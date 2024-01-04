#!/usr/bin/perl
##############################################################################
# WWWBoard Admin                Version 2.0 ALPHA 2                          #
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
#									     #
# Translate by Soeren Schmock          for      hostweb.de		     #
#              http://www.soeck.de              http://www.hostweb.de	     #
#									     #
##############################################################################


#############################
#			    #
# Konfigurationsdatei laden #
#			    #
#############################

require 'konfiguration.dat';

#
# Erzeugen der $basedir
#
$board_dir = "/wwwboard";
$basedir = "/home/";
$basedir2 = "/htdocs";
$basedir = $basedir.$usercfg.$basedir2.$board_dir;

# $basedir = "/home/Ihr-Domain.de/htdocs/wwwboard";

#
# Erzeugen der $baseurl
#
$http_head = "http://www.";
$baseurl = $http_head.$domaincfg.$board_dir;

# $baseurl = "http://www.Ihr-Domain.de/wwwboard";

#
# Erzeugen der $cgi_url
#
$pl_dir = "/wwwadmin.cgi";
$cgi_dir = "/cgi-bin";
$cgi_url = $http_head.$domaincfg.$cgi_dir.$pl_dir;
# $cgi_url = "http://www.Ihr-Domain.de/cgi-bin/wwwadmin.cgi";

$mesgdir = "messages";
$datafile = "data.txt";
$mesgfile = "index.html";
$passwd_file = "passwd.txt";

$ext = "html";

$title = "Forum";
$use_time = 1;		# 1 = YES; 0 = NO

# Done
###########################################################################

if ($ENV{'QUERY_STRING'} ne '') {
   $command = "$ENV{'QUERY_STRING'}";
}
else {
   &parse_form;
}

print "Content-type: text/html\n\n";

###########################################################################
# Remove                                                                  #
#       This option is useful to see how the threads appear in the        #
#   wwwboard.html document.  It can give you a better idea of whether or  #
#   not you want to remove the whole thread or just part of it.           #
###########################################################################

if ($command eq 'remove') {
   print "<html><head><title>Beitr&auml;ge vom WWWBoard l&ouml;schen</title></head>\n";
   print "<body><center><h1>Beitr&auml;ge vom WWWBoard l&ouml;schen</h1>\n";
   print "<table width=80%><tr><td>\n";
   print "<center>Bitte markieren Sie den zu l&ouml;schenden Beitrag.</center><br>\n";
   print "Markieren Sie das linke Kontrollfeld (Diskussion), so wird die ganze Diskussion mit Beitrag und Antwort gelöscht.\n";
   print "Markieren Sie das rechte Kontrollfeld (Beitrag), so werden nur die Antworten gelöscht.\n";
   print "Die Beitr&auml;ge sind nicht sortiert! Sie sehen die Beitr&auml;ge in der eingegangenen Reihenfolge.\n";
   print "Dies spiegelt die Eintragungen in Ihrem Diskussionsforum wieder und ist oftmals hilfreicher\n";
   print "als eine andere Art der Sortierung.\n";
   print "</td></tr></table></center>\n";
   print "<hr size=1 width=75%><center><font size=-1>\n";
   print "[ <a href=\"$cgi_url\?remove\">L&ouml;schen</a> ] [ <a href=\"$cgi_url\?remove_by_date\">L&ouml;schen nach Datum</a> ] [ <a href=\"$cgi_url\?remove_by_author\">L&ouml;schen nach Author</a> ] [ <a href=\"$cgi_url\?remove_by_num\">L&ouml;schen nach Beitraganzahl</a> ] [ <a href=\"$baseurl/$mesgpage\">$title</a> ]\n";
   print "</font></center><hr size=1 width=75%><p>\n";
   print "<form method=POST action=\"$cgi_url\">\n";
   print "<input type=hidden name=\"action\" value=\"remove\">\n";
   print "<center>\n";
   print "<table border>\n";
   print "<tr>\n";
   print "<th colspan=6>Benutzername: <input type=text name=\"username\"> -- Passwort: <input type=password name=\"password\"></th>\n";
   print "</tr><tr>\n";
   print "<th>Beitragsnummer </th><th>Diskussion </th><th>Beitrag </th><th>Thema </th><th> Author</th><th> Datum</th></tr>\n";
   print "</center>\n";
   open(MSGS,"$basedir/$mesgfile");
   @lines = <MSGS>;
   close(MSGS);

   foreach $line (@lines) {
      if ($line =~ /<!--top: (.*)--><li><a href="$mesgdir\/\1\.$ext">(.*)<\/a> - <b>(.*)<\/b>\s+<i>(.*)<\/i>/) {
         push(@ENTRIES,$1);
         $SUBJECT{$1} = $2;
         $AUTHOR{$1} = $3;
         $DATE{$1} = $4;
      }
   }

   @SORTED_ENTRIES = (sort { $a <=> $b } @ENTRIES);
   $max = pop(@SORTED_ENTRIES);
   $min = shift(@SORTED_ENTRIES);

   print "<input type=hidden name=\"min\" value=\"$min\">\n";
   print "<input type=hidden name=\"max\" value=\"$max\">\n";
   print "<input type=hidden name=\"type\" value=\"remove\">\n";

   foreach (@ENTRIES) {
      print "<tr>\n";
      print "<th><b>$_</b> </th><td><input type=radio name=\"$_\" value=\"all\"> </td><td><input type=radio name=\"$_\" value=\"single\"> </td><td><a href=\"$baseurl/$mesgdir/$_\.$ext\">$SUBJECT{$_} </a></td><td>$AUTHOR{$_} </td><td>$DATE{$_}<br></td>\n";

      print "</tr>\n";
   }
   print "</table>\n";
   print "<center><p>\n";
   print "<input type=submit value=\"L&ouml;sche Beitr&auml;ge\"> <input type=reset value=\"Verwerfen\">\n";
   print "</form>\n";
   print "</body></html>\n";
}

