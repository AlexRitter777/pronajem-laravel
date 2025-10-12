import {computed} from "vue";


export function useProperties(items) {
    return computed(() => {
        const map = {};
        items.forEach((item) => {
            const count = item.properties?.length || 0;

            if (count > 1) {
                map[item.id] = 'Více nemovitostí'
            } else if (count === 1) {
                map[item.id] = item.properties[0].address
            } else {
                map[item.id] = '\u2014'
            }
        });

        return map;
    });

}
