$(function (){
//    $("#screendate").datepicker({maxDate:new Date});
    $('.datetimepicker').datetimepicker({maxDate:new Date});
});

$("#absencehrr").click(function(){
        $(".restabsence").each(function(){
            $(this).prop("checked",false);
        });
//        $(".restabsencerad").each(function(){
//            $(this).prop("checked",false);
//        });
         $(".resetnatal input[type='text']").val("");
});
$(document).ready(function(){
//    $("#patSubmit").click(function(){
        
        $("#patValidate").validate({
        rules: {
                    babyName: "required",
                    jelectHosp: {required:true},
                    birthdate: "required",
                    father: "required",
                    mother: "required",
                    contact_no: {
                       required: true,
                       number: true,
                       minlength: 10,
                       maxlength:10
                       
                    },

                    email: {
                        email: true
                    },
                    state:{
                        required: true
                    },
                    district: {required: true},
                    city: {required: true},
                    pre_address: {required: true},
                    per_address: {required: true},
                    screendate: {required: true},
                    
//                    screenin Page validate
                    subscribe:{required:true},
                    oae:{required:true}
                    
//                    password: {
//                        required: true,
//                        minlength: 5
//                    }



                },
                messages: {
                    babyName: "Baby name required",
                    jelectHosp: "Select Hospital",
                    birthdate: "Birthdate required",
                    father: "Father name required",
                    mother: "Mother name required",
//                    password: {
//                        required: "Please provide a password",
//                        minlength: "Your password must be at least 5 characters long"
//                    },

                    contact_no: {
                        required: "Contact no. required",
                        number : "Enter only no.",
                        minlength: "Enter valid mobile number",
                        maxlength: "Enter valid mobile number"
                        
                    },
                    
                    email:{
                        email: "Invalid email"
                    },
                    state:{
                        required: "Select state"
                    },
                    district:{required: "Select district"},
                    city:{required: "Select taluk"},
                    pre_address:{required: "Present address required"},
                    per_address:{required: "Permanent address required"},
                    screendate:{required: "Select screening date"},
                    subscribe: {required: "Specify your request"},
                    oae:{required: "1'st Screening not completed "}
                },
//                 highlight: function(a) {
//                    $(a).closest(".subscribeGroup").addClass("error");
//                  },
//                  unhighlight: function(a) {
//                    $(a).closest(".subscribeGroup").removeClass("error");
//                  },
//                  errorElement: "label",
//                  errorClass: "error",
//                  errorPlacement: function(error, element) {
//                    if (element.is(":radio")) {
//                      error.appendTo(element.parents('.subscribeGroup'));
////                      error.appendTo(element.parents('.oaeGroup'));
//                    } else { // This is the default behavior 
//                      error.insertAfter(element);
//                    }
//                  },
                  
                  
                
//                submitHandler: function(){
//                    alert("test");
////                    var hospid = $("#jelectHosp").val();
//                    var babyno = $("#baby_id_num").val();
////                    var pocdno = $("#pocd_no").val();
////                    var baby_name = $("#babyName").val();
////                    var birth_date = $("#birthdate").val();
////                    var babyage = $("#baby_age").val();
//                    
//                    alert(babyno);
//                }
            });
           $('#patSubmit').click(function() {
                
                var preAbs = $("input[name=subscribe]:checked").val();
//                var chkpresence = document.getElementById("pesenceid"); 
                var DvPre = document.getElementById("prenatalDiv");
                var DvNat = document.getElementById("natalDiv");
                var DvPost = document.getElementById("postnatalDiv");
                var DvOth = document.getElementById("otherDiv");
                if(preAbs == 2){
                    //alert("test");
                    DvPre.style.display = "none";
                    DvNat.style.display = "none";
                    DvPost.style.display = "none";
                    DvOth.style.display = "none";
                }
                $("#patValidate").valid();
                var hospid = $("#jelectHosp").val();
                var babyno = $("#baby_id_num").val();
                var pocdno = $("#pocd_no").val();
                var baby_name = $("#babyName").val();
                var birth_date = $("#birthdate").val();
                var babyage = $("#baby_age").val();
                //alert(babyage);
                var father = $("#father").val();
                var mother = $("#mother").val();
                var contact_no = $("#contact_no").val();
                var email_id = $("#email").val();
                var gender = $("input[name=gender]:checked").val();
                var state = $("#state").val();
                var district = $("#district").val();
                var city = $("#city").val();
                var preaddress = $("#pre_address").val();
                var peraddress = $("#per_address").val();
                var hosp_name = $("#hospname").val();
                var delivery_type = $("input[name=deltype]:checked").val();
                var region = $("input[name=region]:checked").val();
                var religion = $("input[name=religion]:checked").val();
                var caste = $("input[name=caste]:checked").val();
                var socioeco = $("input[name=socioeco]:checked").val();
                var staff_name = $("#staffname").val();
                var screen_date = $("#screendate").val();
                var med_history = $("#med_history").val();
                var pat_id = $("#pat_id").val();
                //alert(pat_id);

                $.ajax({
                    type: "POST",
                    url: Root + 'assets/ajax/submitPatientInfo.php',
                    data: {hospId: hospid, babynum: babyno, pocdnum: pocdno, babyName: baby_name, birthDate: birth_date, baby_age: babyage, babyfather: father, babymother: mother, contactNo: contact_no, emailId: email_id, babygender: gender, babystate: state, babydistrict: district, babycity: city, preAddress: preaddress, peraddress: peraddress, hospName: hosp_name, deliveryType: delivery_type, babyregion: region, babyreligion: religion, babycaste: caste, babysocioeco: socioeco, staffName: staff_name, screenDate: screen_date, medHistory: med_history, patient_id: pat_id},
                    cache: false,
                    success: function (data) {
                        if (data) {
                                $('#patUniqId').fadeOut('fast', function () {
                                    $('#patUniqId').fadeIn('fast').html(data);
                                });
                            }
                            

                    }

                });
            });
        
            
            $('#hrrSubmit').click(function() {
                $("#patValidate").valid();
                var patientID = $("#pat_id").val();
                var subscribe = $("input[name=subscribe]:checked").val();

                if(subscribe){
                //var ssubscribe = $("input[name=ssubscribe]:checked").val();
                var prenatalhrr = $("#prenatalhrr:checked").val();
                var natalhrr = $("#natalhrr:checked").val();
                var postnatal = $("#postnatalhrr:checked").val();
                var other = $("#otherhrr:checked").val();

                //        prenat
                var exvomit = $("#exvomit:checked").val();
                var eldpreg = $("#eldpreg:checked").val();
                var bp = $("#bp:checked").val();
                var bloodsugar = $("#bloodsugar:checked").val();
                var abortion = $("#abortion:checked").val();
                var rh = $("#rh:checked").val();
                var viralinfection = $("#viralinfection:checked").val();
                var otomedication = $("#otomedication:checked").val();
                var chemfume = $("#chemfume:checked").val();
                var alcohol = $("#alcohol:checked").val();
                var smoke = $("#smoke:checked").val();

            //        natal
                var weightless = $("#weightless:checked").val();
                var bwt = $("#birth_wt").val();
                //alert(bwt);
                var birth_wt = (weightless === 1)?bwt:"";
                var jaundice = $("#jaundice:checked").val();
                var bil_level = $("#bil_level").val();
                //alert(bil_level);
                var dbcrychk = $("#dbcrychk:checked").val();
                var dbcrysec = $("#birthCry").val();
                //alert(dbcrysec);
                var prematuredelchk = $("#pdwchk:checked").val();
                var prematuredel = $("#prematuredel").val();
                var birthasphyxia = $("#birthasphyxia:checked").val();
                var fetaldistress = $("#fetaldistress:checked").val();
                var aaf = $("#aafchk:checked").val();
                var nicuchk = $("#nicuchk:checked").val();
                var nicu = $("#nicu").val();
                //alert(nicu);
                var apgarone = $("#apgarone:checked").val();
                var apgarfive = $("#apgarfive:checked").val();

            //        post natal
                var craniofacial = $("#craniofacial:checked").val();
                var cogenital = $("#cogenital:checked").val();
                var degenerative = $("#degenerative:checked").val();
                var viralinfect = $("#viralinfect:checked").val();
                var convulsions = $("#convulsions:checked").val();
                var otitis = $("#otitis:checked").val();
                var trauma = $("#trauma:checked").val();

            //        Other
                var Consanguinity = $("input[name=pos1]:checked").val();
                var hrr1 = $("#hrr1:checked").val();
                var hrr2 = $("#hrr2:checked").val();
                var hrr3 = $("#hrr3:checked").val();

                var familyhistory = $("input[name=pos2]:checked").val();
                var maternal = $("#maternal:checked").val();
                var paternal = $("#paternal:checked").val();
                var hi = $("#hi:checked").val();
                var sp = $("#sp:checked").val();
                var lg = $("#lg:checked").val();
                var md = $("#md:checked").val();
                var othr = $("#othr:checked").val();
               
                var hrrId = $("#hrr_id").val();
                var prenatlId = $("#prenatal_idval").val();
                var natalIdval = $("#natal_idval").val();
                //alert("Natal Id:"+natalIdval);
                var postNatalId = $("#postNatal_id").val();
                var otherId = $("#other_idval").val();

                $.ajax({
                    type: "POST",
                    url: Root+'assets/ajax/submitHrrScreen.php',
                    data: {patient_ID: patientID, babysubscribe: subscribe, prenatalHrr: prenatalhrr, natalHrr: natalhrr, postNatal: postnatal, babyother: other, exVomit: exvomit, eldPreg: eldpreg, babybp: bp, bloodSugar: bloodsugar, babyabortion: abortion, babyrh: rh, viralInfection: viralinfection, otoMedication: otomedication, chemFume: chemfume, babyalcohol: alcohol, babysmoke: smoke, weightLess: weightless, birthWt : bwt, babyjaundice: jaundice, bilLevel: bil_level, birthcrychk: dbcrychk, babybirthcry: dbcrysec, pdeliverychck: prematuredelchk, prematureDelivery: prematuredel, birthAsphyxia: birthasphyxia, fetalDistress: fetaldistress, babyaaf: aaf, nicu_chk: nicuchk, babynicu: nicu, apgArone: apgarone, apgarFive: apgarfive, cranioFacial: craniofacial, coGenital: cogenital, deGenerative: degenerative, viralInfect: viralinfect, babyconvulsions: convulsions, babyotitis: otitis, babytrauma: trauma, babyConsanguinity: Consanguinity, babyhrr1: hrr1, babyhrr2: hrr2, babyhrr3: hrr3, familyHistory: familyhistory, babymaternal: maternal, babypaternal: paternal, babyhi: hi, babysp: sp, babylg: lg, babymd: md, othrBaby: othr, hrr_id: hrrId, prenatl_Id: prenatlId, natal_Id: natalIdval, postNatal_Id: postNatalId, other_Id: otherId},
                    cache: false,
                    success:function (data) {
                        //alert(data);
                        $('#hrrdet').fadeOut('fast', function () {
                                $('#hrrdet').fadeIn('fast').html(data);
                            });
                            showToast.show('Successfully submitted HRR detail',2000)
                       }
                       
                    });
                }
                else{
                    alert("select any required radio button");
                }
            });
            
            
//    });
});


