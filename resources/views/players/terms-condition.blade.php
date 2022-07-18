
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WPC</title>


    <!-- Styles -->

    <link href="{{ asset('css/min/backend.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body class="body-content">
    <div class="content">
      <div class="container-fluid">
            <main class="py-4">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card card-login">
                            <div class="card-header card__header">
                                <h4>Terms and Conditions</h4>
                                </div>

                            <div class="card-body">
                                <p style="text-align:center"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong><u><span style="font-size:14.0pt">TERMS AND CONDITIONS</span></u></strong></span></span></p>

                                <p>&nbsp;</p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">The following terms and conditions of use ("{{ strtoupper(request()->getHost()) }} Terms") shall apply to the Client's use and availment of the {{ strtoupper(request()->getHost()) }} Services offered by LUCKY 8 QUEST INC. By downloading and launching the {{ strtoupper(request()->getHost()) }} Application and/or using its services, the Client hereby agrees to be bound by these Terms and Conditions and our Privacy Policy. </span></span></p>

                                <p style="text-align:justify">&nbsp;</p>

                                <ol>
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>&nbsp;Definition of Terms</strong></span></span></li>
                                </ol>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">As used herein, unless otherwise specified:</span></span></p>

                                <ol>
                                    <li style="list-style-type:none">
                                    <ol style="list-style-type:upper-alpha">
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">"Account/s" shall mean any of the following: MASTER AGENT ACCOUNT, GOLD AGENT ACCOUNT, PLAYER ACCOUNT, and other types of accounts maintained at {{ strtoupper(request()->getHost()) }} owned by Client and which may be registered with {{ strtoupper(request()->getHost()) }} website;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">“Arena” shall mean the cockpit where the coverage is taking place;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">"Client" shall mean the owner of an Account or Account who is using the {{ strtoupper(request()->getHost()) }} Application.</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">"Lucky 8" shall mean LUCKY 8 STAR QUEST INC., its successors-in-interest and assigns.</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">“Mobile Device" shall mean any portable computer; such as but not limited to smartphones and tablet computers, used by the Client to access the {{ strtoupper(request()->getHost()) }} website;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">“On-Hold Account” shall mean an account that has been banned, blocked, closed, de-registered, or excluded from the site either at the instance of Lucky 8 or at the option of the client;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">“Player” shall mean the person who utilizes his own money to place wager/s at the online betting console;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">"Third Party Licensor(s)"s shall mean third parties engaged by {{ strtoupper(request()->getHost()) }} to grant license necessary for the {{ strtoupper(request()->getHost()) }} Application to be utilized or related to the provision of the {{ strtoupper(request()->getHost()) }} to the Client. Such grant of license (or licenses) shall be subject to Sections 2 and 7 below;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">" {{ strtoupper(request()->getHost()) }} Account/s" shall mean the Client's Account/s registered for use in the website/ application;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">" {{ strtoupper(request()->getHost()) }} Service" shall refer to services of {{ strtoupper(request()->getHost()) }}which allow a Client to perform any or all of the following:</span></span>
                                        <ul style="list-style-type:square">
                                            <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">send and receive funds from the {{ strtoupper(request()->getHost()) }} Account/s;</span></span></li>
                                            <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">send/ distribute/ collect points from the transaction or online transaction; and</span></span></li>
                                            <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">such other functionalities that may be designed for {{ strtoupper(request()->getHost()) }};</span></span></li>
                                        </ul>
                                        </li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">{{ strtoupper(request()->getHost()) }} shall refer to the application installed in the Mobile Device whereby the Client may access and/or use {{ strtoupper(request()->getHost()) }} via the Mobile Device.</span></span></li>
                                    </ol>
                                    </li>
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>Grant of License and Applicability of Terms and Conditions</strong></span></span></li>
                                </ol>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client acknowledges that Client is only granted a non-exclusive, non-sublicensable, non-transferable, personal, limited license to install and use the </span>{{ strtoupper(request()->getHost()) }}</span> <span style="font-size:12pt">Application only on a Mobile Device or Computer that he/she owns or controls, solely for his/her personal use and in accordance with the terms of this {{ strtoupper(request()->getHost()) }} Terms and Conditions.</span></p>

                                <ol start="3">
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>Participation</strong></span></span></li>
                                </ol>

                                <p style="margin-left:48px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Participation in the ONLINE BETTING is at the Client’s sole option, discretion, and risk. Client is solely responsible for ascertaining whether it is legal for him/her to participate in the ONLINE BETTING. Client may only participate in the ONLINE BETTING if he/she is at least twenty-one years of age. Lucky 8 does not warrant the legality of client’s participation in the ONLINE BETTING. Lucky 8 has the right to request for client to furnish it with proof of identity and age as a prerequisite for participation in the ONLINE BETTING and at any time throughout client’s participation in the ONLINE BETTING. Client agrees that Lucky 8 may use personal information collected in order to conduct appropriate anti-fraud checks. Personal information that you provide may be disclosed to a credit reference or fraud prevention agency. The agency may, at its discretion and according to its policies, keep appropriate records of such information.</span></span></p>

                                <ol start="4">
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>Warranties of Client</strong></span></span></li>
                                </ol>

                                <p style="margin-left:48px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Upon registration, Client warrants that he/she: a) is legally able to participate in the ONLINE BETTING platform; b) will furnish Lucky 8 with personal details which are valid, accurate, and complete in all aspects (any change in personal detail/s shall be sent to Lucky 8 via email); c) is the true and lawful owner of the virtual points and/or that he/she is duly authorized to utilize such virtual points; d) shall not deposit or wager any monies in the ONLINE BETTING which was derived from illegal activities; e) shall not charge-back, deny, reverse, and/or countermand any payment to Lucky 8; f) shall ensure that monies owed by client to the ONLINE BETTING are paid to Lucky 8, and any payment made to a third-party shall not constitute as a discharge thereof. Any breach hereof may result in Lucky 8’s refusal to credit any cash-in for points; g) has read and understood these Terms and Conditions. </span></span></p>

                                <p style="margin-left:48px; text-align:justify">&nbsp;</p>

                                <ol start="5">
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>General Rules Governing the Use of </strong></span><strong>{{ strtoupper(request()->getHost()) }} Application</strong></span></li>
                                </ol>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client hereby agrees to be bound by the following general rules governing the use of the {{ strtoupper(request()->getHost()) }} Application:</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">In order to use and/or avail of {{ strtoupper(request()->getHost()) }}, Client must register at the {{ strtoupper(request()->getHost()) }} website. Only Clients enrolled/ registered in {{ strtoupper(request()->getHost()) }} Application will be able to gain full access and usage of the same.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">All bets are assumed final by the customer. Minimum wager is 100 credits or points which is a direct equivalent of Php100.00. All winnings are subject to a house commission or "plazada" which automatically accounted by the console.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Betting can only be done through the Game/Betting Console. Betting done through the chat room or any other means besides the Game/Betting Console is VOID or INVALID.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Lucky 8 reserves the right to exclude players from participating in the betting without prior notice and/or reasons for the exclusion.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">If BETTING has been closed and bets have not been properly placed, fight will continue and a result will be declared and all players included in the winning side will be paid.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">If BETTING has been closed and bets are placed properly, fight will continue and the winning side will be declared.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">In the event of a "DRAW", bets are returned to the player's account and no house commission is deducted UNLESS you have placed your bet on DRAW, in which case, player will be paid x8 of original bet.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">BETTING is opened as soon as a cock/stag is already available in the ARENA and still WITHOUT any assigned SIDE. The player has the option to place a bet on his favored cock/stag at this point BUT if the sides have been assigned and are not the same with their original places, the fight will NOT BE CANCELLED.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">In the event that the sides (MERON or WALA) are switched/reversed with player's bets already matched, the fight will be declared CANCELLED and bets are credited back to their respective accounts. Non-placement of scores or incorrect scoring WILL NOT be a cause to cancel a fight.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">In the event of an entry withdrawal, [limping cock/stag (namimilay)], [cock/stag that refuses to fight (nangangayaw)] or disqualification from a fight, the match will be declared CANCELLED and all bets (matched and unmatched) shall be returned to the players’ accounts.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">In the event of a video buffer or video latency: If betting is closed before video buffer or video hang, the betting will resume and the result of the fight will be declared. If betting is open before video buffer or video hang, the betting will be canceled and the wagers will be returned and credited back to the player’s accounts. In the event that the betting is open and the cocks/stags have already engaged in battle, the betting will be canceled and the wagers will be credited back to the player’s accounts.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">The DECLARED WINNER by the SENTENSYADOR at the end of a match is FINAL; UNLESS the cockpit management requests for a review of the fight because of a protest on the actual declaration.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Only the cockpit management may request a review of the fight in question.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">If the cockpit management decides to change the initial declaration, we will honor the decision and make the necessary adjustments to the player’s credits.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">The fight review, and the change in the declaration, if there is any, must be done before the next fight resumes.</span></span> Otherwise, the initial declaration will be considered FINAL and IRREVOCABLE.</p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">The ODDS are FIXED and payouts are computed AUTOMATICALLY after the RESULT has been DECLARED. In case client needs clarification regarding the computation, he/she may contact customer support for help thru email.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">In the event a player's ACCOUNT is DISABLED for whatever reason, all credits are withdrawn and sent back to his nominated recipient.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Clients remain responsible for protecting the secrecy of their accounts and shall not allow third-parties to access or use their accounts. The Client accepts full responsibility for the consequences of allowing such activities. It is also prohibited to deal or transfer funds amongst customer accounts. In the event of obvious errors in drawing up client account balances, Lucky 8 has the right to make the necessary amendments. Claims regarding account statements and the balances in these statements may only be made within 5 (five) days of the betting event. Failure to claim shall be deemed an acceptance of the notified account balance.</span></span></p>

                                <p style="text-align:justify">&nbsp;</p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>Lost Mobile Device</strong></span></span></p>

                                <p style="margin-left:48px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">In the event Client loses his Mobile Device/SIM/ Computer, it is Client's sole responsibility to reset his password to avoid any unauthorized use of Client's Accounts. In the case that Client, cannot access their account due to the lost SIM, Client should inform the CSR for account blocking, which will be completed after proper customer identification. Client shall remain accountable for all the transactions made using his/ her account prior to resetting of password or reporting for account blocking, as the case may be.</span></span></p>

                                <p>&nbsp;</p>

                                <p><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>REFUSAL TO REGISTER, DEREGISTRATION, EXCLUSION &amp; SUSPENSION</strong></span></span></p>

                                <p>&nbsp;</p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Lucky 8 may refuse to register client as a Player or elect to unregister and exclude or suspend client as a Player from the website at any time if it is deemed that your participation on the website is, shall be, or has been previously, in any way not for personal entertainment [i.e. business], fraudulent, illegal or that your participation is or has been abusive, collusive or irregular in any way. Client acknowledges hereby that Lucky 8 is not obliged to give client prior notice of its decision to refuse, deregister, exclude or suspend, nor to furnish client with any reasons for such decision.</span></span></p>

                                <p style="text-align:justify">&nbsp;</p>

                                <p><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">If the event that Lucky 8 becomes aware that a player is under-age, it will, except where there are grounds to believe that a fraud has been perpetrated: </span></span></p>

                                <ol style="list-style-type:lower-alpha">
                                    <li><span style="font-size:12pt">Suspend the account immediately</span></li>
                                    <li><span style="font-size:12pt">Void all wagers that have taken place</span></li>
                                    <li><span style="font-size:12pt">Refund the value of all deposits net of withdrawals and </span></li>
                                    <li><span style="font-size:12pt">Close the account</span></li>
                                </ol>

                                <p>&nbsp;</p>

                                <p><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>Consequences of Deregistration, Exclusion, or Suspension</strong></span></span></p>

                                <p>&nbsp;</p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Once deregistered or excluded or suspended from the console Lucky 8 shall have the right to: withhold payment of any contested funds whether such contested funds are deposits, refunds, bonuses, payouts, or the like; and/or exclude client from all or any other sites of Lucky 8 and/or solely determine what criteria have to be met in order to establish a New Account at the Console; and/or in the case of fraudulent, illegal or similar misconduct or failure to pay any sum/s due to Lucky 8: Furnish any relevant information about the client to an intra-group database recording such mischief and, if necessary, hand over client account details to a collections agency for the recovery of any sums that you owe us. Client hereby irrevocably authorize Lucky 8 to do so in its absolute discretion, and/or have forfeited to Lucky 8 any contested funds that may be derived by client from fraudulent, illegal, or similar misconduct.</span></span></p>

                                <p style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>4. Disclaimer</strong></span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Lucky 8 Quest Inc., shall not incur liability in any of these cases:</span></span></p>

                                <ul>
                                    <li style="list-style-type:none">
                                    <ul>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Lucky 8 Quest is unable to receive or execute any of the requests from Client due to reasons beyond the control;</span></span></li>
                                    </ul>
                                    </li>
                                </ul>

                                <ol>
                                    <li style="list-style-type:none">
                                    <ol style="list-style-type:upper-alpha">
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">There is loss of information during processing or transmission or any unauthorized access by any other person or breach of confidentiality due to reasons beyond the control of Lucky 8 Quest;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">There is a loss of any kind, whether direct or indirect, incurred by Client or any other person due to any failure or lapse in the {{ strtoupper(request()->getHost()) }} Application;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Any loss, cost, or damages suffered by Client or any third person as a result of, or caused by any delay in transfer, non-transfer of funds and/or debiting and/or crediting of funds carried out by Lucky 8 Quest, and/or default on the part of Lucky 8 Quest in performing the {{ strtoupper(request()->getHost()) }} Application due wholly or in part, to defects, delays, malfunctions, interruptions, failures, or breach of security in its computer system, and/or causes beyond the control of Lucky 8 Quest;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">There is a lapse or failure on the part of the service providers or any third party supporting the {{ strtoupper(request()->getHost()) }} Application, which includes but not limited to Third Party Licensors. Lucky 8 Quest does not make any warranty as to the quality of the service provided by any provider in connection with the {{ strtoupper(request()->getHost()) }} Application;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">There is a failure, delay, interruption, suspension, restriction, or error in transmission of any information or message to and from the Mobile Device of Client and the network of any service provider and Lucky 8 Quest system;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">There is a breakdown, interruption, suspension, or failure of the Mobile Device of Client, Lucky 8 Quest system, or the network of any service provider and/or any third party who provides such services which causes a delay or failure to provide the {{ strtoupper(request()->getHost()) }} application;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">{{ strtoupper(request()->getHost()) }} Application is not compatible with / does not work on the Mobile Device or SIM of Client;</span></span></li>
                                        <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Claims that resulted from breach or failure of Client to perform any obligation and/or warranties covered by the Terms and Conditions and/or separate agreements with Third Party Licensors, regardless whether such breach or failure is done willfully or not or merely by negligence or lack of knowledge;</span></span></li>
                                        <li style="text-align:justify" value="9"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Any loss or damage whether direct, indirect, or consequential, including but not limited to loss of revenue, profit, business, contracts, anticipated savings, goodwill, or loss of use or value of any equipment including software, whether foreseeable or not, suffered by Client or any person from or relating to any delay, interruption, suspension, resolution, or error in receiving and processing the request and in formulating and returning responses.</span></span></li>
                                        <li style="text-align:justify" value="10"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">There is a loss or claim of any kind, including but not limited to loss of data or information arising from any unauthorized, unlawful, or fraudulent access to or use by any third party of the Mobile Device of Client, which includes hacking, or when the Mobile Device has been subjected to tampering or is non-compliant with the standards of the manufacturer, such as but not limited to cases of "jailbreaking", "rooting", "unlocking", use of outdated or unlicensed software systems, or other similar activities.</span></span></li>
                                    </ol>
                                    </li>
                                </ol>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>5. Indemnity</strong></span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client agrees to indemnify and hold Lucky 8 Quest Inc., its directors, officers, employees and assigns, free and harmless against all actions, claims, demands, proceedings, loss, damages, costs, charges, and expenses which Luck 8 Quest, Client, or any third party may at any time incur, sustain, suffer or be put to, as a consequence of or arising out of or in connection with the Client's use of the {{ strtoupper(request()->getHost()) }} Application.</span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client shall indemnify Lucky 8 Quest Inc., and hold it free and harmless against any and all claim, action, loss, damage, or liability arising from any unauthorized, unlawful, or fraudulent access to or use by any third party of the {{ strtoupper(request()->getHost()) }} Application; from breach of confidentiality or security of Client's User ID, password, Mobile Device, and SIM; from any unauthorized, unlawful or fraudulent transactions made via the {{ strtoupper(request()->getHost()) }} Application, and/or from any harmful or malicious third party application/s installed or downloaded, whether advertently or inadvertently, on Client's Mobile Device or Computer.</span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>6. Third Party Licensors</strong></span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client agrees and warrants the following:</span></span></p>

                                <ol style="list-style-type:lower-alpha">
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client understands that the grant of license to use the {{ strtoupper(request()->getHost()) }} Application under the Terms and Conditions may be revoked at any time at the discretion of Lucky 8 Quest Inc.</span></span></li>
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client will not decompile or reverse engineer the {{ strtoupper(request()->getHost()) }} Application. All rights not expressly granted to Client under these Terms and Conditions are specifically reserved by Lucky 8 Quest.</span></span></li>
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client agrees that the Terms and Conditions is an agreement between Client and Lucky 8 Quest. Third-Party Licensor is not a party to the Terms and Conditions and does not own and shall not be responsible for the Application, including but not limited to (i) any warranties and/or support obligations related to the {{ strtoupper(request()->getHost()) }} Application if any, and/or (ii) claim arising from the use thereof.</span></span></li>
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client</span></span>
                                    <ol>
                                        <li style="list-style-type:none">
                                        <ol style="list-style-type:lower-roman">
                                            <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">is not located in a country that is subject to a U.S. Government embargo, or that has been designated by the U.S. Government as a "terrorist supporting" country; and</span></span></li>
                                            <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">is not listed on any U.S. Government list of prohibited or restricted parties.</span></span></li>
                                        </ol>
                                        </li>
                                    </ol>
                                    </li>
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client agrees that Third Party Licensors are third party beneficiaries to this Terms and Conditions and that, upon Client's acceptance of said terms and conditions, any and all Third-Party Licensors will have the right to enforce this Terms and Conditions against Client as a third party beneficiary thereof.</span></span></li>
                                </ol>

                                <p style="margin-left:48px; text-align:justify">&nbsp;</p>

                                <ol start="6" style="list-style-type:lower-alpha">
                                    <li style="text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Client will protect all the trademarks and service marks of {{ strtoupper(request()->getHost()) }} and its Third Party Licensors associated with the use of {{ strtoupper(request()->getHost()) }} Application or its provision.</span></span></li>
                                </ol>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>7. Disputes of Unauthorized Transactions</strong></span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Transactions are authorized when validated by the CSR or Client has authenticated the same; this shall be sufficient evidence that any and all activity has been made and validated, and cannot be disputed by Client. The details in the notification/SMS/email confirmation message after every transaction and/or the entries in the Statement of Account are conclusively presumed true and correct unless Client notifies the CSR in writing or SMS message of any dispute thereon within thirty (30) days from the date of transaction. Disputed transactions shall only be credited back to Client's Account once the claim/dispute has been properly processed, investigated, and proven to be in favor of Client. </span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif"><strong>8. Other Provisions</strong></span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">LUCKY 8 STAR QUEST INC.&nbsp; Strictly prohibits the duplication, modification, distribution, and public exhibition of its video contents without its written authorization. Lucky 8 also reserves the right to amend or modify the WPC2026.LIVE Terms and Conditions at any time by posting on its website or sending the revised Terms and Conditions through email or text messages and the revised Terms and Conditions shall be effective at such time. The continued use by Client of the Application will constitute acceptance of the revised and/or modified Terms and Conditions.</span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">A valid government issued id will be required from clients who will cash-out their money as part of Lucky 8's validation and verification process, in compliance with appropriate Pagcor and BSP guidelines.</span></span></p>

                                <p style="margin-left:15px; text-align:justify"><span style="font-size:12pt"><span style="font-family:Calibri,sans-serif">Any inquiries or complaints relating to the use of the {{ strtoupper(request()->getHost()) }} Application, including those pertaining to intellectual property rights, must be directed to Customer Contact Center at the contact details indicated at <a href="/help">help page</a></span>.</span></p>

                                <p style="text-align:justify">&nbsp;</p>

                                <p style="text-align:justify">&nbsp;</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</body>
</html>

