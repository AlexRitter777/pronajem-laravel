import {defineAsyncComponent} from "vue";

export function useAsyncComponent(name) {

    const path = `/resources/js/components/Tables/${name}.vue`
    const partials = import.meta.glob(`@/components/Tables/*.vue`, {eager: false})

    return defineAsyncComponent(async () => await partials[path]())

}
