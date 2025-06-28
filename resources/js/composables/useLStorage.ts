import { Ref, ref, watch } from "vue";

export function useLStorage(key: string, val?: string): Ref<string | null> {

    console.log('value', val);


    const storedValue = localStorage.getItem(key);

    let value = ref('');

    if (storedValue) {
        value = ref(storedValue);
    } else {
        value = ref(val);
        write();
    }


    function write() {
        localStorage.setItem(key, value.value);
    }

    watch(value, (val) => {
        if (val === '') {
            localStorage.removeItem(key);
        } else {
            write();
        }
    });



    return value;

}
