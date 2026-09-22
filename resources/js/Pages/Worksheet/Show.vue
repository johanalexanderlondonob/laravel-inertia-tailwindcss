<template>
    <worksheet-layout>
        <template #toolbarTitle> Hoja de trabajo {{ worksheet.period }} </template>
        <template #main>
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ worksheet.customer ? worksheet.customer.third.third_name : '—' }}
                        </h2>
                        <p class="text-sm text-gray-500">Período {{ worksheet.period }}</p>
                    </div>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-medium"
                        :class="worksheet.opened === 'S' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600'"
                    >
                        {{ worksheet.opened === 'S' ? 'Abierta' : 'Cerrada' }}
                    </span>
                </div>

                <h3 class="mt-6 text-sm font-semibold text-gray-600 uppercase tracking-wide">Procesos</h3>
                <table v-if="worksheet.worksheet_processes && worksheet.worksheet_processes.length" class="mt-2 min-w-full divide-y divide-gray-200 text-sm">
                    <thead>
                    <tr class="text-left text-gray-500">
                        <th class="py-2 pr-4">Proceso</th>
                        <th class="py-2 pr-4">Fecha tentativa finalización</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    <tr v-for="wp in worksheet.worksheet_processes" :key="wp.id_worksheet_process">
                        <td class="py-2 pr-4">{{ wp.process ? wp.process.name : '—' }}</td>
                        <td class="py-2 pr-4">{{ formatDate(wp.ideal_completion_date) }}</td>
                    </tr>
                    </tbody>
                </table>
                <p v-else class="mt-2 text-sm text-gray-400">Aún no se han relacionado procesos a esta hoja de trabajo.</p>

                <Link :href="route('worksheet.processes.new', { id: worksheet.id_worksheet })"
                      class="inline-block mt-6 text-sm text-primary hover:underline">
                    Gestionar procesos →
                </Link>
            </div>
        </template>
    </worksheet-layout>
</template>

<script>
import WorksheetLayout from "@/Layouts/WorksheetLayout";
import moment from "moment";

export default {
    name: "Show",

    components: {
        WorksheetLayout,
    },

    props: {
        worksheet: {
            required: true,
        }
    },

    methods: {
        formatDate(date) {
            return date ? moment(date).format('dddd, D MMMM, YYYY') : '—';
        },
    },
}
</script>
