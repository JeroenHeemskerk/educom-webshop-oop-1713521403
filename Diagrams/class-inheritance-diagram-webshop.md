```mermaid
---
title: Class Inheritance Diagram - Webshop
---
classDiagram
    note "+ = public, - = private, # = protected"
    %% A <|-- B means that class B inherits from class A %%
    HtmlDoc <|-- BasicDoc

    BasicDoc <|-- HomeDoc
    BasicDoc <|-- AboutDoc
    BasicDoc <|-- Error404Doc
    BasicDoc <|-- FormDoc
    BasicDoc <|-- ProductDoc

    FormDoc <|-- ContactDoc
    FormDoc <|-- LoginDoc
    FormDoc <|-- RegisterDoc
    FormDoc <|-- AccountDoc

    ProductDoc <|-- ShopDoc
    ProductDoc <|-- CartDoc
    ProductDoc <|-- DetailDoc
    ProductDoc <|-- Top5Doc
    

    class HtmlDoc{
        <<abstract>>
       +show()
       -showHtmlStart()
       -showHeadStart()
       #showHeadContent()
       -showHeadEnd()
       -showBodyStart()
       #showBodyContent()
       -showBodyEnd()
       -showHtmlEnd()
    }
    class BasicDoc{
        #data 
        +__construct(mydata)
        #showHeadContent()
        -showTitle()
        -showCssLinks()
        #showBodyContent()
        #showHead()
        -showMenu()
        -showGeneralError()
        #showContent()
        -showFooter()
    }
    class HomeDoc{
        #showHead()
        #showContent()
    }
    class AboutDoc{
        #showHead()
        #showContent()
    }
    class Error404Doc{
        #showHead()
        #showContent()
    }
    class FormDoc{
        <<abstract>>
        #showFormStart()
        #showFormField()
        #showFormEnd()
        #showError()
    }
    class ContactDoc{
        #showHead()
        #showContent()
    }
    class LoginDoc{
        #showHead()
        #showContent()
    }
    class RegisterDoc{
        #showHead()
        #showContent()
    }
    class AccountDoc {
        #showHead()
        #showContent()
    }
    class ProductDoc{
        <<abstract>>
        #showActionButton() 
    }
    class ShopDoc{
        #showHead()
        #showContent()
    }
    class DetailDoc{
        #showHead()
        #showContent()
    }
    class CartDoc{
        #showHead()
        #showContent()
    }
    class Top5Doc{
        #showHead()
        #showContent()
    }


```