###########################################################################
# Remove By Number                                                        #
#       This method is useful to see in what order the messages were      #
#   added to the wwwboard.html document.                                  #
###########################################################################

elsif ($command eq 'remove_by_num') {
   print "<html><head><title>Beitr&auml;ge des WWWBoard nach Beitraganzahl l&ouml;schen</title></head>\n";
   print "<body><center><h1>Beitr&auml;ge des WWWBoard nach Beitraganzahl l&ouml;schen</h1></center>\n";
   print "<center><table width=80%><tr><td>\n";
   print "Bitte w&auml;hlen Sie den zu l&ouml;schenden Beitrag.<br>\n";
   print "Markieren Sie das linke Kontrollfeld (Diskussion), so wird die ganze Diskussion mit Beitrag und Antwort gel&ouml;scht.<br>\n";
   print "Markieren Sie das rechte Kontrollfel (Beitrag), so werden nur die Antworten gel&ouml;scht.</center>\n"; 
   print "</td></tr></table></center>\n";
   print "<hr size=1 width=75%><center><font size=-1>\n";
   print "[ <a href=\"$cgi_url\?remove\">L&ouml;schen</a> ] [ <a href=\"$cgi_url\?remove_by_date\">L&ouml;schen nach Datum</a> ] [ <a href=\"$cgi_url\?remove_by_author\">L&ouml;schen nach Author</a> ] [ <a href=\"$cgi_url\?remove_by_num\">L&ouml;schen nach Beitraganzahl</a> ] [ <a href=\"$baseurl/$mesgpage\">$title</a> ]\n";
   print "</font></center><hr size=1 width=75%><p>\n";
   print "<form method=POST action=\"$cgi_url\">\n";
   print "<input type=hidden name=\"action\" value=\"remove\">\n";
   print "<center>\n";
   print "<table border>\n";
   print "<tr>\n";
   print "<th colspan=6>Benutzername: <input type=text name=\"username\"> -- Passwort: <input type=password name=\"password\"><br></th>\n";
   print "</tr>\n";
   print "<tr>\n";
   print "<th>Beitragsnummer </th><th>Diskussion </th><th>Beitrag </th><th>Thema </th><th> Author</th><th> Datum</th></tr>\n";
   print "</center>\n";
   open(MSGS,"$basedir/$mesgfile");
   @lines = <MSGS>;
   close(MSGS);

   foreach $line (@lines) {
      if ($line =~ /<!--top: (.*)--><li><a href="$mesgdir\/\1\.$ext">(.*)<\/a> - <b>(.*)<\/b>\s+<i>(.*)<\/i>/) {
         push(@ENTRIES,$1);
         $SUBJECT{$1} = $2;
         $AUTHOR{$1} = $3;
         $DATE{$1} = $4;
      }
   }

   @SORTED_ENTRIES = (sort { $a <=> $b } @ENTRIES);
   $max = pop(@SORTED_ENTRIES);
   $min = shift(@SORTED_ENTRIES);
   push(@SORTED_ENTRIES,$max);
   unshift(@SORTED_ENTRIES,$min);

   print "<input type=hidden name=\"min\" value=\"$min\">\n";
   print "<input type=hidden name=\"max\" value=\"$max\">\n";
   print "<input type=hidden name=\"type\" value=\"remove\">\n";

   foreach (@SORTED_ENTRIES) {
      print "<tr>\n";
      print "<th><b>$_</b> </th><td><input type=radio name=\"$_\" value=\"all\"> </td><td><input type=radio name=\"$_\" value=\"single\"> </td><td><a href=\"$baseurl/$mesgdir/$_\.$ext\">$SUBJECT{$_} </a></td><td>$AUTHOR{$_} </td><td>$DATE{$_}<br></td>\n";

      print "</tr>\n";
   }
   print "</table>\n";
   print "<center><p>\n";
   print "<input type=submit value=\"L&ouml;sche Beitr&auml;ge\"> <input type=reset value=\"Verwerfen\">\n";
   print "</form>\n";
   print "</body></html>\n";
}

