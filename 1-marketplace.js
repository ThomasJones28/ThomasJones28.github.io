
function Cart(){
    this.itemGroups = [];
    
    this.addItemGroup = function(itemGroup) {
      this.itemGroups.push(itemGroup);
    };

    this.getTotalAmount = function() {
      let amount = 0;
      for (let i = 0; i < this.itemGroups.length; i++) {
       const g = this.itemGroups[i];
       amount += g.price * g.count;
      }
      return amount;
    };

    this.showTotalAmount = function(){
        if (this.itemGroups.length == 0){
            document.write("<p> You have 0 item, for a total amount of 0$, in your cart! </p>");
        } else  {
          const subtotal = this.getTotalAmount();
          const TAX_RATE = 0.15;
          const totalWithTax = subtotal * (1 + TAX_RATE);

          document.write(
            `<p>You have ${this.itemGroups.length} item group(s) in your cart.</p>` +
            `<p>Subtotal: $${subtotal.toFixed(2)}</p>` +
            `<p>Total with taxes: $${totalWithTax.toFixed(2)}</p>`
          );
        }
      };
    }
function ItemGroup(name, pricePerItem, count) {
  this.name  = name;
  this.price = Number(pricePerItem);
  this.count = Number(count);
}

document.write("<h2> 1) Creating the cart </h2>")
let my_cart = new Cart()
my_cart.showTotalAmount();
document.write("<h2> 2) Adding 15 pants at 10.05$ each to the cart! </h2>")
let pants = new ItemGroup("pants", 10.05, 15);
my_cart.addItemGroup(pants)
my_cart.showTotalAmount();
document.write("<h2> 3) Adding 1 coat at 99.99$ to the cart! </h2>")
let coat = new ItemGroup("coat", 99.99, 1);
my_cart.addItemGroup(coat)
my_cart.showTotalAmount();