export default {
    methods: {
        checkTimeFormat(start_time = '', end_time = '') {
            const regExp = new RegExp('^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$')

            if (!regExp.test(start_time)) return false;
            if (!regExp.test(end_time)) return false;

            return true;
        },
    }
}
