const textArea = document.getElementById('description');
const charCounter = document.getElementById('char-counter');

textArea.addEventListener('input', function() {
    const charCount = textArea.value.length;
    charCounter.textContent = charCount + '/300';
});