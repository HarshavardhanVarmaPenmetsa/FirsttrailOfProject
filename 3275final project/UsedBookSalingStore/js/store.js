// When the user clicks on <div>, open the popup

//overlay whole screen
const overlay = document.getElementById("usedBookStore-overlay");

//Seller navigation bar for edit seller profile of current seller
const popupSellerEditForm = document.getElementById("popupSellerEditForm");
//overlay elements for disable any action except edit profile form
const overlayNavigationbar = document.getElementById("usedBookStoreNavigationBar");

const overlayBookList = document.getElementById("bookList");

// buyer navigation bar for edit profile of current buyer
const popupBuyerEditForm = document.getElementById("popupBuyerEditForm");


const overlayBuyerListForSeller = document.getElementById(
  "buyerListForSeller"
);


//functions for Buyer as belows
$(document).ready(function () {
  $("#editBuyerProfileByBuyer").click(function () {
    
    document.getElementById("usedBookStore-overlay").classList.add("active");
    document.getElementById("popupBuyerEditForm").style.visibility = 'visible';
   
    document.getElementById("usedBookStoreNavigationBar").style.pointerEvents = "none";
    document.getElementById("bookList").style.pointerEvents = "none";
  });
});

$(document).ready(function () {
  $("#cancelEditBuyerProfileByBuyer").click(function () {
  
    document.getElementById("popupBuyerEditForm").style.visibility = 'hidden';
    document.getElementById("usedBookStore-overlay").classList.remove("active");
    document.getElementById("usedBookStoreNavigationBar").style.pointerEvents = "all"; 
    document.getElementById("bookList").style.pointerEvents = "all";
  });
});



//functions of Seller to edit profile as belows

$(document).ready(function () {
  $("#editSellerProfileBySeller").click(function () {
    document.getElementById("usedBookStore-overlay").classList.add("active");
    document.getElementById("popupSellerEditForm" ).style.visibility = "visible";
    document.getElementById("usedBookStoreNavigationBar").style.pointerEvents = "none"; 
    document.getElementById("bookList").style.pointerEvents = "none";
    
  });
});

$(document).ready(function () {
  $("#cancelEditSellerProfileBySeller").click(function () {

    document.getElementById("usedBookStore-overlay").classList.remove("active");
    document.getElementById("popupSellerEditForm" ).style.visibility = "hidden";
    document.getElementById("usedBookStoreNavigationBar").style.pointerEvents = "all"; 
    document.getElementById("bookList").style.pointerEvents = "all";
   
  });
});


