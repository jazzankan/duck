<script>
    import DatePicker from 'vue2-datepicker'

    export default {
        components: { DatePicker },
        name: 'date-picker',
        data() {
            return {
                time1: '',
                time2: '',
                time3: '',
                // custom lang
                lang: {
                    days: ['Sun', 'Mon', 'Tis', 'Wed', 'Thu', 'Fri', 'Sat'],
                    months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
                    placeholder: {
                        date: 'Välj datum',
                        dateRange: 'Select Date Range'
                    }
                },
                // custom range shortcuts
                shortcuts: [
                    {
                        text: 'Today',
                        onClick: () => {
                            this.time3 = [ new Date(), new Date() ]
                        }
                    }
                ],
                timePickerOptions:{
                    start: '00:00',
                    step: '00:30',
                    end: '23:30'
                }
            }
        }
    }
</script>

<template>
    <div>
         <date-picker v-model="time1" :first-day-of-week="1"></date-picker>
         <date-picker v-model="time2" type="datetime" :time-picker-options="timePickerOptions"></date-picker>
         <date-picker v-model="time3" range :shortcuts="shortcuts"></date-picker>
         <date-picker v-model="value" :lang="lang"></date-picker>
    </div>
</template>