//screen first

function hrrscreen(){
    var patientID = $("#pat_id").val();
    var subscribe = $("input[name=subscribe]:checked").val();
    //var ssubscribe = $("input[name=ssubscribe]:checked").val();
    var prenatalhrr = $("#prenatal_idval").val();
    var natalhrr = $("#natal_idval").val();
    var postnatal = $("#postNatal_id").val();
    var other = $("#other_idval").val();
    
    //        prenat
    var exvomit = $("#exvomit:checked").val();
    var eldpreg = $("#eldpreg:checked").val();
    var bp = $("#bp:checked").val();
    var bloodsugar = $("#bloodsugar:checked").val();
    var abortion = $("#abortion:checked").val();
    var rh = $("#rh:checked").val();
    var viralinfection = $("#viralinfection:checked").val();
    var otomedication = $("#otomedication:checked").val();
    var chemfume = $("#chemfume:checked").val();
    var alcohol = $("#alcohol:checked").val();
    var smoke = $("#smoke:checked").val();

//        natal
    var weightless = $("#weightless:checked").val();
    var bwt = $("#birth_wt").val();
    //alert(bwt);
    var birth_wt = (weightless === 1)?bwt:"";
    var jaundice = $("#jaundice:checked").val();
    var bil_level = $("#bil_level").val();
    //alert(bil_level);
    var dbcrychk = $("#dbcrychk:checked").val();
    var dbcrysec = $("#birthCry").val();
    //alert(dbcrysec);
    var prematuredelchk = $("#pdwchk:checked").val();
    var prematuredel = $("#prematuredel").val();
    var birthasphyxia = $("#birthasphyxia:checked").val();
    var fetaldistress = $("#fetaldistress:checked").val();
    var aaf = $("#aafchk:checked").val();
    var nicuchk = $("#nicuchk:checked").val();
    var nicu = $("#nicu").val();
    //alert(nicu);
    var apgarone = $("#apgarone:checked").val();
    var apgarfive = $("#apgarfive:checked").val();

//        post natal
    var craniofacial = $("#craniofacial:checked").val();
    var cogenital = $("#cogenital:checked").val();
    var degenerative = $("#degenerative:checked").val();
    var viralinfect = $("#viralinfect:checked").val();
    var convulsions = $("#convulsions:checked").val();
    var otitis = $("#otitis:checked").val();
    var trauma = $("#trauma:checked").val();

//        Other
    var Consanguinity = $("input[name=pos1]:checked").val();
    var hrr1 = $("#hrr1:checked").val();
    var hrr2 = $("#hrr2:checked").val();
    var hrr3 = $("#hrr3:checked").val();

    var familyhistory = $("input[name=pos2]:checked").val();
    var maternal = $("#maternal:checked").val();
    var paternal = $("#paternal:checked").val();
    var hi = $("#hi:checked").val();
    var sp = $("#sp:checked").val();
    var lg = $("#lg:checked").val();
    var md = $("#md:checked").val();
    var othr = $("#othr:checked").val();
    alert(othr);
    var hrrId = $("#hrr_id").val();
    var prenatlId = $("#prenatalhrr:checked").val();
    var natalId = $("#natalhrr:checked").val();
    //alert("Natal Id:"+natalIdval);
    var postNatalId = $("#postnatalhrr:checked").val();
    var otherId = $("#otherhrr:checked").val();
    
    $.ajax({
        type: "POST",
        url: Root+'assets/ajax/submitHrrScreen.php',
        data: {patient_ID: patientID, babysubscribe: subscribe, prenatalHrr: prenatalhrr, natalHrr: natalhrr, postNatal: postnatal, babyother: other, exVomit: exvomit, eldPreg: eldpreg, babybp: bp, bloodSugar: bloodsugar, babyabortion: abortion, babyrh: rh, viralInfection: viralinfection, otoMedication: otomedication, chemFume: chemfume, babyalcohol: alcohol, babysmoke: smoke, weightLess: weightless, birthWt : bwt, babyjaundice: jaundice, bilLevel: bil_level, birthcrychk: dbcrychk, babybirthcry: dbcrysec, pdeliverychck: prematuredelchk, prematureDelivery: prematuredel, birthAsphyxia: birthasphyxia, fetalDistress: fetaldistress, babyaaf: aaf, nicu_chk: nicuchk, babynicu: nicu, apgArone: apgarone, apgarFive: apgarfive, cranioFacial: craniofacial, coGenital: cogenital, deGenerative: degenerative, viralInfect: viralinfect, babyconvulsions: convulsions, babyotitis: otitis, babytrauma: trauma, babyConsanguinity: Consanguinity, babyhrr1: hrr1, babyhrr2: hrr2, babyhrr3: hrr3, familyHistory: familyhistory, babymaternal: maternal, babypaternal: paternal, babyhi: hi, babysp: sp, babylg: lg, babymd: md, othrBaby: othr, hrr_id: hrrId, prenatl_Id: prenatlId, natal_Id: natalId, postNatal_Id: postNatalId, other_Id: otherId},
        cache: false,
        success:function (data) {
            $('#hrrdet').fadeOut('fast', function () {
                //alert(data);
                    $('#hrrdet').fadeIn('fast').html(data);
                });
                showToast.show('Successfully submitted Screening Test',2000)
           }
           
        });
    

}