###########################################################################
# Remove By Date                                                          #
#       Using this method allows you to delete all messages posted before #
#   a certain date.                                                       #
###########################################################################

elsif ($command eq 'remove_by_date') {
   print "<html><head><title>Beitr&auml;ge des WWWBoard nach Datum l&ouml;schen</title></head>\n";
   print "<body><center><h1>Beitr&auml;ge vom WWWBoard nach Datum l&ouml;schen</h1></center>\n";
   print "<center>Aktivieren Sie die Kontrollk&auml;stchen neben dem Datum um den gew&uuml;nschten Beitrag zu l&ouml;schen!</center> \n";
   print "<hr size=1 width=75%><center><font size=-1>\n";
   print "[ <a href=\"$cgi_url\?remove\">L&ouml;schen</a> ] [ <a href=\"$cgi_url\?remove_by_date\">L&ouml;schen nach Datum</a> ] [ <a href=\"$cgi_url\?remove_by_author\">L&ouml;schen nach Author</a> ] [ <a href=\"$cgi_url\?remove_by_num\">L&ouml;schen nach Beitraganzahl</a> ] [ <a href=\"$baseurl/$mesgpage\">$title</a> ]\n";
   print "</font></center><hr size=1 width=75%>\n";
   print "<p>\n";
   print "<form method=POST action=\"$cgi_url\">\n";
   print "<input type=hidden name=\"action\" value=\"remove_by_date_or_author\">\n";
   print "<input type=hidden name=\"type\" value=\"remove_by_date\">\n";
   print "<center>\n";
   print "<table border>\n";
   print "<tr>\n";
   print "<th colspan=4>Benutzername: <input type=text name=\"username\"> -- Passwort: <input type=password name=\"password\"><br></th>\n";
   print "</tr>\n";
   print "<tr>\n";
   print "<th>X </th><th>Datum </th><th>Anzahl der Beitr&auml;ge </th><th>Beitragsnummer<br></th></tr>\n";

   open(MSGS,"$basedir/$mesgfile");
   @lines = <MSGS>;
   close(MSGS);

   foreach $line (@lines) {
      if ($line =~ /<!--top: (.*)--><li><a href="$mesgdir\/\1\.$ext">.*<\/a> - <b>.*<\/b>\s+<i>(.*)<\/i>/) {
         $date = $2;
         if ($use_time == 1) {
            ($time,$day) = split(/\s+/,$date);
         }
         else {
            $day = $date;
         }
         $DATE{$1} = $day;
      }
   }

   undef(@used_values);
   foreach $value (sort (values %DATE)) {
      $match = '0';
      $value_number = 0;
      foreach $used_value (@used_values) {
         if ($value eq $used_value) {
            $match = '1';
            last;
         }
      }
      if ($match == '0') {
         undef(@values); undef(@short_values);
         foreach $key (keys %DATE) {
            if ($value eq $DATE{$key}) {
               $key_url = "<a href=\"$baseurl/$mesgdir/$key\.$ext\">$key</a>";
               push(@values,$key_url);
	       push(@short_values,$key);
               $value_number++;
            }
         }
         $form_value = $value;
         $form_value =~ s/\//_/g;
         print "<tr>\n";
         print "<td><input type=checkbox name=\"$form_value\" value=\"@short_values\"> </td><th>$value </th><td>$value_number </td><td>@values<br></td>\n";
         print "</tr>\n";
         push(@used_values,$value);
         push(@used_form_values,$form_value);
      }
   }
   print "</table><p>\n";
   print "<input type=hidden name=\"used_values\" value=\"@used_form_values\">\n";
   print "<input type=submit value=\"L&ouml;sche Beitr&auml;ge\"> <input type=reset value=\"Verwerfen\">\n";
   print "</form></center>\n";
   print "</body></html>\n";
}

