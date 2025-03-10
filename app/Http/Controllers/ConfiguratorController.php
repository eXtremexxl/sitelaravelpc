<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\Configuration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use PDF; // Добавь в начало файла

class ConfiguratorController extends Controller
{
    public function index()
    {
        $components = Cache::remember('components', 3600, fn () => Component::all()->groupBy('category'));
        return view('configurator.index', compact('components'));
    }



    public function download(Request $request)
    {
        $selectedIds = $request->input('components', []);
        $components = Component::whereIn('id', $selectedIds)->get();
        $totalPrice = $components->sum('price');
        $benchmarkScore = $components->sum('benchmark_score');
        $compatibility = $this->checkCompatibility($components);

        $data = [
            'components' => $components,
            'totalPrice' => $totalPrice,
            'benchmarkScore' => $benchmarkScore,
            'compatibility' => $compatibility
        ];

        $pdf = PDF::loadView('configurator.pdf', $data);
        return $pdf->download('PC_Configuration.pdf');
    }

    public function configure(Request $request)
    {
        $selectedComponents = $request->input('components', []);
        $components = Component::whereIn('id', $selectedComponents)->get();
        $compatibility = $this->checkCompatibility($components);
        $totalPrice = $components->sum('price');
        $benchmarkScore = $components->sum('benchmark_score');

        return view('configurator.result', compact('components', 'totalPrice', 'compatibility', 'benchmarkScore'));
    }

    public function checkCompatibilityAjax(Request $request)
    {
        $components = Component::whereIn('id', $request->input('components', []))->get();
        $compatibility = $this->checkCompatibility($components);
        $totalPrice = $components->sum('price');
        $benchmarkScore = $components->sum('benchmark_score');

        return response()->json([
            'totalPrice' => $totalPrice,
            'compatibilityMessages' => $compatibility['messages'],
            'status' => $compatibility['status'],
            'benchmarkScore' => $benchmarkScore
        ]);
    }

    public function getCompatibleComponents(Request $request)
    {
        $cpu = Component::find($request->cpu_id);
        $motherboards = Component::where('category', 'Материнская плата')
            ->where('socket', $cpu->socket)
            ->where('form_factor', $request->form_factor ?? 'ATX')
            ->get();
        return response()->json($motherboards);
    }

    public function saveConfiguration(Request $request)
    {
        $this->middleware('auth');
        $user = Auth::user();
        $user->configurations()->create([
            'components' => $request->input('components'),
            'name' => $request->input('name', 'Моя сборка')
        ]);
        return redirect()->route('configurator.index')->with('success', 'Сборка сохранена!');
    }

