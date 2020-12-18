// console.log(a);

// var a = 5;

// function asdf() {
//     console.log(a);

//     var b = 6;
//     console.log(b);

//     if (true) {
//         let d = 8;
//     }

//     console.log(d);
// }

// console.log(b); // undefined

// console.log(c);

// let c = 7;
// const f = 9;
// // f = 10; // error

// const constObject = {
//     prop: 5
// };

// constObject.prop = 6;

// const frozenObject = Object.freeze({
//     prop: 1,
//     complexProp: {
//         prop: 2
//     },
//     arr: [1, 0, 3]
// });

// // frozenObject.prop = 5; //error
// frozenObject.complexProp.prop = 5;

// const constArray = [1];
// constArray.push(5);
// constArray.pop();
// constArray[0] = 3;

// for(var i = 0; i < 5; ++i) {
//     setTimeout(function() {
//         console.log(i);
//     }, 1000);
// }
// // 5 5 5 5 5

// for(let i = 0; i < 5; ++i) {
//     setTimeout(function() {
//         console.log(i);
//     }, 1000);
// }
// // 0 1 2 3 4

// const config = {
//     host: 'localhost',
//     port: 8080,
//     connect: function() { console.log('Connecting...'); }
// };

// config.host;

// const basketModule = (function() {
//     let basket = [];

//     return {
//         addItem: function(item) { basket.push(item); },
//         getItemCount: function() { return basket.length; },
//         getItems: function() { return basket; }
//     };
// })();

// basketModule.getItemCount();
// basketModule.addItem('banana');
// basketModule.getItems();