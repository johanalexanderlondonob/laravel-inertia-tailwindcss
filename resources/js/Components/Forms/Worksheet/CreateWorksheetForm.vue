<template>
    <form @submit.prevent="createWorksheet">
        <div class="space-y-4">
            <div v-if="customers">
                <jet-label for="id_customer" value="Cliente" />
                <select id="id_customer" v-model="form.id_customer"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-25">
                    <option value="" disabled>Elige un cliente</option>
                    <option v-for="customer in listCustomers" :key="customer.value" :value="customer.value">
                        {{ customer.text }}
                    </option>
                </select>
                <jet-input-error :message="form.errors.id_customer" class="mt-2" />
            </div>

            <div>
                <jet-label for="period" value="Período" />
                <jet-input id="period" type="text" class="mt-1 block w-full" v-model="form.period"
                           placeholder="2101" maxlength="4" :disabled="!form.id_customer" autofocus />
                <p class="mt-1 text-xs text-gray-400">Dos últimos dígitos del año, y el mes</p>
                <jet-input-error :message="form.errors.period" class="mt-2" />
            </div>

            <jet-button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Crear Hoja de trabajo
            </jet-button>
        </div>

        <jet-dialog-modal :show="dialogPeriod" @close="dialogPeriod = false">
            <template #title> Se encontró un período </template>
            <template #content> Ya existe un período para el cliente seleccionado. Verifica los datos provistos. </template>
            <template #footer>
                <jet-secondary-button @click="dialogPeriod = false"> ¡Entendido! </jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <jet-action-message :on="showSnackbarWorksheetCreated" class="mt-2 block">
            Hoja de trabajo creada satisfactoriamente
        </jet-action-message>
    </form>
</template>

<script>
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetActionMessage from "@/Jetstream/ActionMessage";

export default {
    name: "CreateWorksheetForm",

    components: {
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
        JetSecondaryButton,
        JetDialogModal,
        JetActionMessage,
    },

    props: {
        customer: {
            type: Number,
            required: false
        },
        customers: {
            type: Array,
            default: null,
            required: false
        },
    },

    created() {
        // Sets the timeout for querying to the server if period exists from the current customer
        this.debounceExistsPeriod = _.debounce(this.existsPeriod, 1000);
    },

    mounted() {
        if (this.customer) {
            this.form.id_customer = this.customer
        }
    },

    data() {
        return {
            form: this.$inertia.form({
                id_customer: '',
                period: '',
            }),
            dialogPeriod: false,
            showSnackbarWorksheetCreated: false,
        }
    },

    methods: {
        existsPeriod() {
            // Revalidate that period field contains 4 digits
            if (this.form.period.length === 4) {
                axios
                    .get('/api/worksheet/' + this.form.id_customer + '/' + this.form.period)
                    .then((response) => {
                        if (response.data) {
                            // Show the dialog that notice customer already have a period asignated
                            this.dialogPeriod = true
                            this.form.period = ''
                        }
                    })
                    .catch((error) => {
                        alert(error)
                    })
            }
        },

        createWorksheet() {
            this.form.post(route('worksheet.new'), {
                errorBag: 'createWorksheet',
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                    this.showSnackbarWorksheetCreated = true
                    setTimeout(() => this.showSnackbarWorksheetCreated = false, 2000)
                }
            })
        },

        resetForm() {
            if (this.form.hasErrors()) {
                this.form.clearErrors()
                this.form.reset()
            }
        }
    },

    computed: {
        // Function that return an array with the customers data received from the server and ready for read
        listCustomers() {
            let listCustomers = [];
            for (const customer of this.customers) {
                listCustomers.push({text: customer.name, value: customer.id})
            }
            return listCustomers;
        },
    },

    watch: {
        'form.period'(newValue, oldValue) {
            this.debounceExistsPeriod();
        },
        customer(newValue) {
            this.form.period = ''
            this.form.id_customer = newValue
        }
    },
}
</script>