    public function recommended(Request $request)
    {
        $budget = $request->input('budget', 50000);
        $maxPrice = $budget / 9;
        $components = collect();
        $categories = Component::where('price', '<=', $maxPrice)->pluck('category')->unique();
    
        foreach ($categories as $category) {
            $component = Component::where('category', $category)
                ->where('price', '<=', $maxPrice)
                ->orderBy('price', 'asc')
                ->first();
            if ($component) {
                $components->push($component);
            }
        }
    
        return view('configurator.recommended', compact('components'));
    }
    private function checkCompatibility($components)
    {
        $result = ['status' => true, 'messages' => []];
        $cpu = $components->where('category', 'Процессор')->first();
        $mobo = $components->where('category', 'Материнская плата')->first();
        $gpu = $components->where('category', 'Видеокарта')->first();
        $ram = $components->where('category', 'ОЗУ')->first();
        $psu = $components->where('category', 'Блок питания')->first();
        $case = $components->where('category', 'Корпус')->first();
        $cooler = $components->where('category', 'Кулер')->first();
        $ssd = $components->where('category', 'SSD')->first();
        $hdd = $components->where('category', 'HDD')->first();
    
        // Процессор и материнская плата (сокет)
        if ($cpu && $mobo && $cpu->socket !== $mobo->socket) {
            $result['status'] = false;
            $result['messages'][] = "Сокет процессора ({$cpu->socket}) не совпадает с материнской платой ({$mobo->socket})";
        }
    
        // Новая проверка мощности
        $totalPower = 0;
        if ($cpu) $totalPower += $cpu->tdp; // TDP процессора
        if ($gpu) $totalPower += $gpu->power; // Мощность видеокарты
        if ($mobo) $totalPower += 50; // Материнская плата
        if ($ram) $totalPower += 5; // ОЗУ (5 Вт на модуль)
        if ($ssd) $totalPower += 5; // SSD
        if ($hdd) $totalPower += 5; // HDD
        if ($cooler) $totalPower += 10; // Кулер
        if ($case) $totalPower += 10; // Корпус (вентиляторы)
    
        // Учитываем запас мощности (x1.3)
        $recommendedPower = $totalPower * 1.3;
    
        if ($psu && $recommendedPower > $psu->power) {
            $result['status'] = false;
            $result['messages'][] = "Мощности БП ({$psu->power} Вт) недостаточно, требуется ~{$recommendedPower} Вт";
        }
    
        // Форм-фактор корпуса и материнской платы
        if ($mobo && $case && $mobo->form_factor !== $case->form_factor) {
            $result['status'] = false;
            $result['messages'][] = "Форм-фактор материнки ({$mobo->form_factor}) не подходит для корпуса ({$case->form_factor})";
        }
    
        // ОЗУ и материнская плата (частота и слоты)
        if ($ram && $mobo) {
            if ($ram->frequency > $mobo->max_memory_freq) {
                $result['status'] = false;
                $result['messages'][] = "Частота ОЗУ ({$ram->frequency} МГц) превышает максимум материнки ({$mobo->max_memory_freq} МГц)";
            }
            if ($ram->capacity > ($mobo->memory_slots * 32)) {
                $result['status'] = false;
                $result['messages'][] = "Объем ОЗУ ({$ram->capacity} ГБ) превышает возможности материнки ({$mobo->memory_slots} слотов)";
            }
        }
    
        // Видеокарта и материнская плата (PCIe)
        if ($gpu && $mobo && $gpu->pcie_version > $mobo->pcie_version) {
            $result['status'] = false;
            $result['messages'][] = "Видеокарта требует PCIe {$gpu->pcie_version}, а материнка поддерживает PCIe {$mobo->pcie_version}";
        }
    
        // Корпус и видеокарта (длина)
        if ($gpu && $case && $gpu->max_gpu_length > $case->max_gpu_length) {
            $result['status'] = false;
            $result['messages'][] = "Длина видеокарты ({$gpu->max_gpu_length} мм) превышает максимум корпуса ({$case->max_gpu_length} мм)";
        }
    
        // Корпус и блок питания (длина)
        if ($psu && $case && $psu->max_psu_length > $case->max_psu_length) {
            $result['status'] = false;
            $result['messages'][] = "Длина БП ({$psu->max_psu_length} мм) превышает максимум корпуса ({$case->max_psu_length} мм)";
        }
    
        // Кулер и процессор (TDP и сокет)
        if ($cpu && $cooler) {
            if ($cpu->tdp > $cooler->tdp) {
                $result['status'] = false;
                $result['messages'][] = "TDP процессора ({$cpu->tdp} Вт) превышает возможности кулера ({$cooler->tdp} Вт)";
            }
            if (!str_contains($cooler->socket, $cpu->socket)) {
                $result['status'] = false;
                $result['messages'][] = "Сокет кулера ({$cooler->socket}) не поддерживает процессор ({$cpu->socket})";
            }
        }
    
        // SSD/HDD и корпус (объем)
        if ($ssd && $hdd && $case && ($ssd->capacity + $hdd->capacity > 16000)) {
            $result['status'] = false;
            $result['messages'][] = "Общий объем накопителей превышает возможности корпуса";
        }
    
        return $result;
    }
}