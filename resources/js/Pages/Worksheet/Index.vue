<template>
    <worksheet-layout>
        <template #toolbarTitle> Hojas de trabajo </template>
        <template #main>
            <div v-if="!customers" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="i in 4" :key="i" class="bg-white rounded-lg shadow p-6 animate-pulse">
                    <div class="h-4 bg-gray-200 rounded w-2/3 mb-4"></div>
                    <div class="h-3 bg-gray-200 rounded w-1/3"></div>
                </div>
            </div>

            <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="(customer, i) in customers" :key="i" class="bg-white rounded-lg shadow p-6 flex flex-col">
                    <h3 class="font-semibold text-gray-800 truncate">{{ customer.info.thirdName }}</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Hojas de trabajo: <span class="font-medium text-gray-700">{{ customer.worksheets.length }}</span>
                    </p>
                    <div class="mt-4 flex space-x-2">
                        <button v-if="customer.worksheets.length > 0" @click="showWorksheets(customer)"
                                title="Ver hojas de trabajo"
                                class="p-2 rounded-full text-primary hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <button @click="newPeriod(customer)"
                                title="Crear nuevo período"
                                class="p-2 rounded-full text-primary hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <jet-dialog-modal :show="isNewPeriod" @close="isNewPeriod = false">
                <template #title> Nueva Hoja de trabajo — {{ customer.name }} </template>
                <template #content>
                    <create-worksheet-form :customer="customer.id"></create-worksheet-form>
                </template>
            </jet-dialog-modal>

            <jet-dialog-modal :show="isLookingWorksheets" @close="isLookingWorksheets = false" max-width="2xl">
                <template #title> Hojas de trabajo — {{ customer.name }} </template>
                <template #content>
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead>
                        <tr class="text-left font-semibold text-gray-600">
                            <th class="py-2 pr-4">Período</th>
                            <th class="py-2 pr-4">Fecha creación</th>
                            <th class="py-2 pr-4 text-center">Abierto</th>
                            <th class="py-2"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        <tr v-for="(worksheet, i) in customer.worksheets" :key="i">
                            <td class="py-2 pr-4">{{ worksheet.period }}</td>
                            <td class="py-2 pr-4">{{ completionDateFormatted(worksheet.createdAt) }}</td>
                            <td class="py-2 pr-4 text-center">{{ worksheet.opened === 'S' ? 'Sí' : 'No' }}</td>
                            <td class="py-2 text-right">
                                <button class="text-primary hover:underline" @click="showWorksheet(worksheet.id)">Ver</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </template>
            </jet-dialog-modal>
        </template>
    </worksheet-layout>
</template>

<script>
import WorksheetLayout from "../../Layouts/WorksheetLayout.vue";
import CreateWorksheetForm from '../../Components/Forms/Worksheet/CreateWorksheetForm';
import JetDialogModal from "@/Jetstream/DialogModal";
import moment from "moment";

export default {
    components: {
        WorksheetLayout,
        CreateWorksheetForm,
        JetDialogModal,
    },

    props: {
        customers: {
            required: true,
            default: null
        }
    },

    data() {
        return {
            customer: {},
            isNewPeriod: false,
            isLookingWorksheets: false,
        }
    },

    methods: {
        newPeriod(customer) {
            this.isNewPeriod = true
            this.customer = {id: customer.id, name: customer.info.thirdName, worksheets: customer.worksheets}
        },

        showWorksheets(customer) {
            this.isLookingWorksheets = true
            this.customer = {id: customer.id, name: customer.info.thirdName, worksheets: customer.worksheets}
        },

        showWorksheet(id) {
            this.$inertia.get(route('worksheet.show', id))
        },

        completionDateFormatted(date) {
            return moment(date).format('dddd, D MMMM, YYYY')
        },
    },
};
</script>
