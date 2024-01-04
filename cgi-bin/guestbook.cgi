#!/usr/bin/perl

#################################################################################################
# Guestbook 1.54 -- January 7, 1998
#
# Created by Bernard Sowa <bernard@zonecoaster.com>
#
# This is a simple perl guestbook script that can be used by multiple users.  It is written
# to create visually-attractive guestbooks and to allow users to customize their guestbooks
# by adding their own inputs in addition to the ones that must be present.  It also allows 
# users' to have multiple guestbooks as long as they are in the same directory.
#
#	DISCLAIMER:  I AM IN NO WAY RESPONSIBLE TO ANY DAMAGE THIS SCRIPT MAY CAUSE TO YOU OR ANY
#		     OF YOUR PROPERTY
#
# modifiziert und übersetzt von Marcus Schäfer http://www.marcuschaefer.de/perl/ (1999)
#
#################################################################################################

#################################################################################################
#Konfigurationsbereich
#
#$basedir
#	The base directory onto which all user directories are appended.
#	Example:
#		Two typical users, jdoe and eodj have the following home directories(respectively)
#		/root/users/jdoe
#		/root/users/eodj
#		$basedir would be:  $basedir='/root/users';
#
#	If you're setting it up for your own personal use, set this to your home directory.  If you
#	have a public_html directory, include public_html in $basedir and leave $pub empty like I have.
#
#	No trailing slash.
#
#$baseurl
#	The URL for the $basedir.  No trailing slash
#
#$pub
#	If your system uses public_html directories for user's home directories set this to
#	the name of the public_html directory(most likely 'public_html').
#	If not, leave as-is.  The choices are 'public_html'(or whatever it is on your system) and ''.
#
#	If you're setting it up for your own personal use, leave $pub empty and include public_html
#	in $basedir if you have a public_html directory.
#
#$tilde
#	If your server uses tilde expansions in URLs then set this to '~'.  ie.  If users have
#	addresses such as http://yourhost.here/~jdoe/ and http://yourhost.here/~eodj/ then set
#	this to '~'.  If not, leave it as-is.
#
#	If you're setting it up for your own personal use and have a tilde in your URL, add it
#	to $baseurl and leave $tilde empty as I have.
#
#@required
#	Array containing a list of all of the fields that must be present in a form and which
#	must be filled in by a person signing the guestbook in order for the entry to be
#	added to the guestbook(required inputs from your form...<input type=text name="whatever">)
#################################################################################################

#
# Laden der Konfiguratonsdaten
#
require 'konfiguration.dat';

#
# Erzeugen von $basedir (realer Pfad)
#
$basedir = '/home/';
$baseend = '/htdocs';
$basedir = $basedir.$usercfg;
$basedir = $basedir.$baseend;

#
# Erzeugen der $baseurl
#
$baseurl = 'http://www.';
$baseurl = $baseurl.$domaincfg;

#
# Weitere Konfiguration, require gibt die zwingenden Felder vor!
#
@required=('name','email','beitrag');
$pub='';	#'' or 'public_html' or 'whatever'
$tilde='';	#'' or '~';

#################################################################################################
# Auslesen der Formulardaten
#################################################################################################

&get_form_data;

foreach $rfield (@required)		#Check if required fields are filled out. If not, quit.
{
	if($formdata{$rfield} eq "")
	{
		++$bad;
	}
}
if($bad != "0")		#if one or more of the required fields isn't filled in
{
	print "Content-type: text/html\n\n";
	print "<html>\n<title>Fehlerhafter Eintrag!</title>\n";
	print "<body bgcolor=\"\#ffffff\" text=\"\#000000\">\n\n";
	print "<br> \n";	
	print "<p> \n<center> Sie haben Felder nicht oder falsch ausgefüllt, überprüfen Sie Ihre e-Mailadresse. \n</center> \n";
	print "<p> \n<center> Füllen Sie bitte folgen Felder komplett aus :\n";
	print "<ul>\n";
	foreach $rfield (@required)
	{
		print "<li><b>$rfield</b>\n";
	}
	print "<p> Bitte benutzen Sie \"Zurück\" oder \"Back\" in Ihrem Browser. \n</center> \n";
	print "</ul>\n<center><hr width=50%></center>\n</html>";
	exit 0;
}

