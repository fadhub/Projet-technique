export default () => ({
    showModal: false,
    modalTitle: '',
    formAction: '',
    formMethod: 'POST',

    openModal(title, action, method = 'POST') {
        this.modalTitle = title;
        this.formAction = action;
        this.formMethod = method;
        this.showModal = true;
    },

    closeModal() {
        this.showModal = false;
    }
});