###########################################################################
# Remove By Author                                                        #
#       This option makes a list of all known authors and then groups     #
#    together there postings and allows you to remove them all at once.   #
###########################################################################

elsif ($command eq 'remove_by_author') {
   print "<html><head><title>Beitr&auml;ge vom WWWBoard nach Author l&ouml;schen</title></head>\n";
   print "<body><center><h1>Beitr&auml;ge vom WWWBoard nach Author l&ouml;schen</h1></center>\n";
   print "<center>Aktivieren Sie die Kontrollk&auml;stchen neben dem Author um den gew&uuml;nschten Beitrag zu l&ouml;schen!</center> \n";
   print "<hr size=1 width=75%><center><font size=-1>\n";
   print "[ <a href=\"$cgi_url\?remove\">L&ouml;schen</a> ] [ <a href=\"$cgi_url\?remove_by_date\">L&ouml;schen nach Datum</a> ] [ <a href=\"$cgi_url\?remove_by_author\">L&ouml;schen nach Author</a> ] [ <a href=\"$cgi_url\?remove_by_num\">L&ouml;schen nach Beitraganzahl</a> ] [ <a hre
f=\"$baseurl/$mesgpage\">$title</a> ]\n";
   print "</font></center><hr size=1 width=75%>\n";
   print "<p>\n";
   print "<form method=POST action=\"$cgi_url\">\n";
   print "<input type=hidden name=\"action\" value=\"remove_by_date_or_author\">\n";
   print "<input type=hidden name=\"type\" value=\"remove_by_author\">\n";
   print "<center>\n";
   print "<table border>\n";
   print "<tr>\n";
   print "<th colspan=4>Benutzername: <input type=text name=\"username\"> -- Passwort: <input type=password name=\"password\"><br></th>\n";
   print "</tr>\n";
   print "<tr>\n";
   print "<th>X </th><th>Author </th><th>Anzahl der Beitr&auml;ge </th><th>Beitragsnummer<br></th></tr>\n";

   open(MSGS,"$basedir/$mesgfile");
   @lines = <MSGS>;
   close(MSGS);

   foreach $line (@lines) {
      if ($line =~ /<!--top: (.*)--><li><a href="$mesgdir\/\1\.$ext">.*<\/a> - <b>(.*)<\/b>\s+<i>.*<\/i>/) {
         $AUTHOR{$1} = $2;
      }
   }

   undef(@used_values);
   foreach $value (sort (values %AUTHOR)) {
      $match = '0';
      $value_number = 0;
      foreach $used_value (@used_values) {
         if ($value eq $used_value) {
            $match = '1';
            last;
         }
      }
      if ($match == '0') {
         undef(@values); undef(@short_values);
         foreach $key (keys %AUTHOR) {
            if ($value eq $AUTHOR{$key}) {
               $key_url = "<a href=\"$baseurl/$mesgdir/$key\.$ext\">$key</a>";
               push(@values,$key_url);
               push(@short_values,$key);
               $value_number++;
            }
         }
         $form_value = $value;
         $form_value =~ s/ /_/g;
         print "<tr>\n";
         print "<td><input type=checkbox name=\"$form_value\" value=\"@short_values\"> </td><th align=left>$value </th><td>$value_number </td><td>@values<br></td>\n";
         print "</tr>\n";
         push(@used_values,$value);
         push(@used_form_values,$form_value);
      }
   }
   print "</table><p>\n";
   print "<input type=hidden name=\"used_values\" value=\"@used_form_values\">\n";
   print "<input type=submit value=\"L&ouml;sche Beitr&auml;ge\"> <input type=reset value=\"Verwerfen\">\n";
   print "</form></center>\n";
   print "</body></html>\n";

}

