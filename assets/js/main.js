;

const query = async (method = 'GET', body = [], params = 'read') => {
  try {
    const API_URL = `./api.php?action=${params}`
    let myInit = {}
    if (method !== 'GET') {
      myInit = {
        method,
        body
      }
    }
    const res = await fetch(API_URL, myInit)
    const data = await res.json()
    return data
  } catch (err) {
    console.log(err)
  }
}

const app = new Vue({
  el: '#app',
  data: {
    title: 'Anuma',
    showAddModal: false,
    showEditModal: false,
    showDeleteModal: false,
    errorMessage: '',
    successMessage: '',
    students: [],
    activeStudent: {},
  },
  mounted() {
    this.getAllStudents()
  },
  computed: {
    displayAddModal() {
      return (this.showAddModal) ? 'u-show' : ''
    },
    displayEditModal() {
      return (this.showEditModal) ? 'u-show' : ''
    },
    displayDeleteModal() {
      return (this.showDeleteModal) ? 'u-show' : ''
    },
  },
  methods: {
    toggleModal(modal) {
      if (modal === 'add') {
        this.showAddModal = !this.showAddModal
      } else if (modal === 'edit') {
        this.showEditModal = !this.showEditModal
      } else if (modal === 'delete') {
        this.showDeleteModal = !this.showDeleteModal
      }
    },
    setMessage(res) {
      if (res.code === 201 || res.code === 200) {
        console.log(res)
        this.successMessage = res.message
        this.getAllStudents()
      } else {
        this.errorMessage = res.message
      }
      setTimeout(() => {
        this.errorMessage = false
        this.successMessage = false
      }, 3000);
    },
    getAllStudents: async function() {
      const students = await query()
      this.students = students
    },
    createStudent: async function (e) {
      const formData = new FormData(e.target)
      const data = await query('POST', formData, 'create')
      this.toggleModal('add')
      this.setMessage(data)      
    },
    getStudent(action, student) {
      this.toggleModal(action)
      this.activeStudent = student
    },
    updateStudent: async function (e) {
      const formData = new FormData(e.target)
      const data = await query('POST', formData, 'update')
      this.toggleModal('edit')
      this.setMessage(data)
    },
    deleteStudent: async function(e) {
      const formData = new FormData(e.target)
      const data = await query('POST', formData, 'delete')
      this.toggleModal('delete')
      this.setMessage(data)
    },
  }
})