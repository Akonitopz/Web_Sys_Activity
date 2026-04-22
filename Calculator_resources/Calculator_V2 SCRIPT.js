let num = 0; let finalNum = '';let tempNum = ''; let coef = 0; let choice = ''; let choice1 = 0; let temp_string = '';
let data = JSON.parse(localStorage.getItem('data')) || {
  num1: 0,
  num2: 0,
  answer: 0
};

document.body.addEventListener('keydown', (event)=>{
  if(event.key === '1'){
    input('1');
  }
  else if(event.key === '2'){
    input('2');
  }
  else if(event.key === '3'){
    input('3');
  }
  else if(event.key === '4'){
    input('4');
  }
  else if(event.key === '5'){
    input('5');
  }
  else if(event.key === '6'){
    input('6');
  }
  else if(event.key === '7'){
    input('7');
  }else if(event.key === '8'){
    input('8');
  }
  else if(event.key === '9'){
    input('9');
  }
  else if(event.key === '0'){
    input('0');
  }
  else if(event.key === '.'){
    input('.');
  }
  else if(event.key === '+'){
    operation('+');
  }
  else if(event.key === '-'){
    operation('-');
  }
  else if(event.key === '*'){
    operation('x');
  }
  else if(event.key === '/'){
    operation('/');
  }
  else if(event.key === 'Enter'){1
    calculation();
    equalsReset();
  }
  else if(event.key === 'Backspace'){
    backSpace();
  }
  else if(event.key === 'Delete'){
    reset();
  }
  }
)

function input(num){  
  finalNum = document.getElementById('inputBox')
    .value += deciToSci(num);
  tempNum = finalNum;
  temp_string = num;

    if(coef === 0){
      data.num1 = finalNum;
      console.log(data.num1);
    }
    else{
      data.num2 = data.num2 === ''? temp_string: data.num2 += temp_string;
    }
}

function operation(choice){
  document.getElementById('inputBox')
    .value = finalNum + choice;
  coef ++;
  choice1 = choice;
  data.num2 = '';
}

function calculation(){
  if(choice1 === '+'){
    data.answer = parseFloat(data.num1) + parseFloat(data.num2);
  }
  else if(choice1 === '-'){
    data.answer = parseFloat(data.num1) - parseFloat(data.num2);
  }
  else if(choice1 === 'x'){
    data.answer = parseFloat(data.num1) * parseFloat(data.num2);
  }
  else if (choice1 === '/' && parseFloat(data.num2) !== 0) {
    data.answer = parseFloat(data.num1) / parseFloat(data.num2);
  } 
  else if (choice1 === '/' && parseFloat(data.num2) === 0) {
  data.answer = 'Error: Indivisible';}
  choice1 = '';
  data.answer = deciToSci(data.answer);
  localStorage.setItem('data', JSON.stringify(data));
  document.getElementById('inputBox')
    .value = data.answer;
  data.num2 = ''; 
  tempNum = '';

}

function reset(){
  localStorage.removeItem('data');
  finalNum = document.getElementById('inputBox')
    .value = '';
  tempNum = '';
  data = {
    num1: 0,
    num2: 0,
    answer: 0
  };
  temp_string = '';
  choice = '';
  coef = 0;
  choice1 = '';
}

function deciToSci(num){
  let counter = 0;
  if(num >= 10000000 || num <= -10000000){
    while(Math.abs(num) >= 10){
      num /= 10;
      counter += 1;
    }
    return `${num.toFixed(2)}e${counter}`;
  }
  else{
  return num;}

}

function backSpace(){
  String(finalNum);
  document.getElementById('inputBox')
    .value = '';
  finalNum = finalNum.slice(0, -1);
  input(finalNum);
  choice = 0;
  data.num1 = finalNum;
  data.num2 = '';
}

function equalsReset(){
  data.num1 = data.answer;
  tempNum = data.answer;
  finalNum = data.answer;
  choice = ''; 
  choice1 = ''; 
  data.num2 = ''; 
  data.answer = 0;
}

function systemDebugger(){
    console.log(`Num1: ${data.num1}`);
    console.log(`Num2: ${data.num2}`);
    console.log(`answer: ${data.answer}`);
    console.log(`finalNum: ${finalNum}`);
    console.log(`choice: ${choice}`);
    console.log(`choice1: ${choice1}`);
    console.log(`tempNum: ${finalNum}`);
    console.log(`temp_string: ${temp_string}`);
}