#################################################################################################
#Do stuff with it...ie. open the user's guestbook file and add the new entry to the top
#################################################################################################

#check if logon matches Referer URL
# if($ENV{'HTTP_REFERER'} !~ /$baseurl\/$tilde$formdata{'logon'}/)
# {
#	print "Content-type: text/html\n\n";
#	print "<html>\n<title>Fehler</title>\n";
#	print "<body bgcolor=\"\#ffffff\" text=\"\#000000\">\n\n";
#	print " Falscher Username.  Sie können Ihre Seite nicht editieren.\n";
#	print "</ul>\n<center><hr width=50%></center>\n</html>";
#	exit 0;
#}

$logon="$formdata{'logon'}";		#find out user's logon
$bookname=$formdata{'bookname'};	#find out path to user's guestbook
$bookurl=$formdata{'bookurl'};		#find out URL for guestbook

if($logon ne "")
{
	$book="$basedir/$logon$pub/$bookname";
}
else
{
	$book="$basedir/$bookname";
}

open(BOOK, "$book") || die "Content-type: text/plain\n\n Could not open $book";
@contents=<BOOK>;	#get contents of Guestbook so you can add this entry to it.
close(BOOK);

open(BOOK2, ">$book");
foreach $line (@contents)
{
	if($line =~ /<!--Do not change or get rid of this line-->/)	#print new entry after this line
	{
		print BOOK2 "$line\n\n";
		print BOOK2 "<\!\-\-Begin Entry\-\->\n";
		print BOOK2 "<p>\n<font face = arial>\n<font size= 2>\n";
		print BOOK2 "<b>$formdata{'betreff'}</b>\n<br>\n</font>\n";
		print BOOK2 "<font size= 1><a href=\"mailto:$formdata{'email'}\"><b>$formdata{'name'}</b>\n</a>\n";
		if ($formdata{'homepage'} ne "http://www.")
		{
			print BOOK2 " / <a href=\"$formdata{'homepage'}\">Homepage</a>\n";
		}
		
		print BOOK2 "\n</font>\n";

		
		#	if ($formdata{'homepage'} ne "")
		#	{
		#	print BOOK2 " <a href=\"$formdata{'homepage'}\">Homepage</a>][$nicedate]\n<br>\n";
		#	}
		# else
		#	{
		#	print BOOK2 "[$nicedate]\n<br>\n\n";
		#	}
		#
		# now print each of the input names and the user's input if it isn't empty
		# then print the comments last.

		print BOOK2 "</font></font>\n";

		$leaveout='/logon/bookname/bookurl/bulleturl/separator/comments/email/beitrag/name/homepage/submit/betreff/';

		foreach $key (keys(%formdata))
		{
			if($leaveout !~ /\/$key\//)
			{
				print BOOK2 "<li><b>$key</b>: $formdata{$key}\n";
			}
		}
		print BOOK2 "<font face = arial><font size = 2><br>\n<br>\n";
		print BOOK2 "$formdata{'beitrag'}\n</font>\n";
		
		print BOOK2 "\n<br>\n<br>\n";
		&get_date;
		$nicedate="$nicedate";
		print BOOK2 "<font size= 1>\n";
		print BOOK2 "[Geschrieben am $nicedate]\n";
		
		if($formdata{'separator'} ne "")
		{
			print BOOK2 "\n<center>\n<p>\n<img src=\"$formdata{'separator'}\">\n</p></center>\n<br>\n\n";
		}
		else
		{
			print BOOK2 "\n<center>\n<p>\n<hr width=50%>\n</center></p><br>\n\n";
		}
		print BOOK2 "<\!\-\-End Entry\-\->\n";
	}
	else
	{
		print BOOK2 $line;
	}
}
close(BOOK2);

print "Content-type: text/html\n\n";
print "<html>\n<title>Vielen Dank für Ihren Eintrag</title>\n";
print "<body bgcolor=\"\#ffffff\" text=\"\#000000\">\n\n";
print "<br> \n";
print " \n<center> Vielen Dank für Ihren Eintrag, klicken Sie ";
print "<a href=/guestbook/index.html>hier</a> um Ihren Eintrag zu lesen.\n</center>";
print "<br> \n<center> Benutzen Sie \"Reload\" oder \"Neu laden\" um Ihren Eintrag zu sehen. \n</center>";
print "</html>";
exit;

#################################################################################################
# Subroutines
#################################################################################################

sub get_form_data {

	$buffer = "";
	read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
	@pairs=split(/&/,$buffer);
	foreach $pair (@pairs)
	{
		@a = split(/=/,$pair);
		$name=$a[0];
		$value=$a[1];
		$name =~ s/\+/ /g;

		$deniedfile='/usr/local/www/bernard/denied.txt';
		if($value=~/<SCRIPT/i)
		{
			open(DENY,">>$deniedfile");
			print DENY "$ENV{'REMOTE_HOST'}\n";
			close(DENY);
		}

		$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		$value =~ s/~!/ ~!/g;
		$value =~ s/\+/ /g;
		$value =~ s/<([^>])*>//g;
		$value =~ s/(\r)+/\-\-/g;
		$value =~ s/\n+//g;
		$value =~ s/(\-\-)+/<br>/g;
		$value=~s/\<SCRIPT//gi;
		$value=~s/\<\/SCRIPT\>//gi;
		$value=~s/\function \{//gi;
		push (@formdata,$name);
		push (@formdata,$value);
	}
	%formdata=@formdata;
	%formdata;
}

sub get_date {

	%days=('Sun','Sonntag',
		'Mon','Montag',
		'Tue','Dienstag',
		'Wed','Mittwoch',
		'Thu','Donnerstag',
		'Fri','Freitag',
		'Sat','Samstag');

	%mos=('Jan','Januar',
		'Feb','Februar',
		'Mar','März',
		'Apr','April',
		'May','Mai',
		'Jun','Juni',
		'Jul','Juli',
		'Aug','August',
		'Sep','September',
		'Oct','Oktober',
		'Nov','November',
		'Dec','Dezember');
	$a = scalar localtime time;
	@a=split(/ /,$a);
	#############################################
	#@a looks like:
	#############################################
	#@a = ('wdy','mmm',' ','dd','HH:MM:SS','yy');
	#	 0     1    2    3       4       5
	#############################################
	foreach $key (keys(%days))
	{
		if($a[0] eq $key)
		{
			$a[0]=$days{$key};
		}
	}
	foreach $key (keys(%mos))
	{
		if($a[1] eq $key)
		{
			$a[1]=$mos{$key};
		}
	}
	if($a[2] eq "")
	{
		$a[2] = $a[3];
		$not = 1;
	}
	if($a[2] eq "1" | $a[2] eq "21" | $a[2] eq "31")
	{
		$a[2]="$a[2]";
	}
	elsif($a[2] eq "2" | $a[2] eq "22")
	{
		$a[2]="$a[2]";
	}
	elsif($a[2] eq "3" | $a[2] eq "23")
	{
		$a[2]="$a[2]";
	}
	else
	{
		$a[2]="$a[2].";
	}
	if($not)
	{
		$nicedate="$a[0], $a[2] $a[1] $a[5] um $a[4] Uhr";
	}
	else
	{
		$nicedate="$a[0], $a[2] $a[1] $a[4] um $a[3] Uhr";
	}
	return $nicedate;
}
