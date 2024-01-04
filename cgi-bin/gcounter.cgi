#!/usr/bin/perl
#
###########################################################
# 
# hostweb - gcounter 1.01 
# einfacher grafischer Counter, SSI wird nicht benoetigt
#
# (c) 1998-2000 Marcus Schaefer fuer hostweb
# http://www.hostweb.de
#
##########################################################

# Einrichten der Pfade
#
require 'konfiguration.dat'; 

# Ab hier sind keine Aenderungen notwendig
#

$basicpath = "/home/";
$basicpath = $basicpath.$usercfg;
$counterend = "/htdocs/cgi-bin/gcounter.txt";
$counterfile = $basicpath.$counterend;

# Pfad zu den Digits, diese muessen den Namen 0.gif bis 9.gif tragen
#

$digitend = "/htdocs/cgi-bin/digits/";
$digitpath = $basicpath.$digitend;

$imagefile{'0'}= $digitpath."0.gif"; 
$imagefile{'1'}= $digitpath."1.gif"; 
$imagefile{'2'}= $digitpath."2.gif"; 
$imagefile{'3'}= $digitpath."3.gif"; 
$imagefile{'4'}= $digitpath."4.gif"; 
$imagefile{'5'}= $digitpath."5.gif"; 
$imagefile{'6'}= $digitpath."6.gif";
$imagefile{'7'}= $digitpath."7.gif"; 
$imagefile{'8'}= $digitpath."8.gif"; 
$imagefile{'9'}= $digitpath."9.gif"; 

# gcounter - ab hier bitte keine Aenderungen
#

$|=1;
@querys = split(/&/, $ENV{'QUERY_STRING'});
foreach $query (@querys) {
   ($name, $value) = split(/=/, $query);
   $FORM{$name} = $value;     
}
$position="$FORM{'position'}";

open(NUMBER,"$counterfile");
$number=<NUMBER>;
close(NUMBER);

$number++;
if ($position==1) {
   open(NUMBER,">$counterfile");
   print NUMBER "$number";
   close(NUMBER);
}

if (($position>0) && ($position<=length($number))) {
   $positionnumber=substr($number,(length($number)-$position),1);
}
else {
   $positionnumber="0";
}
if ($imagefile{$positionnumber}) {
   $imagereturn=$imagefile{$positionnumber};
}
else {
   $imagereturn=$imagefile{'0'};
}

print "Content-type: image/gif\n\n";
open(IMAGE,"<$imagereturn");
print <IMAGE>;
close(IMAGE);
exit 0;