function submitScreeningTest(){
    var patientID = $("#pat_id").val();
                
//        OAE screening
// screen 1
        var subscribe = $("input[name=subscribe]:checked").val();
        var ssubscribe = $("input[name=ssubscribe]:checked").val();
        
        //var techk = $("#techk:checked").val();
        var oaechk = $("input[name=oae]:checked").val();
        var rtScreen1Chk = $("input[name=oaertear]:checked").val();
        var ltScreen1Chk = $("input[name=oaeltear]:checked").val();
        var rtScreen2Chk = $("input[name=oaertear2]:checked").val();
        var ltScreen2Chk = $("input[name=oaeltear2]:checked").val();
//        var oaertpass = $("#oaertpass:checked").val();
//        var oaeltpass = $("#oaeltpass:checked").val();
//        var oaertrefer = $("#oaertrefer:checked").val();
//        var oaeltrefer = $("#oaeltrefer:checked").val();
//        var oaertcnt = $("#oaertcnt:checked").val();
//        var oaeltcnt = $("#oaeltcnt:checked").val();
        //var oaenoisy = $("#oaenoisy:checked").val();
        var oaenotcorp = $("#oaenotcorp:checked").val();
//screen 2        
        //var oaechk2 = $("#oae2:checked").val();
        var oaechk2 = $("input[name=oae2]:checked").val();
//        var oaertpass2 = $("#oaertpass2:checked").val();
//        var oaeltpass2 = $("#oaeltpass2:checked").val();
//        var oaertrefer2 = $("#oaertrefer2:checked").val();
//        var oaeltrefer2 = $("#oaeltrefer2:checked").val();
//        var oaertcnt2 = $("#oaertcnt2:checked").val();
//        var oaeltcnt2 = $("#oaeltcnt2:checked").val();
        //var oaenoisy2 = $("#oaenoisy2:checked").val();
        var oaenotcorp2 = $("#oaenotcorp2:checked").val();
        
        //aabr
        var aabrchk = $("#aabrchk:checked").val();
        var aabrrtpass = $("#aabrrtpass:checked").val();
        var aabrltpass = $("#aabrltpass:checked").val();
        var aabrrtrefer = $("#aabrrtrefer:checked").val();
        var aabrltrefer = $("#aabrltrefer:checked").val();
        var aabrrtcnt = $("#aabrrtcnt:checked").val();
        var aabrltcnt = $("#aabrltcnt:checked").val();
        //var aabrnoisy = $("#aabrnoisy:checked").val();
        var aabrnotcorp = $("#aabrnotcorp:checked").val();
        
        //BOA
        var nbn500pass1 = $("#nbn500pass1:checked").val();
        var nbn500refer1 = $("#nbn500refer1:checked").val();
        var nbn500pass2 = $("#nbn500pass2:checked").val();
        var nbn500refer2 = $("#nbn500refer2:checked").val();
        var nbn4000pass1 = $("#nbn4000pass1:checked").val();
        var nbn4000refer1 = $("#nbn4000refer1:checked").val();
        var nbn4000pass2 = $("#nbn4000pass2:checked").val();
        var nbn4000refer2 = $("#nbn4000refer2:checked").val();
        var whitenoisypass1 = $("#whitenoisypass1:checked").val();
        var whitenoisyrefer1 = $("#whitenoisyrefer1:checked").val();
        var whitenoisypass2 = $("#whitenoisypass2:checked").val();
        var whitenoisyrefer2 = $("#whitenoisyrefer2:checked").val();
        
        //Acoustic analysis
        var acanalnormal = $("#acanalnormal:checked").val();
        var acanalabnormal = $("#acanalabnormal:checked").val();
        
        //aabr
        var moropresent = $("#moropresent:checked").val();
        var moroabsent = $("#moroabsent:checked").val();
        var rootingpresent = $("#rootingpresent:checked").val();
        var rootingabsent = $("#rootingabsent:checked").val();
        var suckpresent = $("#suckpresent:checked").val();
        var suckabsent = $("#suckabsent:checked").val();
        var tonicpresent = $("#tonicpresent:checked").val();
        var tonicabsent = $("#tonicabsent:checked").val();
        var palmarpresent = $("#palmarpresent:checked").val();
        var palmarabsent = $("#palmarabsent:checked").val();
        var plantarpresent = $("#plantarpresent:checked").val();
        var planterabsent = $("#planterabsent:checked").val();
        var babinskipresent = $("#babinskipresent:checked").val();
        var babinskiabsent = $("#babinskiabsent:checked").val();
        
        var screenOneId = $("#screen1_id").val();
        var screenTwoId = $("#screening2_id").val();
        var boaId = $("#boa_id").val();
        var primReflexId = $("#primReflex_id").val();
        var cryAnalId = $("#cryAnal_id").val();
        //alert(cryAnalId);
        var aabr_Id = $("#aabr_id").val();
        //alert(aabr_Id);
        //alert(aabr_Id);
        
        
        $.ajax({
            type: "POST",
            url: Root+'assets/ajax/submitScreening.php',
            data: {patient_Id: patientID, babysubscribe: subscribe, babyssubscribe: ssubscribe, oaeCheck: oaechk, oaeRtScreen1: rtScreen1Chk, oaeltScreen1: ltScreen1Chk, oaenotcorperation: oaenotcorp, oaecheck2: oaechk2, oaeRtScreen2: rtScreen2Chk, oaeLtScreen2: ltScreen2Chk, oaenotcorperation2: oaenotcorp2, aabrcheck: aabrchk, aabrrightpass: aabrrtpass, aabrleftpass: aabrltpass, aabrrightrefer: aabrrtrefer, aabrleftrefer: aabrltrefer, aabrrightcnt: aabrrtcnt, aabrleftcnt: aabrltcnt, aabrnotcorperation: aabrnotcorp, nbn500passone: nbn500pass1, nbn500referone: nbn500refer1, nbn500passtwo: nbn500pass2, nbn500refertwo: nbn500refer2, nbn4000passone: nbn4000pass1, nbn4000referone: nbn4000refer1, nbn4000passtwo: nbn4000pass2, nbn4000refertwo: nbn4000refer2, whitenoisypassone: whitenoisypass1, whitenoisyreferone: whitenoisyrefer1, whitenoisypasstwo: whitenoisypass2, whitenoisyrefertwo: whitenoisyrefer2, acanalNormal: acanalnormal, acanalabnormal: acanalabnormal, moroPresent: moropresent, moroAbsent: moroabsent, rootingPresent: rootingpresent, rootingAbsent: rootingabsent, suckPresent: suckpresent, suckAbsent: suckabsent, tonicPresent: tonicpresent, tonicAbsent: tonicabsent, palmarPresent: palmarpresent, palmarAbsent: palmarabsent, plantarPresent: plantarpresent, planterAbsent: planterabsent, babinskiPresent: babinskipresent, babinskiAbsent: babinskiabsent, screen1Id: screenOneId, screen2Id: screenTwoId, boa_id: boaId, primRef_id: primReflexId, cryAnal_id: cryAnalId, aabrScreen_id: aabr_Id},
            cache: false,
            success:function (data) {
                //alert(data);
//                $('#screeningtwo').fadeOut('fast', function () {
//                    $('#impresn').fadeOut('fast');
//                     $('#impresn').fadeIn('fast').html(data);
////                    $('#oaescreen').fadeIn('fast').html($('#inner1' , data).html());
////                    $('#impresn').html($('#inner2' , data).html());
//                 });
                $('#impresn').fadeOut('fast', function () {
                    $('#impresn').fadeIn('fast').html(data);
//                    $('#oaescreen').fadeIn('fast').html($('#inner1' , data).html());
//                    $('#impresn').html($('#inner2' , data).html());
                 });
                 showToast.show('Successfully submitted Screening Test',2000)
               }

            });
        }
        
      
      function saveRefer(patient){
          var patient_id = patient;
          var nbsChk = $('#nbsCheckedVal').val();
            $.ajax({
            type: "POST",
            url: Root+'assets/ajax/submitRefer.php',
            data: {patientId: patient_id, nbschkval: nbsChk},
            cache: false,
            success:function (data) {
               // alert(data);
                   alert("Screening Completed"); 
               }

            });
            
        }
        
        function patientRefer(patient){
            //alert("test");
        }
    function savenbschk(){
        //alert("test");
        //var nbschk = $("input[name=nbs]:checked").val();
        
        var centername = "nbs";
//        $(".nbschked:checked").each(function() {
//            nbslist.push(this.value);
//        });
        //var nbsHospList = nbslist;
        $('#nbsCheckedVal').val($(".nbschked:checked").val()+"-"+centername);

        
        
    }  
    function saveoscchk(){
        var centername = "osc";
        //alert(centername);
        
        $('#nbsCheckedVal').val($(".oscchecked:checked").val()+"-"+centername);

    }  
    function saveaiishchk(){
        var centername = "aiish";
        //alert(centername);
        
        $('#nbsCheckedVal').val($(".aiishchecked:checked").val()+"-"+centername);

    }  
    
    
    $('#pesencehrr').click(function(){
        $("#prenatalDv").toggle(this.checked);
   
    });
    
    function changeImpression(impSelectd,patient){
        var impSel = impSelectd.value;
        $.ajax({
            type: "POST",
            url: Root+'assets/ajax/updateImpresn.php',
            data: {patient_Id: patient, imprSel: impSel},
            cache: false,
            success:function (data) {
                
                $('.impSel').fadeOut('fast', function () {
                    $('.impSel').fadeIn('fast').html(data);

                 });
               }

            });
        
    }
    
  
    
    
