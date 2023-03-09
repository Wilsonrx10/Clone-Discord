export default {
    methods: {
        /* Metódo para formatar money */
        formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
            try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

                const negativeSign = amount < 0 ? "-" : "";

                const i = parseInt(
                    (amount = Math.abs(Number(amount) || 0).toFixed(
                        decimalCount
                    ))
                ).toString();
                const j = i.length > 3 ? i.length % 3 : 0;

                return (
                    negativeSign +
                    (j ? i.substr(0, j) + thousands : "") +
                    i.substr(j).replace(/(\d{3})(?=\d)/g, `$1${thousands}`) +
                    (decimalCount
                        ? decimal +
                          Math.abs(amount - i)
                              .toFixed(decimalCount)
                              .slice(2)
                        : "")
                );
            } catch (e) {
                console.log(e);
            }
        },

        /* Metódos para formatar Date */
        formatDate(input) {
            if (input) {
                const datePart = input.match(/\d+/g);
                const year = datePart[0].substring(0);
                const month = datePart[1];
                const day = datePart[2];

                return `${day}/${month}/${year}`;
            }
        },
        formatDateHour(input) {
            if (input) {
                const datePart = input.match(/\d+/g);
                const year = datePart[0].substring(0);
                const month = datePart[1];
                const day = datePart[2];
                const hour = datePart[3];
                const min = datePart[4];

                return `${day}/${month}/${year} ${hour}:${min}`;
            }
        },
        formatDateDay(input) {
            const datePart = input.match(/\d+/g);
            const day = datePart[2];
            return day;
        },
        formatDateMonth(input) {
            const datePart = input.match(/\d+/g);
            const month = datePart[1];
            const months = [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro",
            ];
            return months[month - 1];
        },
        formatDateYear(input) {
            const datePart = input.match(/\d+/g);
            const year = datePart[0].substring(0);
            return year;
        },
        formatDateStringMonth(input) {
            if (input) {
                const datePart = input.match(/\d+/g);
                const year = datePart[0].substring(0);
                const month = datePart[1];
                const day = datePart[2];

                return `${day} ${month} ${year}`;
            }
        },
        formatHour(input) {
            const datePart = input.match(/\d+/g);
            const hour = datePart[3];
            const min = datePart[4];
            return `${hour}:${min}`;
        },
        formatMoment(input) {
            const operation = parseInt((new Date() - new Date(input)) / 60000);
            const datePart = input.match(/\d+/g);
            const year = datePart[0].substring(0);
            const month = datePart[1];
            const day = datePart[2];
            const hour = datePart[3];
            const min = datePart[4];

            const hourParsed = parseInt(operation / 60);
            if (operation < 60) {
                return `Há ${
                    operation + (operation === 1 ? " minuto" : "  minutos")
                }`;
            } else if (hourParsed < 6) {
                return `Há ${
                    hourParsed + (hourParsed === 1 ? " hora" : " horas")
                }`;
            } else {
                return `${day}/${month}/${year} ${hour}:${min}`;
            }
        },
    },
};