<template>
    <date-range-picker 
        :startDate="startDate" 
        :endDate="endDate" 
        @update="console.log(value)"
        :locale-data="locale"
    >
    <!--Optional scope for the input displaying the dates -->
    <div slot="input" slot-scope="picker">...</div>
</date-range-picker>
</template>

<script>
import DateRangePicker from 'vue2-daterange-picker'
var moment = require('moment');
export default {
    components: { DateRangePicker },
    data() {
        return {
            moment: moment,
            startDate: '2017-09-05',
            endDate: '2017-09-15',
            locale: {
                direction: 'ltr', //direction of text
                format: 'DD-MM-YYYY', //fomart of the dates displayed
                separator: ' - ', //separator between the two ranges
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                weekLabel: 'W',
                customRangeLabel: 'Custom Range',
                daysOfWeek: moment.weekdaysMin(), //array of days - see moment documenations for details
                monthNames: moment.monthsShort(), //array of month names - see moment documenations for details
                firstDay: 1 //ISO first day of week - see moment documenations for details
            }
        }
    }
}

</script>