//    $('.btn-save').click(function () {
//        var refermnth=$(this).closest('div').find('input').val();
//         var remark=$(this).closest('div').find('textarea').val();
//           $.ajax({
//            type: "POST",
//            URL:Root+'assets/ajax/submitPhonefup.php',
//            data: {month: refermnth, mnthRemark: remark},
//            cache: false,
//            success:function (data) {
//                   //alert(data); 
//                  
//               }
//
//            });
//        
//    });
    

    
        
        
        
        
        
    
    
    
    //function hrrscreen(pat){
//    alert("test");
//    alert(pat);
//    var patientID = pat;
//    
//    var subscribe = $("input[name=subscribe]:checked").val();
//    var ssubscribe = $("input[name=ssubscribe]:checked").val();
//    var prenatalhrr = $("#prenatalhrr:checked").val();
//    var natalhrr = $("#natalhrr:checked").val();
//    var postnatal = $("#postnatal:checked").val();
//    var other = $("#other:checked").val();
//    
//    //        prenat
//        var exvomit = $("#exvomit:checked").val();
//        var eldpreg = $("#eldpreg:checked").val();
//        var bp = $("#bp:checked").val();
//        var bloodsugar = $("#bloodsugar:checked").val();
//        var abortion = $("#abortion:checked").val();
//        var rh = $("#rh:checked").val();
//        var viralinfection = $("#viralinfection:checked").val();
//        var otomedication = $("#otomedication:checked").val();
//        var chemfume = $("#chemfume:checked").val();
//        var alcohol = $("#alcohol:checked").val();
//        var smoke = $("#smoke:checked").val();
//        
////        natal
//        var weightless = $("#weightless:checked").val();
//        var birth_wt = $("#birth_wt").val();
//        var jaundice = $("#jaundice:checked").val();
//        var bil_level = $("#bil_level").val();
//        var birthcry = $("#birthcry").val();
//        var prematuredel = $("#prematuredel").val();
//        var birthasphyxia = $("#birthasphyxia:checked").val();
//        var fetaldistress = $("#fetaldistress:checked").val();
//        var nicu = $("#nicu").val();
//        var apgarone = $("#apgarone:checked").val();
//        var apgarfive = $("#apgarfive:checked").val();
//
////        post natal
//        var craniofacial = $("#craniofacial:checked").val();
//        var cogenital = $("#cogenital:checked").val();
//        var degenerative = $("#degenerative:checked").val();
//        var viralinfect = $("#viralinfect:checked").val();
//        var convulsions = $("#convulsions:checked").val();
//        var otitis = $("#otitis:checked").val();
//        var trauma = $("#trauma:checked").val();
//        
////        Other
//        var Consanguinity = $("input[name=pos1]:checked").val();
//        var hrr1 = $("#hrr1:checked").val();
//        var hrr2 = $("#hrr2:checked").val();
//        var hrr3 = $("#hrr3:checked").val();
//        
//        var familyhistory = $("input[name=pos2]:checked").val();
//        var maternal = $("#maternal:checked").val();
//        var paternal = $("#paternal:checked").val();
//        var hi = $("#hi:checked").val();
//        var sp = $("#sp:checked").val();
//        var lg = $("#lg:checked").val();
//        var md = $("#md:checked").val();
//        var other = $("#other:checked").val();
//        
//        var prenatlId = $("#prenatal_id").val();
//        var natalId = $("#natal_id").val();
//        var postNatalId = $("#postNatal_id").val();
//        var otherId = $("#other_id").val();
//        
//        
//        $.ajax({
//            type: "POST",
//            url: Root+'assets/ajax/submitHrrScreen.php',
//            data: {patient_ID: patientID, babysubscribe: subscribe, babyssubscribe: ssubscribe, prenatalHrr: prenatalhrr, natalHrr: natalhrr, postNatal: postnatal, babyother: other, exVomit: exvomit, eldPreg: eldpreg, babybp: bp, bloodSugar: bloodsugar, babyabortion: abortion, babyrh: rh, viralInfection: viralinfection, otoMedication: otomedication, chemFume: chemfume, babyalcohol: alcohol, babysmoke: smoke, weightLess: weightless, birthWt : birth_wt, babyjaundice: jaundice, bilLevel: bil_level, babybirthcry: birthcry, prematureDelivery: prematuredel, birthAsphyxia: birthasphyxia, fetalDistress: fetaldistress, babynicu: nicu, apgArone: apgarone, apgarFive: apgarfive, cranioFacial: craniofacial, coGenital: cogenital, deGenerative: degenerative, viralInfect: viralinfect, babyconvulsions: convulsions, babyotitis: otitis, babytrauma: trauma, babyConsanguinity: Consanguinity, babyhrr1: hrr1, babyhrr2: hrr2, babyhrr3: hrr3, familyHistory: familyhistory, babymaternal: maternal, babypaternal: paternal, babyhi: hi, babysp: sp, babylg: lg, babymd: md, otherBaby: other, prenatl_Id: prenatlId, natal_Id: natalId, postNatal_Id: postNatalId, other_Id: otherId},
//            cache: false,
//            success:function (data) {
//                alert(data);
//                 $('#hrrdet').fadeOut('fast', function () {
//                        $('#hrrdet').fadeIn('fast').html(data);
//                    });
//               }
//
//            });
//}

    