###########################################################################
# Change Password                                                         #
#       By calling this section of the script, the admin can change his or#
#   her password.							  #
###########################################################################

elsif ($command eq 'change_passwd') {

   print "<html><head><title>WWWBoard Admin Passwortes &auml;ndern</title></head>\n";
   print "<body><center><h1>WWWBoard Admin Passwort &auml;ndern</h1>\n";
   print "Bitte f&uuml;llen Sie die Felder vollst&auml;ndig aus um Ihr Passwort zu &auml;ndern. <br> \n";
   print "Lassen Sie das Feld <b>Neuer Benutzername</b> leer, so wird Ihr alter Benutzername verwendet!</center>\n";
   print "<hr size=1 width=75%><p>\n";
   print "<form method=POST action=\"$cgi_url\">\n";
   print "<input type=hidden name=\"action\" value=\"change_passwd\">\n";
   print "<center><table border=0>\n";
   print "<tr>\n";
   print "<th align=left>Benutzername: </th><td><input type=text name=\"username\"><br></td>\n";
   print "</tr><tr>\n";
   print "<th align=left>Passwort: </th><td><input type=password name=\"password\"><br></td>\n";
   print "</tr><tr> </tr><tr>\n";
   print "<th align=left>Neuer Benutzername: </th><td><input type=text name=\"new_username\"><br></td>\n";
   print "</tr><tr>\n";
   print "<th align=left>Neues Passwort: </th><td><input type=password name=\"passwd_1\"><br></td>\n";
   print "</tr><tr>\n";
   print "<th align=left>Wiederholung des neuen Passwortes: </th><td><input type=password name=\"passwd_2\"><br></td>\n";
   print "</tr><tr>\n";
   print "<td align=center><input type=submit value=\"Passwort &auml;ndern!\"> </td><td align=center><input type=reset value=\"Verwerfen\"></td>\n";
   print "</tr></table></center>\n";
   print "</form></body></html>\n";

}

###########################################################################
# Remove Action                                                           #
#       This portion is used by the options remove and remove_by_num.     #
###########################################################################

