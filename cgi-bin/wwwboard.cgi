#!/usr/bin/perl
##############################################################################
# WWWBoard                      Version 2.0 ALPHA 2                          #
# Copyright 1996 Matt Wright    mattw@worldwidemart.com                      #
# Created 10/21/95              Last Modified 11/25/95                       #
# Scripts Archive at:           http://www.worldwidemart.com/scripts/        #
##############################################################################
# COPYRIGHT NOTICE                                                           #
# Copyright 1996 Matthew M. Wright  All Rights Reserved.                     #
#                                                                            #
# WWWBoard may be used and modified free of charge by anyone so long as      #
# this copyright notice and the comments above remain intact.  By using this #
# code you agree to indemnify Matthew M. Wright from any liability that      #  
# might arise from it's use.                                                 #  
#                                                                            #
# Selling the code for this program without prior written consent is         #
# expressly forbidden.  In other words, please ask first before you try and  #
# make money off of my program.                                              #
#                                                                            #
# Obtain permission before redistributing this software over the Internet or #
# in any other medium.  In all cases copyright and header must remain intact.#
##############################################################################
# Modidied 10/01/99 by Soeren Schmock    for   hostweb.de                    #
#                   http://www.soeck.de        http://www.hostweb.de         #
##############################################################################


###################################
#     Pfad fuer Eigenschaften 	  #
#				  #
#                                 #
# Design des WWWBOARD einstellen. #
###################################  
#  
#
# $font_face setzt Schriftart
# $font_face = "Arial"; setzt die Schriftart auf ARIAL fest.
$font_face = "Arial, Helvetica, sans-serif";
#
# $fontsize setzt die Schriftgroesse 
# $font_size = 2; setzt die Schriftgroesse auf 2
$font_size = 2;									 				
#
# $page_textcolor setzt die Textfarbe (hexadezimal)
# $page_textcolor = "#000000"; setzt die Textfarbe auf #000000 (=Schwarz)							
$page_textcolor = "#000000";							
#
# $page_textcolor_errorline setzt die Farbe fuer Faehlermeldungen (hexadezimal)
# $page_textcolor_errorline = "#CC0000"; setzt die Farbe fuer Faehlermelungen auf #CC0000 (=rot)						 
$page_textcolor_errorline = "#CC0000";						 
#
# $page_linlcolor setzt Linkfarbe (hexadezimal)
# $page_linkcolor = "#0000FF"; setzt die Linkfarbe auf #0000FF (=blau)  							 
$page_linkcolor = "#0000FF";							 
#
# $page_alinkcolor setzt aktive Linkfarbe (hexadezimal)
# $page_alinkcolor = "#006600"; setzt aktive Linkfarbe auf #006600 (=dunkelgrün)
$page_alinkcolor = "#006600";							 
#
# $page_vlinkcolor setzt besuchte Linkfarbe (hexadezimal)
# $page_vlinkcolor = "#000099"; setzt die Farbe eine besuchtenlinks auf #000099 (=dunkelblau)
$page_vlinkcolor = "#000099";							 
#
# $page_tabe_width setzt die Tabellenbreite in % 
# $page_table_width = "73%"; legt die Tabellenbreite auf 73% fest 							 
$page_table_width = "73%"; 							 
#
# $page_table_align legt die Textausrichtung fest
# $page_table_align = "center"; legt die Textausrichtung durch zentriert fest
$page_table_align = "center";							
#
# $page_bgcolor setzt die Hintergrundfarbe (hexadezimal)
# $page_bgcolor = "#FFFFFF"; legt die Hintergrundfarbe durch #FFFFFF auf weiss fest						
$page_bgcolor = "#FFFFFF";						
#
# $page_backgrpicture setzt ein Hintergundbild
# z.B. http://www.IHR-VERZEICHNIS.de/wwwboard/HINTERGRUNDBILD.jpg 
$page_backgrpicture = "";							 


#############################
#			    #
# Konfigurationsdatei laden #
#			    #
#############################

require 'konfiguration.dat';

#
# Erzeugen von $basedir (realer Pfad)
#
$basedir = '/home/';
$baseend = '/htdocs';
$boarddir = '/wwwboard';
$basedir = $basedir.$usercfg;
$basedir = $basedir.$baseend.$boarddir;
# $basedir = '/home/Ihr-Domain/htdocs/wwwboard';

#
# Erzeugen der $baseurl
#
$basehead = 'http://www.';
$baseurl = $basehead.$domaincfg.$boarddir;

 # $baseurl = 'http://www.go-linux.de/wwwboard';

