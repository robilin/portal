function check() 
{      
    var inputLoanDurationPeriod = document.getElementById("inputLoanDurationPeriod");
    var loan_interest_period_value = document.getElementById("inputInterestPeriod").value;
    var loan_duration_period_value = "";

    if (loan_interest_period_value == "Day")
        loan_duration_period_value = "Days";
        
    else if (loan_interest_period_value == "Week")
        loan_duration_period_value = "Weeks";
        
    else if (loan_interest_period_value == "Month")
        loan_duration_period_value = "Months";
    
    else if (loan_interest_period_value == "Year")
        loan_duration_period_value = "Years";

    selectItemByValue(inputLoanDurationPeriod, loan_duration_period_value);
} 

function selectItemByValue(elmnt, value)
{
    for(var i=0; i < elmnt.options.length; i++)
    {
        if(elmnt.options[i].value == value)
            elmnt.selectedIndex = i;
    }
}
function setNumofRep() 
{
     var inputLoanDuration = document.getElementById("inputLoanDuration").value;
     var inputLoanDurationPeriod = document.getElementById("inputLoanDurationPeriod").value;
     var inputLoanPaymentSchemeId = document.getElementById("inputLoanPaymentSchemeId");
     var inputLoanPaymentSchemeIdText = inputLoanPaymentSchemeId.options[inputLoanPaymentSchemeId.selectedIndex].text;
     
     var inputLoanNumOfRepayments = document.getElementById("inputLoanNumOfRepayments");
     
     if (inputLoanDurationPeriod != "")
     {
	     var totalRepayments = 0;
	     var yearly = 0;
	     var monthly = 0;
	     var weekly = 0;
	     var daily = 0;
	    
	     if (inputLoanPaymentSchemeIdText == "Daily") 
	     {
	         yearly = 360;
	         monthly = 30;
	         weekly = 7;
	         daily = 1;
	     }  
	     if (inputLoanPaymentSchemeIdText == "Weekly") 
	     {
	         yearly = 52;
	         monthly = 4;
	         weekly = 1;
	     }  
	     if (inputLoanPaymentSchemeIdText == "Biweekly") 
	     {
	         yearly = 26;
	         monthly = 2;
	         biweekly = 1;
	     }  
	     if (inputLoanPaymentSchemeIdText == "Monthly") 
	     {
	         yearly = 12;
	         monthly = 1;
	     }
	     if (inputLoanPaymentSchemeIdText == "Bimonthly") 
	     {
	         yearly = 6;
	         monthly = 1/2;
	     }
	     if (inputLoanPaymentSchemeIdText == "Quarterly") 
	     {
	         yearly = 4;
	         monthly = 1/3;
	     }
	     if (inputLoanPaymentSchemeIdText == "Semi-Annual") 
	     {
	         yearly = 2;
	         monthly = 1/6;
	     }    
	     if (inputLoanPaymentSchemeIdText == "Yearly") 
	     {
	         yearly = 1;
	     } 
	     
	     if (inputLoanDurationPeriod == "Days") 
	     {
	        totalRepayments = inputLoanDuration * daily;
	     }
	     if (inputLoanDurationPeriod == "Weeks") 
	     {
	        totalRepayments = inputLoanDuration * weekly;
	     }
	     if (inputLoanDurationPeriod == "Months") 
	     {
	        totalRepayments = inputLoanDuration * monthly;
	     }
	     if (inputLoanDurationPeriod == "Years") 
	     {
	        totalRepayments = inputLoanDuration * yearly;
	     }
	     
	     if (inputLoanPaymentSchemeIdText == "Lump-Sum") 
	     	totalRepayments = 1;
	     	
	     if (totalRepayments > 0)
	        selectItemByValue(inputLoanNumOfRepayments, totalRepayments);
	     
	     if (inputLoanPaymentSchemeIdText != "")   
	     	$("#inputLoanNumOfRepaymentsChanged").html("<div class=\"form-control bg-red\">&larr; Updated!</div>");
	}
} 

function removeNumRepaymentsMessage()
{
    $("#inputLoanNumOfRepaymentsChanged").html("");
}    

function disableNumRepayments()
{
	var inputLoanNumOfRepayments = document.getElementById("inputLoanNumOfRepayments");
    var inputLoanPaymentSchemeId = document.getElementById("inputLoanPaymentSchemeId");
    var inputLoanPaymentSchemeIdText = inputLoanPaymentSchemeId.options[inputLoanPaymentSchemeId.selectedIndex].text;
    if  (inputLoanPaymentSchemeIdText == "Lump-Sum")
    {
        selectItemByValue(inputLoanNumOfRepayments, 1);
    }
}
function enableNumRepayments()
{
	$("#inputLoanNumOfRepayments").removeAttr("disabled");
}

function enableDisableFirstRepaymentAmount()
{
	var inputLoanInterestMethod = document.getElementById("inputLoanInterestMethod").value;
    var inputLoanPaymentSchemeId = document.getElementById("inputLoanPaymentSchemeId");

    if  (inputLoanInterestMethod == "flat_rate")
    {
        $("#inputFirstRepaymentAmount").prop('disabled', false);
    }
    else
    {
    	$("#inputFirstRepaymentAmount").prop('disabled', true);
  	}
  	
  	var inputLoanPaymentSchemeId = document.getElementById("inputLoanPaymentSchemeId");
    
    for (i = 0; i < inputLoanPaymentSchemeId.length; i++) {
        var repayment = inputLoanPaymentSchemeId.options[i].text;
        if  (((inputLoanInterestMethod != "flat_rate") && (inputLoanInterestMethod != "compound_interest")) && (repayment == "Lump-Sum"))
        {
            inputLoanPaymentSchemeId.options[i].disabled = true;
            inputLoanPaymentSchemeId.options[i].selected = false;
        }else
        {
            inputLoanPaymentSchemeId.options[i].disabled = false;
        }
    }
}