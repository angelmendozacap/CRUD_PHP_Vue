<!DOCTYPE html>
<html lang="es-PE">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD con Vue.js, PHP y MySQL</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <main id="app" class="container center">
        <section class="row">
            <div class="col s12">
                <h2>CRUD con PHP y Vuejs</h2>
            </div>
        </section>
        <section class="row valign-wrapper">
            <div class="col s10">
                <h3 class="left">Lista de Estudiantes</h3>
            </div>
            <div class="col s2">
                <button class="btn-large btn-floating" @click="toggleModal('add')">
                    <i class="material-icons">add_circle</i>
                </button>
            </div>
        </section>
        <hr>
        <transition-group name="fade">
            <p :key="1" v-if="errorMessage" class="u-flexColumnCenter red accent-1 red-text text-darken-4">
                {{errorMessage}} <i class="material-icons prefix">error</i>
            </p>
            <p :key="2" v-if="successMessage" class="u-flexColumnCenter green accent-1 green-text text-darken-4">
                {{successMessage}} <i class="material-icons prefix">check_circle</i>
            </p>
        </transition-group>
        <transition name="fade">
            <table class="responsive-table striped">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Web</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
                <tr v-for="student in students" :key="student.id">
                    <td>{{student.id}}</td>
                    <td>{{student.name}}</td>
                    <td>
                        <a :href="`mailto:${student.email}`">{{student.email}}</a>
                    </td>
                    <td>
                        {{ student.web ? student.web : 'No registró su Web' }}
                    </td>
                    <td>
                        <button @click="getStudent('edit',student)" class="btn btn-floating">
                            <i class="material-icons">edit</i>
                            </span>
                        </button>
                    </td>
                    <td>
                        <button @click="getStudent('delete',student)" class="btn btn-floating">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            </table>
        </transition>
        <transition name="fade">
            <section :class="[ 'ModalWindow', displayAddModal ]" v-if="showAddModal">
                <div class="ModalWindow-container">
                    <header class="ModalWindow-heading">
                        <div class="row valign-wrapper">
                            <div class="col s10">
                                <h4 class="left">Agregar Estudiante</h4>
                            </div>
                            <div class="col s2">
                                <button @click="toggleModal('add')" class="btn btn-floating right">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                        </div>
                    </header>
                    <form @submit.prevent="createStudent" class="ModalWindow-content row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="name" type="text" placeholder="Nombre" required>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input name="email" type="text" placeholder="Correo" required>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">web</i>
                            <input name="web" type="text" placeholder="Web" required>
                        </div>
                        <div class="input-field col s12">
                            <button class="btn-large btn-floating right" type="submit">
                                <i class="material-icons">save</i>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </transition>
        <transition name="fade">
            <section :class="['ModalWindow', displayEditModal]" v-if="showEditModal">
                <div class="ModalWindow-container">
                    <header class="ModalWindow-heading">
                        <div class="row valign-wrapper">
                            <div class="col s10">
                                <h4 class="left">Editar Estudiante</h4>
                            </div>
                            <div class="col s2">
                                <button @click="toggleModal('edit')" class="btn btn-floating right">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                        </div>
                    </header>
                    <form class="ModalWindow-content row" @submit.prevent="updateStudent">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input v-model="activeStudent.name" name="name" type="text" placeholder="Nombre" required>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input v-model="activeStudent.email" name="email" type="text" placeholder="Correo" required>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">web</i>
                            <input v-model="activeStudent.web" name="web" type="text" placeholder="Web" required>
                        </div>
                        <div class="input-field col s12">
                            <button class="btn-large btn-floating right" type="submit">
                                <i class="material-icons">save</i>
                            </button>
                            <input v-model="activeStudent.id" name="id" type="hidden" required>
                        </div>
                    </form>
                </div>
            </section>
        </transition>
        <transition name="fade">
            <section :class="['ModalWindow', displayDeleteModal]" v-if="showDeleteModal">
                <div class="ModalWindow-container">
                    <header class="ModalWindow-heading">
                        <div class="row valign-wrapper">
                            <div class="col s10">
                                <h4 class="left">Eliminar Estudiante</h4>
                            </div>
                            <div class="col s2">
                                <button @click="toggleModal('delete')" class=" btn btn-floating right">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                        </div>
                    </header>
                    <form class="ModalWindow-content row" @submit.prevent="deleteStudent">
                        <div class="input-field col s12">
                            <p class="flow-text center">¿Estás seguro de eliminar al estudiante: <b>{{ activeStudent.name }}</b>.</p>
                            <input v-model="activeStudent.id" name="id" type="hidden" required>
                        </div>
                        <div class="input-field col s4 offset-s4">
                            <button class="btn-large btn-floating left" type="submit">
                                <i class="material-icons">check</i>
                            </button>
                            <button @click="toggleModal('delete')" class="btn-large btn-floating right" type="button">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </transition>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>