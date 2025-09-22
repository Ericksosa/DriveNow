document.addEventListener("DOMContentLoaded", function () {
    let successMessage = document.querySelector(
        'meta[name="sweet-alert-success"]'
    );
    let warningMessage = document.querySelector(
        'meta[name="sweet-alert-warning"]'
    );
    let errorMessage = document.querySelector('meta[name="sweet-alert-error"]');
    let validationErrors = document.querySelector(
        'meta[name="sweet-alert-errors"]'
    );

    if (successMessage) {
        Swal.fire({
            title: "Éxito!",
            text: successMessage.content,
            icon: "success",
            customClass: {
                confirmButton:
                    "bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2",
            },
            buttonsStyling: false, // Desactiva los estilos predeterminados de SweetAlert2
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: "error",
            title: "Error!",
            text: errorMessage.content,
            customClass: {
                confirmButton:
                    "bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-2",
            },
            buttonsStyling: false, // Desactiva los estilos predeterminados de SweetAlert2
        });
    }

    if (warningMessage) {
        Swal.fire({
            icon: "warning",
            title: "Sesión expirada",
            text: warningMessage.content,
            customClass: {
                confirmButton:
                    "bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mr-2",
            },
        });
    }

    if (validationErrors) {
        let errors = JSON.parse(validationErrors.content);
        let errorMessages = errors.join("\n");
        Swal.fire({
            icon: "error",
            title: "Error de validación!",
            text: errorMessages,
            customClass: {
                confirmButton:
                    "bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-2",
            },
            buttonsStyling: false, // Desactiva los estilos predeterminados de SweetAlert2
        });
    }
});
