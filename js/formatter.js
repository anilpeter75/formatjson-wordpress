document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('json-input');
    const output = document.getElementById('json-output');
    const formatBtn = document.getElementById('format-json-btn');
    const clearBtn = document.getElementById('clear-json-btn');
    const status = document.getElementById('json-status');

    formatBtn.addEventListener('click', function() {
        const jsonText = input.value.trim();
        if (!jsonText) {
            status.textContent = 'Please enter JSON to format.';
            status.style.color = 'orange';
            output.value = '';
            return;
        }

        try {
            // Parse and stringify with 2-space indent
            const parsed = JSON.parse(jsonText);
            const formatted = JSON.stringify(parsed, null, 2);
            output.value = formatted;
            status.textContent = 'JSON formatted successfully!';
            status.style.color = 'green';
        } catch (error) {
            output.value = '';
            status.textContent = 'Invalid JSON: ' + error.message;
            status.style.color = 'red';
        }
    });

    clearBtn.addEventListener('click', function() {
        input.value = '';
        output.value = '';
        status.textContent = '';
    });

    // Optional: Auto-format on paste (Ctrl+V)
    input.addEventListener('paste', function() {
        setTimeout(function() {
            formatBtn.click();  // Trigger format after paste
        }, 100);
    });
});