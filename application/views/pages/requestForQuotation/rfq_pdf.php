<html>
<head>
<style>
    @page {
        size: auto;
        odd-header-name: MyHeader1;
        odd-footer-name: MyFooter1;
    }
    @page chapter2 {
        odd-footer-name: MyFooter2;
    }
    @page noheader {
        odd-header-name: _blank;
        odd-footer-name: _blank;
    }
    div.chapter2 {
        page-break-before: always;
        page: chapter2;
    }
    div.noheader {
        page-break-before: always;
        page: noheader;
    }
    p { 
        text-indent: 5em;
        text-align: justify;
        text-justify: inter-word;
        line-height:2em;
    }
</style>
    <link href="<?=base_url()?>assets/css/report/template_rfq.css" rel="stylesheet">
</head>
<body>
    <!--
    <pagefooter name="MyFooter2" content-left="{DATE j-m-Y}" content-right="{PAGENO}" footer-style="font-size: 8pt;" />
    <div class="chapter2"></div>
    
    <!-- content of pdf -->
    <br/><br/><br/><br/><br/>
    <div style="text-align:center;">
        <h2>REQUEST FOR QUOTATION (RFQ No. <?=$rfq['rfq']->case_id;?>)<br/>(Goods)</h2> 
    </div>
    <br/><br/>
    <table cellpadding="0" cellspacing="0" border="1" width="100%">
        <tr>
            <td valign="top" rowspan="2" style="text-align:left;" width="50%">To: INTERESTED BIDDER</td>
            <td style="text-align:left;" width="50%">DATE: <?=date('d F Y', strtotime($rfq['rfq']->delivery_date));?></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="text-align:left;"> REFERENCE: RFQ----------------- </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">Purchase of ------------------------------------- to The Putra Mulia Telecommunication under Long Term Agreements (LTA)</td>
                    </tr>
                </table>
            </td>
        </tr>    
    </table>
    <br/>
    <p>
        Dear Sir / Madam:  
        We kindly request you to submit your quotation for Long-Term Agreement for provision of --------------------------------- to The Harapan Utama Prima as detailed in Annex 1 of this RFQ. When preparing your quotation, please be guided by the form attached hereto as Annex 2. 
        <br/>
        Quotations may be submitted on or before ------------------------------------ at --------------------- local Jakarta time and via ☒e- mail: rangga.andika@pmt.co.id ☒    OR via courier mail to the address below: 
        <br/>
    </p>
        <div style="text-align:center;"> 
        <center><b><u>The Harapan Utama Prima (HUP)</u></b></center>
        <center>Patra Jasa Tower 18th Floor, Room 1811</center>
        <center>Jl. Jend. Gatot Subroto, Kav. 32-34</center> 
        <center>Kuningan, Kuningan Barat Kec. Mampang Prpt., Kota Jakarta Selatan,</center>  
        <center>Daerah Khusus Ibukota Jakarta 12950</center> 
        <br/><br/>
        <center><b><u>For clarifications please contact</u></b></center> 
        <center>Mr. Rangga Andika, <u><i style="font-color:blue;">rangga.andika@pmt.co.id<i></u></center> 
        <center>Procurement & Logistic Manager</center> 
        </div>
        <br/>
    <p>
        Quotations submitted by email must be limited to a maximum of 5MB, virus-free. Files larger than 5MB will not be delivered and therefore the quotation will not be considered. They must be free from any form of virus or corrupted contents, or the quotations shall be rejected. 
        <br/>
    </p>
    <p>
        It shall remain your responsibility to ensure that your quotation will reach the address above on or before the deadline. Quotations that are received by HUP after the deadline indicated above, for whatever reason, shall not be considered for evaluation. If you are submitting your quotation by email, kindly ensure that they are signed and in the .pdf format, and free from any virus or corrupted files. 
        <br/> 
    </p>
    <p>
        Please take note of the following requirements and conditions pertaining to the supply of the abovementioned good/s: [check the condition that applies to this RFQ, delete the entire row if condition is not applicable to the goods being procured] 
    </p>
    <pagebreak />
    <br/><br/><br/><br/>
    <table cellpadding="0" cellspacing="0" border="1" width="100%">
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Delivery Terms</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>DAP ('Delivered at Place') - the seller delivers when the goods are placed at the disposal of the buyer on the arriving means of transport ready for unloading at the named place of destination. </p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em;" width="30%" valign="top">Exact Address/es of Delivery Location/s (identify all, if multiple)</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>PT. Harapan Utama Prima (HUP) Office, Jl. Kalibata Utara II No 22. Duren Tiga, Kec. Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12760</p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Latest Expected Delivery Date and Time (if delivery time exceeds this, quote may be rejected by HUP)</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒2 working days (maximum) from the issuance of the Purchase Order (PO)</p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em;text-align: justify;" width="30%" valign="top">Delivery Schedule</td>
            <td style="text-align:left;" valign="top"><p>☒Required</p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em;text-align: justify;" width="30%" valign="top">Preferred Currency of Quotation</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒Local Currency: Indonesian Rupiah. IDR</p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em;text-align: justify;" width="30%" valign="top">Value Added Tax on Price Quotation</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒Must be inclusive of VAT</p></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="1" width="100%">
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">After-sales services required </td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>In case any product defects, such as damaged or wrong products, are discovered upon the fact of supply, the Supplier is to either replace the product within 3 working days or reimburse the losses. </p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Deadline for the Submission of Quotation</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>--------------------------------- at -------------Indonesia local time </p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">All documentations, including catalogs, instructions and operating manuals, shall be in this language</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒ English <br/>☒Bahasa Indonesia </p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Documents to be submitted</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒Copy of Value Added Tax Registration Code - if any (SPPKP- bila ada) <br/>☒Declaration Letter - for non-taxable enterprise only (Surat Deklarasi - khusus untuk perusahaan non PKP) <br/>☒Company Profile, which should not exceed ten (10) pages, including printed brochures and product catalogues relevant to the goods/services being procured</p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Partial Quotes </td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒ Not permitted</p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Payment Terms </td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒ 30 days upon receipt of invoice, <h3>NO ADVANCE PAYMENT</h3></p></td>
        </tr>
    </table>
    <pagebreak />
    <br/><br/><br/><br/>
    <table cellpadding="0" cellspacing="0" border="1" width="100%">
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Evaluation Criteria [check as many as applicable]</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒ Technical responsiveness/Full compliance to requirements and lowest price<br/>☒ Full acceptance of the PO/Contract General Terms and Conditions</p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">HUP will award to: </td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒ One or 2 Supplier, depending on the following factors: HUP shall establish multiple non-exclusive LTAs for each lot with primary and back-up suppliers. HUP reserves the right to award both lots to the same vendor (vendors), if it serves in the best interest of HUP.</p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Type of Contract to be Signed</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒ Long-Term Agreement* with issuing the Purchase Orders for each specific order throughout the contract implementation period 
            <br/><br/>
            <i style="font-size:6px;">* Minimum of six (6) months period and may be extended up to a maximum of one (1) year subject to satisfactory performance evaluation</i></p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Conditions for Release of Payment </td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒ Written Acceptance of Goods based on full compliance with RFQ requirements</p></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="1" width="100%">
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Annexes to this RFQ</td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>☒ Specifications of the Goods Required (Annex 1) <br/>☒ Form for Submission of Quotation (Annex 2) <br/>☒ Others Contract Model: Long Term Agreement (Annex 3) 
            <br/><br/>
            <b>Non-acceptance of the terms of the General Terms and Conditions (GTC) shall be grounds for disqualification from this procurement process.</b></p></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" width="30%" valign="top">Contact Person for Inquiries (Written inquiries only) </td>
            <td style="text-align:left; line-height:2em;" valign="top"><p>Rangga Andika <br/>
            Procurement & Logistic Manager<br/> 
            <i style="font-color:blue;">rangga.andika@pmt.co.id</i> 
            <br/><br/>
            Any delay in HUP’s response shall be not used as a reason for extending the deadline for submission, unless HUP determines that such an extension is necessary and communicates a new deadline to the Proposers. </p></td>
        </tr>
    </table>
    <pagebreak />
    <br/><br/><br/><br/>
    <p>
    Goods offered shall be reviewed based on completeness and compliance of the quotation with the minimum specifications described above and any other annexes providing details of HUP requirements. 
    </p>
    <p>
    The quotation that complies with all of the specifications, requirements and offers the lowest price, as well as all other evaluation criteria indicated, shall be selected. Any offer that does not meet the requirements shall be rejected. 
    </p>
    <p> 
    After HUP has identified the lowest price offer, HUP reserves the right to award the contract based only on the prices of the goods (including VAT and transportation cost). 
    </p>
    <p> 
    At any time during the validity of Contract or Purchase Order, no price variation due to escalation, inflation, and fluctuation in exchange rates, or any other market factors. 
    </p>
    <p> 
    Any Purchase Order that will be issued as a result of this RFQ shall be subject to the General Terms and Conditions attached hereto. The mere act of submission of a quotation implies that the vendor accepts without question the General Terms and Conditions of HUP herein attached as Annex 3. 
    </p>
    <p> 
    HUP is not bound to accept any quotation, nor award a contract/Purchase Order, nor be responsible for any costs associated with a Supplier’s preparation and submission of a quotation, regardless of the outcome or the manner of conducting the selection process. 
    </p>
    <p> 
    HUP encourages every prospective Vendor to avoid and prevent conflicts of interest, by disclosing to HUP if you, or any of your affiliates or personnel, were involved in the preparation of the requirements, design, specifications, cost estimates, and other information used in this RFQ. 
    </p>
    <p> 
    HUP implements a zero tolerance on fraud and other proscribed practices, and is committed to identifying and addressing all such acts and practices against HUP, as well as third parties involved in HUP activities.  
    </p>
    <p> 
    Thank you and we look forward to receiving your quotation. </p>
    <br/><br/><br/><br/><br/>
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td width="80%">&nbsp;</td>
            <td style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sincerely yours,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><img src="<?php echo base_url().'assets/images/tandatangan.png'; ?>"/></td>
        </tr>
    </table>
    <pagebreak />
    <br/><br/><br/><br/>
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                <table style="background-color: #F7F2F1">
                    <tr>
                        <td style="text-align:center; line-height:2em;" valign="top">General information for the Bidders</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" valign="top">
                <p>
                    HUP in Indonesia is looking for qualified company/ies to supply ---------------- products on recurrent basis for their office and operations to complement their daily work 
                </p>
                <p>
                    Based on the mid 2019 statistics (Jan-June 2019), around Rp. -------------was spent on purchase of ------------------------------------- by the HUP. 
                </p>
                <p>
                    HUP expects to award the contract and enter into a long-term agreement (LTA) with 1 or 2 suppliers as a result of this RFQ. 
                </p>
                <p>
                    The service standards to be provided must be of the highest order, and responses to specific criteria concerning service elements will be weighted heavily. 
                </p>
                <p>
                    HUP shall establish multiple non-exclusive LTAs for each lot with primary and back-up suppliers. HUP reserves the right to award both lots to the same vendor (vendors), if it serves in the best interest of HUP. 
                </p>
                <p>
                    LTAs shall be concluded for a period of 6 (six) months and may be extended for 1 (one) additional 1 (one)- year terms at the discretion of the procuring HUP entity subject to satisfactory performance by the Supplier/s. The Prices shall be maintained for the whole contract duration.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <table style="background-color: #F7F2F1">
                    <tr>
                        <td style="text-align:center; line-height:2em;" valign="top">Scope of Work</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" valign="top">
                <p>
                    The successful suppliers will be requested to provide the list of items on as-needed basis by the HUP office or projects as listed below in Technical Specifications. 
                </p>
                <p>
                    The successful supplier shall appoint a Team Leader responsible for the smooth running and execution of --------------orders placed by HUP. The supplier shall visit the HUP office as needed to deliver the orders. 
                </p>
                <p>
                    The successful Supplier is expected to deliver the items within 5 working days after Purchase Order placement. 
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <table style="background-color: #F7F2F1">
                    <tr>
                        <td style="text-align:center; line-height:2em;" valign="top">NOTE (IMPORTANT):</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" valign="top">
                <p>
                    Bidders shall clearly state which lots they are bidding for. Lots offered must be complete in order to be accepted for evaluation. A lot is considered complete if all items requested are offered. Incomplete Lots will not be considered. <b>Bidders are requested to offer a minimum of 1 (one) complete LOT in order for their bid to be considered.</b> 
                </p>
            </td>
        </tr>
    </table>
    <pagebreak />
    <br/><br/><br/><br/>
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td><h2>Annex 2</h2></td>
        </tr>
        <tr>
            <td style="text-align:center;">
                <h2 >
                FORM FOR SUBMITTING SUPPLIER’S QUOTATION</h2>
                <br/>
                (This Form must be submitted only using the Supplier’s Official Letterhead)
            </td>
        </tr>
        <tr>
            <td><b><hr/></b></td>
        </tr>
        <tr>
            <td style="text-align:left; line-height:2em; text-align: justify;" valign="top">
                <p>
                    We, the undersigned, hereby accept in full the HUP General Terms and Conditions, and hereby offer to supply the items listed below in conformity with the specification and requirements of HUP as per RFQ Reference No. ----------------------- (LTA) 
                </p>
                <p> 
                    TABLE 1: Offer to Supply Goods Compliant with Technical Specifications and Requirements
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="1" width="100%">
                    <tr>
                        <td style="background-color: #D8FCF0; text-align:center; line-height:2em;" colspan="5">LOT-1 --------------------------- </td>
                    </tr>
                    <tr>
                        <td style="text-align:center; line-height:2em;"><b>No</b></td>
                        <td style="text-align:center; line-height:2em;"><b>Description</b></td>
                        <td style="text-align:center; line-height:2em;"><b>Uom</b></td>
                        <td style="text-align:center; line-height:2em;"><b>Confirmation Spec (Y/N) if NO please specify</b></td>
                        <td style="text-align:center; line-height:2em;"><b>Unit Price per UoM</b></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="1" width="100%">
                    <tr>
                        <td style="background-color: #D8FCF0; text-align:center; line-height:2em;" colspan="5">LOT-2 --------------------------- </td>
                    </tr>
                    <tr>
                        <td style="text-align:center; line-height:2em;"><b>No</b></td>
                        <td style="text-align:center; line-height:2em;"><b>Description</b></td>
                        <td style="text-align:center; line-height:2em;"><b>Uom</b></td>
                        <td style="text-align:center; line-height:2em;"><b>Confirmation Spec (Y/N) if NO please specify</b></td>
                        <td style="text-align:center; line-height:2em;"><b>Unit Price per UoM</b></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <pagebreak />
    <br/><br/><br/><br/>
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td style="text-align:center;"><b><u>TABLE 3: Offer to Comply with Other Conditions and Related Requirements</u></b></td>    
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="1" width="100%">
                    <tr>
                        <td rowspan="2"><b>Other Information pertaining to our Quotation are as follows :</b></td>
                        <td stylë="text-align:center;" colspan="3" >Your Responses</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;line-height:2em;">Yes, we will comply </td>
                        <td style="text-align:center;line-height:2em;">No, we cannot comply </td>
                        <td style="text-align:center;line-height:2em;">comply No, we cannot comply If you cannot comply, pls. indicate counter proposal </td>
                    </tr>
                    <tr>
                        <td style="text-align:left; line-height:2em; text-align: justify;" width="40%" valign="top"><p>Delivery Lead Time-2 (two) working days upon issuance of PO </p></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:left; line-height:2em; text-align: justify;" width="40%" valign="top"><p>Payment Terms: 30 days upon receipt of invoice, NO ADVANCE PAYMENT </p></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:left; line-height:2em; text-align: justify;" width="40%" valign="top"><p>Warranty on all supplied goods will be brand new and their originality </p></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:left; line-height:2em; text-align: justify;" width="40%" valign="top"><p>All Provisions of the HUP General Terms and Conditions </p></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:left; line-height:2em; text-align: justify;" width="40%" valign="top">
                            <p>
                                Confirmation on the delivery all goods to  
                                <b>PT. Harapan Utama Prima (HUP) Office</b>, 
                                <br/><br/>
                                Jl. Kalibata Utara II No 22. Duren Tiga, Kec. Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12760 
                            </p>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
                <br/>
                <p>All other information that we have not provided automatically implies our full compliance with the requirements, terms and conditions of the RFQ.</p>
                <br/>
                <br/>
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr>
                        <td width="50%">&nbsp;</td>
                        <td style="text-align:left">[Name and Signature of the Supplier’s Authorized Person]</td>
                    </tr>
                    <tr>
                        <td width="50%">&nbsp;</td>
                        <td style="text-align:left">[Designation]</td>
                    </tr> 
                    <tr>
                        <td width="50%">&nbsp;</td>
                        <td style="text-align:left">[Date]</td>
                    </tr>                     
               </table>
            </td>
        </tr>
    </table>
    <pagebreak />
    <br/><br/><br/><br/>
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td><h2>Annex 3</h2></td>
        </tr>
        <tr>
            <td style="text-align:center;">
                <h2 >
                LONG TERM AGREEMENT</h2>
                <br/>
                <h2>FOR THE PROVISION OF ------------------------------</h2>
            </td>
        </tr>
        <tr>
            <td style="text-align:left;font-color:green;"><i>TO THE HARAPAN UTAMA PRIMA</i></td>
        </tr>
    </table>
