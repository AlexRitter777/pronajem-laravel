import {defineAsyncComponent} from "vue";

export function useAsyncComponent(name) {

    const path = `/resources/js/components/${name}.vue`
    const partials = import.meta.glob(`@/components/*.vue`, {eager: false})

    return defineAsyncComponent(async () => await partials[path]())

}
