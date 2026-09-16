<template>
    <v-form ref="formNewWorksheet">
        <!-- Select customer and set period-->
        <v-row>
            <v-col v-if="customers" cols="12">
                <v-select label="Cliente" outlined dense v-model="form.id_customer" autofocus
                          :rules="rulesCustomer"
                          :items="listCustomers"
                          :error-messages="form.errors.id_customer"></v-select>
            </v-col>
            <v-col cols="12">
                <v-text-field label="Período" outlined dense v-model="form.period" placeholder="2101" counter="4" autofocus
                              hint="Dos últimos dígitos del año, y el mes"
                              :rules="rulesPeriod"
                              :disabled="!form.id_customer"
                              :error-messages="form.errors.period"></v-text-field>
            </v-col>
        </v-row>
        <v-spacer></v-spacer>
        <v-row>
            <v-col>
                <v-btn outlined color="primary" @click="createWorskheet"> Crear Hoja de trabajo</v-btn>
            </v-col>
        </v-row>
        <v-dialog v-model="dialogPeriod" persistent max-width="450">
            <v-card>
                <v-card-title class="headline"> Se encontró un período </v-card-title>
                <v-card-text> Ya existe un período para el cliente seleccionado. Verifica los datos provistos.</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary darken-1" text @click="dialogPeriod = false"> ¡Entendido! </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-snackbar top v-model="showSnackbarWorksheetCreated"
                    timeout="1500"> Hoja de trabajo creado satisfactoriamente </v-snackbar>
    </v-form>
</template>

<script>
export default {
    name: "CreateWorksheetForm",

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
            rulesPeriod: [
                value => value.length <= 4 || 'Only 4 characters',
                value => !!value || 'This field is required'
            ],
            rulesCustomer: [
                value => !!value || 'This field is required'
            ],
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
                        console.log(response)
                        if (response.data) {
                            // Show the dialog that notice customer already have a period asignated
                            this.dialogPeriod = true
                            this.form.period = ''
                        }
                        // else {
                        //     // Sets the field period of the form that will be sent to the server
                        //     this.form.period = this.period
                        // }
                    })
                    .catch((error) => {
                        alert(error)
                    })
            }
        },

        validate() {
            return this.$refs.formNewWorksheet.validate()
        },

        createWorskheet() {
            if (this.validate()) {
                this.form.post(route('worksheet.new'), {
                    errorBag: 'createWorksheet',
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                        this.showSnackbarWorksheetCreated = true
                    }
                })
            }
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
        // Function that return true or false if the period given is valid. The format valid must be contains 4 digits:
        //      - the first two digits are the two last digits of the year;
        //      - the second two digits are the month
        isValidPeriod() {
            let year = this.form.period.substring(0, 1);
            let month = this.form.period.substring(2, 4);
            let currentYear = new Date().getFullYear().toString()

            return year > '19' && year <= currentYear.substring(2, 4) && month.startsWith('0', 0) || month.startsWith('1', 0) && month <= '12'
        }
    },

    watch: {
        'form.period'(newValue, oldValue) {
            // if (this.form.period.length === 4 && newValue !== oldValue && this.isValidPeriod) {
                // this.form.reset('period', 'processes')
                this.debounceExistsPeriod();
            // }
        },
        customer(newValue) {
            this.form.period = ''
            this.form.id_customer = newValue
        }
    },
}
</script>

<style scoped>

</style>
