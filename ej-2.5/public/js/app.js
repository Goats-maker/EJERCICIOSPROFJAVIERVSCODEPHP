public/js/app.js`\n```.addEventListener('DOMContentLoaded', () => {
    
    // 1. Búsqueda en Vivo en el Listado de Apuntes
    const searchInput = document.getElementById('buscar-apuntes');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.apunte-card');
            let macthes = 0;

            cards.forEach(card => {
                const titulo = card.querySelector('.titulo').textContent.toLowerCase();
                const materia = card.querySelector('.materia-tag').textContent.toLowerCase();
                
                if (titulo.includes(term) || materia.includes(term)) {
                    card.style.display = 'flex';
                    macthes++;
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // 2. Contador Dinámico de Caracteres en el Textarea
    const textareaContenido = document.getElementById('contenido');
    const charCounter = document.getElementById('char-counter');
    if (textareaContenido && charCounter) {
        // Inicializar con el valor cargado si es edición
        charCounter.textContent = textareaContenido.value.length;

        textareaContenido.addEventListener('input', function() {
            const length = this.value.length;
            charCounter.textContent = length;
            
            // Efecto visual dinámico si pasa de los 1000 caracteres
            if (length > 1000) {
                charCounter.style.color = '#4F46E5';
                charCounter.style.fontWeight = 'bold';
            } else {
                charCounter.style.color = 'inherit';
                charCounter.style.fontWeight = 'normal';
            }
        });
    }

    // 3. Confirmación Elegante antes de Eliminar un Apunte
    const deleteForms = document.querySelectorAll('.form-eliminar');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const confirmacion = confirm('⚠️ ¿Estás completamente seguro de que deseas eliminar este apunte académico?\n\nEsta acción es irreversible y no se podrá recuperar.');
            if (confirmacion) {
                this.submit();
            }
        });
    });
});