//function hrrdetsubmit(pat){
//    alert("test1");
//    var patientID = pat;
//    var subscribe = $("input[name=subscribe]:checked").val();
//    var ssubscribe = $("input[name=ssubscribe]:checked").val();
//    var prenatalhrr = $("#prenatalhrr:checked").val();
//    var natalhrr = $("#natalhrr:checked").val();
//    var postnatal = $("#postnatal:checked").val();
//    var other = $("#other:checked").val();
//    //        prenat
//    var exvomit = $("#exvomit:checked").val();
//    var eldpreg = $("#eldpreg:checked").val();
//    var bp = $("#bp:checked").val();
//    var bloodsugar = $("#bloodsugar:checked").val();
//    var abortion = $("#abortion:checked").val();
//    var rh = $("#rh:checked").val();
//    var viralinfection = $("#viralinfection:checked").val();
//    var otomedication = $("#otomedication:checked").val();
//    var chemfume = $("#chemfume:checked").val();
//    var alcohol = $("#alcohol:checked").val();
//    var smoke = $("#smoke:checked").val();
//
////        natal
//    var weightless = $("#weightless:checked").val();
//    var birth_wt = $("#birth_wt").val();
//    var jaundice = $("#jaundice:checked").val();
//    var bil_level = $("#bil_level").val();
//    var birthcry = $("#birthcry").val();
//    var prematuredel = $("#prematuredel").val();
//    var birthasphyxia = $("#birthasphyxia:checked").val();
//    var fetaldistress = $("#fetaldistress:checked").val();
//    var nicu = $("#nicu").val();
//    var apgarone = $("#apgarone:checked").val();
//    var apgarfive = $("#apgarfive:checked").val();
//
////        post natal
//    var craniofacial = $("#craniofacial:checked").val();
//    var cogenital = $("#cogenital:checked").val();
//    var degenerative = $("#degenerative:checked").val();
//    var viralinfect = $("#viralinfect:checked").val();
//    var convulsions = $("#convulsions:checked").val();
//    var otitis = $("#otitis:checked").val();
//    var trauma = $("#trauma:checked").val();
//
////        Other
//    var Consanguinity = $("input[name=pos1]:checked").val();
//    var hrr1 = $("#hrr1:checked").val();
//    var hrr2 = $("#hrr2:checked").val();
//    var hrr3 = $("#hrr3:checked").val();
//
//    var familyhistory = $("input[name=pos2]:checked").val();
//    var maternal = $("#maternal:checked").val();
//    var paternal = $("#paternal:checked").val();
//    var hi = $("#hi:checked").val();
//    var sp = $("#sp:checked").val();
//    var lg = $("#lg:checked").val();
//    var md = $("#md:checked").val();
//    var other = $("#other:checked").val();
//    $.ajax({
//        type: "POST",
//        url: Root + 'assets/ajax/submitHrrDetInfo.php',
//        data: {patient_Id: patientID, babysubscribe: subscribe, babyssubscribe: ssubscribe, prenatalHrr: prenatalhrr, natalHrr: natalhrr, postNatal: postnatal, babyother: other, exVomit: exvomit, eldPreg: eldpreg, babybp: bp, bloodSugar: bloodsugar, babyabortion: abortion, babyrh: rh, viralInfection: viralinfection, infect: infection, otoMedication: otomedication, chemFume: chemfume, babyalcohol: alcohol, babysmoke: smoke, weightLess: weightless, birthWt : birth_wt, babyjaundice: jaundice, bilLevel: bil_level, babybirthcry: birthcry, prematureDelivery: prematuredel, birthAsphyxia: birthasphyxia, fetalDistress: fetaldistress, babynicu: nicu, apgArone: apgarone, apgarFive: apgarfive, cranioFacial: craniofacial, coGenital: cogenital, deGenerative: degenerative, viralInfect: viralinfect, babyconvulsions: convulsions, babyotitis: otitis, babytrauma: trauma, babyConsanguinity: Consanguinity, babyhrr1: hrr1, babyhrr2: hrr2, babyhrr3: hrr3, familyHistory: familyhistory, babymaternal: maternal, babypaternal: paternal, babyhi: hi, babysp: sp, babylg: lg, babymd: md, otherBaby: other},
//        cache: false,
//        success: function (data) {
//            if (data) {
//                    $('#hrrdet').fadeOut('fast', function () {
//                        $('#hrrdet').fadeIn('fast').html(data);
//                    });
//                }
//            
//        }
//
//    });
//    
//}