#
# Erzeugen der $cgi_url
#
$cgi_name = "/wwwboard.cgi";
$cgi_dir = "/cgi-bin";
$cgi_url = $basehead.$domaincfg.$cgi_dir.$cgi_name;

 # $cgi_url = 'http://www.go-linux.de/cgi-bin/wwwboard.cgi';

$mesgdir = "messages";
$datafile = "data.txt";
$mesgfile = "index.html";
$faqfile = "faq.html";
$ext = "html";
$title = "Forum";

# TEST
#
# print "$basedir \n";
#print "$baseurl \n";
#print "$cgi_url \n";
#
#
#die;

# Done
###########################################################################

###########################################################################
# Configure Options

$show_faq = 0;		# 1 - YES; 0 = NO
$allow_html = 0;	# 1 = YES; 0 = NO
$quote_text = 1;	# 1 = YES; 0 = NO
$subject_line = 0;	# 0 = Quote Subject Editable; 1 = Quote Subject 
			#   UnEditable; 2 = Don't Quote Subject, Editable.
$use_time = 1;		# 1 = YES; 0 = NO

# Done
###########################################################################

# Get the Data Number
&get_number;

# Get Form Information
&parse_form;

# Put items into nice variables
&get_variables;

# Open the new file and write information to it.
&new_file;

# Open the Main WWWBoard File to add link
&main_page;

# Now Add Thread to Individual Pages
if ($num_followups >= 1) {
   &thread_pages;
}

# Return the user HTML
&return_html;

# Increment Number
&increment_num;

############################
# Get Data Number Subroutine

sub get_number {
   open(NUMBER,"$basedir/$datafile");
   $num = <NUMBER>;
   close(NUMBER);
   if ($num == 99999)  {
      $num = "1";
   }
   else {
      $num++;
   }
}

#######################
# Parse Form Subroutine

sub parse_form {

   # Get the input
   read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});

   # Split the name-value pairs
   @pairs = split(/&/, $buffer);

   foreach $pair (@pairs) {
      ($name, $value) = split(/=/, $pair);

      # Un-Webify plus signs and %-encoding
      $value =~ tr/+/ /;
      $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
      $value =~ s/<!--(.|\n)*-->//g;

      if ($allow_html != 1) {
         $value =~ s/<([^>]|\n)*>//g;
      }
      else {
         unless ($name eq 'body') {
	    $value =~ s/<([^>]|\n)*>//g;
         }
      }

      $FORM{$name} = $value;
   }

}

###############
# Get Variables

sub get_variables {

   if ($FORM{'followup'}) {
      $followup = "1";
      @followup_num = split(/,/,$FORM{'followup'});
      $num_followups = @followups = @followup_num;
      $last_message = pop(@followups);
      $origdate = "$FORM{'origdate'}";
      $origname = "$FORM{'origname'}";
      $origsubject = "$FORM{'origsubject'}";
   }
   else {
      $followup = "0";
   }

   if ($FORM{'name'}) {
      $name = "$FORM{'name'}";
      $name =~ s/"//g;
      $name =~ s/<//g;
      $name =~ s/>//g;
      $name =~ s/\&//g;
   }
   else {
      &error(no_name);
   }

   if ($FORM{'email'} =~ /.*\@.*\..*/) {
      $email = "$FORM{'email'}";
   }

   if ($FORM{'subject'}) {
      $subject = "$FORM{'subject'}";
      $subject =~ s/\&/\&amp\;/g;
      $subject =~ s/"/\&quot\;/g;
   }
   else {
      &error(no_subject);
   }

   if ($FORM{'url'} =~ /.*\:.*\..*/ && $FORM{'url_title'}) {
      $message_url = "$FORM{'url'}";
      $message_url_title = "$FORM{'url_title'}";
   }

   if ($FORM{'img'} =~ /.*tp:\/\/.*\..*/) {
      $message_img = "$FORM{'img'}";
   }

   if ($FORM{'body'}) {
      $body = "$FORM{'body'}";
      $body =~ s/\cM//g;
      $body =~ s/\n\n/<p>/g;
      $body =~ s/\n/<br>/g;

      $body =~ s/&lt;/</g; 
      $body =~ s/&gt;/>/g; 
      $body =~ s/&quot;/"/g;
   }
   else {
      &error(no_body);
   }

   if ($quote_text == 1) {
      $hidden_body = "$body";
      $hidden_body =~ s/</&lt;/g;
      $hidden_body =~ s/>/&gt;/g;
      $hidden_body =~ s/"/&quot;/g;
   }

   ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);

   if ($sec < 10) {
      $sec = "0$sec";
   }
   if ($min < 10) {
      $min = "0$min";
   }
   if ($hour < 10) {
      $hour = "0$hour";
   }
   if ($mon < 10) {
      $mon = "0$mon";
   }
   if ($mday < 10) {
      $mday = "0$mday";
   }

   $year += 1900;

   $month = ($mon + 1);

   @months = ("Januar","Februar","M&auml;rz","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");

   if ($use_time == 1) {
      $date = "$hour\:$min\ $mday\.$month\.$year";
   }
   else {
      $date = "$mday/.$month/.$year";
   }
   chop($date) if ($date =~ /\n$/);

   $long_date = "$months[$mon] $mday, $year um $hour\:$min";
}      

