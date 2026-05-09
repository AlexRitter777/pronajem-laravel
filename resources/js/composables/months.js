import {trans} from "laravel-vue-i18n";
import {computed} from "vue";


export function useMonths() {
    const months = computed(() =>
        [
        {id: 1, name: trans('month.january')},
        {id: 2, name: trans('month.february')},
        {id: 3, name: trans('month.march')},
        {id: 4, name: trans('month.april')},
        {id: 5, name: trans('month.may')},
        {id: 6, name: trans('month.june')},
        {id: 7, name: trans('month.july')},
        {id: 8, name: trans('month.august')},
        {id: 9, name: trans('month.september')},
        {id: 10, name: trans('month.october')},
        {id: 11, name: trans('month.november')},
        {id: 12, name: trans('month.december')},

    ])

    return { months };
}