<p>
This Long Term Agreement is made between The Harapan Utama Prima having its   headquarters at Patra Jasa Tower 18th Floor, Room 1811 Jl. Jend. Gatot Subroto, Kav. 32-34 Kuningan, Kuningan Barat Kec. Mampang Prpt., Kota Jakarta Selatan,  Daerah Khusus Ibukota Jakarta 12950 hereinafter “HUP”) and (hereinafter called  “Supplier”) with its headquarters    at _________________________________ 
</p>
 <p>
WHEREAS, HUP desires to enter into a Long Term Agreement for the provision of ----------------------- by the Supplier to HUP, pursuant to which HUP can conclude specific contractual arrangements with the Supplier, as provided herein; 
</p>
 <p>
WHEREAS pursuant to the Request for Quotation [RFQ--------------------------] the offer of the Supplier was accepted; 
</p>
 <p>
NOW, THEREFORE, HUP and the Supplier (hereinafter jointly the “Parties) hereby agree as follows: 
</p>
 <p>
Article 1:  SCOPE OF WORK 
</p>
 <p>
 1. The Supplier shall provide the ---------------------, which are listed in Annex 2 hereto as and when negotiated by HUP Officer and reflected, in the form attached hereto as Annex 2. 
</p>
 <p>
 
2. Such ----------------------------- shall be at the discount prices listed in Annex 3. The prices shall remain in effect at least for a period of 6 (six) months from Entry into Force of this Agreement. 
</p>
 <p>
 
