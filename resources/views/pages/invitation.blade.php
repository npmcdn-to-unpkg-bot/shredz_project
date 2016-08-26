@extends('themes.default.layout')
@section('root-class') invite @stop
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.min.css">
@append
@section('content')
    <!--Full width table start-->
    <div class="invitation-page">
    <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top">
          <!--Template Body Start-->
          <table align="center" class="em_wrapper" style="table-layout:fixed;" width="600" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="em_hide" style="line-height:1px; font-size:1px;" width="600"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/spacer.gif" height="1"  width="600" style="max-height:1px; min-height:1px; display:block; width:600px; min-width:600px;" border="0" alt="" /></td>
            </tr>
            <tr>
              <td valign="top">
                <repeater>
                  <layout label="Join the Movement section">
                    <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10">&nbsp;</td>
                        <td valign="top">
                          <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="45" class="em_height">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" valign="top" class="em_font34" style="font-family: 'Lato', Arial, sans-serif; font-size:51px; line-height:54px; color:#000000; font-weight:300;">
                                <multiline class="em_font34" style="font-family: 'Lato', Arial, sans-serif; font-size:51px; line-height:54px; color:#000000; font-weight:300;"> Your <span style="color:#ff0000; font-weight:bold;">Invitation</span> To<br />
                                  Join The Movement
                                </multiline>
                              </td>
                            </tr>
                            <tr>
                              <td height="35" class="em_height">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" valign="top"><a href="https://itunes.apple.com/au/app/shredz-trainer/id1038433318?mt=8" target="_blank"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_appstore.png" width="261" height="78" editable="true" border="0" style="display:block; max-width:261px;" alt="Download on the App Store" /></a></td>
                            </tr>
                            <tr>
                              <td height="28" class="em_height">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" valign="top"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_1.png" width="350" height="397" border="0" class="full_img" editable="true" style="display:block; max-width:350px;" alt="SHREDZ TRAINER" /></td>
                            </tr>
                          </table>
                        </td>
                        <td width="10">&nbsp;</td>
                      </tr>
                    </table>
                  </layout>
                  <layout label="Arvin Lal section">
                    <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" valign="top" style="font-size:0px; line-height:0px;"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_line.jpg" width="600" class="full_img" height="4" border="0" style="display:block;" alt="" /></td>
                      </tr>
                      <tr>
                        <td background="http://edmimages.net/edm//2015_october/1444961356/img_bg.jpg" bgcolor="#ffffff" width="600" height="531" style="background-position:center top; background-repeat:no-repeat;" valign="top">
                          <!--[if gte mso 9]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:532px;">
                            <v:fill type="tile" src="http://edmimages.net/edm//2015_october/1444961356/img_bg.jpg" color="#ffffff" />
                            <v:textbox inset="0,0,0,0">
                              <![endif]-->
                              <table align="right" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="15" class="em_spacer">&nbsp;</td>
                                  <td valign="top">
                                    <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" >
                                      <tr>
                                        <td height="85" >&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="right"  valign="top" class="em_font25" style="font-family: 'Lato', Arial, sans-serif; font-size:34px; line-height:38px; color:#000000; font-weight:300;">
                                          <multiline class="em_font25" style="font-family: 'Lato', Arial, sans-serif; font-size:34px; line-height:38px; color:#000000; font-weight:300;"><span style="font-weight:bold;">Arvin Lal</span><br />
                                            SHREDZ CEO
                                          </multiline>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td height="12" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="middle" class="em_font9" style="font-family: 'Montserrat', Arial, sans-serif; font-size:12px; line-height:15px; font-weight:bold; text-transform:uppercase;">
                                          <singleline class="em_font9" style="font-family: 'Montserrat', Arial, sans-serif; font-size:12px; line-height:15px; font-weight:bold; text-transform:uppercase;"> Welcomes You To the team</singleline>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td height="15" style="font-size:1px; line-height:1px;" >&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="top"><a href="https://www.youtube.com/watch?v=1iDAMA20Tjg" target="_blank"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_Playvideo.png" width="194" editable="true" class="full_img2" height="58" border="0" style="display:block; max-width:194px;" alt="PLAY VIDEO" /></a></td>
                                      </tr>
                                      <tr>
                                        <td height="30" >&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="right" valign="top"><a href="https://itunes.apple.com/au/app/shredz-trainer/id1038433318?mt=8" target="_blank"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_appstore2.png" width="194" editable="true" class="full_img2" height="58" border="0" style="display:block; max-width:194px;" alt="Download on the App Store" /></a></td>
                                      </tr>
                                      <tr>
                                        <td height="72">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td height="109" >&nbsp;</td>
                                      </tr>
                                    </table>
                                  </td>
                                  <td width="57" class="em_spacer">&nbsp;</td>
                                </tr>
                              </table>
                              <!--[if gte mso 9]>
                            </v:textbox>
                          </v:rect>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </layout>
                  <layout label="download the app section">
                    <table bgcolor="#000000" align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top" style="background: #000">
                          <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10">&nbsp;</td>
                              <td valign="top">
                                <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="23">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top"><a href="https://itunes.apple.com/au/app/shredz-trainer/id1038433318?mt=8" target="_blank"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_logo.png" width="400" height="181" border="0" class="full_img" editable="true" style="display:block; max-width:400px;" alt="SHREDZ TRAINER" /></a></td>
                                  </tr>
                                  <tr>
                                    <td height="20" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top"><a href="https://itunes.apple.com/au/app/shredz-trainer/id1038433318?mt=8" target="_blank"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_btn.png" width="424" height="60" border="0" class="full_img" editable="true" style="display:block; max-width:424px;" alt="DOWNLOAD THE APP" /></a></td>
                                  </tr>
                                  <tr>
                                    <td height="15" style="font-size:1px; line-height:1px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td align="center" class="em_white" valign="top" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:19px; color:#ffffff;">
                                      <multiline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:19px; color:#ffffff;">You asked for a chance to <span style="font-weight:bold;">join the movement</span> - an opportunity to be on<br class="em_hide" />
                                        #TEAMSHREDZ - so we are giving you this special invitation to be the first<br class="em_hide" />
                                        participants in the <span style="color:#ff0007; font-weight:bold;">SHREDZ Master Trainer</span> Program.
                                      </multiline>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="30">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="top"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_8.jpg" width="382" height="74" border="0" style="display:block; max-width:382px;" editable="true" class="full_img" alt="NO REGISTRATION FEE EASY CLIENT MANAGMENT EARN MONEY ASAP" /></td>
                                  </tr>
                                  <tr>
                                    <td height="48">&nbsp;</td>
                                  </tr>
                                </table>
                              </td>
                              <td width="10">&nbsp;</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#ffffff" align="center" valign="top"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_9.jpg" width="600" height="73" border="0" class="full_img" style="display:block;" alt="" /></td>
                      </tr>
                    </table>
                  </layout>
                  <layout label="step section">
                    <table  align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10">&nbsp;</td>
                        <td valign="top">
                          <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="28" style="font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="top" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:15px; line-height:18px; font-weight:bold; text-transform:uppercase;">
                                <singleline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:15px; line-height:18px; font-weight:bold;">become a SHREDZ Master Trainer and</singleline>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" valign="top" class="em_font50" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:63px; line-height:66px; font-weight:200; color:#ff0000;">
                                <multiline class="em_font50" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:63px; line-height:66px; font-weight:300; color:#ff0000;">You Can Earn Over<br class="em_hide" />
                                  $70,000 Per Year
                                </multiline>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" valign="top"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_line2.jpg" width="468" height="3" border="0" style="display:block;" editable="true" class="full_img" alt="" /></td>
                            </tr>
                            <tr>
                              <td height="28">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="middle" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:36px; line-height:42px; font-weight:bold;">
                                <singleline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:36px; line-height:42px; font-weight:bold;">Step 1</singleline>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="middle" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:20px; line-height:26px; font-weight:300; font-style:italic;">
                                <singleline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:20px; line-height:26px; font-weight:300; font-style:italic;">DOWNLOAD THE APP</singleline>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="middle" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:21px;">
                                <multiline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:21px;">The app works on all iOS devices and is trending on iTunes. Search for “SHREDZ<br class="em_hide" />
                                  Trainer” in the App Store or click any of the Download buttons within this email!
                                </multiline>
                              </td>
                            </tr>
                            <tr>
                              <td height="17" style="font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="middle" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:36px; line-height:42px; font-weight:bold;">
                                <singleline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:36px; line-height:42px; font-weight:bold;">Step 2</singleline>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="middle" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:20px; line-height:26px; font-weight:300; font-style:italic;">
                                <singleline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:20px; line-height:26px; font-weight:300; font-style:italic;">BECOME SHREDZ CERTIFIED</singleline>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="middle" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:21px;">
                                <multiline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:21px;">Our app includes the brand new, FREE SHREDZ Certification Course to get you<br class="em_hide" />