elsif ($FORM{'action'} eq 'remove') {

   &check_passwd;

   for ($i = $FORM{'min'}; $i <= $FORM{'max'}; $i++) {
      if ($FORM{$i} eq 'all') {
         push(@ALL,$i);
      }
      elsif ($FORM{$i} eq 'single') {
         push(@SINGLE,$i);
      }
   }

   open(MSGS,"$basedir/$mesgfile");
   @lines = <MSGS>;
   close(MSGS);

   foreach $single (@SINGLE) {
      foreach ($j = 0;$j <= @lines;$j++) {
         if ($lines[$j] =~ /<!--top: $single-->/) {
            splice(@lines, $j, 3);
            $j -= 3;
         }
         elsif ($lines[$j] =~ /<!--end: $single-->/) {
            splice(@lines, $j, 1);
            $j--;
         }
      }
      $filename = "$basedir/$mesgdir/$single\.$ext";
      if (-e $filename) {
         unlink("$filename") || push(@NOT_REMOVED,$single);
      }
      else {
         push(@NO_FILE,$single);
      }
      push(@ATTEMPTED,$single);
   }

   foreach $all (@ALL) {
      undef($top); undef($bottom);
      foreach ($j = 0;$j <= @lines;$j++) {
         if ($lines[$j] =~ /<!--top: $all-->/) {
            $top = $j;
         }
         elsif ($lines[$j] =~ /<!--end: $all-->/) {
            $bottom = $j;
         }
      }
      if ($top && $bottom) {
         $diff = ($bottom - $top);
         $diff++;
         for ($k = $top;$k <= $bottom;$k++) {
            if ($lines[$k] =~ /<!--top: (.*)-->/) {
               push(@DELETE,$1);
            }
         }
         splice(@lines, $top, $diff);
         foreach $delete (@DELETE) {
            $filename = "$basedir/$mesgdir/$delete\.$ext";
            if (-e $filename) {
               unlink($filename) || push(@NOT_REMOVED,$delete);
            }
            else {
               push(@NO_FILE,$delete);
            }
            push(@ATTEMPTED,$delete);
         }
      }
      else {
         push(@TOP_BOT,$all);
      }
   }

   open(WWWBOARD,">$basedir/$mesgfile");
   print WWWBOARD @lines;
   close(WWWBOARD);      

   &return_html($FORM{'type'});

}

###########################################################################
# Remove Action by Date or Author                                         #
#       This portion is used by the method remove_by_date or 		  #
#   remove_by_author.     		  				  #
###########################################################################

elsif ($FORM{'action'} eq 'remove_by_date_or_author') {

   &check_passwd;

   @used_values = split(/\s/,$FORM{'used_values'});
   foreach $used_value (@used_values) {
      @misc_values = split(/\s/,$FORM{$used_value});
      foreach $misc_value (@misc_values) {
         push(@SINGLE,$misc_value);
      }
   }

   open(MSGS,"$basedir/$mesgfile");
   @lines = <MSGS>;
   close(MSGS);

   foreach $single (@SINGLE) {
      foreach ($j = 0;$j <= @lines;$j++) {
         if ($lines[$j] =~ /<!--top: $single-->/) {
            splice(@lines, $j, 3);
            $j -= 3;
         }
         elsif ($lines[$j] =~ /<!--end: $single-->/) {
            splice(@lines, $j, 1);
            $j--;
         }
      }
      $filename = "$basedir/$mesgdir/$single\.$ext";
      if (-e $filename) {
         unlink("$filename") || push(@NOT_REMOVED,$single);
      }
      else {
         push(@NO_FILE,$single);
      }
      push(@ATTEMPTED,$single);
   }

   open(WWWBOARD,">$basedir/$mesgfile");
   print WWWBOARD @lines;
   close(WWWBOARD);

   &return_html($FORM{'type'});

}

elsif ($FORM{'action'} eq 'change_passwd') {

   open(PASSWD,"$basedir/$passwd_file") || &error(passwd_file);
   $passwd_line = <PASSWD>;
   chop($passwd_line) if $passwd_line =~ /\n$/;
   close(PASSWD);

   ($username,$passwd) = split(/:/,$passwd_line);

   if (!($FORM{'passwd_1'} eq $FORM{'passwd_2'})) {
      &error(not_same);
   }

   $test_passwd = crypt($FORM{'password'}, substr($passwd, 0, 2));
   if ($test_passwd eq $passwd && $FORM{'username'} eq $username) {
      open(PASSWD,">$basedir/$passwd_file") || &error(no_change);
      $new_password = crypt($FORM{'passwd_1'}, substr($passwd, 0, 2));
      if ($FORM{'new_username'}) {
         $new_username = $FORM{'new_username'};
      }
      else {
         $new_username = $username;
      }
      print PASSWD "$new_username:$new_password";
      close(PASSWD);
   }
   else {
      &error(bad_combo);
   }

   &return_html(change_passwd);
}