#####################
# New File Subroutine

sub new_file {

   open(NEWFILE,">$basedir/$mesgdir/$num\.$ext") || die $!;
   print NEWFILE "<html>\n";
   print NEWFILE "  <head>\n";
   print NEWFILE "    <title>$subject</title>\n";
   print NEWFILE "  </head>\n";

&file_body;

   print NEWFILE "    <center>\n";
   print NEWFILE "      <h1><font color=blue>$subject</font></h1>\n";
   print NEWFILE "    </center>\n";
   
   print NEWFILE "<hr size=1 width=75%>\n";
   if ($show_faq == 1) {
      print NEWFILE "<center>[ <a href=\"#followups\">Antworten </a> ] [ <a href=\"$baseurl/$mesgfile\">$title</a> ] [ <a href=\"$baseurl/$faqfile\">FAQ</a> ]</center>\n";
   }
   else {
      print NEWFILE "<center>[ <a href=\"#followups\">Antworten</a> ]  [ <a href=\"$baseurl/$mesgfile\">$title</a> ]</center>\n";
   }
   print NEWFILE "<hr size=1 width=75%><p>\n";

   print NEWFILE "Geschrieben von ";

   if ($email) {
      print NEWFILE "<a href=\"mailto:$email\">$name</a> on $long_date:<p>\n";
   }
   else {
      print NEWFILE "$name am $long_date:<p>\n";
   }

   if ($followup == 1) {
      print NEWFILE "Als Antwort auf  <a href=\"$last_message\.$ext\">$origsubject</a> geschrieben von ";

      if ($origemail) {
         print NEWFILE "<a href=\"$origemail\">$origname</a> on $origdate:<p>\n";
      }
      else {
         print NEWFILE "$origname on $origdate:<p>\n";
      }
   }

   if ($message_img) {
      print NEWFILE "<center><img src=\"$message_img\"></center><p>\n";
   }
   print NEWFILE "$body\n";
   print NEWFILE "<br>\n";
   if ($message_url) {
      print NEWFILE "<ul><li><a href=\"$message_url\">$message_url_title</a></ul>\n";
   }
   print NEWFILE "<br><hr size=1 width=75%><p>\n";
   print NEWFILE "<center><h1><a name=\"followups\">Antworten:</a></h1></center>\n";
   print NEWFILE "<ul><!--insert: $num-->\n";
   print NEWFILE "</ul><!--end:$num-->\n";
   print NEWFILE "<hr size=1 width=75%><p>\n";
   print NEWFILE "<a name=\"postfp\">Schreibe eine Antwort</a><p>\n";
   print NEWFILE "<form method=POST action=\"$cgi_url\">\n";
   print NEWFILE "<input type=hidden name=\"followup\" value=\"";
   if ($followup == 1) {
      foreach $followup_num (@followup_num) {
         print NEWFILE "$followup_num,";
      }
   }
   print NEWFILE "$num\">\n";
   print NEWFILE "<input type=hidden name=\"origname\" value=\"$name\">\n";
   if ($email) {
      print NEWFILE "<input type=hidden name=\"origemail\" value=\"$email\">\n";
   }
   print NEWFILE "<input type=hidden name=\"origsubject\" value=\"$subject\">\n";
   print NEWFILE "<input type=hidden name=\"origdate\" value=\"$long_date\">\n";
   print NEWFILE "Name: &nbsp;&nbsp;<input type=text name=\"name\" size=50><br>\n";
   print NEWFILE "E-Mail: &nbsp;<input type=text name=\"email\" size=50><p>\n";
   if ($subject_line == 1) {
      if ($subject_line =~ /^Re:/) {
         print NEWFILE "<input type=hidden name=\"subject\" value=\"$subject\">\n";
         print NEWFILE "Thema: &nbsp;<b>$subject</b><p>\n";
      }
      else {
         print NEWFILE "<input type=hidden name=\"subject\" value=\"Re: $subject\">\n";
         print NEWFILE "Thema: <b>Re: $subject</b><p>\n";
      }
   } 
   elsif ($subject_line == 2) {
      print NEWFILE "Thema: <input type=text name=\"subject\" size=50><p>\n";
   }
   else {
      if ($subject =~ /^Re:/) {
         print NEWFILE "Thema: <input type=text name=\"subject\"value=\"$subject\" size=50><p>\n";
      }
      else {
         print NEWFILE "Thema: <input type=text name=\"subject\" value=\"Re: $subject\" size=50><p>\n";
      }
   }
   print NEWFILE "Kommentar:<br>\n";
   print NEWFILE "<textarea name=\"body\" COLS=55 ROWS=15>\n";
   if ($quote_text == 1) {
      @chunks_of_body = split(/\&lt\;p\&gt\;/,$hidden_body);
      foreach $chunk_of_body (@chunks_of_body) {
         @lines_of_body = split(/\&lt\;br\&gt\;/,$chunk_of_body);
         foreach $line_of_body (@lines_of_body) {
            print NEWFILE ": $line_of_body\n";
         }
         print NEWFILE "\n";
      }
   }
   print NEWFILE "</textarea>\n";
   print NEWFILE "<p>\n";
   print NEWFILE "Optionale Link URL: &nbsp;&nbsp;<input type=text name=\"url\" size=50><br>\n";
   print NEWFILE "Link Titel: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=\"url_title\" size=50><br>\n";
   print NEWFILE "Optionale Image URL: <input type=text name=\"img\" size=50><p>\n";
   print NEWFILE "<input type=submit value=\"Antwort absenden\"> <input type=reset value=\"Antwort verwerfen\">\n";
   print NEWFILE "<p><hr size=1 width=75%>\n";
   if ($show_faq == 1) {
      print NEWFILE "<center>[ <a href=\"#followups\">Antworten</a> ] [ <a href=\"$baseurl/$mesgfile\">$title</a> ] [ <a href=\"$baseurl/$faqfile\">FAQ</a> ]</center>\n";
   }
   else {
      print NEWFILE "<center>[ <a href=\"#followups\">Antworten</a> ] [ <a href=\"$baseurl/$mesgfile\">$title</a> ]</center>\n";
   }
   print NEWFILE "</font></td></tr></table>\n";
   print NEWFILE "</body></html>\n";
   close(NEWFILE);
}

