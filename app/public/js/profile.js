$(document).ready(function () {
    const url = $("span#url").text();

    function getScheduleStatus(statusNumber) {
        const statusNames = {
            1:"Pendente",
            2:"Aceito",
            3: "Rejeitado",
        };

        return statusNames[statusNumber];
    }

    function formatDate(dateToFormat) {
        const datetime = new Date(dateToFormat);
        const date = datetime.toLocaleDateString();
        const time = datetime.toLocaleTimeString();
        return `${date} às ${time}`;
    }

    function formatToPrice(number) {
        const price = String(number).replace(".", ",");
        return `R$${price}`;
    }

    function populateTable($table, data, template) {
        $table.empty();

        data.forEach(item => {
            $table.append(template(item));
        });
    }

    function getScheduleRowTemplate(schedule) {
        return `
            <tr>
                <td>${schedule.name}</td>
                <td>${formatToPrice(schedule.price)}</td>
                <td>${formatDate(schedule.datetime)}</td>
                ${schedule.message ? `<td>${schedule.message}</td>` : `<td>---</td>`}
                <td>${getScheduleStatus(schedule.status)}</td>
            </tr>`;
    }

    async function fetchData(endpoint) {
        const data = await fetch(`${url}${endpoint}`);
        return data.json();
    }

    async function updateTable($table, endpoint, rowTemplate) {
        const data = await fetchData(endpoint);
        populateTable($table, data, rowTemplate);
    }

    updateTable($("[data-schedules-card]"), 'schedule/get_by_user', getScheduleRowTemplate);
});
