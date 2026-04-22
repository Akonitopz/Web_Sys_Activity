let storedData;
try {
  storedData = JSON.parse(localStorage.getItem('todo'));
} catch (e) {
  console.error('Error parsing todo data from localStorage:', e);
  storedData = null;
}
const todo = Array.isArray(storedData) ? storedData : [];


renderArr();

function renderArr(){
  let inputHTML = '';
  for(let i = 0; i < todo.length; i++){
    let valpass = todo[i];
    let html = `
    <p>
    Task${i+1}: ${valpass.todo} ${valpass.date} 
    <button onclick=" 
      todo.splice(${i}, 1);
      renderArr();
    ">
    Delete
    </button>
    </p>
      `;
    inputHTML += html;
  }
  document.querySelector('.input-html')
  .innerHTML = inputHTML;
  localStorage.setItem('todo', JSON.stringify(todo));

}


function addData(){
  const inputElement = document.querySelector('.inputBox').value;
  const dueDate = document.querySelector('.dateBox').value;

  todo.push({
    todo: inputElement,
    date: dueDate
  }); 

  renderArr();
  document.querySelector('.inputBox').value = '';
  document.querySelector('.dateBox').value = '';
  
}
//debuggers
console.log('Type of todo:', typeof todo);
console.log('Is todo an array:', Array.isArray(todo));
console.log('Current value of todo:', todo);


