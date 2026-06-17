import {message} from "@/messageStore.js";

export function useTooltip() {
    function showTooltip(text) {
        message.value = text;
    }

    function clearTooltip() {
        message.value = '';
    }

    return {
        showTooltip,
        clearTooltip
    }
}