###############################
# Main WWWBoard Page Subroutine

sub main_page {
   open(MAIN,"$basedir/$mesgfile") || die $!;
   @main = <MAIN>;
   close(MAIN);

   open(MAIN,">$basedir/$mesgfile") || die $!;
   if ($followup == 0) {
      foreach $main_line (@main) {
         if ($main_line =~ /<!--begin-->/) {
            print MAIN "<!--begin-->\n";
	    print MAIN "<!--top: $num--><li><a href=\"$mesgdir/$num\.$ext\">$subject</a> - <b>$name</b> <i>$date</i>\n";
            print MAIN "(<!--responses: $num-->0)\n";
            print MAIN "<ul><!--insert: $num-->\n";
            print MAIN "</ul><!--end: $num-->\n";
         }
         else {
            print MAIN "$main_line";
         }
      }
   }
   else {
      foreach $main_line (@main) {
	 $work = 0;
         if ($main_line =~ /<ul><!--insert: $last_message-->/) {
            print MAIN "<ul><!--insert: $last_message-->\n";
            print MAIN "<!--top: $num--><li><a href=\"$mesgdir/$num\.$ext\">$subject</a> - <b>$name</b> <i>$date</i>\n";
            print MAIN "(<!--responses: $num-->0)\n";
            print MAIN "<ul><!--insert: $num-->\n";
            print MAIN "</ul><!--end: $num-->\n";
         }
         elsif ($main_line =~ /\(<!--responses: (.*)-->(.*)\)/) {
            $response_num = $1;
            $num_responses = $2;
            $num_responses++;
            foreach $followup_num (@followup_num) {
               if ($followup_num == $response_num) {
                  print MAIN "(<!--responses: $followup_num-->$num_responses)\n";
		  $work = 1;
               }
            }
            if ($work != 1) {
               print MAIN "$main_line";
            }
         }
         else {
            print MAIN "$main_line";
         }
      }
   }
   close(MAIN);
}