approved in hours. If you’re already a certified trainer, we can fast track your approval!</multiline>
                              </td>
                            </tr>
                            <tr>
                              <td height="17" style="font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="middle" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:36px; line-height:42px; font-weight:bold;">
                                <singleline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:36px; line-height:42px; font-weight:bold;">Step 3</singleline>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="middle" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:20px; line-height:26px; font-weight:300; font-style:italic;">
                                <singleline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:20px; line-height:26px; font-weight:300; font-style:italic;">QUALIFY AS A MASTER TRAINER</singleline>
                              </td>
                            </tr>
                            <tr>
                              <td align="center" class="em_blk" valign="middle" style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:21px;">
                                <multiline style="font-family:'Helvetica Neue', Arial, sans-serif; font-size:13px; line-height:21px;">The elite trainers are called our SHREDZ Master Trainers. This group is eligible for the<br class="em_hide" />
 maximum payout on each and every client that becomes a supplement customer.</multiline>
                              </td>
                            </tr>
                            <tr>
                              <td height="5" style="font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" valign="top"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_6.jpg" width="252" height="338" border="0" style="display:block; max-width:252px;" editable="true" alt="SHREDZ app" /></td>
                            </tr>
                            <tr>
                              <td align="center" valign="top"><a href="https://itunes.apple.com/au/app/shredz-trainer/id1038433318?mt=8" target="_blank"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_btn2.png" width="470" height="68" border="0" editable="true" style="display:block;" class="full_img" alt="DOWNLOAD THE APP" /></a></td>
                            </tr>
                            <tr>
                              <td height="45">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center" valign="top"><img src="https://s3.amazonaws.com/shredzecamp/app_promo/images/img_logo2.png" width="216" height="70" border="0" editable="true" style="display:block; max-width:216px;" alt="SHREDZ" /></td>
                            </tr>
                          </table>
                        </td>
                        <td width="10">&nbsp;</td>
                      </tr>
                    </table>
                  </layout>
                </repeater>
              </td>
            </tr>
            <tr>
              <td valign="top"></td>
            </tr>
            <tr>
              <td height="40" class="em_height">&nbsp;</td>
            </tr>
          </table>
          <!--Template Body End-->
        </td>
      </tr>
    </table>

    </div>

@stop