else {
   print "<html><head><title>WWWAdmin f&uuml;r das WWWBoard</title></head>\n";
   print "<body bgcolor=#FFFFFF text=#000000><center><h1>WWWAdmin f&uuml;r das WWWBoard</h1></center>\n";
   print "<center>Bitte w&auml;hlen Sie Ihre Methode um das WWWBoard zu modifizieren:</center><p>\n";
   print "<hr size=1 width=75%><br>\n";
   print "<ul>\n";
   print "<li>Beitr&auml;ge l&ouml;schen\n";
   print "<ul>\n";
   print "<li><a href=\"$cgi_url\?remove\">Beitr&auml;ge l&ouml;schen</a>\n";
   print "<li><a href=\"$cgi_url\?remove_by_num\">Beitr&auml;ge nach Anzahl l&ouml;schen</a>\n";
   print "<li><a href=\"$cgi_url\?remove_by_date\">Beitr&auml;ge nach Datum l&ouml;schen</a>\n";
   print "<li><a href=\"$cgi_url\?remove_by_author\">Beitr&auml;ge nach Author l&ouml;schen</a>\n";
   print "</ul><br>\n";
   print "<li>Passwort\n";
   print "<ul>\n";
   print "<li><a href=\"$cgi_url\?change_passwd\">Admin Passwort &auml;ndern</a>\n";
   print "</ul>\n";
   print "</ul>\n";
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

      $FORM{$name} = $value;
   }
}

sub return_html {
   $type = $_[0];
   if ($type eq 'remove') {
      print "<html><head><title>Zusammenfassung der L&ouml;schungen</title></head>\n";
      print "<body><center><h1>Zusammenfassung der L&ouml;schungen</h1></center>\n";
   }
   elsif ($type eq 'remove_by_num') {
      print "<html><head><title>Zusammenfassung der L&ouml;schungen nach Beitraganzahl</title></head>\n";
      print "<body><center><h1>Zusammenfassung der L&ouml;schungen nach Beitraganzahl</h1></center>\n";
   }
   elsif ($type eq 'remove_by_date') {
      print "<html><head><title>Zusammenfassung der L&ouml;schungen nach Datum</title></head>\n";
      print "<body><center><h1>Zusammenfassung der L&ouml;schungen nach Datum</h1></center>\n";
   }
   elsif ($type eq 'remove_by_author') {
      print "<html><head><title>Zusammenfassung der L&ouml;schung nach Author</title></head>\n";
      print "<body><center><h1>Zusammenfassung der L&ouml;schung nach Author</h1></center>\n";
   }
   elsif ($type eq 'change_passwd') {
      print "<html><head><title>WWWBoard WWWAdmin Passwort ge&auml;ndert</title></head>\n";
      print "<body><center><h1>WWWBoard WWWAdmin Passwort ge&auml;ndert</h1>\n";
      print "Ihr Passwort f&uuml;r WWWBoard WWWAdmin wurde ge&auml;ndert!<p><hr size=1 width=75%><p>\n";
      print "<b>Neuer Benutzername: $new_username<p>\n";
      print "Neues Passwort: $FORM{'passwd_1'}</b><p>\n";
      print "<hr size=1 width=75%><p>\n";
      print "Bitte vergessen Sie Ihren Benutzernamen und das Passwort nicht! Sie haben sonst keinen Zugriff mehr.\n";
      print "</body></html>\n";
   }
   if ($type =~ /^remove/) {
      print "<center>Es folgt eine kurze Zusammenfassung der gel&ouml;schten Beitr&auml;ge.\n";
      print "<hr size=1 width=75%>\n";
      print "<b>Betr&auml;ge:</b> @ATTEMPTED<b> wurde gel&ouml;schte.</b></center><p>\n";
      if (@NOT_REMOVED) {
         print "<b>Beitrag konnte nicht gel&ouml;scht werden:</b> @NOT_REMOVED<p>\n";
      }
      if (@NO_FILE) {
         print "<b>Beitrag nicht gefunden:</b> @NO_FILE<p>\n";
      }
      print "<hr size=1 width=75%><center><font size=-1>\n";
      print "[ <a href=\"$cgi_url\?remove\">L&ouml;schen</a> ] [ <a href=\"$cgi_url\?remove_by_date\">L&ouml;schen nach Datum</a> ] [ <a href=\"$cgi_url\?remove_by_author\">L&ouml;schen nach Author</a> ] [ <a href=\"$cgi_url\?remove_by_num\">L&ouml;schen nach Beitraganzahl</a> ] [ <a href=\"$baseurl/$mesgpage\">$title</a> ]\n";
      print "</font></center><hr size=1 width=75%>\n";
      print "</body></html>\n";
   }
}

