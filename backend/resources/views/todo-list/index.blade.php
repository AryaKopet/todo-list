<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" href="{{ asset('images/todo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div x-data="taskApp()" x-init="init()" class="container mt-5">
        <h1 class="text-center mb-4">Tulis kegiatanmu Disini</h1>
        <!-- Task Form -->
        <form @submit.prevent="addTask" class="task-form mb-4">
            <div class="input-group mb-2">
                <input x-model="newTask.title" type="text" placeholder="Nama Kegiatan" class="form-control" required>
                <input x-model="newTask.description" type="text" placeholder="Deskripsi" class="form-control">
                <select x-model="newTask.priority" class="form-select">
                    <option value="Low">Mudah</option>
                    <option value="Medium">Sedang</option>
                    <option value="High">Sulit</option>
                </select>
                <button type="submit" class="btn btn-primary">Tambah Tugas</button>
            </div>
        </form>
        <!-- Task List -->
        <ul class="list-group">
            <template x-for="task in tasks" :key="task.id">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span :class="{ 'text-decoration-line-through': task.completed }">
                        <strong x-text="task.title"></strong> - <span x-text="task.description"></span>
                    </span>
                    <div>
                        <button @click="completeTask(task.id)" class="btn btn-success btn-sm me-1">
                            <i class="fas fa-check-circle"></i>
                        </button>
                        <button @click="viewTask(task)" class="btn btn-info btn-sm me-1">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button @click="editTask(task)" class="btn btn-secondary btn-sm me-1">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button @click="confirmDelete(task)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </li>
            </template>
        </ul>

        <!-- Popup Modal untuk View/Edit Task -->
        <div x-show="isPopupOpen" class="popup" style="display: none;">
            <div class="popup-content">
                <h2 x-show="isEditMode" class="mb-3">Edit Task</h2>
                <h2 x-show="!isEditMode" class="mb-3">View Task</h2>
                
                <div>
                    <label for="taskTitle">Nama Kegiatan</label>
                    <input x-model="selectedTask.title" id="taskTitle" class="form-control" placeholder="Enter task title" :disabled="!isEditMode" />
                </div> <br>
                <div>
                    <label for="taskDescription">Deskripsi</label>
                    <textarea x-model="selectedTask.description" id="taskDescription" class="form-control" placeholder="Enter task description" :disabled="!isEditMode"></textarea>
                </div>
                <p> <br>
                    <strong>Tingkat Kesulitan:</strong>
                    <span x-text="selectedTask.priority"></span>
                </p>
                <div x-show="isEditMode">
                    <button @click="updateTask" class="btn btn-primary mt-3">Update Task</button>
                </div>
                <button @click="closePopup" class="btn btn-secondary mt-2">Close</button>
            </div>
        </div>

        <!-- Popup Modal untuk Konfirmasi Hapus -->
        <div x-show="isConfirmPopupOpen" class="popup">
            <div class="popup-content text-center">
                <h5>Apakah Anda yakin ingin menghapus "<span x-text="selectedTask.title"></span>" dari daftar?</h5>
                <div class="mt-3">
                    <button @click="deleteTask(selectedTask.id, selectedTask.title)" class="btn btn-danger me-2">Hapus</button>
                    <button @click="closeConfirmPopup" class="btn btn-cancel">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{'js/todo.js'}}"></script> <!-- Link ke file JavaScript -->
</body>
</html>
