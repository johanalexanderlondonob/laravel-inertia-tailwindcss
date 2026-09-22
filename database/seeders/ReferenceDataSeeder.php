<?php

namespace Database\Seeders;

use App\Arketops\City\City;
use App\Arketops\Department\Department;
use App\Arketops\IdentificationType\IdentificationType;
use App\Arketops\NatureType\NatureType;
use App\Arketops\Process\Process;
use App\Arketops\Subprocess\Subprocess;
use App\Arketops\ThirdRegimeType\ThirdRegimeType;
use Illuminate\Database\Seeder;

/**
 * Seeds the catalog/lookup tables the domain forms depend on (cities, identification
 * types, nature types, tax regime types, processes and subprocesses). These are fixed
 * reference values, not user data, so they are safe to commit and reseed at any time.
 *
 * This replaces database/00-general.sql, which mixed this reference data together with
 * real customer/third PII in a single raw SQL dump committed to the repo.
 */
class ReferenceDataSeeder extends Seeder
{
    public function run()
    {
        $department = Department::firstOrCreate(
            ['name' => 'ANTIOQUIA'],
            ['country' => 'COLOMBIA']
        );

        foreach (['MEDELLÍN', 'BELLO', 'CALDAS', 'RIONEGRO', 'AMAGÁ'] as $city) {
            City::firstOrCreate(['name' => $city, 'id_department' => $department->id_department]);
        }

        $identificationTypes = [
            ['name' => 'NIT', 'code_rips' => 'NIT'],
            ['name' => 'CÉDULA DE CIUDADANÍA', 'code_rips' => 'CC'],
            ['name' => 'TARJETA PROFESIONAL', 'code_rips' => 'TP'],
            ['name' => 'CÉDULA DE EXTRANJERÍA', 'code_rips' => 'CE'],
            ['name' => 'NÚMERO ÚNICO DE IDENTIFICACIÓN', 'code_rips' => 'NU'],
            ['name' => 'TARJETA DE IDENTIDAD', 'code_rips' => 'TI'],
        ];
        foreach ($identificationTypes as $type) {
            IdentificationType::firstOrCreate(['code_rips' => $type['code_rips']], $type);
        }

        $natureTypes = [
            ['code' => 'J', 'name' => 'PERSONA JURÍDICA'],
            ['code' => 'N', 'name' => 'PERSONA NATURAL'],
        ];
        foreach ($natureTypes as $type) {
            NatureType::firstOrCreate(['code' => $type['code']], $type);
        }

        $regimeTypes = [
            ['code_regime_type' => 'C', 'name' => 'RESPONSABLE DE IVA'],
            ['code_regime_type' => 'F', 'name' => 'RÉGIMEN SIMPLE'],
            ['code_regime_type' => 'N', 'name' => 'PERSONA NATURAL'],
            ['code_regime_type' => 'R', 'name' => 'NO RESPONSABLE DE IVA'],
        ];
        foreach ($regimeTypes as $type) {
            ThirdRegimeType::firstOrCreate(['code_regime_type' => $type['code_regime_type']], $type);
        }

        $processes = [
            ['name' => 'DIGITACIÓN', 'sequence' => 1, 'subprocesses' => ['DIGITAR EGRESOS', 'DIGITAR COMPRAS']],
            ['name' => 'AUDITORÍA', 'sequence' => 2, 'subprocesses' => ['CONCILIAR BANCOS', 'REVISAR COMPRAS', 'REVISAR GASTOS']],
            ['name' => 'INVENTARIOS', 'sequence' => 3, 'subprocesses' => ['CONTAR MUÑEQUITOS']],
            ['name' => 'FINANCIERA', 'sequence' => 4, 'subprocesses' => ['RECALCULAR INVENTARIO', 'CERRAR MES']],
            ['name' => 'REVISORÍA FISCAL', 'sequence' => 5, 'subprocesses' => []],
        ];

        foreach ($processes as $processData) {
            $process = Process::firstOrCreate(
                ['name' => $processData['name']],
                ['sequence' => $processData['sequence'], 'active' => 'S']
            );

            foreach ($processData['subprocesses'] as $order => $subprocessName) {
                Subprocess::firstOrCreate(
                    ['id_process' => $process->id_process, 'name' => $subprocessName],
                    ['execution_order' => $order + 1, 'active' => 'S']
                );
            }
        }
    }
}
