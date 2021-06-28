# Clean Architecture


### Problem statement

Let’s implement the code for a supermarket checkout that calculates the total price of a number
of items.

An item has the following attributes:
1. SKU
2. Unit Price

Our goods are priced individually. Some items are multi priced: buy n of them, and they’ll cost
you less than buying them individually. For example, item ‘A’ might cost $50 individually, but this
week we have a special offer: buy three ‘A’s and they’ll cost you $130.

Here is an example of prices:
| SKU | Unit Price | Special Price |
|-----|------------|---------------|
| A   | 50         | 3 for 130     |
| B   | 30         | 2 for 45      |
| C   | 20         |               |
| D   | 15         |               |

Our checkout accepts items in any order, so that if we scan a B, an A, and another B, we’ll
recognize the two B’s and price them at 45 (for a total price so far of 95). Because the pricing
changes frequently, we need to be able to pass in a set of pricing rules each time we start
handling a checkout transaction.



### Solution flow:
<img src="https://i.imgur.com/IDrYkSV.png"/>
