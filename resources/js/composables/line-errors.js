export default function useLineErrors(type) {
    return (errors, line) => {

        const prefix = `${type}.${line}.`;

        const result = {};

        for (const [key, value] of Object.entries(errors)) {

            if(!key.startsWith(prefix)){
                continue;
            }

            result[key.replace(prefix, '')] = value;

        }

        return result;
    }
}