############################################
# Add Followup Threading to Individual Pages
sub thread_pages {

   foreach $followup_num (@followup_num) {
      open(FOLLOWUP,"$basedir/$mesgdir/$followup_num\.$ext");
      @followup_lines = <FOLLOWUP>;
      close(FOLLOWUP);

      open(FOLLOWUP,">$basedir/$mesgdir/$followup_num\.$ext");
      foreach $followup_line (@followup_lines) {
         $work = 0;
         if ($followup_line =~ /<ul><!--insert: $last_message-->/) {
	    print FOLLOWUP "<ul><!--insert: $last_message-->\n";
            print FOLLOWUP "<!--top: $num--><li><a href=\"$num\.$ext\">$subject</a> <b>$name</b> <i>$date</i>\n";
            print FOLLOWUP "(<!--responses: $num-->0)\n";
            print FOLLOWUP "<ul><!--insert: $num-->\n";
            print FOLLOWUP "</ul><!--end: $num-->\n";
         }
         elsif ($followup_line =~ /\(<!--responses: (.*)-->(.*)\)/) {
            $response_num = $1;
            $num_responses = $2;
            $num_responses++;
            foreach $followup_num (@followup_num) {
               if ($followup_num == $response_num) {
                  print FOLLOWUP "(<!--responses: $followup_num-->$num_responses)\n";
                  $work = 1;
               }
            }
            if ($work != 1) {
               print FOLLOWUP "$followup_line";
            }
         }
         else {
            print FOLLOWUP "$followup_line";
         }
      }
      close(FOLLOWUP);
   }
}

sub return_html {
   print "Content-type: text/html\n\n";
   print "<html><head><title>Diskussionsbeitrag hinzugef&uuml;gt: $subject</title></head>\n";

   &html_body;
   
   print "<center><h1>Diskussionsbeitrag hinzugef&uuml;gt: $subject</h1></center>\n";
   print "Dieser Diskussionsbeitrag wurde hinzugef&uuml;gt:<p><hr size=1 width=75%><p>\n";
   print "<b>Name:</b> $name<br>\n";
   print "<b>E-Mail:</b> $email<br>\n";
   print "<b>Thema:</b> $subject<br>\n";
   print "<b>Text des Diskussionsbeitrags:</b><p>\n";
   print "$body<p>\n";
   if ($message_url) {
      print "<b>Link:</b> <a href=\"$message_url\">$message_url_title</a><br>\n";
   }
   if ($message_img) {
      print "<b>Image:</b> <img src=\"$message_img\"><br>\n";
   }
   print "<b>Geschrieben um:</b> $date<p>\n";
   print "<hr size=1 width=75%>\n";
   print "<center>[ <a href=\"$baseurl/$mesgdir/$num\.$ext\">Gehe zu Deinem Beitrag</a> ] [ <a href=\"$baseurl/$mesgfile\">$title</a> ]</center>\n";
   print "</td></tr></table></body></html>\n";
   
}

sub increment_num {
   open(NUM,">$basedir/$datafile") || die $!;
   print NUM "$num";
   close(NUM);
}

sub error {
   $error = $_[0];

   print "Content-type: text/html\n\n";

   if ($error eq 'no_name') {
      print "<html><head><title>$title FEHLER: Kein Name</title></head>\n";
      print "<font face=\"$font_face\" size=\"$font_size\"><center><h1><font color=\"$page_textcolor_errorline\">FEHLER: Kein Name</font></h1></center>\n";
      print "<center>Sie haben vergessen das <font color=\"$page_textcolor_errorline\">'Name'</font> Feld auszuf&uuml;llen! Die notwendigen Felder sind: Name, Thema und Text!</center><p><hr size=1 width=75%><p>\n";
      &html_body;
      &rest_of_form;
      
   }
   
   elsif ($error eq 'no_subject') {
      print "<html><head><title>$title FEHLER: Kein Thema</title></head>\n";
      print "<font face=\"$font_face\" size=\"$font_size\"><center><h1><font color=\"$page_textcolor_errorline\">FEHLER: Kein Thema</font></h1></center>\n";
      print "<center>Sie haben vergessen das <font color=\"$page_textcolor_errorline\">'Thema'</font> Feld auszuf&uuml;llen! Die notwendigen Felder sind: Name, Thema und Text!</font></center><p><hr size=1 width=75%><p>\n";
      &html_body;
      &rest_of_form;
   }
   elsif ($error eq 'no_body') {
      print "<html><head><title>$title FEHLER: Kein Text</title></head>\n";
      print "<font face=\"$font_face\" size=\"$font_size\"><center><h1><font color=\"$page_textcolor_errorline\">FEHLER: Kein Text</font></h1></center>\n";
      print "<center>Sie haben vergessen das <font color=\"$page_textcolor_errorline\">'Text'</font> Feld auszuf&uuml;llen! Die notwendigen Felder sind: Name, Thema und Text!</font></center><p><hr size=1 width=75%><p>\n";
      &html_body;
      &rest_of_form;
      
   }
   else {
      print "OOPS da ging was schief. Aber was?\n";
   }
   exit;
}

