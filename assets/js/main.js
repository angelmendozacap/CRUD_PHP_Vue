;
const app = new Vue({
  el: '#app',
  data: {
    title: 'Anuma',
    showAddModal: false,
    showEditModal: false,
    showDeleteModal: false,
    erroMessage: '',
    successMessage: '',
    students: [],
    activeStudent: {},
  },
  mounted: {

  }
})