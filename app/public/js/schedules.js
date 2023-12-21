$(document).ready(function () {
    var currentYear, currentMonth;
    var user_choices = {
        username: '',
        tel: '',
        service: '',
        date: '',
        time: '',
        message: '',
    };

    function getMonthName(month) {
        var monthNames = [
            "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
            "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
        ];

        return monthNames[month];
    }

    function fillWeekdays() {
        var weekdays = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];
        var weekdaysContainer = $(".calendar_weekdays");

        weekdays.forEach(function (day) {
            weekdaysContainer.append("<div>" + day + "</div>");
        });
    }

    function fillCalendarContent(year, month) {
        var daysInMonth = new Date(year, month + 1, 0).getDate();
        var firstDayOfMonth = new Date(year, month, 1).getDay();
        var calendarContent = $(".calendar_content");
        calendarContent.empty();

        for (var i = 0; i < firstDayOfMonth; i++) {
            calendarContent.append(`<div class="blank"></div>`);
        }

        var currentDate = new Date();
        for (var day = 1; day <= daysInMonth; day++) {
            var date = new Date(year, month, day);
            var dayClass = date < currentDate ? "passed" : "";

            if (date.toDateString() !== currentDate.toDateString()) {
                calendarContent.append(`<div data-time="${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}" class="${dayClass}">` + day + "</div>");
            } else {
                calendarContent.append(`<div data-time="${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}">${day}</div>`);
            }
        }
    }

    function updateCurrentMonthYear() {
        $(".current-month-year").text(getMonthName(currentMonth) + " de " + currentYear);
    }

    function initializeCalendar() {
        var currentDate = new Date();
        currentYear = currentDate.getFullYear();
        currentMonth = currentDate.getMonth();

        fillWeekdays();
        fillCalendarContent(currentYear, currentMonth);
        updateCurrentMonthYear();
    }

    function isDatetimeUnavailable(time, unavailableTimes) {
        return unavailableTimes.some(unavailableTime => unavailableTime.datetime.includes(time));
    }

    async function fillTimeChoices(datetime) {
        var fetchData = await fetch("http://localhost/template_php/schedule/get_unavailable_datetime");
        var indisponibleTimes = await fetchData.json();

        var disponibleTimes = [
            "7:00", "7:30",
            "8:00", "8:30",
            "9:00", "9:30",
            "10:00", "10:30",
            "11:00", "11:30",
            "12:00", "12:30",
            "13:00", "13:30",
            "14:00", "14:30",
            "15:00", "15:30",
            "16:00", "16:30",
            "17:00", "17:30",
        ];

        var timesContent = $(".time__buttons");
        timesContent.empty();

        for (var index = 0; index <= disponibleTimes.length - 1; index++) {
            var currentTime = disponibleTimes[index];
            var check = `${datetime}${currentTime}:00`;

            if (!isDatetimeUnavailable(check, indisponibleTimes)) {
                timesContent.append(`<button>${currentTime}</button>`);
            }
        }
    }

    function scrollToSection(sectionClass) {
        $([document.documentElement, document.body]).animate({ scrollTop: $(sectionClass).offset().top }, 500);
    }

    function handleServiceSelection() {
        user_choices.service = $(this).attr('data-id');

        $('.services__container .service').removeClass('active');
        $(this).addClass('active');

        scrollToSection('.datetime__section');
    }

    function handleTimeSelection() {
        user_choices.time = $(this).text();

        $('.time__buttons button').removeClass('active');
        $(this).addClass('active');

        if (user_choices.time && user_choices.date) {
            scrollToSection('.message__section');
        }
    }

    function handleDateSelection() {
        user_choices.date = $(this).attr('data-time');

        fillTimeChoices($(this).attr('data-time'));

        $('.calendar_content div').removeClass('active');
        $(this).addClass('active');

        if (user_choices.time && user_choices.date) {
            scrollToSection('.message__section');
        }
    }

    function handleConfirmation() {
        user_choices.username = $('#username_message').val() || '';
        user_choices.message = $('#textarea_message').val() || '';
        user_choices.tel = $('#telephone_message').val() || '';

        var targetSection =
            !user_choices.service ? '.service__type__section' :
                (!user_choices.date || !user_choices.time) ? '.datetime__section' :
                    (!user_choices.username || !user_choices.tel) ? '.message__section' :
                        null;

        if (targetSection) {
            scrollToSection(targetSection);
            return;
        }

        showConfirmationModal();
    }

    function handleSubmit() {
        const { username, tel, service, date, time, message } = user_choices;
        const datetime = `${date} ${time}:00`;

        $.post("http://localhost/template_php/schedule/add", {
            username, tel, service, datetime, message
        })
            .done(function (data) {
                const response = JSON.parse(data);

                if (response.status) {
                    $('.modal__body').append(`<p class="modal__alert">Agendamento realizado com sucesso!</p>`);
                    $('.modal__footer').children("#modal_close").html("Fechar");
                    resetAll();
                } else {
                    $('.modal__body').append(`<p class="modal__alert">Erro ao realizar agendamento. Tente novamente.</p>`);
                }
            });
    }

    function resetAll() {
        $('.calendar_content div').removeClass('active');
        $('.services__container .service').removeClass('active');
        $('.time__buttons').empty();

        $('#username_message').val('');
        $('#textarea_message').val('');
        $('#telephone_message').val('');

        user_choices = {
            username: '',
            tel: '',
            service: '',
            date: '',
            time: '',
            message: '',
        };
    }

    function hideConfirmationModal() {
        $('.modal__overlay').removeClass('modal__active');
    }

    function showConfirmationModal() {
        const { username, tel, service, date, time, message } = user_choices;

        var splitedDate = String(date).split('-');
        var formattedDate = `${splitedDate[2].trim()}/${splitedDate[1].trim()}/${splitedDate[0].trim()}`;

        $('.modal__overlay').addClass('modal__active');
        $('.modal__body').html(`
            <h3>Confirmação do agendamento</h3>
            <p>Nome: ${username}</p>
            <p>Telefone para contato: ${tel}</p>
            ${message ? `<p>Mensagem: ${user_choices.message}</p>` : ``}
            <hr>
            <p>Serviço: ${service}</p>
            <p>Data: ${formattedDate}</p>
            <p>Horário: ${time}</p>
        `);
    }

    initializeCalendar();

    $(".switch-left").click(function () {
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        currentYear -= (currentMonth === 11) ? 1 : 0;

        updateCurrentMonthYear();
        fillCalendarContent(currentYear, currentMonth);
    });

    $(".switch-right").click(function () {
        currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
        currentYear += (currentMonth === 0) ? 1 : 0;

        updateCurrentMonthYear();
        fillCalendarContent(currentYear, currentMonth);
    });

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                $(entry.target).addClass('visible');
            }
        });
    }, { threshold: 0.1 });

    $('.title__background').each(function () {
        observer.observe(this);
    });

    $(window).scroll(function () {
        $('.title__background.visible').each(function () {
            var scroll = $(window).scrollTop();
            var offset = $(this).offset().top - $(window).height();

            if (scroll > offset) {
                $(this).css({
                    transform: 'translateX(' + (scroll - offset) + 'px)'
                });
            }
        });
    });

    $('.start__btn').click(function () {
        scrollToSection('.service__type__section');
    });

    $('.services__container').on('click', '.service', handleServiceSelection);

    $('.time__buttons').on('click', 'button', handleTimeSelection);

    $('.calendar_content').on('click', 'div:not(.blank, .passed)', handleDateSelection);

    $('.schedule__confirm').click(handleConfirmation);

    $('#modal_close').click(hideConfirmationModal);

    $('#confirm_modal_btn').click(handleSubmit);
});