sub rest_of_form {

   print "<form method=POST action=\"$cgi_url\">\n";

   if ($followup == 1) {
      print "<input type=hidden name=\"origsubject\" value=\"$FORM{'origsubject'}\">\n";
      print "<input type=hidden name=\"origname\" value=\"$FORM{'origname'}\">\n";
      print "<input type=hidden name=\"origemail\" value=\"$FORM{'origemail'}\">\n";
      print "<input type=hidden name=\"origdate\" value=\"$FORM{'origdate'}\">\n";
      print "<input type=hidden name=\"followup\" value=\"$FORM{'followup'}\">\n";
   }
   print "Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=\"name\" value=\"$FORM{'name'}\" size=50><br>\n";
   print "E-Mail: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=\"email\" value=\"$FORM{'email'}\" size=50><p>\n";
   if ($subject_line == 1) {
      print "<input type=hidden name=\"subject\" value=\"$FORM{'subject'}\">\n";
      print "Thema: <b>$FORM{'subject'}</b><p>\n";
   } 
   else {
      print "Thema: &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=\"subject\" value=\"$FORM{'subject'}\" size=50><p>\n";
   }
   print "Diskussionsbeitrag:<br>\n";
   print "<textarea COLS=55 ROWS=15 name=\"body\">\n";
   $FORM{'body'} =~ s/</&lt;/g;
   $FORM{'body'} =~ s/>/&gt;/g;
   $FORM{'body'} =~ s/"/&quot;/g;
   print "$FORM{'body'}\n";
   print "</textarea><p>\n";
   print "Optionale Link URL: &nbsp;&nbsp;<input type=text name=\"url\" value=\"$FORM{'url'}\" size=45><br>\n";
   print "Link Titel: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=\"url_title\" value=\"$FORM{'url_title'}\" size=45><br>\n";
   print "Optionale Bild URL: &nbsp;&nbsp;&nbsp;<input type=text name=\"img\" value=\"$FORM{'img'}\" size=45><p>\n";
   print "<input type=submit value=\"Beitrag absenden\">&nbsp <input type=reset value=\"Beitrag verwerfen\">\n";
   print "</form>\n";
   print "<br><hr size=1 width=75%>\n";
   if ($show_faq == 1) {
      print "<center>[ <a href=\"#followups\">Antworten</a> ] [ <a href=\"$baseurl/$mesgfile\">$title</a> ] [ <a href=\"$baseurl/$faqfile\">FAQ</a> ]</center>\n";
   }
   else {
      print "<center>[ <a href=\"#followups\">Antworten</a> ] [ <a href=\"$baseurl/$mesgfile\">$title</a> ]</center>\n";
   }
   print "</font></td></tr></table>\n";
   print "</body></html>\n";
}

sub html_body
{
      print "<body bgcolor=\"$page_bgcolor\" text=\"$page_textcolor\" link=\"$page_linkcolor\" vlink=\"$page_vlinkcolor\" alink=\"$page_alinkcolor\" background=\"$page_backgrpicture\">\n";
      print "<table width=\"$page_table_width\" border=\"0\" align=\"$page_table_align\"><tr><td>\n";
      print "<font face=\"$font_face\" size=\"$font_size\"> \n";
}

sub file_body
{
      print NEWFILE "<body bgcolor=\"$page_bgcolor\" text=\"$page_textcolor\" link=\"$page_linkcolor\" vlink=\"$page_vlinkcolor\" alink=\"$page_alinkcolor\" background=\"$page_backgrpicture\">\n";
      print NEWFILE "<table width=\"$page_table_width\" border=\"0\" align=\"$page_table_align\"><tr><td>\n";
      print NEWFILE "<font face=\"$font_face\" size=\"$font_size\"> \n";
}


