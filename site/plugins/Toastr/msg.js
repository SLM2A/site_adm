define(function () {


    var vm = {

    };

    vm.showError = function (mensagem, titulo, timeOutSegundos) {
        if (timeOutSegundos) {
            toastr.options.timeOut = timeOutSegundos * 1000;
        } else {
            toastr.options.timeOut = 0;
        }
        toastr.error(mensagem, titulo);
    };

    vm.showInfo = function (mensagem, titulo, timeOutSegundos) {
        if (timeOutSegundos) {
            toastr.options.timeOut = timeOutSegundos * 1000;
        } else {
            toastr.options.timeOut = 0;
        }
        toastr.info(mensagem, titulo);
    };

    vm.showWarning = function (mensagem, titulo, timeOutSegundos) {
        if (timeOutSegundos) {
            toastr.options.timeOut = timeOutSegundos * 1000;
        } else {
            toastr.options.timeOut = 0;
        }
        toastr.warning(mensagem, titulo);
    };

    vm.showSuccess = function (mensagem, titulo, timeOutSegundos) {
        if (timeOutSegundos) {
            toastr.options.timeOut = timeOutSegundos * 1000;
        } else {
            toastr.options.timeOut = 0;
        }
        toastr.success(mensagem, titulo);
    };


    return vm;
});