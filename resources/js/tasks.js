document.addEventListener('DOMContentLoaded', function () {
    function showJsMessage(message, type = 'error') {
        const container = document.getElementById('js-messages');
        container.innerHTML = `
            <div class="${type === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700'} px-4 py-3 rounded mb-4">
                ${message}
            </div>
        `;
    }

    // Funcion para validar los datos del formulario cuando creamos o editamos una tarea
    const form = document.getElementById('taskForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            const title = this.title.value.trim();

            if (title === '') {
                e.preventDefault();
                showJsMessage('El título es obligatorio');
                return;
            }

            if (title.length > 255) {
                e.preventDefault();
                showJsMessage('El título no puede superar 255 caracteres');
                return;
            }

            // Si todo OK, podrías limpiar mensajes
            document.getElementById('js-messages').innerHTML = '';
        });
    }

    // Ventana de confirmación a la hora de eliminar una tarea
    window.openDeleteModal = function(taskId) {
        const form = document.getElementById('delete-task-form');
        form.action = `/tasks/${taskId}`;
        document.getElementById('delete-modal').classList.remove('hidden');
        document.getElementById('delete-modal').classList.add('flex');
    }

    window.closeDeleteModal = function() {
        document.getElementById('delete-modal').classList.add('hidden');
        document.getElementById('delete-modal').classList.remove('flex');
    }

    // Funcion para actualizar el estado de la tarea desde el Dashboard
    function updateStatusTaskHandlers() {
        document.querySelectorAll('.mark-own-task, .mark-shared-task').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const taskId = this.dataset.id;
                const loading = document.getElementById('tasks-loading');
                const container = document.getElementById('tables-container');

                if (loading) {
                    loading.classList.remove('hidden');
                } 
                if (container) {
                    container.classList.add('opacity-50');
                } 

                fetch(`/tasks/${taskId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const params = window.location.search;
                        fetch(`/tasks${params}`, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        })
                        .then(res => res.text())
                        .then(html => {
                            if (container) {
                                container.innerHTML = html;
                                updateStatusTaskHandlers();
                            }
                            if (loading) {
                                loading.classList.add('hidden');
                            }   
                            if (container) {
                                container.classList.remove('opacity-50');
                            } 
                        });
                    } else {
                        showJsMessage('error', data.error || 'Error al actualizar');
                        this.checked = !this.checked;
                        if (loading) {
                            loading.classList.add('hidden');
                        } 
                        if (container) {
                            container.classList.remove('opacity-50');
                        } 
                    }
                })
                .catch(() => {
                    showJsMessage('error', 'Error en la petición');
                    this.checked = !this.checked;
                    if (loading) {
                        loading.classList.add('hidden');
                    }   
                    if (container) {
                        container.classList.remove('opacity-50');
                    } 
                });
            });
        });
    }

    // Llama al inicializar
    updateStatusTaskHandlers();
});