3. HUP does not warrant that any quantity of --------------------- will be purchased during the term of this Agreement, which shall be for 6 (six) months (with possible extension of more one year). 
</p>
 <p>
 
Article 2: CHANGES IN CONDITION 
</p>
 <p>
 
4. In the event of any advantageous technical changes and/or downward pricing of the -------------------- during the duration of this Agreement, the Supplier shall notify HUP immediately. HUP shall consider the impact of any such event and may request an amendment to the Agreement. 
</p>
 <p>

 
Page9 
</p>
 <p>

Article 3:  SUPPLIER'S REPORTING 
 </p>
 <p>

 5. The Supplier will report semi-annually to HUP on the Goods provided to HUP. . 
</p>
 <p>
 
Article 4: ACCEPTANCE 
</p>
<pagebreak />
<br/><br/><br/><br/>
 <p>
 
6. This Agreement supersedes all prior oral or written agreements, if any, between the Parties and constitutes the entire agreement between the parties with respect to the provision of the ---------------hereunder. 
</p>
 <p>

 7. This Agreement shall enter into force on the date of the last signature by the representatives of the Parties and shall remain in force for a period of six months, and may be extended for [one additional] year by mutual agreement of the Parties. 
</p>
 <p>
 
 
IN WITNESS WHEREOF, the duly authorized representative of the PARTIES have signed this agreement. 
</p>
 <p>
 
For and on behalf of: 
 </p>
 <p>
THE HARAPAN UTAMA PRIMA    
</p>

</body>
</html>