//screen 2


//submit Patient detail

////function submitPatientDetails(){
//    var hospid = $("#jelectHosp").val();
//    var babyno = $("#baby_id_num").val();
//    var pocdno = $("#pocd_no").val();
//    var baby_name = $("#babyName").val();
//    var birth_date = $("#birthdate").val();
//    var babyage = $("#baby_age").val();
//    //alert(babyage);
//    var father = $("#father").val();
//    var mother = $("#mother").val();
//    var contact_no = $("#contact_no").val();
//    var email_id = $("#email").val();
//    var gender = $("input[name=gender]:checked").val();
//    var state = $("#state").val();
//    var district = $("#district").val();
//    var city = $("#city").val();
//    var preaddress = $("#pre_address").val();
//    var peraddress = $("#per_address").val();
//    var hosp_name = $("#hospname").val();
//    var delivery_type = $("input[name=deltype]:checked").val();
//    var region = $("input[name=region]:checked").val();
//    var religion = $("input[name=religion]:checked").val();
//    var caste = $("input[name=caste]:checked").val();
//    var socioeco = $("input[name=socioeco]:checked").val();
//    var staff_name = $("#staffname").val();
//    var screen_date = $("#screendate").val();
//    var med_history = $("#med_history").val();
//    var pat_id = $("#pat_id").val();
//    //alert(pat_id);
//    
//    $.ajax({
//        type: "POST",
//        url: Root + 'assets/ajax/submitPatientInfo.php',
//        data: {hospId: hospid, babynum: babyno, pocdnum: pocdno, babyName: baby_name, birthDate: birth_date, baby_age: babyage, babyfather: father, babymother: mother, contactNo: contact_no, emailId: email_id, babygender: gender, babystate: state, babydistrict: district, babycity: city, preAddress: preaddress, peraddress: peraddress, hospName: hosp_name, deliveryType: delivery_type, babyregion: region, babyreligion: religion, babycaste: caste, babysocioeco: socioeco, staffName: staff_name, screenDate: screen_date, medHistory: med_history, patient_id: pat_id},
//        cache: false,
//        success: function (data) {
//            if (data) {
//                    $('#patUniqId').fadeOut('fast', function () {
//                        $('#patUniqId').fadeIn('fast').html(data);
//                    });
//                }
//            
//        }
//        
//    });
//    
//}    