sub error {
   $error = $_[0];
   if ($error eq 'bad_combo') {
      print "<html><head><title>Falscher Benutzername - Passwort Kombination</title></head>\n";
      print "<body><center><h1>Falscher Benutzername - Passwort Kombination</h1>\n";
      print "Sie haben einen falschen Benutzernamen, oder ein falsche Passwort eingegeben.<br>\n";
      print " Bitte korrigieren Sie Ihre Eingaben und wiederholen den Vorgang.</center><p>\n";
      &passwd_trailer
   }
   elsif ($error eq 'passwd_file') {
      print "<html><head><title>F&auml;hler beim Lesen des Passwortes</title></head>\n";
      print "<body><center><h1>F&auml;hler beim Lesen des Passwortes</h1>\n";
      print "<center><table width=80%><tr><td>\n";
      print "<center>Die Passwortdatei konnte nicht ge&ouml;ffnet werden!</center><br>\n";
      print "Bitte stellen Sie sicher, dass die Datei <b>passwd.txt</b> im Verzeichnis wwwboard vorhanden ist und die Zugriffsrechte richtig gesetzt sind.<p>\n";
      print "</td></tr></table></center>\n";
      &passwd_trailer
   }
   elsif ($error eq 'not_same') {
      print "<html><head><title>Falsches Passwort</title></head>\n";
      print "<body><center><h1>Falsches Passwort eingegeben</h1>\n";
      print "Die Wiederholung des Passwortes ist falsch. Bitte korregiern Sie Ihren Eintrag</center>\n";
      &passwd_trailer
   }
   elsif ($error eq 'no_change') {
      print "<html><head><title>F&auml;hler beim Schreiben der Passwortdatei</title></head>\n";
      print "<body><center><h1>F&auml;hler beim Schreiben der Passwortdatei</h1></center>\n";
      print "F&auml;hler beim Schreiben der Passwortdatei!  Passwort nicht ge&auml;ndert!<p>\n";
      &passwd_trailer
   }

   exit;
}

sub passwd_trailer {
   print "<hr size=1 width=75%><center><font size=-1>\n";
   print "[ <a href=\"$cgi_url\?remove\">L&ouml;schen</a> ] [ <a href=\"$cgi_url\?remove_by_date\">L&ouml;schen nach Datum</a> ] [ <a href=\"$cgi_url\?remove_by_author\">L&ouml;schen nach Author</a> ] [ <a href=\"$cgi_url\?remove_by_num\">L&ouml;schen nach Beitraganzahl</a> ] [ <a href=\"$baseurl/$mesgpage\">$title</a> ]\n";
   print "</font></center><hr size=1 width=75%>\n";
   print "</body></html>\n";
}

sub check_passwd {
   open(PASSWD,"$basedir/$passwd_file") || &error(passwd_file);
   $passwd_line = <PASSWD>;
   chop($passwd_line) if $passwd_line =~ /\n$/;
   close(PASSWD);

   ($username,$passwd) = split(/:/,$passwd_line);

   $test_passwd = crypt($FORM{'password'}, substr($passwd, 0, 2));
   if (!($test_passwd eq $passwd && $FORM{'username'} eq $username)) {
      &error(bad_combo);
   }
}
