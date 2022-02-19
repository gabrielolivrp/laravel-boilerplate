require("./bootstrap");

require("@coreui/coreui");

const ButtonSubmit = function () {
    /*
        <button type="button" class="btn btn-primary"
            data-submit-method="POST"
            data-submit-action="{{ route('...') }}"
            data-submit-cancel="true"
            data-submit-cancel-button-text="Cancelar"
            data-submit-confirm-button-text="Sim"
            data-submit-confirmation-title-text="Você tem certeza?"
            data-submit-icon="warning"
            data-submit-redirect="..."
            data-submit-redirect-target="_blank"
        >
            Text
        </button>
    */
    function form(method, action) {
        return `
            <form action="${action}" method="POST" style="display:none;">
                <input type="hidden" name="_method" value="${method}" />
                <input type="hidden" name="_token" value="${document.querySelector('[name=csrf-token]').content}" />
            </form>
        `;
    }

    [].forEach.call(document.querySelectorAll('[data-submit-method], [data-submit-redirect]'), function (button) {
        const submitConfirmationTitleText = button.dataset.submitConfirmationTitleText;
        const submitCancelButtonText = button.dataset.submitCancelButtonText;
        const submitConfirmButtonText = button.dataset.submitConfirmButtonText;
        const submitRedirect = button.dataset.submitRedirect;
        const submitAction = button.dataset.submitAction;
        const submitCancel = button.dataset.submitCancel;
        const submitMethod = button.dataset.submitMethod;
        const submitIcon = button.dataset.submitIcon;

        if (submitRedirect === undefined) {
            button.insertAdjacentHTML('afterbegin',
                form(submitMethod, submitAction)
            );
        }

        button.addEventListener('click', function (e) {
            e.preventDefault();

            if (submitCancel !== undefined && submitCancel === 'true') {
                Swal.fire({
                    showCancelButton: true,
                    title: submitConfirmationTitleText ? submitConfirmationTitleText : 'Are you sure?',
                    confirmButtonText: submitConfirmButtonText ? submitConfirmButtonText : 'Yes',
                    cancelButtonText: submitCancelButtonText ? submitCancelButtonText : 'Cancel',
                    icon: submitIcon ? submitIcon : 'info'
                }).then(confirmation => {
                    if (confirmation.value) {
                        if (submitRedirect === undefined) {
                            this.querySelector('form').submit();
                        } else {
                            window.location.assign(submitRedirect);
                        }
                    }
                });
            } else {
                if (submitRedirect === undefined) {
                    this.querySelector('form').submit();
                } else {
                    window.location.assign(submitRedirect);
                }
            }
        });
    });
};

ButtonSubmit();
