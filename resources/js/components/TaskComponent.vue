<template>
    <div class="container container-task">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group text-left">
                    <h2 class="text-center text-dark">Crear tareas</h2>
                    <label class="text-dark text-bold">Nombre:</label>
                    <input v-model="name" type="text" class="form-control">

                    <label class="text-dark">Descripción:</label>
                    <input v-model="description" type="text" class="form-control">

                    <label class="text-dark">Contenido:</label>
                    <input v-model="content" type="text" class="form-control">
                </div>
                <div class="container-buttons text-center">
                    <button v-if="update == 0" @click="saveTasks()" class="btn btn-success">Añadir</button>
                    <button v-if="update != 0" @click="updateTasks()" class="btn btn-warning">Actualizar</button>
                    <button v-if="update != 0" @click="clearFields()" class="btn btn-primary">Atrás</button>
                </div>
            </div>
            
            <div class="col-md-12 mt-3 text-center">
                <h2 class="text-dark">Lista de tareas</h2>
                <table class="table table-responsive text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Acciones</th>
                            <th scope="col">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="task in arrayTasks" :key="task.id">
                            <td v-text="task.name"></td>
                            <td v-text="task.description"></td>
                            <td v-text="task.content"></td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-warning" @click="loadFieldsUpdate(task.id)">Editar</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger" @click="deleteTask(task)">Borrar</button>
                                    </div>
                                </div>
                            </td>
                            <td v-if="task.status_id == 1">
                                <button type="button" class="btn-success span" data-toggle="modal" data-target=".bd-example-modal-sm" @click="taskId(task)">Activa</button>
                            </td>
                            <td v-if="task.status_id == 2">
                                <button type="button" class="btn-danger span" data-toggle="modal" data-target=".bd-example-modal-sm" @click="taskId(task)">Cancelada</button>
                            </td>
                            <td v-if="task.status_id == 3">
                                <button type="button" class="btn-info span" data-toggle="modal" data-target=".bd-example-modal-sm" @click="taskId(task)">Finalizada</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <modal-component 
                :status="arrayStatus"
                :task="task"
                @update="updateStatus">
            </modal-component>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                name:"",
                description:"",
                content:"",
                status_id:"",
                update:0,
                arrayTasks:[],
                arrayStatus:[],
                task:[]
            }
        },
        methods:{
            taskId(task) {
                this.task = task
            },
            updateStatus(id,task) {
                this.update = task.id
                this.name = task.name
                this.description = task.description
                this.content = task.content
                this.status_id = id
                this.updateTasks()
            },
            getStatus(){
                var me = this;
                var url = '/status'
                axios.get(url).then(function (response) {
                    me.arrayStatus = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getTasks(){
                var me = this;
                var url = '/tareas'
                axios.get(url).then(function (response) {
                    me.arrayTasks = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            saveTasks(){
                var me = this;
                var url = '/tareas'
                axios.post(url,{
                    'name':this.name,
                    'description':this.description,
                    'content':this.content,
                }).then(function (response) {
                    me.getTasks(); 
                    me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });   
                
            },
            updateTasks(){
                var me = this;
                axios.put('/tareas/'+this.update,{
                    'id':this.update,
                    'name':this.name,
                    'description':this.description,
                    'content':this.content,
                    'status_id':this.status_id
                }).then(function (response) {
                   me.getTasks();
                   me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ 
                this.update = data.id
                var me = this;
                var url = '/tareas/'+this.update;
                axios.get(url).then(function (response) {
                    me.name = response.data.name;
                    me.description = response.data.description;
                    me.content = response.data.content;
                    
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deleteTask(data){
                var me =this;
                var task_id = data.id
                if (confirm('¿Seguro que deseas borrar esta tarea?')) {
                    axios.delete('/tareas/'+task_id
                    ).then(function (response) {
                        me.getTasks();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){
                this.name = "";
                this.description = "";
                this.content = "";
                this.update = 0;
            }
        },
        created() {
            this.getStatus();
        },
        mounted() {
            this.getTasks();
        }
    }
</script>