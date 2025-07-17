<img src="https://github.com/heinrich-hernandez/emerkado/blob/main/app/icons/eMerkado.icon.png" width="280" height="314" alt="eMerkado">

## eMerkado

-----

### Get Started

Let's start with:
```shell
git clone https://github.com/heinrich-hernandez/emerkado.git
```

Make sure to both have node, php and composer installed.

Now let's go to our project directory:
```shell
cd .\emerkado\
```

And then install dependencies:
```shell
composer install
npm install
```

Now let's start debugging:
```shell
composer run dev
```

-----

### Task List

- [ ] User Login
    - [x] Admin Login
        - [x] Admin Dashboard
            - [x] Coop Page
            - [x] Merchant Page
            - [x] Buyer Page
    - [ ] Coop Login
        - [ ] Coop Dashboard
    - [ ] Merchant Login
        - [ ] Merchant Dashboard
    - [ ] Buyer Login
        - [ ] Buyer Dashboard

### FlowChart

```flow
log=>start: Login
proc=>operation: Login operation check
cond1=>condition: Is Admin Yes or No?
cond2=>condition: Is Coop Yes or No?
cond3=>condition: Is Merchant Yes or No?
cond4=>condition: Is Buyer Yes or No?
e1=>end: To admin
e2=>end: To coop
e3=>end: To merchant
e4=>end: To buyer

log->proc->cond1
cond1(yes)->e1
cond1(no)->proc->cond2
cond2(yes)->e2
cond2(no)->proc->cond3
cond3(yes)->e3
cond3(no)->proc->cond4
cond4(yes)->e4
cond4(no)->proc


```

###Sequence Diagram
                    
```seq
Admin->Coop->Merchant->Buyer
```