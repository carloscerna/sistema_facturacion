<?php
//============================================================+
// File name   : tcpdf.php
// Version     : 5.9.009
// Begin       : 2002-08-03
// Last Update : 2010-10-21
// Author      : Nicola Asuni - Tecnick.com S.r.l - Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
// License     : GNU-LGPL v3 (http://www.gnu.org/copyleft/lesser.html)
// -------------------------------------------------------------------
// Copyright (C) 2002-2010  Nicola Asuni - Tecnick.com S.r.l.
//
// This file is part of TCPDF software library.
//
// TCPDF is free software: you can redistribute it and/or modify it
// under the terms of the GNU Lesser General Public License as
// published by the Free Software Foundation, either version 3 of the
// License, or (at your option) any later version.
//
// TCPDF is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with TCPDF.  If not, see <http://www.gnu.org/licenses/>.
//
// See LICENSE.TXT file for more information.
// -------------------------------------------------------------------
//
// Description : This is a PHP class for generating PDF documents without
//               requiring external extensions.
//
// NOTE:
//   This class was originally derived in 2002 from the Public
//   Domain FPDF class by Olivier Plathey (http://www.fpdf.org),
//   but now is almost entirely rewritten and contains thousands of
//   new lines of code and hundreds new features.
//
// Main features:
//  * no external libraries are required for the basic functions;
//  * all standard page formats, custom page formats, custom margins and units of measure;
//  * UTF-8 Unicode and Right-To-Left languages;
//  * TrueTypeUnicode, OpenTypeUnicode, TrueType, OpenType, Type1 and CID-0 fonts;
//  * font subsetting;
//  * methods to publish some XHTML + CSS code, Javascript and Forms;
//  * images, graphic (geometric figures) and transformation methods;
//  * supports JPEG, PNG and SVG images natively, all images supported by GD (GD, GD2, GD2PART, GIF, JPEG, PNG, BMP, XBM, XPM) and all images supported via ImagMagick (http://www.imagemagick.org/www/formats.html)
//  * 1D and 2D barcodes: CODE 39, ANSI MH10.8M-1983, USD-3, 3 of 9, CODE 93, USS-93, Standard 2 of 5, Interleaved 2 of 5, CODE 128 A/B/C, 2 and 5 Digits UPC-Based Extention, EAN 8, EAN 13, UPC-A, UPC-E, MSI, POSTNET, PLANET, RMS4CC (Royal Mail 4-state Customer Code), CBC (Customer Bar Code), KIX (Klant index - Customer index), Intelligent Mail Barcode, Onecode, USPS-B-3200, CODABAR, CODE 11, PHARMACODE, PHARMACODE TWO-TRACKS, QR-Code, PDF417;
//  * Grayscale, RGB, CMYK, Spot Colors and Transparencies;
//  * automatic page header and footer management;
//  * document encryption up to 256 bit and digital signature certifications;
//  * transactions to UNDO commands;
//  * PDF annotations, including links, text and file attachments;
//  * text rendering modes (fill, stroke and clipping);
//  * multiple columns mode;
//  * no-write page regions;
//  * bookmarks and table of content;
//  * text hyphenation;
//  * text stretching and spacing (tracking/kerning);
//  * automatic page break, line break and text alignments including justification;
//  * automatic page numbering and page groups;
//  * move and delete pages;
//  * page compression (requires php-zlib extension);
//  * XOBject Templates;
//
// -----------------------------------------------------------
// THANKS TO:
//
// Olivier Plathey (http://www.fpdf.org) for original FPDF.
// Efthimios Mavrogeorgiadis (emavro@yahoo.com) for suggestions on RTL language support.
// Klemen Vodopivec (http://www.fpdf.de/downloads/addons/37/) for Encryption algorithm.
// Warren Sherliker (wsherliker@gmail.com) for better image handling.
// dullus for text Justification.
// Bob Vincent (pillarsdotnet@users.sourceforge.net) for <li> value attribute.
// Patrick Benny for text stretch suggestion on Cell().
// Johannes Güntert for JavaScript support.
// Denis Van Nuffelen for Dynamic Form.
// Jacek Czekaj for multibyte justification
// Anthony Ferrara for the reintroduction of legacy image methods.
// Sourceforge user 1707880 (hucste) for line-trough mode.
// Larry Stanbery for page groups.
// Martin Hall-May for transparency.
// Aaron C. Spike for Polycurve method.
// Mohamad Ali Golkar, Saleh AlMatrafe, Charles Abbott for Arabic and Persian support.
// Moritz Wagner and Andreas Wurmser for graphic functions.
// Andrew Whitehead for core fonts support.
// Esteban Joël Marín for OpenType font conversion.
// Teus Hagen for several suggestions and fixes.
// Yukihiro Nakadaira for CID-0 CJK fonts fixes.
// Kosmas Papachristos for some CSS improvements.
// Marcel Partap for some fixes.
// Won Kyu Park for several suggestions, fixes and patches.
// Dominik Dzienia for QR-code support.
// Laurent Minguet for some suggestions.
// Christian Deligant for some suggestions and fixes.
// Anyone that has reported a bug or sent a suggestion.
//============================================================+

/**
 * This is a PHP class for generating PDF documents without requiring external extensions.<br>
 * TCPDF project (http://www.tcpdf.org) was originally derived in 2002 from the Public Domain FPDF class by Olivier Plathey (http://www.fpdf.org), but now is almost entirely rewritten.<br>
 * <h3>TCPDF main features are:</h3>
 * <ul>
 * <li>no external libraries are required for the basic functions;</li>
 * <li>all standard page formats, custom page formats, custom margins and units of measure;</li>
 * <li>UTF-8 Unicode and Right-To-Left languages;</li>
 * <li>TrueTypeUnicode, OpenTypeUnicode, TrueType, OpenType, Type1 and CID-0 fonts;</li>
 * <li>font subsetting;</li>
 * <li>methods to publish some XHTML + CSS code, Javascript and Forms;</li>
 * <li>images, graphic (geometric figures) and transformation methods;
 * <li>supports JPEG, PNG and SVG images natively, all images supported by GD (GD, GD2, GD2PART, GIF, JPEG, PNG, BMP, XBM, XPM) and all images supported via ImagMagick (http://www.imagemagick.org/www/formats.html)</li>
 * <li>1D and 2D barcodes: CODE 39, ANSI MH10.8M-1983, USD-3, 3 of 9, CODE 93, USS-93, Standard 2 of 5, Interleaved 2 of 5, CODE 128 A/B/C, 2 and 5 Digits UPC-Based Extention, EAN 8, EAN 13, UPC-A, UPC-E, MSI, POSTNET, PLANET, RMS4CC (Royal Mail 4-state Customer Code), CBC (Customer Bar Code), KIX (Klant index - Customer index), Intelligent Mail Barcode, Onecode, USPS-B-3200, CODABAR, CODE 11, PHARMACODE, PHARMACODE TWO-TRACKS, QR-Code, PDF417;</li>
 * <li>Grayscale, RGB, CMYK, Spot Colors and Transparencies;</li>
 * <li>automatic page header and footer management;</li>
 * <li>document encryption up to 256 bit and digital signature certifications;</li>
 * <li>transactions to UNDO commands;</li>
 * <li>PDF annotations, including links, text and file attachments;</li>
 * <li>text rendering modes (fill, stroke and clipping);</li>
 * <li>multiple columns mode;</li>
 * <li>no-write page regions;</li>
 * <li>bookmarks and table of content;</li>
 * <li>text hyphenation;</li>
 * <li>text stretching and spacing (tracking/kerning);</li>
 * <li>automatic page break, line break and text alignments including justification;</li>
 * <li>automatic page numbering and page groups;</li>
 * <li>move and delete pages;</li>
 * <li>page compression (requires php-zlib extension);</li>
 * <li>XOBject Templates;</li>
 * </ul>
 * Tools to encode your unicode fonts are on fonts/utils directory.</p>
 * @package com.tecnick.tcpdf
 * @abstract Class for generating PDF files on-the-fly without requiring external extensions.
 * @author Nicola Asuni
 * @copyright 2002-2010 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://www.tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @version 5.9.009
 */

/**
 * main configuration file
 * (define the K_TCPDF_EXTERNAL_CONFIG constant to skip this file)
 */
require_once(dirname(__FILE__).'/config/tcpdf_config.php');

/**
 * define default PDF document producer
 */
define('PDF_PRODUCER', 'TCPDF 5.9.009 (http://www.tcpdf.org)');

/**
* This is a PHP class for generating PDF documents without requiring external extensions.<br>
* TCPDF project (http://www.tcpdf.org) has been originally derived in 2002 from the Public Domain FPDF class by Olivier Plathey (http://www.fpdf.org), but now is almost entirely rewritten.<br>
* @name TCPDF
* @package com.tecnick.tcpdf
* @version 5.9.009
* @author Nicola Asuni - info@tecnick.com
* @link http://www.tcpdf.org
* @license http://www.gnu.org/copyleft/lesser.html LGPL
*/
class TCPDF {

	// Protected properties

	/**
	 * @var current page number
	 * @access protected
	 */
	protected $page;

	/**
	 * @var current object number
	 * @access protected
	 */
	protected $n;

	/**
	 * @var array of object offsets
	 * @access protected
	 */
	protected $offsets;

	/**
	 * @var buffer holding in-memory PDF
	 * @access protected
	 */
	protected $buffer;

	/**
	 * @var array containing pages
	 * @access protected
	 */
	protected $pages = array();

	/**
	 * @var current document state
	 * @access protected
	 */
	protected $state;

	/**
	 * @var compression flag
	 * @access protected
	 */
	protected $compress;

	/**
	 * @var current page orientation (P = Portrait, L = Landscape)
	 * @access protected
	 */
	protected $CurOrientation;

	/**
	 * @var Page dimensions
	 * @access protected
	 */
	protected $pagedim = array();

	/**
	 * @var scale factor (number of points in user unit)
	 * @access protected
	 */
	protected $k;

	/**
	 * @var width of page format in points
	 * @access protected
	 */
	protected $fwPt;

	/**
	 * @var height of page format in points
	 * @access protected
	 */
	protected $fhPt;

	/**
	 * @var current width of page in points
	 * @access protected
	 */
	protected $wPt;

	/**
	 * @var current height of page in points
	 * @access protected
	 */
	protected $hPt;

	/**
	 * @var current width of page in user unit
	 * @access protected
	 */
	protected $w;

	/**
	 * @var current height of page in user unit
	 * @access protected
	 */
	protected $h;

	/**
	 * @var left margin
	 * @access protected
	 */
	protected $lMargin;

	/**
	 * @var top margin
	 * @access protected
	 */
	protected $tMargin;

	/**
	 * @var right margin
	 * @access protected
	 */
	protected $rMargin;

	/**
	 * @var page break margin
	 * @access protected
	 */
	protected $bMargin;

	/**
	 * @var array of cell internal paddings ('T' => top, 'R' => right, 'B' => bottom, 'L' => left)
	 * @since 5.9.000 (2010-10-03)
	 * @access protected
	 */
	protected $cell_padding = array('T' => 0, 'R' => 0, 'B' => 0, 'L' => 0);

	/**
	 * @var array of cell margins ('T' => top, 'R' => right, 'B' => bottom, 'L' => left)
	 * @since 5.9.000 (2010-10-04)
	 * @access protected
	 */
	protected $cell_margin = array('T' => 0, 'R' => 0, 'B' => 0, 'L' => 0);

	/**
	 * @var current horizontal position in user unit for cell positioning
	 * @access protected
	 */
	protected $x;

	/**
	 * @var current vertical position in user unit for cell positioning
	 * @access protected
	 */
	protected $y;

	/**
	 * @var height of last cell printed
	 * @access protected
	 */
	protected $lasth;

	/**
	 * @var line width in user unit
	 * @access protected
	 */
	protected $LineWidth;

	/**
	 * @var array of standard font names
	 * @access protected
	 */
	protected $CoreFonts;

	/**
	 * @var array of used fonts
	 * @access protected
	 */
	protected $fonts = array();

	/**
	 * @var array of font files
	 * @access protected
	 */
	protected $FontFiles = array();

	/**
	 * @var array of encoding differences
	 * @access protected
	 */
	protected $diffs = array();

	/**
	 * @var array of used images
	 * @access protected
	 */
	protected $images = array();

	/**
	 * @var array of Annotations in pages
	 * @access protected
	 */
	protected $PageAnnots = array();

	/**
	 * @var array of internal links
	 * @access protected
	 */
	protected $links = array();

	/**
	 * @var current font family
	 * @access protected
	 */
	protected $FontFamily;

	/**
	 * @var current font style
	 * @access protected
	 */
	protected $FontStyle;

	/**
	 * @var current font ascent (distance between font top and baseline)
	 * @access protected
	 * @since 2.8.000 (2007-03-29)
	 */
	protected $FontAscent;

	/**
	 * @var current font descent (distance between font bottom and baseline)
	 * @access protected
	 * @since 2.8.000 (2007-03-29)
	 */
	protected $FontDescent;

	/**
	 * @var underlining flag
	 * @access protected
	 */
	protected $underline;

	/**
	 * @var overlining flag
	 * @access protected
	 */
	protected $overline;

	/**
	 * @var current font info
	 * @access protected
	 */
	protected $CurrentFont;

	/**
	 * @var current font size in points
	 * @access protected
	 */
	protected $FontSizePt;

	/**
	 * @var current font size in user unit
	 * @access protected
	 */
	protected $FontSize;

	/**
	 * @var commands for drawing color
	 * @access protected
	 */
	protected $DrawColor;

	/**
	 * @var commands for filling color
	 * @access protected
	 */
	protected $FillColor;

	/**
	 * @var commands for text color
	 * @access protected
	 */
	protected $TextColor;

	/**
	 * @var indicates whether fill and text colors are different
	 * @access protected
	 */
	protected $ColorFlag;

	/**
	 * @var automatic page breaking
	 * @access protected
	 */
	protected $AutoPageBreak;

	/**
	 * @var threshold used to trigger page breaks
	 * @access protected
	 */
	protected $PageBreakTrigger;

	/**
	 * @var flag set when processing footer
	 * @access protected
	 */
	protected $InFooter = false;

	/**
	 * @var zoom display mode
	 * @access protected
	 */
	protected $ZoomMode;

	/**
	 * @var layout display mode
	 * @access protected
	 */
	protected $LayoutMode;

	/**
	 * @var title
	 * @access protected
	 */
	protected $title = '';

	/**
	 * @var subject
	 * @access protected
	 */
	protected $subject = '';

	/**
	 * @var author
	 * @access protected
	 */
	protected $author = '';

	/**
	 * @var keywords
	 * @access protected
	 */
	protected $keywords = '';

	/**
	 * @var creator
	 * @access protected
	 */
	protected $creator = '';

	/**
	 * @var alias for total number of pages
	 * @access protected
	 */
	protected $AliasNbPages = '{nb}';

	/**
	 * @var alias for page number
	 * @access protected
	 */
	protected $AliasNumPage = '{pnb}';

	/**
	 * @var right-bottom corner X coordinate of inserted image
	 * @since 2002-07-31
	 * @author Nicola Asuni
	 * @access protected
	 */
	protected $img_rb_x;

	/**
	 * @var right-bottom corner Y coordinate of inserted image
	 * @since 2002-07-31
	 * @author Nicola Asuni
	 * @access protected
	 */
	protected $img_rb_y;

	/**
	 * @var adjusting factor to convert pixels to user units.
	 * @since 2004-06-14
	 * @author Nicola Asuni
	 * @access protected
	 */
	protected $imgscale = 1;

	/**
	 * @var boolean set to true when the input text is unicode (require unicode fonts)
	 * @since 2005-01-02
	 * @author Nicola Asuni
	 * @access protected
	 */
	protected $isunicode = false;

	/**
	 * @var object containing unicode data
	 * @since 5.9.004 (2010-10-18)
	 * @author Nicola Asuni
	 * @access protected
	 */
	protected $unicode;

	/**
	 * @var PDF version
	 * @since 1.5.3
	 * @access protected
	 */
	protected $PDFVersion = '1.7';

	/**
	 * @var Minimum distance between header and top page margin.
	 * @access protected
	 */
	protected $header_margin;

	/**
	 * @var Minimum distance between footer and bottom page margin.
	 * @access protected
	 */
	protected $footer_margin;

	/**
	 * @var original left margin value
	 * @access protected
	 * @since 1.53.0.TC013
	 */
	protected $original_lMargin;

	/**
	 * @var original right margin value
	 * @access protected
	 * @since 1.53.0.TC013
	 */
	protected $original_rMargin;

	/**
	 * @var Header font.
	 * @access protected
	 */
	protected $header_font;

	/**
	 * @var Footer font.
	 * @access protected
	 */
	protected $footer_font;

	/**
	 * @var Language templates.
	 * @access protected
	 */
	protected $l;

	/**
	 * @var Barcode to print on page footer (only if set).
	 * @access protected
	 */
	protected $barcode = false;

	/**
	 * @var If true prints header
	 * @access protected
	 */
	protected $print_header = true;

	/**
	 * @var If true prints footer.
	 * @access protected
	 */
	protected $print_footer = true;

	/**
	 * @var Header image logo.
	 * @access protected
	 */
	protected $header_logo = '';

	/**
	 * @var Header image logo width in mm.
	 * @access protected
	 */
	protected $header_logo_width = 30;

	/**
	 * @var String to print as title on document header.
	 * @access protected
	 */
	protected $header_title = '';

	/**
	 * @var String to print on document header.
	 * @access protected
	 */
	protected $header_string = '';

	/**
	 * @var Default number of columns for html table.
	 * @access protected
	 */
	protected $default_table_columns = 4;

	// variables for html parser

	/**
	 * @var HTML PARSER: array to store current link and rendering styles.
	 * @access protected
	 */
	protected $HREF = array();

	/**
	 * @var store a list of available fonts on filesystem.
	 * @access protected
	 */
	protected $fontlist = array();

	/**
	 * @var current foreground color
	 * @access protected
	 */
	protected $fgcolor;

	/**
	 * @var HTML PARSER: array of boolean values, true in case of ordered list (OL), false otherwise.
	 * @access protected
	 */
	protected $listordered = array();

	/**
	 * @var HTML PARSER: array count list items on nested lists.
	 * @access protected
	 */
	protected $listcount = array();

	/**
	 * @var HTML PARSER: current list nesting level.
	 * @access protected
	 */
	protected $listnum = 0;

	/**
	 * @var HTML PARSER: indent amount for lists.
	 * @access protected
	 */
	protected $listindent = 0;

	/**
	 * @var HTML PARSER: current list indententation level.
	 * @access protected
	 */
	protected $listindentlevel = 0;

	/**
	 * @var current background color
	 * @access protected
	 */
	protected $bgcolor;

	/**
	 * @var Store temporary font size in points.
	 * @access protected
	 */
	protected $tempfontsize = 10;

	/**
	 * @var spacer for LI tags.
	 * @access protected
	 */
	protected $lispacer = '';

	/**
	 * @var default encoding
	 * @access protected
	 * @since 1.53.0.TC010
	 */
	protected $encoding = 'UTF-8';

	/**
	 * @var PHP internal encoding
	 * @access protected
	 * @since 1.53.0.TC016
	 */
	protected $internal_encoding;

	/**
	 * @var indicates if the document language is Right-To-Left
	 * @access protected
	 * @since 2.0.000
	 */
	protected $rtl = false;

	/**
	 * @var used to force RTL or LTR string inversion
	 * @access protected
	 * @since 2.0.000
	 */
	protected $tmprtl = false;

	// --- Variables used for document encryption:

	/**
	 * Indicates whether document is protected
	 * @access protected
	 * @since 2.0.000 (2008-01-02)
	 */
	protected $encrypted;

	/**
	 * Array containing encryption settings
	 * @access protected
	 * @since 5.0.005 (2010-05-11)
	 */
	protected $encryptdata = array();

	/**
	 * last RC4 key encrypted (cached for optimisation)
	 * @access protected
	 * @since 2.0.000 (2008-01-02)
	 */
	protected $last_enc_key;

	/**
	 * last RC4 computed key
	 * @access protected
	 * @since 2.0.000 (2008-01-02)
	 */
	protected $last_enc_key_c;

	/**
	 * Encryption padding
	 * @access protected
	 */
	protected $enc_padding = "\x28\xBF\x4E\x5E\x4E\x75\x8A\x41\x64\x00\x4E\x56\xFF\xFA\x01\x08\x2E\x2E\x00\xB6\xD0\x68\x3E\x80\x2F\x0C\xA9\xFE\x64\x53\x69\x7A";

	/**
	 * File ID (used on trailer)
	 * @access protected
	 * @since 5.0.005 (2010-05-12)
	 */
	protected $file_id;

	// --- bookmark ---

	/**
	 * Outlines for bookmark
	 * @access protected
	 * @since 2.1.002 (2008-02-12)
	 */
	protected $outlines = array();

	/**
	 * Outline root for bookmark
	 * @access protected
	 * @since 2.1.002 (2008-02-12)
	 */
	protected $OutlineRoot;

	// --- javascript and form ---

	/**
	 * javascript code
	 * @access protected
	 * @since 2.1.002 (2008-02-12)
	 */
	protected $javascript = '';

	/**
	 * javascript counter
	 * @access protected
	 * @since 2.1.002 (2008-02-12)
	 */
	protected $n_js;

	/**
	 * line trough state
	 * @access protected
	 * @since 2.8.000 (2008-03-19)
	 */
	protected $linethrough;

	/**
	 * Array with additional document-wide usage rights for the document.
	 * @access protected
	 * @since 5.8.014 (2010-08-23)
	 */
	protected $ur = array();

	/**
	 * Dot Per Inch Document Resolution (do not change)
	 * @access protected
	 * @since 3.0.000 (2008-03-27)
	 */
	protected $dpi = 72;

	/**
	 * Array of page numbers were a new page group was started
	 * @access protected
	 * @since 3.0.000 (2008-03-27)
	 */
	protected $newpagegroup = array();

	/**
	 * Contains the number of pages of the groups
	 * @access protected
	 * @since 3.0.000 (2008-03-27)
	 */
	protected $pagegroups;

	/**
	 * Contains the alias of the current page group
	 * @access protected
	 * @since 3.0.000 (2008-03-27)
	 */
	protected $currpagegroup;

	/**
	 * Restrict the rendering of some elements to screen or printout.
	 * @access protected
	 * @since 3.0.000 (2008-03-27)
	 */
	protected $visibility = 'all';

	/**
	 * Print visibility.
	 * @access protected
	 * @since 3.0.000 (2008-03-27)
	 */
	protected $n_ocg_print;

	/**
	 * View visibility.
	 * @access protected
	 * @since 3.0.000 (2008-03-27)
	 */
	protected $n_ocg_view;

	/**
	 * Array of transparency objects and parameters.
	 * @access protected
	 * @since 3.0.000 (2008-03-27)
	 */
	protected $extgstates;

	/**
	 * Set the default JPEG compression quality (1-100)
	 * @access protected
	 * @since 3.0.000 (2008-03-27)
	 */
	protected $jpeg_quality;

	/**
	 * Default cell height ratio.
	 * @access protected
	 * @since 3.0.014 (2008-05-23)
	 */
	protected $cell_height_ratio = K_CELL_HEIGHT_RATIO;

	/**
	 * PDF viewer preferences.
	 * @access protected
	 * @since 3.1.000 (2008-06-09)
	 */
	protected $viewer_preferences;

	/**
	 * A name object specifying how the document should be displayed when opened.
	 * @access protected
	 * @since 3.1.000 (2008-06-09)
	 */
	protected $PageMode;

	/**
	 * Array for storing gradient information.
	 * @access protected
	 * @since 3.1.000 (2008-06-09)
	 */
	protected $gradients = array();

	/**
	 * Array used to store positions inside the pages buffer.
	 * keys are the page numbers
	 * @access protected
	 * @since 3.2.000 (2008-06-26)
	 */
	protected $intmrk = array();

	/**
	 * Array used to store positions inside the pages buffer.
	 * keys are the page numbers
	 * @access protected
	 * @since 5.7.000 (2010-08-03)
	 */
	protected $bordermrk = array();

	/**
	 * Array used to store page positions to track empty pages.
	 * keys are the page numbers
	 * @access protected
	 * @since 5.8.007 (2010-08-18)
	 */
	protected $emptypagemrk = array();

	/**
	 * Array used to store content positions inside the pages buffer.
	 * keys are the page numbers
	 * @access protected
	 * @since 4.6.021 (2009-07-20)
	 */
	protected $cntmrk = array();

	/**
	 * Array used to store footer positions of each page.
	 * @access protected
	 * @since 3.2.000 (2008-07-01)
	 */
	protected $footerpos = array();

	/**
	 * Array used to store footer length of each page.
	 * @access protected
	 * @since 4.0.014 (2008-07-29)
	 */
	protected $footerlen = array();

	/**
	 * True if a newline is created.
	 * @access protected
	 * @since 3.2.000 (2008-07-01)
	 */
	protected $newline = true;

	/**
	 * End position of the latest inserted line
	 * @access protected
	 * @since 3.2.000 (2008-07-01)
	 */
	protected $endlinex = 0;

	/**
	 * PDF string for last line width
	 * @access protected
	 * @since 4.0.006 (2008-07-16)
	 */
	protected $linestyleWidth = '';

	/**
	 * PDF string for last line width
	 * @access protected
	 * @since 4.0.006 (2008-07-16)
	 */
	protected $linestyleCap = '0 J';

	/**
	 * PDF string for last line width
	 * @access protected
	 * @since 4.0.006 (2008-07-16)
	 */
	protected $linestyleJoin = '0 j';

	/**
	 * PDF string for last line width
	 * @access protected
	 * @since 4.0.006 (2008-07-16)
	 */
	protected $linestyleDash = '[] 0 d';

	/**
	 * True if marked-content sequence is open
	 * @access protected
	 * @since 4.0.013 (2008-07-28)
	 */
	protected $openMarkedContent = false;

	/**
	 * Count the latest inserted vertical spaces on HTML
	 * @access protected
	 * @since 4.0.021 (2008-08-24)
	 */
	protected $htmlvspace = 0;

	/**
	 * Array of Spot colors
	 * @access protected
	 * @since 4.0.024 (2008-09-12)
	 */
	protected $spot_colors = array();

	/**
	 * Symbol used for HTML unordered list items
	 * @access protected
	 * @since 4.0.028 (2008-09-26)
	 */
	protected $lisymbol = '';

	/**
	 * String used to mark the beginning and end of EPS image blocks
	 * @access protected
	 * @since 4.1.000 (2008-10-18)
	 */
	protected $epsmarker = 'x#!#EPS#!#x';

	/**
	 * Array of transformation matrix
	 * @access protected
	 * @since 4.2.000 (2008-10-29)
	 */
	protected $transfmatrix = array();

	/**
	 * Current key for transformation matrix
	 * @access protected
	 * @since 4.8.005 (2009-09-17)
	 */
	protected $transfmatrix_key = 0;

	/**
	 * Booklet mode for double-sided pages
	 * @access protected
	 * @since 4.2.000 (2008-10-29)
	 */
	protected $booklet = false;

	/**
	 * Epsilon value used for float calculations
	 * @access protected
	 * @since 4.2.000 (2008-10-29)
	 */
	protected $feps = 0.005;

	/**
	 * Array used for custom vertical spaces for HTML tags
	 * @access protected
	 * @since 4.2.001 (2008-10-30)
	 */
	protected $tagvspaces = array();

	/**
	 * @var HTML PARSER: custom indent amount for lists.
	 * Negative value means disabled.
	 * @access protected
	 * @since 4.2.007 (2008-11-12)
	 */
	protected $customlistindent = -1;

	/**
	 * @var if true keeps the border open for the cell sides that cross the page.
	 * @access protected
	 * @since 4.2.010 (2008-11-14)
	 */
	protected $opencell = true;

	/**
	 * @var array of files to embedd
	 * @access protected
	 * @since 4.4.000 (2008-12-07)
	 */
	protected $embeddedfiles = array();

	/**
	 * @var boolean true when inside html pre tag
	 * @access protected
	 * @since 4.4.001 (2008-12-08)
	 */
	protected $premode = false;

	/**
	 * Array used to store positions of graphics transformation blocks inside the page buffer.
	 * keys are the page numbers
	 * @access protected
	 * @since 4.4.002 (2008-12-09)
	 */
	protected $transfmrk = array();

	/**
	 * Default color for html links
	 * @access protected
	 * @since 4.4.003 (2008-12-09)
	 */
	protected $htmlLinkColorArray = array(0, 0, 255);

	/**
	 * Default font style to add to html links
	 * @access protected
	 * @since 4.4.003 (2008-12-09)
	 */
	protected $htmlLinkFontStyle = 'U';

	/**
	 * Counts the number of pages.
	 * @access protected
	 * @since 4.5.000 (2008-12-31)
	 */
	protected $numpages = 0;

	/**
	 * Array containing page lengths in bytes.
	 * @access protected
	 * @since 4.5.000 (2008-12-31)
	 */
	protected $pagelen = array();

	/**
	 * Counts the number of pages.
	 * @access protected
	 * @since 4.5.000 (2008-12-31)
	 */
	protected $numimages = 0;

	/**
	 * Store the image keys.
	 * @access protected
	 * @since 4.5.000 (2008-12-31)
	 */
	protected $imagekeys = array();

	/**
	 * Length of the buffer in bytes.
	 * @access protected
	 * @since 4.5.000 (2008-12-31)
	 */
	protected $bufferlen = 0;

	/**
	 * If true enables disk caching.
	 * @access protected
	 * @since 4.5.000 (2008-12-31)
	 */
	protected $diskcache = false;

	/**
	 * Counts the number of fonts.
	 * @access protected
	 * @since 4.5.000 (2009-01-02)
	 */
	protected $numfonts = 0;

	/**
	 * Store the font keys.
	 * @access protected
	 * @since 4.5.000 (2009-01-02)
	 */
	protected $fontkeys = array();

	/**
	 * Store the font object IDs.
	 * @access protected
	 * @since 4.8.001 (2009-09-09)
	 */
	protected $font_obj_ids = array();

	/**
	 * Store the fage status (true when opened, false when closed).
	 * @access protected
	 * @since 4.5.000 (2009-01-02)
	 */
	protected $pageopen = array();

	/**
	 * Default monospaced font
	 * @access protected
	 * @since 4.5.025 (2009-03-10)
	 */
	protected $default_monospaced_font = 'courier';

	/**
	 * Used to store a cloned copy of the current class object
	 * @access protected
	 * @since 4.5.029 (2009-03-19)
	 */
	protected $objcopy;

	/**
	 * Array used to store the lengths of cache files
	 * @access protected
	 * @since 4.5.029 (2009-03-19)
	 */
	protected $cache_file_length = array();

	/**
	 * Table header content to be repeated on each new page
	 * @access protected
	 * @since 4.5.030 (2009-03-20)
	 */
	protected $thead = '';

	/**
	 * Margins used for table header.
	 * @access protected
	 * @since 4.5.030 (2009-03-20)
	 */
	protected $theadMargins = array();

	/**
	 * Cache array for UTF8StringToArray() method.
	 * @access protected
	 * @since 4.5.037 (2009-04-07)
	 */
	protected $cache_UTF8StringToArray = array();

	/**
	 * Maximum size of cache array used for UTF8StringToArray() method.
	 * @access protected
	 * @since 4.5.037 (2009-04-07)
	 */
	protected $cache_maxsize_UTF8StringToArray = 8;

	/**
	 * Current size of cache array used for UTF8StringToArray() method.
	 * @access protected
	 * @since 4.5.037 (2009-04-07)
	 */
	protected $cache_size_UTF8StringToArray = 0;

	/**
	 * If true enables document signing
	 * @access protected
	 * @since 4.6.005 (2009-04-24)
	 */
	protected $sign = false;

	/**
	 * Signature data
	 * @access protected
	 * @since 4.6.005 (2009-04-24)
	 */
	protected $signature_data = array();

	/**
	 * Signature max length
	 * @access protected
	 * @since 4.6.005 (2009-04-24)
	 */
	protected $signature_max_length = 11742;

	/**
	 * data for signature appearance
	 * @access protected
	 * @since 5.3.011 (2010-06-16)
	 */
	protected $signature_appearance = array('page' => 1, 'rect' => '0 0 0 0');

	/**
	 * Regular expression used to find blank characters used for word-wrapping.
	 * @access protected
	 * @since 4.6.006 (2009-04-28)
	 */
	protected $re_spaces = '/[^\S\xa0]/';

	/**
	 * Array of parts $re_spaces
	 * @access protected
	 * @since 5.5.011 (2010-07-09)
	 */
	protected $re_space = array('p' => '[^\S\xa0]', 'm' => '');

	/**
	 * Signature object ID
	 * @access protected
	 * @since 4.6.022 (2009-06-23)
	 */
	protected $sig_obj_id = 0;

	/**
	 * ByteRange placemark used during signature process.
	 * @access protected
	 * @since 4.6.028 (2009-08-25)
	 */
	protected $byterange_string = '/ByteRange[0 ********** ********** **********]';

	/**
	 * Placemark used during signature process.
	 * @access protected
	 * @since 4.6.028 (2009-08-25)
	 */
	protected $sig_annot_ref = '***SIGANNREF*** 0 R';

	/**
	 * ID of page objects
	 * @access protected
	 * @since 4.7.000 (2009-08-29)
	 */
	protected $page_obj_id = array();

	/**
	 * List of form annotations IDs
	 * @access protected
	 * @since 4.8.000 (2009-09-07)
	 */
	protected $form_obj_id = array();

	/**
	 * Deafult Javascript field properties. Possible values are described on official Javascript for Acrobat API reference. Annotation options can be directly specified using the 'aopt' entry.
	 * @access protected
	 * @since 4.8.000 (2009-09-07)
	 */
	protected $default_form_prop = array('lineWidth'=>1, 'borderStyle'=>'solid', 'fillColor'=>array(255, 255, 255), 'strokeColor'=>array(128, 128, 128));

	/**
	 * Javascript objects array
	 * @access protected
	 * @since 4.8.000 (2009-09-07)
	 */
	protected $js_objects = array();

	/**
	 * Current form action (used during XHTML rendering)
	 * @access protected
	 * @since 4.8.000 (2009-09-07)
	 */
	protected $form_action = '';

	/**
	 * Current form encryption type (used during XHTML rendering)
	 * @access protected
	 * @since 4.8.000 (2009-09-07)
	 */
	protected $form_enctype = 'application/x-www-form-urlencoded';

	/**
	 * Current method to submit forms.
	 * @access protected
	 * @since 4.8.000 (2009-09-07)
	 */
	protected $form_mode = 'post';

	/**
	 * List of fonts used on form fields (fontname => fontkey).
	 * @access protected
	 * @since 4.8.001 (2009-09-09)
	 */
	protected $annotation_fonts = array();

	/**
	 * List of radio buttons parent objects.
	 * @access protected
	 * @since 4.8.001 (2009-09-09)
	 */
	protected $radiobutton_groups = array();

	/**
	 * List of radio group objects IDs
	 * @access protected
	 * @since 4.8.001 (2009-09-09)
	 */
	protected $radio_groups = array();

	/**
	 * Text indentation value (used for text-indent CSS attribute)
	 * @access protected
	 * @since 4.8.006 (2009-09-23)
	 */
	protected $textindent = 0;

	/**
	 * Store page number when startTransaction() is called.
	 * @access protected
	 * @since 4.8.006 (2009-09-23)
	 */
	protected $start_transaction_page = 0;

	/**
	 * Store Y position when startTransaction() is called.
	 * @access protected
	 * @since 4.9.001 (2010-03-28)
	 */
	protected $start_transaction_y = 0;

	/**
	 * True when we are printing the thead section on a new page
	 * @access protected
	 * @since 4.8.027 (2010-01-25)
	 */
	protected $inthead = false;

	/**
	 * Array of column measures (width, space, starting Y position)
	 * @access protected
	 * @since 4.9.001 (2010-03-28)
	 */
	protected $columns = array();

	/**
	 * Number of colums
	 * @access protected
	 * @since 4.9.001 (2010-03-28)
	 */
	protected $num_columns = 1;

	/**
	 * Current column number
	 * @access protected
	 * @since 4.9.001 (2010-03-28)
	 */
	protected $current_column = 0;

	/**
	 * Starting page for columns
	 * @access protected
	 * @since 4.9.001 (2010-03-28)
	 */
	protected $column_start_page = 0;

	/**
	 * Maximum page and column selected
	 * @access protected
	 * @since 5.8.000 (2010-08-11)
	 */
	protected $maxselcol = array('page' => 0, 'column' => 0);

	/**
	 * Array of: X difference between table cell x start and starting page margin, cellspacing, cellpadding
	 * @access protected
	 * @since 5.8.000 (2010-08-11)
	 */
	protected $colxshift = array('x' => 0, 's' => 0, 'p' => 0);

	/**
	 * Text rendering mode: 0 = Fill text; 1 = Stroke text; 2 = Fill, then stroke text; 3 = Neither fill nor stroke text (invisible); 4 = Fill text and add to path for clipping; 5 = Stroke text and add to path for clipping; 6 = Fill, then stroke text and add to path for clipping; 7 = Add text to path for clipping.
	 * @access protected
	 * @since 4.9.008 (2010-04-03)
	 */
	protected $textrendermode = 0;

	/**
	 * Text stroke width in doc units
	 * @access protected
	 * @since 4.9.008 (2010-04-03)
	 */
	protected $textstrokewidth = 0;

	/**
	 * @var current stroke color
	 * @access protected
	 * @since 4.9.008 (2010-04-03)
	 */
	protected $strokecolor;

	/**
	 * @var default unit of measure for document
	 * @access protected
	 * @since 5.0.000 (2010-04-22)
	 */
	protected $pdfunit = 'mm';

	/**
	 * @var true when we are on TOC (Table Of Content) page
	 * @access protected
	 */
	protected $tocpage = false;

	/**
	 * @var If true convert vector images (SVG, EPS) to raster image using GD or ImageMagick library.
	 * @access protected
	 * @since 5.0.000 (2010-04-26)
	 */
	protected $rasterize_vector_images = false;

	/**
	 * @var If true enables font subsetting by default
	 * @access protected
	 * @since 5.3.002 (2010-06-07)
	 */
	protected $font_subsetting = true;

	/**
	 * @var Array of default graphic settings
	 * @access protected
	 * @since 5.5.008 (2010-07-02)
	 */
	protected $default_graphic_vars = array();

	/**
	 * @var Array of XObjects
	 * @access protected
	 * @since 5.8.014 (2010-08-23)
	 */
	protected $xobjects = array();

	/**
	 * @var boolean true when we are inside an XObject
	 * @access protected
	 * @since 5.8.017 (2010-08-24)
	 */
	protected $inxobj = false;

	/**
	 * @var current XObject ID
	 * @access protected
	 * @since 5.8.017 (2010-08-24)
	 */
	protected $xobjid = '';

	/**
	 * @var percentage of character stretching
	 * @access protected
	 * @since 5.9.000 (2010-09-29)
	 */
	protected $font_stretching = 100;

	/**
	 * @var increases or decreases the space between characters in a text by the specified amount (tracking/kerning).
	 * @access protected
	 * @since 5.9.000 (2010-09-29)
	 */
	protected $font_spacing = 0;

	/**
	 * @var array of no-write regions
	 * ('page' => page number or empy for current page, 'xt' => X top, 'yt' => Y top, 'xb' => X bottom, 'yb' => Y bottom, 'side' => page side 'L' = left or 'R' = right)
	 * @access protected
	 * @since 5.9.003 (2010-10-14)
	 */
	protected $page_regions = array();

	/**
	 * @var array containing HTML color names and values
	 * @access protected
	 * @since 5.9.004 (2010-10-18)
	 */
	protected $webcolor = array();

	/**
	 * @var directory used for the last SVG image
	 * @access protected
	 * @since 5.0.000 (2010-05-05)
	 */
	protected $svgdir = '';

	/**
	 * @var Deafult unit of measure for SVG
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svgunit = 'px';

	/**
	 * @var array of SVG gradients
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svggradients = array();

	/**
	 * @var ID of last SVG gradient
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svggradientid = 0;

	/**
	 * @var true when in SVG defs group
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svgdefsmode = false;

	/**
	 * @var array of SVG defs
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svgdefs = array();

	/**
	 * @var true when in SVG clipPath tag
	 * @access protected
	 * @since 5.0.000 (2010-04-26)
	 */
	protected $svgclipmode = false;

	/**
	 * @var array of SVG clipPath commands
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svgclippaths = array();

	/**
	 * @var array of SVG clipPath tranformation matrix
	 * @access protected
	 * @since 5.8.022 (2010-08-31)
	 */
	protected $svgcliptm = array();

	/**
	 * @var ID of last SVG clipPath
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svgclipid = 0;

	/**
	 * @var svg text
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svgtext = '';

	/**
	 * @var svg text properties
	 * @access protected
	 * @since 5.8.013 (2010-08-23)
	 */
	protected $svgtextmode = array();

	/**
	 * @var array of hinheritable SVG properties
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svginheritprop = array('clip-rule', 'color', 'color-interpolation', 'color-interpolation-filters', 'color-profile', 'color-rendering', 'cursor', 'direction', 'fill', 'fill-opacity', 'fill-rule', 'font', 'font-family', 'font-size', 'font-size-adjust', 'font-stretch', 'font-style', 'font-variant', 'font-weight', 'glyph-orientation-horizontal', 'glyph-orientation-vertical', 'image-rendering', 'kerning', 'letter-spacing', 'marker', 'marker-end', 'marker-mid', 'marker-start', 'pointer-events', 'shape-rendering', 'stroke', 'stroke-dasharray', 'stroke-dashoffset', 'stroke-linecap', 'stroke-linejoin', 'stroke-miterlimit', 'stroke-opacity', 'stroke-width', 'text-anchor', 'text-rendering', 'visibility', 'word-spacing', 'writing-mode');

	/**
	 * @var array of SVG properties
	 * @access protected
	 * @since 5.0.000 (2010-05-02)
	 */
	protected $svgstyles = array(array(
		'alignment-baseline' => 'auto',
		'baseline-shift' => 'baseline',
		'clip' => 'auto',
		'clip-path' => 'none',
		'clip-rule' => 'nonzero',
		'color' => 'black',
		'color-interpolation' => 'sRGB',
		'color-interpolation-filters' => 'linearRGB',
		'color-profile' => 'auto',
		'color-rendering' => 'auto',
		'cursor' => 'auto',
		'direction' => 'ltr',
		'display' => 'inline',
		'dominant-baseline' => 'auto',
		'enable-background' => 'accumulate',
		'fill' => 'black',
		'fill-opacity' => 1,
		'fill-rule' => 'nonzero',
		'filter' => 'none',
		'flood-color' => 'black',
		'flood-opacity' => 1,
		'font' => '',
		'font-family' => 'helvetica',
		'font-size' => 'medium',
		'font-size-adjust' => 'none',
		'font-stretch' => 'normal',
		'font-style' => 'normal',
		'font-variant' => 'normal',
		'font-weight' => 'normal',
		'glyph-orientation-horizontal' => '0deg',
		'glyph-orientation-vertical' => 'auto',
		'image-rendering' => 'auto',
		'kerning' => 'auto',
		'letter-spacing' => 'normal',
		'lighting-color' => 'white',
		'marker' => '',
		'marker-end' => 'none',
		'marker-mid' => 'none',
		'marker-start' => 'none',
		'mask' => 'none',
		'opacity' => 1,
		'overflow' => 'auto',
		'pointer-events' => 'visiblePainted',
		'shape-rendering' => 'auto',
		'stop-color' => 'black',
		'stop-opacity' => 1,
		'stroke' => 'none',
		'stroke-dasharray' => 'none',
		'stroke-dashoffset' => 0,
		'stroke-linecap' => 'butt',
		'stroke-linejoin' => 'miter',
		'stroke-miterlimit' => 4,
		'stroke-opacity' => 1,
		'stroke-width' => 1,
		'text-anchor' => 'start',
		'text-decoration' => 'none',
		'text-rendering' => 'auto',
		'unicode-bidi' => 'normal',
		'visibility' => 'visible',
		'word-spacing' => 'normal',
		'writing-mode' => 'lr-tb',
		'text-color' => 'black',
		'transfmatrix' => array(1, 0, 0, 1, 0, 0)
		));

	//------------------------------------------------------------
	// METHODS
	//------------------------------------------------------------

	/**
	 * This is the class constructor.
	 * It allows to set up the page format, the orientation and the measure unit used in all the methods (except for the font sizes).
	 * @param string $orientation page orientation. Possible values are (case insensitive):<ul><li>P or Portrait (default)</li><li>L or Landscape</li><li>'' (empty string) for automatic orientation</li></ul>
	 * @param string $unit User measure unit. Possible values are:<ul><li>pt: point</li><li>mm: millimeter (default)</li><li>cm: centimeter</li><li>in: inch</li></ul><br />A point equals 1/72 of inch, that is to say about 0.35 mm (an inch being 2.54 cm). This is a very common unit in typography; font sizes are expressed in that unit.
	 * @param mixed $format The format used for pages. It can be either: one of the string values specified at getPageSizeFromFormat() or an array of parameters specified at setPageFormat().
	 * @param boolean $unicode TRUE means that the input text is unicode (default = true)
	 * @param boolean $diskcache if TRUE reduce the RAM memory usage by caching temporary data on filesystem (slower).
	 * @param String $encoding charset encoding; default is UTF-8
	 * @access public
	 * @see getPageSizeFromFormat(), setPageFormat()
	 */
	public function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false) {
		/* Set internal character encoding to ASCII */
		if (function_exists('mb_internal_encoding') AND mb_internal_encoding()) {
			$this->internal_encoding = mb_internal_encoding();
			mb_internal_encoding('ASCII');
		}
		require(dirname(__FILE__).'/htmlcolors.php');
		$this->webcolor = $webcolor;
		require_once(dirname(__FILE__).'/unicode_data.php');
		$this->unicode = new TCPDF_UNICODE_DATA();
		$this->font_obj_ids = array();
		$this->page_obj_id = array();
		$this->form_obj_id = array();
		// set disk caching
		$this->diskcache = $diskcache ? true : false;
		// set language direction
		$this->rtl = false;
		$this->tmprtl = false;
		// some checks
		$this->_dochecks();
		// initialization of properties
		$this->isunicode = $unicode;
		$this->page = 0;
		$this->transfmrk[0] = array();
		$this->pagedim = array();
		$this->n = 2;
		$this->buffer = '';
		$this->pages = array();
		$this->state = 0;
		$this->fonts = array();
		$this->FontFiles = array();
		$this->diffs = array();
		$this->images = array();
		$this->links = array();
		$this->gradients = array();
		$this->InFooter = false;
		$this->lasth = 0;
		$this->FontFamily = 'helvetica';
		$this->FontStyle = '';
		$this->FontSizePt = 12;
		$this->underline = false;
		$this->overline = false;
		$this->linethrough = false;
		$this->DrawColor = '0 G';
		$this->FillColor = '0 g';
		$this->TextColor = '0 g';
		$this->ColorFlag = false;
		// encryption values
		$this->encrypted = false;
		$this->last_enc_key = '';
		// standard Unicode fonts
		$this->CoreFonts = array(
			'courier'=>'Courier',
			'courierB'=>'Courier-Bold',
			'courierI'=>'Courier-Oblique',
			'courierBI'=>'Courier-BoldOblique',
			'helvetica'=>'Helvetica',
			'helveticaB'=>'Helvetica-Bold',
			'helveticaI'=>'Helvetica-Oblique',
			'helveticaBI'=>'Helvetica-BoldOblique',
			'times'=>'Times-Roman',
			'timesB'=>'Times-Bold',
			'timesI'=>'Times-Italic',
			'timesBI'=>'Times-BoldItalic',
			'symbol'=>'Symbol',
			'zapfdingbats'=>'ZapfDingbats'
		);
		// set scale factor
		$this->setPageUnit($unit);
		// set page format and orientation
		$this->setPageFormat($format, $orientation);
		// page margins (1 cm)
		$margin = 28.35 / $this->k;
		$this->SetMargins($margin, $margin);
		// internal cell padding
		$cpadding = $margin / 10;
		$this->setCellPaddings($cpadding, 0, $cpadding, 0);
		// cell margins
		$this->setCellMargins(0, 0, 0, 0);
		// line width (0.2 mm)
		$this->LineWidth = 0.57 / $this->k;
		$this->linestyleWidth = sprintf('%.2F w', ($this->LineWidth * $this->k));
		$this->linestyleCap = '0 J';
		$this->linestyleJoin = '0 j';
		$this->linestyleDash = '[] 0 d';
		// automatic page break
		$this->SetAutoPageBreak(true, (2 * $margin));
		// full width display mode
		$this->SetDisplayMode('fullwidth');
		// compression
		$this->SetCompression(true);
		// set default PDF version number
		$this->PDFVersion = '1.7';
		$this->encoding = $encoding;
		$this->HREF = array();
		$this->getFontsList();
		$this->fgcolor = array('R' => 0, 'G' => 0, 'B' => 0);
		$this->strokecolor = array('R' => 0, 'G' => 0, 'B' => 0);
		$this->bgcolor = array('R' => 255, 'G' => 255, 'B' => 255);
		$this->extgstates = array();
		// user's rights
		$this->sign = false;
		$this->ur['enabled'] = false;
		$this->ur['document'] = '/FullSave';
		$this->ur['annots'] = '/Create/Delete/Modify/Copy/Import/Export';
		$this->ur['form'] = '/Add/Delete/FillIn/Import/Export/SubmitStandalone/SpawnTemplate';
		$this->ur['signature'] = '/Modify';
		$this->ur['ef'] = '/Create/Delete/Modify/Import';
		$this->ur['formex'] = '';
		$this->signature_appearance = array('page' => 1, 'rect' => '0 0 0 0');
		// set default JPEG quality
		$this->jpeg_quality = 75;
		// initialize some settings
		$this->utf8Bidi(array(''), '');
		// set default font
		$this->SetFont($this->FontFamily, $this->FontStyle, $this->FontSizePt);
		// check if PCRE Unicode support is enabled
		if ($this->isunicode AND (@preg_match('/\pL/u', 'a') == 1)) {
			// PCRE unicode support is turned ON
			// \p{Z} or \p{Separator}: any kind of Unicode whitespace or invisible separator.
			// \p{Lo} or \p{Other_Letter}: a Unicode letter or ideograph that does not have lowercase and uppercase variants.
			// \p{Lo} is needed because Chinese characters are packed next to each other without spaces in between.
			//$this->setSpacesRE('/[^\S\P{Z}\P{Lo}\xa0]/u');
			$this->setSpacesRE('/[^\S\P{Z}\xa0]/u');
		} else {
			// PCRE unicode support is turned OFF
			$this->setSpacesRE('/[^\S\xa0]/');
		}
		$this->default_form_prop = array('lineWidth'=>1, 'borderStyle'=>'solid', 'fillColor'=>array(255, 255, 255), 'strokeColor'=>array(128, 128, 128));
		// set file ID for trailer
		$this->file_id = md5($this->getRandomSeed('TCPDF'.$orientation.$unit.$format.$encoding));
		// get default graphic vars
		$this->default_graphic_vars = $this->getGraphicVars();
	}

	/**
	 * Default destructor.
	 * @access public
	 * @since 1.53.0.TC016
	 */
	public function __destruct() {
		// restore internal encoding
		if (isset($this->internal_encoding) AND !empty($this->internal_encoding)) {
			mb_internal_encoding($this->internal_encoding);
		}
		// unset all class variables
		$this->_destroy(true);
	}

	/**
	 * Set the units of measure for the document.
	 * @param string $unit User measure unit. Possible values are:<ul><li>pt: point</li><li>mm: millimeter (default)</li><li>cm: centimeter</li><li>in: inch</li></ul><br />A point equals 1/72 of inch, that is to say about 0.35 mm (an inch being 2.54 cm). This is a very common unit in typography; font sizes are expressed in that unit.
	 * @access public
	 * @since 3.0.015 (2008-06-06)
	 */
	public function setPageUnit($unit) {
		$unit = strtolower($unit);
		//Set scale factor
		switch ($unit) {
			// points
			case 'px':
			case 'pt': {
				$this->k = 1;
				break;
			}
			// millimeters
			case 'mm': {
				$this->k = $this->dpi / 25.4;
				break;
			}
			// centimeters
			case 'cm': {
				$this->k = $this->dpi / 2.54;
				break;
			}
			// inches
			case 'in': {
				$this->k = $this->dpi;
				break;
			}
			// unsupported unit
			default : {
				$this->Error('Incorrect unit: '.$unit);
				break;
			}
		}
		$this->pdfunit = $unit;
		if (isset($this->CurOrientation)) {
			$this->setPageOrientation($this->CurOrientation);
		}
	}

	/**
	 * Get page dimensions from format name.
	 * @param mixed $format The format name. It can be: <ul>
	 * <li><b>ISO 216 A Series + 2 SIS 014711 extensions</b></li>
	 * <li>A0 (841x1189 mm ; 33.11x46.81 in)</li>
	 * <li>A1 (594x841 mm ; 23.39x33.11 in)</li>
	 * <li>A2 (420x594 mm ; 16.54x23.39 in)</li>
	 * <li>A3 (297x420 mm ; 11.69x16.54 in)</li>
	 * <li>A4 (210x297 mm ; 8.27x11.69 in)</li>
	 * <li>A5 (148x210 mm ; 5.83x8.27 in)</li>
	 * <li>A6 (105x148 mm ; 4.13x5.83 in)</li>
	 * <li>A7 (74x105 mm ; 2.91x4.13 in)</li>
	 * <li>A8 (52x74 mm ; 2.05x2.91 in)</li>
	 * <li>A9 (37x52 mm ; 1.46x2.05 in)</li>
	 * <li>A10 (26x37 mm ; 1.02x1.46 in)</li>
	 * <li>A11 (18x26 mm ; 0.71x1.02 in)</li>
	 * <li>A12 (13x18 mm ; 0.51x0.71 in)</li>
	 * <li><b>ISO 216 B Series + 2 SIS 014711 extensions</b></li>
	 * <li>B0 (1000x1414 mm ; 39.37x55.67 in)</li>
	 * <li>B1 (707x1000 mm ; 27.83x39.37 in)</li>
	 * <li>B2 (500x707 mm ; 19.69x27.83 in)</li>
	 * <li>B3 (353x500 mm ; 13.90x19.69 in)</li>
	 * <li>B4 (250x353 mm ; 9.84x13.90 in)</li>
	 * <li>B5 (176x250 mm ; 6.93x9.84 in)</li>
	 * <li>B6 (125x176 mm ; 4.92x6.93 in)</li>
	 * <li>B7 (88x125 mm ; 3.46x4.92 in)</li>
	 * <li>B8 (62x88 mm ; 2.44x3.46 in)</li>
	 * <li>B9 (44x62 mm ; 1.73x2.44 in)</li>
	 * <li>B10 (31x44 mm ; 1.22x1.73 in)</li>
	 * <li>B11 (22x31 mm ; 0.87x1.22 in)</li>
	 * <li>B12 (15x22 mm ; 0.59x0.87 in)</li>
	 * <li><b>ISO 216 C Series + 2 SIS 014711 extensions + 2 EXTENSION</b></li>
	 * <li>C0 (917x1297 mm ; 36.10x51.06 in)</li>
	 * <li>C1 (648x917 mm ; 25.51x36.10 in)</li>
	 * <li>C2 (458x648 mm ; 18.03x25.51 in)</li>
	 * <li>C3 (324x458 mm ; 12.76x18.03 in)</li>
	 * <li>C4 (229x324 mm ; 9.02x12.76 in)</li>
	 * <li>C5 (162x229 mm ; 6.38x9.02 in)</li>
	 * <li>C6 (114x162 mm ; 4.49x6.38 in)</li>
	 * <li>C7 (81x114 mm ; 3.19x4.49 in)</li>
	 * <li>C8 (57x81 mm ; 2.24x3.19 in)</li>
	 * <li>C9 (40x57 mm ; 1.57x2.24 in)</li>
	 * <li>C10 (28x40 mm ; 1.10x1.57 in)</li>
	 * <li>C11 (20x28 mm ; 0.79x1.10 in)</li>
	 * <li>C12 (14x20 mm ; 0.55x0.79 in)</li>
	 * <li>C76 (81x162 mm ; 3.19x6.38 in)</li>
	 * <li>DL (110x220 mm ; 4.33x8.66 in)</li>
	 * <li><b>SIS 014711 E Series</b></li>
	 * <li>E0 (879x1241 mm ; 34.61x48.86 in)</li>
	 * <li>E1 (620x879 mm ; 24.41x34.61 in)</li>
	 * <li>E2 (440x620 mm ; 17.32x24.41 in)</li>
	 * <li>E3 (310x440 mm ; 12.20x17.32 in)</li>
	 * <li>E4 (220x310 mm ; 8.66x12.20 in)</li>
	 * <li>E5 (155x220 mm ; 6.10x8.66 in)</li>
	 * <li>E6 (110x155 mm ; 4.33x6.10 in)</li>
	 * <li>E7 (78x110 mm ; 3.07x4.33 in)</li>
	 * <li>E8 (55x78 mm ; 2.17x3.07 in)</li>
	 * <li>E9 (39x55 mm ; 1.54x2.17 in)</li>
	 * <li>E10 (27x39 mm ; 1.06x1.54 in)</li>
	 * <li>E11 (19x27 mm ; 0.75x1.06 in)</li>
	 * <li>E12 (13x19 mm ; 0.51x0.75 in)</li>
	 * <li><b>SIS 014711 G Series</b></li>
	 * <li>G0 (958x1354 mm ; 37.72x53.31 in)</li>
	 * <li>G1 (677x958 mm ; 26.65x37.72 in)</li>
	 * <li>G2 (479x677 mm ; 18.86x26.65 in)</li>
	 * <li>G3 (338x479 mm ; 13.31x18.86 in)</li>
	 * <li>G4 (239x338 mm ; 9.41x13.31 in)</li>
	 * <li>G5 (169x239 mm ; 6.65x9.41 in)</li>
	 * <li>G6 (119x169 mm ; 4.69x6.65 in)</li>
	 * <li>G7 (84x119 mm ; 3.31x4.69 in)</li>
	 * <li>G8 (59x84 mm ; 2.32x3.31 in)</li>
	 * <li>G9 (42x59 mm ; 1.65x2.32 in)</li>
	 * <li>G10 (29x42 mm ; 1.14x1.65 in)</li>
	 * <li>G11 (21x29 mm ; 0.83x1.14 in)</li>
	 * <li>G12 (14x21 mm ; 0.55x0.83 in)</li>
	 * <li><b>ISO Press</b></li>
	 * <li>RA0 (860x1220 mm ; 33.86x48.03 in)</li>
	 * <li>RA1 (610x860 mm ; 24.02x33.86 in)</li>
	 * <li>RA2 (430x610 mm ; 16.93x24.02 in)</li>
	 * <li>RA3 (305x430 mm ; 12.01x16.93 in)</li>
	 * <li>RA4 (215x305 mm ; 8.46x12.01 in)</li>
	 * <li>SRA0 (900x1280 mm ; 35.43x50.39 in)</li>
	 * <li>SRA1 (640x900 mm ; 25.20x35.43 in)</li>
	 * <li>SRA2 (450x640 mm ; 17.72x25.20 in)</li>
	 * <li>SRA3 (320x450 mm ; 12.60x17.72 in)</li>
	 * <li>SRA4 (225x320 mm ; 8.86x12.60 in)</li>
	 * <li><b>German DIN 476</b></li>
	 * <li>4A0 (1682x2378 mm ; 66.22x93.62 in)</li>
	 * <li>2A0 (1189x1682 mm ; 46.81x66.22 in)</li>
	 * <li><b>Variations on the ISO Standard</b></li>
	 * <li>A2_EXTRA (445x619 mm ; 17.52x24.37 in)</li>
	 * <li>A3+ (329x483 mm ; 12.95x19.02 in)</li>
	 * <li>A3_EXTRA (322x445 mm ; 12.68x17.52 in)</li>
	 * <li>A3_SUPER (305x508 mm ; 12.01x20.00 in)</li>
	 * <li>SUPER_A3 (305x487 mm ; 12.01x19.17 in)</li>
	 * <li>A4_EXTRA (235x322 mm ; 9.25x12.68 in)</li>
	 * <li>A4_SUPER (229x322 mm ; 9.02x12.68 in)</li>
	 * <li>SUPER_A4 (227x356 mm ; 8.94x14.02 in)</li>
	 * <li>A4_LONG (210x348 mm ; 8.27x13.70 in)</li>
	 * <li>F4 (210x330 mm ; 8.27x12.99 in)</li>
	 * <li>SO_B5_EXTRA (202x276 mm ; 7.95x10.87 in)</li>
	 * <li>A5_EXTRA (173x235 mm ; 6.81x9.25 in)</li>
	 * <li><b>ANSI Series</b></li>
	 * <li>ANSI_E (864x1118 mm ; 34.00x44.00 in)</li>
	 * <li>ANSI_D (559x864 mm ; 22.00x34.00 in)</li>
	 * <li>ANSI_C (432x559 mm ; 17.00x22.00 in)</li>
	 * <li>ANSI_B (279x432 mm ; 11.00x17.00 in)</li>
	 * <li>ANSI_A (216x279 mm ; 8.50x11.00 in)</li>
	 * <li><b>Traditional 'Loose' North American Paper Sizes</b></li>
	 * <li>LEDGER, USLEDGER (432x279 mm ; 17.00x11.00 in)</li>
	 * <li>TABLOID, USTABLOID, BIBLE, ORGANIZERK (279x432 mm ; 11.00x17.00 in)</li>
	 * <li>LETTER, USLETTER, ORGANIZERM (216x279 mm ; 8.50x11.00 in)</li>
	 * <li>LEGAL, USLEGAL (216x356 mm ; 8.50x14.00 in)</li>
	 * <li>GLETTER, GOVERNMENTLETTER (203x267 mm ; 8.00x10.50 in)</li>
	 * <li>JLEGAL, JUNIORLEGAL (203x127 mm ; 8.00x5.00 in)</li>
	 * <li><b>Other North American Paper Sizes</b></li>
	 * <li>QUADDEMY (889x1143 mm ; 35.00x45.00 in)</li>
	 * <li>SUPER_B (330x483 mm ; 13.00x19.00 in)</li>
	 * <li>QUARTO (229x279 mm ; 9.00x11.00 in)</li>
	 * <li>FOLIO, GOVERNMENTLEGAL (216x330 mm ; 8.50x13.00 in)</li>
	 * <li>EXECUTIVE, MONARCH (184x267 mm ; 7.25x10.50 in)</li>
	 * <li>MEMO, STATEMENT, ORGANIZERL (140x216 mm ; 5.50x8.50 in)</li>
	 * <li>FOOLSCAP (210x330 mm ; 8.27x13.00 in)</li>
	 * <li>COMPACT (108x171 mm ; 4.25x6.75 in)</li>
	 * <li>ORGANIZERJ (70x127 mm ; 2.75x5.00 in)</li>
	 * <li><b>Canadian standard CAN 2-9.60M</b></li>
	 * <li>P1 (560x860 mm ; 22.05x33.86 in)</li>
	 * <li>P2 (430x560 mm ; 16.93x22.05 in)</li>
	 * <li>P3 (280x430 mm ; 11.02x16.93 in)</li>
	 * <li>P4 (215x280 mm ; 8.46x11.02 in)</li>
	 * <li>P5 (140x215 mm ; 5.51x8.46 in)</li>
	 * <li>P6 (107x140 mm ; 4.21x5.51 in)</li>
	 * <li><b>North American Architectural Sizes</b></li>
	 * <li>ARCH_E (914x1219 mm ; 36.00x48.00 in)</li>
	 * <li>ARCH_E1 (762x1067 mm ; 30.00x42.00 in)</li>
	 * <li>ARCH_D (610x914 mm ; 24.00x36.00 in)</li>
	 * <li>ARCH_C, BROADSHEET (457x610 mm ; 18.00x24.00 in)</li>
	 * <li>ARCH_B (305x457 mm ; 12.00x18.00 in)</li>
	 * <li>ARCH_A (229x305 mm ; 9.00x12.00 in)</li>
	 * <li><b>Announcement Envelopes</b></li>
	 * <li>ANNENV_A2 (111x146 mm ; 4.37x5.75 in)</li>
	 * <li>ANNENV_A6 (121x165 mm ; 4.75x6.50 in)</li>
	 * <li>ANNENV_A7 (133x184 mm ; 5.25x7.25 in)</li>
	 * <li>ANNENV_A8 (140x206 mm ; 5.50x8.12 in)</li>
	 * <li>ANNENV_A10 (159x244 mm ; 6.25x9.62 in)</li>
	 * <li>ANNENV_SLIM (98x225 mm ; 3.87x8.87 in)</li>
	 * <li><b>Commercial Envelopes</b></li>
	 * <li>COMMENV_N6_1/4 (89x152 mm ; 3.50x6.00 in)</li>
	 * <li>COMMENV_N6_3/4 (92x165 mm ; 3.62x6.50 in)</li>
	 * <li>COMMENV_N8 (98x191 mm ; 3.87x7.50 in)</li>
	 * <li>COMMENV_N9 (98x225 mm ; 3.87x8.87 in)</li>
	 * <li>COMMENV_N10 (105x241 mm ; 4.12x9.50 in)</li>
	 * <li>COMMENV_N11 (114x263 mm ; 4.50x10.37 in)</li>
	 * <li>COMMENV_N12 (121x279 mm ; 4.75x11.00 in)</li>
	 * <li>COMMENV_N14 (127x292 mm ; 5.00x11.50 in)</li>
	 * <li><b>Catalogue Envelopes</b></li>
	 * <li>CATENV_N1 (152x229 mm ; 6.00x9.00 in)</li>
	 * <li>CATENV_N1_3/4 (165x241 mm ; 6.50x9.50 in)</li>
	 * <li>CATENV_N2 (165x254 mm ; 6.50x10.00 in)</li>
	 * <li>CATENV_N3 (178x254 mm ; 7.00x10.00 in)</li>
	 * <li>CATENV_N6 (191x267 mm ; 7.50x10.50 in)</li>
	 * <li>CATENV_N7 (203x279 mm ; 8.00x11.00 in)</li>
	 * <li>CATENV_N8 (210x286 mm ; 8.25x11.25 in)</li>
	 * <li>CATENV_N9_1/2 (216x267 mm ; 8.50x10.50 in)</li>
	 * <li>CATENV_N9_3/4 (222x286 mm ; 8.75x11.25 in)</li>
	 * <li>CATENV_N10_1/2 (229x305 mm ; 9.00x12.00 in)</li>
	 * <li>CATENV_N12_1/2 (241x318 mm ; 9.50x12.50 in)</li>
	 * <li>CATENV_N13_1/2 (254x330 mm ; 10.00x13.00 in)</li>
	 * <li>CATENV_N14_1/4 (286x311 mm ; 11.25x12.25 in)</li>
	 * <li>CATENV_N14_1/2 (292x368 mm ; 11.50x14.50 in)</li>
	 * <li><b>Japanese (JIS P 0138-61) Standard B-Series</b></li>
	 * <li>JIS_B0 (1030x1456 mm ; 40.55x57.32 in)</li>
	 * <li>JIS_B1 (728x1030 mm ; 28.66x40.55 in)</li>
	 * <li>JIS_B2 (515x728 mm ; 20.28x28.66 in)</li>
	 * <li>JIS_B3 (364x515 mm ; 14.33x20.28 in)</li>
	 * <li>JIS_B4 (257x364 mm ; 10.12x14.33 in)</li>
	 * <li>JIS_B5 (182x257 mm ; 7.17x10.12 in)</li>
	 * <li>JIS_B6 (128x182 mm ; 5.04x7.17 in)</li>
	 * <li>JIS_B7 (91x128 mm ; 3.58x5.04 in)</li>
	 * <li>JIS_B8 (64x91 mm ; 2.52x3.58 in)</li>
	 * <li>JIS_B9 (45x64 mm ; 1.77x2.52 in)</li>
	 * <li>JIS_B10 (32x45 mm ; 1.26x1.77 in)</li>
	 * <li>JIS_B11 (22x32 mm ; 0.87x1.26 in)</li>
	 * <li>JIS_B12 (16x22 mm ; 0.63x0.87 in)</li>
	 * <li><b>PA Series</b></li>
	 * <li>PA0 (840x1120 mm ; 33.07x44.09 in)</li>
	 * <li>PA1 (560x840 mm ; 22.05x33.07 in)</li>
	 * <li>PA2 (420x560 mm ; 16.54x22.05 in)</li>
	 * <li>PA3 (280x420 mm ; 11.02x16.54 in)</li>
	 * <li>PA4 (210x280 mm ; 8.27x11.02 in)</li>
	 * <li>PA5 (140x210 mm ; 5.51x8.27 in)</li>
	 * <li>PA6 (105x140 mm ; 4.13x5.51 in)</li>
	 * <li>PA7 (70x105 mm ; 2.76x4.13 in)</li>
	 * <li>PA8 (52x70 mm ; 2.05x2.76 in)</li>
	 * <li>PA9 (35x52 mm ; 1.38x2.05 in)</li>
	 * <li>PA10 (26x35 mm ; 1.02x1.38 in)</li>
	 * <li><b>Standard Photographic Print Sizes</b></li>
	 * <li>PASSPORT_PHOTO (35x45 mm ; 1.38x1.77 in)</li>
	 * <li>E (82x120 mm ; 3.25x4.72 in)</li>
	 * <li>3R, L (89x127 mm ; 3.50x5.00 in)</li>
	 * <li>4R, KG (102x152 mm ; 4.02x5.98 in)</li>
	 * <li>4D (120x152 mm ; 4.72x5.98 in)</li>
	 * <li>5R, 2L (127x178 mm ; 5.00x7.01 in)</li>
	 * <li>6R, 8P (152x203 mm ; 5.98x7.99 in)</li>
	 * <li>8R, 6P (203x254 mm ; 7.99x10.00 in)</li>
	 * <li>S8R, 6PW (203x305 mm ; 7.99x12.01 in)</li>
	 * <li>10R, 4P (254x305 mm ; 10.00x12.01 in)</li>
	 * <li>S10R, 4PW (254x381 mm ; 10.00x15.00 in)</li>
	 * <li>11R (279x356 mm ; 10.98x14.02 in)</li>
	 * <li>S11R (279x432 mm ; 10.98x17.01 in)</li>
	 * <li>12R (305x381 mm ; 12.01x15.00 in)</li>
	 * <li>S12R (305x456 mm ; 12.01x17.95 in)</li>
	 * <li><b>Common Newspaper Sizes</b></li>
	 * <li>NEWSPAPER_BROADSHEET (750x600 mm ; 29.53x23.62 in)</li>
	 * <li>NEWSPAPER_BERLINER (470x315 mm ; 18.50x12.40 in)</li>
	 * <li>NEWSPAPER_COMPACT, NEWSPAPER_TABLOID (430x280 mm ; 16.93x11.02 in)</li>
	 * <li><b>Business Cards</b></li>
	 * <li>CREDIT_CARD, BUSINESS_CARD, BUSINESS_CARD_ISO7810 (54x86 mm ; 2.13x3.37 in)</li>
	 * <li>BUSINESS_CARD_ISO216 (52x74 mm ; 2.05x2.91 in)</li>
	 * <li>BUSINESS_CARD_IT, BUSINESS_CARD_UK, BUSINESS_CARD_FR, BUSINESS_CARD_DE, BUSINESS_CARD_ES (55x85 mm ; 2.17x3.35 in)</li>
	 * <li>BUSINESS_CARD_US, BUSINESS_CARD_CA (51x89 mm ; 2.01x3.50 in)</li>
	 * <li>BUSINESS_CARD_JP (55x91 mm ; 2.17x3.58 in)</li>
	 * <li>BUSINESS_CARD_HK (54x90 mm ; 2.13x3.54 in)</li>
	 * <li>BUSINESS_CARD_AU, BUSINESS_CARD_DK, BUSINESS_CARD_SE (55x90 mm ; 2.17x3.54 in)</li>
	 * <li>BUSINESS_CARD_RU, BUSINESS_CARD_CZ, BUSINESS_CARD_FI, BUSINESS_CARD_HU, BUSINESS_CARD_IL (50x90 mm ; 1.97x3.54 in)</li>
	 * <li><b>Billboards</b></li>
	 * <li>4SHEET (1016x1524 mm ; 40.00x60.00 in)</li>
	 * <li>6SHEET (1200x1800 mm ; 47.24x70.87 in)</li>
	 * <li>12SHEET (3048x1524 mm ; 120.00x60.00 in)</li>
	 * <li>16SHEET (2032x3048 mm ; 80.00x120.00 in)</li>
	 * <li>32SHEET (4064x3048 mm ; 160.00x120.00 in)</li>
	 * <li>48SHEET (6096x3048 mm ; 240.00x120.00 in)</li>
	 * <li>64SHEET (8128x3048 mm ; 320.00x120.00 in)</li>
	 * <li>96SHEET (12192x3048 mm ; 480.00x120.00 in)</li>
	 * <li><b>Old Imperial English (some are still used in USA)</b></li>
	 * <li>EN_EMPEROR (1219x1829 mm ; 48.00x72.00 in)</li>
	 * <li>EN_ANTIQUARIAN (787x1346 mm ; 31.00x53.00 in)</li>
	 * <li>EN_GRAND_EAGLE (730x1067 mm ; 28.75x42.00 in)</li>
	 * <li>EN_DOUBLE_ELEPHANT (679x1016 mm ; 26.75x40.00 in)</li>
	 * <li>EN_ATLAS (660x864 mm ; 26.00x34.00 in)</li>
	 * <li>EN_COLOMBIER (597x876 mm ; 23.50x34.50 in)</li>
	 * <li>EN_ELEPHANT (584x711 mm ; 23.00x28.00 in)</li>
	 * <li>EN_DOUBLE_DEMY (572x902 mm ; 22.50x35.50 in)</li>
	 * <li>EN_IMPERIAL (559x762 mm ; 22.00x30.00 in)</li>
	 * <li>EN_PRINCESS (546x711 mm ; 21.50x28.00 in)</li>
	 * <li>EN_CARTRIDGE (533x660 mm ; 21.00x26.00 in)</li>
	 * <li>EN_DOUBLE_LARGE_POST (533x838 mm ; 21.00x33.00 in)</li>
	 * <li>EN_ROYAL (508x635 mm ; 20.00x25.00 in)</li>
	 * <li>EN_SHEET, EN_HALF_POST (495x597 mm ; 19.50x23.50 in)</li>
	 * <li>EN_SUPER_ROYAL (483x686 mm ; 19.00x27.00 in)</li>
	 * <li>EN_DOUBLE_POST (483x775 mm ; 19.00x30.50 in)</li>
	 * <li>EN_MEDIUM (445x584 mm ; 17.50x23.00 in)</li>
	 * <li>EN_DEMY (445x572 mm ; 17.50x22.50 in)</li>
	 * <li>EN_LARGE_POST (419x533 mm ; 16.50x21.00 in)</li>
	 * <li>EN_COPY_DRAUGHT (406x508 mm ; 16.00x20.00 in)</li>
	 * <li>EN_POST (394x489 mm ; 15.50x19.25 in)</li>
	 * <li>EN_CROWN (381x508 mm ; 15.00x20.00 in)</li>
	 * <li>EN_PINCHED_POST (375x470 mm ; 14.75x18.50 in)</li>
	 * <li>EN_BRIEF (343x406 mm ; 13.50x16.00 in)</li>
	 * <li>EN_FOOLSCAP (343x432 mm ; 13.50x17.00 in)</li>
	 * <li>EN_SMALL_FOOLSCAP (337x419 mm ; 13.25x16.50 in)</li>
	 * <li>EN_POTT (318x381 mm ; 12.50x15.00 in)</li>
	 * <li><b>Old Imperial Belgian</b></li>
	 * <li>BE_GRAND_AIGLE (700x1040 mm ; 27.56x40.94 in)</li>
	 * <li>BE_COLOMBIER (620x850 mm ; 24.41x33.46 in)</li>
	 * <li>BE_DOUBLE_CARRE (620x920 mm ; 24.41x36.22 in)</li>
	 * <li>BE_ELEPHANT (616x770 mm ; 24.25x30.31 in)</li>
	 * <li>BE_PETIT_AIGLE (600x840 mm ; 23.62x33.07 in)</li>
	 * <li>BE_GRAND_JESUS (550x730 mm ; 21.65x28.74 in)</li>
	 * <li>BE_JESUS (540x730 mm ; 21.26x28.74 in)</li>
	 * <li>BE_RAISIN (500x650 mm ; 19.69x25.59 in)</li>
	 * <li>BE_GRAND_MEDIAN (460x605 mm ; 18.11x23.82 in)</li>
	 * <li>BE_DOUBLE_POSTE (435x565 mm ; 17.13x22.24 in)</li>
	 * <li>BE_COQUILLE (430x560 mm ; 16.93x22.05 in)</li>
	 * <li>BE_PETIT_MEDIAN (415x530 mm ; 16.34x20.87 in)</li>
	 * <li>BE_RUCHE (360x460 mm ; 14.17x18.11 in)</li>
	 * <li>BE_PROPATRIA (345x430 mm ; 13.58x16.93 in)</li>
	 * <li>BE_LYS (317x397 mm ; 12.48x15.63 in)</li>
	 * <li>BE_POT (307x384 mm ; 12.09x15.12 in)</li>
	 * <li>BE_ROSETTE (270x347 mm ; 10.63x13.66 in)</li>
	 * <li><b>Old Imperial French</b></li>
	 * <li>FR_UNIVERS (1000x1300 mm ; 39.37x51.18 in)</li>
	 * <li>FR_DOUBLE_COLOMBIER (900x1260 mm ; 35.43x49.61 in)</li>
	 * <li>FR_GRANDE_MONDE (900x1260 mm ; 35.43x49.61 in)</li>
	 * <li>FR_DOUBLE_SOLEIL (800x1200 mm ; 31.50x47.24 in)</li>
	 * <li>FR_DOUBLE_JESUS (760x1120 mm ; 29.92x44.09 in)</li>
	 * <li>FR_GRAND_AIGLE (750x1060 mm ; 29.53x41.73 in)</li>
	 * <li>FR_PETIT_AIGLE (700x940 mm ; 27.56x37.01 in)</li>
	 * <li>FR_DOUBLE_RAISIN (650x1000 mm ; 25.59x39.37 in)</li>
	 * <li>FR_JOURNAL (650x940 mm ; 25.59x37.01 in)</li>
	 * <li>FR_COLOMBIER_AFFICHE (630x900 mm ; 24.80x35.43 in)</li>
	 * <li>FR_DOUBLE_CAVALIER (620x920 mm ; 24.41x36.22 in)</li>
	 * <li>FR_CLOCHE (600x800 mm ; 23.62x31.50 in)</li>
	 * <li>FR_SOLEIL (600x800 mm ; 23.62x31.50 in)</li>
	 * <li>FR_DOUBLE_CARRE (560x900 mm ; 22.05x35.43 in)</li>
	 * <li>FR_DOUBLE_COQUILLE (560x880 mm ; 22.05x34.65 in)</li>
	 * <li>FR_JESUS (560x760 mm ; 22.05x29.92 in)</li>
	 * <li>FR_RAISIN (500x650 mm ; 19.69x25.59 in)</li>
	 * <li>FR_CAVALIER (460x620 mm ; 18.11x24.41 in)</li>
	 * <li>FR_DOUBLE_COURONNE (460x720 mm ; 18.11x28.35 in)</li>
	 * <li>FR_CARRE (450x560 mm ; 17.72x22.05 in)</li>
	 * <li>FR_COQUILLE (440x560 mm ; 17.32x22.05 in)</li>
	 * <li>FR_DOUBLE_TELLIERE (440x680 mm ; 17.32x26.77 in)</li>
	 * <li>FR_DOUBLE_CLOCHE (400x600 mm ; 15.75x23.62 in)</li>
	 * <li>FR_DOUBLE_POT (400x620 mm ; 15.75x24.41 in)</li>
	 * <li>FR_ECU (400x520 mm ; 15.75x20.47 in)</li>
	 * <li>FR_COURONNE (360x460 mm ; 14.17x18.11 in)</li>
	 * <li>FR_TELLIERE (340x440 mm ; 13.39x17.32 in)</li>
	 * <li>FR_POT (310x400 mm ; 12.20x15.75 in)</li>
	 * </ul>
	 * @return array containing page width and height in points
	 * @access public
	 * @since 5.0.010 (2010-05-17)
	 */
	public function getPageSizeFromFormat($format) {
		// Paper cordinates are calculated in this way: (inches * 72) where (1 inch = 25.4 mm)
		switch (strtoupper($format)) {
			// ISO 216 A Series + 2 SIS 014711 extensions
			case 'A0' : {$pf = array( 2383.937, 3370.394); break;}
			case 'A1' : {$pf = array( 1683.780, 2383.937); break;}
			case 'A2' : {$pf = array( 1190.551, 1683.780); break;}
			case 'A3' : {$pf = array(  841.890, 1190.551); break;}
			case 'A4' : {$pf = array(  595.276,  841.890); break;}
			case 'A5' : {$pf = array(  419.528,  595.276); break;}
			case 'A6' : {$pf = array(  297.638,  419.528); break;}
			case 'A7' : {$pf = array(  209.764,  297.638); break;}
			case 'A8' : {$pf = array(  147.402,  209.764); break;}
			case 'A9' : {$pf = array(  104.882,  147.402); break;}
			case 'A10': {$pf = array(   73.701,  104.882); break;}
			case 'A11': {$pf = array(   51.024,   73.701); break;}
			case 'A12': {$pf = array(   36.850,   51.024); break;}
			// ISO 216 B Series + 2 SIS 014711 extensions
			case 'B0' : {$pf = array( 2834.646, 4008.189); break;}
			case 'B1' : {$pf = array( 2004.094, 2834.646); break;}
			case 'B2' : {$pf = array( 1417.323, 2004.094); break;}
			case 'B3' : {$pf = array( 1000.630, 1417.323); break;}
			case 'B4' : {$pf = array(  708.661, 1000.630); break;}
			case 'B5' : {$pf = array(  498.898,  708.661); break;}
			case 'B6' : {$pf = array(  354.331,  498.898); break;}
			case 'B7' : {$pf = array(  249.449,  354.331); break;}
			case 'B8' : {$pf = array(  175.748,  249.449); break;}
			case 'B9' : {$pf = array(  124.724,  175.748); break;}
			case 'B10': {$pf = array(   87.874,  124.724); break;}
			case 'B11': {$pf = array(   62.362,   87.874); break;}
			case 'B12': {$pf = array(   42.520,   62.362); break;}
			// ISO 216 C Series + 2 SIS 014711 extensions + 2 EXTENSION
			case 'C0' : {$pf = array( 2599.370, 3676.535); break;}
			case 'C1' : {$pf = array( 1836.850, 2599.370); break;}
			case 'C2' : {$pf = array( 1298.268, 1836.850); break;}
			case 'C3' : {$pf = array(  918.425, 1298.268); break;}
			case 'C4' : {$pf = array(  649.134,  918.425); break;}
			case 'C5' : {$pf = array(  459.213,  649.134); break;}
			case 'C6' : {$pf = array(  323.150,  459.213); break;}
			case 'C7' : {$pf = array(  229.606,  323.150); break;}
			case 'C8' : {$pf = array(  161.575,  229.606); break;}
			case 'C9' : {$pf = array(  113.386,  161.575); break;}
			case 'C10': {$pf = array(   79.370,  113.386); break;}
			case 'C11': {$pf = array(   56.693,   79.370); break;}
			case 'C12': {$pf = array(   39.685,   56.693); break;}
			case 'C76': {$pf = array(  229.606,  459.213); break;}
			case 'DL' : {$pf = array(  311.811,  623.622); break;}
			// SIS 014711 E Series
			case 'E0' : {$pf = array( 2491.654, 3517.795); break;}
			case 'E1' : {$pf = array( 1757.480, 2491.654); break;}
			case 'E2' : {$pf = array( 1247.244, 1757.480); break;}
			case 'E3' : {$pf = array(  878.740, 1247.244); break;}
			case 'E4' : {$pf = array(  623.622,  878.740); break;}
			case 'E5' : {$pf = array(  439.370,  623.622); break;}
			case 'E6' : {$pf = array(  311.811,  439.370); break;}
			case 'E7' : {$pf = array(  221.102,  311.811); break;}
			case 'E8' : {$pf = array(  155.906,  221.102); break;}
			case 'E9' : {$pf = array(  110.551,  155.906); break;}
			case 'E10': {$pf = array(   76.535,  110.551); break;}
			case 'E11': {$pf = array(   53.858,   76.535); break;}
			case 'E12': {$pf = array(   36.850,   53.858); break;}
			// SIS 014711 G Series
			case 'G0' : {$pf = array( 2715.591, 3838.110); break;}
			case 'G1' : {$pf = array( 1919.055, 2715.591); break;}
			case 'G2' : {$pf = array( 1357.795, 1919.055); break;}
			case 'G3' : {$pf = array(  958.110, 1357.795); break;}
			case 'G4' : {$pf = array(  677.480,  958.110); break;}
			case 'G5' : {$pf = array(  479.055,  677.480); break;}
			case 'G6' : {$pf = array(  337.323,  479.055); break;}
			case 'G7' : {$pf = array(  238.110,  337.323); break;}
			case 'G8' : {$pf = array(  167.244,  238.110); break;}
			case 'G9' : {$pf = array(  119.055,  167.244); break;}
			case 'G10': {$pf = array(   82.205,  119.055); break;}
			case 'G11': {$pf = array(   59.528,   82.205); break;}
			case 'G12': {$pf = array(   39.685,   59.528); break;}
			// ISO Press
			case 'RA0': {$pf = array( 2437.795, 3458.268); break;}
			case 'RA1': {$pf = array( 1729.134, 2437.795); break;}
			case 'RA2': {$pf = array( 1218.898, 1729.134); break;}
			case 'RA3': {$pf = array(  864.567, 1218.898); break;}
			case 'RA4': {$pf = array(  609.449,  864.567); break;}
			case 'SRA0': {$pf = array( 2551.181, 3628.346); break;}
			case 'SRA1': {$pf = array( 1814.173, 2551.181); break;}
			case 'SRA2': {$pf = array( 1275.591, 1814.173); break;}
			case 'SRA3': {$pf = array(  907.087, 1275.591); break;}
			case 'SRA4': {$pf = array(  637.795,  907.087); break;}
			// German  DIN 476
			case '4A0': {$pf = array( 4767.874, 6740.787); break;}
			case '2A0': {$pf = array( 3370.394, 4767.874); break;}
			// Variations on the ISO Standard
			case 'A2_EXTRA'   : {$pf = array( 1261.417, 1754.646); break;}
			case 'A3+'        : {$pf = array(  932.598, 1369.134); break;}
			case 'A3_EXTRA'   : {$pf = array(  912.756, 1261.417); break;}
			case 'A3_SUPER'   : {$pf = array(  864.567, 1440.000); break;}
			case 'SUPER_A3'   : {$pf = array(  864.567, 1380.472); break;}
			case 'A4_EXTRA'   : {$pf = array(  666.142,  912.756); break;}
			case 'A4_SUPER'   : {$pf = array(  649.134,  912.756); break;}
			case 'SUPER_A4'   : {$pf = array(  643.465, 1009.134); break;}
			case 'A4_LONG'    : {$pf = array(  595.276,  986.457); break;}
			case 'F4'         : {$pf = array(  595.276,  935.433); break;}
			case 'SO_B5_EXTRA': {$pf = array(  572.598,  782.362); break;}
			case 'A5_EXTRA'   : {$pf = array(  490.394,  666.142); break;}
			// ANSI Series
			case 'ANSI_E': {$pf = array( 2448.000, 3168.000); break;}
			case 'ANSI_D': {$pf = array( 1584.000, 2448.000); break;}
			case 'ANSI_C': {$pf = array( 1224.000, 1584.000); break;}
			case 'ANSI_B': {$pf = array(  792.000, 1224.000); break;}
			case 'ANSI_A': {$pf = array(  612.000,  792.000); break;}
			// Traditional 'Loose' North American Paper Sizes
			case 'USLEDGER':
			case 'LEDGER' : {$pf = array( 1224.000,  792.000); break;}
			case 'ORGANIZERK':
			case 'BIBLE':
			case 'USTABLOID':
			case 'TABLOID': {$pf = array(  792.000, 1224.000); break;}
			case 'ORGANIZERM':
			case 'USLETTER':
			case 'LETTER' : {$pf = array(  612.000,  792.000); break;}
			case 'USLEGAL':
			case 'LEGAL'  : {$pf = array(  612.000, 1008.000); break;}
			case 'GOVERNMENTLETTER':
			case 'GLETTER': {$pf = array(  576.000,  756.000); break;}
			case 'JUNIORLEGAL':
			case 'JLEGAL' : {$pf = array(  576.000,  360.000); break;}
			// Other North American Paper Sizes
			case 'QUADDEMY': {$pf = array( 2520.000, 3240.000); break;}
			case 'SUPER_B': {$pf = array(  936.000, 1368.000); break;}
			case 'QUARTO': {$pf = array(  648.000,  792.000); break;}
			case 'GOVERNMENTLEGAL':
			case 'FOLIO': {$pf = array(  612.000,  936.000); break;}
			case 'MONARCH':
			case 'EXECUTIVE': {$pf = array(  522.000,  756.000); break;}
			case 'ORGANIZERL':
			case 'STATEMENT':
			case 'MEMO': {$pf = array(  396.000,  612.000); break;}
			case 'FOOLSCAP': {$pf = array(  595.440,  936.000); break;}
			case 'COMPACT': {$pf = array(  306.000,  486.000); break;}
			case 'ORGANIZERJ': {$pf = array(  198.000,  360.000); break;}
			// Canadian standard CAN 2-9.60M
			case 'P1': {$pf = array( 1587.402, 2437.795); break;}
			case 'P2': {$pf = array( 1218.898, 1587.402); break;}
			case 'P3': {$pf = array(  793.701, 1218.898); break;}
			case 'P4': {$pf = array(  609.449,  793.701); break;}
			case 'P5': {$pf = array(  396.850,  609.449); break;}
			case 'P6': {$pf = array(  303.307,  396.850); break;}
			// North American Architectural Sizes
			case 'ARCH_E' : {$pf = array( 2592.000, 3456.000); break;}
			case 'ARCH_E1': {$pf = array( 2160.000, 3024.000); break;}
			case 'ARCH_D' : {$pf = array( 1728.000, 2592.000); break;}
			case 'BROADSHEET':
			case 'ARCH_C' : {$pf = array( 1296.000, 1728.000); break;}
			case 'ARCH_B' : {$pf = array(  864.000, 1296.000); break;}
			case 'ARCH_A' : {$pf = array(  648.000,  864.000); break;}
			// --- North American Envelope Sizes ---
			//   - Announcement Envelopes
			case 'ANNENV_A2'  : {$pf = array(  314.640,  414.000); break;}
			case 'ANNENV_A6'  : {$pf = array(  342.000,  468.000); break;}
			case 'ANNENV_A7'  : {$pf = array(  378.000,  522.000); break;}
			case 'ANNENV_A8'  : {$pf = array(  396.000,  584.640); break;}
			case 'ANNENV_A10' : {$pf = array(  450.000,  692.640); break;}
			case 'ANNENV_SLIM': {$pf = array(  278.640,  638.640); break;}
			//   - Commercial Envelopes
			case 'COMMENV_N6_1/4': {$pf = array(  252.000,  432.000); break;}
			case 'COMMENV_N6_3/4': {$pf = array(  260.640,  468.000); break;}
			case 'COMMENV_N8'    : {$pf = array(  278.640,  540.000); break;}
			case 'COMMENV_N9'    : {$pf = array(  278.640,  638.640); break;}
			case 'COMMENV_N10'   : {$pf = array(  296.640,  684.000); break;}
			case 'COMMENV_N11'   : {$pf = array(  324.000,  746.640); break;}
			case 'COMMENV_N12'   : {$pf = array(  342.000,  792.000); break;}
			case 'COMMENV_N14'   : {$pf = array(  360.000,  828.000); break;}
			//   - Catalogue Envelopes
			case 'CATENV_N1'     : {$pf = array(  432.000,  648.000); break;}
			case 'CATENV_N1_3/4' : {$pf = array(  468.000,  684.000); break;}
			case 'CATENV_N2'     : {$pf = array(  468.000,  720.000); break;}
			case 'CATENV_N3'     : {$pf = array(  504.000,  720.000); break;}
			case 'CATENV_N6'     : {$pf = array(  540.000,  756.000); break;}
			case 'CATENV_N7'     : {$pf = array(  576.000,  792.000); break;}
			case 'CATENV_N8'     : {$pf = array(  594.000,  810.000); break;}
			case 'CATENV_N9_1/2' : {$pf = array(  612.000,  756.000); break;}
			case 'CATENV_N9_3/4' : {$pf = array(  630.000,  810.000); break;}
			case 'CATENV_N10_1/2': {$pf = array(  648.000,  864.000); break;}
			case 'CATENV_N12_1/2': {$pf = array(  684.000,  900.000); break;}
			case 'CATENV_N13_1/2': {$pf = array(  720.000,  936.000); break;}
			case 'CATENV_N14_1/4': {$pf = array(  810.000,  882.000); break;}
			case 'CATENV_N14_1/2': {$pf = array(  828.000, 1044.000); break;}
			// Japanese (JIS P 0138-61) Standard B-Series
			case 'JIS_B0' : {$pf = array( 2919.685, 4127.244); break;}
			case 'JIS_B1' : {$pf = array( 2063.622, 2919.685); break;}
			case 'JIS_B2' : {$pf = array( 1459.843, 2063.622); break;}
			case 'JIS_B3' : {$pf = array( 1031.811, 1459.843); break;}
			case 'JIS_B4' : {$pf = array(  728.504, 1031.811); break;}
			case 'JIS_B5' : {$pf = array(  515.906,  728.504); break;}
			case 'JIS_B6' : {$pf = array(  362.835,  515.906); break;}
			case 'JIS_B7' : {$pf = array(  257.953,  362.835); break;}
			case 'JIS_B8' : {$pf = array(  181.417,  257.953); break;}
			case 'JIS_B9' : {$pf = array(  127.559,  181.417); break;}
			case 'JIS_B10': {$pf = array(   90.709,  127.559); break;}
			case 'JIS_B11': {$pf = array(   62.362,   90.709); break;}
			case 'JIS_B12': {$pf = array(   45.354,   62.362); break;}
			// PA Series
			case 'PA0' : {$pf = array( 2381.102, 3174.803,); break;}
			case 'PA1' : {$pf = array( 1587.402, 2381.102); break;}
			case 'PA2' : {$pf = array( 1190.551, 1587.402); break;}
			case 'PA3' : {$pf = array(  793.701, 1190.551); break;}
			case 'PA4' : {$pf = array(  595.276,  793.701); break;}
			case 'PA5' : {$pf = array(  396.850,  595.276); break;}
			case 'PA6' : {$pf = array(  297.638,  396.850); break;}
			case 'PA7' : {$pf = array(  198.425,  297.638); break;}
			case 'PA8' : {$pf = array(  147.402,  198.425); break;}
			case 'PA9' : {$pf = array(   99.213,  147.402); break;}
			case 'PA10': {$pf = array(   73.701,   99.213); break;}
			// Standard Photographic Print Sizes
			case 'PASSPORT_PHOTO': {$pf = array(   99.213,  127.559); break;}
			case 'E'   : {$pf = array(  233.858,  340.157); break;}
			case 'L':
			case '3R'  : {$pf = array(  252.283,  360.000); break;}
			case 'KG':
			case '4R'  : {$pf = array(  289.134,  430.866); break;}
			case '4D'  : {$pf = array(  340.157,  430.866); break;}
			case '2L':
			case '5R'  : {$pf = array(  360.000,  504.567); break;}
			case '8P':
			case '6R'  : {$pf = array(  430.866,  575.433); break;}
			case '6P':
			case '8R'  : {$pf = array(  575.433,  720.000); break;}
			case '6PW':
			case 'S8R' : {$pf = array(  575.433,  864.567); break;}
			case '4P':
			case '10R' : {$pf = array(  720.000,  864.567); break;}
			case '4PW':
			case 'S10R': {$pf = array(  720.000, 1080.000); break;}
			case '11R' : {$pf = array(  790.866, 1009.134); break;}
			case 'S11R': {$pf = array(  790.866, 1224.567); break;}
			case '12R' : {$pf = array(  864.567, 1080.000); break;}
			case 'S12R': {$pf = array(  864.567, 1292.598); break;}
			// Common Newspaper Sizes
			case 'NEWSPAPER_BROADSHEET': {$pf = array( 2125.984, 1700.787); break;}
			case 'NEWSPAPER_BERLINER'  : {$pf = array( 1332.283,  892.913); break;}
			case 'NEWSPAPER_TABLOID':
			case 'NEWSPAPER_COMPACT'   : {$pf = array( 1218.898,  793.701); break;}
			// Business Cards
			case 'CREDIT_CARD':
			case 'BUSINESS_CARD':
			case 'BUSINESS_CARD_ISO7810': {$pf = array(  153.014,  242.646); break;}
			case 'BUSINESS_CARD_ISO216' : {$pf = array(  147.402,  209.764); break;}
			case 'BUSINESS_CARD_IT':
			case 'BUSINESS_CARD_UK':
			case 'BUSINESS_CARD_FR':
			case 'BUSINESS_CARD_DE':
			case 'BUSINESS_CARD_ES'     : {$pf = array(  155.906,  240.945); break;}
			case 'BUSINESS_CARD_CA':
			case 'BUSINESS_CARD_US'     : {$pf = array(  144.567,  252.283); break;}
			case 'BUSINESS_CARD_JP'     : {$pf = array(  155.906,  257.953); break;}
			case 'BUSINESS_CARD_HK'     : {$pf = array(  153.071,  255.118); break;}
			case 'BUSINESS_CARD_AU':
			case 'BUSINESS_CARD_DK':
			case 'BUSINESS_CARD_SE'     : {$pf = array(  155.906,  255.118); break;}
			case 'BUSINESS_CARD_RU':
			case 'BUSINESS_CARD_CZ':
			case 'BUSINESS_CARD_FI':
			case 'BUSINESS_CARD_HU':
			case 'BUSINESS_CARD_IL'     : {$pf = array(  141.732,  255.118); break;}
			// Billboards
			case '4SHEET' : {$pf = array( 2880.000, 4320.000); break;}
			case '6SHEET' : {$pf = array( 3401.575, 5102.362); break;}
			case '12SHEET': {$pf = array( 8640.000, 4320.000); break;}
			case '16SHEET': {$pf = array( 5760.000, 8640.000); break;}
			case '32SHEET': {$pf = array(11520.000, 8640.000); break;}
			case '48SHEET': {$pf = array(17280.000, 8640.000); break;}
			case '64SHEET': {$pf = array(23040.000, 8640.000); break;}
			case '96SHEET': {$pf = array(34560.000, 8640.000); break;}
			// Old European Sizes
			//   - Old Imperial English Sizes
			case 'EN_EMPEROR'          : {$pf = array( 3456.000, 5184.000); break;}
			case 'EN_ANTIQUARIAN'      : {$pf = array( 2232.000, 3816.000); break;}
			case 'EN_GRAND_EAGLE'      : {$pf = array( 2070.000, 3024.000); break;}
			case 'EN_DOUBLE_ELEPHANT'  : {$pf = array( 1926.000, 2880.000); break;}
			case 'EN_ATLAS'            : {$pf = array( 1872.000, 2448.000); break;}
			case 'EN_COLOMBIER'        : {$pf = array( 1692.000, 2484.000); break;}
			case 'EN_ELEPHANT'         : {$pf = array( 1656.000, 2016.000); break;}
			case 'EN_DOUBLE_DEMY'      : {$pf = array( 1620.000, 2556.000); break;}
			case 'EN_IMPERIAL'         : {$pf = array( 1584.000, 2160.000); break;}
			case 'EN_PRINCESS'         : {$pf = array( 1548.000, 2016.000); break;}
			case 'EN_CARTRIDGE'        : {$pf = array( 1512.000, 1872.000); break;}
			case 'EN_DOUBLE_LARGE_POST': {$pf = array( 1512.000, 2376.000); break;}
			case 'EN_ROYAL'            : {$pf = array( 1440.000, 1800.000); break;}
			case 'EN_SHEET':
			case 'EN_HALF_POST'        : {$pf = array( 1404.000, 1692.000); break;}
			case 'EN_SUPER_ROYAL'      : {$pf = array( 1368.000, 1944.000); break;}
			case 'EN_DOUBLE_POST'      : {$pf = array( 1368.000, 2196.000); break;}
			case 'EN_MEDIUM'           : {$pf = array( 1260.000, 1656.000); break;}
			case 'EN_DEMY'             : {$pf = array( 1260.000, 1620.000); break;}
			case 'EN_LARGE_POST'       : {$pf = array( 1188.000, 1512.000); break;}
			case 'EN_COPY_DRAUGHT'     : {$pf = array( 1152.000, 1440.000); break;}
			case 'EN_POST'             : {$pf = array( 1116.000, 1386.000); break;}
			case 'EN_CROWN'            : {$pf = array( 1080.000, 1440.000); break;}
			case 'EN_PINCHED_POST'     : {$pf = array( 1062.000, 1332.000); break;}
			case 'EN_BRIEF'            : {$pf = array(  972.000, 1152.000); break;}
			case 'EN_FOOLSCAP'         : {$pf = array(  972.000, 1224.000); break;}
			case 'EN_SMALL_FOOLSCAP'   : {$pf = array(  954.000, 1188.000); break;}
			case 'EN_POTT'             : {$pf = array(  900.000, 1080.000); break;}
			//   - Old Imperial Belgian Sizes
			case 'BE_GRAND_AIGLE' : {$pf = array( 1984.252, 2948.031); break;}
			case 'BE_COLOMBIER'   : {$pf = array( 1757.480, 2409.449); break;}
			case 'BE_DOUBLE_CARRE': {$pf = array( 1757.480, 2607.874); break;}
			case 'BE_ELEPHANT'    : {$pf = array( 1746.142, 2182.677); break;}
			case 'BE_PETIT_AIGLE' : {$pf = array( 1700.787, 2381.102); break;}
			case 'BE_GRAND_JESUS' : {$pf = array( 1559.055, 2069.291); break;}
			case 'BE_JESUS'       : {$pf = array( 1530.709, 2069.291); break;}
			case 'BE_RAISIN'      : {$pf = array( 1417.323, 1842.520); break;}
			case 'BE_GRAND_MEDIAN': {$pf = array( 1303.937, 1714.961); break;}
			case 'BE_DOUBLE_POSTE': {$pf = array( 1233.071, 1601.575); break;}
			case 'BE_COQUILLE'    : {$pf = array( 1218.898, 1587.402); break;}
			case 'BE_PETIT_MEDIAN': {$pf = array( 1176.378, 1502.362); break;}
			case 'BE_RUCHE'       : {$pf = array( 1020.472, 1303.937); break;}
			case 'BE_PROPATRIA'   : {$pf = array(  977.953, 1218.898); break;}
			case 'BE_LYS'         : {$pf = array(  898.583, 1125.354); break;}
			case 'BE_POT'         : {$pf = array(  870.236, 1088.504); break;}
			case 'BE_ROSETTE'     : {$pf = array(  765.354,  983.622); break;}
			//   - Old Imperial French Sizes
			case 'FR_UNIVERS'          : {$pf = array( 2834.646, 3685.039); break;}
			case 'FR_DOUBLE_COLOMBIER' : {$pf = array( 2551.181, 3571.654); break;}
			case 'FR_GRANDE_MONDE'     : {$pf = array( 2551.181, 3571.654); break;}
			case 'FR_DOUBLE_SOLEIL'    : {$pf = array( 2267.717, 3401.575); break;}
			case 'FR_DOUBLE_JESUS'     : {$pf = array( 2154.331, 3174.803); break;}
			case 'FR_GRAND_AIGLE'      : {$pf = array( 2125.984, 3004.724); break;}
			case 'FR_PETIT_AIGLE'      : {$pf = array( 1984.252, 2664.567); break;}
			case 'FR_DOUBLE_RAISIN'    : {$pf = array( 1842.520, 2834.646); break;}
			case 'FR_JOURNAL'          : {$pf = array( 1842.520, 2664.567); break;}
			case 'FR_COLOMBIER_AFFICHE': {$pf = array( 1785.827, 2551.181); break;}
			case 'FR_DOUBLE_CAVALIER'  : {$pf = array( 1757.480, 2607.874); break;}
			case 'FR_CLOCHE'           : {$pf = array( 1700.787, 2267.717); break;}
			case 'FR_SOLEIL'           : {$pf = array( 1700.787, 2267.717); break;}
			case 'FR_DOUBLE_CARRE'     : {$pf = array( 1587.402, 2551.181); break;}
			case 'FR_DOUBLE_COQUILLE'  : {$pf = array( 1587.402, 2494.488); break;}
			case 'FR_JESUS'            : {$pf = array( 1587.402, 2154.331); break;}
			case 'FR_RAISIN'           : {$pf = array( 1417.323, 1842.520); break;}
			case 'FR_CAVALIER'         : {$pf = array( 1303.937, 1757.480); break;}
			case 'FR_DOUBLE_COURONNE'  : {$pf = array( 1303.937, 2040.945); break;}
			case 'FR_CARRE'            : {$pf = array( 1275.591, 1587.402); break;}
			case 'FR_COQUILLE'         : {$pf = array( 1247.244, 1587.402); break;}
			case 'FR_DOUBLE_TELLIERE'  : {$pf = array( 1247.244, 1927.559); break;}
			case 'FR_DOUBLE_CLOCHE'    : {$pf = array( 1133.858, 1700.787); break;}
			case 'FR_DOUBLE_POT'       : {$pf = array( 1133.858, 1757.480); break;}
			case 'FR_ECU'              : {$pf = array( 1133.858, 1474.016); break;}
			case 'FR_COURONNE'         : {$pf = array( 1020.472, 1303.937); break;}
			case 'FR_TELLIERE'         : {$pf = array(  963.780, 1247.244); break;}
			case 'FR_POT'              : {$pf = array(  878.740, 1133.858); break;}
			// DEFAULT ISO A4
			default: {$pf = array(  595.276,  841.890); break;}
		}
		return $pf;
	}

	/**
	 * Change the format of the current page
	 * @param mixed $format The format used for pages. It can be either: one of the string values specified at getPageSizeFromFormat() documentation or an array of two numners (width, height) or an array containing the following measures and options:<ul>
	 * <li>['format'] = page format name (one of the above);</li>
	 * <li>['Rotate'] : The number of degrees by which the page shall be rotated clockwise when displayed or printed. The value shall be a multiple of 90.</li>
	 * <li>['PZ'] : The page's preferred zoom (magnification) factor.</li>
	 * <li>['MediaBox'] : the boundaries of the physical medium on which the page shall be displayed or printed:</li>
	 * <li>['MediaBox']['llx'] : lower-left x coordinate in points</li>
	 * <li>['MediaBox']['lly'] : lower-left y coordinate in points</li>
	 * <li>['MediaBox']['urx'] : upper-right x coordinate in points</li>
	 * <li>['MediaBox']['ury'] : upper-right y coordinate in points</li>
	 * <li>['CropBox'] : the visible region of default user space:</li>
	 * <li>['CropBox']['llx'] : lower-left x coordinate in points</li>
	 * <li>['CropBox']['lly'] : lower-left y coordinate in points</li>
	 * <li>['CropBox']['urx'] : upper-right x coordinate in points</li>
	 * <li>['CropBox']['ury'] : upper-right y coordinate in points</li>
	 * <li>['BleedBox'] : the region to which the contents of the page shall be clipped when output in a production environment:</li>
	 * <li>['BleedBox']['llx'] : lower-left x coordinate in points</li>
	 * <li>['BleedBox']['lly'] : lower-left y coordinate in points</li>
	 * <li>['BleedBox']['urx'] : upper-right x coordinate in points</li>
	 * <li>['BleedBox']['ury'] : upper-right y coordinate in points</li>
	 * <li>['TrimBox'] : the intended dimensions of the finished page after trimming:</li>
	 * <li>['TrimBox']['llx'] : lower-left x coordinate in points</li>
	 * <li>['TrimBox']['lly'] : lower-left y coordinate in points</li>
	 * <li>['TrimBox']['urx'] : upper-right x coordinate in points</li>
	 * <li>['TrimBox']['ury'] : upper-right y coordinate in points</li>
	 * <li>['ArtBox'] : the extent of the page's meaningful content:</li>
	 * <li>['ArtBox']['llx'] : lower-left x coordinate in points</li>
	 * <li>['ArtBox']['lly'] : lower-left y coordinate in points</li>
	 * <li>['ArtBox']['urx'] : upper-right x coordinate in points</li>
	 * <li>['ArtBox']['ury'] : upper-right y coordinate in points</li>
	 * <li>['BoxColorInfo'] :specify the colours and other visual characteristics that should be used in displaying guidelines on the screen for each of the possible page boundaries other than the MediaBox:</li>
	 * <li>['BoxColorInfo'][BOXTYPE]['C'] : an array of three numbers in the range 0-255, representing the components in the DeviceRGB colour space.</li>
	 * <li>['BoxColorInfo'][BOXTYPE]['W'] : the guideline width in default user units</li>
	 * <li>['BoxColorInfo'][BOXTYPE]['S'] : the guideline style: S = Solid; D = Dashed</li>
	 * <li>['BoxColorInfo'][BOXTYPE]['D'] : dash array defining a pattern of dashes and gaps to be used in drawing dashed guidelines</li>
	 * <li>['trans'] : the style and duration of the visual transition to use when moving from another page to the given page during a presentation</li>
	 * <li>['trans']['Dur'] : The page's display duration (also called its advance timing): the maximum length of time, in seconds, that the page shall be displayed during presentations before the viewer application shall automatically advance to the next page.</li>
	 * <li>['trans']['S'] : transition style : Split, Blinds, Box, Wipe, Dissolve, Glitter, R, Fly, Push, Cover, Uncover, Fade</li>
	 * <li>['trans']['D'] : The duration of the transition effect, in seconds.</li>
	 * <li>['trans']['Dm'] : (Split and Blinds transition styles only) The dimension in which the specified transition effect shall occur: H = Horizontal, V = Vertical. Default value: H.</li>
	 * <li>['trans']['M'] : (Split, Box and Fly transition styles only) The direction of motion for the specified transition effect: I = Inward from the edges of the page, O = Outward from the center of the pageDefault value: I.</li>
	 * <li>['trans']['Di'] : (Wipe, Glitter, Fly, Cover, Uncover and Push transition styles only) The direction in which the specified transition effect shall moves, expressed in degrees counterclockwise starting from a left-to-right direction. If the value is a number, it shall be one of: 0 = Left to right, 90 = Bottom to top (Wipe only), 180 = Right to left (Wipe only), 270 = Top to bottom, 315 = Top-left to bottom-right (Glitter only). If the value is a name, it shall be None, which is relevant only for the Fly transition when the value of SS is not 1.0. Default value: 0.</li>
	 * <li>['trans']['SS'] : (Fly transition style only) The starting or ending scale at which the changes shall be drawn. If M specifies an inward transition, the scale of the changes drawn shall progress from SS to 1.0 over the course of the transition. If M specifies an outward transition, the scale of the changes drawn shall progress from 1.0 to SS over the course of the transition. Default: 1.0.</li>
	 * <li>['trans']['B'] : (Fly transition style only) If true, the area that shall be flown in is rectangular and opaque. Default: false.</li>
	 * </ul>
	 * @param string $orientation page orientation. Possible values are (case insensitive):<ul>
	 * <li>P or Portrait (default)</li>
	 * <li>L or Landscape</li>
	 * <li>'' (empty string) for automatic orientation</li>
	 * </ul>
	 * @access protected
	 * @since 3.0.015 (2008-06-06)
	 * @see getPageSizeFromFormat()
	 */
	protected function setPageFormat($format, $orientation='P') {
		if (!empty($format) AND isset($this->pagedim[$this->page])) {
			// remove inherited values
			unset($this->pagedim[$this->page]);
		}
		if (is_string($format)) {
			// get page measures from format name
			$pf = $this->getPageSizeFromFormat($format);
			$this->fwPt = $pf[0];
			$this->fhPt = $pf[1];
		} else {
			// the boundaries of the physical medium on which the page shall be displayed or printed
			if (isset($format['MediaBox'])) {
				$this->setPageBoxes($this->page, 'MediaBox', $format['MediaBox']['llx'], $format['MediaBox']['lly'], $format['MediaBox']['urx'], $format['MediaBox']['ury'], false);
				$this->fwPt = (($format['MediaBox']['urx'] - $format['MediaBox']['llx']) * $this->k);
				$this->fhPt = (($format['MediaBox']['ury'] - $format['MediaBox']['lly']) * $this->k);
			} else {
				if (isset($format[0]) AND is_numeric($format[0]) AND isset($format[1]) AND is_numeric($format[1])) {
					$pf = array(($format[0] * $this->k), ($format[1] * $this->k));
				} else {
					if (!isset($format['format'])) {
						// default value
						$format['format'] = 'A4';
					}
					$pf = $this->getPageSizeFromFormat($format['format']);
				}
				$this->fwPt = $pf[0];
				$this->fhPt = $pf[1];
				$this->setPageBoxes($this->page, 'MediaBox', 0, 0, $this->fwPt, $this->fhPt, true);
			}
			// the visible region of default user space
			if (isset($format['CropBox'])) {
				$this->setPageBoxes($this->page, 'CropBox', $format['CropBox']['llx'], $format['CropBox']['lly'], $format['CropBox']['urx'], $format['CropBox']['ury'], false);
			}
			// the region to which the contents of the page shall be clipped when output in a production environment
			if (isset($format['BleedBox'])) {
				$this->setPageBoxes($this->page, 'BleedBox', $format['BleedBox']['llx'], $format['BleedBox']['lly'], $format['BleedBox']['urx'], $format['BleedBox']['ury'], false);
			}
			// the intended dimensions of the finished page after trimming
			if (isset($format['TrimBox'])) {
				$this->setPageBoxes($this->page, 'TrimBox', $format['TrimBox']['llx'], $format['TrimBox']['lly'], $format['TrimBox']['urx'], $format['TrimBox']['ury'], false);
			}
			// the page's meaningful content (including potential white space)
			if (isset($format['ArtBox'])) {
				$this->setPageBoxes($this->page, 'ArtBox', $format['ArtBox']['llx'], $format['ArtBox']['lly'], $format['ArtBox']['urx'], $format['ArtBox']['ury'], false);
			}
			// specify the colours and other visual characteristics that should be used in displaying guidelines on the screen for the various page boundaries
			if (isset($format['BoxColorInfo'])) {
				$this->pagedim[$this->page]['BoxColorInfo'] = $format['BoxColorInfo'];
			}
			if (isset($format['Rotate']) AND (($format['Rotate'] % 90) == 0)) {
				// The number of degrees by which the page shall be rotated clockwise when displayed or printed. The value shall be a multiple of 90.
				$this->pagedim[$this->page]['Rotate'] = intval($format['Rotate']);
			}
			if (isset($format['PZ'])) {
				// The page's preferred zoom (magnification) factor
				$this->pagedim[$this->page]['PZ'] = floatval($format['PZ']);
			}
			if (isset($format['trans'])) {
				// The style and duration of the visual transition to use when moving from another page to the given page during a presentation
				if (isset($format['trans']['Dur'])) {
					// The page's display duration
					$this->pagedim[$this->page]['trans']['Dur'] = floatval($format['trans']['Dur']);
				}
				$stansition_styles = array('Split', 'Blinds', 'Box', 'Wipe', 'Dissolve', 'Glitter', 'R', 'Fly', 'Push', 'Cover', 'Uncover', 'Fade');
				if (isset($format['trans']['S']) AND in_array($format['trans']['S'], $stansition_styles)) {
					// The transition style that shall be used when moving to this page from another during a presentation
					$this->pagedim[$this->page]['trans']['S'] = $format['trans']['S'];
					$valid_effect = array('Split', 'Blinds');
					$valid_vals = array('H', 'V');
					if (isset($format['trans']['Dm']) AND in_array($format['trans']['S'], $valid_effect) AND in_array($format['trans']['Dm'], $valid_vals)) {
						$this->pagedim[$this->page]['trans']['Dm'] = $format['trans']['Dm'];
					}
					$valid_effect = array('Split', 'Box', 'Fly');
					$valid_vals = array('I', 'O');
					if (isset($format['trans']['M']) AND in_array($format['trans']['S'], $valid_effect) AND in_array($format['trans']['M'], $valid_vals)) {
						$this->pagedim[$this->page]['trans']['M'] = $format['trans']['M'];
					}
					$valid_effect = array('Wipe', 'Glitter', 'Fly', 'Cover', 'Uncover', 'Push');
					if (isset($format['trans']['Di']) AND in_array($format['trans']['S'], $valid_effect)) {
						if (((($format['trans']['Di'] == 90) OR ($format['trans']['Di'] == 180)) AND ($format['trans']['S'] == 'Wipe'))
							OR (($format['trans']['Di'] == 315) AND ($format['trans']['S'] == 'Glitter'))
							OR (($format['trans']['Di'] == 0) OR ($format['trans']['Di'] == 270))) {
							$this->pagedim[$this->page]['trans']['Di'] = intval($format['trans']['Di']);
						}
					}
					if (isset($format['trans']['SS']) AND ($format['trans']['S'] == 'Fly')) {
						$this->pagedim[$this->page]['trans']['SS'] = floatval($format['trans']['SS']);
					}
					if (isset($format['trans']['B']) AND ($format['trans']['B'] === true) AND ($format['trans']['S'] == 'Fly')) {
						$this->pagedim[$this->page]['trans']['B'] = 'true';
					}
				} else {
					$this->pagedim[$this->page]['trans']['S'] = 'R';
				}
				if (isset($format['trans']['D'])) {
					// The duration of the transition effect, in seconds
					$this->pagedim[$this->page]['trans']['D'] = floatval($format['trans']['D']);
				} else {
					$this->pagedim[$this->page]['trans']['D'] = 1;
				}
			}
		}
		$this->setPageOrientation($orientation);
	}

	/**
	 * Set page boundaries.
	 * @param int $page page number
	 * @param string $type valid values are: <ul><li>'MediaBox' : the boundaries of the physical medium on which the page shall be displayed or printed;</li><li>'CropBox' : the visible region of default user space;</li><li>'BleedBox' : the region to which the contents of the page shall be clipped when output in a production environment;</li><li>'TrimBox' : the intended dimensions of the finished page after trimming;</li><li>'ArtBox' : the page's meaningful content (including potential white space).</li></ul>
	 * @param float $llx lower-left x coordinate in user units
	 * @param float $lly lower-left y coordinate in user units
	 * @param float $urx upper-right x coordinate in user units
	 * @param float $ury upper-right y coordinate in user units
	 * @param boolean $points if true uses user units as unit of measure, otherwise uses PDF points
	 * @access public
	 * @since 5.0.010 (2010-05-17)
	 */
	public function setPageBoxes($page, $type, $llx, $lly, $urx, $ury, $points=false) {
		if (!isset($this->pagedim[$page])) {
			// initialize array
			$this->pagedim[$page] = array();
		}
		$pageboxes = array('MediaBox', 'CropBox', 'BleedBox', 'TrimBox', 'ArtBox');
		if (!in_array($type, $pageboxes)) {
			return;
		}
		if ($points) {
			$k = 1;
		} else {
			$k = $this->k;
		}
		$this->pagedim[$page][$type]['llx'] = ($llx * $k);
		$this->pagedim[$page][$type]['lly'] = ($lly * $k);
		$this->pagedim[$page][$type]['urx'] = ($urx * $k);
		$this->pagedim[$page][$type]['ury'] = ($ury * $k);
	}

	/**
	 * Swap X and Y coordinates of page boxes (change page boxes orientation).
	 * @param int $page page number
	 * @access protected
	 * @since 5.0.010 (2010-05-17)
	 */
	protected function swapPageBoxCoordinates($page) {
		$pageboxes = array('MediaBox', 'CropBox', 'BleedBox', 'TrimBox', 'ArtBox');
		foreach ($pageboxes as $type) {
			// swap X and Y coordinates
			if (isset($this->pagedim[$page][$type])) {
				$tmp = $this->pagedim[$page][$type]['llx'];
				$this->pagedim[$page][$type]['llx'] = $this->pagedim[$page][$type]['lly'];
				$this->pagedim[$page][$type]['lly'] = $tmp;
				$tmp = $this->pagedim[$page][$type]['urx'];
				$this->pagedim[$page][$type]['urx'] = $this->pagedim[$page][$type]['ury'];
				$this->pagedim[$page][$type]['ury'] = $tmp;
			}
		}
	}

	/**
	 * Set page orientation.
	 * @param string $orientation page orientation. Possible values are (case insensitive):<ul><li>P or Portrait (default)</li><li>L or Landscape</li><li>'' (empty string) for automatic orientation</li></ul>
	 * @param boolean $autopagebreak Boolean indicating if auto-page-break mode should be on or off.
	 * @param float $bottommargin bottom margin of the page.
	 * @access public
	 * @since 3.0.015 (2008-06-06)
	 */
	public function setPageOrientation($orientation, $autopagebreak='', $bottommargin='') {
		if (!isset($this->pagedim[$this->page]['MediaBox'])) {
			// the boundaries of the physical medium on which the page shall be displayed or printed
			$this->setPageBoxes($this->page, 'MediaBox', 0, 0, $this->fwPt, $this->fhPt, true);
		}
		if (!isset($this->pagedim[$this->page]['CropBox'])) {
			// the visible region of default user space
			$this->setPageBoxes($this->page, 'CropBox', $this->pagedim[$this->page]['MediaBox']['llx'], $this->pagedim[$this->page]['MediaBox']['lly'], $this->pagedim[$this->page]['MediaBox']['urx'], $this->pagedim[$this->page]['MediaBox']['ury'], true);
		}
		if (!isset($this->pagedim[$this->page]['BleedBox'])) {
			// the region to which the contents of the page shall be clipped when output in a production environment
			$this->setPageBoxes($this->page, 'BleedBox', $this->pagedim[$this->page]['CropBox']['llx'], $this->pagedim[$this->page]['CropBox']['lly'], $this->pagedim[$this->page]['CropBox']['urx'], $this->pagedim[$this->page]['CropBox']['ury'], true);
		}
		if (!isset($this->pagedim[$this->page]['TrimBox'])) {
			// the intended dimensions of the finished page after trimming
			$this->setPageBoxes($this->page, 'TrimBox', $this->pagedim[$this->page]['CropBox']['llx'], $this->pagedim[$this->page]['CropBox']['lly'], $this->pagedim[$this->page]['CropBox']['urx'], $this->pagedim[$this->page]['CropBox']['ury'], true);
		}
		if (!isset($this->pagedim[$this->page]['ArtBox'])) {
			// the page's meaningful content (including potential white space)
			$this->setPageBoxes($this->page, 'ArtBox', $this->pagedim[$this->page]['CropBox']['llx'], $this->pagedim[$this->page]['CropBox']['lly'], $this->pagedim[$this->page]['CropBox']['urx'], $this->pagedim[$this->page]['CropBox']['ury'], true);
		}
		if (!isset($this->pagedim[$this->page]['Rotate'])) {
			// The number of degrees by which the page shall be rotated clockwise when displayed or printed. The value shall be a multiple of 90.
			$this->pagedim[$this->page]['Rotate'] = 0;
		}
		if (!isset($this->pagedim[$this->page]['PZ'])) {
			// The page's preferred zoom (magnification) factor
			$this->pagedim[$this->page]['PZ'] = 1;
		}
		if ($this->fwPt > $this->fhPt) {
			// landscape
			$default_orientation = 'L';
		} else {
			// portrait
			$default_orientation = 'P';
		}
		$valid_orientations = array('P', 'L');
		if (empty($orientation)) {
			$orientation = $default_orientation;
		} else {
			$orientation = strtoupper($orientation{0});
		}
		if (in_array($orientation, $valid_orientations) AND ($orientation != $default_orientation)) {
			$this->CurOrientation = $orientation;
			$this->wPt = $this->fhPt;
			$this->hPt = $this->fwPt;
		} else {
			$this->CurOrientation = $default_orientation;
			$this->wPt = $this->fwPt;
			$this->hPt = $this->fhPt;
		}
		if ((abs($this->pagedim[$this->page]['MediaBox']['urx'] - $this->hPt) < $this->feps) AND (abs($this->pagedim[$this->page]['MediaBox']['ury'] - $this->wPt) < $this->feps)){
			// swap X and Y coordinates (change page orientation)
			$this->swapPageBoxCoordinates($this->page);
		}
		$this->w = $this->wPt / $this->k;
		$this->h = $this->hPt / $this->k;
		if ($this->empty_string($autopagebreak)) {
			if (isset($this->AutoPageBreak)) {
				$autopagebreak = $this->AutoPageBreak;
			} else {
				$autopagebreak = true;
			}
		}
		if ($this->empty_string($bottommargin)) {
			if (isset($this->bMargin)) {
				$bottommargin = $this->bMargin;
			} else {
				// default value = 2 cm
				$bottommargin = 2 * 28.35 / $this->k;
			}
		}
		$this->SetAutoPageBreak($autopagebreak, $bottommargin);
		// store page dimensions
		$this->pagedim[$this->page]['w'] = $this->wPt;
		$this->pagedim[$this->page]['h'] = $this->hPt;
		$this->pagedim[$this->page]['wk'] = $this->w;
		$this->pagedim[$this->page]['hk'] = $this->h;
		$this->pagedim[$this->page]['tm'] = $this->tMargin;
		$this->pagedim[$this->page]['bm'] = $bottommargin;
		$this->pagedim[$this->page]['lm'] = $this->lMargin;
		$this->pagedim[$this->page]['rm'] = $this->rMargin;
		$this->pagedim[$this->page]['pb'] = $autopagebreak;
		$this->pagedim[$this->page]['or'] = $this->CurOrientation;
		$this->pagedim[$this->page]['olm'] = $this->original_lMargin;
		$this->pagedim[$this->page]['orm'] = $this->original_rMargin;
	}

	/**
	 * Set regular expression to detect withespaces or word separators.
	 * The pattern delimiter must be the forward-slash character '/'.
	 * Some example patterns are:
	 * <pre>
	 * Non-Unicode or missing PCRE unicode support: '/[^\S\xa0]/'
	 * Unicode and PCRE unicode support: '/[^\S\P{Z}\xa0]/u'
	 * Unicode and PCRE unicode support in Chinese mode: '/[^\S\P{Z}\P{Lo}\xa0]/u'
	 * if PCRE unicode support is turned ON (\P is the negate class of \p):
	 * 	\p{Z} or \p{Separator}: any kind of Unicode whitespace or invisible separator.
	 * 	\p{Lo} or \p{Other_Letter}: a Unicode letter or ideograph that does not have lowercase and uppercase variants.
	 * 	\p{Lo} is needed for Chinese characters because are packed next to each other without spaces in between.
	 * </pre>
	 * @param string $re regular expression (leave empty for default).
	 * @access public
	 * @since 4.6.016 (2009-06-15)
	 */
	public function setSpacesRE($re='/[^\S\xa0]/') {
		$this->re_spaces = $re;
		$re_parts = explode('/', $re);
		// get pattern parts
		$this->re_space = array();
		if (isset($re_parts[1]) AND !empty($re_parts[1])) {
			$this->re_space['p'] = $re_parts[1];
		} else {
			$this->re_space['p'] = '[\s]';
		}
		// set pattern modifiers
		if (isset($re_parts[2]) AND !empty($re_parts[2])) {
			$this->re_space['m'] = $re_parts[2];
		} else {
			$this->re_space['m'] = '';
		}
	}

	/**
	 * Enable or disable Right-To-Left language mode
	 * @param Boolean $enable if true enable Right-To-Left language mode.
	 * @param Boolean $resetx if true reset the X position on direction change.
	 * @access public
	 * @since 2.0.000 (2008-01-03)
	 */
	public function setRTL($enable, $resetx=true) {
		$enable = $enable ? true : false;
		$resetx = ($resetx AND ($enable != $this->rtl));
		$this->rtl = $enable;
		$this->tmprtl = false;
		if ($resetx) {
			$this->Ln(0);
		}
	}

	/**
	 * Return the RTL status
	 * @return boolean
	 * @access public
	 * @since 4.0.012 (2008-07-24)
	 */
	public function getRTL() {
		return $this->rtl;
	}

	/**
	 * Force temporary RTL language direction
	 * @param mixed $mode can be false, 'L' for LTR or 'R' for RTL
	 * @access public
	 * @since 2.1.000 (2008-01-09)
	 */
	public function setTempRTL($mode) {
		$newmode = false;
		switch (strtoupper($mode)) {
			case 'LTR':
			case 'L': {
				if ($this->rtl) {
					$newmode = 'L';
				}
				break;
			}
			case 'RTL':
			case 'R': {
				if (!$this->rtl) {
					$newmode = 'R';
				}
				break;
			}
			case false:
			default: {
				$newmode = false;
				break;
			}
		}
		$this->tmprtl = $newmode;
	}

	/**
	 * Return the current temporary RTL status
	 * @return boolean
	 * @access public
	 * @since 4.8.014 (2009-11-04)
	 */
	public function isRTLTextDir() {
		return ($this->rtl OR ($this->tmprtl == 'R'));
	}

	/**
	 * Set the last cell height.
	 * @param float $h cell height.
	 * @author Nicola Asuni
	 * @access public
	 * @since 1.53.0.TC034
	 */
	public function setLastH($h) {
		$this->lasth = $h;
	}

	/**
	 * Reset the last cell height.
	 * @access public
	 * @since 5.9.000 (2010-10-03)
	 */
	public function resetLastH() {
		$this->lasth = ($this->FontSize * $this->cell_height_ratio) + $this->cell_padding['T'] + $this->cell_padding['B'];
	}

	/**
	 * Get the last cell height.
	 * @return last cell height
	 * @access public
	 * @since 4.0.017 (2008-08-05)
	 */
	public function getLastH() {
		return $this->lasth;
	}

	/**
	 * Set the adjusting factor to convert pixels to user units.
	 * @param float $scale adjusting factor to convert pixels to user units.
	 * @author Nicola Asuni
	 * @access public
	 * @since 1.5.2
	 */
	public function setImageScale($scale) {
		$this->imgscale = $scale;
	}

	/**
	 * Returns the adjusting factor to convert pixels to user units.
	 * @return float adjusting factor to convert pixels to user units.
	 * @author Nicola Asuni
	 * @access public
	 * @since 1.5.2
	 */
	public function getImageScale() {
		return $this->imgscale;
	}

	/**
	 * Returns an array of page dimensions:
	 * <ul><li>$this->pagedim[$this->page]['w'] = page width in points</li><li>$this->pagedim[$this->page]['h'] = height in points</li><li>$this->pagedim[$this->page]['wk'] = page width in user units</li><li>$this->pagedim[$this->page]['hk'] = page height in user units</li><li>$this->pagedim[$this->page]['tm'] = top margin</li><li>$this->pagedim[$this->page]['bm'] = bottom margin</li><li>$this->pagedim[$this->page]['lm'] = left margin</li><li>$this->pagedim[$this->page]['rm'] = right margin</li><li>$this->pagedim[$this->page]['pb'] = auto page break</li><li>$this->pagedim[$this->page]['or'] = page orientation</li><li>$this->pagedim[$this->page]['olm'] = original left margin</li><li>$this->pagedim[$this->page]['orm'] = original right margin</li><li>$this->pagedim[$this->page]['Rotate'] = The number of degrees by which the page shall be rotated clockwise when displayed or printed. The value shall be a multiple of 90.</li><li>$this->pagedim[$this->page]['PZ'] = The page's preferred zoom (magnification) factor.</li><li>$this->pagedim[$this->page]['trans'] : the style and duration of the visual transition to use when moving from another page to the given page during a presentation<ul><li>$this->pagedim[$this->page]['trans']['Dur'] = The page's display duration (also called its advance timing): the maximum length of time, in seconds, that the page shall be displayed during presentations before the viewer application shall automatically advance to the next page.</li><li>$this->pagedim[$this->page]['trans']['S'] = transition style : Split, Blinds, Box, Wipe, Dissolve, Glitter, R, Fly, Push, Cover, Uncover, Fade</li><li>$this->pagedim[$this->page]['trans']['D'] = The duration of the transition effect, in seconds.</li><li>$this->pagedim[$this->page]['trans']['Dm'] = (Split and Blinds transition styles only) The dimension in which the specified transition effect shall occur: H = Horizontal, V = Vertical. Default value: H.</li><li>$this->pagedim[$this->page]['trans']['M'] = (Split, Box and Fly transition styles only) The direction of motion for the specified transition effect: I = Inward from the edges of the page, O = Outward from the center of the pageDefault value: I.</li><li>$this->pagedim[$this->page]['trans']['Di'] = (Wipe, Glitter, Fly, Cover, Uncover and Push transition styles only) The direction in which the specified transition effect shall moves, expressed in degrees counterclockwise starting from a left-to-right direction. If the value is a number, it shall be one of: 0 = Left to right, 90 = Bottom to top (Wipe only), 180 = Right to left (Wipe only), 270 = Top to bottom, 315 = Top-left to bottom-right (Glitter only). If the value is a name, it shall be None, which is relevant only for the Fly transition when the value of SS is not 1.0. Default value: 0.</li><li>$this->pagedim[$this->page]['trans']['SS'] = (Fly transition style only) The starting or ending scale at which the changes shall be drawn. If M specifies an inward transition, the scale of the changes drawn shall progress from SS to 1.0 over the course of the transition. If M specifies an outward transition, the scale of the changes drawn shall progress from 1.0 to SS over the course of the transition. Default: 1.0. </li><li>$this->pagedim[$this->page]['trans']['B'] = (Fly transition style only) If true, the area that shall be flown in is rectangular and opaque. Default: false.</li></ul></li><li>$this->pagedim[$this->page]['MediaBox'] : the boundaries of the physical medium on which the page shall be displayed or printed<ul><li>$this->pagedim[$this->page]['MediaBox']['llx'] = lower-left x coordinate in points</li><li>$this->pagedim[$this->page]['MediaBox']['lly'] = lower-left y coordinate in points</li><li>$this->pagedim[$this->page]['MediaBox']['urx'] = upper-right x coordinate in points</li><li>$this->pagedim[$this->page]['MediaBox']['ury'] = upper-right y coordinate in points</li></ul></li><li>$this->pagedim[$this->page]['CropBox'] : the visible region of default user space<ul><li>$this->pagedim[$this->page]['CropBox']['llx'] = lower-left x coordinate in points</li><li>$this->pagedim[$this->page]['CropBox']['lly'] = lower-left y coordinate in points</li><li>$this->pagedim[$this->page]['CropBox']['urx'] = upper-right x coordinate in points</li><li>$this->pagedim[$this->page]['CropBox']['ury'] = upper-right y coordinate in points</li></ul></li><li>$this->pagedim[$this->page]['BleedBox'] : the region to which the contents of the page shall be clipped when output in a production environment<ul><li>$this->pagedim[$this->page]['BleedBox']['llx'] = lower-left x coordinate in points</li><li>$this->pagedim[$this->page]['BleedBox']['lly'] = lower-left y coordinate in points</li><li>$this->pagedim[$this->page]['BleedBox']['urx'] = upper-right x coordinate in points</li><li>$this->pagedim[$this->page]['BleedBox']['ury'] = upper-right y coordinate in points</li></ul></li><li>$this->pagedim[$this->page]['TrimBox'] : the intended dimensions of the finished page after trimming<ul><li>$this->pagedim[$this->page]['TrimBox']['llx'] = lower-left x coordinate in points</li><li>$this->pagedim[$this->page]['TrimBox']['lly'] = lower-left y coordinate in points</li><li>$this->pagedim[$this->page]['TrimBox']['urx'] = upper-right x coordinate in points</li><li>$this->pagedim[$this->page]['TrimBox']['ury'] = upper-right y coordinate in points</li></ul></li><li>$this->pagedim[$this->page]['ArtBox'] : the extent of the page's meaningful content<ul><li>$this->pagedim[$this->page]['ArtBox']['llx'] = lower-left x coordinate in points</li><li>$this->pagedim[$this->page]['ArtBox']['lly'] = lower-left y coordinate in points</li><li>$this->pagedim[$this->page]['ArtBox']['urx'] = upper-right x coordinate in points</li><li>$this->pagedim[$this->page]['ArtBox']['ury'] = upper-right y coordinate in points</li></ul></li></ul>
	 * @param int $pagenum page number (empty = current page)
	 * @return array of page dimensions.
	 * @author Nicola Asuni
	 * @access public
	 * @since 4.5.027 (2009-03-16)
	 */
	public function getPageDimensions($pagenum='') {
		if (empty($pagenum)) {
			$pagenum = $this->page;
		}
		return $this->pagedim[$pagenum];
	}

	/**
	 * Returns the page width in units.
	 * @param int $pagenum page number (empty = current page)
	 * @return int page width.
	 * @author Nicola Asuni
	 * @access public
	 * @since 1.5.2
	 * @see getPageDimensions()
	 */
	public function getPageWidth($pagenum='') {
		if (empty($pagenum)) {
			return $this->w;
		}
		return $this->pagedim[$pagenum]['w'];
	}

	/**
	 * Returns the page height in units.
	 * @param int $pagenum page number (empty = current page)
	 * @return int page height.
	 * @author Nicola Asuni
	 * @access public
	 * @since 1.5.2
	 * @see getPageDimensions()
	 */
	public function getPageHeight($pagenum='') {
		if (empty($pagenum)) {
			return $this->h;
		}
		return $this->pagedim[$pagenum]['h'];
	}

	/**
	 * Returns the page break margin.
	 * @param int $pagenum page number (empty = current page)
	 * @return int page break margin.
	 * @author Nicola Asuni
	 * @access public
	 * @since 1.5.2
	 * @see getPageDimensions()
	 */
	public function getBreakMargin($pagenum='') {
		if (empty($pagenum)) {
			return $this->bMargin;
		}
		return $this->pagedim[$pagenum]['bm'];
	}

	/**
	 * Returns the scale factor (number of points in user unit).
	 * @return int scale factor.
	 * @author Nicola Asuni
	 * @access public
	 * @since 1.5.2
	 */
	public function getScaleFactor() {
		return $this->k;
	}

	/**
	 * Defines the left, top and right margins.
	 * @param float $left Left margin.
	 * @param float $top Top margin.
	 * @param float $right Right margin. Default value is the left one.
	 * @param boolean $keepmargins if true overwrites the default page margins
	 * @access public
	 * @since 1.0
	 * @see SetLeftMargin(), SetTopMargin(), SetRightMargin(), SetAutoPageBreak()
	 */
	public function SetMargins($left, $top, $right=-1, $keepmargins=false) {
		//Set left, top and right margins
		$this->lMargin = $left;
		$this->tMargin = $top;
		if ($right == -1) {
			$right = $left;
		}
		$this->rMargin = $right;
		if ($keepmargins) {
			// overwrite original values
			$this->original_lMargin = $this->lMargin;
			$this->original_rMargin = $this->rMargin;
		}
	}

	/**
	 * Defines the left margin. The method can be called before creating the first page. If the current abscissa gets out of page, it is brought back to the margin.
	 * @param float $margin The margin.
	 * @access public
	 * @since 1.4
	 * @see SetTopMargin(), SetRightMargin(), SetAutoPageBreak(), SetMargins()
	 */
	public function SetLeftMargin($margin) {
		//Set left margin
		$this->lMargin = $margin;
		if (($this->page > 0) AND ($this->x < $margin)) {
			$this->x = $margin;
		}
	}

	/**
	 * Defines the top margin. The method can be called before creating the first page.
	 * @param float $margin The margin.
	 * @access public
	 * @since 1.5
	 * @see SetLeftMargin(), SetRightMargin(), SetAutoPageBreak(), SetMargins()
	 */
	public function SetTopMargin($margin) {
		//Set top margin
		$this->tMargin = $margin;
		if (($this->page > 0) AND ($this->y < $margin)) {
			$this->y = $margin;
		}
	}

	/**
	 * Defines the right margin. The method can be called before creating the first page.
	 * @param float $margin The margin.
	 * @access public
	 * @since 1.5
	 * @see SetLeftMargin(), SetTopMargin(), SetAutoPageBreak(), SetMargins()
	 */
	public function SetRightMargin($margin) {
		$this->rMargin = $margin;
		if (($this->page > 0) AND ($this->x > ($this->w - $margin))) {
			$this->x = $this->w - $margin;
		}
	}

	/**
	 * Set the same internal Cell padding for top, right, bottom, left-
	 * @param float $pad internal padding.
	 * @access public
	 * @since 2.1.000 (2008-01-09)
	 * @see getCellPaddings(), setCellPaddings()
	 */
	public function SetCellPadding($pad) {
		if ($pad >= 0) {
			$this->cell_padding['L'] = $pad;
			$this->cell_padding['T'] = $pad;
			$this->cell_padding['R'] = $pad;
			$this->cell_padding['B'] = $pad;
		}
	}

	/**
	 * Set the internal Cell paddings.
	 * @param float $left left padding
	 * @param float $top top padding
	 * @param float $right right padding
	 * @param float $bottom bottom padding
	 * @access public
	 * @since 5.9.000 (2010-10-03)
	 * @see getCellPaddings(), SetCellPadding()
	 */
	public function setCellPaddings($left='', $top='', $right='', $bottom='') {
		if (($left !== '') AND ($left >= 0)) {
			$this->cell_padding['L'] = $left;
		}
		if (($top !== '') AND ($top >= 0)) {
			$this->cell_padding['T'] = $top;
		}
		if (($right !== '') AND ($right >= 0)) {
			$this->cell_padding['R'] = $right;
		}
		if (($bottom !== '') AND ($bottom >= 0)) {
			$this->cell_padding['B'] = $bottom;
		}
	}

	/**
	 * Get the internal Cell padding array.
	 * @return array of padding values
	 * @access public
	 * @since 5.9.000 (2010-10-03)
	 * @see setCellPaddings(), SetCellPadding()
	 */
	public function getCellPaddings() {
		return $this->cell_padding;
	}

	/**
	 * Set the internal Cell margins.
	 * @param float $left left margin
	 * @param float $top top margin
	 * @param float $right right margin
	 * @param float $bottom bottom margin
	 * @access public
	 * @since 5.9.000 (2010-10-03)
	 * @see getCellMargins()
	 */
	public function setCellMargins($left='', $top='', $right='', $bottom='') {
		if (($left !== '') AND ($left >= 0)) {
			$this->cell_margin['L'] = $left;
		}
		if (($top !== '') AND ($top >= 0)) {
			$this->cell_margin['T'] = $top;
		}
		if (($right !== '') AND ($right >= 0)) {
			$this->cell_margin['R'] = $right;
		}
		if (($bottom !== '') AND ($bottom >= 0)) {
			$this->cell_margin['B'] = $bottom;
		}
	}

	/**
	 * Get the internal Cell margin array.
	 * @return array of margin values
	 * @access public
	 * @since 5.9.000 (2010-10-03)
	 * @see setCellMargins()
	 */
	public function getCellMargins() {
		return $this->cell_margin;
	}

	/**
	 * Adjust the internal Cell padding array to take account of the line width.
	 * @param mixed $brd Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @return array of adjustments
	 * @access public
	 * @since 5.9.000 (2010-10-03)
	 */
	protected function adjustCellPadding($brd=0) {
		if (empty($brd)) {
			return;
		}
		if (is_string($brd)) {
			// convert string to array
			$slen = strlen($brd);
			$newbrd = array();
			for ($i = 0; $i < $slen; ++$i) {
				$newbrd[$brd{$i}] = true;
			}
			$brd = $newbrd;
		} elseif (($brd === 1) OR ($brd === true) OR (is_numeric($brd) AND (intval($brd) > 0))) {
			$brd = array('LRTB' => true);
		}
		if (!is_array($brd)) {
			return;
		}
		// store current cell padding
		$cp = $this->cell_padding;
		// select border mode
		if (isset($brd['mode'])) {
			$mode = $brd['mode'];
			unset($brd['mode']);
		} else {
			$mode = 'normal';
		}
		// process borders
		foreach ($brd as $border => $style) {
			$line_width = $this->LineWidth;
			if (is_array($style) AND isset($style['width'])) {
				// get border width
				$line_width = $style['width'];
			}
			$adj = 0; // line width inside the cell
			switch ($mode) {
				case 'ext': {
					$adj = 0;
					break;
				}
				case 'int': {
					$adj = $line_width;
					break;
				}
				case 'normal':
				default: {
					$adj = ($line_width / 2);
					break;
				}
			}
			// correct internal cell padding if required to avoid overlap between text and lines
			if ((strpos($border,'T') !== false) AND ($this->cell_padding['T'] < $adj)) {
				$this->cell_padding['T'] = $adj;
			}
			if ((strpos($border,'R') !== false) AND ($this->cell_padding['R'] < $adj)) {
				$this->cell_padding['R'] = $adj;
			}
			if ((strpos($border,'B') !== false) AND ($this->cell_padding['B'] < $adj)) {
				$this->cell_padding['B'] = $adj;
			}
			if ((strpos($border,'L') !== false) AND ($this->cell_padding['L'] < $adj)) {
				$this->cell_padding['L'] = $adj;
			}
		}
		return array('T' => ($this->cell_padding['T'] - $cp['T']), 'R' => ($this->cell_padding['R'] - $cp['R']), 'B' => ($this->cell_padding['B'] - $cp['B']), 'L' => ($this->cell_padding['L'] - $cp['L']));
	}

	/**
	 * Enables or disables the automatic page breaking mode. When enabling, the second parameter is the distance from the bottom of the page that defines the triggering limit. By default, the mode is on and the margin is 2 cm.
	 * @param boolean $auto Boolean indicating if mode should be on or off.
	 * @param float $margin Distance from the bottom of the page.
	 * @access public
	 * @since 1.0
	 * @see Cell(), MultiCell(), AcceptPageBreak()
	 */
	public function SetAutoPageBreak($auto, $margin=0) {
		//Set auto page break mode and triggering margin
		$this->AutoPageBreak = $auto;
		$this->bMargin = $margin;
		$this->PageBreakTrigger = $this->h - $margin;
	}

	/**
	 * Defines the way the document is to be displayed by the viewer.
	 * @param mixed $zoom The zoom to use. It can be one of the following string values or a number indicating the zooming factor to use. <ul><li>fullpage: displays the entire page on screen </li><li>fullwidth: uses maximum width of window</li><li>real: uses real size (equivalent to 100% zoom)</li><li>default: uses viewer default mode</li></ul>
	 * @param string $layout The page layout. Possible values are:<ul><li>SinglePage Display one page at a time</li><li>OneColumn Display the pages in one column</li><li>TwoColumnLeft Display the pages in two columns, with odd-numbered pages on the left</li><li>TwoColumnRight Display the pages in two columns, with odd-numbered pages on the right</li><li>TwoPageLeft (PDF 1.5) Display the pages two at a time, with odd-numbered pages on the left</li><li>TwoPageRight (PDF 1.5) Display the pages two at a time, with odd-numbered pages on the right</li></ul>
	 * @param string $mode A name object specifying how the document should be displayed when opened:<ul><li>UseNone Neither document outline nor thumbnail images visible</li><li>UseOutlines Document outline visible</li><li>UseThumbs Thumbnail images visible</li><li>FullScreen Full-screen mode, with no menu bar, window controls, or any other window visible</li><li>UseOC (PDF 1.5) Optional content group panel visible</li><li>UseAttachments (PDF 1.6) Attachments panel visible</li></ul>
	 * @access public
	 * @since 1.2
	 */
	public function SetDisplayMode($zoom, $layout='SinglePage', $mode='UseNone') {
		//Set display mode in viewer
		if (($zoom == 'fullpage') OR ($zoom == 'fullwidth') OR ($zoom == 'real') OR ($zoom == 'default') OR (!is_string($zoom))) {
			$this->ZoomMode = $zoom;
		} else {
			$this->Error('Incorrect zoom display mode: '.$zoom);
		}
		switch ($layout) {
			case 'default':
			case 'single':
			case 'SinglePage': {
				$this->LayoutMode = 'SinglePage';
				break;
			}
			case 'continuous':
			case 'OneColumn': {
				$this->LayoutMode = 'OneColumn';
				break;
			}
			case 'two':
			case 'TwoColumnLeft': {
				$this->LayoutMode = 'TwoColumnLeft';
				break;
			}
			case 'TwoColumnRight': {
				$this->LayoutMode = 'TwoColumnRight';
				break;
			}
			case 'TwoPageLeft': {
				$this->LayoutMode = 'TwoPageLeft';
				break;
			}
			case 'TwoPageRight': {
				$this->LayoutMode = 'TwoPageRight';
				break;
			}
			default: {
				$this->LayoutMode = 'SinglePage';
			}
		}
		switch ($mode) {
			case 'UseNone': {
				$this->PageMode = 'UseNone';
				break;
			}
			case 'UseOutlines': {
				$this->PageMode = 'UseOutlines';
				break;
			}
			case 'UseThumbs': {
				$this->PageMode = 'UseThumbs';
				break;
			}
			case 'FullScreen': {
				$this->PageMode = 'FullScreen';
				break;
			}
			case 'UseOC': {
				$this->PageMode = 'UseOC';
				break;
			}
			case '': {
				$this->PageMode = 'UseAttachments';
				break;
			}
			default: {
				$this->PageMode = 'UseNone';
			}
		}
	}

	/**
	 * Activates or deactivates page compression. When activated, the internal representation of each page is compressed, which leads to a compression ratio of about 2 for the resulting document. Compression is on by default.
	 * Note: the Zlib extension is required for this feature. If not present, compression will be turned off.
	 * @param boolean $compress Boolean indicating if compression must be enabled.
	 * @access public
	 * @since 1.4
	 */
	public function SetCompression($compress) {
		//Set page compression
		if (function_exists('gzcompress')) {
			$this->compress = $compress ? true : false;
		} else {
			$this->compress = false;
		}
	}

	/**
	 * Defines the title of the document.
	 * @param string $title The title.
	 * @access public
	 * @since 1.2
	 * @see SetAuthor(), SetCreator(), SetKeywords(), SetSubject()
	 */
	public function SetTitle($title) {
		//Title of document
		$this->title = $title;
	}

	/**
	 * Defines the subject of the document.
	 * @param string $subject The subject.
	 * @access public
	 * @since 1.2
	 * @see SetAuthor(), SetCreator(), SetKeywords(), SetTitle()
	 */
	public function SetSubject($subject) {
		//Subject of document
		$this->subject = $subject;
	}

	/**
	 * Defines the author of the document.
	 * @param string $author The name of the author.
	 * @access public
	 * @since 1.2
	 * @see SetCreator(), SetKeywords(), SetSubject(), SetTitle()
	 */
	public function SetAuthor($author) {
		//Author of document
		$this->author = $author;
	}

	/**
	 * Associates keywords with the document, generally in the form 'keyword1 keyword2 ...'.
	 * @param string $keywords The list of keywords.
	 * @access public
	 * @since 1.2
	 * @see SetAuthor(), SetCreator(), SetSubject(), SetTitle()
	 */
	public function SetKeywords($keywords) {
		//Keywords of document
		$this->keywords = $keywords;
	}

	/**
	 * Defines the creator of the document. This is typically the name of the application that generates the PDF.
	 * @param string $creator The name of the creator.
	 * @access public
	 * @since 1.2
	 * @see SetAuthor(), SetKeywords(), SetSubject(), SetTitle()
	 */
	public function SetCreator($creator) {
		//Creator of document
		$this->creator = $creator;
	}

	/**
	 * This method is automatically called in case of fatal error; it simply outputs the message and halts the execution. An inherited class may override it to customize the error handling but should always halt the script, or the resulting document would probably be invalid.
	 * 2004-06-11 :: Nicola Asuni : changed bold tag with strong
	 * @param string $msg The error message
	 * @access public
	 * @since 1.0
	 */
	public function Error($msg) {
		// unset all class variables
		$this->_destroy(true);
		// exit program and print error
		die('<strong>TCPDF ERROR: </strong>'.$msg);
	}

	/**
	 * This method begins the generation of the PDF document.
	 * It is not necessary to call it explicitly because AddPage() does it automatically.
	 * Note: no page is created by this method
	 * @access public
	 * @since 1.0
	 * @see AddPage(), Close()
	 */
	public function Open() {
		//Begin document
		$this->state = 1;
	}

	/**
	 * Terminates the PDF document.
	 * It is not necessary to call this method explicitly because Output() does it automatically.
	 * If the document contains no page, AddPage() is called to prevent from getting an invalid document.
	 * @access public
	 * @since 1.0
	 * @see Open(), Output()
	 */
	public function Close() {
		if ($this->state == 3) {
			return;
		}
		if ($this->page == 0) {
			$this->AddPage();
		}
		// save current graphic settings
		$gvars = $this->getGraphicVars();
		$this->lastpage(true);
		$this->SetAutoPageBreak(false);
		$this->x = 0;
		$this->y = $this->h - (1 / $this->k);
		$this->lMargin = 0;
		$this->_out('q');
		$this->setVisibility('screen');
		$this->SetFont('helvetica', '', 1);
		$this->SetTextColor(255, 255, 255);
		$msg = "\x50\x6f\x77\x65\x72\x65\x64\x20\x62\x79\x20\x54\x43\x50\x44\x46\x20\x28\x77\x77\x77\x2e\x74\x63\x70\x64\x66\x2e\x6f\x72\x67\x29";
		$lnk = "\x68\x74\x74\x70\x3a\x2f\x2f\x77\x77\x77\x2e\x74\x63\x70\x64\x66\x2e\x6f\x72\x67";
		$this->Cell(0, 0, $msg, 0, 0, 'L', 0, $lnk, 0, false, 'D', 'B');
		$this->setVisibility('all');
		$this->_out('Q');
		// restore graphic settings
		$this->setGraphicVars($gvars);
		// close page
		$this->endPage();
		// close document
		$this->_enddoc();
		// unset all class variables (except critical ones)
		$this->_destroy(false);
	}

	/**
	 * Move pointer at the specified document page and update page dimensions.
	 * @param int $pnum page number (1 ... numpages)
	 * @param boolean $resetmargins if true reset left, right, top margins and Y position.
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see getPage(), lastpage(), getNumPages()
	 */
	public function setPage($pnum, $resetmargins=false) {
		if (($pnum == $this->page) AND ($this->state == 2)) {
			return;
		}
		if (($pnum > 0) AND ($pnum <= $this->numpages)) {
			$this->state = 2;
			// save current graphic settings
			//$gvars = $this->getGraphicVars();
			$oldpage = $this->page;
			$this->page = $pnum;
			$this->wPt = $this->pagedim[$this->page]['w'];
			$this->hPt = $this->pagedim[$this->page]['h'];
			$this->w = $this->pagedim[$this->page]['wk'];
			$this->h = $this->pagedim[$this->page]['hk'];
			$this->tMargin = $this->pagedim[$this->page]['tm'];
			$this->bMargin = $this->pagedim[$this->page]['bm'];
			$this->original_lMargin = $this->pagedim[$this->page]['olm'];
			$this->original_rMargin = $this->pagedim[$this->page]['orm'];
			$this->AutoPageBreak = $this->pagedim[$this->page]['pb'];
			$this->CurOrientation = $this->pagedim[$this->page]['or'];
			$this->SetAutoPageBreak($this->AutoPageBreak, $this->bMargin);
			// restore graphic settings
			//$this->setGraphicVars($gvars);
			if ($resetmargins) {
				$this->lMargin = $this->pagedim[$this->page]['olm'];
				$this->rMargin = $this->pagedim[$this->page]['orm'];
				$this->SetY($this->tMargin);
			} else {
				// account for booklet mode
				if ($this->pagedim[$this->page]['olm'] != $this->pagedim[$oldpage]['olm']) {
					$deltam = $this->pagedim[$this->page]['olm'] - $this->pagedim[$this->page]['orm'];
					$this->lMargin += $deltam;
					$this->rMargin -= $deltam;
				}
			}
		} else {
			$this->Error('Wrong page number on setPage() function: '.$pnum);
		}
	}

	/**
	 * Reset pointer to the last document page.
	 * @param boolean $resetmargins if true reset left, right, top margins and Y position.
	 * @access public
	 * @since 2.0.000 (2008-01-04)
	 * @see setPage(), getPage(), getNumPages()
	 */
	public function lastPage($resetmargins=false) {
		$this->setPage($this->getNumPages(), $resetmargins);
	}

	/**
	 * Get current document page number.
	 * @return int page number
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see setPage(), lastpage(), getNumPages()
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * Get the total number of insered pages.
	 * @return int number of pages
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see setPage(), getPage(), lastpage()
	 */
	public function getNumPages() {
		return $this->numpages;
	}

	/**
	 * Adds a new TOC (Table Of Content) page to the document.
	 * @param string $orientation page orientation.
	 * @param boolean $keepmargins if true overwrites the default page margins with the current margins
	 * @access public
	 * @since 5.0.001 (2010-05-06)
	 * @see AddPage(), startPage(), endPage(), endTOCPage()
	 */
	public function addTOCPage($orientation='', $format='', $keepmargins=false) {
		$this->AddPage($orientation, $format, $keepmargins, true);
	}

	/**
	 * Terminate the current TOC (Table Of Content) page
	 * @access public
	 * @since 5.0.001 (2010-05-06)
	 * @see AddPage(), startPage(), endPage(), addTOCPage()
	 */
	public function endTOCPage() {
		$this->endPage(true);
	}

	/**
	 * Adds a new page to the document. If a page is already present, the Footer() method is called first to output the footer (if enabled). Then the page is added, the current position set to the top-left corner according to the left and top margins (or top-right if in RTL mode), and Header() is called to display the header (if enabled).
	 * The origin of the coordinate system is at the top-left corner (or top-right for RTL) and increasing ordinates go downwards.
	 * @param string $orientation page orientation. Possible values are (case insensitive):<ul><li>P or PORTRAIT (default)</li><li>L or LANDSCAPE</li></ul>
	 * @param mixed $format The format used for pages. It can be either: one of the string values specified at getPageSizeFromFormat() or an array of parameters specified at setPageFormat().
	 * @param boolean $keepmargins if true overwrites the default page margins with the current margins
	 * @param boolean $tocpage if true set the tocpage state to true (the added page will be used to display Table Of Content).
	 * @access public
	 * @since 1.0
	 * @see startPage(), endPage(), addTOCPage(), endTOCPage(), getPageSizeFromFormat(), setPageFormat()
	 */
	public function AddPage($orientation='', $format='', $keepmargins=false, $tocpage=false) {
		if ($this->inxobj) {
			// we are inside an XObject template
			return;
		}
		if (!isset($this->original_lMargin) OR $keepmargins) {
			$this->original_lMargin = $this->lMargin;
		}
		if (!isset($this->original_rMargin) OR $keepmargins) {
			$this->original_rMargin = $this->rMargin;
		}
		// terminate previous page
		$this->endPage();
		// start new page
		$this->startPage($orientation, $format, $tocpage);
	}

	/**
	 * Terminate the current page
	 * @param boolean $tocpage if true set the tocpage state to false (end the page used to display Table Of Content).
	 * @access public
	 * @since 4.2.010 (2008-11-14)
	 * @see AddPage(), startPage(), addTOCPage(), endTOCPage()
	 */
	public function endPage($tocpage=false) {
		// check if page is already closed
		if (($this->page == 0) OR ($this->numpages > $this->page) OR (!$this->pageopen[$this->page])) {
			return;
		}
		$this->InFooter = true;
		// print page footer
		$this->setFooter();
		// close page
		$this->_endpage();
		// mark page as closed
		$this->pageopen[$this->page] = false;
		$this->InFooter = false;
		if ($tocpage) {
			$this->tocpage = false;
		}
	}

	/**
	 * Starts a new page to the document. The page must be closed using the endPage() function.
	 * The origin of the coordinate system is at the top-left corner and increasing ordinates go downwards.
	 * @param string $orientation page orientation. Possible values are (case insensitive):<ul><li>P or PORTRAIT (default)</li><li>L or LANDSCAPE</li></ul>
	 * @param mixed $format The format used for pages. It can be either: one of the string values specified at getPageSizeFromFormat() or an array of parameters specified at setPageFormat().
	 * @access public
	 * @since 4.2.010 (2008-11-14)
	 * @see AddPage(), endPage(), addTOCPage(), endTOCPage(), getPageSizeFromFormat(), setPageFormat()
	 */
	public function startPage($orientation='', $format='', $tocpage=false) {
		if ($tocpage) {
			$this->tocpage = true;
		}
		if ($this->numpages > $this->page) {
			// this page has been already added
			$this->setPage($this->page + 1);
			$this->SetY($this->tMargin);
			return;
		}
		// start a new page
		if ($this->state == 0) {
			$this->Open();
		}
		++$this->numpages;
		$this->swapMargins($this->booklet);
		// save current graphic settings
		$gvars = $this->getGraphicVars();
		// start new page
		$this->_beginpage($orientation, $format);
		// mark page as open
		$this->pageopen[$this->page] = true;
		// restore graphic settings
		$this->setGraphicVars($gvars);
		// mark this point
		$this->setPageMark();
		// print page header
		$this->setHeader();
		// restore graphic settings
		$this->setGraphicVars($gvars);
		// mark this point
		$this->setPageMark();
		// print table header (if any)
		$this->setTableHeader();
		// set mark for empty page check
		$this->emptypagemrk[$this->page]= $this->pagelen[$this->page];
	}

	/**
 	 * Set start-writing mark on current page stream used to put borders and fills.
 	 * Borders and fills are always created after content and inserted on the position marked by this method.
 	 * This function must be called after calling Image() function for a background image.
 	 * Background images must be always inserted before calling Multicell() or WriteHTMLCell() or WriteHTML() functions.
 	 * @access public
 	 * @since 4.0.016 (2008-07-30)
	 */
	public function setPageMark() {
		$this->intmrk[$this->page] = $this->pagelen[$this->page];
		$this->bordermrk[$this->page] = $this->intmrk[$this->page];
		$this->setContentMark();
	}

	/**
 	 * Set start-writing mark on selected page.
 	 * Borders and fills are always created after content and inserted on the position marked by this method.
 	 * @param int $page page number (default is the current page)
 	 * @access protected
 	 * @since 4.6.021 (2009-07-20)
	 */
	protected function setContentMark($page=0) {
		if ($page <= 0) {
			$page = $this->page;
		}
		if (isset($this->footerlen[$page])) {
			$this->cntmrk[$page] = $this->pagelen[$page] - $this->footerlen[$page];
		} else {
			$this->cntmrk[$page] = $this->pagelen[$page];
		}
	}

	/**
 	 * Set header data.
	 * @param string $ln header image logo
	 * @param string $lw header image logo width in mm
	 * @param string $ht string to print as title on document header
	 * @param string $hs string to print on document header
	 * @access public
	 */
	public function setHeaderData($ln='', $lw=0, $ht='', $hs='') {
		$this->header_logo = $ln;
		$this->header_logo_width = $lw;
		$this->header_title = $ht;
		$this->header_string = $hs;
	}

	/**
 	 * Returns header data:
 	 * <ul><li>$ret['logo'] = logo image</li><li>$ret['logo_width'] = width of the image logo in user units</li><li>$ret['title'] = header title</li><li>$ret['string'] = header description string</li></ul>
	 * @return array()
	 * @access public
	 * @since 4.0.012 (2008-07-24)
	 */
	public function getHeaderData() {
		$ret = array();
		$ret['logo'] = $this->header_logo;
		$ret['logo_width'] = $this->header_logo_width;
		$ret['title'] = $this->header_title;
		$ret['string'] = $this->header_string;
		return $ret;
	}

	/**
 	 * Set header margin.
	 * (minimum distance between header and top page margin)
	 * @param int $hm distance in user units
	 * @access public
	 */
	public function setHeaderMargin($hm=10) {
		$this->header_margin = $hm;
	}

	/**
 	 * Returns header margin in user units.
	 * @return float
	 * @since 4.0.012 (2008-07-24)
	 * @access public
	 */
	public function getHeaderMargin() {
		return $this->header_margin;
	}

	/**
 	 * Set footer margin.
	 * (minimum distance between footer and bottom page margin)
	 * @param int $fm distance in user units
	 * @access public
	 */
	public function setFooterMargin($fm=10) {
		$this->footer_margin = $fm;
	}

	/**
 	 * Returns footer margin in user units.
	 * @return float
	 * @since 4.0.012 (2008-07-24)
	 * @access public
	 */
	public function getFooterMargin() {
		return $this->footer_margin;
	}
	/**
 	 * Set a flag to print page header.
	 * @param boolean $val set to true to print the page header (default), false otherwise.
	 * @access public
	 */
	public function setPrintHeader($val=true) {
		$this->print_header = $val;
	}

	/**
 	 * Set a flag to print page footer.
	 * @param boolean $value set to true to print the page footer (default), false otherwise.
	 * @access public
	 */
	public function setPrintFooter($val=true) {
		$this->print_footer = $val;
	}

	/**
 	 * Return the right-bottom (or left-bottom for RTL) corner X coordinate of last inserted image
	 * @return float
	 * @access public
	 */
	public function getImageRBX() {
		return $this->img_rb_x;
	}

	/**
 	 * Return the right-bottom (or left-bottom for RTL) corner Y coordinate of last inserted image
	 * @return float
	 * @access public
	 */
	public function getImageRBY() {
		return $this->img_rb_y;
	}

	/**
 	 * This method is used to render the page header.
 	 * It is automatically called by AddPage() and could be overwritten in your own inherited class.
	 * @access public
	 */
	public function Header() {
		$ormargins = $this->getOriginalMargins();
		$headerfont = $this->getHeaderFont();
		$headerdata = $this->getHeaderData();
		if (($headerdata['logo']) AND ($headerdata['logo'] != K_BLANK_IMAGE)) {
			$this->Image(K_PATH_IMAGES.$headerdata['logo'], '', '', $headerdata['logo_width']);
			$imgy = $this->getImageRBY();
		} else {
			$imgy = $this->GetY();
		}
		$cell_height = round(($this->getCellHeightRatio() * $headerfont[2]) / $this->getScaleFactor(), 2);
		// set starting margin for text data cell
		if ($this->getRTL()) {
			$header_x = $ormargins['right'] + ($headerdata['logo_width'] * 1.1);
		} else {
			$header_x = $ormargins['left'] + ($headerdata['logo_width'] * 1.1);
		}
		$this->SetTextColor(0, 0, 0);
		// header title
		$this->SetFont($headerfont[0], 'B', $headerfont[2] + 1);
		$this->SetX($header_x);
		$this->Cell(0, $cell_height, $headerdata['title'], 0, 1, '', 0, '', 0);
		// header string
		$this->SetFont($headerfont[0], $headerfont[1], $headerfont[2]);
		$this->SetX($header_x);
		$this->MultiCell(0, $cell_height, $headerdata['string'], 0, '', 0, 1, '', '', true, 0, false);
		// print an ending header line
		$this->SetLineStyle(array('width' => 0.85 / $this->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		$this->SetY((2.835 / $this->getScaleFactor()) + max($imgy, $this->GetY()));
		if ($this->getRTL()) {
			$this->SetX($ormargins['right']);
		} else {
			$this->SetX($ormargins['left']);
		}
		$this->Cell(0, 0, '', 'T', 0, 'C');
	}

	/**
 	 * This method is used to render the page footer.
 	 * It is automatically called by AddPage() and could be overwritten in your own inherited class.
	 * @access public
	 */
	public function Footer() {
		$cur_y = $this->GetY();
		$ormargins = $this->getOriginalMargins();
		$this->SetTextColor(0, 0, 0);
		//set style for cell border
		$line_width = 0.85 / $this->getScaleFactor();
		$this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		//print document barcode
		$barcode = $this->getBarcode();
		if (!empty($barcode)) {
			$this->Ln($line_width);
			$barcode_width = round(($this->getPageWidth() - $ormargins['left'] - $ormargins['right']) / 3);
			$style = array(
				'position' => $this->rtl?'R':'L',
				'align' => $this->rtl?'R':'L',
				'stretch' => false,
				'fitwidth' => true,
				'cellfitalign' => '',
				'border' => false,
				'padding' => 0,
				'fgcolor' => array(0,0,0),
				'bgcolor' => false,
				'text' => false
			);
			$this->write1DBarcode($barcode, 'C128B', '', $cur_y + $line_width, '', (($this->getFooterMargin() / 3) - $line_width), 0.3, $style, '');
		}
		if (empty($this->pagegroups)) {
			$pagenumtxt = $this->l['w_page'].' '.$this->getAliasNumPage().' / '.$this->getAliasNbPages();
		} else {
			$pagenumtxt = $this->l['w_page'].' '.$this->getPageNumGroupAlias().' / '.$this->getPageGroupAlias();
		}
		$this->SetY($cur_y);
		//Print page number
		if ($this->getRTL()) {
			$this->SetX($ormargins['right']);
			$this->Cell(0, 0, $pagenumtxt, 'T', 0, 'L');
		} else {
			$this->SetX($ormargins['left']);
			$this->Cell(0, 0, $pagenumtxt, 'T', 0, 'R');
		}
	}

	/**
 	 * This method is used to render the page header.
 	 * @access protected
 	 * @since 4.0.012 (2008-07-24)
	 */
	protected function setHeader() {
		if ($this->print_header) {
			$this->setGraphicVars($this->default_graphic_vars);
			$temp_thead = $this->thead;
			$temp_theadMargins = $this->theadMargins;
			$lasth = $this->lasth;
			$this->_out('q');
			$this->rMargin = $this->original_rMargin;
			$this->lMargin = $this->original_lMargin;
			$this->SetCellPadding(0);
			//set current position
			if ($this->rtl) {
				$this->SetXY($this->original_rMargin, $this->header_margin);
			} else {
				$this->SetXY($this->original_lMargin, $this->header_margin);
			}
			$this->SetFont($this->header_font[0], $this->header_font[1], $this->header_font[2]);
			$this->Header();
			//restore position
			if ($this->rtl) {
				$this->SetXY($this->original_rMargin, $this->tMargin);
			} else {
				$this->SetXY($this->original_lMargin, $this->tMargin);
			}
			$this->_out('Q');
			$this->lasth = $lasth;
			$this->thead = $temp_thead;
			$this->theadMargins = $temp_theadMargins;
			$this->newline = false;
		}
	}

	/**
 	 * This method is used to render the page footer.
 	 * @access protected
 	 * @since 4.0.012 (2008-07-24)
	 */
	protected function setFooter() {
		//Page footer
		// save current graphic settings
		$gvars = $this->getGraphicVars();
		// mark this point
		$this->footerpos[$this->page] = $this->pagelen[$this->page];
		$this->_out("\n");
		if ($this->print_footer) {
			$this->setGraphicVars($this->default_graphic_vars);
			$this->current_column = 0;
			$this->num_columns = 1;
			$temp_thead = $this->thead;
			$temp_theadMargins = $this->theadMargins;
			$lasth = $this->lasth;
			$this->_out('q');
			$this->rMargin = $this->original_rMargin;
			$this->lMargin = $this->original_lMargin;
			$this->SetCellPadding(0);
			//set current position
			$footer_y = $this->h - $this->footer_margin;
			if ($this->rtl) {
				$this->SetXY($this->original_rMargin, $footer_y);
			} else {
				$this->SetXY($this->original_lMargin, $footer_y);
			}
			$this->SetFont($this->footer_font[0], $this->footer_font[1], $this->footer_font[2]);
			$this->Footer();
			//restore position
			if ($this->rtl) {
				$this->SetXY($this->original_rMargin, $this->tMargin);
			} else {
				$this->SetXY($this->original_lMargin, $this->tMargin);
			}
			$this->_out('Q');
			$this->lasth = $lasth;
			$this->thead = $temp_thead;
			$this->theadMargins = $temp_theadMargins;
		}
		// restore graphic settings
		$this->setGraphicVars($gvars);
		$this->current_column = $gvars['current_column'];
		$this->num_columns = $gvars['num_columns'];
		// calculate footer length
		$this->footerlen[$this->page] = $this->pagelen[$this->page] - $this->footerpos[$this->page] + 1;
	}

	/**
 	 * This method is used to render the table header on new page (if any).
 	 * @access protected
 	 * @since 4.5.030 (2009-03-25)
	 */
	protected function setTableHeader() {
		if ($this->num_columns > 1) {
			// multi column mode
			return;
		}
		if (isset($this->theadMargins['top'])) {
			// restore the original top-margin
			$this->tMargin = $this->theadMargins['top'];
			$this->pagedim[$this->page]['tm'] = $this->tMargin;
			$this->y = $this->tMargin;
		}
		if (!$this->empty_string($this->thead) AND (!$this->inthead)) {
			// set margins
			$prev_lMargin = $this->lMargin;
			$prev_rMargin = $this->rMargin;
			$prev_cell_padding = $this->cell_padding;
			$this->lMargin = $this->theadMargins['lmargin'] + ($this->pagedim[$this->page]['olm'] - $this->pagedim[$this->theadMargins['page']]['olm']);
			$this->rMargin = $this->theadMargins['rmargin'] + ($this->pagedim[$this->page]['orm'] - $this->pagedim[$this->theadMargins['page']]['orm']);
			$this->cell_padding = $this->theadMargins['cell_padding'];
			if ($this->rtl) {
				$this->x = $this->w - $this->rMargin;
			} else {
				$this->x = $this->lMargin;
			}
			// print table header
			$this->writeHTML($this->thead, false, false, false, false, '');
			// set new top margin to skip the table headers
			if (!isset($this->theadMargins['top'])) {
				$this->theadMargins['top'] = $this->tMargin;
			}
			$this->tMargin = $this->y;
			$this->pagedim[$this->page]['tm'] = $this->tMargin;
			$this->lasth = 0;
			$this->lMargin = $prev_lMargin;
			$this->rMargin = $prev_rMargin;
			$this->cell_padding = $prev_cell_padding;
		}
	}

	/**
	 * Returns the current page number.
	 * @return int page number
	 * @access public
	 * @since 1.0
	 * @see AliasNbPages(), getAliasNbPages()
	 */
	public function PageNo() {
		return $this->page;
	}

	/**
	 * Defines a new spot color.
	 * It can be expressed in RGB components or gray scale.
	 * The method can be called before the first page is created and the value is retained from page to page.
	 * @param int $c Cyan color for CMYK. Value between 0 and 255
	 * @param int $m Magenta color for CMYK. Value between 0 and 255
	 * @param int $y Yellow color for CMYK. Value between 0 and 255
	 * @param int $k Key (Black) color for CMYK. Value between 0 and 255
	 * @access public
	 * @since 4.0.024 (2008-09-12)
	 * @see SetDrawSpotColor(), SetFillSpotColor(), SetTextSpotColor()
	 */
	public function AddSpotColor($name, $c, $m, $y, $k) {
		if (!isset($this->spot_colors[$name])) {
			$i = 1 + count($this->spot_colors);
			$this->spot_colors[$name] = array('i' => $i, 'c' => $c, 'm' => $m, 'y' => $y, 'k' => $k);
		}
	}

	/**
	 * Defines the color used for all drawing operations (lines, rectangles and cell borders).
	 * It can be expressed in RGB components or gray scale.
	 * The method can be called before the first page is created and the value is retained from page to page.
	 * @param array $color array of colors
	 * @param boolean $ret if true do not send the command.
	 * @return string the PDF command
	 * @access public
	 * @since 3.1.000 (2008-06-11)
	 * @see SetDrawColor()
	 */
	public function SetDrawColorArray($color, $ret=false) {
		if (is_array($color)) {
			$color = array_values($color);
			$r = isset($color[0]) ? $color[0] : -1;
			$g = isset($color[1]) ? $color[1] : -1;
			$b = isset($color[2]) ? $color[2] : -1;
			$k = isset($color[3]) ? $color[3] : -1;
			if ($r >= 0) {
				return $this->SetDrawColor($r, $g, $b, $k, $ret);
			}
		}
		return '';
	}

	/**
	 * Defines the color used for all drawing operations (lines, rectangles and cell borders). It can be expressed in RGB components or gray scale. The method can be called before the first page is created and the value is retained from page to page.
	 * @param int $col1 Gray level for single color, or Red color for RGB, or Cyan color for CMYK. Value between 0 and 255
	 * @param int $col2 Green color for RGB, or Magenta color for CMYK. Value between 0 and 255
	 * @param int $col3 Blue color for RGB, or Yellow color for CMYK. Value between 0 and 255
	 * @param int $col4 Key (Black) color for CMYK. Value between 0 and 255
	 * @param boolean $ret if true do not send the command.
	 * @return string the PDF command
	 * @access public
	 * @since 1.3
	 * @see SetDrawColorArray(), SetFillColor(), SetTextColor(), Line(), Rect(), Cell(), MultiCell()
	 */
	public function SetDrawColor($col1=0, $col2=-1, $col3=-1, $col4=-1, $ret=false) {
		// set default values
		if (!is_numeric($col1)) {
			$col1 = 0;
		}
		if (!is_numeric($col2)) {
			$col2 = -1;
		}
		if (!is_numeric($col3)) {
			$col3 = -1;
		}
		if (!is_numeric($col4)) {
			$col4 = -1;
		}
		//Set color for all stroking operations
		if (($col2 == -1) AND ($col3 == -1) AND ($col4 == -1)) {
			// Grey scale
			$this->DrawColor = sprintf('%.3F G', $col1/255);
			$this->strokecolor = array('G' => $col1);
		} elseif ($col4 == -1) {
			// RGB
			$this->DrawColor = sprintf('%.3F %.3F %.3F RG', $col1/255, $col2/255, $col3/255);
			$this->strokecolor = array('R' => $col1, 'G' => $col2, 'B' => $col3);
		} else {
			// CMYK
			$this->DrawColor = sprintf('%.3F %.3F %.3F %.3F K', $col1/100, $col2/100, $col3/100, $col4/100);
			$this->strokecolor = array('C' => $col1, 'M' => $col2, 'Y' => $col3, 'K' => $col4);
		}
		if ($this->page > 0) {
			if (!$ret) {
				$this->_out($this->DrawColor);
			}
			return $this->DrawColor;
		}
		return '';
	}

	/**
	 * Defines the spot color used for all drawing operations (lines, rectangles and cell borders).
	 * @param string $name name of the spot color
	 * @param int $tint the intensity of the color (from 0 to 100 ; 100 = full intensity by default).
	 * @access public
	 * @since 4.0.024 (2008-09-12)
	 * @see AddSpotColor(), SetFillSpotColor(), SetTextSpotColor()
	 */
	public function SetDrawSpotColor($name, $tint=100) {
		if (!isset($this->spot_colors[$name])) {
			$this->Error('Undefined spot color: '.$name);
		}
		$this->DrawColor = sprintf('/CS%d CS %.3F SCN', $this->spot_colors[$name]['i'], $tint/100);
		if ($this->page > 0) {
			$this->_out($this->DrawColor);
		}
	}

	/**
	 * Defines the color used for all filling operations (filled rectangles and cell backgrounds).
	 * It can be expressed in RGB components or gray scale.
	 * The method can be called before the first page is created and the value is retained from page to page.
	 * @param array $color array of colors
	 * @access public
	 * @since 3.1.000 (2008-6-11)
	 * @see SetFillColor()
	 */
	public function SetFillColorArray($color) {
		if (is_array($color)) {
			$color = array_values($color);
			$r = isset($color[0]) ? $color[0] : -1;
			$g = isset($color[1]) ? $color[1] : -1;
			$b = isset($color[2]) ? $color[2] : -1;
			$k = isset($color[3]) ? $color[3] : -1;
			if ($r >= 0) {
				$this->SetFillColor($r, $g, $b, $k);
			}
		}
	}

	/**
	 * Defines the color used for all filling operations (filled rectangles and cell backgrounds). It can be expressed in RGB components or gray scale. The method can be called before the first page is created and the value is retained from page to page.
	 * @param int $col1 Gray level for single color, or Red color for RGB, or Cyan color for CMYK. Value between 0 and 255
	 * @param int $col2 Green color for RGB, or Magenta color for CMYK. Value between 0 and 255
	 * @param int $col3 Blue color for RGB, or Yellow color for CMYK. Value between 0 and 255
	 * @param int $col4 Key (Black) color for CMYK. Value between 0 and 255
	 * @access public
	 * @since 1.3
	 * @see SetFillColorArray(), SetDrawColor(), SetTextColor(), Rect(), Cell(), MultiCell()
	 */
	public function SetFillColor($col1=0, $col2=-1, $col3=-1, $col4=-1) {
		// set default values
		if (!is_numeric($col1)) {
			$col1 = 0;
		}
		if (!is_numeric($col2)) {
			$col2 = -1;
		}
		if (!is_numeric($col3)) {
			$col3 = -1;
		}
		if (!is_numeric($col4)) {
			$col4 = -1;
		}
		//Set color for all filling operations
		if (($col2 == -1) AND ($col3 == -1) AND ($col4 == -1)) {
			// Grey scale
			$this->FillColor = sprintf('%.3F g', $col1/255);
			$this->bgcolor = array('G' => $col1);
		} elseif ($col4 == -1) {
			// RGB
			$this->FillColor = sprintf('%.3F %.3F %.3F rg', $col1/255, $col2/255, $col3/255);
			$this->bgcolor = array('R' => $col1, 'G' => $col2, 'B' => $col3);
		} else {
			// CMYK
			$this->FillColor = sprintf('%.3F %.3F %.3F %.3F k', $col1/100, $col2/100, $col3/100, $col4/100);
			$this->bgcolor = array('C' => $col1, 'M' => $col2, 'Y' => $col3, 'K' => $col4);
		}
		$this->ColorFlag = ($this->FillColor != $this->TextColor);
		if ($this->page > 0) {
			$this->_out($this->FillColor);
		}
	}

	/**
	 * Defines the spot color used for all filling operations (filled rectangles and cell backgrounds).
	 * @param string $name name of the spot color
	 * @param int $tint the intensity of the color (from 0 to 100 ; 100 = full intensity by default).
	 * @access public
	 * @since 4.0.024 (2008-09-12)
	 * @see AddSpotColor(), SetDrawSpotColor(), SetTextSpotColor()
	 */
	public function SetFillSpotColor($name, $tint=100) {
		if (!isset($this->spot_colors[$name])) {
			$this->Error('Undefined spot color: '.$name);
		}
		$this->FillColor = sprintf('/CS%d cs %.3F scn', $this->spot_colors[$name]['i'], $tint/100);
		$this->ColorFlag = ($this->FillColor != $this->TextColor);
		if ($this->page > 0) {
			$this->_out($this->FillColor);
		}
	}

	/**
	 * Defines the color used for text. It can be expressed in RGB components or gray scale.
	 * The method can be called before the first page is created and the value is retained from page to page.
	 * @param array $color array of colors
	 * @access public
	 * @since 3.1.000 (2008-6-11)
	 * @see SetFillColor()
	 */
	public function SetTextColorArray($color) {
		if (is_array($color)) {
			$color = array_values($color);
			$r = isset($color[0]) ? $color[0] : -1;
			$g = isset($color[1]) ? $color[1] : -1;
			$b = isset($color[2]) ? $color[2] : -1;
			$k = isset($color[3]) ? $color[3] : -1;
			if ($r >= 0) {
				$this->SetTextColor($r, $g, $b, $k);
			}
		}
	}

	/**
	 * Defines the color used for text. It can be expressed in RGB components or gray scale. The method can be called before the first page is created and the value is retained from page to page.
	 * @param int $col1 Gray level for single color, or Red color for RGB, or Cyan color for CMYK. Value between 0 and 255
	 * @param int $col2 Green color for RGB, or Magenta color for CMYK. Value between 0 and 255
	 * @param int $col3 Blue color for RGB, or Yellow color for CMYK. Value between 0 and 255
	 * @param int $col4 Key (Black) color for CMYK. Value between 0 and 255
	 * @access public
	 * @since 1.3
	 * @see SetTextColorArray(), SetDrawColor(), SetFillColor(), Text(), Cell(), MultiCell()
	 */
	public function SetTextColor($col1=0, $col2=-1, $col3=-1, $col4=-1) {
		// set default values
		if (!is_numeric($col1)) {
			$col1 = 0;
		}
		if (!is_numeric($col2)) {
			$col2 = -1;
		}
		if (!is_numeric($col3)) {
			$col3 = -1;
		}
		if (!is_numeric($col4)) {
			$col4 = -1;
		}
		//Set color for text
		if (($col2 == -1) AND ($col3 == -1) AND ($col4 == -1)) {
			// Grey scale
			$this->TextColor = sprintf('%.3F g', $col1/255);
			$this->fgcolor = array('G' => $col1);
		} elseif ($col4 == -1) {
			// RGB
			$this->TextColor = sprintf('%.3F %.3F %.3F rg', $col1/255, $col2/255, $col3/255);
			$this->fgcolor = array('R' => $col1, 'G' => $col2, 'B' => $col3);
		} else {
			// CMYK
			$this->TextColor = sprintf('%.3F %.3F %.3F %.3F k', $col1/100, $col2/100, $col3/100, $col4/100);
			$this->fgcolor = array('C' => $col1, 'M' => $col2, 'Y' => $col3, 'K' => $col4);
		}
		$this->ColorFlag = ($this->FillColor != $this->TextColor);
	}

	/**
	 * Defines the spot color used for text.
	 * @param string $name name of the spot color
	 * @param int $tint the intensity of the color (from 0 to 100 ; 100 = full intensity by default).
	 * @access public
	 * @since 4.0.024 (2008-09-12)
	 * @see AddSpotColor(), SetDrawSpotColor(), SetFillSpotColor()
	 */
	public function SetTextSpotColor($name, $tint=100) {
		if (!isset($this->spot_colors[$name])) {
			$this->Error('Undefined spot color: '.$name);
		}
		$this->TextColor = sprintf('/CS%d cs %.3F scn', $this->spot_colors[$name]['i'], $tint/100);
		$this->ColorFlag = ($this->FillColor != $this->TextColor);
		if ($this->page > 0) {
			$this->_out($this->TextColor);
		}
	}

	/**
	 * Returns the length of a string in user unit. A font must be selected.<br>
	 * @param string $s The string whose length is to be computed
	 * @param string $fontname Family font. It can be either a name defined by AddFont() or one of the standard families. It is also possible to pass an empty string, in that case, the current family is retained.
	 * @param string $fontstyle Font style. Possible values are (case insensitive):<ul><li>empty string: regular</li><li>B: bold</li><li>I: italic</li><li>U: underline</li><li>D: line-trough</li><li>O: overline</li></ul> or any combination. The default value is regular.
	 * @param float $fontsize Font size in points. The default value is the current size.
	 * @param boolean $getarray if true returns an array of characters widths, if false returns the total length.
	 * @return mixed int total string length or array of characted widths
	 * @author Nicola Asuni
	 * @access public
	 * @since 1.2
	 */
	public function GetStringWidth($s, $fontname='', $fontstyle='', $fontsize=0, $getarray=false) {
		return $this->GetArrStringWidth($this->utf8Bidi($this->UTF8StringToArray($s), $s, $this->tmprtl), $fontname, $fontstyle, $fontsize, $getarray);
	}

	/**
	 * Returns the string length of an array of chars in user unit or an array of characters widths. A font must be selected.<br>
	 * @param string $sa The array of chars whose total length is to be computed
	 * @param string $fontname Family font. It can be either a name defined by AddFont() or one of the standard families. It is also possible to pass an empty string, in that case, the current family is retained.
	 * @param string $fontstyle Font style. Possible values are (case insensitive):<ul><li>empty string: regular</li><li>B: bold</li><li>I: italic</li><li>U: underline</li><li>D: line trough</li><li>O: overline</li></ul> or any combination. The default value is regular.
	 * @param float $fontsize Font size in points. The default value is the current size.
	 * @param boolean $getarray if true returns an array of characters widths, if false returns the total length.
	 * @return mixed int total string length or array of characted widths
	 * @author Nicola Asuni
	 * @access public
	 * @since 2.4.000 (2008-03-06)
	 */
	public function GetArrStringWidth($sa, $fontname='', $fontstyle='', $fontsize=0, $getarray=false) {
		// store current values
		if (!$this->empty_string($fontname)) {
			$prev_FontFamily = $this->FontFamily;
			$prev_FontStyle = $this->FontStyle;
			$prev_FontSizePt = $this->FontSizePt;
			$this->SetFont($fontname, $fontstyle, $fontsize);
		}
		// convert UTF-8 array to Latin1 if required
		$sa = $this->UTF8ArrToLatin1($sa);
		$w = 0; // total width
		$wa = array(); // array of characters widths
		foreach ($sa as $ck => $char) {
			// character width
			$cw = $this->GetCharWidth($char, isset($sa[($ck + 1)]));
			$wa[] = $cw;
			$w += $cw;
		}
		// restore previous values
		if (!$this->empty_string($fontname)) {
			$this->SetFont($prev_FontFamily, $prev_FontStyle, $prev_FontSizePt);
		}
		if ($getarray) {
			return $wa;
		}
		return $w;
	}

	/**
	 * Returns the length of the char in user unit for the current font considering current stretching and spacing (tracking/kerning).
	 * @param int $char The char code whose length is to be returned
	 * @param boolean $notlast set to false for the latest character on string, true otherwise (default)
	 * @return float char width
	 * @author Nicola Asuni
	 * @access public
	 * @since 2.4.000 (2008-03-06)
	 */
	public function GetCharWidth($char, $notlast=true) {
		// get raw width
		$chw = $this->getRawCharWidth($char);
		if (($this->font_spacing != 0) AND $notlast) {
			// increase/decrease font spacing
			$chw += $this->font_spacing;
		}
		if ($this->font_stretching != 100) {
			// fixed stretching mode
			$chw *= ($this->font_stretching / 100);
		}
		return $chw;
	}

	/**
	 * Returns the length of the char in user unit for the current font.
	 * @param int $char The char code whose length is to be returned
	 * @return float char width
	 * @author Nicola Asuni
	 * @access public
	 * @since 5.9.000 (2010-09-28)
	 */
	public function getRawCharWidth($char) {
		if ($char == 173) {
			// SHY character will not be printed
			return (0);
		}
		$cw = &$this->CurrentFont['cw'];
		if (isset($cw[$char])) {
			$w = $cw[$char];
		} elseif (isset($this->CurrentFont['dw'])) {
			// default width
			$w = $this->CurrentFont['dw'];
		} elseif (isset($cw[32])) {
			// default width
			$w = $cw[32];
		} else {
			$w = 600;
		}
		return ($w * $this->FontSize / 1000);
	}

	/**
	 * Returns the numbero of characters in a string.
	 * @param string $s The input string.
	 * @return int number of characters
	 * @access public
	 * @since 2.0.0001 (2008-01-07)
	 */
	public function GetNumChars($s) {
		if ($this->isUnicodeFont()) {
			return count($this->UTF8StringToArray($s));
		}
		return strlen($s);
	}

	/**
	 * Fill the list of available fonts ($this->fontlist).
	 * @access protected
	 * @since 4.0.013 (2008-07-28)
	 */
	protected function getFontsList() {
		$fontsdir = opendir($this->_getfontpath());
		while (($file = readdir($fontsdir)) !== false) {
			if (substr($file, -4) == '.php') {
				array_push($this->fontlist, strtolower(basename($file, '.php')));
			}
		}
		closedir($fontsdir);
	}

	/**
	 * Imports a TrueType, Type1, core, or CID0 font and makes it available.
	 * It is necessary to generate a font definition file first (read /fonts/utils/README.TXT).
	 * The definition file (and the font file itself when embedding) must be present either in the current directory or in the one indicated by K_PATH_FONTS if the constant is defined. If it could not be found, the error "Could not include font definition file" is generated.
	 * @param string $family Font family. The name can be chosen arbitrarily. If it is a standard family name, it will override the corresponding font.
	 * @param string $style Font style. Possible values are (case insensitive):<ul><li>empty string: regular (default)</li><li>B: bold</li><li>I: italic</li><li>BI or IB: bold italic</li></ul>
	 * @param string $fontfile The font definition file. By default, the name is built from the family and style, in lower case with no spaces.
	 * @return array containing the font data, or false in case of error.
	 * @param mixed $subset if true embedd only a subset of the font (stores only the information related to the used characters); if false embedd full font; if 'default' uses the default value set using setFontSubsetting(). This option is valid only for TrueTypeUnicode fonts. If you want to enable users to change the document, set this parameter to false. If you subset the font, the person who receives your PDF would need to have your same font in order to make changes to your PDF. The file size of the PDF would also be smaller because you are embedding only part of a font.
	 * @access public
	 * @since 1.5
	 * @see SetFont(), setFontSubsetting()
	 */
	public function AddFont($family, $style='', $fontfile='', $subset='default') {
		if ($subset === 'default') {
			$subset = $this->font_subsetting;
		}
		if ($this->empty_string($family)) {
			if (!$this->empty_string($this->FontFamily)) {
				$family = $this->FontFamily;
			} else {
				$this->Error('Empty font family');
			}
		}
		// move embedded styles on $style
		if (substr($family, -1) == 'I') {
			$style .= 'I';
			$family = substr($family, 0, -1);
		}
		if (substr($family, -1) == 'B') {
			$style .= 'B';
			$family = substr($family, 0, -1);
		}
		// normalize family name
		$family = strtolower($family);
		if ((!$this->isunicode) AND ($family == 'arial')) {
			$family = 'helvetica';
		}
		if (($family == 'symbol') OR ($family == 'zapfdingbats')) {
			$style = '';
		}
		$tempstyle = strtoupper($style);
		$style = '';
		// underline
		if (strpos($tempstyle, 'U') !== false) {
			$this->underline = true;
		} else {
			$this->underline = false;
		}
		// line-through (deleted)
		if (strpos($tempstyle, 'D') !== false) {
			$this->linethrough = true;
		} else {
			$this->linethrough = false;
		}
		// overline
		if (strpos($tempstyle, 'O') !== false) {
			$this->overline = true;
		} else {
			$this->overline = false;
		}
		// bold
		if (strpos($tempstyle, 'B') !== false) {
			$style .= 'B';
		}
		// oblique
		if (strpos($tempstyle, 'I') !== false) {
			$style .= 'I';
		}
		$bistyle = $style;
		$fontkey = $family.$style;
		$font_style = $style.($this->underline ? 'U' : '').($this->linethrough ? 'D' : '').($this->overline ? 'O' : '');
		$fontdata = array('fontkey' => $fontkey, 'family' => $family, 'style' => $font_style);
		// check if the font has been already added
		$fb = $this->getFontBuffer($fontkey);
		if ($fb !== false) {
			if ($this->inxobj) {
				// we are inside an XObject template
				$this->xobjects[$this->xobjid]['fonts'][$fontkey] = $fb['i'];
			}
			return $fontdata;
		}
		if (isset($type)) {
			unset($type);
		}
		if (isset($cw)) {
			unset($cw);
		}
		// get specified font directory (if any)
		$fontdir = false;
		if (!$this->empty_string($fontfile)) {
			$fontdir = dirname($fontfile);
			if ($this->empty_string($fontdir) OR ($fontdir == '.')) {
				$fontdir = '';
			} else {
				$fontdir .= '/';
			}
		}
		// search and include font file
		if ($this->empty_string($fontfile) OR (!file_exists($fontfile))) {
			// build a standard filenames for specified font
			$fontfile1 = str_replace(' ', '', $family).strtolower($style).'.php';
			$fontfile2 = str_replace(' ', '', $family).'.php';
			// search files on various directories
			if (($fontdir !== false) AND file_exists($fontdir.$fontfile1)) {
				$fontfile = $fontdir.$fontfile1;
			} elseif (file_exists($this->_getfontpath().$fontfile1)) {
				$fontfile = $this->_getfontpath().$fontfile1;
			} elseif (file_exists($fontfile1)) {
				$fontfile = $fontfile1;
			} elseif (($fontdir !== false) AND file_exists($fontdir.$fontfile2)) {
				$fontfile = $fontdir.$fontfile2;
			} elseif (file_exists($this->_getfontpath().$fontfile2)) {
				$fontfile = $this->_getfontpath().$fontfile2;
			} else {
				$fontfile = $fontfile2;
			}
		}
		// include font file
		if (file_exists($fontfile)) {
			include($fontfile);
		} else {
			$this->Error('Could not include font definition file: '.$family.'');
		}
		// check font parameters
		if ((!isset($type)) OR (!isset($cw))) {
			$this->Error('The font definition file has a bad format: '.$fontfile.'');
		}
		// SET default parameters
		if (!isset($file) OR $this->empty_string($file)) {
			$file = '';
		}
		if (!isset($enc) OR $this->empty_string($enc)) {
			$enc = '';
		}
		if (!isset($cidinfo) OR $this->empty_string($cidinfo)) {
			$cidinfo = array('Registry'=>'Adobe','Ordering'=>'Identity','Supplement'=>0);
			$cidinfo['uni2cid'] = array();
		}
		if (!isset($ctg) OR $this->empty_string($ctg)) {
			$ctg = '';
		}
		if (!isset($desc) OR $this->empty_string($desc)) {
			$desc = array();
		}
		if (!isset($up) OR $this->empty_string($up)) {
			$up = -100;
		}
		if (!isset($ut) OR $this->empty_string($ut)) {
			$ut = 50;
		}
		if (!isset($cw) OR $this->empty_string($cw)) {
			$cw = array();
		}
		if (!isset($dw) OR $this->empty_string($dw)) {
			// set default width
			if (isset($desc['MissingWidth']) AND ($desc['MissingWidth'] > 0)) {
				$dw = $desc['MissingWidth'];
			} elseif (isset($cw[32])) {
				$dw = $cw[32];
			} else {
				$dw = 600;
			}
		}
		++$this->numfonts;
		if ($type == 'cidfont0') {
			// register CID font (all styles at once)
			$styles = array('' => '', 'B' => ',Bold', 'I' => ',Italic', 'BI' => ',BoldItalic');
			$sname = $name.$styles[$bistyle];
			// artificial bold
			if (strpos($bistyle, 'B') !== false) {
				if (isset($desc['StemV'])) {
					$desc['StemV'] *= 2;
				} else {
					$desc['StemV'] = 120;
				}
			}
			// artificial italic
			if (strpos($bistyle, 'I') !== false) {
				if (isset($desc['ItalicAngle'])) {
					$desc['ItalicAngle'] -= 11;
				} else {
					$desc['ItalicAngle'] = -11;
				}
			}
		} elseif ($type == 'core') {
			$name = $this->CoreFonts[$fontkey];
			$subset = false;
		} elseif (($type == 'TrueType') OR ($type == 'Type1')) {
			$subset = false;
		} elseif ($type == 'TrueTypeUnicode') {
			$enc = 'Identity-H';
		} else {
			$this->Error('Unknow font type: '.$type.'');
		}
		// initialize subsetchars to contain default ASCII values (0-255)
		$subsetchars = array_fill(0, 256, true);
		$this->setFontBuffer($fontkey, array('fontkey' => $fontkey, 'i' => $this->numfonts, 'type' => $type, 'name' => $name, 'desc' => $desc, 'up' => $up, 'ut' => $ut, 'cw' => $cw, 'dw' => $dw, 'enc' => $enc, 'cidinfo' => $cidinfo, 'file' => $file, 'ctg' => $ctg, 'subset' => $subset, 'subsetchars' => $subsetchars));
		if ($this->inxobj) {
			// we are inside an XObject template
			$this->xobjects[$this->xobjid]['fonts'][$fontkey] = $this->numfonts;
		}
		if (isset($diff) AND (!empty($diff))) {
			//Search existing encodings
			$d = 0;
			$nb = count($this->diffs);
			for ($i=1; $i <= $nb; ++$i) {
				if ($this->diffs[$i] == $diff) {
					$d = $i;
					break;
				}
			}
			if ($d == 0) {
				$d = $nb + 1;
				$this->diffs[$d] = $diff;
			}
			$this->setFontSubBuffer($fontkey, 'diff', $d);
		}
		if (!$this->empty_string($file)) {
			if (!isset($this->FontFiles[$file])) {
				if ((strcasecmp($type,'TrueType') == 0) OR (strcasecmp($type, 'TrueTypeUnicode') == 0)) {
					$this->FontFiles[$file] = array('length1' => $originalsize, 'fontdir' => $fontdir, 'subset' => $subset, 'fontkeys' => array($fontkey));
				} elseif ($type != 'core') {
					$this->FontFiles[$file] = array('length1' => $size1, 'length2' => $size2, 'fontdir' => $fontdir, 'subset' => $subset, 'fontkeys' => array($fontkey));
				}
			} else {
				// update fontkeys that are sharing this font file
				$this->FontFiles[$file]['subset'] = ($this->FontFiles[$file]['subset'] AND $subset);
				if (!in_array($fontkey, $this->FontFiles[$file]['fontkeys'])) {
					$this->FontFiles[$file]['fontkeys'][] = $fontkey;
				}
			}
		}
		return $fontdata;
	}

	/**
	 * Sets the font used to print character strings.
	 * The font can be either a standard one or a font added via the AddFont() method. Standard fonts use Windows encoding cp1252 (Western Europe).
	 * The method can be called before the first page is created and the font is retained from page to page.
	 * If you just wish to change the current font size, it is simpler to call SetFontSize().
	 * Note: for the standard fonts, the font metric files must be accessible. There are three possibilities for this:<ul><li>They are in the current directory (the one where the running script lies)</li><li>They are in one of the directories defined by the include_path parameter</li><li>They are in the directory defined by the K_PATH_FONTS constant</li></ul><br />
	 * @param string $family Family font. It can be either a name defined by AddFont() or one of the standard Type1 families (case insensitive):<ul><li>times (Times-Roman)</li><li>timesb (Times-Bold)</li><li>timesi (Times-Italic)</li><li>timesbi (Times-BoldItalic)</li><li>helvetica (Helvetica)</li><li>helveticab (Helvetica-Bold)</li><li>helveticai (Helvetica-Oblique)</li><li>helveticabi (Helvetica-BoldOblique)</li><li>courier (Courier)</li><li>courierb (Courier-Bold)</li><li>courieri (Courier-Oblique)</li><li>courierbi (Courier-BoldOblique)</li><li>symbol (Symbol)</li><li>zapfdingbats (ZapfDingbats)</li></ul> It is also possible to pass an empty string. In that case, the current family is retained.
	 * @param string $style Font style. Possible values are (case insensitive):<ul><li>empty string: regular</li><li>B: bold</li><li>I: italic</li><li>U: underline</li><li>D: line trough</li><li>O: overline</li></ul> or any combination. The default value is regular. Bold and italic styles do not apply to Symbol and ZapfDingbats basic fonts or other fonts when not defined.
	 * @param float $size Font size in points. The default value is the current size. If no size has been specified since the beginning of the document, the value taken is 12
	 * @param string $fontfile The font definition file. By default, the name is built from the family and style, in lower case with no spaces.
	 * @param mixed $subset if true embedd only a subset of the font (stores only the information related to the used characters); if false embedd full font; if 'default' uses the default value set using setFontSubsetting(). This option is valid only for TrueTypeUnicode fonts. If you want to enable users to change the document, set this parameter to false. If you subset the font, the person who receives your PDF would need to have your same font in order to make changes to your PDF. The file size of the PDF would also be smaller because you are embedding only part of a font.
	 * @author Nicola Asuni
	 * @access public
	 * @since 1.0
	 * @see AddFont(), SetFontSize()
	 */
	public function SetFont($family, $style='', $size=0, $fontfile='', $subset='default') {
		//Select a font; size given in points
		if ($size == 0) {
			$size = $this->FontSizePt;
		}
		// try to add font (if not already added)
		$fontdata = $this->AddFont($family, $style, $fontfile, $subset);
		$this->FontFamily = $fontdata['family'];
		$this->FontStyle = $fontdata['style'];
		$this->CurrentFont = $this->getFontBuffer($fontdata['fontkey']);
		$this->SetFontSize($size);
	}

	/**
	 * Defines the size of the current font.
	 * @param float $size The size (in points)
	 * @param boolean $out if true output the font size command, otherwise only set the font properties.
	 * @access public
	 * @since 1.0
	 * @see SetFont()
	 */
	public function SetFontSize($size, $out=true) {
		// font size in points
		$this->FontSizePt = $size;
		// font size in user units
		$this->FontSize = $size / $this->k;
		// calculate some font metrics
		if (isset($this->CurrentFont['desc']['FontBBox'])) {
			$bbox = explode(' ', substr($this->CurrentFont['desc']['FontBBox'], 1, -1));
			$font_height = ((intval($bbox[3]) - intval($bbox[1])) * $size / 1000);
		} else {
			$font_height = $size * 1.219;
		}
		if (isset($this->CurrentFont['desc']['Ascent']) AND ($this->CurrentFont['desc']['Ascent'] > 0)) {
			$font_ascent = ($this->CurrentFont['desc']['Ascent'] * $size / 1000);
		}
		if (isset($this->CurrentFont['desc']['Descent']) AND ($this->CurrentFont['desc']['Descent'] <= 0)) {
			$font_descent = (- $this->CurrentFont['desc']['Descent'] * $size / 1000);
		}
		if (!isset($font_ascent) AND !isset($font_descent)) {
			// core font
			$font_ascent = 0.76 * $font_height;
			$font_descent = $font_height - $font_ascent;
		} elseif (!isset($font_descent)) {
			$font_descent = $font_height - $font_ascent;
		} elseif (!isset($font_ascent)) {
			$font_ascent = $font_height - $font_descent;
		}
		$this->FontAscent = $font_ascent / $this->k;
		$this->FontDescent = $font_descent / $this->k;
		if ($out AND ($this->page > 0) AND (isset($this->CurrentFont['i']))) {
			$this->_out(sprintf('BT /F%d %.2F Tf ET', $this->CurrentFont['i'], $this->FontSizePt));
		}
	}

	/**
	 * Return the font descent value
	 * @param string $font font name
	 * @param string $style font style
	 * @param float $size The size (in points)
	 * @return int font descent
	 * @access public
	 * @author Nicola Asuni
	 * @since 4.9.003 (2010-03-30)
	 */
	public function getFontDescent($font, $style='', $size=0) {
		$fontdata = $this->AddFont($font, $style);
		$fontinfo = $this->getFontBuffer($fontdata['fontkey']);
		if (isset($fontinfo['desc']['Descent']) AND ($fontinfo['desc']['Descent'] <= 0)) {
			$descent = (- $fontinfo['desc']['Descent'] * $size / 1000);
		} else {
			$descent = 1.219 * 0.24 * $size;
		}
		return ($descent / $this->k);
	}

	/**
	 * Return the font ascent value
	 * @param string $font font name
	 * @param string $style font style
	 * @param float $size The size (in points)
	 * @return int font ascent
	 * @access public
	 * @author Nicola Asuni
	 * @since 4.9.003 (2010-03-30)
	 */
	public function getFontAscent($font, $style='', $size=0) {
		$fontdata = $this->AddFont($font, $style);
		$fontinfo = $this->getFontBuffer($fontdata['fontkey']);
		if (isset($fontinfo['desc']['Ascent']) AND ($fontinfo['desc']['Ascent'] > 0)) {
			$ascent = ($fontinfo['desc']['Ascent'] * $size / 1000);
		} else {
			$ascent = 1.219 * 0.76 * $size;
		}
		return ($ascent / $this->k);
	}

	/**
	 * Defines the default monospaced font.
	 * @param string $font Font name.
	 * @access public
	 * @since 4.5.025
	 */
	public function SetDefaultMonospacedFont($font) {
		$this->default_monospaced_font = $font;
	}

	/**
	 * Creates a new internal link and returns its identifier. An internal link is a clickable area which directs to another place within the document.<br />
	 * The identifier can then be passed to Cell(), Write(), Image() or Link(). The destination is defined with SetLink().
	 * @access public
	 * @since 1.5
	 * @see Cell(), Write(), Image(), Link(), SetLink()
	 */
	public function AddLink() {
		//Create a new internal link
		$n = count($this->links) + 1;
		$this->links[$n] = array(0, 0);
		return $n;
	}

	/**
	 * Defines the page and position a link points to.
	 * @param int $link The link identifier returned by AddLink()
	 * @param float $y Ordinate of target position; -1 indicates the current position. The default value is 0 (top of page)
	 * @param int $page Number of target page; -1 indicates the current page. This is the default value
	 * @access public
	 * @since 1.5
	 * @see AddLink()
	 */
	public function SetLink($link, $y=0, $page=-1) {
		if ($y == -1) {
			$y = $this->y;
		}
		if ($page == -1) {
			$page = $this->page;
		}
		$this->links[$link] = array($page, $y);
	}

	/**
	 * Puts a link on a rectangular area of the page.
	 * Text or image links are generally put via Cell(), Write() or Image(), but this method can be useful for instance to define a clickable area inside an image.
	 * @param float $x Abscissa of the upper-left corner of the rectangle
	 * @param float $y Ordinate of the upper-left corner of the rectangle
	 * @param float $w Width of the rectangle
	 * @param float $h Height of the rectangle
	 * @param mixed $link URL or identifier returned by AddLink()
	 * @param int $spaces number of spaces on the text to link
	 * @access public
	 * @since 1.5
	 * @see AddLink(), Annotation(), Cell(), Write(), Image()
	 */
	public function Link($x, $y, $w, $h, $link, $spaces=0) {
		$this->Annotation($x, $y, $w, $h, $link, array('Subtype'=>'Link'), $spaces);
	}

	/**
	 * Puts a markup annotation on a rectangular area of the page.
	 * !!!!THE ANNOTATION SUPPORT IS NOT YET FULLY IMPLEMENTED !!!!
	 * @param float $x Abscissa of the upper-left corner of the rectangle
	 * @param float $y Ordinate of the upper-left corner of the rectangle
	 * @param float $w Width of the rectangle
	 * @param float $h Height of the rectangle
	 * @param string $text annotation text or alternate content
	 * @param array $opt array of options (see section 8.4 of PDF reference 1.7).
	 * @param int $spaces number of spaces on the text to link
	 * @access public
	 * @since 4.0.018 (2008-08-06)
	 */
	public function Annotation($x, $y, $w, $h, $text, $opt=array('Subtype'=>'Text'), $spaces=0) {
		if ($this->inxobj) {
			// store parameters for later use on template
			$this->xobjects[$this->xobjid]['annotations'][] = array('x' => $x, 'y' => $y, 'w' => $w, 'h' => $h, 'text' => $text, 'opt' => $opt, 'spaces' => $spaces);
			return;
		}
		if ($x === '') {
			$x = $this->x;
		}
		if ($y === '') {
			$y = $this->y;
		}
		// check page for no-write regions and adapt page margins if necessary
		$this->checkPageRegions($h, $x, $y);
		// recalculate coordinates to account for graphic transformations
		if (isset($this->transfmatrix) AND !empty($this->transfmatrix)) {
			for ($i=$this->transfmatrix_key; $i > 0; --$i) {
				$maxid = count($this->transfmatrix[$i]) - 1;
				for ($j=$maxid; $j >= 0; --$j) {
					$ctm = $this->transfmatrix[$i][$j];
					if (isset($ctm['a'])) {
						$x = $x * $this->k;
						$y = ($this->h - $y) * $this->k;
						$w = $w * $this->k;
						$h = $h * $this->k;
						// top left
						$xt = $x;
						$yt = $y;
						$x1 = ($ctm['a'] * $xt) + ($ctm['c'] * $yt) + $ctm['e'];
						$y1 = ($ctm['b'] * $xt) + ($ctm['d'] * $yt) + $ctm['f'];
						// top right
						$xt = $x + $w;
						$yt = $y;
						$x2 = ($ctm['a'] * $xt) + ($ctm['c'] * $yt) + $ctm['e'];
						$y2 = ($ctm['b'] * $xt) + ($ctm['d'] * $yt) + $ctm['f'];
						// bottom left
						$xt = $x;
						$yt = $y - $h;
						$x3 = ($ctm['a'] * $xt) + ($ctm['c'] * $yt) + $ctm['e'];
						$y3 = ($ctm['b'] * $xt) + ($ctm['d'] * $yt) + $ctm['f'];
						// bottom right
						$xt = $x + $w;
						$yt = $y - $h;
						$x4 = ($ctm['a'] * $xt) + ($ctm['c'] * $yt) + $ctm['e'];
						$y4 = ($ctm['b'] * $xt) + ($ctm['d'] * $yt) + $ctm['f'];
						// new coordinates (rectangle area)
						$x = min($x1, $x2, $x3, $x4);
						$y = max($y1, $y2, $y3, $y4);
						$w = (max($x1, $x2, $x3, $x4) - $x) / $this->k;
						$h = ($y - min($y1, $y2, $y3, $y4)) / $this->k;
						$x = $x / $this->k;
						$y = $this->h - ($y / $this->k);
					}
				}
			}
		}
		if ($this->page <= 0) {
			$page = 1;
		} else {
			$page = $this->page;
		}
		if (!isset($this->PageAnnots[$page])) {
			$this->PageAnnots[$page] = array();
		}
		++$this->n;
		$this->PageAnnots[$page][] = array('n' => $this->n, 'x' => $x, 'y' => $y, 'w' => $w, 'h' => $h, 'txt' => $text, 'opt' => $opt, 'numspaces' => $spaces);
		if ((($opt['Subtype'] == 'FileAttachment') OR ($opt['Subtype'] == 'Sound')) AND (!$this->empty_string($opt['FS'])) AND file_exists($opt['FS']) AND (!isset($this->embeddedfiles[basename($opt['FS'])]))) {
			++$this->n;
			$this->embeddedfiles[basename($opt['FS'])] = array('n' => $this->n, 'file' => $opt['FS']);
		}
		// Add widgets annotation's icons
		if (isset($opt['mk']['i']) AND file_exists($opt['mk']['i'])) {
			$this->Image($opt['mk']['i'], '', '', 10, 10, '', '', '', false, 300, '', false, false, 0, false, true);
		}
		if (isset($opt['mk']['ri']) AND file_exists($opt['mk']['ri'])) {
			$this->Image($opt['mk']['ri'], '', '', 0, 0, '', '', '', false, 300, '', false, false, 0, false, true);
		}
		if (isset($opt['mk']['ix']) AND file_exists($opt['mk']['ix'])) {
			$this->Image($opt['mk']['ix'], '', '', 0, 0, '', '', '', false, 300, '', false, false, 0, false, true);
		}
	}

	/**
	 * Embedd the attached files.
	 * @since 4.4.000 (2008-12-07)
	 * @access protected
	 * @see Annotation()
	 */
	protected function _putEmbeddedFiles() {
		reset($this->embeddedfiles);
		foreach ($this->embeddedfiles as $filename => $filedata) {
			$data = file_get_contents($filedata['file']);
			$filter = '';
			if ($this->compress) {
				$data = gzcompress($data);
				$filter = ' /Filter /FlateDecode';
			}
			$stream = $this->_getrawstream($data, $filedata['n']);
			$out = $this->_getobj($filedata['n'])."\n";
			$out .= '<< /Type /EmbeddedFile'.$filter.' /Length '.strlen($stream).' >>';
			$out .= ' stream'."\n".$stream."\n".'endstream';
			$out .= "\n".'endobj';
			$this->_out($out);
		}
	}

	/**
	 * Prints a text cell at the specified position.
	 * The origin is on the left of the first charcter, on the baseline.
	 * This method allows to place a string precisely on the page.
	 * @param float $x Abscissa of the cell origin
	 * @param float $y Ordinate of the cell origin
	 * @param string $txt String to print
	 * @param int $fstroke outline size in user units (false = disable)
	 * @param boolean $fclip if true activate clipping mode (you must call StartTransform() before this function and StopTransform() to stop the clipping tranformation).
	 * @param boolean $ffill if true fills the text
	 * @param mixed $border Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @param int $ln Indicates where the current position should go after the call. Possible values are:<ul><li>0: to the right (or left for RTL languages)</li><li>1: to the beginning of the next line</li><li>2: below</li></ul>Putting 1 is equivalent to putting 0 and calling Ln() just after. Default value: 0.
	 * @param string $align Allows to center or align the text. Possible values are:<ul><li>L or empty string: left align (default value)</li><li>C: center</li><li>R: right align</li><li>J: justify</li></ul>
	 * @param boolean $fill Indicates if the cell background must be painted (true) or transparent (false).
	 * @param mixed $link URL or identifier returned by AddLink().
	 * @param int $stretch font stretch mode: <ul><li>0 = disabled</li><li>1 = horizontal scaling only if text is larger than cell width</li><li>2 = forced horizontal scaling to fit cell width</li><li>3 = character spacing only if text is larger than cell width</li><li>4 = forced character spacing to fit cell width</li></ul> General font stretching and scaling values will be preserved when possible.
	 * @param boolean $ignore_min_height if true ignore automatic minimum height value.
	 * @param string $calign cell vertical alignment relative to the specified Y value. Possible values are:<ul><li>T : cell top</li><li>A : font top</li><li>L : font baseline</li><li>D : font bottom</li><li>B : cell bottom</li></ul>
	 * @param string $valign text vertical alignment inside the cell. Possible values are:<ul><li>T : top</li><li>C : center</li><li>B : bottom</li></ul>
	 * @param boolean $rtloff if true uses the page top-left corner as origin of axis for $x and $y initial position.
	 * @access public
	 * @since 1.0
	 * @see Cell(), Write(), MultiCell(), WriteHTML(), WriteHTMLCell()
	 */
	public function Text($x, $y, $txt, $fstroke=false, $fclip=false, $ffill=true, $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M', $rtloff=false) {
		$textrendermode = $this->textrendermode;
		$textstrokewidth = $this->textstrokewidth;
		$this->setTextRenderingMode($fstroke, $ffill, $fclip);
		$this->SetXY($x, $y, $rtloff);
		$this->Cell(0, 0, $txt, $border, $ln, $align, $fill, $link, $stretch, $ignore_min_height, $calign, $valign);
		// restore previous rendering mode
		$this->textrendermode = $textrendermode;
		$this->textstrokewidth = $textstrokewidth;
	}

	/**
	 * Whenever a page break condition is met, the method is called, and the break is issued or not depending on the returned value.
	 * The default implementation returns a value according to the mode selected by SetAutoPageBreak().<br />
	 * This method is called automatically and should not be called directly by the application.
	 * @return boolean
	 * @access public
	 * @since 1.4
	 * @see SetAutoPageBreak()
	 */
	public function AcceptPageBreak() {
		if ($this->num_columns > 1) {
			// multi column mode
			if($this->current_column < ($this->num_columns - 1)) {
				// go to next column
				$this->selectColumn($this->current_column + 1);
			} else {
				// add a new page
				$this->AddPage();
				// set first column
				$this->selectColumn(0);
			}
			// avoid page breaking from checkPageBreak()
			return false;
		}
		return $this->AutoPageBreak;
	}

	/**
	 * Add page if needed.
	 * @param float $h Cell height. Default value: 0.
	 * @param mixed $y starting y position, leave empty for current position.
	 * @param boolean $addpage if true add a page, otherwise only return the true/false state
	 * @return boolean true in case of page break, false otherwise.
	 * @since 3.2.000 (2008-07-01)
	 * @access protected
	 */
	protected function checkPageBreak($h=0, $y='', $addpage=true) {
		if ($this->empty_string($y)) {
			$y = $this->y;
		}
		$current_page = $this->page;
		if ((($y + $h) > $this->PageBreakTrigger) AND (!$this->InFooter) AND ($this->AcceptPageBreak())) {
			if ($addpage) {
				//Automatic page break
				$x = $this->x;
				$this->AddPage($this->CurOrientation);
				$this->y = $this->tMargin;
				$oldpage = $this->page - 1;
				if ($this->rtl) {
					if ($this->pagedim[$this->page]['orm'] != $this->pagedim[$oldpage]['orm']) {
						$this->x = $x - ($this->pagedim[$this->page]['orm'] - $this->pagedim[$oldpage]['orm']);
					} else {
						$this->x = $x;
					}
				} else {
					if ($this->pagedim[$this->page]['olm'] != $this->pagedim[$oldpage]['olm']) {
						$this->x = $x + ($this->pagedim[$this->page]['olm'] - $this->pagedim[$oldpage]['olm']);
					} else {
						$this->x = $x;
					}
				}
			}
			$this->newline = true;
			return true;
		}
		if ($current_page != $this->page) {
			// account for columns mode
			$this->newline = true;
			return true;
		}
		return false;
	}

	/**
	 * Removes SHY characters from text.
	 * Unicode Data:<ul>
	 * <li>Name : SOFT HYPHEN, commonly abbreviated as SHY</li>
	 * <li>HTML Entity (decimal): &amp;#173;</li>
	 * <li>HTML Entity (hex): &amp;#xad;</li>
	 * <li>HTML Entity (named): &amp;shy;</li>
	 * <li>How to type in Microsoft Windows: [Alt +00AD] or [Alt 0173]</li>
	 * <li>UTF-8 (hex): 0xC2 0xAD (c2ad)</li>
	 * <li>UTF-8 character: chr(194).chr(173)</li>
	 * </ul>
	 * @param string $txt input string
	 * @return string without SHY characters.
	 * @access public
	 * @since (4.5.019) 2009-02-28
	 */
	public function removeSHY($txt='') {
		$txt = preg_replace('/([\\xc2]{1}[\\xad]{1})/', '', $txt);
		if (!$this->isunicode) {
			$txt = preg_replace('/([\\xad]{1})/', '', $txt);
		}
		return $txt;
	}

	/**
	 * Prints a cell (rectangular area) with optional borders, background color and character string. The upper-left corner of the cell corresponds to the current position. The text can be aligned or centered. After the call, the current position moves to the right or to the next line. It is possible to put a link on the text.<br />
	 * If automatic page breaking is enabled and the cell goes beyond the limit, a page break is done before outputting.
	 * @param float $w Cell width. If 0, the cell extends up to the right margin.
	 * @param float $h Cell height. Default value: 0.
	 * @param string $txt String to print. Default value: empty string.
	 * @param mixed $border Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @param int $ln Indicates where the current position should go after the call. Possible values are:<ul><li>0: to the right (or left for RTL languages)</li><li>1: to the beginning of the next line</li><li>2: below</li></ul> Putting 1 is equivalent to putting 0 and calling Ln() just after. Default value: 0.
	 * @param string $align Allows to center or align the text. Possible values are:<ul><li>L or empty string: left align (default value)</li><li>C: center</li><li>R: right align</li><li>J: justify</li></ul>
	 * @param boolean $fill Indicates if the cell background must be painted (true) or transparent (false).
	 * @param mixed $link URL or identifier returned by AddLink().
	 * @param int $stretch font stretch mode: <ul><li>0 = disabled</li><li>1 = horizontal scaling only if text is larger than cell width</li><li>2 = forced horizontal scaling to fit cell width</li><li>3 = character spacing only if text is larger than cell width</li><li>4 = forced character spacing to fit cell width</li></ul> General font stretching and scaling values will be preserved when possible.
	 * @param boolean $ignore_min_height if true ignore automatic minimum height value.
	 * @param string $calign cell vertical alignment relative to the specified Y value. Possible values are:<ul><li>T : cell top</li><li>C : center</li><li>B : cell bottom</li><li>A : font top</li><li>L : font baseline</li><li>D : font bottom</li></ul>
	 * @param string $valign text vertical alignment inside the cell. Possible values are:<ul><li>T : top</li><li>C : center</li><li>B : bottom</li></ul>
	 * @access public
	 * @since 1.0
	 * @see SetFont(), SetDrawColor(), SetFillColor(), SetTextColor(), SetLineWidth(), AddLink(), Ln(), MultiCell(), Write(), SetAutoPageBreak()
	 */
	public function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M') {
		$prev_cell_margin = $this->cell_margin;
		$prev_cell_padding = $this->cell_padding;
		$this->adjustCellPadding($border);
		if (!$ignore_min_height) {
			$min_cell_height = ($this->FontSize * $this->cell_height_ratio) + $this->cell_padding['T'] + $this->cell_padding['B'];
			if ($h < $min_cell_height) {
				$h = $min_cell_height;
			}
		}
		$this->checkPageBreak($h + $this->cell_margin['T'] + $this->cell_margin['B']);
		$this->_out($this->getCellCode($w, $h, $txt, $border, $ln, $align, $fill, $link, $stretch, true, $calign, $valign));
		$this->cell_padding = $prev_cell_padding;
		$this->cell_margin = $prev_cell_margin;
	}

	/**
	 * Returns the PDF string code to print a cell (rectangular area) with optional borders, background color and character string. The upper-left corner of the cell corresponds to the current position. The text can be aligned or centered. After the call, the current position moves to the right or to the next line. It is possible to put a link on the text.<br />
	 * If automatic page breaking is enabled and the cell goes beyond the limit, a page break is done before outputting.
	 * @param float $w Cell width. If 0, the cell extends up to the right margin.
	 * @param float $h Cell height. Default value: 0.
	 * @param string $txt String to print. Default value: empty string.
	 * @param mixed $border Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @param int $ln Indicates where the current position should go after the call. Possible values are:<ul><li>0: to the right (or left for RTL languages)</li><li>1: to the beginning of the next line</li><li>2: below</li></ul>Putting 1 is equivalent to putting 0 and calling Ln() just after. Default value: 0.
	 * @param string $align Allows to center or align the text. Possible values are:<ul><li>L or empty string: left align (default value)</li><li>C: center</li><li>R: right align</li><li>J: justify</li></ul>
	 * @param boolean $fill Indicates if the cell background must be painted (true) or transparent (false).
	 * @param mixed $link URL or identifier returned by AddLink().
	 * @param int $stretch font stretch mode: <ul><li>0 = disabled</li><li>1 = horizontal scaling only if text is larger than cell width</li><li>2 = forced horizontal scaling to fit cell width</li><li>3 = character spacing only if text is larger than cell width</li><li>4 = forced character spacing to fit cell width</li></ul> General font stretching and scaling values will be preserved when possible.
	 * @param boolean $ignore_min_height if true ignore automatic minimum height value.
	 * @param string $calign cell vertical alignment relative to the specified Y value. Possible values are:<ul><li>T : cell top</li><li>C : center</li><li>B : cell bottom</li><li>A : font top</li><li>L : font baseline</li><li>D : font bottom</li></ul>
	 * @param string $valign text vertical alignment inside the cell. Possible values are:<ul><li>T : top</li><li>M : middle</li><li>B : bottom</li></ul>
	 * @return string containing cell code
	 * @access protected
	 * @since 1.0
	 * @see Cell()
	 */
	protected function getCellCode($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M') {
		$prev_cell_margin = $this->cell_margin;
		$prev_cell_padding = $this->cell_padding;
		$txt = $this->removeSHY($txt);
		$rs = ''; //string to be returned
		$this->adjustCellPadding($border);
		if (!$ignore_min_height) {
			$min_cell_height = ($this->FontSize * $this->cell_height_ratio) + $this->cell_padding['T'] + $this->cell_padding['B'];
			if ($h < $min_cell_height) {
				$h = $min_cell_height;
			}
		}
		// check page for no-write regions and adapt page margins if necessary
		$this->checkPageRegions($h);
		$k = $this->k;
		if ($this->rtl) {
			$x = $this->x - $this->cell_margin['R'];
		} else {
			$x = $this->x + $this->cell_margin['L'];
		}
		$y = $this->y + $this->cell_margin['T'];
		$prev_font_stretching = $this->font_stretching;
		$prev_font_spacing = $this->font_spacing;
		// cell vertical alignment
		switch ($calign) {
			case 'A': {
				// font top
				switch ($valign) {
					case 'T': {
						// top
						$y -= $this->cell_padding['T'];
						break;
					}
					case 'B': {
						// bottom
						$y -= ($h - $this->cell_padding['B'] - $this->FontAscent - $this->FontDescent);
						break;
					}
					default:
					case 'C':
					case 'M': {
						// center
						$y -= (($h - $this->FontAscent - $this->FontDescent) / 2);
						break;
					}
				}
				break;
			}
			case 'L': {
				// font baseline
				switch ($valign) {
					case 'T': {
						// top
						$y -= ($this->cell_padding['T'] + $this->FontAscent);
						break;
					}
					case 'B': {
						// bottom
						$y -= ($h - $this->cell_padding['B'] - $this->FontDescent);
						break;
					}
					default:
					case 'C':
					case 'M': {
						// center
						$y -= (($h + $this->FontAscent - $this->FontDescent) / 2);
						break;
					}
				}
				break;
			}
			case 'D': {
				// font bottom
				switch ($valign) {
					case 'T': {
						// top
						$y -= ($this->cell_padding['T'] + $this->FontAscent + $this->FontDescent);
						break;
					}
					case 'B': {
						// bottom
						$y -= ($h - $this->cell_padding['B']);
						break;
					}
					default:
					case 'C':
					case 'M': {
						// center
						$y -= (($h + $this->FontAscent + $this->FontDescent) / 2);
						break;
					}
				}
				break;
			}
			case 'B': {
				// cell bottom
				$y -= $h;
				break;
			}
			case 'C':
			case 'M': {
				// cell center
				$y -= ($h / 2);
				break;
			}
			default:
			case 'T': {
				// cell top
				break;
			}
		}
		// text vertical alignment
		switch ($valign) {
			case 'T': {
				// top
				$yt = $y + $this->cell_padding['T'];
				break;
			}
			case 'B': {
				// bottom
				$yt = $y + $h - $this->cell_padding['B'] - $this->FontAscent - $this->FontDescent;
				break;
			}
			default:
			case 'C':
			case 'M': {
				// center
				$yt = $y + (($h - $this->FontAscent - $this->FontDescent) / 2);
				break;
			}
		}
		$basefonty = $yt + $this->FontAscent;
		if ($this->empty_string($w) OR ($w <= 0)) {
			if ($this->rtl) {
				$w = $x - $this->lMargin;
			} else {
				$w = $this->w - $this->rMargin - $x;
			}
		}
		$s = '';
		// fill and borders
		if (is_string($border) AND (strlen($border) == 4)) {
			// full border
			$border = 1;
		}
		if ($fill OR ($border == 1)) {
			if ($fill) {
				$op = ($border == 1) ? 'B' : 'f';
			} else {
				$op = 'S';
			}
			if ($this->rtl) {
				$xk = (($x - $w) * $k);
			} else {
				$xk = ($x * $k);
			}
			$s .= sprintf('%.2F %.2F %.2F %.2F re %s ', $xk, (($this->h - $y) * $k), ($w * $k), (-$h * $k), $op);
		}
		// draw borders
		$s .= $this->getCellBorder($x, $y, $w, $h, $border);
		if ($txt != '') {
			$txt2 = $txt;
			if ($this->isunicode) {
				if (($this->CurrentFont['type'] == 'core') OR ($this->CurrentFont['type'] == 'TrueType') OR ($this->CurrentFont['type'] == 'Type1')) {
					$txt2 = $this->UTF8ToLatin1($txt2);
				} else {
					$unicode = $this->UTF8StringToArray($txt); // array of UTF-8 unicode values
					$unicode = $this->utf8Bidi($unicode, '', $this->tmprtl);
					if (defined('K_THAI_TOPCHARS') AND (K_THAI_TOPCHARS == true)) {
						// ---- Fix for bug #2977340 "Incorrect Thai characters position arrangement" ----
						// NOTE: this doesn't work with HTML justification
						// Symbols that could overlap on the font top (only works in LTR)
						$topchar = array(3611, 3613, 3615, 3650, 3651, 3652); // chars that extends on top
						$topsym = array(3633, 3636, 3637, 3638, 3639, 3655, 3656, 3657, 3658, 3659, 3660, 3661, 3662); // symbols with top position
						$numchars = count($unicode); // number of chars
						$unik = 0;
						$uniblock = array();
						$uniblock[$unik] = array();
						$uniblock[$unik][] = $unicode[0];
						// resolve overlapping conflicts by splitting the string in several parts
						for ($i = 1; $i < $numchars; ++$i) {
							// check if symbols overlaps at top
							if (in_array($unicode[$i], $topsym) AND (in_array($unicode[($i - 1)], $topsym) OR in_array($unicode[($i - 1)], $topchar))) {
								// move symbols to another array
								++$unik;
								$uniblock[$unik] = array();
								$uniblock[$unik][] = $unicode[$i];
								++$unik;
								$uniblock[$unik] = array();
								$unicode[$i] = 0x200b; // Unicode Character 'ZERO WIDTH SPACE' (DEC:8203, U+200B)
							} else {
								$uniblock[$unik][] = $unicode[$i];
							}
						}
						// ---- END OF Fix for bug #2977340
					}
					$txt2 = $this->arrUTF8ToUTF16BE($unicode, false);
				}
			}
			$txt2 = $this->_escape($txt2);
			// get current text width (considering general font stretching and spacing)
			$txwidth = $this->GetStringWidth($txt);
			$width = $txwidth;
			// check for stretch mode
			if ($stretch > 0) {
				// calculate ratio between cell width and text width
				if ($width <= 0) {
					$ratio = 1;
				} else {
					$ratio = (($w - $this->cell_padding['L'] - $this->cell_padding['R']) / $width);
				}
				// check if stretching is required
				if (($ratio < 1) OR (($ratio > 1) AND (($stretch % 2) == 0))) {
					// the text will be stretched to fit cell width
					if ($stretch > 2) {
						// set new character spacing
						$this->font_spacing += ($w - $this->cell_padding['L'] - $this->cell_padding['R'] - $width) / (max(($this->GetNumChars($txt) - 1), 1) * ($this->font_stretching / 100));
					} else {
						// set new horizontal stretching
						$this->font_stretching *= $ratio;
					}
					// recalculate text width (the text fills the entire cell)
					$width = $w - $this->cell_padding['L'] - $this->cell_padding['R'];
					// reset alignment
					$align = '';
				}
			}
			if ($this->font_stretching != 100) {
				// apply font stretching
				$rs .= sprintf('BT %.2F Tz ET ', $this->font_stretching);
			}
			if ($this->font_spacing != 0) {
				// increase/decrease font spacing
				$rs .= sprintf('BT %.2F Tc ET ', ($this->font_spacing * $this->k));
			}
			if ($this->ColorFlag) {
				$s .= 'q '.$this->TextColor.' ';
			}
			// rendering mode
			$s .= sprintf('BT %d Tr %.2F w ET ', $this->textrendermode, $this->textstrokewidth);
			// count number of spaces
			$ns = substr_count($txt, chr(32));
			// Justification
			$spacewidth = 0;
			if (($align == 'J') AND ($ns > 0)) {
				if ($this->isUnicodeFont()) {
					// get string width without spaces
					$width = $this->GetStringWidth(str_replace(' ', '', $txt));
					// calculate average space width
					$spacewidth = -1000 * ($w - $width - $this->cell_padding['L'] - $this->cell_padding['R']) / ($ns?$ns:1) / $this->FontSize;
					if ($this->font_stretching != 100) {
						// word spacing is affected by stretching
						$spacewidth /= ($this->font_stretching / 100);
					}
					// set word position to be used with TJ operator
					$txt2 = str_replace(chr(0).chr(32), ') '.sprintf('%.3F', $spacewidth).' (', $txt2);
					$unicode_justification = true;
				} else {
					// get string width
					$width = $txwidth;
					// new space width
					$spacewidth = (($w - $width - $this->cell_padding['L'] - $this->cell_padding['R']) / ($ns?$ns:1)) * $this->k;
					if ($this->font_stretching != 100) {
						// word spacing (Tw) is affected by stretching
						$spacewidth /= ($this->font_stretching / 100);
					}
					// set word spacing
					$rs .= sprintf('BT %.3F Tw ET ', $spacewidth);
				}
				$width = $w - $this->cell_padding['L'] - $this->cell_padding['R'];
			}
			// replace carriage return characters
			$txt2 = str_replace("\r", ' ', $txt2);
			switch ($align) {
				case 'C': {
					$dx = ($w - $width) / 2;
					break;
				}
				case 'R': {
					if ($this->rtl) {
						$dx = $this->cell_padding['R'];
					} else {
						$dx = $w - $width - $this->cell_padding['R'];
					}
					break;
				}
				case 'L': {
					if ($this->rtl) {
						$dx = $w - $width - $this->cell_padding['L'];
					} else {
						$dx = $this->cell_padding['L'];
					}
					break;
				}
				case 'J':
				default: {
					if ($this->rtl) {
						$dx = $this->cell_padding['R'];
					} else {
						$dx = $this->cell_padding['L'];
					}
					break;
				}
			}
			if ($this->rtl) {
				$xdx = $x - $dx - $width;
			} else {
				$xdx = $x + $dx;
			}
			$xdk = $xdx * $k;
			// print text
			$s .= sprintf('BT %.2F %.2F Td [(%s)] TJ ET', $xdk, (($this->h - $basefonty) * $k), $txt2);
			if (isset($uniblock)) {
				// print overlapping characters as separate string
				$xshift = 0; // horizontal shift
				$ty = (($this->h - $basefonty + (0.2 * $this->FontSize)) * $k);
				$spw = (($w - $txwidth - $this->cell_padding['L'] - $this->cell_padding['R']) / ($ns?$ns:1));
				foreach ($uniblock as $uk => $uniarr) {
					if (($uk % 2) == 0) {
						// x space to skip
						if ($spacewidth != 0) {
							// justification shift
							$xshift += (count(array_keys($uniarr, 32)) * $spw);
						}
						$xshift += $this->GetArrStringWidth($uniarr); // + shift justification
					} else {
						// character to print
						$topchr = $this->arrUTF8ToUTF16BE($uniarr, false);
						$topchr = $this->_escape($topchr);
						$s .= sprintf(' BT %.2F %.2F Td [(%s)] TJ ET', ($xdk + ($xshift * $k)), $ty, $topchr);
					}
				}
			}
			if ($this->underline) {
				$s .= ' '.$this->_dounderlinew($xdx, $basefonty, $width);
			}
			if ($this->linethrough) {
				$s .= ' '.$this->_dolinethroughw($xdx, $basefonty, $width);
			}
			if ($this->overline) {
				$s .= ' '.$this->_dooverlinew($xdx, $basefonty, $width);
			}
			if ($this->ColorFlag) {
				$s .= ' Q';
			}
			if ($link) {
				$this->Link($xdx, $yt, $width, ($this->FontAscent + $this->FontDescent), $link, $ns);
			}
		}
		// output cell
		if ($s) {
			// output cell
			$rs .= $s;
			if ($this->font_spacing != 0) {
				// reset font spacing mode
				$rs .= ' BT 0 Tc ET';
			}
			if ($this->font_stretching != 100) {
				// reset font stretching mode
				$rs .= ' BT 100 Tz ET';
			}
		}
		// reset word spacing
		if (!$this->isUnicodeFont() AND ($align == 'J')) {
			$rs .= ' BT 0 Tw ET';
		}
		// reset stretching and spacing
		$this->font_stretching = $prev_font_stretching;
		$this->font_spacing = $prev_font_spacing;
		$this->lasth = $h;
		if ($ln > 0) {
			//Go to the beginning of the next line
			$this->y = $y + $h + $this->cell_margin['B'];
			if ($ln == 1) {
				if ($this->rtl) {
					$this->x = $this->w - $this->rMargin;
				} else {
					$this->x = $this->lMargin;
				}
			}
		} else {
			// go left or right by case
			if ($this->rtl) {
				$this->x = $x - $w - $this->cell_margin['L'];
			} else {
				$this->x = $x + $w + $this->cell_margin['R'];
			}
		}
		$gstyles = ''.$this->linestyleWidth.' '.$this->linestyleCap.' '.$this->linestyleJoin.' '.$this->linestyleDash.' '.$this->DrawColor.' '.$this->FillColor."\n";
		$rs = $gstyles.$rs;
		$this->cell_padding = $prev_cell_padding;
		$this->cell_margin = $prev_cell_margin;
		return $rs;
	}

	/**
	 * Returns the code to draw the cell border
	 * @param float $x X coordinate.
	 * @param float $y Y coordinate.
	 * @param float $w Cell width.
	 * @param float $h Cell height.
	 * @param mixed $brd Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @param string $mode border position respect the square edge: normal: centered; ext: external; int: internal;
	 * @return string containing cell border code
	 * @access protected
	 * @see SetLineStyle()
	 * @since 5.7.000 (2010-08-02)
	 */
	protected function getCellBorder($x, $y, $w, $h, $brd) {
		$s = ''; // string to be returned
		if (empty($brd)) {
			return $s;
		}
		if ($brd == 1) {
			$brd = array('LRTB' => true);
		}
		// calculate coordinates for border
		$k = $this->k;
		if ($this->rtl) {
			$xeL = ($x - $w) * $k;
			$xeR = $x * $k;
		} else {
			$xeL = $x * $k;
			$xeR = ($x + $w) * $k;
		}
		$yeL = (($this->h - ($y + $h)) * $k);
		$yeT = (($this->h - $y) * $k);
		$xeT = $xeL;
		$xeB = $xeR;
		$yeR = $yeT;
		$yeB = $yeL;
		if (is_string($brd)) {
			// convert string to array
			$slen = strlen($brd);
			$newbrd = array();
			for ($i = 0; $i < $slen; ++$i) {
				$newbrd[$brd{$i}] = array('cap' => 'square', 'join' => 'miter');
			}
			$brd = $newbrd;
		}
		if (isset($brd['mode'])) {
			$mode = $brd['mode'];
			unset($brd['mode']);
		} else {
			$mode = 'normal';
		}
		foreach ($brd as $border => $style) {
			if (is_array($style) AND !empty($style)) {
				// apply border style
				$prev_style = $this->linestyleWidth.' '.$this->linestyleCap.' '.$this->linestyleJoin.' '.$this->linestyleDash.' '.$this->DrawColor.' ';
				$s .= $this->SetLineStyle($style, true)."\n";
			}
			switch ($mode) {
				case 'ext': {
					$off = (($this->LineWidth / 2) * $k);
					$xL = $xeL - $off;
					$xR = $xeR + $off;
					$yT = $yeT + $off;
					$yL = $yeL - $off;
					$xT = $xL;
					$xB = $xR;
					$yR = $yT;
					$yB = $yL;
					$w += $this->LineWidth;
					$h += $this->LineWidth;
					break;
				}
				case 'int': {
					$off = ($this->LineWidth / 2) * $k;
					$xL = $xeL + $off;
					$xR = $xeR - $off;
					$yT = $yeT - $off;
					$yL = $yeL + $off;
					$xT = $xL;
					$xB = $xR;
					$yR = $yT;
					$yB = $yL;
					$w -= $this->LineWidth;
					$h -= $this->LineWidth;
					break;
				}
				case 'normal':
				default: {
					$xL = $xeL;
					$xT = $xeT;
					$xB = $xeB;
					$xR = $xeR;
					$yL = $yeL;
					$yT = $yeT;
					$yB = $yeB;
					$yR = $yeR;
					break;
				}
			}
			// draw borders by case
			if (strlen($border) == 4) {
				$s .= sprintf('%.2F %.2F %.2F %.2F re S ', $xT, $yT, ($w * $k), (-$h * $k));
			} elseif (strlen($border) == 3) {
				if (strpos($border,'B') === false) { // LTR
					$s .= sprintf('%.2F %.2F m ', $xL, $yL);
					$s .= sprintf('%.2F %.2F l ', $xT, $yT);
					$s .= sprintf('%.2F %.2F l ', $xR, $yR);
					$s .= sprintf('%.2F %.2F l ', $xB, $yB);
					$s .= 'S ';
				} elseif (strpos($border,'L') === false) { // TRB
					$s .= sprintf('%.2F %.2F m ', $xT, $yT);
					$s .= sprintf('%.2F %.2F l ', $xR, $yR);
					$s .= sprintf('%.2F %.2F l ', $xB, $yB);
					$s .= sprintf('%.2F %.2F l ', $xL, $yL);
					$s .= 'S ';
				} elseif (strpos($border,'T') === false) { // RBL
					$s .= sprintf('%.2F %.2F m ', $xR, $yR);
					$s .= sprintf('%.2F %.2F l ', $xB, $yB);
					$s .= sprintf('%.2F %.2F l ', $xL, $yL);
					$s .= sprintf('%.2F %.2F l ', $xT, $yT);
					$s .= 'S ';
				} elseif (strpos($border,'R') === false) { // BLT
					$s .= sprintf('%.2F %.2F m ', $xB, $yB);
					$s .= sprintf('%.2F %.2F l ', $xL, $yL);
					$s .= sprintf('%.2F %.2F l ', $xT, $yT);
					$s .= sprintf('%.2F %.2F l ', $xR, $yR);
					$s .= 'S ';
				}
			} elseif (strlen($border) == 2) {
				if ((strpos($border,'L') !== false) AND (strpos($border,'T') !== false)) { // LT
					$s .= sprintf('%.2F %.2F m ', $xL, $yL);
					$s .= sprintf('%.2F %.2F l ', $xT, $yT);
					$s .= sprintf('%.2F %.2F l ', $xR, $yR);
					$s .= 'S ';
				} elseif ((strpos($border,'T') !== false) AND (strpos($border,'R') !== false)) { // TR
					$s .= sprintf('%.2F %.2F m ', $xT, $yT);
					$s .= sprintf('%.2F %.2F l ', $xR, $yR);
					$s .= sprintf('%.2F %.2F l ', $xB, $yB);
					$s .= 'S ';
				} elseif ((strpos($border,'R') !== false) AND (strpos($border,'B') !== false)) { // RB
					$s .= sprintf('%.2F %.2F m ', $xR, $yR);
					$s .= sprintf('%.2F %.2F l ', $xB, $yB);
					$s .= sprintf('%.2F %.2F l ', $xL, $yL);
					$s .= 'S ';
				} elseif ((strpos($border,'B') !== false) AND (strpos($border,'L') !== false)) { // BL
					$s .= sprintf('%.2F %.2F m ', $xB, $yB);
					$s .= sprintf('%.2F %.2F l ', $xL, $yL);
					$s .= sprintf('%.2F %.2F l ', $xT, $yT);
					$s .= 'S ';
				} elseif ((strpos($border,'L') !== false) AND (strpos($border,'R') !== false)) { // LR
					$s .= sprintf('%.2F %.2F m ', $xL, $yL);
					$s .= sprintf('%.2F %.2F l ', $xT, $yT);
					$s .= 'S ';
					$s .= sprintf('%.2F %.2F m ', $xR, $yR);
					$s .= sprintf('%.2F %.2F l ', $xB, $yB);
					$s .= 'S ';
				} elseif ((strpos($border,'T') !== false) AND (strpos($border,'B') !== false)) { // TB
					$s .= sprintf('%.2F %.2F m ', $xT, $yT);
					$s .= sprintf('%.2F %.2F l ', $xR, $yR);
					$s .= 'S ';
					$s .= sprintf('%.2F %.2F m ', $xB, $yB);
					$s .= sprintf('%.2F %.2F l ', $xL, $yL);
					$s .= 'S ';
				}
			} else { // strlen($border) == 1
				if (strpos($border,'L') !== false) { // L
					$s .= sprintf('%.2F %.2F m ', $xL, $yL);
					$s .= sprintf('%.2F %.2F l ', $xT, $yT);
					$s .= 'S ';
				} elseif (strpos($border,'T') !== false) { // T
					$s .= sprintf('%.2F %.2F m ', $xT, $yT);
					$s .= sprintf('%.2F %.2F l ', $xR, $yR);
					$s .= 'S ';
				} elseif (strpos($border,'R') !== false) { // R
					$s .= sprintf('%.2F %.2F m ', $xR, $yR);
					$s .= sprintf('%.2F %.2F l ', $xB, $yB);
					$s .= 'S ';
				} elseif (strpos($border,'B') !== false) { // B
					$s .= sprintf('%.2F %.2F m ', $xB, $yB);
					$s .= sprintf('%.2F %.2F l ', $xL, $yL);
					$s .= 'S ';
				}
			}
			if (is_array($style) AND !empty($style)) {
				// reset border style to previous value
				$s .= "\n".$this->linestyleWidth.' '.$this->linestyleCap.' '.$this->linestyleJoin.' '.$this->linestyleDash.' '.$this->DrawColor."\n";
			}
		}
		return $s;
	}

	/**
	 * This method allows printing text with line breaks.
	 * They can be automatic (as soon as the text reaches the right border of the cell) or explicit (via the \n character). As many cells as necessary are output, one below the other.<br />
	 * Text can be aligned, centered or justified. The cell block can be framed and the background painted.
	 * @param float $w Width of cells. If 0, they extend up to the right margin of the page.
	 * @param float $h Cell minimum height. The cell extends automatically if needed.
	 * @param string $txt String to print
	 * @param mixed $border Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @param string $align Allows to center or align the text. Possible values are:<ul><li>L or empty string: left align</li><li>C: center</li><li>R: right align</li><li>J: justification (default value when $ishtml=false)</li></ul>
	 * @param boolean $fill Indicates if the cell background must be painted (true) or transparent (false).
	 * @param int $ln Indicates where the current position should go after the call. Possible values are:<ul><li>0: to the right</li><li>1: to the beginning of the next line [DEFAULT]</li><li>2: below</li></ul>
	 * @param float $x x position in user units
	 * @param float $y y position in user units
	 * @param boolean $reseth if true reset the last cell height (default true).
	 * @param int $stretch font stretch mode: <ul><li>0 = disabled</li><li>1 = horizontal scaling only if text is larger than cell width</li><li>2 = forced horizontal scaling to fit cell width</li><li>3 = character spacing only if text is larger than cell width</li><li>4 = forced character spacing to fit cell width</li></ul> General font stretching and scaling values will be preserved when possible.
	 * @param boolean $ishtml set to true if $txt is HTML content (default = false).
	 * @param boolean $autopadding if true, uses internal padding and automatically adjust it to account for line width.
	 * @param float $maxh maximum height. It should be >= $h and less then remaining space to the bottom of the page, or 0 for disable this feature. This feature works only when $ishtml=false.
	 * @param string $valign Vertical alignment of text (requires $maxh = $h > 0). Possible values are:<ul><li>T: TOP</li><li>M: middle</li><li>B: bottom</li></ul>. This feature works only when $ishtml=false.
	 * @param boolean $fitcell if true attempt to fit all the text within the cell by reducing the font size.
	 * @return int Return the number of cells or 1 for html mode.
	 * @access public
	 * @since 1.3
	 * @see SetFont(), SetDrawColor(), SetFillColor(), SetTextColor(), SetLineWidth(), Cell(), Write(), SetAutoPageBreak()
	 */
	public function MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false) {
		$prev_cell_margin = $this->cell_margin;
		$prev_cell_padding = $this->cell_padding;
		// adjust internal padding
		$this->adjustCellPadding($border);
		$mc_padding = $this->cell_padding;
		$mc_margin = $this->cell_margin;
		$this->cell_padding['T'] = 0;
		$this->cell_padding['B'] = 0;
		$this->setCellMargins(0, 0, 0, 0);
		if ($this->empty_string($this->lasth) OR $reseth) {
			// reset row height
			$this->resetLastH();
		}
		if (!$this->empty_string($y)) {
			$this->SetY($y);
		} else {
			$y = $this->GetY();
		}
		$resth = 0;
		if ((!$this->InFooter) AND (($y + $h + $mc_margin['T'] + $mc_margin['B']) > $this->PageBreakTrigger)) {
			// spit cell in more pages/columns
			$newh = $this->PageBreakTrigger - $y;
			$resth = $h - $newh; // cell to be printed on the next page/column
			$h = $newh;
		}
		// get current page number
		$startpage = $this->page;
		// get current column
		$startcolumn = $this->current_column;
		if (!$this->empty_string($x)) {
			$this->SetX($x);
		} else {
			$x = $this->GetX();
		}
		// check page for no-write regions and adapt page margins if necessary
		$this->checkPageRegions(0, $x, $y);
		// apply margins
		$oy = $y + $mc_margin['T'];
		if ($this->rtl) {
			$ox = $this->w - $x - $mc_margin['R'];
		} else {
			$ox = $x + $mc_margin['L'];
		}
		$this->x = $ox;
		$this->y = $oy;
		// set width
		if ($this->empty_string($w) OR ($w <= 0)) {
			if ($this->rtl) {
				$w = $this->x - $this->lMargin - $mc_margin['L'];
			} else {
				$w = $this->w - $this->x - $this->rMargin - $mc_margin['R'];
			}
		}
		// store original margin values
		$lMargin = $this->lMargin;
		$rMargin = $this->rMargin;
		if ($this->rtl) {
			$this->rMargin = $this->w - $this->x;
			$this->lMargin = $this->x - $w;
		} else {
			$this->lMargin = $this->x;
			$this->rMargin = $this->w - $this->x - $w;
		}
		if ($autopadding) {
			// add top padding
			$this->y += $mc_padding['T'];
		}
		if ($ishtml) { // ******* Write HTML text
			$this->writeHTML($txt, true, 0, $reseth, true, $align);
			$nl = 1;
		} else { // ******* Write simple text
			// vertical alignment
			if ($maxh > 0) {
				// get text height
				$text_height = $this->getStringHeight($w, $txt, $reseth, $autopadding, $mc_padding, $border);
				if ($fitcell) {
					$prev_FontSizePt = $this->FontSizePt;
					// try to reduce font size to fit text on cell (use a quick search algorithm)
					$fmin = 1;
					$fmax = $this->FontSizePt;
					$prev_text_height = $text_height;
					$maxit = 100; // max number of iterations
					while ($maxit > 0) {
						$fmid = (($fmax + $fmin) / 2);
						$this->SetFontSize($fmid, false);
						$this->resetLastH();
						$text_height = $this->getStringHeight($w, $txt, $reseth, $autopadding, $mc_padding, $border);
						if (($text_height == $maxh) OR (($text_height < $maxh) AND ($fmin >= ($fmax - 0.01)))) {
							break;
						} elseif ($text_height < $maxh) {
							$fmin = $fmid;
						} else {
							$fmax = $fmid;
						}
						--$maxit;
					}
					$this->SetFontSize($this->FontSizePt);
				}
				if ($text_height < $maxh) {
					if ($valign == 'M') {
						// text vertically centered
						$this->y += (($maxh - $text_height) / 2);
					} elseif ($valign == 'B') {
						// text vertically aligned on bottom
						$this->y += ($maxh - $text_height);
					}
				}
			}
			$nl = $this->Write($this->lasth, $txt, '', 0, $align, true, $stretch, false, true, $maxh, 0, $mc_margin);
			if ($fitcell) {
				// restore font size
				$this->SetFontSize($prev_FontSizePt);
			}
		}
		if ($autopadding) {
			// add bottom padding
			$this->y += $mc_padding['B'];
		}
		// Get end-of-text Y position
		$currentY = $this->y;
		// get latest page number
		$endpage = $this->page;
		if ($resth > 0) {
			$skip = ($endpage - $startpage);
			$tmpresth = $resth;
			while ($tmpresth > 0) {
				if ($skip <= 0) {
					// add a page (or trig AcceptPageBreak() for multicolumn mode)
					$this->checkPageBreak($this->PageBreakTrigger + 1);
				}
				if ($this->num_columns > 1) {
					$tmpresth -= ($this->h - $this->y - $this->bMargin);
				} else {
					$tmpresth -= ($this->h - $this->tMargin - $this->bMargin);
				}
				--$skip;
			}
			$currentY = $this->y;
			$endpage = $this->page;
		}
		// get latest column
		$endcolumn = $this->current_column;
		if ($this->num_columns == 0) {
			$this->num_columns = 1;
		}
		// get border modes
		$border_start = $this->getBorderMode($border, $position='start');
		$border_end = $this->getBorderMode($border, $position='end');
		$border_middle = $this->getBorderMode($border, $position='middle');
		// design borders around HTML cells.
		for ($page = $startpage; $page <= $endpage; ++$page) { // for each page
			$ccode = '';
			$this->setPage($page);
			if ($this->num_columns < 2) {
				// single-column mode
				$this->SetX($x);
				$this->y = $this->tMargin;
			}
			// account for margin changes
			if ($page > $startpage) {
				if (($this->rtl) AND ($this->pagedim[$page]['orm'] != $this->pagedim[$startpage]['orm'])) {
					$this->x -= ($this->pagedim[$page]['orm'] - $this->pagedim[$startpage]['orm']);
				} elseif ((!$this->rtl) AND ($this->pagedim[$page]['olm'] != $this->pagedim[$startpage]['olm'])) {
					$this->x += ($this->pagedim[$page]['olm'] - $this->pagedim[$startpage]['olm']);
				}
			}
			if ($startpage == $endpage) {
				// single page
				for ($column = $startcolumn; $column <= $endcolumn; ++$column) { // for each column
					$this->selectColumn($column);
					if ($this->rtl) {
						$this->x -= $mc_margin['R'];
					} else {
						$this->x += $mc_margin['L'];
					}
					if ($startcolumn == $endcolumn) { // single column
						$cborder = $border;
						$h = max($h, ($currentY - $oy));
						$this->y = $oy;
					} elseif ($column == $startcolumn) { // first column
						$cborder = $border_start;
						$this->y = $oy;
						$h = $this->h - $this->y - $this->bMargin;
					} elseif ($column == $endcolumn) { // end column
						$cborder = $border_end;
						$h = $currentY - $this->y;
						if ($resth > $h) {
							$h = $resth;
						}
					} else { // middle column
						$cborder = $border_middle;
						$h = $this->h - $this->y - $this->bMargin;
						$resth -= $h;
					}
					$ccode .= $this->getCellCode($w, $h, '', $cborder, 1, '', $fill, '', 0, true)."\n";
				} // end for each column
			} elseif ($page == $startpage) { // first page
				for ($column = $startcolumn; $column < $this->num_columns; ++$column) { // for each column
					$this->selectColumn($column);
					if ($this->rtl) {
						$this->x -= $mc_margin['R'];
					} else {
						$this->x += $mc_margin['L'];
					}
					if ($column == $startcolumn) { // first column
						$cborder = $border_start;
						$this->y = $oy;
						$h = $this->h - $this->y - $this->bMargin;
					} else { // middle column
						$cborder = $border_middle;
						$h = $this->h - $this->y - $this->bMargin;
						$resth -= $h;
					}
					$ccode .= $this->getCellCode($w, $h, '', $cborder, 1, '', $fill, '', 0, true)."\n";
				} // end for each column
			} elseif ($page == $endpage) { // last page
				for ($column = 0; $column <= $endcolumn; ++$column) { // for each column
					$this->selectColumn($column);
					if ($this->rtl) {
						$this->x -= $mc_margin['R'];
					} else {
						$this->x += $mc_margin['L'];
					}
					if ($column == $endcolumn) {
						// end column
						$cborder = $border_end;
						$h = $currentY - $this->y;
						if ($resth > $h) {
							$h = $resth;
						}
					} else {
						// middle column
						$cborder = $border_middle;
						$h = $this->h - $this->y - $this->bMargin;
						$resth -= $h;
					}
					$ccode .= $this->getCellCode($w, $h, '', $cborder, 1, '', $fill, '', 0, true)."\n";
				} // end for each column
			} else { // middle page
				for ($column = 0; $column < $this->num_columns; ++$column) { // for each column
					$this->selectColumn($column);
					if ($this->rtl) {
						$this->x -= $mc_margin['R'];
					} else {
						$this->x += $mc_margin['L'];
					}
					$cborder = $border_middle;
					$h = $this->h - $this->y - $this->bMargin;
					$resth -= $h;
					$ccode .= $this->getCellCode($w, $h, '', $cborder, 1, '', $fill, '', 0, true)."\n";
				} // end for each column
			}
			if ($cborder OR $fill) {
				// draw border and fill
				if ($this->inxobj) {
					// we are inside an XObject template
					if (end($this->xobjects[$this->xobjid]['transfmrk']) !== false) {
						$pagemarkkey = key($this->xobjects[$this->xobjid]['transfmrk']);
						$pagemark = &$this->xobjects[$this->xobjid]['transfmrk'][$pagemarkkey];
					} else {
						$pagemark = &$this->xobjects[$this->xobjid]['intmrk'];
					}
					$pagebuff = $this->xobjects[$this->xobjid]['outdata'];
					$pstart = substr($pagebuff, 0, $pagemark);
					$pend = substr($pagebuff, $pagemark);
					$this->xobjects[$this->xobjid]['outdata'] = $pstart.$ccode.$pend;
					$pagemark += strlen($ccode);
				} else {
					if (end($this->transfmrk[$this->page]) !== false) {
						$pagemarkkey = key($this->transfmrk[$this->page]);
						$pagemark = &$this->transfmrk[$this->page][$pagemarkkey];
					} elseif ($this->InFooter) {
						$pagemark = &$this->footerpos[$this->page];
					} else {
						$pagemark = &$this->intmrk[$this->page];
					}
					$pagebuff = $this->getPageBuffer($this->page);
					$pstart = substr($pagebuff, 0, $pagemark);
					$pend = substr($pagebuff, $pagemark);
					$this->setPageBuffer($this->page, $pstart.$ccode.$pend);
					$pagemark += strlen($ccode);
				}
			}
		} // end for each page
		// Get end-of-cell Y position
		$currentY = $this->GetY();
		// restore original margin values
		$this->SetLeftMargin($lMargin);
		$this->SetRightMargin($rMargin);
		if ($ln > 0) {
			//Go to the beginning of the next line
			$this->SetY($currentY + $mc_margin['B']);
			if ($ln == 2) {
				$this->SetX($x + $w + $mc_margin['L'] + $mc_margin['R']);
			}
		} else {
			// go left or right by case
			$this->setPage($startpage);
			$this->y = $y;
			$this->SetX($x + $w + $mc_margin['L'] + $mc_margin['R']);
		}
		$this->setContentMark();
		$this->cell_padding = $prev_cell_padding;
		$this->cell_margin = $prev_cell_margin;
		return $nl;
	}

	/**
	 * Get the border mode accounting for multicell position (opens bottom side of multicell crossing pages)
	 * @param mixed $brd Indicates if borders must be drawn around the cell block. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul>or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @param string multicell position: 'start', 'middle', 'end'
	 * @return border mode array
	 * @access protected
	 * @since 4.4.002 (2008-12-09)
	 */
	protected function getBorderMode($brd, $position='start') {
		if ((!$this->opencell) OR empty($brd)) {
			return $brd;
		}
		if ($brd == 1) {
			$brd = 'LTRB';
		}
		if (is_string($brd)) {
			// convert string to array
			$slen = strlen($brd);
			$newbrd = array();
			for ($i = 0; $i < $slen; ++$i) {
				$newbrd[$brd{$i}] = array('cap' => 'square', 'join' => 'miter');
			}
			$brd = $newbrd;
		}
		foreach ($brd as $border => $style) {
			switch ($position) {
				case 'start': {
					if (strpos($border, 'B') !== false) {
						// remove bottom line
						$newkey = str_replace('B', '', $border);
						if (strlen($newkey) > 0) {
							$brd[$newkey] = $style;
						}
						unset($brd[$border]);
					}
					break;
				}
				case 'middle': {
					if (strpos($border, 'B') !== false) {
						// remove bottom line
						$newkey = str_replace('B', '', $border);
						if (strlen($newkey) > 0) {
							$brd[$newkey] = $style;
						}
						unset($brd[$border]);
						$border = $newkey;
					}
					if (strpos($border, 'T') !== false) {
						// remove bottom line
						$newkey = str_replace('T', '', $border);
						if (strlen($newkey) > 0) {
							$brd[$newkey] = $style;
						}
						unset($brd[$border]);
					}
					break;
				}
				case 'end': {
					if (strpos($border, 'T') !== false) {
						// remove bottom line
						$newkey = str_replace('T', '', $border);
						if (strlen($newkey) > 0) {
							$brd[$newkey] = $style;
						}
						unset($brd[$border]);
					}
					break;
				}
			}
		}
		return $brd;
	}

	/**
	 * This method return the estimated number of lines for print a simple text string using Multicell() method.
	 * @param string $txt String for calculating his height
	 * @param float $w Width of cells. If 0, they extend up to the right margin of the page.
	 * @param boolean $reseth if true reset the last cell height (default false).
	 * @param boolean $autopadding if true, uses internal padding and automatically adjust it to account for line width (default true).
	 * @param float $cellpadding Internal cell padding, if empty uses default cell padding.
	 * @param mixed $border Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @return float Return the minimal height needed for multicell method for printing the $txt param.
	 * @author Alexander Escalona Fernández, Nicola Asuni
	 * @access public
	 * @since 4.5.011
	 */
	public function getNumLines($txt, $w=0, $reseth=false, $autopadding=true, $cellpadding='', $border=0) {
		if ($txt === '') {
			// empty string
			return 1;
		}
		// adjust internal padding
		$prev_cell_padding = $this->cell_padding;
		$prev_lasth = $this->lasth;
		if (is_array($cellpadding)) {
			$this->cell_padding = $cellpadding;
		}
		$this->adjustCellPadding($border);
		if ($this->empty_string($w) OR ($w <= 0)) {
			if ($this->rtl) {
				$w = $this->x - $this->lMargin;
			} else {
				$w = $this->w - $this->rMargin - $this->x;
			}
		}
		$wmax = $w - $this->cell_padding['L'] - $this->cell_padding['R'];
		if ($reseth) {
			// reset row height
			$this->resetLastH();
		}
		$lines = 1;
		$sum = 0;
		$chars = $this->utf8Bidi($this->UTF8StringToArray($txt), $txt, $this->tmprtl);
		$charsWidth = $this->GetArrStringWidth($chars, '', '', 0, true);
		$length = count($chars);
		$lastSeparator = -1;
		for ($i = 0; $i < $length; ++$i) {
			$charWidth = $charsWidth[$i];
			if (preg_match($this->re_spaces, $this->unichr($chars[$i]))) {
				$lastSeparator = $i;
			}
			if ((($sum + $charWidth) > $wmax) OR ($chars[$i] == 10)) {
				++$lines;
				if ($lastSeparator != -1) {
					$i = $lastSeparator;
					$lastSeparator = -1;
					$sum = 0;
				} else {
					$sum = $charWidth;
				}
			} else {
				$sum += $charWidth;
			}
		}
		if ($chars[($length - 1)] == 10) {
			--$lines;
		}
		$this->cell_padding = $prev_cell_padding;
		$this->lasth = $prev_lasth;
		return $lines;
	}

	/**
	 * This method return the estimated needed height for print a simple text string in Multicell() method.
	 * Generally, if you want to know the exact height for a block of content you can use the following alternative technique:
	 * <pre>
	 *  // store current object
	 *  $pdf->startTransaction();
	 *  // store starting values
	 *  $start_y = $pdf->GetY();
	 *  $start_page = $pdf->getPage();
	 *  // call your printing functions with your parameters
	 *  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	 *  $pdf->MultiCell($w=0, $h=0, $txt, $border=1, $align='L', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0);
	 *  // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	 *  // get the new Y
	 *  $end_y = $pdf->GetY();
	 *  $end_page = $pdf->getPage();
	 *  // calculate height
	 *  $height = 0;
	 *  if ($end_page == $start_page) {
	 *  	$height = $end_y - $start_y;
	 *  } else {
	 *  	for ($page=$start_page; $page <= $end_page; ++$page) {
	 *  		$this->setPage($page);
	 *  		if ($page == $start_page) {
	 *  			// first page
	 *  			$height = $this->h - $start_y - $this->bMargin;
	 *  		} elseif ($page == $end_page) {
	 *  			// last page
	 *  			$height = $end_y - $this->tMargin;
	 *  		} else {
	 *  			$height = $this->h - $this->tMargin - $this->bMargin;
	 *  		}
	 *  	}
	 *  }
	 *  // restore previous object
	 *  $pdf = $pdf->rollbackTransaction();
	 * </pre>
	 * @param float $w Width of cells. If 0, they extend up to the right margin of the page.
	 * @param string $txt String for calculating his height
	 * @param boolean $reseth if true reset the last cell height (default false).
	 * @param boolean $autopadding if true, uses internal padding and automatically adjust it to account for line width (default true).
	 * @param float $cellpadding Internal cell padding, if empty uses default cell padding.
	 * @param mixed $border Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @return float Return the minimal height needed for multicell method for printing the $txt param.
	 * @author Nicola Asuni, Alexander Escalona Fernández
	 * @access public
	 */
	public function getStringHeight($w, $txt, $reseth=false, $autopadding=true, $cellpadding='', $border=0) {
		// adjust internal padding
		$prev_cell_padding = $this->cell_padding;
		$prev_lasth = $this->lasth;
		if (is_array($cellpadding)) {
			$this->cell_padding = $cellpadding;
		}
		$this->adjustCellPadding($border);
		$lines = $this->getNumLines($txt, $w, $reseth, $autopadding, $cellpadding, $border);
		$height = $lines * ($this->FontSize * $this->cell_height_ratio);
		if ($autopadding) {
			// add top and bottom padding
			$height += ($this->cell_padding['T'] + $this->cell_padding['B']);
		}
		$this->cell_padding = $prev_cell_padding;
		$this->lasth = $prev_lasth;
		return $height;
	}

	/**
	 * This method prints text from the current position.<br />
	 * @param float $h Line height
	 * @param string $txt String to print
	 * @param mixed $link URL or identifier returned by AddLink()
	 * @param boolean $fill Indicates if the cell background must be painted (true) or transparent (false).
	 * @param string $align Allows to center or align the text. Possible values are:<ul><li>L or empty string: left align (default value)</li><li>C: center</li><li>R: right align</li><li>J: justify</li></ul>
	 * @param boolean $ln if true set cursor at the bottom of the line, otherwise set cursor at the top of the line.
	 * @param int $stretch font stretch mode: <ul><li>0 = disabled</li><li>1 = horizontal scaling only if text is larger than cell width</li><li>2 = forced horizontal scaling to fit cell width</li><li>3 = character spacing only if text is larger than cell width</li><li>4 = forced character spacing to fit cell width</li></ul> General font stretching and scaling values will be preserved when possible.
	 * @param boolean $firstline if true prints only the first line and return the remaining string.
	 * @param boolean $firstblock if true the string is the starting of a line.
	 * @param float $maxh maximum height. The remaining unprinted text will be returned. It should be >= $h and less then remaining space to the bottom of the page, or 0 for disable this feature.
	 * @param float $wadj first line width will be reduced by this amount (used in HTML mode).
	 * @param array $margin margin array of the parent container
	 * @return mixed Return the number of cells or the remaining string if $firstline = true.
	 * @access public
	 * @since 1.5
	 */
	public function Write($h, $txt, $link='', $fill=false, $align='', $ln=false, $stretch=0, $firstline=false, $firstblock=false, $maxh=0, $wadj=0, $margin='') {
		// check page for no-write regions and adapt page margins if necessary
		$this->checkPageRegions($h);
		if (strlen($txt) == 0) {
			// fix empty text
			$txt = ' ';
		}
		if ($margin === '') {
			// set default margins
			$margin = $this->cell_margin;
		}
		// remove carriage returns
		$s = str_replace("\r", '', $txt);
		// check if string contains arabic text
		if (preg_match($this->unicode->uni_RE_PATTERN_ARABIC, $s)) {
			$arabic = true;
		} else {
			$arabic = false;
		}
		// check if string contains RTL text
		if ($arabic OR ($this->tmprtl == 'R') OR preg_match($this->unicode->uni_RE_PATTERN_RTL, $s)) {
			$rtlmode = true;
		} else {
			$rtlmode = false;
		}
		// get a char width
		$chrwidth = $this->GetCharWidth('.');
		// get array of unicode values
		$chars = $this->UTF8StringToArray($s);
		// get array of chars
		$uchars = $this->UTF8ArrayToUniArray($chars);
		// get the number of characters
		$nb = count($chars);
		// replacement for SHY character (minus symbol)
		$shy_replacement = 45;
		$shy_replacement_char = $this->unichr($shy_replacement);
		// widht for SHY replacement
		$shy_replacement_width = $this->GetCharWidth($shy_replacement);
		// max Y
		$maxy = $this->y + $maxh - $h - $this->cell_padding['T'] - $this->cell_padding['B'];
		// calculate remaining line width ($w)
		if ($this->rtl) {
			$w = $this->x - $this->lMargin;
		} else {
			$w = $this->w - $this->rMargin - $this->x;
		}
		// max column width
		$wmax = $w - $wadj;
		if (!$firstline) {
			$wmax -= ($this->cell_padding['L'] + $this->cell_padding['R']);
		}
		if ((!$firstline) AND (($chrwidth > $wmax) OR ($this->GetCharWidth($chars[0]) > $wmax))) {
			// a single character do not fit on column
			return '';
		}
		// minimum row height
		$row_height = max($h, $this->FontSize * $this->cell_height_ratio);
		$start_page = $this->page;
		$i = 0; // character position
		$j = 0; // current starting position
		$sep = -1; // position of the last blank space
		$shy = false; // true if the last blank is a soft hypen (SHY)
		$l = 0; // current string length
		$nl = 0; //number of lines
		$linebreak = false;
		$pc = 0; // previous character
		// for each character
		while ($i < $nb) {
			if (($maxh > 0) AND ($this->y >= $maxy) ) {
				break;
			}
			//Get the current character
			$c = $chars[$i];
			if ($c == 10) { // 10 = "\n" = new line
				//Explicit line break
				if ($align == 'J') {
					if ($this->rtl) {
						$talign = 'R';
					} else {
						$talign = 'L';
					}
				} else {
					$talign = $align;
				}
				$tmpstr = $this->UniArrSubString($uchars, $j, $i);
				if ($firstline) {
					$startx = $this->x;
					$tmparr = array_slice($chars, $j, ($i - $j));
					if ($rtlmode) {
						$tmparr = $this->utf8Bidi($tmparr, $tmpstr, $this->tmprtl);
					}
					$linew = $this->GetArrStringWidth($tmparr);
					unset($tmparr);
					if ($this->rtl) {
						$this->endlinex = $startx - $linew;
					} else {
						$this->endlinex = $startx + $linew;
					}
					$w = $linew;
					$tmpcellpadding = $this->cell_padding;
					if ($maxh == 0) {
						$this->SetCellPadding(0);
					}
				}
				if ($firstblock AND $this->isRTLTextDir()) {
					$tmpstr = $this->stringRightTrim($tmpstr);
				}
				// Skip newlines at the begining of a page or column
				if (!empty($tmpstr) OR ($this->y < ($this->PageBreakTrigger - $row_height))) {
					$this->Cell($w, $h, $tmpstr, 0, 1, $talign, $fill, $link, $stretch);
				}
				unset($tmpstr);
				if ($firstline) {
					$this->cell_padding = $tmpcellpadding;
					return ($this->UniArrSubString($uchars, $i));
				}
				++$nl;
				$j = $i + 1;
				$l = 0;
				$sep = -1;
				$shy = false;
				// account for margin changes
				if ((($this->y + $this->lasth) > $this->PageBreakTrigger) AND (!$this->InFooter)) {
					$this->AcceptPageBreak();
					if ($this->rtl) {
						$this->x -= $margin['R'];
					} else {
						$this->x += $margin['L'];
					}
					$this->lMargin += $margin['L'];
					$this->rMargin += $margin['R'];
				}
				$w = $this->getRemainingWidth();
				$wmax = $w - $this->cell_padding['L'] - $this->cell_padding['R'];
			} else {
				// 160 is the non-breaking space.
				// 173 is SHY (Soft Hypen).
				// \p{Z} or \p{Separator}: any kind of Unicode whitespace or invisible separator.
				// \p{Lo} or \p{Other_Letter}: a Unicode letter or ideograph that does not have lowercase and uppercase variants.
				// \p{Lo} is needed because Chinese characters are packed next to each other without spaces in between.
				if (($c != 160) AND (($c == 173) OR preg_match($this->re_spaces, $this->unichr($c)))) {
					// update last blank space position
					$sep = $i;
					// check if is a SHY
					if ($c == 173) {
						$shy = true;
						if ($pc == 45) {
							$tmp_shy_replacement_width = 0;
							$tmp_shy_replacement_char = '';
						} else {
							$tmp_shy_replacement_width = $shy_replacement_width;
							$tmp_shy_replacement_char = $shy_replacement_char;
						}
					} else {
						$shy = false;
					}
				}
				// update string length
				if ($this->isUnicodeFont() AND ($arabic)) {
					// with bidirectional algorithm some chars may be changed affecting the line length
					// *** very slow ***
					$l = $this->GetArrStringWidth($this->utf8Bidi(array_slice($chars, $j, ($i - $j)), '', $this->tmprtl));
				} else {
					$l += $this->GetCharWidth($c);
				}
				if (($l > $wmax) OR (($c == 173) AND (($l + $tmp_shy_replacement_width) > $wmax)) ) {
					// we have reached the end of column
					if ($sep == -1) {
						// check if the line was already started
						if (($this->rtl AND ($this->x <= ($this->w - $this->rMargin - $chrwidth)))
							OR ((!$this->rtl) AND ($this->x >= ($this->lMargin + $chrwidth)))) {
							// print a void cell and go to next line
							$this->Cell($w, $h, '', 0, 1);
							$linebreak = true;
							if ($firstline) {
								return ($this->UniArrSubString($uchars, $j));
							}
						} else {
							// truncate the word because do not fit on column
							$tmpstr = $this->UniArrSubString($uchars, $j, $i);
							if ($firstline) {
								$startx = $this->x;
								$tmparr = array_slice($chars, $j, ($i - $j));
								if ($rtlmode) {
									$tmparr = $this->utf8Bidi($tmparr, $tmpstr, $this->tmprtl);
								}
								$linew = $this->GetArrStringWidth($tmparr);
								unset($tmparr);
								if ($this->rtl) {
									$this->endlinex = $startx - $linew;
								} else {
									$this->endlinex = $startx + $linew;
								}
								$w = $linew;
								$tmpcellpadding = $this->cell_padding;
								if ($maxh == 0) {
									$this->SetCellPadding(0);
								}
							}
							if ($firstblock AND $this->isRTLTextDir()) {
								$tmpstr = $this->stringRightTrim($tmpstr);
							}
							$this->Cell($w, $h, $tmpstr, 0, 1, $align, $fill, $link, $stretch);
							unset($tmpstr);
							if ($firstline) {
								$this->cell_padding = $tmpcellpadding;
								return ($this->UniArrSubString($uchars, $i));
							}
							$j = $i;
							--$i;
						}
					} else {
						// word wrapping
						if ($this->rtl AND (!$firstblock) AND ($sep < $i)) {
							$endspace = 1;
						} else {
							$endspace = 0;
						}
						if ($shy) {
							// add hypen (minus symbol) at the end of the line
							$shy_width = $tmp_shy_replacement_width;
							if ($this->rtl) {
								$shy_char_left = $tmp_shy_replacement_char;
								$shy_char_right = '';
							} else {
								$shy_char_left = '';
								$shy_char_right = $tmp_shy_replacement_char;
							}
						} else {
							$shy_width = 0;
							$shy_char_left = '';
							$shy_char_right = '';
						}
						$tmpstr = $this->UniArrSubString($uchars, $j, ($sep + $endspace));
						if ($firstline) {
							$startx = $this->x;
							$tmparr = array_slice($chars, $j, (($sep + $endspace) - $j));
							if ($rtlmode) {
								$tmparr = $this->utf8Bidi($tmparr, $tmpstr, $this->tmprtl);
							}
							$linew = $this->GetArrStringWidth($tmparr);
							unset($tmparr);
							if ($this->rtl) {
								$this->endlinex = $startx - $linew - $shy_width;
							} else {
								$this->endlinex = $startx + $linew + $shy_width;
							}
							$w = $linew;
							$tmpcellpadding = $this->cell_padding;
							if ($maxh == 0) {
								$this->SetCellPadding(0);
							}
						}
						// print the line
						if ($firstblock AND $this->isRTLTextDir()) {
							$tmpstr = $this->stringRightTrim($tmpstr);
						}
						$this->Cell($w, $h, $shy_char_left.$tmpstr.$shy_char_right, 0, 1, $align, $fill, $link, $stretch);
						unset($tmpstr);
						if ($firstline) {
							// return the remaining text
							$this->cell_padding = $tmpcellpadding;
							return ($this->UniArrSubString($uchars, ($sep + $endspace)));
						}
						$i = $sep;
						$sep = -1;
						$shy = false;
						$j = ($i+1);
					}
					// account for margin changes
					if ((($this->y + $this->lasth) > $this->PageBreakTrigger) AND (!$this->InFooter)) {
						$this->AcceptPageBreak();
						if ($this->rtl) {
							$this->x -= $margin['R'];
						} else {
							$this->x += $margin['L'];
						}
						$this->lMargin += $margin['L'];
						$this->rMargin += $margin['R'];
					}
					$w = $this->getRemainingWidth();
					$wmax = $w - $this->cell_padding['L'] - $this->cell_padding['R'];
					if ($linebreak) {
						$linebreak = false;
					} else {
						++$nl;
						$l = 0;
					}
				}
			}
			// save last character
			$pc = $c;
			++$i;
		} // end while i < nb
		// print last substring (if any)
		if ($l > 0) {
			switch ($align) {
				case 'J':
				case 'C': {
					$w = $w;
					break;
				}
				case 'L': {
					if ($this->rtl) {
						$w = $w;
					} else {
						$w = $l;
					}
					break;
				}
				case 'R': {
					if ($this->rtl) {
						$w = $l;
					} else {
						$w = $w;
					}
					break;
				}
				default: {
					$w = $l;
					break;
				}
			}
			$tmpstr = $this->UniArrSubString($uchars, $j, $nb);
			if ($firstline) {
				$startx = $this->x;
				$tmparr = array_slice($chars, $j, ($nb - $j));
				if ($rtlmode) {
					$tmparr = $this->utf8Bidi($tmparr, $tmpstr, $this->tmprtl);
				}
				$linew = $this->GetArrStringWidth($tmparr);
				unset($tmparr);
				if ($this->rtl) {
					$this->endlinex = $startx - $linew;
				} else {
					$this->endlinex = $startx + $linew;
				}
				$w = $linew;
				$tmpcellpadding = $this->cell_padding;
				if ($maxh == 0) {
					$this->SetCellPadding(0);
				}
			}
			if ($firstblock AND $this->isRTLTextDir()) {
				$tmpstr = $this->stringRightTrim($tmpstr);
			}
			$this->Cell($w, $h, $tmpstr, 0, $ln, $align, $fill, $link, $stretch);
			unset($tmpstr);
			if ($firstline) {
				$this->cell_padding = $tmpcellpadding;
				return ($this->UniArrSubString($uchars, $nb));
			}
			++$nl;
		}
		if ($firstline) {
			return '';
		}
		return $nl;
	}

	/**
	 * Returns the remaining width between the current position and margins.
	 * @return int Return the remaining width
	 * @access protected
	 */
	protected function getRemainingWidth() {
		$this->checkPageRegions();
		if ($this->rtl) {
			return ($this->x - $this->lMargin);
		} else {
			return ($this->w - $this->rMargin - $this->x);
		}
	}

 	/**
	 * Extract a slice of the $strarr array and return it as string.
	 * @param string $strarr The input array of characters.
	 * @param int $start the starting element of $strarr.
	 * @param int $end first element that will not be returned.
	 * @return Return part of a string
	 * @access public
	 */
	public function UTF8ArrSubString($strarr, $start='', $end='') {
		if (strlen($start) == 0) {
			$start = 0;
		}
		if (strlen($end) == 0) {
			$end = count($strarr);
		}
		$string = '';
		for ($i=$start; $i < $end; ++$i) {
			$string .= $this->unichr($strarr[$i]);
		}
		return $string;
	}

 	/**
	 * Extract a slice of the $uniarr array and return it as string.
	 * @param string $uniarr The input array of characters.
	 * @param int $start the starting element of $strarr.
	 * @param int $end first element that will not be returned.
	 * @return Return part of a string
	 * @access public
	 * @since 4.5.037 (2009-04-07)
	 */
	public function UniArrSubString($uniarr, $start='', $end='') {
		if (strlen($start) == 0) {
			$start = 0;
		}
		if (strlen($end) == 0) {
			$end = count($uniarr);
		}
		$string = '';
		for ($i=$start; $i < $end; ++$i) {
			$string .= $uniarr[$i];
		}
		return $string;
	}

 	/**
	 * Convert an array of UTF8 values to array of unicode characters
	 * @param string $ta The input array of UTF8 values.
	 * @return Return array of unicode characters
	 * @access public
	 * @since 4.5.037 (2009-04-07)
	 */
	public function UTF8ArrayToUniArray($ta) {
		return array_map(array($this, 'unichr'), $ta);
	}

	/**
	 * Returns the unicode caracter specified by UTF-8 value
	 * @param int $c UTF-8 value
	 * @return Returns the specified character.
	 * @author Miguel Perez, Nicola Asuni
	 * @access public
	 * @since 2.3.000 (2008-03-05)
	 */
	public function unichr($c) {
		if (!$this->isunicode) {
			return chr($c);
		} elseif ($c <= 0x7F) {
			// one byte
			return chr($c);
		} elseif ($c <= 0x7FF) {
			// two bytes
			return chr(0xC0 | $c >> 6).chr(0x80 | $c & 0x3F);
		} elseif ($c <= 0xFFFF) {
			// three bytes
			return chr(0xE0 | $c >> 12).chr(0x80 | $c >> 6 & 0x3F).chr(0x80 | $c & 0x3F);
		} elseif ($c <= 0x10FFFF) {
			// four bytes
			return chr(0xF0 | $c >> 18).chr(0x80 | $c >> 12 & 0x3F).chr(0x80 | $c >> 6 & 0x3F).chr(0x80 | $c & 0x3F);
		} else {
			return '';
		}
	}

	/**
	 * Return the image type given the file name or array returned by getimagesize() function.
	 * @param string $imgfile image file name
	 * @param array $iminfo array of image information returned by getimagesize() function.
	 * @return string image type
	 * @since 4.8.017 (2009-11-27)
	 */
	public function getImageFileType($imgfile, $iminfo=array()) {
		$type = '';
		if (isset($iminfo['mime']) AND !empty($iminfo['mime'])) {
			$mime = explode('/', $iminfo['mime']);
			if ((count($mime) > 1) AND ($mime[0] == 'image') AND (!empty($mime[1]))) {
				$type = strtolower(trim($mime[1]));
			}
		}
		if (empty($type)) {
			$fileinfo = pathinfo($imgfile);
			if (isset($fileinfo['extension']) AND (!$this->empty_string($fileinfo['extension']))) {
				$type = strtolower(trim($fileinfo['extension']));
			}
		}
		if ($type == 'jpg') {
			$type = 'jpeg';
		}
		return $type;
	}

	/**
	 * Set the block dimensions accounting for page breaks and page/column fitting
	 * @param float $w width
	 * @param float $h height
	 * @param float $x X coordinate
	 * @param float $y Y coodiante
	 * @param boolean $fitonpage if true the block is resized to not exceed page dimensions.
	 * @access protected
	 * @since 5.5.009 (2010-07-05)
	 */
	protected function fitBlock(&$w, &$h, &$x, &$y, $fitonpage=false) {
		// resize the block to be vertically contained on a single page or single column
		if ($fitonpage OR $this->AutoPageBreak) {
			$ratio_wh = ($w / $h);
			if ($h > ($this->PageBreakTrigger - $this->tMargin)) {
				$h = $this->PageBreakTrigger - $this->tMargin;
				$w = ($h * $ratio_wh);
			}
			// resize the block to be horizontally contained on a single page or single column
			if ($fitonpage) {
				$maxw = ($this->w - $this->lMargin - $this->rMargin);
				if ($w > $maxw) {
					$w = $maxw;
					$h = ($w / $ratio_wh);
				}
			}
		}
		// Check whether we need a new page or new column first as this does not fit
		$prev_x = $this->x;
		$prev_y = $this->y;
		if ($this->checkPageBreak($h, $y) OR ($this->y < $prev_y)) {
			$y = $this->y;
			if ($this->rtl) {
				$x += ($prev_x - $this->x);
			} else {
				$x += ($this->x - $prev_x);
			}
		}
		// resize the block to be contained on the remaining available page or column space
		if ($fitonpage) {
			$ratio_wh = ($w / $h);
			if (($y + $h) > $this->PageBreakTrigger) {
				$h = $this->PageBreakTrigger - $y;
				$w = ($h * $ratio_wh);
			}
			if ((!$this->rtl) AND (($x + $w) > ($this->w - $this->rMargin))) {
				$w = $this->w - $this->rMargin - $x;
				$h = ($w / $ratio_wh);
			} elseif (($this->rtl) AND (($x - $w) < ($this->lMargin))) {
				$w = $x - $this->lMargin;
				$h = ($w / $ratio_wh);
			}
		}
	}

	/**
	 * Puts an image in the page.
	 * The upper-left corner must be given.
	 * The dimensions can be specified in different ways:<ul>
	 * <li>explicit width and height (expressed in user unit)</li>
	 * <li>one explicit dimension, the other being calculated automatically in order to keep the original proportions</li>
	 * <li>no explicit dimension, in which case the image is put at 72 dpi</li></ul>
	 * Supported formats are JPEG and PNG images whitout GD library and all images supported by GD: GD, GD2, GD2PART, GIF, JPEG, PNG, BMP, XBM, XPM;
	 * The format can be specified explicitly or inferred from the file extension.<br />
	 * It is possible to put a link on the image.<br />
	 * Remark: if an image is used several times, only one copy will be embedded in the file.<br />
	 * @param string $file Name of the file containing the image.
	 * @param float $x Abscissa of the upper-left corner (LTR) or upper-right corner (RTL).
	 * @param float $y Ordinate of the upper-left corner (LTR) or upper-right corner (RTL).
	 * @param float $w Width of the image in the page. If not specified or equal to zero, it is automatically calculated.
	 * @param float $h Height of the image in the page. If not specified or equal to zero, it is automatically calculated.
	 * @param string $type Image format. Possible values are (case insensitive): JPEG and PNG (whitout GD library) and all images supported by GD: GD, GD2, GD2PART, GIF, JPEG, PNG, BMP, XBM, XPM;. If not specified, the type is inferred from the file extension.
	 * @param mixed $link URL or identifier returned by AddLink().
	 * @param string $align Indicates the alignment of the pointer next to image insertion relative to image height. The value can be:<ul><li>T: top-right for LTR or top-left for RTL</li><li>M: middle-right for LTR or middle-left for RTL</li><li>B: bottom-right for LTR or bottom-left for RTL</li><li>N: next line</li></ul>
	 * @param mixed $resize If true resize (reduce) the image to fit $w and $h (requires GD or ImageMagick library); if false do not resize; if 2 force resize in all cases (upscaling and downscaling).
	 * @param int $dpi dot-per-inch resolution used on resize
	 * @param string $palign Allows to center or align the image on the current line. Possible values are:<ul><li>L : left align</li><li>C : center</li><li>R : right align</li><li>'' : empty string : left for LTR or right for RTL</li></ul>
	 * @param boolean $ismask true if this image is a mask, false otherwise
	 * @param mixed $imgmask image object returned by this function or false
	 * @param mixed $border Indicates if borders must be drawn around the cell. The value can be a number:<ul><li>0: no border (default)</li><li>1: frame</li></ul> or a string containing some or all of the following characters (in any order):<ul><li>L: left</li><li>T: top</li><li>R: right</li><li>B: bottom</li></ul> or an array of line styles for each border group - for example: array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))
	 * @param boolean $fitbox If true scale image dimensions proportionally to fit within the ($w, $h) box.
	 * @param boolean $hidden if true do not display the image.
	 * @param boolean $fitonpage if true the image is resized to not exceed page dimensions.
	 * @return image information
	 * @access public
	 * @since 1.1
	 */
	public function Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false) {
		if ($x === '') {
			$x = $this->x;
		}
		if ($y === '') {
			$y = $this->y;
		}
		// check page for no-write regions and adapt page margins if necessary
		$this->checkPageRegions($h, $x, $y);
		$cached_file = false; // true when the file is cached
		// get image dimensions
		$imsize = @getimagesize($file);
		if ($imsize === FALSE) {
			// try to encode spaces on filename
			$file = str_replace(' ', '%20', $file);
			$imsize = @getimagesize($file);
			if ($imsize === FALSE) {
				if (function_exists('curl_init')) {
					// try to get remote file data using cURL
					$cs = curl_init(); // curl session
					curl_setopt($cs, CURLOPT_URL, $file);
					curl_setopt($cs, CURLOPT_BINARYTRANSFER, true);
					curl_setopt($cs, CURLOPT_FAILONERROR, true);
					curl_setopt($cs, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($cs, CURLOPT_CONNECTTIMEOUT, 5);
					curl_setopt($cs, CURLOPT_TIMEOUT, 30);
					$imgdata = curl_exec($cs);
					curl_close($cs);
					if($imgdata !== FALSE) {
						// copy image to cache
						$file = tempnam(K_PATH_CACHE, 'img_');
						$fp = fopen($file, 'w');
						fwrite($fp, $imgdata);
						fclose($fp);
						unset($imgdata);
						$cached_file = true;
						$imsize = @getimagesize($file);
						if ($imsize === FALSE) {
							unlink($file);
							$cached_file = false;
						}
					}
				} elseif (($w > 0) AND ($h > 0)) {
					// get measures from specified data
					$pw = $this->getHTMLUnitToUnits($w, 0, $this->pdfunit, true) * $this->imgscale * $this->k;
					$ph = $this->getHTMLUnitToUnits($h, 0, $this->pdfunit, true) * $this->imgscale * $this->k;
					$imsize = array($pw, $ph);
				}
			}
		}
		if ($imsize === FALSE) {
			$this->Error('[Image] Unable to get image: '.$file);
		}
		// get original image width and height in pixels
		list($pixw, $pixh) = $imsize;
		// calculate image width and height on document
		if (($w <= 0) AND ($h <= 0)) {
			// convert image size to document unit
			$w = $this->pixelsToUnits($pixw);
			$h = $this->pixelsToUnits($pixh);
		} elseif ($w <= 0) {
			$w = $h * $pixw / $pixh;
		} elseif ($h <= 0) {
			$h = $w * $pixh / $pixw;
		} elseif ($fitbox AND ($w > 0) AND ($h > 0)) {
			// scale image dimensions proportionally to fit within the ($w, $h) box
			if ((($w * $pixh) / ($h * $pixw)) < 1) {
				$h = $w * $pixh / $pixw;
			} else {
				$w = $h * $pixw / $pixh;
			}
		}
		// fit the image on available space
		$this->fitBlock($w, $h, $x, $y, $fitonpage);
		// calculate new minimum dimensions in pixels
		$neww = round($w * $this->k * $dpi / $this->dpi);
		$newh = round($h * $this->k * $dpi / $this->dpi);
		// check if resize is necessary (resize is used only to reduce the image)
		$newsize = ($neww * $newh);
		$pixsize = ($pixw * $pixh);
		if (intval($resize) == 2) {
			$resize = true;
		} elseif ($newsize >= $pixsize) {
			$resize = false;
		}
		// check if image has been already added on document
		$newimage = true;
		if (in_array($file, $this->imagekeys)) {
			$newimage = false;
			// get existing image data
			$info = $this->getImageBuffer($file);
			// check if the newer image is larger
			$oldsize = ($info['w'] * $info['h']);
			if ((($oldsize < $newsize) AND ($resize)) OR (($oldsize < $pixsize) AND (!$resize))) {
				$newimage = true;
			}
		}
		if ($newimage) {
			//First use of image, get info
			$type = strtolower($type);
			if ($type == '') {
				$type = $this->getImageFileType($file, $imsize);
			} elseif ($type == 'jpg') {
				$type = 'jpeg';
			}
			$mqr = $this->get_mqr();
			$this->set_mqr(false);
			// Specific image handlers
			$mtd = '_parse'.$type;
			// GD image handler function
			$gdfunction = 'imagecreatefrom'.$type;
			$info = false;
			if ((method_exists($this, $mtd)) AND (!($resize AND function_exists($gdfunction)))) {
				// TCPDF image functions
				$info = $this->$mtd($file);
				if ($info == 'pngalpha') {
					return $this->ImagePngAlpha($file, $x, $y, $pixw, $pixh, $w, $h, 'PNG', $link, $align, $resize, $dpi, $palign);
				}
			}
			if (!$info) {
				if (function_exists($gdfunction)) {
					// GD library
					$img = $gdfunction($file);
					if ($resize) {
						$imgr = imagecreatetruecolor($neww, $newh);
						if (($type == 'gif') OR ($type == 'png')) {
							$imgr = $this->_setGDImageTransparency($imgr, $img);
						}
						imagecopyresampled($imgr, $img, 0, 0, 0, 0, $neww, $newh, $pixw, $pixh);
						if (($type == 'gif') OR ($type == 'png')) {
							$info = $this->_toPNG($imgr);
						} else {
							$info = $this->_toJPEG($imgr);
						}
					} else {
						if (($type == 'gif') OR ($type == 'png')) {
							$info = $this->_toPNG($img);
						} else {
							$info = $this->_toJPEG($img);
						}
					}
				} elseif (extension_loaded('imagick')) {
					// ImageMagick library
					$img = new Imagick();
					if ($type == 'SVG') {
						// get SVG file content
						$svgimg = file_get_contents($file);
						// get width and height
						$regs = array();
						if (preg_match('/<svg([^\>]*)>/si', $svgimg, $regs)) {
							$svgtag = $regs[1];
							$tmp = array();
							if (preg_match('/[\s]+width[\s]*=[\s]*"([^"]*)"/si', $svgtag, $tmp)) {
								$ow = $this->getHTMLUnitToUnits($tmp[1], 1, $this->svgunit, false);
								$owu = sprintf('%.3F', ($ow * $dpi / 72)).$this->pdfunit;
								$svgtag = preg_replace('/[\s]+width[\s]*=[\s]*"[^"]*"/si', ' width="'.$owu.'"', $svgtag, 1);
							} else {
								$ow = $w;
							}
							$tmp = array();
							if (preg_match('/[\s]+height[\s]*=[\s]*"([^"]*)"/si', $svgtag, $tmp)) {
								$oh = $this->getHTMLUnitToUnits($tmp[1], 1, $this->svgunit, false);
								$ohu = sprintf('%.3F', ($oh * $dpi / 72)).$this->pdfunit;
								$svgtag = preg_replace('/[\s]+height[\s]*=[\s]*"[^"]*"/si', ' height="'.$ohu.'"', $svgtag, 1);
							} else {
								$oh = $h;
							}
							$tmp = array();
							if (!preg_match('/[\s]+viewBox[\s]*=[\s]*"[\s]*([0-9\.]+)[\s]+([0-9\.]+)[\s]+([0-9\.]+)[\s]+([0-9\.]+)[\s]*"/si', $svgtag, $tmp)) {
								$vbw = ($ow * $this->imgscale * $this->k);
								$vbh = ($oh * $this->imgscale * $this->k);
								$vbox = sprintf(' viewBox="0 0 %.3F %.3F" ', $vbw, $vbh);
								$svgtag = $vbox.$svgtag;
							}
							$svgimg = preg_replace('/<svg([^\>]*)>/si', '<svg'.$svgtag.'>', $svgimg, 1);
						}
						$img->readImageBlob($svgimg);
					} else {
						$img->readImage($file);
					}
					if ($resize) {
						$img->resizeImage($neww, $newh, 10, 1, false);
					}
					$img->setCompressionQuality($this->jpeg_quality);
					$img->setImageFormat('jpeg');
					$tempname = tempnam(K_PATH_CACHE, 'jpg_');
					$img->writeImage($tempname);
					$info = $this->_parsejpeg($tempname);
					unlink($tempname);
					$img->destroy();
				} else {
					return;
				}
			}
			if ($info === false) {
				//If false, we cannot process image
				return;
			}
			$this->set_mqr($mqr);
			if ($ismask) {
				// force grayscale
				$info['cs'] = 'DeviceGray';
			}
			$info['i'] = $this->numimages;
			if (!in_array($file, $this->imagekeys)) {
				++$info['i'];
			}
			if ($imgmask !== false) {
				$info['masked'] = $imgmask;
			}
			// add image to document
			$this->setImageBuffer($file, $info);
		}
		if ($cached_file) {
			// remove cached file
			unlink($file);
		}
		// set alignment
		$this->img_rb_y = $y + $h;
		// set alignment
		if ($this->rtl) {
			if ($palign == 'L') {
				$ximg = $this->lMargin;
			} elseif ($palign == 'C') {
				$ximg = ($this->w + $this->lMargin - $this->rMargin - $w) / 2;
			} elseif ($palign == 'R') {
				$ximg = $this->w - $this->rMargin - $w;
			} else {
				$ximg = $x - $w;
			}
			$this->img_rb_x = $ximg;
		} else {
			if ($palign == 'L') {
				$ximg = $this->lMargin;
			} elseif ($palign == 'C') {
				$ximg = ($this->w + $this->lMargin - $this->rMargin - $w) / 2;
			} elseif ($palign == 'R') {
				$ximg = $this->w - $this->rMargin - $w;
			} else {
				$ximg = $x;
			}
			$this->img_rb_x = $ximg + $w;
		}
		if ($ismask OR $hidden) {
			// image is not displayed
			return $info['i'];
		}
		$xkimg = $ximg * $this->k;
		$this->_out(sprintf('q %.2F 0 0 %.2F %.2F %.2F cm /I%u Do Q', ($w * $this->k), ($h * $this->k), $xkimg, (($this->h - ($y + $h)) * $this->k), $info['i']));
		if (!empty($border)) {
			$bx = $this->x;
			$by = $this->y;
			$this->x = $ximg;
			if ($this->rtl) {
				$this->x += $w;
			}
			$this->y = $y;
			$this->Cell($w, $h, '', $border, 0, '', 0, '', 0, true);
			$this->x = $bx;
			$this->y = $by;
		}
		if ($link) {
			$this->Link($ximg, $y, $w, $h, $link, 0);
		}
		// set pointer to align the next text/objects
		switch($align) {
			case 'T': {
				$this->y = $y;
				$this->x = $this->img_rb_x;
				break;
			}
			case 'M': {
				$this->y = $y + round($h/2);
				$this->x = $this->img_rb_x;
				break;
			}
			case 'B': {
				$this->y = $this->img_rb_y;
				$this->x = $this->img_rb_x;
				break;
			}
			case 'N': {
				$this->SetY($this->img_rb_y);
				break;
			}
			default:{
				break;
			}
		}
		$this->endlinex = $this->img_rb_x;
		if ($this->inxobj) {
			// we are inside an XObject template
			$this->xobjects[$this->xobjid]['images'][] = $info['i'];
		}
		return $info['i'];
	}

	/**
	 * Sets the current active configuration setting of magic_quotes_runtime (if the set_magic_quotes_runtime function exist)
	 * @param boolean $mqr FALSE for off, TRUE for on.
	 * @since 4.6.025 (2009-08-17)
	 */
	public function set_mqr($mqr) {
		if(!defined('PHP_VERSION_ID')) {
			$version = PHP_VERSION;
			define('PHP_VERSION_ID', (($version{0} * 10000) + ($version{2} * 100) + $version{4}));
		}
		if (PHP_VERSION_ID < 50300) {
			@set_magic_quotes_runtime($mqr);
		}
	}

	/**
	 * Gets the current active configuration setting of magic_quotes_runtime (if the get_magic_quotes_runtime function exist)
	 * @return Returns 0 if magic quotes runtime is off or get_magic_quotes_runtime doesn't exist, 1 otherwise.
	 * @since 4.6.025 (2009-08-17)
	 */
	public function get_mqr() {
		if(!defined('PHP_VERSION_ID')) {
			$version = PHP_VERSION;
			define('PHP_VERSION_ID', (($version{0} * 10000) + ($version{2} * 100) + $version{4}));
		}
		if (PHP_VERSION_ID < 50300) {
			return @get_magic_quotes_runtime();
		}
		return 0;
	}

	/**
	 * Convert the loaded image to a JPEG and then return a structure for the PDF creator.
	 * This function requires GD library and write access to the directory defined on K_PATH_CACHE constant.
	 * @param string $file Image file name.
	 * @param image $image Image object.
	 * return image JPEG image object.
	 * @access protected
	 */
	protected function _toJPEG($image) {
		$tempname = tempnam(K_PATH_CACHE, 'jpg_');
		imagejpeg($image, $tempname, $this->jpeg_quality);
		imagedestroy($image);
		$retvars = $this->_parsejpeg($tempname);
		// tidy up by removing temporary image
		unlink($tempname);
		return $retvars;
	}

	/**
	 * Convert the loaded image to a PNG and then return a structure for the PDF creator.
	 * This function requires GD library and write access to the directory defined on K_PATH_CACHE constant.
	 * @param string $file Image file name.
	 * @param image $image Image object.
	 * return image PNG image object.
	 * @access protected
	 * @since 4.9.016 (2010-04-20)
	 */
	protected function _toPNG($image) {
		$tempname = tempnam(K_PATH_CACHE, 'jpg_');
		imagepng($image, $tempname);
		imagedestroy($image);
		$retvars = $this->_parsepng($tempname);
		// tidy up by removing temporary image
		unlink($tempname);
		return $retvars;
	}

	/**
	 * Set the transparency for the given GD image.
	 * @param image $new_image GD image object
	 * @param image $image GD image object.
	 * return GD image object.
	 * @access protected
	 * @since 4.9.016 (2010-04-20)
	 */
	protected function _setGDImageTransparency($new_image, $image) {
		// transparency index
		$tid = imagecolortransparent($image);
		// default transparency color
		$tcol = array('red' => 255, 'green' => 255, 'blue' => 255);
		if ($tid >= 0) {
			// get the colors for the transparency index
			$tcol = imagecolorsforindex($image, $tid);
		}
		$tid = imagecolorallocate($new_image, $tcol['red'], $tcol['green'], $tcol['blue']);
		imagefill($new_image, 0, 0, $tid);
		imagecolortransparent($new_image, $tid);
		return $new_image;
	}

	/**
	 * Extract info from a JPEG file without using the GD library.
	 * @param string $file image file to parse
	 * @return array structure containing the image data
	 * @access protected
	 */
	protected function _parsejpeg($file) {
		$a = getimagesize($file);
		if (empty($a)) {
			$this->Error('Missing or incorrect image file: '.$file);
		}
		if ($a[2] != 2) {
			$this->Error('Not a JPEG file: '.$file);
		}
		if ((!isset($a['channels'])) OR ($a['channels'] == 3)) {
			$colspace = 'DeviceRGB';
		} elseif ($a['channels'] == 4) {
			$colspace = 'DeviceCMYK';
		} else {
			$colspace = 'DeviceGray';
		}
		$bpc = isset($a['bits']) ? $a['bits'] : 8;
		$data = file_get_contents($file);
		return array('w' => $a[0], 'h' => $a[1], 'cs' => $colspace, 'bpc' => $bpc, 'f' => 'DCTDecode', 'data' => $data);
	}

	/**
	 * Extract info from a PNG file without using the GD library.
	 * @param string $file image file to parse
	 * @return array structure containing the image data
	 * @access protected
	 */
	protected function _parsepng($file) {
		$f = fopen($file, 'rb');
		if ($f === false) {
			$this->Error('Can\'t open image file: '.$file);
		}
		//Check signature
		if (fread($f, 8) != chr(137).'PNG'.chr(13).chr(10).chr(26).chr(10)) {
			$this->Error('Not a PNG file: '.$file);
		}
		//Read header chunk
		fread($f, 4);
		if (fread($f, 4) != 'IHDR') {
			$this->Error('Incorrect PNG file: '.$file);
		}
		$w = $this->_freadint($f);
		$h = $this->_freadint($f);
		$bpc = ord(fread($f, 1));
		if ($bpc > 8) {
			//$this->Error('16-bit depth not supported: '.$file);
			fclose($f);
			return false;
		}
		$ct = ord(fread($f, 1));
		if ($ct == 0) {
			$colspace = 'DeviceGray';
		} elseif ($ct == 2) {
			$colspace = 'DeviceRGB';
		} elseif ($ct == 3) {
			$colspace = 'Indexed';
		} else {
			// alpha channel
			fclose($f);
			return 'pngalpha';
		}
		if (ord(fread($f, 1)) != 0) {
			//$this->Error('Unknown compression method: '.$file);
			fclose($f);
			return false;
		}
		if (ord(fread($f, 1)) != 0) {
			//$this->Error('Unknown filter method: '.$file);
			fclose($f);
			return false;
		}
		if (ord(fread($f, 1)) != 0) {
			//$this->Error('Interlacing not supported: '.$file);
			fclose($f);
			return false;
		}
		fread($f, 4);
		$parms = '/DecodeParms << /Predictor 15 /Colors '.($ct == 2 ? 3 : 1).' /BitsPerComponent '.$bpc.' /Columns '.$w.' >>';
		//Scan chunks looking for palette, transparency and image data
		$pal = '';
		$trns = '';
		$data = '';
		do {
			$n = $this->_freadint($f);
			$type = fread($f, 4);
			if ($type == 'PLTE') {
				//Read palette
				$pal = $this->rfread($f, $n);
				fread($f, 4);
			} elseif ($type == 'tRNS') {
				//Read transparency info
				$t = $this->rfread($f, $n);
				if ($ct == 0) {
					$trns = array(ord(substr($t, 1, 1)));
				} elseif ($ct == 2) {
					$trns = array(ord(substr($t, 1, 1)), ord(substr($t, 3, 1)), ord(substr($t, 5, 1)));
				} else {
					$pos = strpos($t, chr(0));
					if ($pos !== false) {
						$trns = array($pos);
					}
				}
				fread($f, 4);
			} elseif ($type == 'IDAT') {
				//Read image data block
				$data .= $this->rfread($f, $n);
				fread($f, 4);
			} elseif ($type == 'IEND') {
				break;
			} else {
				$this->rfread($f, $n + 4);
			}
		} while ($n);
		if (($colspace == 'Indexed') AND (empty($pal))) {
			//$this->Error('Missing palette in '.$file);
			fclose($f);
			return false;
		}
		fclose($f);
		return array('w' => $w, 'h' => $h, 'cs' => $colspace, 'bpc' => $bpc, 'f' => 'FlateDecode', 'parms' => $parms, 'pal' => $pal, 'trns' => $trns, 'data' => $data);
	}

	/**
	 * Binary-safe and URL-safe file read.
	 * Reads up to length bytes from the file pointer referenced by handle. Reading stops as soon as one of the following conditions is met: length bytes have been read; EOF (end of file) is reached.
	 * @param resource $handle
	 * @param int $length
	 * @return Returns the read string or FALSE in case of error.
	 * @author Nicola Asuni
	 * @access protected
	 * @since 4.5.027 (2009-03-16)
	 */
	protected function rfread($handle, $length) {
		$data = fread($handle, $length);
		if ($data === false) {
			return false;
		}
		$rest = $length - strlen($data);
		if ($rest > 0) {
			$data .= $this->rfread($handle, $rest);
		}
		return $data;
	}

	/**
	 * Extract info from a PNG image with alpha channel using the GD library.
	 * @param string $file Name of the file containing the image.
	 * @param float $x Abscissa of the upper-left corner.
	 * @param float $y Ordinate of the upper-left corner.
	 * @param float $wpx Original width of the image in pixels.
	 * @param float $hpx original height of the image in pixels.
	 * @param float $w Width of the image in the page. If not specified or equal to zero, it is automatically calculated.
	 * @param float $h Height of the image in the page. If not specified or equal to zero, it is automatically calculated.
	 * @param string $type Image format. Possible values are (case insensitive): JPEG and PNG (whitout GD library) and all images supported by GD: GD, GD2, GD2PART, GIF, JPEG, PNG, BMP, XBM, XPM;. If not specified, the type is inferred from the file extension.
	 * @param mixed $link URL or identifier returned by AddLink().
	 * @param string $align Indicates the alignment of the pointer next to image insertion relative to image height. The value can be:<ul><li>T: top-right for LTR or top-left for RTL</li><li>M: middle-right for LTR or middle-left for RTL</li><li>B: bottom-right for LTR or bottom-left for RTL</li><li>N: next line</li></ul>
	 * @param boolean $resize If true resize (reduce) the image to fit $w and $h (requires GD library).
	 * @param int $dpi dot-per-inch resolution used on resize
	 * @param string $palign Allows to center or align the image on the current line. Possible values are:<ul><li>L : left align</li><li>C : center</li><li>R : right align</li><li>'' : empty string : left for LTR or right for RTL</li></ul>
	 * @author Nicola Asuni
	 * @access protected
	 * @since 4.3.007 (2008-12-04)
	 * @see Image()
	 */
	protected function ImagePngAlpha($file, $x, $y, $wpx, $hpx, $w, $h, $type, $link, $align, $resize, $dpi, $palign) {
		// create temp image file (without alpha channel)
		$tempfile_plain = tempnam(K_PATH_CACHE, 'mskp_');
		// create temp alpha file
		$tempfile_alpha = tempnam(K_PATH_CACHE, 'mska_');
		if (extension_loaded('imagick')) { // ImageMagick
			// ImageMagick library
			$img = new Imagick();
			$img->readImage($file);
			// clone image object
			$imga = $img->clone();
			// extract alpha channel
			$img->separateImageChannel(imagick::CHANNEL_ALPHA | imagick::CHANNEL_OPACITY | imagick::CHANNEL_MATTE);
			$img->negateImage(true);
			$img->setImageFormat('png');
			$img->writeImage($tempfile_alpha);
			// remove alpha channel
			$imga->separateImageChannel(imagick::CHANNEL_ALL & ~(imagick::CHANNEL_ALPHA | imagick::CHANNEL_OPACITY | imagick::CHANNEL_MATTE));
			$imga->setImageFormat('png');
			$imga->writeImage($tempfile_plain);
		} else { // GD library
			// generate images
			$img = imagecreatefrompng($file);
			$imgalpha = imagecreate($wpx, $hpx);
			// generate gray scale palette (0 -> 255)
			for ($c = 0; $c < 256; ++$c) {
				ImageColorAllocate($imgalpha, $c, $c, $c);
			}
			// extract alpha channel
			for ($xpx = 0; $xpx < $wpx; ++$xpx) {
				for ($ypx = 0; $ypx < $hpx; ++$ypx) {
					$color = imagecolorat($img, $xpx, $ypx);
					$alpha = ($color >> 24); // shifts off the first 24 bits (where 8x3 are used for each color), and returns the remaining 7 allocated bits (commonly used for alpha)
					$alpha = (((127 - $alpha) / 127) * 255); // GD alpha is only 7 bit (0 -> 127)
					$alpha = $this->getGDgamma($alpha); // correct gamma
					imagesetpixel($imgalpha, $xpx, $ypx, $alpha);
				}
			}
			imagepng($imgalpha, $tempfile_alpha);
			imagedestroy($imgalpha);
			// extract image without alpha channel
			$imgplain = imagecreatetruecolor($wpx, $hpx);
			imagecopy($imgplain, $img, 0, 0, 0, 0, $wpx, $hpx);
			imagepng($imgplain, $tempfile_plain);
			imagedestroy($imgplain);
		}
		// embed mask image
		$imgmask = $this->Image($tempfile_alpha, $x, $y, $w, $h, 'PNG', '', '', $resize, $dpi, '', true, false);
		// embed image, masked with previously embedded mask
		$this->Image($tempfile_plain, $x, $y, $w, $h, $type, $link, $align, $resize, $dpi, $palign, false, $imgmask);
		// remove temp files
		unlink($tempfile_alpha);
		unlink($tempfile_plain);
	}

	/**
	 * Correct the gamma value to be used with GD library
	 * @param float $v the gamma value to be corrected
	 * @access protected
	 * @since 4.3.007 (2008-12-04)
	 */
	protected function getGDgamma($v) {
		return (pow(($v / 255), 2.2) * 255);
	}

	/**
	 * Performs a line break.
	 * The current abscissa goes back to the left margin and the ordinate increases by the amount passed in parameter.
	 * @param float $h The height of the break. By default, the value equals the height of the last printed cell.
	 * @param boolean $cell if true add the current left (or right o for RTL) padding to the X coordinate
	 * @access public
	 * @since 1.0
	 * @see Cell()
	 */
	public function Ln($h='', $cell=false) {
		if (($this->num_columns > 1) AND ($this->y == $this->columns[$this->current_column]['y']) AND isset($this->columns[$this->current_column]['x']) AND ($this->x == $this->columns[$this->current_column]['x'])) {
			// revove vertical space from the top of the column
			return;
		}
		if ($cell) {
			if ($this->rtl) {
				$cellpadding = $this->cell_padding['R'];
			} else {
				$cellpadding = $this->cell_padding['L'];
			}
		} else {
			$cellpadding = 0;
		}
		if ($this->rtl) {
			$this->x = $this->w - $this->rMargin - $cellpadding;
		} else {
			$this->x = $this->lMargin + $cellpadding;
		}
		if (is_string($h)) {
			$this->y += $this->lasth;
		} else {
			$this->y += $h;
		}
		$this->newline = true;
	}

	/**
	 * Returns the relative X value of current position.
	 * The value is relative to the left border for LTR languages and to the right border for RTL languages.
	 * @return float
	 * @access public
	 * @since 1.2
	 * @see SetX(), GetY(), SetY()
	 */
	public function GetX() {
		//Get x position
		if ($this->rtl) {
			return ($this->w - $this->x);
		} else {
			return $this->x;
		}
	}

	/**
	 * Returns the absolute X value of current position.
	 * @return float
	 * @access public
	 * @since 1.2
	 * @see SetX(), GetY(), SetY()
	 */
	public function GetAbsX() {
		return $this->x;
	}

	/**
	 * Returns the ordinate of the current position.
	 * @return float
	 * @access public
	 * @since 1.0
	 * @see SetY(), GetX(), SetX()
	 */
	public function GetY() {
		return $this->y;
	}

	/**
	 * Defines the abscissa of the current position.
	 * If the passed value is negative, it is relative to the right of the page (or left if language is RTL).
	 * @param float $x The value of the abscissa.
	 * @param boolean $rtloff if true always uses the page top-left corner as origin of axis.
	 * @access public
	 * @since 1.2
	 * @see GetX(), GetY(), SetY(), SetXY()
	 */
	public function SetX($x, $rtloff=false) {
		if (!$rtloff AND $this->rtl) {
			if ($x >= 0) {
				$this->x = $this->w - $x;
			} else {
				$this->x = abs($x);
			}
		} else {
			if ($x >= 0) {
				$this->x = $x;
			} else {
				$this->x = $this->w + $x;
			}
		}
		if ($this->x < 0) {
			$this->x = 0;
		}
		if ($this->x > $this->w) {
			$this->x = $this->w;
		}
	}

	/**
	 * Moves the current abscissa back to the left margin and sets the ordinate.
	 * If the passed value is negative, it is relative to the bottom of the page.
	 * @param float $y The value of the ordinate.
	 * @param bool $resetx if true (default) reset the X position.
	 * @param boolean $rtloff if true always uses the page top-left corner as origin of axis.
	 * @access public
	 * @since 1.0
	 * @see GetX(), GetY(), SetY(), SetXY()
	 */
	public function SetY($y, $resetx=true, $rtloff=false) {
		if ($resetx) {
			//reset x
			if (!$rtloff AND $this->rtl) {
				$this->x = $this->w - $this->rMargin;
			} else {
				$this->x = $this->lMargin;
			}
		}
		if ($y >= 0) {
			$this->y = $y;
		} else {
			$this->y = $this->h + $y;
		}
		if ($this->y < 0) {
			$this->y = 0;
		}
		if ($this->y > $this->h) {
			$this->y = $this->h;
		}
	}

	/**
	 * Defines the abscissa and ordinate of the current position.
	 * If the passed values are negative, they are relative respectively to the right and bottom of the page.
	 * @param float $x The value of the abscissa.
	 * @param float $y The value of the ordinate.
	 * @param boolean $rtloff if true always uses the page top-left corner as origin of axis.
	 * @access public
	 * @since 1.2
	 * @see SetX(), SetY()
	 */
	public function SetXY($x, $y, $rtloff=false) {
		$this->SetY($y, false, $rtloff);
		$this->SetX($x, $rtloff);
	}

	/**
	 * Send the document to a given destination: string, local file or browser.
	 * In the last case, the plug-in may be used (if present) or a download ("Save as" dialog box) may be forced.<br />
	 * The method first calls Close() if necessary to terminate the document.
	 * @param string $name The name of the file when saved. Note that special characters are removed and blanks characters are replaced with the underscore character.
	 * @param string $dest Destination where to send the document. It can take one of the following values:<ul><li>I: send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.</li><li>D: send to the browser and force a file download with the name given by name.</li><li>F: save to a local server file with the name given by name.</li><li>S: return the document as a string. name is ignored.</li><li>FI: equivalent to F + I option</li><li>FD: equivalent to F + D option</li></ul>
	 * @access public
	 * @since 1.0
	 * @see Close()
	 */
	public function Output($name='doc.pdf', $dest='I') {
		//Output PDF to some destination
		//Finish document if necessary
		if ($this->state < 3) {
			$this->Close();
		}
		//Normalize parameters
		if (is_bool($dest)) {
			$dest = $dest ? 'D' : 'F';
		}
		$dest = strtoupper($dest);
		if ($dest{0} != 'F') {
			$name = preg_replace('/[\s]+/', '_', $name);
			$name = preg_replace('/[^a-zA-Z0-9_\.-]/', '', $name);
		}
		if ($this->sign) {
			// *** apply digital signature to the document ***
			// get the document content
			$pdfdoc = $this->getBuffer();
			// remove last newline
			$pdfdoc = substr($pdfdoc, 0, -1);
			// Remove the original buffer
			if (isset($this->diskcache) AND $this->diskcache) {
				// remove buffer file from cache
				unlink($this->buffer);
			}
			unset($this->buffer);
			// remove filler space
			$byterange_string_len = strlen($this->byterange_string);
			// define the ByteRange
			$byte_range = array();
			$byte_range[0] = 0;
			$byte_range[1] = strpos($pdfdoc, $this->byterange_string) + $byterange_string_len + 10;
			$byte_range[2] = $byte_range[1] + $this->signature_max_length + 2;
			$byte_range[3] = strlen($pdfdoc) - $byte_range[2];
			$pdfdoc = substr($pdfdoc, 0, $byte_range[1]).substr($pdfdoc, $byte_range[2]);
			// replace the ByteRange
			$byterange = sprintf('/ByteRange[0 %u %u %u]', $byte_range[1], $byte_range[2], $byte_range[3]);
			$byterange .= str_repeat(' ', ($byterange_string_len - strlen($byterange)));
			$pdfdoc = str_replace($this->byterange_string, $byterange, $pdfdoc);
			// write the document to a temporary folder
			$tempdoc = tempnam(K_PATH_CACHE, 'tmppdf_');
			$f = fopen($tempdoc, 'wb');
			if (!$f) {
				$this->Error('Unable to create temporary file: '.$tempdoc);
			}
			$pdfdoc_length = strlen($pdfdoc);
			fwrite($f, $pdfdoc, $pdfdoc_length);
			fclose($f);
			// get digital signature via openssl library
			$tempsign = tempnam(K_PATH_CACHE, 'tmpsig_');
			if (empty($this->signature_data['extracerts'])) {
				openssl_pkcs7_sign($tempdoc, $tempsign, $this->signature_data['signcert'], array($this->signature_data['privkey'], $this->signature_data['password']), array(), PKCS7_BINARY | PKCS7_DETACHED);
			} else {
				openssl_pkcs7_sign($tempdoc, $tempsign, $this->signature_data['signcert'], array($this->signature_data['privkey'], $this->signature_data['password']), array(), PKCS7_BINARY | PKCS7_DETACHED, $this->signature_data['extracerts']);
			}
			unlink($tempdoc);
			// read signature
			$signature = file_get_contents($tempsign);
			unlink($tempsign);
			// extract signature
			$signature = substr($signature, $pdfdoc_length);
			$signature = substr($signature, (strpos($signature, "%%EOF\n\n------") + 13));
			$tmparr = explode("\n\n", $signature);
			$signature = $tmparr[1];
			unset($tmparr);
			// decode signature
			$signature = base64_decode(trim($signature));
			// convert signature to hex
			$signature = current(unpack('H*', $signature));
			$signature = str_pad($signature, $this->signature_max_length, '0');
			// Add signature to the document
			$pdfdoc = substr($pdfdoc, 0, $byte_range[1]).'<'.$signature.'>'.substr($pdfdoc, $byte_range[1]);
			$this->diskcache = false;
			$this->buffer = &$pdfdoc;
			$this->bufferlen = strlen($pdfdoc);
		}
		switch($dest) {
			case 'I': {
				// Send PDF to the standard output
				if (ob_get_contents()) {
					$this->Error('Some data has already been output, can\'t send PDF file');
				}
				if (php_sapi_name() != 'cli') {
					//We send to a browser
					header('Content-Type: application/pdf');
					if (headers_sent()) {
						$this->Error('Some data has already been output to browser, can\'t send PDF file');
					}
					header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
					header('Pragma: public');
					header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
					header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
					header('Content-Length: '.$this->bufferlen);
					header('Content-Disposition: inline; filename="'.basename($name).'";');
				}
				echo $this->getBuffer();
				break;
			}
			case 'D': {
				// Download PDF as file
				if (ob_get_contents()) {
					$this->Error('Some data has already been output, can\'t send PDF file');
				}
				header('Content-Description: File Transfer');
				if (headers_sent()) {
					$this->Error('Some data has already been output to browser, can\'t send PDF file');
				}
				header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
				header('Pragma: public');
				header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
				// force download dialog
				header('Content-Type: application/force-download');
				header('Content-Type: application/octet-stream', false);
				header('Content-Type: application/download', false);
				header('Content-Type: application/pdf', false);
				// use the Content-Disposition header to supply a recommended filename
				header('Content-Disposition: attachment; filename="'.basename($name).'";');
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '.$this->bufferlen);
				echo $this->getBuffer();
				break;
			}
			case 'F':
			case 'FI':
			case 'FD': {
				// Save PDF to a local file
				if ($this->diskcache) {
					copy($this->buffer, $name);
				} else {
					$f = fopen($name, 'wb');
					if (!$f) {
						$this->Error('Unable to create output file: '.$name);
					}
					fwrite($f, $this->getBuffer(), $this->bufferlen);
					fclose($f);
				}
				if ($dest == 'FI') {
					// send headers to browser
					header('Content-Type: application/pdf');
					header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
					header('Pragma: public');
					header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
					header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
					header('Content-Length: '.filesize($name));
					header('Content-Disposition: inline; filename="'.basename($name).'";');
					// send document to the browser
					echo file_get_contents($name);
				} elseif ($dest == 'FD') {
					// send headers to browser
					if (ob_get_contents()) {
						$this->Error('Some data has already been output, can\'t send PDF file');
					}
					header('Content-Description: File Transfer');
					if (headers_sent()) {
						$this->Error('Some data has already been output to browser, can\'t send PDF file');
					}
					header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
					header('Pragma: public');
					header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
					header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
					// force download dialog
					header('Content-Type: application/force-download');
					header('Content-Type: application/octet-stream', false);
					header('Content-Type: application/download', false);
					header('Content-Type: application/pdf', false);
					// use the Content-Disposition header to supply a recommended filename
					header('Content-Disposition: attachment; filename="'.basename($name).'";');
					header('Content-Transfer-Encoding: binary');
					header('Content-Length: '.filesize($name));
					// send document to the browser
					echo file_get_contents($name);
				}
				break;
			}
			case 'S': {
				// Returns PDF as a string
				return $this->getBuffer();
			}
			default: {
				$this->Error('Incorrect output destination: '.$dest);
			}
		}
		return '';
	}

	/**
	 * Unset all class variables except the following critical variables: internal_encoding, state, bufferlen, buffer and diskcache.
	 * @param boolean $destroyall if true destroys all class variables, otherwise preserves critical variables.
	 * @param boolean $preserve_objcopy if true preserves the objcopy variable
	 * @access public
	 * @since 4.5.016 (2009-02-24)
	 */
	public function _destroy($destroyall=false, $preserve_objcopy=false) {
		if ($destroyall AND isset($this->diskcache) AND $this->diskcache AND (!$preserve_objcopy) AND (!$this->empty_string($this->buffer))) {
			// remove buffer file from cache
			unlink($this->buffer);
		}
		foreach (array_keys(get_object_vars($this)) as $val) {
			if ($destroyall OR (
				($val != 'internal_encoding')
				AND ($val != 'state')
				AND ($val != 'bufferlen')
				AND ($val != 'buffer')
				AND ($val != 'diskcache')
				AND ($val != 'sign')
				AND ($val != 'signature_data')
				AND ($val != 'signature_max_length')
				AND ($val != 'byterange_string')
				)) {
				if ((!$preserve_objcopy OR ($val != 'objcopy')) AND isset($this->$val)) {
					unset($this->$val);
				}
			}
		}
	}

	/**
	 * Check for locale-related bug
	 * @access protected
	 */
	protected function _dochecks() {
		//Check for locale-related bug
		if (1.1 == 1) {
			$this->Error('Don\'t alter the locale before including class file');
		}
		//Check for decimal separator
		if (sprintf('%.1F', 1.0) != '1.0') {
			setlocale(LC_NUMERIC, 'C');
		}
	}

	/**
	 * Return fonts path
	 * @return string
	 * @access protected
	 */
	protected function _getfontpath() {
		if (!defined('K_PATH_FONTS') AND is_dir(dirname(__FILE__).'/fonts')) {
			define('K_PATH_FONTS', dirname(__FILE__).'/fonts/');
		}
		return defined('K_PATH_FONTS') ? K_PATH_FONTS : '';
	}

	/**
	 * Output pages.
	 * @access protected
	 */
	protected function _putpages() {
		$nb = $this->numpages;
		if (!empty($this->AliasNbPages)) {
			$nbs = $this->formatPageNumber($nb);
			$nbu = $this->UTF8ToUTF16BE($nbs, false); // replacement for unicode font
			$alias_a = $this->_escape($this->AliasNbPages);
			$alias_au = $this->_escape('{'.$this->AliasNbPages.'}');
			if ($this->isunicode) {
				$alias_b = $this->_escape($this->UTF8ToLatin1($this->AliasNbPages));
				$alias_bu = $this->_escape($this->UTF8ToLatin1('{'.$this->AliasNbPages.'}'));
				$alias_c = $this->_escape($this->utf8StrRev($this->AliasNbPages, false, $this->tmprtl));
				$alias_cu = $this->_escape($this->utf8StrRev('{'.$this->AliasNbPages.'}', false, $this->tmprtl));
			}
		}
		if (!empty($this->AliasNumPage)) {
			$alias_pa = $this->_escape($this->AliasNumPage);
			$alias_pau = $this->_escape('{'.$this->AliasNumPage.'}');
			if ($this->isunicode) {
				$alias_pb = $this->_escape($this->UTF8ToLatin1($this->AliasNumPage));
				$alias_pbu = $this->_escape($this->UTF8ToLatin1('{'.$this->AliasNumPage.'}'));
				$alias_pc = $this->_escape($this->utf8StrRev($this->AliasNumPage, false, $this->tmprtl));
				$alias_pcu = $this->_escape($this->utf8StrRev('{'.$this->AliasNumPage.'}', false, $this->tmprtl));
			}
		}
		$pagegroupnum = 0;
		$filter = ($this->compress) ? '/Filter /FlateDecode ' : '';
		for ($n=1; $n <= $nb; ++$n) {
			$temppage = $this->getPageBuffer($n);
			if (!empty($this->pagegroups)) {
				if(isset($this->newpagegroup[$n])) {
					$pagegroupnum = 0;
				}
				++$pagegroupnum;
				foreach ($this->pagegroups as $k => $v) {
					// replace total pages group numbers
					$vs = $this->formatPageNumber($v);
					$vu = $this->UTF8ToUTF16BE($vs, false);
					$alias_ga = $this->_escape($k);
					$alias_gau = $this->_escape('{'.$k.'}');
					if ($this->isunicode) {
						$alias_gb = $this->_escape($this->UTF8ToLatin1($k));
						$alias_gbu = $this->_escape($this->UTF8ToLatin1('{'.$k.'}'));
						$alias_gc = $this->_escape($this->utf8StrRev($k, false, $this->tmprtl));
						$alias_gcu = $this->_escape($this->utf8StrRev('{'.$k.'}', false, $this->tmprtl));
					}
					$temppage = str_replace($alias_gau, $vu, $temppage);
					if ($this->isunicode) {
						$temppage = str_replace($alias_gbu, $vu, $temppage);
						$temppage = str_replace($alias_gcu, $vu, $temppage);
						$temppage = str_replace($alias_gb, $vs, $temppage);
						$temppage = str_replace($alias_gc, $vs, $temppage);
					}
					$temppage = str_replace($alias_ga, $vs, $temppage);
					// replace page group numbers
					$pvs = $this->formatPageNumber($pagegroupnum);
					$pvu = $this->UTF8ToUTF16BE($pvs, false);
					$pk = str_replace('{nb', '{pnb', $k);
					$alias_pga = $this->_escape($pk);
					$alias_pgau = $this->_escape('{'.$pk.'}');
					if ($this->isunicode) {
						$alias_pgb = $this->_escape($this->UTF8ToLatin1($pk));
						$alias_pgbu = $this->_escape($this->UTF8ToLatin1('{'.$pk.'}'));
						$alias_pgc = $this->_escape($this->utf8StrRev($pk, false, $this->tmprtl));
						$alias_pgcu = $this->_escape($this->utf8StrRev('{'.$pk.'}', false, $this->tmprtl));
					}
					$temppage = str_replace($alias_pgau, $pvu, $temppage);
					if ($this->isunicode) {
						$temppage = str_replace($alias_pgbu, $pvu, $temppage);
						$temppage = str_replace($alias_pgcu, $pvu, $temppage);
						$temppage = str_replace($alias_pgb, $pvs, $temppage);
						$temppage = str_replace($alias_pgc, $pvs, $temppage);
					}
					$temppage = str_replace($alias_pga, $pvs, $temppage);
				}
			}
			if (!empty($this->AliasNbPages)) {
				// replace total pages number
				$temppage = str_replace($alias_au, $nbu, $temppage);
				if ($this->isunicode) {
					$temppage = str_replace($alias_bu, $nbu, $temppage);
					$temppage = str_replace($alias_cu, $nbu, $temppage);
					$temppage = str_replace($alias_b, $nbs, $temppage);
					$temppage = str_replace($alias_c, $nbs, $temppage);
				}
				$temppage = str_replace($alias_a, $nbs, $temppage);
			}
			if (!empty($this->AliasNumPage)) {
				// replace page number
				$pnbs = $this->formatPageNumber($n);
				$pnbu = $this->UTF8ToUTF16BE($pnbs, false); // replacement for unicode font
				$temppage = str_replace($alias_pau, $pnbu, $temppage);
				if ($this->isunicode) {
					$temppage = str_replace($alias_pbu, $pnbu, $temppage);
					$temppage = str_replace($alias_pcu, $pnbu, $temppage);
					$temppage = str_replace($alias_pb, $pnbs, $temppage);
					$temppage = str_replace($alias_pc, $pnbs, $temppage);
				}
				$temppage = str_replace($alias_pa, $pnbs, $temppage);
			}
			$temppage = str_replace($this->epsmarker, '', $temppage);
			//Page
			$this->page_obj_id[$n] = $this->_newobj();
			$out = '<<';
			$out .= ' /Type /Page';
			$out .= ' /Parent 1 0 R';
			$out .= ' /LastModified '.$this->_datestring();
			$out .= ' /Resources 2 0 R';
			$boxes = array('MediaBox', 'CropBox', 'BleedBox', 'TrimBox', 'ArtBox');
			foreach ($boxes as $box) {
				$out .= ' /'.$box;
				$out .= sprintf(' [%.2F %.2F %.2F %.2F]', $this->pagedim[$n][$box]['llx'], $this->pagedim[$n][$box]['lly'], $this->pagedim[$n][$box]['urx'], $this->pagedim[$n][$box]['ury']);
			}
			if (isset($this->pagedim[$n]['BoxColorInfo']) AND !empty($this->pagedim[$n]['BoxColorInfo'])) {
				$out .= ' /BoxColorInfo <<';
				foreach ($boxes as $box) {
					if (isset($this->pagedim[$n]['BoxColorInfo'][$box])) {
						$out .= ' /'.$box.' <<';
						if (isset($this->pagedim[$n]['BoxColorInfo'][$box]['C'])) {
							$color = $this->pagedim[$n]['BoxColorInfo'][$box]['C'];
							$out .= ' /C [';
							$out .= sprintf(' %.3F %.3F %.3F', $color[0]/255, $color[1]/255, $color[2]/255);
							$out .= ' ]';
						}
						if (isset($this->pagedim[$n]['BoxColorInfo'][$box]['W'])) {
							$out .= ' /W '.($this->pagedim[$n]['BoxColorInfo'][$box]['W'] * $this->k);
						}
						if (isset($this->pagedim[$n]['BoxColorInfo'][$box]['S'])) {
							$out .= ' /S /'.$this->pagedim[$n]['BoxColorInfo'][$box]['S'];
						}
						if (isset($this->pagedim[$n]['BoxColorInfo'][$box]['D'])) {
							$dashes = $this->pagedim[$n]['BoxColorInfo'][$box]['D'];
							$out .= ' /D [';
							foreach ($dashes as $dash) {
								$out .= sprintf(' %.3F', ($dash * $this->k));
							}
							$out .= ' ]';
						}
						$out .= ' >>';
					}
				}
				$out .= ' >>';
			}
			$out .= ' /Contents '.($this->n + 1).' 0 R';
			$out .= ' /Rotate '.$this->pagedim[$n]['Rotate'];
			$out .= ' /Group << /Type /Group /S /Transparency /CS /DeviceRGB >>';
			if (isset($this->pagedim[$n]['trans']) AND !empty($this->pagedim[$n]['trans'])) {
				// page transitions
				if (isset($this->pagedim[$n]['trans']['Dur'])) {
					$out .= ' /Dur '.$this->pagedim[$n]['trans']['Dur'];
				}
				$out .= ' /Trans <<';
				$out .= ' /Type /Trans';
				if (isset($this->pagedim[$n]['trans']['S'])) {
					$out .= ' /S /'.$this->pagedim[$n]['trans']['S'];
				}
				if (isset($this->pagedim[$n]['trans']['D'])) {
					$out .= ' /D '.$this->pagedim[$n]['trans']['D'];
				}
				if (isset($this->pagedim[$n]['trans']['Dm'])) {
					$out .= ' /Dm /'.$this->pagedim[$n]['trans']['Dm'];
				}
				if (isset($this->pagedim[$n]['trans']['M'])) {
					$out .= ' /M /'.$this->pagedim[$n]['trans']['M'];
				}
				if (isset($this->pagedim[$n]['trans']['Di'])) {
					$out .= ' /Di '.$this->pagedim[$n]['trans']['Di'];
				}
				if (isset($this->pagedim[$n]['trans']['SS'])) {
					$out .= ' /SS '.$this->pagedim[$n]['trans']['SS'];
				}
				if (isset($this->pagedim[$n]['trans']['B'])) {
					$out .= ' /B '.$this->pagedim[$n]['trans']['B'];
				}
				$out .= ' >>';
			}
			$out .= $this->_getannotsrefs($n);
			$out .= ' /PZ '.$this->pagedim[$n]['PZ'];
			$out .= ' >>';
			$out .= "\n".'endobj';
			$this->_out($out);
			//Page content
			$p = ($this->compress) ? gzcompress($temppage) : $temppage;
			$this->_newobj();
			$p = $this->_getrawstream($p);
			$this->_out('<<'.$filter.'/Length '.strlen($p).'>> stream'."\n".$p."\n".'endstream'."\n".'endobj');
			if ($this->diskcache) {
				// remove temporary files
				unlink($this->pages[$n]);
			}
		}
		//Pages root
		$out = $this->_getobj(1)."\n";
		$out .= '<< /Type /Pages /Kids [';
		foreach($this->page_obj_id as $page_obj) {
			$out .= ' '.$page_obj.' 0 R';
		}
		$out .= ' ] /Count '.$nb.' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
	}

	/**
	 * Output references to page annotations
	 * @param int $n page number
	 * @access protected
	 * @author Nicola Asuni
	 * @since 4.7.000 (2008-08-29)
	 * @deprecated
	 */
	protected function _putannotsrefs($n) {
		$this->_out($this->_getannotsrefs($n));
	}

	/**
	 * Get references to page annotations.
	 * @param int $n page number
	 * @return string
	 * @access protected
	 * @author Nicola Asuni
	 * @since 5.0.010 (2010-05-17)
	 */
	protected function _getannotsrefs($n) {
		if (!(isset($this->PageAnnots[$n]) OR ($this->sign AND isset($this->signature_data['cert_type'])))) {
			return '';
		}
		$out = ' /Annots [';
		if (isset($this->PageAnnots[$n])) {
			foreach ($this->PageAnnots[$n] as $key => $val) {
				if (!in_array($val['n'], $this->radio_groups)) {
					$out .= ' '.$val['n'].' 0 R';
				}
			}
			// add radiobutton groups
			if (isset($this->radiobutton_groups[$n])) {
				foreach ($this->radiobutton_groups[$n] as $key => $data) {
					if (isset($data['n'])) {
						$out .= ' '.$data['n'].' 0 R';
					}
				}
			}
		}
		if ($this->sign AND ($n == $this->signature_appearance['page']) AND isset($this->signature_data['cert_type'])) {
			// set reference for signature object
			$out .= ' '.$this->sig_obj_id.' 0 R';
		}
		$out .= ' ]';
		return $out;
	}

	/**
	 * Output annotations objects for all pages.
	 * !!! THIS METHOD IS NOT YET COMPLETED !!!
	 * See section 12.5 of PDF 32000_2008 reference.
	 * @access protected
	 * @author Nicola Asuni
	 * @since 4.0.018 (2008-08-06)
	 */
	protected function _putannotsobjs() {
		// reset object counter
		for ($n=1; $n <= $this->numpages; ++$n) {
			if (isset($this->PageAnnots[$n])) {
				// set page annotations
				foreach ($this->PageAnnots[$n] as $key => $pl) {
					$annot_obj_id = $this->PageAnnots[$n][$key]['n'];
					// create annotation object for grouping radiobuttons
					if (isset($this->radiobutton_groups[$n][$pl['txt']]) AND is_array($this->radiobutton_groups[$n][$pl['txt']])) {
						$radio_button_obj_id = $this->radiobutton_groups[$n][$pl['txt']]['n'];
						$annots = '<<';
						$annots .= ' /Type /Annot';
						$annots .= ' /Subtype /Widget';
						$annots .= ' /Rect [0 0 0 0]';
						$annots .= ' /T '.$this->_datastring($pl['txt'], $radio_button_obj_id);
						$annots .= ' /FT /Btn';
						$annots .= ' /Ff 49152';
						$annots .= ' /Kids [';
						foreach ($this->radiobutton_groups[$n][$pl['txt']] as $key => $data) {
							if ($key !== 'n') {
								$annots .= ' '.$data['kid'].' 0 R';
								if ($data['def'] !== 'Off') {
									$defval = $data['def'];
								}
							}
						}
						$annots .= ' ]';
						if (isset($defval)) {
							$annots .= ' /V /'.$defval;
						}
						$annots .= ' >>';
						$this->_out($this->_getobj($radio_button_obj_id)."\n".$annots."\n".'endobj');
						$this->form_obj_id[] = $radio_button_obj_id;
						// store object id to be used on Parent entry of Kids
						$this->radiobutton_groups[$n][$pl['txt']] = $radio_button_obj_id;
					}
					$formfield = false;
					$pl['opt'] = array_change_key_case($pl['opt'], CASE_LOWER);
					$a = $pl['x'] * $this->k;
					$b = $this->pagedim[$n]['h'] - (($pl['y'] + $pl['h']) * $this->k);
					$c = $pl['w'] * $this->k;
					$d = $pl['h'] * $this->k;
					$rect = sprintf('%.2F %.2F %.2F %.2F', $a, $b, $a+$c, $b+$d);
					// create new annotation object
					$annots = '<</Type /Annot';
					$annots .= ' /Subtype /'.$pl['opt']['subtype'];
					$annots .= ' /Rect ['.$rect.']';
					$ft = array('Btn', 'Tx', 'Ch', 'Sig');
					if (isset($pl['opt']['ft']) AND in_array($pl['opt']['ft'], $ft)) {
						$annots .= ' /FT /'.$pl['opt']['ft'];
						$formfield = true;
					}
					$annots .= ' /Contents '.$this->_textstring($pl['txt'], $annot_obj_id);
					$annots .= ' /P '.$this->page_obj_id[$n].' 0 R';
					$annots .= ' /NM '.$this->_datastring(sprintf('%04u-%04u', $n, $key), $annot_obj_id);
					$annots .= ' /M '.$this->_datestring($annot_obj_id);
					if (isset($pl['opt']['f'])) {
						$val = 0;
						if (is_array($pl['opt']['f'])) {
							foreach ($pl['opt']['f'] as $f) {
								switch (strtolower($f)) {
									case 'invisible': {
										$val += 1 << 0;
										break;
									}
									case 'hidden': {
										$val += 1 << 1;
										break;
									}
									case 'print': {
										$val += 1 << 2;
										break;
									}
									case 'nozoom': {
										$val += 1 << 3;
										break;
									}
									case 'norotate': {
										$val += 1 << 4;
										break;
									}
									case 'noview': {
										$val += 1 << 5;
										break;
									}
									case 'readonly': {
										$val += 1 << 6;
										break;
									}
									case 'locked': {
										$val += 1 << 8;
										break;
									}
									case 'togglenoview': {
										$val += 1 << 9;
										break;
									}
									case 'lockedcontents': {
										$val += 1 << 10;
										break;
									}
									default: {
										break;
									}
								}
							}
						} else {
							$val = intval($pl['opt']['f']);
						}
						$annots .= ' /F '.intval($val);
					}
					if (isset($pl['opt']['as']) AND is_string($pl['opt']['as'])) {
						$annots .= ' /AS /'.$pl['opt']['as'];
					}
					if (isset($pl['opt']['ap'])) {
						// appearance stream
						$annots .= ' /AP <<';
						if (is_array($pl['opt']['ap'])) {
							foreach ($pl['opt']['ap'] as $apmode => $apdef) {
								// $apmode can be: n = normal; r = rollover; d = down;
								$annots .= ' /'.strtoupper($apmode);
								if (is_array($apdef)) {
									$annots .= ' <<';
									foreach ($apdef as $apstate => $stream) {
										// reference to XObject that define the appearance for this mode-state
										$apsobjid = $this->_putAPXObject($c, $d, $stream);
										$annots .= ' /'.$apstate.' '.$apsobjid.' 0 R';
									}
									$annots .= ' >>';
								} else {
									// reference to XObject that define the appearance for this mode
									$apsobjid = $this->_putAPXObject($c, $d, $apdef);
									$annots .= ' '.$apsobjid.' 0 R';
								}
							}
						} else {
							$annots .= $pl['opt']['ap'];
						}
						$annots .= ' >>';
					}
					if (isset($pl['opt']['bs']) AND (is_array($pl['opt']['bs']))) {
						$annots .= ' /BS <<';
						$annots .= ' /Type /Border';
						if (isset($pl['opt']['bs']['w'])) {
							$annots .= ' /W '.intval($pl['opt']['bs']['w']);
						}
						$bstyles = array('S', 'D', 'B', 'I', 'U');
						if (isset($pl['opt']['bs']['s']) AND in_array($pl['opt']['bs']['s'], $bstyles)) {
							$annots .= ' /S /'.$pl['opt']['bs']['s'];
						}
						if (isset($pl['opt']['bs']['d']) AND (is_array($pl['opt']['bs']['d']))) {
							$annots .= ' /D [';
							foreach ($pl['opt']['bs']['d'] as $cord) {
								$annots .= ' '.intval($cord);
							}
							$annots .= ']';
						}
						$annots .= ' >>';
					} else {
						$annots .= ' /Border [';
						if (isset($pl['opt']['border']) AND (count($pl['opt']['border']) >= 3)) {
							$annots .= intval($pl['opt']['border'][0]).' ';
							$annots .= intval($pl['opt']['border'][1]).' ';
							$annots .= intval($pl['opt']['border'][2]);
							if (isset($pl['opt']['border'][3]) AND is_array($pl['opt']['border'][3])) {
								$annots .= ' [';
								foreach ($pl['opt']['border'][3] as $dash) {
									$annots .= intval($dash).' ';
								}
								$annots .= ']';
							}
						} else {
							$annots .= '0 0 0';
						}
						$annots .= ']';
					}
					if (isset($pl['opt']['be']) AND (is_array($pl['opt']['be']))) {
						$annots .= ' /BE <<';
						$bstyles = array('S', 'C');
						if (isset($pl['opt']['be']['s']) AND in_array($pl['opt']['be']['s'], $markups)) {
							$annots .= ' /S /'.$pl['opt']['bs']['s'];
						} else {
							$annots .= ' /S /S';
						}
						if (isset($pl['opt']['be']['i']) AND ($pl['opt']['be']['i'] >= 0) AND ($pl['opt']['be']['i'] <= 2)) {
							$annots .= ' /I '.sprintf(' %.4F', $pl['opt']['be']['i']);
						}
						$annots .= '>>';
					}
					if (isset($pl['opt']['c']) AND (is_array($pl['opt']['c'])) AND !empty($pl['opt']['c'])) {
						$annots .= ' /C [';
						foreach ($pl['opt']['c'] as $col) {
							$col = intval($col);
							$color = $col <= 0 ? 0 : ($col >= 255 ? 1 : $col / 255);
							$annots .= sprintf(' %.4F', $color);
						}
						$annots .= ']';
					}
					//$annots .= ' /StructParent ';
					//$annots .= ' /OC ';
					$markups = array('text', 'freetext', 'line', 'square', 'circle', 'polygon', 'polyline', 'highlight', 'underline', 'squiggly', 'strikeout', 'stamp', 'caret', 'ink', 'fileattachment', 'sound');
					if (in_array(strtolower($pl['opt']['subtype']), $markups)) {
						// this is a markup type
						if (isset($pl['opt']['t']) AND is_string($pl['opt']['t'])) {
							$annots .= ' /T '.$this->_textstring($pl['opt']['t'], $annot_obj_id);
						}
						//$annots .= ' /Popup ';
						if (isset($pl['opt']['ca'])) {
							$annots .= ' /CA '.sprintf('%.4F', floatval($pl['opt']['ca']));
						}
						if (isset($pl['opt']['rc'])) {
							$annots .= ' /RC '.$this->_textstring($pl['opt']['rc'], $annot_obj_id);
						}
						$annots .= ' /CreationDate '.$this->_datestring($annot_obj_id);
						//$annots .= ' /IRT ';
						if (isset($pl['opt']['subj'])) {
							$annots .= ' /Subj '.$this->_textstring($pl['opt']['subj'], $annot_obj_id);
						}
						//$annots .= ' /RT ';
						//$annots .= ' /IT ';
						//$annots .= ' /ExData ';
					}
					$lineendings = array('Square', 'Circle', 'Diamond', 'OpenArrow', 'ClosedArrow', 'None', 'Butt', 'ROpenArrow', 'RClosedArrow', 'Slash');
					// Annotation types
					switch (strtolower($pl['opt']['subtype'])) {
						case 'text': {
							if (isset($pl['opt']['open'])) {
								$annots .= ' /Open '. (strtolower($pl['opt']['open']) == 'true' ? 'true' : 'false');
							}
							$iconsapp = array('Comment', 'Help', 'Insert', 'Key', 'NewParagraph', 'Note', 'Paragraph');
							if (isset($pl['opt']['name']) AND in_array($pl['opt']['name'], $iconsapp)) {
								$annots .= ' /Name /'.$pl['opt']['name'];
							} else {
								$annots .= ' /Name /Note';
							}
							$statemodels = array('Marked', 'Review');
							if (isset($pl['opt']['statemodel']) AND in_array($pl['opt']['statemodel'], $statemodels)) {
								$annots .= ' /StateModel /'.$pl['opt']['statemodel'];
							} else {
								$pl['opt']['statemodel'] = 'Marked';
								$annots .= ' /StateModel /'.$pl['opt']['statemodel'];
							}
							if ($pl['opt']['statemodel'] == 'Marked') {
								$states = array('Accepted', 'Unmarked');
							} else {
								$states = array('Accepted', 'Rejected', 'Cancelled', 'Completed', 'None');
							}
							if (isset($pl['opt']['state']) AND in_array($pl['opt']['state'], $states)) {
								$annots .= ' /State /'.$pl['opt']['state'];
							} else {
								if ($pl['opt']['statemodel'] == 'Marked') {
									$annots .= ' /State /Unmarked';
								} else {
									$annots .= ' /State /None';
								}
							}
							break;
						}
						case 'link': {
							if(is_string($pl['txt'])) {
								// external URI link
								$annots .= ' /A <</S /URI /URI '.$this->_datastring($this->unhtmlentities($pl['txt']), $annot_obj_id).'>>';
							} else {
								// internal link
								$l = $this->links[$pl['txt']];
								$annots .= sprintf(' /Dest [%u 0 R /XYZ 0 %.2F null]', $this->page_obj_id[($l[0])], ($this->pagedim[$l[0]]['h'] - ($l[1] * $this->k)));
							}
							$hmodes = array('N', 'I', 'O', 'P');
							if (isset($pl['opt']['h']) AND in_array($pl['opt']['h'], $hmodes)) {
								$annots .= ' /H /'.$pl['opt']['h'];
							} else {
								$annots .= ' /H /I';
							}
							//$annots .= ' /PA ';
							//$annots .= ' /Quadpoints ';
							break;
						}
						case 'freetext': {
							if (isset($pl['opt']['da']) AND !empty($pl['opt']['da'])) {
								$annots .= ' /DA ('.$pl['opt']['da'].')';
							}
							if (isset($pl['opt']['q']) AND ($pl['opt']['q'] >= 0) AND ($pl['opt']['q'] <= 2)) {
								$annots .= ' /Q '.intval($pl['opt']['q']);
							}
							if (isset($pl['opt']['rc'])) {
								$annots .= ' /RC '.$this->_textstring($pl['opt']['rc'], $annot_obj_id);
							}
							if (isset($pl['opt']['ds'])) {
								$annots .= ' /DS '.$this->_textstring($pl['opt']['ds'], $annot_obj_id);
							}
							if (isset($pl['opt']['cl']) AND is_array($pl['opt']['cl'])) {
								$annots .= ' /CL [';
								foreach ($pl['opt']['cl'] as $cl) {
									$annots .= sprintf('%.4F ', $cl * $this->k);
								}
								$annots .= ']';
							}
							$tfit = array('FreeText', 'FreeTextCallout', 'FreeTextTypeWriter');
							if (isset($pl['opt']['it']) AND in_array($pl['opt']['it'], $tfit)) {
								$annots .= ' /IT /'.$pl['opt']['it'];
							}
							if (isset($pl['opt']['rd']) AND is_array($pl['opt']['rd'])) {
								$l = $pl['opt']['rd'][0] * $this->k;
								$r = $pl['opt']['rd'][1] * $this->k;
								$t = $pl['opt']['rd'][2] * $this->k;
								$b = $pl['opt']['rd'][3] * $this->k;
								$annots .= ' /RD ['.sprintf('%.2F %.2F %.2F %.2F', $l, $r, $t, $b).']';
							}
							if (isset($pl['opt']['le']) AND in_array($pl['opt']['le'], $lineendings)) {
								$annots .= ' /LE /'.$pl['opt']['le'];
							}
							break;
						}
						case 'line': {
							break;
						}
						case 'square': {
							break;
						}
						case 'circle': {
							break;
						}
						case 'polygon': {
							break;
						}
						case 'polyline': {
							break;
						}
						case 'highlight': {
							break;
						}
						case 'underline': {
							break;
						}
						case 'squiggly': {
							break;
						}
						case 'strikeout': {
							break;
						}
						case 'stamp': {
							break;
						}
						case 'caret': {
							break;
						}
						case 'ink': {
							break;
						}
						case 'popup': {
							break;
						}
						case 'fileattachment': {
							if (!isset($pl['opt']['fs'])) {
								break;
							}
							$filename = basename($pl['opt']['fs']);
							if (isset($this->embeddedfiles[$filename]['n'])) {
								$annots .= ' /FS <</Type /Filespec /F '.$this->_datastring($filename, $annot_obj_id).' /EF <</F '.$this->embeddedfiles[$filename]['n'].' 0 R>> >>';
								$iconsapp = array('Graph', 'Paperclip', 'PushPin', 'Tag');
								if (isset($pl['opt']['name']) AND in_array($pl['opt']['name'], $iconsapp)) {
									$annots .= ' /Name /'.$pl['opt']['name'];
								} else {
									$annots .= ' /Name /PushPin';
								}
							}
							break;
						}
						case 'sound': {
							if (!isset($pl['opt']['fs'])) {
								break;
							}
							$filename = basename($pl['opt']['fs']);
							if (isset($this->embeddedfiles[$filename]['n'])) {
								// ... TO BE COMPLETED ...
								// /R /C /B /E /CO /CP
								$annots .= ' /Sound <</Type /Filespec /F '.$this->_datastring($filename, $annot_obj_id).' /EF <</F '.$this->embeddedfiles[$filename]['n'].' 0 R>> >>';
								$iconsapp = array('Speaker', 'Mic');
								if (isset($pl['opt']['name']) AND in_array($pl['opt']['name'], $iconsapp)) {
									$annots .= ' /Name /'.$pl['opt']['name'];
								} else {
									$annots .= ' /Name /Speaker';
								}
							}
							break;
						}
						case 'movie': {
							break;
						}
						case 'widget': {
							$hmode = array('N', 'I', 'O', 'P', 'T');
							if (isset($pl['opt']['h']) AND in_array($pl['opt']['h'], $hmode)) {
								$annots .= ' /H /'.$pl['opt']['h'];
							}
						 	if (isset($pl['opt']['mk']) AND (is_array($pl['opt']['mk'])) AND !empty($pl['opt']['mk'])) {
						 		$annots .= ' /MK <<';
						 		if (isset($pl['opt']['mk']['r'])) {
						 			$annots .= ' /R '.$pl['opt']['mk']['r'];
						 		}
						 		if (isset($pl['opt']['mk']['bc']) AND (is_array($pl['opt']['mk']['bc']))) {
						 			$annots .= ' /BC [';
						 			foreach($pl['opt']['mk']['bc'] AS $col) {
						 				$col = intval($col);
										$color = $col <= 0 ? 0 : ($col >= 255 ? 1 : $col / 255);
						 				$annots .= sprintf(' %.2F', $color);
						 			}
						 			$annots .= ']';
						 		}
						 		if (isset($pl['opt']['mk']['bg']) AND (is_array($pl['opt']['mk']['bg']))) {
						 			$annots .= ' /BG [';
						 			foreach($pl['opt']['mk']['bg'] AS $col) {
						 				$col = intval($col);
										$color = $col <= 0 ? 0 : ($col >= 255 ? 1 : $col / 255);
						 				$annots .= sprintf(' %.2F', $color);
						 			}
						 			$annots .= ']';
						 		}
						 		if (isset($pl['opt']['mk']['ca'])) {
						 			$annots .= ' /CA '.$pl['opt']['mk']['ca'];
						 		}
						 		if (isset($pl['opt']['mk']['rc'])) {
						 			$annots .= ' /RC '.$pl['opt']['mk']['rc'];
						 		}
						 		if (isset($pl['opt']['mk']['ac'])) {
						 			$annots .= ' /AC '.$pl['opt']['mk']['ac'];
						 		}
						 		if (isset($pl['opt']['mk']['i'])) {
						 			$info = $this->getImageBuffer($pl['opt']['mk']['i']);
						 			if ($info !== false) {
						 				$annots .= ' /I '.$info['n'].' 0 R';
						 			}
						 		}
						 		if (isset($pl['opt']['mk']['ri'])) {
						 			$info = $this->getImageBuffer($pl['opt']['mk']['ri']);
						 			if ($info !== false) {
						 				$annots .= ' /RI '.$info['n'].' 0 R';
						 			}
						 		}
						 		if (isset($pl['opt']['mk']['ix'])) {
						 			$info = $this->getImageBuffer($pl['opt']['mk']['ix']);
						 			if ($info !== false) {
						 				$annots .= ' /IX '.$info['n'].' 0 R';
						 			}
						 		}
						 		if (isset($pl['opt']['mk']['if']) AND (is_array($pl['opt']['mk']['if'])) AND !empty($pl['opt']['mk']['if'])) {
						 			$annots .= ' /IF <<';
						 			$if_sw = array('A', 'B', 'S', 'N');
									if (isset($pl['opt']['mk']['if']['sw']) AND in_array($pl['opt']['mk']['if']['sw'], $if_sw)) {
										$annots .= ' /SW /'.$pl['opt']['mk']['if']['sw'];
									}
						 			$if_s = array('A', 'P');
									if (isset($pl['opt']['mk']['if']['s']) AND in_array($pl['opt']['mk']['if']['s'], $if_s)) {
										$annots .= ' /S /'.$pl['opt']['mk']['if']['s'];
									}
									if (isset($pl['opt']['mk']['if']['a']) AND (is_array($pl['opt']['mk']['if']['a'])) AND !empty($pl['opt']['mk']['if']['a'])) {
										$annots .= sprintf(' /A [%.2F %.2F]', $pl['opt']['mk']['if']['a'][0], $pl['opt']['mk']['if']['a'][1]);
									}
									if (isset($pl['opt']['mk']['if']['fb']) AND ($pl['opt']['mk']['if']['fb'])) {
										$annots .= ' /FB true';
									}
						 			$annots .= '>>';
						 		}
						 		if (isset($pl['opt']['mk']['tp']) AND ($pl['opt']['mk']['tp'] >= 0) AND ($pl['opt']['mk']['tp'] <= 6)) {
						 			$annots .= ' /TP '.intval($pl['opt']['mk']['tp']);
						 		} else {
						 			$annots .= ' /TP 0';
						 		}
						 		$annots .= '>>';
						 	} // end MK
						 	// --- Entries for field dictionaries ---
						 	if (isset($this->radiobutton_groups[$n][$pl['txt']])) {
						 		// set parent
						 		$annots .= ' /Parent '.$this->radiobutton_groups[$n][$pl['txt']].' 0 R';
						 	}
						 	if (isset($pl['opt']['t']) AND is_string($pl['opt']['t'])) {
								$annots .= ' /T '.$this->_datastring($pl['opt']['t'], $annot_obj_id);
							}
							if (isset($pl['opt']['tu']) AND is_string($pl['opt']['tu'])) {
								$annots .= ' /TU '.$this->_datastring($pl['opt']['tu'], $annot_obj_id);
							}
							if (isset($pl['opt']['tm']) AND is_string($pl['opt']['tm'])) {
								$annots .= ' /TM '.$this->_datastring($pl['opt']['tm'], $annot_obj_id);
							}
							if (isset($pl['opt']['ff'])) {
								if (is_array($pl['opt']['ff'])) {
									// array of bit settings
									$flag = 0;
									foreach($pl['opt']['ff'] as $val) {
										$flag += 1 << ($val - 1);
									}
								} else {
									$flag = intval($pl['opt']['ff']);
								}
								$annots .= ' /Ff '.$flag;
							}
							if (isset($pl['opt']['maxlen'])) {
								$annots .= ' /MaxLen '.intval($pl['opt']['maxlen']);
							}
							if (isset($pl['opt']['v'])) {
								$annots .= ' /V';
								if (is_array($pl['opt']['v'])) {
									foreach ($pl['opt']['v'] AS $optval) {
										if (is_float($optval)) {
											$optval = sprintf('%.2F', $optval);
										}
										$annots .= ' '.$optval;
									}
								} else {
									$annots .= ' '.$this->_textstring($pl['opt']['v'], $annot_obj_id);
								}
							}
							if (isset($pl['opt']['dv'])) {
								$annots .= ' /DV';
								if (is_array($pl['opt']['dv'])) {
									foreach ($pl['opt']['dv'] AS $optval) {
										if (is_float($optval)) {
											$optval = sprintf('%.2F', $optval);
										}
										$annots .= ' '.$optval;
									}
								} else {
									$annots .= ' '.$this->_textstring($pl['opt']['dv'], $annot_obj_id);
								}
							}
							if (isset($pl['opt']['rv'])) {
								$annots .= ' /RV';
								if (is_array($pl['opt']['rv'])) {
									foreach ($pl['opt']['rv'] AS $optval) {
										if (is_float($optval)) {
											$optval = sprintf('%.2F', $optval);
										}
										$annots .= ' '.$optval;
									}
								} else {
									$annots .= ' '.$this->_textstring($pl['opt']['rv'], $annot_obj_id);
								}
							}
							if (isset($pl['opt']['a']) AND !empty($pl['opt']['a'])) {
								$annots .= ' /A << '.$pl['opt']['a'].' >>';
							}
							if (isset($pl['opt']['aa']) AND !empty($pl['opt']['aa'])) {
								$annots .= ' /AA << '.$pl['opt']['aa'].' >>';
							}
							if (isset($pl['opt']['da']) AND !empty($pl['opt']['da'])) {
								$annots .= ' /DA ('.$pl['opt']['da'].')';
							}
							if (isset($pl['opt']['q']) AND ($pl['opt']['q'] >= 0) AND ($pl['opt']['q'] <= 2)) {
								$annots .= ' /Q '.intval($pl['opt']['q']);
							}
							if (isset($pl['opt']['opt']) AND (is_array($pl['opt']['opt'])) AND !empty($pl['opt']['opt'])) {
					 			$annots .= ' /Opt [';
					 			foreach($pl['opt']['opt'] AS $copt) {
					 				if (is_array($copt)) {
					 					$annots .= ' ['.$this->_textstring($copt[0], $annot_obj_id).' '.$this->_textstring($copt[1], $annot_obj_id).']';
					 				} else {
					 					$annots .= ' '.$this->_textstring($copt, $annot_obj_id);
					 				}
					 			}
					 			$annots .= ']';
					 		}
					 		if (isset($pl['opt']['ti'])) {
					 			$annots .= ' /TI '.intval($pl['opt']['ti']);
					 		}
					 		if (isset($pl['opt']['i']) AND (is_array($pl['opt']['i'])) AND !empty($pl['opt']['i'])) {
					 			$annots .= ' /I [';
					 			foreach($pl['opt']['i'] AS $copt) {
					 				$annots .= intval($copt).' ';
					 			}
					 			$annots .= ']';
					 		}
							break;
						}
						case 'screen': {
							break;
						}
						case 'printermark': {
							break;
						}
						case 'trapnet': {
							break;
						}
						case 'watermark': {
							break;
						}
						case '3d': {
							break;
						}
						default: {
							break;
						}
					}
					$annots .= '>>';
					// create new annotation object
					$this->_out($this->_getobj($annot_obj_id)."\n".$annots."\n".'endobj');
					if ($formfield AND !isset($this->radiobutton_groups[$n][$pl['txt']])) {
						// store reference of form object
						$this->form_obj_id[] = $annot_obj_id;
					}
				}
			}
		} // end for each page
	}

	/**
	 * Put appearance streams XObject used to define annotation's appearance states
	 * @param int $w annotation width
	 * @param int $h annotation height
	 * @param string $stream appearance stream
	 * @return int object ID
	 * @access protected
	 * @since 4.8.001 (2009-09-09)
	 */
	protected function _putAPXObject($w=0, $h=0, $stream='') {
		$stream = trim($stream);
		$out = $this->_getobj()."\n";
		$this->xobjects['AX'.$this->n] = array('n' => $this->n);
		$out .= '<<';
		$out .= ' /Type /XObject';
		$out .= ' /Subtype /Form';
		$out .= ' /FormType 1';
		if ($this->compress) {
			$stream = gzcompress($stream);
			$out .= ' /Filter /FlateDecode';
		}
		$rect = sprintf('%.2F %.2F', $w, $h);
		$out .= ' /BBox [0 0 '.$rect.']';
		$out .= ' /Matrix [1 0 0 1 0 0]';
		$out .= ' /Resources <<';
		$out .= ' /ProcSet [/PDF /Text]';
		$out .= ' /Font <<';
		foreach ($this->annotation_fonts as $fontkey => $fontid) {
			$out .= ' /F'.$fontid.' '.$this->font_obj_ids[$fontkey].' 0 R';
		}
		$out .= ' >>';
		$out .= ' >>';
		$stream = $this->_getrawstream($stream);
		$out .= ' /Length '.strlen($stream);
		$out .= ' >>';
		$out .= ' stream'."\n".$stream."\n".'endstream';
		$out .= "\n".'endobj';
		$this->_out($out);
		return $this->n;
	}

	/**
	 * Get ULONG from string (Big Endian 32-bit unsigned integer).
	 * @param string $str string from where to extract value
	 * @param int $offset point from where to read the data
	 * @return int 32 bit value
	 * @author Nicola Asuni
	 * @access protected
	 * @since 5.2.000 (2010-06-02)
	 */
	protected function _getULONG(&$str, &$offset) {
		$v = unpack('Ni', substr($str, $offset, 4));
		$offset += 4;
		return $v['i'];
	}

	/**
	 * Get USHORT from string (Big Endian 16-bit unsigned integer).
	 * @param string $str string from where to extract value
	 * @param int $offset point from where to read the data
	 * @return int 16 bit value
	 * @author Nicola Asuni
	 * @access protected
	 * @since 5.2.000 (2010-06-02)
	 */
	protected function _getUSHORT(&$str, &$offset) {
		$v = unpack('ni', substr($str, $offset, 2));
		$offset += 2;
		return $v['i'];
	}

	/**
	 * Get SHORT from string (Big Endian 16-bit signed integer).
	 * @param string $str string from where to extract value
	 * @param int $offset point from where to read the data
	 * @return int 16 bit value
	 * @author Nicola Asuni
	 * @access protected
	 * @since 5.2.000 (2010-06-02)
	 */
	protected function _getSHORT(&$str, &$offset) {
		$v = unpack('si', substr($str, $offset, 2));
		$offset += 2;
		return $v['i'];
	}

	/**
	 * Get BYTE from string (8-bit unsigned integer).
	 * @param string $str string from where to extract value
	 * @param int $offset point from where to read the data
	 * @return int 8 bit value
	 * @author Nicola Asuni
	 * @access protected
	 * @since 5.2.000 (2010-06-02)
	 */
	protected function _getBYTE(&$str, &$offset) {
		$v = unpack('Ci', substr($str, $offset, 1));
		++$offset;
		return $v['i'];
	}

	/**
	 * Returns a subset of the TrueType font data without the unused glyphs.
	 * @param string $font TrueType font data
	 * @param array $subsetchars array of used characters (the glyphs to keep)
	 * @return string a subset of TrueType font data without the unused glyphs
	 * @author Nicola Asuni
	 * @access protected
	 * @since 5.2.000 (2010-06-02)
	 */
	protected function _getTrueTypeFontSubset($font, $subsetchars) {
		ksort($subsetchars);
		$offset = 0; // offset position of the font data
		if ($this->_getULONG($font, $offset) != 0x10000) {
			// sfnt version must be 0x00010000 for TrueType version 1.0.
			return $font;
		}
		// get number of tables
		$numTables = $this->_getUSHORT($font, $offset);
		// skip searchRange, entrySelector and rangeShift
		$offset += 6;
		// tables array
		$table = array();
		// for each table
		for ($i = 0; $i < $numTables; ++$i) {
			// get table info
			$tag = substr($font, $offset, 4);
			$offset += 4;
			$table[$tag] = array();
			$table[$tag]['checkSum'] = $this->_getULONG($font, $offset);
			$table[$tag]['offset'] = $this->_getULONG($font, $offset);
			$table[$tag]['length'] = $this->_getULONG($font, $offset);
		}
		// check magicNumber
		$offset = $table['head']['offset'] + 12;
		if ($this->_getULONG($font, $offset) != 0x5F0F3CF5) {
			// magicNumber must be 0x5F0F3CF5
			return $font;
		}
		// get offset mode (indexToLocFormat : 0 = short, 1 = long)
		$offset = $table['head']['offset'] + 50;
		$short_offset = ($this->_getSHORT($font, $offset) == 0);
		// get the offsets to the locations of the glyphs in the font, relative to the beginning of the glyphData table
		$indexToLoc = array();
		$offset = $table['loca']['offset'];
		if ($short_offset) {
			// short version
			$n = $table['loca']['length'] / 2; // numGlyphs + 1
			for ($i = 0; $i < $n; ++$i) {
				$indexToLoc[$i] = $this->_getUSHORT($font, $offset) * 2;
			}
		} else {
			// long version
			$n = $table['loca']['length'] / 4; // numGlyphs + 1
			for ($i = 0; $i < $n; ++$i) {
				$indexToLoc[$i] = $this->_getULONG($font, $offset);
			}
		}
		// get glyphs indexes of chars from cmap table
		$subsetglyphs = array(); // glyph IDs on key
		$subsetglyphs[0] = true; // character codes that do not correspond to any glyph in the font should be mapped to glyph index 0
		$offset = $table['cmap']['offset'] + 2;
		$numEncodingTables = $this->_getUSHORT($font, $offset);
		$encodingTables = array();
		for ($i = 0; $i < $numEncodingTables; ++$i) {
			$encodingTables[$i]['platformID'] = $this->_getUSHORT($font, $offset);
			$encodingTables[$i]['encodingID'] = $this->_getUSHORT($font, $offset);
			$encodingTables[$i]['offset'] = $this->_getULONG($font, $offset);
		}
		foreach ($encodingTables as $enctable) {
			if (($enctable['platformID'] == 3) AND ($enctable['encodingID'] == 0)) {
				$modesymbol = true;
			} else {
				$modesymbol = false;
			}
			$offset = $table['cmap']['offset'] + $enctable['offset'];
			$format = $this->_getUSHORT($font, $offset);
			switch ($format) {
				case 0: { // Format 0: Byte encoding table
					$offset += 4; // skip length and version/language
					for ($k = 0; $k < 256; ++$k) {
						if (isset($subsetchars[$k])) {
							$g = $this->_getBYTE($font, $offset);
							$subsetglyphs[$g] = $k;
						} else {
							++$offset;
						}
					}
					break;
				}
				case 2: { // Format 2: High-byte mapping through table
					$offset += 4; // skip length and version
					// to be implemented ...
					break;
				}
				case 4: { // Format 4: Segment mapping to delta values
					$length = $this->_getUSHORT($font, $offset);
					$offset += 2; // skip version/language
					$segCount = ($this->_getUSHORT($font, $offset) / 2);
					$offset += 6; // skip searchRange, entrySelector, rangeShift
					$endCount = array(); // array of end character codes for each segment
					for ($k = 0; $k < $segCount; ++$k) {
						$endCount[$k] = $this->_getUSHORT($font, $offset);
					}
					$offset += 2; // skip reservedPad
					$startCount = array(); // array of start character codes for each segment
					for ($k = 0; $k < $segCount; ++$k) {
						$startCount[$k] = $this->_getUSHORT($font, $offset);
					}
					$idDelta = array(); // delta for all character codes in segment
					for ($k = 0; $k < $segCount; ++$k) {
						$idDelta[$k] = $this->_getUSHORT($font, $offset);
					}
					$idRangeOffset = array(); // Offsets into glyphIdArray or 0
					for ($k = 0; $k < $segCount; ++$k) {
						$idRangeOffset[$k] = $this->_getUSHORT($font, $offset);
					}
					$gidlen = ($length / 2) - 8 - (4 * $segCount);
					$glyphIdArray = array(); // glyph index array
					for ($k = 0; $k < $gidlen; ++$k) {
						$glyphIdArray[$k] = $this->_getUSHORT($font, $offset);
					}
					for ($k = 0; $k < $segCount; ++$k) {
						for ($c = $startCount[$k]; $c <= $endCount[$k]; ++$c) {
							if (isset($subsetchars[$c])) {
								if ($idRangeOffset[$k] == 0) {
									$g = $c;
								} else {
									$gid = (($idRangeOffset[$k] / 2) + ($c - $startCount[$k]) - ($segCount - $k));
									$g = $glyphIdArray[$gid];
								}
								$g += ($idDelta[$k] - 65536);
								if ($g < 0) {
									$g = 0;
								}
								$subsetglyphs[$g] = $c;
							}
						}
					}
					break;
				}
				case 6: { // Format 6: Trimmed table mapping
					$offset += 4; // skip length and version/language
					$firstCode = $this->_getUSHORT($font, $offset);
					$entryCount = $this->_getUSHORT($font, $offset);
					for ($k = 0; $k < $entryCount; ++$k) {
						$c = ($k + $firstCode);
						if (isset($subsetchars[$c])) {
							$g = $this->_getUSHORT($font, $offset);
							$subsetglyphs[$g] = $c;
						} else {
							$offset += 2;
						}
					}
					break;
				}
				case 8: { // Format 8: Mixed 16-bit and 32-bit coverage
					$offset += 10; // skip length and version
					// to be implemented ...
					break;
				}
				case 10: { // Format 10: Trimmed array
					$offset += 10; // skip length and version/language
					$startCharCode = $this->_getULONG($font, $offset);
					$numChars = $this->_getULONG($font, $offset);
					for ($k = 0; $k < $numChars; ++$k) {
						$c = ($k + $startCharCode);
						if (isset($subsetchars[$c])) {
							$g = $this->_getUSHORT($font, $offset);
							$subsetglyphs[$g] = $c;
						} else {
							$offset += 2;
						}
					}
					break;
				}
				case 12: { // Format 12: Segmented coverage
					$offset += 10; // skip length and version/language
					$nGroups = $this->_getULONG($font, $offset);
					for ($k = 0; $k < $nGroups; ++$k) {
						$startCharCode = $this->_getULONG($font, $offset);
						$endCharCode = $this->_getULONG($font, $offset);
						$startGlyphCode = $this->_getULONG($font, $offset);
						for ($c = $startCharCode; $c <= $endCharCode; ++$c) {
							if (isset($subsetchars[$c])) {
								$subsetglyphs[$startGlyphCode] = $c;
							}
							++$startGlyphCode;
						}
					}
					break;
				}
			}
		}
		// sort glyphs by key
		ksort($subsetglyphs);
		// add composite glyps to $subsetglyphs and remove missing glyphs
		foreach ($subsetglyphs as $key => $val) {
			if (isset($indexToLoc[$key])) {
				$offset = $table['glyf']['offset'] + $indexToLoc[$key];
				$numberOfContours = $this->_getSHORT($font, $offset);
				if ($numberOfContours < 0) { // composite glyph
					$offset += 8; // skip xMin, yMin, xMax, yMax
					do {
						$flags = $this->_getUSHORT($font, $offset);
						$glyphIndex = $this->_getUSHORT($font, $offset);
						if (!isset($subsetglyphs[$glyphIndex]) AND isset($indexToLoc[$glyphIndex])) {
							// add missing glyphs
							$subsetglyphs[$glyphIndex] = true;
						}
						// skip some bytes by case
						if ($flags & 1) {
							$offset += 4;
						} else {
							$offset += 2;
						}
						if ($flags & 8) {
							$offset += 2;
						} elseif ($flags & 64) {
							$offset += 4;
						} elseif ($flags & 128) {
							$offset += 8;
						}
					} while ($flags & 32);
				}
			} else {
				unset($subsetglyphs[$key]);
			}
		}
		// build new glyf table with only used glyphs
		$glyf = '';
		$glyfSize = 0;
		// create new empty indexToLoc table
		$newIndexToLoc = array_fill(0, count($indexToLoc), 0);
		$goffset = 0;
		foreach ($subsetglyphs as $glyphID => $char) {
			if (isset($indexToLoc[$glyphID]) AND isset($indexToLoc[($glyphID + 1)])) {
				$start = $indexToLoc[$glyphID];
				$length = ($indexToLoc[($glyphID + 1)] - $start);
				$glyf .= substr($font, ($table['glyf']['offset'] + $start), $length);
				$newIndexToLoc[$glyphID] = $goffset;
				$goffset += $length;
			}
		}
		// build new loca table
		$loca = '';
		if ($short_offset) {
			foreach ($newIndexToLoc as $glyphID => $offset) {
				$loca .= pack('n', ($offset / 2));
			}
		} else {
			foreach ($newIndexToLoc as $glyphID => $offset) {
				$loca .= pack('N', $offset);
			}
		}
		// array of table names to preserve (loca and glyf tables will be added later)
		//$table_names = array ('cmap', 'head', 'hhea', 'hmtx', 'maxp', 'name', 'OS/2', 'post', 'cvt ', 'fpgm', 'prep');
		// the cmap table is not needed and shall not be present, since the mapping from character codes to glyph descriptions is provided separately
		$table_names = array ('head', 'hhea', 'hmtx', 'maxp', 'cvt ', 'fpgm', 'prep'); // minimum required table names
		// get the tables to preserve
		$offset = 12;
		foreach ($table as $tag => $val) {
			if (in_array($tag, $table_names)) {
				$table[$tag]['data'] = substr($font, $table[$tag]['offset'], $table[$tag]['length']);
				if ($tag == 'head') {
					// set the checkSumAdjustment to 0
					$table[$tag]['data'] = substr($table[$tag]['data'], 0, 8)."\x0\x0\x0\x0".substr($table[$tag]['data'], 12);
				}
				$pad = 4 - ($table[$tag]['length'] % 4);
				if ($pad != 4) {
					// the length of a table must be a multiple of four bytes
					$table[$tag]['length'] += $pad;
					$table[$tag]['data'] .= str_repeat("\x0", $pad);
				}
				$table[$tag]['offset'] = $offset;
				$offset += $table[$tag]['length'];
				// check sum is not changed (so keep the following line commented)
				//$table[$tag]['checkSum'] = $this->_getTTFtableChecksum($table[$tag]['data'], $table[$tag]['length']);
			} else {
				unset($table[$tag]);
			}
		}
		// add loca
		$table['loca']['data'] = $loca;
		$table['loca']['length'] = strlen($loca);
		$pad = 4 - ($table['loca']['length'] % 4);
		if ($pad != 4) {
			// the length of a table must be a multiple of four bytes
			$table['loca']['length'] += $pad;
			$table['loca']['data'] .= str_repeat("\x0", $pad);
		}
		$table['loca']['offset'] = $offset;
		$table['loca']['checkSum'] = $this->_getTTFtableChecksum($table['loca']['data'], $table['loca']['length']);
		$offset += $table['loca']['length'];
		// add glyf
		$table['glyf']['data'] = $glyf;
		$table['glyf']['length'] = strlen($glyf);
		$pad = 4 - ($table['glyf']['length'] % 4);
		if ($pad != 4) {
			// the length of a table must be a multiple of four bytes
			$table['glyf']['length'] += $pad;
			$table['glyf']['data'] .= str_repeat("\x0", $pad);
		}
		$table['glyf']['offset'] = $offset;
		$table['glyf']['checkSum'] = $this->_getTTFtableChecksum($table['glyf']['data'], $table['glyf']['length']);
		// rebuild font
		$font = '';
		$font .= pack('N', 0x10000); // sfnt version
		$numTables = count($table);
		$font .= pack('n', $numTables); // numTables
		$entrySelector = floor(log($numTables, 2));
		$searchRange = pow(2, $entrySelector) * 16;
		$rangeShift = ($numTables * 16) - $searchRange;
		$font .= pack('n', $searchRange); // searchRange
		$font .= pack('n', $entrySelector); // entrySelector
		$font .= pack('n', $rangeShift); // rangeShift
		$offset = ($numTables * 16);
		foreach ($table as $tag => $data) {
			$font .= $tag; // tag
			$font .= pack('N', $data['checkSum']); // checkSum
			$font .= pack('N', ($data['offset'] + $offset)); // offset
			$font .= pack('N', $data['length']); // length
		}
		foreach ($table as $data) {
			$font .= $data['data'];
		}
		// set checkSumAdjustment on head table
		$checkSumAdjustment = 0xB1B0AFBA - $this->_getTTFtableChecksum($font, strlen($font));
		$font = substr($font, 0, $table['head']['offset'] + 8).pack('N', $checkSumAdjustment).substr($font, $table['head']['offset'] + 12);
		return $font;
	}

	/**
	 * Returs the checksum of a TTF table.
	 * @param string $table table to check
	 * @param int $length lenght of table in bytes
	 * @return int checksum
	 * @author Nicola Asuni
	 * @access protected
	 * @since 5.2.000 (2010-06-02)
	 */
	protected function _getTTFtableChecksum($table, $length) {
		$sum = 0;
		$tlen = ($length / 4);
		$offset = 0;
		for ($i = 0; $i < $tlen; ++$i) {
			$v = unpack('Ni', substr($table, $offset, 4));
			$sum += $v['i'];
			$offset += 4;
		}
		$sum = unpack('Ni', pack('N', $sum));
		return $sum['i'];
	}

	/**
	 * Outputs font widths
	 * @param array $font font data
	 * @param int $cidoffset offset for CID values
	 * @return PDF command string for font widths
	 * @author Nicola Asuni
	 * @access protected
	 * @since 4.4.000 (2008-12-07)
	 */
	protected function _putfontwidths($font, $cidoffset=0) {
		ksort($font['cw']);
		$rangeid = 0;
		$range = array();
		$prevcid = -2;
		$prevwidth = -1;
		$interval = false;
		// for each character
		foreach ($font['cw'] as $cid => $width) {
			$cid -= $cidoffset;
			if ($font['subset'] AND ($cid > 255) AND (!isset($font['subsetchars'][$cid]))) {
				// ignore the unused characters (font subsetting)
				continue;
			}
			if ($width != $font['dw']) {
				if ($cid == ($prevcid + 1)) {
					// consecutive CID
					if ($width == $prevwidth) {
						if ($width == $range[$rangeid][0]) {
							$range[$rangeid][] = $width;
						} else {
							array_pop($range[$rangeid]);
							// new range
							$rangeid = $prevcid;
							$range[$rangeid] = array();
							$range[$rangeid][] = $prevwidth;
							$range[$rangeid][] = $width;
						}
						$interval = true;
						$range[$rangeid]['interval'] = true;
					} else {
						if ($interval) {
							// new range
							$rangeid = $cid;
							$range[$rangeid] = array();
							$range[$rangeid][] = $width;
						} else {
							$range[$rangeid][] = $width;
						}
						$interval = false;
					}
				} else {
					// new range
					$rangeid = $cid;
					$range[$rangeid] = array();
					$range[$rangeid][] = $width;
					$interval = false;
				}
				$prevcid = $cid;
				$prevwidth = $width;
			}
		}
		// optimize ranges
		$prevk = -1;
		$nextk = -1;
		$prevint = false;
		foreach ($range as $k => $ws) {
			$cws = count($ws);
			if (($k == $nextk) AND (!$prevint) AND ((!isset($ws['interval'])) OR ($cws < 4))) {
				if (isset($range[$k]['interval'])) {
					unset($range[$k]['interval']);
				}
				$range[$prevk] = array_merge($range[$prevk], $range[$k]);
				unset($range[$k]);
			} else {
				$prevk = $k;
			}
			$nextk = $k + $cws;
			if (isset($ws['interval'])) {
				if ($cws > 3) {
					$prevint = true;
				} else {
					$prevint = false;
				}
				unset($range[$k]['interval']);
				--$nextk;
			} else {
				$prevint = false;
			}
		}
		// output data
		$w = '';
		foreach ($range as $k => $ws) {
			if (count(array_count_values($ws)) == 1) {
				// interval mode is more compact
				$w .= ' '.$k.' '.($k + count($ws) - 1).' '.$ws[0];
			} else {
				// range mode
				$w .= ' '.$k.' [ '.implode(' ', $ws).' ]';
			}
		}
		return '/W ['.$w.' ]';
	}

	/**
	 * Output fonts.
	 * @author Nicola Asuni
	 * @access protected
	 */
	protected function _putfonts() {
		$nf = $this->n;
		foreach ($this->diffs as $diff) {
			//Encodings
			$this->_newobj();
			$this->_out('<< /Type /Encoding /BaseEncoding /WinAnsiEncoding /Differences ['.$diff.'] >>'."\n".'endobj');
		}
		$mqr = $this->get_mqr();
		$this->set_mqr(false);
		foreach ($this->FontFiles as $file => $info) {
			// search and get font file to embedd
			$fontdir = $info['fontdir'];
			$file = strtolower($file);
			$fontfile = '';
			// search files on various directories
			if (($fontdir !== false) AND file_exists($fontdir.$file)) {
				$fontfile = $fontdir.$file;
			} elseif (file_exists($this->_getfontpath().$file)) {
				$fontfile = $this->_getfontpath().$file;
			} elseif (file_exists($file)) {
				$fontfile = $file;
			}
			if (!$this->empty_string($fontfile)) {
				$font = file_get_contents($fontfile);
				$compressed = (substr($file, -2) == '.z');
				if ((!$compressed) AND (isset($info['length2']))) {
					$header = (ord($font{0}) == 128);
					if ($header) {
						//Strip first binary header
						$font = substr($font, 6);
					}
					if ($header AND (ord($font{$info['length1']}) == 128)) {
						//Strip second binary header
						$font = substr($font, 0, $info['length1']).substr($font, ($info['length1'] + 6));
					}
				} elseif ($info['subset'] AND ((!$compressed) OR ($compressed AND function_exists('gzcompress')))) {
					if ($compressed) {
						// uncompress font
						$font = gzuncompress($font);
					}
					// merge subset characters
					$subsetchars = array(); // used chars
					foreach ($info['fontkeys'] as $fontkey) {
						$fontinfo = $this->getFontBuffer($fontkey);
						$subsetchars += $fontinfo['subsetchars'];
					}
					$font = $this->_getTrueTypeFontSubset($font, $subsetchars);
					if ($compressed) {
						// recompress font
						$font = gzcompress($font);
					}
				}
				$this->_newobj();
				$this->FontFiles[$file]['n'] = $this->n;
				$stream = $this->_getrawstream($font);
				$out = '<< /Length '.strlen($stream);
				if ($compressed) {
					$out .= ' /Filter /FlateDecode';
				}
				$out .= ' /Length1 '.$info['length1'];
				if (isset($info['length2'])) {
					$out .= ' /Length2 '.$info['length2'].' /Length3 0';
				}
				$out .= ' >>';
				$out .= ' stream'."\n".$stream."\n".'endstream';
				$out .= "\n".'endobj';
				$this->_out($out);
			}
		}
		$this->set_mqr($mqr);
		foreach ($this->fontkeys as $k) {
			//Font objects
			$font = $this->getFontBuffer($k);
			$type = $font['type'];
			$name = $font['name'];
			if ($type == 'core') {
				// standard core font
				$out = $this->_getobj($this->font_obj_ids[$k])."\n";
				$out .= '<</Type /Font';
				$out .= ' /Subtype /Type1';
				$out .= ' /BaseFont /'.$name;
				$out .= ' /Name /F'.$font['i'];
				if ((strtolower($name) != 'symbol') AND (strtolower($name) != 'zapfdingbats')) {
					$out .= ' /Encoding /WinAnsiEncoding';
				}
				if ($k == 'helvetica') {
					// add default font for annotations
					$this->annotation_fonts[$k] = $font['i'];
				}
				$out .= ' >>';
				$out .= "\n".'endobj';
				$this->_out($out);
			} elseif (($type == 'Type1') OR ($type == 'TrueType')) {
				// additional Type1 or TrueType font
				$out = $this->_getobj($this->font_obj_ids[$k])."\n";
				$out .= '<</Type /Font';
				$out .= ' /Subtype /'.$type;
				$out .= ' /BaseFont /'.$name;
				$out .= ' /Name /F'.$font['i'];
				$out .= ' /FirstChar 32 /LastChar 255';
				$out .= ' /Widths '.($this->n + 1).' 0 R';
				$out .= ' /FontDescriptor '.($this->n + 2).' 0 R';
				if ($font['enc']) {
					if (isset($font['diff'])) {
						$out .= ' /Encoding '.($nf + $font['diff']).' 0 R';
					} else {
						$out .= ' /Encoding /WinAnsiEncoding';
					}
				}
				$out .= ' >>';
				$out .= "\n".'endobj';
				$this->_out($out);
				// Widths
				$this->_newobj();
				$cw = &$font['cw'];
				$s = '[';
				for ($i = 32; $i < 256; ++$i) {
					$s .= $cw[$i].' ';
				}
				$s .= ']';
				$s .= "\n".'endobj';
				$this->_out($s);
				//Descriptor
				$this->_newobj();
				$s = '<</Type /FontDescriptor /FontName /'.$name;
				foreach ($font['desc'] as $fdk => $fdv) {
					if(is_float($fdv)) {
						$fdv = sprintf('%.3F', $fdv);
					}
					$s .= ' /'.$fdk.' '.$fdv.'';
				}
				if (!$this->empty_string($font['file'])) {
					$s .= ' /FontFile'.($type == 'Type1' ? '' : '2').' '.$this->FontFiles[$font['file']]['n'].' 0 R';
				}
				$s .= '>>';
				$s .= "\n".'endobj';
				$this->_out($s);
			} else {
				// additional types
				$mtd = '_put'.strtolower($type);
				if (!method_exists($this, $mtd)) {
					$this->Error('Unsupported font type: '.$type);
				}
				$this->$mtd($font);
			}
		}
	}

	/**
	 * Adds unicode fonts.<br>
	 * Based on PDF Reference 1.3 (section 5)
	 * @param array $font font data
	 * @access protected
	 * @author Nicola Asuni
	 * @since 1.52.0.TC005 (2005-01-05)
	 */
	protected function _puttruetypeunicode($font) {
		$fontname = '';
		if ($font['subset']) {
			// change name for font subsetting
			$subtag = sprintf('%06u', $font['i']);
			$subtag = strtr($subtag, '0123456789', 'ABCDEFGHIJ');
			$fontname .= $subtag.'+';
		}
		$fontname .= $font['name'];
		// Type0 Font
		// A composite font composed of other fonts, organized hierarchically
		$out = $this->_getobj($this->font_obj_ids[$font['fontkey']])."\n";
		$out .= '<< /Type /Font';
		$out .= ' /Subtype /Type0';
		$out .= ' /BaseFont /'.$fontname;
		$out .= ' /Name /F'.$font['i'];
		$out .= ' /Encoding /'.$font['enc'];
		$out .= ' /ToUnicode '.($this->n + 1).' 0 R';
		$out .= ' /DescendantFonts ['.($this->n + 2).' 0 R]';
		$out .= ' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
		// ToUnicode map for Identity-H
		$stream = "/CIDInit /ProcSet findresource begin\n";
		$stream .= "12 dict begin\n";
		$stream .= "begincmap\n";
		$stream .= "/CIDSystemInfo << /Registry (Adobe) /Ordering (UCS) /Supplement 0 >> def\n";
		$stream .= "/CMapName /Adobe-Identity-UCS def\n";
		$stream .= "/CMapType 2 def\n";
		$stream .= "/WMode 0 def\n";
		$stream .= "1 begincodespacerange\n";
		$stream .= "<0000> <FFFF>\n";
		$stream .= "endcodespacerange\n";
		$stream .= "100 beginbfrange\n";
		$stream .= "<0000> <00ff> <0000>\n";
		$stream .= "<0100> <01ff> <0100>\n";
		$stream .= "<0200> <02ff> <0200>\n";
		$stream .= "<0300> <03ff> <0300>\n";
		$stream .= "<0400> <04ff> <0400>\n";
		$stream .= "<0500> <05ff> <0500>\n";
		$stream .= "<0600> <06ff> <0600>\n";
		$stream .= "<0700> <07ff> <0700>\n";
		$stream .= "<0800> <08ff> <0800>\n";
		$stream .= "<0900> <09ff> <0900>\n";
		$stream .= "<0a00> <0aff> <0a00>\n";
		$stream .= "<0b00> <0bff> <0b00>\n";
		$stream .= "<0c00> <0cff> <0c00>\n";
		$stream .= "<0d00> <0dff> <0d00>\n";
		$stream .= "<0e00> <0eff> <0e00>\n";
		$stream .= "<0f00> <0fff> <0f00>\n";
		$stream .= "<1000> <10ff> <1000>\n";
		$stream .= "<1100> <11ff> <1100>\n";
		$stream .= "<1200> <12ff> <1200>\n";
		$stream .= "<1300> <13ff> <1300>\n";
		$stream .= "<1400> <14ff> <1400>\n";
		$stream .= "<1500> <15ff> <1500>\n";
		$stream .= "<1600> <16ff> <1600>\n";
		$stream .= "<1700> <17ff> <1700>\n";
		$stream .= "<1800> <18ff> <1800>\n";
		$stream .= "<1900> <19ff> <1900>\n";
		$stream .= "<1a00> <1aff> <1a00>\n";
		$stream .= "<1b00> <1bff> <1b00>\n";
		$stream .= "<1c00> <1cff> <1c00>\n";
		$stream .= "<1d00> <1dff> <1d00>\n";
		$stream .= "<1e00> <1eff> <1e00>\n";
		$stream .= "<1f00> <1fff> <1f00>\n";
		$stream .= "<2000> <20ff> <2000>\n";
		$stream .= "<2100> <21ff> <2100>\n";
		$stream .= "<2200> <22ff> <2200>\n";
		$stream .= "<2300> <23ff> <2300>\n";
		$stream .= "<2400> <24ff> <2400>\n";
		$stream .= "<2500> <25ff> <2500>\n";
		$stream .= "<2600> <26ff> <2600>\n";
		$stream .= "<2700> <27ff> <2700>\n";
		$stream .= "<2800> <28ff> <2800>\n";
		$stream .= "<2900> <29ff> <2900>\n";
		$stream .= "<2a00> <2aff> <2a00>\n";
		$stream .= "<2b00> <2bff> <2b00>\n";
		$stream .= "<2c00> <2cff> <2c00>\n";
		$stream .= "<2d00> <2dff> <2d00>\n";
		$stream .= "<2e00> <2eff> <2e00>\n";
		$stream .= "<2f00> <2fff> <2f00>\n";
		$stream .= "<3000> <30ff> <3000>\n";
		$stream .= "<3100> <31ff> <3100>\n";
		$stream .= "<3200> <32ff> <3200>\n";
		$stream .= "<3300> <33ff> <3300>\n";
		$stream .= "<3400> <34ff> <3400>\n";
		$stream .= "<3500> <35ff> <3500>\n";
		$stream .= "<3600> <36ff> <3600>\n";
		$stream .= "<3700> <37ff> <3700>\n";
		$stream .= "<3800> <38ff> <3800>\n";
		$stream .= "<3900> <39ff> <3900>\n";
		$stream .= "<3a00> <3aff> <3a00>\n";
		$stream .= "<3b00> <3bff> <3b00>\n";
		$stream .= "<3c00> <3cff> <3c00>\n";
		$stream .= "<3d00> <3dff> <3d00>\n";
		$stream .= "<3e00> <3eff> <3e00>\n";
		$stream .= "<3f00> <3fff> <3f00>\n";
		$stream .= "<4000> <40ff> <4000>\n";
		$stream .= "<4100> <41ff> <4100>\n";
		$stream .= "<4200> <42ff> <4200>\n";
		$stream .= "<4300> <43ff> <4300>\n";
		$stream .= "<4400> <44ff> <4400>\n";
		$stream .= "<4500> <45ff> <4500>\n";
		$stream .= "<4600> <46ff> <4600>\n";
		$stream .= "<4700> <47ff> <4700>\n";
		$stream .= "<4800> <48ff> <4800>\n";
		$stream .= "<4900> <49ff> <4900>\n";
		$stream .= "<4a00> <4aff> <4a00>\n";
		$stream .= "<4b00> <4bff> <4b00>\n";
		$stream .= "<4c00> <4cff> <4c00>\n";
		$stream .= "<4d00> <4dff> <4d00>\n";
		$stream .= "<4e00> <4eff> <4e00>\n";
		$stream .= "<4f00> <4fff> <4f00>\n";
		$stream .= "<5000> <50ff> <5000>\n";
		$stream .= "<5100> <51ff> <5100>\n";
		$stream .= "<5200> <52ff> <5200>\n";
		$stream .= "<5300> <53ff> <5300>\n";
		$stream .= "<5400> <54ff> <5400>\n";
		$stream .= "<5500> <55ff> <5500>\n";
		$stream .= "<5600> <56ff> <5600>\n";
		$stream .= "<5700> <57ff> <5700>\n";
		$stream .= "<5800> <58ff> <5800>\n";
		$stream .= "<5900> <59ff> <5900>\n";
		$stream .= "<5a00> <5aff> <5a00>\n";
		$stream .= "<5b00> <5bff> <5b00>\n";
		$stream .= "<5c00> <5cff> <5c00>\n";
		$stream .= "<5d00> <5dff> <5d00>\n";
		$stream .= "<5e00> <5eff> <5e00>\n";
		$stream .= "<5f00> <5fff> <5f00>\n";
		$stream .= "<6000> <60ff> <6000>\n";
		$stream .= "<6100> <61ff> <6100>\n";
		$stream .= "<6200> <62ff> <6200>\n";
		$stream .= "<6300> <63ff> <6300>\n";
		$stream .= "endbfrange\n";
		$stream .= "100 beginbfrange\n";
		$stream .= "<6400> <64ff> <6400>\n";
		$stream .= "<6500> <65ff> <6500>\n";
		$stream .= "<6600> <66ff> <6600>\n";
		$stream .= "<6700> <67ff> <6700>\n";
		$stream .= "<6800> <68ff> <6800>\n";
		$stream .= "<6900> <69ff> <6900>\n";
		$stream .= "<6a00> <6aff> <6a00>\n";
		$stream .= "<6b00> <6bff> <6b00>\n";
		$stream .= "<6c00> <6cff> <6c00>\n";
		$stream .= "<6d00> <6dff> <6d00>\n";
		$stream .= "<6e00> <6eff> <6e00>\n";
		$stream .= "<6f00> <6fff> <6f00>\n";
		$stream .= "<7000> <70ff> <7000>\n";
		$stream .= "<7100> <71ff> <7100>\n";
		$stream .= "<7200> <72ff> <7200>\n";
		$stream .= "<7300> <73ff> <7300>\n";
		$stream .= "<7400> <74ff> <7400>\n";
		$stream .= "<7500> <75ff> <7500>\n";
		$stream .= "<7600> <76ff> <7600>\n";
		$stream .= "<7700> <77ff> <7700>\n";
		$stream .= "<7800> <78ff> <7800>\n";
		$stream .= "<7900> <79ff> <7900>\n";
		$stream .= "<7a00> <7aff> <7a00>\n";
		$stream .= "<7b00> <7bff> <7b00>\n";
		$stream .= "<7c00> <7cff> <7c00>\n";
		$stream .= "<7d00> <7dff> <7d00>\n";
		$stream .= "<7e00> <7eff> <7e00>\n";
		$stream .= "<7f00> <7fff> <7f00>\n";
		$stream .= "<8000> <80ff> <8000>\n";
		$stream .= "<8100> <81ff> <8100>\n";
		$stream .= "<8200> <82ff> <8200>\n";
		$stream .= "<8300> <83ff> <8300>\n";
		$stream .= "<8400> <84ff> <8400>\n";
		$stream .= "<8500> <85ff> <8500>\n";
		$stream .= "<8600> <86ff> <8600>\n";
		$stream .= "<8700> <87ff> <8700>\n";
		$stream .= "<8800> <88ff> <8800>\n";
		$stream .= "<8900> <89ff> <8900>\n";
		$stream .= "<8a00> <8aff> <8a00>\n";
		$stream .= "<8b00> <8bff> <8b00>\n";
		$stream .= "<8c00> <8cff> <8c00>\n";
		$stream .= "<8d00> <8dff> <8d00>\n";
		$stream .= "<8e00> <8eff> <8e00>\n";
		$stream .= "<8f00> <8fff> <8f00>\n";
		$stream .= "<9000> <90ff> <9000>\n";
		$stream .= "<9100> <91ff> <9100>\n";
		$stream .= "<9200> <92ff> <9200>\n";
		$stream .= "<9300> <93ff> <9300>\n";
		$stream .= "<9400> <94ff> <9400>\n";
		$stream .= "<9500> <95ff> <9500>\n";
		$stream .= "<9600> <96ff> <9600>\n";
		$stream .= "<9700> <97ff> <9700>\n";
		$stream .= "<9800> <98ff> <9800>\n";
		$stream .= "<9900> <99ff> <9900>\n";
		$stream .= "<9a00> <9aff> <9a00>\n";
		$stream .= "<9b00> <9bff> <9b00>\n";
		$stream .= "<9c00> <9cff> <9c00>\n";
		$stream .= "<9d00> <9dff> <9d00>\n";
		$stream .= "<9e00> <9eff> <9e00>\n";
		$stream .= "<9f00> <9fff> <9f00>\n";
		$stream .= "<a000> <a0ff> <a000>\n";
		$stream .= "<a100> <a1ff> <a100>\n";
		$stream .= "<a200> <a2ff> <a200>\n";
		$stream .= "<a300> <a3ff> <a300>\n";
		$stream .= "<a400> <a4ff> <a400>\n";
		$stream .= "<a500> <a5ff> <a500>\n";
		$stream .= "<a600> <a6ff> <a600>\n";
		$stream .= "<a700> <a7ff> <a700>\n";
		$stream .= "<a800> <a8ff> <a800>\n";
		$stream .= "<a900> <a9ff> <a900>\n";
		$stream .= "<aa00> <aaff> <aa00>\n";
		$stream .= "<ab00> <abff> <ab00>\n";
		$stream .= "<ac00> <acff> <ac00>\n";
		$stream .= "<ad00> <adff> <ad00>\n";
		$stream .= "<ae00> <aeff> <ae00>\n";
		$stream .= "<af00> <afff> <af00>\n";
		$stream .= "<b000> <b0ff> <b000>\n";
		$stream .= "<b100> <b1ff> <b100>\n";
		$stream .= "<b200> <b2ff> <b200>\n";
		$stream .= "<b300> <b3ff> <b300>\n";
		$stream .= "<b400> <b4ff> <b400>\n";
		$stream .= "<b500> <b5ff> <b500>\n";
		$stream .= "<b600> <b6ff> <b600>\n";
		$stream .= "<b700> <b7ff> <b700>\n";
		$stream .= "<b800> <b8ff> <b800>\n";
		$stream .= "<b900> <b9ff> <b900>\n";
		$stream .= "<ba00> <baff> <ba00>\n";
		$stream .= "<bb00> <bbff> <bb00>\n";
		$stream .= "<bc00> <bcff> <bc00>\n";
		$stream .= "<bd00> <bdff> <bd00>\n";
		$stream .= "<be00> <beff> <be00>\n";
		$stream .= "<bf00> <bfff> <bf00>\n";
		$stream .= "<c000> <c0ff> <c000>\n";
		$stream .= "<c100> <c1ff> <c100>\n";
		$stream .= "<c200> <c2ff> <c200>\n";
		$stream .= "<c300> <c3ff> <c300>\n";
		$stream .= "<c400> <c4ff> <c400>\n";
		$stream .= "<c500> <c5ff> <c500>\n";
		$stream .= "<c600> <c6ff> <c600>\n";
		$stream .= "<c700> <c7ff> <c700>\n";
		$stream .= "endbfrange\n";
		$stream .= "56 beginbfrange\n";
		$stream .= "<c800> <c8ff> <c800>\n";
		$stream .= "<c900> <c9ff> <c900>\n";
		$stream .= "<ca00> <caff> <ca00>\n";
		$stream .= "<cb00> <cbff> <cb00>\n";
		$stream .= "<cc00> <ccff> <cc00>\n";
		$stream .= "<cd00> <cdff> <cd00>\n";
		$stream .= "<ce00> <ceff> <ce00>\n";
		$stream .= "<cf00> <cfff> <cf00>\n";
		$stream .= "<d000> <d0ff> <d000>\n";
		$stream .= "<d100> <d1ff> <d100>\n";
		$stream .= "<d200> <d2ff> <d200>\n";
		$stream .= "<d300> <d3ff> <d300>\n";
		$stream .= "<d400> <d4ff> <d400>\n";
		$stream .= "<d500> <d5ff> <d500>\n";
		$stream .= "<d600> <d6ff> <d600>\n";
		$stream .= "<d700> <d7ff> <d700>\n";
		$stream .= "<d800> <d8ff> <d800>\n";
		$stream .= "<d900> <d9ff> <d900>\n";
		$stream .= "<da00> <daff> <da00>\n";
		$stream .= "<db00> <dbff> <db00>\n";
		$stream .= "<dc00> <dcff> <dc00>\n";
		$stream .= "<dd00> <ddff> <dd00>\n";
		$stream .= "<de00> <deff> <de00>\n";
		$stream .= "<df00> <dfff> <df00>\n";
		$stream .= "<e000> <e0ff> <e000>\n";
		$stream .= "<e100> <e1ff> <e100>\n";
		$stream .= "<e200> <e2ff> <e200>\n";
		$stream .= "<e300> <e3ff> <e300>\n";
		$stream .= "<e400> <e4ff> <e400>\n";
		$stream .= "<e500> <e5ff> <e500>\n";
		$stream .= "<e600> <e6ff> <e600>\n";
		$stream .= "<e700> <e7ff> <e700>\n";
		$stream .= "<e800> <e8ff> <e800>\n";
		$stream .= "<e900> <e9ff> <e900>\n";
		$stream .= "<ea00> <eaff> <ea00>\n";
		$stream .= "<eb00> <ebff> <eb00>\n";
		$stream .= "<ec00> <ecff> <ec00>\n";
		$stream .= "<ed00> <edff> <ed00>\n";
		$stream .= "<ee00> <eeff> <ee00>\n";
		$stream .= "<ef00> <efff> <ef00>\n";
		$stream .= "<f000> <f0ff> <f000>\n";
		$stream .= "<f100> <f1ff> <f100>\n";
		$stream .= "<f200> <f2ff> <f200>\n";
		$stream .= "<f300> <f3ff> <f300>\n";
		$stream .= "<f400> <f4ff> <f400>\n";
		$stream .= "<f500> <f5ff> <f500>\n";
		$stream .= "<f600> <f6ff> <f600>\n";
		$stream .= "<f700> <f7ff> <f700>\n";
		$stream .= "<f800> <f8ff> <f800>\n";
		$stream .= "<f900> <f9ff> <f900>\n";
		$stream .= "<fa00> <faff> <fa00>\n";
		$stream .= "<fb00> <fbff> <fb00>\n";
		$stream .= "<fc00> <fcff> <fc00>\n";
		$stream .= "<fd00> <fdff> <fd00>\n";
		$stream .= "<fe00> <feff> <fe00>\n";
		$stream .= "<ff00> <ffff> <ff00>\n";
		$stream .= "endbfrange\n";
		$stream .= "endcmap\n";
		$stream .= "CMapName currentdict /CMap defineresource pop\n";
		$stream .= "end\n";
		$stream .= "end";
		// ToUnicode Object
		$this->_newobj();
		$stream = ($this->compress) ? gzcompress($stream) : $stream;
		$filter = ($this->compress) ? '/Filter /FlateDecode ' : '';
		$stream = $this->_getrawstream($stream);
		$this->_out('<<'.$filter.'/Length '.strlen($stream).'>> stream'."\n".$stream."\n".'endstream'."\n".'endobj');
		// CIDFontType2
		// A CIDFont whose glyph descriptions are based on TrueType font technology
		$oid = $this->_newobj();
		$out = '<< /Type /Font';
		$out .= ' /Subtype /CIDFontType2';
		$out .= ' /BaseFont /'.$fontname;
		// A dictionary containing entries that define the character collection of the CIDFont.
		$cidinfo = '/Registry '.$this->_datastring($font['cidinfo']['Registry'], $oid);
		$cidinfo .= ' /Ordering '.$this->_datastring($font['cidinfo']['Ordering'], $oid);
		$cidinfo .= ' /Supplement '.$font['cidinfo']['Supplement'];
		$out .= ' /CIDSystemInfo << '.$cidinfo.' >>';
		$out .= ' /FontDescriptor '.($this->n + 1).' 0 R';
		$out .= ' /DW '.$font['dw']; // default width
		$out .= "\n".$this->_putfontwidths($font, 0);
		if (isset($font['ctg']) AND (!$this->empty_string($font['ctg']))) {
			$out .= "\n".'/CIDToGIDMap '.($this->n + 2).' 0 R';
		}
		$out .= ' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
		// Font descriptor
		// A font descriptor describing the CIDFont default metrics other than its glyph widths
		$this->_newobj();
		$out = '<< /Type /FontDescriptor';
		$out .= ' /FontName /'.$fontname;
		foreach ($font['desc'] as $key => $value) {
			if(is_float($value)) {
				$value = sprintf('%.3F', $value);
			}
			$out .= ' /'.$key.' '.$value;
		}
		$fontdir = false;
		if (!$this->empty_string($font['file'])) {
			// A stream containing a TrueType font
			$out .= ' /FontFile2 '.$this->FontFiles[$font['file']]['n'].' 0 R';
			$fontdir = $this->FontFiles[$font['file']]['fontdir'];
		}
		$out .= ' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
		if (isset($font['ctg']) AND (!$this->empty_string($font['ctg']))) {
			$this->_newobj();
			// Embed CIDToGIDMap
			// A specification of the mapping from CIDs to glyph indices
			// search and get CTG font file to embedd
			$ctgfile = strtolower($font['ctg']);
			// search and get ctg font file to embedd
			$fontfile = '';
			// search files on various directories
			if (($fontdir !== false) AND file_exists($fontdir.$ctgfile)) {
				$fontfile = $fontdir.$ctgfile;
			} elseif (file_exists($this->_getfontpath().$ctgfile)) {
				$fontfile = $this->_getfontpath().$ctgfile;
			} elseif (file_exists($ctgfile)) {
				$fontfile = $ctgfile;
			}
			if ($this->empty_string($fontfile)) {
				$this->Error('Font file not found: '.$ctgfile);
			}
			$stream = $this->_getrawstream(file_get_contents($fontfile));
			$out = '<< /Length '.strlen($stream).'';
			if (substr($fontfile, -2) == '.z') { // check file extension
				// Decompresses data encoded using the public-domain
				// zlib/deflate compression method, reproducing the
				// original text or binary data
				$out .= ' /Filter /FlateDecode';
			}
			$out .= ' >>';
			$out .= ' stream'."\n".$stream."\n".'endstream';
			$out .= "\n".'endobj';
			$this->_out($out);
		}
	}

	/**
	 * Output CID-0 fonts.
	 * A Type 0 CIDFont contains glyph descriptions based on the Adobe Type 1 font format
	 * @param array $font font data
	 * @access protected
	 * @author Andrew Whitehead, Nicola Asuni, Yukihiro Nakadaira
	 * @since 3.2.000 (2008-06-23)
	 */
	protected function _putcidfont0($font) {
		$cidoffset = 0;
		if (!isset($font['cw'][1])) {
			$cidoffset = 31;
		}
		if (isset($font['cidinfo']['uni2cid'])) {
			// convert unicode to cid.
			$uni2cid = $font['cidinfo']['uni2cid'];
			$cw = array();
			foreach ($font['cw'] as $uni => $width) {
				if (isset($uni2cid[$uni])) {
					$cw[($uni2cid[$uni] + $cidoffset)] = $width;
				} elseif ($uni < 256) {
					$cw[$uni] = $width;
				} // else unknown character
			}
			$font = array_merge($font, array('cw' => $cw));
		}
		$name = $font['name'];
		$enc = $font['enc'];
		if ($enc) {
			$longname = $name.'-'.$enc;
		} else {
			$longname = $name;
		}
		$out = $this->_getobj($this->font_obj_ids[$font['fontkey']])."\n";
		$out .= '<</Type /Font';
		$out .= ' /Subtype /Type0';
		$out .= ' /BaseFont /'.$longname;
		$out .= ' /Name /F'.$font['i'];
		if ($enc) {
			$out .= ' /Encoding /'.$enc;
		}
		$out .= ' /DescendantFonts ['.($this->n + 1).' 0 R]';
		$out .= ' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
		$oid = $this->_newobj();
		$out = '<</Type /Font';
		$out .= ' /Subtype /CIDFontType0';
		$out .= ' /BaseFont /'.$name;
		$cidinfo = '/Registry '.$this->_datastring($font['cidinfo']['Registry'], $oid);
		$cidinfo .= ' /Ordering '.$this->_datastring($font['cidinfo']['Ordering'], $oid);
		$cidinfo .= ' /Supplement '.$font['cidinfo']['Supplement'];
		$out .= ' /CIDSystemInfo <<'.$cidinfo.'>>';
		$out .= ' /FontDescriptor '.($this->n + 1).' 0 R';
		$out .= ' /DW '.$font['dw'];
		$out .= "\n".$this->_putfontwidths($font, $cidoffset);
		$out .= ' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
		$this->_newobj();
		$s = '<</Type /FontDescriptor /FontName /'.$name;
		foreach ($font['desc'] as $k => $v) {
			if ($k != 'Style') {
				if(is_float($v)) {
					$v = sprintf('%.3F', $v);
				}
				$s .= ' /'.$k.' '.$v.'';
			}
		}
		$s .= '>>';
		$s .= "\n".'endobj';
		$this->_out($s);
	}

	/**
	 * Output images.
	 * @access protected
	 */
	protected function _putimages() {
		$filter = ($this->compress) ? '/Filter /FlateDecode ' : '';
		foreach ($this->imagekeys as $file) {
			$info = $this->getImageBuffer($file);
			$oid = $this->_newobj();
			$this->xobjects['I'.$info['i']] = array('n' => $oid);
			$this->setImageSubBuffer($file, 'n', $this->n);
			$out = '<</Type /XObject';
			$out .= ' /Subtype /Image';
			$out .= ' /Width '.$info['w'];
			$out .= ' /Height '.$info['h'];
			if (array_key_exists('masked', $info)) {
				$out .= ' /SMask '.($this->n - 1).' 0 R';
			}
			if ($info['cs'] == 'Indexed') {
				$out .= ' /ColorSpace [/Indexed /DeviceRGB '.((strlen($info['pal']) / 3) - 1).' '.($this->n + 1).' 0 R]';
			} else {
				$out .= ' /ColorSpace /'.$info['cs'];
				if ($info['cs'] == 'DeviceCMYK') {
					$out .= ' /Decode [1 0 1 0 1 0 1 0]';
				}
			}
			$out .= ' /BitsPerComponent '.$info['bpc'];
			if (isset($info['f'])) {
				$out .= ' /Filter /'.$info['f'];
			}
			if (isset($info['parms'])) {
				$out .= ' '.$info['parms'];
			}
			if (isset($info['trns']) AND is_array($info['trns'])) {
				$trns='';
				$count_info = count($info['trns']);
				for ($i=0; $i < $count_info; ++$i) {
					$trns .= $info['trns'][$i].' '.$info['trns'][$i].' ';
				}
				$out .= ' /Mask ['.$trns.']';
			}
			$stream = $this->_getrawstream($info['data']);
			$out .= ' /Length '.strlen($stream).' >>';
			$out .= ' stream'."\n".$stream."\n".'endstream';
			$out .= "\n".'endobj';
			$this->_out($out);
			//Palette
			if ($info['cs'] == 'Indexed') {
				$this->_newobj();
				$pal = ($this->compress) ? gzcompress($info['pal']) : $info['pal'];
				$pal = $this->_getrawstream($pal);
				$this->_out('<<'.$filter.'/Length '.strlen($pal).'>> stream'."\n".$pal."\n".'endstream'."\n".'endobj');
			}
		}
	}

	/**
	 * Output Form XObjects Templates.
	 * @author Nicola Asuni
	 * @since 5.8.017 (2010-08-24)
	 * @access protected
	 * @see startTemplate(), endTemplate(), printTemplate()
	 */
	protected function _putxobjects() {
		foreach ($this->xobjects as $key => $data) {
			if (isset($data['outdata'])) {
				$stream = trim($data['outdata']);
				$out = $this->_getobj($data['n'])."\n";
				$out .= '<<';
				$out .= ' /Type /XObject';
				$out .= ' /Subtype /Form';
				$out .= ' /FormType 1';
				if ($this->compress) {
					$stream = gzcompress($stream);
					$out .= ' /Filter /FlateDecode';
				}
				$out .= sprintf(' /BBox [%.2F %.2F %.2F %.2F]', ($data['x'] * $this->k), (-$data['y'] * $this->k), (($data['w'] + $data['x']) * $this->k), (($data['h'] - $data['y']) * $this->k));
				$out .= ' /Matrix [1 0 0 1 0 0]';
				$out .= ' /Resources <<';
				$out .= ' /ProcSet [/PDF /Text /ImageB /ImageC /ImageI]';
				// fonts
				if (!empty($data['fonts'])) {
					$out .= ' /Font <<';
					foreach ($data['fonts'] as $fontkey => $fontid) {
						$out .= ' /F'.$fontid.' '.$this->font_obj_ids[$fontkey].' 0 R';
					}
					$out .= ' >>';
				}
				// images or nested xobjects
				if (!empty($data['images']) OR !empty($data['xobjects'])) {
					$out .= ' /XObject <<';
					foreach ($data['images'] as $imgid) {
						$out .= ' /I'.$imgid.' '.$this->xobjects['I'.$imgid]['n'].' 0 R';
					}
					foreach ($data['xobjects'] as $sub_id => $sub_objid) {
						$out .= ' /'.$sub_id.' '.$sub_objid['n'].' 0 R';
					}
					$out .= ' >>';
				}
				$out .= ' >>';
				$stream = $this->_getrawstream($stream);
				$out .= ' /Length '.strlen($stream);
				$out .= ' >>';
				$out .= ' stream'."\n".$stream."\n".'endstream';
				$out .= "\n".'endobj';
				$this->_out($out);
			}
		}
	}

	/**
	 * Output Spot Colors Resources.
	 * @access protected
	 * @since 4.0.024 (2008-09-12)
	 */
	protected function _putspotcolors() {
		foreach ($this->spot_colors as $name => $color) {
			$this->_newobj();
			$this->spot_colors[$name]['n'] = $this->n;
			$out = '[/Separation /'.str_replace(' ', '#20', $name);
			$out .= ' /DeviceCMYK <<';
			$out .= ' /Range [0 1 0 1 0 1 0 1] /C0 [0 0 0 0]';
			$out .= ' '.sprintf('/C1 [%.4F %.4F %.4F %.4F] ', $color['c']/100, $color['m']/100, $color['y']/100, $color['k']/100);
			$out .= ' /FunctionType 2 /Domain [0 1] /N 1>>]';
			$out .= "\n".'endobj';
			$this->_out($out);
		}
	}

	/**
	 * Return XObjects Dictionary.
	 * @return string XObjects dictionary
	 * @access protected
	 * @since 5.8.014 (2010-08-23)
	 */
	protected function _getxobjectdict() {
		$out = '';
		foreach ($this->xobjects as $id => $objid) {
			$out .= ' /'.$id.' '.$objid['n'].' 0 R';
		}
		return $out;
	}

	/**
	 * Output Resources Dictionary.
	 * @access protected
	 */
	protected function _putresourcedict() {
		$out = $this->_getobj(2)."\n";
		$out .= '<< /ProcSet [/PDF /Text /ImageB /ImageC /ImageI]';
		$out .= ' /Font <<';
		foreach ($this->fontkeys as $fontkey) {
			$font = $this->getFontBuffer($fontkey);
			$out .= ' /F'.$font['i'].' '.$font['n'].' 0 R';
		}
		$out .= ' >>';
		$out .= ' /XObject <<';
		$out .= $this->_getxobjectdict();
		$out .= ' >>';
		// visibility
		$out .= ' /Properties <</OC1 '.$this->n_ocg_print.' 0 R /OC2 '.$this->n_ocg_view.' 0 R>>';
		// transparency
		$out .= ' /ExtGState <<';
		foreach ($this->extgstates as $k => $extgstate) {
			if (isset($extgstate['name'])) {
				$out .= ' /'.$extgstate['name'];
			} else {
				$out .= ' /GS'.$k;
			}
			$out .= ' '.$extgstate['n'].' 0 R';
		}
		$out .= ' >>';
		// gradient patterns
		if (isset($this->gradients) AND (count($this->gradients) > 0)) {
			$out .= ' /Pattern <<';
			foreach ($this->gradients as $id => $grad) {
				$out .= ' /p'.$id.' '.$grad['pattern'].' 0 R';
			}
			$out .= ' >>';
		}
		// gradient shadings
		if (isset($this->gradients) AND (count($this->gradients) > 0)) {
			$out .= ' /Shading <<';
			foreach ($this->gradients as $id => $grad) {
				$out .= ' /Sh'.$id.' '.$grad['id'].' 0 R';
			}
			$out .= ' >>';
		}
		// spot colors
		if (isset($this->spot_colors) AND (count($this->spot_colors) > 0)) {
			$out .= ' /ColorSpace <<';
			foreach ($this->spot_colors as $color) {
				$out .= ' /CS'.$color['i'].' '.$color['n'].' 0 R';
			}
			$out .= ' >>';
		}
		$out .= ' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
	}

	/**
	 * Output Resources.
	 * @access protected
	 */
	protected function _putresources() {
		$this->_putextgstates();
		$this->_putocg();
		$this->_putfonts();
		$this->_putimages();
		$this->_putxobjects();
		$this->_putspotcolors();
		$this->_putshaders();
		$this->_putresourcedict();
		$this->_putbookmarks();
		$this->_putEmbeddedFiles();
		$this->_putannotsobjs();
		$this->_putjavascript();
		$this->_putencryption();
	}

	/**
	 * Adds some Metadata information (Document Information Dictionary)
	 * (see Chapter 14.3.3 Document Information Dictionary of PDF32000_2008.pdf Reference)
	 * @return int object id
	 * @access protected
	 */
	protected function _putinfo() {
		$oid = $this->_newobj();
		$out = '<<';
		if (!$this->empty_string($this->title)) {
			// The document's title.
			$out .= ' /Title '.$this->_textstring($this->title, $oid);
		}
		if (!$this->empty_string($this->author)) {
			// The name of the person who created the document.
			$out .= ' /Author '.$this->_textstring($this->author, $oid);
		}
		if (!$this->empty_string($this->subject)) {
			// The subject of the document.
			$out .= ' /Subject '.$this->_textstring($this->subject, $oid);
		}
		if (!$this->empty_string($this->keywords)) {
			// Keywords associated with the document.
			$out .= ' /Keywords '.$this->_textstring($this->keywords.' TCP'.'DF', $oid);
		}
		if (!$this->empty_string($this->creator)) {
			// If the document was converted to PDF from another format, the name of the conforming product that created the original document from which it was converted.
			$out .= ' /Creator '.$this->_textstring($this->creator, $oid);
		}
		if (defined('PDF_PRODUCER')) {
			// If the document was converted to PDF from another format, the name of the conforming product that converted it to PDF.
			$out .= ' /Producer '.$this->_textstring(PDF_PRODUCER.' (TCP'.'DF)', $oid);
		} else {
			// default producer
			$out .= ' /Producer '.$this->_textstring('TCP'.'DF', $oid);
		}
		// The date and time the document was created, in human-readable form
		$out .= ' /CreationDate '.$this->_datestring();
		// The date and time the document was most recently modified, in human-readable form
		$out .= ' /ModDate '.$this->_datestring();
		// A name object indicating whether the document has been modified to include trapping information
		$out .= ' /Trapped /False';
		$out .= ' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
		return $oid;
	}

	/**
	 * Output Catalog.
	 * @return int object id
	 * @access protected
	 */
	protected function _putcatalog() {
		$oid = $this->_newobj();
		$out = '<< /Type /Catalog';
		$out .= ' /Pages 1 0 R';
		if ($this->ZoomMode == 'fullpage') {
			$out .= ' /OpenAction ['.$this->page_obj_id[1].' 0 R /Fit]';
		} elseif ($this->ZoomMode == 'fullwidth') {
			$out .= ' /OpenAction ['.$this->page_obj_id[1].' 0 R /FitH null]';
		} elseif ($this->ZoomMode == 'real') {
			$out .= ' /OpenAction ['.$this->page_obj_id[1].' 0 R /XYZ null null 1]';
		} elseif (!is_string($this->ZoomMode)) {
			$out .= sprintf(' /OpenAction ['.$this->page_obj_id[1].' 0 R /XYZ null null %.2F]',($this->ZoomMode / 100));
		}
		if (isset($this->LayoutMode) AND (!$this->empty_string($this->LayoutMode))) {
			$out .= ' /PageLayout /'.$this->LayoutMode;
		}
		if (isset($this->PageMode) AND (!$this->empty_string($this->PageMode))) {
			$out .= ' /PageMode /'.$this->PageMode;
		}
		if (isset($this->l['a_meta_language'])) {
			$out .= ' /Lang '.$this->_textstring($this->l['a_meta_language'], $oid);
		}
		$out .= ' /Names <<';
		if ((!empty($this->javascript)) OR (!empty($this->js_objects))) {
			$out .= ' /JavaScript '.($this->n_js).' 0 R';
		}
		$out .= ' >>';
		if (count($this->outlines) > 0) {
			$out .= ' /Outlines '.$this->OutlineRoot.' 0 R';
			$out .= ' /PageMode /UseOutlines';
		}
		$out .= ' '.$this->_putviewerpreferences();
		$p = $this->n_ocg_print.' 0 R';
		$v = $this->n_ocg_view.' 0 R';
		$as = '<< /Event /Print /OCGs ['.$p.' '.$v.'] /Category [/Print] >> << /Event /View /OCGs ['.$p.' '.$v.'] /Category [/View] >>';
		$out .= ' /OCProperties << /OCGs ['.$p.' '.$v.'] /D << /ON ['.$p.'] /OFF ['.$v.'] /AS ['.$as.'] >> >>';
		// AcroForm
		if (!empty($this->form_obj_id) OR ($this->sign AND isset($this->signature_data['cert_type']))) {
			$out .= ' /AcroForm <<';
			$objrefs = '';
			if ($this->sign AND isset($this->signature_data['cert_type'])) {
				$objrefs .= $this->sig_obj_id.' 0 R';
			}
			if (!empty($this->form_obj_id)) {
				foreach($this->form_obj_id as $objid) {
					$objrefs .= ' '.$objid.' 0 R';
				}
			}
			$out .= ' /Fields ['.$objrefs.']';
			if (!empty($this->form_obj_id) AND !$this->sign) {
				// It's better to turn off this value and set the appearance stream for each annotation (/AP) to avoid conflicts with signature fields.
				$out .= ' /NeedAppearances true';
			}
			if ($this->sign AND isset($this->signature_data['cert_type'])) {
				if ($this->signature_data['cert_type'] > 0) {
					$out .= ' /SigFlags 3';
				} else {
					$out .= ' /SigFlags 1';
				}
			}
			//$out .= ' /CO ';
			if (isset($this->annotation_fonts) AND !empty($this->annotation_fonts)) {
				$out .= ' /DR <<';
				$out .= ' /Font <<';
				foreach ($this->annotation_fonts as $fontkey => $fontid) {
					$out .= ' /F'.$fontid.' '.$this->font_obj_ids[$fontkey].' 0 R';
				}
				$out .= ' >> >>';
			}
			$font = $this->getFontBuffer('helvetica');
			$out .= ' /DA (/F'.$font['i'].' 0 Tf 0 g)';
			$out .= ' /Q '.(($this->rtl)?'2':'0');
			//$out .= ' /XFA ';
			$out .= ' >>';
			// signatures
			if ($this->sign AND isset($this->signature_data['cert_type'])) {
				if ($this->signature_data['cert_type'] > 0) {
					$out .= ' /Perms << /DocMDP '.($this->sig_obj_id + 1).' 0 R >>';
				} else {
					$out .= ' /Perms << /UR3 '.($this->sig_obj_id + 1).' 0 R >>';
				}
			}
		}
		$out .= ' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
		return $oid;
	}

	/**
	 * Output viewer preferences.
	 * @return string for viewer preferences
	 * @author Nicola asuni
	 * @since 3.1.000 (2008-06-09)
	 * @access protected
	 */
	protected function _putviewerpreferences() {
		$out = '/ViewerPreferences <<';
		if ($this->rtl) {
			$out .= ' /Direction /R2L';
		} else {
			$out .= ' /Direction /L2R';
		}
		if (isset($this->viewer_preferences['HideToolbar']) AND ($this->viewer_preferences['HideToolbar'])) {
			$out .= ' /HideToolbar true';
		}
		if (isset($this->viewer_preferences['HideMenubar']) AND ($this->viewer_preferences['HideMenubar'])) {
			$out .= ' /HideMenubar true';
		}
		if (isset($this->viewer_preferences['HideWindowUI']) AND ($this->viewer_preferences['HideWindowUI'])) {
			$out .= ' /HideWindowUI true';
		}
		if (isset($this->viewer_preferences['FitWindow']) AND ($this->viewer_preferences['FitWindow'])) {
			$out .= ' /FitWindow true';
		}
		if (isset($this->viewer_preferences['CenterWindow']) AND ($this->viewer_preferences['CenterWindow'])) {
			$out .= ' /CenterWindow true';
		}
		if (isset($this->viewer_preferences['DisplayDocTitle']) AND ($this->viewer_preferences['DisplayDocTitle'])) {
			$out .= ' /DisplayDocTitle true';
		}
		if (isset($this->viewer_preferences['NonFullScreenPageMode'])) {
			$out .= ' /NonFullScreenPageMode /'.$this->viewer_preferences['NonFullScreenPageMode'];
		}
		if (isset($this->viewer_preferences['ViewArea'])) {
			$out .= ' /ViewArea /'.$this->viewer_preferences['ViewArea'];
		}
		if (isset($this->viewer_preferences['ViewClip'])) {
			$out .= ' /ViewClip /'.$this->viewer_preferences['ViewClip'];
		}
		if (isset($this->viewer_preferences['PrintArea'])) {
			$out .= ' /PrintArea /'.$this->viewer_preferences['PrintArea'];
		}
		if (isset($this->viewer_preferences['PrintClip'])) {
			$out .= ' /PrintClip /'.$this->viewer_preferences['PrintClip'];
		}
		if (isset($this->viewer_preferences['PrintScaling'])) {
			$out .= ' /PrintScaling /'.$this->viewer_preferences['PrintScaling'];
		}
		if (isset($this->viewer_preferences['Duplex']) AND (!$this->empty_string($this->viewer_preferences['Duplex']))) {
			$out .= ' /Duplex /'.$this->viewer_preferences['Duplex'];
		}
		if (isset($this->viewer_preferences['PickTrayByPDFSize'])) {
			if ($this->viewer_preferences['PickTrayByPDFSize']) {
				$out .= ' /PickTrayByPDFSize true';
			} else {
				$out .= ' /PickTrayByPDFSize false';
			}
		}
		if (isset($this->viewer_preferences['PrintPageRange'])) {
			$PrintPageRangeNum = '';
			foreach ($this->viewer_preferences['PrintPageRange'] as $k => $v) {
				$PrintPageRangeNum .= ' '.($v - 1).'';
			}
			$out .= ' /PrintPageRange ['.substr($PrintPageRangeNum,1).']';
		}
		if (isset($this->viewer_preferences['NumCopies'])) {
			$out .= ' /NumCopies '.intval($this->viewer_preferences['NumCopies']);
		}
		$out .= ' >>';
		return $out;
	}

	/**
	 * Output PDF header.
	 * @access protected
	 */
	protected function _putheader() {
		$this->_out('%PDF-'.$this->PDFVersion);
	}

	/**
	 * Output end of document (EOF).
	 * @access protected
	 */
	protected function _enddoc() {
		$this->state = 1;
		$this->_putheader();
		$this->_putpages();
		$this->_putresources();
		// Signature
		if ($this->sign AND isset($this->signature_data['cert_type'])) {
			// widget annotation for signature
			$out = $this->_getobj($this->sig_obj_id)."\n";
			$out .= '<< /Type /Annot';
			$out .= ' /Subtype /Widget';
			$out .= ' /Rect ['.$this->signature_appearance['rect'].']';
			$out .= ' /P '.$this->page_obj_id[($this->signature_appearance['page'])].' 0 R'; // link to signature appearance page
			$out .= ' /F 4';
			$out .= ' /FT /Sig';
			$out .= ' /T '.$this->_textstring('Signature', $this->sig_obj_id);
			$out .= ' /Ff 0';
			$out .= ' /V '.($this->sig_obj_id + 1).' 0 R';
			$out .= ' >>';
			$out .= "\n".'endobj';
			$this->_out($out);
			// signature
			$this->_putsignature();
		}
		// Info
		$objid_info = $this->_putinfo();
		// Catalog
		$objid_catalog = $this->_putcatalog();
		// Cross-ref
		$o = $this->bufferlen;
		// XREF section
		$this->_out('xref');
		$this->_out('0 '.($this->n + 1));
		$this->_out('0000000000 65535 f ');
		for ($i=1; $i <= $this->n; ++$i) {
			$this->_out(sprintf('%010d 00000 n ', $this->offsets[$i]));
		}
		// TRAILER
		$out = 'trailer <<';
		$out .= ' /Size '.($this->n + 1);
		$out .= ' /Root '.$objid_catalog.' 0 R';
		$out .= ' /Info '.$objid_info.' 0 R';
		if ($this->encrypted) {
			$out .= ' /Encrypt '.$this->encryptdata['objid'].' 0 R';
		}
		$out .= ' /ID [ <'.$this->file_id.'> <'.$this->file_id.'> ]';
		$out .= ' >>';
		$this->_out($out);
		$this->_out('startxref');
		$this->_out($o);
		$this->_out('%%EOF');
		$this->state = 3; // end-of-doc
		if ($this->diskcache) {
			// remove temporary files used for images
			foreach ($this->imagekeys as $key) {
				// remove temporary files
				unlink($this->images[$key]);
			}
			foreach ($this->fontkeys as $key) {
				// remove temporary files
				unlink($this->fonts[$key]);
			}
		}
	}

	/**
	 * Initialize a new page.
	 * @param string $orientation page orientation. Possible values are (case insensitive):<ul><li>P or PORTRAIT (default)</li><li>L or LANDSCAPE</li></ul>
	 * @param mixed $format The format used for pages. It can be either: one of the string values specified at getPageSizeFromFormat() or an array of parameters specified at setPageFormat().
	 * @access protected
	 * @see getPageSizeFromFormat(), setPageFormat()
	 */
	protected function _beginpage($orientation='', $format='') {
		++$this->page;
		$this->setPageBuffer($this->page, '');
		// initialize array for graphics tranformation positions inside a page buffer
		$this->transfmrk[$this->page] = array();
		$this->state = 2;
		if ($this->empty_string($orientation)) {
			if (isset($this->CurOrientation)) {
				$orientation = $this->CurOrientation;
			} elseif ($this->fwPt > $this->fhPt) {
				// landscape
				$orientation = 'L';
			} else {
				// portrait
				$orientation = 'P';
			}
		}
		if ($this->empty_string($format)) {
			$this->pagedim[$this->page] = $this->pagedim[($this->page - 1)];
			$this->setPageOrientation($orientation);
		} else {
			$this->setPageFormat($format, $orientation);
		}
		if ($this->rtl) {
			$this->x = $this->w - $this->rMargin;
		} else {
			$this->x = $this->lMargin;
		}
		$this->y = $this->tMargin;
		if (isset($this->newpagegroup[$this->page])) {
			// start a new group
			$n = sizeof($this->pagegroups) + 1;
			$alias = '{nb'.$n.'}';
			$this->pagegroups[$alias] = 1;
			$this->currpagegroup = $alias;
		} elseif ($this->currpagegroup) {
			++$this->pagegroups[$this->currpagegroup];
		}
	}

	/**
	 * Mark end of page.
	 * @access protected
	 */
	protected function _endpage() {
		$this->setVisibility('all');
		$this->state = 1;
	}

	/**
	 * Begin a new object and return the object number.
	 * @return int object number
	 * @access protected
	 */
	protected function _newobj() {
		$this->_out($this->_getobj());
		return $this->n;
	}

	/**
	 * Return the starting object string for the selected object ID.
	 * @param int $objid Object ID (leave empty to get a new ID).
	 * @return string the starting object string
	 * @access protected
	 * @since 5.8.009 (2010-08-20)
	 */
	protected function _getobj($objid='') {
		if ($objid === '') {
			++$this->n;
			$objid = $this->n;
		}
		$this->offsets[$objid] = $this->bufferlen;
		return $objid.' 0 obj';
	}

	/**
	 * Underline text.
	 * @param int $x X coordinate
	 * @param int $y Y coordinate
	 * @param string $txt text to underline
	 * @access protected
	 */
	protected function _dounderline($x, $y, $txt) {
		$w = $this->GetStringWidth($txt);
		return $this->_dounderlinew($x, $y, $w);
	}

	/**
	 * Underline for rectangular text area.
	 * @param int $x X coordinate
	 * @param int $y Y coordinate
	 * @param int $w width to underline
	 * @access protected
	 * @since 4.8.008 (2009-09-29)
	 */
	protected function _dounderlinew($x, $y, $w) {
		$linew = - $this->CurrentFont['ut'] / 1000 * $this->FontSizePt;
		return sprintf('%.2F %.2F %.2F %.2F re f', $x * $this->k, ((($this->h - $y) * $this->k) + $linew), $w * $this->k, $linew);
	}

	/**
	 * Line through text.
	 * @param int $x X coordinate
	 * @param int $y Y coordinate
	 * @param string $txt text to linethrough
	 * @access protected
	 */
	protected function _dolinethrough($x, $y, $txt) {
		$w = $this->GetStringWidth($txt);
		return $this->_dolinethroughw($x, $y, $w);
	}

	/**
	 * Line through for rectangular text area.
	 * @param int $x X coordinate
	 * @param int $y Y coordinate
	 * @param string $txt text to linethrough
	 * @access protected
	 * @since 4.9.008 (2009-09-29)
	 */
	protected function _dolinethroughw($x, $y, $w) {
		$linew = - $this->CurrentFont['ut'] / 1000 * $this->FontSizePt;
		return sprintf('%.2F %.2F %.2F %.2F re f', $x * $this->k, ((($this->h - $y) * $this->k) + $linew + ($this->FontSizePt / 3)), $w * $this->k, $linew);
	}

	/**
	 * Overline text.
	 * @param int $x X coordinate
	 * @param int $y Y coordinate
	 * @param string $txt text to overline
	 * @access protected
	 * @since 4.9.015 (2010-04-19)
	 */
	protected function _dooverline($x, $y, $txt) {
		$w = $this->GetStringWidth($txt);
		return $this->_dooverlinew($x, $y, $w);
	}

	/**
	 * Overline for rectangular text area.
	 * @param int $x X coordinate
	 * @param int $y Y coordinate
	 * @param int $w width to overline
	 * @access protected
	 * @since 4.9.015 (2010-04-19)
	 */
	protected function _dooverlinew($x, $y, $w) {
		$linew = - $this->CurrentFont['ut'] / 1000 * $this->FontSizePt;
		return sprintf('%.2F %.2F %.2F %.2F re f', $x * $this->k, (($this->h - $y + $this->FontAscent) * $this->k) - $linew, $w * $this->k, $linew);

	}

	/**
	 * Read a 4-byte (32 bit) integer from file.
	 * @param string $f file name.
	 * @return 4-byte integer
	 * @access protected
	 */
	protected function _freadint($f) {
		$a = unpack('Ni', fread($f, 4));
		return $a['i'];
	}

	/**
	 * Add "\" before "\", "(" and ")"
	 * @param string $s string to escape.
	 * @return string escaped string.
	 * @access protected
	 */
	protected function _escape($s) {
		// the chr(13) substitution fixes the Bugs item #1421290.
		return strtr($s, array(')' => '\\)', '(' => '\\(', '\\' => '\\\\', chr(13) => '\r'));
	}

	/**
	 * Format a data string for meta information
	 * @param string $s data string to escape.
	 * @param int $n object ID
	 * @return string escaped string.
	 * @access protected
	 */
	protected function _datastring($s, $n=0) {
		if ($n == 0) {
			$n = $this->n;
		}
		$s = $this->_encrypt_data($n, $s);
		return '('. $this->_escape($s).')';
	}

	/**
	 * Returns a formatted date for meta information
	 * @param int $n object ID
	 * @return string escaped date string.
	 * @access protected
	 * @since 4.6.028 (2009-08-25)
	 */
	protected function _datestring($n=0) {
		$current_time = substr_replace(date('YmdHisO'), '\'', (0 - 2), 0).'\'';
		return $this->_datastring('D:'.$current_time, $n);
	}

	/**
	 * Format a text string for meta information
	 * @param string $s string to escape.
	 * @param int $n object ID
	 * @return string escaped string.
	 * @access protected
	 */
	protected function _textstring($s, $n=0) {
		if ($this->isunicode) {
			//Convert string to UTF-16BE
			$s = $this->UTF8ToUTF16BE($s, true);
		}
		return $this->_datastring($s, $n);
	}

	/**
	 * THIS METHOD IS DEPRECATED
	 * Format a text string
	 * @param string $s string to escape.
	 * @return string escaped string.
	 * @access protected
	 * @deprecated
	 */
	protected function _escapetext($s) {
		if ($this->isunicode) {
			if (($this->CurrentFont['type'] == 'core') OR ($this->CurrentFont['type'] == 'TrueType') OR ($this->CurrentFont['type'] == 'Type1')) {
				$s = $this->UTF8ToLatin1($s);
			} else {
				//Convert string to UTF-16BE and reverse RTL language
				$s = $this->utf8StrRev($s, false, $this->tmprtl);
			}
		}
		return $this->_escape($s);
	}

	/**
	 * get raw output stream.
	 * @param string $s string to output.
	 * @param int $n object reference for encryption mode
	 * @access protected
	 * @author Nicola Asuni
	 * @since 5.5.000 (2010-06-22)
	 */
	protected function _getrawstream($s, $n=0) {
		if ($n <= 0) {
			// default to current object
			$n = $this->n;
		}
		return $this->_encrypt_data($n, $s);
	}

	/**
	 * Format output stream (DEPRECATED).
	 * @param string $s string to output.
	 * @param int $n object reference for encryption mode
	 * @access protected
	 * @deprecated
	 */
	protected function _getstream($s, $n=0) {
		return 'stream'."\n".$this->_getrawstream($s, $n)."\n".'endstream';
	}

	/**
	 * Output a stream (DEPRECATED).
	 * @param string $s string to output.
	 * @param int $n object reference for encryption mode
	 * @access protected
	 * @deprecated
	 */
	protected function _putstream($s, $n=0) {
		$this->_out($this->_getstream($s, $n));
	}

	/**
	 * Output a string to the document.
	 * @param string $s string to output.
	 * @access protected
	 */
	protected function _out($s) {
		if ($this->state == 2) {
			if ($this->inxobj) {
				// we are inside an XObject template
				$this->xobjects[$this->xobjid]['outdata'] .= $s."\n";
			} elseif ((!$this->InFooter) AND isset($this->footerlen[$this->page]) AND ($this->footerlen[$this->page] > 0)) {
				// puts data before page footer
				$pagebuff = $this->getPageBuffer($this->page);
				$page = substr($pagebuff, 0, -$this->footerlen[$this->page]);
				$footer = substr($pagebuff, -$this->footerlen[$this->page]);
				$this->setPageBuffer($this->page, $page.$s."\n".$footer);
				// update footer position
				$this->footerpos[$this->page] += strlen($s."\n");
			} else {
				$this->setPageBuffer($this->page, $s."\n", true);
			}
		} else {
			$this->setBuffer($s."\n");
		}
	}

	/**
	 * Converts UTF-8 strings to codepoints array.<br>
	 * Invalid byte sequences will be replaced with 0xFFFD (replacement character)<br>
	 * Based on: http://www.faqs.org/rfcs/rfc3629.html
	 * <pre>
	 *    Char. number range  |        UTF-8 octet sequence
	 *       (hexadecimal)    |              (binary)
	 *    --------------------+-----------------------------------------------
	 *    0000 0000-0000 007F | 0xxxxxxx
	 *    0000 0080-0000 07FF | 110xxxxx 10xxxxxx
	 *    0000 0800-0000 FFFF | 1110xxxx 10xxxxxx 10xxxxxx
	 *    0001 0000-0010 FFFF | 11110xxx 10xxxxxx 10xxxxxx 10xxxxxx
	 *    ---------------------------------------------------------------------
	 *
	 *   ABFN notation:
	 *   ---------------------------------------------------------------------
	 *   UTF8-octets = *( UTF8-char )
	 *   UTF8-char   = UTF8-1 / UTF8-2 / UTF8-3 / UTF8-4
	 *   UTF8-1      = %x00-7F
	 *   UTF8-2      = %xC2-DF UTF8-tail
	 *
	 *   UTF8-3      = %xE0 %xA0-BF UTF8-tail / %xE1-EC 2( UTF8-tail ) /
	 *                 %xED %x80-9F UTF8-tail / %xEE-EF 2( UTF8-tail )
	 *   UTF8-4      = %xF0 %x90-BF 2( UTF8-tail ) / %xF1-F3 3( UTF8-tail ) /
	 *                 %xF4 %x80-8F 2( UTF8-tail )
	 *   UTF8-tail   = %x80-BF
	 *   ---------------------------------------------------------------------
	 * </pre>
	 * @param string $str string to process.
	 * @return array containing codepoints (UTF-8 characters values)
	 * @access protected
	 * @author Nicola Asuni
	 * @since 1.53.0.TC005 (2005-01-05)
	 */
	protected function UTF8StringToArray($str) {
		// build a unique string key
		$strkey = md5($str);
		if (isset($this->cache_UTF8StringToArray[$strkey])) {
			// return cached value
			$chrarray = $this->cache_UTF8StringToArray[$strkey]['s'];
			if (!isset($this->cache_UTF8StringToArray[$strkey]['f'][$this->CurrentFont['fontkey']])) {
				if ($this->isunicode) {
					foreach ($chrarray as $chr) {
						// store this char for font subsetting
						$this->CurrentFont['subsetchars'][$chr] = true;
					}
					// update font subsetchars
					$this->setFontSubBuffer($this->CurrentFont['fontkey'], 'subsetchars', $this->CurrentFont['subsetchars']);
				}
				$this->cache_UTF8StringToArray[$strkey]['f'][$this->CurrentFont['fontkey']] = true;
			}
			return $chrarray;
		}
		// check cache size
		if ($this->cache_size_UTF8StringToArray >= $this->cache_maxsize_UTF8StringToArray) {
			// remove first element
			array_shift($this->cache_UTF8StringToArray);
		}
		// new cache array for selected string
		$this->cache_UTF8StringToArray[$strkey] = array('s' => array(), 'f' => array());
		++$this->cache_size_UTF8StringToArray;
		if (!$this->isunicode) {
			// split string into array of equivalent codes
			$strarr = array();
			$strlen = strlen($str);
			for ($i=0; $i < $strlen; ++$i) {
				$strarr[] = ord($str{$i});
			}
			// insert new value on cache
			$this->cache_UTF8StringToArray[$strkey]['s'] = $strarr;
			$this->cache_UTF8StringToArray[$strkey]['f'][$this->CurrentFont['fontkey']] = true;
			return $strarr;
		}
		$unichar = -1; // last unicode char
		$unicode = array(); // array containing unicode values
		$bytes  = array(); // array containing single character byte sequences
		$numbytes = 1; // number of octetc needed to represent the UTF-8 character
		$str .= ''; // force $str to be a string
		$length = strlen($str);
		for ($i = 0; $i < $length; ++$i) {
			$char = ord($str{$i}); // get one string character at time
			if (count($bytes) == 0) { // get starting octect
				if ($char <= 0x7F) {
					$unichar = $char; // use the character "as is" because is ASCII
					$numbytes = 1;
				} elseif (($char >> 0x05) == 0x06) { // 2 bytes character (0x06 = 110 BIN)
					$bytes[] = ($char - 0xC0) << 0x06;
					$numbytes = 2;
				} elseif (($char >> 0x04) == 0x0E) { // 3 bytes character (0x0E = 1110 BIN)
					$bytes[] = ($char - 0xE0) << 0x0C;
					$numbytes = 3;
				} elseif (($char >> 0x03) == 0x1E) { // 4 bytes character (0x1E = 11110 BIN)
					$bytes[] = ($char - 0xF0) << 0x12;
					$numbytes = 4;
				} else {
					// use replacement character for other invalid sequences
					$unichar = 0xFFFD;
					$bytes = array();
					$numbytes = 1;
				}
			} elseif (($char >> 0x06) == 0x02) { // bytes 2, 3 and 4 must start with 0x02 = 10 BIN
				$bytes[] = $char - 0x80;
				if (count($bytes) == $numbytes) {
					// compose UTF-8 bytes to a single unicode value
					$char = $bytes[0];
					for ($j = 1; $j < $numbytes; ++$j) {
						$char += ($bytes[$j] << (($numbytes - $j - 1) * 0x06));
					}
					if ((($char >= 0xD800) AND ($char <= 0xDFFF)) OR ($char >= 0x10FFFF)) {
						/* The definition of UTF-8 prohibits encoding character numbers between
						U+D800 and U+DFFF, which are reserved for use with the UTF-16
						encoding form (as surrogate pairs) and do not directly represent
						characters. */
						$unichar = 0xFFFD; // use replacement character
					} else {
						$unichar = $char; // add char to array
					}
					// reset data for next char
					$bytes = array();
					$numbytes = 1;
				}
			} else {
				// use replacement character for other invalid sequences
				$unichar = 0xFFFD;
				$bytes = array();
				$numbytes = 1;
			}
			if ($unichar >= 0) {
				// insert unicode value into array
				$unicode[] = $unichar;
				// store this char for font subsetting
				$this->CurrentFont['subsetchars'][$unichar] = true;
				$unichar = -1;
			}
		}
		// update font subsetchars
		$this->setFontSubBuffer($this->CurrentFont['fontkey'], 'subsetchars', $this->CurrentFont['subsetchars']);
		// insert new value on cache
		$this->cache_UTF8StringToArray[$strkey]['s'] = $unicode;
		$this->cache_UTF8StringToArray[$strkey]['f'][$this->CurrentFont['fontkey']] = true;
		return $unicode;
	}

	/**
	 * Converts UTF-8 strings to UTF16-BE.<br>
	 * @param string $str string to process.
	 * @param boolean $setbom if true set the Byte Order Mark (BOM = 0xFEFF)
	 * @return string
	 * @access protected
	 * @author Nicola Asuni
	 * @since 1.53.0.TC005 (2005-01-05)
	 * @uses UTF8StringToArray(), arrUTF8ToUTF16BE()
	 */
	protected function UTF8ToUTF16BE($str, $setbom=true) {
		if (!$this->isunicode) {
			return $str; // string is not in unicode
		}
		$unicode = $this->UTF8StringToArray($str); // array containing UTF-8 unicode values
		return $this->arrUTF8ToUTF16BE($unicode, $setbom);
	}

	/**
	 * Converts UTF-8 strings to Latin1 when using the standard 14 core fonts.<br>
	 * @param string $str string to process.
	 * @return string
	 * @author Andrew Whitehead, Nicola Asuni
	 * @access protected
	 * @since 3.2.000 (2008-06-23)
	 */
	protected function UTF8ToLatin1($str) {
		if (!$this->isunicode) {
			return $str; // string is not in unicode
		}
		$outstr = ''; // string to be returned
		$unicode = $this->UTF8StringToArray($str); // array containing UTF-8 unicode values
		foreach ($unicode as $char) {
			if ($char < 256) {
				$outstr .= chr($char);
			} elseif (array_key_exists($char, $this->unicode->uni_utf8tolatin)) {
				// map from UTF-8
				$outstr .= chr($this->unicode->uni_utf8tolatin[$char]);
			} elseif ($char == 0xFFFD) {
				// skip
			} else {
				$outstr .= '?';
			}
		}
		return $outstr;
	}

	/**
	 * Converts UTF-8 characters array to array of Latin1 characters<br>
	 * @param array $unicode array containing UTF-8 unicode values
	 * @return array
	 * @author Nicola Asuni
	 * @access protected
	 * @since 4.8.023 (2010-01-15)
	 */
	protected function UTF8ArrToLatin1($unicode) {
		if ((!$this->isunicode) OR $this->isUnicodeFont()) {
			return $unicode;
		}
		$outarr = array(); // array to be returned
		foreach ($unicode as $char) {
			if ($char < 256) {
				$outarr[] = $char;
			} elseif (array_key_exists($char, $this->unicode->uni_utf8tolatin)) {
				// map from UTF-8
				$outarr[] = $this->unicode->uni_utf8tolatin[$char];
			} elseif ($char == 0xFFFD) {
				// skip
			} else {
				$outarr[] = 63; // '?' character
			}
		}
		return $outarr;
	}

	/**
	 * Converts array of UTF-8 characters to UTF16-BE string.<br>
	 * Based on: http://www.faqs.org/rfcs/rfc2781.html
 	 * <pre>
	 *   Encoding UTF-16:
	 *
	 *   Encoding of a single character from an ISO 10646 character value to
	 *    UTF-16 proceeds as follows. Let U be the character number, no greater
	 *    than 0x10FFFF.
	 *
	 *    1) If U < 0x10000, encode U as a 16-bit unsigned integer and
	 *       terminate.
	 *
	 *    2) Let U' = U - 0x10000. Because U is less than or equal to 0x10FFFF,
	 *       U' must be less than or equal to 0xFFFFF. That is, U' can be
	 *       represented in 20 bits.
	 *
	 *    3) Initialize two 16-bit unsigned integers, W1 and W2, to 0xD800 and
	 *       0xDC00, respectively. These integers each have 10 bits free to
	 *       encode the character value, for a total of 20 bits.
	 *
	 *    4) Assign the 10 high-order bits of the 20-bit U' to the 10 low-order
	 *       bits of W1 and the 10 low-order bits of U' to the 10 low-order
	 *       bits of W2. Terminate.
	 *
	 *    Graphically, steps 2 through 4 look like:
	 *    U' = yyyyyyyyyyxxxxxxxxxx
	 *    W1 = 110110yyyyyyyyyy
	 *    W2 = 110111xxxxxxxxxx
	 * </pre>
	 * @param array $unicode array containing UTF-8 unicode values
	 * @param boolean $setbom if true set the Byte Order Mark (BOM = 0xFEFF)
	 * @return string
	 * @access protected
	 * @author Nicola Asuni
	 * @since 2.1.000 (2008-01-08)
	 * @see UTF8ToUTF16BE()
	 */
	protected function arrUTF8ToUTF16BE($unicode, $setbom=true) {
		$outstr = ''; // string to be returned
		if ($setbom) {
			$outstr .= "\xFE\xFF"; // Byte Order Mark (BOM)
		}
		foreach ($unicode as $char) {
			if ($char == 0x200b) {
				// skip Unicode Character 'ZERO WIDTH SPACE' (DEC:8203, U+200B)
			} elseif ($char == 0xFFFD) {
				$outstr .= "\xFF\xFD"; // replacement character
			} elseif ($char < 0x10000) {
				$outstr .= chr($char >> 0x08);
				$outstr .= chr($char & 0xFF);
			} else {
				$char -= 0x10000;
				$w1 = 0xD800 | ($char >> 0x10);
				$w2 = 0xDC00 | ($char & 0x3FF);
				$outstr .= chr($w1 >> 0x08);
				$outstr .= chr($w1 & 0xFF);
				$outstr .= chr($w2 >> 0x08);
				$outstr .= chr($w2 & 0xFF);
			}
		}
		return $outstr;
	}
	// ====================================================

	/**
 	 * Set header font.
	 * @param array $font font
	 * @access public
	 * @since 1.1
	 */
	public function setHeaderFont($font) {
		$this->header_font = $font;
	}

	/**
 	 * Get header font.
 	 * @return array()
	 * @access public
	 * @since 4.0.012 (2008-07-24)
	 */
	public function getHeaderFont() {
		return $this->header_font;
	}

	/**
 	 * Set footer font.
	 * @param array $font font
	 * @access public
	 * @since 1.1
	 */
	public function setFooterFont($font) {
		$this->footer_font = $font;
	}

	/**
 	 * Get Footer font.
 	 * @return array()
	 * @access public
	 * @since 4.0.012 (2008-07-24)
	 */
	public function getFooterFont() {
		return $this->footer_font;
	}

	/**
 	 * Set language array.
	 * @param array $language
	 * @access public
	 * @since 1.1
	 */
	public function setLanguageArray($language) {
		$this->l = $language;
		if (isset($this->l['a_meta_dir'])) {
			$this->rtl = $this->l['a_meta_dir']=='rtl' ? true : false;
		} else {
			$this->rtl = false;
		}
	}

	/**
	 * Returns the PDF data.
	 * @access public
	 */
	public function getPDFData() {
		if ($this->state < 3) {
			$this->Close();
		}
		return $this->buffer;
	}

	/**
	 * Output anchor link.
	 * @param string $url link URL or internal link (i.e.: &lt;a href="#23,4.5"&gt;link to page 23 at 4.5 Y position&lt;/a&gt;)
	 * @param string $name link name
	 * @param boolean $fill Indicates if the cell background must be painted (true) or transparent (false).
	 * @param boolean $firstline if true prints only the first line and return the remaining string.
	 * @param array $color array of RGB text color
	 * @param string $style font style (U, D, B, I)
	 * @param boolean $firstblock if true the string is the starting of a line.
	 * @return the number of cells used or the remaining text if $firstline = true;
	 * @access public
	 */
	public function addHtmlLink($url, $name, $fill=false, $firstline=false, $color='', $style=-1, $firstblock=false) {
		if (!$this->empty_string($url) AND ($url{0} == '#')) {
			// convert url to internal link
			$lnkdata = explode(',', $url);
			if (isset($lnkdata[0])) {
				$page = intval(substr($lnkdata[0], 1));
				if (empty($page) OR ($page <= 0)) {
					$page = $this->page;
				}
				if (isset($lnkdata[1]) AND (strlen($lnkdata[1]) > 0)) {
					$lnky = floatval($lnkdata[1]);
				} else {
					$lnky = 0;
				}
				$url = $this->AddLink();
				$this->SetLink($url, $lnky, $page);
			}
		}
		// store current settings
		$prevcolor = $this->fgcolor;
		$prevstyle = $this->FontStyle;
		if (empty($color)) {
			$this->SetTextColorArray($this->htmlLinkColorArray);
		} else {
			$this->SetTextColorArray($color);
		}
		if ($style == -1) {
			$this->SetFont('', $this->FontStyle.$this->htmlLinkFontStyle);
		} else {
			$this->SetFont('', $this->FontStyle.$style);
		}
		$ret = $this->Write($this->lasth, $name, $url, $fill, '', false, 0, $firstline, $firstblock, 0);
		// restore settings
		$this->SetFont('', $prevstyle);
		$this->SetTextColorArray($prevcolor);
		return $ret;
	}

	/**
	 * Returns an associative array (keys: R,G,B) from an html color name or a six-digit or three-digit hexadecimal color representation (i.e. #3FE5AA or #7FF).
	 * @param string $color html color
	 * @return array RGB color or false in case of error.
	 * @access public
	 */
	public function convertHTMLColorToDec($color='#FFFFFF') {
		$returncolor = false;
		$color = preg_replace('/[\s]*/', '', $color); // remove extra spaces
		$color = strtolower($color);
		if (($dotpos = strpos($color, '.')) !== false) {
			// remove class parent (i.e.: color.red)
			$color = substr($color, ($dotpos + 1));
		}
		if (strlen($color) == 0) {
			return false;
		}
		// RGB ARRAY
		if (substr($color, 0, 3) == 'rgb') {
			$codes = substr($color, 4);
			$codes = str_replace(')', '', $codes);
			$returncolor = explode(',', $codes);
			return $returncolor;
		}
		// CMYK ARRAY
		if (substr($color, 0, 4) == 'cmyk') {
			$codes = substr($color, 5);
			$codes = str_replace(')', '', $codes);
			$returncolor = explode(',', $codes);
			return $returncolor;
		}
		// COLOR NAME
		if (substr($color, 0, 1) != '#') {
			// decode color name
			if (isset($this->webcolor[$color])) {
				$color_code = $this->webcolor[$color];
			} else {
				return false;
			}
		} else {
			$color_code = substr($color, 1);
		}
		// RGB VALUE
		switch (strlen($color_code)) {
			case 3: {
				// three-digit hexadecimal representation
				$r = substr($color_code, 0, 1);
				$g = substr($color_code, 1, 1);
				$b = substr($color_code, 2, 1);
				$returncolor['R'] = hexdec($r.$r);
				$returncolor['G'] = hexdec($g.$g);
				$returncolor['B'] = hexdec($b.$b);
				break;
			}
			case 6: {
				// six-digit hexadecimal representation
				$returncolor['R'] = hexdec(substr($color_code, 0, 2));
				$returncolor['G'] = hexdec(substr($color_code, 2, 2));
				$returncolor['B'] = hexdec(substr($color_code, 4, 2));
				break;
			}
		}
		return $returncolor;
	}

	/**
	 * Converts pixels to User's Units.
	 * @param int $px pixels
	 * @return float value in user's unit
	 * @access public
	 * @see setImageScale(), getImageScale()
	 */
	public function pixelsToUnits($px) {
		return ($px / ($this->imgscale * $this->k));
	}

	/**
	 * Reverse function for htmlentities.
	 * Convert entities in UTF-8.
	 * @param string $text_to_convert Text to convert.
	 * @return string converted text string
	 * @access public
	 */
	public function unhtmlentities($text_to_convert) {
		return html_entity_decode($text_to_convert, ENT_QUOTES, $this->encoding);
	}

	// ENCRYPTION METHODS ----------------------------------

	/**
	 * Returns a string containing random data to be used as a seed for encryption methods.
	 * @param string $seed starting seed value
	 * @return string containing random data
	 * @author Nicola Asuni
	 * @since 5.9.006 (2010-10-19)
	 * @access protected
	 */
	protected function getRandomSeed($seed='') {
		$seed .= microtime();
		if (function_exists('openssl_random_pseudo_bytes')) {
			$seed .= openssl_random_pseudo_bytes(512);
		}
		$seed .= uniqid('', true);
		$seed .= rand();
		$seed .= getmypid();
		$seed .= __FILE__;
		$seed .= $this->bufferlen;
		if (isset($_SERVER['REMOTE_ADDR'])) {
			$seed .= $_SERVER['REMOTE_ADDR'];
		}
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$seed .= $_SERVER['HTTP_USER_AGENT'];
		}
		if (isset($_SERVER['HTTP_ACCEPT'])) {
			$seed .= $_SERVER['HTTP_ACCEPT'];
		}
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) {
			$seed .= $_SERVER['HTTP_ACCEPT_ENCODING'];
		}
		if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$seed .= $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		}
		if (isset($_SERVER['HTTP_ACCEPT_CHARSET'])) {
			$seed .= $_SERVER['HTTP_ACCEPT_CHARSET'];
		}
		$seed .= rand();
		$seed .= uniqid('', true);
		$seed .= microtime();
		return $seed;
	}

	/**
	 * Compute encryption key depending on object number where the encrypted data is stored.
	 * This is used for all strings and streams without crypt filter specifier.
	 * @param int $n object number
	 * @return int object key
	 * @access protected
	 * @author Nicola Asuni
	 * @since 2.0.000 (2008-01-02)
	 */
	protected function _objectkey($n) {
		$objkey = $this->encryptdata['key'].pack('VXxx', $n);
		if ($this->encryptdata['mode'] == 2) { // AES-128
			// AES padding
			$objkey .= "\x73\x41\x6C\x54"; // sAlT
		}
		$objkey = substr($this->_md5_16($objkey), 0, (($this->encryptdata['Length'] / 8) + 5));
		$objkey = substr($objkey, 0, 16);
		return $objkey;
	}

	/**
	 * Encrypt the input string.
	 * @param int $n object number
	 * @param string $s data string to encrypt
	 * @return encrypted string
	 * @access protected
	 * @author Nicola Asuni
	 * @since 5.0.005 (2010-05-11)
	 */
	protected function _encrypt_data($n, $s) {
		if (!$this->encrypted) {
			return $s;
		}
		switch ($this->encryptdata['mode']) {
			case 0:   // RC4-40
			case 1: { // RC4-128
				$s = $this->_RC4($this->_objectkey($n), $s);
				break;
			}
			case 2: { // AES-128
				$s = $this->_AES($this->_objectkey($n), $s);
				break;
			}
			case 3: { // AES-256
				$s = $this->_AES($this->encryptdata['key'], $s);
				break;
			}
		}
		return $s;
	}

	/**
	 * Put encryption on PDF document.
	 * @access protected
	 * @author Nicola Asuni
	 * @since 2.0.000 (2008-01-02)
	 */
	protected function _putencryption() {
		if (!$this->encrypted) {
			return;
		}
		$this->encryptdata['objid'] = $this->_newobj();
		$out = '<<';
		if (!isset($this->encryptdata['Filter']) OR empty($this->encryptdata['Filter'])) {
			$this->encryptdata['Filter'] = 'Standard';
		}
		$out .= ' /Filter /'.$this->encryptdata['Filter'];
		if (isset($this->encryptdata['SubFilter']) AND !empty($this->encryptdata['SubFilter'])) {
			$out .= ' /SubFilter /'.$this->encryptdata['SubFilter'];
		}
		if (!isset($this->encryptdata['V']) OR empty($this->encryptdata['V'])) {
			$this->encryptdata['V'] = 1;
		}
		// V is a code specifying the algorithm to be used in encrypting and decrypting the document
		$out .= ' /V '.$this->encryptdata['V'];
		if (isset($this->encryptdata['Length']) AND !empty($this->encryptdata['Length'])) {
			// The length of the encryption key, in bits. The value shall be a multiple of 8, in the range 40 to 256
			$out .= ' /Length '.$this->encryptdata['Length'];
		} else {
			$out .= ' /Length 40';
		}
		if ($this->encryptdata['V'] >= 4) {
			if (!isset($this->encryptdata['StmF']) OR empty($this->encryptdata['StmF'])) {
				$this->encryptdata['StmF'] = 'Identity';
			}
			if (!isset($this->encryptdata['StrF']) OR empty($this->encryptdata['StrF'])) {
				// The name of the crypt filter that shall be used when decrypting all strings in the document.
				$this->encryptdata['StrF'] = 'Identity';
			}
			// A dictionary whose keys shall be crypt filter names and whose values shall be the corresponding crypt filter dictionaries.
			if (isset($this->encryptdata['CF']) AND !empty($this->encryptdata['CF'])) {
				$out .= ' /CF <<';
				$out .= ' /'.$this->encryptdata['StmF'].' <<';
				$out .= ' /Type /CryptFilter';
				if (isset($this->encryptdata['CF']['CFM']) AND !empty($this->encryptdata['CF']['CFM'])) {
					// The method used
					$out .= ' /CFM /'.$this->encryptdata['CF']['CFM'];
					if ($this->encryptdata['pubkey']) {
						$out .= ' /Recipients [';
						foreach ($this->encryptdata['Recipients'] as $rec) {
							$out .= ' <'.$rec.'>';
						}
						$out .= ' ]';
						if (isset($this->encryptdata['CF']['EncryptMetadata']) AND (!$this->encryptdata['CF']['EncryptMetadata'])) {
							$out .= ' /EncryptMetadata false';
						} else {
							$out .= ' /EncryptMetadata true';
						}
					}
				} else {
					$out .= ' /CFM /None';
				}
				if (isset($this->encryptdata['CF']['AuthEvent']) AND !empty($this->encryptdata['CF']['AuthEvent'])) {
					// The event to be used to trigger the authorization that is required to access encryption keys used by this filter.
					$out .= ' /AuthEvent /'.$this->encryptdata['CF']['AuthEvent'];
				} else {
					$out .= ' /AuthEvent /DocOpen';
				}
				if (isset($this->encryptdata['CF']['Length']) AND !empty($this->encryptdata['CF']['Length'])) {
					// The bit length of the encryption key.
					$out .= ' /Length '.$this->encryptdata['CF']['Length'];
				}
				$out .= ' >> >>';
			}
			// The name of the crypt filter that shall be used by default when decrypting streams.
			$out .= ' /StmF /'.$this->encryptdata['StmF'];
			// The name of the crypt filter that shall be used when decrypting all strings in the document.
			$out .= ' /StrF /'.$this->encryptdata['StrF'];
			if (isset($this->encryptdata['EFF']) AND !empty($this->encryptdata['EFF'])) {
				// The name of the crypt filter that shall be used when encrypting embedded file streams that do not have their own crypt filter specifier.
				$out .= ' /EFF /'.$this->encryptdata[''];
			}
		}
		// Additional encryption dictionary entries for the standard security handler
		if ($this->encryptdata['pubkey']) {
			if (($this->encryptdata['V'] < 4) AND isset($this->encryptdata['Recipients']) AND !empty($this->encryptdata['Recipients'])) {
				$out .= ' /Recipients [';
				foreach ($this->encryptdata['Recipients'] as $rec) {
					$out .= ' <'.$rec.'>';
				}
				$out .= ' ]';
			}
		} else {
			$out .= ' /R';
			if ($this->encryptdata['V'] == 5) { // AES-256
				$out .= ' 5';
				$out .= ' /OE ('.$this->_escape($this->encryptdata['OE']).')';
				$out .= ' /UE ('.$this->_escape($this->encryptdata['UE']).')';
				$out .= ' /Perms ('.$this->_escape($this->encryptdata['perms']).')';
			} elseif ($this->encryptdata['V'] == 4) { // AES-128
				$out .= ' 4';
			} elseif ($this->encryptdata['V'] < 2) { // RC-40
				$out .= ' 2';
			} else { // RC-128
				$out .= ' 3';
			}
			$out .= ' /O ('.$this->_escape($this->encryptdata['O']).')';
			$out .= ' /U ('.$this->_escape($this->encryptdata['U']).')';
			$out .= ' /P '.$this->encryptdata['P'];
			if (isset($this->encryptdata['EncryptMetadata']) AND (!$this->encryptdata['EncryptMetadata'])) {
				$out .= ' /EncryptMetadata false';
			} else {
				$out .= ' /EncryptMetadata true';
			}
		}
		$out .= ' >>';
		$out .= "\n".'endobj';
		$this->_out($out);
	}

	/**
	 * Returns the input text encrypted using RC4 algorithm and the specified key.
	 * RC4 is the standard encryption algorithm used in PDF format
	 * @param string $key encryption key
	 * @param String $text input text to be encrypted
	 * @return String encrypted text
	 * @access protected
	 * @since 2.0.000 (2008-01-02)
	 * @author Klemen Vodopivec, Nicola Asuni
	 */
	protected function _RC4($key, $text) {
		if (function_exists('mcrypt_decrypt') AND ($out = @mcrypt_decrypt(MCRYPT_ARCFOUR, $key, $text, MCRYPT_MODE_STREAM, ''))) {
			// try to use mcrypt function if exist
			return $out;
		}
		if ($this->last_enc_key != $key) {
			$k = str_repeat($key, ((256 / strlen($key)) + 1));
			$rc4 = range(0, 255);
			$j = 0;
			for ($i = 0; $i < 256; ++$i) {
				$t = $rc4[$i];
				$j = ($j + $t + ord($k{$i})) % 256;
				$rc4[$i] = $rc4[$j];
				$rc4[$j] = $t;
			}
			$this->last_enc_key = $key;
			$this->last_enc_key_c = $rc4;
		} else {
			$rc4 = $this->last_enc_key_c;
		}
		$len = strlen($text);
		$a = 0;
		$b = 0;
		$out = '';
		for ($i = 0; $i < $len; ++$i) {
			$a = ($a + 1) % 256;
			$t = $rc4[$a];
			$b = ($b + $t) % 256;
			$rc4[$a] = $rc4[$b];
			$rc4[$b] = $t;
			$k = $rc4[($rc4[$a] + $rc4[$b]) % 256];
			$out .= chr(ord($text{$i}) ^ $k);
		}
		return $out;
	}

	/**
	 * Returns the input text exrypted using AES algorithm and the specified key.
	 * This method requires mcrypt.
	 * @param string $key encryption key
	 * @param String $text input text to be encrypted
	 * @return String encrypted text
	 * @access protected
	 * @author Nicola Asuni
	 * @since 5.0.005 (2010-05-11)
	 */
	protected function _AES($key, $text) {
		// padding (RFC 2898, PKCS #5: Password-Based Cryptography Specification Version 2.0)
		$padding = 16 - (strlen($text) % 16);
		$text .= str_repeat(chr($padding), $padding);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
		$text = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_CBC, $iv);
		$text = $iv.$text;
		return $text;
	}

	/**
	 * Encrypts a string using MD5 and returns it's value as a binary string.
	 * @param string $str input string
	 * @return String MD5 encrypted binary string
	 * @access protected
	 * @since 2.0.000 (2008-01-02)
	 * @author Klemen Vodopivec
	 */
	protected function _md5_16($str) {
		return pack('H*', md5($str));
	}

	/**
	 * Compute U value (used for encryption)
	 * @return string U value
	 * @access protected
	 * @since 2.0.000 (2008-01-02)
	 * @author Nicola Asuni
	 */
	protected function _Uvalue() {
		if ($this->encryptdata['mode'] == 0) { // RC4-40
			return $this->_RC4($this->encryptdata['key'], $this->enc_padding);
		} elseif ($this->encryptdata['mode'] < 3) { // RC4-128, AES-128
			$tmp = $this->_md5_16($this->enc_padding.$this->encryptdata['fileid']);
			$enc = $this->_RC4($this->encryptdata['key'], $tmp);
			$len = strlen($tmp);
			for ($i = 1; $i <= 19; ++$i) {
				$ek = '';
				for ($j = 0; $j < $len; ++$j) {
					$ek .= chr(ord($this->encryptdata['key']{$j}) ^ $i);
				}
				$enc = $this->_RC4($ek, $enc);
			}
			$enc .= str_repeat("\x00", 16);
			return substr($enc, 0, 32);
		} elseif ($this->encryptdata['mode'] == 3) { // AES-256
			$seed = $this->_md5_16($this->getRandomSeed());
			// User Validation Salt
			$this->encryptdata['UVS'] = substr($seed, 0, 8);
			// User Key Salt
			$this->encryptdata['UKS'] = substr($seed, 8, 16);
			return hash('sha256', $this->encryptdata['user_password'].$this->encryptdata['UVS'], true).$this->encryptdata['UVS'].$this->encryptdata['UKS'];
		}
	}

	/**
	 * Compute UE value (used for encryption)
	 * @return string UE value
	 * @access protected
	 * @since 5.9.006 (2010-10-19)
	 * @author Nicola Asuni
	 */
	protected function _UEvalue() {
		$hashkey = hash('sha256', $this->encryptdata['user_password'].$this->encryptdata['UKS'], true);
		$iv = str_repeat("\x00", mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
		return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $hashkey, $this->encryptdata['key'], MCRYPT_MODE_CBC, $iv);
	}

	/**
	 * Compute O value (used for encryption)
	 * @return string O value
	 * @access protected
	 * @since 2.0.000 (2008-01-02)
	 * @author Nicola Asuni
	 */
	protected function _Ovalue() {
		if ($this->encryptdata['mode'] < 3) { // RC4-40, RC4-128, AES-128
			$tmp = $this->_md5_16($this->encryptdata['owner_password']);
			if ($this->encryptdata['mode'] > 0) {
				for ($i = 0; $i < 50; ++$i) {
					$tmp = $this->_md5_16($tmp);
				}
			}
			$owner_key = substr($tmp, 0, ($this->encryptdata['Length'] / 8));
			$enc = $this->_RC4($owner_key, $this->encryptdata['user_password']);
			if ($this->encryptdata['mode'] > 0) {
				$len = strlen($owner_key);
				for ($i = 1; $i <= 19; ++$i) {
					$ek = '';
					for ($j = 0; $j < $len; ++$j) {
						$ek .= chr(ord($owner_key{$j}) ^ $i);
					}
					$enc = $this->_RC4($ek, $enc);
				}
			}
			return $enc;
		} elseif ($this->encryptdata['mode'] == 3) { // AES-256
			$seed = $this->_md5_16($this->getRandomSeed());
			// Owner Validation Salt
			$this->encryptdata['OVS'] = substr($seed, 0, 8);
			// Owner Key Salt
			$this->encryptdata['OKS'] = substr($seed, 8, 16);
			return hash('sha256', $this->encryptdata['owner_password'].$this->encryptdata['OVS'].$this->encryptdata['U'], true).$this->encryptdata['OVS'].$this->encryptdata['OKS'];
		}
	}

	/**
	 * Compute OE value (used for encryption)
	 * @return string OE value
	 * @access protected
	 * @since 5.9.006 (2010-10-19)
	 * @author Nicola Asuni
	 */
	protected function _OEvalue() {
		$hashkey = hash('sha256', $this->encryptdata['owner_password'].$this->encryptdata['OKS'].$this->encryptdata['U'], true);
		$iv = str_repeat("\x00", mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
		return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $hashkey, $this->encryptdata['key'], MCRYPT_MODE_CBC, $iv);
	}

	/**
	 * Convert password for AES-256 encryption mode
	 * @return string password
	 * @access protected
	 * @since 5.9.006 (2010-10-19)
	 * @author Nicola Asuni
	 */
	protected function _fixAES256Password($password) {
		$psw = ''; // password to be returned
		$psw_array = $this->utf8Bidi($this->UTF8StringToArray($password), $password, $this->rtl);
		foreach ($psw_array as $c) {
			$psw .= $this->unichr($c);
		}
		return substr($psw, 0, 127);
	}

	/**
	 * Compute encryption key
	 * @access protected
	 * @since 2.0.000 (2008-01-02)
	 * @author Nicola Asuni
	 */
	protected function _generateencryptionkey() {
		$keybytelen = ($this->encryptdata['Length'] / 8);
		if (!$this->encryptdata['pubkey']) { // standard mode
			if ($this->encryptdata['mode'] == 3) { // AES-256
				// generate 256 bit random key
				$this->encryptdata['key'] = substr(hash('sha256', $this->getRandomSeed(), true), 0, $keybytelen);
				// truncate passwords
				$this->encryptdata['user_password'] = $this->_fixAES256Password($this->encryptdata['user_password']);
				$this->encryptdata['owner_password'] = $this->_fixAES256Password($this->encryptdata['owner_password']);
				// Compute U value
				$this->encryptdata['U'] = $this->_Uvalue();
				// Compute UE value
				$this->encryptdata['UE'] = $this->_UEvalue();
				// Compute O value
				$this->encryptdata['O'] = $this->_Ovalue();
				// Compute OE value
				$this->encryptdata['OE'] = $this->_OEvalue();
				// Compute P value
				$this->encryptdata['P'] = $this->encryptdata['protection'];
				// Computing the encryption dictionary's Perms (permissions) value
				$perms = $this->getEncPermissionsString($this->encryptdata['protection']); // bytes 0-3
				$perms .= chr(255).chr(255).chr(255).chr(255); // bytes 4-7
				if (isset($this->encryptdata['CF']['EncryptMetadata']) AND (!$this->encryptdata['CF']['EncryptMetadata'])) { // byte 8
					$perms .= 'F';
				} else {
					$perms .= 'T';
				}
				$perms .= 'adb'; // bytes 9-11
				$perms .= 'nick'; // bytes 12-15
				$iv = str_repeat("\x00", mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB));
				$this->encryptdata['perms'] = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->encryptdata['key'], $perms, MCRYPT_MODE_ECB, $iv);
			} else { // RC4-40, RC4-128, AES-128
				// Pad passwords
				$this->encryptdata['user_password'] = substr($this->encryptdata['user_password'].$this->enc_padding, 0, 32);
				$this->encryptdata['owner_password'] = substr($this->encryptdata['owner_password'].$this->enc_padding, 0, 32);
				// Compute O value
				$this->encryptdata['O'] = $this->_Ovalue();
				// get default permissions (reverse byte order)
				$permissions = $this->getEncPermissionsString($this->encryptdata['protection']);
				// Compute encryption key
				$tmp = $this->_md5_16($this->encryptdata['user_password'].$this->encryptdata['O'].$permissions.$this->encryptdata['fileid']);
				if ($this->encryptdata['mode'] > 0) {
					for ($i = 0; $i < 50; ++$i) {
						$tmp = $this->_md5_16(substr($tmp, 0, $keybytelen));
					}
				}
				$this->encryptdata['key'] = substr($tmp, 0, $keybytelen);
				// Compute U value
				$this->encryptdata['U'] = $this->_Uvalue();
				// Compute P value
				$this->encryptdata['P'] = $this->encryptdata['protection'];
			}
		} else { // Public-Key mode
			// random 20-byte seed
			$seed = sha1($this->getRandomSeed(), true);
			$recipient_bytes = '';
			foreach ($this->encryptdata['pubkeys'] as $pubkey) {
				// for each public certificate
				if (isset($pubkey['p'])) {
					$pkprotection = $this->getUserPermissionCode($pubkey['p'], $this->encryptdata['mode']);
				} else {
					$pkprotection = $this->encryptdata['protection'];
				}
				// get default permissions (reverse byte order)
				$pkpermissions = $this->getEncPermissionsString($pkprotection);
				// envelope data
				$envelope = $seed.$pkpermissions;
				// write the envelope data to a temporary file
				$tempkeyfile = tempnam(K_PATH_CACHE, 'tmpkey_');
				$f = fopen($tempkeyfile, 'wb');
				if (!$f) {
					$this->Error('Unable to create temporary key file: '.$tempkeyfile);
				}
				$envelope_lenght = strlen($envelope);
				fwrite($f, $envelope, $envelope_lenght);
				fclose($f);
				$tempencfile = tempnam(K_PATH_CACHE, 'tmpenc_');
				if (!openssl_pkcs7_encrypt($tempkeyfile, $tempencfile, $pubkey['c'], array(), PKCS7_DETACHED | PKCS7_BINARY)) {
					$this->Error('Unable to encrypt the file: '.$tempkeyfile);
				}
				unlink($tempkeyfile);
				// read encryption signature
				$signature = file_get_contents($tempencfile, false, null, $envelope_lenght);
				unlink($tempencfile);
				// extract signature
				$signature = substr($signature, strpos($signature, 'Content-Disposition'));
				$tmparr = explode("\n\n", $signature);
				$signature = trim($tmparr[1]);
				unset($tmparr);
				// decode signature
				$signature = base64_decode($signature);
				// convert signature to hex
				$hexsignature = current(unpack('H*', $signature));
				// store signature on recipients array
				$this->encryptdata['Recipients'][] = $hexsignature;
				// The bytes of each item in the Recipients array of PKCS#7 objects in the order in which they appear in the array
				$recipient_bytes .= $signature;
			}
			// calculate encryption key
			if ($this->encryptdata['mode'] == 3) { // AES-256
				$this->encryptdata['key'] = substr(hash('sha256', $seed.$recipient_bytes, true), 0, $keybytelen);
			} else { // RC4-40, RC4-128, AES-128
				$this->encryptdata['key'] = substr(sha1($seed.$recipient_bytes, true), 0, $keybytelen);
			}
		}
	}

	/**
	 * Return the premission code used on encryption (P value).
	 * @param Array $permissions the set of permissions (specify the ones you want to block).
	 * @param int $mode encryption strength: 0 = RC4 40 bit; 1 = RC4 128 bit; 2 = AES 128 bit; 3 = AES 256 bit.
	 * @access protected
	 * @since 5.0.005 (2010-05-12)
	 * @author Nicola Asuni
	 */
	protected function getUserPermissionCode($permissions, $mode=0) {
		$options = array(
			'owner' => 2, // bit 2 -- inverted logic: cleared by default
			'print' => 4, // bit 3
			'modify' => 8, // bit 4
			'copy' => 16, // bit 5
			'annot-forms' => 32, // bit 6
			'fill-forms' => 256, // bit 9
			'extract' => 512, // bit 10
			'assemble' => 1024,// bit 11
			'print-high' => 2048 // bit 12
			);
		$protection = 2147422012; // 32 bit: (01111111 11111111 00001111 00111100)
		foreach ($permissions as $permission) {
			if (!isset($options[$permission])) {
				$this->Error('Incorrect permission: '.$permission);
			}
			if (($mode > 0) OR ($options[$permission] <= 32)) {
				// set only valid permissions
				if ($options[$permission] == 2) {
					// the logic for bit 2 is inverted (cleared by default)
					$protection += $options[$permission];
				} else {
					$protection -= $options[$permission];
				}
			}
		}
		return $protection;
	}

	/**
	 * Set document protection
	 * Remark: the protection against modification is for people who have the full Acrobat product.
	 * If you don't set any password, the document will open as usual. If you set a user password, the PDF viewer will ask for it before displaying the document. The master password, if different from the user one, can be used to get full access.
	 * Note: protecting a document requires to encrypt it, which increases the processing time a lot. This can cause a PHP time-out in some cases, especially if the document contains images or fonts.
	 * @param Array $permissions the set of permissions (specify the ones you want to block):<ul><li>print : Print the document;</li><li>modify : Modify the contents of the document by operations other than those controlled by 'fill-forms', 'extract' and 'assemble';</li><li>copy : Copy or otherwise extract text and graphics from the document;</li><li>annot-forms : Add or modify text annotations, fill in interactive form fields, and, if 'modify' is also set, create or modify interactive form fields (including signature fields);</li><li>fill-forms : Fill in existing interactive form fields (including signature fields), even if 'annot-forms' is not specified;</li><li>extract : Extract text and graphics (in support of accessibility to users with disabilities or for other purposes);</li><li>assemble : Assemble the document (insert, rotate, or delete pages and create bookmarks or thumbnail images), even if 'modify' is not set;</li><li>print-high : Print the document to a representation from which a faithful digital copy of the PDF content could be generated. When this is not set, printing is limited to a low-level representation of the appearance, possibly of degraded quality.</li><li>owner : (inverted logic - only for public-key) when set permits change of encryption and enables all other permissions.</li></ul>
	 * @param String $user_pass user password. Empty by default.
	 * @param String $owner_pass owner password. If not specified, a random value is used.
	 * @param int $mode encryption strength: 0 = RC4 40 bit; 1 = RC4 128 bit; 2 = AES 128 bit; 3 = AES 256 bit.
	 * @param String $pubkeys array of recipients containing public-key certificates ('c') and permissions ('p'). For example: array(array('c' => 'file://../tcpdf.crt', 'p' => array('print')))
	 * @access public
	 * @since 2.0.000 (2008-01-02)
	 * @author Nicola Asuni
	 */
	public function SetProtection($permissions=array('print', 'modify', 'copy', 'annot-forms', 'fill-forms', 'extract', 'assemble', 'print-high'), $user_pass='', $owner_pass=null, $mode=0, $pubkeys=null) {
		$this->encryptdata['protection'] = $this->getUserPermissionCode($permissions, $mode);
		if (($pubkeys !== null) AND (is_array($pubkeys))) {
			// public-key mode
			$this->encryptdata['pubkeys'] = $pubkeys;
			if ($mode == 0) {
				// public-Key Security requires at least 128 bit
				$mode = 1;
			}
			if (!function_exists('openssl_pkcs7_encrypt')) {
				$this->Error('Public-Key Security requires openssl library.');
			}
			// Set Public-Key filter (availabe are: Entrust.PPKEF, Adobe.PPKLite, Adobe.PubSec)
			$this->encryptdata['pubkey'] = true;
			$this->encryptdata['Filter'] = 'Adobe.PubSec';
			$this->encryptdata['StmF'] = 'DefaultCryptFilter';
			$this->encryptdata['StrF'] = 'DefaultCryptFilter';
		} else {
			// standard mode (password mode)
			$this->encryptdata['pubkey'] = false;
			$this->encryptdata['Filter'] = 'Standard';
			$this->encryptdata['StmF'] = 'StdCF';
			$this->encryptdata['StrF'] = 'StdCF';
		}
		if ($mode > 1) { // AES
			if (!extension_loaded('mcrypt')) {
				$this->Error('AES encryption requires mcrypt library (http://www.php.net/manual/en/mcrypt.requirements.php).');
			}
			if (mcrypt_get_cipher_name(MCRYPT_RIJNDAEL_128) === false) {
				$this->Error('AES encryption requires MCRYPT_RIJNDAEL_128 cypher.');
			}
			if (($mode == 3) AND !function_exists('hash')) {
				// the Hash extension requires no external libraries and is enabled by default as of PHP 5.1.2.
				$this->Error('AES 256 encryption requires HASH Message Digest Framework (http://www.php.net/manual/en/book.hash.php).');
			}
		}
		if ($owner_pass === null) {
			$owner_pass = md5($this->getRandomSeed());
		}
		$this->encryptdata['user_password'] = $user_pass;
		$this->encryptdata['owner_password'] = $owner_pass;
		$this->encryptdata['mode'] = $mode;
		switch ($mode) {
			case 0: { // RC4 40 bit
				$this->encryptdata['V'] = 1;
				$this->encryptdata['Length'] = 40;
				$this->encryptdata['CF']['CFM'] = 'V2';
				break;
			}
			case 1: { // RC4 128 bit
				$this->encryptdata['V'] = 2;
				$this->encryptdata['Length'] = 128;
				$this->encryptdata['CF']['CFM'] = 'V2';
				if ($this->encryptdata['pubkey']) {
					$this->encryptdata['SubFilter'] = 'adbe.pkcs7.s4';
					$this->encryptdata['Recipients'] = array();
				}
				break;
			}
			case 2: { // AES 128 bit
				$this->encryptdata['V'] = 4;
				$this->encryptdata['Length'] = 128;
				$this->encryptdata['CF']['CFM'] = 'AESV2';
				$this->encryptdata['CF']['Length'] = 128;
				if ($this->encryptdata['pubkey']) {
					$this->encryptdata['SubFilter'] = 'adbe.pkcs7.s5';
					$this->encryptdata['Recipients'] = array();
				}
				break;
			}
			case 3: { // AES 256 bit
				$this->encryptdata['V'] = 5;
				$this->encryptdata['Length'] = 256;
				$this->encryptdata['CF']['CFM'] = 'AESV3';
				$this->encryptdata['CF']['Length'] = 256;
				if ($this->encryptdata['pubkey']) {
					$this->encryptdata['SubFilter'] = 'adbe.pkcs7.s5';
					$this->encryptdata['Recipients'] = array();
				}
				break;
			}
		}
		$this->encrypted = true;
		$this->encryptdata['fileid'] = $this->convertHexStringToString($this->file_id);
		$this->_generateencryptionkey();
	}

	/**
	 * Convert hexadecimal string to string
	 * @param string $bs byte-string to convert
	 * @return String
	 * @access protected
	 * @since 5.0.005 (2010-05-12)
	 * @author Nicola Asuni
	 */
	protected function convertHexStringToString($bs) {
		$string = ''; // string to be returned
		$bslenght = strlen($bs);
		if (($bslenght % 2) != 0) {
			// padding
			$bs .= '0';
			++$bslenght;
		}
		for ($i = 0; $i < $bslenght; $i += 2) {
			$string .= chr(hexdec($bs{$i}.$bs{($i + 1)}));
		}
		return $string;
	}

	/**
	 * Convert string to hexadecimal string (byte string)
	 * @param string $s string to convert
	 * @return byte string
	 * @access protected
	 * @since 5.0.010 (2010-05-17)
	 * @author Nicola Asuni
	 */
	protected function convertStringToHexString($s) {
		$bs = '';
		$chars = preg_split('//', $s, -1, PREG_SPLIT_NO_EMPTY);
		foreach ($chars as $c) {
			$bs .= sprintf('%02s', dechex(ord($c)));
		}
		return $bs;
	}

	/**
	 * Convert encryption P value to a string of bytes, low-order byte first.
	 * @param string $protection 32bit encryption permission value (P value)
	 * @return String
	 * @access protected
	 * @since 5.0.005 (2010-05-12)
	 * @author Nicola Asuni
	 */
	protected function getEncPermissionsString($protection) {
		$binprot = sprintf('%032b', $protection);
		$str = chr(bindec(substr($binprot, 24, 8)));
		$str .= chr(bindec(substr($binprot, 16, 8)));
		$str .= chr(bindec(substr($binprot, 8, 8)));
		$str .= chr(bindec(substr($binprot, 0, 8)));
		return $str;
	}

	// END OF ENCRYPTION FUNCTIONS -------------------------

	// START TRANSFORMATIONS SECTION -----------------------

	/**
	 * Starts a 2D tranformation saving current graphic state.
	 * This function must be called before scaling, mirroring, translation, rotation and skewing.
	 * Use StartTransform() before, and StopTransform() after the transformations to restore the normal behavior.
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function StartTransform() {
		$this->_out('q');
		if ($this->inxobj) {
			// we are inside an XObject template
			$this->xobjects[$this->xobjid]['transfmrk'][] = strlen($this->xobjects[$this->xobjid]['outdata']);
		} else {
			$this->transfmrk[$this->page][] = $this->pagelen[$this->page];
		}
		++$this->transfmatrix_key;
		$this->transfmatrix[$this->transfmatrix_key] = array();
	}

	/**
	 * Stops a 2D tranformation restoring previous graphic state.
	 * This function must be called after scaling, mirroring, translation, rotation and skewing.
	 * Use StartTransform() before, and StopTransform() after the transformations to restore the normal behavior.
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function StopTransform() {
		$this->_out('Q');
		if (isset($this->transfmatrix[$this->transfmatrix_key])) {
			array_pop($this->transfmatrix[$this->transfmatrix_key]);
			--$this->transfmatrix_key;
		}
		if ($this->inxobj) {
			// we are inside an XObject template
			array_pop($this->xobjects[$this->xobjid]['transfmrk']);
		} else {
			array_pop($this->transfmrk[$this->page]);
		}
	}
	/**
	 * Horizontal Scaling.
	 * @param float $s_x scaling factor for width as percent. 0 is not allowed.
	 * @param int $x abscissa of the scaling center. Default is current x position
	 * @param int $y ordinate of the scaling center. Default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function ScaleX($s_x, $x='', $y='') {
		$this->Scale($s_x, 100, $x, $y);
	}

	/**
	 * Vertical Scaling.
	 * @param float $s_y scaling factor for height as percent. 0 is not allowed.
	 * @param int $x abscissa of the scaling center. Default is current x position
	 * @param int $y ordinate of the scaling center. Default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function ScaleY($s_y, $x='', $y='') {
		$this->Scale(100, $s_y, $x, $y);
	}

	/**
	 * Vertical and horizontal proportional Scaling.
	 * @param float $s scaling factor for width and height as percent. 0 is not allowed.
	 * @param int $x abscissa of the scaling center. Default is current x position
	 * @param int $y ordinate of the scaling center. Default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function ScaleXY($s, $x='', $y='') {
		$this->Scale($s, $s, $x, $y);
	}

	/**
	 * Vertical and horizontal non-proportional Scaling.
	 * @param float $s_x scaling factor for width as percent. 0 is not allowed.
	 * @param float $s_y scaling factor for height as percent. 0 is not allowed.
	 * @param int $x abscissa of the scaling center. Default is current x position
	 * @param int $y ordinate of the scaling center. Default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function Scale($s_x, $s_y, $x='', $y='') {
		if ($x === '') {
			$x = $this->x;
		}
		if ($y === '') {
			$y = $this->y;
		}
		if (($s_x == 0) OR ($s_y == 0)) {
			$this->Error('Please do not use values equal to zero for scaling');
		}
		$y = ($this->h - $y) * $this->k;
		$x *= $this->k;
		//calculate elements of transformation matrix
		$s_x /= 100;
		$s_y /= 100;
		$tm = array();
		$tm[0] = $s_x;
		$tm[1] = 0;
		$tm[2] = 0;
		$tm[3] = $s_y;
		$tm[4] = $x * (1 - $s_x);
		$tm[5] = $y * (1 - $s_y);
		//scale the coordinate system
		$this->Transform($tm);
	}

	/**
	 * Horizontal Mirroring.
	 * @param int $x abscissa of the point. Default is current x position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function MirrorH($x='') {
		$this->Scale(-100, 100, $x);
	}

	/**
	 * Verical Mirroring.
	 * @param int $y ordinate of the point. Default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function MirrorV($y='') {
		$this->Scale(100, -100, '', $y);
	}

	/**
	 * Point reflection mirroring.
	 * @param int $x abscissa of the point. Default is current x position
	 * @param int $y ordinate of the point. Default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function MirrorP($x='',$y='') {
		$this->Scale(-100, -100, $x, $y);
	}

	/**
	 * Reflection against a straight line through point (x, y) with the gradient angle (angle).
	 * @param float $angle gradient angle of the straight line. Default is 0 (horizontal line).
	 * @param int $x abscissa of the point. Default is current x position
	 * @param int $y ordinate of the point. Default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function MirrorL($angle=0, $x='',$y='') {
		$this->Scale(-100, 100, $x, $y);
		$this->Rotate(-2*($angle-90), $x, $y);
	}

	/**
	 * Translate graphic object horizontally.
	 * @param int $t_x movement to the right (or left for RTL)
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function TranslateX($t_x) {
		$this->Translate($t_x, 0);
	}

	/**
	 * Translate graphic object vertically.
	 * @param int $t_y movement to the bottom
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function TranslateY($t_y) {
		$this->Translate(0, $t_y);
	}

	/**
	 * Translate graphic object horizontally and vertically.
	 * @param int $t_x movement to the right
	 * @param int $t_y movement to the bottom
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function Translate($t_x, $t_y) {
		//calculate elements of transformation matrix
		$tm = array();
		$tm[0] = 1;
		$tm[1] = 0;
		$tm[2] = 0;
		$tm[3] = 1;
		$tm[4] = $t_x * $this->k;
		$tm[5] = -$t_y * $this->k;
		//translate the coordinate system
		$this->Transform($tm);
	}

	/**
	 * Rotate object.
	 * @param float $angle angle in degrees for counter-clockwise rotation
	 * @param int $x abscissa of the rotation center. Default is current x position
	 * @param int $y ordinate of the rotation center. Default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function Rotate($angle, $x='', $y='') {
		if ($x === '') {
			$x = $this->x;
		}
		if ($y === '') {
			$y = $this->y;
		}
		$y = ($this->h - $y) * $this->k;
		$x *= $this->k;
		//calculate elements of transformation matrix
		$tm = array();
		$tm[0] = cos(deg2rad($angle));
		$tm[1] = sin(deg2rad($angle));
		$tm[2] = -$tm[1];
		$tm[3] = $tm[0];
		$tm[4] = $x + ($tm[1] * $y) - ($tm[0] * $x);
		$tm[5] = $y - ($tm[0] * $y) - ($tm[1] * $x);
		//rotate the coordinate system around ($x,$y)
		$this->Transform($tm);
	}

	/**
	 * Skew horizontally.
	 * @param float $angle_x angle in degrees between -90 (skew to the left) and 90 (skew to the right)
	 * @param int $x abscissa of the skewing center. default is current x position
	 * @param int $y ordinate of the skewing center. default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function SkewX($angle_x, $x='', $y='') {
		$this->Skew($angle_x, 0, $x, $y);
	}

	/**
	 * Skew vertically.
	 * @param float $angle_y angle in degrees between -90 (skew to the bottom) and 90 (skew to the top)
	 * @param int $x abscissa of the skewing center. default is current x position
	 * @param int $y ordinate of the skewing center. default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function SkewY($angle_y, $x='', $y='') {
		$this->Skew(0, $angle_y, $x, $y);
	}

	/**
	 * Skew.
	 * @param float $angle_x angle in degrees between -90 (skew to the left) and 90 (skew to the right)
	 * @param float $angle_y angle in degrees between -90 (skew to the bottom) and 90 (skew to the top)
	 * @param int $x abscissa of the skewing center. default is current x position
	 * @param int $y ordinate of the skewing center. default is current y position
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	public function Skew($angle_x, $angle_y, $x='', $y='') {
		if ($x === '') {
			$x = $this->x;
		}
		if ($y === '') {
			$y = $this->y;
		}
		if (($angle_x <= -90) OR ($angle_x >= 90) OR ($angle_y <= -90) OR ($angle_y >= 90)) {
			$this->Error('Please use values between -90 and +90 degrees for Skewing.');
		}
		$x *= $this->k;
		$y = ($this->h - $y) * $this->k;
		//calculate elements of transformation matrix
		$tm = array();
		$tm[0] = 1;
		$tm[1] = tan(deg2rad($angle_y));
		$tm[2] = tan(deg2rad($angle_x));
		$tm[3] = 1;
		$tm[4] = -$tm[2] * $y;
		$tm[5] = -$tm[1] * $x;
		//skew the coordinate system
		$this->Transform($tm);
	}

	/**
	 * Apply graphic transformations.
	 * @param array $tm transformation matrix
	 * @access protected
	 * @since 2.1.000 (2008-01-07)
	 * @see StartTransform(), StopTransform()
	 */
	protected function Transform($tm) {
		$this->_out(sprintf('%.3F %.3F %.3F %.3F %.3F %.3F cm', $tm[0], $tm[1], $tm[2], $tm[3], $tm[4], $tm[5]));
		// add tranformation matrix
		$this->transfmatrix[$this->transfmatrix_key][] = array('a' => $tm[0], 'b' => $tm[1], 'c' => $tm[2], 'd' => $tm[3], 'e' => $tm[4], 'f' => $tm[5]);
		// update transformation mark
		if ($this->inxobj) {
			// we are inside an XObject template
			if (end($this->xobjects[$this->xobjid]['transfmrk']) !== false) {
				$key = key($this->xobjects[$this->xobjid]['transfmrk']);
				$this->xobjects[$this->xobjid]['transfmrk'][$key] = strlen($this->xobjects[$this->xobjid]['outdata']);
			}
		} elseif (end($this->transfmrk[$this->page]) !== false) {
			$key = key($this->transfmrk[$this->page]);
			$this->transfmrk[$this->page][$key] = $this->pagelen[$this->page];
		}
	}

	// END TRANSFORMATIONS SECTION -------------------------

	// START GRAPHIC FUNCTIONS SECTION ---------------------
	// The following section is based on the code provided by David Hernandez Sanz

	/**
	 * Defines the line width. By default, the value equals 0.2 mm. The method can be called before the first page is created and the value is retained from page to page.
	 * @param float $width The width.
	 * @access public
	 * @since 1.0
	 * @see Line(), Rect(), Cell(), MultiCell()
	 */
	public function SetLineWidth($width) {
		//Set line width
		$this->LineWidth = $width;
		$this->linestyleWidth = sprintf('%.2F w', ($width * $this->k));
		if ($this->page > 0) {
			$this->_out($this->linestyleWidth);
		}
	}

	/**
	 * Returns the current the line width.
	 * @return int Line width
	 * @access public
	 * @since 2.1.000 (2008-01-07)
	 * @see Line(), SetLineWidth()
	 */
	public function GetLineWidth() {
		return $this->LineWidth;
	}

	/**
	 * Set line style.
	 * @param array $style Line style. Array with keys among the following:
	 * <ul>
	 *	 <li>width (float): Width of the line in user units.</li>
	 *	 <li>cap (string): Type of cap to put on the line. Possible values are:
	 * butt, round, square. The difference between "square" and "butt" is that
	 * "square" projects a flat end past the end of the line.</li>
	 *	 <li>join (string): Type of join. Possible values are: miter, round,
	 * bevel.</li>
	 *	 <li>dash (mixed): Dash pattern. Is 0 (without dash) or string with
	 * series of length values, which are the lengths of the on and off dashes.
	 * For example: "2" represents 2 on, 2 off, 2 on, 2 off, ...; "2,1" is 2 on,
	 * 1 off, 2 on, 1 off, ...</li>
	 *	 <li>phase (integer): Modifier on the dash pattern which is used to shift
	 * the point at which the pattern starts.</li>
	 *	 <li>color (array): Draw color. Format: array(GREY) or array(R,G,B) or array(C,M,Y,K).</li>
	 * </ul>
	 * @param boolean $ret if true do not send the command.
	 * @return string the PDF command
	 * @access public
	 * @since 2.1.000 (2008-01-08)
	 */
	public function SetLineStyle($style, $ret=false) {
		$s = ''; // string to be returned
		if (!is_array($style)) {
			return;
		}
		extract($style);
		if (isset($width)) {
			$this->LineWidth = $width;
			$this->linestyleWidth = sprintf('%.2F w', ($width * $this->k));
			$s .= $this->linestyleWidth.' ';
		}
		if (isset($cap)) {
			$ca = array('butt' => 0, 'round'=> 1, 'square' => 2);
			if (isset($ca[$cap])) {
				$this->linestyleCap = $ca[$cap].' J';
				$s .= $this->linestyleCap.' ';
			}
		}
		if (isset($join)) {
			$ja = array('miter' => 0, 'round' => 1, 'bevel' => 2);
			if (isset($ja[$join])) {
				$this->linestyleJoin = $ja[$join].' j';
				$s .= $this->linestyleJoin.' ';
			}
		}
		if (isset($dash)) {
			$dash_string = '';
			if ($dash) {
				if (preg_match('/^.+,/', $dash) > 0) {
					$tab = explode(',', $dash);
				} else {
					$tab = array($dash);
				}
				$dash_string = '';
				foreach ($tab as $i => $v) {
					if ($i) {
						$dash_string .= ' ';
					}
					$dash_string .= sprintf('%.2F', $v);
				}
			}
			if (!isset($phase) OR !$dash) {
				$phase = 0;
			}
			$this->linestyleDash = sprintf('[%s] %.2F d', $dash_string, $phase);
			$s .= $this->linestyleDash.' ';
		}
		if (isset($color)) {
			$s .= $this->SetDrawColorArray($color, true).' ';
		}
		if (!$ret) {
			$this->_out($s);
		}
		return $s;
	}

	/**
	 * Begin a new subpath by moving the current point to coordinates (x, y), omitting any connecting line segment.
	 * @param float $x Abscissa of point.
	 * @param float $y Ordinate of point.
	 * @access protected
	 * @since 2.1.000 (2008-01-08)
	 */
	protected function _outPoint($x, $y) {
		$this->_out(sprintf('%.2F %.2F m', $x * $this->k, ($this->h - $y) * $this->k));
	}

	/**
	 * Append a straight line segment from the current point to the point (x, y).
	 * The new current point shall be (x, y).
	 * @param float $x Abscissa of end point.
	 * @param float $y Ordinate of end point.
	 * @access protected
	 * @since 2.1.000 (2008-01-08)
	 */
	protected function _outLine($x, $y) {
		$this->_out(sprintf('%.2F %.2F l', $x * $this->k, ($this->h - $y) * $this->k));
	}

	/**
	 * Append a rectangle to the current path as a complete subpath, with lower-left corner (x, y) and dimensions widthand height in user space.
	 * @param float $x Abscissa of upper-left corner (or upper-right corner for RTL language).
	 * @param float $y Ordinate of upper-left corner (or upper-right corner for RTL language).
	 * @param float $w Width.
	 * @param float $h Height.
	 * @param string $op options
	 * @access protected
	 * @since 2.1.000 (2008-01-08)
	 */
	protected function _outRect($x, $y, $w, $h, $op) {
		$this->_out(sprintf('%.2F %.2F %.2F %.2F re %s', $x * $this->k, ($this->h - $y) * $this->k, $w * $this->k, -$h * $this->k, $op));
	}

	/**
	 * Append a cubic Bézier curve to the current path. The curve shall extend from the current point to the point (x3, y3), using (x1, y1) and (x2, y2) as the Bézier control points.
	 * The new current point shall be (x3, y3).
	 * @param float $x1 Abscissa of control point 1.
	 * @param float $y1 Ordinate of control point 1.
	 * @param float $x2 Abscissa of control point 2.
	 * @param float $y2 Ordinate of control point 2.
	 * @param float $x3 Abscissa of end point.
	 * @param float $y3 Ordinate of end point.
	 * @access protected
	 * @since 2.1.000 (2008-01-08)
	 */
	protected function _outCurve($x1, $y1, $x2, $y2, $x3, $y3) {
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c', $x1 * $this->k, ($this->h - $y1) * $this->k, $x2 * $this->k, ($this->h - $y2) * $this->k, $x3 * $this->k, ($this->h - $y3) * $this->k));
	}

	/**
	 * Append a cubic Bézier curve to the current path. The curve shall extend from the current point to the point (x3, y3), using the current point and (x2, y2) as the Bézier control points.
	 * The new current point shall be (x3, y3).
	 * @param float $x2 Abscissa of control point 2.
	 * @param float $y2 Ordinate of control point 2.
	 * @param float $x3 Abscissa of end point.
	 * @param float $y3 Ordinate of end point.
	 * @access protected
	 * @since 4.9.019 (2010-04-26)
	 */
	protected function _outCurveV($x2, $y2, $x3, $y3) {
		$this->_out(sprintf('%.2F %.2F %.2F %.2F v', $x2 * $this->k, ($this->h - $y2) * $this->k, $x3 * $this->k, ($this->h - $y3) * $this->k));
	}

	/**
	 * Append a cubic Bézier curve to the current path. The curve shall extend from the current point to the point (x3, y3), using (x1, y1) and (x3, y3) as the Bézier control points.
	 * The new current point shall be (x3, y3).
	 * @param float $x1 Abscissa of control point 1.
	 * @param float $y1 Ordinate of control point 1.
	 * @param float $x2 Abscissa of control point 2.
	 * @param float $y2 Ordinate of control point 2.
	 * @param float $x3 Abscissa of end point.
	 * @param float $y3 Ordinate of end point.
	 * @access protected
	 * @since 2.1.000 (2008-01-08)
	 */
	protected function _outCurveY($x1, $y1, $x3, $y3) {
		$this->_out(sprintf('%.2F %.2F %.2F %.2F y', $x1 * $this->k, ($this->h - $y1) * $this->k, $x3 * $this->k, ($this->h - $y3) * $this->k));
	}

	/**
	 * Draws a line between two points.
	 * @param float $x1 Abscissa of first point.
	 * @param float $y1 Ordinate of first point.
	 * @param float $x2 Abscissa of second point.
	 * @param float $y2 Ordinate of second point.
	 * @param array $style Line style. Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @access public
	 * @since 1.0
	 * @see SetLineWidth(), SetDrawColor(), SetLineStyle()
	 */
	public function Line($x1, $y1, $x2, $y2, $style=array()) {
		if (is_array($style)) {
			$this->SetLineStyle($style);
		}
		$this->_outPoint($x1, $y1);
		$this->_outLine($x2, $y2);
		$this->_out('S');
	}

	/**
	 * Draws a rectangle.
	 * @param float $x Abscissa of upper-left corner (or upper-right corner for RTL language).
	 * @param float $y Ordinate of upper-left corner (or upper-right corner for RTL language).
	 * @param float $w Width.
	 * @param float $h Height.
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $border_style Border style of rectangle. Array with keys among the following:
	 * <ul>
	 *	 <li>all: Line style of all borders. Array like for {@link SetLineStyle SetLineStyle}.</li>
	 *	 <li>L, T, R, B or combinations: Line style of left, top, right or bottom border. Array like for {@link SetLineStyle SetLineStyle}.</li>
	 * </ul>
	 * If a key is not present or is null, not draws the border. Default value: default line style (empty array).
	 * @param array $border_style Border style of rectangle. Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(GREY) or array(R,G,B) or array(C,M,Y,K). Default value: default color (empty array).
	 * @access public
	 * @since 1.0
	 * @see SetLineStyle()
	 */
	public function Rect($x, $y, $w, $h, $style='', $border_style=array(), $fill_color=array()) {
		if (!(false === strpos($style, 'F')) AND !empty($fill_color)) {
			$this->SetFillColorArray($fill_color);
		}
		$op = $this->getPathPaintOperator($style);
		if ((!$border_style) OR (isset($border_style['all']))) {
			if (isset($border_style['all']) AND $border_style['all']) {
				$this->SetLineStyle($border_style['all']);
				$border_style = array();
			}
		}
		$this->_outRect($x, $y, $w, $h, $op);
		if ($border_style) {
			$border_style2 = array();
			foreach ($border_style as $line => $value) {
				$length = strlen($line);
				for ($i = 0; $i < $length; ++$i) {
					$border_style2[$line[$i]] = $value;
				}
			}
			$border_style = $border_style2;
			if (isset($border_style['L']) AND $border_style['L']) {
				$this->Line($x, $y, $x, $y + $h, $border_style['L']);
			}
			if (isset($border_style['T']) AND $border_style['T']) {
				$this->Line($x, $y, $x + $w, $y, $border_style['T']);
			}
			if (isset($border_style['R']) AND $border_style['R']) {
				$this->Line($x + $w, $y, $x + $w, $y + $h, $border_style['R']);
			}
			if (isset($border_style['B']) AND $border_style['B']) {
				$this->Line($x, $y + $h, $x + $w, $y + $h, $border_style['B']);
			}
		}
	}

	/**
	 * Draws a Bezier curve.
	 * The Bezier curve is a tangent to the line between the control points at
	 * either end of the curve.
	 * @param float $x0 Abscissa of start point.
	 * @param float $y0 Ordinate of start point.
	 * @param float $x1 Abscissa of control point 1.
	 * @param float $y1 Ordinate of control point 1.
	 * @param float $x2 Abscissa of control point 2.
	 * @param float $y2 Ordinate of control point 2.
	 * @param float $x3 Abscissa of end point.
	 * @param float $y3 Ordinate of end point.
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $line_style Line style of curve. Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(GREY) or array(R,G,B) or array(C,M,Y,K). Default value: default color (empty array).
	 * @access public
	 * @see SetLineStyle()
	 * @since 2.1.000 (2008-01-08)
	 */
	public function Curve($x0, $y0, $x1, $y1, $x2, $y2, $x3, $y3, $style='', $line_style=array(), $fill_color=array()) {
		if (!(false === strpos($style, 'F')) AND isset($fill_color)) {
			$this->SetFillColorArray($fill_color);
		}
		$op = $this->getPathPaintOperator($style);
		if ($line_style) {
			$this->SetLineStyle($line_style);
		}
		$this->_outPoint($x0, $y0);
		$this->_outCurve($x1, $y1, $x2, $y2, $x3, $y3);
		$this->_out($op);
	}

	/**
	 * Draws a poly-Bezier curve.
	 * Each Bezier curve segment is a tangent to the line between the control points at
	 * either end of the curve.
	 * @param float $x0 Abscissa of start point.
	 * @param float $y0 Ordinate of start point.
	 * @param float $segments An array of bezier descriptions. Format: array(x1, y1, x2, y2, x3, y3).
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $line_style Line style of curve. Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(GREY) or array(R,G,B) or array(C,M,Y,K). Default value: default color (empty array).
	 * @access public
	 * @see SetLineStyle()
	 * @since 3.0008 (2008-05-12)
	 */
	public function Polycurve($x0, $y0, $segments, $style='', $line_style=array(), $fill_color=array()) {
		if (!(false === strpos($style, 'F')) AND isset($fill_color)) {
			$this->SetFillColorArray($fill_color);
		}
		$op = $this->getPathPaintOperator($style);
		if ($op == 'f') {
			$line_style = array();
		}
		if ($line_style) {
			$this->SetLineStyle($line_style);
		}
		$this->_outPoint($x0, $y0);
		foreach ($segments as $segment) {
			list($x1, $y1, $x2, $y2, $x3, $y3) = $segment;
			$this->_outCurve($x1, $y1, $x2, $y2, $x3, $y3);
		}
		$this->_out($op);
	}

	/**
	 * Draws an ellipse.
	 * An ellipse is formed from n Bezier curves.
	 * @param float $x0 Abscissa of center point.
	 * @param float $y0 Ordinate of center point.
	 * @param float $rx Horizontal radius.
	 * @param float $ry Vertical radius (if ry = 0 then is a circle, see {@link Circle Circle}). Default value: 0.
	 * @param float $angle: Angle oriented (anti-clockwise). Default value: 0.
	 * @param float $astart: Angle start of draw line. Default value: 0.
	 * @param float $afinish: Angle finish of draw line. Default value: 360.
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $line_style Line style of ellipse. Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(GREY) or array(R,G,B) or array(C,M,Y,K). Default value: default color (empty array).
	 * @param integer $nc Number of curves used to draw a 90 degrees portion of ellipse.
	 * @author Nicola Asuni
	 * @access public
	 * @since 2.1.000 (2008-01-08)
	 */
	public function Ellipse($x0, $y0, $rx, $ry='', $angle=0, $astart=0, $afinish=360, $style='', $line_style=array(), $fill_color=array(), $nc=2) {
		if ($this->empty_string($ry) OR ($ry == 0)) {
			$ry = $rx;
		}
		if (!(false === strpos($style, 'F')) AND isset($fill_color)) {
			$this->SetFillColorArray($fill_color);
		}
		$op = $this->getPathPaintOperator($style);
		if ($op == 'f') {
			$line_style = array();
		}
		if ($line_style) {
			$this->SetLineStyle($line_style);
		}
		$this->_outellipticalarc($x0, $y0, $rx, $ry, $angle, $astart, $afinish, false, $nc);
		$this->_out($op);
	}

	/**
	 * Append an elliptical arc to the current path.
	 * An ellipse is formed from n Bezier curves.
	 * @param float $xc Abscissa of center point.
	 * @param float $yc Ordinate of center point.
	 * @param float $rx Horizontal radius.
	 * @param float $ry Vertical radius (if ry = 0 then is a circle, see {@link Circle Circle}). Default value: 0.
	 * @param float $xang: Angle between the X-axis and the major axis of the ellipse. Default value: 0.
	 * @param float $angs: Angle start of draw line. Default value: 0.
	 * @param float $angf: Angle finish of draw line. Default value: 360.
	 * @param boolean $pie if true do not mark the border point (used to draw pie sectors).
	 * @param integer $nc Number of curves used to draw a 90 degrees portion of ellipse.
	 * @author Nicola Asuni
	 * @access protected
	 * @since 4.9.019 (2010-04-26)
	 */
	protected function _outellipticalarc($xc, $yc, $rx, $ry, $xang=0, $angs=0, $angf=360, $pie=false, $nc=2) {
		$k = $this->k;
		if ($nc < 2) {
			$nc = 2;
		}
		if ($pie) {
			// center of the arc
			$this->_outPoint($xc, $yc);
		}
		$xang = deg2rad((float) $xang);
		$angs = deg2rad((float) $angs);
		$angf = deg2rad((float) $angf);
		$as = atan2((sin($angs) / $ry), (cos($angs) / $rx));
		$af = atan2((sin($angf) / $ry), (cos($angf) / $rx));
		if ($as < 0) {
			$as += (2 * M_PI);
		}
		if ($af < 0) {
			$af += (2 * M_PI);
		}
		if ($as > $af) {
			// reverse rotation go clockwise
			$as -= (2 * M_PI);
		}
		$total_angle = ($af - $as);
		if ($nc < 2) {
			$nc = 2;
		}
		// total arcs to draw
		$nc *= (2 * abs($total_angle) / M_PI);
		$nc = round($nc) + 1;
		// angle of each arc
		$arcang = $total_angle / $nc;
		// center point in PDF coordiantes
		$x0 = $xc;
		$y0 = ($this->h - $yc);
		// starting angle
		$ang = $as;
		$alpha = sin($arcang) * ((sqrt(4 + (3 * pow(tan(($arcang) / 2), 2))) - 1) / 3);
		$cos_xang = cos($xang);
		$sin_xang = sin($xang);
		$cos_ang = cos($ang);
		$sin_ang = sin($ang);
		// first arc point
		$px1 = $x0 + ($rx * $cos_xang * $cos_ang) - ($ry * $sin_xang * $sin_ang);
		$py1 = $y0 + ($rx * $sin_xang * $cos_ang) + ($ry * $cos_xang * $sin_ang);
		// first Bezier control point
		$qx1 = ($alpha * ((-$rx * $cos_xang * $sin_ang) - ($ry * $sin_xang * $cos_ang)));
		$qy1 = ($alpha * ((-$rx * $sin_xang * $sin_ang) + ($ry * $cos_xang * $cos_ang)));
		if ($pie) {
			$this->_outLine($px1, $this->h - $py1);
		} else {
			$this->_outPoint($px1, $this->h - $py1);
		}
		// draw arcs
		for ($i = 1; $i <= $nc; ++$i) {
			// starting angle
			$ang = $as + ($i * $arcang);
			$cos_xang = cos($xang);
			$sin_xang = sin($xang);
			$cos_ang = cos($ang);
			$sin_ang = sin($ang);
			// second arc point
			$px2 = $x0 + ($rx * $cos_xang * $cos_ang) - ($ry * $sin_xang * $sin_ang);
			$py2 = $y0 + ($rx * $sin_xang * $cos_ang) + ($ry * $cos_xang * $sin_ang);
			// second Bezier control point
			$qx2 = ($alpha * ((-$rx * $cos_xang * $sin_ang) - ($ry * $sin_xang * $cos_ang)));
			$qy2 = ($alpha * ((-$rx * $sin_xang * $sin_ang) + ($ry * $cos_xang * $cos_ang)));
			// draw arc
			$this->_outCurve(($px1 + $qx1), ($this->h - ($py1 + $qy1)), ($px2 - $qx2), ($this->h - ($py2 - $qy2)), $px2, ($this->h - $py2));
			// move to next point
			$px1 = $px2;
			$py1 = $py2;
			$qx1 = $qx2;
			$qy1 = $qy2;
		}
		if ($pie) {
			$this->_outLine($xc, $yc);
		}
	}

	/**
	 * Draws a circle.
	 * A circle is formed from n Bezier curves.
	 * @param float $x0 Abscissa of center point.
	 * @param float $y0 Ordinate of center point.
	 * @param float $r Radius.
	 * @param float $angstr: Angle start of draw line. Default value: 0.
	 * @param float $angend: Angle finish of draw line. Default value: 360.
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $line_style Line style of circle. Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(red, green, blue). Default value: default color (empty array).
	 * @param integer $nc Number of curves used to draw a 90 degrees portion of circle.
	 * @access public
	 * @since 2.1.000 (2008-01-08)
	 */
	public function Circle($x0, $y0, $r, $angstr=0, $angend=360, $style='', $line_style=array(), $fill_color=array(), $nc=2) {
		$this->Ellipse($x0, $y0, $r, $r, 0, $angstr, $angend, $style, $line_style, $fill_color, $nc);
	}

	/**
	 * Draws a polygonal line
	 * @param array $p Points 0 to ($np - 1). Array with values (x0, y0, x1, y1,..., x(np-1), y(np - 1))
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $line_style Line style of polygon. Array with keys among the following:
	 * <ul>
	 *	 <li>all: Line style of all lines. Array like for {@link SetLineStyle SetLineStyle}.</li>
	 *	 <li>0 to ($np - 1): Line style of each line. Array like for {@link SetLineStyle SetLineStyle}.</li>
	 * </ul>
	 * If a key is not present or is null, not draws the line. Default value is default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(GREY) or array(R,G,B) or array(C,M,Y,K). Default value: default color (empty array).
	 * @param boolean $closed if true the polygon is closes, otherwise will remain open
	 * @access public
	 * @since 4.8.003 (2009-09-15)
	 */
	public function PolyLine($p, $style='', $line_style=array(), $fill_color=array()) {
		$this->Polygon($p, $style, $line_style, $fill_color, false);
	}

	/**
	 * Draws a polygon.
	 * @param array $p Points 0 to ($np - 1). Array with values (x0, y0, x1, y1,..., x(np-1), y(np - 1))
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $line_style Line style of polygon. Array with keys among the following:
	 * <ul>
	 *	 <li>all: Line style of all lines. Array like for {@link SetLineStyle SetLineStyle}.</li>
	 *	 <li>0 to ($np - 1): Line style of each line. Array like for {@link SetLineStyle SetLineStyle}.</li>
	 * </ul>
	 * If a key is not present or is null, not draws the line. Default value is default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(GREY) or array(R,G,B) or array(C,M,Y,K). Default value: default color (empty array).
	 * @param boolean $closed if true the polygon is closes, otherwise will remain open
	 * @access public
	 * @since 2.1.000 (2008-01-08)
	 */
	public function Polygon($p, $style='', $line_style=array(), $fill_color=array(), $closed=true) {
		$nc = count($p); // number of coordinates
		$np = $nc / 2; // number of points
		if ($closed) {
			// close polygon by adding the first 2 points at the end (one line)
			for ($i = 0; $i < 4; ++$i) {
				$p[$nc + $i] = $p[$i];
			}
			// copy style for the last added line
			if (isset($line_style[0])) {
				$line_style[$np] = $line_style[0];
			}
			$nc += 4;
		}
		if (!(false === strpos($style, 'F')) AND isset($fill_color)) {
			$this->SetFillColorArray($fill_color);
		}
		$op = $this->getPathPaintOperator($style);
		if ($op == 'f') {
			$line_style = array();
		}
		$draw = true;
		if ($line_style) {
			if (isset($line_style['all'])) {
				$this->SetLineStyle($line_style['all']);
			} else {
				$draw = false;
				if ($op == 'B') {
					// draw fill
					$op = 'f';
					$this->_outPoint($p[0], $p[1]);
					for ($i = 2; $i < $nc; $i = $i + 2) {
						$this->_outLine($p[$i], $p[$i + 1]);
					}
					$this->_out($op);
				}
				// draw outline
				$this->_outPoint($p[0], $p[1]);
				for ($i = 2; $i < $nc; $i = $i + 2) {
					$line_num = ($i / 2) - 1;
					if (isset($line_style[$line_num])) {
						if ($line_style[$line_num] != 0) {
							if (is_array($line_style[$line_num])) {
								$this->_out('S');
								$this->SetLineStyle($line_style[$line_num]);
								$this->_outPoint($p[$i - 2], $p[$i - 1]);
								$this->_outLine($p[$i], $p[$i + 1]);
								$this->_out('S');
								$this->_outPoint($p[$i], $p[$i + 1]);
							} else {
								$this->_outLine($p[$i], $p[$i + 1]);
							}
						}
					} else {
						$this->_outLine($p[$i], $p[$i + 1]);
					}
				}
				$this->_out($op);
			}
		}
		if ($draw) {
			$this->_outPoint($p[0], $p[1]);
			for ($i = 2; $i < $nc; $i = $i + 2) {
				$this->_outLine($p[$i], $p[$i + 1]);
			}
			$this->_out($op);
		}
	}

	/**
	 * Draws a regular polygon.
	 * @param float $x0 Abscissa of center point.
	 * @param float $y0 Ordinate of center point.
	 * @param float $r: Radius of inscribed circle.
	 * @param integer $ns Number of sides.
	 * @param float $angle Angle oriented (anti-clockwise). Default value: 0.
	 * @param boolean $draw_circle Draw inscribed circle or not. Default value: false.
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $line_style Line style of polygon sides. Array with keys among the following:
	 * <ul>
	 *	 <li>all: Line style of all sides. Array like for {@link SetLineStyle SetLineStyle}.</li>
	 *	 <li>0 to ($ns - 1): Line style of each side. Array like for {@link SetLineStyle SetLineStyle}.</li>
	 * </ul>
	 * If a key is not present or is null, not draws the side. Default value is default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(red, green, blue). Default value: default color (empty array).
	 * @param string $circle_style Style of rendering of inscribed circle (if draws). Possible values are:
	 * <ul>
	 *	 <li>D or empty string: Draw (default).</li>
	 *	 <li>F: Fill.</li>
	 *	 <li>DF or FD: Draw and fill.</li>
	 *	 <li>CNZ: Clipping mode (using the even-odd rule to determine which regions lie inside the clipping path).</li>
	 *	 <li>CEO: Clipping mode (using the nonzero winding number rule to determine which regions lie inside the clipping path).</li>
	 * </ul>
	 * @param array $circle_outLine_style Line style of inscribed circle (if draws). Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @param array $circle_fill_color Fill color of inscribed circle (if draws). Format: array(red, green, blue). Default value: default color (empty array).
	 * @access public
	 * @since 2.1.000 (2008-01-08)
	 */
	public function RegularPolygon($x0, $y0, $r, $ns, $angle=0, $draw_circle=false, $style='', $line_style=array(), $fill_color=array(), $circle_style='', $circle_outLine_style=array(), $circle_fill_color=array()) {
		if (3 > $ns) {
			$ns = 3;
		}
		if ($draw_circle) {
			$this->Circle($x0, $y0, $r, 0, 360, $circle_style, $circle_outLine_style, $circle_fill_color);
		}
		$p = array();
		for ($i = 0; $i < $ns; ++$i) {
			$a = $angle + ($i * 360 / $ns);
			$a_rad = deg2rad((float) $a);
			$p[] = $x0 + ($r * sin($a_rad));
			$p[] = $y0 + ($r * cos($a_rad));
		}
		$this->Polygon($p, $style, $line_style, $fill_color);
	}

	/**
	 * Draws a star polygon
	 * @param float $x0 Abscissa of center point.
	 * @param float $y0 Ordinate of center point.
	 * @param float $r Radius of inscribed circle.
	 * @param integer $nv Number of vertices.
	 * @param integer $ng Number of gap (if ($ng % $nv = 1) then is a regular polygon).
	 * @param float $angle: Angle oriented (anti-clockwise). Default value: 0.
	 * @param boolean $draw_circle: Draw inscribed circle or not. Default value is false.
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $line_style Line style of polygon sides. Array with keys among the following:
	 * <ul>
	 *	 <li>all: Line style of all sides. Array like for
	 * {@link SetLineStyle SetLineStyle}.</li>
	 *	 <li>0 to (n - 1): Line style of each side. Array like for {@link SetLineStyle SetLineStyle}.</li>
	 * </ul>
	 * If a key is not present or is null, not draws the side. Default value is default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(red, green, blue). Default value: default color (empty array).
	 * @param string $circle_style Style of rendering of inscribed circle (if draws). Possible values are:
	 * <ul>
	 *	 <li>D or empty string: Draw (default).</li>
	 *	 <li>F: Fill.</li>
	 *	 <li>DF or FD: Draw and fill.</li>
	 *	 <li>CNZ: Clipping mode (using the even-odd rule to determine which regions lie inside the clipping path).</li>
	 *	 <li>CEO: Clipping mode (using the nonzero winding number rule to determine which regions lie inside the clipping path).</li>
	 * </ul>
	 * @param array $circle_outLine_style Line style of inscribed circle (if draws). Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @param array $circle_fill_color Fill color of inscribed circle (if draws). Format: array(red, green, blue). Default value: default color (empty array).
	 * @access public
	 * @since 2.1.000 (2008-01-08)
	 */
	public function StarPolygon($x0, $y0, $r, $nv, $ng, $angle=0, $draw_circle=false, $style='', $line_style=array(), $fill_color=array(), $circle_style='', $circle_outLine_style=array(), $circle_fill_color=array()) {
		if ($nv < 2) {
			$nv = 2;
		}
		if ($draw_circle) {
			$this->Circle($x0, $y0, $r, 0, 360, $circle_style, $circle_outLine_style, $circle_fill_color);
		}
		$p2 = array();
		$visited = array();
		for ($i = 0; $i < $nv; ++$i) {
			$a = $angle + ($i * 360 / $nv);
			$a_rad = deg2rad((float) $a);
			$p2[] = $x0 + ($r * sin($a_rad));
			$p2[] = $y0 + ($r * cos($a_rad));
			$visited[] = false;
		}
		$p = array();
		$i = 0;
		do {
			$p[] = $p2[$i * 2];
			$p[] = $p2[($i * 2) + 1];
			$visited[$i] = true;
			$i += $ng;
			$i %= $nv;
		} while (!$visited[$i]);
		$this->Polygon($p, $style, $line_style, $fill_color);
	}

	/**
	 * Draws a rounded rectangle.
	 * @param float $x Abscissa of upper-left corner.
	 * @param float $y Ordinate of upper-left corner.
	 * @param float $w Width.
	 * @param float $h Height.
	 * @param float $r the radius of the circle used to round off the corners of the rectangle.
	 * @param string $round_corner Draws rounded corner or not. String with a 0 (not rounded i-corner) or 1 (rounded i-corner) in i-position. Positions are, in order and begin to 0: top left, top right, bottom right and bottom left. Default value: all rounded corner ("1111").
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $border_style Border style of rectangle. Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(GREY) or array(R,G,B) or array(C,M,Y,K). Default value: default color (empty array).
	 * @access public
	 * @since 2.1.000 (2008-01-08)
	 */
	public function RoundedRect($x, $y, $w, $h, $r, $round_corner='1111', $style='', $border_style=array(), $fill_color=array()) {
		$this->RoundedRectXY($x, $y, $w, $h, $r, $r, $round_corner, $style, $border_style, $fill_color);
	}

	/**
	 * Draws a rounded rectangle.
	 * @param float $x Abscissa of upper-left corner.
	 * @param float $y Ordinate of upper-left corner.
	 * @param float $w Width.
	 * @param float $h Height.
	 * @param float $rx the x-axis radius of the ellipse used to round off the corners of the rectangle.
	 * @param float $ry the y-axis radius of the ellipse used to round off the corners of the rectangle.
	 * @param string $round_corner Draws rounded corner or not. String with a 0 (not rounded i-corner) or 1 (rounded i-corner) in i-position. Positions are, in order and begin to 0: top left, top right, bottom right and bottom left. Default value: all rounded corner ("1111").
	 * @param string $style Style of rendering. See the getPathPaintOperator() function for more information.
	 * @param array $border_style Border style of rectangle. Array like for {@link SetLineStyle SetLineStyle}. Default value: default line style (empty array).
	 * @param array $fill_color Fill color. Format: array(GREY) or array(R,G,B) or array(C,M,Y,K). Default value: default color (empty array).
	 * @access public
	 * @since 4.9.019 (2010-04-22)
	 */
	public function RoundedRectXY($x, $y, $w, $h, $rx, $ry, $round_corner='1111', $style='', $border_style=array(), $fill_color=array()) {
		if (($round_corner == '0000') OR (($rx == $ry) AND ($rx == 0))) {
			// Not rounded
			$this->Rect($x, $y, $w, $h, $style, $border_style, $fill_color);
			return;
		}
		// Rounded
		if (!(false === strpos($style, 'F')) AND isset($fill_color)) {
			$this->SetFillColorArray($fill_color);
		}
		$op = $this->getPathPaintOperator($style);
		if ($op == 'f') {
			$border_style = array();
		}
		if ($border_style) {
			$this->SetLineStyle($border_style);
		}
		$MyArc = 4 / 3 * (sqrt(2) - 1);
		$this->_outPoint($x + $rx, $y);
		$xc = $x + $w - $rx;
		$yc = $y + $ry;
		$this->_outLine($xc, $y);
		if ($round_corner[0]) {
			$this->_outCurve($xc + ($rx * $MyArc), $yc - $ry, $xc + $rx, $yc - ($ry * $MyArc), $xc + $rx, $yc);
		} else {
			$this->_outLine($x + $w, $y);
		}
		$xc = $x + $w - $rx;
		$yc = $y + $h - $ry;
		$this->_outLine($x + $w, $yc);
		if ($round_corner[1]) {
			$this->_outCurve($xc + $rx, $yc + ($ry * $MyArc), $xc + ($rx * $MyArc), $yc + $ry, $xc, $yc + $ry);
		} else {
			$this->_outLine($x + $w, $y + $h);
		}
		$xc = $x + $rx;
		$yc = $y + $h - $ry;
		$this->_outLine($xc, $y + $h);
		if ($round_corner[2]) {
			$this->_outCurve($xc - ($rx * $MyArc), $yc + $ry, $xc - $rx, $yc + ($ry * $MyArc), $xc - $rx, $yc);
		} else {
			$this->_outLine($x, $y + $h);
		}
		$xc = $x + $rx;
		$yc = $y + $ry;
		$this->_outLine($x, $yc);
		if ($round_corner[3]) {
			$this->_outCurve($xc - $rx, $yc - ($ry * $MyArc), $xc - ($rx * $MyArc), $yc - $ry, $xc, $yc - $ry);
		} else {
			$this->_outLine($x, $y);
			$this->_outLine($x + $rx, $y);
		}
		$this->_out($op);
	}

	/**
	 * Draws a grahic arrow.
	 * @param float $x0 Abscissa of first point.
	 * @param float $y0 Ordinate of first point.
	 * @param float $x0 Abscissa of second point.
	 * @param float $y1 Ordinate of second point.
	 * @param int $head_style (0 = draw only arrowhead arms, 1 = draw closed arrowhead, but no fill, 2 = closed and filled arrowhead, 3 = filled arrowhead)
	 * @param float $arm_size length of arrowhead arms
	 * @param int $arm_angle angle between an arm and the shaft
	 * @author Piotr Galecki, Nicola Asuni, Andy Meier
	 * @since 4.6.018 (2009-07-10)
	 */
	public function Arrow($x0, $y0, $x1, $y1, $head_style=0, $arm_size=5, $arm_angle=15) {
		// getting arrow direction angle
		// 0 deg angle is when both arms go along X axis. angle grows clockwise.
		$dir_angle = atan2(($y0 - $y1), ($x0 - $x1));
		if ($dir_angle < 0) {
			$dir_angle += (2 * M_PI);
		}
		$arm_angle = deg2rad($arm_angle);
		$sx1 = $x1;
		$sy1 = $y1;
		if ($head_style > 0) {
			// calculate the stopping point for the arrow shaft
			$sx1 = $x1 + (($arm_size - $this->LineWidth) * cos($dir_angle));
			$sy1 = $y1 + (($arm_size - $this->LineWidth) * sin($dir_angle));
		}
		// main arrow line / shaft
		$this->Line($x0, $y0, $sx1, $sy1);
		// left arrowhead arm tip
		$x2L = $x1 + ($arm_size * cos($dir_angle + $arm_angle));
		$y2L = $y1 + ($arm_size * sin($dir_angle + $arm_angle));
		// right arrowhead arm tip
		$x2R = $x1 + ($arm_size * cos($dir_angle - $arm_angle));
		$y2R = $y1 + ($arm_size * sin($dir_angle - $arm_angle));
		$mode = 'D';
		$style = array();
		switch ($head_style) {
			case 0: {
				// draw only arrowhead arms
				$mode = 'D';
				$style = array(1, 1, 0);
				break;
			}
			case 1: {
				// draw closed arrowhead, but no fill
				$mode = 'D';
				break;
			}
			case 2: {
				// closed and filled arrowhead
				$mode = 'DF';
				break;
			}
			case 3: {
				// filled arrowhead
				$mode = 'F';
				break;
			}
		}
		$this->Polygon(array($x2L, $y2L, $x1, $y1, $x2R, $y2R), $mode, $style, array());
	}

	// END GRAPHIC FUNCTIONS SECTION -----------------------

	// BIDIRECTIONAL TEXT SECTION --------------------------

	/**
	 * Reverse the RLT substrings using the Bidirectional Algorithm (http://unicode.org/reports/tr9/).
	 * @param string $str string to manipulate.
	 * @param bool $setbom if true set the Byte Order Mark (BOM = 0xFEFF)
	 * @param bool $forcertl if true forces RTL text direction
	 * @return string
	 * @access protected
	 * @author Nicola Asuni
	 * @since 2.1.000 (2008-01-08)
	 */
	protected function utf8StrRev($str, $setbom=false, $forcertl=false) {
		return $this->utf8StrArrRev($this->UTF8StringToArray($str), $str, $setbom, $forcertl);
	}

	/**
	 * Reverse the RLT substrings array using the Bidirectional Algorithm (http://unicode.org/reports/tr9/).
	 * @param array $arr array of unicode values.
	 * @param string $str string to manipulate (or empty value).
	 * @param bool $setbom if true set the Byte Order Mark (BOM = 0xFEFF)
	 * @param bool $forcertl if true forces RTL text direction
	 * @return string
	 * @access protected
	 * @author Nicola Asuni
	 * @since 4.9.000 (2010-03-27)
	 */
	protected function utf8StrArrRev($arr, $str='', $setbom=false, $forcertl=false) {
		return $this->arrUTF8ToUTF16BE($this->utf8Bidi($arr, $str, $forcertl), $setbom);
	}

	/**
	 * Reverse the RLT substrings using the Bidirectional Algorithm (http://unicode.org/reports/tr9/).
	 * @param array $ta array of characters composing the string.
	 * @param string $str string to process
	 * @param bool $forcertl if 'R' forces RTL, if 'L' forces LTR
	 * @return array of unicode chars
	 * @author Nicola Asuni
	 * @access protected
	 * @since 2.4.000 (2008-03-06)
	 */
	protected function utf8Bidi($ta, $str='', $forcertl=false) {
		// paragraph embedding level
		$pel = 0;
		// max level
		$maxlevel = 0;
		if ($this->empty_string($str)) {
			// create string from array
			$str = $this->UTF8ArrSubString($ta);
		}
		// check if string contains arabic text
		if (preg_match($this->unicode->uni_RE_PATTERN_ARABIC, $str)) {
			$arabic = true;
		} else {
			$arabic = false;
		}
		// check if string contains RTL text
		if (!($forcertl OR $arabic OR preg_match($this->unicode->uni_RE_PATTERN_RTL, $str))) {
			return $ta;
		}

		// get number of chars
		$numchars = count($ta);

		if ($forcertl == 'R') {
			$pel = 1;
		} elseif ($forcertl == 'L') {
			$pel = 0;
		} else {
			// P2. In each paragraph, find the first character of type L, AL, or R.
			// P3. If a character is found in P2 and it is of type AL or R, then set the paragraph embedding level to one; otherwise, set it to zero.
			for ($i=0; $i < $numchars; ++$i) {
				$type = $this->unicode->uni_type[$ta[$i]];
				if ($type == 'L') {
					$pel = 0;
					break;
				} elseif (($type == 'AL') OR ($type == 'R')) {
					$pel = 1;
					break;
				}
			}
		}

		// Current Embedding Level
		$cel = $pel;
		// directional override status
		$dos = 'N';
		$remember = array();
		// start-of-level-run
		$sor = $pel % 2 ? 'R' : 'L';
		$eor = $sor;

		// Array of characters data
		$chardata = Array();

		// X1. Begin by setting the current embedding level to the paragraph embedding level. Set the directional override status to neutral. Process each character iteratively, applying rules X2 through X9. Only embedding levels from 0 to 61 are valid in this phase.
		// 	In the resolution of levels in rules I1 and I2, the maximum embedding level of 62 can be reached.
		for ($i=0; $i < $numchars; ++$i) {
			if ($ta[$i] == $this->unicode->uni_RLE) {
				// X2. With each RLE, compute the least greater odd embedding level.
				//	a. If this new level would be valid, then this embedding code is valid. Remember (push) the current embedding level and override status. Reset the current level to this new level, and reset the override status to neutral.
				//	b. If the new level would not be valid, then this code is invalid. Do not change the current level or override status.
				$next_level = $cel + ($cel % 2) + 1;
				if ($next_level < 62) {
					$remember[] = array('num' => $this->unicode->uni_RLE, 'cel' => $cel, 'dos' => $dos);
					$cel = $next_level;
					$dos = 'N';
					$sor = $eor;
					$eor = $cel % 2 ? 'R' : 'L';
				}
			} elseif ($ta[$i] == $this->unicode->uni_LRE) {
				// X3. With each LRE, compute the least greater even embedding level.
				//	a. If this new level would be valid, then this embedding code is valid. Remember (push) the current embedding level and override status. Reset the current level to this new level, and reset the override status to neutral.
				//	b. If the new level would not be valid, then this code is invalid. Do not change the current level or override status.
				$next_level = $cel + 2 - ($cel % 2);
				if ( $next_level < 62 ) {
					$remember[] = array('num' => $this->unicode->uni_LRE, 'cel' => $cel, 'dos' => $dos);
					$cel = $next_level;
					$dos = 'N';
					$sor = $eor;
					$eor = $cel % 2 ? 'R' : 'L';
				}
			} elseif ($ta[$i] == $this->unicode->uni_RLO) {
				// X4. With each RLO, compute the least greater odd embedding level.
				//	a. If this new level would be valid, then this embedding code is valid. Remember (push) the current embedding level and override status. Reset the current level to this new level, and reset the override status to right-to-left.
				//	b. If the new level would not be valid, then this code is invalid. Do not change the current level or override status.
				$next_level = $cel + ($cel % 2) + 1;
				if ($next_level < 62) {
					$remember[] = array('num' => $this->unicode->uni_RLO, 'cel' => $cel, 'dos' => $dos);
					$cel = $next_level;
					$dos = 'R';
					$sor = $eor;
					$eor = $cel % 2 ? 'R' : 'L';
				}
			} elseif ($ta[$i] == $this->unicode->uni_LRO) {
				// X5. With each LRO, compute the least greater even embedding level.
				//	a. If this new level would be valid, then this embedding code is valid. Remember (push) the current embedding level and override status. Reset the current level to this new level, and reset the override status to left-to-right.
				//	b. If the new level would not be valid, then this code is invalid. Do not change the current level or override status.
				$next_level = $cel + 2 - ($cel % 2);
				if ( $next_level < 62 ) {
					$remember[] = array('num' => $this->unicode->uni_LRO, 'cel' => $cel, 'dos' => $dos);
					$cel = $next_level;
					$dos = 'L';
					$sor = $eor;
					$eor = $cel % 2 ? 'R' : 'L';
				}
			} elseif ($ta[$i] == $this->unicode->uni_PDF) {
				// X7. With each PDF, determine the matching embedding or override code. If there was a valid matching code, restore (pop) the last remembered (pushed) embedding level and directional override.
				if (count($remember)) {
					$last = count($remember ) - 1;
					if (($remember[$last]['num'] == $this->unicode->uni_RLE) OR
						($remember[$last]['num'] == $this->unicode->uni_LRE) OR
						($remember[$last]['num'] == $this->unicode->uni_RLO) OR
						($remember[$last]['num'] == $this->unicode->uni_LRO)) {
						$match = array_pop($remember);
						$cel = $match['cel'];
						$dos = $match['dos'];
						$sor = $eor;
						$eor = ($cel > $match['cel'] ? $cel : $match['cel']) % 2 ? 'R' : 'L';
					}
				}
			} elseif (($ta[$i] != $this->unicode->uni_RLE) AND
							 ($ta[$i] != $this->unicode->uni_LRE) AND
							 ($ta[$i] != $this->unicode->uni_RLO) AND
							 ($ta[$i] != $this->unicode->uni_LRO) AND
							 ($ta[$i] != $this->unicode->uni_PDF)) {
				// X6. For all types besides RLE, LRE, RLO, LRO, and PDF:
				//	a. Set the level of the current character to the current embedding level.
				//	b. Whenever the directional override status is not neutral, reset the current character type to the directional override status.
				if ($dos != 'N') {
					$chardir = $dos;
				} else {
					if (isset($this->unicode->uni_type[$ta[$i]])) {
						$chardir = $this->unicode->uni_type[$ta[$i]];
					} else {
						$chardir = 'L';
					}
				}
				// stores string characters and other information
				$chardata[] = array('char' => $ta[$i], 'level' => $cel, 'type' => $chardir, 'sor' => $sor, 'eor' => $eor);
			}
		} // end for each char

		// X8. All explicit directional embeddings and overrides are completely terminated at the end of each paragraph. Paragraph separators are not included in the embedding.
		// X9. Remove all RLE, LRE, RLO, LRO, PDF, and BN codes.
		// X10. The remaining rules are applied to each run of characters at the same level. For each run, determine the start-of-level-run (sor) and end-of-level-run (eor) type, either L or R. This depends on the higher of the two levels on either side of the boundary (at the start or end of the paragraph, the level of the 'other' run is the base embedding level). If the higher level is odd, the type is R; otherwise, it is L.

		// 3.3.3 Resolving Weak Types
		// Weak types are now resolved one level run at a time. At level run boundaries where the type of the character on the other side of the boundary is required, the type assigned to sor or eor is used.
		// Nonspacing marks are now resolved based on the previous characters.
		$numchars = count($chardata);

		// W1. Examine each nonspacing mark (NSM) in the level run, and change the type of the NSM to the type of the previous character. If the NSM is at the start of the level run, it will get the type of sor.
		$prevlevel = -1; // track level changes
		$levcount = 0; // counts consecutive chars at the same level
		for ($i=0; $i < $numchars; ++$i) {
			if ($chardata[$i]['type'] == 'NSM') {
				if ($levcount) {
					$chardata[$i]['type'] = $chardata[$i]['sor'];
				} elseif ($i > 0) {
					$chardata[$i]['type'] = $chardata[($i-1)]['type'];
				}
			}
			if ($chardata[$i]['level'] != $prevlevel) {
				$levcount = 0;
			} else {
				++$levcount;
			}
			$prevlevel = $chardata[$i]['level'];
		}

		// W2. Search backward from each instance of a European number until the first strong type (R, L, AL, or sor) is found. If an AL is found, change the type of the European number to Arabic number.
		$prevlevel = -1;
		$levcount = 0;
		for ($i=0; $i < $numchars; ++$i) {
			if ($chardata[$i]['char'] == 'EN') {
				for ($j=$levcount; $j >= 0; $j--) {
					if ($chardata[$j]['type'] == 'AL') {
						$chardata[$i]['type'] = 'AN';
					} elseif (($chardata[$j]['type'] == 'L') OR ($chardata[$j]['type'] == 'R')) {
						break;
					}
				}
			}
			if ($chardata[$i]['level'] != $prevlevel) {
				$levcount = 0;
			} else {
				++$levcount;
			}
			$prevlevel = $chardata[$i]['level'];
		}

		// W3. Change all ALs to R.
		for ($i=0; $i < $numchars; ++$i) {
			if ($chardata[$i]['type'] == 'AL') {
				$chardata[$i]['type'] = 'R';
			}
		}

		// W4. A single European separator between two European numbers changes to a European number. A single common separator between two numbers of the same type changes to that type.
		$prevlevel = -1;
		$levcount = 0;
		for ($i=0; $i < $numchars; ++$i) {
			if (($levcount > 0) AND (($i+1) < $numchars) AND ($chardata[($i+1)]['level'] == $prevlevel)) {
				if (($chardata[$i]['type'] == 'ES') AND ($chardata[($i-1)]['type'] == 'EN') AND ($chardata[($i+1)]['type'] == 'EN')) {
					$chardata[$i]['type'] = 'EN';
				} elseif (($chardata[$i]['type'] == 'CS') AND ($chardata[($i-1)]['type'] == 'EN') AND ($chardata[($i+1)]['type'] == 'EN')) {
					$chardata[$i]['type'] = 'EN';
				} elseif (($chardata[$i]['type'] == 'CS') AND ($chardata[($i-1)]['type'] == 'AN') AND ($chardata[($i+1)]['type'] == 'AN')) {
					$chardata[$i]['type'] = 'AN';
				}
			}
			if ($chardata[$i]['level'] != $prevlevel) {
				$levcount = 0;
			} else {
				++$levcount;
			}
			$prevlevel = $chardata[$i]['level'];
		}

		// W5. A sequence of European terminators adjacent to European numbers changes to all European numbers.
		$prevlevel = -1;
		$levcount = 0;
		for ($i=0; $i < $numchars; ++$i) {
			if ($chardata[$i]['type'] == 'ET') {
				if (($levcount > 0) AND ($chardata[($i-1)]['type'] == 'EN')) {
					$chardata[$i]['type'] = 'EN';
				} else {
					$j = $i+1;
					while (($j < $numchars) AND ($chardata[$j]['level'] == $prevlevel)) {
						if ($chardata[$j]['type'] == 'EN') {
							$chardata[$i]['type'] = 'EN';
							break;
						} elseif ($chardata[$j]['type'] != 'ET') {
							break;
						}
						++$j;
					}
				}
			}
			if ($chardata[$i]['level'] != $prevlevel) {
				$levcount = 0;
			} else {
				++$levcount;
			}
			$prevlevel = $chardata[$i]['level'];
		}

		// W6. Otherwise, separators and terminators change to Other Neutral.
		$prevlevel = -1;
		$levcount = 0;
		for ($i=0; $i < $numchars; ++$i) {
			if (($chardata[$i]['type'] == 'ET') OR ($chardata[$i]['type'] == 'ES') OR ($chardata[$i]['type'] == 'CS')) {
				$chardata[$i]['type'] = 'ON';
			}
			if ($chardata[$i]['level'] != $prevlevel) {
				$levcount = 0;
			} else {
				++$levcount;
			}
			$prevlevel = $chardata[$i]['level'];
		}

		//W7. Search backward from each instance of a European number until the first strong type (R, L, or sor) is found. If an L is found, then change the type of the European number to L.
		$prevlevel = -1;
		$levcount = 0;
		for ($i=0; $i < $numchars; ++$i) {
			if ($chardata[$i]['char'] == 'EN') {
				for ($j=$levcount; $j >= 0; $j--) {
					if ($chardata[$j]['type'] == 'L') {
						$chardata[$i]['type'] = 'L';
					} elseif ($chardata[$j]['type'] == 'R') {
						break;
					}
				}
			}
			if ($chardata[$i]['level'] != $prevlevel) {
				$levcount = 0;
			} else {
				++$levcount;
			}
			$prevlevel = $chardata[$i]['level'];
		}

		// N1. A sequence of neutrals takes the direction of the surrounding strong text if the text on both sides has the same direction. European and Arabic numbers act as if they were R in terms of their influence on neutrals. Start-of-level-run (sor) and end-of-level-run (eor) are used at level run boundaries.
		$prevlevel = -1;
		$levcount = 0;
		for ($i=0; $i < $numchars; ++$i) {
			if (($levcount > 0) AND (($i+1) < $numchars) AND ($chardata[($i+1)]['level'] == $prevlevel)) {
				if (($chardata[$i]['type'] == 'N') AND ($chardata[($i-1)]['type'] == 'L') AND ($chardata[($i+1)]['type'] == 'L')) {
					$chardata[$i]['type'] = 'L';
				} elseif (($chardata[$i]['type'] == 'N') AND
				 (($chardata[($i-1)]['type'] == 'R') OR ($chardata[($i-1)]['type'] == 'EN') OR ($chardata[($i-1)]['type'] == 'AN')) AND
				 (($chardata[($i+1)]['type'] == 'R') OR ($chardata[($i+1)]['type'] == 'EN') OR ($chardata[($i+1)]['type'] == 'AN'))) {
					$chardata[$i]['type'] = 'R';
				} elseif ($chardata[$i]['type'] == 'N') {
					// N2. Any remaining neutrals take the embedding direction
					$chardata[$i]['type'] = $chardata[$i]['sor'];
				}
			} elseif (($levcount == 0) AND (($i+1) < $numchars) AND ($chardata[($i+1)]['level'] == $prevlevel)) {
				// first char
				if (($chardata[$i]['type'] == 'N') AND ($chardata[$i]['sor'] == 'L') AND ($chardata[($i+1)]['type'] == 'L')) {
					$chardata[$i]['type'] = 'L';
				} elseif (($chardata[$i]['type'] == 'N') AND
				 (($chardata[$i]['sor'] == 'R') OR ($chardata[$i]['sor'] == 'EN') OR ($chardata[$i]['sor'] == 'AN')) AND
				 (($chardata[($i+1)]['type'] == 'R') OR ($chardata[($i+1)]['type'] == 'EN') OR ($chardata[($i+1)]['type'] == 'AN'))) {
					$chardata[$i]['type'] = 'R';
				} elseif ($chardata[$i]['type'] == 'N') {
					// N2. Any remaining neutrals take the embedding direction
					$chardata[$i]['type'] = $chardata[$i]['sor'];
				}
			} elseif (($levcount > 0) AND ((($i+1) == $numchars) OR (($i+1) < $numchars) AND ($chardata[($i+1)]['level'] != $prevlevel))) {
				//last char
				if (($chardata[$i]['type'] == 'N') AND ($chardata[($i-1)]['type'] == 'L') AND ($chardata[$i]['eor'] == 'L')) {
					$chardata[$i]['type'] = 'L';
				} elseif (($chardata[$i]['type'] == 'N') AND
				 (($chardata[($i-1)]['type'] == 'R') OR ($chardata[($i-1)]['type'] == 'EN') OR ($chardata[($i-1)]['type'] == 'AN')) AND
				 (($chardata[$i]['eor'] == 'R') OR ($chardata[$i]['eor'] == 'EN') OR ($chardata[$i]['eor'] == 'AN'))) {
					$chardata[$i]['type'] = 'R';
				} elseif ($chardata[$i]['type'] == 'N') {
					// N2. Any remaining neutrals take the embedding direction
					$chardata[$i]['type'] = $chardata[$i]['sor'];
				}
			} elseif ($chardata[$i]['type'] == 'N') {
				// N2. Any remaining neutrals take the embedding direction
				$chardata[$i]['type'] = $chardata[$i]['sor'];
			}
			if ($chardata[$i]['level'] != $prevlevel) {
				$levcount = 0;
			} else {
				++$levcount;
			}
			$prevlevel = $chardata[$i]['level'];
		}

		// I1. For all characters with an even (left-to-right) embedding direction, those of type R go up one level and those of type AN or EN go up two levels.
		// I2. For all characters with an odd (right-to-left) embedding direction, those of type L, EN or AN go up one level.
		for ($i=0; $i < $numchars; ++$i) {
			$odd = $chardata[$i]['level'] % 2;
			if ($odd) {
				if (($chardata[$i]['type'] == 'L') OR ($chardata[$i]['type'] == 'AN') OR ($chardata[$i]['type'] == 'EN')) {
					$chardata[$i]['level'] += 1;
				}
			} else {
				if ($chardata[$i]['type'] == 'R') {
					$chardata[$i]['level'] += 1;
				} elseif (($chardata[$i]['type'] == 'AN') OR ($chardata[$i]['type'] == 'EN')) {
					$chardata[$i]['level'] += 2;
				}
			}
			$maxlevel = max($chardata[$i]['level'],$maxlevel);
		}

		// L1. On each line, reset the embedding level of the following characters to the paragraph embedding level:
		//	1. Segment separators,
		//	2. Paragraph separators,
		//	3. Any sequence of whitespace characters preceding a segment separator or paragraph separator, and
		//	4. Any sequence of white space characters at the end of the line.
		for ($i=0; $i < $numchars; ++$i) {
			if (($chardata[$i]['type'] == 'B') OR ($chardata[$i]['type'] == 'S')) {
				$chardata[$i]['level'] = $pel;
			} elseif ($chardata[$i]['type'] == 'WS') {
				$j = $i+1;
				while ($j < $numchars) {
					if ((($chardata[$j]['type'] == 'B') OR ($chardata[$j]['type'] == 'S')) OR
						(($j == ($numchars-1)) AND ($chardata[$j]['type'] == 'WS'))) {
						$chardata[$i]['level'] = $pel;
						break;
					} elseif ($chardata[$j]['type'] != 'WS') {
						break;
					}
					++$j;
				}
			}
		}

		// Arabic Shaping
		// Cursively connected scripts, such as Arabic or Syriac, require the selection of positional character shapes that depend on adjacent characters. Shaping is logically applied after the Bidirectional Algorithm is used and is limited to characters within the same directional run.
		if ($arabic) {
			$endedletter = array(1569,1570,1571,1572,1573,1575,1577,1583,1584,1585,1586,1608,1688);
			$alfletter = array(1570,1571,1573,1575);
			$chardata2 = $chardata;
			$laaletter = false;
			$charAL = array();
			$x = 0;
			for ($i=0; $i < $numchars; ++$i) {
				if (($this->unicode->uni_type[$chardata[$i]['char']] == 'AL') OR ($chardata[$i]['char'] == 32) OR ($chardata[$i]['char'] == 8204)) {
					$charAL[$x] = $chardata[$i];
					$charAL[$x]['i'] = $i;
					$chardata[$i]['x'] = $x;
					++$x;
				}
			}
			$numAL = $x;
			for ($i=0; $i < $numchars; ++$i) {
				$thischar = $chardata[$i];
				if ($i > 0) {
					$prevchar = $chardata[($i-1)];
				} else {
					$prevchar = false;
				}
				if (($i+1) < $numchars) {
					$nextchar = $chardata[($i+1)];
				} else {
					$nextchar = false;
				}
				if ($this->unicode->uni_type[$thischar['char']] == 'AL') {
					$x = $thischar['x'];
					if ($x > 0) {
						$prevchar = $charAL[($x-1)];
					} else {
						$prevchar = false;
					}
					if (($x+1) < $numAL) {
						$nextchar = $charAL[($x+1)];
					} else {
						$nextchar = false;
					}
					// if laa letter
					if (($prevchar !== false) AND ($prevchar['char'] == 1604) AND (in_array($thischar['char'], $alfletter))) {
						$arabicarr = $this->unicode->uni_laa_array;
						$laaletter = true;
						if ($x > 1) {
							$prevchar = $charAL[($x-2)];
						} else {
							$prevchar = false;
						}
					} else {
						$arabicarr = $this->unicode->uni_arabicsubst;
						$laaletter = false;
					}
					if (($prevchar !== false) AND ($nextchar !== false) AND
						(($this->unicode->uni_type[$prevchar['char']] == 'AL') OR ($this->unicode->uni_type[$prevchar['char']] == 'NSM')) AND
						(($this->unicode->uni_type[$nextchar['char']] == 'AL') OR ($this->unicode->uni_type[$nextchar['char']] == 'NSM')) AND
						($prevchar['type'] == $thischar['type']) AND
						($nextchar['type'] == $thischar['type']) AND
						($nextchar['char'] != 1567)) {
						if (in_array($prevchar['char'], $endedletter)) {
							if (isset($arabicarr[$thischar['char']][2])) {
								// initial
								$chardata2[$i]['char'] = $arabicarr[$thischar['char']][2];
							}
						} else {
							if (isset($arabicarr[$thischar['char']][3])) {
								// medial
								$chardata2[$i]['char'] = $arabicarr[$thischar['char']][3];
							}
						}
					} elseif (($nextchar !== false) AND
						(($this->unicode->uni_type[$nextchar['char']] == 'AL') OR ($this->unicode->uni_type[$nextchar['char']] == 'NSM')) AND
						($nextchar['type'] == $thischar['type']) AND
						($nextchar['char'] != 1567)) {
						if (isset($arabicarr[$chardata[$i]['char']][2])) {
							// initial
							$chardata2[$i]['char'] = $arabicarr[$thischar['char']][2];
						}
					} elseif ((($prevchar !== false) AND
						(($this->unicode->uni_type[$prevchar['char']] == 'AL') OR ($this->unicode->uni_type[$prevchar['char']] == 'NSM')) AND
						($prevchar['type'] == $thischar['type'])) OR
						(($nextchar !== false) AND ($nextchar['char'] == 1567))) {
						// final
						if (($i > 1) AND ($thischar['char'] == 1607) AND
							($chardata[$i-1]['char'] == 1604) AND
							($chardata[$i-2]['char'] == 1604)) {
							//Allah Word
							// mark characters to delete with false
							$chardata2[$i-2]['char'] = false;
							$chardata2[$i-1]['char'] = false;
							$chardata2[$i]['char'] = 65010;
						} else {
							if (($prevchar !== false) AND in_array($prevchar['char'], $endedletter)) {
								if (isset($arabicarr[$thischar['char']][0])) {
									// isolated
									$chardata2[$i]['char'] = $arabicarr[$thischar['char']][0];
								}
							} else {
								if (isset($arabicarr[$thischar['char']][1])) {
									// final
									$chardata2[$i]['char'] = $arabicarr[$thischar['char']][1];
								}
							}
						}
					} elseif (isset($arabicarr[$thischar['char']][0])) {
						// isolated
						$chardata2[$i]['char'] = $arabicarr[$thischar['char']][0];
					}
					// if laa letter
					if ($laaletter) {
						// mark characters to delete with false
						$chardata2[($charAL[($x-1)]['i'])]['char'] = false;
					}
				} // end if AL (Arabic Letter)
			} // end for each char
			/*
			 * Combining characters that can occur with Arabic Shadda (0651 HEX, 1617 DEC) are replaced.
			 * Putting the combining mark and shadda in the same glyph allows us to avoid the two marks overlapping each other in an illegible manner.
			 */
			$cw = &$this->CurrentFont['cw'];
			for ($i = 0; $i < ($numchars-1); ++$i) {
				if (($chardata2[$i]['char'] == 1617) AND (isset($this->unicode->uni_diacritics[($chardata2[$i+1]['char'])]))) {
					// check if the subtitution font is defined on current font
					if (isset($cw[($this->unicode->uni_diacritics[($chardata2[$i+1]['char'])])])) {
						$chardata2[$i]['char'] = false;
						$chardata2[$i+1]['char'] = $this->unicode->uni_diacritics[($chardata2[$i+1]['char'])];
					}
				}
			}
			// remove marked characters
			foreach ($chardata2 as $key => $value) {
				if ($value['char'] === false) {
					unset($chardata2[$key]);
				}
			}
			$chardata = array_values($chardata2);
			$numchars = count($chardata);
			unset($chardata2);
			unset($arabicarr);
			unset($laaletter);
			unset($charAL);
		}

		// L2. From the highest level found in the text to the lowest odd level on each line, including intermediate levels not actually present in the text, reverse any contiguous sequence of characters that are at that level or higher.
		for ($j=$maxlevel; $j > 0; $j--) {
			$ordarray = Array();
			$revarr = Array();
			$onlevel = false;
			for ($i=0; $i < $numchars; ++$i) {
				if ($chardata[$i]['level'] >= $j) {
					$onlevel = true;
					if (isset($this->unicode->uni_mirror[$chardata[$i]['char']])) {
						// L4. A character is depicted by a mirrored glyph if and only if (a) the resolved directionality of that character is R, and (b) the Bidi_Mirrored property value of that character is true.
						$chardata[$i]['char'] = $this->unicode->uni_mirror[$chardata[$i]['char']];
					}
					$revarr[] = $chardata[$i];
				} else {
					if ($onlevel) {
						$revarr = array_reverse($revarr);
						$ordarray = array_merge($ordarray, $revarr);
						$revarr = Array();
						$onlevel = false;
					}
					$ordarray[] = $chardata[$i];
				}
			}
			if ($onlevel) {
				$revarr = array_reverse($revarr);
				$ordarray = array_merge($ordarray, $revarr);
			}
			$chardata = $ordarray;
		}

		$ordarray = array();
		for ($i=0; $i < $numchars; ++$i) {
			$ordarray[] = $chardata[$i]['char'];
			// store char values for subsetting
			$this->CurrentFont['subsetchars'][$chardata[$i]['char']] = true;
		}
		// update font subsetchars
		$this->setFontSubBuffer($this->CurrentFont['fontkey'], 'subsetchars', $this->CurrentFont['subsetchars']);
		return $ordarray;
	}

	// END OF BIDIRECTIONAL TEXT SECTION -------------------

	/**
	 * Adds a bookmark.
	 * @param string $txt bookmark description.
	 * @param int $level bookmark level (minimum value is 0).
	 * @param float $y Y position in user units of the bookmark on the selected page (default = -1 = current position; 0 = page start;).
	 * @param int $page target page number (leave empty for current page).
	 * @access public
	 * @author Olivier Plathey, Nicola Asuni
	 * @since 2.1.002 (2008-02-12)
	 */
	public function Bookmark($txt, $level=0, $y=-1, $page='') {
		if ($level < 0) {
			$level = 0;
		}
		if (isset($this->outlines[0])) {
			$lastoutline = end($this->outlines);
			$maxlevel = $lastoutline['l'] + 1;
		} else {
			$maxlevel = 0;
		}
		if ($level > $maxlevel) {
			$level = $maxlevel;
		}
		if ($y == -1) {
			$y = $this->GetY();
		}
		if (empty($page)) {
			$page = $this->PageNo();
			if (empty($page)) {
				return;
			}
		}
		$this->outlines[] = array('t' => $txt, 'l' => $level, 'y' => $y, 'p' => $page);
	}

	/**
	 * Create a bookmark PDF string.
	 * @access protected
	 * @author Olivier Plathey, Nicola Asuni
	 * @since 2.1.002 (2008-02-12)
	 */
	protected function _putbookmarks() {
		$nb = count($this->outlines);
		if ($nb == 0) {
			return;
		}
		// get sorting columns
		$outline_p = array();
		$outline_y = array();
		foreach ($this->outlines as $key => $row) {
			$outline_p[$key] = $row['p'];
			$outline_k[$key] = $key;
		}
		// sort outlines by page and original position
		array_multisort($outline_p, SORT_NUMERIC, SORT_ASC, $outline_k, SORT_NUMERIC, SORT_ASC, $this->outlines);
		$lru = array();
		$level = 0;
		foreach ($this->outlines as $i => $o) {
			if ($o['l'] > 0) {
				$parent = $lru[($o['l'] - 1)];
				//Set parent and last pointers
				$this->outlines[$i]['parent'] = $parent;
				$this->outlines[$parent]['last'] = $i;
				if ($o['l'] > $level) {
					//Level increasing: set first pointer
					$this->outlines[$parent]['first'] = $i;
				}
			} else {
				$this->outlines[$i]['parent'] = $nb;
			}
			if (($o['l'] <= $level) AND ($i > 0)) {
				//Set prev and next pointers
				$prev = $lru[$o['l']];
				$this->outlines[$prev]['next'] = $i;
				$this->outlines[$i]['prev'] = $prev;
			}
			$lru[$o['l']] = $i;
			$level = $o['l'];
		}
		//Outline items
		$n = $this->n + 1;
		$nltags = '/<br[\s]?\/>|<\/(blockquote|dd|dl|div|dt|h1|h2|h3|h4|h5|h6|hr|li|ol|p|pre|ul|tcpdf|table|tr|td)>/si';
		foreach ($this->outlines as $i => $o) {
			if (isset($this->page_obj_id[($o['p'])])) {
				$oid = $this->_newobj();
				// covert HTML title to string
				$title = preg_replace($nltags, "\n", $o['t']);
				$title = preg_replace("/[\r]+/si", '', $title);
				$title = preg_replace("/[\n]+/si", "\n", $title);
				$title = strip_tags($title);
				$title = $this->stringTrim($title);
				$out = '<</Title '.$this->_textstring($title, $oid);
				$out .= ' /Parent '.($n + $o['parent']).' 0 R';
				if (isset($o['prev'])) {
					$out .= ' /Prev '.($n + $o['prev']).' 0 R';
				}
				if (isset($o['next'])) {
					$out .= ' /Next '.($n + $o['next']).' 0 R';
				}
				if (isset($o['first'])) {
					$out .= ' /First '.($n + $o['first']).' 0 R';
				}
				if (isset($o['last'])) {
					$out .= ' /Last '.($n + $o['last']).' 0 R';
				}
				$out .= ' '.sprintf('/Dest [%u 0 R /XYZ 0 %.2F null]', $this->page_obj_id[($o['p'])], ($this->pagedim[$o['p']]['h'] - ($o['y'] * $this->k)));
				$out .= ' /Count 0 >>';
				$out .= "\n".'endobj';
				$this->_out($out);
			}
		}
		//Outline root
		$this->OutlineRoot = $this->_newobj();
		$this->_out('<< /Type /Outlines /First '.$n.' 0 R /Last '.($n + $lru[0]).' 0 R >>'."\n".'endobj');
	}

	// --- JAVASCRIPT ------------------------------------------------------

	/**
	 * Adds a javascript
	 * @param string $script Javascript code
	 * @access public
	 * @author Johannes Güntert, Nicola Asuni
	 * @since 2.1.002 (2008-02-12)
	 */
	public function IncludeJS($script) {
		$this->javascript .= $script;
	}

	/**
	 * Adds a javascript object and return object ID
	 * @param string $script Javascript code
	 * @param boolean $onload if true executes this object when opening the document
	 * @return int internal object ID
	 * @access public
	 * @author Nicola Asuni
	 * @since 4.8.000 (2009-09-07)
	 */
	public function addJavascriptObject($script, $onload=false) {
		++$this->n;
		$this->js_objects[$this->n] = array('n' => $this->n, 'js' => $script, 'onload' => $onload);
		return $this->n;
	}

	/**
	 * Create a javascript PDF string.
	 * @access protected
	 * @author Johannes Güntert, Nicola Asuni
	 * @since 2.1.002 (2008-02-12)
	 */
	protected function _putjavascript() {
		if (empty($this->javascript) AND empty($this->js_objects)) {
			return;
		}
		if (strpos($this->javascript, 'this.addField') > 0) {
			if (!$this->ur['enabled']) {
				//$this->setUserRights();
			}
			// the following two lines are used to avoid form fields duplication after saving
			// The addField method only works when releasing user rights (UR3)
			$jsa = sprintf("ftcpdfdocsaved=this.addField('%s','%s',%d,[%.2F,%.2F,%.2F,%.2F]);", 'tcpdfdocsaved', 'text', 0, 0, 1, 0, 1);
			$jsb = "getField('tcpdfdocsaved').value='saved';";
			$this->javascript = $jsa."\n".$this->javascript."\n".$jsb;
		}
		$this->n_js = $this->_newobj();
		$out = ' << /Names [';
		if (!empty($this->javascript)) {
			$out .= ' (EmbeddedJS) '.($this->n + 1).' 0 R';
		}
		if (!empty($this->js_objects)) {
			foreach ($this->js_objects as $key => $val) {
				if ($val['onload']) {
					$out .= ' (JS'.$key.') '.$key.' 0 R';
				}
			}
		}
		$out .= ' ] >>';
		$out .= "\n".'endobj';
		$this->_out($out);
		// default Javascript object
		if (!empty($this->javascript)) {
			$obj_id = $this->_newobj();
			$out = '<< /S /JavaScript';
			$out .= ' /JS '.$this->_textstring($this->javascript, $obj_id);
			$out .= ' >>';
			$out .= "\n".'endobj';
			$this->_out($out);
		}
		// additional Javascript objects
		if (!empty($this->js_objects)) {
			foreach ($this->js_objects as $key => $val) {
				$out = $this->_getobj($key)."\n".' << /S /JavaScript /JS '.$this->_textstring($val['js'], $key).' >>'."\n".'endobj';
				$this->_out($out);
			}
		}
	}

	/**
	 * Convert color to javascript color.
	 * @param string $color color name or #RRGGBB
	 * @access protected
	 * @author Denis Van Nuffelen, Nicola Asuni
	 * @since 2.1.002 (2008-02-12)
	 */
	protected function _JScolor($color) {
		static $aColors = array('transparent', 'black', 'white', 'red', 'green', 'blue', 'cyan', 'magenta', 'yellow', 'dkGray', 'gray', 'ltGray');
		if (substr($color,0,1) == '#') {
			return sprintf("['RGB',%.3F,%.3F,%.3F]", hexdec(substr($color,1,2))/255, hexdec(substr($color,3,2))/255, hexdec(substr($color,5,2))/255);
		}
		if (!in_array($color,$aColors)) {
			$this->Error('Invalid color: '.$color);
		}
		return 'color.'.$color;
	}

	/**
	 * Adds a javascript form field.
	 * @param string $type field type
	 * @param string $name field name
	 * @param int $x horizontal position
	 * @param int $y vertical position
	 * @param int $w width
	 * @param int $h height
	 * @param array $prop javascript field properties. Possible values are described on official Javascript for Acrobat API reference.
	 * @access protected
	 * @author Denis Van Nuffelen, Nicola Asuni
	 * @since 2.1.002 (2008-02-12)
	 */
	protected function _addfield($type, $name, $x, $y, $w, $h, $prop) {
		if ($this->rtl) {
			$x = $x - $w;
		}
		// the followind avoid fields duplication after saving the document
		$this->javascript .= "if(getField('tcpdfdocsaved').value != 'saved') {";
		$k = $this->k;
		$this->javascript .= sprintf("f".$name."=this.addField('%s','%s',%u,[%.2F,%.2F,%.2F,%.2F]);", $name, $type, $this->PageNo()-1, $x*$k, ($this->h-$y)*$k+1, ($x+$w)*$k, ($this->h-$y-$h)*$k+1)."\n";
		$this->javascript .= 'f'.$name.'.textSize='.$this->FontSizePt.";\n";
		while (list($key, $val) = each($prop)) {
			if (strcmp(substr($key, -5), 'Color') == 0) {
				$val = $this->_JScolor($val);
			} else {
				$val = "'".$val."'";
			}
			$this->javascript .= 'f'.$name.'.'.$key.'='.$val.";\n";
		}
		if ($this->rtl) {
			$this->x -= $w;
		} else {
			$this->x += $w;
		}
		$this->javascript .= '}';
	}

	// --- FORM FIELDS -----------------------------------------------------

	/**
	 * Convert JavaSc'µh#º_
.”=¢à¤»±;Œ>ËËv~Êu’KÂ°øŒ*œzle8âäNXjG¿(àðk§À4zWž©¢Ì_² *è‚o|áõÃ7Õ‹sA'¿æþÓWß+û¥GNpíå¯Ô‘°@*ëdÌ|³Š¿Ck­ö,ä/ÿº·¤~ÑŒõÃñŠ-	íÃeµÕ5–†¢Á	nêiW‘4¥½AëC:v¼
v3«KH`ßÎvZ$d	ÝMŸw6ËZûŠ¤Ï­Ï|2EU­^™îÇsæJ,92h‹ºlˆŽ¶ÄÞ_Ù·«ØWê$7±gpçCbHÆ4yKà¢â ©ßùB`Éäí°4äo¤Ï­qU"°6Ân[ç×%à Öë.eÉöµv…±tÃã3ÅÑZq;@’‹Éd è)µË‡m‰,àÃòôlÂd§Ùs…“ºÝ|n;‡öw—®0=ôó §¬Ù›F)LNHJgZå¡º[ÂP„žO®Á­6Ft¢:,khrý «¯Ö­„Å{×5JÅßÂ®„Ös½š¿#çßÈ>º‹ø¯?ÆBœ±‹zJÀ‡'xˆH@ûÆ.ò“ÂÚùmTñ€ü•~ªu©Ú
§ ³¬â“„†¢¶í³ÑáÇ‡D<r‘L	Š©·áCê%°ê^(Tæ”aÔÄ¦m³]Ù½º%GC>ÙŠvÐ1ô¼y `mjü3÷rê²œ àœmÙóÃO!Ã&2"Hî‘ßTá®ZÐ7s>ûùlfŸ‰=°ƒÑ,#^wcÔ/©Òlz¡¬Þ£n¥Ðk±Wí÷ôžgñiŠ³Èô~°ªVÂÖÛÞz—þFá¢ÙòžpŸ§Ê»Ùâ€PKÿ˜ïÍA‘@`êÆÒRl8ô¿½¯&	¯.ï pR±ÅX,ìd…¼BB©UÂ	î±V}ðmTóIâ¹R{èæ‡íVtÐØ·3o=C	úÇ!í¹T€ýËxÂ¿ªäžXÀ¡˜Ò¤ãT=Vò
ä»Xj:›aóæÎP‚N4e&*·"PçÝc”@k¡žù²õ¿'ÈÂ5gh‰Ì=ô¦¯¸`$h~rAw^jÞ¨ôz.6–=Ïˆ°7>¹üD,ÂØ’'s¤0†÷óõú¿iùòË¢ñ>æö:8ÆÞÀ÷_ÅÓµÕàwk¹«p¢êCºÜ¢Ÿ1•8[­‘!ÕOàÍÆ(Ë…Ñ•˜Š~*‘ò'u÷À˜M˜ýØ¯ÕÄ%Søõ‘61¥°îoÁpMGÑ‘ª­`ºÎ±'\Y†éfRX¾év¬Yäå[ùÇÚ­üûR+tÅ=—êvrñÎë{˜º{©$ˆž3)#sBj¿®õGµâÜœd‰Î^¶=8vUÎ_àd ¹?z:ÛqH­áª‘uÒèå"DPùÉ@_Ëí¼Ó0Êu+cXØ/{ûô·'i”æéàhÁ)whqÌªQèuXUkå•=ç‡‹]å¤ºÛÍ*Ú>nTòc¤ªHCùQÝÚ~Î"Ü¼±®>½Ç^GƒR”obËì¡ë§*BÔ¦9þw|×ˆËì)·²¢B>XîRDÜÜV¡`ýòwáUoMqzùÆ¦!gØ Ë^mrë°÷§±U÷*\;R9Žð•]Ì|^=‡â–Â!ò¡ÿ¯%¢J·4J{KQK©Œsš< ÈÁk‡òhÖMK1Ô(: à=%:Ÿ{â£ã}yKä»b«›òÖ~Àgb{mcrCÃ´¾Æâ÷¬rRá	ýÑ]çù!€.bÛ:nH›¸&g<	Æ»!Ì{ötµìÄ¢¼Õ<Ág/<?”¢.jÿFõŽ?ÕïGÑ“ m!xÄã 3‘‡¬ºÌ±´q([,ãÄ#¾>Áðð–ËNÄ˜Â8È`.ÿ5ÈHÆ™àùë´\šQ×+’ÿ¢­ö02NþssòV2ÂÈ…—úºÜù›+IM¥å‰‰sã­ÈIdFÖim£Æ×–Ø‰zÔf‰qHÊP¨ðÔ^ih¬@`¢bß/—¾»¨uö0HÞ”×›{; {ÊŸDø7-`Ýër²äFöTðˆu,0ÛÂPT‘"—_Ép;À27˜¥¥è£	*ìªÿZ&¬r’§¾9$ápž§#_ì(Ë…Ñ•˜Š~*‘ò"éß‹(aKæ7i4ÃlSÔÿMÉf hÙñKÌ6	¢—AT==À«ÞÅùxX@aº7¯)ŠÏ‘k5²ÞÐïØëú¿<Æ‰Ge
>¨Sƒc*½#%O”èYgÔœÀïJ§*õå¬Aþm›í¨ó%ç0{#-%4GEë?Ï#Å(MÏª+6Çì'‚-!jBg¬gœP¢?ïÚQBŸ4<±—×-.îÄœ:îOWAb=´A¶«Œ÷8-bžU$»‘ŠÄŠb8ð±È÷¬¹I½C¿ ‹ÐoÍÙ
’(šš¦2‚èK„q(_1?q¨1Õç4M<ö ,Ç§Ç˜AÁa’”QZÏ}	+; Öx2C§Ñè„«‰¯vµH‰C™Ízµ€q-+„Yü|…Ê™»icºˆ ‚ (ŒhÝ¶²ùÓ–ŸÛN³ÊJI˜–j!:wbbS¦qøG,î++„®Õîw)tiïcGçyðõ@9ÈuEÒ:ÿeG;8´ñ{ÈëÔêšEj< POÿXõ¿õ­r¤ê³0Ë+&¢ñ»lµ+ü{U\j^_éØ\Q’e){^+5nŽ®Þ¨Bu'WØøU ÇA…ïìð>JKÔ‘‘E¢¸$¦¶AÜªîõ’´ôw>‹Ü'íc"6£$ÂWd~J	öV$¬Z t
C9m€×J4$¼ÔV/T³€ðÅ¨˜Ÿ)ÅRÞ~®½s” Ë0t”&r}˜1ÓØE£ÎôßuÂM*ñ¸ôŸe'¸ü¸„Þ†É@×|·TuÇÞóOXÌ
?YY‘JSHß*£•‹±½T”î4mþR)†ìQhÔ×ËUîjÉáÊÝëâx2³O¹HóÆ|w'Š9°¶NI9\ðý  »–Š{tshòÕ6’	9ÀŒU‹mëZA°Éÿsb¹¼F{¤ÁAû!UüÏgéëï•ûBú£f£à¤…¶ÅÏîõ>iÞ+ÀF›Í‰]þuö':tpÕaðr§îúm¨|ïi#–å÷}
? YÙœ²‡wÙþX9ô0UË©Ü\uBäÂ£êªh5Êd“È¼(¥ÊdšO*E‹ßl¬mX^ã7~Âp²úœŒC|¶v'hã)8›ûÂ
NÒizZ‹Nï|¾~Y?…Kƒœ‚/â´Ìr]œ‰å‘dù‚¤)Á+Y‚	õ—¼óÛcœ!ØëcúTÃ”	éØºbÜ`À7DDtH0.ÁäþßÒ–ÄŽìFî=ÌÓiÙ 9TnAJ50=ÑÝ´'8„1véçÏ‰ö°‚J•¯D-Ùð	(t:úKK­˜Œ©®á
=iB—îæðv).+®Êl;C¥¡*Âè2…÷ä»:^ò2rhBi?‹ò}—¤O§?8òí‚Øö8Òô¡á\0Ò¡“{»`Ë—pÍˆ½U-æOíhìãËd/ÛñUd›ç3”Æ°—à°°+GâdÒ°ÎèÌ?B¬Âˆùü”"7FéèS­$‹]É¿ÉÅüÁÈ$HêêhuÑØm494¦îA:ÑàL,Vú.ùÿ‚•Á€ôÉëñøQû	Êy?«Ùë%?Üßç¤‚±ZQ“82±„<7nf{fËùo¦MS?ýûjnSÎt1ñ!MÐ—¬âÓHñÿ³Û¥ís$ÿwÆ¬»‡Ü?ë›£q4\ò9O£‡ÞRÓáÉnP?fY%µ[V³•›O½J¯øghírb¨ð2öýùØ`XY…½@×GºEq x¿¿ [Ub?ŸŠúÍs=aà%Ð¯þžÜ‘rÜ=:í‹(íP>ö„íž<»¥‰\ý!žQÚsÐIó6ñ*yÞ#Mv§4îRõÅ=ŒYjº†ï«6ñW÷VroE3¹,zK¹¬›Ø{>‹”@59 ê\þÕ‡psâàžêÊN@¢öozeZÏM²4±›á!øÉÇŠ
]„EÕ§=ŸÍv°ƒºªƒ?ìE°	~”Brîn¨ø¢ÈS=Æß’¥ŽýþÃêÛÈ¬°Žë #þ?•
F©±ãtNÔ±L§FX}
¤í:±Ûõ‹=³Õ›â†i«Ù}°[–t…>±1*®ŠñÐ#'µï3GD©ã¬,I-VS¤3¾Jé-ÓÚ&o†D>§RÔ |úæÐqó—²®2ÜGÔìí§àÀ¿OœN7{Ÿ"aJ]è.ÖLÞ×ãW~a’llX±ñ ¸`\ðûuÄÜâ‡K:Ä¬áXuª?Yâ ËÂ.Ñ
OgNœ~_”7Ûaß¨’¹‰Ï`Q;Œæì=aøxç?“Ââx•V@&øIãMÓ ÍvpÔG£fz;ã4¢XSÚ2ƒ2÷\Úb>åÞ³‡@™–™ÈKð|v‹¸mº~òÙàôá××­°¸Dˆ4DTÂ¢Ê(z<u¦ç¥´?ˆæ¤‚<nøp‡ gIÁX[gú—O(]Ç‘6³KÓ!ÓÿÏ6"A·°Ã¢ÛPs™9`®ö–ÛRŸ½¦–îÜÓwlYÌÆ¥—¥O–ŠNÑ<oin2tÖFÄ_’Bžø?à1G^66žÉf©›'€îK\«(£[17.ˆósgo*$å-35ß˜rç)ˆô½¾Êg¢]Å¿åÿ‚|êÚLº×_r‘×
põÑ»è†óÎ«M¹08ÇûÓé’9‘&¨8e¯Ý\	ÃÈTõ#‘ðœFß|EÄéT¿ØoÌ M¾Æ2~YeôÙHDáÇ*ú øamÌpWhPÙï7³wï"H”W)bWÍU‚-Œ-Í£4­‹è½£0NQÐi[·ÆÆº½xõw™Û³ÒrÍ8úâð©(CbÙþŒÀÂ¤ÉæW@ü|&Ÿª"WîM%|TŽjkož]òV\¥Z„éÇ|-X>µ¼Î'³¼²loå¾žT(Œ)`Ðt»—P.H—–xÐã5 {EÛ¢þR‘üã"•¡}nË0ÐF>X3…BåíkñX–„Üø‚[ëÇy ö˜½té—"m€‰‡ò60WrgŒYšLþ¹î•"áL† êÆÒ1PñÜš«WDÞ ÊYã’÷ú¤%ÄÐŒîhph³—}K‰ˆÈjnÙð'‡çn=kþo"uàëÓqQÌa•³”FDlÌ¯®E=¯ÒÚr¤±w%üxÂG? &ÇþÈm	Ùäo;ñ[\¨h¿ñOkæiŒ.Böw$)Ý±e-‚f›vCbÑ¸‹³2![½‹éJ2°=²üÕÏ‰œH¡k²¡d¸[˜cØ(×ÍLå6a;*þÊ&ŸâÿüÙŠ¢u´D°QøhïÛ30–*ÕçN[þ£}ËÄAˆ•‹)’†ùDí»ðØËx-ÑîíYl½BsÒ˜º-É…àÛ¿üFê¥*¿M3@Áà )Ö¿‡hõíî®‘C;ïÀEþÇv‡qÆT^j{ÝÖíê¯Æ…ÏGý:=µê|äB5ÿñ/YûÕe5b!nÑÇW'’·kÅ*ÿ“ÝŠwö¸ü©£¡B¿ öµ)Ÿ}LîŠeÕRlùC÷ÈÕ[§ó Žù[ö·›²û6(Ý¥ØjˆÃ:¿¼·r4ÐN-K`ÓS—Òft¦qçP ydmVÜËNz±tÇÇàð†¢|úí¥/X—N]ŠÖ×‘íÍJá£Aëàt-±[ÚxÑÐœaJUÉžý\í—¯g^4Ñ´çÓ)«‘îÿ6(Í:v‹ ×nÕ‰Ñßç!m5žŠ¼¥² ïªÄÀ]¥Ÿ;{Qo!Ëk~ökÓˆQÄ—ðøoQ›Ð^\}"–^ç£«b¼u5&Pèfï›Øûà· "Rn7Í‚ªêÑ_«k	¡ew
«S/¨Œ@u+–k—¸¥³ÓwÑ½ø‡‘Sh„úyÎ_†ÇpãM…Åœ¤E©J;Í×Jl­µÉH:¶Èûü	QZÕÊ·ªõBN/²M¾t»®(»IØÛ@°,7C0wƒf+&èPåùEC>¹9E©}CÐÝ|”v¦´0òÇÊU9Ìþ Ë'•‰X ñœ#="û“¾’n=!Õ%žf,í«šÏ&û–âÒüØe}¢Zc‹õ¡.Vö}*y
îWJ]#zÄXRTÓ‡»ý8…-•ü|ø4Ø+¢×eÊ1?ÐÝ~˜óÄþ@æ ×jÞ@V¶bR7B=bcæ,$Û™t<D½ò™^$êúdJäî¾r5˜¡dº†¶óµ2÷ÉF¿hÓQxC¡-C!ìbr2ãÌOíÙˆÊ´ Í{ï{Â¶î¨ºüˆðÏ›ÓŠƒÑ¦Þ@™:M<w!|myafÃk#cLëÆAgŠ&ˆ>G1ü™¸¾§šHógˆÈmeÁ…ÂLæ˜K<!QÚ9üÙ=±I­pÐ³™œvG"$n›êÊF sÇf€KÑ]ºb¨±a 4bšjƒŸ4ÌÒáa¦°“<U·	÷YzMÿ£5êŠºy«ßªb=Õ6,E?$ŒÿwÚHð'bÄ%ñÇY›–FÑÌ<¶)!ã˜\q~Öü7þN!À¾øÚ²:,ìå
çÌ’¯ùc†ªÑÂÊ÷ÃjÈ|=ø7$>D
@ÝÔ {LóÐè+”ˆ!c[vè¿LßÖ”ùºt–”hüj9ø³5¬eK“Ë°·¨ÍOê«Jš¥ÆÒéòiþc@gƒøÔy‘À­m9ÁUÎÄ9"ËC÷e±ˆÌ®Œ&÷YõÇ0€’•¶ž®b|Ä7šÿr±ð—=nƒËÏÉÍ”îá‚pí§J2{[!‹âãú@|*Ž¸À_Z·5z~Aæ$…¥§@ŸÁ¾¸ÏbDW9Q<ßZpØ°aˆ¨äJÎO•©¨êó…™¥ÍfyÄÎŒ¦õ®sèNÂ¼Gë@ãÆ½4ƒäo|)&U.Î¶påÄÒØëY£eå
ªw«Â£¸Œ÷]§ªÉã>æcõË`GÜŠþ*(dèmÆ;ãNÛÎIö_)ÒæF«‚\Î¼£øÙ¢š3„"NÌº†S”Î© s`lA¦xØ·©#.£F 2ÀÅ /˜jÂÊßÜ3+t}ïâÄC­ÄàÖ°ÎéŽý~/5ÐPß{"%ŸûBY9þ„£“§”{ÅfÒÏ©Ç–æýOd€üWO%*oÍÂ¡…Áâ5AP(i®Jÿßïz{Hé$ï\¿í"f£Øû¹ùÌ$>FˆpcßÄÄè²cd®s¶rŽŸ—^:éíbÊ¸÷
»Ø±")¸úÌî&©_ºQBÁZ%#I‰ç-Ÿ¹#W+«ªÞ½	Òüe Ônr•b`¿^™æ®³Ò¸.Aðô*~Í‡rlØOÿM¹xI¬%_AB²”Ã¾§êòFo…ïsãT“>9*bBiiªPC¨äÚTÃ†¬XÚ^Bæ¿ãöÜo^D°ú+aw‹œÍéÒ¯zÓñ›åEä£g$ÈH^:±ã®ŒêGØ@‘s&è_¨„ÓaU$ú»/ÑÞ¸F™igàlBdL±z£Õ"û-E-\=$³}Ü)SãÐ±
á|[ñ=Æïfr®uáÝþƒyVáL`"åýõÃ0¸ŽI•¿èÝIƒ
Z£ihÍšêK—(	X7Cî’ƒ™Šc^—Ø×ýO‚Dem×}Oš¬Á!^G÷…Î‚ô¯Ë¯Ôô`_…ñVåŸÛôLN·pí;KdÿûT7AÄrëx`Îþï–o€‰yoÉô‡¿DfÝ™Kæo‚–ÇMTÆY¶‡©D{¼a/æR¨KÎñ}Z„ª(‘¾*ÙG0êB’À•º`àMÏK FcIÚj!ôsÈÓJ§­®l'R›‘jÙ÷V”ŒZ-i3|ƒÔ}ÉøZ:Óv
LóYzòÖ+pó¯Auáe4	J»·“.¶7¡{_Š!µ…‡Æí§­ÐÆóp úáÄ¥šWSÜÎù4á¸
ƒ-xD·ÖwG-ˆÝ¯e¾å¼î«†M^y«œs–tüVâÞþaC–ùüSÑ¡­?…ðY‘Ãneˆ‘rYU’‡ð'’–¥ªéÄ {uaÃîËü¢?=Ûºá½–*ï#òßV†6Äk³>ô%øþàkYGYßáî˜OFCþÿ¢ˆ«IY‚¾(µÅ!´ð²MºôgqÅéQýýøE¥Èž±´e;«·¢„s¼£#ç£Ç™Š¶e+íÈ>:Ô:$I0çA^þæ²B†˜-Æè2§_ªÆQQ°Ò8:ÒÓzÌg5jöMA˜9Ò´T§%ÿì/–úš«[»u/v».XÝî	R„X·°ìŸKÁh¶œ)piÓé®hÿœšaÊQ>”9¾*U­í!EõnLKÄSÇ¤ÀÁ‡vÅ0b—ø;s£ª¡;õ›’¶-¾Då8^œyÊÐÞùHÛ$~qóûeƒÞ'ÁXÉ.Û¾[nä?<pT°q€Z$„o—%éE3NVÒÂíø"£v>ƒQ'[Mx@QÐAÃîíD!È\,âw£Å¾aõ’‚û+c—ã?ÓÊ]†}¤ã²žÌDe×ô*'1ÙƒMl\Ýî'‚·èxÿñ»†<—bÅ¯Òö2qI†š÷¢)XH|OHQà{-ÊµTzË4ŸM]KJÞ‰ôÃÏ«o!—^j5T¾XLP^™ä¹ÜáàŽ)å‰h|YYÅXë”pìåuéRD:M?†€VÿqÉG‡ã 0Ún–mU
*7ø)rºyŒ©¢r#ã£f\<æ€I€½ U“"™¼e¾Ýxæ7
°þîØ þQŸ_Dà)
{*ÝÙ—ëáQ:Zõ•!æ‡Ùü¹ÙWÜ)5(5@šE½ƒ,Fäqê‚GÔ!ëÀ&Žé‰„çÎ®ya9$ÃÔÃ‚Méz+´CúÛ6Ä'I­ u úmSœ-Þ>´Þ—+$/×6’ºx×WˆÊçqrê@€¼0$~%R¸O÷­e°³çaM¥hc.ß§¼ˆÔ@vóºª—ü†ÐÆ~ù~PoÞßoì²›OÃ,gT#­±Ï´h~ ØIBÌ»ãÿø¤‹Ñ7Œm-#<Ö0a£ì‹ãváyßÞãë‰ð„ü^Ü‹U Ól+©šê‚sy(¿+ß©wGU ï#c¸ycüWÔ€°àí »º¼^0fýÇ¯3FžÌ_CRX
iŠlø… cÙž£Pãq;LX–hôd~}É„Øœ žV9îÿÚZH=¨ÕX;h­ä>ŒA²êœ•`©¥ñD!À6§-Àÿ&¨º+Â$ê~’xÖ›¾Ÿ`²o­Áá2Qê‚	ôÓ•µËù§2þ¨Ñƒw™´0âÖ©‰Óã54÷`F@RCNò¡aaxkp¬_¡Å‹õicêé@HVdÍÝG+
(ÒjI;!1od$æboã£3–ð· ù˜‚KÕOB¢–-•*¥»—XÆM3õg‚f\òâƒÁ¯Y\‹Z6"ïb:¿ÊN>SMýB gêE¼:ãŸ">ß;;:EÓØ—ïALïb’vb‚Ìõñ" U £Égq_©+7wíör%!Æâ–ãt qP*q|-\8E×<Ý!™0”eÏªšhºÓµ¾ U®ô¤fy$dð÷03&/(@8Ÿ”€Ä 8°³®»“ñBž~È\&.#\íJ´UC?ýÄHOË1Éº+±,ôÒ’ö›VÎ»äÎ±šóÙ\Í³câ;‹<×¥Zc5OhGÁ¥VÊ<F½û®³OÈS@ú¸ÐY‰¶‡ÑêäC+QËêà˜ÚÆÙ÷p“¾‹}9@·;á
@9ÉÑ¢AƒmòV«'®ô'+Ž“S×H’NHøä[˜úJcüç®Vß6½Q‘ú@87\LáfO(G£]»fÇ–M‹8${Á0–ë½©¸ï!{ÃÊÃ>2‰DÐ&tÑ™hÝ1òÔâ \ûù.¤u£Hµ´þâz	™¦ŸèÖùçgj­)øí½Ë»¦z£€u›½à@„¿{5WXšèçÈ§úN×>RíÁðÂ9=wóiQîcñ7å^¦~ü’tã^7:WžX˜“%­í¦ØZå¼fÖøÈ¢e9‹kÏ¨·û
»ö…}à»Õ
‚=EƒüÚ+LêgUÜðwžˆ†“ÔàQÆUU‰ùíþ s;†ÿùõ&ïÁAao
fh1£¹¬ Ú%Ë^÷—¨A3f³“§=ú)Ü•”@]ÌWâ°R¡3$¶Š—´~ëÑ<­Iå¯Èš8)@R½‡Â;oŸÕóÆjþy*}))‚@¼X-þáƒaÞ9Ó½oÝ|“ÁR½Z\àÐð(äbpˆŽšÁ3`]¢Ë¦Öè/Ñ}2vÉÅÉ/ë®ØPØdPl‹vÓ`?<7Ç½rŸ_‡Øè8˜óšêå¿øCõ’Š	lúÉâ(ð•Ëð¤H{xåf¨UjeiÆØÅ“3ùxµÉŒU‡0S¨âÎ¶Ä)hER3b÷¬ÑÝ{¿LvŽ%5tHTmœ•°‘§¤¶ôƒí9‰Ë)´6NLzæîˆ={ôËqš”	@÷åÖ8ÍŠ¨OÖJÐñ]‡ãlÁíð‰$r=ÂÄn0Þ“¼Íìjí\=š§fR¸*xKÁH—pºö´¢ÇþÝÌaßví9ô¨îª>þo¼1pÑÆÌ¨
çt øs÷°Bî>nœ3FnQ0öŸZ°™yc›"ß®;ëîÞj7ò	ÖÖ1gßÜ"@±Lá/Ðsm;cùioÑŸ«i.mÍ1.›Ù~’—iœôµMpék÷ß¸:ù}÷°øJ!w|r0eÂY§X¶–Ÿ£Á‘!µöÙ|ªÂÔŒ¨p0.ªó«£ÛŸdt.Ë`O“’qWLê¼ˆFsð(®–÷³S¿e¯ùÛ†-ì¥Þ ·	ŽKâÇ6? ÷Åîî†ú#i¥™sÿÊÞ| .ÿ±o…]–È¿-‘%Îîù}ù‰Ý€ta(ÛA:šµ )ºÏÎ|%ÁG¼ŽªïG3ÜC:V§·w`l*+™G…‹É³BÎq˜èÙ(#i–2#ÄpyzŒ HêÌƒï„¢	…š‡Vä…ûðmÜ¦.{HùÒÍù„e5Ã		7ÈÝþº®»G|RÙY^Di°ïZjñ TÔ\V´ÓKšŽ‘“„`‹žƒ.ÂMHÄþ œ(¶oîm~×0º”¸¯u¸‹bðÃ› Çr+Öwjå	åqG®ÁêÆ­k6œÑãx2ñÉ¹Zì¿Ø‘°Øï‚^ ¼.LäøËøîiyÃßŽt¨ï3Å]F‘+ ‹Ùa†K g´ÝDF´  °÷»¤…Ïé‘ï– ö{´Ý•q”ó÷ö™b^SÏv®3Æmˆv{T\!¶Sò2ÚiIÙåKjjU»ëét	Û$#1]`˜73'Ÿ×Iü×:<Y6šJ[Æ_9·™­ˆÓËwà
 &xÉ/(®[š ”Më9·‚TÒ;æòQú ºÍìO1°+•ö l0$!ðºürŒ÷YÐ=Td8vyU;(,1v¥ìCÎÑã	V¡Œ	ÉÎw®×æmœ]ž=Oj¶ÞgX…½¨-VùõqW–óuÌ	²œq“ßê<>šøëx7ËK÷ÉxËÿ`¾‚ÍÏ9KÅN¹ßÿ^F ºreô¿+ ØãÅÈ$0Z2À:pó¢V:>smyU|ªkÏ¢yàª^²;µqm–\Xºö»áýœ¯-±iHÖþrVe!ä®²FÄ¦\òÊJ`3²Ì=s/Åms3™z0˜ArU­‰ÞÄnÆfeš_÷ÍŸå—6Šø~Ö‘3¯	VFiÊK@J}H¨êC¹òHŸ¹é:U/ªüÉ}9ÔÒ˜"ôfë$Á…K’Â¾»;Õ9)ò­ù?±PEÎ}³¬ºª›~žÓW^2tùQ.ýå‚W IÛTIÛÝ1¡C§zeÜä[R)
%-Ó¬ý WŠ	ü*â-7ÈéL(©I YâÅé\¯éªº³/Ì‰õ(žÙ>²	nñzVg›59puQ-—«å’@xØBÓêSû´9'/Á­ñ£ï™yL;Ip.•~>ŠOkŽø»PhoôZXn[¥Ú‘§(G:ÅPþrè®ÐÛë9±FŽdëI¬bìš†ÌËþB²êÛÎ¬Õ‰£ÀPdf$¥=ËD¡À«$Ö•WßÍíeÂ½Ù@îÖ¿×Ó5™þè•?w1''YË<™1Ô«D	±¿&l*¥ÒkÔa‘è>O¾Ð®AËEkGÿø‹.ª‡È¥®èI÷eÁþ%îP™É“´’d¨¯‰t$j9Îêä3&ÑÛnº"b’€Ô¦Ê_E
ú\r€“`b²nAzº®kþÝ›í(PÞ×Û”j*/{í˜ÓU_8,£ô1¢¡Åp0„
LÞ‡öcOOØ ¢Á Õ•Föª¾úÃÁÜäM½å>DvÆ¨_ËM½3ÁÁÐ=UÌëä€¾4Â£@ø—?bó¦Áö`èÒ ékªõšu“l§é$Ù>j÷9×Œû³qÑÌ+BÈX¶‚ªpŠ}_Îtùâ·¯îø_ØËÝ},o·Ù¹×g{"xâÆ*ä¡ /QŽ†-ƒ;¤k: Yd‰KS:\ò¹¾T²¦£Q¨ø>úQ¶Y‚>RA>€‹ííBˆº—W„ËgÙ;ºKÜju{ Ž•ñ ºjäFÉ”±‡¶Z{ÔF¬Rî!³ƒ[Å*—‡üo(#Y¯f¦¬°ÏæÔõj> £³ï´÷æ¤»ÈP 4·…«CfxQ“·«yc­äožÓ'ßûÒ€}h|ÆêT^§f-ß 4PålÎ;Üh2È<šŒ$”Cï02s'2öGÞìƒÆ'TÀÚG|v+0f›,rÓƒ„iÄª‘¶»SÀJõ±…†‰ÙÐ€Ûòá0È±JÈŽÏâö3Ç<:“`¯isŽ:RESå9©¬ÖV#û£ÆäÆ»àÐÙö§Ï‚/ÓuºÒ7ü»Êö#fŠ3e1ZqÌÐ:–çžý
_ËVæ—0{P}‰‚©/”Ø Æ&[ÚÈÞÝmÊ¼Ø›ö»Å¤óû?lo‰j€yÀ&×°¬^Kôé[Ê¶¤Øa¯LF­J¬kg„|191ê@ˆ»h)bá'„æe´p¡¿E®ÀCS”mò@Ùš''lÞn*ÃŸ#âVS?Œ÷:˜C„èÝ¥RAÜÔ¢¿`á0à´»›žþ×Z¶œÇúd‡ÜšÊ@ÕC†JZ¿(­ríXlŠËº4v=Ë’áØ4Îÿñß ô%ªg§>Ñ‘øW	óñC!ãg(.lÃš€BfosÈ·2*QÈ6öÚ¿g1UÍkµcz–oãHTíÜÑ81.DV&¸´ÌšgÃØ+Tü*Jü'é-ûoöh:NÂ°¸òÓºaoC¯‚wê\1¤Ê3J"|¡,—Ÿ?¡ÁÔÉˆ\¿J–	Ú•ÀR”Mµå·q¬ÛiØ´çz“‡ {Öžð±jÙæE$ÁØâ„`lv®w‹tˆxÞ¤‚v4–4[!ÉÎ‰#B§þiHÒY…m“þ”ÅéðJ¾¾ ÷FjY:¼íøçÕ¤~~Q@l`i}j½ü
Î”uùZ÷›—ëÕ´*{÷–.?™Îjmì„Ž¾³²ó<¯›rƒ1³
ÉKê!LÏ4S1ü½?˜³£Ö‡¶"·ÈáLè„ò~š7É(5vé¸–ÐŸËÁŸœÙ¹'¸4¥q+ú±Íu‡~å5yÎ_Ú…©Mí^/æÕc™9 ótÌ„WP¨(žl µù|lÅ'/$iÕÍÙsÃ0	—„Á:å:Wh¤¬n½»r‡Ø}ùXÐ,·;pœ‡wÖ²5Ò«ÿl{`ÝopÍðœ3Ç¥CºñÂL“;åx×øñ, ÍR;Çñ|"zc£c>1þ"„Ë2é0»b5p¬Ý.ƒœq±ÙúÉ«})³@üAjùnÃÅjgÍ=^YDFÌ%n~–d¸”Œµ¿;ùª¢{4ý?C»µÿNZœËøéŠ'¨Æsø^rRà©A]cØ“7ð­'Ñyj­®)ò‚÷º>…vöáiÏ’…GfÞªéÝ‚ñ°Cä1AéT5=¨BB4ShÍ	·
ŠDCMRcWŸ$C»m|½¦~žÒÚ2ª»B‚Ê}´îÛîW­ÞfŽ£4èRÕÈu=!òœ&üàž„ªvÇ3’ïNsÛ&@g„¨ÃbÄ·ÍM„ÁZ£‡„O6.„˜ûŒ¬¯£XŸ¦§?ãëß;
Z3ÏÈå–Œ´J¦°-r™w©Ÿ1†Þ“¤¢€"tDD>\>ü~ f¬˜÷#/¨¿~ê¹„iúMén5åì¿¡õüz³¦°
¡¥M]rb•Cêó+÷©ºKmMËƒf½º×#ÀÆïÏÁ6*Ží®ôŸÆ9ã™W¬Íü°D‚²@´e,ùÌé°%¿G)èE¢›³…æÜIÉ#,ÆH.’™ƒK~B¶8ß;W³»?³¶J³XE&t
BmupÇˆÇ8íéÖgì€›º®ç:_‚ï¹¿šñž+¡q¦6;H“-ûÑL~y{¡CNöýJÿ’ÅÊäÎ'sÙ_åÃ?®Â6"`V†ð@‰ª©‚.ÁŽÜÉ?øgQjbw‹ñz›§?ÿš¡M¶v¾ÈÖ7Š~úávq©“ž“IƒÁhïîJßÕ`Ž›éò‡ñ*W±1ÃÂõz‹y£,"Få¡8šõ…]˜ãÜõtŸç%©^¶¼®£ >D|“q%]>ü~‡äf×_fL±¸l¬M×Ñ\Š©€d°,’x¹#8ØõÁÌVÛ¸#¨6²Ê)qûÞösÎ0ý$;”m3Û¾0È/Ä39 lZuâÎá›>©§Ù(aAn41<±k¿
½”‚¿]½Ç Ê8|!±É†çæ‰ž<)®0U&È	ó€Eðµ¼rMÿçC'i‡ü)cÒôàòZæJê¢®nªï¥¤çŽÔÊÝ4-tAa7‡qM…°máø´gZc}ÌË¦Y
£û(sôNîšÎvÞ„(ÂLCã/ä4w¦ÛeRRZUÖÝm‹±#äßJ!&ýü„AW9íB°&Ã|[HnS÷ŠÛy'XR%ˆd–wü¦'zÒØ0?{5å;A1|lj›M£š`ìªZì„µ©faá4Í[sîsÿ)Êvˆ†HÑˆÐª&!<¹®ñ¶s•ó¨-(´óf¤³éWäü9ý‘eÃÛ+)IkDÖ9¢ïü$—«ãò™»pÎiYWÀV(º	ðÍë²#É?hÐü¿ò:õ1ó4›Qe#õ:ü¢€U*15FKéˆüeø Ðô°k¿óq)±ÔãÐåÛ…oî‡øMsÓÄÎÿR9Ák-3Ù¤N½KÙô¨d ÌWy]pæç\l„ÖÃãwípHæcµÔŒ´IVD
ª¦ö+Š
WÕ¤Ì³fð,Û:êÔ:Iê´XŸ¶ð³lõ>ZŽ}—	OG6^g;A+þîJºC¢…°‰¬¸÷[úñƒÂÇzÐëˆam7$"ãÝS‘O9æ•ù©Æ@Žï„{!ÂiU·Í£ÆÆSF=)QÝ¼¥Öû0&x‹ï0›Üë/Ôd\»ˆ´»f¶Ê‘.Túdy	‹[;•o›˜T‰~KîD!µqÄ^s¢Ñ Ôû•Æô|`ðâkrŒÃÍÆóÒg¿Åôzìò<üšÁ¡&muïvÐHÂM.½!?¸(d{v?3P7¶^M||{†Ö?Â)±åYÇF6Õ¤ŽIøúÌcY6Å×zæÞÝ¸ì#™x×‚m?Em€Úú‰÷×÷ÞJÂìå'“–0"ªñÜí¿ˆÍÑ®;:Íí»ðÂ£rÛê
‹‘„XÎlaŒâ%K7€sßä…¤!Sö†ÇÑ÷Y›‚uoÝEì#³Éóùõ«t¾©9öDQbBŠÈå\{¢ÉGÈTj)µ‚ºˆ”ƒë¬z!	t‰Ø·nÏ®/ï¯FRy¼aŸÎÃ}¸{yµ§1õÓY³MÌrÃ²BûÐÛòø3÷@±âôMa"×Ÿú†ætrK)ùŸ_¸¡P8d~.v’Ú'ÿvL.åR´0ÃÔy´wBÏ¡¿¾ããˆ}Aè¿Æ£˜ã©å
–Ê_lWQ×š]bä÷Ó#3`t‰*ó±Ü0ÛEÕÒ­!\Ç
Þ$ÑAæÍ+ÛÚŒ¥Å4~£÷¶»`™é	ÑÛØÝ€bBRWz›cŠÃ^4ç)O©è×üõ0c=e©y4·‹ó'éÉqÎ©YõÎ‚¼¶ëdB€HÜÂjhò(Ð…Kæ%"*Q™’_I_wÃ‰ð®GÙ#®”ç)ÒÆr
¸±Ôü)m®¸Wß`¦Ï~¸1ŸÎÖ§ž`ëH¥ÏÝçŸ{nöô¶žãÒå'¸÷ÞË¿¿g1–ãƒYdà1ÍwÙÑù%rÕ§{ù¹/â‹Ô†¬nâò:ä…µ)ë-oöo®^XIå®Ô©[ØE
B^Ù¿P‚ì÷TºF3ë­ô,5uÆFí>¾žÉ<E0sQUæ¼xŠDDƒ
(èB¸Ã•ÕŠÊ¢|•ÿù®W™ª4OÔaÇôÙÎØÐ]nüý7G;EU—©Úö˜h'ñþõÙêÖ(Ú¬ûo[UP*ìêÒoæÉå²œá©µ±þ
Äðþ‰´ÿË7«BJÒL˜BôP™—¶ðZyìAtâ{5<ðƒS§Ø½d-ŠzÛÖÿµáã<äâl'VG Æ¹•|'Nó E‡T×/~â Žÿ®x¥Ïªl”ÿtéÊÎ—ùâüÃÚ–‹;<ÒBoO“-:kß¥W)¿Ñ^5i]i<î¨óziÒãþZ 9(ý¶qtüÑÈ].µ­Ù•“‘D„¾8·*Ão"÷N6vãÓ‹éµãym',ø¬™¥Ï¶™ì˜VóÖÂE“Ê#·HéyöùEdwí˜>‹¹3ƒÚ~yssï~¾àž—Û÷^¹®3.MÓe­\µ³ºqŠ›¾Æñ“.®\‡;Þº¦ ¬½NÆÊ”Ë,®Ic»³Þ¥•ìÐ8 GMÿqi,Úo¦¶+&˜
ä>‡–îÏ´,·9Æw7ÚþçE«Ë™üöÿ^r-#¥.Û=}ƒ& ex¼´X`ðú8GùÉBv~5ŸéÉØù™ý< ;‡öKþ¾p°UQ|‰NÕÊÌíÖÃNüfÊâ[ì¯£ì~æ0o&0!0õ‡Ìøs¿hî›KC¦ðÔqÞÊ}Ãq‚ìT	/³¦i:oŽ8*nPýs©Ë§&ÔÚµþQgÛ—–šCÝú0BåaÅ`Xÿu
Ûñ9n²(–¹“µ³öÐç±¯»Td®•¿Ð~ [Ã7¡=¿-®*O¼S 
cŒyeh`²Ç¯^Ž]¾Û[äp¢_ æBä-±»bˆw$˜•iñ¬=‰$X¨êx’ê©Æ+~ý×Z;–™Ï†jíUzJÒGÄÝþ<–\4>?(*fdHGf½j˜¿PmÅ0Åƒœ*Anå‹-uÊ$™{6£ÛžUïÚ[ïV?¥ÅÛu~EÞ7ó‰°lEÖYš8šðx8Ë˜íÙ·‡‚ö	Åë_¡¾•‘ï¨‘¡Íóý±`ÑŽèóÖeh]dxõ·¢uUGsóþ}û¢½'…1|`òkÅÝSFo-xêS/Àƒ@Û Õ³höž¶„a¯Bé!{—¿U0‡RãÇvñ¤VvqÀë&#óJîX·ùo¢LABÁÚ¯¨Û^ý!þº4ýKÜ”°qÝ5³hzy®=óóÃíÃ&+Á 7]®ªÎ!]ˆR¥F=*Ýå.ô|Œ#ÏÜÝÓ»ÃKG€ö¿“Ç˜j*ßá]Xù²nEø…$ý»F‡¨EØëJ¶!/¬Š3ëGÕ´nÛlV |dýIwy˜‹5;5 -„*|û’Ä¨ ÙèÛI*BØ§TÞ¨ç
Rw4=)˜RÉEæxQnÒsË&Íyzö›À…išÎ\Ü«±˜k¢Ñ2q‘Ü÷Ì=®·•YPŒ’º¡3ÊŒbÇÂ^ow(Ñ© ñ÷	­Ùã'o`™íA%&ª>Éë†éöÐh^!Š<¯>£X~®©”ÖùN	‰´CÃˆÝ¬ÑóËâ„½Þ”‚º­÷§°]MK×žé}ÚÐž-œòp-úÎŽ|KËó>ªXZI·¢ŽxŒ~þÆÐ#O$Ùök¼¨ùí™;áMË¢¦fªDëT>‡AYÆ°Ùí¼Éì½¼p`ïÁ —m‰þ¸µVÑkeˆ‚äX˜Äý”‚/TÎÀë½¸L#Ì©‘†íÍÂZþJ°]&IeEFçðÏp~¾¾†,ˆÜ1™7ÖÁ"Þ¤äùÖÅ?Ø…Ë½çW’¸*ðmQúÕù[hHîöÈØ^)ÎÍŽTMw.ioÈ+ðì2 ZQµ-ÍPS'’AëxŸZF_™ÄÃH û¢Þ— ¥þmçÏNËòû‹a‘Ò]Ž [j™óîVspnÏÙU)}6t'$«LHàX›€<¤Âtm…½Òâ÷AÐÿ½OÆ|Eé›æªT(Ë[\'¿WÙÝSóPÓÌ,þk¹ûYÅ/“¶Çœw#ä7[>¥}#¹¶N‡ÊœÓäs¬Õ_Õô_ŸÂ°×LÍ\•2‚ÄÈ)w÷è£i£°6ÓoF—ü.…®®ú‘åðî´Šä ù-UèÚI`ÇÊï˜Ï6&Ù Ùá4z„°>46ó,°üLµ¤üuì²³Ç†é¼¾¯ªL.ÿ«ï#ÑeøË,W§u…î¾•œ£ë´_¡JÕ]¾Â¡C7MUæ®‡áÙ’ú­.gååŠ}÷¹3¼íÛÆîZDo™”ci/ûq‰ä²¨™E‹à‘ù†äª¸ðùˆÑÁî›;Œ¨ïcsÛw 7ÆŽ³ñæ–©^ïkÁTúãü9óM0"Z kÉæAßñœìgcò§‰_tÝ¯˜nc&ßäI€ä®¯äÉBS¬ÌâþG±bxØ<ž¡AñäfNö·š³éÁó+%åæF·Á¬H_ÇM,Åò$ÍÄî"XF™ÐwÖ&þqüY ]»G`ëIý Â1–Ü”kOmA¦_É•{«>˜Ö1î:å¼ÎGgìégŽnŸ$)¡\2ÄÍ”ïW>ó,T&L‚e^G!œÍ­Ã‘‡¤d€ò×*ó<¯_`¯Á9œÓJK$âó¯‡2ð¹Jq² Ú)–“ÇHã-iFW†Âõ‡1û„O(ÈÉçNÌ‘ý<^Ã`/Œws0ñJz÷i*Ïü~â¬}ß‹¬ÄEÃÙT]´±ìÜÛÔ%ÂC°DÇÛ7pÄØ9Jø&ùj‹Ûj87îÅe”d™n•”ÅÙë®ô	%‡J³Yƒû*]ˆÄ5‘Ú½’íKèNŸ‡ß1	#ÒLIt˜mK·QèI{ _¾N¶§W¦I‚óA8™MÔÛ- ¸sC¨ÙÈuÏÅöõ0Äï„„Ú §ò å7MÉ@÷?¸Ž6#ˆmÐO“­˜ú[ û7"¨%YRø•1¶ÏÃøÎNY3NM¨„À«ôO¿©è/ï9È1ak‚˜<‘€Ë×óÙ(Ž›b9ÿ»rAÐ¾¿?N™		Ü©X)„ì²¿iJû®è1xd¸Uã~áÁs° Ÿ"z÷êœß¢·Iœøõhÿ22¦¹aç.Ë¡ƒëÝ=_ŒŠRFâ…âW_‘CÓ€lÿ=®´
ñ‹+ô4…£(",~Vú0ÂÜ±ðN0³m°ƒØ0ÐZæ=çp€éj¨&ö[ £_;‘Kçš½ÂàkoaÔÚAt‘kº¢ÉS€êhÂÂÅg÷}×õøèUNf]±q{ï+Oº®Æs»u£üf£Ñ³TtkC—1>ÜmaHú#"sšÏÕwÜ Tã9'ÑUÎ”yxoåÛgÊmªÂ,$`Oþl™P®Kó044º*'.-%þ‰¸ Î=áõ¯i']é6Ç*wpx1œP¾˜,;Nîž)ªí	7D—6œžlÿ„~HjøZŒ½“4Îidžë¹(Z˜Ã™œè»¼Ù[<ïÛ?Pìp³‡Å˜£HòPÒ–UGÊLRš¬S®Eod¶±‡(ÁYk¶X.k&\¢EÄ¬!ÏëÈb*š8Ãrp°ƒÈ v>Uå5x€k€ÌÊŽÿàûz‚S&Ç#[ºóº–çMÏŽXmMºÌ0U&–=C•jÛäÛ´¬|ÉtHk‹Å)	ÚN«’ÚÓÂ0ƒ<‹ ´”xß±l¡Ø.êÛù4¥—S%šqÄ0À._æ#ß	Ñ*{ìW±‡ÎRòï‰*\­!€¨ÿ‰q‘±X?ÿ¥e¾¾Ôòù6öñÌxè¶*ïçVµy
n©}œÓ:H
–ä‡æ-0ËÃÓ>ó‰F'D5¾ñšŽW²{äíºllnî7&‹Pgt`ì°æáÕ¨Q7g-.C¼·rà´ç½Ò¾Š::‡KûTt#ˆÕà˜„ü^nÕólÌ§ºL
mš¸V]b%ßþí8µfvˆN2fz¤õù×V÷Ž*å}ÝgÌÁÔh&åˆdÃD*øØi I&ˆ¡{Ä#á”ÀHA¶ùó1ÜWzó1„ãi2w ¦(?1“ú£õ1¡y^´qó¾Ô8gvcÖoj1F'ÁÏZ‰B£ïdŽŒÔB–I	-I•ñ¹8ÙkÒ—àðvt\ïlïCá"_ììh8w¦š°tC sVMÛõ9ƒèì]µ^}Uöê’ÌpV¦.  P©9Êi;ó>–/bÖõÉs®Ÿ+lÖù¸î5cÙªÞ$%Ó‹0fÈ¨™§*¯­©¦XëôV…f i²µà×˜MƒÝ¡äµ0w<žsÕm?¥-I%áBÊ
â¥5jy`¥›ßEd¥ã'3’í§TàcèÈå[¦¡ãÚ	ÀóyT[ÅåBul¥°ÊyÛ¶Mšf¥ri÷)f¬(…rè' ªÒc[o{·E+$ôÚtó|Ìb¹#KL~¦Ö¹©†›÷ëÈ:¥Nóq6ïŠI‘ÚÿNØ³ìsÚg)Ù£C5õŒmÕ bõMÈÝˆñýoÛ+.º1.¢7ñîQhÂåÏpe¿ËÑžyWÅ•,’Uºx\vyÄ´ßñj®Á‡@ŒŸB1µ@Út‡,ÃÅ-À&qå “Ú'dÊÆÚ‹žß¡iw9&Q«‘ðÞw\”êMÿÖsÊ÷Ø¹…ß [oe=·JGÜçäãÛêþ6¥÷K<NÒ%¸ÉðÁÙÌ‚æ*³õ)ŸE¹UQIKƒÐ×IÃB“õž‹;V´UK÷É'CÎ2ßFŽO•È\TBRÕdiÎ,úËÉ˜&óë7†Ç\ª
[	ðŸ¢”ìCZ®fƒ+Ù³ÜÃ‹…¸hþûÄ¤ÏVò­ÿ©øˆPy·úsè¬°ÞªÜ¬:°É” ¹†%Ñå³>ïé¿"T=+Bp
‹ÊÐùAI‹†n#iK+œyŽX]#®â;äSÜ,}†ŠÆ@˜î¨š-Xa®‘j’%#"Ü(øRXã=ª*iúÝ\ô¹ùÏBvµ!wº–†6¨w~ZH{›·€x†‘¹š©H‡;Ëõ£$h/˜z;¹³(uákRÚÆŸ¶kÆÕÍŒ&ÜáýNR²RZà›âÓ>ò	!±¨ßÙ4«K˜¨–CÑ_cÇGœ0"ß²Âž5¨Ø%'IÂíM³õªdOÐ˜…«os±=L£èa(«Óv¼êÏ$ªV$€áÊk;µÑ•cëèšQ
‚Hke¿¬bÓÃŠñ`3î<Çà¸ìºFsy™èMe[½êlš)˜t [ß¨&V 8X­Gß«_¯zÂwS´·òr;E“1 Í¡;†x¶OÀ`5cº’¨˜rÛ.†`6/%ê¦¼?ÿ&«Âˆ»ßªú!K;)ƒüÄ€H¾¢	RYFÖ³Z÷ZüÇãâõê¼6%¬+†Tù=xÓæ³IE¡äë2HöCùÇ^©D’m<¦·[ætµ’@‚ï‡»³ÁÑ+ÏÆî—ýŒÁ_3È³ND_½¾_1÷_¡µØ“07•Ái$ªÑ²•â“Kä,rÉŠzÐc—ü«¾°ø¾Ï“šk2þ=§Û½™®ñÞÔIFtßÝFô?ël-Ú;¢*°¦£zÛêm*Š°+]{ÑMM;	[,CŒWƒ+Ÿ—®l\VpbBB‹¬)9x X“Éý[­ â#×»ùÔÛËî*áÚýà(?Ðú*PQ²~´uL'#r«?Tq]2‰+ûø.*ÉQcÝ*ï¿ûõŠø™ÂÒ=ä“=“ƒ‹ÒÎñZ®ÔÐ6þ&ÊíÔ¼œA`SœdŽæ\|Ô<äøí¬—×Pjóç²“.~‰hà(s&½ƒÖ§äµþy.õ+Ð€<q¼Ö“¸¸´ôÍC)|.SWˆ‡¡Þ0ÊtX'‚,¿žŽÃ¸ ¬‰;¸¨óë|ƒ CQŒ°)ç:VïX7’G¤¬>Rã†’º|§¼6¼myê£¶³Ñ¡N1ï ÜKÀ?‘ë+cª¾Ìy÷´ZÈ”}V¯”§ÙØ.¯Ñµ†’6¬Ad·ìTˆnÎ©î¦ïk' Ä+Býüv¯QK¹Â‚2Âk2p¦ÂàÐŸeoÒ…Iõ¼pÅMD×eòHNžØÞgó$v&ž6d—.ïÇÎëŸþšTÆZSÝø^ü†ÞÝþKû§¡pÖFéÅ«d¼ƒ”‹ÿ'wPeðXcLVüºÿL²f!F_ÌŒ0%Ì|e°ÓH1Áé44bökáÓúÀ‘k '~³ô€+.¶çåžöõ‹E"9U#™ºHŒâŠ÷gÚ¹µzùÊ^<,{ìéÔšLH‚fÌìE9ì‹_Z}ýÄ*ˆýœx°‰G+°±uáŸÖV)3¤;`ãc¶ü£GªZë˜Ó1Õ1•;@Œòôz3Å˜–ÂŠg£‰Q˜[õ¸¬›óK_á(0ü¸ªÄÁh·\2|q@@áèèªYþ·C4¿ÃÝ}N[sÚØB^	§«V·U÷Y>ñ\Ù—5=³ƒˆ0AˆMÒ‘Ñ‹Ø§4Û)¢IFÚ›%³ÆÐ¢àÅ£†‚ˆ´ã$“‚sM¸ç¼¥žõ¥/YIùåUZ7†ˆmö#Äm÷Ê*&ÛlØf¸Ýƒk~Ëˆ±UèNü6àî:€:Q#i™aÑ4 É‚Z7DšÄo®¼äÉÛÍyÙ¼Ç2²n¢ûSL-ïþÉ4ÿÖèôÂ´ÝóYÿd·P‚¡Ë‘Ê‰£QY	Å ¼¨IwM³/!jþ+üÉf!¦Œ#À4¦GÚ;e
X]ªt¼šÈPÝ—ÕŠ·Ž;¿½A]$’”>€ùÔÈ]ìAáÜ‡TteuªÍ²Ú¥NöÌÿGœoŠü¬‡FÎ_tfXØ8åîdCHo°Ó@?Üˆë€D€Œ'‰èjž÷W±Xi'{çùÒ¾Í@‡j*SHƒBµ—Ü)XÐ¡LV¬*ÍÔ»;FêÃw2ë5ëaÆ“â¿ÔÂ×.¦  ¢nìêØ–zhþ$jÙc›Ñå@yÂÚNêÝd‹Z?zù7Öß™¨JÍ²	¥pe¾wŽ\˜g'¦2&b†á0~>„8 ø`vÞ¿Öâ…E39M$6˜Vü9—ã”ÑþàgŒ^cË¦#i7cX”	X?¬ÿWNÌjUãiÜW@ç5è¦bÍQ@Göu„Ò²/Ñœ÷J<oý¼qˆriùsÜ³(×P¼|÷ýD"UÓ“zçB®Ïs.l®C¶¬ÊÖ³äÅ¨ð®	.”?êZáÓN’6hîÆBÔcŒ.Åwù~ø~‹6ùìÀË¨íËtš°PNìNþÏÜÕ£—õ]3ôùl¨Ž	ù;-ÞàHi¼Éìv”ÅŠÆ+nhB¦k çh˜<ßC`AgÇ~¹áíöí¥™„5ÒBop.g^°ESðn‚‡
–ŽÃÙÁ‚¡ŸU­"¶¯´ù:†rŸ•æÌ’Å‘»Ceµc"ÑZˆm,U…”É„—KÚÏ°U3BØ4W¸TÜøžêC€8ÛkóDÅÍ¸æÿL\Lè=—2>,]rÐ|Ò“ÞUÿåR/×4ÅM_è¸©­#5Ušƒ3iD¨Ó×ÍªDÔSß?Ð™Jü]š@³êRµÕÀÝÂ¿µmlêG’ÿ.´aÏP^û²r9¾œR4ØN)ÙegÑõ3Ÿ3wD_Ð‰ˆ¦ø†q€ƒDÈlû–¦$¬uIžžZ,çm9ßÞm^ÈøÂbIRé~ï¸egÿT5´ÊÀþFfjRÈQT™„m‡0˜rãßUáº~î*¡á‘C¡×%#;%Å0¿ËŸa‹[‡K´pq²Þ36ÇyT`ˆÌŽ¦åÙn N°‡Ë"Cr×?uà"A
	aÄàso]ÚKíKh\¥2z¦nSªÊŸQIÈ²ð¨rÚ™Àc ‹¶ÒÃKpð©£‚Æäí®ú,k»Ý´QßGFA¤pÍg¥íÒQeSp$ÓÉiý±ðQƒcâ¥%	<Ø–0Fb ñeÀö_ýá{ÒŸº¯ü\«XÄA-Û¾ZÚ‰œY¥B%ºWïÜËÞ'?j9œ‘f„ú/™éýìGx<’m®øž Ù´’:eì6€Œ¶VûîÆ@p¨p>ª7µó´ü•u¨©ó50ìÃÑÃhM¾_øØv¥cC¿mµ÷¯ÀïùÌ§tú×R“Pv©uòuëœØ‹®‚ã tÂÍÃ`…8î8´ÏNêÀyZ®ÊÂà#V/4&è³&/DT“[¥Æ ûÌ@ØëŒË!ÐR†€7WJp`$Ù	mÉ^”‰›rÑ.WR“)âçMÎ—C¶]Xô½/²P¿âB 6¾ð;8Hr«[0/'pÂ'œMJ:0!nÆèªùoàõIÆ—ÇSx=bÑ˜ÚÆ[&ŸˆÙÎ…^ô/íã]Åfä¿PEÛÏµë†ØQ”“xƒúFC~ñ—
; 4"ârfGÍã
žŒ1ÒRßX.s•, %zÕ/8Ï \®"›;	‹:qõ8í`îm9ÒØ¥|šBšÿwh‰Œ[/Õ4†¾LÛ¢„ëðÌl€‘lá#	²âV–Ùºb“„æº»#äqØï¶ö$ƒ]Ø2bÁyFÛ9o-ˆ)räùŸÖ^è¾Çéâ;'*ÛbÈ×!jù+èÐ¬4	/$keé\ˆ\@áO©bî'ëehÑÍCAî"Oï€iûmïØ\e)\Å7ÄgÀ`7»Sˆ±;µ™)
à3Ê‹í}ˆC¼¯Ç@¿«üyÁš,ýVo=(½lAûÒ" ®%¥cèÜ@J°l$Ž!'4XyÃ.­ÞDÒGj/4†Y^*¯î[F¾¦“©\&ëÒü+jÕçGuvfÒ`><•r‹Zähp‰†õˆ¨):gš?Áv†ÔËápôŠKt”\JnÄò5M¯ŽþVn«)õ¹‘“±dŸÂ7µƒ¥ä–ŽDšT,V» Äu-9I¢¸bSÏø¦¤ÕöÕú(öPHÎxÔ*6MVàûÎº#ŠüÄ6ôˆ{ÔóœÄÝS›i(‚scÞ‚¨îQ0ƒEé-¨Çe›‡[ß!l£vt ”µ§ëñ.SˆÇ@*G¾ùzÜSx!Rì]­±œ‘‰ø˜NA¶-§ª—Á\÷Žƒ„¦W_|5yà*Œ+¡»ÉM¨U¶Ø;™‰ìµ®*4åj¸rö>ÚÍf©ð™0ÙönÏ—ë®¸ƒ{åâ)«Û´4õàkš÷óÅ
o6°Š%¢©•rªÓ _oÖÏ¾„÷ud£ç'V8î`+óZWm90 ŸaôâÇø™t^×gÜg/ÀQsVÁ´‡4¨T0Ô	`µÄÑ&øôØZLÿ~3ñSðä”¥eÅdkÛ8 ÛEð›ðn÷Ì!jã@%9|ë,;~º‡¢`‚:_«ŸJç¬)3-ðiÅgÜ{šÔ´´V…iñÇW§a$ynØ¨2Ôh ¸9¼¶,Eî¶ËÔ?Q§Þ==ì¢Bâ2ýÒtÀÐê Èos«ÊŒKÉì:8Ô;vRtÿôLÏ;
f»ÄN¶†önãÚçpSÒ±Üóµþ?jRIU
ézópïÝRw\ú’5	zc¶ájåDå—gä~zƒª±îK°¯õ2,T~UÈª0²œŒS¹¡µ1¹Ã×o0+¯9rÇ}Å¬Y°¦HOÿÀ–¹9>“ÿ5ÍJ$æ™Ì£}qC^˜É;°éä;U¡^A•È¨¸ÆØÅà$x ¾¤þ'&¤
²Ž*"Ùûm4 Lk—¼i¹ÉèÛ‡¡ÖÑDû·]FÁ™ÎTÛ¸™ªY5·u,Ô¬ˆÎazËææºCê‡[cXM-ÌzŸ)TËÑ:|½/D[Â\ƒ+2êøW©fqšUÆMTyM>¿'ÊiiÕl®v6Ï,!4yã¢LÉ¥•Ø³@D´owQç¥Óýò>áõ5+`ŠŽâ±gù&S³2
„x(+–P ÃGWãÇ-íî.÷Ï{ ›‘úù£Œ`Ø7YÃrã¿]wxþ•É'^f§õ¡qwk;F‰^\/œŒì£±±”¾h<0Lˆ#‹˜y'¤Tà®3 YiéåÐ6¥%^)ïÜ"ÆÞÝçïV7óÀ”³„¿›Âtù¨Ä|ç`²¾…Bxí	˜€²“”Waá3Vw<ØÃGy*jDåÓ¦cÔ&x†Çó“sÁòàÙ~ã[‡…`Î\Þ&±¯êåMÖá©#ÃkS1Ú¼?5:@gƒ:Çr<ÓÙ6óëš],AÅÚR®¢÷®i"ÄÊó·òãhFœ>æH–ŠërYÓ5’µ#:ÕÀgµJ]i(=d(‡§²Äè±ÉÄ=dºM{N<\êÖß—_ÎZàÓ4ÄÈËª°ÝRñƒû¨Ï5‰)pÃÐ<|hÑÖž}V|PxáÁšÖP/éM0ZòN|øN§gD€^Äk¿M¤D_´Í JNLØ;BNóöP·ªG ^‘¦&Tƒe†ó*±É³÷ßš 'ÁÄëë‘h%)AÕmÇŒAïòV¡É%Ø:u§Á‹´B©8š¼aÈ‰]¤Ö$!2Ý™‹ØzàšÅ‰«Ý½s	/::‡ O_ržïPô÷j’´æSÇJ€òR—ï¶’Ÿ¢{ØèêÞO¦Ÿ*š‹2§KøøýÐ,0ªå¨X:ø¬è%Cô m$;$>©•gŒá5ñv¦¢·±Ä…íò`eôÎ Yñ–Ñ46pÓ'€b…c\Ý ‘q²˜.µèSxˆ«ƒkj8Üœïo‚9æ%’&ž˜¸/«WÍ½Ý}‰ñûš`ÐP;ëÍ
ŒóO 5	‡ÐtO‡<)XDÞ–â¿è¤KŠñùO¨>êgAQÍjm§˜c¯öDã•	8„ºïòŒôy{A¿½O÷¡~èCÂtÜùœî)îš©Šu°s}‰Ò™0)•ª"àÈ¡‘Â—¬F|±@8cÁ_Å”…¯»¥ÀôŸ++tGp9ëÚïØºŸ°ˆ"w×Û\GVç–”Ôkœ™	£Ô.{òƒš•#¿êG‘žo‰B7I!%Hàžœ}¥V¢²IGf*¿õÏþT÷ãÈl}2ŸUÜÀ¾.H*¶(lPmI>>©a`yd«ì0ŽY²¹U¨áåòŒ2~Fp¥ŸÜÞ§a\±¨jxõ¸"@àúzd®Ÿ³Û
Ã‰@ÏW&ûñ¯ÓÈ­4±`Z™S€18gžõ‹ªYòtTÒéÐy}•˜(~‚Û…¬ƒO‘=æhÃŒÿòë^wŠÀiµ$Oõ`ùO¿	¬ØgS½i#LõÐÆR@›ç [K;´IkàGüÂ1ˆ¢ô	ÁTÉ˜·3A¼ /! n­MØà‰H­'^šéÃÂ½§ÑeÜn$FJ†ÏjG¨áéÓÿÈêloa¶¸Ä´†3‘6­RÀøRèµ5‚/¢~(.ŸŽÐ4^Ä%¸‚×=÷]ÒYÏyÑ…G8ÊUêU.IŒ¾âª"sl‚ÔiÜë-^m^Ë¦+¼AÓvé«ä¹xMhëfO	æ1¨_*Ñ­†I¸ÿJI{T"ÅM%y•xôÀD¯È.‹ËT%!æ@'TºŽ¿½×öŽÛ Û¦›—»_mýjSÐÙ¤U*­òHq¿O®ëbifFP3äIlÜ{•a§âãRÌuU9¤‹™&*ä2—ýú7êye“}nä`"0{hÇ&¶+ÝWÔÑ¥.­ûQÀˆÂ†õ¨¯{T£î,u
¦½«éðÉÙà•c~×"¼^	Œá±£ÉøEí©ï÷PË—„³s­™óP¹ÁP×A­Š•“?ÞBý“L'=F‘Ë
Z\ü¥S`EÌ(Ol+Ï™„$"
…†ÒÅ@2ü™ž_êVn§2ŸÆÇ;Ò -:Ù.ØI^‰­ûe=ÐvüÝîªŸµÆ‡sãðœ/ˆ|¨LG›Ú¬ƒa0Þ@ßÑš’q®·J’†ñáâ›œÆ~Ó6ÇHNO &â{uPù3 JÞ‡Ê¢1y›_>ÔàI4#*+qg,Ú4èg^UÎ».Þ‚ûªrÐþ&{­ÁìJÑÊ”_›S8'K˜%×ûO=Ü÷íß”óÅ„ÞR÷+³äêãƒ)ù3&ààR©W õÝ7³‰rªÞ[A¸–µ­éšÜ»0'ÿõ,)“º¦™V+ÍU„¬:$c#ä‘¿ãŽÿaUŸLåÝÛ¦SõòNÏ5$B=r„¯«i»å§_IÒÝ`ÉÔ(s§W*‹á%‹…X¡q,0À/J3)uˆyYÇ´{kT Ùk`k!@êD“˜‰j–±„Î¬»¢ª•Õ”P4€	´òzŸÚêi0¦H%ájhNå1ü«¶Y6šïîzˆÉÆ !9Äñ¶ÜÙÁ€68s<WäÞ/C½î‘&ÑÙâ¢êPBÀó²ÇYÝ@-ÃTj8˜N+/M¼ñ7¬¼îÌW=$ù\Wøý6·,<c	/yåZ^lB3(=ð+?Ý›Ì·!sñÞà/OJóßËðêvI€z½<¢VÆÆýÚTaÍîôÐ%Œ!˜·ÁÌþeÂå2‹5Ê%GýŸuÝu<7Â1©òÜ·MmHÄ—±Ã1“kBó,ÿ-<(¼‡Å9‹Ø…Äž³Ñ	âzÒeŠúU‰Ã¬9z-ð?2|€ýÅm£Ps™t¸m®Øˆ!O\(ƒËw÷%S–®+³!VFŽ ç#¡:ÉÖ¬ì««€4Jg°Ÿ`¯±b]cF¦ êœýlOK¶©!p±XW{Þ.W¸(ÏŸÿK€m¿$…e&#á}&Ÿ_Wâ^CòŠZÃ[ZŽWD leÏbNÌ¿üþúÕ½ªT³“¹=2 OŒ]ñGiÞí–ì[éZþ]l?Êµžœ#‹§«tq´©!·C9ŒjëëG*23ªãÇóŠ,ÒqÒ†Ò$ÕÆkYØP•èt/w"
‹¨{sƒïv×£ÒA½‘qF(!d<ÎG<–<ÐÊ|Qk)õØ>àÝ³ÂŒ›¹íö‡³ ˜íÐépedœL‚ùîÐ?ñ|…PÇV„æˆT™å§ƒÃ²ÿaáºÜGR 1ƒÖíè*C¨œ>¾À˜Œb¢“J6^{AàÅ™`ÔÀóF‡6.%¨îÑ™UÕŸRÐ= ÷"Ýº™E«K­’²-‘hÐÚ8p–ú¡etìµNu-, Š²C{7‘ç!Ùü91r"ìnƒºÊ«]y0²œ<Ä§Œ×»êYwŠýcU¼&w[9Û]ÕÑº‹Ï|Ú<úœ7‚Duê]S£¾T´lÁÖ…eë¡P´°,o£ùè5»îhÛPÉWZsXõhÖ3ÇË8˜ßÓ VäÇQÊ@çT‘ÑÃRðbqTHÆ‹©qÌÚfÑÊ/_Ý}(Ú¤·÷ÿ}<•ýÁWá©Ñ™,)<jäG ×s?Ô›¸Œ§³¨µi«rw¹…\‹Ï,8†TÃ€ë\¹}ñ`Äûk¨†jæ·µQ”ab<>‹_›º†iå3–·#[2
›-%Ëƒà¤Îj„¢¿FÄt¢L}ÅbÉ’h«!(w?=hÜÏ¢äc?_2DÄ&JèxÚƒo×KŸ4W‡ãÉ"x§t¬	Ðë›„\l¨ý÷ðë³8÷5@4h|”	>°ó;x?¨ã÷E®7eu:p¢xõ;¦F+h¨0\ZüÚ[¿Ó=Ö**¦ß¨Á“ æ/Ð-E®`Ûâ|’ìâbsßð¨Ìþ4c.RT©B·µj‹šèzÚMÙ¶ý×úê°ìER@Jkj[KÌtÄ°§àé³¼vºÔæùì<	°#ÛxÜó}l§*´¥"û“ŽgnkGŒÿ_„L]ø•LÚzØŽAïýêðdÓÜ¾6 ÈšØ›‹ª²¹— «ÊH“²ÚýXÝ"	Ê…q¬¢"`Y›Xç-Ä´ê5|½Ý_6Ë;¯­Ý’»Šáq8‘ö8£Ñ¯â€~ˆ„M×¤‰ž†~Ã'àÚjb©÷œêÀW4u?úa_"•¯]Ãâ`žú˜5è: Cq"«R§OÓŒspí…¤+©—·™¡-˜¼+£tV?¤gCRÛ¾8òç
©®êéfÛ
ÞÁFÏU”“w¼fÜîìFcÔ—’Náû/¶„J¯~ˆýNÚ‡tŸ£-&ðD¸•yüŠHŽ %é÷ó¡l“Bè‡,ÚMJì’ñÚB%Kuˆq8‘Ñ.ÖT{Â”2ØTc¿s\KÖMïuÜ`êèŽ;o:«¯7Ê1ž{å}P¯Ñ­»šY„ð¯úaùŽßßI2€EÔ¶=eœ©´Ž·€cåÌ“òP¬GÛ—ÁÐEyò®,*N~2Ã€›Óû/¯„së Í=z†£ãý›oiéçÊ+SQ¼¤–r<£Øÿfb?‘ýî¡QÁOûm¾ ï£ïas_ää+‰.˜›û†ó sÓXÔe°à>¤ú¬8Uº8Ÿ‰ ÏÆ={ýU{rÝëªÖŒV_Aå-Óð—¤n³Å¹ÎxÉ/o4QmÅæùà’ù£e
¿ëÑ	Þ‚c»â³ÝÌ%u’S‘ë¸~ŒôÒû-OqÏŒÌS;ä?š'HtrÎÌùÎŽgú0åÛ?“‘½Çß2q=\…ÕN³METrÄMËG@¨¯ðÕ9lp]àKeŠ@¼:’!h!ò³k§Å}y—AgˆU.L¶À—ç‹ÎZŸ)ÏOÙ~9°.òå ½rÜlY¿äpí5ª³ˆÍa¤í LÅJ/‘ ºHAž³ÇþM«¯'à§×ÇYùùéº“‚cŒ¨É-tç\•Ô¶ùíT\qúÇzgeË8hÁîDŽò°·]¤¹­o“Û]òŠ¦kIkl×ŠŠpØ1N
Ê$öÜ é!QÂé-í}'³Û»{ÓL°=ÅŒrš4I•˜²¹cétC‡ÍŠÉ¾ÀÁ­tæãƒšmóSü„çÀ²^1žræpQ¿BS}Ä[±ðõ!ïÒ+¶I¤f{'+;½¥½`×Ûg4ªV‰Æ±˜Jfø\Rl¨l[OgøuÌrÕ»Š$‡lM¢?!0ÒÒ¼l6©BÔ;KšªÂ Îyî€ùÏ,ox-ÍkÆJRÉßvéªåˆ9ž’ÂUŽ¥´Ÿ­©—‹°ÿ¤Á ;ÿ¯šËÓ_Ûq¼©(jƒ@—@š‹³p`!	>éU7±íŠ‰¾ëñ&Ô¦ÂªL9h¢Ì=ÇÏ”}¤ÖicÇ]"ã©â¦ÂüS»·IbãEyP9ÏN…”v6W7Ìz(ï´J«¸©,ˆ&™p344“÷h…M†@ _~s¯Ü+¶-U³[ÃŠ a†oåR¥4à÷k]*@$˜ç¿±ƒTÎ
:c	Ã†¯±&¥Àõ2üÄ¤t4Ré™DØ?&Ùstsà„¼ÃV6§D¡{öNÀ`±$î«¿ûöG4ðþc@¿‰®„é¿kŒo?c‚ž,íÇ+N¨›ã_-A •9@BôNnkÅ+3Rq&‡‡O*<ÀEÛÛÂØÀ$R$ÞçñG“®ne‘ÝHj
âv'“¹üz×ÄYi€Äõ±¨·þe=$¢*áñ_–ó‡üvÕÖó+íÒÞ†Üc‹}4srj”Ý¨¨Ðä)QdâÇP –-jMsô	b_•ý}ÝstíÖÞnCŸÑyFƒM$‘„YÉ–wÔùŠáfÄ=œ˜ D·w™Q¬÷ùyÇnÛ9BŽjëPŽ”æ`³y¿
¹ÿˆºûÀ±"t`3o"<ÆµJ©Gç¼öÚ¡ü3H}Ÿ€“ê›|[o'Ëv»©õ1å÷lºˆxQ²@¥V6yºOpH‘Ð¤ÚKÚ˜Š#€ÙnÓ9M I¯“ö'¿/_;áŽÕ¹] œÌCpŽÓU±žË(ú»-=¥XƒÂ¨:ÙÝî'f± n—W³5¢R›Š½j°,Šº3GÃ«dp¸‰:j<j­ì¾›òîe=þqÖCír/Ç»ÞÔÄkgiF»íÑáçp"	‰‡)Ä•[ïQ³™ìeR$FåñÞï	œF\H|¥
û–	è¦HÃë÷ò¿V6ìãò¬^Û†Á(ïédCêb¿½­ºzÂ‚U¦6ä¸[Và¶Ês©Ÿ¡ñŒœ:ùz;¶ 'ñ…³!˜ˆEé½9a+ pŠerÀ0C%µ˜-ÊÇ,ðgu?Èƒz­Ð2zŠ"ÐÌdS*xèæþABi‘‘BlMàÊQÕc/VÖ×ô¶è%Ÿá$Hž›|†ïqïÍ“ìK—„uÝß-R­Õàÿ˜¿žqý\§åiü+L;€7'ÿãÙ`6/Ú";3'Î
ñúVÑéÝ·
ô”®ïÄ'}­|–¦9º<Yç?þi^‰w({6ñÕY/ƒ±aÇ½ÿ}=¬ƒ•Ðý¹BôËJÏâ1Úwåé„Ñl	.\­ÓŽ«”÷Ÿñuì­µÑ”ÏÈ¹«‰…æ%ø:ÚÊìn¡+äè»JêÎyœO_ÌùÉ’¥þ²D®ÉX2nßy]ë—b”‰B%Õ.éÀê­ßû]W¥7;Âáó–×:ÃÌ¢{ÙW
$ò³YèÊà&«i­>¨²{=CçÉ¿:UÃîd¥Ë±ìö´Bäã”×ª‘ˆ¿L'HÉ±ø™eëQûØD›„¹´Í²¤ý EÎ°H©ØFÆ•ž_¬>§~Þ”¯COÑeþË-¤«á®I2Ë¬Úu¼"®×töŽëþÐÚ×Y)+Pšã7»UÕ*dŒúÑîBÔø–d’ãšŽL]×oæ†²8jf&èÞ<c*¸B ]fŽ"Ø6)o5hÚ†'ö@¶YMnCA,½ôÓouç5v¬ÄÉ½ªtý‡nO¾~:{"^žœÛZÙ’Ênïår“+d~Û[í`qÂ‚¼ÅƒÓzåynÁÏéL3«|¥^Uœ2qmsíeÎM
dOƒ-ño\SÓJìÄŠÒŒò„1`W*O{Žýæè4@÷Z»£q aqunQP…2Ž|±E¡‰à	’=ÁXmæ$’Âéœ/¤Z;ëÝÓL.øï¡@Ž\ùb>´åãXlÆ\ÞÛÎÎøá$Va(‹h‚Ü‡ÈÖå:©ˆ)†NÔåû¢Ò €ÑJXè&«³/Œ&~\dë9öµ§%QòsüÍoGñe¾Ø$9üÕmÒ4­ÂN“ò®1+:¶ŠèV¿µ_Å…Ë†Þ­e-LÎ>éÉ«jÈ€}ç˜wf´9³Â"‚;m×„Åë¼¥ð¡òšlw÷ëPlm/,$ÑÁK´¾þ^Ì583Ì-¶RÀÀ÷/9¤ø+¤F„4ÇU\ñÜ¿+°÷GŒ^pàXxûÌv£ådù,!Ù pDsr±s¬«†Æ)Þ{O‹‹‹¹ygü‚Å›ûá–‚Œr£(	°_èH‰	JBÄÒ,zûíÜ–ù>ôìÀÀ_ˆ@·8#èÓiŠŸï.!%ŠÕ•Åûˆ§™‘ðÆª”LäVu‹~BïnÁ_¹ÿðv0(ÍÖ0l|•Â°ìP™¥ä™Ì\ûZY_n­^mò–ê=•p;ÿ8+ë²¡yº#ªoƒ|)¶Jç¿^h(ˆƒRÁ¢˜®‘µ™jÕiš…Û2Wi;5Ó©<RŒ”>O¶C¼Ê‹QT) ÒñjA¼„Hp™‚³ögJ#Žâ$z¦/D\è¸I·ó)Ä2‰Nª*ˆ(##?‡øÚ5·ˆúß„ðÔp>ÆId¦àÌaƒgú³êz„¼¤="§À¼g)ðÅÅu‹35ƒ+b½î]`õ{~¯öuÀÜÍ8?mœ&»Í™‰Ké‚èFd›(yu¹Ð ØJ)3ÂŠ³kÑ^F¶$S‚G1¶kZ³hKDÛ×#Q{‰DlÓ™9Ój §QHŠÚÑž„0=nÛ‹+½µIÜ@³iTËç­æX}É ½åÕõ¬€Y/¾½(õÏGMh— ¼òšÿë%Ê¶Y3ÎlžzÚ­ù3žÜ Ó4¼ÑÅ
éÙöˆ4P¡“-ŸGèk,øÍ@J*ôN‘3mpûOZ&F~5	ðÿoá% fÞ‚Ô7o†€	U@x¸Ò¶‰¼¸âÄ!·&éÇ¾8ÞiFÕáŽG¼ NÇÒ7,rÜÒ‡ºë¤f…œ…G	ýªwú}Iðü *Æù"òÀIõSÃnÛ—Þ¨ÖÜnkI`¤ÎE ªŠ="r‹óñ¢v–ïa1¼ÞŽÊû8™ìøÌÝýÆGþbÏ—'˜§&a†Ó”Ø±òw“¶ÃQ Î…óÁ¾å±á­©–“†3.Tž,ùzWûåsIzTKÎÅµØ•ôËÅAtTRËrº‹t‰ã…Õd9"N=ØˆÉ«Ÿ‡ýpâ¸iUFZmìNÃ¦>·ÈRí¹Y¨žŸuKâ4£¯Ù;	Az*gn}pô§R¶ñ‡·¥ùzz FÜ$™Ù/ç¶
fRO|¦¼²nã_Tˆ­L´€ÜåËæpÍÕØå]'hé;¸Pg†…¦Ž[Ž¶cy%çlãÞ/PYƒ² õPPíðËùàûÔÔæAú4Ê/FvKè¯ÅØ<š„&d€lA³0Æjk\êo£ýSuÊ(«Íñ¨à+«XóZB)K›ïÌ°WZBš7ÒHúí
ÿ&ÐKº«ågþE9(þ¹â[_Ä,­y} „àùñÑV·ô^<,ûD¢Ó×ÜËÃ°|î[|MÿëÉÛF·J¾ŽÈ¡ûç+\’Û=Ü7‘œßœ`ûWO>äÐT*W†}sŠåSÚ,|Âcí1LÎ‰a4MZb¥Y8*¨ƒ -ÌÓ‡øó¨1:ºµ’ã fyLH¦[*i.Üæ=ä$9<×x6 -)
JW³(æ‘•¡ï–U‡Ug‡tàÎçÏ»,]³ÀK²]“ä^<¡«Žjøy}ó‘…)EˆÔwéýdòCÔ²rÒ+!Î”×«ÞNÉs>ª+›+ˆhA=¸û.c[=CÉÐ–?eßÉ©žþ˜KådZ-æ´msqúïº/i)P63§ˆOI£¸
é ¾u‘â®µŠf!á›JšE…Ï“ó2Á+œf	èÚ”´&€ºêŒ•	IÎ,Ü‹_»t¶ˆØ4t[”÷:wy&f‹Z9ó*6Ç±/Ë¨‰—”AþhÀYËP½ã‡Ü‹|Ÿ‡ìh*M¡¦º6±AkËXÎÇBt@ý
?ãvi•çf
ßd@r˜>$
qµV2}¡wˆ¨ça6rÄÝÁù¦éaÉpa5þÏø]ë:÷=‡áºÁ#…l_Û42t²/,úo„ºê,õõv]žðtÂ„‘Í½BPµféÕË½DØ0š>ÙMvOø_¼&)„¥N±©šVóàÈÆüaàèÃll^€d62³öÏôõÜe§à[rÑZl	…"íë¢…tð{'÷6ÍŸôó	ËŽÈ¤*…vòÓÈWpºiº?iðG”·J†¨q4‘÷±š&WS)áöÄ¿ÄËËŠk¥WMÐ¿¾s=Ö6Ù¸Ò{óAxP±RbÇªý¥]6J[žü}ã´
ªÅj:&×<§Ë˜#L-š¯™ÍæˆRB¯ŽÐf”\Z‡ˆ¬Ê7ÐU–G€yq·£x×â˜Ú[Œ»»´è‰öŒ[–Yý·t_íØ`I'Ø[!ý)r¾ï+
fh¢ÅÆ2yº÷zR	„Ün±­K!àl´/Èú“çßh€ÝãkY{…šúèug
/õ%j,Áî§ _©DÁ½Ýl\ò¹úxÉaAzHÌ*"ªeEãŽKV=–}×=“ë¸^†‘œ$¹Ÿ:_Bü/==S˜”ç%ñíô"îzH£„!ÙÕÞzÿV©^(½Ÿ²n&Þ?å«˜–ˆë'Ä¯>~[*åª#{k~bà–®1Q”;á ²~ÅÁë½ÚàIè~¬$%÷à5/=ëbk[&¬Ê÷ø4â0ÞêU}WÝœÃÙTÕæ†€µC–­]’ž|Æ†š,Ÿ‚@?»fjU×ÂJ˜·Ú^\ÌÁé :ñ1‹,ó«—2ó6àjÌ£´¤Â‰wÄi¼%½«ñ{„ÿÖ§‹?Ýé–ó<½éC†ØFñ‰h1ÜežÓZÚ€EŒûsj'7sÈ-g¢Ð·Æóþgæ¼Æ“qq¡=+´Bd)™¸zOÎâBÆQ}À:!‘œWÌM³#£ùw5»ë'5s'iÆòa™$¡ÿ°±¯çh]]°$IÓFºûqDÞ­Ìz;ò¸ô ¼û Ç™'k÷ÃÁœYKKC`¢ågFÃl©›9åú°7ù¿<õÿÆ$Ù¨¥Ïb.Ò†³iÎ@ãGkN`ÿœÅ:ƒc¹˜'žüŒÕ¯QSxÔ£Œê#Ó;$ÃÔÚ>œ[ž*¥Å0žDùÎoÄð×«Cð±jAˆ±ZÛº1€ˆ#vª;ŒÄØ¸\#oy®ª¿õ$Gy¾çÐédzüìqìî™!æö”	J¥CyÖïQÃŒúuâX9T!ˆ‹_9³®‡×Åà²ÅÚ€ÃUŸ‡»?¹á|ô³¡‹„ãØšÚöâêsW”mò3/Õ•MÝ²T¿nôâÍÁ§ÍƒEUº¿OñNûI‡ Q5ëôÕ¤'ˆÉ>˜Üæ1wñSò>b’LÒOñ¼–$ÍEc?É””ú)8ƒí…/ª”qWÑgO$øZ[ÙØ’R¬‘ˆ%¦UlfJ0Ÿ‚Óí¦¼)@eí>±Ô'³cuö‘ÜE‰˜Çy*#'è‚ƒAY­Wãéy[aÿÅ\i°¡CŸÑ#É%¯	—KÂžùÉn’Ž›n$"›h°¸‚´êøÉÃM†?L(Fžæ2›z7±9û LÏðŽK360€Ž‹ø3Ín®c• ÜŽ§bn] jA¶õ9?Š/È44u¾dnaCÂàC~W“æ@ºR;¾—ÉkçFåÔùq¢
$4Ç{oì»„Ô¹þ5²¤²U
ô49·T¨¾QþBŽ%l+á¢frø…Œß~é~†&§8RÈÂ®bW#4ÈéY 7Œ¼¿'^9c-d”£²÷@¹%ïJ"Ë-0ãõðž¶¼l#4z•á´ÒQGänEvøÈ”æcÊÀ@Hô°¿áF¢Ó®a½ùd¨g:HºÜüþbV'fœrDîî{áºnßÑÊ£¡¥êíAšppçÛ!Ûçi 3 <áú÷§¹ç2ñ³>ñÕjÐn6ÁuîÀE¢>õ+‹*ÑZtHæ²¸fœwÃêv91ý{®°!Í·GræCKÁgŽpŠ^X†ÉUPKà¶pœ¢• Š5Å•“1b(q(%»Q°ÖÒËë¢Y y	¸RSQÐ[†bjZ`Øˆ¦Ä‹Íy à†RÆŸA}U¦;r%‚ÆýhÝ¤Hœ ³¨·éuEï¹T¨u\6F^Ù¡;3èÁô¡\¿^ksÈï¨ˆf^£! %‚éìIbëª ç“øA¿ÂAƒžRlÃÑÑþÓR:‹ÉLÙÔ&gMÓã;éø‘"¬š y}¦Œ¸'‚B?RA~8Tï|ÃÉ9ÂZð‰ÔZ¼a‘'‡%ˆƒâ:øÏ¼ûFjiÖJºÆXc—¶òÐ0# ®r]uOù’ûTGQqX3,.ú¤‡:ù7ð¢¢õ6pc%V5ÈÑça5¬›îñQv8Ì­iI	¯þÅç—ë¨,ˆDiÅøBçq€CòxE;–„$™H*YLE^IIŒúÖÜ \9ÁÇ%-¿EvAá5úè÷GŠ9†Ó¹“÷/‚Z:Ü+f¨~ƒMß0r {ºGÓgCu°™ZÒDrÆlŠÏ€˜G²dû‘­´"*= ñR $»³rÖdwFIÞ9s>ú/§Û­+­ LJ‡§‹ mê:—?´‰;V
Z2Z™\çkGepÊÀOv"^|Ù>¼Çï†º\¤g­ó¢Ä]yv€Zåô¬èùNÁC{(fJ†D'Øž£‹âÚ“JÔðDÝŸèv (Ý+¹¼_ÆGrWï\)ÁõrŒ“ »
‹urO#¯O½À¼´#á;¿mû
Tt¯”vé2Uƒ>pæQŽC×_u…-vU»ûRÿöhþ4ˆf$¦\_µï«Â–¥Îëþ‚:mü])Ò1—0Œ½sø-SÁ)Ãày(Å’¥•p£Gbã»à­Íl¡˜õ)¥û4o%€› ‰vŽcGM ò¶åâñTÀ·àØü½'CÿX>G´Ñ¿÷êüë¡M=?ýº²à•Ÿ{þ,¥J—oÖjõ(y°)¬³ü‘<DÎŽ«”‘Ž.¼9w#£žŸ«û”ƒv©4Çh=`l¿=?	Pú~˜Þê¹6€Ž$Ù— åšxu‘cŸ9å4hÎ †#Ö¡ã’ÀäZ½jö>ùÃþYU’‹)¥õ÷gÛ<)ç‰®õÜ;ƒ°9–¢Vlê×{I¤ˆÝ#Ì‚.ö=­ÙŸ‚;»äÚ¶Äz›Ëà!Ê>îï[çîöhãr•·ÑB¾œEë¶©ºëÆÉ¯x’jÙÆM_HØód?„%ýƒtâù×@ãAFO!úÈØ'd½zÔùˆ`ž&Z^&s±Žå¥u–­+õ Óßˆd$Y™³*="«Çª¹;uûïâ@ øn1€Ì=/ ômØžy‡5ªvßŽŸÚ¤–é‹a)•Vf‘Né0´”óy¢Tæ§·=ŸpgÍ˜ùÙþû±ß(×e'«TA¬|,È_$¦âðUdY7
â²]glî½¥-M9ÜYKo¾ =ôEŠ®$;Ñì®4·²Á8mù©ØRgû8µoYš\JÙÅÜt •ø ëìèm^‰	=:Æ¾ì:X‘®Tº¯ÁK•¾ÔŒJ¯j„GÊè!	Þ£µ£Ã
ìÇ#›l3-rH)¸’vŠ^'ÅºñÀ®FDGÉ?ÔbÁ
eŸ®©9ËÁVBø™Š×%¯%)Ò±dÈK÷„Ï-¸›åhÕÿÇ¿Ø§%Ó™‰4Q?dxzÅ}ÕÚi•ÃMñî^àj¥üÍÜÈØ0ö7ç~ŽôÓ#áVÈãÙƒBŸöéeÃNB6Hý¯×0âDƒŽôX¼w—(³®½¿;)êd²³Äó¡Â§&!¿*jüÊIZ—´ÂC¦³¶¤ÖiKä”á£î•ëŸ=A¨Ýw:xÛr?î™Áí¨ðGN»ç©ÙÂ\ð³VU;‡Ü:<¤å"p*·èk/ø=âu?—=\?¾|æ³ /yQwûnÒf>#!áŸ ÎXÁÒF'‡²dýÿÑlôù}œ€±²³Ìò'²ñZ¾ý?]øýÃ³A¥
êw&Dö÷MoøM¿ÚÈ#Ê~¾i%>v&É·5¼¨¬qîéŒîXn×wã¡pðèiLjDzáã”luXÃ%Jó‰Ä4õrI§¾® Çæî‚LF™Y·åWÞ|O¥-	åÏ~fâ
Ä¦E­ðŸ“V+–‰ÐêPðÍX Ü¦|"amÚv³£(›þ:ùø ÷¨.,dë*8zi€Ã›ŸZ<ÆýZ–]li”Éi™ÎüÂ:„N;rµ†¾ŠaZ0§ÄˆøÍf²å2¼cazÃ‰_CU’»Æ)i¬’èÁÞICo€ûð?ªÖ­ïÒkü±Ú(«7·Õ{×ÑMˆ¿÷²Ø³÷}Xá¸®žgS sŽÀøJ—`Âý$º˜|$Ãr\ÃìÛmo>›’G’VúIy}§y®`+Pöù4–·»;¦úýfagTÄ H0–‚aþáYQÉµ>ZÄY"%¯"Q—*<aëØ­ïÝZÕj0±Ì2(}ŠB„Aµ\ríƒ>+<xÍ®ÿ®k	ÿ†üÃ¹½Â0T¼æ——ç•^ ¦a¨å}z›ÔŒ‡J².g©{'JüíÚQ1}±r6´†6;$ü÷q–FÈÀK™†ÛT{vI’ÔV,–æa”?oæÑ¶ÅÛ9‡°ßî¿Õ¼s0…ò+öãº# ‹[yìïÙëxà†}ÍË¹•M>n<Qï;Xç6Ëêið'%Ù]ät övÄÆHºkÓå.c3hž^îœ	þ(·’lý¢_­#Ø4Ø +1tîs éã-ë…ZRØ_³Ø}Ò‡ùw?Ú"þ®Bï‹Â?WÛOm¯Ã5Â¼g#quCML¨8*ê;b1û¥]s\Jöå–†Ý‘3b¼ÕÄÑLÃó¨´Ó
Î ›#Z“‰0%Ðz»tÅšRî×›³œY´à
ýžR*s\YØ~np?Š«*}¯MGLï¹C’8§!a4fø×ú}@¾´ÊÆ{ñQÍþÇ¦ Ùš_K¹8hü1ùgâÆxVâY–l›hV0{®¦ u9¬ ùq{ÓâÒ•8Ñm+ƒMï'c¤(ïš‚@ùÙö$$†G¡Örª}MošfÌ"o˜tÚµø'wðJQ)æ`_mcÝ”(G71ÍzÞR®_&¿E7·¿l©cö'Ö"ø†Ë^nÁˆ(ÆÃ¸3¾]=’…ýY¯¡V˜íØÅï¨m¢W`¨Þ/#œdh—LÞF%hZ) 71ÍBÍíp2.ŒÆGâï€WÈ=ßi&%»Ïmà=¬VÀfá`itg[õSB¦rö×Éã„¾¬Y‡¦÷×%>Ql„èAï2à«‡)Û‚h¬µAÛAÖ5Æ¥u¦‹‹ÝÐùBÒHGëØ8’X„ftì26A´,é’îú`Énó—Tð;x£Î6–kéZõ”ÚÂ>úð§zŸ¦òý/2×UúCU²7Cç"Jƒ¾~·fjzž/š0-¹ný‘[ŽÞ^Ã„±þ¬‡t…Ž!“@öéÀÇÉ¼¥dê¾rýe`Fð ³`¼îÚšaIZW°ÔþHÛW¼ùÆÑ{£rÿ1[ZŸ|f–×¬ß\BŒc]–Yô¢Rz–^õßõÖB¨ø~ÑèŠƒÞ "«
,8Âð#$±8‚MˆŽ¹
ÒF•ÁIÀÅé±GÔ+}Fe°-¹[],•`_·¾dïotóö™3¸ÓnÔ˜AåCOtÇßÚZ¡Mñúë·fsîRÊX»u³ùÄ_\Í¿Ýš®w‚hÁ•Cœ°¶<•t¨@M÷N>P]PÜ¼[Çbëë½-S“zŸ¸ÔFN-¥Z½*±»­Ï)ÿ…»>Þïl–ÕsŒÞ©öNœÔX-íâ7	6åé«Âj›aÅkkÏHF›±oqPO¥½ÝžÕShF ¿ïvk°2N›7RÚ»~FëS”a)‹DÂA–®!ûdƒf/#Z/4@/‰ÙÅpûž,÷¸—é
Ù\f0Fâ°BáÂáeŒŸ–ùðÑ´UX—÷_Í³5vÓ"4[r»/*°¦29Hmâ‰Ø`@ADêlà]_…çÿþW¸vûÍW.7Tçjé
ª„Eòú¡O«·–“üVÞ‰SH¦§à–T˜Ù£?ÉÅÏoïÝ4ø¦áJÍ™¶j³Ô§Ž§n&‡Üf>i€ÆH†óôŠ6S‹¨d8:1¶°'3éyL=Å%œbž×“d§vÎJsëüÂÕˆÀÜ ªÂ‹>ÐDìM Ô§Ùú¶kbT:É(•ý"ù~¾HÉ¾m7šÚ‚9TíÓômKÐ1Úm4½Æ);ú#7Ã+d
¨ÊBl¾¯±zñG-²dŠÒ:Ì¹Å¯6'6•º“.ÌKžö;«I¼]ÞÁµàùô^°û¦/f;=ÇýŸÇ`Y—¢·üÃìE†©|°X’VÝ¤nžGûýUqV\ƒQš_DóIºOÉbçòßÜÓ›‚´vŠKÛ‡'Ÿ AL;‡oèçpÈPt%*”3Ñˆ<Ò#ˆ`Jp²ä+`ñ'e3°Ý-áaåÐzZ1.vƒa¼{t	d¢öÞ(Öºû±‹©ÇÃ€u_ê¥ìÿ˜X„³XÊbX;mÊóÞ;'-çßò¤Fý¯@ðGÆk0tÎx*:ò ›e¸pÙ– AjÂoµðSpC"Ò×Àn,?Òè6p;cÖºåÞA£y,f<ÿÓ;êÂ[KÉµDø[a9‹ÁÌLQkÛÌíBÁŠç6<0|”u¨™‘­¤§?ÃLúíÌì³b' !%¨Q>ÔÓ|˜VÇ·¾r¡Øæ3$¯Ì(eP%Ÿ@››Ò p·_Á¾,K‹êM§|¦lÑV
ñíÏ¾æa$A£ne;Ù0‡n‹Ïö(ªÏ -Ü7bd¬]8×ÐÉ Œ€NŽ E¥ã¨ƒÎâî„ìkSyè{šÓ¾TüÆG(ëÿ*´«}ÍC¯Øàú¤(ÊË§ß7€ST—ª	KÜù•s™öÎºì+œ!QÒ[h—Æ½ÆMúö-=ª3ä‚¿ö-²…’®U"\)„Z{ÄYVá$ï\|õ.I‰ûNøÊÄøMË‡ºÃTÀØØ‹ù fc­™½™•„Œð™W\¾Ë½"Âûê?Wç¬Q‚‰Gãrñ¡#5ø>ðtÆ(Û,dH@² „y×UÍŸQ•†gke_4‹\˜â^;dž(ãÙL¼eqwbYðeu–ø&\,¾'¸:AÚ"Ã€1=_:Ž Åîì [†**HßAOÙ<°A°Âò†q¯Z0ƒJ®?YC˜4ÀïSýÈrR@ËSÙîû¯ÛÇÄ8ó˜Bù íeÂøp2åš„éóùñ
xl=7FØÚîÙý%›ÃµSµ½/õ~	ïIäp_«û)ä™ñ¿¿š>˜€W£ÛÂ	B•®qp•Ü;¼#ÂœÅÐ{bÓê¤ŒáAúÕ»æ×å€@…n^%pz	 ÔÆˆÜåM $>ªò\qJ`TäŸoU²Ÿðé_è¶S~Ì_KV£P6$+_â>6ÓL}Ä¶!_ŠØ^]<†0¤5éÝ÷úl3ƒÛ·/b,‰bO"û>‡îNëô!­yŒUÊ\,–ÂáÛGdp3¡?ûøÑNªï´Ø¨óD²fÓg1Cž¨FÂ08[H»ïyÍ©®ú@eÚPì×^6j®9îÈ††E2xòâ9¹LY¿Ö¨)òôP¾2„Çr‡#éê%}6®¢Èâ¥yð8”:ÅPÕh˜FfŸ=vœBý‚ymîÞ1âŠÀú†(ÓTmð«0ôÉªwû±Ï-s'ƒ*I*\±;>^KU|È»~Oú¦
­«ø¢ÀÖóßøZŠÎ9™µº³–ÏÒ¦‘Ã¿ï» ,WkLFÅtÔÚ·‘6 4Yñ­¢¸É=,ÙTôÍü
3ÏÇtMÔÌó•páöµ^ñ‡)Ånd•ú¦æO…Ã«Â\€õ•j3ArÄLï>W)æãQ,1x”þáÈ`°´ÙŒÈÃ7fš%ì6PiQŸÇ>—]guÃ®eÖçŽvá@w'„¶ðDY”ê õ,u{s"1Ma7S€È»ì£ü¨=“¤)’ÁáÄ+“}â *-|ŸäëaØB„à›i'¹ôˆÅEÏBsNƒ8´Áô½^rÉJAƒ›|a
€ ×;‡Ï°êàïŸWkÊÀÒåÓðò­pkÒ™Y¹}…R¹Êþ“ŸŸ¯Íõ°¢Yg)}ssˆ?è€W¼Œ}›ŒÑ=o` çÜJ‹#"(..+Ñ¦V*O@šUj~º<«5*iöÉpw{P<;Ÿo§1ž<¹YDvÄ ×Vy±	þ£sKH¼Ö®?;È™àÃD‡/>Ge=u„ëžêç¯I¯VÄùß„…Q»aBy#¨ø‹ÙõÖ?}w«ƒ!nÑÕzó>Sbv¬Yäå[ùÇÚ­üûR+tÍ[ BùÝS=ø)d	;€Ë*lßµ;ðÄ½._ª>KfBÿ
QÝáÑ‡Ï8L1ûI6e¾Œébù’¥jÕdw1]ðÁrOòpo5˜Ü¶}u-H¾óÒkÎ‹{PÜšI‹‰»9òvÅ;d-‰£&Gº{‘*ñ÷g›ëØqA”1‰äºƒæù!„ð$;ÉN“Ê1iŽÒˆ[5•·Ë¾}•SãË¿ÆñW¸·w?!G:U4gïÈgùì÷iZ– “dÍözÖr)’Û‚!áýþoþžËSè«bp^Q„ÁÖlÏ×ŽöQ"KŒ&Æ{S²u¤ËßÁ¨*Ð&„:	bÙr3½Ã	Y­	˜Ð7mdP+Ä}Óâ¼±J¸ñóË6ë«cNVäCîZ°Å"OÏùàG¨Iyª˜ëš¨ÂsýhðUìdÎêúªiö†¬è˜C†Šâî8¬/ø0„ÎªDù…-vpËxCn^™ZhXN„ïd[TäÙ À—¥IúkÒy°¶OtLJnœBÉÀŠèVÎ|zCu;…§ßqGZ”‘A¤%ª¹‘ßàh(É¡ôèåö™Ë^Õ{Î¯—ÊqÌì{ïu°âËF
5O 5²~JexÐd‚ÕúÝ:ü	ŽÛÏŠ®î½ñž&/<óKXµƒ–‚)­2“Âp!ñÆ?ˆ½OÔ²všer½RßáÈþy!µ¨3b„}ZQb’tI\Äm²’ç ÈÎîŸÞ¥BËˆ?\ ÐN¯&(”q=$ápž§#_ì(Ë…Ñ•˜Š~*‘ò'u÷À˜M˜ý…‘œ#ka`}œÒÄ{Ý%iñ)G”åÅ×;Öu²ô
,1ôš½b™½ÓÿdõèUR´ÕK5‹©³5GÍ?}ÜˆóñýÙœ‰ÿ°ä€xŠ»’ŠVQ…ôö[³³¤!›ÑÛtºm<Ô¾Z®:5	):Ì»øˆÙ¤rû¥,Rc£37ÁÜÁÝ­—ÌÆ<D'…8sŠûÔÑ¹÷€øæ¶²«väÀ2i‹MÀ¬Ÿ4·Ê§™X§XŽ!Êµ”“šÂD˜åœEä}~m[J¨§c[½éjmyu’¨‰ Ë@Ãy»¥<¿3š!×´
}šŠ‘?d]mÈn¾»ƒ“ÖŒ^J¾¿Á
sª/¢u5¶ˆ5„~%¢™>A¿CÒí­îœðo>ŸFŒíÙŠg‹-U®(¡ïêÃÉié†ÚF¯|[­ÛõÇÎ%„ï\{?U¤Y/z%ÙÄb×dr„˜@!ñôÖ¸ @ˆO½[Hç= <5þ™™;	­æqe()ÿ ˆŒf¥ü9ì¥>¿Í\oÏ_äî­òO¥1Hè-[%º+½Wö´N°›¹¹?‚¦ÇýZ¡œôÏ`-ºv&%/’"ø hAùŸKÄ®¼5^¤7§ÌHè9GD(\"óC€áìœYã/
ZC]Ë9t]GEG·§ÁAçêxES	-¹L RáA¯`6€v_á(di®7R=ðÉ¥*p¦àÊ%ÞyÁ¦Ì×ñ©üüÅ=‚2.üB	bt¹æÇ’ü0Ç[GB§ ‡hú²€óÒÉmfa—5Ÿ¿®?Úg4rcC¥¶Ã°„Ò ñÖýæocþô8±PGOeèFœ¢/úÛ?è¯ÔG–¦ÿÆûƒoÍLÞ2•É —DÃ	sm4cøNPñ[pë&ÊåÊP&=[ŠeA”R'¶Ÿ¹3ù„kpÏü'h“º±¦DT÷ˆ
î4mh˜Ë”}ªSø¨ÕºÞ+ow˜àÝ¾PB›àE°ÉzÝû85r÷»\,éð³-CL÷M{ƒÇUÅxXøðC‘áÂo¼¬¼È™—»2‚ëç<èúÆƒŒäŒ1.Dó¶'`T*J²'š¦ÆØ³{é#tà"/’ÝÜ€=Ã…ñþ`àht'9:'¸jdFb‡Â/ 1€œÄ2=¿à²8þÉ‡Z—ŠñÈ#
`ß^·pShú9ÏH#xé(“›Éb¡Å4á*åOõºã/t;ãü 
gCNÇ0ê™u`•Å35»§«°'7ŽÎì™dÀ‰f±[] ïÓ({/Pí’èQ€dÍš¨r”%d¹[˜]GÀ£è aõ²ÇûÞ½!ôð¿IJ?¤®Y±ªàú£ì%Ïqß÷÷¥Ï<I<ÑÂ_žÊ«ÓÒ²ÑÜh^8ƒ­ª<ÊYíÎc\›Ï·ÝˆÍ06 †SÊ<§è°+ÂB	ÒPƒÇJE] Ê|~è€‚áøýFåª?”$/Þ-ƒ6„áý?ìÀµ‘žj…ùø³þÞyîR·É{êH¼š-·éö—‹ýöÆìíyRSüœºœa£k½Æ¥Õ[ûQiP5‹…ìŸ¸š"@†Aê²Äj7¥?7ÍbfÊ™¿ÔIŸh—ö[Æ¾XµÏr—æÙ(³Í—vµõ
ÍnjÂûe¤…rL/gñ7Õk.©ôÃJeÀüî(¬ÈðºÆoÜ¤Rð×ôÁ³Æ;fJ²Æ/}I‡JD´ÞaíR¯Â»g©¾®z¢$ûS­J—N`(‘
É.šµ†4Øß}´üÆ¿wØlw)û_…éÎŸðÎº¾coÿ™(Vµèð_'õaÄ¹^tB×7•Ùn˜Ä@8ÅŠµ‚"R^j…,¾Jó/âùÜlâEáÊY@‡ÿìè·ç7åáôM—¨G8a÷S‡Ò°iî1‘DCƒ›}=ÿ/aò·iµs¬ ä¯Ç3P…¨Ñê©m)öãþŽ»9Ü‚ ¦µW'™BÏ7uT~ÿèZ{¢ó©•üô]VÔF-9ØXäYˆ¼
õå‚ý¾B
ŠýØ†%Îã¡ç™MŒwzwTÙk¯×yÓ¢ôc›$ÿßTúgÅÕÿgdXUZ)ÀBƒ¡ÞYÄZ´^8˜e#ð·0‡Ý±uYt0nð³µØQœïÊ¾Ýy¹ý.Æ7[~ØF±‚%¾>&¢;Y5lòL ”J¼O¤ÃÙRãM—"üénè¸BTbµiù­r§2Áøç»NŠ²å™Ùßìß(”Ð4ÀºÍKHY²Æcnkª¸%Ý#×/á”ÒÜÉm¨ä¸ØˆŸUküÏ/íÔÉáÍíG)îé=}4Žn]ßXxEKFEq”Ý¦5	ÉNÖr ïYÛöá÷ŽÅVÁ¶0S’üÔâô\-™þe®†Ä–2ïi¿dá…žß¬ éÒ/rÓÕÄZH†­ù iÝ˜¶(¾œ3ŸïÁ¾Af´ŒÃv_‘3¬šïÈl=-§ƒ¥°ó`á>
îp´{“¤ÚÅ1^øàà&S=Í,êÎÆØH :	mãC3`“±îÿI|¦Ü¿2Ä@4H}Ž’TpHÝ—åq°9TÛÉ"8ê9^ÏC|ÈsŸä$JëÔÎîo†.=i7éLßÛ6Æµ‰.«âO%6tm·•GÜØ‡ëÀ˜h‰PqÍ–äí4Ir3¢æ¿×t÷æøÑ(+:…	|þXÈ"ŠæƒxL…qF9n~‡D£cÄ2`J8OU$ÿ) wáŒï¯çÍ¶ž2b¨CÆ/ûZRæîÈŒÁI³ikxÝMÎŒ1õóÆå«Rhô=?ï¼—u§8ÒÃq€T]ÚcÐð<>“ÖÞÍq¼»PÜ¸ó8añlAlÙ¸ŽÿM¦‚«ÊÄ³Kæ	yd­ê\Žûç}ð
O“#øêYˆ]x’ã[¹+ŽÔ¼q‘AÙIË¢aJ©Î©êãB=„£¶×$(Ý£8-î´¥l:R¨+7Ä€|K¼]:ûw³Û’‡íÕ˜2ÕÐãh<æ½öÉÇÆ•jÝ¶,¦çî!‡÷‚Îãbìä4›EõÏP§Z9ãÒƒÜv z¶NöqÈÞ;Æ&Wn"²1DF„Ÿí>ÉÃÃy›úuÌTÁC•Ó;ñÃkëRú»äL3¤v 3Ú[òÜ×ÀpA ˆ/w>HËlW·‰n\Î&)]IètŸP¬¿¶¦lÓ/¨H>àCVL¼	Cží®!l{Ï·Ñ¯ûÝU’ìÞ‡aâ·þ×V,±Nq}óý˜“3Œo”²Yê©¿vÛá<¯à!êßq_-¨#%2[µ‹óÿýá39½bX‘žvòævž!?'û<•–èJã·"MP­$·èø9³=ªÆÃ°G«—±o»±Wy¢m±:~¶Zå9J©|ƒÕÑƒç­" Ê'¬(@ŒüÆ•>Kèù­6s‚r¿-ƒªÇ")MêÙ9nv¡©¢%.š&ÊìõMl‡„ªJ-´º
ë@›€‡kPÚ ›Ádñ|ì$5Ò€½Ä2 exœžoÂ™°5¸4)Ò_ªwœ7Ýùrœ¾.gÿ±#',§–nøü)ÛúdG>š-6„	ÀQKÎ&ÿ)œ§Þ‡Ò'à8©ÔÎ·.¡¢ÞhXhé†­'XŠŠÐ”%R$]¶Î£]ƒ¡†õIý5bÄ²Æ9zM>ÆËÇ?ýÜ3¡Bøˆ2}Àåâfƒ[»öý¨ï÷-Iâç>C²›‡‹Ö:O£ïCµù^ù°ù€¨è\8à>;½ýF™ù¹„öt*Ù&i‰lSÃÔÔöPj•¯vîà¥b½H [°Â¥Þi¥¹È×ËqDDL¶¿ó5ô°OµëßD"3Uùð³öÊ.VôiŠ¯ß6¶e~ç’ã±G$µe»·_ŒÙ(³rçá—,€Î!B“0÷ól”™µ¾LÎ§9?ê*•rBu—^˜¡eSI/þwªü’eÒWœàÀVÈT<ßa!pö¡ÜÜñÆËRûÇücg„.±E7pUïøT5œ¾hÞ˜Ã‹7ß‚K"€B]ûâ[ËÏId0b‰ßfÊ_:C33”mÍ•nÞ‰,ç¸ãäãó‹ð˜@Eåº<™÷ÀloÁ!¬7ÕE:‡°àÖnUs-¥$UõzXúzJ—úF)mÓ–ê/("¾ˆ;×˜/›{ô7¯§ËÜôsDOç1{ýJ
-iJgð~â,0Æ‰äŒ?7½$îAFŸÑrX–DIˆÅ4ôã„2!zkó÷K —•
ØòªÁ;ç¡w»@D[éÐðvº¸…Äìx™KýkCå¡Âý_Ž'<øÀÓ ›Œ›!0òÛ(íÒÓ¾+áÀ”Ú<Þ»­ ‘ ê$ß{”òñà¼!î*ÔOã[WÍ±ÁØš1ápõ¢oƒ9Ý¡ÄoPeJÓg*Oz|À×0žáÙ9c~‹!èE!HÍ0¨üü°#¡•÷)‡å0›®	±†vd/ï_À¯æœ½"ŠæŸ^‰|ˆG7³ÌËwì|ŠÄðF®ó66PzjÓÍeY<ãÈ.Ð Ä‡áæ4©ö*•;Ü1¬«çLül%+ùÀ~w}ó¼¡E~îƒ´ŠÉæ½‚ÐQ,’;e£°ó0±zXåhL°ŽÖ9¨(#WÏàxeÎõJÏw”Ò%Š”Ïø%êá°‰6®Ùˆ’íˆ~ê~HWp,ªjß´ÕñØ%4†„@‰òÍ/­_Yq©ÍC´pÛš¬¥¹ªíÞa*R–¹˜:U€7~šR†u5Ðõ]¥€L¡À=- Ï<«xßÚœ}/^q ÉTˆ™ÓVC¶ò\8’-Déû÷|/ ˆ4•“EšlÇ€!ÌÍy2×ôšRw.*ãë$>G}ú0W½±¹,ô$¢‚Ÿ*ª® @ Aç¼è%DÍéž™žd#­õ/A‰ÞPgŽÔ­ðÎÆÍFŸ{úèHH€wœÁ2°Ep]æe‰ã©v•ûÑ¥:ËsØK|^¯¡¥&ž1Cây|4ÈÌõâÈŠß©Ö“áDK­ŽÞ{Å*#È¡RðúL>„êÊxrX¤ucÎ¯–â»¼3ì2°ÐOQ/vàÉð@,“þÅOÐòM@öÿHÛ¹ãÑÇ?€Ùül@h¼Dÿ
·§ióßÿ­ëÉšàŠms-Ei¦zEÿÉ®Í·ÃmsßÏcFÚ…¾;Õzë±¨²I~]¶<)§ÎØ†€káúÐp!¿ë@ªK+-¡¦ î§‚Û¨fŠâWæ×œ Ç‘øNŸÆU°ˆt+¤5(á¨ö ®èôúýõ]ÐÊ­¤z™ÁÃ²2uc¤¸q‰KeÄ5Õ÷é‹ãhz€9{E`æ\ÉæLH†w"Ùb­CÚ–Ä‹.¾ã2pYøxyî†PéÃ…ÀÏ ß@1‡+ê9¸áFsp¡.ƒ%Ï¾Á5v»_ØiÊi½ßç:‰G_=$™DXŠ)Ãvƒx¢Vé¿—­‰5IN{R°”@²â5Z ]?ÚYŒ$¥e,z÷@—¤wÿ9e¶ÓMÀâP¦6®Ã‚ÊL¿EÊ]>nÈ¼ðvoOT„ˆ`þ;¬¶{1L¹›5v.Ÿ9ƒˆ“bmÕøÅÃS]ˆzÏ¢~XL©Lâ Â
"ªa€™‡3L9Èh| ŸÑ
¨KJÛ|K”o‡eâ‰Ìï”§GƒS°ƒ‹‹¦ü¦þÏ6Ñ6zW˜ÜUº`:ÖDúŽ×©Œ(ß¶•—à) ½`›–±W•
@•WÌ|çÖvF[¾'¨¡.4½SX»Pó¢Àøe{„û¸Ílrý¹ôÖKebt(#',¢Daÿ¼*$&
[íÝ'®ìqÒSH”*qä–Ãâ¢:¡Æ mt4Ç
à£ïÏU¿™ žÌ3¨ÝtÎ¨ë¼³^¨¥ø7ÇÜ¢À´f±ë(Vè¾
*à‚×®KÛHãOg/T–7xxëÞ»'´Ù¨ùpð_™~Ì^„{]çü·UÖOë=§øj~ì!²nó
²åÉÝ#mn|"Ý½Ú$PÝ(#ÿË³ãc*+bN<–Á(½ç1Ý¦‚  º­y;1ÖFoœz%
u§O¤¡‡-ÂÚ„7…ã;5äŽºé9%»#š/Y¦‰€õy·0Òðu‰uVÔò”èµ,?LmhîQœÄçx*ßª¼¸èký„|R±.…l‹s>¬	?³Re³ÔÂn]	Ë0•ûŽBÇE²Hæ;—K¥jÊÎÏ[M£æaGxÕH!JëoÐ˜|	‚e	9¬ÿ½ºî€@½çtÀHPX¹`cÌ@•"‹]¤•çH¹3·—”rÃ¢™ÆØ‡‚×
âeB_÷Y•ÕîùÂeŸìç­[²i¾SÈŽÍh¦ÃkvŠdqªÇÐ^wì¶2DM^LñÕ#ÚˆRþ0v¤	àXŒ´õµv:€@áj¥ž­ò_L˜YÎÃ¨çÈ/¥ìÖôFE:.4ÚŒ9Ü åì"®HÄ)[<ž¯¹ï8åý"z$'PØ`y
KÎkrcä÷…vâ%Ÿ™ÍF	P¦A+Î/n#"Yœ]›CÍ):÷sB~†’F¡ç‹­ÅWñGû†Ð|D»8N8[¦DÈ²#±ÔÂm’Ùó»v ê¶ÉÑyWæ#×‰Dj%MC¤¯´I…’ïÆ›ÃO<IGÇÞ¶Xôj;ù}áÄM•Mæ!ï=5·®¹åƒÆŒj\XºT¸:1˜êB\}8mÞ´›‘Âá¥/\û’H‡u™XZ[‚+HÒÖ¡3ô“ÊO^«2xUþr¥@d'ÿ[DþfK¡DkP|¯¼ßÿ6?jrö®þžª¥ƒÇjÉ\sFXñh
{%ÜÊï¨f,X&s8†’vhÒNÅ™Ùâ2wÇ­!˜È¤)æŒ•:êÂÒ0›OíŒ´	`ƒ›öqHÍºGìZ>Wzë½qôƒ•¿Y‘‹Ïó<	é¸¯YO2}†b­2)Ü¬‘EGå“8}&U{©¤Ê¶±í-ŸKÚ]žŽ	¥.ê†ÒNÆŸhY">.NŽúcî%T×‰RrÊ83Ìhÿpp;á’Œ©…Ò[ž(i2Áš£Fõ˜Ÿ&ÁùI­ ÊsàäúzÙ¹Mœ<Ê—‚ ÓNs‡S<Ã¦2µ|Íú½7äŒ¥ãÏÇ"'h*“(ÐVz@/ºšï}qÓ9–´ÅhtÍ$¦QþžËCÆŒÜÈöðè.S>)ã1#›ÀÌ†»[:ý¬¤À³&JŠÖÎ1g=hú3š\‚ÚMD¼F[[(6‰©è½.–õNfõâ…}.ÏµðÅq+¹™tS—õ·»n$WdNøbËúÃ‡öšÓ`zÉúôm÷ÜÑÐ·ºµÂ8tíqlÞHàžÊÀûêRÞ¯”É4îÕÐ‰:¼#NÓ]‘˜Í¿ØPåÿ	®N)õelWäôIÎDb ì°™Åý^8ymOOm†·\U˜Ì§üu,Ò•Æâ{°;ÿÒô`YRk9:GÚc<ÊVðé‹ªge ,ÜÑ˜ÐøÀg¿± gEòèü¿—£ooZÐ†•=\DE§É02s½8è‹„.åÚ¬`¾)Uá(2 ô–À]Y 	ì¬žÙv¨£à{ÒÂ¿‹¶á‹p§®kx›©Æ€'&k&45±->_IÇ¥‡sÞìàË¤-ÃH,ä®ðNv/=ëœ?PéM3èJ¨?Úb^e@%á~=«Õ+9»åŽ€˜J$þOîé ®@3Êº8Á‹g"Š0µïå­ð=¸-E"ÜùóõvËwt ×ò/êMŽÊX`$ßgÃ)‹u•˜×tykë¥»Í8®8¥ctfoË¤+ávtPÂ€öÑ·1\Ö«GñL¾7¾T’yŸ÷=Mƒ2Ø°„"¨'Ýã œ@kQ¨ÍëÐ”¬Ã: òÃTUÚ…E ”h®FrEc›—Tñ0C’ÜOGæé4›èr¿ƒ¤ÄbÿßMÆ¨d¿[À]IþB²K(dZž}™ÂS(,ðÌ]¡œéÆYóë~&2ðûþ¸ˆ:WFè,~uVŽÆßÿ.ÏåÂYƒŒÌ;ÜŒT©zÔo"ôš]Õ9ï¼	÷ž§k¿™™)‰©çë¦1†e'ËyB@R±„–v~¦ONG6.°-`CÎ ê’DYUÌ¯N‡ß`IûP]A3‰{™àÒ—ÒŠ¤<p“h:’<çª|ËØù	bŠ7;uÇ(ŽCœE½¿ëœðï­¥m@6Àú"•ë3ñ·$Þ&cmÍq€Í—2¼ùõªªr!’ó36l°­Êý'ýMäãrDqÖ9„ÚäêM@¸õpnWålÞBé]Bæ@ï¯‚¼d ÆÐPù9’_ë±Z'OADûá¤½}þ·ãÀ(òtJ‡ûê•B57X›íÏ –Q:Èv<Âö;ÖÄíK¿=gî5V±&WB7ƒox,,¥"F±Ê®¦*íƒPë|ÒŽ!ê¼ED˜(‚U7:GÒ¸2¿LN¨©ÁÂÌ¾WOðçÕËòÕLâ2%Ã¥zn;3Ž°Ñ*LÂÃqs—‘Ë$/§óÐÚáÓ‚ÑÍYÔñòÙÇ©ŸLu¡E¡Æ7›œ|Ç.*¥¬M×“Ò|žXåGú_‚[Þïs|G?9‚Tè<þ…žk¹Ö<g_"äºôäR|™¢„q¼<EEðËlšn×Ù˜¢Äð*ò–oîÝòàAn
ùžÉƒ%ëÈLŽÜ9¥ï‰XòŠTFgªÏ>ä«ªðH1õ¸ú7ËzŒûÀ	•OUTòJh–;_—Â]€µmP6}TÀ©ò,#UHæ‹V°ØÓãÍ§Í+<oð4ò9kª-ëÊ³4åÉààŠá+¸gû ³Õs§ó#X·ë»¡XcQG˜¿YKäÌŽÆçÒÇ+ð?ÕƒeWÒÔG·:ö-$«¶×Þ×8Ï#\éWÂ(®„±P~‰Dk”ûÊR¸¯ì±C}uå>«9\o#MDVFG·ÌW¢û(Yj¹#S\hŠÝT›Û0L©ê0¿áI%(@,­ä+í^ñFz“#° “òmPeœjY]þÛ MGb¶ñ‰­Ðz×Š x£åøëèfÔÜ”Û³¥à˜<³;Hi¤‘RWN¡
Àp2¨î}ï	R>ôàãt‘ˆ;¾©ÝõA DŠÅN–g¡É(dy¢½Qî·cc”#K³(FÂ%EyXÔ™š¹Úv³Ç¨~üîÙ™#s›¾Ãh“×Y÷ÏÎFÓ°NDÍ/NÌÀú0¦évUé‘4:<Ÿ˜¡®VÔ@õÆÞzê}@+%;„	è«á‰!Ç’{œØc+Ýòƒé}£hv¢ùÛwpL±T?Xz³ªA¿å~B¦HÂq
àÐæÀâ‚@BØ™ˆ¢ð´@B¾%4i}l˜Šè\Àœæ@´ØŽTÏ%øŸ
Ÿ{Zö“^€ÚA§?£÷–J¤ÉŸj+w¹‚¼—¨#I&ñèËdhØ³Œoó^×‡Fúó	»²=îOmá“O|»àiH¨VµOã­våVùEß1Âa¤+ž	ªO#ˆ·uiÂËEëeßU
÷‚Ã3Ù¹~€­Y¸Y™á7zSmÿc'ÉŠ†3öå&P‰½
5Æýx++ÒèUbìT
Í-YçøD=Kž›¾–­Hº[ÕÉô° øñ#}`óAì±zÙÞaz_q#ñuù–!`L÷Å4±ˆøÂY8˜U·—ŒöC>ôWÑÖÊëÏ‚:"ÝAc€œµŠÌÙ}bÖ8¶¡'v¢
”Í¹Å.qEGÀZ¿¯	±Àu	ZÚ4z $ÙJ“ÿÙ`6{1ŽKŽuØÒ‘eJv³‚ØŽ¥Ó˜ÍèOO`%ËgÛDû8¶jç‹û*“ûÙA³FÐD^*†¸?î¿¡«÷ÄqÎ!úØ‰b8¥l´Àäta²¿ÕçIåîVžcòl]³]ñgyiýÙªb.ÖXZ˜#üÀcfš…3E¬Û3¢µ‹ªL¹ð9Ô qä÷¹ÜgÀTr?¤¼’›—+
˜pþÄˆã¬md%¦,z”ZÖk‚#zµ8Âƒ@6ï«„¨ÏßNA]-kiTÃ’+ï(fÂ(Šà¶Gï¦DØ´Úžb9Éxí¦§ËàŽ•C˜8m—x…WÉ§~ø‹î5­ï1xà4ÓÖñaY5+úð›~i8×4ÎFW›”i¬PœÄ ØÉ`¼, ¬ ‚šöœÚ½‰ŠÏŠpDÖc3	K83heZE0?\ÝH€ÂÿŒ®áfˆÐƒÔ£ëWÌ¥šKã°Ó(ãËz™ª2SÇ–ÙH‘ávÍO*_ÀlæBàVì>¸t¾cï º¯yóµJÄE|Dró2DWXGõ›S›ª4A.–™èŒ·‘ ª†ö9]C¯£ð¸ˆÏ×Ô¦øúÂ”Aa¾ÊøÇÝtÒ‡ÈB	Ýdêq–‹Q/c?F†ã«T‘à!ôm—µ¾‰ÿZ	:{¼YÆ»5jZçÝyQ„QÝ%)³“†9J(Œq3ÖÄ$œYmlôVc
V Õ·œZÇÔ¸S¿ú öÕ¦y²à®–X=XyåŸ‡cêW?[ÿ\$=Ë/cø‹(^€ã«Ö!ŽæÜŒL^Â!ÙY¡pÈ¹…óWâ ¤v3Ö1HÊü+×ñH’¥‚S‹‡™_ò3Ë.w[á!5òÈH‡YJCÙ 7œ!ÄÅŸºž
Ô§{Ô²qr^‹ûX»ùYì¡8%¸7«V„ëYÿ@¥{‘Á.‡c1NQ)Ó‘«»RV£Æ1ƒ Ä®z]ïß²²è%tãPÝi¦Oñä;‹¢-ô-ê¯³ö|¢û}_Õu™iñì¼…ÙØíÖÂ0™U¸|ªÙ™¤ÀÇ;¦™ŽEMd¶F»
õ»”¼ €|J=´€âæ,‡4€ûV%ìÊØƒöËW¨è#ë*
/Øåkœ6àKÄ\ã¨Lêß•c› Ù%CšzØ™Ã•˜Î†ëIBeŠ³-óè­uV<¨bÿ]áyðžÃuKˆ0KÁ‘{‘KKu;‡‘ö´¿"[#`Êƒ?[ü`t%§á8~o®®cí
¡ÍìÖYSí¥¹Àx½›ødÏ‰3	‘uf$š¿	ñÌ	õÐkNzïH²¥œ’®‚©^8ìó÷»4:»U¢ÿ¶YdÍ]ÿK]4Ý6ê”>Ój5ZÔë™Q ’˜Øf
‰³)[•Ñ’ÑŠìÞE™¢ê+2Îw$ðÇ0Už-õ¼€zÄÙ
|a‡©f,‡
Î †X•ãþ,›d‘9‰Ù­…h¡Iéõô]„q¹@E3Ø§ å°¦Áç*8«1•üü#l¾”l·v d8À½¯Rtð·e1Ö3nvËœW€°\H?Ôp½–ŽPëGåÄ ‘Ù2^+ÎK‰‹þ	u ¡ÞXáT^™ ªýQwÇüŽ{ÍFîEe~F(á–?Èƒ[´];üªú©¦x]¹ÚÇžImcöM1eëæ# ª2¦êŽ(Ká¿.ü“ßŠ+Eéß5¸ãS56‡·èÎ¼‘cº‰	{Ÿ\T}€Ó\‘t»Èæ¥¸µi×mi4“Í[1/ª9.NÅòò¿éþÖ~=gªVVÎh“aõ{ZVÐÓj2ö>§KkÞÑ&4¶…1·‘–fm'€ì±¾Ä±Ð<«ù7\JAÚk„ïâù´þ©ê4rR¶KÒ__ðíï5˜à8zrÖ£¬r |_¡ßQƒR[cÜ –
m¿àªÉí ÎŠ¶©ßKª :áaç—e%¤ÅwD`\ÙâW9¢¥Ãä¢Û‚}•5gWTæ+=Và½pWgÑ¤Ò Ÿ,D!qvÖÛœÄxYwôD?ÇN×Íi;çûtTøBPùeÀLtã”ù½[kmŠ‰ Êf€‚MJ’žåˆÂøVXðMzVýmÀ¨\ællÜ×0„6“€³2þÊ¿«¬Â¼MæÚŒÒ_jë~u‡Ö)D¤î:Î<Õºžœ!føØ94"—Ô…$·²ØïxÆ¶^ˆÔ7©QÜZHŽ…”AE"Õü*Ã\™ÑiÖß8ü°âbë°±u8À×2"®U`·ÝÞdd”Ê $bc©ö'ôE°¢f¡h¶¨jXD*/²LúPÊ%ö—”†$Q‰¶9	 /yAiè„³smK¶øpÄtQ®:Ö&zTÛñfŠñd¢eäÁ­Å®¯<ŸS6ÄÒÞ¯§5½‹f¶u-÷d=‚íÑ^‚vïåôE?ú«2ƒwIú(nŠcsQã#Ì;šèÖÕ‡p(LÑÓhž ÃXëiM¿À%ÇÝ¾ÏÂ»#Õˆg'ôPoÆñ&H,>ågI5žÒ’W#æÙeX~ê»Á§2Çy~ÈO¼uŠž•àš*ˆ4Â¢Áªë	¸ÉƒØòtL‡ÝgíŽ´[Ng.M5ö+\Ã/äJÛ¯èMçÍ»	è7O"¤æßEŒk1’œ¹›ŽœÞ¯xœTâ\ñÛæ^ ³ß•Þ°ÓT}…/‹ò^­'œÛ~~gZ`«xÏ~»ÂWÏ‰&a–~c¼EqÎà|*9ÙëØŸÖ`†gg…„ð™Yï(ß°ÿñ>/Ì›„­·À_ŸŽý5ÙbÂ2Ë¿doÁ¥æZOTP›"ùP³äQbsFû"_råÎk‡CÈ;{Æ³Ìg4è™æÓ»@­i¸h8ã.˜nÏ
5Nï+6—Ë3hjÀ+<û+—­Áxhâ·EÄ¾Þ79ª³xÚ‹mIß2þfHTÎ"Ñy˜¡µ+Àï[º­Š]‹ ¦òúªB=u5yÏ=kšÄ…AS0ñüsoÅæ˜‡ÒµUsA£—
Oà&™¾-%¤ÕKP¸EhÒ³&%jŽ7hñ#š<ë¶´(RÁo|+ÜôÅZÕ|ä-•ÁÙß>Ìã©^®©BmÔë,Öb²+-Ur¹Ì:.<Uf ÏÂÜÏun|‹=¸‡€Ø×k½ŠÉ©[,N]¢ì«Rã	@­QÉÓ×K*›w5êF©Ü“VSüü.œß5-œø›Åd—é€*³£/¡ð>‰oUÄ²¾1…z¹Âë·nTtºi?T7­:©â™q…
ÂÙÚ?¸.ù›å$;·dry(þ¢­À„µ].}2ýÌõpvÂn”œ_ËZ‰{ÍÃÄ$Ý÷VÑuV7˜Ó}D(à(k‘ËämØ8Ã²|{ÅfkêÎÚ×¾¥¡á»D‘L
õD×Gy~‘£8¬z«­N¸ól|^ ¤>&vAiîMþ‘Åà`y–à®3¶Åó4ž|ª¨
í  ƒÙÃ|ÐÝc¿ÕI:\"üÛ­ÇjùnW‘+]~õàW:¾©_Œ²pNÏJ²¢r´G†sÅt‹SàÞî­Ñ&ü¯ûcŽö5ýhcµ¾bõËz`Yô ª?¾ú<’°däîåçw{A\Q†µJî94V&
îmš¸Lá«¹õuª„ëÊ©n©·Û}aOùIýê“ /Ïü§‰M‘×ùÐú ¥y““ˆÕøÍ¹¾Q[Õ§þ|pn¼_\$J²y2'2EœÿÁf¼ú“˜Å¸e 2Žn¤¿_ùCßÎl/‡´±>ƒg¶Ÿò#IYÐ’!g±ò4x¼~Ú6‘ôbÊZ3{¸ùnPí“Ð ¾´HBè3¸õ GúÊt‰û2Í^ýc0dï‚ULßNÆ•àÁI‰ü’Ë°>nlD]ÚFDý³½õÏ¥[¦M®ÇÏ]hò9» ï¯ìŸ2raÎ¥RÃ}Tp2ÐYá­ 34a×L&Å@\¤Tôd/´hruÂìÜ§Bæœ–€skmLIÅ†±È¬á¸u ðƒ~XŽÙ$«E'·a¶oÖè¾BïëÊl	ŽG— ¤a0{MTP–Òð2¨Á/vÐ‘ns
oˆ”¸~«Åí1£ä½l¡bÕ]Òx«c†½åC?•À÷]¢iZÿT
,§”OdÞÁÂazZ5ÍÈþ"ÍÁc„g9´“Mëx7£ù[O.¶¼ºvc’¾¼µA\~¢!~Z»"±ÈÕŒÂËÚ!²#è4!sPGÎ­(ç·\çåãÆH†ŽšÉPÑÜaÁ`ŒáåAaT^Ÿ`Pc‹G×ôÈ{áš€ûóÑËß[A i¤¤u1$5‰xš1s0@Ì»†ºY•†Ù0&gDÇ ‡M²PT‹œô!›KÆX2’! ‡yâE^)ìƒ |·¹-­‰w/½K	)%0¸ë¹Ràz>PoK²/ÌlQzÃ‚õ
@P˜#ïj¼Ø—ûã£0Žlâþæ ¥zóuÎ™Dù VÁ¥xJH[?°Une8ÌÔ¯)ÏÈÜô™üÔ†"ˆú¾qO 'ÁTI‘½©kaM;GU<!Æ0À¹|k|¸¬râ¯kË¾t.ûlì˜PÕ9Þµº”Êè¾JáäÝ\ØW»e‹¨™¥'L^ ú…G¨ Áä ÅRúŸ;B­<”4:s­¶¶‚¢bŒÊ}y çâùõ».Ú¨RñN$W+!s:­{=•‡±×&+DLnãmç¢#jÅNÅxÛ:ç?úY_O×Ñ']L%¿ÿ¬%KB—JzÈêü7­ÆÂäDHaÚ/Vm*„ÂÖº>ýÞºËåÃ‰ äx–Ï?Ý*.q?^óÝC7@p0·èÎ*ì?ØZÍ,°ùˆaöÖì°\€IdÛŸÄ.öÁ6ÿÅ†ÛŸiRI¬“©{Zþ‚Ð9‚3oYoaì^ùëiä
ˆ¸7Yæj>å8o‹~¬}<!‘™\¹´éóP	™ZGŽ€ÎØÿûéØò%Ÿh”ƒ ¾õ½é3Åæ0A˜:?F)ÏÊGFÆÕEH†k{Ù™üÀÑoÐ¡´ýËÆ ºˆï—"&×d¯½lÔ‚Œ[PúNäÐìQ;[¢d™•{¼Ø¦»Nç…E‹WÏµà(`¯Uß¯ÐEÛÕ¾/øËöü2×—¸‹BºØÐü‘ýfI÷”Ú´û 
ž'[[B*©÷À”yöº€ì‹¸ßý$æVhñK•°Göž¯ƒü"óD¡©†HÛNéƒ–^€k®Í_G
”f(­F9§Z ëKA^‹Ï~PcâL=æjoá_Ñ¹Ie©äC¸Ë.ák¯MÖ1à \U¶kzWÀ…•ab!hÍˆlÛB£ÿ³ìÅÒ¸Ðc:£¢c6¤Qds±®¥žÁS¯ØkšxQñšpXyÄ·õî!·þ Ê
Ð“´·¸tÛ|L#~\n Ù”„y,Ömª+uÜ—!ó‰x2¼<Më¡—À8è;->4É°ì7"Ã*(+Ê¬2°ãá¬')åðE‚çÏ€È=gómÚWUi\ÞÞ·ˆãœ"#›–˜¬½…(tÏ~ƒ'B¨«èMQRì'ƒà$’W†yâM)mûx¬ß½Ii»Óï‘ _â¹YQy^}{p?R"}x74R6È³)^M9’°ˆ4Ì^°\"E4Šõ[÷ƒ6s`
BqeXâ»³A÷°½}-ÀjTC»X%SÛ‘mª=f1ñ¿¦¸ÂZÝ	%ªtBµš0/ŸnBÎa,ÕÐn@±•Þ|€òT“3ÑÛÌßrÍx”tR¾ÂáœTP«ý½d‚¯}Ê#‡Ý¹Øûõ9^
-Yòü]BŠo$Â–=kñÉfëÁŽžOARmò÷ ¥ñ-ï¦¦Ä3Q~s–´ó/—ùÊÍvŠŠ	38¹žÔ¹U«²Ž†Ç‡}=ÚÙ‘¶ž¤çaÕUÜöò­MÓÓi*(ò¦^¿Åªm"¾ÜâÂndÚO»IÕ ÃyG1ñ6£±‡dÊ©ˆÁÂÆ?ß©‡ÐÉ¸ë_’	šITéÏ<YÌè+´ãì®ÿè<ý2KÐ,£)”,”
¸ÖVÔÖ§FÊ¬•¡Þíßxýç÷ÜÖ¡Ÿ2»ƒýZpÚrÉ;[p÷nHØK0O0_!M¼­b<Kì«s)Þb4gL¯õ ûr¨M!Tv|6>XÒª×o‡!?YüòŒn;³ôã®ñç{_Ë†ë½›\í.‰‰Iœ-})ÑÈÎ—^ÖZ„_‹"Ô|ÄØ”3‚—}Þo\ùÇÖñÅB£©ä¨ôj#ãr£šÈA^?µ1Oº÷®U¿Ð*[v¸†J”89ÈBH$|Z—â¦âr B3ˆQ	nWÿHð©#;zÑü¡0[ÝÛ‡Qhp†¹›NV`Zˆ2Û™¢Äs(®¼‹ªZ¾Ä-ˆÂ¿÷ÞDÈvT½Ñ"ŒÀ%Ø
kÌþ~7VóÓEÚ=ÿ¶©¶Ö½,¾ëjØÁp…™˜?~†Ô—ðµ†Ù´A¬wCòYÂš$6ìü–ÀÍM%¢[×N–(ôK¸»ŠgCcþðq<MÆ§X„£¬w‰ƒuå“I‡õ¼.+AÉÖí\Ÿ6‚2ï@zg	ëgU5•yRì­ ý–f­¬XÜ‰`h{VYôh‘VÏ9ôýF+üzÄßè~ÀýÞêÖŸµNÃ„h-ükF©óW{Kð“ø€Ê¯õ'õ3Ñ¨[NP: êÙü„BUÕ¦Žæ¬×bí´lÔŒÀ—±ýÿêÏ„Uzöpœ:7Fwà%Ra(q¦éZË§·E,B	äÐŸI¶&‘&ÙÅ tU·À.¦q>é1wmóZÁeÞÃkaW21%	zd°7E{!ìˆ¤Uïçá$B%sÿ¦¡@4X.ÉoV
ôÚ™÷#B~ò"aõU$ÀšU/úÕd€µV¥ã‚œéçµØâ´_yZg–mYs{Üz"6&ÜëžÒ/æ òî¨©91¨´)/Ø‹9ËÜO)lK^¬òm”ÌÕæˆþ.PèÜºg¿ÈP›'ru*ìJÀ¶Ï“ýMv †vVszý'|‘É†M®ñ&ü§«Ê|‰@² ñ„ÚljáCóœc*·÷ÙMB§HÞH‰Ò5©c½Š÷ÉéH©r  G4_ü$C²L·èSi>Üýã¡/Á†ãrþ(Fó‡¿Â¦HòH€<÷ðCU¼µî”÷ñ^¦Umúý«çd’d_izñ9t¾kœâE2-S¥+Äž›äCJ"À°‹K2žb;ÝÐF–3[û+ÝjýZˆQ¾6wËHãr TŽ–áó×qKZÃýEµqzD~J™,®ä+ºÕÞÉ5Äq E¸êÿwæq ã86Ð½UP¢‘±ùáN¸XKzç¶‰›¦)œmBf9YºÓ8êe8pe‘t‰bñ®Šìo+e*ŽÃ³ÑÊá|åÞùf‹ËfIñeËüËÑk þœ\ŸÒÐ¾Ì««LôäW"-O2Ì	{‘“c™#¤K·)VŸ„§/£ãajÍÞ‰ÂO Û!˜Må:Ux;Ø]_³å¤¢2‘xVJÄ‡ ð
\Áãf¹„v½;»ÈI³U*ºC¦œÇ(.ja3¹‚»þ¹:È_Ž•¿Ô%…¥Ðéµ[ß´»Ó8 5¢zuIr1}s[=ï¶ƒ‡×ï¾ttQo[AÞƒ©Ð#Ö »:°8©/º=^×ÊÅ5‚½nýÐ½Œíš:u¶«ø4?hsâL.bLY=Z6ËÂÙ¹ps&ÈI3O³ïÇÈRr­\ ´¨“	zß˜gÄÄOÉ1Ê+ò¤ îòÈ‚såqUq£é°+ûÄè4ˆEYð)ê±Å	ÿÖ(Iw´€PO9F/—Ì¯2KñBlÝÛC1ÛðUZ°fhN2ýuâõÀ¾EsXáváŒ›S5Å¡>6`Ð¸£ï‡-pxã¦>7ÇÐÑ¢HÄ6Ý÷h×ï%Äv„67øBcåÙ€$X6á€­0ÙÊ>JeBÇÃnÚ!4Z›O>dM‚8n—C º¤)<ÏÈ#æ‡Qb`@àÂ9éêäð|Šqô/Âã‰ÝeÓ‚R^!‡VîWE@$4k	(‡k{ãf9Þñ­©QºJÓ(¢#F_)F}°I#$UBlÚ!sÔâvv@W=bcÀï<Ì ïws+öMÄÉ7ž×NÔa_ŠCˆ…©LÆ0Ÿ•¤ÝÑÖ‰ÓYò(E[ß{¡/‘)±„°c²ÞTŒëÕ`"}ÔµšØGœŽ$¯iŸç¾t}Æn5n%DÇÚ­ùT`c²ÒÎqüÛ•N­Bí<UÏF÷"zqœìBõÀ_Vˆiã<•{KA>;Öö}º¨‘O¿ˆ–ñ¹Úºsú›«X‡©ÿñ‘+¡×Ž"0»Yžd`MÁN-—þ¥èj´rýp¿:ª#ø%q¶xþÛ]ñã@ði=º‹²ð¨XvX(‚Ã¦'fÙÜ´é&“‰™]¿mhy´‰Ÿ´û#žþ~71F›¶ ®¨Æö;¤ÂI*ÃÀ4÷¼Kb½6’ÀÜÈ$#H²üˆ`ÁaRIÞ ~ÜKúP›P*,3Ÿ©DËË¦O0èÞ;>°©¯˜»tÔH“;!KÔj{
Œc\þ¹êX@«ÝñØës£…§×(Y:D§_ë
zÏiÝc3/2ù@H^8§Oí w&g¶¾r:wØVÈyL>{Bàî7^_¢x¥¤Í15¡`Oô[Y¦Í€·É`P{mý7Ã§Ü±"(f>'/¿¤­G*OÜÅIÙüuDÜ¬@I4uºøa²þ£Ü@Xü“ÂdôÚÔ ·ÀÒ¯‰Pî´êŒ¡äÕÉ÷]ã™B~…Cøv¨ËIú˜JÅH* Áã®ˆýUŸÁQ9ˆ—”Sìïéðü‰:L¬sË¥Á\¦ !›îE¬-LÍ8P~Ràš4òX
ZeL¡jÝºÛ0¸Ò‰Þ²Î*³,Ê=8)bßa>Çï³Öê˜(UJªs–*ªË¹0_l¥|¿))¹" Öáå«`ê`WØ›Ì¤dÈq*…gyÜC¡Â½Y2šìGHq—3/ÂÜÇù\fŸ£šD%¡b½EGÄ¦	ßÏçÌïÈ¶zqÓO¶9…ãvÈ˜Vïê>‹T¯«U›Ð¼ÿ¹†’«ÑšçÔ»Á‹%ÿÑÙ¹›¨—*J 0N4ä¤‘Zñæ«ød?Á-Ä×Â•PÌé¶qþÈÒ´PçÜ‚ç@œ,©KúPŠlYc:¶ð0¼oMRæåœ]Ñá’(Ñ‹•ÿP+blÚQÝrì@¾žÊ¾¯N=~ÎŒëì©ÙÆ8‘áùïïÙxaBÕ¤KßZ+þ¤Bn>i^"‰ ªö¶(;‡` ÍžØÛÏ—ªw6ÿmPbt©pFç/›6­Á†qNø¥½`±ÒÎlãJ~$LŸ¹ŸÓâ39Y†5øÆc%êi\ERÆ›ñLè‹RÎAá›5ÝÿòÉ:÷(¨«õ8ûÍ½IÑ°½8ƒãµQÐÄ|bk	éS£Ñ÷ŸÙÄ» <	Äh±½Ýÿ¢ÉË<C“žàe@ƒ™ÇøÈX¬”Kpàt)ÿ¬xV­`f|[Áê/Y,ˆjï¿@?ÃØíužçà"æÆF3Ø³¾grê6vyR[Çï6x\NtKÞŸ¸3Ö
‡³‹ù=ÊëÏz$¡±Ž5:ç.!$+)~s™,”zØ	Ò·*ä^M$°œ™ø¢³—> Ér2m’* ú<‡ô`ŠÔË9é¹òûò7›õ$ë`šÖg¿§eÑ,¸);Üy8bÜ'v¬´tÚ:†ÚMÒÕ”;¥>›ÔÁÁ¡ï&¾I”üq±³é·aN¯§Qe}æØ!­Åor'¬'¿7»—ÚÝEÑ”±ûÙÜÇ©µž÷¡qüjÒ	\"Q²¹€-„K6:Šz·F›WòU”Qè'AQ&ia¸»w0'«{¹.ÌwÍC!‡=Oí%Ç›ÅãÕÑ!¯W|b¾·QMHÈ¨øÀBzwˆu0åÊ!Tð1Ëû|¦JzñÂÁîÞ Gã{s=8)ÈGgs':;@óy_ VÌÒŽ’[›Åú~‰pÀµoØ2A–E=£Ãa€ÍmÐñÆL3éuå»1Ë+œu«Å¾!’AÃ€;Ÿ²³§s¢˜GjéÛ	5Ó&&‚â|ÙÂ÷*Òåþv
§ëºCack,ŒHùkvùÌB‰4,žß¬`âÍÖ“„	áEý¶³V9±…{ˆæûÌà`³@»1ûÿµÈùO€Býšq8ê	± ók#üÜXÏ±ÖÉ+vúÌ›äåEÐžÊ„ù{Œ¤jGPüc€4QUÀÍ_Vµõ¢¤?µÇèÃvôƒð%MïŠ5ÿ»ÿ()‹é“v7XÄî)Ôëf±:°	¤Î¢Ôà (%Â£„¢=CúóMgcòÜÇX…Öæ¦at{šÔŠÿ¬¬¥n ö¢Å·ÞKÛ>â9î$’`ƒmATKZôª•ÊUîJ
T‘±m	bvŒwœÑ¥s-B?9ö*²½öY*Eë,~P6%%wÁfúw]Z¥’·ª\ŸÊ‘M<¬ÌŽ@¶§izôn@lëZâŸê»ˆ!¬šÆ^†¨£ý`ôçø (*3P&Ó Q·ˆ¨;”HÏW²G«³ðìžÛ¢m 5uÆÇ‹eÎ¨ä1e!ç†´–Åå×MñŸçÑPƒª?òè~¾clh+ƒjWJãÍºˆMÃ:`8cÜ0ˆwå5Œ”È”>”`Á¹ H$Ó=SÎã‡¬`ëóìCNšÆdëŒ±›ÀÈŠ5÷g‡¸@¬0u¡êj·÷Z¥vAk•fŽñ?pþ+?ÿMöú¢Û_5;Ì„=!òeÞ–—m<Î©‘:Äï©ØA{üKë¶ùÜöùCÁ%*ÂÆ.F7¤8- Ú`#ÓAÂu
Ò¸LKÌXç"W?'æv}Ô’AØTKH]¨‰ejôÑŽ•´	þdJ–§Ÿk—7Èß>§´‘ßÝ$hˆ¯išîd(Z<â¤é@ÔÉ-»«õÐØC=&á­.ãÀ6!£üýZE¬µZ}þ©Í0PAÀ•C$˜MYjÔsÞèE!Œ–þB‹p–(VHªNnuA^	ï(Ý•µÎuÞssßÏß½ÕS¡«’ü³bð€óI;]Ø¾“ˆÈ\c)8­éàCvÄ¾õJÿ›{{]=¥ÑÇo”Ú;ÈÖ)˜ÄTsð»-pêÈûÅ¾«ˆu4½ÒŒêW'£¢ØþÉÙÕJ\®ZÙMX2Ê—Gù9\û¾‘ø'!‡ºÔ¾”)¨n¾d¤ ±lØpIr6´f‡·†¡BŸ¤EýyŽÆ(J»(†KsíqÊ"¹kºöQïíaEx;Â7„Ç÷ŽŒŽl¸ð0‘N$œ¥y¢!î¨%î
»øZ¾“g_?Ê?û)šjL6¦WéñUö[Ègæžzb¨•ëß Œ8fQ±Ž™§ÛG×Íe¤êc,
•†e“®xäÓLªÿ¤\Í8Ø'êvp#¼¡ñoä¹§IŠo‹¹X÷ÛÙ%½Vg,Gn6b¶^-‚î"¹>ñïÀÌÃÞ»¿ÖYBÞy¨÷¥IÊ½¨³  @ÇÆù¹¿·O
†œ‹×69ê„¾ê…¢ªÓäù*;3WT¥!-­5’ D…M	ÛH2‡£xŽ‡W[¾¬!ÈëæÝ›NŒQ¹|4›Û~ë<…ñ÷|\âpé?ZN;F½Õœ ¸¢6ò½Ë×…T®œˆ: •ªØrP¸ñˆf6´Ÿ¿#S.iâ=Mñþƒx•Ó£õS# ÈÍÓì‚k¥ò7p3gHóó;Ò¿(½ôQÚL¿ráÔ5Âi\ˆeOÜú*z</ãÀ¶ôZPø‰Ð6Ïü›w‘›ÔäÇ^ã=8^Êa(êU<FØüK¦Ù#ðìÉ}¶{ZþöÂ‘Ä¾bD3¶­jPX¼pme»FÜe³A€Û9åD#TbäÂË—1<Òcª}<W§áL¦:¡P©s0kÄlÉ± Õ,ã&$°á²‡ä¦b­^ySÎH.çF–^«.‹¯NÙ-z¨x‚½Äû*–ŸÈufaƒozãæ ÂCwl—ÑA§¼§pªÄJ[9×¼ ŒCŸBlœ*}’áFÈ0ˆÃVCƒ¤æòêt…x¡+º%cRRÁÏW
ªweÉ+FÜ-rE„šKRÙ«èþ	õ“=òLžÕ.ÔÃ¯}„½°%U[å‰®¤Èˆ+;£ÓŽNüâÞ/8z! €Í¯“«æC Ôÿwa®\]iA‡•ÒZ½ÒóÛr™ÐŒóSfœSMöªZ¢$oà@aœ.Æñ¾ŠàsxVëùï=`mT=Ïçýúï_¢1ª9SÛFkI1¥=Ÿï¶q"È‡è~žwÁ¶ìœ™­¦«1‹aQºÏŠqE—‹êIÀåùÀŸàÉU@	á’Þ¨ö±r¼2˜@‹ß±AæS€ïöt‚%Ö›9ùÓ=S94éŠ8¶ÿQ7ø_ÈÄŠJ»Ê±÷±tøîsè‹uœÀß@@r†+aA87†Áënc¢2ÒÑùUÑ#ôÂ§©TôÝ?á‚œ$›åkG[et2&Qt9º4/RÁÈ©õÑçŠÌ±ß»eºA$:3å8ü•ž›­rg<q:®JSÏÃÃLwe«ï€£Í÷M˜©…oÚðø× a[GúHˆ	Ž£¶À3"Ñù)dÛA®.›e5ÀJ‘“z¶cNûž}8¡,@³™—m²Ìä^°ÄA’‹Hˆ‹á¹ê˜‡ÊcU[K†J{ÎyY=ÞÌbdx,`¾9‹ˆ“ŠüA±™ÅÒ°\ÇßB[¯‚‡Ä±¨Kl‡‰',ü
5:^@žœjè/d:å´& ~÷)#tÜÚ ‰»%@Ž1vIà[NŒ`5ç·ÌÓÈî_Ž;Ÿß'Žùiµ-aæo’ã`cc	Ñadé-•ˆÙ£Úž®ß#ø|¹©ï6Õ)ƒ_¯ÖÙˆf>˜Ev-ú¾lû'ê*€ô
‹iÖÜ‘4c®±»4êU%ü²± îüë=—‹,Fgf%¥QV3&AÄnŒfnÁ§!¼ƒþxNš7Ñúgò©|<öŠÅ*@%X4Â(êwôû]z²Ä7…}ŽÅ<<Í[BCHkÒÂöÂ”M…ýu3‰ö	mˆÌœ=Ãõ®5¹V•"ØD¾£cŸæ±0«Ãº³5èjWÐ²,À\6ýc	-ÁÈÊ?'öÞTe'É‰ºyQŽW-Õ˜¡–¶ñŽ_%r7vetüLVº?ð(Ð@	€ cÞÈ«	­r¨m„¢i`hå¹³£Ü²y¯R½Nr¨‚sCª¤;a™œ\£Ñ–gÕñK“¼Ü~6¢±¢`®’ni±@”è€·ÞBÎM•^›Vì¢Uth!ùa¾
rPÀ¯U,ªÕs±éŽw¸èÛ€šR3Z)m%r&2¤ÏMëpþO'âfÖKÔ„¦2ÃÐÛ!§2í˜bmsU„©„¨Kº^T¸f©×ºV·g"¡	r°T6l'?x™Ú Å,ÿ•Ux¹(ºB­(yQ~l¢gi¶dËÚÖ=	fKÀXGèm*[i/ÛÌr ³JÂçâvç¸‘Ä0ªkO¶»·ž þ”4:ý`cqˆ"î…(*
Tr? žÄšKÀdvû²ÁV[Ðß°’VEì”wC01µ]xZÍßÇNÕÇõ”˜­”«Ø¥P‚’lÊŠú döhÁÏÀö°¼ØÏ¸ÇGŠu#Þ¾e.â,¾9r§Ø¾<„ù¤ŠC+U
õ>e5‰ë¤{ì¼kâ‡¥(¿ÛFœÚãj}ªyÏ¯-J€xWß–3ÙEÜ\%«+HlÉ¶z?ñh‰ô½K öYz)^	|k™(¤ÌM§ ¹¦£ÙÄz¸ˆ‹ÁÁ©M§]NtiÒ˜ûzº3DAí„DÉ-“²Æ›ðÿ|Vj@ÜÒFüH¸!©aÿ¤ŽÀÓ•@±²î8zÃíÀÄ3¡›N 0eÐC$¿ ê˜õ½*²ñ4íAäGc5Z¶ûïeÕoÖ}½ø³&„ãA;¯ƒ°E|çý5É è©!Sîñ`ØÍÆ+ÀÑç©.CŸ;¯îYÜ$)TÁÄbüÁO4—ÄÉ*MÎ¤£ó7ÃC7`ã‹ÉGàìàq¥	¼NXãÆ…-?Í³ßA`ëéXp~àK°Ã@	ŠM¤ÕÁî‘2†×ûdÈÛvÝ%·ÒÊðñô­Ÿ[c˜´¡B,ˆ‚ÿŒý¦ôªM*¼ª;ù9ˆÂ_yàïŽ§Qs›\ód0üi5¦Þ®\eÍÃEdàªÁgS`oiÝ8v{*¯‰JçlZQR¹fã;Í–‡àØÂbFí¤×ôêºiaþâÌ¿Q ú*Onáßài®¡ò®g	y>ÜÑÇç¿EE©€hG É¡ã‹ƒ7›ªVu=@ðm€9@iéd¾©ež9\i‚É6Tj^Éœ %£e_—ê ïNÕŸyP>d%µ\«ßxõ8}ÉàšÕJKIÔ|á3´R’Ž¢Šawf¯’ž¾ÂÌ•¥²ˆyÈçd”¸å(:ˆ=Ó¹Æµ”.,eÈ¥C
±ì7uÞ=A)IÁÓL£æö<{šOŸ@lFoº‘ä»ÙïÔuQ¨]N¢û¡[„ Qí4q+;=`À¿äè’K¤3«9ƒÅY(û¨$m•c¥Þ/Ö³ÚÆ§qUA¹.di²Ã‘H5í{*rå{;ga@—Ç™d¨:ÄLSª[ÿŠ\Ö¥SÛ½Ï¬NL¸]üZl~DaoØz!U ™’|Ù1 ´¶ýÉq5‡ÿxÍfm‹õ&À…#Ô[WGº»¾ßÊñ§ü3ÕÉ•\:…Ìø0±lÌÏ{[½HXY“Pí¼s4Öô¼3þ©6þ¸‡jKç5«÷3ÌªA]JMgñÒC_Þ˜X£†ï¥5ìa¢dëh=þ„D"‚#~,}Hq‰²˜nã”Ñ-C—¨<=\åpfTc¹³%G<H
Úžœ‚b\¼ŒÇÕÝII‰É€Äì[0÷µc=_®bäüwØízß¾)²†U*mThjXÃÇ{Õé;ž†À—¹ÑIüâìëˆ9Ö7CKÛ%î3ÇÁW„þV‚¸ú¢š[j/yeæ¤¾šÇ.œù¸æi^Vž7ˆH¾,ï·_…^bRÕµ¿CîìõãFpÐ78Ñ}xY¿ÿ<WàèÎ:zÞ@aÁÁÈ ¨ªÿ#âl%Ásº¢ÛÀLÕÛMÔYè\ðC6Ôr(as¢ŸÙø×ö\@qï‘…ëï}°Ñáü~a™QÀKvÿ¬æº³s[iLE×ouÌnÏuX“ŒðYVÝ#úîLÓ!š4ƒŽ
ÓÈ6•AãheÈØ°ÛW ŠëY•–%Y™$¹¬p~ÙZR€7©/ÜXMÉõþÀ•õZ\ò¹8Fº5Ç‹DðmÌ®b‡M:ŽuÐ6ÎŽƒ|ò
h¹µ±J!êä ä¢B ¡¾Ý1^Ëæì÷6˜ÔîA‚/§‰¡bÞÁÏMìm¡ƒîltËþŒ :¿ß2GCÁ¤Á^KflœiÁ uíõi¨Æ„?ÿÔßo§Ðrdm€Á×{Óp9»È_3Ê?¹1pGe-¨å6p–çóÊMFÄ$#éUØ¢À‡Ù|7¶‰f“½€Tâ¢öªÖ Ç9b:3W.jšŸUÈ×é„%û­¬ÝqÜ{ZÐiÎŸ—¯<–-z£™Ù½• Üöá] ·GžˆÕí¸¥âghåŒôÙÊÑ6^Z•?HéBò™×¡×€JŽ| &HAtå-ôAâ`ùí˜zù~€>zOa?{û†ÊiÕÙ*O«„âfIÇ« \ö,¥ÉòAß?õˆäD<äh^ž¿Ihêø±ÐÚ¶	zíÌÚ{~F:E)?µ6òÉk´¶?œ?¿fsáP Á7¥œýº‰Z §~‘ø4´íàÒ2üÊ
•àòûnìm+ÇÅÜ1/ž¶›”QY~=ÅBî¾Éív?‰`«>0†{Ám,Ï“6ó#™ÕØëk™û2’ëC¯µ¼BÎå (¿uŽÝÚ&ëä_,Î8âaà|ÀÄô¨êq©°¿úçEe\(÷iNüãrg	Y»ë2¼Twdžèç«ÐÙæ™òÐ, AS…2jØì+eÀª­ÏD´bÖwßþô„%ÜGÅ²FüÝèîÖÿ%rn8$v$ÃŽÍ0ä’ Ýuz£BUÏ¿®; ÿÉöðÉo¶ýæAŸ¥zí§ï;»¾%ôÎ0,“„ë¿0hÂ³n1™1%|„ñÐ!o!Ãcø^Î¡ûÉÒRHù¸È¡¼==£»Q%©@Fô2'^þÎ%3v[–'ó¦=‰ñ §½ÝhÂËÆæLTçÕæšèO«êPÏF–î ˜SÖäÄiŽAB”©›&NºÜHÆ¼ÒxBsîV>»¢ó‹d°ÙÉ^¼ÕIozÓófQbA›ƒ yMŸ~¨WåVp%²€77“,x= §ÉG‘»û¿8Ée”j`Ú.AÎÎ–rh8ÆrDió1ªÇ-A²X°Pî\Êavtw[½ªIÀh–®Ã†cÔ°!ƒÛ![@d3†l4¯Ñ«QEß·VÈè0óÜŒ”ü9§:Ùƒ“ ‡Ýv›¨§kÎ%¦Ä1\&Î¶vmð&?3…¾xÚ+n;ü÷R,É"–ƒW¥	?ñçõ37¼×°4}—ÇªKÑžË`]åf~ãEüö» –ç„Â |‘§î¹&Ü‰VŽø
u„d”êqr‹>Ö4Æ±µ‹åªÈj“Ëu
j¤ïñd×¦ñAX²t+%o·—j—ôaØÑmyPÞ12ãÿNñ4¡ÝãA ëŠÍÝ‘â'ÅÙ‘•D†\Í¸ùÎ ¸Ã¬ìŸÖ¼:º9¿ÿ8&Ò€‡ë¹6°×¾¢S°E\2a$@†eÕAÀØ¡·¨ôRÌ8Ó";ë¼ÜuNÅŽiÿ_Þrƒã	 hìÛ„î,GSøZu˜,ý¨¹/%H
•ü´R!×)5+í† LÀ×…ƒ‡óÌÆî¢)[°
wñÐ"*îSâµ!æYbÜæËÊ šC @ç£*›<ÿj>êÉú[)50KD/Ÿ‰…ô7ÈhOêˆ€¬¦‚¡;—Wßª‡ŒEÛ–øÈ\¦FVÊêðÁC’mé‰o¥:ö¼œ&¶nö‡™«ÂæW¥É‰aÞ²å4ëQ…Ëú¹hXK¼4°oŸÆ8£]«ÔK¨jk·ûÎ£Ë]È£máÅðö¾ñ¦AåòÒé Æ¾&¥çú?m;zDï¯ºÂplåùÖ`¦­ý­Î— 9ªÓbÛAÛ2é)$X¹a£:6qt]*þiKÏä
öúb´…½ß÷ýè®³<Í}eIÑb™>Žjd¶õì4„Î"e4{‚KP³j]fÛ ¦Y5!ÝðÍJKaçó¹Ã!øE†Ü¶#ž±¯«ªÚÍ}uÚ¤Ó´¶Xw:…ëÅ«¢ž8 ôŽ}>:9¿ìä¼þ°âyÙQü¶Ü˜„pI–ô	/ùíÀ=¼ˆÏ¸«²hèÖûª|Gžð27Ó
A'†¥Y}z8×åT°E0R…³¯O®Ð‹#rŽŠZu&•õ­ÓãÎ;Rš”¿|sœ¨î±EÈA}–ZÛ¦yK{:ø°[çÂ1Á{1TR<Z±>ßk®³X!“´š,ã)Œ8Æ/ÿ±Zû?ß…µø€U(§/îì[7 ºGµ]T?Ž¡ôòçEPú+o”s7<\û,;JÙŒÃÑ¼m¼!åýðpýq*G.-–þú<Îë%­…–«ŸÇÖDãûZaØ¦F«fŒw5x@ùzk'|jsßÁ'-›Éé•{~—N‡~)°¦WÔ[/;>8s÷‰8ýPÊDÄBÞÀ<kW}ødBÁÍOÝGõ¹°véÀ=}[ž,Ó˜†8éŒß¼hä)¤€Ä›ßDY»ùÜ¶ZLZWãàù	ieàÞÙ8ÑŠ”›b:Ì"öè£`ÊRvC^HÚ& ™îê‡<“KýrEs+$¡.°ŽÐÉµ…×™!¼bÂÌªJÉØÿFú¿?ŽÞšëïCÒ‘4¢ÈÏ—†_û¹þOÝ¼†Î#Ð‚ô>Ÿ¹»÷¬½/ã”±$çDè­Ãâo%â[ºŽykü‰×+£‰ÎR…	#Ö&EN? ß/ç–ø³½d${}Üè4ñðÄµ½±oyqÒiJ²Ì>ƒ@Šs¯Ð£H îO"èàAéfG¥è‰–DêÔ…ø#‚	ðæm™™û‚½¹°!&ùFr!yÁ¬jÂÚg‡ñYg‘88-_­&F±û®µ\ä(8¶
ÂàÀ’²<V‚ Õ£.¦_ÞO'†Ý3 TÅ]IÖ‰>'KðHt/añ^,)‡¨Ç‹KÔ¢ÇJú@s‹
œ5Ï"ÌñïA_ÏÑ[“Ùîn³Ð„Ã…Câw@|ô€»(EÝð¼E3ò9•fÏ’Q¿h·R?hv@úž² v®0¬|z~òHúEP<Ël9æ-pÊÇ!œè
ú²³ô~gËÒZFõñqR¨kjH‡ý%ñãì­Iž@IbäÉ.UË$¿Ds,ÔE	èJËC›rqÞI†¼ýpX_êîHÓ.T “œ;ë]ùÿ¡4P®´¤‚m’m;éûc…uH 0+¹µ8•uŸ¬™éXÍC‰£‡£K´û‘_nF›¶Õ¤J$X*¬2ë_&+ŽÂ˜£Æ°w7`µ”X]6¸ý`Ý¬¶˜º ;A¡åÃq3«16¨é†³HÌÂaSÌ*W¿6&­LìÀõ³Àèª	½%:¼ÚlBÔÜðŸ5ÚÚ&d]¾“Ö×CÛì%¸ÚÎ-}µûPåå(Í÷Èë²ÒÞØÒm„Ó¹ÿáÓ3;vßóÆ{F@òäÈ‰‘A&8Ö’<e7¼áB3½tÀ=—¹9£™@ÁµúôåT‚ŽèÝ>«hÏ»mír¤ô
ñ¦2ö‹0Yÿš»0y-uÁ‡®MøðjyL»xáwZ§ïªEŸ´[RR"o±òÃÇÚ˜­öÓ‚—Å=c–“)¿Î’™þJÍéP?<=û¯“}åÝ·+Gb$ux‹´ ®h!˜Øm9D!8…gWãàü¸þ”€¸µŠtÀk#vË3¹,þfN¤Å}›¬ÊpQ½ž«çë„Â3I=Y(	=m<èepÿ`,vØ¦ôpð™?‰ŸÀæ÷´e‡»8ÈªµMéA›1‡ÃiK¤òÝþŸ9!é= waïHÂtÏ¤ñ££æ¶eÓC™ÚòüqÂ˜6^”Â\ÔÂGø¦…Ñ`î8…G+ž …Â(`ŽX5Ü}ÊEÛ~•59È<6T"hm"»	Ÿ Ÿ
4s(wcÛX±švú÷ˆ)C¢r<Ú’¥YÀ…1ßŠa ÷|«±Zîß ‰¡LÝ°h°ñ:=`¨ã/ŒšÊK«í†±ÿ|ðÖ•ôÍÌÐÀ·½g<bbùÄKSîª"?å‘ÝõâÌQ7E9;Öëc»N›0õ‘twÁ#ï<_ëcÎjKzuÇümk1>áì.L®Ðy1ãzøÜ*nÕìËøbéTåüb" ×ZÂÃ½‹Àž

²JÄSû5¿þä1¶+LY30/ú­úò3/ÌdÖ­°?ú'kÁº³ÙÇ—®šnœñ2`‰Ozh¯vÔ#	“®óO×z¬l¨D%m9.–ÔË38´ Ã´G+0üßŸ¢<®ºŠY>£w.7•6ÁNíXxÂáz çƒ½õ¯(qB"‘XÛ|ÕßžbÃÂŠÊR…¿ê’÷"ú9Ç]|q³SRd¡½5FôF
Dõ¦ó4æ:½ÉÌvœØEÎi’G×`~`TÜ¹—34aÕà…_š§²!!ê»)œYrÑÕžC§Î-RÐ>ŠªÃ#O•<óZöâ5]ƒ´Í§7Sv×icÞ³1Í=à$ðíÔÒžázþcûåø«’es+ñwd¿Ú÷—µ°nƒŠêMfÊnÒÚ ÁF7=¸b ¯ùä!úŸ3”ÏÄC‡ý¾ŸÕ#öú>±zÙPþê¨IR|¨nDÛ~e<D„§&e±¦¬Q±aºdõ¤åÌi	úF7û–ÕõRÐ¥ÜBÞ(ˆ2d :Ø¶žã]¹{ÊssŠXp`¥ÑÃØ`¶DBˆ-ñÕkÎ}Ë„{¶—y^@KÇé¸S Ë6ñEX“Õ÷o¡ÒˆÇñà^+š»ùõÒ‘V
ì½|‰¡äÂ8kã?w™Be1`#Ìap‡^ï.ªæÔ~qQ‹K’¥[Æì§	6EÒÙ×ÿÃ+ËæÇÜHg Àä‰•"·é]$I"ÅÍYÒ³¿g¯æÑMÕ¡£{÷J€ó¸~òÍÖ¯nÜ	¸¹µ2DCƒ4?m¢{ÎêÓoYµJÃ›'nëÓÃ²9œ¯1é%üå*ÛÜ'tdh¯>Mña8ÿ)RsRfß9‚nð=õVˆ†{FˆzJÕ‰ødEqö¼æð%'7]½9C0n§UbŠðj±	ÈÐÒ{±º´»6ðE	-ŒR¹s}Ö§!¤\YçÆ›wÃvŒ3áÉ~QÄQš˜¦W(…üŠzSPæÏDO½à3¯pïa9u$S2‚á@##Ã9d×]ß$^ö]éÏ[!ÛìˆÈD'au=Ü•Að"ðL(ë+,1,|7šý›ÆÍ=óÃÀ;Ï”(K]&ûaKûKcÓƒÄÏ´‡ºÿF×É’.I¤NÐGß7fB4”FP‘É¢ü~ì$¬g¯Í®ÔçIŠZJk)šÎóS{{wZ¹ÿÀ’/OÑásÚ6ƒÌ b]BŽùDòÔüëC"XW›Æžßgñ˜+áïnÔÉËcû°”á¶k=[€4ûé6!ÉÂëûÇ­Ži¯âÉÊeV
þ˜Cæ­[llQ£ôÆ„›¼"Å<çÿS@Co¿‹ÜäÜ}j,T›;[fÖl}ÁJÿÙÚ]6üß0{	cEe¯ÛÌ=±bè_:E›ô"
`3„ýœHXx^=á>¿ó¡òã 4 òÇï_K™ÕhC#(2ÈˆÛ·Ï·$Wƒ_g*Øõ:}ÂÒ±dõx÷çÿŠE¿jÍ*Ñ‚J‹ël» 9Em(Ìˆ ¢(óÛœB3"ñ9>èKÎr9,Uv^+êÚ*ß²AQµ+®e\
%Ø„ÿu&¼ï™®ÊŠL]£ƒ`ëƒ2\µç§âçÛÞAòmGÚý|X4nTñ(ƒVqGÜªá <À'–À>ªIM³à:5Y­ÐÈbóg>øÌ®¾²¹Cõ7ú±2ïnÃEøû½Lôñw}%<Û7¥Ä¬Û•Õ×/É6&Ê+ô]¨2NC³u<ë¬n™Âæ<ÿ’]Ë“ð¢ &uà²<„–áM¯~ôsp24°842ê=Á¾ÔtØœžònmK¯nµò/·/c“²á³OóJ	 Ÿì¬}¤Ò]èPT`•@ŒÇÿ$âR%êÅZ¨ò0vÉÓïµRôŸˆáõ‘G‘­mE8‡ËÎåp{o?yÒ6C•ŒÖHn{‹3!.Q¡oSñ‹³¥Yqeƒ:U]¡#›ÈDöœÑR…ðúCSå&Åa‰†o­W*Ô¢þ‚¹g4Á™n+{”žd3¹B=Á< bÞåºqŒÕxÝƒW±ozÙ«º´<zûœ Ù_‰µ7á§W~AØsƒô”Á|î—¸¾9m…üÑø1õ$söÜT/hþ¬Ò Ii
S‹ƒõSxÁüÓ½QÌSÆ^I²\`$ƒðßõ1óO#}æìóâëÂŠ}ÏÆ´âWÐÅ[3‡/§qéIŒ¨î`]$àÆöëž<øw»>¿jm™dœ±½Kx$é2»¸ðŠ¬èÑkÇ)™mµ³ÁåŠÂ÷^ïº±Ê¼i+qwÎM“& j—\«yžÏÙ3âÍéE†:Æ§wj#1Ú˜:HjTuîpEÈ¢í¼)Ûü×gÈV¨#Ã0Š>PT‹påIýŽüþmKÍ®—èTOÖþ­áwRFõKœ9ãßÅ(=²qµY¸ ð€TƒÇ°ÃKj‘È(_–ÇÉ&dôÈÞ‚¶F–Ç÷!¼¹?ƒDO8péš(MÃ›¦™…Iâ
 ‹“8„r âArÄÎî;á­±‡·« 4.FšM´HüÐ!eûÁØJgtìUúøOÚ€¿Ï¬CL0Æúg8çßS³ãV¶°™B’=ð]X*×Õ´Cw‡LØY…ØlÁlÐÌm‘ž‹€Îœ
OÜk}<è•Œ½Y…6Ô~êo[S1^Î	£!æáœCÇe/–Äµbè°¹[³¥¨UÇküÄºTôØ	šõ"Ïš3Ìm34£‘³Œæ$%…!½¸Ù¸È¯ŸŠ£XËÅ?ÂžØß/,´w³óÓœ´CYæ…gÈkU-ÈB`úhZ°NtJ¢éÐ<o<ò^kÖä”N¸+mþ”‰ZÙÞ[z˜š¤Ø6”vWëBmô¿»UPÔ÷ÈëàWékžù]S#l¾Ó|aÎù/äwD¿‡º‹/ôâöö*{Z\{
ÚÂ¾çÆI2ü	7ä9¬‰»¨Ê>`ò¤¸¾*u”5¸¬¬ßSCq2ðÞÉçõ{­T¡šÀÀL¬+$nåàfïn|û—Oj6¡œ´Ò,c‘\§¹:?ý¬væâ#M¨š­¯b3¦fäšÄC Aú¾¥~%þŠÃixk¹nC;×dA˜$<àÛ.©¥«Æ~ZrÖRnp2hÎúS¡¸’fÛ\e²V5çä"ÆH?«¯"ã%qgša K*	/SªJSÁ–‰‘µ”I&§wh	~6ÍÁÂý”=ôñ4h¿ÁL.Îê|?8¡,/àLôSL°7²oósè!G6NÂ™r“"£W2«¥´›Lä-®–•Ê‰÷e—¥…û£ãt²ÿ=ùK|d$×Â,é¥~Z”Š~×*ë´ùémtVóC™ó83K2TÍ¤§'žGq¼îiþN6k£7™¥«ñ\Zt¢¡ìyÖ')¦c»}Ì×ÕÏ†ÎýºFùüÇy 9¬À%Šy•ìù%Çã“Ô-pTKnK´“ v»•zepd-…2_ª5{ê:nÊI‰JO¨…Ô¶².¨L5Øºë#éeeåüŒ ãBgªÒn‘*Þ˜Ë[@[YøßÏ«hÍûDÃBì?–›ºxJâ^õÊ^„‹i• }¡–ã ÒYs:ðp•Ó	ÄPtb]õ¾œLñÇ›³+Iqá²c¥fú‡Õè%Ý¥ NxæÎày_ Ê”Sj îy"Ð1ù!¿TË=™º?Ñ^¯¨K¿DENƒ¿o?è¼è”s¨TPUòÅbfXIy4Ê[8JXe8I9S(˜›=~~øBÇtãÔ74Q:R
´·GÙW.ýÞmÂXOƒ)OÃí›Œü:³¡?«TÛzQ‰ïÃRÛy”ÞÏªóëó{3â¶z¡¥¦®`O	 ~åX/mÇyP]})¶„BšÀÛq»¶r:Šñ‚›©?@Ç¿Èß~Ëþ–ƒ*æW´»Ç­ÞÂèiaIªmHB[²Uµ+âØc3?ö„ø©i·$f™´”
·zÈôª~Ní$2•Éò<“ª÷òrúq)Íì¾fÞx_kC’ÇÝ4*Õƒî_ùÛ6'^(•íHu[‘-è˜QÊ]…wäå+5ñËÑåéüòÒµ[vÉfÚµîšmx™ïI“0,Á+X¬Æ5ÒÓÛÇöáÒÙk×¢Þ7®šqxÂž“Ô­@Î)‘ž¶Ð$[fFo6Ô{â»<ú'h¦Ú@¡
È31BŠ®1¿~%“•¡ýR~IÒ´ŒöOñú—„™%/ÒÀæ®‹îž\ûö†P9˜¦òµ®9ìÇ_v£šIq­¬\ù?™†'.ðÙŠH­âG?ÑX=°|c×WËm#Þ€@‰‹œ9zøößá<ìVW]ƒ?:j1¥ Rùþ§ñ<®¼ÂÞÃ“]ÊÒY×¦‰çáÖ˜†!nÿü]U7þ3Ð0Õ¢…2JKrg©`£ÿ­ÞHÎøì{áP6v‘×] }›ß´þ–#+ë´R˜r°§1”K³­¦ðé·’$i}òŸÉ3]@Úì²¾ˆï˜àiF6GóYg‡÷œâpZ­?ãõ ZF~ªTÓHVD_úì-´Âá’5T|È¤SˆFÖ%F¯É¼³p>|`kNy žƒ@¾eÌ¬ý çfµºÀSMLˆÖ>°n0¬VýÌ‡¦Ùÿ›gMÅ’¦¹®€ nØÄ©r$XŽO­òÁŠöb'–°Ü¼Ñüjåã¹©ÍžùØ^•²‹¹¹xËâø^#ú§96­n±ˆhŠ) #œe‹?”’~³± ¶}]ZO)¾'Új{sƒ¢j'!ÝÎªªÑÂ‘CwÂ&AÉÈÞmJÜh*8µbŸ 9jþ‡ÞÇ3Ö”Qˆ¶´À.w\gÊž¼Ë8úi‹fIEO8B{[g¦:_Ö_)þ[“À·ªM‘†l«éýL@åÚØÖÇ„.×º’ð<+=dêîX'Î&ï‰&À•4ïýÐ:Æ2“ÅP)ÿNŽk£[ˆ¸øÅ‚®^æç›ð‹Œ²{¢
¯G1o	ÞrÊê‘îƒÎÊˆVþ0þƒ<¿N¯äºªM!€vÕeu
µViEeÉþT7Ê2
ÝáÐbR´*e<Qû³‚. v¾ºAsrµÿJ	f5¥mäÿááSÐimnê±ª"dñ u®à.Ò9J9ÁgÅ½ãÝ©-‡Pª:Ÿ4zò†ixø>U+5¥’s
8ïÑUé›ßþÊîö÷‹ÝÀa±˜8sÏv¥è¯Ž˜b	Ìî&5ë_ââ	U¡a[éNèu°¤µ–ëÜ­èwŒ£°Úhß³U@Í¶é<A:šŒXÈUä´ËSxò^9¬0ºn¿Ýž¼·ã‘ì	ÅÀžä3õ+iµyh4*àì_&QÉK6ÊV5œ-7ßâÒæŒz¨#‘9Ï¢¹qÖðu^ûü1%.¦Ò¶®ºkg% ›Ûªîf9íŽßU6*ë+©X¤JÛ…ê\Ã*•ÇSáŽÎÉ1‡®LU]®ª8´rÜ: kHÍjµ§Æ'¤‘÷o›·¶wä¸uªôYçŽG2 >
Ý9¢e\ªÓÖ®ýFÜªíL„*„œ&o®PA®Iúý˜—<=E|Î²ýu‡’îH¥]°…‘¤™°y°ÆÀèˆéo
pÀ§gjUê&Î«—2§á[ìï*_w&¾|c~Òc_7'¨‰¯Q‘Y±®ÍYjñ(c°ÛËô„Òë@iA’ëyp		'æ2ßk†¼Àî"è†w°ó(Ê’èUÓ{d£_cÖctÉKçéR	Ä.ôu›Ð·>èÖÝ«z>	_û›»^ÃEåÕ—-¦›4"nŠ´U%‡-…†P]ë—õ°Šòç¦¼	cµ¼6£Žª{®]rµVÐƒB÷º]'ÖÞ‰àê“ÒÇÈ(O'-ÐŠÏ‡âc€C©s›’–?À*%‚ÝeYj µ×c^=Wÿ[Pþž´Ï™áûÓàèÈZž“„Î[+ÕDÄuOvIÔ8ÆuðKÝ èO/-tÇËó~úW0]Â]í®Èôëå{m‡vŽ!™]r¾?®ÙÔÕz7…†ý€°!!ãPæ\½P[·cY UçÇpr¶$îtaP}Q=7ñî€rKØô¢PÛ`Ê ÿÅ˜3¸s@a³%Œò¦”t@ÒF#b“Žã˜¬ˆÕŸESaI—H­òå¤÷™dñ“O5€@utâ¼˜ –€˜_´Úíò¦×³4¡ØØŠsp†fs}¥‰Krò.°'õð=*äýØ–º"»K<Cƒ¦à{‘TñË£þ×ß®ÅvÆ‘~:¡—ˆi*n àŽ=²•r»3m¼qÐëeŽ’Ã	px˜G@3»Âdq«áßÝô¼CY ø8±9"%Õ¯™üqåÇîF’=;ª_¢p?™H;6MÎÎ5Kœr¾§Ïý£¨¿ žu(9ZÔÉŠn8ä‡™6#•®‹ú É—Øæ¾ÖÆ¸²OãÏ±&ÒÈ-2ö`ô7­ÓÕŒÅ'rÔÄé'f4åsÇ¹ËÒÈb‘§2ï”®[¥BL¢õ¨5ŠåŽ!* Ó,=‘žL\Ë£ÄÎtm=ó2T{ŽW<p(5¯"³Ãho±´‡Ã~Ãvj[XÝ`îò½¿Xµ·øÃ”Œ—Wg÷¢»Ï*–zÞÜ6—jŸÛÐEsÿç©,lNÌ£**UÞo›(³‰Ìôè±ÚJõoã?G2'S
ÛÉm*ûÂì-.—˜Ø‰'ÔÙ"	A‹‚p\¤®v9£Gú/Íjßõ‡a9Pe–ËÌ«k0ÀYÌÇ¹ÄJeH|ˆƒMi&©•—-¬Å4†c["ý~ìüãü Ã°%çúR%ÝÂÒBVÅ*{—ÇÒÙˆ{l†8;Êj'õtîáÎ¢WGîyøÑ$ëE¡ÎÓ–?îbK/õ1c•ò¥TlXº.–$9æEuƒ>ãÉ°Ù½d#¾¹Ž3‰âLMJÌ9-{Yâ·âÇ–‘ Í<Þ"tÁ©šÓÎ™0"'`¿×
 Å-ž,44Ï´aßçnÕF©ÃÀgwCQQ‚£þië”Œ'¹ª(lËB!½í“²3ï‰fÆWr­éwÉUš‚½X±3ôÄ,keó€÷ä3@aÔ¾ Á)ÌÂ¾/ú¥ÓÎ\óxm¢Cë—Ë~Ï¨¾sOª¤yK#w8é°h²»×SM’r¼üºK-ÕgpÚWzo4Ã€}§–è?Ý¨ðTu ÿâÌûò&sFCk²·ƒÝ˜@Ò5÷oßá\ù({<¹µï8ŽˆBÎç’s’“=àƒU´0´?$|ÈòiŒäÂò‚y€Y·I£?;ï®e@÷‡Jñ–2½]vDzs$v—¤ÛŠÕvn
Sì½®=cŒ‹¢ï]e:Ï¬™:6%úQHÝ1”ÙqùÙ?.nSÓ§ÚÐ^bR> oÕkiÝYfTKâ¤CPÚ³e™Ü®0ÐVmÔi-äX‘¯õJ'q¶æXDC®Ã.à‰wí­‹øÔýrYk3¥ÉŸ½ìIÚTõ’&h‘¯™GáÆ¤±/âãâ<âs,o²Iž‰›†q@c	6ÃÏÎÒIU×qX²nðnrÞ÷†B(VF«E‰ô›`RHÕLðsã8?)±ã¥eÈ'°ÙŽkrQ™‰1UT_à•Ø*yCË5´zßÖÞ2¾FÞ¾rÁz)$ñŠ1w&Æó
ÿ£§¯\y5ÓkE–¼ÔeÑ®ö¼J4ßÆçtÝ8NÇ{à%JFâÝž•ù/œ%NOÓDF1H?VÍáè¹Ô*B±¿ò1ä!Öh´c Œ°R—+|gÈ-qüèwNõûZ›²¿‚+­ëÎÿú€—@·!Š4Ïf©iÝ“†{×‹¦S³1¼"{wj&zÛJJíy0ú-ËÎà‰ú`ï<·‘†^4¼¡žë‡Èå64­é+IJ›&Rœä@ÞCvõÞæeÂa3
s¹`*!o9¤8#—wvëùÝo¨ƒðú‘îßÝ	!‘ÞšÌpÖ,}šU‚¦¾ìeç34;G‘`Ž²,ÄkoUÊŸoQ´gš1K77’ýû™ ÑªLÛo)„Å¾	•ÏÁ zÝc8ûykíÜhk}ûÔ
òWBP	0ÛälJŠŠ0 rHBYºfÈÎ!ŸÃüæLì”ÉZÄÂ-’[l7´F'–RËÅÑ»þXµëyM«DA€vÉÂôááÈhæÃÊýX•—%Tê6'iö5ü¼‰[*ßsÙØÙJ@†Ú­gËŒßl$IdvXèú:.û?T	¨@'2y°1î×T¡œ´žfIq¤
­¸v}Az€wMÇNå4—¶MÆLäí©3Yè%¼RÆFÞáN—ì¶%P'×²ògûÏHÍ!CD[ÕñØŒ^¥áp™»ÖÂ>q:iª/‰`a¬„^ëâCíî¬30~ÜTsÃÝCYî¼Öa¾çý*äƒ"I]÷x¢ø$&$âqÈ<òÇ²qÏòÌÉP5<ÃNr5°¿Qï~KabRÕyŽÒZÑqëªEÿõj¿D¢fb!OZ¤ûFÒ£,ª÷eˆ›GS*OªÆlj[xÀg/™6'¨h/qøRøÉ×XP‡®{‹P·¢H£¬ë8‡.3Ê;3î÷IxÊ=û¬KQHOL?m†:`Q–¢€Æ0á¿©Z·^ŽÁ _ÍÊ½þøÒw§z©õ÷k±gV!”¨´nÆXC<UÜÚÆ§!$þÙ”=«<àF9r=ØÓ»f4_¼,‡ƒ]ðhG°×*A€™Ôè˜ì®Si,Ï.÷¡ÿŠ	2Ýøä%<ŽÂ½7±×û½êËOÿD¼L|É(ïjÌ±Éã÷rœëÐÐÎ&CÄÄx¢]¢XJà;’”mîÂä…ö™)6‰€7•8õiü: bœ$2x¼Ñìr#žFM›‚¥…§¾BåºÞøä×M|(Õ¥†q$[fø!ÁÒ‰ÁW¬Þ‡¢áCme»“
‰î§ßž/F4z	ØžyTîu´é³GIzóã£þ7|mâcÉ9ÛTñ•øŠ¯3ãnJÑ'	Êƒ®XçïÐ#l:¬2Qt—ümDídîo­Š¾Ùåâp¬ %d„é]€ÑðB<éaç4ñ”82}…ÙI^íŠ¡ïÍ L‘€ð.èá¡^Ð¸îOF%[X³âÁÇ¸èÙ©ù:úÿ5\onå6€ðg´üÄŸ}ünQÖLÍ
M5f{ð‡IÒKän„ÑlÞ®…%¥Å<‡°jéÛÉ™Ø/Â‘×OÃ®˜ZÚËè¢>‚:ìÅ/gºÅ¥˜?^ò”Áèt}]%n1¦‡¹ûØÖ£‘%c±Š¹e@šá‹ˆˆa‰{¼×UiY4Ígû«=â©ý„Ìð‡~„Ä—£}»ÎÀLÞ²f*Ï‹$ÕÙs÷	{éxýå^Í-ù$íÞH­@{ÖÚˆ«Ü¯­/
˜ÛR¼‚ê|F~uæ€è­–‘ß)ÀKáN²èìÔÚ.ß‘#š^ŠåìU“ö¡Ç?‡ÏkÌl¤yÃTO‚¨eâKünÞHðîù7!†T’¥ÌˆÀVø	÷o)aßq|¾H?nNTCL8Qc¼¹Ñ×B>OÓ;`ÈóäÇîÍQ–ÎerI\3´B¾ŽÆ–{éqäuíô¿£T6Õ¨ $Ê™G‘U?îã ¬&€Ëšý&“	? l8ÅT
=}¹L¡ýAV=ùì²Iì•4}c™LŠçÇM®ºw\¸R¹"„ã yYE ÚŸ³ÀcÔåLAÛÄ ×/ÌZVtqûpË¬9éƒƒÅð–ÃO³Sn×•<£û·iÅ2®Ó·q$¢b€s öOïQnzðÝøb LU-	¢S¶,4¸êE–Ë
çjßÎ·°>lŒk*t@Kêà&Ópª¶:'†_Ïê`4#1U¡c.©Üwêålr…ºÂ‚Q¡¬îŒ!ÃÍlp:½ ¹nHÔãwªL0ýüßÎ¢#7õ?Ãúmùu¯Ñùë²·qäÄ³í	(â†f<÷™ÅÏZ`|$#…–xh*-hÛ~Ã±‚íÄ²jDÁÙ±øaÜÆÖFÀýk`lNÞvr(‰Ñ)‚zÂ¿‚·˜ãZžiÕbúgVdh´ÊNwï™cñIéF9þœÒœ‘Ê³=þª©×¨›â¸¢§P·îc
Æ­òâ.ÄòC~˜W/ºöfYâk¾*Ýd~G…ôž¼Ì%ô§Lv¨22)7¦Yâ÷½'éŠ%}eù°¥áâcæê}’öàeÄvùëG|`â8ƒµ¢RºcÂ§údÑmŽ_Æ§k³"ó‚º·'é]E$d²âŠë½ãž"fP¾ûaìk©z\¬n‰‘Kä²Cìuã6ÇÎ>éGfç=šDGïóÂHó´ûÝxfÜ]èdî}ýây•!¯é}óù¥HÐâAí6*"‰Pá¤‹Þºx«PË™UçT ÇÎN¡ÓýŽ0jë0¦¦¯rpžvèä¬þá^Áy7\á„—7©f:Å9Â9|(ÏùÇb#Z8:¯„„U:]VÀ6HÏ)",Ýïì0=O~™ƒ¢fúÀ˜ Ø“@Ëóp~€”\®–x9ÒØ+9ŽiS˜G¢i”ï‹ƒ'fl:é9
ª6!ÅÌïD=Z†Æ¥¦î+ÿ¥ÈQý½éÒÜùbª{Zžœ!áqÈ÷:à—eÏ§µ™<ÀO°Øº£qeàr`Ò³Ö¬Ú
-Ý{æØ½ÄWf³H|Ò?s­ìK·;­Ã¢²C-	öÕgJ‰CžO•o)lDÉ˜ÂÏÞ8«¶ÈxÓœHöýÈH=F
%éÓoçA­]Ìi’Ué3«Øx£IRaxlœ…óªemŽ' Ð5û†z¸Òl¸ÏðÒ´©P+9Ñ™[ÄzY^°Ÿ…˜êé½Ùz?™môgGÛe][>t¸EÄ"[}ŒLåhŒ4éÕXÚRMËeÐÜA°Â £#ØoÓ'XÙkŽWÝ=?l?ÂâÒî˜ÙœPLsf*ãköŠ=²>úægØ îîHJ>)F§œ˜¬û›ZÚK ¥¹Iö8'˜{íŽä¸9Ä¼/ÜÃð„¦(¤<žªýIìªœBzz5{¡†é÷¦µ+TRÍa?ÀÎðBg¨t­grR7øŠ²¤0XFP¤ÌeÞÌEÝPæ%£Ö¤*vç×k,‚/ÙÝ)TºótAÈx#CÄz¯Ø5ï*E(™8‡ˆù]ˆ™Šêrw‘[?‹ °¿Y™È	Œû’yIŒª‡û|HKeèèãqznŒõcIæ`Žé1»úY†Õ1K­Oï1ÙÉ!È­cü¼pGT¬+ÚˆRûÌ|¢Ø“vùþ'µÃÇ¼TÄPL£ih¬ÅÉëêÞ«¾  tåø£gØ¢âEÙ VS„Šò`vþ–Þ`²Z ®"è³-Z‚$0#-¹¬€ôU4ÕþÀÃk®ßWòë°ùÖôOo~w«ëü4¥:ù¤À
íîÐNtÜø˜ß-uq‚€
;îCAf®™Ù»ÎˆÔÒSú›P˜:s/èÔèüÏ5l‚ìU&\/wÕXÃþV^õ¨QC×…O€çR¿Žf~º,_®]=;¤Ì0ˆÍO>¡4ÜÜ·Pë_ªN<*RiÜ Í,?hùMÿ±^·!E¼Éš°«LnµòRpÓ½ýŸ§r=!ž­M3î•ónòò3•áÑx>™…®€À[YE¶§ò?"†‘Dª FºÔ`=¾M(vòÔ^î Ut¡D›½µ¸<Eï>0P¯2 6»¦¨Þ¹ÞEdèC…‰´Å»|Ivš'[eMLûU«ö³›ëyÆwT äsk0#S"ôÔPhu’M-ËÔÐ.Û¤æž™A¬tÍá¥C«UtU™Ý6`/ß9ÅÃ?²0I¼Í™U6€eÉ¨“C1qeÎ–éÿ¥ÐHÅøð;SÞ/ ±±Maa¹yÌÃÎ™¥%©þŠ ñ8ÇÀ+BÐseZ%'˜k$u-¬b1Á(–{¤(1K“š!6Ž{…<ˆÉ
ñ£$I j›wNw'¶>”?§?4ß¦±[÷ˆ¹©Np©†Çâ…4X¥*jÖüÅ1rØŸßŽ¦î¦Ñx<ÿX£Ì~ÐVz²ãr¤x—jÄröÈ6Æ‘D‚Kšg±bwîŽð–ºøˆ†³‹Ê·–—FcKãŸÁx–m¯4…ôü‚€{Ûá£ˆÜ€V¤ŠQØ¾P}#x¯¦ÍÃÓ•ƒz;ýž^›wÍá i¥—˜ZZŠü‹1¼zÈ™¡TÌM-3Ð.ÃjÆÊíúX#XérP–ÉÛ:ÕTÖ‡£»ImÃ¢{“Np €5¦èÇ„ycT^çnÌ‡	ØsØ>ÇÁkbt<%Ù0£s7Á–8‘^œÂ4O¸fáOHÓÙG N f¤¥Ž<'þÏ„)0Û’ÿõŒ4ðyÖcB¦ÃR3Ø6%·¶¡ÑRv"’ƒŽžÐžßC14=Ý´hWåKP?³Ô£UÖ˜B«¯‰£JþBbªž±5žÆ}ÙýMbWšI¹‹·ûdw’‚™|G¸¡‰-'©5$a-ƒôAËŒÈ?cMnÒ­Å½#ãYÈÔ¿7«¨)‹v"EÐ$-?v–—ãßg,àŒn/a×ž£ßé|JÆ`m«vÂ›ÆÕˆ¦Ö~)—,c·PI„;•¡ª&¿¨?ìÇ-Ðð¾öäñ~¼ÚY$v À0õ¢¯uø}N¢¼íÛ¹`Ej;r®D¿â¨IÃ(>(›¢óï‰Ó;`üãÚÊÆO€R4ÍÅŽ¶Ñ$/ ™¥‡¢»Hü˜qæXfMý<<Þ¤ê ¡·PXÁ¾Gæ×Ë¼eÕ»A›è@ÜŒ”>„;±9•Á0}úêÂúcín¨9·oµþÓ½
¼—8XüÝ¨\4^4˜Ðx–HzÎ9[ŒTÂ–ÇønN‡(FõÃÝ•GÚ¡ñÁ€¸S±ÉúÁ[Üæ²8û `ÜQ>%B„*bÃ9’F]Ò‘Í,áý¿ÖSp4Kœ!µ]”ãÿþ#Ø(òR¥$?íçƒ’^\–áxBª,ìòû(òŽÌ#9ôÍi ‰Ei.“Äd|6¦l5¬ÊÅ±¿¡öt/é
?¶çÐº•¸IhH¢aèLô³¼¤ŒŽgŒ²‘æVÔÜ¹¥tÐ›˜LJ#Ú|ûgü>ÜÙ©¹™¬$p…ÿW5ZÔ¾[CÄÐ|*.“›„'aLdªÛ«dx5Ì).õ"€öi¯!ì×\Á‹ŠO‚ÁüÆíí¶çÁ%ù:Ë–#¯7™Ô÷¹Úä€\êhu¬Þ‰alà›18#™Ø!>Ë`@„+CTþ0ÄÐŠMe÷L¯~¯Kº±ïmÙ,×Æk`ËIí¯çr`F,Då+ƒI¿	ê1>7Ø°æì=¦’øà/<Ê9>Âq6zª¯fò’¬çLÐ[ò¬Y+t'Çöå¦ÝÅó¸‹É¸â“V›¹ór—æèÀõ¾¤ØÂV=ôóug~QÃ1k…m†(Ì:wÿh‹°D!‹SËñC³ðôxñÛ­Ér£Ñðk‚¦7Ï…Î«.˜ï€Ýf&Ÿ—A:Í·×fFàvLí–BWÒª;’Ü8jÎ‹¨H
Ž‘™ß³}ÆÒC)8L"Ýž‹NfwT¥‡ÊcwÒ`yŠáGÌZ²»¥®pKß[Å%Ù¯6äú	Gn4Qx$æúCËui þád¡ÛtXAÄ#Ñ‰þ(
ô”)]S°)!ªâÕ°fmÖSŒä»×ÑjVY™V•ÄÃìœ2~©Ò¶ø×;^—î÷vFmf~wÔã®G•¹{«ZÉ:m¾j—EJ[kÅ§rþ’¹2	''CÔÒ	°Ò¨à4~!9è²_TsU1ÙO·Ä®
çªnd[Ÿ:­3ðÝrÅ'Xv8eg¯GÖ%7ñµàéÐ$6Ï(*'ëäýsÁ]¿·£:ªÏb`‹®Íýa¼¯8´AÐJ›,kuþñ¶tjiiãu;ÖÑq‘R…äDsaƒZ‰ËmŒö
ýþßüàk(9Nbe(V±®1ˆ¤¹zfiôò|XËÑÓÐ:z¯÷ƒ›ƒ£#vPÐ’k-Z·šq-¾”mÊðì¤¯÷áº³Ð/ëð¹¬o€d¡Õvâg h´y¥ë»æÎ(S<±Ô ì“43›×û£­a²¬jCÒLŽˆ‹^&Ãy¡¶„+}sÌaŸWÖfÑžTþzÊmÃnµhÿ ýÓ1³TaªåÒm@.)ç(A¦¾,¥#wèŠÝÔº™¾nî¬ªHË¿’ÐÕÒKLl»ÑqŠfe@Þ¦k-²4Ä!í­±ŠúH›	ïjVgŸQŠÈ8h£C¤íÀ—`ISØþô,û2g†•>]¾NTã[ß’
àmX#(·òªÜ{8ñ:)ƒ7jjQ¿.æ+¶˜úýˆ¯ Äö¬£ÈÞCÕ#üJ4m wKçtÕï‡Ÿ®M[Xt§·Èl:A_r`ëI2Éö§Ê){´ñW·±çm'ÍœÂt{Xa½>Ô
z¸fïRø§lOŠ=àZ0²Ù.¨4êÊB3F´RLé~jß±ÀÛJ¹?œþü»C2u¥á¡8_IÊ¼ÅñWFCCÝ#k÷CKôBuzhhNÉ™áŽÕí‚žF+	!žœšÈ xQü/ÕÄüÒa¯»¸o_Ž4ŠxaýCõ© Ûq9kÑÖ<†ëQÇ+ÎÃ3rÍñºÆmìrn.&è¿ó’U˜<vJSµÜNÊ¤7$rÁ>0
°Úšð¯à /Y—|y¿ñšMÔ¡ÜkÍWDÁÉa®FÕzúbòÎ7éum`¤ä¡ëÆÀðý’»Jí…ï£Û."nSm;š®¯Ð›€‰hãºa½Ý‚ð¯Ã6²À«Î…‚ýf˜h¼äD,¯pq.7Ê±*tý0Þ~Õþ:èŒÿŠËá©É(}déÁi–·]‹§]9/Xö W„dÄ‚šÞvÜk>fì#µ¼äìø•­‘±þ2ÌÜ’õÕ”èlÃeà–ú˜DçÊaþ…†6*$›L£T<nÛ'[”¼¹1Eöqµ®ð.¨ëö´£F-´þë•oÊàÑÚÓèòýèqÏÎ»e±hÓeGÊÿ‰dr:£Vã÷P±X¯~W·uMS…b 4Ž½¾ƒ¤ÍsqBøŠ(žƒµ¨:¡Tß¯éð7ºÍ‚$n“v8˜ Ïß‡ÂE(©n-lexÏr9·3hæã•T)ÖñYBán˜…¡‡í1±¡D¥üoÉ²¤¬ônÍ›7Â®·¶ê³ü=A#ûÜPÓ©\Æ=ƒm£Fù{üê_âRÒ4kü®„E»®g*\gzV<èÓò¯QDJ¦÷B× l;÷dèoË$¢èEoöÆ*G»ƒÇÚ0“]©2-‡Ü_ÑÊ$nH‡Ñ‡ Æ/Ì‰Á=Ši¿ZdØœX|û&»Ï7ÚŽõä»NwåÜ±2´FãæµžO¤öÈuØà‚&Í\Q?mMP{¼\ ßZsÄÌÌq²³“ÏŠ‚5ˆŠçÇü Ð	EÌP¾§Ì‹X`öplÌÅ00Á6F1bääfŸÁÐwOÕš[’Í#ŠOµ4$Û D¨¢Ð©ròŠ†ÄØJõäß™¨å­—³ç˜ã–\çdïõ:Ònwó
]Ó¶ëeµï„$ñ‘ï·`æ §‘k&î| ±”Òé–õ“$–|ŠÐˆ
"*Æi"õs°F}ò*7€‰SQÉIÓ†‚áŽ<Ôc>#Gg7pŒ`(uäô#4Ü´KýÏëHq×KHm»NÈrjL4@èL«/•(ÚS_ž“òÔPmI}1pò*¬&ò–õ@i2ù5Äòæ®ŸJ¾ xU˜ì"U0æ·#1
+dœ³ÜRž
|a	Ú`tªáéN,QvhHìóÕ]ç¢é¯s±[k¯‡½¶¿>•,î¢0„e"© ¾4Ã"FˆÁ$‘ùäÇ†XÙpÿ‰ÿ'¦,x8,puËåþÔxûŒ9’Éá_)åÜê2A	(öW¤±jL/¡ÎôOÀ÷üsöÄy.!¬ã2RSPg‘ÁZ±,òÚ"hÅÕâÍ´CÛKÖAú~oäSø,7Û»j&GA_wãÃB~\pŸ'§z¡ÿùúóy2ßv‡Ò0Ñú×2»ªù™]¤à6	|v—BåwP8¬¬ÑS!àV$Ï
u½œt¡R~ý[óËŽZþ<æDŒsŽÎò°^ù1àØÂÆm®ö‚²Ú@¡Hˆ!±½¶U]¶ò/#µ2a9 }ÍÇ¨<¹î"óÇíçä0Câ‹?¯$Ñ’ÇOc9MÆó8FìBÌõ¾Ñlj«úšüÞ/äR¨uÛ;yý9z¹àê¾öë¥c}`ÞgªÇ7éËSž—Ñ7BÙ–7ÆnbC]1Öµ;ËGo]´X½}ºÝÚQL©¥GÓÓÂÎµuAþ™æ½áðÉˆûÅ4m¬² Aò´Oütõ³knß@Fv…‰À´¡f¿ó>_S@Å*¡ŸSöW	VµI¤Ô¤ð~¿VSµµÔñ®?^ÊMgò~´çÏ‰l[,óÚr&YÛI»%á"_{1$RH5­ºÞÛ£6W.³œWÃ:±én3+ú§‰MÐ!!åÒÄ«Û 8à¸o&™½,.øåí¤„hÌµ‚ïÝeDù½É*±·òïãXª}á¯ˆâ¡ï^«ÍÕã žù§—¼5RŸ;µƒò€‘]E^DˆZ³2¡Ö›Î°…µ3ßA<Æx~_Í´Å:GÝ2+9Ä\g)ÝŠfû»°<ÚyÂm(/ßñ¯^€-emâyj6Ík™övÑúvã
š98ßhÍ,'P1nxÛ¨Ùßõ²°^ ¡è‘t‹qŒ^é!Ö”7a° lBtt)6¦€ôi{´¶"ªå•Ù7»Û„²×´dîè Á»°pl¤® )Sbä‡ì2¶Í¬¹kô0Ù¼ó4Á:ù¼5~9Ö|gBï”R4	zõ¶ðÜušæu^?¿©¹Àµ¢ÓŠÜD “ÔS|?Šâv¯ÞÆ¯ŽÊ^r‘báá8û2HMÍÃið€}E:£5)¼!·j[G	¥uÃ¾%°)Nmøò\¿Ì}Ú0ž¬v!ÐTÝƒ=#MØšì]&}²>à	•Nžpo‹QxÊpN·‚fNâ-úbºÿ%rÐïuk“€ÞPCcb¦Q‘¹Q&Ù‡ýQ	ªËµ“…ª4ŠTe“_¹~Ø€›ó¤šÞÆ<Í?™UÝüg'MR…äƒ;·FpŽXÄ¶CŸ›u:îïÆÅéZ¡8©Ùm€Ÿ(‚´òÎ—)ßÀ°ÜqžÕ:Äå%<³ûKàÁG‹|-XC‚bÕbl.y¾¿EùSv41®Š’»™÷•g7YßV»5ÊŒ²èÿs¦ÄË}0Rüÿ}£±R!U%õìƒŸu—_.¶/ï¤F*Ø­pO²!PXõ9Kdz¾;ºÅ'€%èÜrüûK’ø–yÉB{„N‚bzî.ñøÄ}XPÓ˜º~ÉòQ²§·ÔáxÕàM)í¾^N‹-aFÕ÷Éú7Ä[ºž‚Íx¤å«JcYþLe¹(÷ÖŽñØA^‡«G#ÀÎ.5a0ž@»géIÆ§F>Î”øD˜Ö»Lþd‚*ŽæþÔ.Ñ{‡‡2Y¡QÊ@tÑßðÂ°«Þ|}ç¾àÈ—ƒ<£ùyä°eP^<¥<?~ÙüÌÇ‚(•ðÇÃ¯4% O }+‚°¬ôÐŠáŸÖÎ”ÓÀ)›ÞÑ”,Öõö×
}oRtÿECÈàóSúãÄñÉ¾e»2Ó¾š¢‚{˜ÈN-­0rÏiWT@§„ˆôâŒëfR!¯6x{Ä;tÏü^—AWZ¤(¹›M[‰ñêˆ«èN•±ºú’<¬/ñ‘B5»7«ÇvKÅíahf«w«à±xOy]XÄ?Õk­õ®xïæÆüL,E ³›¼qM“ùeéL0“ ¯BÊ½tåÑ¼ÅS#¸ãYü­C;†p–áQi%Ùƒ“¬•Š¡ÓTÁpMœú}³jôPËtR6u¨ÜO•;VŒaåú•–ßãd5ôå[Q`¹Uá(ÂxÑû¨«%ßVÑqæeå±NvFû+6XlŠŸíòVñ'â"ä”8Ç•Djåt%íáÒ¬Y¸éŸÂ”×š…í"&;¸xBr
Õ;£ºâÎrdMZ¥6¡¿Húªõí6ä s¶Š•Xê’%õŽÈ|¡†¿øê”l=ÃçlùÙ&HÆŒÁl+eEõ!Æîp»¡|«4
Jz	¶´6<ßœÒ(|«ÜáFä¦ñÂJƒÃPÒÊFH”É®õR¾úÞ§õßI›)Œ³¾1¬FÓ©c­LåÏ†½0ŸUó¥DYuyírkPáçÔôK‘±ÏûÇHÓ@¼BM6hÚçËTÇ‚¾öˆ$Ol½Öˆ¡(l'>	¨UB;ºä+§=fôPÛi,xÂ¹®)ëïªŠi÷•ráexW®zd<Ê×+‰7Û™¼v±m=©³“Ošk’Ä/;ðˆ|Woãˆãa¼ÌLÞ‡µoŽ’préš¦8Kn¾nÁ(¸rí`ÁFBF‰œ<“[˜@í×ÙÖ¹ì°+€úm8R£×µÝ2¯|ôE|ñ¬¿šÝb¦QoÒÙÜp»²úô'†æž3™5‡Ck^¼” 7o¼¬+üE5ƒÕ-wæKÞúOq‘™Ãè\¥%|¢l’®€¯Bho4Õ@qºØ‡ž6Qš“SûBáj›è(ˆ?ÿ-~ÕÂ_­­cù('Â-YËµ áMb½“Í©†+âþEt™¼·©„ÄòxAuíšç§Ï©4!Œ³­Þìû[#Ç2F˜MfÞKYc†£üŽÆù”'³uKžÄ'‹‹¿qåS §ˆ½^¢Gì}0ŸòŸºŽk,Z×®†AÄ4c¡·¯K²8ÔY¤gõP4oKËs´¶xOI'¿YŒó#¥ÆnyŸ&ûáÕiB{\‡š4¹(;VKYm+oe´³G_LNZBÓÓ™¨»ª\Ç˜ÙEÔ[¨ZóãÙøOn™aÙX]’ÿÎŽH8w¿ÖI½OiÙÚ=Cµ-ÄMËôˆDÍéÓþ7¨…ùŽeõÅ3‰ØN§‚eÿø™;L"(ÔÂÛƒúçùÖî„ÝÌ¤˜ä¼	hLƒ(?‚?:2Í{¹µfaÌ*ÞWA•©ûY[¸»lÄ¼¾¬¹Å4¶Z7@¹Æä)”„•LÑ$p(NN®f¨sšè[»bçsÓ—j|taz$™ÚÄ—ÞC¼ª¬mNÎ´c”ÉµhÝWŒ#DÉ1X–óoál‡P‡80¡wŽ‰2oÞ¸Æƒ)mdl5à¼ñB§<3• udUËX¢ ³îÆzú¹C³""åk+d/àD	­ÄP-p˜¸ß+Üâ®W‡Íõû®ˆ‹ ÿd{Ü}¸Në@j0`Ãr×ÚMY òç {xH@ýôWjÉj$M³Oþyçžóæµ×ÒWw¬I×¸Iv†K®Ç²Å—æ®‘yêGƒïhyàªDÆc¼rÂXŸ‹¶y>éÐÐÓþk}i‡QD($ñÿÒKäÿß_ Ý(x‰Òw…ç‹ùâA‡ÑH:ô™é7B½:dQ_@òƒ6™¬;<\ƒNenZ´n“øÇï¾O½íªï*(-l®™ƒF‹™åº3™°>z1Y“ÇyoÐt	k,#­»1ˆM6$YÑz˜®i¹Ü7×|¹RMþ S#«ì(z>Œ‚&ÿ„XîØ¹­K‹¾&ä²gæMýßGZÌkÈr	_ÔÐódeÏo›A>¨íI¹öò¡dxÃHœóÉš±fª1ÆI ­1)ïßÅp<îÕñ­´0oRt/{¥mG‡Þ4[¿_ÚœôÃ-›˜æA/ˆ$Ò¦µÃŒò#f0éæÆZˆâ}ç/ù·ÉŒëB‰ Šœ½wAm2ï:»Eøõƒ+€+ ÈC1Þkõ…C¬gþ]¹ú[!¿‘’ÌaèbË!„{ëåÃ* bs84È®íå÷»HhËuè»#Gi¥àÔ³þi˜£•·áÛÃóñÊ• N¶ßÒ£Ží¬:‘9ç}¹‡z€¿,ˆ:Ú3þÛ6j#Ö›Í	6ú÷¿¼ÖO 
À÷lo‰áú¦Rnè|9t„8WT3}ê^—"àÓÁ*½ÙX#´f%ºÍu»°ÖÚõµ¥Í*öüùF*£A)ê5ºs!C@ÍeÁŽü9ÀØù™qEû!­¡r]ïËÙ]¾l-®Pþâ÷
ì…§Úî² []\‚e`3o/cyûÏû–Ëk¦o§èË2m1v2‹yYøM]<@ÖŒíu¬Ý}r¥½Kä‘5þR=r&Â+ªùù³ü pO×ðý ûUbJÝ¡1_0•…w(&2·G‚õ9]—UþcÕ=h³S_ü°ÀÝ4pm,£õ$…Ø~€`~c9çóžáëSðÔR9Û0Ñ ª«h¾»£ÃòÄrö€þÙ%“·åéþÃ˜4Fç¡T£ô*:î6Ð“o‘SR ˆ|ºáÜ1é<—3Ù.—ÜˆCú‚Ã5¦1˜ùK5¿`UøýY{Õéq.Ü»¾ãcàÎ@ï…åre‡_@o$R98Öé´ÈÓ)×*[AeÐx8ùveWŽ±È·ðüj}gSF©"MsnÎµ©Zñ'	QÕºdƒË3c÷+§Ù…s‡îG’uºF!g>³Â:³ËÞ:Ù9Ì»0øj.Kä³”’jŸ×61ûv;„J³`(®,qž‰…2†¼^¶íbÛžæmº,ùv¡‰Q—™çÎýøCP2	>+ì?Él~Ÿ4qéVé½™³=Ó•rŠòCòæêþ¹Eˆ_‘£â™¸ªj(¯N\Áö¼^zò™îÛj÷–Íè`fÈ´Õ¡Õð;>ìº×ƒÃn¥™¸)Ò¿ž£’`ˆ*NnúÕÐ¶ÊKþ&ºùV$äÀLz)æõýj(œ×òŽ…ŽAT¯|§x5-a›/"Tˆ_5À¶ùªÑihu©N—W+wdwf‹mÌ’›/®Q3, óh†k´ÕäÔ‹°9|Å³™$º%:E£{×Wûÿ|î>Ô2Za	e©:Ð¢ ´lÑÇž4)|
é4•Ñ ¬üÏ¿!Ž@»¨<›ˆû?ùŽ÷÷”1ðÖ"”•¡4ÆØÎ ž¸,[†xÏ	N»B*[‚F>gu¤=äRAb êr*VŸJ[÷3¹âûû	±§ßoßÈþ  ÉO#FpÜ][œôS5¨úç¾SÓ;%²ª÷îª©ìö‚Ý‚|sô™sÝ<q‹‹íFžÇÆE	6ý+×¼&"º¶ÜUŒ]å²Liÿ_ölTŒ·>|*ÖÝðú,_6F”žmôÙ\.%œ)°œjü*V&ªÊÕëGEÖœú2ã n›áÕï…™
ÑöfQ¤ÊMÈBÄÛúƒXPò_Ju³Àl¹6ªÖ	?´Šø"[ôèÓ××+œt6Œ‚O–Òø,6NƒÖ@:®rýFqí[ÆÕú_‡ÿ÷ÜØxb”
h‡;©‚ÚÊ¨¦­¬h²>„<a&HÜÛ#;ä;QËwl–û?¯ò;×‚ òRSPX´>Í^dS0Iz"¨ë³@V²Æ~)î:¬ù°€Àß§6ŸØ4ÙÄÌ®@‰·ØÛ›|Óã4Såmmè’É ŒE›<	ãÚw2tziýÒMÝÙê1ú„CÈ-õØ¨ÊåJŠ©»¸|Ð$Q'© ³·Yçæ“xÞ•Ÿ0W›°Âòì¹ºÈÆ]²&B§Ûs‹1"ÙÞÒl·”Ý˜’GEèø4rtñÑw”Awk6Üý‚+/lµ±sÌ|îKÉ_·,b…’	câ71å~gHWï_®V¼„ÇExWÜÒãy½6OÌrPÇ!Î4êþ†sWõ§L‹&`¦ÅjòÏRI¸ÝÀW>ÓqË„™&a¡Ã×oÍ?à¨…±FX7ïdgwf·ÉÄä¬gñÇ‚"	!‘Kxb¿‹!Û§$	±Ö‘<áþ³W	FÔp_i¿ì¬õ!|E­\/^ÌÁì0!Õàt‰ë’²sC×NŠ#åÌKÙ×m—(K
ÓÙ9Øq¤Î]	9µ§ãv°\â D¿Y |ÞOã†/zâ¢®šDýGµ–S»él]:ª[DTÜƒ±Mõï	LZÂ€b{2ÊÔ<_|[¼‚çg}M#¶g«%{_Úogøh³vÀé&Å¯œ©>Ç¥‹µ@|bîî]“Š¥ÿÝOóóãÇ#ÀuC˜xþ’Ë´· Ü6	 Úuåµ€Øö=h½“ ÊÍ…˜«6Yç
×æúÒv¨=ª<d6iÙü?&Ýb×NþcØlhfŒ'µÀÚÍ®–_jˆßH§s6ÜÌ›æŽ	y´L&üE¶pÂ£–3lTàæçð ý¹-‰%zˆR+-æ@`³A·õì—«±€×¡
Eˆé³ò}ã)H¾t ê–å7¨UjÝéÖeŒ¾¶Â3ÇNùÛ§u8èõûTk¥(Þ%pôììQØèúÎwèdÿ{»Wr|‹yÙ~1•*ì)¸^øÔ¾:|yE Ÿ'ª!ÌMüÓ9ñ3Eyk•_Ö¸(­P$í91úÀ“È¾AŒr
»ë)Ó*éih/ÙEèí“)gØ…r6ãóiàœÀí÷øî$&•=åý|)ä-î½V¥K‹½ï\`ß(­ÇTEéâuÏ«V²1`bdè¸¶slŸH>—ëÈØ4Jh:Üéþ€ÊÏj!=·L]˜8r&ú×·¤À4 ŽsÒ¤õCæ$Žmoû&Ó/XU8‹¶vÖBñà¿j{<y)p‡i¤ÏlËrã€qÉ 4ßˆ.-ŒTÍ~×œø£¤³0)*ïŒÔøvM’²ûr¶©šô•Øçƒt×¡á3žu=ùbÁÄü3-B(àÆ}>5÷BJî¾5ž+HjAÀýó7iÙ–Z,»µ¿ÍÒ!ó‰øŒÌ(ÿ5.Ñç»¢c›Ul’‚éòçá‘ˆÅ	M‹ß9ÿ÷Ñz	íQ¿pßÌÉ?XÃ|ÅCKð•*U¿éT¢\Ólc©'îûW”M\Lb;²¨a(YÝ$Rê¨4;qU“-Þ?\5Ìú+Ëô|Y´˜óQð@]b¾ŽäGŽn¸òušÉ}PsÏÎ6·ûÍàÌºéœmÖøz¶Ú¿j@ô=#ÎRßš"ÿc2«èh·>ó—œ¥6|AùÖ-–óºwYø#äwK2"ÿ+ì{-ÂH¼²8‰b¶¢c7Ý[}JÐç­­Öÿ¡÷¨<ø\½çÞ‡Òa¸OøD<(¡°0”©oßNëd!L$Lk£«­î§æ£^ZaÐXlÁòoó 	æ`ð‚gÎ]ìØò„	Ìr„e"wºõm'‹£Rë¼ÿd·¿¢s¾:§Ñ=ò­Sp¤ÖëEìuoÎ‚Wk0‡T§éKèŽé'§ö©¢¥˜ckPë'##ÚjYMãT§‚žÀ9®fIîiÊÁþã +3¡‹™¿²	¦ýó%
kµÌÊ4‡v ¾òê„ui¶8ã³ULšdlHLŠª×ÙŠó`Ô_<yÕãZ:xä7,Î÷$Ë$©¤ZÞ·i`½…1ƒ˜Ó¼y¹ßj|"ÍÀÜâŽ²mwô,Lt!Lç¸-ž]ÑËÐŠóŽ·`‚Ñ;T·|84_¬œ–|ï•7®–Mf
àð­Lê#ÀîŠ`ÃCokàs,»9ìc ºK¬•Âž³³GM3PÎ¢x‰Ø4tŠ<T|qyjÍá£k…´ÓÜÿªi²ÈOþnôeÏ* ¤;/ñ­_°õÒn\ù2x”|ûâjŸý#9´þwá­[9Ix$ìð
”:pfj²ìq‚§µ+l8çÂQÅl;á‚Ÿš÷&	glK¨U3Ÿ°à®gÓåLÌpOR¦}(7ã‹Xß˜”(”™ŒÑ1Šk3xMÀ¯îÇõx¬’A_àF@c‰yý;±÷8žì‚µ[™ÖuÎ+¸]†u4až·?©o)Ée ÛzÑ$„ÊW-v.Pm<c‹ÈáwÒ±i’Ò³4ë60ÇÀ€ˆF!7|‘¿tÙoghóeÙöãŒÀúÆÖ†ê«l»„ßßrg %š¥HÆEÀ–?æÆyi¹¦[¨c˜1ídªEëáEû÷¢9_X¯‚ÉK×rž¢VR$úó1~ø’sG¥X.:¬îb?ˆê*¾±Ñ;Àþ¡c›.Òƒç.§,>åWëÏ'àLtÍ¼Öafº¬»[¡Á^8P²Æ·r^—9V‹‘5B²ë¶iñM¯/-”-8Ñmí–Ã¡ÚÇáDpâitÉ¡_{Í{À²ƒásíÇöE3eËð´«™(Õ|ï·ìŠæ
Î¢plB¸1>¿î!³N÷(„È ¸£^Í5š²S›t§ãŒU£,¤Hrz¿H:oS‘â²„ˆm©#«ÇrÈzNV>O)u‰sšwZ2…»‰bÊ
°öûÙ¦÷^|8›¼CXÞ’µñxŸ'¬¨RI„@›ÉfJUÍ¾%¥øÑþk\‡ªÁåÅÄ¹³+“<B¦Œ~Œ!:òH@uŸFuw%9ëå¨¼!wÔ(±
>¢b}ÊÑ'´…ò¬Þzr6C¹Ðë„Ö3Óˆ	xìÄdÝéRZ°ø<+M©uÎáÆØ1¨ÔBoŽ
ALçÊ_r™lƒP¾‡Þ_iÓà°Àz!Kl5¡²Di›öisL²)ÿ.åÁë‹‹Aù“–TÕc©´`N |t¢rœ{DÆÙ÷*ðò®˜µ/éÛìåuœVEÄušá°…Õé)¯…äWÔtk÷øô²»ÜËóg¾2a–ÍcÛ´ÎÇÌ÷rŽ=÷$lIŒð§ŽDX)bTå3”Æú-ˆ±)²>!‹³åtÏ©¥ÄºÎÍpžNÕHG$CÏ?e¶÷^¦Ÿ'”bˆzŒ<þ«1…}ØiæÞª?…cDÒ°k•7¢Du‹2‡š
o8._–ôuÚS\'Ø|&u»BQ—ÞÚ_
M8¸°ÌÝFjpá‰ž"«0žæñê×¦õ]ŸÝåµnÀjE´ L£åQvŠd¨
hÍn€Ê“îýÆ_‘ñc¢µ0ÞläVÌ’]ÐOãÐ³þ³v³·ÀérŽƒ§Ðp†üä"Äí¾E0õ`+&žäºm…ý#E
“0º"‡âóÅô‰\ô¸Ä|C´ P¿Øéœ®ñZráW|®ÁR%*žôé©úã).fÞÌ1[âŸ¦Îæº?…LÃ]çòí”¸ÿ¹xâ«JJ:}T‹äÍÎÜ/“ NÉì6¢ßsãÒ¨š^4=Ü®œÍp“X~
DŠ0{³éT®Õ$PŸÚgY¸#±”)C]¦ž„[ÎQý"/œ@bšCåSØ¼SuÏ¹C?¼¸àø€ºé/ðî¸:Œü,‰ÐÒ^ ºr¨“XêˆoÈÙùëe'g¢:Äâ´Qþözà‚RÓÄûPn¢fÊ‘@ê½õ}<’ºdN~šÎÌö="Üƒ˜âÛSÌâðÉxw¨1Á›ôŸüš•,°ì¡4V½†“©Êeýˆû¥Ì¯¥{§ò-½â©t¿/3I ÌM—½»yÊM*€R2{åVÝAlå»á*]S
&]	Ð¨lÖ6i‡Öd¢·{‡›ãÌˆU€A8aÉ¼/U_»Ä%d·†i5¼Êèå¶2ã¨#,b€Iøé, r –LP#þÐü ™Ío+Âçæ®TË¼2rfdd•µ÷M{¦lªX™â+:Â¥ƒÜHe«¶L}yd¦cÕ	¬ø&àæg”d¤û/qºb­PÜçÉ=^ÑÝ£ÖuÀ$ÅEÅQÓa…ïÃŽorÿœÔˆž ­¬ú½ôST­Ë4ƒ`;Hƒ6«‡šLðûã‡uÚ…ZŒëIÚ&½ÚPL¶k®0X·ÿ{ïèÖÃY ÌÈŸ;Ø&vÙí˜5	¼ü”÷_ &Ä
·TÝf%™Ùï…‚Ž; N›r¹Gmœ^²g³kÑN†zW–Ÿàd”N4‹) ]²@ÜÊKÓ¬úß÷Ûn='­}ÆilÆ‹Z’äÞ-?ì«;Íª«Öm`¥ùd-¤ŽŒ*\šµ¬O™Úµ$oëë¤Ø‰ŸBú4ñJ·ôlÌào ájdÒ\&È!¿£œ´ôuR¬˜
Î¿N²’_wÅŠ{]žÏà4lg¢Hø*ÌŒ#?™, £®¿"Ð2Ç(K¥_$Ó‰¼‡ñ±­fÌù’§‹P5‡ANõÜ›z¡4÷6Ë<´%–­õ¦+eRð <M…üJÆB#ˆœ\—#T‘	Sø‹vi,4™Ç[j£¦Ð`R}!3¼¢È„Àfº}5y[R+5ew›X¬;TUüÂ¤àô¦üñ5ÛFvc$:1b`š~n•%D¢RæGIdÉx%þBùñÞ~ÙÜKÉ¶ÂÁ!ö¸³ÞM¼Ä€ª<kÞ"þwÿŸádCz°ÕÅx—C÷ g´ÀèÕw^"Òü}c\SÏq«9I)	i?(…Æ;n	èÔî2æãá»{
¾AâYÒÿgç›ŸäÅ¾8×Ð!ÆIÃŒõy‚‘…AN¶ÉW Oÿþ¶mÁ¨ë.ÿÄ¡V&¤KHk»¦¢þ°#gìC2*¦Ìpa1ï„DrZA-Ä‘‹„{€k¶¯î"{¸µ7ÕWW%r*ûŸG¬Cm}Ö	i'¹ ûé0¸¦M¿ô6ö?u_Ü³±çé¸_Ä¶èÚc)UÅ¨ÛædÒ¦D´^(ýëpGl“Ï"£4Ñëµ#lˆ­iòð”°<cöžTûÐ„*ðâ}[ÑD@à8™ÙØ–˜À·/«„L;¡ØÐ½ÊøjåÜByQ„°÷Òa¡^µ»áK¡=ª”ÁO4‡úv‚Mê¨âëˆ`u`ŽQ»°¾û“u,to¬±‘Û8FD›&e  Dõ€œ_XBãÌE8•‚Íqaaí/
Ñç]÷c§ÔDmWÑ3”:W½‹ÌÉ~Šò	’Gg‹»ÑV@+#ÊŸgœá"Ì»o‘úšµÀºÇ±0L"·#Ø}ñÇ1ÌõÐØüÂÙ=hÆu7øfx'¤ZtåÞ<ow2j¶M[G€DÇ­¤	¥•wÅÿnô³jb‘sN÷)maøòÿWå)¸jQ^B´Áoœ65‘Ù’lx¾¼·ñüüq´!¸†¢yh™|cÙƒÉ‹²¶Mý¨òNeÁvÐ0xÖß•”ÀÔ¸ >4i8p*=ðPÙ,b§Ý0zÅO¸oŠÑÕå«ßñ á,;_\OèØ¨7–FÊ‰¿Pz¢}Õ»‰iŠ»npžC‰ûBwÿëÒ½ù–¤‚=æÔ<„ë.„JT;2BéîHþ_ì˜N¢Fò½'òß×|¬€¬°¶8û`8¦Áó‚XþÓ(}ƒw‡Æ,ÏzÇ›vy³!ªÿØÆGÝì4âÆžÀ8köZço.avòO“C©üÒø± †®Æ3>µŽºûÍª™Õ}‹³ã†Bmá¯ÒÙ|òÈÖÀ¶%R6¢·PÌ'^¬þ…v¿9=¾Þo¸ B¤aº0WªÁ$Ê,'ÒËr¨©˜?ŠAŒ*ï@S,Ó*Ä4°„)ÝùJk½õæZ„‚Î8¥¢zß€R›põ~]Gvw$%ó˜ªr$°ípæ4tÆx>²/VîÃðÑ¢•ÿH©¼¶E*TÁ±º=öQ®ý¼B"¼Ì¬ôhÚàç07Yv˜‡Øçgòø>ü)VØ!èkÉ@<q‚¢E…—÷2*2–¥µÅ°Tw¡RÖFp;‚3NTkÙùN™c:™Èã÷aôd×>‘:dËY!=è%ä×‹¡®¼§ÛÌž\ì,O ûíˆzÉ®S_û»‘ÇÉG@À(¡_Þ~Ú‰*­çÐÈ¢÷÷è7ñ–u·/~5»uô’ÙfWŒüËÙ:SÞŽY£•geT_7-‰ ‰–Ðâs(Ë[rö>{®–î¥œ™ª¬Õ}çÂ"a‚h¤l8Ê ô<°åiœNî>­D›1›l-7äˆ 7JE_®~¸C¡¾R'+57Î`éJ?‡!ÜÐ:¼ðñzàtoÒÂÁ–%’8F,þûñ¢ZDRaƒ'Æ«ÍnÙF×°ŸJ)ñr©1§ß¼7?ØYÚÔÓB¡h£·Ë™VO<;¿»€~±êÆû]dCc¼ß˜¿êÅQo¾}škT=|„zÿ¼xžüÖ±²^%ÙBígÈ &òÙþÓW·ŒTäRÂ;èTZbÅê1'6 ßeñˆWþWÈ.MA‘PD\Œ¢¥ðÌ•WËíºJbéaW#h‰uê¤ñó=µ>É ³5zö1AM'GÂ+À1ÍXêj¹õDDÓ—Zé
Š/]LzV¦/˜+O#…„š6Äƒf *Î^Iñð”7ÙõgÀ)Il˜/‘7¡îNì¼+YŽ)ë§E u¤F^ÒÅ®&¨æ=1Pï¼{q„Õ½ÒÆšÄõ‹°WmüòÙ\g×‚è·–ª_Ð…Ñ\¿¾¾…©ŒŒk´r6JFšÓ*\‘r$§Kæün—
ºËä>_6ïÑÄyHuÃ@âCíçoöò
¡AÉSˆÖí4œ”FS7jÁy´:Ì{îVˆS‘¼{Âl°sóÆ£óMMºL†2-¬ŽÑ™+´ñÊ¶‚éÛÎ]¼¦×Ô»Á<i^CÿshúqÃS6 `‰<5ÅìIúr'ö‡_.ÿÔ÷D6n¸në…³&¹†ª´õ¢“ªÃî}â)yZ-U_ŠrD^8\H„gÂ½Ùk¨jª¢Î{o§D”w¦[,‰’Ë M‚$OÏè²´*o‰š¨o¦&!´%!Œ_¤+/oq¿—,'ÍÎ€å,V‘ä^:SlJgÕPq.ô´V¿—~?!2¶±QŠÖÞ@œ „ž«êÜña}p³§×6Û4Š(®a.Àrùé,¶¹†­gvA£ØZvN¬
6c'5˜“·j5èµ$@Î}˜EzêÈ¥TùK	Ét?DËÜýe8ÈvÒó™GÔËù""Z*I=)¾qî¤`Qu¸ù>!øÏ	æ'HGS{—tt¨«—¸ž]Í¿ÂÞñËÅÏ.wäAEüsa¯ÿ8h4'	&	crd‹ ÷fh*þÓþGx]ÏyüãvE|–MLtÔ¨Êð™#¸y¢?'Rôjÿ¶Ý±¦Wà«C@²ËbNS)èÂg’NÓ»Ž™Î¯'¥ásnP$¬c<iÙÊáZÏ¡€ÝÇØ	¶0l€RG+]F´£<âIp­6²%úâA2ôÛ$¼[‡» €—M7ë#ü²¤o <tÄ÷Å²åÏ:fZ—±o`å‰_3‰¼6µNíÕ­s…t¦Œ·Ó¯6§Qä‰ÔÊ5Çº1äÞIDÇŒ[ãÐV[à{RÐSx©üV5ürëÜ|žq4ÈÔ|5»—ýK=m©ýzXäè4§Gj`»QŸ2·æ¯Rƒá”W?Ñé L#Ý¦bw’~‘ Ú—tµ²è¼0ñ¬ü~à˜Ëg³9ëäðÑÆúzs.¼ÎÙ„BÚU+"HƒšOIÀÆ0ººÉrG•ðÉØtû‘WÈÜÓ† ÎåÖÈQK2@ö‡M5:²M¬É¶+ã#IGü°²Ÿ¢4G¥./YèÜßÎ56U³¥Uˆ
^Ìo)4ü´Ý@pÎ]ËÔeÆ¹\‘i¢9«…òe\ÆãÇ4w–„`à¥ŠžÂ)®ÜÇ„p[¯FòSPÖß«Ó+h†F’gTÙ9 Œ‚C÷»˜!ãCiDl«R±Jµ<‹ˆ"¾Ý2_2«ÖŽ×	‚IÔôwÈÎ¢ÞÙ5ç5‰ sœœÚ£>@æÓ¡¤¯„¿Ã ÑF„
åqçHSÉß
.NÝL¯ž=R¡qI³»ùŠpÇ,Ó½C9_ž…«Ã_æÌ+í(œC[T6ØcŽ ¸Rp.tý¼Þ[S^ÄžêWåLë{ÖNÃüó|xbþt£ÍÃÀ¹‹õfÑJãfÌî4ó/~x—1ï„.âö9‘ÚLÙƒyî"‰‘äÀÅƒ0f”™·¦iPÚcO!c‡Å»Ì>m‰$ëC.5ƒð¯È>(Vct´QÄ¿û&eö§§Þ¯‘£ÃmW³M^\ŽÑâã›/é¢CŒO *vFéºu»!Å˜0â‹Ur8¾ê'-àØà±>¾ëªßÝZà“öwQR¢bÆ
= èRïÅÄ,Å	~Ë&ÝÔCUeZ[:®löKÑéˆPþfK!“û®ýzè¤&Y°'¤‚£:Ÿ•+«„»_|cG+¸´mžôb}Ä0yV»ÚƒPÚ¼šusëˆÃ<ÌlYÃùà{ì,FÏ«±µJ*1#ªì‰Ež/:»2 Õß“j¶ÒÅ­'¬-jï +1õ}!á¿íæì•“
R+ÑqŒóÒšÊÒÜ®°ÿð\V“ë+–âH[Qwš¢‚üãYI§—PËp4^ P2(¸„tQ\õÊ,ãz•À-Ó­vÔÎÔÍŽx}M//ØÊà!y41O½”®Õ?cN5W1--Õ8[Ð¯%$ïÍÍ‰ÖÖê¿Í®º¸!×Ê”Ö¼)ekÿqs@eB2a·½½Àj^è~S'sˆúKRèoåß„«­å/nÑá8{ùÞ?Â¦Ý³Ç7˜ö³‘[ñv¯æí\Í›–èwƒà¤5Ò¯Ëù?ðŠy‡®t#Pm*Kç~<L­°%ãE@÷ úíÇ}ØMè(¤'ÝÃN¾Ø‡É§+e†vMaº¸E®ßÚ¤‰6¡Û(œ1§ÎÓDJ{*^m`ÿÇ–`šÈ1–H»ð÷ª9!ÒI6	ô›6TŒåO„‡,Zz#š4§ÂF&ªzðänaÇ"‚Ú±rfL3Ü$•Xþoüyò'_*Ìu¬Ùçäûü”“ruQþyA>G2TÔä¹{¬v£ÿkÙpÀ‰’p+.z?ëÇÁ!\2¾}aß;mèC%›¨¥ i#0ªnõ ’:z‹³·AC9tQ¯†ÇCjS^…ä<'šRû±^lL§rÐ…ª7E~U}o3üQoAZ¦xé;¥;	®‚´Ø½hµg²·ŸŠ|n OÔD9}ËØøPÇ)ˆê>ÿDè@8L•Ú<ù‰t6¬ª	!±¦zGu^ë]G„[í¸†ÃóD};]ÑJÍ niqM½Œ îßLGw§}NñôÓùóeÃÜÏ²o¦AÍñÂ…®*ehì%Juü5§éje'øKøÄ}®VTñÐoÐ±-9¡ý%^¿¥p$Ížah.Ï&ð‘«+¤¬?î(uÔ^è¨hƒòƒS¿W]ÈõPQlÞ&²¦L±íht×WMãÆÙLAVA\sBLö1š9]É.‰ÓnÂ“Úq#¥zþrRÌL `òà”1è$'z%ƒ¹#žb¡³°³˜âô¥–«D!
ËkÑ_œwáÞ\ÂY§ 9<§ünß–ƒ«?L«upí½œÂq	â…íýn«.œ…MÿŠ;åE‰×F2ÎT™yöwÝ¶ÂžŠGËËï#¿	²©=1C†¬°À„})’dæÒòý<êS“¡&º(í:®R%¦$P“/¡c9Ó¯òMP_ ¯Ï%ÒÝ`Ä”´¦W–0Éb9÷º»_Ò;©öd=ñ¯£Ô±³Ä1sûË1¬caü€²çv›qóáäFßsT:¸óuã”$¨©/y <^ÀiÊª7l29=Ë*Æð«¢oœÎºK+îà5˜ZN½ùðÿ})Td`m3$	x
ê\úŸú¸cMð<ÂŸ×Õs´"‚þbîn€q–tld•Õ~ÁwNz@Ù‡­ô.÷ðq­VŽO.Óö)ZÄ¡JÛ8Éˆ'M)ê×ö7A¢œ†¯Â…—Ò‚&îpýdPAge=zØ£I¶žúÓÍáÎ¤‰àªÇeKBæ9Ô×;åÇóàLÎô£Ä’mñx»„¬ä46&rgˆ'QQ‘ÑàLX€:47Ÿyúa£¢!5±¿rãGÍ«ˆ>Å&³åÐöéÉîë¶uÜ›¶q-e"öK/ÄÐÐ—ág°ü.ÈpÆTÂÝ/ÐÊO<ºÌ©Ú(Þÿ§]ÄØ:àý¦–·.Y3‘æµ'TXÅu³¼B\8·#[¢Ö)°qÀÐ-@Pn9i?– …{Î`]À´¹WÜ?-~å<;Yn©½e²¼#H_ØªK'
!ý^Ÿtu¦\2§	ä›?ëÒººiÑ5ýÿŠ0l:îk-×º®§`~üå …¢N—©‹˜I€)þ„;B'ïDt}«v{×ÍÃ§,œÄ{<¬‘’, ïüæiùr5µ½`á#Gž 0úÿ9öo†»,ì©Š1ô·ÞÄ_!‚W™qDj×ÅÔÚI¥üÍTÓnªwiêMX¡ä°ú!¿(JQ*%ãG
Þ™{Éª“:q>[CnÛYo¦ZØIe7ÃÔKÌà°ŒË†ðø{Àªì±<Õ‹û‰DÒ?Üˆã©¬ÐAi×Î>@ç¿	^…v4Pn™u²èÐŒUD;_§F~?EKÞÄÿ¨]s€†2V,½WW LL‰ËæÆ?øÇ?&ö£ì\‰Þ´Gõ7Ow„Qã}Jœqý1ÁÞåI£“ÛÉVzãRv/&Éý+ó6§®*ÆÞ%RNckÙÈxB¿˜#[mÛ]_‰Ñ˜3C=P5Èˆ[ÿ{!l:™Yj#~]\¤iIg¤¢®Åãëq¦ÕÄ¶)kî#S§,¤ËHÝdÈ ì½’½V,ó*Þ}LzAË;·'åæÀèä”a»Oåu«úñR%Ç¦W¡}ÌœâæQ‹-:‚äocÌ¨3àÙŠÒ¨|	YEHˆœV6]*øÐHHÉ³e©¦ÉÍNu¦Û5SKjóô)hÀÒRâ€fÐ¼Ê•Qç&–`×Ë¢ì}*'{…b«”¬T- í[Š(¾YÈîO•ãs÷¶²Ð)6•Ì¦ÇhÆ¦XK#‡k§PþsO1NÝ#|LøqgC÷KºO `¡®2YÉìð:9íýãHY¹e¿+4ì/¢€SogSUq’šÍQèß-…õ·¿Zˆ•O´:¤Ëáá¾âð|N?Vw+Æà­
–L2šîø+‘Ñù*käGBªìŽ1CøÐ³\Ùæ÷nÀëÞ‚\°M4ïñœ1¼ß~øúë”%¶0’PÂôÿTó/ëÅjðJxÇVNèqm]ùE³U 3TEÔÎTá(2À-yáÝÏàE=Åó¥éù5päéº¿<ÜæÂ›tXPh}æßÚíÎ—”_À˜õdãÈI‡\ÉÐEƒÙØÖÀ…þæ,)KÌð -¥§]^d”q“éW0$£<MTŒ½C”’@/æ
_Å·åÄ g‰)Æ&è¬–´å€<ÉMíù—L$Yp„Veô0™»ºÜ`÷ôæh“ÀPmÛð–_\òr."|­À~a”ëNèÁê9åš…§Â“æ¶Å!Mø%c=ò	ª‘øÿø€ÏNß”³…X·«*ßª°N‹7‹ÔØXLZI’Î4´X mwy|(Ï©•Àü¾.øVÞÀýeRhk\z eSØ•mHóÊuR¶•µ“x³Í–»ñdbôHaÇ«Ut^ÿ“ÓÙgT£9ðS(a*ëØ8`©ÿÖšö_‰HôLËµ^±»Më‹â5¾ÑÏÝH	v<œ	c€‚Ê`Û[×ÈVWË£`®CD…V‹ðÞÎ©a©5¥äsº¿ÎûÍ¤•ñh
ha Ñaä?×W¿b¡¡6²0AßïµŒ˜ƒF*û2Ý‚ª›áYF?šÁ3Ç{/z#‹$žüù#º¹9ŒÆ”¼ÅW3(/ŽGDj•ª
ù,Cjf÷Æ ÎŒJ«Ù€µ¢žY)"
&ŠÕ…Y‡ëSiv)a&Ét•ÜNSæòt£8ùgPÅµdóUTÿ>Œg+E`rþï (™_w/ø™ÌÞÔÍQFrÝõ¯øG+}3Â,/ÂMÕ¸çf7ØãdÆZ‡'ÉÄ>Ã¸FßCë•pWI¶=\SÇ¢(‰‡¹M_cà ›±ågÓ\Z‚TOkv@ÃöŸå u‡æaÙUöM~€àS/ üUZüý^W‚|µØ%ˆ¢Är«/yqíÉe¿†»QÐ´)%OD&9ÃÎ«.¤Nätóÿ×_Øä7pä<i
e:^†r¯kè˜Š[ÞTOºÿÑG[GU~,Ë2ßCé)uÚÖ©þLpY	_‰Rnî…&¯Îµ;“Ù{qi¿ÿîa_níFáÝ¿*=<#¬'4¥«„8ÌóÏ˜‘Ab]J¾aö&Å¬-´94ë;0×ÿ¯ÀëhìýŠ§ŒïzzØXÃ D$c'÷.ã&¥lÁÅ.¡knjôALàÞ×š%»°t{Jú*°éo]xÓÚ^rbÐÁLq¥¬½¸`‹\T­·Ô½;yÙ"ì³&JúŒ¹½˜ÑÈƒ¥V€"^ëÙ%ñ)Ý&u¯ëº‚mCÛ:ém¬Ý¿¼2Ï£Râ-¹(M]ç‹­Ð5¤à©µÆÎ„{äÐÖÇ3°€
1P>ú{LÎ(^|Ò õ>þëx·n”%‡ø4ª WååýöÖ[êˆöÙ-(ñcÚN4EƒðtéÁÄŠ$îµV$?°0'JO/H`NlûCÜ6!f%Qk€ˆ^ÚÙN€ŸËØIàÀÓï^Fß»|9ýyGÆ£x_²»¯×$K‚£-v4SÛ´Sü®qRÊòÓÌ‡òJ—)§Ÿ	ó¹KäCç\Æìþø5IwÍf™Òõ•L…a‘ï·¬ç¢ËHÃkkÌÆè‰Ô:v$}u:kíA‰wt:9Þy¹¥¾Ñè¡ýKYÓÏG\¥Ü_u7Ž@$T±ïÍO½"ÕGÊÅS%L®mMAµ¿ª›çÖ`“'N).ë­‹çXÈÝÔÐHwJ$‹UÍ™è›"B1—æò’<E[xÐ}oëe±!8è¹ØË¡eÕ?˜Ð÷’líü>áàÊ|¹NßNÄìi9ZÜíß§&¥6}¯#0RDtkç'LZef‰“Õ¥±çÃ}Ðª%ˆC¿~ç+)	* Â9C—©÷¿€BdG<³g?p*Õ§\†ÉÅM²°¦u”*Ûo{†©¡®…Œ,üKt?ã»}âþ¯Mçšˆ¡ TŠ0F§GŸLâÿ¾âÒAb0	•\‹Ôf˜ò•ôÜ]ò$]§=z<zÚPÇÿcSÚO`J×M	’×.€¾Cª}8ë§b¿âX8¦€’”YÄ“§è1¯rÇL É9ií&Su¾ãž™OB2ÒJ€ãbÑõy‚6»˜Úe“¨@ñ+êNKõhP_›±Ñ,-¦Z~Tó ;”'Å!à´üè¯Š'.-²7ÆÔÀé™šÝ°ª¨*n+¥È³-Ÿ5‚ÁaÌØ¶Œ¸°®‚ËÈHdÙ,rJÞ5Ù±ÙTûÞ9cRìësH ï3¬zM+ˆþQJñÆpJt¨.ò„"è[oí0ûü¼öU5üÅ¿	Kú••b¿²™yVýÿ¬ßXÊ5º."ZXñ¢^8fZ€™f{‡Ï”–,®Çè§cÏŒé9ìî€¾íè¿‚Û-æ{\ÜTÛrHþ\–+å‰™¨0­ËÜŒãÌm*õ=|ýü]Qp‹aPmŠ
³ ™ŽÒ¢¿@w^ü’®€ì®¡÷ÿý7Œ°@P¿¬ZI—¬î‚(‘þx)ïÒ\;+×5+/2*ƒèÇR9õtó½¯–`‚®Œû8O†’9M‘ýóÐ¶õé­ 5ÖÂ·yêäSYgmm`æ1~’ÄN¼å~£ËÛ½ÆØÏ¦²@pOÚß—E>H×±6Õ=ËÇ„w®ìy{ÔÞ>Î‰¥e‹èëq›eA¬rÉh8Tê¡¼Vu0	âB}Ø«ùð–‹(€ßY¬òÙe×éë;ö*ˆEŒ¾(ÜËâÍ,*åŽ• ×v;oñ¡¯ÿL¨vàXˆÜî°|³ÄUì‡§¤–‚IÕÏ:,“
PÍ4
†š\^“¤åÇZû_[¾f ÐJ7Ý|ÿ®<¡ß$ŒõæH‚ )íüÿú¢IK+±kL¥óßN[2ÜFªƒ)[ža Ê¥y"6.âo?1ª‡²|ÅxcgÉè¯è"A'çDK|¡½Î"a	SÞ+ÃÿÑñöaÖÙ=Ô¡v®±˜®ß_Ë¸Õ!j‰ÜnøÁÝû'sã\$á¦Õr	„âkˆõL•UUzø^&DŸ»š~À/}n E`EÎ”û”Ü¶ª29ÊTU°n y•ºÑDB{L“ó“¸“(Ù2æò
§Êå¬¯T±ka¼ü‚¤Ó[j@ñTk|éï¿á†GÑÃZà„$ìjø| âU±1·VT®ôÄëª„*ºäA`O¦ß]‘n_ iç&'Œ®	ºHò¬]ã£‹žF×À63S#Cg ±Œ¸ÉáVFSá;ë•iÝ€=y˜M+¡í;aìÄh ÖÕÊ8‡¤Îf  ·ùÿŽ­,ºówÅÚ¶Då&7èlQÏj÷×~0q îýG=*QÃ‰+bðË)¹W'¹Ý´9i¿NC$UÛ¹¨ì_-ÁFa±ó;0õ.Ž ÉÙSSÜGh>V)Yð|­=ª"´¦D‹d3Æ)6àè¤¦H$‹=„þÂRmGs°0|#rQ¿Sš‰Ùöf>"÷chÂA£“Ldº+>,:u£Ð³?ÞqÀJ7/±å{ÚR®B»S4QÔûbm¬òªÇýR–NßÒ	¥Ó8ät¯Ý_ÜƒÊñ{V¥]oå=øhÆˆFÌuˆœE¡€Õt>Dª÷|oG›ÝÈ<ñé*°ƒc˜toàÞÁµÀÅcØ¡!}öEî¦jÈ\±boþÃ`½æB¨RPŸÙ4ðtüWÇ¸© µæo»„äãÏö`ÜÐ@ÇÌË¼l6?\ê;«¾ù·4§yj‘×p‡_
˜À5BSÿ”Â@¸’ø9Í~ÇöÊnÅ£ÖùÜ
ÒÈßªk¥NÓPÛ“ÑT7#h¤?ý“rÓ?µ!ïCÀ#ªPÎ'F„ˆß tƒ¼W†aÀò±A_bêPPãÈ¥ºp ŸßãÇL EJqU·ãÎ8@j<yäÀá·›H‰UŒ;ËÇ›Øâçù0Â}>zÌ”…+¢ºòÁÀË±ìg2«‡þá«9…ô“§¼ÁÖ°ã¥yÿîÆOv+BJÆœ¡‹þYªþ© ,È£ƒÍÊ­Åà“ñ T&¯žä²WÇƒí_O²6¦Eã}5ÌR¼ç´ð3† QªýÇbÆ(PäÏdf« û…‹Z´­õ†á9ÓâU{¢aØÏŽÞD>Â¹Z2ït\Î‘ÈMø%ÓÀ¡¨’%~ŸI'óü_ocOýE0¨ùLg¾$3=ì,¿¸_Ô+BCké„ãÄÎµ:–,j:­ eh‚H0s›»q·þù|‘À1f"NìÏƒs®„ÀOùê­ÙA?¢¾¼cë¸Í|´wH÷3I`N\Ñ¥~û(”Nó+út<XLRÛMŠÖõšŸI+‚äpJ±'3*lÙ8žk.ƒ°jÒ‘ ÜÛ)`&C¦¼¸
†y­¦6È„%•6ºC-@›ÕØµc×kŠ‡@s~»ø	'–RH$}‰ŒÕ"Ü2 MH¦ÏÚœŒ7”fšÂOG„÷;¿ê¦«Ñ0®}ó-×M][ÖÐ‚ZI[ÞˆÇ({{Õë»zq¦MWŸà^ ™WCèÊh¥…&ÚÎÞ'g>¥Õ\T³Dvv¼Õ:ƒƒ5YY¯«%ËÒ‚*Ñ&ñèóG=•Àh7¿à­ÿ@8*cíÒ¹¯ê•8Îîô€çÞIB-U²ŽÛ	§n$×^Ïh½‘à¨sQéWKC½^W‹‹¸»'ÜôÓ‘#ÃC®k!óF´(A«H0¦ÑPƒ´ìV|užQ°øÙÒú¿åo(L3Ôá¹z‰²c°sçÊGÔ
ËæÎˆ›Ïà“ƒGÁaó®g,ÝoLœŽÙ€›¶:SÍàZ˜¥‰ò†ëºïüª/2èëñÌaàšãÖÂn¯eK>IŒze¯ZªnŠÊ8|„žCÈ„/ÿRœ½áîŸéž!}ãP8›r¸ÎZ¥v?ˆ=pS©b Tñý¢ö2å¯O„ªÓÅziQ·Gªœm…,þÏN¥~›†Qñì;I;RfªäÒÅðÓIsüÜ<kHÆ[ŠžìK¿ûçL=~éTíþf/è¹1ŸíüÜÄÜ£S“¢°µœ°ˆ7ç›/JÉŸ~²ê>à¯l2e¹Ú³ÇS|û…ûK4^i½@ì÷XŒ¸Ÿ½¤ BßsÛ£—]v’OôÛB‚§uåÙðdãdD*ü!Q©¯I9ÛK$šyŽ@·ËÙ1I·3;çÍÎù”}Èþ!hmÌoQÀ W:ÕP‰XFñàà|åÿÕVÖÄk¢î8ÚõˆMëTÍ†õf
™/¦ý(êiÉP>Ùp‰MEf˜PœÏ¹e@ÌÆq¶B³ßÞ4èÎ¼~'Q®†öÑ±uÝ»ÑÉ&a¼™ä^Šø ~[M'‚ÅÙýv¹¸”äAiDl!¿ ³G%Ù‚Cç^„_|‘z3¯Ë¾(Y·¥#aöªÞ¬JZ_`ulc¦‚Ì·Õm¯p@Ú^ðW¦<_b2LÚ>ÃP°Ì@ °Ã¹)³0ÇÑÕO‚ ³´ÜÑ/\û7öÙ?x lª/ˆ¼ªÎM¶uºÍ—)G„G@HH¾áÛvª½Õiá”Ï_ø¼ük÷	W®x
}xx³!dñ¾oJÚÚC‘ÎŽGÿ2¹äcu.pBusM´oŠVŒZüCwIïs ‰–®ðº&f¾{$YÉ³.öM*]ÍŠnnˆ«@Ã¯Yeú¶W³<ZS—ü[<b¯öûý;éÌ#ØßnˆsÙjFFx–ú‚æYjÃ,s~ú›˜›ž
g¹3ojä0°A’ºhuð.¯/.úˆ›Ç“Þ14Í&»ê+ÞƒØ$X·Tp|2”²»#Jf¾k±†óÄF7Í#EæŸ÷~þÜ¡‚ FK7r;ò»€{}Ìû'ÖÁH˜*¥™WÞ¬û»aŸøàhcìsïh]P—£;´ì†ÝYxù†3î)XüÅ¢o¤ÇC‡¾w%ÐcÍºB•¸gJd­˜/²Pj×U7™7ëfð¨A›ãjÅü
C¨¯Z‚ýáS¼fc$Pã®DèÁïâ²99ŒØfer‚^üÌ.’éxˆ“©Ôßübã°Ä»ìºOÞsö5|"û@WŽŒð5ýÐÓÅŒ¿êq¬Z^¤¡(ÎÙÈ_%…ó@7dqóÞÓ;Ñ©Wç-G}=¢ÌH4£¬ªBåª—æ7‹§W£9Ÿ[_€ÌYC$Ï¥ÀßÝÔ’²¡a'hú2ñRn1WaMÊ§y½U`zIt3…ÞùË(ÅÒò–þeµ\T:w³(ºÔÐ×–E­RÖ£¢ˆÇž¢,šoÝDî [2þ(°¾+ÂHÏF˜þ‹3\d9H€™‘EÐn4üGøô×Þ\\4&ÿl*ðzÉ]‚Käwc²9HòÆŸ>³I‰®ý1O#eI`{é,b¼îÓÌ@ˆÒŸþúñ«¢=„XQ5¹EýofBœÉ‰%]\ãŸºVŠ!=ÞX¦žwP¹žOcMºì­½fïyERwt|cmòÖîswßJcú¼™¢WÎ:cÿVoŠÚ+¤ãLB˜
WSß¶|œQÒE—û;jhPñ'£wV”XöÉ4Ø¬ŽƒÕgH7¼ù™:Ècö—-ðÖ-Rú»Ã½¤7& §lÄµËªnô”%»¸yæYÓÎ|‚ü`&tìú%Œ‘°z7ïx˜1W&J¤Ýüz$.ð¹.îÍz#puƒ³‚í¯ÚˆMÌ	Ì›[jì6.o(ÍC'~{ÐôvN ¦y8¨<¨:òJ”˜)hâzLÏ¨VË4‹ß9Ö´¢s@žÑmè÷`^FÐ6˜k.L£éÏ3NJÿ­û(x&®ŽŒš y‹(2_Sk¸‚gLÆÎáG2eQíE³ÎDR6g \¼™ªeûvÄÌ"äÀ)j¶7!³T+Çö¯{Vó³ÀòŠPŸ5\[zí™E3I-*áÜ0XùÔˆ`Å4˜¶=[àúÔÙ´¼]Æ‹5òÕVÙ o¹kùk³êKÂ{©î¦Çöäk°>ö…sù¼á§W¶|Ìï?˜–Pbß‚fëÎfß½PQ²!yíGú¦»‘¢ì{ÚÿLƒr(xÝçËÔË'\XrReCÇOª	^uµ²Ü$WZwœ¸¡Ù7Ý‡vM<L¦r€Šy{Oà‚³DªÞ‹ šSqc?És¯wanÆ`ÖY'ieÚ¹ñqE]>Ðqe‚\µå¹”ÏLë`Õ2èÏþ§ƒ¶‹eÚµã¥ÜÇy¡ú(Ó½µHS?üY)#²x©²¦Õ›ã`O£›òÊýd]Ã|zûk!8¾nlð&âù´39Wöl7ÂVTÐP&n5ôË	š‡µÎl\/d±ŽVƒÞL ¯…s Ü?]q´CÈ¾²ù	ÍyÔ@%¬8ËÛ Eé¥U}I²eÙu¨Î¬ÎU‹;ÐaÝ
àF £öþ¤‡?Ü°¼wPfÏšHæÎ˜g [
ÓA4Öõ¼|Fë‰ó7è!¬ ¯f°›É×òÖA©'s*Ï­Díb~ ¼2%R'™ñ‘£è*¤s`†ÑÊýÂ*J1a·Ëç[Šô°›Ž¸LIçöOÖÆv‘6œawõp(ãý@_äá+“ðF./=ØúÉÈ¨Ëi[Öïó7ée°É¢#%ñ¬‘gJD…¯	C±Ä\ñ+¼þ¼”ÞúØ8âÅOä"Û—Œ¶(°A”{gž§õ	bö²³´<Ÿ¸Èš¸=S‚8n$ú¼ºÊklÖË:.\7;ec¡[FSáÉ{Pb5é"°9%œûê~âr¸Äüy´:.%› JxÐã÷Kd¸!\‡¶×Hß”Ò)u¾¢	õŒš˜UF|~û¼Ö}›ƒÛnÝW&âziA°Qj'˜4ÊÃxìU2å*·ð“=R>¾»GeÍ¨¨ŒšO$eêZÍy…FôÛËQ4×æ
maE¶¦Ü§k¹!ÛéÌ›niÆMfK·³paþ5T#_Áö(H¤B÷×^P?ÄR-îÔ™%1i´ ëRi®ßÎÈç*c%÷D½j'ë8YºÐÞ}Ë´Kv ƒBOØw×AHß6A‡ÝÈi¯Z¿Ò9œgÏ€{€Zê™†ƒ	8Xz N&x[ÁñbkÔ¶­”;ìxrVqì-y9ÚšyÛßƒÍ÷½pýŒ\l:Ð´ûè$g£¤¸2sÁ…+”³R÷™ýà3É_¶oûõ	KO44^ì7+L9yx‘c û:¡î‚:Ö[™–§Ô!”‹ÊqÝä3Á$lMºFî^ÔüCG­^‡}—3ÑÈ.k,ßIsh…k°UcxN
BùÅCÊ·n>-G*Ë¤(wŽ+*yüF(/©·+ (ï8®‡ðk3›¿GW<¢¹®†ÀÝÄÆâïL!Òõ\5oLì£N9Ðøç+dÕoyçIãøFéà¾7¢“Í|,ñÍÓ’»r¯ñ÷j1bÆUÅ=6e›ìÝÖ†Ð°œc‰£A´Ãò4ÉqOjÒü~qÕéÙ&
®Þ´g³È @ÅGµE‰B–¥«Ÿ—Tx#£ˆzÓ
„ý£4ÒÙ¼Pì…•W§=ÝË˜¤—Ûöcb]AåXþ‡	óÂx‰w¯&Ÿ(”¾Å­¡»ˆà>*ì^í·bÊ€¾SO4¢Û|ó×sèåŒõ¤¬†úæH9*p±N½!~	¬m(wVÚ^s  á;ˆðÎáhôÇ­Q!Á} Ÿ‡g_/úDGsÇo|Lk!°Í5 KÅç±ƒKÜaßñbW0Š²ðÖÍ²=2³Ø(üƒhÎ8ÓµEQ(XÉ­o6•T÷Æ—°e€øp€Îw+&»gÝYèø–E©‡§ýFá£Z¶Ët$†¤5Û“åLª—«\}Ê1äx}L6ö&C
õµSNŽ9¡C¾Õò†:$‚¹ƒ‡½/EûØ¶h¨.^J'#„ºÕ…ý5êcÅØË³ šö{f#kE-TW\©q•Ý!ˆE¤ö§+0lØ±,e÷gt§€&Ê0õÄ¸Â5.ZÍ)cû:”‰‡»±f\BsonÅJíU\Î ¹ÏgˆyŽ1øœˆúÄ%Z{h®ZÏC¡
!Ci¡ÐžVOãâá_	üH ì»çýÒ\`ïê6Vìò½pÞƒ »|
uÝDsÏž<fÙK×ý­‡£Iågƒ8G'ªYêPÛÐEt“—áB[ÓË—³%8ó‚Èo,1ëzIá‹ðë~¡È^,_ž,÷ÌÅ0òÀôÆ3‹ç!5xß ÖJ²ð
Ã`h’Æ	—{™º;ÒÒÿùe]G K5æ«m5Æ)ú¨æâ2¸òàªªÆ`wïM½¥®M*ÿý½ýT£XÃ2]Z7¡”ïÜY½þ™hh¤øáÖÑ<ýÇ–à=K\ï¾kN¸J¶µ¼ß×OãÖÊ`³ì§7y²Œp¾U<…6÷E#gKÁT§Ì(ûÏÛïý	gu›Ü3Uh”×OÎ…Aq8„[ ä©[;ÀÊçþiêiXíƒ&}yRÅÅÞ$Cú™Ooæ+É‚gxê?p£ïüó²™/©ReNwÃ|?}àÐw^˜ÈgªÖÝ¥Å±öûP÷+<€t ÙÖ?ÿlë›ý|‹é,'„è9‰.ÿnú€ÚIè¨Ár²²òÅ·Ê_:BûÐEÂ”m¼÷œ‘ø‘…ùúôé.ý6À"^ø‰úk8)b-bÝ´ˆÏÈñÿgœ´¤Õ <T$Ñ¡hÐ9 º¥Ç¨Tdˆ¸6"z¿ygamÐDÂÓß'Yß¯¼àtiJÁê-ñÞ§5š÷¦Ë¶ÅCZšßË¶Æ‰=}‡F„Œ€7¦a[Ÿ©fg”Â©hßcDx¸™·MÐÇ)U"´ä¯@Îj¬µå£Øïi
v5äpNrKªÔˆ’Ø;7Q‰Š•TË³oc¢cV“2µ^Å¬TÆ&.ß	Zv™Ê¼Éýœf^£1”Po=ðÙ¨ ÀS–O¡‡N&Ñqzõkå"ñîÜf,8÷¥«Îž—?´<§äÓÝ.¿~J,¿éWCˆÅnëõ“Š}èŸôËoúvb@Ñùãzú€Z¡	½X·šDŒ[ò±÷°€5>›Õõ:ÇANœ7±f‹kÕ.4ø…mÏÁ_l¹š\~ÉÝw¢|qåÜU‚¼Ûø†í‹©óòõMÀ©3÷Á6ha<¸9É†Taþ›êÀ†økæÊ4ÙÖµ«_|±8tç{9Â˜2J|Rïîw¤•õÈ®U×Ò¤ß]ss‡cÇ¦ýKÏìÑØäñ¿ý¿ú¿¹O×é+—óÏ*Ól,Ô»(gò`Xéâ„÷  „Œü»z­Ä0¹§ºë³Kwä¤?Yq¹³2_G8>"ASHTk!·ó‹›Òî9˜ð ‰²=L`ÔbC„€ê%@Ðoµ¡”©	Qöc/¹Ûé7H_À"ðWäb^HT`Èek…õ¼\^³v4
äy&GÈ¿ål‚+ÝÌÍ0€IN¿/OX/ÁûÕœ4<¾ÎSZe¨Õ	ÝÍk;i˜&D³Õóéé¬ŠÏ\¬»ƒw_àHôëÛJ4Ðïµ_ ÖEÀ¿‚…¹15ÇSùÖ	Z»É0m•ëU:r”ƒÏWº£¶^íH®I)Ù —°³fµÂY þÐúb>5@ÜÛ~Yƒ•¦7ßMÞ#·&Ê©´¶·yå[dùà þnÃg—ÇAËÈÐòÞòìIJeüío¾ì EéuÕË5z—E5úŒ	­…ÝMœíÚáUÅÊ¿ºKßyÕùi§ †§!TõqÃ =Ž@
Â¬“$%§¾<Ò9»¬Z—5_=è
?ë»øú*âq’m¢™¡¢«poÂ+Nšõa$Åô‹ÑâÇ±ñ£a™{¹·9‰$ôö²Ë!3ªv.ÉòÜƒó  iû´4Ÿ­å}r·†Ã›ZãMÑŠFÀé5«)“~çÞ€«Jß¹}º+¦u{–>]ó0¸|~_AÀbíã!J,u[lî«à¯’ùçþÍ¤LÛ½ö˜Cî“L“Y¡NZˆ Ef2èð^ô	¤ä ØºR†q/Èao‰ÓßËûŸ®lï=ø-§§±g˜}HÑ.Éž{)ÔÜbKÆÄ[!è÷ÉÛSæM&Z@0Ä=vi¡>d>)¡lÔW40  Ÿ|‰².èëÙ²ÂY¥ÄpÁÝ¾kpT
7Ôjyfì“.À‹·ú¬ÎÚ0ÿQÛIèåÌ~Î°õ+¥3µ_õeÜ›Tåô]ÔíæÑœíj¦LÅÀ\7¯ÓÌ9ç´2	Ñøxƒ šy˜¶l:hö	¾†:¹lÛ™.9U÷Ìžˆqn¸D¶Çlˆ˜Ëüûb±£¦–ün.qv¬ÕðJp×ž#ÖsˆÓ²N1|ÅA^lÛÀî<%°_ÄðŽRtô	8„Ma)ÃAžÖè‰ìî¡ç)ÓöC¼_,ÿù°,N—Íbl_±íÐ„£IÉŽ2ðE”ÔÕ×á‹¢ÏÄCuœÿ…à¯y ˜B¿Ûø0¼tgÆAèÁ<Ç©4öñïU¿ÍÎÌžd}ûIªî&n¥±?»ñÉ û6~~4FÊE"YïæªuÏ¾å ©†‘wö‡ûáûÌÓöÍq:'v8(ÿàOí*"Cÿ£×Ç?û¹Ï+à‘ªº÷Ä¶ÿXvz-Çm¿ ™ëÄˆæïÓ¹ÂO~YL„sñÃ6ÒÏ¬ÌqRØÿC›]£j}ôihy0.€¿èÎp^M‰*û\qñ#Êû–nìá‹PŸ@öóÚã u	Ô§M^41r¢ƒ‚¸½XŽ‡äjº)vsù)*l“H­Ð‚àæËŽ#—â)ñ‹¼ìVÁS0çc×3^ŸÒý‹ç’@”mËSW¼c…;sˆ=EÛ>;‚ùŒ®Æk3m•¡b¨¹Äc4qn¸þ"~ÜAöÍ"áOÅn¿ƒ’5†Ò„hgL¡òâ.W¬ÙX.ÜãD/¶½²z5Ï¼Œ‘gÇj¬ù?|„íŠ<ŠÒùU“g”sý^uÍƒzÕ§iZXïl(=ñsÏ„©q7õ+Á×³ó^‘¥ê…¶åÐâHö4å©€1GPœÃ×… Cùà8‡7a,(|ò”Z…|U›(|ã¸îàåƒîw’La€£ÉÈ‹ËZ`w[Ÿ:››dšHzäÏ.•î¤ì9¤«¨ñ‰SQMíŽQ‚EÍƒFWtµx¤\ûã¢'!Ilã¯w¶¾ÿ[äO{˜¸Æ[Hk%Ržcqá¨ÂÌ6ÜÀ…VÞø=ÊÄJ^ªy	¶4Uyì{Ø±n%+K×Š	FRóU³Ùœ¢Û°®Â»´##Úu&î·êÐ®¼is9Ç_Rmì{ž20ñUûTñg.p•ÿßpë#üøÙÙÏHœx9œ›Gi¿—€!Ç8pµ2‰ºõ•åÌS¢+ºpÿdDÊ†LèJÏo%n4„ù—œn+¾<øÓ¤ã©(D{yop]g6Ô—Í6[âòbÊ]«ÕÌn?WS}ŠwaÕsØŽ7 Ò7½;-"D€ß.)pª/ôÀh±2nÒ]ÿq4˜,MOÅ+ä¬%EZ¢Î‹ÂÞ³L'ãW­*0ßL”ôî=úÐ$ÊEZÍYZmº]ã£ô,MBÕå$WÐµwÝÙèeÎ4 ŠúŒÁmm.~CÌ@ÏÂ%½ßÄ²ëÎQªŒóƒ{ ¯u²®QÍG§F}Â—ô…D ù–bÜ‘k»¼¼Í	áL‘”¯×e³£æ~±
©K‹ãÆ×vXÌÆšF0åÝ§Ø ½êý°Ú2ë*¸6Š¨X'@xNð]ð´$[ù’¶öN	V±mb¨À6ìúÚM‚©SÂ0q/ŠOÝPn´Ÿ,<ÌÉŠXXHµzyŒW¸óÛg+ž¶ô?áJüPuKŸ'„r0BÀV„Üÿ©G±<než>ÌØbÛøwÅÝÿP®aÑO¯ÄÝâ¹‡Ô„heÆFV'*yÅ+dKÕÖÒi¼P¦ûÎü–|0Õ˜ÞT›Î# ß5ÓÂ^ænšHáË]}FR)šÔmˆºŸjŒ}™è› ¨^…ÑtŸ}ôÊ¦‰Y¼Mª\§uõZØ¢ŽáI7fÿ]LÎ€LåÚÙûJ¨›²PLñ7ŽŒö	Ã½ÑÍÎoòQk®6®­jµ‰©};²W uà‡;´u0üÁBsÔ~éJ¤izä•1V…&ÒV÷ŠL+²Ô,~¼£ˆî|ø1ßXiÜùiÅ@º\“¨5ÕÁÖ²Á‘'!íemÒ}jä7¥u:9ÏDUâ¹ãúÿœ¨&+¢m"q§=8A_#†¤HY5Si&v»ñ®’æ;—$x\©VJ®¸8³«]öeQøM·ïiôðo>È1J1­Ã€)&Ük«e§’)@å5uìz¦4§Ü*t¯®-ˆ…û.W:£ã¹Î(‡„‰Ñ×‘L9íIüC	btVçx‰ÇQÈbjÿ’Pr¡\Õ9ôîÀW®:vÑþ9.ËŽ€=²~#!”7%¦\·Ù=;'ÒÌÎµ·0ï(Îúäl­ºðá‹Çn+k0ÿÓS@J¥Î·^Î©ÂØKÇá=ÐÏ»3²É’7—An»…G
ïÃ?ù1‘6ÅŒæG³ 7ŽAÄÉ‡î¿ˆŽÕÜ¹Á¬­‹Â=	d’±Õà£¿õç§þ[¡£gjÞgj51(föîÝÀÕÏDuzò;žÞêÝ0D8‚€zÌR¼Ò åj‘ÏÇJŸ=¯;šú¹jœÔcˆ¨ÃáKÙSŒhWëÍðôs!Vj´ELÜ×,Ì”¹¯·àdÊ–h™¾FÄ=>­>BKh¦ŸÒÜYÄ{Û-ÿQ–’±žÁM$Le'¡º.O¼ »•¾«å¹"k-ðˆïbO©¿íŸ2HM&h?B]ZóŠþD°=,deVvP ¿o˜2ëá£€šøüâ |xCtN{Ø˜ Oã‹Q
–˜ð`}6™vhDL­TKçMŸïµGþëßâÇ'Mñý^4lp´(%Œ„åhRA§RD²› OH²Î§Ç>GÇ2Íhä„Ü¦º<KxŸÁžCi¸™Š:zó=Î×·¥øé ï¸	²VÄÕ*ÚëHÓ“ŠD™ ½Kû¥ 8Á©ø72ÃhÁŸl{ÁdVÔ~Tq´¨ˆTÎr-…Æô8Å÷CüÌ•bcÉtIct¬`¼.s²~.GÞD…Ô~bCóÝüê­’ê… lü;2OVêãÖã86	!Yù]qŠ´ØlŸ;Ú8QAœ˜6(—Úaw^6h¬ –èÐœ+Sðí-ÚðÜ0Q#k˜B·x—•zÇˆ® t¾”†Õú?‘Ñ Õx)hdjÂv.'ðO’6ï÷ÉÄV¿¿Ø‚ëòaWhÐãY®É£ÏÍQúo\ÉÞâ å‰;Ö`Ö@šöÂA@7
þù75¢§Z_Òö¬$¯ÖÉ¹J½çoæÛòñC1OŸ!Ç<Ùî\ò¬kšëð°«q=KÙ|‡ÿ ”_}É]¼Wx¸c Ê­,C‰¯ÿ
$JèDàåì) Ö‡'Â{mQÕÆöav³(`C´Ù$J–"úo ãD™ŠtÒÑRþÝðèÖõÕ.çîØ&ÍîÅÑæn©ÜËý`šdè`Ý¢ÚB¼XÅÉ=.ÄöÃWÝV¹æûWºM"!—ù`#µ#ïé£DS÷iêƒLæ
\&câ&îØÇõR}ÄåÖÀ×ïäí¿Ó«¹ÊÓ[õ³¼„áÒ[ìƒ'äUuŸ³gfG&žpZÐöœµñÜ,­tlÄ1wšb•§{þZ{]MÍLÔÌ‹“„Ó&˜+‚8 >ÅxS¢FOV	K¾›®Ëä\_“°>‰­,g¦-Ú‰DÇ;s9)ßWJ8‚øƒ¬ŸàzXëÄíò(x³Q‚"#2BKÒô^B5ž)=ô¿hŽú3‰^pÒb3Q`«Þc£ày,š°FÝ¸"‹ˆKlÅ³rÊ¢ù¸ëdËøkñd Ñ¿Ö©aV¶àâFƒO*z¡­“Ô‡6¨ËËÁ­Äx ƒµ•÷ºÿÄ#–Ì¯ŒãËîµ«G¿Ö¬/_±™Y Ï-B¥YÒ› ë4aG½²x-	\<7w¡Î¼DÜv¢-7ÕOážÊÁ¾®«	³Zº_ù?ž{Wöºý[hRKÝØ'Œ¢ã€YÙM ã|Èë…+¯0ýmxã¼'Ñ'u`CÔž~åYxYzCþ0öã|F#®2=ns&»çe	%×ÂÄ­…YôªŠ²Øbj´#¿4›´SJ’^êã®|%·[ÐÛ9Éë«Î3½0+„§³èB¥Û¸³Ðß4¡ÖK»xÌ“)¼<.Q¹~8Ëª»,¦×rúqUšA«ýiã#…ÔÄUÜä¸1›ÙVËˆf°ä1¡È|s-pˆ³²g2¨8íÌš`5ÞâR.ØÖ‰¶íqÙæ§Àªž-bÎ(au7­*¿¶HóæÎ.ÊºÊÚF^/L	P­f„sŸûÓ7ï?÷p:¸b‚®0òé¸<àÎ`ß=ÛcüÂ•hƒ;¨Ž²iŽÑ*CWªu‹i€}¹K½ <ªÄ&&púe3!1YÑ:lLwU‚d¸V\î½Sþ0¢±Šë‰µÇþµ"wì`ýŸZÕ'c^ÌJæù9æ·bÑ èøI]C…×w¢¢9d3P×Ã·’OÄû&ÁŒ,–J_#èL ð›¤ªÚ–ò+Ê÷eQ¥±|²–óà£ÅÎ@Äý>AÛáš•ÐûðgjûéVévªõ+Âöu›0€¸0?ú
¦§ ŒÅþ™Šæ+¢Ò½fcµi«€ }þÆë¬B”°ÀàïNPSÒ®)K”·ÈJ­GÅ)?åÈŒ3{Î.$àR¢ÒàõDñ–GÁ#„É™Y¬+9N ‡ÕU`3‚ .Ÿè¨!µY«á2KWl
Fá«Ûh%Æ¦joîA3é¼~‰±(A—·¬ÃxÚ®¹FÌâmÌÛWpãVì'PÖÔƒXA‰<\†ÂF7a¿D´WÏˆ…aÑ\ÈÍS!l|6 ³ðšMy£óT `ó#aOõ—~´Õ*6PÞÊ&pé€FÊ­rs¸± ’.m«Ë!.6ç3c¾zç¤ƒöÖõ÷:Ëþ)JAÃMÎžüÝHžÞˆî¯ 8é÷f[Ÿ×F¸ˆCÚ)ÿºÊI\XÂ~ùß·€øxCÏ×wäQ,‡r&ã19fîB•Œóµ;Ûb4w»ß!¹¨Y2½|:ˆßÄoÞéº„Ðï&J'"GØa¬ÝÌ` ìlŠWzy¹®o ãll9 “:Î17;{:xJëø{Ó”÷ÛC*‚†ÓLñ>÷
Z6hÑ²mÝšóh€PÒyÀãxˆû—¸eÅ@r¥¢áºÞ´Pû‚Æ¡|7hee=mÁ¡¨41|„Vrz‚1¡GÌÊÇ/–×à)Íuë¯\§Iz{ÑÒH¦«Ñž‚Z0é¾f"—ÚãÔa „Ÿè,pLa!«¿Þ6}œôMç·S±£}öË5I„ùË-ÿpxX¼èë}Zt"c¥æ
Ì`&#à›÷ÈtV 6rd.ä©˜Žó /Ô¦Ù×­›3y'Jc×åu«—½Ót0ùüÏÕ#h—Ÿ.	„$ªÀwp™éøEY¯òÅ4fZLvŸ'Ÿ)DøLŠpÓDÔ'£µ©!†¨êxô5ƒmñ\)…œÑ„öö½ì¸RQÈ
É\Ð¢Ã§V-ÕÐõ¢ïñø…D†´ ÎÑ…î¨&¬]½V¿:ÃBè¸ ±¸VžTXqÆGà²VÂÚo"kø>¶ä|.Á¡<Ë³ô^ï?ÏT›¿½ŒÄÌíÃ½HØéâ@ÒØbRBtÌFyãÂŠÐüÝýhb¦k`BƒCZFß˜N)Ñ5*¯böb4¢€ÃÅÍUxB[?¤Î<Hˆ£>®ŽL|É4Ñd&L™‡eåfSí0íy!&ô}ÄžMi ‰
äÏÐÇwÃIÈ)u¬Ó)W—¥ú—´daÍã'g%~ÊCuÃl¼=Ðð’UÖÂ´ý;í¹GãðRÔïd"(¡6eU6“Ós!Úñ²sÕ4“Ô1@3EÚlê`?ì» ‰Èì®ªÂgæ
ð*×.ŠIMJ‡wY‚°¡v…#±Dºr5~¡<¹îüÀWÞN÷ÒV¶ýtDQv%¼0ó1Áúðóú+[ÇÖÏÀ&¬§(Çµ‚*LªAÁ8s$"Á'ÀùˆK˜Z©@+yqzfÇïæY”+Z_ÉìŒÊÎVŽöØ[˜w|Y/ðŠSdaˆIj"5ä›wk›¥/”AÞê9œõš°gæÑáú«VrÄõ2%ˆí/Üè'´ö@@dö÷ŽÖ(G¨õ6®žbRFûæìF~§0ú1Ü,(Wÿnîå˜f`_*›½ýîUmLWn++íÇëãOÄŸ[W—{C®¬n@:¹q4^”jKóŽÀÍë ØŸkdÉŒK¦ùñV•§È[Ï•ª-•–¼I^ª«{?a{NÈGœxÉ¯c'nË5ÃàWÙóZ¨z
0v>æfñ*ìYð£v~.Š x]×|jˆ+„ßæû«Š‹ˆhJBì=,é#«%Õ;d7«MÛkFÑÂ;,ðešn¢±Ÿ ÜEœi>…f”\‡½²u„kOyx+w®3EdóXl]kþÅà¦\]ÝOgµgQ·%ù-l0;ìyù9›×]ðþlêé1Òé¡')†Ö`™‡/DH'4\~ìá0å]
@Pc°¿ÏªçøŒ‚D8/QŽÒá.ä§X –AâÂ•+Ã{H \þj`¹4Wèl§‡Õn<ÿŽÙArý7óYð¥–«årR3ï¡0­w‡IÿÑf²àŸ¤7´¾>_Kƒ« Öç½÷E‹ËrDõèìœ¹ÞÖ“×QaÎw;¬ÆL-ÙËK”ì‹uó»LAÛt¿ÊŸB-?">Ÿ‚h½¡ÜŒóÿR÷ºAúSö&U³ù%¢IÎ,šTÞmôì›ƒ’¤™ên³’Ë5ÌàÓ.vêw˜_÷é¯Î£¤†å“å‡È“"«fY—&«§ÆÛ6ôe_|ÁF8ÓÚSB	.6ðø¶«"Ó¯f›è‹×ZÈ…3OŠØ5Ì‹ƒ¥­§j²_d*›âˆd[¿».ÐÌŸnëÓbÛÀ‘ˆf<Qyž3¸bîBŸCC>î‘ÌmU–ÆC¿º	ZïØàÞ:Aú²"•î]±±³tµÔÔ]óGaèÕÌ
£ÒqÐæîá`ËWû•§ëÃ^r×oÒµóŠZÆ€¯8úav>­jP+Ÿ£ñ~No",²	éÞä|Öˆ[ÌŠº1Öñ®ú÷s‘)%`9/÷úÒ> Ùa¦¹ä¢œï‹@Q/Ûr®TšgáÈ™²j§µ[yŠôbâ„o¾Û«#	–gä‰†Ïm\Rø<èg}^Myï‘ÔC«¹‚®”…ùßµœò0Ÿ™7i%új®ü8²×”'§øn¶-ôJ8ýè‘&Ì>ÈÊ-¿³sŽæÈEÌ+ã•..qçö"|T_¡I¸ëôªÌÈîG&H{F_8rÛ–í„gkÝé-]ªPd¢­ßRÛ¹®Õp¬tfjŒFs	ƒÚžs?éžC„hZ‹\G›Ê;—ç÷nÖKÎ¢V×*ˆ“˜â„:³Ä 1G{,H²šY_:˜¾ÑÖgïwhè…mCJˆÓsÙÈ<É1îªÞ¡×Ú97°Â§Àâ’º@fhóô·¼µ%Ý§¸j¤ò¯Bš«õ#ö$Ž^`È—htÒ„Ø#êo5ºÜœÔ×öÙWqºÖ¼ª—=’;‚Ô{3µ'©••e¼œE¥(Dë}û/”ìw5äVÊL1ž×÷CÖ²‘ƒO&©DöÃ¦2ˆÈc´yžñ X®ÒAô¾±N‚úûÞ¸Âµ•5UtBÆƒ»,+Jã\ëêÒr÷dóÇCl—,´s~ÂƒÔFLÅ	—3ÂWžëb«Âž©.t´UˆäÊèQ‘sœàQÇbºÇæ¦lFdØ¬ôˆD«T×ÊOþ? %Ð/-½Ítz—›H9„òÝM~ƒ£§eš~T¡q¸Mœùš—ïMåÁ¡µ:([Í?zª%EœŸ‡×ì!^dS.™ôZ_Ÿ4,S&(	WÓã˜Vá1—q¬wrg9¢’2îïpB+¹ºaöSð®fÞéÄÃÞç¸zHðÑ»•]9ò{¿Íù;QÜR56Vü‘9'µÞŸ‹ÁèÚƒZp|EOW?ÑÌ©Å¡Çl€»Ç.SöÑS_&±wòÍt…°–^¥­eÀ/vµÌ”ÚS'@hþq;p>ÝµÅÏN…%‘¤Åäw®)6ÝLaÝ#c¸Ò(^QœÑžñ²ôýG·}³¨yÌ·§Üÿ9Jc´Í—_Y–ÀQT<~4ù†™ñ:rñÒ#>[S×;Là›¯ójh©Q÷ó¶…Œ²›ú+• ‡dÿ‘;Z]cß!ò[§¢ZÑŒ[6Š“€p¶ZFÓ3BŒE&Ø´WÏYjÖèï[Ã²°-™¿%þÅîQžäÓKÃ“¿íU}ÇÁ Ýô;›>ûâØèZP¶yA?õuíá<Båj›aQKa…¡^Á´Èû€ ‘§ûÓ6ÿù"+‡‡³¼TÂ‘âdˆþÿ1æÀš¼Âµçý¡Öñ¹9vãaV'N0 Â¶>ßûçÒÃ¬’£­|›žAãåf›k3†Jly§c¦WãáºÈÈÎ@È³Y—þ8èlè6î§Ó'­µH]9ot”â¸5L‘(Â0Që‘Å}Ï"AîÃ+ù¥U°Ž÷ÊTóèˆ½ÜAH­W¯ùØ«•A6 /ÞêT0–“Ù]íoà„Ü’$gd(â¢†×‰hðÃÛqî“A»ÁkVÇÍäázjvõ¦àWàNG¿=Å„µ±u<Qq`ý`U]_ÃêLJv!÷üÞûÆOÌ_ï¨·úéÝbÊsþ±µI›œA?¤é¬2ìÅñ€ô.@ÚÊ®§ðæÿ24@Ø^¸+›ãÇð€(„ëý:–ž^·Œ÷·Ç%w½oNl©GDo‹ÊEV/À(“ü!èL‚\™©Ö*Õñ	[€m¸Õ-ñì/Ñ¨¬MR›1Èœz ¼MË†PS”m…^¯F¢»ÜN™	0ùKý,9+ca(Bí]«Qå€ìä¿åU7ñÙ‹Í3–¢u'ÂE¬€ýÍ$å<ù¢$ª£·F€æ‰/Ì²Äÿ·ƒï¥y×ö›¢9ÒFš'®)Âó.À…\èÍ›¹Îv^ÍÜ¿†.qBP6Ñ°~>TÚ“*££ƒæ«Ù“…âÙMp&Ò|XÝã†þß¶zŸM‹¿¾n@ ól±xJ±KcI`gá²A½n`q…Ñå.$àó8)Ðú'ö"eÛ£Š gß|ÁX&?HL¬­W™Þ°gö$%l«Eh²ˆl9À¼¬½[ThVèÆ·Æ^ñ'y‡MÄÙé®Œáôé™ôqg=ý‹ì³ìüíäD†€ûø²¬†Yæ˜ÿÍ-K1d÷¶qÖ5|éò¶Çþ>$3rd„Cúv}Œ&8Q!œ]VX[|õîHÝCýöÍ«Ø€…§^·Š‘)xºÍºBbGôãöü^ýç˜‚l˜Ù'>¸ÉÅ¶~€šœV,°•ôW?J·rªÞ‹Xj^\¹èß€*ÇµØÖƒ˜<¸W„1ÇQÈ0NØ#Ò¯#¹”c°=Le™‰d-ã Åë¡W¼%m#:ÜXƒ"/x/0HMx­Ó,¿(bPbå¸Ë¬xËÄgy;ÄõÉ,)©ZOõGRazDÞ``ãc+G&QèðuN„×ÓŸ‹@þ†Ìúü eÐt6L_j 3¨ç¾ûŸ,_²rÓm½M¯‰Î£5:oHw0@ÌªÎïß¶`±21ërœƒJÎñðF”e"îx	<}´Ízn¡Ä!M«ú{ë™Î©»9á%*#ËSK 28—Î¯I4ÁÇÄì¬S¯r¿€{õfÞð¶X¦T·Wì¤Ð`¡³­"ó…*´ qç²ZÏ«Œ<%ööÖâ/yp¡Šˆ âîSo^=Êø¿ÅÓÄù»&D_³œBÆ[.fkR_,0Óè³°ÚŽ©H£#Ú¶ž§{ºÃ”(çû‚1qƒ(kÒøMÂÒlîgóƒùè×ö_:“°XŸHe)y`X±c5!ž:¸[Äün4›÷»f¶°Ü–­…3'¼§:vG/"²kÁr@|ceíh}Ò‰/²>m=ži¼ß9¡XÓ1ÿä©Ë[k´;'í%’Õ³{‰?YË€ô3¼•ÜÐ÷*SD…^AÃ-0y™ž ÿ„´É®´·|<@g‰‘Ü+Gä{j÷foaã?žžŸ?KÏ²˜ž{ï<z /ÒÉp}©^ž
ˆ™êš¿õ#‰o³Ë¿¿;³øA
V»OÀÁ+L{æÐdO3 HšÍÈÝGEhÝr&;{H­hÃâÉ?6Ÿ¼YÄ¨‰±i±mw–s˜Ó4·Ñú‡§ÚtbgßíàíbqH…ÅS²´	}ýš-{`Dž³¡!å¶·ÂÉ¸°Ú® t×ÊXêÓæ[¨O´úµÜ¤Bü—îH¦ ¢w5P”âz®ÒÔƒÓ‚½E}ä—B{äÖævÈÂ"5íŒ=G³³ù¶ùñÈEÂžÅ–¼sçCÍþ‘dP/q´ÞÕ±ßÞGy*—›]/xÈ¶ˆ ¯nü‘¾QšÜ ÎÔÐÒ_¦|TmÐzÞÛaþS•]åö:†>²…Åfð›KqK6ë::!Â ´ë¢B–Þ)LqO=ÿómlÂåùÙë¹÷±_Øjëd}›¥ÓæB};åRì>»Xt64#ªpbc6·9ŽjnXr?Œ^»=ò™sØä½o7m¾ÐüÉ1õÝíò®J?B.™Ž}reÅÙ»
Ýõ‰KhsÅÓ¯Ÿm49äÖ<"p¶ÕÄ/(+ëYúã¸by¸5Ø`[q×ê÷¾‹y²÷Œ÷)nÃK«55öª!Q’7M…N[›Ÿ£uÃ'-¦åwTÂ[È†Á[P·ŠvQìËâ•v`ÏÞ½ú‚‡7¸“=2 Öj/ž ÇÉÅ7²œcbBj,y¦Ý }ö×3£kùnlŒ¬Å±]¾T1óÚa`yÍ(Û7k›ýßî†vòò7„–CÄ²"=6ÙGÆföLÉÓÊoœ´¶l‹Öt-U^Àiü[~¥Žx‰>II1ü£yÿÍ1X
òºåÈ¥ZÆixÀOäÚÂô¡š¤£'qÙÍÆÑžéèdT-4"˜°f–Äâ
Ôýâi—ˆæÜÆ ð€,Çâ>÷,ÄaF™ƒMA*áŽ±eËq=_¾’GvÖ3±E
öÍQæ…ÖÜ÷îs—Ö¸xÚZöšªjÍ®;	‡ásÈ£¸M!(žó®K áJ2£xÈaÜ:È‡Jé,XiÂbŠPïÂ°^DÙf2¦.Ï6ò’'„lÏjl6P?ÎRAŽz-ëòçýàŽ[Ã_ý"¼þÇ“]Ë6ë«£¼91:ÿ¡l§£/oiÂˆ¡Ô‡¶ûjÙæ 68›Út”L‰¬ÚŠæµ·*€·øÍÅÕ¡_^ºë9²­X·7ý!›€Û`þd'|.²,`ãçï«H|ª/f<r4ÊnO`l±U©ÝÓr²Ô‹°s¤ÁÍ}Øžãà+?KŸºm—ýûy’`É½àAÂ¥“òÂÃ%2R]ÃI0Ì5é³ªÃ }&.õ7÷»3êÞžGrSÁU3HµÒðÕ+~¦ŠûˆÂÂI»Sž"(@:¯K	Å_#½EìfCrõˆ9?é„‹ŒŽÜ[‡kyÝ*=¡9Nô,†{$’ää³Ìã"W7±¸#wÏtØ³«$_:éQ1( àg¨+ä5\ìD¢1D<{î5x5Z(Ý¯ŸfùB±¨˜ez~¡¯j±•\¸H6wõ¾p1ŽI„Î´±/+'5ÝFCyàá ×™	2®yÏâ§ÖP]—:•ºU9å_‹N¥·ãÁ¯÷šŠß8-a’¼4ÝF\¨è‹éù>ÍöÁ˜46—	ÐaîÂrsHb³×²ëe8¼­k¢Í‡òüŒ˜ƒ¿{A%Ó¥a:‚ÉÕëÕS!ËÆêŒ Îïc…f önCØÚT„¦ƒzœ0ÝI½M}±–<µ~ìFsÔè¯Ôg§®ÎÚ%¶ñ0ÐÅ‡+@Üï˜zET&æ5§Ï\÷ÞáßDÄ1ü¶ý)ˆöêøhIî6F¯šÿŒàÍˆÀžüˆR,{4P—ó¤Æˆ‡|ž¡¥ADfT_³
Vçäø1Ò¿±¡„¹](z¾•ƒ½mW7FBa‹Q½˜ÎžqGyv$’÷.œ* g,a¸!£HT£Á*-‘µè5*W*ö.¨ôä‰HÙÚüŸä(È0vÑ»ŒLeãÙ·¼õö1ôHÛ—ÆÂš•Ûp‚‰xI–v%@„—C3œppyä›®›£Ä—ø¨‰v‘Íçt&ù4Ï°iw©#âþy‘zÄo]äIÐB´J“>ãA+$€/;3ÍùÃö¥µ“ØlŽÝg`È>ˆ&ðð8Î2ø‡©Ývx%_KÍä${<Ðb§@²ªé“R}&Z¹òp3tËÇ½oåƒÆHIÅæ™}+h
T`ß÷ãñs;/#YDƒ·ßl‚Ë†ßzZ‘¬Î$ÃÞ},ÓÛnùg¨&¤DÊ¡MøÈGé}l–ÐšBcñ•äÖ¿sg÷AV=£«$~³)ï)t¤'Õ.Ž?•^n!Ïeúh‚#Xg¦\É:½ä½±Ù¦‹'9¼èû^í{·†Â]­œ¢ðÆ§Æ[úÌH†¯îY]¶ë‰aá‹~[¥žÒ^ æÕ- êèÆÆó+;+Þñ›Oúßb8sjŽ;ÿM¡øÆ§ý0 D9$±g©÷ñ$Êây9ûŽïìò‘¡3WóÌEzË5½?ÄšÓéŠ›¹´oLòK2lÜò©U,î<( J¿‘;2Ò„À—3	’Qxx¯Á’3›VÇ	í–µÍ°^˜Ì¡w\goÜÃ|`úõŽ(ºÉ9—Â_
.qOJä=a]÷¶7OSÙbôµçº¢Ô/»:bg:ÁV•!…pŸoŒÞPa/º_t>çÞC“sO±'ºl?îŸ±&ù@I«~kOTš‚
É´àUª¥‹ ˆ¥™=ÄÑyÉ´tÄT¼Qàìå°[èiïŠMeá÷€:Š<81í9â0ÕÍ`e	¬®bÕ2ém}«B_lGqòC;ˆ1˜ï«@ äOë¦ë„ïôÓ3_NÏ/š±­3°Zuþü»=Ìü•™ƒü–_×¡Y4yzTfˆ\eha£,ÙcýŸ{9R­ž½Í¾Ñ~Šqú¯¸U&Ë¨3üææ&ø_ÆÜtðUûSðSÔ žèÑŽÎî)»>]×­ºó¤ÁŽð1Ú~)ŠHE@l8í¡éÑýë?Sõž…PãÈ1[à!ïÑûèlÁü¯êŠ7s93^õ”vÉE„÷Ÿ±þŠúlìé.4whÌ].ufiŒ»pó3R\ð<˜ tí\àÙ¿¯“¦1~ÖwC
:ñxe?ŠaÇtÎÙNá¿FËŽ8ø½ý ª¦QÆžjS‡® ‘/)>ÅÈ¯ˆ0Ä yï¦¦V.¯oF0C¥PµWcž˜õ´9ëTpïJQ:I5
O4ÉÇ’wþ¹Þ
 Tû‰Ü#·ßÌ¼¦ÿŸ½¤ê=Yµz¶}—T9[‰k©=wŒÈ‰î¨?ÏC=mÝGÎFÁÐ´ŽâVü½(¢Bî¼Jçt ù)9$0Ó)!-g,–À8æÃ½äÑÛCÒÄ¸¨>M%‘î_ èMty®qàÕÎ]bƒvß’‡d¢áV ybU35‡Úÿ(%_DW 7Å$h]E'k1ˆ?êÞ€ê˜ñá™ÕË‚A¡ìâØ‰m‚ ¥YŒeÇ’ÇôOûnÀtl÷È‚&y€Èªk—T ž¹àŠñËŸ?•Ìî;Ù,¶QÜ,†ÐÜ%1}šýÂxW·ýb^ù¿à®v!œ«ª âëÉàœÚÌû;Dïƒ–*Í`¾ìZC¡Øf‹8¯áš‚qÒó_ÐàŠ/O­‡’Y•æ{az#Uíþ‚åŒ*åûˆévõÚ*ß ÈéÇšê{‡Öý’AHƒ
cÜ ”{NÔÑfÎ»³—A$Øâ¿¥Ä8˜¾3›öÏwø¨•Ty”iQ03	Xà9pµs¬Vƒ¨k´÷ªì¶™;Êx`dèî×°GôÁøvšn"ÇT{Má"‹1ÃgÆ}–Mzt»ìØÚ|·H_÷^Ìh¡–±ÌÊÑaCGIÅÃ„´´Ç¬æYà0’VâR¼=ÂçÂQ÷:À$+Ä`5eÂÚqë¯0[{i…µ/šú~cþä
Ò¬dÂˆ‰X¥ùÌÄ+Y$ÍNÚgNà	'0á—ü‚öuÏ^þÂ<qäçœ£(#ˆ èy=Â<{Âì	Ç/°MH*,‚€YË&7BçRAÈš:ì /‘G‹w-ÃÚía‰½ò~ oOm¦H7+r7-cþ¶¡Ž
å¬W´aÚÏmqÀGÃ½¦9u‘§†Ù|Öšâj¾ä^7Ý)éúÚª;-¥Ÿ_é±¼[FÇï£l`ý9¦
z›Šš©CœÝ[ß]¸u«e2ÔU,ÌÒ±<LØ†ÝJuèe86°è¸èMdD%è•PËÒõ,i«ÂjñáÇÎ w#G1ö¢-ñFŸ¸Ü_à[·wh¹§%Ñ8¦‰.×e´œµ«ð‚*b„C­û?õO©ÓâHÃLTÔ´}Éôý=0‡}¯zÉØAÂj¶kŽ@âå"){>$ø²í$ÃRsw~ô’i… Fâ0¥*iCj‚û:WÆÕ{ÏV-÷—@¦~Ú9¥ÇWðeyŠ.éwôêi™Ì³–ŒmnY%¬(DQF¾fÞïu ™Ë±ÇûÊ‡M€èjð½®¬n¹„lŠˆÖìÃšØÕ·0¬‘b—ƒÄÉËuÃ2õ$ØÉúR””«~¾Rß–_è”–ò}~u´ gÚ"sýáN?,¿J@¤%dVqMÏCÐ‰ìëWrÈÓ"í+‚1IõøQìu
]ä´ú¤…}ì™šÍ(´\xÔí—Btcû?Gj"@`^²¶!þ)ÅÞØ=zˆŠ•äÁá9Â£†t°W¾Æ™àÃä ØÊ¤k"@É ïqr!*f ª£<©öJ7è†Ò¬óõ\Ák˜^tXìF‘©Çoá -kÊÙÄgÝ°=ˆbk­Ò ¾_+
|ÖÃ$ô­ùÐD:¸êâ¡%;×¾0| ìÃXÚzyEi{ZbŸ0Ø5Æ©oJX%RÆËF+úºúÆœÖ»ñg£ª—oeeãÐ½ÛyÌ×9o\¬CŠ¸ªûú®“Ä(ÿî:RóWÂ©ïè Êké`ºrË:1@–ä6BM&èn½½FÄ»±?r¦‰; 9ÞûAo~Ó¨µÉ 
…œ©ë¥ƒqN¤€û³x´×Çè‡˜1‹-6i«Mÿcü ŠÔ: ô²»àr~ïý7ñ˜^¾§ •C§U³îõ6Ûÿšœ" ZˆxÖ·;HÜ•FÔv+¬×É’èøp¾
±[m?c	 >Eé2ua¦îŠ™|=kz‚ù.äÃ­}²rZŠÕèk=œ»œvØvôL“çÎÓÆy÷n¯,V"n¶ôkj†€¬Kvõô§ó€ø]{Z8X¨±¡‹Œ1*“Î‘öžP6:ì}DvmÀ½´¬&ÌîN°b,¨…ààºtsqñÑ*ì):%ˆ¨× ¢OTÙK€¸€#+QüBJŒvOf,ÉêÞr}/üu]Ü²$~6=õ•šªÃŸM>×ÿ2Õ×pügùfC	“iÒcfìâ€îÔVN2ÏG ·äšx*ÿqàOöŒ= Ò€]ºyù	Æx	üQvJyÃ~*
ÞÓË!‹þžçP™“Iìsâ/kÎóÌÝ'‹æZÝÎÖ•NÙå6½æ™¦Ó©ÅÞÀóµ:0ºòÜÍ=ZÕ,OŸ·ò$©L}/.¤j·G	&– ½2•¤àw€½Ø4©Mµn"ªu0± Z°>¯Ahî`UŒe¥5‹¬†zWW(Œþ g5—#„ù.ü\‰=:ÎÖÙø<ÃÈ=Â³ÓÂ°W	2Ó^sâ^­åmOzjŠ_#ä—ú½£$Øj„"’D¯5Höê›îòDO1¼|»qä†û{*fÅQí@*6CÓÎÈ9Æ\üñ›3ñ’bË¼ÄÔêõøì\Ä_Ã\“¨.ÃÎØð¦¾†4æGŸCìÍ~úæ¨š„)	Q¬t3‹~ÓÅé‡YÁr‹XRAÔÅ‚pR­q¬}iÜ%»/ûÇWUj•¡mº PQŽŸV5ŒumŽžî@tÒŸUiê 0Š×	Eueˆ¬èdÊµ`.@y<:îëáû˜0Ñ@'qÁô¡§Ð>‹ù]@‰7÷—nì“jªô]Ø|<ïÂÙ’•»#‘¸ÅCC½ÍCDuØ$Lš*y9eÖý£H™› šå‡ºO¦)÷é€*]œWI‘k*ÓA´fÜ|%ÑöƒÎM%®Ù³ð´K^‹FíØ)ásëf°a]6šÏ”Rä@‡y‰®ŽœlúÊe,ÌÕ™Ù)çÝPÿLÁo$-}³äÈñœU’‹Ã!i€÷,m1K"œ*]‰	$ÖUÀ@Õ*m@fÖ¦“¨Ô¾«yÄ³Ëˆ;®¾6‘‹Á`ë-±>ì|ZèäHÒDøéƒ´[~Ë–¤@:o•Ðs0êûÂ;]ZÙv9ÅéeÃØuB»}–}ïe1èp¬¨œ
ë-RÉDf5)¼gÁº+P´"fâæº$W ™ÚôõKê9u¥’€¥h»Ú#!Ñ{1XæJL6ggéöUtCy_N–”¼àÒ/V÷á*U"èöŽ÷à	Çý¶úé ·‡ä!Ù¾ûÝbEé
$Õê[úÃUas(›hçT¨¦—Æ)Ó¹#õ`‡ËR iŠÕ*¶&³RoŽ’?|¡÷1^„f¢0ÄòéÿãepV1$ƒª]Š“ò†ä1*‘¡¶ÑhUJ +õÕhÂízŸF.ìÖ‡óVã|mùÈô¿lº%Òh<kaHë~`3§úŠ©¹²¸U¨cLRƒ3Œèû°ƒu¢ØØ¥÷¦cW‚P÷oV¿]FqÕ-æ*XBtŸ‰ÇÐ8£CÑ»{û`â	&]šöï{P¢töSpÈM±‘@Ý¤3Æ-)c§ßt2O£³oˆÆ³GQo¡XÍÊe«Á¬>‚túÈv0­ÑYÕØ‰‹ó:žçÐ“/É5Ò†åþü&€/æNBçz%sNAßMu”t@ ~JÌ›ü+¢ï„S±l2ÉäÚ‚OŠ&=î\ödKh®å4Ú=L©bI,Ž` é.*AÛ­­5DYyÌJh7 l](„FÏXVk)#£¼þq×ô‹v%(½ô)+ú6·g9ãš4s~¥’¨*¶wQn¨IIƒ]ëx<È,_{	ÒÛÃ·.q2è;08ûš'§êh!*€"Aì±BkÆçVÓÀEï>$\Z/¶Ç®¢³Oá@_NË`jŠû
„Ç©}«Œñ¶¾éMìYIÿŒs&¢l­èéÞòý¬¶¤|ÆW$	âÊ+ŸR V-–1&*+0j"‚,ãuDéE‘‡l§>MWÃÎ`‚¸XG wìýè
••‚ãÝ£Ì… øI±¡Êëºú©¬	U}z2ç`ñ¤qWCh–|²4Ì;q¬'¯ˆ²Óuþš#ö“z¹~'KPáÿC“Ùö2˜´BžH#ôk mÑ,bîcPÁÐÍîBÒ§Ð¶à³ðßä©Îß+ˆÁ¸h¤<Í’ŽîM·Hª•·“©à\Vhpwºç\¯x²§xç¶J'#3"j¿%´¡ôÝÕƒÚy–F®~{žÕ/ÏHœcNÛ­¸ðh1öŸ%ÕÈjji=_ÆÈ[•<´ÀrýªfyÃÑZ­Ã UÛÄ¿i%5'Aßl¡¦¬L=/ÝïÅÆ5/óki¡Æ¤˜W5È†«®6…Ä‘Eiz"cõî†ãZº©Åâ±èœ¥ÁÏÈ®=Å½9æw{!pê3þÔˆÊa‘õAK¯VS¬‡Àm-Fz$_cŸ Z¦a+ù`7™Ž(Yzrxf'nâÍ‚§a-À†‚”dVìÀÁlÁH	Ú•ÊhrAW–ÝW—±Ñì®é§Å9T³Ø$:S½S‡‰PT—óqe¡2X/Æ2Äo”$~ŽQP“7CK·ñf=WiåÞSò£ Áþâò+_y”eÙf…ï8`ÝLî‘œ>Žõf};	c]G–)ÀÕOCîX= vÑgx1&<¹ÕÊâZyv/äÜÕ~Wh@»€e9¿ÿÉ²&©›W:Í™É¦Å«-^Ü€òïýQ Ùá­qØ¡¢ˆ¡Ê.n:åÉËO)ºØò:ÄoälI+œxñZ/Ôm¯NmtÚX%I2‰ð^Ú`ÏÆjM-6ÙVG—¢§ñ5zÂ™ÔÒöjvuÚ¿P8DW¦YÇŸµ· †Í¼Ô÷êQ}£@ÙÛ;Ôâ(Ø3}ãÞÐ‡¤2œïïIï|qt)ãRÛ:¢*+·;ñ‹îo€dO°Ðñpæ·•±=ËÕFfÛÏGªwC¢÷)„
%kù²àgÃ×hûØíÙ ÆûßicE&×þØÉ¨lªš¾ÞŽ`cE„²™±Œ±=ìà'.³qê5æJ®NòbÇOJ,Ÿ0N!Þl¥âR+€3íJœ`¦§½ÊÞSÈƒ£ºÄ¸ö\ËÒCfxØ¯òÏ™g)9.ú‘!oÄÞB±ä<¹š£Ql‡5Pã«Þ4s‚N”ohü9þ>b™öxv-¡•è3²Ä©Í§ì^jrz†³hó±!™5ØÓ!gi´>­vŽî»¯Jx[ÙJ±W™­G¼ÇNÁP'Õ¨õ¿^Íw“ ß©üiîTlNŒh {iH5·2xÉ³ô—Á¶$›}±am§6Î°Û¹˜ßãÏ³Ò¿·ƒBˆ2ÂOzETÄéÌÃòƒÑª¸Â‚w0Xà3à@ŽU†<.ÈÞ¸!ýGUG‚ãxyi^óÂØBê,Þžñ Brœ9"J‹ŸÃ0Q….K€w™dÂ]$¯U×¬Î¯/¨5@ÿé–¿¥o—¨ãÓT±ÆÑ4¦aix1úYZÇwùÞO7‰â÷¹/ñÛ5Ù€D‹ÿØI4ºã^DŒ"õP8bÀññ`Šïˆ2i‰²ÇRˆÍ’µöÔ˜4GùÙÂÓ¯$gwKiÈaß‘Ý¿Â¾åH¶ËÕþe…ß©’n»âÇH[Hð—·gôÖTúð=K±Û7\÷ðÇêp1Kûoa>WéÒé«d­n)HrþtqÄ°~+ÕÆ]-ë×ahü'¨n"×ô)I i.áRý×_¬ôöÀK¿Ã«I£<¶±´7ø`?I"TvCMŒÚ¬–äÄ8OA°¯A4,_U{Ò=4Ûs= AÌW‚ NLaÖà Û›ý¬çzÆzêŒÚGVœÒî“É q¬<œÑ&ñ	êZŸ5 ÃPX,cv,êáJÚ×W6iÇš
6žQßæèwÌÍGí)¬™-‹ þÃš‹äA»k[¼¢ÿ"Ÿè¦±¹`?ñ"W²¬ZÙ˜óHÚj\±‘'Á+ü8—l0ÙºÊäö­“«T»•4"ê1¿¹ÍÙÖo<x‘™wæ„Š*ž.ÿÃ;fãSœå¥z¨HiéH’³Ð¨%ç„=0Í‚^"¼xDŽ?ìnG¢bB”c²‹xk¦FSÇ»Ê3E@OàÛ3H7zOy5jØïûTª²wÌÎWï‚žâ‰yfgÞ^kÑ}§z|5€=KÏ!¨6‚c®µËd=d=ÊH‰¬OÓÕ=•ªö»›4/‡êfxcw‚”_­ÓÖƒÆ3³r(ù†iRÂ˜Ä½FlÌœ©ó¯z©Ã@ {4GL#Ñ«Q±Ê‘µÂÎ0½ J^3p¿¼t¬ü˜¾÷¦cõ~†ÔU\{¡ÍÛèÐåfÇæ^É§Cµ©]VÿäT¹šö2V!Pø)ìˆkÇ²Øì“Øÿç½JUñ*ç»(µ	áj÷=}ÍÖ|Ûú)÷þ´(yžÞ¦šuÛÝi/šÃ†Äƒí^p7á÷I÷ÝÝ"ç~Ót\|amüòÝÚãêÁ›ï(qPµ39ë[ˆ» }Ð³¬œdd#&µb8¨2Zóô#_ñ …Å…ZÆ”ü¯L¦å8Ì=É“Ð+wŽ1ì1
†çbŒYƒîí»`~©´¬ÌÔæ£ÒbqÆ´ÎQÐð1¢/ïGô/¯äÐO¤N´@f$~á†íaÒYÑZŒAì?=•Öa¡Ëd‹Çæ»¡Óã„:æFÇ‘7yK˜îlá*šW#{(4âúi;ùû>¶3C{tà›«ÔÜªºd[€•«c+}÷ ã`ÐgØºÀ—S0àç“s
2ý‰¶šù“0¾?'á—ÞOÛâ×‰ÆOkp·Lê³÷ï€N9™e¯¤‡áœ/fQ
àãó|˜î„Û†Ã[æû	ué½œL‹â‘JÐ‰ì¾”‚) rä«â½¬€$Ræ7¨2‡ñÙ¬™l_v–]:¤zÅ1;Ù\­ÃQhì¸îõ÷8b÷^†¯
P â·NÿÛóŠQlè>iÇ¨¨Ÿ.7ÞÓÈÕv ‰•}`‰Ë ‹Ý.šÉœÕ™÷hÙ”e>ŒÎ¤ð$quy°‹ÉäòEˆJk O½¼6hî.og:„€ô4Žï¯öÌé¡~sÃšWgK¿ø¨üXÊ`Óý’Üûà8HWÅW´ÔŠYÉ	
o® Ž Ä½†WÌ„*|Ø*ãâ`™ßÛ
)LNx¬¶QßeY÷S‚ØYõ«bÊüÙ /ŸÉá©<êä÷7$›!DÏÜ©s’<šbŽgmÍÍ3E´ÅŒŽïÏDd¨ÒJ&•Òñ¾Å§Kâ´ç¼SÊÃêÃçHi´ðâ®¾Úpr­ižåcß­ªQÁ„¦-÷ª­í#$‹$æä$Ýíï]O}½u¸Y½¿Y
<E£y±CÚºBßRç">Óðä˜»ôÇîi“Aÿ€)À•Ðuù²§Ó^E©ë~–P9‚~à6Š+c!ËZ/Ëá±iOH¹k“ºh&†y$œ$`SqŽ—,j‡²fÜëieí]À"?ìüü.e³q!í±Œ€±ùÐ&ú[Î!¸Êä–²Ø7ªQÝ+nÉ˜‹™R„	7ab'4ßæ)ÿ„ê«TULýów]§ŽG¿Uý$-€=ãúIvãýÍðIµŠOãv:“›‘‚ì‘ò»˜È\Ì¿|ÁzRôÑÔÞ¸Ñ÷°&8ßG¦çû‘å@Ý5ZõÙazßs‡àŸ¤Z‹ˆ§òÿãXìõÕù qAÙ^Yoá``UkÂŒ|Ûl“%ËƒóµðÖ†
Í1H©Øs·ö¨"²X‹ÒÙùýªç23QÈï£Õ‹Ê0-­ëèö@7=V }|ºcš1äwó¤Ü/Yí6îu[Ó– õÕoe™iÍ«N£e/[¿Á³¹ìU3&ÆþŽäX]±£ôÈƒò…Ê0L®G¿Ñ	á÷Ðªãè*3¦Ü³/ [)}œ‡zVËÙ/‡„[pØ2Û‡Vét‹†õÿ|L5ï+[èÚñ{¯”ú'eÏ¶[É]ö‡xPÄ:OÕPMQ€R;§á²Ð£„°/B€ÚÖŸÏMîæò®ìG ›qƒ¶¤nÕó?ŽÆ:è½Ý:œy~YOv‡axí|ŠêzOì˜m1bZpW%C£âRz÷n3Ï£	1ª‰=’eÂ†esž3‰:†³ãE~Ú£nm~KYÂ;ä§ò{Ü>¡Î@ê©XîwL€Ö`¬šÚE“(1o­ÜVÁ'Aµí1ç.ÍøË5„Ðnú…vøÔ Ê—m¯¥ ¢ÜéQ°˜Gã›ƒl–\QAÕûaŽÅ¥î§ºtÓœˆžTçÐlàÿÕŽó%-¶K/}ç¨ü.$!ù•nÄ˜`ÒÛ!jtû"ƒzl«(_óõ›ˆ×íLžWÕDÒn²4`©
•×ôD(ô)Þ*†”{ÍV_•F@á¸\ëRp¦á`ì+GÜq6‚øpˆ#öB7á£qˆtÔ·DÎÂuä!‹-nêð²\ê	r6ÈN$èßéW¤Ò/"?øxÜX-PáU~_¡’«øbIÃŒnn‚Q½åTØ3kz–y6îzaÕÈvøû‡&a5‰– 5KXˆ|=ÀMñðÑ,e½‚Æ“pq~¹Ü¯'w¾øL5à¢adØl TµFø·ÍDì„}nf*ñ¦–ùýYìEžæÞf,™å×S0éWÍÆÉÝØUô~;CíÌ§ +:öHÃ¹S3NšŽ‹b…A~sâ¤Àjü™º»ÎAmRÜ7„ÉÚ2L©`çUÊüÜâ¸úÙÇÀÃ©	ZÑÇã¥ì¯Ñ|[±uŒÅðÇÞ#z@
ú\T8ú¡*Á	C(žP‡¦ð–
î=V’Ë$Ø¶…Cx±ÐÆ†§ÇR\ÃŸb£¹íÃSƒ6Q=I­ë‡‰Û¹q]IÄm²\ˆî¶ÕPwRïEC8WM=Ê±¶m‰”e7ù	6H¾nŽ¸v…ñgžû‘“I¡<Ó/ò,+óÊæ¹ùÊ!{Õ;óŽ!MdÏ!Àe=RýÄ¢Ó(xÀ»6:fm Á(5ŽOÈ.òOÙ¸ª8uÌÞÂoûý’4å½R–.z;õðœ+§ºPJX.íŽ&½¢“ëk IïžRåàÇ_ýUölë”&‰ÂÞþ•ÍW¢„fÍõÅœZRê„ËÌñË‡2—bº5iä"@ß²mP™l´çÏÿB8ù®€Ç±ï¢³Ô¨Ûù·6¿ôæS1]\¯×EëµþvÎp®Gz9ÀäîN†Ê{AÿÀ­z‚”‡rïphâN+~«·Èœ‘ø$âÎ<JNE˜ ^Ù’?Îéž­T}ë…wÐRW¢ÇÆ¡¸ûu, ì/Îu¼éÚÛè".·÷Šõ“hK1±ì•zµtcƒ”KÖý÷wXòb&žÂ„\?øù!ÌðtuZ½A>¥Ç—QÛ6šêfDh…Óš¿e~ªGŽ^¦ÐX÷¥Ÿ ø_q±hC¸Âê§®	zj‹}ö¬¯Flú=qy‹$;ËÒöN,¿™ëc™ñôá¹h¯ˆ&; œ¤LÃ
ó/MA©³Á¸÷ÑypÕ¸{“MmškÚÁûê°Ñ|æHÒå‘‚çøUþ.ãÓå‹~¢H4å,ZYåoÖêšû¬Èœ³óœ‹¹jKuyÓ^¶
Ò*„D!ö‹/O®oª»çáåàOªÖÍHûðR[šßýþÐn~	O³µ8q£ch‹.¿—3Ò×ãðÒ®ïŠŒ•G4Æ¦Õ9Žƒ.ñN"_EH%j)\g=õäS]Ìù,ÙÛÒtºO]¿_Yv˜:RüŸ`‚¶ƒ‹¹yãšÇ5C3Xï!\‡ûx@9^ðL"îî³§N)Qp|ReXJ„²eðA—vã—}áÑ=;e &Óîï°ÓÜÒ°…H²ª¡E¥ñs¡Ö5üq=û}±wìÉNÇšÇ‡„xá›ÿEÂš‰è¥jžÕÙ?Î*pžû´Ò¤¦§¯³¤Òa’ |³Q{Q©›1\!Ò¿³{y/@vO¾#LužMóûc£Ú¯!ÙW²{js‰+e+œ~³`Hwœçýç…­²@Ž˜Kuƒ²)B1 Â ’ÞCÕ-à¸‰Ÿû\‘¨†ÅÖ!ÂrvÄý°wÌ°n´õd<ü·Gt,>MTþup#¥™‰C°£Àì¥Ñ¬HqGÑž©@îØ|‡ìÆg¦R6w«Ìí	é-h¾K.žP!ˆ*œ·-7´Hr$2¡›q-ÎYa¶¤ˆw|L.äÓŠ1Ïæ§òƒZ¯¸qGm3ZOiKkìnt1@SÙ=™ÞMÀÆ	®¯y¸Wd¤)	•ÝL‡¾Ú¾³=á@P’üS7%¼‚ðV¤»ÍäÀ=ÁpžNr6/Ðø—èMš!hÏi3ÀjaM †•©ôÚ9áÓ¥yu·¹fˆã‚IóÂØ ð?G²>µGº	+„’ÏfY¿gPßÜÚ×¶BDÅ}¼V’¨»"Ç&-y”‚›DLbkÑZ²,tnFõ¦©3làDó«ºub"IbZæìz`¦þÒ…žäb)	|ž<,%§oPG;_K-Ùçwa¤ý‘àxòCë~à‹¿Â)EšHÄIêGf‘<Æu±[Éñ*Q/g'‹ûßß[âÊ`Õg{`¥±Ãa¾ž…Ò¡s SZÙjŸñÊ…éÚê;×Ü?@šÛ(¸9ÓŽ,‹ó¤A¶@PyJ´.–Ò@Paok)$¦¿ŒòõCâ²Ÿ×0Š«_YÒU[ÿý;¢¦]\c×©È.;Q:;]Æ%&>›€õ…`Qx;ž
Ë g¯xzš§ÑAÿºòu]5\±¸Án Ë¾Ô°ÎY‘ƒ}m2‹}ì´—¦b_ï²y’0H$a'›Ú!™æÿÉ{:ü¾èÑÅ*VR| ¹òœeYQÄÃ0$ÅãnféX(+›‚QòãƒÑ9šn«õãGžÃ4Inè'}ù$³ÀüÆ~œÁ?(<…fÓš¢â]Úª(à”+Ó4G|e”òà^y±`K#+Ú/½µÇÅÊÚeÀ¹|O·«Þ€1#](¤œR@PBÚu6Š9ß€|äºýÌÀàÓ£³|;N—ˆ•7fª/_š¥üKÂ'Ù7‡œ
½.`$L€ïß¢í³–™_“Aó¡?OdaÍp./M.Xôäº‡4È¸·k&OXqKÆ/óD{É'Êê}z’0ìë§!EOÞªºxLéÏ¯¤Ø–:x6GòÁÈS–S/Æ‘bu(_,ìmÜ­úlªžŠ”«êÈ¶Ì ¦
ð6à«×B9€=¦ì&’¶vMP  TõÁü•W(ˆàÁ„]zúÉ5%Ã(‘jP6M* 4*)<‚ý•“S`‹©ÞRr‡Iñ\#œŒ¢„	?¨Zn”\´0#K&g‚‚bWS0D0Ø¦•„ÏÐxƒMsN'¬·Ze8c.]Ò´iž §a‘QÌx2ÃðŽÂôƒó† §k¦§©°èà†/v²è¸k_.zO(È+IÉ"Æ:dÙòØÅ- ¯Ii‘a£ÖH×F7Ý¬cÁzàr¾j9‡e‡?Ÿ!;ð(oÃÈ>ü ™
ÅWª‰`^þaõª†©n&Jô?›7zxP	Œ¾øÀ^ÖÔ9uØ&0mY- ±OBçÅŸ(®‹ÒmæY‡âLãNGÓR÷FqÜ÷¹OÀÿi:ê™ Ô›5ÄÐãîŠº½Æ×Áeã#<„'üáœì“¼)UnªC‰†—X=áà1nVæ×yÈê½Û~}tv¶–hä‡ÙõØÒ3tÎ–KV…Køb²¯wÕÞ
3Ý3ÏÚtÊå°;†ÙKÀ¼Ðà7¶å¥Ã"É¶–€þë¨ÓztˆˆKXF°*Þ•Ãn/Úfœ[!©Lîè/ÎÆþúñ _£äÛñïÉ[ëÃ-àtZà…1‰ÙÚ/Uf!ës‚£¥¤¾Ú¹{9%£óÂO9ùçdeÚ†=ž4h`Zù‡E]Ê.v£l[(ëšA3Óv´´£m¢{ßÉ¸Ù{ãª\ìñôŸèH(sã(³žZÚf ¼)×£º¡’’ƒ-|”Çð?<{f „F•Úú3’s>î’´¤=‘â î+n<Îí;ï"NGÊán'?‡rÈîö¼°oKÐIÇ.P´6ËÌ
™ÖË+}ýVÕ¸¿Ó+ÀU:	p«HuÚÇvnbU¤ø¥¤°ôêk‡ÜÑ>jí•0×›§jÅD÷ ™ç¥úK‰¥Š+Ëj>Èv#ÿÆÌ—…†,ø¦Í$Ø«wm@ÎS‰8#I{úfÅX±	Uc™‚ìcL ¦â?;{ç†ë[Æ(­¸¥´¡@ Ëþ]Zò›`u{ñ‹>±{R–GàýÉ±È9ìéß?k<yÃ­‚Ï–¨0W.öRìÙ/õý–Ü{î—: tl03ÙuyÓ·‰·á¹4¹•½ø£±{(™þHqeøoŸÐ–W¸À„_ã×Š¬øþ"gûV™¼ùë:žTàx´ísÚæAèR'÷Å€+?‡×¬sé;Qâ? Ë>› 0L#ùÝLT\CÄ“"P¹a‡Ñz5£WÜnBË7!­tìŠÿ3ä³Dlh&n§‹)tr¬ÈbÅGUí¡2žæv«
OõTÈŠ¢È|Yra°¨„£ò'+^Oö¼É16Ø\¡<¦qo—V·ŒžkI!˜“º#è±uˆO;\ØËñOf<Bè÷/,ö>¢2n)˜¦lº£]C2ht÷’¾¨	…6µýÐˆƒ´¯@Tr–„·EÀS }êpÝÉ©Òm•íÏèDºÊØe[2ã×KµË%§éð×b%&—‚îæQ+ûãUÅ'øKü•.ÉÜiˆ%ìÁxÍÓÚ-‰YÑËôóX$z¸iMs
ÕîãÂOcy)HíX‘îØ2û»æ?°›{Kˆknbµbþ‚"€åïIœEÓ$Œ}‚‰Å˜`„£&næÅá¿“4HÅb‚»½Ú”†n ”4á	†smÀžäÉ’É¦ï>6Úú´A´w‹NÕf…UäìÜk½Æ‚[´ÁâÞxcÁš2<‘»9ÀºâA1™9‹Ó8—ÊÎw‰QIÃ{³V’_iæ¼]ß>ô9¿ácÂšZÎõç?N¼`Ñ@«9¸äír»¡k¤‰?¸(eÒ6[Ú0J0S=•O)ì¨õµaùÌýÓýç6ÀÞ•6«•ŒÝÁ(B§f‰zû†nü.˜á™atäT±e±JaÒþ›2ºAW†ã±ø0ªŽÓŸv/b]Ÿaã<ÿ ¬òÐiÉ%2Ú,—òmúŠš“}†øvÈ~ŠÚ™U\:ï&¶3½”KÎyÀN+Ç ’`uÝœQCS°¸Gfàª—Á"@B&Ú•£—)—T;szCZõ+¶à­Ý–\’çúà@AÈ¼-n«ðCÜ6\¤ŸÿfÊZ·|†¦B½B­{Pø=4<ÑÓ—•\ìÙ8{Oì¤Põ}«Ù<£nÛ<"~¿Œv&­+PýeÌIæc=7×eŠ,?·¥--üûDa÷útîþAK_”OƒÓ‘°ûZ`#Oš¸9Ù\fµtÖ]]oœ©‹&ŒT†,5^ÍÞîÜ†$ULÈ=QKÊŽÚ+Øµü9úÎMEíÕßuìŠVÒ½ìî„•É&Œ¼|ÚOóó®/üLàl¶VPØîÜŸifnlWÀö,@Œ(YÃâ2dhf¥=ëÖæpŽ±+9NœtÍÞän¼;	¦³ÔGÐ®Í\L~MÝµ4o…¢ Lãäç,f:ó«csôAÏsáîèå <ó€d@x#7éÚ)bÓ“;î†ß•bƒ?i…Ši³„$Z„)!PÐ
E‹ë›*u Í’ “ìƒôþhzi—û’äEùš½_·
-ÉÙƒçýúñhõŒRçfoŸø-XÈþû~”¾)€Ø£ÒNØõ=‚Ô×Ÿ£"wá‡hx5Û„`i¡pâVÖ¸]naÜÅM.sÍ¯®y£žÙ¾«º¦ÿä`ð§ ‘ÞU€~A8@?}Jö.bO»Â.FÝvìl7¶$ ‹z¾""<½Î!3œxD˜^@«±±Uv=º™š²0Þ)Ú7JQ™’<bâØ2Ù6[PÈÏ¿K\àÍMX~ØÀµB4ëžWAÞ:Ú™œÆÆ}ÎŸ°cSÆášÒœ¹ø’¨JÌ@%üo_c-Žæ§¥%ÓA9ï³!i:‘ æu%üÈåpÍMà"ÎµtR¥k0¹ä{ÌZEGêIÔ£ì•ý¹æ!¯å¸QÂ:¥ØäÉõ&ætâW–0<mE~ìscÂ›È‹ OK­`‡jVÈË"ü‰gaiIð¢œ3d”«0˜¤ _ôÞ°t='!Ât·x³ºGriKmeÑ,hm¸·ü8B½ã¼©|—-]¾uo©Á·Ýæzæ•{R-.Ç™ZZigûˆé§lY)ÏEó[Z[VÔèyC6†6õŠÂµçm¾{'ñB»A¹‘~ÏO†ªa*kgšdŸßî5‡
%V‡Cˆ¥°ñˆ¦Æ€øÄÖa`ñ)»\ÿõQ‹i5ô:zìVÝâº•w3a~^åè1HÆü5—²[ž©¼þÍ¹N¡={‡~->eñhl	oAF„Ê¿×œêºT	•!±#h°Gbë |eaNøÒe‚
L×¡†âü‰öî]âÏ!’Z‚€iLjnµ«ç3Z?IõvàÌ§½ÜÙ³*Ã—›ÈÂew}Ï"D¦ô³Ÿø‹Ï¯sk.Á6×®•IoeíäØæ64*?@@M•ã^>/#³yV¦]n¸Æ®¥I„ºæ"zp—Z‡+Fªšž‚´)ÖR³ÀÊ•n¼Ë M~åÃ¯3Ï×wÆóÊ­5—Ê´nôéí÷«þãF’ø„’ãt†@ÞŸÎ4UlÑx+~¬=?Åû–!øÅƒ&ÍJ+cˆðÂ20˜Ââï	,zöú‰Ù3kÔ‘nf·”€Ùÿ_	¹c¯!gs‡aÝ`²ê*™Sá`†5¶(Ï¸àk¤÷-¯ÎÖ3Ÿo9àqFe­•,¦Ëcõ"iœ×+§˜S­äÀL¼9å¿¢ÆGv1Š¬Ü÷Á):^ÚIŠýC–E¸ 'õd
(ú°³^úUŸŒ{>‹ÛÀö/iq‡7|òi›È°* pXL·y¬_Ôµ¸¦ˆFàuÅ¢9Å„†cÍ¬Ëùg¥1ž™l÷CñQûwV….TÀ*9ôôt‹ÝÆÎÑùÎÕ˜"ß{?À#wŸH@nøð(>IÔ´8Y×m?‚¢ÊÜcJãNÏ3S÷‘¾ ?Ç>2A`{9€Î¯ÆÑ$Ï¨ÉM)Â?”ºn5 ºèŸÀáŒ_ãcã"Âz	lnC;Û8Ä~)¼bÀ%M¯œkë•Rë€ ²óµ´vª[?å¯s‡â=
M«,u c+€ÊLí”&ñ-*3,®º39Ën@˜w‹žÔ‚F§Zô˜>ç)qç*ºWx g–ÑÊ¨Oœn/PY%ó8Ä!(ŒgÍtï9±ózPq¨û>Ü G¶°§4f¡&8…Ÿ5{¹òÁ½–Þ:0ÉYæ$ÁJcVÖžï`ì³Î¾ÀœpŸi”ÜaÏh•Sá7Ú}$8ÛçKœ5¯°˜ÅƒÃ o­j6Ž’âÿê‡–VÁÀMŽ²4dêf‚þ²«»/+ï\þ@1AÏp0È¬¡zÀï¿8ÒÉ
Ú2ô;˜ý>±¤|/'ç-‰Ô©‹:µÓ’÷i0®Û,@¬#RÀþKŒ”•Oç¾HÛfs²¨AB÷2 Ó-M ˜&›dz9Í¨‹±~Ü÷ 2È9øïíUõû"?Á¶~6æŒóJ+¼¿(¼zR·¬‰™î»CdF¼lu159IÊˆùÖÊB?“s;PsF
ÚÀï¶Y{’roì5â’ej1ô|¸s†¦op£ŒœG&˜¢¨C½jGÖáDþÝ”Î!,sáa8d-F4è²m]
o£+¿Œ‰XÒL. —¢#Ä"Ôà*‚*'^%}µSRÊNg§j¼§×Eh9™$ÁG11¶ÞýAÛ­WsDwÙy…í“¬_ã¬Øí(aÌWhk»þÓ
–¦ÔÁ`KÀê•íi–B‡AQ[~)ícv¹ÅØ5O: äî$lùÔØý ì‰ôëÜÎ«"ûŒÂëÛÏôgé²¦d–)š¤¨y3f$¨!d°µØpÃû¨Ûhñï[ªo×´mÇòôúï¯h"gÔ˜ˆÄ1Z¼%R4»[€ÆÒ”hCZdÊCVÔsÃ¢É{®DÞkÀ™…[pE@{=|[{ Ô“â>pMö’€ÓÂátý"ûGºáúÙ4•Ï,¢7J‘²®$Wêkâ[?)ÚíŠ „|UãˆÐ»R~×S?‘§dè:ZîÓë5Ió¢ù¬óÜ„„rt7E“‰Oª"7@à õ°k*Ë·¥Õ.€*‚ìD~5Øâþ)ÔU±Ñþ5Ž>(²^Ä¡
žük Çk…g5àñ{Êï+Øi/‹nÒGhXðXØX·aÜ»å¿s¢Æ.z 4ÁV2¼àqvh>$çþ=»ÿ<SµÏÞ%q{©Yl…z	ëzŽÁz{öØoïãÂµš” ƒ®:À›‰]˜ -ÊÚ,{ÑÐÂô¼Y…v¶'·6÷§/øx}.–¨NhÝýÂËoâÁ•]u)X:né{ý;vÐ¥j*v!§Cäý‡èúøxÝJ Qa³4Ò«Ñ˜Þxÿ¡¢·êH‚lç\2v¾AùÚ»[%ÉªÜ]~ä™úÃ¥¶ûÿIíÞe<þÓhºÀ,e«ÂÔy1ÐoÄa$Yq“ðÀLOaèMr§hKÑy	²?îÏÜNªÌp!Ñc«
ÎŸ4ÇÕ Émš¸ÅÙGÁ¾ò¹¾'o9{›IdèZv!ÍÛ¶y$U§™¡ƒE¦>VwOãÖE]HõÃiwµÊýÏ^Ó'›§Ÿø†oßj¬}Em“Ñ~j\õó Ato­žìŽçòÊÒ ä@‘ÚþÖß~Aè¾÷XÀ/¡§K[vÐèÅÈÖ¡ÿÎ“gv¨¼ÎöSÜ°­ái>Ì§CP!ÿ9Ë˜‰€#S~ŽâÍæS#>o„(«ÙâÖb°±¿Rú€œó1XüwÍ5o+P@;•ŽÞ*¬;¼cd%¹‡¾òÄu}*›¿‰²^¤õMXg;+0Ã§j`2»ç^{'L–ô¦EýÕ|º|†P—ñ¼ò—Û+çÞô‡7ÿ`Ð8juýÆò9vx•’ƒŽ¡àE øR·;ˆ8m„>\óš&Ÿx…æÌ…”r	°S8Î;ysd™˜lY£ú®/›Ó£cXªbXVÒ#ñ¨#‡J¿æðI’OŠ%™\öšÁ¹Rù~ºQ¬Óª‡CT­F³ô2\”mÁS9AÔ±ÜÜœ@Ã»D@InçÇU¥Ídk¨Ùg¾ˆ¢÷JŒ'—Ûö©?ÂMÔúe5Ügš“ü»ëXˆÑ„nv_y,‡è¿VzçCõcyxÃ±NuWÎù:(46Xâ¤‹‰nífÓ¶óuãdy…åÍœ5§ßbˆ½
Oîûc®ÒçÜuíhãhë”±Î‡õ|MÊ„VÜIƒ¼V&óéÑX‘Æ†Ô‚¡œómÆE•Êe!¼ÉÝ£ŒoGÕ°=Ù»Z;w5„¬Ç =Àœ›†ÃwÃEGY­”n£©CSM%v¶s‰tžöé”]}ÞnÚ±|m…ˆýŒKG'Ÿn<8	Âè®,×u„BóHbäÇ|¼Yt³ ø~WŒ~Ÿ¾~3ÒfúV/ÀSº©ã÷²cŒP¢<t*ÿ›G5ºÛ×¯Ä˜K¼r6>‰¤:7Ú_H½ã¿àV{¼úK‡e¼‹M¾?¡„“ýðÿÙBy9GVñÈ¸zc €D 
Ý=ŽPÔsÏÛGoZqôƒR›Œ7{‰Œ4£8lö±ùÕ-/¼=þ¦sQPy|4/É¦c½/™´&µ5"Ý;°WEÎùhšî¤í£eÏv†vk'W‚6ØgoÿÔá3<¨m²×H1kšXEVvIxèÕ4_b ¥Ž¤øˆn¯\8Û3"òÎÄJ*­PÙýÔ8ß|º± `RÓGµ)I‹|äuHN¨O^£Wc?Áa‡0:@­jê”÷ƒBÔûá˜ÇY³òUó÷/ãCpßK®FXÖ
Á&¹êà4¨À]ýŠãƒ÷ \Ò½:
-{xc<P¨å!$Õbñl¡8ÖoÉ c%6d’\ªQËµ>øÃwÃ…åÚ½i…rp©Žmd!ƒçÀÎ¯{ŠFó'œôDø”m“¨†‚eõýu)»RRe¤L7šÝ£¹&õ¢9È3úé7ÄÏ+°ÂkÌBÆüÔ6z‡+5~ý¥^¶bL´ƒ=ÿÝŸ)3Ì†Kúy¯å¯ðe•ÇÙ³Ìð°ËUDÐ4²–jXê;¿ÆØ 	p–d“ÕWIáY¾ª÷ÿ
 Ip3÷ÆMA€uysì–ðvœJY±
m ê{ˆYJsi‚µ’€X‰Úü*—ó_hèá˜hsªìB-…]0]$úž\-÷îÍÇ?·=’m™UÃ‚‘;Â=ì“¡ßþï‡É÷Ÿ„×K
Ã
|à²™yƒbw®ÂÉuùÕ»¦¡63hø~`BÏ¬Û+kðxø{E‡V%ëñò²3pUqSÂé÷GA)4ÏŒQ(7Î-]#ÙçXØ²F¬ðW:‘±
j‹{zÔo}àÌËmÊÀ©MlB¯ÓÄ€öHy­À¦Í¡sîÇT÷&ã•–ÀÀ÷º@OÛ x^@Îçà}žÆ­?Z­Enå®0ÇõÒßötv§†þPÆÚ€òÔ›˜(®FÛ^,áM2ßÙ¬?†.š{Ê£š= '¼RSó>’[äqÒ'Ú ¶¼ |§<¾²V†Ë§sŽÜG‹R;òv/ò"ÀŒ‰.QPYî2‹LÂy€W!Ør& Oó¹r²¼U$®qk‰wÁÄ×j•ÂüÉªì@mÐ²Â•Ê5/Ük ~fÔuh„"(ÿ†ÞJß½·0^­ršoFïu\ÕØÖÀm¤ªû-€þ÷ÐK3gè,Ø´Œð6{U/{®#ßñº® û ½A5èTÙ˜¿BñoÒAÈ5&š¦b¾ÿZi8˜©H¤„è–Ö]ôKÃ(}	NÃ)‘’÷Œ”;Ù6o¢\g#ÓHËØWÞX¯G¸VØ+2ï»ØñkÜpRÂŸ©€°/½BàÆªÑ7ñ¾J68ÖÈðÏ=\ø&õ!æ>Œ1*‰gADŒˆÕèïL‚&*î“,Ô¢b«¯ç(†·©	 5ýa^@‹_„¹©wtæ“5ñþïYŽC¡ö²N›´ÑùI¦¦«£òäk§öGÎ³»áà}š;¬ÒI"Í©nÍ—R£¿<¶9¿^õ5ÔOäÑRÏ(¦=`‘5¾#±#­Up´fªñ„ÌdÌÅ]þð"ÏH£²a.p^Z1&ÿð%ii¿¸ÑàG:Š‚³k
8dËvc;Ì_¿g+fâLý#7÷—¨³ÃkÐ¨éÒ?/A™qß¿‚Þ³5lr‡³Ãïâ´]HÏÙå¾ñh;¶[T©ž}?1¤Xå=xI›ÌÎ¢>bKÜ}:¢Ã²=f1j»BcËKàÃ	iÿùŠ÷?7*µëð·KÞdº€~y+2¾ç{æªlbÙ%Áï¡î!ôô¹êœzS\»ˆ"#vU?.œÏ
¾±R´Ð³ƒx(zƒQ]0Ä¾Ä–ñêsñ/‡DY¥3¯«2çÁ4G ­Tý;I­†æ/;9»A­ä¦_L0Ð!$Ìä!-ó-L½‘NOµd·™BwëÛ¨œ¤*\Úcd
€Ê–7/«Uû¥J‰Mû,î;—R&ò*«¦Z¨ ªÀ´é’ãæ1Ád^½˜ƒ0fç¬D¨Æàë£ÀÂì{{S=Ýcõ`ô¯”i¾Œbþ?Íx¾ËžzD‰º(ÇF(Ô9‘ó/êòaNÂÞÜä©ÝcsÉÄÏu
ìDÑ,‚¯¿élf7sFAÂÒ³yú$æ²å+6Ô°Ù¦5±îÎðOà)$a(X÷^cÁËg\0Óä;¿¦9Þ¯Pê“›¹ÓEˆJ¿ÄmZ‡ÆÉš˜“q[Ø9{ÍÿzŸ¸xÎ08äi‘m»BËC¨¥€qz›«œH´Ø›ÕÒ¦œöwWÞkàM/êX»ãOtÛÝš–M0±Eª*á3“F‹šætéÚAŸ_m|Í9Q‹F‰:cª†´òï4og†ÏÙÔÂµdÕxù¥ÄÛÙ9£ÚÎGf”Í!#"!ß
Ë¯º~Ôýèà—Ñr»æý’w¥	é,Ý÷£8ý­_2‚	½"¾§Æd¼-ÜÈ¡P*œHË"q"U‚f	ï¬«ç­¼+_¦ î˜¦yAaý?žtÒ™ëœgaŒë}&F3ê×¸šþ®!){j©Ý$Ð(	ž«ì"âËŒ¾ ×É‘…#Æ²—UËš]®Yt~"“|]¸Æžb$HL*åQ” P˜9Â7%‰;2]1¯˜AËôF`•¶ÛuÏ±õnò¤Õ6a8í/šêIjKÂ˜0hX=•Ã®ÛÓ¹d^—Qc’bòÞ3Ò’ÄeØÐ©ÇZkÏò¹Ê§¸Wˆº¢_0~5*Eô%*1t:œ781VzÊ0+·‰lK0µï4Ìò_½$ïÄm tÐf‡&Pà¸³¤ì»Ü wÐÆù¯¥Óãó)‹TS¿R+Y!,æS¸˜É,{´´ê,75F¨½îAª¶.”i±ón5D¹Å öÊ| zÓÄ]rae¤=‘^ëf1~_WqaGEÐlŸ,ß3Œ8´WYÁŠ¯­:>ý³Ð¨»…ZÜ¿\®‹a’¼äÉ`‚,dØ¾BžVéî´»Y×‘‘	PÕ6ØÿÿAõ#KQÇS‹8õéöõãÝ5¤¯†„Áˆü¼WcgŒøC‰jþ½O8^K°ôé\
—"e'šäó¤Ûõâ7OC,®@x„!\÷K|º.R›:Ý„jü¶wlFßÉ6ñàê'i4/Ï*’Â´bAEòK•êù*J‹†{8í™-•³½¹%‚³
¤0„ ÷\ñ¶µÐbÔv Ž½Qê|vÅ»k§àJé›U@ææA0tJÂÊq&vó!ÈÿÄtb‘‹GŽÂDˆ†°Î%ðçÄ©47ð
»éì³äu.k/ËZ\ý:@ÔF§ã{À	ž¿|rÏ<ÏC«U /[
˜™B1~úwšµ\ôA!«9îúAŒ~Íƒ¦‡b#^'cÔ´3{8ÙÏYöeÙ"ß<{‚J½°ØFäË´Ð#Äãç”>4ªk1‹Ä[cBfÃ½¯€ÑN¾®£ú²i|`¢O6Õ­6]¬`Ö|Øª#.ZÖ>Xª_v¯ÿôÞœÍÁ±ßë‚%	ÛþOÅ‹Qá÷¨ÀÙþˆWÞý–¨•+FC.ÜFOúè«ª-ïŽâ/N™^E„„Ù†]Ó‚(ó4Â¦8çyçU.k^°P1êØ÷)ÜÕhÙòõ¨ûs¹÷ `è}øa þuNl%ôz?7&Eå1ÿ læÌÜOQVÎ¦+%þn¬sõŒ¬ñ'nBm–:›Ænžøcv#~ç“$ò1ƒtã1¬e5ˆ±P§ØÅeONŽ–T ê“Ò¿”$>\hÐ¹`ÊŸeŸˆÍÁöÃ¿g%´qt²‰&èïÒOûçB3ò²PöK¼ž›ºŠ¾jßùïÀüËÆ‡G0‡<I6šéËD!¶FvT'RxÊƒ½·Ï$	Ah$‹„Þ¬à"º#ªG5fëa+4,’"ã¡z«äù7Qr§ÇU'—P—håeB<at:°—=ÐÕçÔÍøž˜×„¥dÚŽÁ ÊäÂT_@¦ÞzëíBËsÎ+ø0XèÂ<õñÝ÷ø"­gôJ ‹PG´ìeØyÖ¼6Çñ®Úúí¦Å+“BÂŽÖÍË	dÞW.aEùy‘¡^Ûà¹;Á«Ê’º¸^OìY¡WHÝ¯~~ÓÉ¦¿mÕ%þ ï>ªÅKI±ÅYÉÛ>«íóÒVáý¹±ž¥QÄVóÈ,—ËÅqø“!Ð ‰rõ¹±þ¹¹ß.êÃâRQþæˆb9…áŒ×í9/"²0XÎñVœDÇºÞË9Ro›Ë¼”¥Œ'˜ÙÏ• ƒ»ñþ µuÎa7üLÚ¾À¿!<¥Þ×ïkõuÌ£-œ!<Œ¶MJ6‡#ê©°äOâŸ“°ÂDR/g7:·º-3ˆÚãq¦åg{4DËo9ýJ¥XkZ+]–r?%$“e=Áž'hÿ¦ùÄM.ƒ–«Óò#vjÊOƒw·M”Ô ñŒNÊÁYiA0Ò#ä¤fE9ð 9eú‰-o6¯®TVs•X©±bT¶*„ÁÂµ²W’.wý­‚Qæ3C²¢_†uÇoË‡¹¼²EL–aøsÁ)CeDï»‹àŽâ÷T©Ÿkûèe>ÆTDäpð'®oë¢<lxÔyÑLáöÏò÷–;mæ‡ãƒ¿Ôª¸ÐcâŠs¯£1J}Ê#›$¤	ÎÞžŠg~¯*›`ãI^ÌÛ|H„”|µÉV4=¯‹ž¦¡Ü¹ÓÝËã6Ds…Ò¦¤Žu.2™U=@Lt^Ê=f‹á–ÃŒ`Kî4š1] T“²]Hà}%k/`¾Y$Æ—À·ˆËBU6$–x¡ÅÂ‡ï®×rÅB»„×óº™MqƒfÜÅ´  y†íæ‰Øvñ­üäÙw¨P¦ì5›–pîÂ¢xü¶¥­ž®ac›-¦µèW×RaŒùd®Z?dú|˜¢,¯ÅKT¸Þ—pì7äŠž½’Ž/Üö¦„µ¥0,JËâÁGrEdáùCýß©Ô1Õp­C´1Å³ÔáþÉB|Îç¨Í`ŒÒ1©ÊJÄ²xA¢\zÚ
¿<•ƒß[ªEŽ•“÷½FPÃU†¼$Î@æê£íEKˆÁáË¸Ò_hv„%SŸd÷ßi7Ê£Ôk–jà5ô#ö·dúf*ÉI „tû»HN„keù—ÏÅn Ží{7<’Æì(Q™=ÿ<ÜM”Î’<vqb›º¯ª`¥v!€ N®]A7jLÒÐšïè.¡ÈÖ³`Í /I¶Jsì}­†(­Ý-	5¨ÓÌÖeï-~ê3„æ¾¡^¹ÜO8JHŸ½-VuU;ó³qåÔ¿uˆFÉy}›ekâHAC¬=}ÒÈ°~ø­ßÓÜÙb>ìôªUÝ#¸¸&ÑÕNIÊT„ ³=ò	­pÚFù)=A{6zg4X¼¸ƒÀêXÓ^¤ÝcK%¥;2¬;rçQ|×Ód‰Ž'¶v9ÿ¡7g±ÈT÷?™³¾3ÀR“_y«ÇŽ‹Öl£´W:[ê£¦—üÈ¨Ø5Ä+7d´vk5Z›À#«™˜'Í÷iM§Ö·Í¨™YÜé×¦m[x½ˆx
7<uAÅÅR÷©ÈÙÏ‰%Aˆ¬wi¤zÈ»7jRk§9~tã~þq¡¨ØòÉj‘0µùµäØ9ÞLõk-í¼ÿÃÍ$^4Š½æ¬*{øû8	;2²ô±Õ¥+n‹¬å&!`¹­Ú.Neˆ‹Ô@íæT‰w#]ÖÃ÷Çf·ÏÝÎIC2P±ZëÉ ˆÍ÷jzIÝ¦2+nÚ‡I»U!Úc'áúSýËÍ+	­$9`Fé·’3c¦–ˆ‹ìqüXÉ’zÄKVˆ´ódãÌYü¨v}?Ä©Ô·]î:%:3¦ç ÇUÿšPXVÌ›ÙNÂ†rK±Tò—T¿$_Ï*éP»"‹ŽêÅxÍR§¸A0Øæ–ƒ§g6*Öaƒ|Áõ×Îê¸%@øay†ùá½Yp–ì‘²`wÄ^Ü¸cÖèðreŽ-¶U«(Ü›ÞòÈÙn“êÆãÇ÷èTø‡Ž­½ßeí·ÏÑFÅÓçæ„gSŠ9…ŠÓr9l¶cÌGGI¨€é(lk¢›ra¼5q™GfZW5œ²*_ªØï4°YY‹uDzí¹ÒÂ Ir÷!ËÿL(´îv»l?Tª¼\ÏG–R²…ŸÜËŠ1Pò¤ lœ¹%×¯2°'‚@ÁD×õ<€K—h#Oƒ$¸%l}<!˜6³w£ FÚˆ£Š™6©œhn”+s€ÀbÆÙLÒðûíŠãv9µÿ,iŒMƒUÅRs¸{ƒÝ]XìÆM“šrˆ×ý†Ó¸ŽIScp‡–u+V“ysuull½Yb±F‹Ù…á.$±ë$M¤‘EtÑfÙÛ …­£÷ÿ2O¾FÝŽÓ}<É!bÕyÄRq‹ÑÀiñšôÑp›oDÊCª¸Çÿÿ¦c‹§ý Òçkˆ+ø#3È0Õ1¨‘ÝžóU:£æÔbàu!f^©qõ-àXóÉMõ.N{Ö¯4Yv¦› ~/wŒõ;ìé=•ëkbýÏ!bK5âÙÏvÆI›g=¹)Ýàœ"ÈTÆb6 	§½ï3iÕ¨i"Í.ŒÉ9Ì/Üó3ƒ-ÝIŒb€ðñ}:Óð2Ä!­@Wæf5ûÐ1Fýù’~ÕÖ&y0[¨F?*4éRû‡búêÏQÝÍnOîþ¼/¥Òà@éOÎuAA®÷[qmÝx©¤ÁÞë Ìƒ=_;jªÅã`è·&Â‰·0šÜS®M³DÆWY)†÷x FaæøùT½áÂòE¾ék’Ð6ÈvŠ`iÚóÒq™:AÖÏ,ŠrÝ›b¡G¶ 2r¤°ž`ÉîTdcÝô ¢ [ºóõSÄÇè0
^_€™t%Œ¶V(¶º‹½*¢ú|U½©ÊÌ?Û¸	ÀÛt
i1sÅ9£üó°·Ø²[@b-óÕ»ðæ.[Ä;$ÝUGpGQOÖ‡{œþ‰„Š”:L~ÌËÖžh8ð°	l^GYöºXöžÄ°¢G Wç±" z‡}Zná
ÌDÊœ|*cü&uîdTÈ;Õß¡LÕÛ²ê\<O9ÍªäE nÏkžYÀbF˜h9ŒžßÁÖL™Ç†8éOòË¢)5¯¤÷Ègr5üêf@CÙó™eÔ{ Éb£IÙAÔr“±CUÿœ…ê”˜ øF~‘ËB›
8 ¼¦ç EúÁƒB‹Ó¢O`¡¥rÆµd%=I">Ì4'JQ3]—RñE‡Nö¸„»]{«KW§UÊP#!ÈE’iÔX+¨z•žF uŽËí‡ê&$ÀÅˆ{+9àE†ØNÊ¦°¨(&·\CaE‹Ç{@ÇŽ¼àBR.œ'}6d·¸©=û@Ù„p@ÕOkºã2üù£ŒVL{†hÆP-Àšå£Ùó˜üÀMóžøF>oAWr“8Ë¥šÅOn[Á$Ï¯…ÒQÉ¯2vls.N‘åî©àúø^š‡Ú]Åu‚ÂPÉýú äöe÷ñy‹øâ×‚Aqš:š­¿P‡Ã«ÛØåêË,¬Ú¯ªÌ¶Ñ½|Á	d‡™H:TŸ´óõO¨0+–w:ænJÖPÖšg~Cl7"õå@Õ*/Ž,†¿h’Úÿœ­Ûº_<‘X—¸\ßÕž²›÷©ˆîf'¨çv$ÛQ´c²Áª¶+³g)§ªiÏäÊ—%ÓofOéœà¯H‡0ÿc®G ÀLÚÜdÀoàD1xU–¤±ÊtOêYˆüµ2b^6ËW"ý‚×›Ðg€ƒg\a­“FÄêçE#pKÖ)ˆ`#d‹¯•~Ú“PçšãõB–Ìê6*eirêç6/c.Òµ¶çƒÆö°üYêg~ñVKs÷¡¦VÿsŸ@D|Áks·ÏžíÜàÓ8ÌÊý=z‰ªŽ‡t	ƒ—ØÅñÛ¹ÀWwÕ\$»Xãóv¡[rÎ¶#ƒÂ#½-ÒRÑ¤Ò•í2'º½¹˜Ñî±Mœw÷àiðÍ¾´9úuJJÍë9GÿÏËçÿÉŒ±va®óqÐÞ„Îùtˆ÷ "%ëOÕØ¡2S4ì3À+C!Cq;9òeòÕ"¾ŸïN•øÀÛ>›UÅêÍ&QÁrFhÕƒñ`Ÿ
pŽHLfFTÉýHöéý–	œ{hzÂ¯v¬Â¢¤RÇám-<¹ƒ½ÆÕ ‚øxU|JÜÕ¿ kö|ƒÂ€œ`èv$*8rÈjg¨Ýñ••Ó¼ûj•ûíš}¥’ÝÆ=ú»M©ËÞ»
ä2Î›n~÷î*“\h9R2§“ÕÐÚàKkîå)~½¿æ½lùÖ ÌŽÑyÊzÛ°ÇŸ L†ñ4æÍñDHH¼×hˆf6S[MtÕêq{ãÆÐîÞö„Yf«©ˆþ²g#èZ’'¾ž²Ø(s:®¼J¡‚‰>³cç¸œ¸ÕVö¼WÿoäaÚYû—+›ÒLY}_ t£uºlDîâbÚëØt–QÄ¹ÞÛíúï.ç;ó.‘¶°‡Ä‘ïÈÒ—Îd´=«Ôaˆ9ý™s¯­£  ¬Í’˜ƒþ%7<zÖ+ïqqàÐ}9 P;W²¼Ë`&wv+ØýB“þÎÄžUé±•í†¬Ðl’k+»'#jÐïŠ_žF>+9AëvL›~ô?éÔJÝ~¨3HÊ½EÍ•#r`ÃÆ	ño­WaºÅ,&$Ãx¼£d'Ý—ö'RŽ¤/¥£#wW›‰âÅW—«ßÐ£»žÁdõ5_ò‘N³oT,’<”pq‰§IªÛ%¨p8nCéf¿§7Lñô4»ÔÁ}X¸C¨EøË„sUßcu’‚¨ÑèŒÑ¢/ÃœäHëÓûàx'ÉÑ›!ó4[gÓQë±N º£†<B™Uuz‡p‰ücm¯3&§ÿÐ{*ª¥œthn†+²3aÙ1“è€ëhñ~ w Õþqì† ÁV•”:? òu„«F¯E­?*ÌGí’‡ÑíßÈùžh‚^€å>¨Ž‘­_14Ãt£¤Ni]A}ßh@Êr,Þ›Êc®%ôÞîú<µ×éƒ;O@œj’6°BùpLã%”³­þƒž|>p·¤þýÇÊï~1µîœoûQÒñðàzÚ‡[^2M·;å ŸG*_»¬Ÿ}€¶Áº²Êºø'³û¥ë¦s6U\G·à— ¡Òõß&<¶¬h2»<ÕÕ~¯ÑÌy?F«sKÑ*…FÞü ¼Ì‘Ì5b~Ôó¥ö¼¯Øÿˆ99‚(V‘³ŸEÊÂÆé±ŽöÎÛÎ/ÓÂÕ¸2‘ìd„öjÖùò›%ò(%ïJ(ìàÒ±s)Waf>®l—«Àç™’Î}X±j-|qñQ`rÄ~S(s…ëÕà‚ŽséKÛ›d‘ªb‹fE©û=í1ACÑl{gq¯AqfsètyßJ¼b²úž<pê »a(~ºüù@7’ÍÀùiõ	þ$ÙÙ‡¯íx½[]¾’#;>È2jã–Ý˜ÊÎÒÉÕ«èò
=­¹{.©mJý¤)WaˆÂñI§XævÇ¢«,PÃ:Öäýe3a’/ào.9ê¹­&‹.:z2"öÅiò€QgÍÌðÓ³-+|löú1TÜÅh’á}ÀóËÄ=“íð÷ÙeØ˜†»)WnüIýfæ#ö½çIYÎòœ¯v]#HÙoX¨ÁûÄ’Ñ«äz_ ‹kx1¨T4lÏO!I³¼ÐnAï[QyCªÕ‰=DÍ÷“lG°=²úØ-
gq9£XÆ™V«'÷‰Òä]¬®îÁÍ¡„N/õ*öò+®=Îæé‰oÃäppnpr_U±büîü‡=xµ*:êp?·Î„bczáº%ÁËï1;\ã¹­Wø¿Ì,€BÐ4ï–– [³ÀÎÊ^Ê…½\\œW "­Wó¡?).òRä³yTÞÚ¦‡m¥KyÚWS¤öb¨Ø@ÊaTriRœ'‘êFhZDåGÁ†Öá£e¦È^†ÇŸ­¢žŸ]™¥ @G„þ6…©ÿÛáŽU9EÌ¢IìBWsOx¬÷'Ï¼;ºúRTÛXˆ9¨ýcT×½Ö!‡ª©ŠÍÇ´þbÅmæ><ÅÉ{‹ïž<‘ÂUø×¹§ˆð­—5,ËHC5%êø&;(yó]³Îä6¯UÍ˜ùFVr3-E±©ßÕªE§Øø¯üPc˜Ma;§ÿÐ Ý‹ÁÁ¾@²,W—‰TßÞ‰ð±"‹Hñ™¢ç?+a”yôF)Ý›dmO9Ež1VjIŸ¨]‡%F¹mOŒ‰¨|HÚlWÔ3^Ù$?	Ýò7ÌFó"–ÖSšÊÑÚæá\UY®™íbOO¹5[g›”·ç.—&?ôù­Õ6˜¼~µià­Uõgj³äß…—j?±þ.¸Av™‰ÖZZ™SÈŠ×¹(ÐÂÍqjWÃQù­Zî¼œ3ÂÊQ+  ×v@ïu«£Ÿ"Q›BX$?¤ckˆ
kfrÁÃ`sÔSž‘å&`1™Þ•Ò*øih£1¬® Êè¹¶èÎ>—éV¦ 
¼OËÍS¨™ñØC
µÊÒŠs' Ë¡ƒ;síz|9g@Ü¦ôEŒ„âeó6iC;\{êÉóÆì[Ìß§SW£V3h{•hZ¤§=Áfù‹fn6‚jgÅ²’GùdHb@±*ð	)¸¢>€•3UËÏâSà aîuˆ£÷¶å=ô)m¦ú±j ð¿ZùŠ¸³M¶ÿ±2FÚ `szF×maÄùÉÛ‚–uU8¿Án{˜”l—Äi)¦”pàOq¶¥6ò¢”mFïBkéaçíMc¬¹o¨v3äK\Mó“fŽ[]ÝèlÜª"£è½ÙW|=¦¼ÈqézFx›…ì0QÖmÛJp¶Èò¡Åš);@ßOƒu˜lµââ¿pþwšÍÂ\ŽýÅ19»Ý	Þ\W1¦kêÈluY FôR2‡¡Û’èH+nÉØ€DùûwÃ­.ŸËJ'žU]-Ê,(¼´âã0.¼G ¶×Ì]˜)zÎö;M(Ç¥(¿?u–‹4¯"U2RèTSQÐfàrSÚÅTTÓÅewP‚!ß-íBFL­½©M¤+¾˜NÈDØlÌn9)À2ìÍHN,@c·gØÔÝÆnToéÂQÓ Çúd«&« çîÊûA ãF\çM+°A³R¸Å(Ù‚’„Lo“JÖ´˜·8)*½1õUµô`ôÎ]^Á¼&ª÷.À–€#¢o°¥8ðÒ@ïê¾|+`›Ô0
Â&êr|Wyb¶7 `I[%9ê›óÓvìPÆ]ê"&½¯H†º:ãüúâsç¬p{Ã!`§¨¿[›µ´<Ú[q vZ„ííÍÝ›Jó¥ÅñVÑZº³¨ É¾/ÂJä[Ü½U¥ ¸@~~Â–v¦fŒ¤(Ñ÷¯ý±d}¢Ñ®çt2üiÖ/¾†÷˜I¡
ûS=3ÏÄx¾ÑÖ©ë,8?)+EM×+Ù:øBÌ/Î§jrdÓÈ·*Æ{°j–œ–ÍŸyã%¸xŸ‰­XpÞ¶m„²<J+;Ò„Fy>Ú·]å0oØç‰ü4y€å)]ð ’3	´Îúž"Ž\’`ª×Òê%Öf¶ñÙ¦°Ÿ(#Ù\º û¾Ya‚¾[±Ù+xì¿­ì!¹f¿Z—:5öÀþå’œdÏ´ýé•´Iò„rçâø1¤˜©,#,nÍº)<ÑÚÝ?"r3ü4ÈHSp¶Åš6nTæÚ€Â!pÐ}eèÁg?á=¿óNþíÄ•ü„4i)¾x·e•tƒ-}œ'Îõ«Z*[*Bo`*v¿sy¹­¸»tãÕ˜²ÔéôÂ­)ÝØX+h4_4Ê“z‰Ñmp?ºhÎËG÷+á`,F‘0ÝÑ#•Ù³¹¢FÈV<õX.‚Cqwt¤‡pì<…˜kE¦ð¨Õ§êŽÁÃ™Ji¶2À–Â¸é…¡78§MYÏ­Öc)5a¶ÈL¨Î†ƒþ·¼€UÈ¼­G Xc„‹ÊròÁÂµ™u)}á¨?Ï^*¨OÁBV©4Mô:è2iCóÇZ‡wÔÅWû œôË3×néKÇÍP}Mç {>b8›‹zpO@ßký$ÓæByç#¡ôY¨?•ÉÕ«µ±JŸ) ”®¹“ª²ààã«ù
Þ±í <)
BÓIÜcþ‚tW]éöüTßkÈÑR……=—‚´œi§¯"šÒZ2pØÆ3"]—ô¢”Ñ/Ndõˆz»ô;ÂZøiöjˆžd4‹g­æÁÃ<q…úÀWàcüHßÀ™!ô¬n‡ÖöX¶z×[yÆwNÒ™Ì`³\ÛÜ#]ånH@’ñß{†“éÈäüñ„‰#Þ¶ônŒPâ¢H•ÓÓcÁšU‚q:´qZ8ø'?ý¨8î)=îR—ˆ@1	èäâå$o*äóÎ¡û bÙð@[tÔ\?±a]¡OìÁš…y¦{ÝY«KÄ'¯U!4°õNêâY/ßeª¡Ê#ŒYª^g’ëøÑîñ‰råøQˆ“oK¦êT ÕóL9÷1>äBÊÐi:Åõ>·Ýb Ná˜ûq™t=fõ?.öÂ_9$Þ/ò¤é•Ùç!ßî_e3ƒH–V­ Ò¿¦.Ù}îŽ÷}¬ú…Lë&	§…Î
õ0A>d£KÀ_<{NmìÒLšÙºNg™ð¤Äÿýcâîâ¨Ì<NH}ý‘H¨kúÝ£@Ûöð`÷Á ‘ðP ­±°IT;À3è«e˜Åíï¶o¬Q¬õ!-;„{/CŒßõ¢Ë«¹&>ÏÂß=È_ìKf<€2÷E¿	õeŸTôÌª¾Z•²ÚªæZy®]4¡Å´^3QÚñ_l¿Ÿ˜x§ssÍÄCÏÃå=øú1·CºÚ#ÏÔs‡ó(\ÆeÂ~õ…É; täO†º¹$–U¸Ò¢ôPRåÑ¢eŒDoÆŒzLqTxLOÙ¨Q’þI†Z”È‰ñØÉò\ÐJ»Œw&¼†–DI	sDÖìéYLEkØ‰¢ýävYX'¿¸h÷Œ@cû£LûÌ%[Ñ•’ûbµ«áŠÎ5—
ð¥Iïã{?èµPVç"Í‘JÓaüô
ªeNP¼`B®ÊäÝø;åÊ—¸öÎº–q\Ó4E5CÍ‹"ÊÍÁ2S=™`Ö.¾í.=íßW}3àùÌŸ¹¿šÚCÀ~Sæ<ÙxD€ŠUÁžM-e‹á=ØU§˜¶Bâ[…FSäæçˆ<þ#
%Lˆ­½™º•—ËL‡ö
B«EËÃOó¦_öÊÔÚ-‹ÔšF'cêÌ|à””v#†‚¯0úÿ|y% ß.JÅ·Käü¦þñ¶TÃé²Q7HÚ¬ãÈ~"È.×ÅtLýá'Ì¯*„.tŠNþŽ€]*Û¢²”¸ðCT‡ÒLÊ“ë³G7}´kV¦òUbá•¤„ Q'ñ±D{¢ÄV~Ï¹=;vÎŒ=J7g»YúÂ–KÛh¢°õ]qŒ„™6H}òµÍÔL“\y~g6!Á7]2ø{Ôè´étúÅK`•ý3×Û9I-xÝÖihþ‹ê'‹qÏ«ß¬³ãý¼
hZ³6N/­è-ù«è¹†–2ÈPtÍå¥,UÓð€åš8Õ4SºëœÆŸhcÊWÃøF>ûöµ]V^•lÙgô5ÛŠ‡˜k”‡iï;-ÄR­žä¨8SµÚ]Òºàšú*ã•/ô©|áÎÑÛÐIqd®e@BšÞ<‘8¥QÑ™*õªI2ýý`b\„â+­û&“aóU6:é«`ômÙôˆ–`Ü¬›	BjÉŠâ]K8"—v‘çÏ>Õê*w±Û:Ó»urZ¥WÚÞgÉþVÌ ™J¶” ]|ßWQ†ÉÐÐBÊ7Ãiy±W™_‹OW¼úLCT¤_‰Q7PèÄ0…‰§ëf¯âZ8xdžp‘u³X†×Ö>7Ñ*âžm‡7¿BK+‡IfÀÓ»¼*F»wõÐ#e>–¨Œ~6Y2>as¶Ü¨¾Q+6çk{(¹>^|EÅçÔæ„yRpï!6ýì›ÀÝ NÛ-‰xÒÿ¬[;/w¥[T‡yz³ð#)í|YwWè¤›]w‡Â¤÷3×7BÖ;ÛÁëcÒR¢8•Žêñe™Ó]/ÃƒœJ\Ž~WùÈj³ñ6éÝmÃÝÐÓÄ¢Îòº´ÃÙOW‹Æh5€¨‰ˆ—`Õl¿¿ózv ÇêË#û‘WsÌZ /æÚbàÆØó¸?0Ò¤õ7–dËSÌ1pÐ‰`t{òUhYž,ÔlÛKCÈ_A(«•+ã8 5ý
‰Øl¨Aðm_bÙ`rÐœÆ[wòd2„gÀ×>9ŒXÞÄÜþËNÎÎ¥(Å`Ž9éò°Nàðµ{2ÐùÒ%ïŸúžÇÕ•@/4„ˆ”Ïªó†Û¹4în„Í\ÍŸ±†Z+â]/U|Ýk9JÄ<«3V‰…ÔrŠ¥tøpUtsRºÖäÅX+ÌTÙ*wF­ó–?½o\ÁfÈ;{½H95;ð Î  ÿ!áÈºw*!ÆŸÒ`ø9®ç¶ë4|³×;R°9^6«xqÕ­@÷ò–µ~ÕÖ­ T¹F«!ÌØ½Oïh¡¯ä¼_lƒš&7hãÍ‡qÐ&(êL¥uÛoAŠ±‹áwËäß\óGÊIEþëHT_±>eí"ËŽŽÀ€1þÓ‡D»E®øãÄ–éx5o+ñ—Ÿð<²áqKDADîS$5?fJÈ«ÒŽžl7ÚÓÛ-7Ž	5d—ö“ZFW
ÍZ\ÿ*ñª>÷Œ;Þ•‚ò _þÖ›äÃ•ÏkQOÃÆht¸ê&&¼j0acÅ~gê(wœeb{­ØeÜ‡Éñ®ê»ÊP‡·ûÂÅ75¥!£ÍuÛ
ó—Su¸y ¢‚Ÿ&kñì:Ž¶QFph
JAÞôíN.´Á~W|;C‡YÚoÛM¹ýù$Àï38G;z–L.ÙëK(6ú@%cB‚=­¼\¼6o‡`˜Ñ=™]ï°2Ñv„J½ˆÈ7–äŠ6&Ç;ª?¤¢±Ýú()™ö—‡lõÒ Ä2 Öºdëë>TÔk»áÍ?i6fe)3 Zž´çl¥õ)üS¹¾_€¦§Ã¡KZRs^Œ{X)ïˆÑX>ÁIcs—È³"d¨»èAöú{X•Ç‹1&~°cmˆÁ&Q>ÚJéÞ^í'úÇª2CopöÄ¡¯QZé/®ñ"Ç[¯æöIjCÀ3¤$G]™Zà`dÄ»>)PVVÔU‹XOÌ°NªúDÑÔÃfôpÞ…n HüÙZ–b\…ûF@¶Ýæå,Øz‹|°M90h*&ééúwµö]åHN5¨€G¹òdÍ£•£[~{6µ˜%™V»ŸéŸ% e®ªjÃœÎAàE]0ÛÏ‰¡“žëô¬µ€Râ„‰øÖVN_ÅŒžÁ¥“ÿd°ôÈ<²é*ì?—Ãµ”Üs‰œ_Ñ5™b³H*TE^JÑ‡ûÇJåÂYLÌdÄ.ÙÉu…–§xv®Â”<
”úµFßæ
Cà´«sÃ„¯ßÆQ÷aÛÞs÷*“gâÅ‚ž¼‡i­Œ\L9Ä×PÌ4øæz
Ìª©4gg®úJ	8çS–0å^± 7í:ÎA6¶^½ÃôëÆW,/Œ“bªßõí‰ã^ÈY1-4ógÇ	Ó7h€EN!±!9‡`ÈkÌ«%+ekbuë¶‹µÌ­)¶Ïj^Å¬$ðe8MêËÖò—e ¯~‘È—ÒóÈç'é.®S‘É	LÔX	•ÌéÑÒßZjÝ
 ôöï,Ïá¾Ñ†¼i`¼¶*b7Þ2¾·™ÓÄ‚¯â•JiºßŽ±Û=áC°»A‰eÁø=xçËÏW”ŸvüÈE^w—	c±PÃ‰ÙŽqŸ|ŸÀ©Ê|5|œkÉË2Xª¼©!îkzõãÎ¦çp?úaK´~L*|üá(Œù\gn^®½¥ Ã»ÄÁ·÷é¤|‡Š7¹¥p5L‡ß(á X	_—÷
‚˜AädÀi£€;µ(§iîœÉã4ÃÎŒÉw;e*ÂO	‡Ð_9w!q›ÿ[Œ€©š2-@QøKÍ< ÛÝ*¶¦©›uéPŸYÎáI† %òŠÑÇm¡ÅD­ž&UgÐ„œ5y•¤/ŠjÁA\Ñçø¡ÓÍ¹%Üžïƒ^:u£ˆÐ"›qwñg`Uxq4ibg‰B1I»™¬ùº:w,äÑÙuÿ¬=qaÓÂ«>ÐØ¿è8"†w@Ûèýs_ÖP¢—Ú»‹r˜šù‹JÃ1q¶˜³X_êÚ×›|ðåèº'SüÒCN_O¡ûî?ûUG#ýÒÛ§§¯‰‡‚Xá†Õ•–Óä_äþÍB	¢Û BoþÓ”­BŒWÐÌËø—Æ|ˆ­?ïÊÛBÔ_/¾“,œOÄªœ”Ò’ØŸi3 0¹r\`Qþ™ý
6,ãyý<là8Ø¦RaÒìei4vég\ì][.<þ¨¾{N~({·ÊÓOéÉað²…Ÿ¨ru:cÈ ±]&âXh“ïÜk „»ï‡hç¹³‡ìŒ›iáºP’²¿öRÌÌ±KÒ`ÉD}…—•eSWäJ˜X5Ìýu@T³¹†€Éß)¢ß/°øÛ˜tñ1voÕXé[˜@À›½Ñ¬ôµs.Eä-ÿá¿ð]p»T_—øƒ	k3†¿Lì¨_¿ÃîÞ¶+$TŠ¦œ,nzûF!¥æË*Ã1ì%0{Xj¥Žåä‚ÎY2
qíÀrTúØ]ugas¿§¥}ºöÈ{ôJ@1ûSìÞ‚1.ZTÂ|ÇJá¬·LÇÞ)	ß1+w$q¤:Ÿœ|IN0ýVéxŠíõr[üT…Ý¡`™@sX™hBO÷_âU$¨Bø¿„|O-ÌÀ<//l›øu~³C#ˆÂ‘âCf•Ø•2¹:y*šNó¯g7…¼…ÞdM©—M_+·sz*fg÷ë’ÿ×ç‰šŒLá¥÷-ê¥úóo¥aE­PÐüèù!Ö’¿o½´­ÊvµO#ËØ8Á£›4Ä‹.„ùi8Rý‚/iëµ—¢Jd–@š‘)SVèÞÎ›}N´i¤¸þŠÙ›Ëo—µVtZ†
Û!O"Ò·îýeÕÙ´˜a·ùÉÒnùCú¿Ô¬ÈŸ”ÃÏ™PÊøõe4âê€c™ÕØ³¼wffÍE%JRëßHjk‚€ë“7 …½ÊÑÏù˜eùv)í+7´1•‘kN4Žµ„µá‰ÚÙÜLÆåóDZ (
:<ØÔý÷u_ƒÉEÖü~½€«‚ä!J´„7°GÑ_8Ïöeusœ–UÀ,Ú $¡3§oì¼ÁOx¾â1Ï\{fË¢ÉprÔâå´¯¤ƒêv–€ÔÖu3ZLa05×í†fÖJ»\XG|23#OÓ#@J«Òñ$f ä$¹®ö85"|â¢ôó™õš‰}KFÖ9en|â”÷¯ýÉÅ¹3KMîKüéÈ6:Qx¢òì$œcïÅM1nšÁŠ ‰Éu
ª‡ä
”ª+çŽšà‚I88÷W÷!
ûcÓBDp¶ß¹”¯Á¸ÐpV¯×H¤^`d¨‹E6>ÀÛª¾³¹­vý_Z$þD^6)4µÊ¹.UrÞë¶§´e oôƒ”cã@v©b¤à`Äìá
F!­Ò¹ö¦zyæGrÅŠ~Ý]î¯ ³`è»xÅ¦L×øÔ4S hJ}B«'4‘Ù½ñôCïˆñûqŽä•N¢6iá±ù:¦©ˆS$­/ÃŸU†™èÔÎ
QRÎðöŒ(ºkí ?›t¦(9(Cj~ö%ÄÂÛãO†ð¡Ë­-ZZYínÃ¤ˆÈMÒ‰¡¡*#•¯÷dbømNqnÁëÍÿë…™.ìÒ\Ûò‰çjÌ”wßÓ#ãM²´ð$27–ê« ·‹hßîè*y÷<ÍäÍ ¿¤‚$Þ‚÷®)œbáÔ³íq&oÝíêæÑ‡åÆí«ÉªÄÉJ_¥jz§Z—äT¶šj$Ê¦w1Õ ãÂ_=µ[%¸œÝÅ@Ù™:äú·tvª\ðM	^ÂË„«:Vüd‚!&YCÁ[•\c¨DÑ×|ƒ&:Ìç±±£K=ÀgJŠí‡°Æäk	
ô´ž7·Y?¾©ƒíá¥M!õû|?Ä8'‹Ž6½üE¹´¶JŸ¸ãiàÁ”¸ŒbÑö;žñYª€Î£…Ì‰Ë('Jñgt~`d[ÖCRkeÕ Z¹…ú³¬xTæ§Á½çpÿHQçÉÓß‹'ðµú§î‘Õ®ðC0ë_½«µ<Ì@‹kjò“àd‹ƒR\Ôlhê‹sØòÊâÇ»ŒTg@˜ÍQ5˜P²¼1‰Gáô§\*ñ¢5»tÄ£ªÅB:ƒìs<|ë9ù«W8Z5Æ|/'A%:Î1Òkkj¢x36>q=ùðÀh?à³ a±kªz3ãRÈí‹HäE#D­N©DÃþƒ$¢Kl¢HÀZ1x|DuwtygµÜý5Tä_ùÅµ Y…ò¨/F º®èÜÍCW« ïÛ¯Ä&¡"\Fñs£Ö
N q¢3<E)œ;«Åö4Ÿ½„d¸1€ÞE¾ø*Ã±íò^&8‘ŸÇío±?JáÕs"ütGLyÛê\”ÚF»z*Ù‚¡*ÈyžÖ3Hõì¿·ˆºyàò,^1•’O%Ây,³ìÒý¹QÀEÙó'ÅŠ§“xC=Ôçú`gÕrr‹Ý±c Ü§­=poVcÈyv@½H–‚åŽmw6 tÍ;dZê×Ü¢ú1GëWvXÆ"PÄ„5{$?ËÚTQM­ŒkõÝná%ÝoÔ2OÃÍÜp·ÊÍ|Ö°«ò[fÑ*?¯]KUö§‚”úµù&òÈa-×µ‡`›*À{É'J†&Vw1O§Ÿ´@bÞkl¤1µyøŠ¥ŠlW±8˜õTP¡3uéáõ”ë*Vmÿ@_œž.F‰†àþñŽ*mÕ@²k82/7 ’!ZcÅ9²' œ3÷øˆ=§âL¬¬YÝ$?B­ãàTŠ,ŠŒ?Aj¡‰ã“Øªé†,ŒbçêD›ÚûÕ•¾p‘øO—î5­¤b˜­-.pg_}¢õæ¹&z”Ñ/ÍP¦ÔÒæ&‘_”íÜÛCÇ*Û˜ÏëAý’63Õ_¿zh4Í¼×‡|û§Bñð/#”ƒÈgPf®°ý…str¡GK Ë‡Psº¿¢	ˆ²ç9b´LpHÔ5S›\†_vÂÝ˜Iÿw@æ$gÈ[S-ÈNM¿¦§ˆ?ß{2é»Àª›º˜cUÄßö¨ý®6ç•½×ÇzR—À¦(Ï½`!V åÉûñFZÜù=Ú#D_|ß›ºÂâ
-Áp•ÙŠyûM¾äÊŒÉ1ÂKä¯v!‚ZÁÚáL”‘]bWÁŒü¡õ*a­Ñ´Ú…Ý2DAèÏ²ÿôMØð,è¨¿‹VL%gÇµAr ¼ðwúR­íÚGú¿«‘Šø(¸0 [2’7QSjçÎ“­mÓõÖ·õðcû‰…0¥M§Þ†#Èd†rO£p™gÄf³BE¦»¾ÁÜa¹ÇOŸÏzòáS» 9._€iäÃhÕ;ñ²Œ±ù-™$·{$OV2<ûP*=§Áö,¥'H!ã÷+ÑC±¶¢ (ÉºžA„
z1Ò¶!„Z6¹
ÖÁÛ' /yPÑâ/-ÌÃb6Éé¤%[C]¶“?Ø°;Ê“ÜÇžn€0`öšæñôÔtØ%y©@ˆœ{ùóƒ.¶#À¾@‹¨èÃšÛ<\Ö¼\©%=ß¤‘ä(ÛÄÁ:Xîù)Á7Ÿ_+P.UN(Õ’Ç¸ÐRÜÂ´OÀ5¨É…_uëx,ÙËð`ÙºW{ÁË1ÕLªm¡Å0ùF§êgÙUÚ"¤M(v–K‹P€0Ö‘V‚¸^+²ð.-‚Ù{-¦íÒÑuÍÝPÄ/k¿Ø±ùéüK$¯Íb‚X9œîÈym‘‰ñƒ¾OŸžU_“.ÎÐÃ~Sñc?½íãüŽSiµUIbßevN°í”*LQ²SâÑnÑ¥
û^KPÑ`1çó³O‰AêüP›:weÕ“Ö^ç³ì­péŽ:[z˜k/RÓRöŽ^~±\Ø•<D]·Ã·P¡õ*óž²P…ò
Ý…(QPz;aŸ)žd¼Ý¨ÈÕ M7
P“S	Ýd%ÏA1Qæ)†è’Ñ­vþ |³Œ"»q1—AÀø.Bæ½NÇèh#—ôqNµÐæ~óà{h®ÒL%„Ì2™Kú ÑÕ9êEY ¨¯msûßÀð«çKDc?Hà{*2¶ìYÞuÂ0¼¯Äë•ôš½Ç…Ù¨1c×Ž:ë¢øµžpÍãJí…©BX'<ÿ›ØŒ³‚ˆöc)ÿþ;l¶ÞEô@ $}CFŽéd#Œ?ýYÞÓÎtìx…‰ÿÅ#£•¿.«L~­™Þf`¬jÛ$]7+­/þkþwi£Í²õ@P@cYŒ©‘ÓÝ^ÌÜ¶¬šë|ÃAqé1ö¤†Ô+[“¾ÕÊ&h™í®.ÁS–½Ù\µ‡¤C›Ÿ7>#­§‹s£!¢¦¯ë~¦IGŸ’éÅž[‹J_,š³”ž’	Mý<žÙ"	ùI\%nu¯‚JßÑˆ1½Š­jMÞ.ô˜ÓS†™ÁãoŸ#jôoŠjô…¨YYÂD“ûZ–#¬DóGP¬~b÷ég'„&&¥+çBåv“ÇÁpá®'ÕmÕ÷ò ÚºK& vøXÖ†‘÷ÃêïU6È+)rÇæX‚D#æ+8O¯ÿQ¾oÿz›«sï–F#åÈrNÛßù÷Õq	„¸ÞhÂ‘%¢,ÎØ
9å`œ¡4Y«‘Bµ\¯Ï¶Ë.Z¨ÂÊ1ó\+Y§Ÿ˜Sþ›ØÕÝñå_¡É^å$µ´^¥Â„ùa^´gM 1Ê3è^6ôï²AÍ>Žs†ôÒ&<~›{ÄeL±ØÚ©´2ÝŸº‡c'g¬p}_ì~Ûb¨^_÷U{“Uà«)¶å¼92b† 9°ô%Á¨XŸ”t˜A+| Ì¿¿ýq–žßìê
èbßN?¯úåbÉŽ	ô©ÚÍ+k&mÏj:R6—ÉÎ>èeA=/Õ  »¬‰z~÷¡o 
PMD¹'ËNû>D"xbUæ¬ö³W®`&]¤	ê›7Nk½[jX_;ÚÉ|ýKÙöÁ°ÁôXx/d’qÖEí$Vœ–˜4Ïá;ÑòÈ²èªY1ÁhdÙ†ÅÞ£ð»Jtkí“yÜF$ØáÎ× ðEòîÀK¾°Æïºr8¦	3Ìîßp™•ŠÒzÃÖÎOÆKgqP’o¯ô~ŽÐ9€LåA•âŽKý<!‚ÚÌ§eMö«ËaÆô¾”KvC)XðÍXOò¹kÒìÒÍ°ô·§É k”üvsDÍªÞ÷«,mÇE^ƒˆ§Ÿ|!O$à²_-zq?z5^-ÑTñ™Íõp¨¦)Á†õSúþÄâ<ÖÜ+D¡–:‘ýyXÙÿ³Q™h·­J:ˆ]C¹qlît’®JRºÈoÎx¹)¸OóêØé2™’Q€„Æ|M²øæéu;FÔgës®%1›^§1nMÒ¼ <0îÀ.£¡äÕø…DwÁNq~‹_Ÿ€¡9XoGJÁ#sjî¸pJ.`v%@»î™Â‘”t``–ZH5(€áÿ\šÁå°X´C6©þÑ&ø­´÷äuå¨ÖkôûÝbÄ<DjÎÊ@#»Æ€Î>ÅÝˆ5fm±ôï&˜u˜gÈæ¯ÎI’eHŽÖH%T|\È©ä‹¸[][ñ	’ÔôP›ÑhG3¥|/Ív%*K~=aSê´T
¼2›Ø÷ˆÔŽY(8MèÕ…Ø#ò3s}bÚ
»""²H |<(¦ayû[²Ñ2Ã³¾ïR{üPú7„b	QüY²	8°]%e´Ž®¾‚eÖí¦Ç&8!zœÊ¾!Õ¹»û‹T¼ à33«ªqØ…£9µ•‰k`È#?qs›/ñ… ¾¤ëcTk¨IcA€=eŽ~¾Ür	êÎ£§Í,³ë)TÜ[ÈÍÄ×0 ñ²½F†‹‡ÙÏ—¼qÎŽ“gUj§ÏjNö›NÃw)Ë!ÿgl÷ï!R:Š²Éˆ­’bFË#^ÄÛJDž3çb•(ÛF¾üÛÎ¶Àã~Ð‰ï›¿!6ûxKD­ä£Öýóbèä‹öê5ãL{á]\Øºö6Ç{oë¸’EéÙœ1¹ÿê<A­µ%‘l›E-Ùô+Yó‹Î[°Ÿï¥ßƒjéè4s<O«¿Õt)"m%¿’`þÂAO¡	´ÈéîÄØòç¦É®´™$ñò°ÌÃ±"ÿÉÎàššI/'u‘Ð/S+×Â¡Û/èÝ<Å£„›7Ø ÈX{gÍ¢¸J¢®‚4%º»Ê1ŸŸÄ#.FNŒÊ)ºìÖ,÷¯j;ë­žÇçÏ:ðR9M
6®Z=ÿ°î˜™¶ï¸	ž±ÚÑZúÆ‚ðvŽvßmYÛðr7s¨Ä€U9e$“äK¡Yá?È˜¦"4ÎCR‘Fõ´¼·ÍîAá”‹ðXjBd‚âõÂøÌ·ó¤@ç½p)ŒÓÉuiœ¯¬Ä×qS@  
{¯	$6
ð¶qÁˆÚPÞXñø´Øös$oÆ9¦­^û!¤w´#y4*›ÂßÔíÈÔš8pQ©ÅÈ€^v§RRÔ·Rþ¶Ë®£žÂ®·Ù°´û'E—wÍÇJ€àE«ênÂÀï¼¾›gòøS_J¤ØŸMÞ OCNžä|*s,#P|4}O­c³<ÌV²ºä6Iù‹vÕ?ï‡Î{ÃÖMMm*%È30‚¯V²ä#ˆéXôXœÀb÷<Nj›çÝž‰¥@óÆ€á•¶TÓbš,]kê«R¾Eò5¡´teË|_œî<M¿3{¬ˆ[ÚÞ˜wðš<?]© =Í1v”Éýÿb'Sx¾”.Zï„hel“üÌR`öê>–½¸²c³53>ø¹Ä¶®¡W›\… f©HÖEC«4†º·b—Ä¾=˜«\üYoÂgÂÔãAZÂ ÉÝè…‡5:¹sbuÁ¾Ìó,˜¬Ê*ŸwË6
¹ `XïƒŒˆÑlFþT|0ô’/iÏõ“…ÝƒÜgÉa†¤ï^0q¢3F¼AÛx}Ïðôö)ý-3ƒÁe$5Rwµ>æ<ßPuM
É¬£E¼el;½áŒ„ó–½4»Mâ4¯ëâñpLJ¯ÝæÁLaªßp˜S¨ý—u{òs*–”ƒ"¶>íËn2=øvcš¹«$d¶ÿ3ÕäXÑÎG3Z!N´eÆ˜;©RÝr ÝƒcezA>’W<×¡
«8(äcˆ~(ðñ=#• ¸-ú!äïÌWo7ÞâJ1ü¶»P=(ÕzÒ§b3&	žAÖ½¶ÐçóÀzvAùÇÕšáFÈà¤y”<q˜†¼”UØ_$÷œÚ?óÐ†å3RR&¦ÐÆ©›
-'.Ñ)$¥0·>D$»ŸÇîõÿÛ"	ÿ
÷æŽkßxmÂ4j£@WâÎixánGoë°ùþƒŠÇÔÉ‘¦x¤j,"óÏCðÇ(¦ &'Ð­R9<Õ¾µÃ¸ýR2¹/u‡ºBÍÕ“ëZ/Y¤;ý¯/lê0-6§ü÷êQ·ã²¶_ =qÐÿ|€x°}SÓÛñãàÈ|ÜCã¦æO•º÷šZË¥à5øÏ¢½À‘8ûs/t«s6t-•ÔÍª£-”‘!³õ| ¨dª‚>ÌA¯Á¸'‹7¬7Œ2þ¶pï/àª
‰ÆŽÚë½±ÆŸÎR¦¥nû9ÒG¦©5v>Ööß`È	õ‘)ÖdÛs*Rï°ÂÁvM1¨ýŒ•+híÀT,8[¦Î¤ÿß½:fç%d"N&R·8=ˆèO±…œö´¡0+gR¡ˆz”´N]Ê!“•Øxë½ªîæ	`‡w‡ù‘Î…´uîoÅEnÜSÏìO=/ñ©Y[«Õtd×°?Ëa
6’È¢T
j¹Ç‹²]E@$BÜìÿ!Ò¿Š\…g¼‚~‡8õ_€óJ‚wO)t“LES¾b‘£#æÉ1©ˆ v½bÂ²+Þ¯Þx°	â¹”=AeƒJV¡'"º&”•Šw–Œü5Õ™ÏctyG˜ó>ýì\µIÓÜ[`PÿhZ%ÉG+F÷xÕ{±QxoÒ#c‹2v«ß„¸Q„âJT·7æ|À1¦ùÎÀ–5–­Yk¤7ØDxƒä'}zŽD÷·ÝsóM5ÕJ^wÍò&öîÃ&ðq‡×ÿÂÞq6RoñWðútÍj¬ƒAý˜Â-EÈRg†,+ní @S9 )¬ëM<R”BåPT›Ákg(yôx{Eß÷Üø§aŽ£{G:}8ÐNëSâDSã°º~!ÿŸpQÎŠ´¤q\íï~ïJ«Ü´
©R¦º…5rÉƒÏã|oÖn]Š—ÞøËNpÇ<Lãy×U¸å#ØÕ¤/Îè©DFŠ‚úñC¦äö-qëMºþ&Îj¶XÇÐ.Ôç'1rïŸñªSÇ-Úä$}U'¯˜þ;¯,È·vRÚ¯1‘ÞŒˆ
“™™¦[@´àvÒ£zåâƒã‚6ÂV¡\â¸y£ò!Å•îS—?ôœ«!$¿£-62ÙTÔ/k¦>Ubd¬yÇ<²ÆŒÿR ¯a²&Mtù¸#e<b»¥s…‹&£i×s”.^?‚ñÁßáØOèè/kùÏ“5èêÏÂï¬½‰B¾»Ç;’ÆËû°¥þ•þ¹1vG}¯Bx?‹`ê<†÷gÌ›
¯}èê@ôc%®x´ùôW©ÍKýÊœ‚ú§‘S•Iô·~ÆrvOë–CïÿG:¼;ˆÿqu“««¤h-†¿˜åžlÉ±ÛÎqû­¤¥!/Ç&Ô÷mê†JûÀÓ‚	ŒÃ¬+ûs½‡DJõÀˆ ¥ÍæãÖÆaìšaf}¸Š¦[øöÈ®!¸Å~Ýk¨?|Oºš\â:á{|Æ£, ¡‰±i”eL×r^÷gÙ±·SOÑÚ«æ„ú}	;7\»Œê¤h0Åâþ~+˜ÃrA¨¡¹mŠ$åòlæÅè©M%%O™ùŠU¥nþHcö~ŽÈ»'­g†(}E"qpÌ™0 4ƒ½–@~>³\,6Ý³ã1ÃlV–.æ’KùrÎ¥à ¤Z–EœÁDIž:nµÅ‰X¶ÔÄ»YÛÔÕ>”ø#V;07q—³¶iæÌ	Ë/Vßvf9Ÿ‹b
l”Z6ÁnK½MÅu¤DXö‘@]æ(.ë…ÔC›ûwÓ°º52³°PPå¤…–€ôcÉ"ÁÛÃ/üÖ¶£äDHêŠGä{´7²Kbä¦ ‡™œV²ŽöHäu½îêF²î‹»iv{É4R
TpW3ÆG—Ô+¹T–—/ékBkdÔ»3ÖvÜ!,Kk3”MS|ÚPÆè04eYp¦•`‰Hþ7¬š¦þ™7Ù¢lˆ sxû1
¨½ÇªºÞZQ‹Œ]@îB½»
	ÑòÕÏ¼èùÄŸõ¬ÆŠ†Ì,f~@Y‰ÛÓÞRRXgyA#TšMÿ„ #Ž‚ÓXßI†mÙ²Oi¯9®$@ÉùM¥IeÛ7îíu$øÝª! ¸o$µ'£ä€Ëi«»Bþöiï:¶ò¨çàÃdsõVMù˜fLu·¡í%xÎûÕ)äµ€W^¼¿Ÿ.ã[XGdÃBP€E¸­-3©_ÿg¼X¸HˆÝlO“;\xˆýÑ¡+ƒöw4÷ý"æ2‚‡ñ&É¹Ã¥6±H?2É%6öc80Ð.†ÃÀ™ø‘C0–ß,X,ì¡®%¢R*A%ä½‰rQ«»2‡Æû×ÙÍ?=?+aOl¿e7‹¨£Ö˜·f¯’À,ÙÝý¹ÍxýÞs(uœ+z\|·Jd;¡¥ÆdÛ©ð4ÙÁT¦ ýži&caÙ‹CiÈûé!Å˜¥ºÂ›W(ÎÖáAU`Ë2^"¦³T€/îiÃ'¯¾}ÊÄa 4ÒÀÊÆûòÒÖùVTú(Ô¨`Ø.O˜¨@Z«XDb×ˆc>ô};0ÃsôÄZø”k‰PÇ}Ènïì›Á^dƒºiqDKëð`ÓŠÏ 3´=—ëÚ ^ÑàÀúM“TöÈøË€…yÙÃólW…°sAL†Ìß—}Äû?%„Å¬Ð%	Ê«J^ÑíB¡~ïÉ.Û…M}‡R-\¡²Šièl0@75Ø–ŠÃB¢ Ë•÷”æ^y:”œ¬ý„«q& *…m^‡‚ÚÔ÷OÐÚSoã‹¸¡Ážj™šýÈÛ;ïUoÇøjäBŒÙq<fœ…2óímYýä.U<KlrëÒÕ·ÓSWìl‹·ÁÝgÇÉU¤ÝYT}[=Ç€îåÄyÃ‚;àÆ¢ôCs°uðè3‚¶È·'e,"LÆvF9:"Óhå¶´:&ŽY.©FF³žžG§æU:†êOÀ41Œ­¡  1ÉË¦ì¦FÛ‡Ûï§Œ\Û©ûà^ñÛNt•´Göµ²šî¢¦7g…)«îr€or ¼ÜÔx a.àÇt^×÷§g—óqp#=0ZK]œ4éSKÏW‘wï®ß/Sš&”rï"€Šÿ¿Ÿ”È ûqòDÔÜ= 1‚¦“šóvr„Àïqv|Ü5ëLÒQ²Œõ”Þ~º¯×‚çEÏéR¼FÃcRý›\ÝÍB6`†ÀU›¹}´?îð®qW¿ˆFfgÙÎÁîÜuì<€8pdL–lfIH:67È·1~B(
MEr«°£¶–‹îdªýx.ó	>“—5ÓQ”(ÆÍ%ãÉ¹…,"9B¼vf–viˆk2 ™#¬éÂ™Ÿ´<zÒq•cC€ç¦9ø…ðçvÁ1©75ë@ê5—ºÊ¼î¡?+Ëª%ñÆ/€†¤ÚçÌßroc¥;Pƒ60ÕxjˆŒkT|Ne
Càpy9öèÜL¾âG„žUæra'‡h…¢þå¥rwnm©í¡&sÆ#£ [ßg3Lú1Ž0HÓ>\x‚o“l2¥Y!é°ë–ÇŠ?gÙ!B8+$‚Ú<ÎþQêÍÇ1­wz¥mºÚô¡ó)ªMçÂöæ¿ªù!µ~òÇˆDA_ßŒWQZ!vhø7Ý0Úê»"v“s…·pW¾i<Ô‹9ëŒÑ1Ø^[l{%ëjjÊ}T¦Ùà·Á‚8Ëéñä-’ØÚ¤…¹â)ºU@›ŽSl™Ù¡Ä<êXfÂújÞ‰wÁß¤ˆØVA£nÌ=q;­\¿ßP^ñY"CÇÍ õ'Ð	J:§¬ái’uPaúW@ØÜ%ç’e€nXÓA6R™hª—<v‡øy2ßŽÚåGÅr§n­®Q_Pl¸,úk/%,ƒž;KL¶\ß%ÚÖè<¸tê nóüß,øk@ÞÛ;«Ø§Pr®´ >U‚83žØ¬;XÅdî¯ÉñF²EuGñJ~Â`6Æ€ÆÕ)û÷Ù¥½÷¹›IŽÃ©t)uÖ\µÂñ˜ÍÚ6é}­DñEtMŽÔÍþxòð6»‰å,4àãÙûéC²U'ääàÝ	Vn}ë$¡XÔv`C’íu×Þ{ÙDE(ÙÆN|ô´\‚¬bq´ì˜jžÈ‚išï…Ó $µxÈêD_õK^žìX*$µr´¯o>³IÀfãŸËV`e½+T2Öp¥üt‚Ôé@lZšj‚\D=¹Ñ-¤¤ñÊy®%7ÉªÈä(aqèLÌJwÿÉŠp?W ŒÌ*W¶à`Ÿ!î'÷+÷çÿŠÆ#ç²ëãSŠ(9[(ÈS-JŠ×—ætü€qóÊ1U–5}lÃ¸|ê“ðÔn'…4TZéðïuÊçT}1tñ¥n@?Fà;?‰¶·¼eƒ4•—8 †ð
*ØwØêðèxÒ?”§¦o:máþ±äÝ‚§AÎ•3âÉÇìJã ºTÖü¡hT¼ÌL¡)§<¤•,¦øOñõï#úÔ\Ò€@]5¶c í°Âœ Z}h5sžÎ#ƒ·µ$ä …?¡\ù´Ê¹ñ«Ñj¦ùÆlg&¯K²¤€n~„ÚÛe@À•é1nµèüçñ<{þªà!R<®1
wŸ*m8¬z“$¥LÛÚ¶zR*ç#fFäØKŽXáIÄ×>ÆM„¼¶ÞË×£fx?îÕÞi§¿2´g¥áS¹–»9MD´ÛA§[}ý:¨,ëœM¶AsosìèzGH—1Æöe»§%‹ý‹¹ÖncÓÆ",•ËK‚Ã½ÓâÉÔÄõÒO„å“Ùs`¤IƒM!!J¼ a¢ÿÜâåÐø3Ê.Zcçì=¹-ŸAo‚Äè^*@¸U—S—ÈÃ‹qÀ—w|› L} ·â„0(;íT§ÚŸØ›·
œÓt,µó$ùXìR€L/îÞ@N‚Ô¼Ú'>ûÿ"^»³ÒãÕr@#7MiË½·ÅöÍÒÞÕýa_Zu@OGÎû3N±h¥ü	½¦ã$åòŸÕíZÑtOg‡ê Ñ¸neÄ$TfÄÇð¨}L'}öS~oËD‰­R»¥Æ±CŽ©i2y×æ«´Td¥Ž[»•²®fCe0ï„•¸¥U2aPZÆl>ÉV„\é‚,
^Øý<5Sw¢MmŒˆ5’(låPw1-tIðÝ1Ídl5“ÓäžN#ñå_ÐôÆ\þöûØ¯„À3çGÎ (Î>ã	ñ…Þ<e
{vs‹û$²ãÿíMÖ,Hv³A»Ÿ¾jE­ã÷g+pwÁIÕ6`¾ÚOË¥´ƒªùdîEpAÜ„âþÅBÊyO‘‰^kÛ€kj—i&ÑÄA¯¡.ñ*†‹É?³Ó·çäF-|6‡WÊVh{ô°n³^çl‰_"˜:3wî@˜{ó(q¨+­ÉË/,¶ª,:aäO\Ã©¾‹U·@5Î]GÂ³G&ÄìD_¿Ú©6[cf…ð|&èX„Û0æxœBô 
KýntUü†ŸBƒ©¦‚¨Ž Û¯—/è3-¸9âÆæU´íVŸ½H¦£ÃœbCœ‡W+Ã^“G'ÚqŠ%²¹œ{¡[Û¬V‡‰–fÒíChdQŽ=a›.yN8@Sâš~Ðê¹.SB6|ÚMaRß]§S’Kcñ	{—øî‡y‘+×ñŒ¢¡QÀ\IDhhEQ‘uþ<½‰KW]j—!æ_Ó‡
Þ¼1¯k|ó¼éøÛ‚;©îæ©Ïóµz
ü![@»ˆºcùçM×IiñŽQB`B‚…†:^¦6¬/ ÏñËúÑr6v/˜ö^X]´_¾Z´ˆ_†Í‘„?Ì'Ïþ”qJeIÒ™!Çþ
>$8«l%îCÐF `»ËÌšÙý"ªZŒïÃ9Á YÍŸCãG!Äý]^ã/#ä¯ü *;:†6ëzƒ×ÞÌìª½P¤ÚyeöQ½u
>.ß„¨îö-NÂûCg‚*°›âšWuYn"Ä£r‚«‚³×}wþßA¸öÐmÙ$Pá_„­[Û{“õ¦ÃÄ­Lµâ¨%ÅB»ŠÐ¬X'¬hÍJ§`],ó—Õ‹;°6ø›d
ò•6KŠÔµÈ¬ÙòÎØh÷Ã ˆ³äXóA§‰ˆEÌ.J‡1+Ú%Õá
nþµ=°_ýC°º ß!Ûµ6J²®ú¯~uÈ¢fþX¡iÄq[ýé+ö¾=Û‹]®KãqLÿ+:	Õ…<¼–ŠÀÞà©{¨ªK›'ìí!#Dµ³µrb>)MáiÚ¿5ïYdÑþJûM°äÜ¸HR±QfæUÞäŒ1ÇÖa×Sd ¼É'hˆUÎ‰ƒfûZŸäE€ûzÊÌúT³ž£Ì\j/d§õÉ/„>û oÛ°™ë2›}ä$ˆ]¯Â˜(þ©¬„ø¯"(ŸÐV›+'‰´òuÝoÏ=ì½î7&È†È!ó¶`æúÏ.–¿Øž4l›r#Zä¹¥® |CT	½åzFº¸ùž¢Äj›Oô>'mW.¥ø*aˆnëÀ°f±a^vb©ŒŠƒ¯åQ,ß»ˆ’w;–úâ£K&±‰@QPU=ûo=ÝÚÖ`ÛV—)l"ˆ1r]Ø……ÎÉêòå  ‹`hmšï?“6ê‹”gž0DF}"¨e]iˆà…:ÏÀí¨œ¹e’æƒÎDU@¨r|£›ŠOú3Àˆ!ÊF €æ@*–ªŸWOÜÜY¬P}²òiŒÆÛñ½—BÃ÷µCØõ.pÏç9‡Ü„S„ð,Ž6sž¸üBözd‡–;?ååš-‚L=¶ê}¸ªA«ïÇòl8gòÿˆQò®Šð¿Ý½4“JH~4YÊÙ¹µGq£d¨g®²z…ê™>}ª@µ9å±a¦›Y3…“¿1H„/Ô§Ç¸7ŠJqöê¿’|•qÆó‚çôº½'™J††`KªÉAšÍ¦“–ü>BW'`ÈöX¬Ü„ƒ¶ÌtíˆÕŠyP€Àwññ¢w=(ËÑþœ³±WœúkF£ä€Xãý˜:Ã3Ú*—ÖÆîÔ¸xt$ÍŸ(	cÇ¤löèDõ¢X¨©:Àä ß>ÁuŸ­ó)úñ‚EQú‡|ÛåD:42²Ê.)NlLg×‹¼ŸÈØC ˆÑö«]å«6ÜSjê¢¥ ˆ…QÕ¡oÐ4ór+˜xSÂUb÷5àMc™ Ïøö	ýfMÄoÑÖ}Âl©Ý+7”Z„æ1!\b¢tÖf±î)é ú¤¾»>7OíÁ -%ùyº~Z'ª‚§¾Þiú{ì`ËTD ÙÁî{|¥YñYkt5×0]c€ê×töø-AçvÁ,¶/áümêÊvZ!ýÑé.ÍéÔèÖc†Ruû×dÚŸFãf±vóKífg.qáœÍ	pwva-›_›Øü›åWrfšÄ^qÿïeêí”æYqž~ô&×ŸœÙ³ÛŒŽmÁ’LfÖéNNìÕsgykö;PØóWìÖþùV	Ò®Ïƒ`ÈÁ–¢›üº–ˆžüyŽ·P
\o€ÍÃÆfN»~@±„5Qõ~ÊföT.z[‚äî¯lÇU­‹;µ´ƒÜÿãË§F¡ð¦¤N?îÏA¬ŽU¡­®(]Je÷*hCï|q¼–;C#è¬ÆI%"u1ªl á$½o¤Ž ´j1¸}EOBM«Yî«8ç¸²þ‹Sn¤O´¢@©–ûì»P¿–>ÑfšˆXtìD,[>›T÷ñX¯˜òFG[Ä%+PH“]âÅ¿œ{OâÌw	€KÄs÷ñ¯Þ;®Ñµ¢PƒZ§
Üý÷¸n]˜}Âp)~ˆƒæKÏg›B+&wÄŸràØ«\çèJ¥MÑ6•¹_Ì„¤Ê÷:ÿƒ{Å	Ÿj‹HIXQƒbç èèNi6NÌ|ràØ; W…ª¥‘®­ÏÚ=cI µ®8ê•|SÄ‘¢g	ŠQLFDL7½+ÖM	»ÛO¶áœô®ƒé ^˜ ¬Á×çòž|Î'/'Ú!Kt`"0ŸÏ¡ùþ×J|²‡\jÜôVAç¥k©ç¦€,‰ê”]±`©fÂ:œ`=)¦pz–¥á@fÒ­D°²®SY¢Ö@ï`#wDŒ†P:õÖ’Æ­qôßÒ>Ìœ{´g.&Ûï¸Ç‹¹é¬‰)Öj%}Ïù,4	9)å_Y&”å¥N™.Y[ÕÁn˜¾½öG¶Bû“ómž3×Ú÷2 ›}{è yöi5.ðfgvÕ¶Ú’Ë„*¹(Uá­§oq7o¸  ÄÐW¡íª½Ð™	K¥ßQå$ÿ‚ðjdX/(•w—æ°Bš»cÜ9>m¤ìÿÎhPÿ†F9Ã&š¯YÊÏax`ôïÙÁj)]£wAÈÍºkÏ=3§Ýiêõón÷ÎZ )9’Üò[ÃÆÁÉ¯Þç4 tºáfj
Â>²æeâ§jfí†y¹»R¨E‡«í%n—{ïW13èaìËFþgšc3HØw¨ñOÖd$ã‹Ò¤Ï¸öŸ3iVÿÇ(¨t@dpdŸ³_ä"(¢Œ,UÄ)PlOËv—[Óq”]“Á«‚~{ÖË‘~´ðÿ‚^Áœã=ÐØ¡í:y™ÒÁ•S«Þã§nüuô7¨n f¯RŒä´²	o@µýß/¿iè†ëRG#.å:´Ï¿Èbpi²± ¹$ŸšÁ¥…ð<ÝB¸–GN¦ô§ +÷Ñ5+Ÿ¼žâ ïtÄ¼ò‹ÓAö+g(=ë”™ú	Ó`ŠÃ‚Lß4lèT¹~±Åƒs @[mE9y7î/\zåànS¼Ðòñ'\  e±rËˆ¿½píŸk÷S÷nbµ‚‰)›wv_ÎcÑ"ÜÃÞ®
P2ž×}r^ƒY#h0«0D’VXj‘èäñ
èJXÃáâÁ[×¹	‹¹ˆ”«ýËZXH-CÏ¿»¥¦NA% b”K6_ƒ@{×±ªÍ©ÿ°]¿3V/qÈ§Víã[)S2@8ªG½¹ÐÉ|áaUå9(dÅq|0xÿ½|KšÂ2^Kñ¡{RóÒ>ŠJP„¥ƒgR·ðqFJåƒDæÜƒ6uìÌi¶»Wú"FngÓD¼éÕŽI2çë{cŽ^
£…ËÛP‡RP_©<Å85#‰¬[³ôW½»ò6¶
*ØTp­BP'wO	“÷D¹¦:v=ˆ_Ž[›…¶ø/uugò¶¬G ÚhžÁW¿Aq²úÿG«Ì>eh¿±sÈsÑF%LÎ‚àC±•í C–÷ÇæbX2Sg®¹í^NÄ¼Ž®8p*òÉ1ûéé§™²Oõã„šäcÍ3´ðšFª	Ãû7î-Q®Þ“ºY˜|"ÿî÷I¯]!”\LÖ8ýZë×ÍêŽÜdÍwA*3PHZ™EÌkÉž“+‹¤Á¢¤kØhøúHÙTùC²m2&;0$mÏ›¯	í»Ô 1_ŠË)ØÉ¼èv‡À*Ê$¶Ë%õwgZ§6ÄCê‹Ð1ðq#*©ÖWšö¨} ÷>:k¼ì=úÃ¤_èIŠÚOŒ£¥.z“¦›Gñ"Äd‡,`¯dæÖu
Mgnoë¯†nÚ
s©…p¤!ï¥ýG˜löšçoëÅHÓòáëû€ñV 0aêí,š(ò' ç‡ {Ê~, j‚0J!$ˆ$õ
‡Ñ6Zwky­e eÝ’ 
Ð×{ã"êž‰WªÚ¡^³ˆÒ)Í7rï<	1!âh1)NyMÊUÀ5÷òv~Ñ‡”î	è±Õ?€‹4le,F¾‘íéoV-‡ìÿ|ü×ÀH5–+É2@$É(Rûû@ÈƒÏ÷ËyÙI:?½E¿€Áçˆ5¨NŠfT³L)Iñ©Ò·¸ŠÏ_­`+¨Åî86±‘\f‰ˆêOã%‘6ÆhõŽ°l_àŸêÉá{Õœ{UéD8-‡Ð9øN0Ò,ª]µCJºf×ü`-eSÎ˜Üu£æè-BX0rè×d·)ç)Ü´T4GnzjS èRïEÜ„‹•ÌŒ8Š@†±•ôÞõhtð´èEdNjô‘Åäð/p„ ýÀÛL²«@þùîÏ8ðA£$œef¶³¨ŒOQÔ ±‘6Ò?=åhèP×Ô†‚n<Ä6’aVî‚Úáú™ÕÓÐab€¾MX ˆTó±ùH.mˆ„Œ,‰‹Ç¯å w·÷˜ |Ó
–Ð–B ÄJÉ’n(Gó¾ Eœ(/%k§}·Øem²¯ÃŸ­ç^I	‹¨§\ïòý`¨dÀN²Îûî»,nzeñÊØÝ§.ØE;:Ï_‹‰&]úŸ„•¥u'aÕSuðÄ×WÉ’$jùa°ùfåÐú{Ïü#q!‹zx0>µJ®#bÞª-€Åñß•‡Þ”ÖÊ¸+v é‰¢°Š Txïºâã+`MöáIÊº‘ÝEOA Â~Ô$^<¥„Ó‡£}¼”´-Š<€Í!Ho5ç«•EyÄ{§ÓÒª|¦.Ö}j™‡òQHÀPB`¨ºØE<\çG= Ü[§®*6xP&H|‘ÏÝëÔ²)Ö4Uæ¢*E™@x—©#óÕÓ%ê+k=åb+cj©š˜³Ÿã‹±À{[³+º·Ÿzî ö~Ç¿WŽðbÄ«ƒ„%šÑ;ôŠž‡ P‡ëøÖA›ë æ8%?Fà©ô»Z¨­ÅgX=^}l„šN)‚qgC×Â‹‘%ëÐÉÑ%)Ó­ëMòH,‰±\a	¡ï?«‡¥9v–Áz.dehjú2~se˜¸Á|NQ¸wþ©sH0  é…Ý{¶c˜-éf¬®–¹nJsz¹Cs+¹¹Å€Á½zÏI)»>Ùò±çjck'Ñ,“Lã*”ÄÒ£iætá{Á v¦àW¿xZ%<l	Ècf‚ÌwAR´z¨Í3ø™/{4·ì8ïðÊª?´DÏPµ	§)hhÙ8MÝÊDZs Ôà—=sVS9mˆÒxi)\¿Fj%ÔH§³6À†ÂWÍvÔím[¯ˆûg&ÎC\*ªÔÏW:XôÛ­±u@Â
ƒNúÒCR‡AÙoÚ·°ÀZ†µDËÑ»sGO0rrJH¬æ'RÉt§ž"¡—8>ò£jŒ®„C²UMïvßÚQž`’VÅŒ°hF†¼aÀ¥F…&£÷K]ÚôCÍîq8’ÀýÆ²{–Åm¯‰?9ÏÐ‡Hh/ÚÝI*Z.¼V`E­¼²}Þ‹,Ù|d#·Ï¤AWåìþéöç‘5õ[°õêº?lfãè=>ë•@¼ÇvM7æˆéãUL÷·«ã—?æB).F9–âp†L{"îñ™3"àæÔ¿FñÒûA“`i*âƒÝU-"3&«×&)7M½éZ÷/©Ðs«VÒþÆ}Ôx:žxé÷-g[É x¤±âû&‚²ZëÌëlÙ”6ïhÙÔs–}W„{Ÿ¸íœÙ€eCB‡žœzáºù›@¹×_IYª§”¤“KgGë²ÉðÏÁ  â‰eëà$¢+‘QKþÀ’­'ýaØC&6AÞÍóª<eÃO¡¸ŠryŒ|w­7áN•WºûÇ*3ª´<Á“l“óËÑNB§Ï£·Nz(öL=º¬ŸnÉƒGšï
ÁÙ!Ky7‰WÞO.ÐKPJÃh¯KÛ‚djˆ!qDkîYÇóÕ½ŒzY‡‘GoÚ›rŠ­õçÆŠ_£8*.Ö:Åûµ< Bó˜ú/8ˆœfR½#JîŽ7Éÿq-c™Ìz+\ìXjdÃýºÁ)¬Œ:*–èÜvHÐ "fbïÇâÙ×B~œ›¬Š4Ø”ÕF¢7FšŽ¸Ü]!‘7ÿë±¨T5[]íêŽ‘T;Ú7äÊW‘©7?n,ÆC*]kæ/Úy¼KDä[Üûøe]sƒ‹JémWÉØ”H²]Ú4[ÎÒY‹î»Q‰Fíà…ùpÿ›‡y”zì¦êðžñ«çÞ+ŽÂFu¢®SrñÒ)‰È©\Õbxè¬Ä-Š@Z½¨Ðxèl‹fé`B\inãL}á÷”¸[VóƒÊ½ž×‰9óÎè<Á)¹lIj|7“A9©\À"
˜”BØÖ·dIê÷¶ÇÏ°J{¯‡ƒX\<'(î•F"%öd²åŒN>¦ˆNÿýo\9Jº'ŽÊÁŽxç¨×+ÿú²¯E®aUuZˆ`KŒ	Ë$·ÿÍHÂu¿³×ópšŠVAkë¹ÎÇù¤ïh‘@@²¬øw3°µ…ÿÌW?Ì6•ò¿âáåc†RALr;,AŸ×èðóvö¦IÊÔGüûV½2ƒMQc=Y–žÞä=°ó´rHiå¸ŽÌmª¯'sBÎºöYï+’UûÒÔ7çVÝ´sz¿ê³ù½áJøýüÇÖ]~Pñ½ÁG•1Ù–„Žsž¨Š,kÌ¹ÝÖî_Ó˜<‚"GÏ¡í¬¿0úÄŒÂÅbÒŒb0Î/pª^Iñô e©VÈYåeÙX“x8m°eáª‰n‹™ÑòË³K2anº¥^ÙŽ²ñ=˜BS?Ð	2¶Áo€¬Ðœí"6ò÷Éa U5Ê|Mø×ÌIˆ"€f¢,¤rÍ]§œ›H‰3Àw„ÚŸôÅ
KrÊÏX,¯³c7%p…¼xµ»‰7"•Ã×;¹’ïŽ6íMDr=åÒ~@~?>®ßEN¨½
÷J­aÄËZ38VkÖ2„¼à¡G‰P”÷qR(½HCK–@Ì’(”|ü³°—Tvîµ¢Ã0B®*ºƒIç<…ŠgJÜ]ø¤Ïb¹š£3w•pèTGÈ%YP¡G‡È­¾þ¹b0ƒ²ã‚âÐlµ»ÕØëý¬÷àaºÂl/pÜ	ÊÜ1Ýßžuâ£FÐ>âvÃåwº9Å4Tð8ÐïséÑš¾v¶Ã9è¡³ÕÏb;5St\x¯Rš‹ñ4]]‚•’nÁâ.Àò6º-,Fµ°+(dœW@eRHüèj4œ,ße,Qp™ºËý¤§ßâ˜×ÉpŽõC¶Rå°¼‡ï§v[¶•ýf½ó>=¯h³Jæc—ÜkLQvlÙR²ð|åv(ÑÊ´e4áÄÂ`~å°ß¥‚o›0du÷§c.£]ÕB	¡å*5ß¦Vá*¼*é2	þù]Lü"BÍÈŸ]h¼6Çà°[çí9?³Øí9áóHÜu4°…9×Œ$=°@ä=¥êq84rž)7ü_w.ÆlÍ¯+‹ãìüïFâØEZâ z²îÔ·úÐÍ­
"À«Ñ>ÒŸ„³änt1³súà¨m,€óc+}'Õh²\?DCÂ,³fá¤ý®'˜Â¨B±—Êä¼} šœ]?€}&EP&ØšätôEŒ4bØ5 Ïu5ØÛšÕy…yÜ„?¾k¯nUÖ1_·&eÙø;þíšhA„±¢ãÆÏ«…óJ¹mb‘]Ò¦Ä]°µ/‡‚éôXÖ\.o-ÜžÃ{eý´oEpp¨QkbÏe`ÉK®çÖmë:sÒµs<Îó/óÀÂš3Lqr°®l¨pma#>hÏ¼ÑÁèÁé¢wÇh%„âxY®]ÒÑˆ{‹éwyúõÛIšA?yj<&’Õ±k¼$_Àó\Oùía¹Ú1Îo(
0·(&yå¶iíòÃ¢€D‰2h¦}þ=ûàAÖ—â3mÿK¸Kº5A¾ÀàmïŽð˜rƒ.B%»¬hš‰RÓÒ*Ý)ÜmÌëaÚï`Q kžM¹X*§}!å
Ã'ÞäJ".D÷Y3wJÏ™žíÁ«ë3\w«ª²æÂê²TËµõÂ„Ø!âiï"Ç
&¿A0#FñåÎÔvpš-Kä„i1Æ˜Aö…3±/§Vµ1¤›—UÕñ–ú†d /Nmš“ÅÏèt+«´üì…Q/5jËÍ:Y¼ãœžë=«#GªŸÌ*Î“>¨pE­T°Bì£^…|m–ãˆ^–çµCõÜ ƒ\Z¦ÌÁA„¨idño†:6¤JG:‚+õ–åÖíÇá5|j1òX­Wâv{FJÞÎ|†—£“×Ö·¡ÝÃ ¨Éj,‹‚I¾{Ü¥·–˜TNŽ2b½©‹|ë4WûäAÆ×ZQºëèUÃõ]
d·Oâ¼/LÃ°P²åü²nY_MØ
ûìoÒ|k¯t]}éôÊ-Tg_ÂØ:ªí³û7Äe/Y*X²xH6<uÙÇÅ=Ëæ®ÜFùaMÄ/'ùV4V>wcXe
Û¹-L¹¢ÿ€ÂU‚3NQÐ;ûÕo0ê…ÒdO"?Í»H”QªBÉL×oW9 ¸÷°ü6oKÈnpRè$öz6™ô‚fƒBš«©‹ÔšŠ¾·î=
D3%¤˜5ÿép/Cð¥ø¶Ò¬/–—×~x9´¸¦oI`¦”óÙhj¯ý‡*ŸjëCB^%ž	ŽÈ\£NA¤ª;¥’L^úÔ€p‡$ËÍ†‹HÛhâÒ‡ïd Ó‹Þì Ü¹Q8;—xmÊÐíçRÑ"Í'B Òzí¯hF×œ˜Xê ø/°ëÚåŸ³›…’×,0;3zÊ‹dÆ¥uˆ‡®¿
EÊX‰„MÉ=C#&«•s€J¥§/ü „/ïèã–áqÜ©W.ÔµÂÁ<Û\ËûOÚ"eØàFe¢7éKSÇ³äP<×…V‘Ÿ?®ÃÿQÌ‰¼Ÿ¶<ÓP­‹£Ä ó Ý8
k2ûÓ÷Á”ÀËlÇà&§Þ0Í7Â}v»ðO6â¥^ÿuœIƒ³zä´7‹(úiL-ékWòI*i¾*{ÞQðê÷®x¢ø ë]ÖÜ‡HjÑD¾brç×Ì`ýò,¿+«‡M=¨Ï;!ë¹±9T3÷ºeP|ª¯“îåC±&Okcå3FÙVù}Sì—ÇËéOÌO{¹ÊŸƒ¡ðÎù°4”hFÏZ…)´r‡±ÌŸXãO’ÖÓ@Æ Ž²)×ÊIQÁÜå_T“ÎKTrŠí¤‰¶ÚèD+Èk§„?AóÏý­·ÔÁ|k‚‚\×*51àüåi¯LM´äÉÍéØI—¿SLý›NG8=OÒ>|Nñ`«]áwÁkmV¥RÍ	˜<úÜa1ÚSøŽLDªT²àL²E˜Äs¿]Ñaã^®H´'s·º<¥´H"=u\­Ï=¦õqsÃfv¶¼áò,ö•P@Üë1º1ÈØm#úYµ¯†ÕyÍƒÝ½vÚÑ”®ª4ÂÛn=©àÿ(nf­<äˆM¬‚yNGXÃö!&†çcF>yTËc€…ÛäÓ/ª«¬4ûEù6SÙ¥Ó®­ÛñÁT¹Z*~ÕýDQæ,yÊ¯¡e*ë]ï0
½ü„œ;Îµ•ñ&±Ë´¾¢ƒ6pZõ¦×›ÂY ¬ßGŠ‡öI™‡Cÿ0ƒ].äalqðP±ÈôÖs%–(Y½uîéý+I«Z·³uAŒaEŠQ>þ+ès–è~MÃÏOÚlSOR=Æk7–Ÿ‹mÒðßOé$öTµ£ZøïÁ(Ž»ï",€”¦{‰ÓîÃR—¦í­j‹Ÿ…¼×ˆhLÐô
‘0ä´Úÿ} ÅšÂW8
rV–PiÇL÷ËŽX>ì Ýw†5ŸÑ¶³è†)@7ü¾K,Â¾¦1Lí[`0Ù¶jñ¾@ä$!i“ÓÈ|*wÛ*c ÄÔ8w¾ËãêBÓ³:©~k¥IÊt{ ´ãF‰Ýi_ûõ°nÖA’zù]â=Ë^sV²„Å¾ÿ()ýÒd¯\*!¶<­*åÑ‚<çl¼Àý5TÖdµ¯»µLÝ_¹Çô´¢6^¾‚ìò¦q/~û¢ÔñÀóë6åÊG1£>3ù·½|…†*ÉX¬¨Ñ–4¸–!¢>ÚîÁÖD¡f·›Ð~ºS|«<pgöÕ¬Gë×.Zu³¤!·¿XtáÂ¸E‹vC£J™~ÝÇ!_«v#¹Ëä5–2 o‡þU?Ø'´èŽ2¬,2¹dÖßµã”‘uuø|õ‘¡…Â¥\ZñŒ6š†Tý	=ñ9Îe!ˆJ}S¥ûúò¢£6¿.8ÖÏ¶64¶Yl¹_~*…Ró·7]‚ž´âb©üˆ¿5¤Æ¦¶‹‡¶¶7êæ5£[ôé¥½Ñmrà:õâ¼Zf”×8‘%ØÁ–oãÓ<Õ}ÍxtFÙMÜ	m9ÇIA˜ÊùðšårEåÌ&¸ÛêâÍ<Ø¯C™ÿÿ5í.püÍ'S?ò='
A6f¸÷‡÷Ó•µC²Êë:P"²îÜœd'šÃ_å{<EGt°â‚ÛõÅá
'Ž" Áu*+Ã£sB
/‘|	8˜kÔ)(v\`×#¬ÉrÒíË–‘:Ú–_Ä"†dh‹ÒyÁ‰³z°õ¡|]§ÀèÄt´'hUßþ¹eŒÎÀuÎ\DKw7ygOØ	Òe1 =dû²$X¿5÷¹¼Ä€eò(oŽd)`PÑBã÷y&Œ‹j—•v‡Wk÷±5gõæ€ÒŸŸm¢")Ýq¯}ƒ\Ü¾\óH‰2«WŠ¨˜2!š‘E·¯ÒÒyéÆE´ÓÆmS8…J¥nJræ¼ÊS/Åu%u”¼¡¨Áª‚¤ ÈóFòº×Xß°v~ˆòóHø¯Ãq"O}§HU7uÜ)ˆƒc1«x¿Ao}ChNv.)R—/bù©ÌrKû¼:B^ìR¼ÍÄ»Ñ³«üà8½I~‚ëfCÔÅZ¯u5çÂ–Êdÿ©	«îß–\ýlð0üþÞ
²‹wŽßŒ³Ù‘“ˆW€¡‚v@1p@"H”Þ=’*
.°æí1úa†’èç4³ Öµ(Ë¢¿s`ôÚú#äo©cR?­ˆëà¨Í¶ÈÂé‡æ&5Eò,y²/æ,’fD¿17ÝA/©Sä½!¯¥ÈÞ¤à3“3c6f©Ô²á.G-8øóK¥ù¶dŒ^A¡Éª/¤I'åoíÜwiÕéwÓ`DASéÕY=zô‚º·Ò:ÚÌð)ñyäEöz¿`ÌéS©-5jÐ**5þöqIx—‚Aï k™ïí·ç"\ùÙB–ûxŒ<Íµ¹ñ0v^Ù¸v’Ç†ç0:.„Yòz¦]š›f’ˆáÌSðýi{Ø‹¾V©¾iêÀ
*®Å.THži˜r?èñ<í…zuŸÐåˆ»ºÇû£3}ÎPhN—<IôVÙ³+D³-åT
@'bÖrLžiøôú“©¯}-%9|þrJÀ¥?x5x2àvcð±±îÄ5ÈüÞ8µ@"þ#Ëáò®õz€)'v )«qm{µÞÒ™­ÿœÆWìR_ï&ùSZ¬†‘J£>Š{T)HEZ¦¥¤«ß~$R…û„–r75Øv˜Ñ“·‚Éü³‘üõh‰µpP;Ñ"¨3QgvG?îwÏ	×lÈ½Œ’£2Ž)‰þ7‹@)Üé"Šô&>dêÂãÙæM¦ž/‰Ï…0ùYÕ+ùÑÁÕ®mÕŽ•6n¥u¹þ#©¨Ï±c'k+g”“‰þ[sä¶~g†:×R_¾=‰l©e¦w”øÊ“ÌcG€Ô29øÊíŒIÁ*™±,@Òkò=‰=.îBh\­mŽ_yÜ›é‚4ˆöáŸ÷Wì0²J-Àh`û¾r–µtîM%ôÃqr„ÃN9Ä&”CƒœÊºK«êº¨â €)G~Ï“±«!®˜C"õ2ÊB¤ò½o£ý€ýsB~ÐËÔÄÃèøÚTïdˆTúª-ß–Þ%Æ¿,‰ä“ö‡0è­’òË®_[iBs}½™òø‹M²¯xþZªÄkÈö_) “Ù8dmX	;É%ß!^–â-Ž©ºEz~€ à›°Q>v‚õß<¨ÇžôøsÞô|/Ú†]Ùº(Ù*ß$ÕË1}-di¿€.j¨:BÐØÈ‚~»pØPP¥ø¢~aQâ‚p³Œ_ÕUñÉtº£÷öy9%nÁðÃÌQúÃ«=³¾í$õ¦E§›ŒîÕÒ†¶Ö+FÐÜÃ¾®ú|
í‹—I1àxút&¸‚-D<”áêV˜R¿õQì??„WœÉæCSŠq‚—ühñ­IÉ—0ûÂý*!X½é^Ù8ñH·BU47Ä$ôîÀ9zs–äÂç¥ ©$¯çb ìÿ)Sø`Dì¯fœK±º–Þ M…äa”°(Ö³Öccqþ¹÷¦`˜¼´Ñ“Z@e3Unù›6A­|(ìà|mÎ³÷}DdT¸MÛ·(Aç™lÛj4âƒ[2í|C%$ jÅØ‘’PêÏ¡Õö÷ñm
%]îÁæ„1\GÈŽû¿kaHC)ŸœÑE½¤öÿLDoŸ˜Äå	`Qt¨­Âicë|ha‡jåª—Åêêu53ømùE/n­Ož€wåYÛ)­A ¯iéq2õŠŸ%#/î¶ÙÉkÑ"îïóCÙI !¨îß»Óñ‡Žt¿ª;OrIž…ÄX}ç‰SÑû^ÿ#±…}EL§}4—œ+zˆiPüÃ
ø_hN pG¥O¤¸Öÿø›Õl‘SþÆä³Í£àêÌÅèŸÕ®•$uqdÎì[ôÌ¤—š¶¤•´(Æ¢8[Ý~)@¤OËaÕüW_eÔÇç†ÖÅm="0ö˜\ÐHEœdýË3Ì^ÄÓ3Ô|%&`%úÅÚQÝC‰&/uÏ”Oâý:¨à&E›z_ÛŸ@§]›-®	@ª€áøû¿>º tÇ¿Ã‰´ñíö¦Q²±©×¥ëZòÖ’¨¦Ãè¶ÌÛ¼‚P+Ù÷íã2˜¤Çßõ×™ÜQm¾ûÁ6v!eæ=øyñ­Ý…°§ÖwúPm9SHP!¸B=“#¥AŠ6ôž6ÅWÏ¤rŒ£ÏwÂOAæ|l˜XàÕ(®dZ¿rª’[YäÛè$º3§úù'YˆÃ™¶éÃê2CÂPH°'-1v¼H)?0.}L¯FoyÍ£ƒFÝkœÀ/¤lR¿Wx¹{ÇYÑàõŽQYÁ¿»¯aNÐÞÃ¦ˆÞÈ?.¢ñ ¡!Ûu§½ÁE›w|öÉgéOF€§Å`?º;ò‹ü+6ù/„3;dbìiïîÕK[“:s4WƒæÛ¦jC Ò~0äç&F9…á[:Ðç…Â;È¯Å.D_Ö?fØÁei|NŠ¡ÜbY[¬¸ÑFô|º`væ¼$\r3 ÔB¿²V	FŽÏqÌ£8ï@ÚÑð„Æ‘å‹Š³ìW§™|‹k½V8²µs’ÅÕ5æÆª	íç€Zçp¹$~ZdKÏ¼Qû¹õü¸š:½îå·Ê3@vÂ˜ ´ÁÕÜj©N}£È£íñûýÍ—-š>"Š®ú‡õ;%#¢‹éÊ LJ€²½TÆõŽ¹Çeç¯üu¼1Ÿ÷Rêm–õs·Ûu‚îÌWÊŸmŠì¯U™AUŒÎ—ù˜G{ëBoÅÍÛ¡áS%F Q$¹ÖÌd<R¡RÔå)Æ]=¼^ÐkkBàXþØÀ·ñí¸VooxÂÜÕ%_/Å9Ð!Îùh3\]f0~ÖÛý– ©I6Ë™—‰ÅRm}¯z<2_&`Íœ>› éXË=pÚd¶ïË¯L1î“fåŠpæ©Ýw¯$Äé¦Å`Ž¹Ûcl{FSkõ‰	í”‰Ü‡5«ú:”mñ¬á¾Ø6ieTP˜“ ~àaŠ±—›	ùÊ"=-hå–JYÍTiuS‹@õm<„4¶;A…ñVê-(:&¢±+Ý””ì&Óvâ„i	o:‰PÌ×òQcÜë…3á‰”ž/q‚9sóáõJ8a4D Ëj_ JruÌK¶±7|¢þ'
¸ßm‹¶ÈUqk˜ŒAq ÂÎ¿M,("]Þ7éurÌ‘.*ÆRŸê¶¦œ+ŒLü\.Ìôz¿Äm(`ñÙûŒ½¤vgÏOh@IÜ’ÞQ¦š´†=hóÀFˆbdmYÈ¡Ùñ Z•Q2ƒw vDh²)ûeÌqä½#IÉ`^³ü#!‘a;J€	sþqp àÍž4Y+××+hñÀ ›[2¤ï¦ÙÁH§ÄñÎÌMWçUž6_Ì`ÓDú Q	Ä=Œ~ìä3Þåâ0äì±>³$t…–¤ÿ³jÏC3õ(ÙR1W ÉdV#†ÞÃ²ñÚ4û0ì¶È^’6å8¤IýÛ9ú¼^üÍ¯¶Äá³{ <”¨¡ö99<EªùcºyÜãCíÜdyç‘xN!â úÈó}œÍó„}“¸aË=aIVQÁçcb:è‹Î÷›‘2Ú ö¥ø©Á†aŒ÷Da¿Dm¡Â|â·¬Û7b¿&ÆÊªCCqë]IY€•i‘tç¾ñ.8Ÿê»{›Ž«MNRØÂ€n äº9’“ŒpG Á¡âÎ<˜bPé¹¿vÏYÖ„Ë-%™µªYs±yøåá"dWÒ•c‹MGsP—–A]ðFî&&ÃgÙîF:ƒ'yDJàáƒhæ]¥ö²eôrSñŠµi--!å?

)çXe-(ÜÌÜà q-ÈØîÛÃe; ô‘1[kÉ‘PºÕ_[ýãwÎIŽ²”@ð)C=€	N-g¥Æ*ËìA‚9¯ú®`¡bÚ$•«Œè‡¥¤˜²{ÑÖ©*”N°Uæƒ&g“­=ÈPCDø*~OYŒ;›“™Q0w‰ºBæš,É½7h>fV£	˜Œs>»É2  ´°Tã¹˜¾<ð§"%ã4Z*0?ÎhHÜ³MÕªO˜Bâ(ÞÇs%A¾ù»4Uîç„½=¦Ã\óÈÕ¹/ÞÀÑirJŸËÌ‡Ê2/MËÀ7¸"M08b2¤µ/H=þ‹@ÃJîÿéBŒ…`4„hßì<µe ç'§¾¦…oìÿ‰ø6Xð[¼ypãÖÝï²C|º4¾êÜ»:¡ùi *¸Q¨P»½I»ô¼ŠÁê«pÓ­‰Æ÷A×.!oÏÚîzÅ¬JªPå«¢-§1éA(KÁLpc¦v³Kù3+.ŽÉ³‚(pjµÚ3EûÁqéÔÝdøˆS™­]C¥` ÌÓÓV€Ý]7ûûQ5‘UÀæ@˜P2ùÛãÌ±0U¨ñ•Ý?ê½ŸÞýþÄÔpîœÇ 3íõƒä©Ž÷e7×Þ”ïÜ}ÅêS–X°¶Í–­‚ä÷ƒÁÚšèuKG“V´|J(ìË³l‡Î®æZµoåpåëÉðpÓ4Å6x`³ãhAÎÝ2âEdñF´6í§œ™<uè¤ / Ê;çèÒ_¢7~-„’Gè’eè¥…°žþŸÍò(ÐR<#GÂON³üÞ
W‚Í#xsèÜI]€ôœ{¼ÒwÐ;w ÁŠ>8ŸVàhVOL+ÿ‡?n*î•á/½`¢£VP·¢n¢9©I¥˜œ‹ìh×Œ3(€ÌÈ‘¦®w·UZ­úÛ‡Œ£uvßšü\J¨B flEVÈ³Ø±=™ôÇC0}ì[$Ñ”Öö†râu¡íD—õŽK	pEõöÄ«Û(\DŸ¼Rly)Ndö.f€«îÿá¬ß~¤’;šY+Ë²ñ2\Qú Ž˜¯-NŒÊ,ôu½²|s¼.ÀB+åTtê<,¬ï>e+·»®Lu£“÷žÁq,¼ÇLæ¬ˆöâ¹“¾t»^ºÊ[Á–†ÿ&4Ö—®ÃyñÈF™*¢}ñ‡á±º÷«Oä/ÑÑ¢7âCW%‰öæèO÷û!œ?=Þ‚+ËMlæDÏ‡n$!Mç˜Ux“túþŒÎ1&æ™ÿz/H«ÿþüû“÷&ØTH0û½m¦ mPì×g"/-÷“•á\O0…‘ÌÓ†$)zÎoRL®)ìÝUÈTôìQ“ó))xïŒŽÝ8>=a_ì\â»Ë˜g1‹*µQ;ŒS¢é®_çŠ/âU·ø€0\<6/´úGíE‘^Á—Ù^‡#%ÍçÖ6¡~Ð£¹2õÇRÝb)%ûäë/{céÝ`ÉÂäÈ\Ÿ*æc=†¯[õRQ»ø'xd ËØÖ¢ö€¶Ï²‡”Œ4•tu¶ÑpŽf’Îçn	L=Í!QŽ×¤F–¥ºcS+»Êƒ[{yâƒ[‚ä˜¢ÑD-ÏS=eÙ’^Ñ1÷P&ñ^¯ª2Ôc×\I~[ÈèMf¬~(,l¤±>”.²µ¡Zu,ä?kOˆëÊ¼ƒÁZ	}xWßw¾<@ïíLTÌª}†L#¥°h«dÄ$²Ó.ôô\½þY—ÂfŒ÷¯M±Ý;5,H™z®¼[9Z˜¤{%.&Úéýì©ÐºÿÄ!ó´§Y>Sê'éýÜØI: ¨ÐNŽûuKŸˆA•â|jï¼²pVå©êX‰7~‘¯å@hÝ¯tK>J0Bâ^€€¸Ûˆœ„zÚw°¥gqÚ4\[	±L³nQÃízˆë×½²¥”|\kíÞÊÊ¥3¢övAyß&yQ«øáp8 Þ@“H¯4£€Ÿy1„ù}¢Ä;MÎxj$‹Çù‰Žú&yªj›âãÿ;®ÎøV;–>â`ÝÃ-Êû‚Bko/ÈçjtÅM{ONFÄÊÜw$§Û¼©å°Î‡½ür$'ð.Ú—x³YgÅnSÿEíâ£©‰·"{Œ‰_×a¼Å&pÀ±ð÷!ç%Ù’–ùÈëhï}æeÌÆ¥8Ùµ÷TÅž­5B¾Út£·„GhAÔûê•û×Owú­ºéX´ä:1·:ƒYê&ÏL‰*(Í6.«y}¶ÈÅ[âºÏ„X·ßUÈnVå¼7OêXá°JÍâÂ=¿Ÿw­æÖT-CÉw¸iÿx]Œ€±TÚëjžÌ õªfL¢bÆ¢îh§¡e0T5ÄìÃoVÖ5ÿÑm)B—]y¾ªEäÎäÐž ÍêµˆÚ$Ñ†èJ¿l`÷s:×{÷Š¿A0Õ€bP'ò¼²,|šO»ãµH˜¦àr,}!ÎËÚ[’\û!›íŽ€D¾Ô‹¡qÛ†©_ôp9ô^ ¬6•U9Þ€kÇjøF©ÅÉêUˆ%	K\ßÂ:=4,]"âù¾ù=”Ñ®ž±iÍ&)Y+Öžôˆª§ç*i)ëu©	õBó:½;¡Õ#°³]V ­é Nö?Ü`Â_¨T;<-@¿°]¾béÎ0ÿª‘ñ~ÿkîÐ‹®ûú©—[0c»L#x;žT½£ío°¤3œ}ŠèšuGÔ:ˆšÏ‚ƒ^$Z|óqwù‹LrdP½·lsñ¥ƒ;e~lxŒ°AZ]+=sJÅ­|Ûc=:ÃÀ†³ØòwÏv›¼x·BT^*¢zw¾»;£"œ,šáÿn.5?41îl[~ÞÝŒ†•P0ƒlzŽÂk'ø¨Ã{•1â”HX-’âËìx[›ŸÎóŸ,‹­_iæs*rJ¡º¾OnRÃl^§ÇðuÝãLj—_Ó.ª	ªÓâŽ’œRÂ¿×éPÓ‘ÂH¬ô›…u
EÏ¦nÓ4;ê«ó=>kkt)öUÆ*Þ¬ä€ä½˜BîEWö®„K+,v <`©®üÊ×!E«Ì&zŠcÍ@@1©$þ£ÚŠ&·ªŽ¬ØOˆçwHú,…ÚÖX“…42OE´ršN„,‚ÜÑ©`—žÍ´ŒZ¢~w r`”/·a[ ›ÍÆŸY·öœŸ›1(ŒÊ–^3_ØRçäßkWºïU¶'6?òkÔÜ$‡î³Ü¾!I1„d÷Ça5ŸýÅšQOÜÐ¸gë/ÇÙ–ÀáLG¬ú®qè^a–?üœê‡äKEV†tê‹\6'mžoîŠfŽ`?9Zÿª´³ô#ñ¾àðõýÆ^m  ‰ãÛQÆp‹¦ÔCó˜©É5 ¦©BÿÞ¡`;#zE±ë÷nã‡dÆõjSÒl¾9óyO)¥[„9ÿSôçDîèN‰&jpzasëþAÞdJ|“á	æÖ¤"š1ö<
À¾®ëâ†>	g£âœ–H Ø
!õš«ÅÉ¼Ì/~û^¯„)ø7¹§¨HCQÙ„t£Ü|F/n•ï$‡ÓDÅP’dL¡³›¥"n–Þ5Ïç‚+¼ƒ¾®7þÚÈ“âÜ@]ú~Òóœp÷ç	øZõ¬$&!¨¬â>o²{Ž=è”žîù[¾Ò:–ô­ñ·³)¦&V”ßO×´µQm÷¦câ|áRÌa àõÁŒD¸(%êìnl>"SèwÀ%¢¹ª3ŸÍ=7LÉá*~Á™ßö¨dóåyõÅžHÙÆEå7*º.däD°l^Pqp`#×oý¨] ]Ï†¾ÆŽ•;ô[©×½ÆÔùÏdÏ¦[tþÿÜP»¼˜ˆ55$ÃÅ 6
Ê?;í‹Ö&/>Æ<k“LB	Z‡5_>jÚW!ºôTXt6°éÜ:ï}*–®‰JŸí¥/8sÿÍiâ”LêZiI˜çŒoêÃÏß“A¤³¨69ïÁî˜*ÅUÁ¼½H*<Ž–ICQð\cR®›¤*h8GF/¥ñ¼î"lŠ•ÞcôdônÏÐ+œålÐY§!ìÙHÅì´¢Ùz€&®‚é3~;pNŒ®òÜ§UK£Ì/u.üê¦]œyê8ú·ÄØ4&®]¶ña70"°¦‹H¦y‚S‰âáÃõ‰1´±Ý¦›ñ!CS„ƒÿ‚ï ƒJ‚>Û(ž7¢5÷<µÃîº³¡Pã¢1B”OâÂ&aÓ~e!GXÛoAR+Ï© ¼ó‰üDh¸S°xŒ„:TŽ9ã&êÀÔ°10â¶âT€ß‹Âœä£CÛOqw¤¾ÇØ(A¢ôÖ,ò°¯÷˜kñŽ‘¹Gð7a”¶„¬ò|—ß•k®fì§­«¨òÜ’Ãbk„\µÂ+¿ð.8=¹E|Ë‰°(2‡êò¿Ì°€†¸=ý5¸1IÓì%yÒ(É€ ÚßÄ‡€]ü\>xuQ×+«Ž”+-ƒã”h_§"µõlcòMî‹ú­XUC%íÐKy‘›#ÓZPr- -œZ‚ú…«% d¿ßŠë`fèT»ÖÚ_c*è_XZ=]·rzÎThÑªÒtºÀ¸dÍúŒ3.‡2ñøl‰ _Ô(OåõZ,¾uˆ#’vTnAó´·€m|‡Š7¨ö-vûçºge37/gk-?L
ïëöZr¤Hku0¤z;pó wÿYnx–íHáó’Hù°mtPÓÃQÆ)lTS&Òöaá¢Ó§l39í½ŽWŒñEüÔ ¶cY‡@ïÚ‚ÅäýP³ŽÂWV2e*ø¸ÌÜRýNJ;Z$‚¸y²ëG	Õ5¦irtÌm°qT –!½° Ôk)ÐÇ´ÆÃÄÂ°ÈÈ}íŽ5Có=5aogï(/3Ÿª}{:÷g‡¦EÍ ÝàÚö'{ŒÇ÷eU!ŽaŠÄ~Û9:Ÿ×Mª7)1ñn¯SGEÃOÜPíêPQÄ69÷ˆ5dvlÃB¸¶—&¥Uh¹To¨Ô2—hÏrÖöæ?»Hçm@|-ÓeÓ¥Ã:xè¶Ù=ZD4ðÀØP6éØïF?¸ñy¥£M
O½¶¾½—6	âŽW¿B™MENŠ“Ž,¬#XÆðp²•Q„+u”Ôéb[fÚºÛ^¼®±©¹Ý8-(”:°msª'^_Ÿ*Ü¿=kæ¥Ýþd	æmSs Íjp"%öŒYÑbì0.¶rÛáÏ¼þÐJ¼]üNëäfÜše8„ÄŽ»œí—ô[Få›§Ä‰ww©µÜÜê[½´q‰ÑÛ×äì&×ú™³@´”	ØÇ“ªc%´ïÓÊÃ³ ò·ãRüs·©= ‹;~îÅgn’dö$KŠ9þ“?ö²ªRL-"ý6PUŒ£ò4«Nq:D‹(¥¿¥4çŠVûùØšb5¬vË•c§»J	!ˆ¥·ñs²U9ZØ'ø²½íËm_)T¼Þ¨á”*š[€=\˜ü©‚g©d©Ùž7LøRUTåà èÀÕ66 êRô.´€¾óS=ç.D
†ÇRµ÷ìµîÚðj[éDnÉR‰€ÐUkà)e>ay_+JK­ùÑÜu²­K~Îá1© ŒˆI´?ýÅÁ`ò”Uü°§e¥Àšmp›õÏ£^Cès4ç”æåƒ¨Úbý\¨†<‘ù»‹%¾­¶›ª™k?UÉº¿É5…È°}ÏÍuSµ£\šøõ‚]ýOIz~µHŽÞr<¶Å­ÇVŠ5>ŸNî}"âE‘Ü©ïXãÂÿâ¹Æ^kÕˆNsn´`‘’¶F1Ä1†XkÏ‘òñ-¸hHB%Œ­Í, ˆíµyW Ž¸ëqÏ|Sæñ·Îyí“´âï„\UeßF5áÈÑqÊjyvÿÿ9qGä•*2š#Ç°Ç­íˆCŒÿa*±PU”ì¢K˜%¨“)O6©Õ‚IF%Ï¡úÍWM!È+i-–}“ƒûä´…[ø®Æ·¬7ÀÛSæ™çêÀoÜØ]ü]q]Ý*œ”×ÿn	 
²‚°óó‰Å'Uð]È¬VˆÍ4Ãˆù^ÞªÙM®š>ì|ÌNÄ`êçugÏiêêVt9­;)yhgÐ)á+>ÞFm_ Ma¢éô)¾Ì´jøëŽ»'ôçŒl§ÃYKyDÑ)7ñ&ö­	w*Æ¶üÑÙ-R™¦NG+½R'aQ¹‘&F˜¤ž–5ÉŸÚˆ¥ÕÄ°uÉwÑ4Ö3ýSÁuÒŽ¹ò¸>))Ì¯Î©Áf5ßlÊÀ²ZÍ¸Ñ…'«Ö¾‡Úß2.RŠÿcé¡ÕšMbÄv„ÔÔÀ¬ù‹-çš` Ä¢‰À¥»vãZgòœ´Pì ÙpÆñÓ8¨\&è%³ù-í•„¨—èûXžjŒ…H¦³@w<¶ÁHá
˜Å›W,kd*6žâA~®5!þ«¦ò8¯örY@½EÆsÙË7wŒ½Q™‘øû„è0Äh“¡ÀJôY‘Ï¥A¬ìú¤nëÕXk^>CQ	,¬5;Àòd' ?á¤"î}0m¼ÜšˆÂKÀeƒî¹U¨Í±T‡•1Ò;Ÿåç*jºr«çlHe(‚±6V2â-ÅC }ò2“ŠÄKŸ•AŽÿ+A•¡ÑTp ê‘™)-Kæ6€î¸¢±<ÌmFP79ðjÝ¼|-.ðª	ª³;é‘,RâZPW†•oåÆ‘2~SïŒ®rºü…W’x.ý ‡pð‹¬>‚#´pDxK=j'^Ü¥íþÓÈãÖe2Ä|T²»ƒP ñÆ)åÔŒÙ·L©Ù¾î¯FòJ´$ÙZŒá:ÝJý²¹Q>U4G¼RÃHœ÷VË#ÁÆóg¯Öh³Tÿ|œUÒv
íD´Ä´íRzý|I2u‘ˆèó¥ABRÙæAô(eIpÙ'Š¨Ø…Yõ™iŠ¬Ý`aH[˜DÐø_~—Ó­óåÿÇ[š[Z°r‡[¿FF_eN2>'a³ÇqH‡>ˆéðöÚlL94‡s¥$#rä"þÑ¯Î°QwÇ…-~eÃêòÄr7½¶¦E¿Üq"ËïÉ¡	“×¹$ADY6ÛãÂÎƒñÊ*‡>Vþð7XùÏŸ²›ÞÓHuB×¸Ü¾Å›oè³š/¬(2œ¾ &.½“{­L[.Ëhc	y¶ïn°vGõ­»Û £vÛÖÅWA?ä=€pM,@€éƒ¾ñyŒÂ1¦-y‚ð4/få˜;Ök;›’‰§OQ¯ò\Þ8Í×¿4Ñ±z/)«5´þ‰Ñí@¯ÉLKº?.‰(593n>ˆQ&¢Í>ml•Ø‡‡dø‰‘ÇËu²!mú‚;¥½.#¹¶ÓÝäRäb 3ÈmÉgc˜¥•˜ Z;bàŒømZa™93FPqàu—’†:¸ñ[kÁøŒ˜»³4èð½6[yMSû—OÆíU)EÎÃp{:¶!(hÂôê^a¸Ú.ÄìZ’¡LžYZûÃ9úLÑ±ü¥ã+HžV§øô¤O{^0×V£ÛçÃN†EBÂ—*R»¼zN4ÃŠÅ@¦U¯—¡ÁÛ¸BŽÃÚ’ço!
_éc-v-8Öø!¡Ðëð˜z+J,äA(©S	Ã¢x[×Žž# J6U}ö´MpHŸž#ùqb‡K¯ÏÀ‰ÓYH›B•¯Õ|¥4ãÉ•y8(@?Õÿˆñtˆ	ØjäeD²X²«'ŠÊe„8>¢ Ý©E'¿XÚ)àŒIß&×äWÕ¨”ÅÇ<_žn]dÿ!9-‰+BƒñÎdt>ÃÅLhÐdÎÎƒc@Ïâ¯ÈJ~tG”º ƒÓ×µß»L2%GPÈÅJ+Ž¬ða“S_Øc´ ]plÆéfêìÑN1Î`þj¶ÄÔUT^gý^ÿöa4<H
» /è—ò%0à÷MÏüÛieíîÈ)oÇúÙÃ6Ò':¼Í{ËôY;âLÆHfi¦Â²b,Ùm¤kâßü:ñ6qèn7žqø,¯™üB÷ƒ¼-ÛAœÆ™ïcÍî!.{g Õ³V‡Ó[Bk’„­ç‚ÆÉ¢’Â1Ïè µÀa·%÷‘Ã­·'„@ç÷ªþ/gÊP È‚àP•W[ýn`Çp[è×‘Gõ½ÿiå. A4à+Ž·^à8<G†Øþ°„:ÝØš´ÀE{-tbÔoÙË)Ì.Ç€•>ÜzìùuîpÝ4BZ”ÄÓM|f¸^Ú5ø1²dàµu­ß½y¬ˆ1ö§V/UG­˜ü¨&=ßn¿è¢3¡—ïÉÔnb¼ó¿g^³%K¿Gák\ìô7ßL1Vy”•éãöäÜ=Vºh’1<§½5é7-‚osF¨‹\[ºž×‚&e-F2Q„kT•4™ôÀá6„a•¢Qïà1„Â"}š O5eF¾_&KqÒørX41ÜñPª^´Úa÷†À£ÞqµØ•‹xŽ>vÅa¸¦+?âè0ÀNù(¿¦· U¸Áíß½ØÙ’(rQ‡T†òGx¼qr?‘ë9šZ„¥á1ùK&aŸpÌIÜè‘E@³bÇ¯EJ@_ÒöB/Î¨:YÛ~éa¡f*	ÒSöÕN_ÖÕÊB½‹M‹wv÷‚e¾¯ú˜k”^%?EŽE‡†öÝ7]z–¥ÞNÐÊ]¿Lo¤|¡ÞÂº–ƒAØPÓBRSn¿¼¯ê‚â×¬EA™SpÁ‘#ø\½mÜÔó£‹õö³×uBk Yéû‡ÓÆh9"Q½3„~ ûŒ‹qx0¡<•¸“z+`ç{ïyl½K¡#wÜ4|&(ò¯EÂdÓ§Ü(QeJ–Y@#&€=
••¹p‹‚ÌKú=yKTüÖÂ_^lðÇ„ü¨ÆLœÔ¹¹Å¥_Õ†
GÜü¹ow gC€x›­}–ÑT%áÕžíŒ‹‡ðißî¬TûßX‡Õ¯8ñz?äpwA¡¼=‹ƒê^\¸œ›ák«°	$½ÚgÕÙ¥HÑ'SÓ,_È^XkÖŠ[šr!Hðœm#2yj†ÒK-^´Ndñ@žúM1ÿŽºÑÉ?Y¸Oåf¯¯VpÏ×Œ–ÜÿïUW
„ôñþÔÑZì“Ì¬Mã_²¿Y¡žÔ›Bó¹~gÛêõ1·s²°tõK8ÿZž_äÚàgÅZqÐ
b À·³éÍ0x¹»ÆïWTƒV~äcYÂX·ëØ¡K?»§!4,±æìèÆQ$*l3Ï¶2PYæw£ñô1xM›É°³Y»•Åý`Tã†°,¾€§
ËùÈ†‘êM³íCé2éî¸Y²h¡qZ] ©ÿí8ø­	Ò£Pÿ7ÓNfÿJdE¶¹^( a3Ñ·×•]#w.±2URi|›3ªÁ+MáØ¯¢–‘MaBš«ž:ßŠCˆÂ·—R®4ÄÖ¯ßhˆd'Ú&ªî|WÐ·êŠ÷oˆ¤W0Ï(þ£<³Ç°sÈ4UÍ½Pâ:ô=‚^Y0a"Úß,ºæ¼·«÷}€¬$¾T_-3ÆO4ùkË@ª~Õ‡ÿB†46‡§.´¡”{1?nˆî¤\¬ñÞ{æ‰ó7‡üÝÒËp~ž«4ºc©š¼ÛIŸná ”Å'“ü<™Ÿ-9…ç¨l)sªŽ»;¢ÏSÙY^Ì°|è´
¾œ‰Á¨»Ã¯¶“9Ä» Ïx`xe¥ÝäH9­z´0ôuXÕ×žH©ÝÏLi,q¢.U¨7X,_‡ž÷G¨	:7¿ÎÎ´¯@ŠSåÄxÖQŽWÓÅJØ€‡\G3H*øN[¸»ñj2û£7x'ÀÝ‚o±Ñ±õãfàT¿‘Ï~T`­b(Ý#ê»Ø&º2¶òœãï–K	•Ûÿ²ÁZ¦ÆJ»f^Ža0Ä¾^hà¹uáóÛ#µ¸½&£ñ¢{Häú(„ÃAÛrÃi¤ú5m¼œ€ñxÿl?é¶Ú•›ÏÁ=±F®\±#©ÊÁîû8ŽûÛ0K36t÷U(’À¦IµÅCîyºû÷LUncêˆz{Mg½
Ú«¶È
7‡Mr”VÙ¹[ä§‡ˆOúCù5<…«w-á3Ó¢ïÿÚóT³žqxÆ~ÔÐ-Ó	[óèméç·Ý™¿¹_Î*2˜ÚY›³&cW3î±Û‡¦SIj;„†ßäUCë
ÉYÂ·ÅHŒYÝô7.[ôB«Q‰ªL«B˜¥ rðÂÞ? $]Jž*}º
Êá/}è°º‘çlûØ¯»ˆ(Ö»ágyëi¥ÊR­Na¢7H0 ¤˜·Ç
#s¦ÿ€Tf†R#f!ùÌŒDZ)sˆ9“+‘f©¡×$Í.êÛ1tŸ5¾áˆþmâ/=üçrú-72ª[§góL]CXÞs´Rf`87¶8Éõ²”*É]+m'æ@NŒÿMÒi‚äk§½®FÞYG¡³¶˜;ÓÎÇóŒ¡bÝF?¹×ùØØ–ëbª[
0ázÜîròzø-P û™¤åÉVýq*)B‰ÁXŒÆ¦RÂ3y:jG:û¦F=Ž0ò'·YHPRÿìÜ\.˜d”µ“IðkÔ:ÜÏ÷>å˜Û¿ŽÒ}fâÛ4¦¡Þ­úAàbò*}ón!rÚÑÄpæ{öpâä4Ü\pÎìlgÁ6’cm¹©5:´|LüEoµt -—Ò—À$L©ŠxÏ0›ùñ7W>«÷ÓeÉsÇîÛŽóX†ù¿KŠR™u]í_I3pYž	+žªä“èÌ+ì¤G±Ó~_‡ëU!º‹>Ðˆ	ŸÈe¹ËÉæU¼Ö+ëÉ €í”–íéÅ¥» òNw›g³\™§H“à3ebG=ÝRÆa¸ÿ¯At4¾ÕÌúc—ì)pÐGø  ë¦,ì->_g’ýö‡§÷SÅÀ 4ç¦õÝôÑzŸ`ÖS;8W—¢ÝD/ÓñÙ:­êùâ´h Ž+%Dq=™é[ú|<Ybq)7>«,’SÝ¸yÝYåbÅD™N3g”át½¼öÊ)}cðo"ÙÔÉÖ„|È¼¤k±+3Ö¹?ýô²u F
s÷yš7bA¢—*ˆ\àiKþßá4^„9‹äcÕ2 ­È¢©ŸâIŒ<>{²$åAÃÛä·ð÷õÿ|¸¸’%0åUn®8n±9pÕóGy¯ÑºW<HE#bÍT=äc¼æ] ÑçÄ!6,Ÿ“ 7^q²SÊpöZ„æX	Å`©dHq}üo,r†§™¹*h€R’ÆV;*¶Ü°p6ÇF´$ÚnªHzôõquŽìVlk\jISX€±pýâ–ŽÙq’/m‹ÕÎ{m4Žjš{ŒZ Y³H¿ÞŒŠbhè‡Õ|ý>¹^TV6~²¤˜ež~S¸KLÒç-Å`aê_£Cksk3T_ Äejì0Åâ¸qp!=$÷àà6¥¤æìlLi©¾å¿yyÏfpÈ*IÒ´(ó×²=»,ÜL“`š€lòÆ" EÓ·åDì‹F†\b7&1ÊÔ€7•œVí³Wp QÀb5˜Ö1Ï¦1ÿHMÁmö—¬ žÍó·™$æEÞz«t 7Ej½°á¬QJX…ÐX$€±ë¾ÅáÌ1¯4JQ	61AQfÞ°ì­“»ÑJ_ð™È,žkðÎŽòñèðê£²J›ÊÃuGä&‘©JÚpô&Zzë¼7b*Šf.õñž5^…ÓÌjbì‹”ûû8àÅ\\’¼†|*|EZk§XÅB¤žÕç6$eYLþç¤µ:¥®€Ðs"´Õ2ù|·W`„“ã!n`xf2
šJœœúÈï´ôK£P{ñÀŒy‹Ö°°‡l˜‡³xÔi{Ö$˜Õr"ÙZ%²r–uÕ sU¢¿ý9©ÚMý—# ¶=Ü¯&³OúŠÙæù*î>O‰ï¾¬®+pBŒ}ÂÂ=îÒ““zÁí÷/Bs›ÄWl}*—•_DOÛ
|ú"í‘Cß\÷íøQfòÎ¤A"´°]g”þl¯4k7Ìlœ*×Y9S¸iÕìn0Ätµ¾àdµB…n‰»ÞF©H#ÇÓ¸¿x¬Óô¾%Cœ|6Ož8YrïHt|n¾kî$
iûckK“#,5¿Å½ÀLsV˜ÁÙ®è9U:YÀÓRÖæ›d,úë›Ü.ùs4—ö1Æàì†‡ YÔ}»3Â/8mûŽ—¸õ5‡J9Â¬É+íÏ °’FÏ;%Vü*uŠ¾BÈ> ´Sì]3¹h·¢‚áúÙ,JSÅ	Sóåí‡òx SÓ h#£&kCËðº#äŒ•eväv‘³-ª¦Á-'t“!Š”¨Ü€úâ$‡MKK<wè½˜®Ÿ•,†£P:ý'
ÚîV$Çàð:÷VY`2 w-=lÌâ¯u€ÒÞªŸêRÏJ¦ÁÆ´$` íë8½/ˆˆ°ú³:YÔ#¿ë£h€¦¶U¥æ¶?æ‡X¤Ö÷€¶bÆ]¥>àÁ/î®­/¾Sn—(7ž»´î!"zPløciã¹ì1(?“È3* žBÒ’Ó8Wg¢˜÷!îµÑšßÏúp–cª2:DÇcŸƒ>t¼|¹ÌCKck±‘­mqgùQEv`å (¥n›‰ïe•Ÿ2Oô8ý½áNÃ·•òÐ´áU&t7+ÜÄÔæˆI±œ¥÷ÐÀ¸0gÜ'“$‚+¯œ83¨éÆA¼JÃ}T±â‹d§*¿íj’Œ"¨¥5Ój¤ Ã”.kºX½Aøâ½–­×Ü³StS?;õœ|[`.ð¨Ü~Ú¢—ÊŽM[\u¸o€¯æ|
š=dEh8Ç0S)%ãÀ^Ÿ80÷gô0»qÍÁŠüð›FK%Y¢ðnß¨ŸA<ÿJ¨?÷‰&ÉÊÍé´‰èNs¾h÷µåáÙX3ò½è¢âK>îÓ’Ù;~"îªÁÁç^áÌø$$o©¯°Ùû»J}ã}#z52‚5³”§t‡¿šÉb_´½Ým—ZU†Œ U‡ø5Òöhî2Ò¡Ÿ¸%ËÁˆ£ÜSŠ‹é¸35]ÃÙqGÛr à(ÀÁ3Åµr ,¯;P^blöš&Ÿ	Ú~nû½{à‡û¾eèªãËôéXâOïX‡¾VŠ{V†P—áè¨&?N³‹ßD×"-É”/?|º„wÛíc\@fIéÝÜxªÍ=.!+´4ßà :r4	¨,™ {uV&ÞÞŒ—GluÉj÷îûù¬ÑÜ’47œ¥¡VæJ«¯zZŒà†TJÝf"É£ÇÁ½0lð­ÈßòàÁØpG¢±í~°1ìFÍÓ?Däbü½wß%JÂ›±Q*%Œ‰Q/Cß°ð¦í*^\eKZ¢¬ñÔBr³¥8x ›N²šAµªÑ¼ëVÓNbÊ(ñA“JšdþaiÀÓî(w°Â×÷&õNõ§9}#P¿^áÏ@gÍZøua`Ñ¬Wˆð®'Ã°Û
¥á{öGœ.óts^Ý;vbÔÚ0‘DÞÉ2bö@be™0@#FÍåÀ`´9º{=LÎO¶†øÜÀ°e|Mó•ª"eœS:W…Ï=®k™'å_„p¡¸fèE2ö±fÁgœí-•xqDl ÑbÌ*€¯ ç]Ý+ÿW)ÚlI2íl(‡;Æ½d=9Þ;øÚ†W#’C‘tûq::×)Â¿ýi–ŠfXq^{sÙf©ŸÑå%Ð'ÃS©’€Ò]#/¬‹)!”1EV"SÿCÔmÖÈ¬a'-3Â Ô¯u	Û›SvÖ4³rj¦y¢ ¤`Ú]‡:UùV%|œw“»`uaç+rˆ
0Ò[¨ÌÆ	ŒáÿB |,Ý?!<Sò7^¯{]ô£„ôE‚si6r(E¾hõÓó™º.Uû
× ÖñÁ8åG[ÃwWÒï`gÉ øV½ñq¨*·°¶ÎHê¥b:?î‘Ô®ÇÎ„3»áH½L§w‰É¯mgYØ(ççý/Ní&ÓÑçFOuçœÑÃv"Ç3%öñ‚Ùïú\!Ýpvÿ³Ä½ò\ëJÑpHySþÜ=fÔû‚øJÂ÷¦WWgx}FÚykx"ü8”…æ»Õá3Så!t‡¤>ié“:Ö"?kÎyežAwøÇ,ú{žsd2Ëjoò†áú¯båc¬Ú‘;p{ïèùgKÿêiÞi*]øè–s› “Àñ?Ž3úÏäþB”´Cè¯S]Pr‡ØÚPÖÐÀ«1þm±¼ª€X*×«	#éÜÝ×‡d¾i©IàJ“wû^0äQ<ÑM6ÿ’n7_·àº"R9«ÃV’AîDÆ={Š
ÿˆQ« ¼1ÕRëx‰É³-t“gÓvªæ:[IÌêšÜ–Êp,JS¿Pu˜Íò>±
‘¾’èé„úFy-›l2`¨ÆHC®çá0ôÚ?•&ÜèB²*QÆVÏ§=vðäÑNZùjö­5Æé.hò¸Wd°x·‘¾	qƒÝQbƒ4iUÌØ—B©è®R¬O³ÈÌra;¥¿Ea¶¡¬ú"zepÌ¿Yus—Œ>å)¤$ÿgŠHU	á 6|#Î8èÃÊH—` î@@Þ ‚äZ|çýµÌ=à`È8DrWîU:ÂŒÍ™hßUÀEÌ¦ý~§fÐ&×Áz6¶Èk¤yJ<¼ï4¥Ë¾¤hÝôø$T®à±âûi®dä#3Ü…;ø÷:fÀL×˜gCxa˜ÍÆJRÆÇûÎ»]Öß!½ër¢ñy÷¾#7NõüŒ§·¥–5 *¡çëÜŽIkí…öµDÄï”ù–Ð›—<(6'ºNBê·[ûnê÷ˆH¡Û*±/¬Øªs¨ ‰qô¸Kì¹þŸ÷DKÙØH¸HÕŠQ¿¡1¶>4Õ‹EãW°°N™°FMÔ<H7{úô5ôÕ£ÿÅüáÛ<a×úÈË!Càòiã¤#ñmhf:Í7ËawIê»k‡è ðœ:œbÑCi~6ìåô	¹–&½:Àå'LÐêçK›8äï`}OKí¦5¢î'ØÔL½‘j ;´]ØÂ$wW(Vr×# qË˜9ÙéÜ{¿X¶‹ºœóž±ªÛHÑÚ$Ê×*žµm˜ËÁî,³oºA—?Û[Í	#‡1žVØ6=~»ºJ¥éøcfDkèfpH–*Ã°•õ¿…§Áw«ºçG“cd˜¡ŠžÆw!Ó¬!Ã Ž o*piK'k†qÐC.&X¬B¬¯ÑÃ_õ¢+èYÅý4¥øLüK	¹	ÊÒÑ	i¢H%Û\-<dWÇTágõb!ƒáA"VœŠ²{yÄ¯¾’¶ü½ÈBœ-¯ÏÂG‚0àöí¾]Pg>8å(øÅA»å<¦9íê ‡$dæ4¡R5­€D8Í:¯ÅéŸí~!‡Ì>k«X_ªaï{n–°ÊýÇgý;1¤ðKk#ñã::ˆ+ƒ¬”Z$w¹LÇ³r÷Rlƒê’q™[&7§øCêÙûbí~(Ÿ cf{auï«_ÔL‘Õk4E›ÃK.^šä {Z}&’¨,áS‚2ÀP•0&Ÿå¸k{¾é\»®^XuìèÄ„F–?’ÃT*ÏgxfýÜ àçûñ¯!¤ŠMâ®RÍzåÅ gf±¦Ùà‹ÔŸÿ§TæMíF²þ‚¶¼,ÓÊN•‘dœpu74ºø·LÀ–@t¾,ñxŒétfŠó7àôÈ/öŒüñX+„ÊQoPF<ƒ¾Àå#¢³D&@±5àäY½ïg}°O¢¿Ëª»ó¸žã†»ÀóÀË…º˜ñ©]z'ÿ„ø	¥®ûm)ÊGn¬*&¨à&–ÕSü©'1¤%“0 ò¡Ò‡·€ã¤.²gÜiUé:þ¸kAàC»ÂtÒný„æ†îÆÇj7öb<™/]áÆ;³ßÈëlmîNÐ+ò•pZYñ?ÙäºžOÞÜÿ÷?ÙŒ.ÆcæÛs[lrå ž¿4Ö2„S¡»ŸÏPÌO#Fsã¿œ¸Z6ÿáü-ÆZŒ EV„+‹Ò|ê¡µï´ó½Ù‚>ïI^¨±%irKDÃÕo¦lÖz'«µÂ[°»ƒR°%‹\ó¸¬‰ç(÷ÿz-Z¬­v*üo®¼D ‰Y¨ðŠ)'N(íÄ)ox†ïLvx“q²&i{K9ï¡ª\óm?¦¨+á÷ÀEï ½à#¾7|åxh~NÜõ™ÌBöÒ^­
Ø#ŸæaÉ¿æ¤”ÎÊ]âù9œÍáíîÞë@ùœ$Yå­Ô‡Íwœ”£;ùýz¥ŠÉ];°¢ÆÃ©/ÜÈôf8að*c£½ý™´ˆ‚ŸñaÈÎb£ÔÿJÞ1¿ºvº+îè3É;ÿÄô(DWš\B¿7ôó±ÐÒÅžVñ&°—	¯ÞjÜ@€ü‘Ùöø{¥ì–ÜÊ(çÙ â“Ë”¨çA/·ÞÀ Tc¥GÌá4eÎÖ*ÏåðFÔ®Àgò*0ê…¿ÌŒŽu3Ámæz¥|yïÇ¯xd*¢â#ÂªËu¢yM¦ü*ŽEÔ‹ßE£å»G5z]¢Ë?’J‡ÙpfÎÜJôP ÃŠ2Ÿàé/ØsçÕÄÉ¬¢¢U'"ŸÊf5“—&ø·Zú˜Ú)&µÎ]ÊmœÃ †ýÇø«ø£Ìp 6êZ ŠBÁráô;•Ëÿt†¯—áÐÂg`¸ºV§Ã—%?¡¸â$SÙŸ!Ñ'¸"óLÈOW»hGRyÊ±É+ªŸ Í©ÐW8×{U‡íBgÐŽ$~’´¬Àañ¼ðÐí"!Z¥Ùyr‘È4U,t>Ypö‘ëEdÝÙZ³&;#ñÁB±‡œMš^-Ó/GÐN&_cï9ÑàÎIù–•2UHéøYM7(Žv§ûµQàž$< ‹À½‰Î=IÏÆ~¨£$=Cñgì×‡ºýŒ»Âò¿_Ô´È‹ÓVÜ1Nï)íóú*ØéóýVÖ¦ó5sˆÜ?B¡Ž^eÕ±ÝûP–áiYtKÒðñ·¨ªœ1(IŽžá^TjÝÇJvÀÙÜGïdÅÖoÞÝ¸Ÿ¬ÿH(Y"º¹–r½tIÜíKÊÞÈöd„´\/|¹¹¾£»‘Zå"Ö@ªÈH†h±ï:Ôµö‚)[IPôÒ°t|Ä%¥ Æ1k”¤dL'g:È‹\¾‚¿*Ï˜:BÆT¥IÇÃlF\;ÿGCè(?LÙ¾eÐ:óU»*á&ÄZ~ÇÜaÊäú)ìKÉÇÌñÔQ‘ƒÏß=Q¨Õkã¨ùvÕšCgÓ5>Â³cºÌE6­|ÄÅ	[“ƒ²ßÃþã^ÙÍ½ªéˆØÍúq®Èø‰uôn¨ø¢¿…"ÒC­à--Všì…gH6>Ä¦Þ”TÎÏpØÐÜEÍk:%WœC×†§ÿ*­.‰ök=›ÝÔ¿déF*ª«œ^?83žU´w4Aß€êž96"ªùÀ¦w…¡hÕZá!oD™2™BkD=ö:ç¸¿‡hˆ<€ÁhÔhÀ‚Ÿ…ŽÎ%Cbk9mÃ+·A¿âÕˆ³…*O#G-ÓÄ³žè nf/ãuæØ"Gÿ’#ˆÛla¦ÒÜÀYú|,®ËÜåˆSŠí_£KÛï¶!e7Ò¥yß`N„!YâD)ú“Û"Ãs0ûJ5¸>Lø	 ¹>hXÐ³ý3€‹1š< 4£HóºáPÄ)»÷½f¿†Ò×Øj¸€ž³®À?e>BËD¢ÉD^mr¨÷.;—É§¬Ö«Ù?öÄŒ‡¡€­ÇnçN#œê¯KZrñ=Ýðï©óÕC/ÚyÞ÷g§÷—gýëÙØ«ÊîÄdMVýeP|á_èÃ"
@_IõwÈ‰“r3jÇÜÕ¶Ä5‘ŒÔ–EŠÇY0¥òÒËbÞÆ'Š¥4àB FÌ@Ä˜7O¤ã~Œó/x’š¬¾Aã«êœÔBÁ(¶¶¶IYá—£Õôß’¶”3¨ÉcN’9`@œ–;Ïøû1™Í¢eF\ëv°XwÉ¸«	fC¯í	7gnÒ}Ž ×f¥â:GAé¦þN}O›¥)µ=¯¬™ãvŒãCG˜ýìjG¼„"ªáÌX¦vÆ}&Îa$öÊÏP¦À~O¶KþXCÞWêr¢héçlWN7ìÑaš	Ñµ Þþk‹øAp^îä&µÈ‡M-¬ì®iId"=¨6Û¡=ÀÊVú	=_ULóDÚ a{æVü·Ã¶`só(ë’6ëp´&Â»ÈŽ¶7J	Zµÿõßñ_#aH˜ðN¢F…½FÈŒHž ŸÉ¬B"—ý¿33G¥$é~¥âç£ùÊÑ“
LbqŽûÂ ËœÐ@]ºFÀé%Î»EÅÄíÆ8÷ì%Ä”rÄ/:OÈ¤ëÒïw‘òž¶R’ÒN	0(ð¸",xéb&Iò>xÐ#ªÏ˜©rõ ^ñ}^ÈybD…œŠ¨ &ˆš½
ÁŠßßtõSÐÌšÞƒsý>¼7Õ”P%øõZˆït1£2|m*FeÖÆR¹šçä¢ ˆü.e¢Ýë]êËÜö¶Þ¡½[bÞ§`¥G gÜeyžÔwÇ8ŽtUÚMz¤ðfÂÁ¢ÁTGïÂÕG‹¬=|€8ZžVôž'i1by<ˆ!åu5ÈvRûæGÜ§/jv
]ãß¿ däÝDYZ+„¶™œƒšT+úùã7 ¦Ë/7»MÂnîBÙç.¬À©Å\÷HvYT((|\þvO†ÓssLgß©
à#¢¸d¦wÉ¨†AÆ3¸ Y?U72h¢s¼Qõï#^î¡Ä³#î¹œi7JÚA‹àz»’d	¬	ŸËPFZØ%±9<sd‡é‘^Ûu½OÜjÍß`pKÁ÷3‚ËþöŸE”47 SoíV¨Ç#ŠÅÈ¸ÓÏŸâõ‹æ¹ð`xr ‚›=Ç.F¿óD˜QÐáÊÊÀ`¡Ÿë²<|]Fµ§n8c,ÓV4aÄV;ô©ò›brìŽ”•úHéÝ3ÊøºñƒÀ¤öþ0b ý[ó8ÿŠàoû2—ÓÇÌ4À1¦øšÇ5²¨y3Nàùv
f$0ƒãÈå8­Âú<"r’&Ûë$}ù-m,å^tçz’—éœùèßã¼Ùkl«”eývÇý‹}†§úe¹g…=ý»@êŸú4µ­:|qÊàs,ëæáþö(XžõpD´š¹’dNiqEgK]ÞúGxþi‹aV«:m”òÒ&ffƒOc(ˆFO	3z;pe®Ó¢÷SE-jke4H
‚ø¯íç
KöïÌÑ-ò½K9Ûìc<°7œƒk@—ž-A/Ð0»¿²Þqîò5]>.€Vœ»/\íÜ—]qß²Ê$!ÌMeüÝPá„Ž$"&5`óWëS=h_¾ÚÕ¿wƒ<•Éé—¥÷µ	J UÙïF÷l¢h<³}Šý!½û7%E¢	qìô¤LuöŸ“üüÐÇ5)³+šøÆ¥™šãžÅ-hut…¼Œ`Z´÷Ì‹“åL÷ö_­–’™vônëM£»lL­°9BZÌí{”|E‘êaÇÙJÏª+J½­d°Ö£Ž½m®p*ì´0låD:‘llñ–·PDÉ¿ ÷N ³ÍÍáq¤ãó„mhÂ¹¼hA"ƒ{~BµÖL§½ãBËÎF« Q‚~ò€Üí­ñV¦ò ž€Í‚µ€Òo˜ú?Ö”®dK·îeÝ|ºUÛ„OTI)(·P æcá«‘õË.AJhz7$ñ%~]ãGèõ£"EÍø–6ŒµWeCJ')“Ö»F’Â³íÂ6PrL
f[ýÓÏx§ZÏ\Êxlúg¥¶~OrÉçj9I¸áh‚Â°¹¢S#ÕÕÈ…åy6Ò­¿Kû‹gßÖ”©Vèì«›yõ²þ­©*;‰¿;ÿz|œe%TÜ"qý*ò[<HÔÐ>îŠ?8„Ô¢—»×3ÕYóõRô‰ƒÁó¿¬Û¿È]v	Þá+÷h€CÏøV~·Q-38Dõl48§ñlùC¦ùúXtD:´±W¢´ƒÇÞL}xãr$*â}‚‚sD÷â\ÑFZÚ{nÎ°úüÑ­~w·„—ñåÈÕÉ‡æïeÅ9¡15-à½TMÖ‚-¨!±½KZäð»s,Bì×GÅ95íq×‹š^WÄî—íÏãî.ûzµ>;C"øŸì.LGSZÞÝG_4Axaâ‹&t1–{"`9äËê@w3£ F´P?ÒTÑ˜îÞ”«˜üjY”X
$6R?¸‹[¥ÚÇUí@æSÁðÞ÷&€pœ|ôsC·ø¸Â]0AÚ÷ö|Ÿ_®²öÙx9dŽfËu˜½¸0ï›ÍÈ¾æ…ØãB78çÅY\Æ@uzÓVh3ã«åDÂ¹Å½´ÔjÔ®óç—}ÿÕ¥pé@ÙF VÂ¯G¥}©s)ù¾qî+IÛRí’ÈÝßñ µñŒJƒKäËí~„x	ÅcÒÀ`Rk™<	å¢ˆ5†cP°Aˆæ˜¢Æ·µeÏã[\VeVñõtÈ“«a‰oN?l<É4q£âíUè‘y&*ß·Ž¼sB¶G–?_*ræyÂ`—D#l2B²½ýÍÎÏúÁÅ@ú7ç´VÅ}Ü	GÊY=Ö4Ì~ö¥ò ÿÇcfBöàÈ¥2u‚‡ÄÝˆ“Ðƒ~	TÝL67È~3Gd;ë€d_½V€²ëp{|ìÛüÑ<—gáÈÁÑá>ƒª^ÈB´ižUš<6·ÒOÀ¯ægœÁpeŸÝžæ/Ÿ”èü«?ÏkYö13qâØ"<?†Åþ˜ÔY7üYÁÙ‰ÃÝœ·ôÎ©Hïÿç°Áw‡‘ÒÒÉ¶¤¢@G†4âÌ˜õHB^œ–yz©sÁ;Ú„;ù!åƒ.øK©‰`p,“V7ñ‡ó‰èËÜ×ÒD¬eÍð¥qt9¤ã 0´¿|´x²ÿï²VoC©vf¹sBÑ8.+%\ëÿùÕHò5õ3 ²2b$6 6ÅTe@{\³ÂVŠØNtæf$ËJKöŸÅõÍ.Q-CMÙ¿Ãµ†lªuvÔ9]“æªXw¢w±ü_ä›fûK‘²`"5¶c:é@(ö=jr4$Ö‘hµ*N5aUê¿%;<ŒD‰éJpåñ:J¹UËÂŸ[vÜüDMå–WfA›%Ã\6&Fó`ÎÛW¹»ç‚Ò/Ï?ð©ñ\Ã:î’
[ª^­¤ME€“ºy”æ–¦*lÎ¹ÙÎ±Qn€&Þ©`lÏ5¨×(.k™Y4éÍ,Y†
»3¨ºARÁ¤;ºÎ›@É^—›ËGêûk;]­Q{&âu¡!¾f×›}9Â,þ D+¨+è±Ž¶ƒoéP9±ˆä#ÝÕý4Á€±æúÕÞîÖ§¶†³þ/;2'2”îg”‘ƒšƒñž‘ÍË§W8ÿT¡b %þ‹ß„©cú“k±"g>5õ¥Þ+Úä3%@€¶³ü–]»01ð_­Òb¶#öm¡†nkË°øõ—<ã“Kcè;¨Üœ“qG§¶á¢Î› É¾d±Ð†¤Ý$¥,­²Õ{Îå:sJ®fUwƒƒqÎŽ&—A\ôiÝŠm±JÂ1¾p*K92%~^PÉ*\_® !CÐ.zÁÓëÏŸº]q[Ê
–œÖI‹•·Õ†(ÇI:ë¨üÝ´Qoäë?öËøÑaIT‹ÎñÍ-Úv»Š àÚô8_¿ˆ¡Õ§?j;MÆLPÝÿçèÛJ“¨¦
‡=ìLÈoH—µºîgRì5PO6l!ÔÂ½hzeðˆÒ‚‡õôÎ[Az­ê°.‰ÍñsP]°·â•£üžu€@¹FÅœlÔ‡~¾_M‘²ô¤Ái¹¾ÝúnQ±A±µª1ºñ¡[v#£O4kÌPØÉE¡"8iTÔÈLÑ“IM#÷„¥¿Î	#Úr -÷g#Zü¢Æäžp¡t ÍöI>¯ó
Ðêa.½8”Yo°3|igkR™ê’W>ê¨ÈS¼ºAh§+D z¨ñl›FŽ£“0wy¥[OV›9"	@Gòã´¡<ø 2 ÷4b’S_Œ:-zí9`®sw©«r“D¯ï—˜F?šˆxMMBtEf£"e±£æ9ï•¥£	Í%X™×õh§æìQ.†leÛ‚}Æå¹0Ö½Æ}	6€nÄ¶*¬Ã¬»/G«Äü/ÇªÝ¨ä†6íBØúìÀzuÙ+Yš´hªGNIÑ^¼5®¦‚aÔ–•1`“Ç8w^ãg)´hSé2ÇÖX<ÝÀ_nN†;¢Ï¡B¯‚[ ÕZü5}„ø:YT
ñíèÉ	rkXióŒ±îD>Bd±–_áÐPÖ%C_ØäI|Ä'DC3ÜŽoøË´ÿú=;w0·6„£Q ]c?µ¤…‘y8NL´ÃÕ=•¿6Ë:.Ø¹Iº4 °ðµ ’ß>&dìõ2‰õÅÂò¬ŠÅû?‚ÕS*Œ>–ÈÙ©ïÙn+]ä`IoÑ0c¦ Z¯ê~í¶È]Ê¨lÊiMtÏNP‘“çO×§)y¶8ç˜y¹!Lßp²%q~4·,VPâ×)08EÌs‚œe_BÔ¾–Ñu>CâBb–ÃÊT ¸€ BÈŽóCqjÁá¤ÿó*ôÈ^äg,œ³a1‚ožaPÂ'(3C%dæa>!ìCD*V&X‡:ÖrZÓ$W_dq¬É'™­!÷p)µµ†XÜ›-M 1r›¶3˜¤qØz4/<QïDp'½ç’ªJ.ª Ç‹©X\ÚIœ%½Œ¶DJŽƒ_–+ÐÏ%_W7;ûÐVÏ…RJÖÖ
ƒGÑõNŒ©3	Bm;}@të²0szmõ&µìßŒG:! ØEkûØ®x»”dÑKê &–h+¸ïžJ,éšÄ=[jÂÏcVû×ýÅ?K›Á9^×"‚ö ’ï.=7>5ƒj›QbÄíôÉ¿ÊY¬ÉðñK~1kË¸¦}Zˆ[Px¤Fy²
‹í‚î±7KÛ^¦r_ž«M09ˆƒïÍ/â*—G´‡9&Q`EŸkÏ|l£<W½`ƒÈØÌ¨Lc‚Ÿ‹
­mIÀQQ‚Ð%6ÆïtrÆ6#¾’ë‚	Ý4r¢Ï0äÁ¡1½ccž*¨€É¡v'>ƒ×Ý¤Hvû?Å­¤|¼örÎ Þj4x&ªW'¦¤Ô2Z8×Ïð;ÇÓø½ù.øö´•Ó7ƒÌ‹	i+}ŠðUy¤Å|»¯Dw¦gÔø½é	ò0€Ý7oõî\¬}_•·Ìo¦žk—ÀkfLµjØfû÷M<|;p êÃÕ¯!¸>=<Q38ò\/¸‘ha!°³æ„°Eþ–÷‹8Ã3Ò0¤¦Fé)¦q®w—x¤ {wr7®H2‚D¿júªëslÞ91PÑÎØÀüd.;Ê–›&»÷³±’¿ƒæåYe–¦õ"eyØ'mceN‹–>wmñ
ñÙ,‡‘¡ÍÍ@ó*÷n2®St#cøE[x¸4mO°Œîî„å¯M¯®,|¬ºÐpÿä¼ôÃŸòœi¦ç
`•…GKçCRÚ“ÿ£×gw:^Øˆ€a_¢+Àcô9Ê^X“Tët-†}„úF:1¬÷´P—#|Ú!Ûvä˜7Öñe¡ì0¾wªÊõÒÚòQ—šÈ’½”"­.ð¦»°2{”ô‰ûÉ£æÄ´‡œÛ¥Rè…•Y§IÓîÀqò5ä¦ÝÐä©ÎMÚ/Àñ›	zâøÁ:.@s~µ=nNË¡Ü½ÕQÚXépŠÔË7ÏKÒµƒä|uâ¬JkTò†ðºŸÔ{1Àb=å(V‹s_Q„ýXæ Hþ‘¬Z`ãø×sÌkY› bI”ŒH)b¯kÈÐdâ@tÛ0D?¢HMðÌO¼=j—AË‹n¤Á®@8{:Àœ>úKá4ÿ]	:ÊòÚë¿Ý×‰X§Ô¾G’?m(9¾|á:ÜRøÑã :ÿÌehš/n¨¢ºß"^ïA¢Üú<<xBELÜ}°-'/¥q¿¼¼Háý5-Y!A)ãHrVZæ¬åË1å.×î˜(6r6ÕhE‰{¤"ÖßJúÅj˜¸úa¨,ÐJòM: ´˜åh.º•k"`4ð•©¤(¬¸•©ÒjUû'8aÝˆˆ*LÚa-Fb?M›m ÈS»&=me2EŽÖ-¼þÂ=¬,€éÉaM¶ûŠ}i™´)„eæì”š:3OUq¹³nWúÿV:~Å˜ŽVm‘ .ÙA<KûŸ-¡A<Ò±Ú‘ˆö!£	Ÿ½wo(æ¯D=.G&ù½ãû™_àçšÖ¦)8W¶ÇzYãÓ‚˜BWð*7‚…_ð™Asë9±ŸÀªx^ÁQ·;G9+gØ˜EÏ‰fñ7ÔSu+—5žûl°ÑSZÆÖGr
@¹òOß æÞvªšù÷ÁKbt¯ìÝ¦øxÒŸ?=—!âgOwU¦SŒA¼Óý—}Óh[oáeyÈ$A­‘µ7Ó¬ö_¸,ƒfZ$<ˆj›¶É¤RK/4OwáªÐ%Opå¶j'g–^|ÿë#€Q
ÞÕã´xÉÆ›Î‘`i+öõtRß½û˜s§‰Ù¢ ärá$áHTÉ6UÁŠ	?z”w`µŒ8Öä{é†Õ#u¨â¼l¢½ccõç†­eÙðX“,îtîpÐ}¼
7nÌ.-wªÊ ¸éInšCÎæóÙ×õnR!õ«@šöò0¸p.F‡Ïv2ö]oÜÊq:=H¬üîÏDfHK`Þb_¾•Á.ÊURæå}˜´»#â@!í^­^šÍè6¢@òo~Z ;¢±e1õæ•§rø'2¨½Ç& ]:Ì$SÊ63’™$Srù¥±þFÓY´ÜÌÿ9B
²ß8û ËàN¬OœÞ ÔÚŽoìlüF¦yÁìŒü$²Ð;Y]|ú”#Ã3	Jå†TGsÂžÒŠíÓñ…7Ó;ë’âVq^¤n>ãË«’®œÁH˜ƒÅÜïtÌ8ÃÂi)û*3}<iQ½g‰7‘xqÖP`õ>U|
äwãP9ý¦¢òÆŸ¥U2°ýz\Øq€NfsäJ¶Âó¢äçç©†•‰ß™x9,î?3“&ìw‘–Þ}‘óÖ…ð¢yc~\¢ÒØ<N¨ƒZµßáÝN¹ò’³ïL€j°sÅ(¶¨²r_PôyŠzvýbÍþ:£ñÉl+eŠâÕù"h÷É¼ÆA¨ó2qsË£áù¼Z@«»UP„ì¬	û*zöÝ®£Ÿ
@rÀP,§EäÂ˜IyûyŠkr·:/cîvØ“ØJ|øÈª¾€D6¢ Ää¦bSuÀŒYÚµ+„Ètmüã–Á§xzrså‰æÙöÈ€ÎÁF/<§åÞ°Óp/¼ùÁ)í,‘,iO'kOqpÈŸ‹vý±çhù˜.cøÊUG„* ƒÐ5Uð¹Ëxþkù¡á pD&Q×”ÉewÇc@oLÿ<–3´¦­ø¨Â©(_èyÆ" 0øÔ.]ŒãŠÔE.C_Êýæ2el”Ez°æ[õ2±ÛzyH=kêGu Dþk¢Ü•©ÿäŸi^Œ|äGE@‰÷RæÙn}²à²”ÒKp›ËFø’ó+vÆƒ’cÇ¤¸Ã8a<Þ¸ô£*¹5¸*îe36À\Ýk¾§*ö#:UÐØù<¯Ñ²0õ2¨?Èfò”ÞÀÀƒÜ‡Í‘>Ó¸ëcÖ¸]ZicNˆë
&Hq¶jž g1+²4'=yŸyÛ:ZT/†ÿra‚ÏÀ‡L£<ìJÿhKJeî’¾‹ÀyÊÜudZ˜‡¢ñÙ~ ž%Häæc‡XDÖçœÝdtŠ¾üðº4ß!óòBWÔÑàÄ&ÜÃ—4Xp¬CG²è¼üñDÓî`¼Wš"pí€Ð¢4Î²¡£¸ZÍ<Å"îûü Ö¦çŽM5'ÙÆ'`@>w‘ÙðHßÑN+o}­O”œœ~³ëXÖ‘6\c2ä3ËÝã"'h3œ±çÕp™:G1}S7¢8Æì§¦‘wðn™±¦
DñéÞšd8l§9›÷¾ÎÚŒéUªã.©ðil¬±ÆoDÁ¬/Fí©ûxþ"‡j«¦wOà£Še;·}Á‘w¢	8,ªQiTªIG${=gþ®Ž‰8‰µˆ!Ä'i7Z‡ƒ-;¹M©V1©IU‰'¥Q‰L`¹`8‚?îþ#¥7Â¹øØ„ÏèÇSÏfG›æq¤‹‰¼â‡ù©´ÙÅ›ª]åUå.û ¥õO¤YhÚV¼nò*euäL“ò÷q–­àºæ8Ÿµœåï$£¦ç«D
O`ûtd8æH\nöš{ªO¦H6€­G¼Mù×:?ú\)àþü‘8bæ	=‘ß/àŸgø¯’Ë3²XtX,[²ªÐ³óìŽS@X4þôQ¢à”ÓuÒPø­÷Õrw·rL/…%¥t½ç}Xç$Mâý	B¯ôELßøéÚÇ×±yÔzØè»åÛ4ƒÜOQgJicw„†­Ì¸[¿ØSÞÑÐ]Ôý)ñ‘: "Ë×~+	Á˜i—Áe±Rñ}¨TbÞAYh|ºo¯·‹ç­"]æB_éH‚À;âu26×orXyÆ§×ªO½çñƒ£–ÜzˆIFwá‹nãFŽ{Š}¡Û¢(»·däâW7àÕ²ŸÂzëÉÁˆa €ªX=T_Î‘Dª•_†ZˆÕøùÌ}"ŽMªøq JìÆñåF«;Ì]‰¨®S
•@ó‚ŒôD´_?<Ç—tÖ²vi!âÁr3@„ÄOÒ4£=k‘Ÿ–oïö°ÂjI,4€ºï’¦Ð/žY·Œ~vÝÛqâ+WŒýˆ±äX_Ì)ùH«“…¼"Ø-öJ„³iúøaACsÅzäzÜò5 º£ƒ/"[Œ¥&¼ºK®¹þ
‡»vÚŸ½‚Ÿqš$Ã&S·… ·¡fº~lÄÁù¬N•7]©L#5‹%¯E|GãišÚ**{‚yœð„þòËrN
n˜b`ãá$Û§}ê?ÉÆsNIµ1¢XðäTØäáâM\MoU¶ü,Do¬Ua›€mˆvkùË-J½Û"xÃÿ›M	à¼äXmJÎ¨ÛÒ¶¦ÄúòhE 1— ¨”P†ë®BE‡”x!Ø«êT99¡yÇ5¥)|ìKð@÷Mè}×O¡ÑþeE‘®Ý4¦à¼‚?ö®ÌU\œúß.Ð.qSXO¾â Gùº¨?s)‰˜×ÞHRkÆ1BvÌÝÎlëjô½¢ÔÕªâ´Sý3L¨;Ïk3hÛÔÒIoÅÙVÜÝ1Scúž¾ ž‹¦~¯Œè$¦K¸Ä©ŸôTÞw0G¼9B~"?ö{µî_8¾ª¢j&N,î™ÚŸ§ËÄFoæ=§Õ–«¨ˆg‹ãmIufÑ#È/Ðî Bµ‡	Åd€ôIôrÝ?ûæMô¿ 2¥ ]x©åéÀ>T*dÌ™_b•ßÞÞäúæ¢'/ž³Ecd¤—ÄäºTGs>wò½ b€ˆ	ëÕÌÑÃÒW÷þiøš¾ç™¡Í”öÇØ+š{x&µ1GW9mØÙeÍ1–†Bÿ{_®‹ë*%}wŸ¹ý²þr<ï–µÚ("XÐx¸“TõðÝ"Œ¯“´mdêw¨Žxæ¬bã‡Šn$Cf½“5Šw×ýÌ‚œ×ÕüoqŠåÉÓN”<*À‚ó\KƒP/Ø|¥¢wfÐhÈŠü)œ]ïÉ%­–ÐÒõyNÁ^;‘½—•ü¾Ëó»S!²Ðuw‹×@^‰Aí8-­Oe-#¤’þßØXxjN„›höÈ\Æbø:¤Ûçÿ1$ì$|KRÇú}êu6be¯y‡wyír}Y™`°¦HÑH¸šÁ;ØAl×¿ÇããÍue1DçO× M®¬}zI1÷³7¹[òv»Â¡ŽÇQš÷5V¡±.,êE^w§UÔ[Ï¤fDýžüæéYŸ©ô>Ý=:–š?›/C·*£ÇÀˆµD†/8D(Ð<ˆ„ÖŸÒª9ó`açR­PjÏwò-Æ|Pæ»~Ý]èƒv•¯õcJ}yÃz“P°ÜÁ`V‘_K	Áž¬AåS‚ƒå5üâoûßåÖJ“A&ÉÀ']ÝßÅ¡nS‡tÂ”êç.8¯_õ{€‰O¸²ÞuXìJ,*sÇâÜI@G‘ÐîðéñOÆÏÿqV´y—‡­$=ºVªKK 7M€˜:­¾µõ¯Ã¢¬þ]ÅâSÌ’²Ú-°'w×?¾Š<0;	AFNùß[sÿ\Aß+¬+o¸#káÒ;FÀ¹~EÃ×:­‹¯r_HèæüTÉ–nµ1Ìª7ÈZ§x(5A½©…úD¤àvCEò2=¨D_7ÖÀ†îG’ÂóD"ÔÔC» ô
øv<ý2w6QûÁÅ¶_'
BV1fWëîO”Íh 6£AÕB…ÑÅéì.Ë§§I]é^øÕÕÐ1§¯÷Ž¿ÂqËZw mþm	šÝÑMáûñ&q>°ƒÀ%TÊWehH¶ïöçç÷$bã²‹+®&*=üü&‚gTíWÏ#j#­ºú¢ôáƒz­¿¹fÜ›§>Ì±wMõKåzÆÓå]fZÃ.À˜BgKˆCÿXŽè„q3S¥Ãæ¡dW´Y0º³Êã•^%„ŠÕ›^ž¬áôÇ´4ðAÉåéåö­	F‡}ŸÙ)0°%6KTËžÂÔ>íaŽFjáNàò &˜NÀhæVœuü¦‘§“°iÈ|áû:þr¥#Ú9€§à£ýEªˆ,¸5lˆº0YS®¥§©9Oh1¤Ÿ<»U(Îuä™ÎÖæy“§3‚¼{i³GMîs9€€Aå[¨Â3Ù€÷¤0Î}Ó
ÔT›²ˆ±0¶$ÄµDÀ7X4¤!».zl…IÝ§1»ÏÂ~Ûª"G\Ãk÷pAuH9®ßâ§nA ŸÓ‘Z¶,\U@ f=@ÝG~poô­ç$ÌÈBvò®)vM,áÊÛ$ ±†ç@å\:È´9»øïënW÷‹©Aò<RÞ1WU+÷¶µÊ¹Ò•¬ŠyÁÇJá²ä¶¾/b…\…¤à‚º^¿û2ØUô)Þ<òt½Xâ¸Er¡t»Ò®ïõ5œNe!gjÙ©UþT9Úªñ!Ê‹}¢šg&môS<
}O”(rßÇ2%eï‡²JŽS³ŠdƒÍŒ:–ÇUÆüN#”s;ûFlŽŠr@ë3#¼ˆæ¹îÕ–Ú¥íR,p¼¯2ŽŒÉ¹tÈP#¢ £<‚Rä¾—uréTí¶?C­þ×>Æéæ$fgÏôßÏÁ›œ˜ë«Õ]à—wóapY †§»pKl¾Kä–%#²T‡ú5Ë•ìûYb<Ž‹Ì\ö‘Á½ý>(xÈá©×=€^èŠY²6¤‚Ów‰)&Æ¸šó«Ë[~Å»íp¿¶P5ô†éµƒ‰îÀã–¾³æàŠ™‰r{œ-YMé…ü &ï67äÑðÙéÎ†ßeœ4äAt =	Š6òÜ¢ÙòvÙ*x(LÛ±`Ž "µŒm?
7¹á,&¡·>¦fMDû(ÏuûQpÑ,‡j´žÉJÚØ®Å-Â_·øvq€|t#xUš‚fÊ«îóáèÚ:Bysn5ÜD©ÂûK–'u¶˜îc¼¯øÿ’Ž^©µE‘k?>—ƒ}ój  ÄÉH,ˆ>f!·¥2‘Ìþ—£æí‘[šyDU‰üC[Ø|ø<Ã/%`=/ÏÝû$tÑ“þ
ŠÍ´H‹¯nñ}|ˆd+<Y)Æ¸ºœ.üØÂïŠ°ýßdIÎà6RÊ)õ#×ñÙÄóÞ˜rÊñÕ—SÐÖŸÄ—\_Æÿ?Â£L}¼Ñã¤†wÛ˜þ+±ìÀ£Šïƒ?`nN¬&§@‘ÑíüL×ßMÁÜô|¯TUƒõiÐ«a9íÍr®OlTû¨Á^5 ë&yú™ñ Œn–|Šçf8HŽ[]Š`Ýƒ&-ÏâL‰ùìfŽÂê¯m;‰®,êêÂ"þ˜ÍÒ³ã¡=qE‰ôøø€ž•Êˆnòtçå_ž%êê/’ @oAmQ§ã«¶ñ¬uÇ	4t!ISÖ’@Ž˜).a–6ƒ”Û•*ÕEõBY.(Q2ë@	äfn¢ÅwéÑãGÓ´ 0¯Q¦Èç1äb9wyó¬eÎCù¹fèî²ü$ŠàÅ„ELu)ÔHìÂej=•ñ‹žßÉ¬+/>k†)yšp­¿‡a/ÛÕ·ÆÒ´Î¼hÑ-­ßêêÌˆlŸ²ZæYZõÓL¥JË0¼qáã DÉKWô‰º»‘”®©¿Rh4ü†¬ºF.¼¡c‹Íz3zC³ø3Õ¾UÚ7Š³ÑŠ-ú•ö_þÒyY5DÖîd ]ƒÉ}ÆXj0è‡Ø3ÑŽ¦ùI&?‰*m]ÌKœ„
×Œ"«6‹
û1êŽîÛp¿mÇ¾8š Íf'Þúˆ/Â— 6Š Wgp“Æ÷oÐÃÈg¦8Ä†À
ƒ›"húØjÌ@[HÀõåÍÒû9'ÂölÜ—›à;ì Âq…(è—AÕ µÂ ¢?y:›:;þ>1t*h2Ž"å’y¤dþã~àÞ$:!‡çXÊm/·”ÃN+œtðÁ¦«•0;8è:8Î›žüùYpùØx:z…ÚžÞ’¿,f•¡¿TñÁ¥<Ë<Q–´q
¡Àî=§¬ryy*…û`ë
I»„¼×ŽÞïÕ=»]]z©Iš"g°m|,™*ÑºJÖdòvÀ»ª <¸Ü¾`M«íÔz§™šQH#Ï5¥mŒŽÒrÐ"'r«U>,ã#L¢ú£S:ŠÎøÇ#›Óä:]¼¡*Ü€"ŠHÁv˜,`Np:­tˆyØ´~õY KÈg}ƒøéÞ5´2WÝëË50Ú‚å8ßÚÌœÿ¢¬š­øcgvÃx×åÇq›cÓ¹•åï/H&YŽˆò!Wmz#àRH¯í6\îõ/¯aØ­Qƒ²Xzãöé°LDúØ!C*Ï#QÙe)Osà{_Àì¹ñDuIÏŒfDÏ¡';<—¢À¥{ëŒMÃæˆ[¯‚Þ²¢5M8¿…l1 ¯:MÜ„NòÙÊtAÉL¤aF%‘,~÷—ðíH£qTÛÒ©|f‚¶…sÐ{É‰Q&tä4—^Ãàšæ.^F2ŽÅÄÊÝ<t·Q@B6æ±þ–tëÂvø%ØWhÅíÕ¾¦K¥Q€‘aÉÙ.ò^*Ýà
ÑDlg«±î &*¬Ž(3×¸²jÐ¨ëc¥íOé¢Â™Ô,Þ±Ø™Wÿè4…iø-0è=Z·0—¦Š;û::Tº7x-<Q+¢§ë×Aî½{È™ôN4É“¢FÜ2)ñ?Í¯JùPž¿ß±}	·?U
~DXâEî‘ÉŸbÔÅa‹¢°O Âä‘oÈí¿cÌŠiDFàUjÄú¸wÉÕZÏ"Mhâ§_øv»Ñj@‹æìÎÃ¸g†™¯rÄ¾u4Ø¢áÏžÀÐ 5»L‹Ò}ì¥Šyé¼Õmÿ<‡[àtƒŒÐa°Sc$~°@³s•YgLØÓj®6{¸å*;“›¡üàï%O¤É’Èû{ü•©G'^æÿêHNd"J‹v•ÓcJÙýò ”œÈRÕ¬âIw“Q}2™)üÞølªd4è@0‚ýM8û,ÜjIÈKLöY	xÿqŒÔæ qÁ¨jvV6Û¯ÆIÊÃãÆ(² ÈÂmàšB,¿jÀØ:Ö»±˜p¾`"‚éÇLGæžÉÿT•± é¬vµ]ÓÄv©Û†P!#ñãu#Û :×£²Á7æ2V›ð€Õ·WI¸¼‹œWuo+©ëÎ’ôÓè°ÀÔ(úÐˆ–ê‡®ÂÈ˜
kþÑˆÐö;²¸‡YÖwÒçÀw+¨^¸ÑK$¡“=± IþhÊ›º?%¢œaíÕkÎÌÜÕòñ YRêçç…¿4û¤MÄÐÃ“}“úO$1|ÊŽ¡xtã[|ÑFÔt(uš½Ž¯œ\Î?!èŠ?Ä5LLÄ_‹*ü_Plñ”ºÔÑFø¡©e¤ShØ ¡»pê/¡\r{ðŠÉªøÿî_WzÓòÞ{á<Øä6Õ¢éÐeÚu¾ñ¾¸òÞªœîˆìÄ³é3É¢°Ÿ.Ø¥x
xZçtÑŽ¬‰Xuo$Ä8ŽÆŽVÊ3›Ô‚D„ŸmHtÏ¦#ÌŒÈw=8Cw½luÌ=ix´ÓÀYm”á&/zh•†QGnálïCñ·”oc³L3˜=©?K(ýÅÿÓCUM†É˜ÂÙ¢Ìn¨Æn<#5[º:½8ÏÔ¢á)žOÒ‚,ÁÑ!§o¢Ð˜Ä^mä|»u\ZÙ˜š(! ^\€„‡z”±Ò¹Jã}ê”1ÚÁˆ˜2
0»	‹Ï¦“òMÞQÙíÑž#v'Ýi²Š’’€ì%-
,^Iáxï«M§CSæŸÇ¦‰‡¾œüÇvÔ,ÃûuãfãvÓê"ªROîæ(´uæaˆ>	QE:íÃ‚ÕÑzÙÃs{ÁKø¯Ž½&Ê®‰×n#kl…p°Ó˜å|bU‹dˆÃA_-W6³~Üò" J¡kÔ2HªlW ±ôK·ã½[ôŽvÉßÚ u$P÷á±Cž»…B»V{ü÷pY1ä&!÷—›÷C¼Zyô…-“qXÖVsRÔ÷cqSC˜9Á(uX3<TP¸¶. 9Ë”i¾¶#Ôÿì€g„Ga22ÀbM]AÔ57œF5:d^‚ÆMžðÛ°kD—âóþqÎ/ÑB=¡Š›‰jò''e|,@šªÿ¹½³Ý™BýhíIú¸t_‰‚ºF6aÂ³*B-Ø<S¦ïGKs%-9Z,6× ã‡Gz®ú¼±Èµ÷ÂÛx70á¨g'tÖÆ8a"ÆÜ¡ÃJe¾Œh’P­ó`OW*5l‹|Õ÷“Ò˜ÿÜq(í;ËÓé!ý- Ÿ‚:µ×Êö&—»q.  ðvã\­cEƒðbÁjM÷M¹°Õ„.nyˆ9]˜·Ôþ&áÐe3¼¥FA†bÖu³ï\¢I9_à™\Ž¯Ã¿ôœý6X5 È»_£ÂÏß+œ…[ÃFˆîCN£®œõ»¤((Ymý´“—™Ë¡É†¼æ»ÌÎB÷¢ÔÍ=È¢övfH5±–¨Ž\LÈ÷4×tGùwÍKÚø]Dw|dÿKÄæ.¦"ÏˆrÈ%%o@€¸˜ßuké…ï¶WsdÀácß"mò¦O8j<M£ÇÇý0³ÿó~×J¥1ƒ%'uµTû}PÅ¦®2W³Qô"%öªméöoçNª!Y!0éëuø>ó€]17è­eÂìs_ÇÓß3¡(zÏ%Z;ìG„MÀª‡Î=ùúQ¦¤[ÌlÞƒl-.›uzð~ Y’ë	æk-+Õfµý^àeFé¼"ì‡ÑŽ>*¥ ‰ð2ÐãLõuuÛ†&êŽ¬¤²ÅÞ– è®éÌ¼Ë¿1AÜx‚ÌPáÍ*QØÉ­´Ä&,ˆ7Ùð¾4M"ûÿ8[1û0Tôâ˜Ñ$C~ónù¤|™=Æ¶)YŠßàÉ<óàÔ‘HŠ\+*skÛ»ÒÈÀ­k}È5~™Qr¦ìTÂ¹§¯×¿—´1ôÙŸdÑQ?òT:À‡ir¢‚£ M'a˜ìö—Fß„3ý—ZØ5•pßŒŠ`ýoäžµÂ.á[u+M<†¶i([ß¨«IúØ-c…ž‰ùÒØ$øJÓ6yÄv‚uŒ9Y¥¦±ví)àtƒLÿƒô;s‚«ëÁq¨{£n6E²â™ó:?®œqÑˆT@™O¦üOz_—<¨«ÜfâS¸Œ‡ï£!ÿi´¾ÁË¸dÝX&}?ZU°ŽQýÝŠœOks‰*YïßÚ øÚ·´žÃý=áj(”B1H¡šïàˆÊ¦Ó‡èÃm¤l}à/¢e— ‘HVàE­BVø€¦G#ö¿ÄÖ73ò´&\Àq×o’M	70ÝÏ&—ÛKè³× ÜŠa îà™Ê!»Ê]{b¤4ïÿzøTÄ|& /2ï5\k¨Wðn#—ËEö‡óæâ]0îÀxlBÜ¢øÌÌuÎ˜ïšØ•û­m)äÐHÉªù‡~ƒ0¥j=Œ”ÜJau^`ÜçRu;ÎZf»A’Ú6ÁDH{Ç’ êËoS^+ xC®¸6SbÐèTÜS€6óÁÐO"é@ ä‚b§Àx`½ñKIŠÞ*s÷™TE§ÔÔ9þ´¨Éô)˜i‰Ñ°Ç¥Z¸Þ×G8­Ka/Ô9Õve_tžLA‡¹‘jW»­ô1ZÆÌ’Ïôê€× VþØp @'p¥Ê vUo¨µ9kƒ;"•ÖìÙaùÈAö“ü}7âÿnQ!>X¶’slyî«Ç¦QÆoœHÇ¦šáµË»©(ätt^'hCë?Åò¤üThøÁdêSá$00²1ˆã@9é}¹²í0…<Q0ÀdJêOD®ÀGVü ³ÿÒ1#OEîZêƒà€¶O®žÁº|DôŠô-ô)+»°wì‚•õÒ+Ši]þáòŸ„ðïçQdsh%ƒÞ}ÈˆV•g`18 ÜÇ.š5XÞäÆEøƒì-þ~µò	ºR3!Ú’¯ïÜÄWxF×fŠ:ð^øÑ28uÚeZÙÊªWÓÆ~)«7«˜,ƒ¸Ø„†¿ðÐuµ¶£¨ 2Û¢Íõ*Ô•'àÍ´ý2Û’ÒC×…×dŠ^5‚ó´¶`Süqž>%vÈT]CDò@4µdü²ì!„ÚVlt¨ÀåîZîTHñœ‡’À³©XÆuŠ÷ªq¬Ã
hñô¿e~±`èÍXAMÏ4&>¶Ïº©ùÓûØË(híDîV
‚R|{Ã‘M§-h˜f¶Kr%i€ËKÓ	ùä}ÄVUÔ˜^K,X0‰‚µb}3{0¹áS‹^–€³y¤›e“‹ó„IHTzcÊ|’³4˜ósïÁoüw}kùdN_:‡W*OeÏjŒŽÈŽ«cFªK™sK‹&žýµÿ$®rÇ,{Œ4ºV¡Õà)‰Þ•Mu/.nRcle|d›ÀŽIzBaáÀùÏ_cÄÀ¼jÂ'%a€"}F•øézOmÈ}Z'Õ@.?@c%Ü©‹Hpéqºâ¨Îú…Í|wFE^S²$ÝðZwçc¼_|¢ìSEÂT`èÅÓùÜÝ›vÙ²_ß%Éš…fÐ­!ÏS/¯48Ñ[‹²ÁüÝJŸ˜©NÍfÏ§Ü¸öÇU-?úeê¤ûàlÅ‚¿¾‡@Ù˜Õ¬ÞëœGØc&räccµÝŽ_1ÛèÂ%‹äïdjI.ÐM­ßàNÅ$$&ôS$Ì6¼ûtâWOÎå\2«¯ŒøÝìvKØ`Öa@ÙQhD4’¾Yåg¤^Ž‘*Rí„veì{i9d¶>«¤+XÜå©òŽ„µöï´z{ö+Gi½lìVÎ]å#}
.‘zàçêHxŒï¤xàaƒ!ä-—‰i ƒ–³Ób%J˜	ÀœµVý³æÂ¹U¥›Û^åÿÝª”’ö(ÔùÞön5¥Á¶žŠÓŸR:W³í¬-þH—¢‚ÏGu»¼Š-Ü<Âz£ú~J7‚Ë­]Žt|ÖK_šq]¥Y‹iX½ÄŒO•9ì@?¤tæ5ì¶ 0`íÄ)íôÇl½H…ô¶¸º÷· 
X€ã¬üýQØ*3RÜÇž¼®ºç
ÕO£Ðãç0ŽëÈ;^G€”1lãQ€—ªù[ôrº`–á7d‘*zÄlŒ ­I«!*è^«òX§Û¬Q%zîRÅâ†üß¥/oU«—¶´<ÚÐª>ÙÎ‰¶Ä,òåãƒL††”ü4q$‡e~9‘
lÐþ7mÒÿ(¸‡ï…1EÛ}ˆùñ/*¾Z{íî]£‡ùw3Ùœ$††"ø¿ïí¥Zñ1Eèÿo€ G»Y ôrd°:z Ïv
Ç¯ˆ×Ç­ÍL½¤SÄª“âÁ9@ÓU[TÇnë›AœýIYc“ÏYªN
•b‚èøÛòHj'1øp‰p€[#šüï¹æGq*& ½ôÏ9›wª¿.X{ûÕÆfÖY^Æ14<¾7}øN.ÂgÓ ÃÛ­${Jˆ¤Ò¶á'"«Å;¿;0ý_ôð¬-®9¯Ú\ê~~Žó²á,rûùM+þêÞ8Í,êfdûùVù ×ï¹	óM›;TüâôÃ\KX—û?©Æ`èÀþØUuš$qŽN8âëÕ’á¢Á*¾…Š&LÌ×–¼ðÄÝôiÞ6Y’ÆPë@W¦}î+j¿ƒ‹_1þâ/wa-éÁtž0†%£.JI5×pÏêõ×mU*¦ÁØ/›åªýBž{5|\Ömþª©'!:Ývè&ö»éfg“mÏµþ·­Ù‘À8ˆau g0™ÿÒBõÅZZ.qF(„„XÞâ~˜é>×}„f†õe’Md®D`H²'­Ûî¶O›î¤pCMkhO„c®†Ž‘×O=âÇ:R¶ü7f»Ž©‡F‚ðÿ•æúŽ»ÔbÇYÃ­÷¬¨J©¡vÞiöÃÿj˜m[Né“ÕíÕz†-I0¡€0é:`ß"^ŽÿLôw[Þ¶{4âæ›™O¯0Îë£óºº‡eé<{ i‡ðm<&†`û·ÖˆíÎ©>¦c_ßA­×Sþ/ 'ˆA"ÄT}ïƒ=™[“æŽe«ÕZ””ºl¥Â6ª¦G°ŒÈÕÒº+UVñôï¹¼åPÕ:EúýVÇfµ¼XÛ"æÚqÂ?æ¥¬,sAØRÁ"EYWâb(ó5u\8« ª¦Ü¥K|7~ ŽG
…°;žÑtÒ.%Óù¨“ãÈÞyKõ4¸¡ÁÈQOØyi{ò,<+@KQ»ÿîé½?Õ8}œðsd'›zPM\!ô¶„ ¨OñìjÑG#›RTÑ’®6¹_=òFÕææ.!ràœ´aàIêÉê2êW/Ëß;5¯;[ó®;y÷-lß­š.ì­^vñénþRL'C¤4½$Ñ„¸¬Þl´RVM[¸p¢Ë_¨+çÂwUÐaè ¹­°²•÷éëuÎ•>#”åÑ¦ˆŽaFëæ'fEj¿VÄŒ"ÃŸ*¬:ôË¸ÕŠŠ®úašK-‘×¨±÷ Gö%}«ükÊsC(ÉÙc´ÛªóÂ~9mÒNóÄue"‘ÛwY‹¶´?¦?AN’P¼W‡»X®€¨ŸÌø‘-£KHô “‚Ÿ]H¯ÿ5C¼Åªl—_Œ¾ïóks’dœ¯Lk~Ý@‡
pšéaÉš£LMSD ÷‚:ë—pN­ÓhtJV-Èô°K¤%®…®uô”ØËÏ»ÐÉþ*øÄáÄï"\ìjO$§~«ró —qPS®ñ¶Ú}f–²{ÒO®Ö ŽâW: ›ñHîBká•¯ttŒe}gx;•>ŸÝ/f´”è>]pRžR+§Góe×¶ª¬4Òe<$1ã¥=¸£²„e“«€©}’WXZ€bÁÿ­Xª(]iEÁ}Hßóï°Ï¦‰»ö˜ù<cØVIä‚ÕÁ†¢K·[ÅƒÝ”etµÃp<¯oöK·»ëKMÇž­œ¼$PÓJ&~B˜Š+êy{v×ýÒ¢–¶d¶…´ºº¯GS¥FÛ4’ì?V[ý>ÿ´Ißã	‘`7ÅÉç[õ‹'¼ùw¡êÖ<»B$
=ao:i@â4Ð¹¨mŸ…Ûcaþ‚¯À_:Üö'
c'¦#‹¿¿¿rôKJHs^Øÿ ùê—/Ì÷¼ÎÕšÛJ<‰Y1e]Õv`13\NR6ÛãlŸŸÌ³]?=/Ìå¶MÛY8UF×Ü1zêŒÊs:ê8g'â'üs¼—µ'(ïråYÂ¥F 1TIí2>ÝyáuvƒB0¬>Wr*+½éŠêz1ÙÅŠP/@{ŽSŽRc^šLv»¥s*âYœt—ˆM0qròœìÌôfN8}Qn1Ç(“ò€dú2¸É=|ˆOGxI#—Î*Æ¥n V¼›Ýø²ùèxŽJ8púZ%e+p”ÖÞñGcn#ô‹‹¢á¥ú³¤bðPu*7î½,^ Ž¥éõ%¦EWù\o$Ñòáq›ïƒîîÍBÞGg«l4Ž»<VmOæÓø’Â“cV'”Òä%.("EüÌu¦ûöæƒulÙ…sÛ¼g&%y<Œ©¢¸‘´Á;ž„Ç0¼[O¬ÌÓUMCÄË}Ía¨SeËe½J_cÑ€·¨¿Îùï9½ªIÎ†Œ1ƒ~8ÿuËï	àDI+%N&Bæ›¨Ûƒ öO®‹˜yÆn[§÷6¶+=vð˜[Þ—°å—‚M_‘š¹§‰ÒÆ@å—Û¥q!@™í‹ï!]Èxo† ¿¥+‘LDÉDÜsÖ(é*¢˜6/ETè®]ïêÿc^.ž1„•>oZô+ŠÓó7£GMýP{D rhvâtº L±à¡–4âòZ›ýhº†”Îm)²7+êo—XVLQMÀp•ðuÕùFø_WˆRåi50éí`œU<Måˆõ”‹†®S\bnk‰>çü%kˆöˆ<®ù?ÊC%SV{òÂðÕÆ}Ø©SÞñ”î¸.ÆèQŸlÉGáI¯/æmþëzä»«¾ï˜÷e=¿Bÿë}×ß€ñ‘VéÙ:è âŽeSë“õu<5ålÎ¿‚ºÃH}$6a‰†íw¹æ)ßé7?Ý*uï¸Ëä<Éè4r]FZåù'Gì<žrÍp€Ä§WJ¼¬ÕÙÛ.«Eï¯Zª?\	©˜@Ü üÅèM(³ÍH¦Árí’Ï’bºA–póaz–Ö´­ªqLÇÿOj†(Ø¤vÌÙˆaÝSÛ½¬‰ÄØ¯ø©"‹gÈ~ô­‚Åf–Æ?ž*ËõÚÐ³ê%†±2xJˆ%¼)Þ¬tp+5/: ²šªq”–anÈ€£RQM†u tOVÜ2F¬Ñ× â°ÆÌùV:´pm¦D}³í³®Ô×Fœ-8 ûëÒHáå+ñ¢ lòB÷îË{ÔE8¶À½e
)èÎ<Õñä4sUÓl¼ÀG…}eB$´´Ñ•-kÿq	øçî~	§5³|ŽÊ¥z*²“F×4Äç¤œ<FÈ°À<‰ÒGº÷ù>1â˜¶wÔÄYÕvpnŸÀT…=ÞÂÜR	+û=ßJŸ(q¾`ÖŠ™TºhÈ£à#*¬NÎ’p.†­Ö’1¯³­èƒvî9S†cÿÉ_–¨#æo Â1gÖw6€ûá'J_ËMSÊ€¢¾Å7—˜C±¶è&’$ãjÊ9¼ó
Ÿæ¯Œ1aÂe†å…g|6ÀÕÑÎ¢0yÎwV^=&\ã¹š.åtÁ¼,ø SN6¾Æ7xo"w÷+-(­è¡ßð*×Îw`„Ø§¹ˆõæÄA©nŠºó
:9€Âó+eqêš•_ÅÔ%ušÏ;=¾dë²À’õ23ê¸h&|‚†‘é7¹pER´½}@$Î°uø2[¥îzÜ^j°«·cÞ™£êøm›t’nÍëCi0¡c?×RÈ¤ò¦›@µþfwÍÍ'Ýkju–(C8VÍ$±ÓŸ|cÞ›„‚¢¯ØÞ1høs¬Á.¶g\´~ì4Å °…ý;çü’…»¹ã>ßÚ“±†7Òö-F¯‰6ò2/^i³…5çøsäÀ|§M»{œços‡µªðAªõÒIÁˆÎ¦ÿ0uõ± "‰A“…õ1W?]íê²rHü›×ºù¡dÏòÙlíX6ÈS”Èc9Ôÿ"6‰éf­RC!lš½¯µZ’Èª®·Ìå|XYt‹óÇÆá‚´éÞQõuwU"=NaëÛ=3y>ñ®j–
MÐ_o²z'ŠHþæ%yb3ZnïU¹à¶å>	s ¯gà0¤Ë|àÙÓülšòþ„NéÁ4ôo²ÖNû“í#MÄbüB ¯ÙÆ\ËdœD|'*•fÖ†ÝðL¥âƒÚÿàÊé
JÖµÔƒŒ€Ø­6ÞScJ¦=ífãI7‘ž+¼§ƒ1t¶ê¯Ÿ2lxŸzÙ[‚À±Á.-ìÆ¼þ©ú„G/ï½Öwª9Å+ƒÜÏN<ÓÉZÆñ€è{jºY¡jneŠšJcI?â­:Ð5Ó—wÍ%±g!ÓNµ³cÌà‡xáË3"Lfž¿ýn PÈjàKü¸vý¤¾9[”±(ú·dž,Š™5qÈÂaÕ^ò'¦÷[²¤aÎ1'“ó¶{ò§X$rnÀ(»•Žg…ù©õ³õKØå¥%+€f#,Z¡«ûçž1s°OüÀ¹Bú««óN!²uú'pínc¥U\ÞDÝµÃÜä6_—©ñÖ
”L5…öOj7(‚»s˜)(°g?·rÝØ	ýˆª%ÁÛq¬4lBÒA½ÁIg…ûÁˆPÄ¢M21Ì®‚2<…üôÍ|™§–w» $¦L	€ÜÅ6G’L¿ü_ÿ$’I!A&êO\ûaû¡T%NÈ7|s·R°Ñ¸™(ÿÕŠu^j_ÔNìê}ÊçŽ[[s$)`
5UAQÄÓJ×5ÿ"Åh›¼ò\¾E`ü¸zC“ØGT]ú©ŸÙ]³„Ž¬ïÌbQµ“î}²û‘pO«´ïª%Þ%ÚkQá@Vø?²Ã
LsfYà(¹)!f¤%Sz2³¥öK¶[[¼K*QÙÚ%ë{cí™ðs—¡Áì.òL¡P¯ŠoÈÚe.ÊÍ$ë Ç·¯µÊæ¿Ãsõç÷Lú¾~ß²o¤ &ïŸX¬{Æ_H	È«ô¹ÜØz'Á-ÏYít¶ÌLím`&'RÌ	wj›^¦#ñÇŒüÝŠç3ä
}/ûàÊËŸž¦' R ;õ'£ña$éó¦n°ÅKéúh²›äsx¸ïïVc¦ÐxG··ÖíÞÃá)xyZ ö*•¡/—–îk²ÝÛ3áîìPUþ0Zø½ˆïAÔÌ¡Êwúô™ÿ¿½9¯%µßØBsì4†§ß?Cå/g‚•c,³­`åHèóÐe2”4;‘ßG›B…eÄ3ò‹i3©¤?Ÿ;ßÿ-cÔ–˜RµäÿÏ=õá†ÃZ±LvFìB=bhSW±Úöö8L)ˆy}ÕhER†5ÈÖWª“—µš PÐññ÷ÈÂ,£¯¬®Ì“q²m¸"Œ×Âaz/ßGÎXo$Mþ¤Ùs5˜°•5$N94l9>6
jü<x¬üÑõ:Ñ^È\Ø|û*BcüÝ¸y¯ë¹çæÃaOä¶0ò°¨N×„·°ÊèÌWœm†zgè	 G§x&ø±TéÓè5ø oŽàPùj?wh«ãõ€â…™Pàf°¶¯L+Ó+N0!(>SdªRa„í*{”cÝt‹€L+šŽ³ „ÁoJÎ¡/þ,£tGð!PãÁ¿jÌ¬j’ò^½ ò‰÷kdm7Qtþîç‹Ë®Ã"Ù¶ƒ@Xï¯±Rfà½ÈºôKdÁc„àÁ jŠhhÿ8¶e.¼Q|q«j²Œ–wÂUo›Ä¾#Ïò¤QœI­JÖÂR`	Ï%¹ì'L³|v~`øãÕ.!ºïQ6=	Ï Å—´¥A	Ã±õ
ù2ÃÀK³/Mþ/
au”Ñ7µß;½±m„Ö…Û,±[_S†\mzˆþ¶@¥B›F„€ŽKÛ„í …šº‚ütTÏÐ	ß’ã³g¡ÁI+ÍVø£…6î¥)9¡`ÒÀÐ¿ C²îX}|Ãq•¼NÉÏ”ÕøöQµû%´[6õm;™oŒ³Ÿ‹­
¾3xÊÄÊV¿“ã?6Gè39­ÐøÔ©–úÉÓp”j’Áþ_'7r4Ü§]¦Œ¶Á[ÐÁvÜ|YVT9¶–)( ¼$iÜòbZ£ “4 yc!rï:aõ^®`äÊÜåµFÝ—ƒ2ÖÓ}ÀSÞ Ô‡üq<†Õ	öˆïÐö¦Æ‡U`]Ôô½ê£AH7¬ Å¬“ê ”ÈdËÅ^ÊÓfÖÑ™,+×˜Émü<¼btkí¤_…®5ò?ÑšhüÚkÿ)Œ³)í¥Æ„=«-/ÒÓ¥¤mÂÞ²J)H’ÌsÒrm‰øB"”òoö¡uÏš¦ø?ŠEÓM#jp¯±>Ü¬bñjÎîètl§í`Œ¥.L¶ðWÖÙº¸T½&ÉÍ/ÄÄÍtÕ5Œ@¼î1­Òø_L”AV¼ZjÀöàÊ+WFáõ5Ÿ´dVàk@™d6ø«ëft]-ã y|êÁ‹uÐ£æƒÝKkªÅtö% 63†6¶-#Ùæ±9'tE®‰	þüLsý¡r&óÑsH2þ{›@f=•“úaw7wˆã±à{07¦”ò<TÒ¹'¿Š~€Î:Vgd•®.$?¥#eL{¼tªÙŠ|9ì?ý•¢¯Àúšvé[†šÜÝúåYóÕìJ€UfKËñ[È‚¬PN€*Ñeˆƒ4{¶ÃfçíÂ=Ø·À×T‹”ã^r5º4Wª«­ˆ”…“Ú½Óq+â‹s|¿ßµÉƒaé¶¦¶&µ%B ÇAñ°Ž[·‹X:e¤­`hkî/¸°«_ý¯*Ï…'”©˜X‰ +ý{ÄTÞƒÎïÅ¯Ùoi­ŠTF;ŸÈb×ì%ñæ2/×‘ÊÚ^]©®ÀãÄ`9þ˜—;¶Ñ”¬?lÄòM¦Í›"¼ÄNCÓAÑ_n_aÔÏW7š©‰‰ÄÀ~í¿Y»ò¿ú"
hXNÛÉJ¢yê[¯Òioæ=íºRõc½FŒ=LÚÊí­iÆ9 ª‡îý#Ú´‘?Ñ@LFÄÁ’'ºéò@’[<pE T::V)0ÊakD…4§ï;>
²Y3÷L{CáÖÿ¼Õ©lp‹ºê£x½œÚpËÑå¢’Áom>Ç
J’÷»žíík*zuï;	=®ˆ‰‚·ÖÚh£ˆä±û3ÉÁ™ÀvŒòürJA<_•óþPY0Û,J
hþ°ŠšÞ(	êæ{rÓmù›æ`Vlíš;¸T¯±
ž‘\ô 7â1»¢’j%©¹–of«nñú÷´º*µ†¨¾OÂDÇöËÔ`åÛ On_ R™g1Ç¶µž~ÎvüAõtÿŸU þ¨(a>yœÛó(ŒVCøÕxûÒØªI|†‘`·èŸªÒ'ì‡?¦¸óñžìùu†Ä5bï´¾­@932¬ú¤¬r}•$ìiaÎÌŸOÙsÛŒ¿ÈNáº™§JË›€z9D9«Fºá½è;ãºÈ«pêðA éfT|6Ff*¯¬;¾Ä™;e¨ÿ`ðúvJÿèµ§ý¯í²c™|@íÎ
síðÃ5½9ð½,*iå~á|ß0:<Rp–T’éƒ=p ¤¶UÐ>êž8¿MÕ%äg»v‰§—PäÖoáM»ì9C>þ™ãü]#Y4ùé:å0gžÑ2?}¿j–b:|žJýÖF`ZÃÁ¶à¡QÅð˜bê
(~¸iþ=áÄ¿ÅúÃõ¯/¹œ¢ ‰CÒÒj
x®{,šÚùY‘¤_D¡V5ÞõÆ„ `t(M™wFTÞº<ýz‹øI\W…ÎÞ=ÈOÔgÚ]pÃ€¨¯ó¡zºVÖ–|{01/eû|¥k/¹Ã::Ù=nö¨ñŸÖSi†õHôwhÚØHÇt¹5ô«ÙùÿD„zÍHï+`g˜Î¯«§ü YÉ¸‡eï;€:—î€[é@ŸqrlOD‚ÜÀñÆÌya
[Á4Õwp€²ý¼,çH0 »#Ÿ ¡g#hÌŸ·¼Æ6‹¯j‰ÉðvØ?ýÞ`¸Y„jbnœ~ëÊþmåý0Uãp"p ƒ1Vgñ½È2“´M±@ábÝ©@HKzfjÂhÛ6w*_Ð'˜gàÑ’[³kfï,.ë|÷|ZLÉÀTs~Üi gÍ¶,ËÖúØ:Ašd=-äVÏ!dw[l!·?wß‰<‰o¡´õ‡4e>yFUò `Ä5±Šú/zqSíDÎåw‰„Ki;d«TG°^ÓlÌÞÞ	€-´Qzä`æ{Ø£‘ªréOÙ7ÈÉUòuGô‰ygY*ô$¹Ñï_*ÊÝˆÓ.S"ñgO2ÄŒÉŽøÝŠñdËÛ”4j·žþ
XCÃß²&pñ÷V÷w^Y÷	euógL	@lêÿ‡dnRÙhØ,aÉ Ö9g¼á¼AÛ´eÚ‡óö[éôÐµ’˜–äZ"_ÿ%$„h°³\v‹çU¢%C+Uñ§<B‡CŠRµnîcTO@æå´ÐÄ%S¡-—¯tÑ¦ @4&¢oI"Ó¨N‰ÇmR†ÃßÌ¨Ê6¢OyDAÀv¼ea¤œ»ªØH°d+¶úé»CÊ®$@¬¨&·ÝÓiËœ•„1¥{Ñ½ÀIžû´jÆsW¿ËLCyV9äš8ÂÔâÖŸ){Ù!?LŠón+Êª›¥ïÝI¿‚oæe4û‡Sp/¯=EäšÜ‚8€B‹âÐo¡0NM¥ÜYí]•¤¶m†ŸCÔ=Y­Õ¨³—²„Aã+£²½´Ï"9	“ðeŠkCH30rø3xé ï¿ár¹Ã>ÉiH<µcUCâÔt†ûaA,wäÚ¾^é§¤VO©€ÆñJév¸8v²~¦òÚ†ïVÔÁÔœ„’\6 q7›åsú(û›°R´‚yÛ*z|ÈËþCRãÒÊBnÄŒkG^° g—;\Ll¢ôgNíj?gðØ#Ë ÓX¨ÍÈ:VJ©5)ÄË¡îÇøÞŸÉF®âÊÏ(bz‚P‹€þÝ¶]©ò†û~új˜ÀÔÝ]”8%=Î€¯‰	G ’‹«å…ºa|=‰¤Ÿåà¤¸ÚÉ“€|Qç¦—Aý?ú«ÅÊÕ¤ËhMÖB!ÿŽpÑžD0Ž[¡þQ¿biY8ÑQA%álÜô«AÀ~'c´<Žœì­„32²ñ)4ÁNÓ'm	aEôò‰ß‡ÁË‰íG”.œ˜Å/¯À/>#¸çÍß—d.¿÷w#0Æ——”µN®s*RãTçÓHÆwÇ:Q”TUÖW‚CmõÌ½fç¸é““	7ˆ©j±PHVìikH[GX¡ç}ËD5Øs¯$$Üèº Y	‚@éÊH{ý’¿SÂ­J#ÒÑokã0×ÇèÈÒÕÞ¿ÚA&“À1]pòÌó¼…9Ã€þD­ð@ˆø¤øß$|JEð0µdkoÏ»´·¥™—Mæ9ÖÜ½cL—­£Ð°‘¸‹Ð<üxËôªÓÂµ­_‘ñÎhz<@j„§¥“æà×"ãÙ¼Ú¼YLÈ¾„+›_ÄLe=^®ºð[…ð²”	&aÎM‚—.}±¼ëv2aYOzŽÂé•¹äôøVÈŠ;âØ¯‚«`eK½:×eì‚ï%A ¤©¸j^l‘ü‹¬«Öo~Ì¿¸ÀÛ¥Ý±4„å	Ïàà#È- ­YÌºÖ|ë…Û„ÃÑ®krŸÔ Øp¾?DýêtC5ñ½JÌX6ÊqÛ™²5’Ç`„’5*&¯õ¹ð´·€úV‡Rž2ùþbFYƒ|=ñª jñeàÛ©—ðJó $“¹ÁXoD¸oÄøÒ{mc÷¯Ó"öÊeˆip
’nóçÐ²qÏ“ †Œç¯ðÌÒŠé+ú˜Ë¤˜4^zOÑ/Fôsua1#c—Ç2lÍuËÏÀ‚ÿ{"S”þ˜õ<}fúMÒt§Ã*Ÿ†ké«¡É›Íîi >¦ìÛ²ÎáäIïrn*Ùu–6
ÚRÚg„™¬,:ÿ2Uþ‘ÒŒ­óµšŽNÌúÙjòú™uC¶þM#i§(½«ÅnUö_[exhûFÔZWóÓUbˆ´8ôÙŸ¹T’ªã«eªb6Õj )m·—î™ŸMTëÃ@Q^]Žm>È^Â.\FîØ"‚]RäÀßS*ó@Ù‡þeÓðÓd÷¸éI¨d=ø€ÜqIŠ*N×£oÔVÓúnk8Ç»ô·À‹Ÿm¦˜„:¼»@¿zóû<–øü€‚½ßöþüÕ^IÙ £,­h‘ˆÀ	¾âL«gkLÒ£„ÞÞ,æþkwìtB•ë¢ãxÒÎB4)Í¯‰Š_ÃÞrF@T6´ÉŽIÝxfŸWuñ>YÔ;{š×tdûÑåÓ2‚#¥SvYÒý+4žsKƒónÄ)GÊ©^O˜-ÂWh„TÏY'}©_áÄnXeãb$mEÒç[fàØÔUŠÍ+`t²å÷‡táÇ¨w„eÛ<Ïm6œfRs«›¸“2ÿ5?xç™×Ò¡ÖQ!*ªêáñÈnïÌ(¨”çI“ë¼›4ä¤SR|„>£-GYð+œáSR+ùŠŠfõ†i¼ŠÛ_ÑþQ%¼¬Ö;Ò­¯U?$RýMVýþ_>v@~~ñ¿°I–ÅÔ¥¿¬!œfñý),Ë`Ù™;ÄrGßöPŸuÕ©ÿºV½ß´V–Ø“íÕŒD@6ÖD¾°@¯¹ìØs Ô|Q¨Ûn PLõ”÷1a}bŸñS­—Äœ‡%“W%Z.ð7:ìóDªMšÀÔ¸PBõ ÐK‡ä¹¾#¢\Î?ÈçR¥;³£DÃKÄ4oúœÞáKNò‚m™.²kA!³!w_ORxŠRÇ°ßÐC§öYµ³/Ú–¸DƒmÇ‘ Ì“rìb+˜nˆS\h­ÕI*œÙž°FŠT#(h]"ðvèÅ¨ŸàáÊÏiï‚µ©Þô§7­¹ ‚±6‘3“{NQaƒ½B+á¶£¨A£{nžÒRÝü½yoûjt8ÌÀÙ)0ö¨giŒò¶Ð¼æÕqÏKõÆG€CrÖxEÜÃ¤O
¹‰¦Å_EÈLªðS:sA&ãcêf˜†–üòÛO¢~N6U*RâDâ¦•jÑb8¢2ge—G“ªO‚# Y‘ºa3‹	¹M6gL£DBý´³©çß–êKŠ™¸ óãxÕK.dåZçÀÐ÷F 5ç‹†3Šmxœ“ƒs‰[¶_P‡åibŒ<^.„º`)1?x™	I]3¯@øñÐjk±¨9­ÒÛÌ¶õ´ÙDe¿—Í¦Ór™)¢’{¢-'ÿ]<àSGDhLbŽ÷°åAðD­hVÚÿÉLP÷[H*ö·ÉwšËt™1KZ Ãvg}ï53PÇuBðaÀ1÷ŽíÜ®ïÖ`M)cAa0Giï¬Z£Aïþa‚iÃU-Ø‹cu^ÑìÎR1sX.îFŽ@ÙWâgÔ¨]![…”Û`[qšl>¦6fÀjíbÅ£;ŽF¦§GÓyâ£G¬üå,©Su)(Á«Ç›ÜE„¬ýuá÷ñÛ#ÎFÂYÄ³k@:ÕZA $!—ZGd JÉŽñÍ*;2âF/\!ãúÃ\5o~¬BÌª\«R‡ze&‚kƒ†FŒ
öW$o7&}Ô’ýYÉ0…kû÷dWÂ6TPÙ››F	ŽßÁÍhéè&?›}:ôì$´¦$Ê¾öŒ}À:*è¦·å™Ç \,ÏÓGEÿèšC”Cƒ:]«Ê?ÝüÖõ—Ýþ¹¬õÎ§Ú2{[q~¡Ø$Ã2‰[Ø²Ã}úg*†¡wÈ%íêAm ÿ÷—æ\ßÆmÄ·ÁÊ;`èº7ê´ÀzŒ°˜ÕµÉ» `äÓ–XZ¢e|9r<b:”F=¾®ÙÊp“Ù%)ü¥pµ¡áä_à¸gìØYnP½itôIÈÍ…ªß›‘šUÅ:ôªYÓ®bÒ8õÍø:)°t¹Üá!É-D{4YŒ
äg£7ÿ0œ®CnQW¸Ø¯Þûa6¦·ñuHÕˆ×”Ê½t³!«w'<.Nv»™ß,9EîL^‡É1[q??£p±ñ½b®cÎlOÉZ[ü’¨-_/»Úô¿¥Áz%¢Á‘ÍÍÒÆ€QHv!¹Èõû_3àà)*z¸¡u=åF†®w_æ‡¬x¥ jÿ(õr3Ü«TÍ/™ã€m˜™9k'–%J¬£{bâŒ'qú9éò…^Œ¢ãyôtÇe¾xÂYÍ7€!©´4ê´¥ž%û°]ÍìÚÁHMK%6;÷/ZºVý™Nµ:kÒµEi”ã†4x¹BK(PcÍÃO$5~ÒOümŽ Ç#GÖ5O]Ú€ü1ì^Aâ=)ŒÈÔ!ITê7±“¤Èg‹î¼s;1×vp`Ó¥Š´aüA4¿Oÿ$ç" '[gÜQ!>à7ð á£šßì¦:˜ï¥»WúL1Vz<i:,Gv43L}j<Ÿ‰?¿¸Tã–>“†5V¿iŽ¾31UIÞ1Vßf*q¨s{&1v4«£pÀï{ 6 åé¶ÿaE§š$F|M(¦çsÓ^éUX‘€iÿèÃB{iHŠ„TOk¥ðJº“F,a4Ë¹Ê#<Ôv–²PS¦J3T.oÆæC,9÷±õrôM:B@=‚MžåŒiuîØ?Ý×‡4”‡9ßëñ5ÇIúu÷ùV’°=kÂ/ÊbÜí„ƒsj‹ä–ýC=×uwÈû³ßa<…ºXýJ˜Œìx+Ì¿¬êÚv6/n¢<¹:ýÊ€°ûÐN ÒcÜÍLMó$‚5óÿ-:ë¥>©„h =}­½YEPð>°ÐuåHKAÂH+>å.(z[XeŠI§^Mow(wm<ÉåRhÃøÀXŒ¸ë»Þó¸qDæ\ý.Ÿé›sµ·y¨%'·W¾š˜ÀØYäÄÆŸ›™úÕ`&¢:S¨~^ðîB†µ{•Í¦o&Æñ3{¦ë9èð¢mýâiÊåŽ‡Ž0P2„gê*ïÜu¨ñï¿É/C:axö×üxË‹`ek|˜ØHå”H&À·ôs2úxf²MÐqÁQØù½¦,9Zù˜r”E<o¶ÿ”.‡Á¸øª*°P/CZ¨kMŽßÑŽ—0…*(T"UÅÛºí: ôm%þ#Êø§$ À\œä¸P.q*<"ï
ò²âá¾wÇÞ>|R½5m‰OI~üðžÛ³õYªð’yô|ÇN|<¨æO)N‚VÞ4'þ?—î-`ÞZåÞ7ÂéŠüRÎ5fŒˆ™Í3vóÜìNå¶cPèÂêø	æb5þžp¸ç¼1S•Üü «wò€UäÕÇž¤gzd­éãæštmUéy€Ãª¦£ø¾ü–È1ÌÕ6l¹Ë£‡ç/GeêéÊaélŸÀ!@\²<ì"}ý£ïÍ ?ˆ$ÿˆÂ8æß•ox¦ xƒ.¡‰;ÁÙÞ¬ã0S!UKhäCÔ–NH˜ÏÚéjr¾É/†Éà·ŒSÿ[M[Î™•IÎ	míWªü‡ð‘u^;ŸÜ	Yfìvç°B©Ô‰¡¢¤š@»­\Äè¦´µª~EBIà¶×E%‰ ¥éî4ÙÄ[ÿXGYÙ´ý.BWvÇµ|á¡Cœ¬¸¨<‹©6E(²ƒÖË«"cËLíñFö—¨ÏÝd™zE¦Ó› >Äì{CvÊ]â+-¥ª‰Š)H¬¼ARë`6•#¥Kˆ•Y’ÅŠ—‰d“º©Xa·qGÊóc
QÊugö<ñ~Ï
ÛOr>uèÔéV`¨gôÀ;dÿDŒµ’~i?€õ{vƒEA¤Âµ›Œš|–òSðûæÈCvÇ¯×*lf‡·F=Hºý†èõ‘Ù,^õÜçŠ4õU2[ øËŸ}x%'Z¢Ã,˜mz:µÕú´z·xö '1­ ýc²	f5È2/u©›(û@ÚqÚs±fÈ+ºzçäÎa4L\Ð’ì.8Ð¼c›cÏù#ß1ÏÛ»»¸‚Ì I1ÓüêÌ«Ñu4nW­­gÚ=´{Ñ”²Èå@=bÏ!É\C‹–¬×‘` Ÿ¡~÷Òp2¢éüŒ¡UÔLçX„üaè¥ Vwú¼Dì4rß>·¨¦’±2ØL€ÉrT6§/â×TPn—l°ž¥nøUÒ²/d¿ÝTåº5Bê½ƒÞCÔ‰„_l^©P#f,¿œ„ÿ·¯³ö•A$r]=‡8‘+qâˆ·:Kr.l¡øSÑ+IÉd3:&œB3u´£bÑ­(ÙÇ?R·InÃ¨W¾eñŒouåõ†ûe¡ÆzñUIùIè–ýÂù¬*.ìÉÍé5iU3ÚY…JM;[\šðxÍàcQ¥¢õÀî?¨Ø¡„•dÀÖÃ>¶£û"<àÔ†Î†S}„æ5´ŠG	°ÞqÜ«òúõÎ%uØR^K‰¢`™{E	’²ÑeÌè ¹ýÁß“ó á3â2ix×¤û¼+@Foº 
a²¯‰{g51JÔÅn¾³b\}}¶O8R¯{b®¨QCX]ðÒÄÑ»åZzºŽ<÷›Ðq£Ü˜ï+SÞVŽúgÁ(¦É¨ÞÉká˜o0ö¬¯'H†íµ°Z½,ÿ`åM;dÎÅvØ‰	Y,b/]w¦¹fSèMk‰M7ˆ²—¡Á‰Þ1@¬AÆ<ƒQÎä\f*2:s¼”ãHî@zx¨©I
Ñ0P’ÑNöÏ¹ÇÂ/ÃŒa†âè¥ò{Ëžž²µlˆ'_6WâÆÎ ¡Þª7_–‹R¢1UZÀy•¼¢ATkÕ>ŸËA}”êU:e5•¬Ëoõ47=JÚ²*3€3:.Òcîžós®o‡:RÜl¯º8”¦0øy½d,œ‘RÛI·‘2Zô€Á¥òn'_r6ôñý°±˜€õnÀšÛþ‘Ia-Ûû¨³è—ï,ÄXUv‹‡lb<vG õÃoI÷R®5$”4…¹rrÉY$ð$ˆKy h¦ÏÄ?ÉøVºÓ °;T2!u\P8û''½a0 u&‚ oãê÷Ê›ùŽÞÝlw(VR¡øÙd:-NÖLàšˆÁý%&3s–¯ÈËòc\‘ +¹•îÅáÉÆB`Á*febJïR9-äÊ4È¤Y_x³=vBczž4Ã«5üAº—´@kQƒ1'â™éŒ’£Ö^ßL©…4:t£ ©Ó&œåÐf¡¼ÁÈûiDÎøüÍý)¸mY–Ž¶8á&Á²}*fÎBRœôe¬¿ÝÉR*4V™ôX›¶F1ŽÞc8qªSžö†ÕÏápŒyîž¼kX$s,Wc(ÏÙÞxºæÑ¢¨kù!*_9Tèží !ÞSg8 ©£Sõ}ïæÌþÃË‚7uwÄå¾v±Wtc)²~€ÑG& `f‡aßl(^J±m ˜A1ÀÁ®¨&öÿÁËb{Þð–k˜ÂúÉ–:
àõÌhÝ>Àüª+˜"‰Ì¶Ùø†TJ¹«+¾§ž*–|ØŒÇHD&úábæó	¦&•V}âP³ìí$lS</ºÝæÀ[‘ñ$ÉŸþ!SK¸Ê/‘$bäÕÞ(ãã|;Ôä3Ñè—l`IÈð³U0'PZ_Î2Í ùnRÐž>îù@C¹+…G8©W£Ò@°j>Ñ¸õ- ?K·LmœýH0Ä{å‡çÍoè«Íh8zÛmKt¼&{tSœã6«š¡d"ƒÍáLŒgðÑòÌkX6.yƒµßëVÖ§ø^Ï;üÐ´µÝÎf€¢|¡Ý3lÎ‡†`õînÂ’è’±†coû—~\û<Íì»Â825öUdÃ¡Ó àA<€‹xv"™Æ ‡½áºê0{ñ£ïWç&yG…	Õ­ClbªÎ†1gä»Ëq¼xÒëd0>rl_ù­*&º¤›XEHñ°<\¢~PNùp×¶ÿ§P‡ZLMÍW@¹ÄI*J_žÃ;s7Õ{÷Ær­)a<œiÂ§b1'Hn~i©K}{XÜŒêŒ0·5)uÀ¶©ˆ{Ýrõ@Õ@Ö¬¥u ®Ëó 
)ëxà-­©v®ë” 0ÎãúÏqÌZ,æ c¶µ|ß&p7«èTîAÖj¾-½†Iõ˜$Òóe÷ðƒÝ-Ç¼vJ­9Úo™¤çö¡cÎÝ6ußWïÀÁ^¥’0èáéükK“^ýz?	úE(b!ÊK÷ëŸa÷$RDI‡¯äl‚J‘'B«TlTÍ”KëøuÞ:*q_v©3´ûÆÑr.PÙÕ!¯rŒ\·TWø:ÐR„s¥c“„YÚ/1¨Ù„˜jóxG&8¨©]^¶iðÛÑÈx6óÊ´…ÿIÊV>C1ÒßZdzÉe	lÊ¿¤g·rÅŠì7‡ƒÌZÝeG5C ²IÛ²ÛAf€mKkç%aØ]Œß¢=œ½¶ÂænxÑr½æ;_â&`V}6Ó:íùTAL Á:±üB£™0¤4«¹»iþÃ8U»ï@TÍ"8Éj4íQ±Äâ]'†IDœ™¢™;?o†„È.ð/“àŸE¡ý]Rf|<2óÿÌþ=Žyöå¼‰“?„Z1fJ–7¢ƒoÌ ~,©[£¡A¼þ«ú¸¼ì€ª$,ã"2þ<iDc[-bg™Õò{´õF«Ë)!Ê‘·ßT¤Å6¹WïbÜ`~a®V»c[£?Çþ¶
+EéªnNÏ*Éà<²‡îŠ†;n´{{z¢a¦Ý†W¢W^3Þÿî>‘>–…Aåç
ÁØ©éc¥VAh)ý”NÜ÷öÇ¸ÊmOï™7É¹QŒÍ…R˜²xgk`+ûƒšc8&pæ›h›>1¡ã}IáˆNËbFÌÞlpO+ˆA|îæÞT6ÏÅË[Ú¶¹@žFTÂ©GBÒ†)ÛTœ¥"Þé?,¨øjó#¼ãË=¼UOäNÿ]=âœ ªÃ‘Yø#=–% t\r6rª<ˆ|Üóu»èŸ½¼ÝÝÏ:ÖóúLÒ­—™‚©ï¾<âV Û?denXå7*$;Zr*ÀÓ3n3J³oœ·&)¿jõ¹Yï0(œ”O·ÏêÖ×¿y8J÷65jŠ¸kw” …#³…”nw¤Ž*»‘ûî'Q3ž¦úÔõm`+lÖ¬«_#ìÁðSK$#Ž£{˜«üždLöºZr»'(µÑb-à—÷vì±#ÐFÕMN Ñe0­¢ü%ò_¬æ/²&Ð”à ö¿ø¯è|Ðqá”F|PKõ¾¹PÅ¬zú&
Ðj¨`”tºO—¸*Ûâ`ÅË¤)ììYtQK\’û‹FÐ0KÔÜÙwVªÈµ1ð‚$ªè.£þƒë²øÀ„³âð®°Þ“tˆq]˜ý1úq'ÎÝ!‘t5ßOr®ž’è˜þÅ¦pxw$H«ù‹FÌ¶”Ê¡£OÈPOö….Yß¯|+r¸ÏðY23k1ŒªžâÙ›Ñ±ÎÕ{ªˆbGyš¤•f°’ù]2Ù n;tHø°U‚9—ÛRêR: lý¦¨Þ%<¹}±An¬3nlbg<tGßšåáœ3‡s–h§þ{ÈÌ´¶—¶õH€EÁCþCüPï>¨"±÷4»Üð3Ö$!¦ìç0³é~Q}ñÝ®M„Õ‚¡Ðj;×¢n¥ËEEð×F8Äàh¢òjŸM3êÜeÐæ‹œXš•ÆkEN2ƒÙtÄ0ßeø\åqëDî¸›B¹ô—4Ä'ÂÚv™ñ}¾ûÉ\:—Qå‰A85ÒÒVxõ-Ìš\‘ëƒ!?n éNE  Üˆ%Ô<Šã²LÚ…ožŽVñHpŸ-žÝý(îE
Ç_g» sCNAWP¤,’r­1i*#t/Kç·Péâ"(üc77‡òaì¸uF	&¦Ã"$2„sè’¿bÿZ¼²¤&À;«œ Ð'0m	¹ÌPEÕQ}pÔÔ?* ôÛ~ûKá-búœ§‘I<R˜1þâvym°câ®#Ý,¦™Œ¹AÅ®jb9àXe´dÜÌ‚KºP#Æ—
Lmè3.wP‚U… ºïÜ=y®êt	uÀ7	k­ëÕí¤IÊžJ½ú¯i&··U$Œ„
ÀxD%5`°Žjá|¶Ô’­ôûƒ7ˆñ÷†@|Š7Î–ÈÔ¡æU3}’?ZØØNÕ× Â–±ÆÍíÀ¶$øDoùlþPPÄü|Á*-‘2KëÄi¦èFÞSOë}@ÔÙ*]q$Âå‘^TÑJ1‹
—Æ”<iƒipívã/ˆRcÕŠ ÚtÙæTê²JŒJÔÆQŸN¥èÞÉðÃEzÔÓ(¡'UT)ðA˜Üÿ–L5ÿ„ö°É¸:U	?¦¡.«×(–ˆÁd€éåßõÁŠ¦¤%¹sÛÿì}†R¾ÏQ_Š064!lQ¥Rï'LÀž>Ì% qräÅ{õT‰Ìüá0CJ,_“é–8=Ç½{k7¡cÆ(ö_Â@¢ÓlZ0qîhv…1y®µÅõópL[Yªo¿HœlÏM?w
o9boÌ Ÿ{ü¯s—âÛÕ«Äª5k¿Aª„5ø[™v3¬œ®%GZUÏ6U-ä¾7H¦®‚¦}Zº‘“Ú93ÝÄÿÒÕÚÀ:FúÅDúí“jôvfàlt)@#©Ðô¸†/.qK²¨\9`/Œ6—R¯§`³6âÄÅ~(?àë©l,U[F9É
ºÁõõpÎúQï/H[xÑ&®b&zÍIçÞV`›`ñÊêŽÖN*i?>	´t°ã¿šÏ±<­×úW4Ä¢ãâÀÕŽZRÞëÞÅBO¨éÄ;ôƒ¤P®z+…”npƒhi"˜|¨úEÀYkb|G"}ð#AF51\í×½ž#ÉàÙfe|—¯e“ë­“ŽoÛ:ø".ûËÛ|˜îë×Œ×ä(Q‘ª™¢ŒÅv²l)¸.6ß˜‘OH’êzµ#ùÏBþ‘ÃN¡9Ûœ8adÙL…ŸmÏÅ<	"_¼¾ÍÞ¢y#4øÌ%ŽQckã…=ðø¬¦#§¨ûâw%nš$«Qô0o×ÍÒ¢ò;Aî‘³ŸÇ*gÂ‚ú.þ›Ë’&§œÒBž8ù’¸Ë4îÐ¹}7`±‰´RÈåÉ€‘IƒrU¦Á%÷ò~d¼pdƒ×¿é%ér¯¡\·ž*»ð¦Á’ˆ†ÕŸ=ÐV¯e¤`ïÁŠ‰ä®Ö4ªçq´Wáç—Ó?c<(A
‰¬(ßÁZ|Ì#µd™Åw²ò-ÆšeY5©Þàœ˜&^ôKƒÙªßˆì
ÇxÉ;Ì‹ÎO‘÷_è'ÿ{·òçw’4¡¾dõ³ë4¹fõ‡XÀq	6‡n¡ß›ŠI5P<d¢3)i9`opÜ™(ÝñÄ%Ó`ŽQ˜±IùU¹¯7&)
öëYŽÓü×ÉF ÔPYgÏŽâ¨¼qÎ\>éÊëêšKµf{Ód"‹…ÔXgù|
&†fwimHÁöt¢QŽ¦0]Ý*Üað–çØÚ~PråMa¸$èÀq”ÍÂG©3ì}'é^óÿ²OUÿ^zðfôçöÓýaR[ò~ïI‰ž@®.K9Ï„ÚY6zjÀ‰_±Y¾l„Æ_Cñ§˜‰M¬×¥r-ª#xvcD¦µkUóî¤<M6Ý`÷b«æ=_CSc¸ÒsÌ¯/”8àUY¹¬éÈ¤Xìþ8®Êb‰
àÕÍ~ÛjcÜçIv Tu·\Æ+-å_Zƒƒ…³7#ÔH1-âÖ¯ô•œ¤á^ðß®›½JÐkè_A-yw;ûŒ59ñ—ä &ÀOlƒ£Y7:þí(jÊ!•ŸzfCK·‚BÉh&šÚe»–ë’º{£=uîôº>Åt†¨ýúôšå_&°Zôm'ªÿ™•FfS8ùÓS¹ÚÏ/D½?9súS÷§ñ€k}ú>…­xŸÐ½àM×ži=‘¢t<¢£¿8‹\Àÿ£?îaÒr4>¦ÁÁ• !TY¿”IF8iÔÄÄ àÝH©)sˆ]‘þ”Þ5šºü¤AlqQ Y‡ä/³ÁÛJé÷%fÙI,ø¹LU¹ÏO‰Pˆ²²CdV~mâ:MW¿$Í«ýiO²4ñb,uÖ¯W®Y?(¸ùÍ9Ï¸iÌe‘Ý´	•b#N‰°âCŽ‘ôÀí§BØxDP%àGtÚmœu‰˜”ÿHÁŒ’D³næ_úž^þâh|èåWePä¸ôPÖÛ§Lû}nûà5ÿ›Òñ¬ý=í@Êy37àß©L›‘…‚ ðÐmä¯9ÐÝ'rì	Ž.L¡®_ˆùÄuØ Ž†ÈŸ#šE\‡vYdÞ¨¤¼¾j+ä,­þ÷rE°;h€ÁƒÕ Ò° (`¬yäOÀç["³”ºNþšl5»cÌ	Ÿ´Õ¦ºŠƒŒzOí°ôwò€E~Iª<[(cu/–Ö®åfÒC¹wuB\X•[³y¢v!Cá4±fìdÍ®JäÌå¸(ÞÊ¹–¶I~…o†hš©·æâ›"HwuøÞÞÈcHoÚú	­	{™E7@ñF¬<p.!‘òˆˆI8¾®E\¶K]Ð‚$ÉB‡d«Ó›ÉÎ>tM]¾fúôúØù™¶?
¸,ÝÖJùcA•§ l8Ë÷Ì\’_w»H¯¤ÓäÀÜíçnü87©?®y¨¤‰¨Uhwg]v±}5§Èÿu—1L(EQúC ãärAw˜è1iŸjÈ·0f;¨O*¡¿1ƒ™º!êb\,>ÄD­ÂC¯àë)ˆi¯Ë}¡cG\¤M“Àezµ`TP[õ™À¨€év¬Ì<áQ—)KF±;ƒ<Ä>ogŠ„\7™ì7Ï¼˜$‚Ï¢ƒ9g—ùÊÙ¾Þ:~¥°îXyßn
É¡fŸ£fêRlö`PdQ ý‚YçSÏÐß£-cRñ¨ oŽÜ}p—£poØ!‚M8'ôí¹Ã"9MKP!&r—­/	*ÿ‚ŠKsnmÚ(Õu“ªE'4¹Si‹ÃƒŽìÎfZµáŒâfnEn?'¾Åý‚Jkv=1;„rþ«ÔbNÑ%3ˆöfóM”ÀâÑVZ.#P•Ÿ’uSý·¦®5ˆYê4­K9o+ì@?º»¤U¹yå¿gpÊÍ"ÿB–B7	íJgËÏ¶¿ÍÜÑ°bSäï¯
GŸH)åþØå×W…°duÑç<^s<Î]¤¹J¨ø›Ä½‰»e íPkvEé,âÕk«¹ W†KÛ”vÑé*8ónSoôT­¯Ïùû³ú‘h÷Tt_b$}Ÿ_ÅµæGÍ®zÏÕi½¦>NÕÑWNßÌ#µûô}ô*„-J9ÙÜ³<´Æ8–Þïë.T<,+tÍ[ BùÝS=ø)d	;€Ë*lßµ;ðÄ½._ª>KfBÿ“øqxYøÍÿ•(F©ü|Þûš0.VÀ…óƒÀeÄ%Søõ‘61¥°îoM„D®Ý,˜3Q—Ïy±ÿžëqTÏ$ûP÷Óp¼‹RƒŽël•BFëgÌ9ÜŒ„›—Hü#´Ðo
JmP©`”ÒòÅ—…[±wiJ#ðÙ+SZ;ãyXvÃ4c{kµ^’3ÓïÔ€y¾–ÐäùW£tF^sžZû‰ÖÉ[ØðT¾Œeã´ø/Hs^i;*­ª0`ì0¬Cô[Á"{f&Ç¨:,‚I²4T.wãnAóˆ{_Ì8€ÎÔÜÄøz!B}PÒ ²GÕ²\C„THÚ\tK£‘€¦ÏèT–.ÍP»šb†î×4xóYÙ¤°Ík¶^3ghz/†Bq7íM ¨O-ð!÷m”Œäò'îiÑj°ŒTÉÖO„ê3Á/•Ä_¤EäŸ®’[-ô…÷MÁ[–[È–ÚéÎþLë]úY·¹p¾æ×ÀÙ”r‡™ì;nbHê£j-Ž¶Žu6è¢ªÒ‡’³‘-×­eüîpöð/ˆÛn`jŸtt°I/2kÅ¦‚ÿY˜M>c!RÔ¯š6äOawD½|gì}zÜ*_½Xé¢õ]Z¤ßŒ}¶> ÉL“¡ÁÌ+f¹ßÆ§¿øã6gâ¡ý€Úø })Õ{4 .‹Õ4´Q4³ÐÑ

f­„sžä-IRFÀìõHzid¯¹+u1ùÞRÌiŒFgJ6½™]hŒ ÖEvÔ[ÄY†­§ 0NMÕ¸á&ÎÞ¯¹G¶O£$¿þæ)Ô‚a¾‚ûºØK’PoàyË'ºäèé/Ødë…½Äd&rqX<Tbæ*H¼^ å…ö‚ÔHº»@·pÔ…@A~l‡d±õ[;&K“Žt¼[ÇÞ’igýôÃ¾<Ž½­3ô@&+Mù„h—ëcj½k¥‹@ãó}[{Õ7!‚ì´?…6POlŠ6‹‡8ÝåMg3E>ÏæCý-Ý5²lRržð91Àÿ.\®–&8¨©zÁ8Åäùjü#ßÀ¸L¢V×h±Üì"®&¹ÎÛÞ	&]2°¥¬~HiÏ'û†/r±wÿê{bºÄ_>+„sË¾rÕ ˜ùŠ¨âê-$–'nVŠÿ×Ðú™]·åÛcçCè'±Ò‚Ö þ·ìÞ˜ÃˆÖ°«Zƒ(fÐÈn®©-kÎùŠ‚U„AAÿOþç4Zoù‡ß¢˜Öæ15£ÂjdÍ¾¶5¤~`<â'°3Û`‰i!;!(ÃÌúÐ˜áªÉÐ¾óð„TžÕ­FTd7æ#ÏzÁÏaâN•Lb‘»-šDETª>'Ïe:Có(sý^ªb;ëãeïùk6½1z~::K%¢’…Æ#&‰þºÍ½;^*ØEY£šîžÀ§th9=u~6ÆO*31¹Nš°TïØÜ±àç-„ö[ìÛôÊåF8ÉØ%½Àõ%oåÄ/ï¢@%
lÝÕ~	&e§Žœè~‰.¸¯ÃÔeà„G¯Œ<¡3‘’v½Û#NÎã9e›A g~l1È²×Žˆ¨mßUhfÂs‹;à+wÓcåÒ>ï‘s,8Í€™n<æ“RàTÏC‘þô «Äù| ,W2­Yl!Ü>¨óƒ>}<Çä·$È|Wƒßb.ÓÄñ)ãtm#)ÊßšÇôk"ªÛÅÎN?Èg(š¢Ê®²¢^õŒ%ÍesçR/@&z‹ÇÒwi÷8þVzSâR^Ø¦…öVZUIJÁè›€)Ü¾î•ªÃ‚–öÓžÄËá¦K_ÆWHâIk–ªýg2ñVFñ:¬òV„ñÏ•(&?*ùp8%…¯Sø¸â6£m? ŒþŠè‡·ÒU‘u–²_Füvžœòr¥åä¸ãš~É-û/(üMÚ6E6WúIS*,.°¸in;Jö}Ç7,þùp©³¢,'P¿^ø q‰²-féQ0ÿoöÞïÔü VƒÝòd‡†Ï–÷É¼X*Ýê61Ñ˜âA)Â»»
uØ¡ÀÔö¤T.Ši yÑt§C%nÿ«Í\¡–‡â¿©wâŽB.‘ßjT(¸¥Ö–(`ü[¼ÅX¿™â_êË¹Fð¿8E
Ç5m°ð1n]û›d³µò¯çòN-~¾{à</vlÄJHêÅX‡½ËÙ´*_< QàJYz‹B@4]Óv}bšyï†²ik‹^†øboë{Õ@_e¡õ*@¤-šÚh'ŒÅ‚¬$²°íŒ,(p'üŠÃSÌ1ñr†E‰tïèRäú"‚UØçt§Ù ×ó\?œ‰'âb¤ûÛ)¢ýÃ@§ °ár‹;'IÃð¼:¢)V21Ú oÂÚÈæ‡<º±öûÈžÒ›Í¤þ©¶’Wh‘FF3S`Íßlìø«#¢ñ·ˆm´>`€µÄ»èº¹\	™)Ð7Ú"}ÅÿyÍ­ªÄªëÉàôk5¤=,ÂÙ¤¹¾RÎ` ” ï³X¡YíÔeñÈ¯Â:…à½BÐ¨BKn±ž±¿aÑŸ5jØ5Ù“â”Å4·§U5~gÙjZÓ°°Ù4)¶ØL¶B>°ê`FúåÝ’ƒ‡®³{$)]ï¼Û·Â :b©&K[7Šæv)=Ô_qÍ2o¨·tvÁ¸5ÙlC€Úâ¹ ÚKÂ%áX+ùbì±*³®»üóù`#ž€õó‹µÛéƒér^Å›ïåÝã¦,¨Ëg¤ÜN-±‡EKhM¾û¾ß¹ù¨e©‚ ¦KMgÛßð‘µ¦vtß€ÜMz/,_=y|T„éÇXŒ$vª-äøWOýqX+Dï>B¢[É~…¨Zp¥¬ ¶fú}uàÑnPsÌçÙ&i_XÚßtï“öLÑTÓ¼Ms8Qµ>ß®‹¿¡7S4à~7¾,GÅB)¹Ð+"1È ÂVæªÚ·-çB£ýmf. 7ÕªÄ3Þs}'µ±%Žb»ñÆ¤|åM™V¢Oºã¥#áí¢ØdÆ4…ÍtÀY˜ù³rÝ¼Io{¿ á–ç¾|B5]ZÇ]ÑGK¥ýÒ)£uMMÛµíóµ¬‰Z_÷€û¡’	?!·*¾*8I½oÕæ4é»ã\`ÖƒJÇI¸\1ØpÐõý¼·õ‹=2ždõtÛŒä£ëf
'ÿAœ—¦j0`n®áú¹ÐLçØÑsæ¿®ß+Mýðp€>;|Šâæl×¢,¸Jyu/¬Â‚ê_$¼n=4‡|ç]Ó°6o]'Ô­TF®j	sZ®·”»ÍE(HùœûRâRöµ¾7Â±ÀiéÊÃ‰PO‘‹næ^²ì°¥½jg}Ií‹ïøRsì†îÜ7Ð¶I^6âç?âbq€™¾ÆÍéìï¿8­†¯Áýç ²„é8–ž$Ú/Åß‹éç˜é5»ÀHMyé’uõ_tV€Ü[ˆLìE¢N÷-[“ˆøø¡<¬²ÿ¿P>—v–ÝÔm”G^üŒ))ýžä-¿x	zùçÍ ,ÍæØc³œÅÚÎH¢~ñd‡ù00\¢WR%ž”ƒ;…U†:­<˜NeŒkÅcà80Iý™l‰ºš-‚>Å™þÎÀéòºíwÌ„¾—çf†ž2&›‡GOÑ#{G&"AÍq Áo9dþ¿¼T"˜^£tìpñ½ïÀéî—š­9jÛ@NðAÅÖ0‚¦TÒêÂW&€¯®Œæ½)Æ‚ñðì ‹GÓ.¡:mÙí­_€¯Ñ­2ÞQÜì²Žýæä4 =­Z… AÿàÙÞq®-àNHh®€™tù•þy-;ë°›§×R‰%½]DhùÀªù0 HF°›ÑÆmcl¦ä$ð©J„CBÕ¦É› ‹ÑD:Q@@«ÒÏœ^2	gï#‘ôä‚Û^CL‘·ýÛ’PÃ–¬È‰àMóg<vu¦Ì1©xºìP)ãÞzpëFqÎ¸\³èPC†ýú)Žz®OÎ¹Pläqš³ûÐ‘Â•ãÏëAýÀ@÷|ìÐÀ×_÷D8=Ê<½Wo¬¼OëÐ|éúOHÊ*NÍq^žß^Z¡<ÜŒÜ*Ù.ÃÌEñ«${|\ËÑjjš€h46€Fèõ;4r70?‘è„£€[—`äiiG»=Fù›âÓ h({\•ü~ÕÈê~E:Ù]AÝß3F(FäŒlžu™_SÀs—M¥å3öø8ac*áØÁÑÁó÷æN&Äz!)¬¡‰cB˜‡QnÍn¨aÕqñrµŠ<²õ¹¤a™Ñwüò3À¹,Þ-bÿù÷j~)rvf!Wëúšõ£#é=yOZa ü€h[1ŽÊÚH¦‰cNFËo†^ýÎ•§ök6ŸîóO·9—:Q)]–’ÚQ4ðFæ¦=WßiÍN({šsˆL×ïx¼8= U¥ bŒ·Þ¢hŽÿZ]VS»>ßá…Ãq;ŽG	€ñZÕK‹;Eì%–£ùJõy’É‚'QèOÙ²É~¿Ñj¯’˜tÒò·M±XÐBª¢ lwí|xÒ¼kMñ¸/ÃBÊ?B¹.5‹7æ7RV§GËÙÙ4Ë@9Ý*Ð“5‘Q‘m­¼Ý|¥p}Ž\\œÒ`-»†7¤’±Gu?b †—|~SÒ¬•)Øo£B¨›_ý%ìTÝ«î×µËÿÀ×è’Î¨k@ó%âºPìml +yM4ç…QâŽ$±®ã7°Dö]¯ƒ3¢8È}RÏ{pÕæÛIÐ	êpÜ(À—$ôÄ)ez[Ÿöß ®¦@ë2:„ÿ7ì^‹UeÚû”&cvˆ!P`iÏè'ôV+Lv˜’+c`bë^*Ì
›ý¯ÿ?«ß@ÊÄ›Gêd½âSÜÂ¦#³‡;Àk‘ŽðER:}r2Fba¿tä`U÷tÄ&Îa[^ÒæÂC´jý4¤¹>IÐÉ›{’ìü?òž1<Ô&9d^µ©Ò3–“@ÄÚEóµV¨ìZ}70u5»ßˆƒñ•æ1êLj,üçU`¿PM¿•”2aU•qîË42ßÚF'!cÂ¿×<~Vˆ16Kžˆ‡ü6~ïQûJûÝŽºa†üÝItr,%LÙ–y$] ¦INw‹Z¦ãýÊPðÕÊÖ\àQ=zè‰Hg¤ðRÌE?dÊ[ô~Þ©²_É{{îys(…xbÁ]˜TbÍ×F_Ui´˜ùû'’‰…¹›Êãlá%#›@K½	Ó-Te"ø©HåÂô>IðnÚ\ËŽ;¯ó€Òg‘`¶Môþ¹Ë/äeN¶™å*ëáv½¼]Ït˜b\ƒÓOÝVŠ¬Áòcþé¬J=þ„6=éó#iõÇ6ºXu¼óëË·Ž§€!ÈùÄDJ@’Ø©ýs-²äp·uäah¿±"§§ÅYöíõ`Î1Mª+ÚÕ- ¢#ëUpïÃÜüÐƒ gþ@—“PÛ(Ë§QÄy!Š-z ÆVbÍ>œâÄr1–õÔ:GÇ§›Å­(¨“Š37¸Ð7bX,F¨>> ƒ>2Ie%#?ŽÐ&·E=3Pm)e×(Y€Þý’s>ŸvUÁ88Ré)^<  -F£¹ñèÌ™ ïÊßTL!Æ¥±x¬…(˜³Žv–½î·|œÌ[4Ø€kÀAf]ýÑ»ß,äÏ,t"ãÙ›übl}¥„ö‘cä”è_ý‚™MlÉ» (×ÏY®a¥„»…ÏO2º<‹&f¢mò÷:Öîê_ÞÃƒÀ'‰ÑF¹¢_«Ä=VÂJI~û¿‰ëlÛÉ8¯sû^Ó2™¯^èx›u?O¿Ö“ÎhCš+M÷³€œ®¾¼òÛØ;¨N%Ža³ØÉò;¢¶óÏ ¥?<:Y3´²k_yÕ¬PAP¤¬ñi3fî"6Gž‡Âi) =æ7ã¾[yëê°'Ó½q§'÷Ð_
CF·~`vQ-nVa™€£ÓŒ´„Kê…½‹EË–0Èúû“>Þ‚YT8ÑxE†[ï;%!â5.ÍœÖòÙãÔ)›5à¤¡íÄÓÒXÙ¢>¯Ùâ’=§7Íð‹òêÐùÑ’+ŠT`PÌNC³³ÁÑ<sà«–á+é{ù#¤¤/Vc¿5«ç®áîC’RÑÄB®T fE`ÜÍÝ.Ž–™ts €q.g#¼Jñ‡ê~ïÃK“Ý#:ð€Vý#È ³ü¨‰êŒÚ*Ñ²1nFA½"K „l`	‰¼"#û.@od8ÉC”	fBlA†8ºI%5¨¼)ñwmÑø¤Ñ€óéÐj?{‚ti?<
rck\¦Á¸ø<‡‚úB	mÃ~“HWöJ¸E`ŒrlZÓÁ•äfx±+Ü¡BáhÁD_¢ÍÑÆŽ]É ¨î €t®4§ˆaGÃDòë 0/|æ©¥žˆûïzn †`b­÷÷ðyég0é˜ÝÕÎ¶óUfbL–Ýi¿Ù
J½Â×¦èëÚUŒØ[üKâK&ÆÒE¢É~þ%÷íW0t3GG½5[üˆ|¤w·È	+CÄÄDIé#Dº‡—,FR<BvÞRÝg]ÕLeFó~RÑ¶åº®uœÕƒ J8ûâû€§SG¹ø€66(dpNd¿:6G½8P¨À%O¿ÀÙvCÖŒUçùÜïvA/.9âê¦õ=
Y¹£óÜ±÷&–’—S=¼`éœ<‹½c‹}ôù=™ëkþ’Ñ%Ã˜Õ5}rÓEŽ : lÆ4W%$äáý9è«Ù¶¢– ¤%R»=4âE-´¼›ÑÜÉBC0<$J«b•ú~säíN´s4E2(5§Þ^‹\/OCBâäiþüºt}jØ¿šé¯•O­’ÔLdS´~‡7zçE6JÐ¯PòÚiÊér¹ßScû!+¶_Gý	W®ëÂôËîÕ‡p°Š²e·Åš,5º'A
W»Cè¥„hu‚´Ð›ÑEõoÎ›ëÛ%	ü„É—£tÕ°ã±+
#´jˆuÅ€á5{Ä>§2‚×_Û%;óh\
®aØò‚£0[ù W`Tw}lÎaÒÁQ/¸£\•âë·wbŠ¦‚¶yºÍ ÛTWËäÖŸ/CòögÑ÷›#PÜÄ’þÑâf¨ÖfOæŒ|lé|v™£¯?É¨«mØ‚V½´Êâà}æ0U¾Òåj$‡xdSÖúŽí‹gÓ£¯Xéû3ˆØÃ¤•þSí)Ä¶"ªôÄÄ±ãØðOì¢’èžeFYEó"³©˜ò@œÀ`5HRÜëäˆaÚôÄìÛXD_ÓÑÑnQxt?ò}x»ZŽÔ§ûV²7ùŒ]6aŽ2eü¦dÜ%*(£ñ¤a[°1‘ˆk‰½ñÿišSL ³É#(F0Bé5#]C{qƒ^(÷p(ÚEwÂ‡ëÓE›y'‹VòÙùáø¹á’s†#Î²dÒ\ˆ|©¹y—‚ÎÓy„‡µØ– •|ÂKjýû¬ò¥_¨]rwY5\X”n~Ý·äesSúqÆœž·\ìtí	ë¿‘hÅÆðñºð¹´ûFÎ\ŽÝÍØŒ¨eûê§°ÆqÙ¥7Áï|8sÊ.'”OH!?FÂÅçR™4S!S5YkÈ¦E“·!_š4f;kùf3•À",ñt‘ë½Ä,äz±{ä¿iÎ€Î
É–rëèý‚nR0Ï]£ŠØ8Ô
1 E0"SÃÓFŸ–6¤Ï+¾9`0Ãì{¥éµôvP)§0-‘pówª©^Úû7óJÎeçðw©ÿbÏa>`ÌüÕn<Ô®cŸÀ}å½ì[¨ah=º3¼ã[™`+ôÉÅÂY§BÓè]ä#t%?	‰Ó‰Jœ¨ŠJÚÖ“-Ÿ´}Uó8J*dò¬3-ß–n¿MrgJAk |Aô ‘oŽD/ÿØp3*Ÿ>UZxsáËüè¦ÆîBT'u@‰ÐÞ>ÂhªLATÉ=šHÃ¿´¨Ÿ1P0YQï±dÕ¸¦ƒ¦PÈýÕ-¢ú½…ÞJ
ß‰Ž#+”gÉÔS£ŸØâ:iö‘1v|¿ î˜€Cþ‡¨KSÞþ˜úåƒB®”3‘V@/0ŸhÃg#ƒ’¯ÖœþdRGa®y&5LæÇY¹os/X dDÏ$vš#¶†¬ˆ]¿¹¹fñ-}{úf;Í¿ˆ#u»Ñ˜:N’-ÐIü,Pº“¢Ž‡;*È,NV÷¢ÖúàLá„¶šS¥ÚìAòb¦iN‰uÂ(¬ #î¦2‚%Ý­lB}_d‡ Lcò¬¶Ý‡Ž1a¾ikàZØB˜ºÒ¹_ñÿ´÷Ù«ŠØÿ¸w).)ÍÍ5ÐfŒïwÊ ½rÔÇ£XüŠwbWš¿/,4Y±ø,dõÁnì"s°…úÁØã±ç Ñ”–¥Üª­¼o ØWTÒh¸ ZB( \çy.&þR‹¸Jš.gÓ'šY
¢iÝÙÕ`O¤ÞöWk]ebÅ](µ,C*_¹¼Ômç *´„ÃRÀY(9 á˜	Œ^äHÚðr¬Þ~Äi‰ßvî‡ sJÓ`w\eÇÉ}ˆdö/eo ~óÏÅø£yWÄoK9ÄÐ›[€ëš—ÏŒ\µëúLí‚/B©FL^áÝþŠrÒÉ÷‹lóA«Øé_ß•Ž-¨ÇAÅ½ÿ ä6˜öŠfõNOìÁ1øý3Ùƒ‹c@é¼¿z±Kkç6ü§Þ-X$ÕôR‘²‹OéÁúB£$€†Y§´CÑ¶V	HžÌÚtg`Ï¢óÇ+:þÆ–Íä”6‘•ë™;Yf«öWS¯Ó+÷vT–UÀ&‘¼Ýäz³ä#1¾Òh-Ü9"ØÆ7ž´A÷ÓÒ&¦Q‡I%þ§‡’«ˆA„XŸÌç¥¨³¾Ä@>ÿ œ
Ø¼Åû¢öÍT½#†a)$œš<†	ÅZ—À`2’ÃI[7ZjÞ–ª—”5OvÓÆªE.N&ä› ðFûþ2«däÊ–EŸ[Â<¯o–v½³ÁCèå7KoŠ;Í@·3áa1bõü&Ê@\Ú(ž/µôH¨kkk&ï¿çz0±'ãg+°¯û(WQ2üdf!ð2Ò·ðxÌÞW+òº”ÿ~éüÕ0Sìv^‹ÿYLô)î~Ë¬üñøý0,óW[øìÃ?­·“½`Ã‚¯êgâ†T­Óñ2ý(…#X”­â¡öÂwIýÍëéÈ	z@4˜ÅùOùQ[mÞk.z›_â=Ï¸Wþvw&žò«6ª¡Ø:‘ÈÛS·#{¥X-=(É°ï·ráþ;½½×Ó—~1
Pï)©JHg?÷Þ‡õ¤èhþkÐà*ã³º²çu?ÁÓ÷ gž¦L4\VÅÊ±Œ…^KUÏò?<lØ¢WÉ>{pË	EUr!ü½ªe*>mkc8(6ÊÌþÿÆÈ_˜4òJ¯ñBÑ¶;ˆ*÷q ýÍƒ5Æ‚SÏ·!P˜Þ*Ä’(pj>"íL2½®¼mB—CÎahi²Æ³Ø¸ùD³ðÄSÁ‚„ùr[ucE%lîÈÞ†ÑlOÉu®éuTÑ‚ÀBŽ‘ÞAëƒóJGØØgbÖpœ^ C)8¼Ôû¾K\×°‰¾5ÅÓGÅn°ãaÍ¨F>†öK â†ùQf_Ã×ïÍm +ñ ›‚Zm4Hú[Ô›ÚrˆEQî}âÈx‘LCrçªÐÐìÇ´ƒ#½}s9½8~ÊUÕòÅFFö_ËUqüð€è˜MÇHáØû¡î)ÀÎS2ƒää>Ž^²hÈ6â<Y&œ 	Í½Æcl&Ìv?ƒ‰^9‘æ¹Pƒ¯IÒG+.JÔFéÖ‰ÁyL8M‰^È€·Ñ+Y*Š:N³›{
ó°_•;˜:§
†jÝfcè¹,©:7b¶Â¿iô 6Òeêud#øB‚UzlDZ"lˆŒk¡W«cìß,“‡ñoZ~¶"dqzâs$Ë3¡é‚êm¨KnÍ©Ý!ÔÂ]Àô&[òñÉ^¹i“»ËJ¶¸Ê×ØÎÀbþ¡)g(øÐämÃÏ+ž!($-*rB¾~»¿£-âã688ì.Ñ‚¬á$Ì3ÇëEjEo¸C;eR¥¡þI¥±ÔF· ™nâAæ„Â|—ƒxŠ‰¿µÞø¶®ôk¥òleO'¯zo.îJåç½Ôä´Dc8ÒVNÚ•øºG½ïD»|Z¹Í‚”Ðz+ÃcÉ}ª{®Z4ÿr5PRáøgÝ4Á‡5¯8?âG…±wsÝ]iƒÅ\‚¬gô7>l°O•ï:9{-T7cLU`§Å¨Êœ;’•ƒÝûkpŽ©É Ñ.å7_&41OøA*žŸ‹ò&ÈT"êH‚ÖÞæuÁí!(œ¤Œ»	–ä­®þ4×ŠÄfÓb|½Ét®­*Ròšýñ?s::Ôl^×…­ZLá•1ca¥³[ÄÇB4{„¤i/½-ÐÂH[ÜÓðÎ€d8§€ø²Gš 5úž>XÄB<å@½Ë&žm~» 	8vý¤ÒÌƒ|8ê—s·0^Ô\ÕÑZ„?|ßÝo®e¯öÃó®¶É€ÃÅ•‡{Ýì¢Î7^:f›ÐÉtÃ{ÑmÌa8MZbÈðŽ´æŽ˜Æ·ˆÂ<Ç!ç‡¤<úw.ä'>Lx”æ·Q-å–Òï@µÊ'õk•ˆªvž.>¶£ÕÍ5™“~y6ì>„eÕdƒFü~bldDÖ|Çç`K|ì¡sÂsÆZFtžéß¸Æh{?O“K~I!Ú>y½N*e€4Ž^O|Uû¤úõ°e,cãj%ÿˆ^L›ÃáA.Ò-´îŸì±ŽkŠlVÜÜ" É‡ÃZŸZót×uJ×0’(”Ã+9Q6‚ÃçÅÞ¾èj;Ù¡gø3¥¼!ÝÌäf£ù À±3Ó{†e5ˆ…Àæ|ÊFX
h…¿X)}é` /Ü:Í§Ä–@,Yº,¸ÇS¾Öh s5Aý1þEén¹o	£"°n¯ø˜í¾4BÜó¡õ®I ßd›™Búö[íQ	…Ù³þß"ƒPÚñ¾±\ZX<2r²Èq{€×ý‡ØÓò&[¿bµ¸ïÃJÃ”çë…55ßLÂU°^ç>Õžòd±|“4<ýRfªm­†K"¼qóô{=BA²¦JeYd–.ïáV.Lãcþ¬â;}Ÿµ«3ÒÐ"˜\jÃ_l1Ï¡åf“qÖYËJæN
C¦âgþÞ£ìñ*mîM*"OÃá0¯Ï Ý=äW-ào>ß)WÕý¿OšNC@:Ù›AœY`˜ <s¤^UÂs¥7ìh¥°â§ŽÈ\õ%˜½¶¾Ïç‰¿o¹f[÷ç·ÿü~ hî)ä(÷kˆh	ÞU@c)§¿Äu›LîzÚÅmÚ…Û<XŠW!&YÑe:¦üÎlŸi¼lâ6f¤°?®æÑ7 XX…u¢°Ù*%à`‡TÞíŸ6+)SÓ½£¾úÚ8±*“ï$SÖ*¬¾U­g57ÆÏË”J„®v.Óñ§·7ýçdáŠŠrë{Æ¨_kwï©Äk#ÿeSÒKäfÑƒÐ…´`Š_ü
HnÛ§íˆä$ýBBþ:$¬“mÈÁªÎþwßŽ÷GÑïV±‚„tó¬¯Ìu¡4ÔJ¨œê#9ýG±©×í:Ž‹JK´Íá[¯Gƒâ@hz+§¥ø¢r®1¤6dô¿ö«‚§I#BÝ<eÈzH¹°Ô*•ì!e¶i
K¼1JÉµÏ™4òKsÎïÌxq;Foô}ë\FËÚ
{	›v,#‡‰ä:TößS4—ñåUãú¹–õ©¡u~E23ò5å[@JU”c€eyX3{©d™ó7®F~×N¹óQ½^YK”„-ÿŸ‚‡X›þÛÀ½÷®4®uM¢a7/ˆû¢U-¨éFXJù}³6VeDœ† êÄ·„÷ÓKê!ÒÚÅU»Þƒ'Æ#rl“qâ’äi°´`sÓ¶XÈ(ájý¿ÊóððÏLÅzÒó°ïx¨XÊ="´F)¯Z\ZþRÎÐéê­™ i:o<¾}²ÛU,W´:
²ÊFw+±$vk|¤–þÐ@¹ò°…éàzÛ”€­¤:õéõ¸‰¼Ñà/ôïƒÐ†/^Ee2ªÔs%Óƒu;êt`±Aó!­`eÚÙ¬‚¦UOÜWol\:0¡’o
ÖØ®yÊ¶q¶DÖ•ŒÛ&o€/nîËyáÁhbJv!9m£Wï=î&†!=f/ug€Œëëá@¶9SÙ/a|&mj˜*ïÜdz€8µ‰Úy¢G­KÀ@
ðµí¦ö…Zµ¸0TV3?ÆES­øT¿¿âœ°³øBÜ"žB&MK‚Ú›×WœÖ8u¶çÞEŸ_y²õQKë/bê„JÌ©ODÔ?Ï"Ûë;Ú
|ÓÁ(<=¯p†HÖ®s™¤Q’kˆ½Ä9,bbhý0(<›Ñ; ÃÈ…p\†9ô¿§ÈZC<®Wä‰¶ÐBf{{%Ä! Á© ¦-LÔSç³@Ìj¬‡µÐ„ ï¡¦=Ì[&eY\M.V`>o®¿;ÂW“§T£ø™ùq©À9¸uŽC¡Ú\¦[ñ¢´Rµ2
é.ÚE3ÅÝý! ®¨c\ºv¼‡tÛËÍOáUrn[lÇýá.³­cÞäã‰ßIâÍÌP»K#±&f—‹›nþAo§5Äàáp%æ>û#œ/”‹V†LYÒ	1hŒÈäE’Œ*z	aô ÷Ö™4…´kÜ÷->˜OnÑ«€ƒíÎìa¸À"’:D ˜›ä¥ëÏp™¤“×?œîÞô#æ§àx¢½ÆÈ×Ä•gø/ŠØ›gŒÁ ±Ÿ]œ9;Ë#»|g>¶9È8É‚ÏKÈëH’J_ "¥äZµ,—­¶OÉœ£fƒí»†
dˆÙ‘YÞ=Ðkõò?¾Úo<‡Ë;˜@öíç:Q 	Iîìµ2GàÏÝ¬|?×§P]S ?ãûI¾l° ›•Üi6Þ˜Õ]¶Ô;‘2?]ùÝ†Û %IÚjÍñÏéêL´5ë9iÙ[ŠNžå‚ŠÔŒB”kHSÉzÈ.%Òäš½­¤ŒuIG>{Ãz‰œòð¼}!J›ÒŸ	âS07\ŠiBš²¢‘U0pNÝZFòÎ_¹öìýÂÆüGýŠ.CÛŸ›U¿jªˆÃþ’Áí³Ûò³1ì4ïê¯¹ô®\ÜÛÿ¯?ç£Šx§Àpˆ¤D?¥íB‚çºÅÂÑ
€A²Qu·Èú'G`§4Œ¯=Ms"Œ7­êEØSØVO&dÚ–£Y!·ˆ¿	Ñ0H=z–&† }|k®Xi½ê¨Ôqò·ûº4Rtãñ~“Ýª¼&€i|$LIØ‘?í çVB
‹#iEÿôRÓ<òwáˆX´^¦¨¨S©à;(láCìAœ5ºŽšãŸ·ÎÏÖ‚ë°MAÿŽ÷K²§ô¿û³~-¾mf†)ªàqâBÂÿn‹/d–j/#é:æŽç±ë˜#ÙÔ;ŸÉõ>9¨«¯K8÷Äx{˜‰­âêy,5'ˆóŠÔ¹]èv¢ÖÂ£ö<´¹ÑÏÌ/y´ÎŸ'Jãò0ÁŸ‰hóÅ«7Ý³•—…÷~¿š~Âè™³r»0‘û€9¸¹v¼ïyë6ä1Ž¡SR”~_ kŸÝ-…´z‡?W/"åÒ›{ñbM*›
L[Àáy˜-*maS®@%óLn‘¡²­Ä¿!WÓ)â]— Œi+ei,uÈ|¡D»D}ÈÂ«\V.(e†ãdâ¡(høé;ý°äC£›3òªS«ó/°ös6qÝâWÝG°~+çu êX#Üc„2SñÐ‰ÝËˆh:} férÉ*ÈÇ¬®!¶6òÔ8hŸ-¸cÖ­¬BG­’å¢ïzx¾âç	\‘—ÍK*Û(«8u_MÉŽï™	¤«*ÈSûžÝÄ…aeGÓA$£n„ÁÎ¶‰Þ!«Rx:<I¤öÑõGzá@uÔ†½1âtPÖ©fŒá×tðq#Ùù¤ûküýÈ{€3áÊjøl:×ÃÅ0]^ñ²›Ez~¡"•ìs¥;ëñúÉˆ/a]ç>º?„C~®›2]ì^wá›ßAÞOœùô‰|l¢˜Ø‹ ÎCýœ-°?ÑÁ(P\ycÑ1I¾·Ÿ0r,íò0ŠOºtï¶c#~[NÍÄ'ÿWF!yµŽìàx7S½äµ;SÖŠü"µL¨_ùu¹!µÓë©˜À®á]dJ¢¼Zj’­þÉ«F”KHÂ¬(cñÿnÐÛR£™)Ù{.þ
±)„¢!6@DhSš~5š[RHünÿ0W"Á7ÖñHZn®«	åï„ñ!¾dKŒÊ•¾'ÁlãÁ*êÒ$:8Gt
c›ætql’2}Ž‚ˆØ?Ý¨SJ5=cˆË(k}´Ž¼ˆ³È“M66ÁX4î¸¾ùe&¹NwwÞ<YW=Ÿˆ¥R®(zÔ`Ø¤+Ê¾-þ¸@Ñ`‰/UÄEí®HîÄW£µu4jbõs‚QxLˆmUQg”²†¦H]ÀŠS£ •7LüƒÏöH]èhÃÓ·dÙùæâ?©djÌ ”É„oõó­ðÖå¯û¾mçŠ4îyâ(hÉnjäZhÅ„íGÃ+£þz¢«ÎìÃ"g²ÞâÏ£cõ/ðSÔ®!õñ%òN$ÂTµìBÂ& 5ŸŒjLgºL÷Í/XJ¹
~<Ÿ<&IùùöÝü
T‚~ †´qvATÕØ°ý¢«‚9¨(×p¼Þ£Šä›wó}ÑåMVe¯±gb®ÎëÌÊò¬°Ëúð¤ªÕ±©á¢…½”¯`oüÿ¨ìÏ/Rœ*<ÆÕÙäò#3™ma‚h­(t	ðC¶tqHŸn× -´ÓÅßö¨63[BEu2,/<”ï<©	Ý›ÒEˆF¢Òdƒ(6 8{¯7ÙgmãÐry·jòe”©Ôò“A›N?»=ðoDu8\ƒsŽ‘¨¿P5ì"2ÃMÿðýºš¤Êx<Ì%–„9‘1#µ@éá»f£@†FÁbùwëØ`õõWB÷Ð³™“Oxô.)þ±µß>sÕtÄMÉ¶cò‚]XÞÿ=û4{Æ`C˜‡\âù¿¼~47¸è†Fy8ä¦S½èŸZ‹2‚xïÌK@¹_‹D“´²fEÉ˜GŽÖþ½$÷ÍNj*ºÝOt”ë´F1“K6<l¶C>.HK>ãÕ
Äž¶VöSÿ;a”ò‡ü¤Ôa:<ÄÅæ‰ªj	Üd¨"2Ð(
Y‚ùqý_õòºû¢Þáî†jšE©‰¦j~ƒt†ÓÄH²äÑáåG]Fv÷ƒÙÞ×ÁÞh=/<¯-¾©™þ\ë39-Õ®ÚIÖñÒmÚˆ„Þ7„ó‚|“ñ”Í}jl1^å¾]…F°äI²TuvªÊ®õmž4ýr+]THõN¤I¥¥Bt^îyÕ<IAš–[m $WHp_5‡:c¯7ˆw#’uôíî7Ýt¥&`ËVŠpN÷}Sâ+Ò?_å;=1à‹c-¯D(=N%¬˜\âó2hâ>yiòJ (Ñ~„Åíë]=Aû³¤=muä6Ø|´´uŸ¶*`Œæ™°×b,²¬]eáb°8¬ÁB©Aºs‚/í½›XØ»Ø"w>¡‘®uçî3ï„áñ•o}l?¦Ä„Æð×˜3´ýç£`Œ@Qa‘"Š¼7Ÿá¿>9‘þâQÂŸv–bzªä¯‚Qž`¦ÍÅ÷më”¾8sò”âÛ†rk­‰1Ë_9	‚HšÃÖ©EÔJa^]kh¦ÀüÏŽ.þ;^‹A6([Ì «¥ñÜ¦—›ÞÛ:§ÇOêÃáVÑ›wXÇX¾Bu,‚MW:·L(@ú}~	¤=>mÞÍ:Ý+Ü¢–ûõXco$í}#E¾H³šœµP×-f)B¬¯Ò0sð8žºcúF'§ªÛ­ñMYD~Ÿ}M ä\EÁD©ÈÕ]ÖF(á¤¸4Oe±ÿ÷»+Ë¶(ù|x˜Æà“ôR¦i÷š§ªßYî$Èµ„ßý•3\)¦y¿C©4y|Ï‰SÈ©™ØI®˜’s
iüûÿÎ3 ˜Ë_KDp=ÏÁù§q)7a‚1”OŒ)nn¯ºôe»ãÊ‡Ø†?RëmaY¦:´¼õ? êªØ5á}s`«Ë¾ÕÀßµå)>´Æë–Þj²4Ú7®a9I ÆänÉ'‹ºïh‹²N•ZãÖ'£´bBèºÃ\X¹ +ñ‡¨/Š2:jB^ì‚ƒ9S©]…ª*¨a±"pi0à× hÆŸ]"²ír/ž1·61ÒgÁ¤0¢´ŸÂÏû¨ð9*T|Nè6XO!z &xÇÏc:ÁoGé†ÑçíFN¶`3ÿÔû©§cÆBÔ7?ôWÃì¯æEÑp{9¬m„`¸1T(I»‘}£xAh~ð>FËj&LÌG±ÆEN qáM”Š´ÿÞ6¤±<¿Ì4£ï7AY¼]æ‡©ZŸ÷EËÌñÀRêU™ÆP‘Ä.L9ZtŽÙOP½3ñÄ‹ÍiòÝÝl€¦ Lßý%ÔŸÃ$|c1Ê±…ð·%HXuÉã·ï¨à%a¾¦C¸ŠXÒ÷Aç…ýæ{S‰?Þ¹}k©§pÖ›]kéË„ƒ£ë½l·0-sY€Ñ1Þ/ cŸÓ×÷ÒŒ7ò­Ñ§â†5ñ¡H7²Ó6fW&cË R:üX±‰j&<«Hcækó±=;²&á¢†<³ó[)Ý,ÙÑ&ˆ¿ž\P×ŸÊ¢bœµã…£¥qxIf{¹‰bm"q²KÇ€çT¹?äIá¦0mæØjK\Eèp}=ÓK„*N€“n} ÇuZÂœpjÏ.Òvê­Qµv©#©¾5æ½e2ß/ù<÷°?Y½ì‡5}D£e¼Ü|qB îFç6:Rä@›…\Í5Ož?¢ñ[X,›uÑeÄ«‰Zv:­ª*ÄkË¹žS4£	šdlèá‹”n |É”ÐÜ/Z**6¢¡$•	CØlt=¤·¬<dzÂÕÉ¥Om¸¶0•"»ldÚ\h¬3_=OM‹Å2¾¿`˜XS¸KuÂš"ßGÐ‡2}„MNvSÖÿÐÂX¬ï~C^¸N90Ýðº§È+ÙT` MØŽ¹³¶£H@¤ääYmLLË+.K4À.ùá;F'¾Ì­§ôDíæÕW±7wIÄÔJüöP!¡Gímš!ý5=VLµØZVãö˜ÃÝS-½å€è7¡î÷C0ÏÍ_ê[—®‹ !5
)0u>&:JQ»XïË¨ÀKúhDL’-“N;à²R{‘vÒœà$=ø¼Æ¨8+à¢.¤öö©oäõ|Ú(eFúºQyO>¬àwÿ¿€Ãí~uFàˆÚìÎ¦I.~éè¸ÛÁØ®Iµ†V-æ(FŒB#Ï.g<>ÉóøóZ÷K³5ï²ƒ¯óéHÆ±+„¡±ÉÌÇzüžì>\´·“‰Dµïå7Mþ»zQó{–Þ'Až«úTò/ýœþdš­Ô$æ)Öä(µ©S¶–z5­µµHÛñØÚÞ0{z§:bží8cÅRúÁ½Ò0~Èó›÷x9¤–{”t$°ÕÁµ¿kv\š´“¼øÝ—åÐeºT9üX*>›`x¤dY›hõ“M‘¦d9."˜¾jqñ~ÐZ’Ó’ƒ`à}+ÄHîÁh¯’V¬(2Ð&mì,–²3VàÂf	u"˜}fÄ;&À·r0KO…)_ûóì$–øvÿZï$Pe LuzEw§-©&’_Ô×Ö ©
v¥²åÙr™Ás‡?—´+C.F£œf}ENä®8›ã•z;kjç€\Z«h¦œûm÷ú¦û>F-;Mš!$[BÝ1­”.ä™CC4fLâõ‹–	µX¨‹NŽìqèMôCßßÅMª+õZ§Õ*N	™Ãs«´WH’_ÓC´ŽÀë!vëXg¶ÑTÈÞ%¬Õ&&68ë6Æ(Á“ôx¬¶ >î¯ß¤°ÏQTì-¦—EðCEçÈ©Œb1o³ÐU(¢b3ñ‡ç¯Â©Ü®'Hø y#ÓËTóŠvpNàB}1Uû=Ýâ:/Ô•ÔBÍ9%'µí}7ý À=…Šç/^°ç.¬3sú` £„Ã¥þ±€ZÐÿ®ªœ‡0v,<­ÔÜy†Ÿ¨V×ŠkVLÞ>‘`2ÛEŸmn Š’Gž:VÓUþ.½±¦f?’¦‘¹-Là·ñS’kûÇó7q.ËíJ„–UÄh(XP¾;«6QÍÓ¸sùxÂwyr^n|¯2i
¯ä™ØDÁèF{âmcMoa3MŒbæ]c“»¦ìª9¬¶†@ æDôæ>¦º¤¶Ö±~÷2¼d¡{âÍVO‘<ÿvÚ9å¡qC]#7c²9Ø/Ï@D]mŸðöÓ-pÿ±ÜÚM¤E5û¹ë}]#ÆÀ¡k^g“˜z´aî£>GO9õ[Bö·N+N}þñá}SƒR3G$YZ‚Ð¥ãØÿ¿SÚ¯2õUý0l¼h@p¥„ƒ23¶`ä´ª¦k
àš¹¼£“!þÓíñ'Y¿@Ñ†b¨ª¶Pú–i›7µ ["(%–¯®;Èˆtšz™ÑnœQ4'‰%±¤âH~<2§)¦ÚJ#ú5ŒZJB­p=ÚþcÄJû-iøê®}þÜ—¸MQmæ‘Ñ”<‰´¼çÀ¢úè^Y¤Bÿ‘Lí ·Üt hjpub€05g€ƒŠ%|O
$$Q“gæ—ò¿Çïñú.À’Z‹Îõ<W+©d;¨µ.9¬£ú÷”·çz»YÆ€_,$\Dœ±¹ï'êòçŠXQÜ‡lëlkJ_¡\SZ’—G€$›”j0Ù`Œà_ÞízÀú2ŠïC‚z¼l‘müñ¶p¬·eÞíõÄE·£‰;ùR»FÅ©	0â0ñpÓê†[Ìq«ceø	ª]fÎTG ¦Ø.–ÍÕæåú/=SMA6†ò~<ë©ûÛŒ6¡_ÙOŒ­E)’	tÿúÏã¿¯“%Õ/*´?nçž9KµêD„æHu:÷ì¸&R"ýæ»£ò®5£‚¹6ª'5™ë&¾'j†½uÃó3§ßK±$‰8 LûÚNùœÎ·ŸÕ-Ñt[¥À‘¡S­¸iòÍtÃWXQªSZJ/GW£üìUc¼LÊÓ\Å¡¹B‡¼-²0/|±cŒão_Þdóò»Ï‘9W–Jî©ÝÒYÆµƒÓ½«‹{.ZÄVM—C6‚ßWm,_…î¯ãŒò×Š¢:ùÍiÝÒçIÆUä°„ºÞƒ+?aö8&êÞ›vb*ž—±`ó¼MÄÇòsC8]±y÷ ]3ÞÉ©lé±7ðƒbÈ!±¤-a˜¡ð©}Ñ%Í[‹DÐW¸’C:@bã,ýò¢¸¯kdJÔƒý]-ÅŸäCHŽbÖ/²…dÒÑBt´.Y1ªöøÿg2½áV!BAn’å¶" ´‹°s2nðFHºlÇIÄîß*®¬;ûØ,âYcÑbAÿ’s½123\2¾äKbH nh&{M‘„‹2¯ºeFçÔÜ¢9QÀ/Ü„ñ˜-tØXq°ÁBöôÝ.ê“x®ß c&5ˆL¨¯ï î«j@H+>êvíèðö²U/LƒY“g´â¨SUQì€ôåkÕ{’Ç´8Ð6­VrÜÙJ…§~É=1:ø»8fV…Ê¢´‡â“µ+°-¶Ç’ÀØˆ¹»9‹§SCUô¿uÙ”ìªmR<É²µ–#Q@~)UÙí–¼ìÁˆ­¢3ÚŸC¿ LÕä”°@ÆUB+’»Ÿ(¸ÝÞ®iCŒš‰Ú—µbP+>ƒ¡Š ´ÿnÂžÄXá7uUs!øæD¦| C@Øˆ³yÑÓÈ™òbÜÑ<¹‡²OnjÇˆ}VØP
ÿßý€UrQDé–—ò•çØ¢bô»ÀËà'’çÃ®&`èõqrÎæµåÜuµƒzWgÕÊn†‹r²¼~à'mw¤YÛ²r9Í£/9|ï~G<Zê%YÏ‰ñ`æ1p¢3mz:éŠfòs«**UšDÖŽHòþMÊ0?ÎkÉþÌp‡8@ÄL2¨ß€j$‹7ŒndþÊüw!ÂÙÝîofqkˆÎOÊ	ä£¦–÷(»GÊÄÙÇÓDùsÜÞŽ‘1–gX_²ÃÐ(„¶rHãn„³D7b@'°î;“É2æú†ªÐo˜%¯Žh®óÃ&ÅÌ¡Uõê¸Ø<ŽdqJ²XÇ5æ ¼æøáÙÃ}ÕíäÆþ1ÏxðºƒþZ††KŸŒD2×S,;WÁ¹ËÔÍÓÇ™%ÐpiÈæIŠ”6ÎÅFýçí`Òå&4ÕCP”ó`–}Ào,’9…ÎP÷!´`({çPQ8Ž	þ:n)Ï¾m‡ÁÓX„ÇòNIÉ€”ÜáØ¿:Êè÷NOCrR6¥ùzùY«3Dó)†¤¡©eËy;¦^Vþ?Ðs%(xjÍ{ÝäY‚¸Š¾ái»Ûý#èg'"²ï
á¢V—]‰iÖªÕ%*êŽ˜Wø"ÆèÁÃÂ9KÀ—”OKç)rÈ0t¨­¬¢¸Àæºƒ#+‡'3ÒoLG ½Wœ«[üòòõœeÉÃ0Q³:"ÒV¥¶íNî!$£E6‘Px)½]°Ð_†Ötå—é,äF§ÞêYQ;?¡¢L¦ÇÇc+Þœí3_¨¿àò:ÎðÝß.Õ8înKy¯ªÝò–ÿÝvÔõAN6S]UŒ™‰ Ê|µ
G{ÙÇø Y«ie;Y´z½8Áé#ºjõ¥Ö“hœáxõZŠã˜RßÅÍú…Ø|^ùm~7õü5œ£Wê•.G…±C%cö`ëÖàB‡(ò4ˆ":ÞÛ"K˜z—­&Ò¯ªÒnl&óeÐ”sß 6|ð’¤ø&Šo«Å8#®æ"è…ƒ!í?%±q!Þ”v6¤¿§ƒgŠ–Nt1j­)ßY›“©Ì‡ÇïÙäXä†¬\Íœß×Ë; â€wïÒŸã:Yï3}ä˜Aî¿CTüý0iÏëwëÌØóÇ2¬	lí£Xåç“ueÁÒ;û¼™lÅàd¤B±&bIv,—OíÆ®Î]Öcí:IêáäQëc-Ìò%Îƒ¬?âŸ¥À)EQˆj‹1¨«ÝZàT*›Í?0\à5g‹ó…Óšä»®·(f“«;B”Ý3_/ßåtÙ!I4,‘ý@•ŽoièúVÌÄ}9&•Ît¨Ÿ1[4}…è×ïËøÔ‡dç8·ìHc³D@„G!6L´tuÏW8S!´F?^ŒÐ‹šÒã†&Ÿ]÷Ç—Hj6Áïå$/¹X üˆÔff1ÜõS`ìŸ | Ä,jûUÙ±¯žÑQ9%ÂŠ•—·MôÕ‚,§@"SÞNpª2Iüº~ú-©íŠcÄ7›‰Að™¶F„yÍ`ä3U{Ìg;ñge60 Áé6\^öo•Ûcƒ0Û+ÊøUÌIê<²À]w Æ	ÆÅ2ïWÍû¸<†è9£•Þ~ž›&ùÛ¹X	_“~I ã¸	j>(Máê‘Œ”WªkMàÌV¹WŠ?*Êž\(ØZu‹™ä‹í åïåôÂ¯xpMØCÎÄc…M˜…èß8g•¹íP3£ÀÀ5”YÝÕÊYã2­¤œ¤ü[·fkB’ÍûŽ³3¨ÊJPXb÷I#D;ÆÓÆ[*Ï†QZ€¶œKRßH÷ÿîêCl· ºØâ1eÚËÀ'ôÜ©uñqxnŸœ(ª&ôÈÏ»D–œžõæÅdž]]Œ	N¨-’wú7lŸ}ù5KŠ•¤sªÖï(Ò_ÃÈ‚=~zÊoiiá!à®Lÿ¯·°Úµ½·‰$ï¥Qn@ì ªx«ÐV‰¢ÜYKGcSÊÔ®O~´I©O»ÛÝËÍ˜™«…uþ $phïdÙ‹<nªEjÿÒWã®hDÜH¯wýMÑ‘ó]ó•:¢åT¦$lG{¶EOhÔ@B/¯šéšQÁSkÞ`:™&~­âØ–¡BKp±pxBc‰Ôf§™Ò—IpXÌ]vŠÙ«u”f‘G#ŠÓI,&!MŒå©»JÂ4z7IÇŽ£Ò6ÙÑÖŽ@šo:§¢!„Îö*RK´vÔÑI6m}°éè¹W4ëŸsÔ­VKIB8²ŽûTÂ„Ö|kÝý™ûXXxvrC§;´n[·Ì#—Á{N
½Ø}¿GÚhô3—ÕMIDk.Höðâ"¹¢EDùLDä+º;æ«ðXe(†C(¤ÃY¤–wÒ‘8ÿ &`°¢"P0KXˆ+‚*9ÀÞø2y©Û
MÅ÷ÂÉ¸˜r#íÕß¹æQ@J$ùÜd]ÂÈðž.¯À¥ìÁÊ;ÀIóŽJÍèßª°Šv?Ç;Ü	N€©ÛUtà„"¾ñƒ!>dçïÔÔ´(‰ñ@‚Syˆ?oK•:ÇÖ™Ê…g‡YéÜÆ·²Ç{J¿Ž'tv:$#ÿ5_WÏB:òíŒÄÏ–´ÿÄ%%Qô)!½l°Í	—>À÷ù»ÃEK±ôCìÄøe7ÒæäF¾š¬Õ°z‹j\Ð9ÒŠå~œZ-‹3:ièeé¥ß$©cŽ­Ìé³ÿ3›„¹jÃ˜ˆÃâª^Ü~ÞbpûRÐyÅçÚ2Žˆ›2±¤ë±­1usu&Žþák é­!àá*$NÌÀK. ¦º,åOp!H5B‘ž
”;‹~–¶BA÷˜5×~È±WìG¯è5p1RÔ0¹üÃÕ‰…pùBÇ@“èù/qlR¯öUZ#÷ æ¾Ý¬Ëi{ŒA„*r)2à¾QX2afÍP^NaÄ9¯Ï’ûègÕ½ í~¤%”Ôu²€œÿÕëç
ó#jiÅ&Ôo†Zúçbsåˆ^-¸œ]+(YZUOr¢×UÈ^uÖéh{)Ÿœ½„–JÐ”ïÙ:ó"w. ƒ
UaÊzD?†Ò¿†/,Jsµ;pÿØzvÛ¢Øã?*§}Ø:•´Î=«kóêÙM‰ðxòIýI>ñ!n@Fåñ¨mübìb§éÓÍBe3Wã‚({³¶A3B	?8¯ðTjôýÏþÚ¹gæëx0aŠ-¿Èt[¼CÃJ“žhè¬7gÏ¹á£CàÏ"d LÈ+M]€swI!GE®Ã©°?8Rëj­á´ÉõJqW_Um{²÷ô#Ç8 ƒ¹ƒò9²ªl12G8]¬$ªî,b~aà uæ
¡{óÖÖ¦«È°«QÂh~•ïó–4ÎÂLœŒŽª7‹gß?}‰lg*é_Zu¿1f²süßµ8Ò« Èíe9“¾ß`c—‘£*•ïKÖ4'+âßé„ÈÛ ©4xôÛR§Å—§,ì‚úÊUkVÁ“!zL¢Lùû}Œ¦Þ=#ÓJ„$œZÃì®sFqšjµ¿b/Šc—H/	%M5ðjô«-“PkA0¥ðÌw"¡7M’ñ5©ßúÏZvÄÏzª¡Õsy(zòo@ùþaA ufD{F“æÀ¼Òc5®°`Œ[hõØŸ´ÉŒöø¿åBW­œ!"~{éáì+ø&ïzj)Û5uw»‘‡cZã.I·‰VÙÀNZ¡"‘³-Ï"t˜ôh£[ïŒA¸ÁÈ»9£š8´Ÿ-.4—ÂÎÀJL‡šÉŠÆ'q‡Þ¯X¼J³o¾ì‹§–2%É°ùåm~Û\L(»-f·æã~ç¹RG˜z`_Ùg¢”ˆõ»æ ÷D6ÑZžº–,ƒ·…cC´‡ m¶˜Ñry°¿²¦öëw+Û³èaÃÚº­>8OÖ5½¤toÂwÏNË™‡L.$#–ërÙŠGÄôå·kg©ž€>ÅL_Ã¿6AÆj½žS]Bí‰<D,æÅ,hÉàl×
ÛlîDÕÌùáº]-<œ¯ãgì‚¶8†v«cÑ»2©
ý‚D´Ü•;…äBˆ~PlÚÕHÆË=ÃDì™šï.Dy‹*0¨ü¯rZKcÀÝ‚Ê˜!¢l|ä¼;3ÑÌZèÿ„s”g2^(Ù„CÞòòª†qÔkÆ#ûlƒM3 ËjÈþÏkÃñ$ª7ãâàô©ÄÁôÃXTtx‹4#Ï5	ÕÀ¾C[%|¶ç=J>n[¥A¡ãVÆ–z¨¦&Z¸_c–Ê#¥·Ñ¸ÁlÕ—SV¤Y~å6®ñ4RAaÆ:JWøÌ;¾4ÑÔƒÃ¶çë!ÙÞ =7Ë#>) È¬j_¿`¦h¯ù‘bÛ‚Ç	šb-›bZw¢?‚ç&X¥³ÛrmUý( ù¾V¤¯ir»4{G@ÝÃÉïí…A“™etIû‹°¢êý…x)Û:/írv™úw×{I–‡€Ò´åêŸ~ý¢{2¾wË#ÉÆI‚ß¡!é¨»h3J™=ž¢[¼`[ü`yEÇ¢0=ñ˜ÎäI[M/(o.$Fáý=m¹÷1s¡g Epmé¬Œ=µ±®bI*+’,¼2ö7nc,™ñ—ã}ñ
´Ãô«Ñp@Ž£þÌC–·¥ZgÈ{®
xØÜí„‰€7>ûšÝ‘?2ˆÈ.Xy÷‚¿J-„pŠøžîÖH¶

zµèTCŸª­Zr†Ñ­2~…ÿ^—‹G,2¤äùÁ Un¹¨§ÄîÇ7´°‘ß8lù ‰ÌZ6òOAªšrŒÂœòÁoŠGMgWH³¢à×“»BÒýˆõ²8/Ní®˜ü—`!p9PÄCn¢¬Ï˜²à„UÁ}Ë†-n@8r%!6—\cÖÉ¿({ˆ	a;ªŸŒ×±‡ðVÞé¦×dƒZ|¨ïô_æ‰ÿùŽ9ã†ãÌÌúú£‘{Õl2–‘¾ˆ+P'µ)O	5Ñ‚žLìq€[‘T5vh×À‰V§•™‚5â‘g/Ö£â ÅN›”Æüª1ÊA,ÎO>Ó»!xG0ƒDlÝAÎMy	:¬¸w$aÓœBœfÍóù<fAÜç TiÂìË~*¯"ÜChí©^yt“›î‰#Ãî‰ù)_. •Ëx ôr05£ñ¬ýWƒÏX‡Š ¬ßÒåX›Ÿ«è¶(v™k„§?>Sö»Îo«*M²°	;z RöÛ‘¾iÊc),Ëe¥XÆvâœÊ	Ó›øŠ¬i[ãÈéüÊ¯B
+ÝüýÚ"³Êð„V¤ZQWJ\›ÅWúŸž7pÓÓf÷DÑ‘&ö>šxM£kƒ»þx
¡9å­à¦3ÅPËoÒ5úÃö1l€h<â0_‘ÈÆDÜ×ìãDÍCÐ˜è$²óÅÌ\P¨Õ
@¡‘1ÜN|­ÖÂ‘êwØ†ì§ß°÷MOå&åÙf@²š_ri«1ÿ/òFG_0;zA «<qí‘&²eÛËC²³u1Ì(GaP6Øêôhl’Ê„\ª·ÂVð:J ]‹äˆ«÷{hE«g¾©flÙvPÚäµFÐÇíÿ)i
8ŽÐ×µí~ŸyDE©NGW"vÏ…ÒQ³¿¶â×èmî‹/¼¼Ýÿ¸bT ®rÂß§û;/eOGeç'öŒtü}u«BÞ”ÁèA(«+Š–¦ý¹Â<ÿ!Ó)Ô:ÈOBn7[Z°2Tû½ˆºî7 ¯S±9éœøYLUFS:e8å½,)ãT?¹],ÝM®ÀJ2ÑM÷qŸÚ‚‹3µ¼ŸjÿÝ„äX‹ç®ÊÄœS§Z(MãrŽÛ:Sãa$y™‚^Jq5 ÛßÇè_ðñ­2jæká£–UëÒwVdwo)>gˆ®-ŠU ©úXa¦øal§æôvdŠÖŠRÞh!¦Ÿ&\}°ðáÚMb£+Éˆ›9ëD•RóSí=Õc<Œö]Öv6†rtÍx¶g°I6Þ[¯bùÕç˜;Ä«JÏ³¬å³ë´9yÝ›x#®ã5¼°1¨T‹²^›Åwºc€½Ü¼ÇÊºõ„È÷•ð VGé¯têI“ºx×sØõóŒ×¬täAÃK¤BéàV\Ñ–…mu–<•Ó#zTdÂÌô·ˆ.×µ¡‰çˆgVÜí49êWb/Ž3øB­à#uû:CøPØx§µ»mU HŠãŸl¦\iŒÌèèjºÔd”v©7ÆHv²³\×ùôUÒô£ R&l"Â-æj†ä
OÞ 9Pë
8I'ì¤Þ‡§–FÄäµ8*¼ÌY©µhëš$p&ù>›ã3çØsÕc®ôb\íZ@l}„#t€?œ«•‚8ÁŸÜß¦¢µ#v=+4ôz&jã‚>ò 1=ït&G6ŸÔéBîíƒ²^\ùm£"ãKNC.¹#dìäÌa¿8rˆp»'ÝÄ#Œ|^úý¢;7Pú˜=h}åC”îoŽUZZUê_ôÂ{zjØXa2‚r®Ù8æ%´'1'½^_hëAßªb}MÊJýè9Œy¾BGÄ¶VÔ_¸fº¯„eÏSf—/‹•1‘ËBkâ÷üÄÈC	f¨À Þv´€Ë»-ßÚ÷Ðªk_ìþ=IÔ†kHgŒziÆÂEµ½ßÂÑÞ÷àø‹ÇðR=yî1ÇYŒÙCp$`Ó¼ÿWÛ%™Yãæ½ïR*¦¶q]\5‹™ôÖ"+y­~¿½’uóÃ÷Qxœ—5ƒÎû‘_¤Kvß–Ëg¡ºVÔVûX[EP¦>3-ZBOóªb¢ôÊ[P4+£Lnž53wÀ[ºëšæ	!_Ä\n§Å3do$ÕšÜß}™z÷¤G¤WPre¦¢}·ÉUcöÌVÒ~d	ä	´JÙ¡Ü)€WŽPã<!ëd1ÃÔ3àTÂuþÄð5N×Šî‚y›Ž:ë?¸ì²oÓ$­à[,yŠËñ¦FõÀÚF,ïDú@sÔ˜¿[²CKÛÚ¸¿–-\O®®W–ü•ùijwl”È½…¥“¥(sÆ«Ÿþ5PÞÜa\‡ÚºiÆtõö4ÞrÚ_þ†>á£êésÓƒŒ
‹…58C¨Á)|’wU[±%Üa'˜º^á¾-—))Ä>>|ƒùöÈ‡¾ÇÝm'A.Ë0âoM°à¡¡Óé—ïIÍÚ ¯’ù×!þÝjši­XÑG4I1Ýüó¶lq´Yë,é‚8\ Ð©VÄð{ðÊÆñây—½Ð<s"^.óF¬V÷.è¿œeN4º¦‘#ƒQx@y=Œµútv–b¾¼S»qÂÝ{Õ;DÏÜaDïº¤}v¤ó­]0ïºóôx¨þ”Ñ_
÷0`$¨Zóô)/‡|¶l³[ƒºÅ»N›(@?9ñ&1ÈV-&$˜át®Lg²­ëBÄCêØlrg®Ji âW@z¼«3•PúøÝ-EÀË¬®yîø[%:§¥Ôš§Ì‚«ÌOØ‚Òn_J`õš‰‰ùî=öQ¶þŽiò’¸¿ÆàFc~`<”ÚÑàõ1ÄÐýÀ\yÁ-æ_iûC¸ø4„ä@	õ’c­=õ{¬$óò+js²Fo|Ž4žTµèÆfz—U»ÀÝÝìÂÞ€ßH²!éœ],*/‚b©%-þwÿOŽH¼Þ¥{÷ÉdÇ!xññ:.¼‰Fþ%u®•öF)¼¨?õWOj.¬Ô„ê¡òºáŒ«w$u3¦mÃw§'yàÈc•v9P[Š öQ©IÝHÜ;Ó<)pÆµ¿•ê}„PcgŠVõ¢‹i¹Šõã³&ã¬”/ñê-û»_­ƒõ?½eÀ·Hñ®Ï ÂE)ßÅ•aÑ¯=7é/Š@‘ýúMAðZ;aZ‰e$“û/UT77ô¶9ÂHy“W¨oüŒy7fÂ…äÙø ÎøŽ½¹Ü4õieÿÀ¬@Ð!N«nÙâãs„rö‰
R®™{p‡)(ë(~ÝË˜ŠÃ×ˆp%Å…‚	P¼†ÆAYìZ%ËµËžQŒËb¥Çõ9IÓ\ùä•—×ßYm$•KÅ*ÁÌÃëü$ˆübH@EÆ™|;kR­“ªXz@À<z7y.¯ÙÓåjäŒUñÔÚ³q'UØò;'ì¢í‰:ßØ¯‡Z9÷úµ²yFþÿ—š›¥ÁÕÐ:§"—2…'·ÁÉC²\Â¾qÜ2ê”eíõô¾’QÎvo¾i~—Mù/‡€•ÖE¿îÅïSúQ4îúS¾Ž×ŸWŸ˜9éx|]]«09_ÒÃÒy|¿.Œ}á}[öÍÂêü¨èpe¿¿þ¹üÂXª†­,I1´Ð6’÷¬…Mˆzi‹ëŒ%¾|÷jÿ?îæÏD.O÷–žWdwÅïÂØýßÎ!jÖµGm|çBÐópBG±û3_×ç‘{>€² +Î•å N‹D™ñ¥r0"&þÝT&!\pù"LsGh	ø>±U$ð<!3@K¹¯¦â¢²Ë¥ÐŸÚ°Úó–Nœw´U:Å¬\áïŒhg§‚g>Û!Ï-mì¶udLfd"D¼ðõ{p ¬ÏnÜQ‰RòÞa¿TW¥¢²Tñ7N°Óð¶6ÁUâ!£)•ð)ðG¡Štóà@9ôúÕƒv^»’a%Ñ“CbÝ"ßW‘_µì½X<¶Hö6TòC]'gnðOÓšiHµIŠWmY1"˜ÕÉóïX2äG¿.Æâ«8ÊþÁWÃ}9ž·‰äýŠÅ±AýA„ºUã¹ÛTUäž¢ú­çÈz²8ÞÐ·„”¨œî$Ö0vqe©±2IA3ÂÃó+ZÞ7X´tƒ äFü!“§—,Ÿ–åi†­’|Sz]k•±§E£WA_ê 
¢ÐdIƒDùîÏ,ÈZ$/n’´h¿æßÈåF	î¸%¤†[[?g×{¶£È¯BVr¼cvªy—Ü‘ìÊb8£ýX‡#Šßò¢õ€¥ªª¢³
¯83š]=CýoöÉËºsˆ£ÑçÁÓ°ÿS!VøÊ[ZÕ5«¯Ú\</áè…âÞ\jÚFxãÐpð'õLcÕàoÅèÉ«0À‡8o(û:XiÈõØ†¡#ö×î/ÏiÎ³å&ÁP~D!3ëéÄ™¡û$òêøºi HÜ==*l¡­"ˆ9SßH‰t7,¥“\'‚ü¡b^{eI{ŽüÈàø4:åIoQ˜ŒM»œw.å)ÞtÛèb²oÌ”^?ÄX,“È.’{ô{’O"CuïL¼PõÎ€‡ž¡èÙØñê@²HÈ[uNˆ>ü¥Lç‚i¾¼™oƒÝá|;‹ñÑJn#§eàJ=vøô ë‰Dp¨*AaîVO>¦}&s#ÀŒ²çÅTâZ¤.iáÛ>ØYYe§áá ¯uÐúá¾Hõ…ßáÐ<«ßû.µœŒ\‡Ÿ+S­q¢£2|5‚‹BÔcS¤:¾Pô\ÿÖ3A{XÓéÁOI™MOÖG€YýÜýÅ¹²`;]òÈŸ&Þø·ü¥`PèàÑ:´vÌ2ø»²_ŒØ~ÖïIN=í•¯¬§#¼+/ogðÑòÉÃ•Öd§•BË|Ó*¹E¾`c-ÕbüFÃÚSßòÜÀ~áòæW?bac2<òRPÚÒ4ÆSµ”Æd`æñœÇ¡Tò¸ª¿i–ÊäRì[çD;>h ­òÖñw€äÛ6©¯W´¼ÚŽ17	Þpñ”"o	<ÎÓ§µOjû3GNº±l®àì0ˆÆ¨æ‡yuh]ÔÑ#6¤‡ª%ñêÇH#àÖªúÍÑ¬œ‰ñÞ};©?_"×çÀYúh‘w›²—s/Ãçñn&D[…nƒ$715…ÕÿTeâàÀèî6C‘‹
y(Ð»ZÝ|âîGÝfF&•ˆ^êlV¿i…_ß;ÌêÿéQþm:YW®:Œ¨‡Á)›°g¯PäžfÃÞæe‰@0?G¥Ÿ‰‡’2¦£ŠÓjŠ]“Dê:6€Áà¿È	<ß\áÙˆöúVà(¨c™XŒ«˜ž•!ÉâMË	¿ KH¼uBë–]qM #4pÃ"ñá…	á@Häè”“^A×ÁX¸»Æ÷Úiˆ{—½¸`2Ø0Q€EŠ‰TFÈá¼€e:£á¥»ôìb¶ôº L1¦)Rr÷Ž	žÝ»hÿ#<ðÙ1{t«Ztžt¥lúIòæ9^-v 3Á’àÖøfÎ_öÄä0cbÝ{\xGkbŠ—˜ü!\&¨z‡o²˜TÕFUu"rJæ²Œ] /c
…õÞ7û/Ì³×ž»AÑ·›Ëi0ÅSÞ}s“P——Tép2Õ3ýÎ®ÑGZ3¬gxbœ,r èe/E;M¤ª®&ƒóƒËxY¢‰€_ˆô!¥vÀ™OwD!ÇÑt%ÈeqNàrc7³çéBFk(PPîÿÑ7b¨~p\%§ñÔÃÖ¤L`ÐÊÍÏyõ/B"òCèHRyÜaˆ¤Ô‡ž2rã©1”f¨ÏIrÉ·6$¹{tâ³$lÿ¨þBðÅá›¾¬^ÁU$çÃ‘Ì‡³åŒNmâ¿ëB¿·…h²òpo‘RKEÜ†kÌ5òOZN£Ž¸Ëòc…Ô#ø^ËØ8óÈ†7lQ.¶Ýý˜øÃ1ä@Ùå3r½ ÂXÐ"vîS-e3ÆÕ²‡³Ð±•ØËSü¿¤~R8ÍhêOŽXñW¼wª‹¸;‘j­-²ŽÐnGÊ¶’7Ò,BiÀ	K»ëj+üNT¿4–à‚öÚ³~ržqÛû¢ì”¬#'Y?ÅD)1ÒZEfî…é9ï§›zòQýÒ‘çÒ ¿°ÕÙâþ±„”à!>4™žS~@ï¦§dùé‚À÷Ð¯
•Áð¯Á_H°*S¿¬²é­,äÁN¡ùqæMB2úTÝš÷¯ÊBÅUná¦†®3méœ!µ`¢ÓáÓOr\wÀJ¨°ç¼¡než ŸÀÈÊ¡5*[X æá<%Óy|ß´«`U„)—Ûç,‘¥ˆ3º,9pYÆ6Õ.›Ú0Vü*°ðêvá/± p/‘‡÷*4Œ&¯Ôë¡Ò½Qöt{R*y6É‘ÔüZÎªéˆƒ£zã¿\­¾Ô­}Å/ic.–Þãï–ôÅøöÈLãßKHÉ8åxoJc÷}˜¢µ€IdÎ	ÎsP&•®“%¤±94·`PË·ïb§Ü¶w-&±¦ÌG~XI,ñj´>6Í¥¦8SÐ¿om–Ÿ8JÐ­nšBFŠ4›ˆ;`¶–ÆV>µ‰€Ì”žþ»!ñ’m³4¨™?ú[ŽÁJ˜ô¹~&s+tJ[žöÆ½^Ú¸4ua¦c/¿óäÖ&øùwÛ?ðÄ`Ä"¬ü|ü³‡”mt
'2|ºEý1¾ôŸÏÅÛ±­ÝýÅˆ¸­NE4Äú
@AxKÎ£î›©`Qm÷#ÃýWj]kªÅâá‰D«ç65ëi‡Ä?tî9H/§‡Ïúv‚ªUöØéËRÔû+©ŸÎ¬lBô¥OŠ÷AŒéçL-Î D,‡x@ùÂ5Ôƒ´å°™´É&”aazÇ&ò fà~Í·BÍ†¶ÄãîqU”›­)zEÊ¤]^üè…¤•ò±æy¨#?ÒŒ\Ã}Ñc½b
µEãÌ/ý6¥k$<íKö\Õ±½ !ßÒ’Qå.®P‘â-¯+KÌ?:RìØ·Ìàw,äêi=_>Æ/ub‹×Uü†q8»TYá‹GBÀt¿sC{l…ùžÑŸ+o–,^ï!Ô­ÓÛY³|ý4ú×uù,Ù5ûŸ†êy—'+©mZY‰é|3…Œµv¹eë®¶Þ.2=Ô-È®JÜÝe±;Þöl*5²ZG×È¬² šHb§·ÇÓÔ}TÔÀƒáÛÙŒ,#“agƒÚFåþ³wÚg¨ÍÄÆK+äÿîRLŸ1ï³Ö31_ÓËÿôPCËÈéàÆE2™[USŽjóÇG±ªÆÔPµ¼-ù%ª€Ü´,'®)46äØrÿf_ Þqä¬zôN¹ aå)Ñ®*TøiUZŸ&¾G|·K^Ûp}ÊWJ<þác¾›f&f’æ~FèIv#Åhl¹Âõ]_ ™²buý¤&\°¿J.w£f2I„’NçÄ±žõ#_.io;'ÕÌY{‡sKòg<P#ËTbvxøö
ìs'· C­Ñ™>‰Ž÷×¬c÷ºâÁ«`R<*ærþïeô–Ly#	*>¼v3½O‚Ì'hÔiÄ©L‰ç
™&ÔÃÎ;¬Vv`¥¢˜Š|1O~ÝÀœx´x!C*4XÍtú¥‘J–‘·éÿ?ŽÕ.&%g¥ywS=pÃÛÓ žmWFË+ &î	cðjhIM°Ò¦ž0ä38Ä?h`¯:D±yµŸg¯Ÿ¯Ûf¢q×è§ÃY9ã±‘Zþë¾ð÷X¬ä7.Z’ºZËd5q“Ìk=±þ0t¾9O~ÃE±.90ÀÙÚ¤¯ÿL—€Ô­S†ø_ŽØù°d
2«éÆd«ÂíàÂ*g­ßTFÿ0î ã ¦ŠUåfkïçô7ˆ>^ígö-<Ôq†ª.…;„LØFP~oƒO¢z²:ïÜaZo* ~rgPãwÜbÞ‡~}xÿÀµ{G±{9˜:_6)ñzÊ3švèlr;–®ž1Ð¦!J?õPµ,Û€M»¢4^Â_+Ø˜'#¥õ‘'ý2S‹©º¦ÑÂ:q—ˆØêa#hÓæcëeÓf­Ì%µ´ÈNËÈdn,ý¯ŸÃKl·¡o¿Ù6„!Â‡lS[m(–d1˜ôã F» Zt}øíL6çnû¯^“DÓ²›,9OT Œ ïv²Ô	 âîÇYlr…db@ý¬E¨TG"þmø‹ùåQ“É³ôÖlêä8V£6àl:;ä‘¶÷³ÛòWÓ6•Ãô\_š‘ßçÚ7Ë€u?ÊìBæ«£”Ñ=înIÔg2ªzMCæŠ*äªÄð·¾)!Ø-N‘@&gVY“_Ôš{HÆÓOsÚ1·C¬vôàÐqý+›£òÁ8:%ù32{
¤6£žÙ#<l›®@y¢š¢‡Ïæ~Æ××V"¸Y‚ˆ6¯¨ÌÊ/,RˆãUãNUÝžE§­B´W¡Íø]j%%–VÇkûjÝùFC)–ayRj°¨¸Ã¤0àÑ}SÑï4.EÊƒXðaHÍ_ÐsÒRNy›…±†“V0PRXˆ3ªØs4ÀÀóX§yAºUw^­|¦cÖRÊ_½¾—Š( æ·_í­°Ç|	G 2h5®	{·#3!ADC…z7LÔ×}k0 xx8‘[ BÔv;ØAøO.€¡9‡ìÔ[g—õÜ'»Þè»ßóÃ³)º?êºŸ¾D
Ív‚GzÄuÍO½S3QVÀë6¬Ê†µû/ÔUˆY©!èÌù_ž¨UøñËqÓ=Ãyúïû7ìCëÇÄ†24t®õ™rl&ÞX&=Q!ZÐÕ	ìæ@Z7u=	Q~õ×ëžƒ¤š¡^iQX?pgFù–¼ú·‹TE%øn‚‚¸øÑ
8vÚbÙößë<—ÅªdÆM~¼k`Ìcë^ m­ôsˆ.Mw—g;·îë-7qœžžh¼í	M?å‡?•Tñ^ãÿdñ>âõ%?JN4‡¢[ÑšuÖvLý¢ù{ë¨0ÞÙ­IIbìÄ¶€êyrD0–7Ëg¸PÀ	šÉQúÉu¥…Jêc9 4'`•Û¨Z}ø®SsòŽõ=¹©˜¡f–¿S—<”)cÚ?,È^{ßÔ2Š'úóGÑÙ?E	ó?Çq}Ò,5DµÜ‘È#C´øªâìF@x9/@ÜŒ<%L.3ôIý§Œ×»( óš6›µ¶±¼µF)3~v9ž ØîÝkÎ!”qÏ†YÂèô›(vTè¦uÍ–÷Z8œšà³Rµ<¾›xs²_¾ìTþDëùõÐsˆsà _à"¾ùiy™X‘ÙØVLBs¶¿ÂØ“¬W‚½#¢ýÏJiYmþûQ‹cËT%<›^pïB†wÄI"øjÌC6jêºÒqupYÌ[.^¤Ëd+ é¸ïâûåÈqCªFÃ›Á D9æÆdGÀµ®õèwu­5r‡ÝY…A¡šÍ<·âhÁ9AxöœËÜP5Þ,O)eÑ†œ|åðt‘‡ÈY¡õ2{Ù«/waüôf#ž¯‡ØÑ	úÆ€.1ô×ìðÖ<¢úØœÜÖ5˜Òðyùfd£m®[žÚvÖ†r¯àîµÀhíYÉâº‰4_Š}Û‡-G9:¥ŽF›.jîá2ŸæœfÎ¿WÉ3†„“¸çìÉÜqŠmptMb”L[h{A¯z¢ÞÇãäêBd=±H4×Û<ê‰¢m ÄG©Ã¢6,¾‹n@Ì.{hú„î¡?­S)ìÓv…ž‡® z&%2méÀ8†â",¥ÎD¦¯Ý;’`¦öy9¡*ö[•_UúÉ«P7Õ¼ÌvÎ>—fzÚ¥kæû¿cR,}ýÝ‘Ë3ôú}Î§Aå¤Z÷I –€9“ûf‚''*@ÔY¤Ñ—é‰õYjùCKßñÍ	(Â ÑŠb¿&ŽÛ)a£œY¼ž›å"ftóWÝ±*ÌÓBo>íaœ=<¨GgPðÜ‡~ð=«ÂùÐ© ´ÖhæÈ¿¬Š1´ÏÚ'ymñI(’Íë<4GåAvšûù[Ã&ÑjYá¡Qo€yð ëAA°óWØ‡ 7|&@p†¨@~67¼Ùâ8kÉÎÄØ›Ä¹ÓT•}§*”€I~d]Ln‚øêhfs &Ž{–\}è.ÜrþvR=dvü³Pº~4ˆÌ¿‹QÙIöü"~Û¸¼çÎä¦7)Ô¬²B–ßºŸ ×¹tì4¸åˆ‹+ù¦‡NP¹e[aØ6†x¾;ÊbµàE‹aVÉgî¡_¯Œ¾TþÑÐµ‚CÆó. ×ŠïÁë}û–F"ªfØiEé¥éºÌ]Óà7ÙÁšOûÁéØÒûìiDßÏùÍô¼ðiN†çØ‹ƒåe1ùÀâmÔ§C¶"*U+.ÝQ’ó6‘§í©¹Q®ŒVpõÊE•pr®Íúf¢–¥ Šx;{Ø#]	Zœòá2à.Š.°Öx ¦º¾uÇöVÀž3‡£$_¶l°¦m·F‡³~´³|ƒn
j>-E!$ÞAÂÓ»·J}qu]A»³5°ŸòuÛ‡aˆBnêÊ‰´—Â1{Ë®&D“AÚê¯–¦ËuÃ³€ŠÁ9»SÔUì`.‚§žŸË!ë.È¿ÙÎQÕù‘'ÈM$¼B0‰£/ÌþVŽ7u^fTÎGpµÞòŒµ½¼5unÞè¿V$*¹³þ<y€·(PcÓxGFç×ˆŸ5ÑÕ	”¡ov’€D›¹b'iê.”™#Ô ïþØ»Í3»>û+Kh/$áNzvA·±~£@—M^@üÿM§™¥FPûà“a>Yå²‘Õ*ñ´=ŽþóO-È¡¯nŒíÄ‡ñe1lÐ.x,³&£‹¿ý|öÞ$pjiÕ[ÉÈ!Œâê%'+ô‚‹OEÀbýU-l›*'hŽ@_‘n#Ayp
2­4;5Wå}¿x®=RÞÕðÇya¼Ù4]­Ê¿]OØ9Ì…‚Ý·w[Ï ¡¥A¼æßQ?YsŒÿ’™³CN[5å87ªA¬mn<	ÝI­L(CÙ¾X'Æ»mv…W×k4oœÿ•’>odü_è¨–\C7˜bœ}F£”ãÄ^ ¶óˆÖb4©˜-ÆÁGŸ—õZû3Ñ˜…k&ËUf—òB·
Ìt{kD;.Ç3\#ž¨½¹ÑŽä|oa"•F=COÅS”°ó»óÍê¨MÁ~ÒÓ‚îiÚsXÄžð…Ñ ŠŽÕ$]KIPýz<”Ê™™ÙE¢‡Fí!iðZYU!²MÉèòUÛ¿Â%^¡i¿«ÌÏ×L	ôãDàº×"EâµèTž¯;PÐÑžŒtm4±ðâ§y,i[>…ôÇØ›ªèû´@]FËñ`$’¬’)&›¦*µ@¾UY‹q«¯CÝ+AxÎ€9;˜ÉM»zî$qÉt”A(JÂÂv/}V@N+§ …º´¯_ÐNµ-¡ch¡Z?¿ltôÚ%eõÍþj÷WdÚen»>îó´2ŽÓïoOŒZ[B2]å:-i—ö4“)6áŸ‰Qg©…J xþ<µV$á‡9ì:xvÌ2ˆK‹~ÿ´]Â×'UžïYù‰(ÜÆpôl¬¹'eëÙ…iÂ%‘³åOè-´¨8±ØTNZ;6áM–™!½Å?Î¥[X	ÓdGpåÄh oéJS|Ë¹÷S¸Jµõó=6KO¢Î'Ûí<§ ç—ù2Ö?ûé®ýyGÁ5|ŠüÏfX/:¡.ÎØ³`%)Í*íAÉ»»ÅN‰”Ù'©âŠY ’oQrÒé GÕàÿ&*=K	Œ¶±_ì€R=·ˆÃÛäÎ‹LÈø
‰Þü«õÝðy§øÚlÜˆD&¢¥>dF¤õr*3AA`*–ªJ0ë	Áe¶àä«W«?_Sð5ºÎ‘÷DEÁ½,›o—Þ¸ß-ÚÊA€2¦Û®l›-J~eYãÄJÈÝÎÍ¿dØ‹Òf,ÓW÷kFˆ-gt{¼•Vp#Ê³Éå9±•V­»Þ\*?¿Yúíƒð(Æ ÚCDÀ°PŸC$PƒäOƒÞÌ²'tP™NÄPÁñt¿#!T{¶Ê‰Å×ÆÒÄ'ƒ0@”•¸b+ñ@ ŠBWûýwÝo’rpÅjµ®Ì	ìß¾äš €¨3“¸×› ×_µ¬Ò`ãnô&IXØ4`÷§Ùûh¥Øþ#¾1+´›øÊ
 ëƒG9LRL.QMü¦Ä+VSH2bg«AU_@ v„W5JTê¥®A
¾¯)e`k’Ì§÷Wêf$Ñî*ÇˆªaÖõé¹±zõVs²eÌðšø:µ·‰ÿeÀ¾!hd ãŽØ¨Q$m9ð‰é‰ôjM² Så$ˆ¬\F½ØïLk!xù^wýEôeM®ÏF1\r{¶ïâðëÝ‰éø´åQy)ÆuÜ'#ç‹I?(Û‚¹ÚÀþ©Ù²ó]ÝtÙß;7‘Sï*Hïíè‚ˆ€‚1aöIP§Q(&á.BÔh QØÎ”1¿-Üú¦d0,Õø›§ßÐ	¼7
4
zƒ¹Ö¦oz7ÛaA§¬…R+Î¥Òlx°[?¤™]ch÷ý;õe¯pgÛhÄ€f–;wÅ.i>KÝöBÒS~ïÔVŽøhh`Ì4Î¹RÚÂw›v.óËGtœxÙw>€ð=C4`Ò¹.ÉL)ïÄë¯…i ëuG¯:HÎ*áiŽß|£ØWÔ·@vtèG7¾saÆ~È—‘·|…~I˜±´#( <3ù¬tžmÊ^*(|ðƒÑ¶÷]hå{"lïýZ’ÏÓ-À›åoQ“(è>þµ]))†æ|NfÄ™àÁØ=Úž_5HÄ»1„X`Éy8æúGˆÑÓ:†¾*äýh@œ¥?(e›æÃ›”d®ANÅuÌøWm‘Ë4XÏÿ(.\¡¤ƒ*ýÒsþº±³åð6|ñ·èøˆÅo%³è…±™ ®(°—”ª™&›((äàÝ€-æÄºMÉ+©Ø¢&$5Á£¾Îèµ]j6D§N¨F¥zªÞõ&E+tl»x÷†¦y–ÌM•ËCP³u²ªÄûƒÃ’›Ow)~~ŽnŽE¹¸£ª9âÐ/º“÷¼$gÂ¤É¦H£Á=þÑä^1¶â‰t#R£Ì‚æ^@SBdÇ˜3˜µ$t’¤nÁ×Þ(=[Lá-<c•”P>™ñ[wsû@ A®ùnÁ¿
3	F5Q‡k0iÀ/;#Ï9$Éù{VÆåê?<ËWg9e^}éZ¥ÇúL5Í?`«\²¿“Oð]óÏzw¨þà--M:Y”u£~3y|«·â²§Î]SC×(-ßpÈB!4^Þñäž^ {[:,®ðU- è¸>BœG/èG÷òº\mÿÿË‡VpfÐwÇžãM¦öŸcq;JbÞgl†z®òîÈ Tz€™âÄŒ0«oYHÐþiyÄÀ­õ“%jX”f¤-Œf¹v!:bZåJ·.¹Æ?N'µ«†÷ãÝ„<ÖŠŠÁ€\›KZ'\;Ë”D-V!Æ°| X¤	ï£[†§(µ–"»Þ\…ßM2¶ï>Ð´’õ¥_LÍºJ’¸‰0…¶2ÙŒ¥dyŽ`65ÿƒÈ›¾í\µ/§ûqýèÙ«A±_@nå´
"L»Á×Ë¹fg)²-Z¤Äæ9Ü.uòÍwß¯Ï«ÌõUøK†Á!ƒp½³@ÀVX8Ñ1Q‰ˆwV~AÇ—Û’˜93ûÅPÊz~“yÃ¼7R“Á†-?ºL÷ð
d±ì@Ù†[ø´ºÎ>PfÜlý°SÃ•RmªÅÅX¹jÃûÑ³]>#sò;ƒPNÎ‹û¥ä÷Õ¡ü½À„Ÿk5À.6c¨¯
Ý7ƒÝª­˜ubGHkžÛ:€ÃS2.:Š`Êˆ[hËlŠ¬§Ó'z<æ,üTUw!èaÜísìQZ6*,»Zp[ó¾Ï´c!œ~«´¸‰G*~x5€tÿùâË«<™L3õâ­›m-)])¥Ðªà…~”Ò6Wl`A¼ôðe®ó—Ý{‡sè¥"€|¥ª-—ó[YÔÌ®¥¸MÂqS$kyvì`MÒFÌm`¡Ô…NÏ†ËêK[‹ô%Uò›’ÍR€:‘hŽøÀ*6Œ,ß+Æ“jR=Ù»GŽŒ®‘ƒÛk”ÈBRIsö5ÂŠ a¼!ß}Ÿ‰Pû_X¢?@5‹ÝÒâ¶\L¥³“­ ©ŠÉñ“xnSý›:U\™Ü¡G#®ŸÌYØ¹W,xÙk‡ddM¢Æ‰xæŸŽ£²ìE0pÙw¢½îÉi9CN:ÁgqQ²§rh%}é;^šêÏªC™R®ÛÆ/
_åòC¢ÎÆÆªQÝtû‹M\›=‚}	Ñ»B2Éø8¨mK-gÜ¬­‰9š¦–rÌjht¬M:&>Nß©}3iùJøùOmÒdå_8Çc[ÄbOÓû¤Ëzƒq-ì.ç’Ð'ˆ<qLgßðà—•1¶ä>,lS ‚pëXøÏ~X!›y¯ÆÊgOs°/C©½kšæ#DŒŸGÙ¡À¾ŠP]ëåjnð&Û8Kø¼tDªTÜÚ /TWÎX“ï‡,-u‹»­ pËòåh–ífc±wq©þžáÞY |è¡óÅ'ÛCÈ™:¦t+zö(áZ]ËÙÀzTF2ž4óxì5Ø'»U$ »Rêû Õ	·Ÿò²øì»R×D‡½ÿiæƒ–ü½GjbúÓUð¥!V»£·îÓÓÖ{tN›£×ÞäÚeo~L@¢Å±Gw –-àr/EÅÓ‹~"iÐÔÓø5šæÝDÆö2?ßßÕÞË=G®HÐ‰ªÔ?f²[i^Î>ÍoÝŠ·ÿ7O¼8²øëžý^·ÐAéÉÿ –ÛÆÎéÞÄGðç†´Ò”À†u´Û³5ë.i_ŒuË|˜m•N‘õAáÐ¡¯.ˆ7^„íe²ä÷}Ã?6µøÂßÏßTC™Øl¬QæobÇ±DhCß /zHmðÖÅZ­ØæÙÇUq  Já;nt¹ê~­s´ßk’¹)-ùX¶~½Æ}]•ýO`úùê¯+Â$uñ-ÓØ€Þ&ËÊ
>ºÖ[0÷ ®IbÃÊË#£î´ßužªÑ®´FÃúNÕ|llß×¯²D0ËAâ"á<I†Zmò1rºÓ[ÁÙòžÜUßNrŠÔª$kßæ„5&;wÚõ.?yñ4…ˆð¨PNžò›Ä«z¼;ëE¦ä¯ð"ÔŠ"²ó¾£`_Ýö	è¦‘%±§ómêþ¶ý?ïM`ä-Æn"ù²Í¶ú'c¬¼¶íqœrª÷zcg£‰¤
8:þ™ÖrM: òœC)ÙF–Ùfô‹ÐUO„H+·ç	5SÇ¢‰z‚™ÖP7¿ñ¦Š_Ôô\eD±IûÝ`ŒìÇÅ¤¹Öw©ùKByn2ï%¦’pŠŠÂu¾å4ªâTÔiêÄÿƒOäOïí“«Œ¨„ÀIõ‚Ror^ä†ÃJópqÓ"ýî©¬/ëÌkbq‹YX‚	U-#Í·âºÖ²ì¶`õI0oe2qá`ßB§\Þ||2°DAöÅ…ò¡óØLƒ,ª#Aœ^€ŸèG	¾^,Bj¤—$ê*›Ñÿ«”YË=±AúÂƒÊô%TÅü4ƒÐºI¨ñ‘®bÊ6Èºív`Å4Ž•Úˆ¯0òáéÃ,’¢7§ZÑùiäðÓö¥:q‹AõÎg@V©ÈkQ‘H˜z°ð<s/n½G6ÊºàMœ!ƒ
*J?—à¢Âr9Ý3ràP‘È(;°ü—["[Ðj«¸pá»Z ÔŠ,B2§Žá(IÚÂá<ÄØø²/óª…Æ]¸3©r8Z‡@ÍGÞ2Ìk^á¤8íTßXqa¢8Jàq£À‹æž5R0#á5¬G8ð¦EY§qý¿X¢½\65™µ5D~;†ÄV’Ê i… ¨-F=3†ïî­b¾]2#Î¤jh¶DjR1kÉ¸™ÃÛ] rÝî}ü8¶Èrç{ðÇì¨óru
+øï1+ñŽ\Ï™ˆköçGKÒ6B“¡…iD!Í#þ²\ü8‘„´½‘Òïvå§«ÆŒ—óü~ŽïT=S¸‡è*„+ËÁ	:H§1¼.®7"Ý~â–1õ¬-éò>,¶êö@ÑÞ0Ñ”“ÂB§–
E.l§ƒÑtöÄ—hR~áJû(¥a hlsîÐ¶ÜeÔÆ_f`cÛPC3lÒbjMvH†*^ïÍã?<éTFem¤“+øÃ÷HÞCâ5§¥âiÓ?dº@ÝØ“8ÀžÊ0®Š6tv¥è4É^°ÉÆì8y^¯uõo=ßGQrÍx¼@ô!i#ãüÿ“®ŠŸÚoàbË¹ly<fÎLªaËÓšÏ•÷EÝpgží>L."øå®Ôù’Uíq]ŽÜžcù9IøéÑìIÿ¶ùÖÚaì·¸îcÜœÙnqï™¢FüÄQÁ¾Þ¨¸¶,}Çñ˜Ý@¸k ]R >ålrÝðÈYåŽÝRDÐßè\åô¨uì¤PGTÈ_êv!9 ²W^Iz9t+AÎ9	Ò4ˆÐðÏälÚ·uv)ïZ -À"‘™EÜˆ~ aX¤TÇ’®!„ñ Œž…ZŸ‚ß“wWg6¨>vc%†^ÊÕ}“D7³J¦
Ást€éœÐy/tyÿç§šÑY#k&‡ÎúŒxej-:fÑŒ¶ÃÒ ‘ü®ï½y%ùÿª^÷Ê[¾ayÿÆù70Á½x^Pºž,Ð)öpd?ƒ~» Û†3Hq+ŽZ4Ùâf¶Ìâ8Òë¼L0Ú•ú#§Àåa~AÚ¨6Ê[OîKrÌ.€“¡Dy“[ò#ÏŽw˜»ðA¦LYÃª)…õl
1\¢þbL”ÐÛàµ±@oâH—0Å‹ °oÞ
E&s—Õ4BþÈûƒÈz„M>Ý2-C˜Â Sà°¶Ê ‰´^›>ˆ,³ÙÓ?0Ê3æÿÎ?æÄÉJéŒt÷"yþ]7¶ûÔ»)û|uáGqCøq@æq±ŽH¬Ãîhà@—©¼# ÎdQÏ&U$åïûñ¢šÝkÀâPz0ÄÓ³u+¿äNr[yÒ-v‡½/‡£ÌÁEZlU¤{¤bdi¿„Fvê BÇ~kØ¶4Ói®¯öø/ÍGj¢|×­ˆ0ëDÛD"¹$]›ðû­->„¤óg&#Æš3È:}ŠÝ¬G åGDh$ÂqË:#£â¨ëT#½Hð›€ }5)¦8ì¨±äAPæ´ÄX­¤gà¨xäPìÙ"Â•ãöb¤£oÌúß6óŸ­âçËžzÍáÂ²)w^(f£Ê_kdŸ¾°†Œ¬^07¨áGïDÏ[G•uI[Gò„k&»ªíïf?úèGJpÑ¥•^”Kh#h 1‚Œ€¸8d·dƒfÐÆ|Úls¡—h±2¤ÀÑE»°˜éÌ„FÜ/Á§su³‚Šážì<²_èGI¤$JÒ£zA8)&qêcÙ~) ©}36 K!ÜyÐÿå‰q¡\é(¿ç"<¢PÌ „ž¾¥¯7Á…+'¢ïoÎËÁRY‰-ZÙ¨Mb¾ÙtŽ,{öL'±NxóJ£õÃ¶H€öÛ}*r4¸”4öZŸ­Äf¾ˆ1öžªè&DX®1]£¿Bv˜ý«)Âj	¦¤°Œ?Â‚pÌ¸ÀÕïc‘b8¿Ü€Dí;ýœ?ÚùÆOxš“ôa½þ*÷¶sõ•h¥¨g[jÝÄ‹;Ó
çÚÀ)§i•ÕEíÔÅøõkSŒIù<€|ÿÎyh|æ¾¹[ý”Y¡ÀonNÎ>»CŠR~·yÄ¥ŠJtÞô&RX˜µÿñ/3ÔäW•ôóguúZ? Ýp—¬|^H °üeË2õ*ÑŒ’m]Í)Õ]%×=a».¤Ágø eeåÖm.z¾îàYg&2Pj R'òŽîeµh†ˆó$i!$ÆÔ {†U3ø®e®F?¯%äßò/”tJÓ¼„;/³öûtº@²š½UY²©4hfmvèùö-)¾š¦æ„ ºb:?ÁM	/ ò1WgÿåE§X‚KÈN‚´o‡™ã8è[¥ªr¹ë0<JW£ï q¹µøÏŒúã+à™Šr‡_û“Ë¼wZI{V'ƒ×ö'?W¼ûÿ¬|ZâT~©P}êØ{O|¬Âu*âÌêy®1øí3tÌ*^
QS‚Ú›ßöÇx}«ÒgS@¦L-LÄ›`PK&!n#Nê‚ô™}´Ÿ‘Î¾!_ºA<‘
—|L±hƒÐ<Ó£?ók5l¹ò>xY”ÇuL¤Ï¥¿¡Á«€"8¼êE7<û‹hŠæyŽ;
¨^´ÊŠ#€Ä¶háázð(ÌçmÒ*CrŒûôC[Dqqºë›¥{æ5]kIîkTµ©1f®ün‰îu7A_Ò¾J7iØz?ëË1‘ªì­äfmgÊEŠcšéø˜ï„/"eG7‘Ð<›PÎ?BÕ§H’ÌSeù´m¦&¼Þ„¨`Ú¤ÒKÌ«ùæÛÖë)ž0õp0uÔ}Œ>ˆ¸v/Œ‘í³:- úíàØÔ%‚‹s"ü›áãø¡_x^ 9§äÁêµÁËÖŽ¸:s[jÕËöi4ßiS2xµñ‡-eb4fÉ9WcÕî÷N€Ug\%Ð½#YÌq9{_\‚Y#žÝ)ç[÷r½è;U•™pUˆ™P>ŸGò„ÝføÇBÈÏ°0€ŽGÐëë2w@E	Çk†[<‚ŸOÇ¬;«b¨òxqO§¾¢Pú±ŸWlàÓ…u`íâd=:Ü§¥Íûuë®Z/=\ÿS¤Ç*Ÿ+^Vm­/[Å’¾Ù·C¯A-]¹B{ÿíWCÒ9yëjÉÃŠt‰2€ÄFðî_ÛÝy-²O¹&±³1Òp5!ò®ŽV|D¤ã¾Æº‰•A¼ÐOÅ.BVSy“xŠx¿IjGGk{“„ˆ¬QÌwW¾zO^74|iÈ„l©8rYI¯+
yäY ™ôvØÈ‚pBÚÒÂÖwÝÐt.B	\¤Q,Å…³h,ÑRÖ1¯™j0	U‰á€|#Î·’†Ê9ðp¸¦§&˜Âã°rëãrÄF?°¤OA°égki.äYÆälOv&u‹ðŽf[ª‘O¥õ	êLëû,=e,(›àíú)¤–ƒ.Ø¯/ëT»ëtÏ1}öúi€¾î·/Év¾jïš8~A	ìdJ¹;Mï·‡†b‘¨Àkà×0—4²•¼„|KÈ>%"·Žf  P4²€ö7Èº±™Œ‚ÇrÜÑ_…¿µÝÃjD@Qlº×ó–âìœ\ì!R` ;f³Ã e;!šç`f¡rÍßê“©h4$t¹<g¦;E¯%æŒ %UëÁ‚Ž“!!…mý¡/j/ñs7Õ3ºd8:H ò…Y-þÉ¦èŸ*d}&³
t×‚	•—˜SI>¾gÀö!Ùê!ígfãô•N^PX²@£vQÜNšÚö­Q@@[pÜ»ÿ…Ö`.G’å¾z€vÛsôŒaZe±õËÂÁ­&!C-ã"»ïoAß/Fwðe#Ö‘ÕÿŠ!ePQWF¨õË¼MÖš,æ’[10¢YÙâÄ§çxkz,‘×m†,Mçí+¤?ÉÊ}€ÞŠºBÝrµ‡¡§þþâ`cQ¡šPv^Î®â=ÛŸ<@ú®‘¡âL‰
[à¶=M»È9T”*zyÞêjPLNø, ˜ÐƒFc«Ãb.À¾ïñü`mr ¨6\È÷·Û2ùÿžÁ¡¦'×ý"75b ­Ž}ïIŒè½gH#SfæIÿïTÁDQpßxçÙ´›èáï=ã‘’ì,n(«p§®gÜd9së sµ‘ÌhÖüå3J^5M½¯¢˜V¯2d¶†îÒÎD&åcc-Ê•¦§o	1Víuì}:¾:`Ì=s‡áÅüyP¯»dÎûÓè1<P<lÅí½ ãÖa&^L}€Qª…èg³höEIÊUºBtaœ~¹Ó1"(„@(qPäïú® â<FçÐlT‹iSÂtà`ËëÃ–Ä›® CsJ±!Ó·…(ýZ€ü	Ò˜ÖâøäH†ñ&0DY}Ý 	²ýË“Ã±‹Ó>èÏøQFAn­{hñðo5-
yÅøž4æ$E1UàFÛ¥ëyä°¢<"ª¥ú] IµÕ¦e7öç]ÏˆP:*Ü	2:_P-Mîù<ßêt¡«îÿ
×³îò ©äÈ·A»äò~ª+ùâŠ@zFl<Ð›|avþÜ~ÔEé$ß›cžmGÙÖ(üÊô2•5S„Î¢Äà$ôùºùov+¤JÍ•ØˆÔ\Ìx:´“Ÿ›¼œ‰Ûeû:wf”.`Ã¨‚ÒŽÑÅx³ìƒÁµrdN¶8gí ÝNG53’É×­XF>¹‡¿Šo?{ÊÖjÝ²”&2rº>ÑÚÚV¤G6y„PwS2¥š¾ ÉÙHs½N	§ü [t9…ª™§GriPf ÔéXY0å|ñÈ˜Z)F<’úÉljÏhÓ »ŒàðõOŸ+ô¯èm#cNŒ`Û›èÞ>5nƒHM»k|&˜“FŸ(…ÎW!yÏïJ8:ª›‹ª9È\ %Lë?Gõwõ ¤"y{k2–eÃ&¦T¨socÓQÀZžÄ$O{Ñ?ŽGF„Iú–D÷ˆù˜½,±Ji–@úM–F‰ÉI!y˜=À™v5¾€Ia47ÛòOöRP¢rZ®{ $ÂÇ™çü:ñà#±•ª«…Ÿ¼ÿÒð>bsøÏ®<“Ë!V/„ï„“Š¥ÿB_z:ú·['/î¸á|g%…&Izö÷Ù‘qØº2HhúZ0þÊŸ)kœ‘½†d42¬®˜dÅvY…Ízvç¸Zÿá7ë¹ìª€@†á,"¶^Î…Aå[Óh—¾£)uÞñ>wÇº¢·!¿MU“dm­ Ëê¯€€ÐÊ[ÜnlÝ±kÃ(@ÀÅFXìâÙy£¾Cê@rÃË¸»õFº¤ŽIé{Bã®=²TbðÏ2€VÂèq„£Ëš¹š7d=§Mª©R‘SS«Í[-€Lþ×JÏ	N##Pà*ˆÛ¡é¨ãªCL÷Íû¸½G	I?Ö0/¹×"jwüŸ#ž<ä‹‚ñ	\ñ¢¾Õê€Zƒ˜E‡¾ºÍ·<¹}À¾3úÄðS9ó^Ð±ójvg²$à;#Tý”	>óeQL¾ãâG*´žrà0‹|è˜•d1¨œ gË»#Ü¿žòÖÍsoÑ{ÌÕ’@íÊˆ”…$¬·”2rÚ Jt
b·ý¯ªD‹\Ø œŠ”yÎ‰œ>/e?wgGbÖË“	ìœ´[zNå)¥Mêœ‰9xH°ÖñÌÑ—UŽ1_‡ef3e;fB¾œd¶4 ®ËƒŠ¡µ©IÿPöÁeœ;ûL9ÍÕÜyÈøI?¦©¯)÷šÅ¡ç¹Þ;8?-ø
ÉÎêÀÎµBi	V¹íÓ^.!/•ýQÈÃÖ[¶#Ç`¥w—Ž­AezíÒwš´ ±…š	³§ð©Ù9S¹,cïñØñ"ˆ¼5ûã/Ô(IÙEílLÅe§ÐsC‹j…KtGw0×q‘ºa‡»ÆKˆãº±V.¼:Rl¨dF™oÁE=˜&k)F9Ê ¹a¦{ë}Úhgü£§‹š"ÌÏÝ–øä.dmKœˆ?Wsöò¬…¯mëäYmáùõÈãÌK®¿˜PÑák¯Ò©ÚeŠ~³kú—-¤Eoa•}&ót<Þ›0¯òONÝý€Vš°úÅDš’#ÒoòCŠìi’»šÀúÂŠëóGßÖ?Üwç{ˆ|AÄ—7ü¦Alž€ÓiË,$8Üó°¶¬0>ÿkêóÎpRCêw¡¨*«~vû‚„à}ºƒÂIW_¬ž“6Ä&…%öÖ«yö»|„ Ä·!õÅÇAÏñˆÏŽ2.lëñJp5|T5½¡~Æç~k®ÂˆˆÃ	qû¾“±zÀÎc-266•ØËÜslW}è”ê$½êÏÌ²žŽÉåµ!+*øw'vÞØ8)¿'sj…óF!Å$zjyÓ³}hdxýÅÈyZ  A	•¾½ŒjéSt­H€Ià©Zià6FD^íVÈöÿB6}×ÊN1o··RLžÃÜÆîùHHqjÇž«šÛt<MÆ€c[ý •àøŠ†ýzøßQ›ÐZhÎÕhi¿Æ”…¼úM	Eã2˜d<÷ÔÀÏ¤;×¶:Ä]Eg¡_Ùp(²×#0Y)Ÿz9 E,û6%ªw+à!ºÞ•d/:ëÞ<¯Ç›ì—äh_eŒå=/ÐGš¡]
b«L-ÎÆMå3d[CD1(¶òFÄÓ‹ûVÍÆ_l³Ëq^HËC9],6éå·àú*k(¿š#µÐkÀ‘Á‚ÈÈbÎƒªš3"êûD0LŒúÞ•H"V9´ï¡÷sË9ÓºM°ú¡ç`¡‡Ô­|ñËKW!”ut°;
˜ù)ýÐ¿R7„-KŒš¼¬ó¥6¹à°?ý@Ò¯#‚wqÍ¸ß@ n¤4ä§sÚœUú]ˆ
¬è_T	>çE&R$ÝUtâ|„í5¢îqqŽ	†ÒnS©Òäþ±¶®=vjõñ±^£ü¬ˆÁ´ôO"¼ÛMÜüÜú³Šü¤Xç<pã»–™	Î£`eÒ,C‚ÔS€je¥&ô8_†'ú<bý$n?=îwé5á"m—yº5iÏ¦4þHOðBÈÝOf5Êh‘ñÓÖGYf-š*Kíaú÷ÓaßÄ~¡,Åú®^TûXx}ùÕØ 	Kô½H˜}•í*	¶Í3‰LÚGÄô(þßHò»3æ!:žš‚EUÌîÒYeva~Œá¡”&ÒAW¥Ìý˜³%"áÇ^˜V±~E1QŒÅ†€.Ô!ãUH»!$»àË¡å—÷tÕÁØ|VHÍS{îèù>ˆv×@’äpú×¥˜ =ßðãÒ¶˜Â»ã6/IjB­˜Ÿ0ž;>fM<j®õ9)ñ—á¦$ki…ñËF•çlKÅœÞ\5ÍkîøÅ”;á!¡ƒ…ÞXˆe½&ž&P+ÌPGâA n—æ{“É3tï“×KŒåÞ†»Ý#;þÉã5³”§Ö,¥v.Ý»É‡8lö`M®Aj×Ã%›vîè,0H¬~p¸ëà(1ÐeøÂòÖ“dP~±N5ï³Ä
8&”«—3-¸ H;õ]…èøÇ7.8Ê@'Þ)é±íiZê‘ÿÍS%Sô’ˆ=Pm¾‚:XS>LA¯Êíj]Üëêú‚Ð·†¶áøE¡ëÏ!+1s·š_Ï®Š9Õ:×ãÏÌ‹j®Ücà®…[§øs‹Ã`ÂÚ-Z:•?þ ©yiV(’¹©ÁO/‚ã†„î€½DãÍA8×¢*Ö’™’M#Ý‘†­¨/-k|šÄÌÀ÷}ö·µ<<F
y‰À6-1cÙ5ºÕâÆi–Ú@’ ¼^Åêo(îÄsÕêKœQµÌ§D:¬¢á-«‘ÎyÂ8w!rÛže¶q¡K»Køƒ­L?òÔÏã2)"+êÌI#ÊÒÅÉ©@!è=w²«nÁ¶îxIÍ†©¨ifž"e§é¡/ö ¨ýt‰Òô~Í¿`nÆ€ùCÂäé00»%]r§£—å8£uûÌgØŸ‘ãê±!R öcðsažy7€z hËt©su obœø‹üê°Ù[Ò˜lãù©Í¸Bï AÊðRçBÁ‚­W:e«ë©Ü÷¬R *7ÌªävW86Bô|QZUV´×R£FêS„ì¶×SÉÖ¾·
E«C+<Ce1Ìâ’d Î!óÑìšzïí ÌœÝJ&´ÌD/¶æq7C×Çtºµ{ÞôÈ’QÐàŠSJq %.òÓüÈ¶º¼aÃ†nèÕ¥˜¶È%c­§ÄVØ²¬8q¿`“Åg—X”À‰ÂßH*rA7¸w ÔÜhYþJË±ÅŽÊ¦µ« ˆôéO’-ð\d\ÿ ãZç–ú“zÇÎ1Ju¿u¶Ø'Á‘È9¥É?eâ|Tö ÷òªÞ½þBü«{dW#‰Õ§–bòÁ?ÿ#à:ëç œÁëÓÛR'AvÔ¾òJ°—þ?Ðæ†Ã61ŽAÛ—•$R lö|þ•¨A( ¯ANø
¹O¹F¼…ƒm+iêëpÈëM‚ñª¯ä·à›Ò‹å®w[—øû—©-vá‹kæÐCÙõöæíqa„YÉ)u~Ágö¯Å c[^…[a•ÓJIK=‡ ù…bôÁIc¦ªÁ!è¦Uùè³“ŠŒ¹š3sÇ•Úû¾¤ƒ¹ô.	†Rì<£3î
v+8ú0üaà|“”2ÌpI7SŠ˜©„rh5úaîŒ¾)ö{¯qqTc[:gcíEU®5c¸þ'ºi²ý¿X|‹ÏZ‰È…nîÃfõ%M¥OÓt
‚kt³K—Ò¤^ngçÿIv"ÚJh°·ïÝš¿PZz¾ìB’žiR/sqU‘+*æªðàÆ/ptøy–†–é¾½A…­n\f™ˆþ^×¿Ù,{_¥¥Ê§Y—@Bozl7ÝÑ­‰ž½w*–àoôI Ò‚oçcÝíœà†/Â`pÏâÞÕNÓ\@i'“ý•GC¹\ê-VéüÑÕ“¼™$åv'Ó3èˆš€kÜ=Qß|‘=–pÄõÉMÊŒ’Ö>5úí«Ö4¸ünv6˜zÑÓjïåäò ÛØûx^ÿ/
ÆÌu»>'·Õ|Ø2‚mùVn5»‘yÝˆy.ès¬E77YÖˆÿ§äÐ“’(ØM®;%´Çâ)ù^d–«.è\ìnq,´lÁÞCƒzn©{Q\ØhLO+ÌÍ°¾'D4áSáUÈ‚´ŠŠW’8 ý&G;Žê‡á)LÐ:*Oì‚Ï<NŽÉá:iƒV¹«r¢X¥¿J?k/îzƒJ'Xý¦ïR>±Ë®E†sŒ™ÎƒpZ.Ê®PsauAþÛsq}ž…í†Ž‰5Eé}}\4ÂªwY¿¥§~çTá‰ QC
‰Û’j™rOo{ÖÙ%‘x± Qú*)¿¶NçÑî'­Rb>tÍtÒàNv–FÚU_8_›Öß>“õú['œ¾}ÍŒÈšRL]jÃW–1Ñ
Ümß­	´ ëžÕJà{üñŠÒ…1x}¬÷‰büZÎ±c=•6»uò©´‚ç#@@"šF5å÷˜°’9jK¬á ùÛx¤¢£JÛ•b2ë.U‘Ýlïsé< µátæk^"+ÇÈ¹\³øW¥¤q«7*éLî€øTŒN˜ÃBãQ…á²ºÆ……á'‘¦h7Áh­±äÈ v‹˜hÈÉß/–“kÌÊ§èÂAv½Ø„	€âo6±:¢3YËâ(mp­¼nÄö~²rJìç«íAûü¡€nSM·\kœîÓ-f‹¬V¨÷Ï-ff0O.ÿšçá¡ó¨Ä°Oì2Uw½vÂhjÛõoï–q¶¼¿ñ=F;þbï¯:‡äpj©Z£=v Ñ¨0b§£üÉ2.~«ß!á¸ëbÓiE'$‰ÿrÏ­	€h’E3m¨hñž¹-¾Œ~‰0³ù6|ß­7‘ÐïG _u²•ÅMToa/oÃj„Ù—•¨œÛJ™÷çgùh˜û ±)Î„HúÒÃê?µÐYtÈë¡:Á>Ñ¼A'k¢×’úÓ:Ø¥×Œ]ü¾d%ò'’JÖâº^ÚuësÏ¤Ÿ¬«˜lü¯­üÖ&Á€®ÅÚ
ZT
´g½”‰}á²Á£ªfqºõ:É HÊIÁÞvÆ±rKü´ì»´`™”Ûûv²‡Ç£g4=%Q3 ÇÚE»X&0w°ôú«8Ö§	ÐFLÖ`íHÿ~¡•(2Ø+SÓ[×UKï5Ë{AB»Gx¡sQ‚ëSíf’ýHª¤*¡§°sþývÁnûZˆ¶tÂœ+òxÆ2ùïm=W@Èšd¿zÚD&×Ps»º½Më˜;)žeÄL˜G	·FfL½Z7"UË“Ã±>;RUk)åå ‡Œ|4gÁ¸ ©MÆÄ³CCš%rîã”IÐiJè.4xÿñŽ˜—¥9.‹üÿ¤’ìûsn|PF×§PÑ4õ†Ý*ð^”ªÝ› ‘[?ðMíišÊæ®k¿´p“oÞ¥·üu“èj%Wö>.n×_Q)	ŠÙ)AÖÍôzìåC'qq[QYÜ­]Ú‚@÷2t%™]Í…_!4<hŽB#Â"‡Å©ø¸X‘b>¬ö:Ô™ák/÷¾{‘)biRZËÔŒéb§¿v·ÔeÈ¹»+·Qê1E«3î÷¥Ð¹~N~äc/[D€[wäŠÿ;fJ=Œ2À¹ö"SÍMÔP}¥çÄÒÖp,²ê­®ÖDù¼	~%Eòþ´iåÅRÖÜµ†šdQá!û‡"Wù\f*‚’	¡¯»ýEG±9}¥Œl|Bïè2íS²¸4ÝÍ~¼{šŽlü…uÞH¼cL5ûìŽýW{ˆÊÄ=,#e±N™z…Ê?æ¾¦`DÀ}7Rì}ûÐµû˜yk\Në<Q10p&¶$àŒŸý>†·¾aÂÌ¤6¬k™Ö|4›¦až5¹ÊÑîf5ùÁlû7vÁâ7xf&BûÜÈÂ»‘„úòwÐ9èˆdŒ07Þ V€åêjz‚Ï]›¤(ÊÝW×°RÏ51U(Pr2žz ¤ŽÞIC¸Ù¸öz.åV¡'ã‹…òmûÆ7‹|~Œ~>B’µŠˆæ´à|«©6%å=¾âËí¯
-È¡^b@C’º	`eh=7-zËŠß–:›ÖE2:_€T;¼º+’™6[#>óŠ¾‘ ‡hßµ»Øniy¿‹£sÖ1s‹JéL²Æ&2÷‡ Ú=y§âþ÷	°HÙzî‹Z§l©óç¯ØcÏr;x­·h˜5­[ÚÒ‰@œ0C/µ9„ûZ‘¯Æ¦¸4ÙiØ
Æ5´ˆ… 2œxlí>‚Ñ”™ÃvjƒniÉ˜‹WÔÏf+"H´ÝÇÇG=™‘­ü›ô.½%xFS ‚Dd¦£&Ùið˜¶kJN°/òSFŽ¥’[Ê™ì€ÌWäS™-Í;²L‰uðó—ª5¶EÂ*=Œ0÷Ú´œ·Ç¹`æÝk¾äˆœËÈ•Ë©)¶OqÉj.rÓpèzÜ38?j
€ñå"œ¸	ÜdeÃ“eŸÐ¸Ý‡Dó½;Š°»ÆY“o"@ç©ŸŒ•ß¿ïõ3o{ÞI</ÝÜ?ÐW	2ø«ý·Å2N)I•îÑ®Qáw …a?OEË³Ê_üîWÐ‚­BUÃÈiu2z^0äL3±™|pÛ8ïŠS‡CO4±Ø¶œVZ³´1ÌøTjªôM”Ëåo‹6*t«EnŠžVBÞÆ”àøç~³ög®ð¦••:iô«V™H¤†¬¿»umÊzZMÙ,E”¶tšf)¤ §6«þ_%ßpd0)·ª¬×ÒsŠTþ£8Ù?Æ3U4c …B!‹Ž‚Sh±­UUÒ¨9®ƒI uþ!¢¨È5}^`œO¢^¸5k@”Áv+†¬IKÝÁ‚‰—_öM±~Äêl<¬–ÍÑ‘üˆð†ëCL!ÚWY“¡û~•®^¾c‚”M¶,@Óç™+›=i
¿ˆoØÖAv¬‹“Ñ	×õÞÓBOÇžÂ9!}(è¨vWáëÄ8p$ç…¨®#lî£Éòx­C+§”ä'^·ìà&ÒdÑœ2ùÕÕƒuû¤ô\úÆÙÙÁÝØœœ(á“©/»ÇJ¬5Õç…vÏúqn2qj{€B_lKOLÔéBO†Z2Ç}ÿDN¡Lµpô?¹g¦Tþ³X­­ôÀJÑÇ_ÈþQ”pžåì‰kûÛù@yÂ[žÁM_Ú²ÅïÙ"XêÂ‹Ý§
â Ùu{É	M@†lyfŸ¼ãé–.È,[ú+Mõ[î{z¢C~ýxhÐº/.ä¢YØO(‹ú‚
›9$Ž T¿îº˜õOú5K(]6aŠ
¼TåãìŒS,šé­¼…²›–{Quyöuùû…:Ûˆ&ŸÌxÀ%ùzÍóÐJeh¡ËïÀ@#¹SúÙ„{&ð$± õÝ‹àÀ=Šý‘óž9F:™”!Jä¦´sŸ[ƒt3´F„ÀA0áÛ>FÄ~¹æ¶ÓÙlÚS8TrÍ¿@™hH‰“µZéyo€…(Æ{^‚vË÷@”­[·gæ´¾w·é©ù<8ˆqZòX•®lÉp\}[Ùc§‚ªª’Æz!]Í‹ ‹õ5ÏN õÎÉ62Â‚’}¥ì·!½b«¤!Ó\îA	‡i‰%œ¼Åc8³zé<‹ÌíÉ>êN„^jºÿ3£Ç@w’|lþÆZpbßPšÃÉZŒP›_Z6 jý‘Mc÷Yw‡mÀTÍ¢v¡+Ù’³Éô"jØ&#»yŒŸð1“áÊ=4qtÝAÛ*rpÁš‡ã›ÞšMÐ¯á8ß5gß-Ûm¥Y­ý;»Œ­Y%(Ì«¦û¤©ÓJÅ“Ò«O…¶ÆÒ´³HCs3Å'zCŸ×üeíâ›.šS°L‰9€R1G 4ÉüNNaW“®Ú%ò½ÈX%Âörlû~C Š™A×5’§ee‰iñ!9ß­ Ä«vÜèu+“;ßòq4
-,LgúTmlòÐMë«½ÂÚÙ&§=À¹Óû‰íL|=ƒ[~•¶ˆõ¸ÛÇ6áÚT~…°ƒÍxª,{i“å*GÌ/7rç­Þ¢U§Ñ‰=÷m¶läì‹ÓSÁ›Á¨LKì_¸9 ÑÇšÆLºíTÎ4„ýký¸èÚ•]ö÷grb41‚ÙšPÜê¤Ì5$›‹¨×¢]dËRUƒºàQ˜ðIÑ·Àú§îþÞï…Š#¬C¹$Ä¼§1V°Þ U'ÿÊ3‹ÌO¤Œ	²>ùéQ›£êAœß ôôE‡Ï
Î˜ÂI<ì}Ç9o%B§!UÛ›-ŠÌýË&Uq‹ÍL‚ $mûÂgÊyòÝàôú 4º®Ì1~Xéñ¬dì>™´Vµ†EŸf²;d9jX"G‚”m>9æ-ßÄ¿i‚üZIÐƒ¤Ñ,,aêsdrg1P *SÂsÓäð˜¤C
]œb)ÀeÝx+è¬sùRl0jÂ^u®&pV]øå]_
¥@@mjÂþ{¬âBfIíßï‹'U?ú4=|¨1ÓãŸ~YÑ…Tò¾p—"õ£1
!Y…Ðì~‘­GƒÎ¿)ÃVr‹=ýu%@6™#1ïmãèÇ5½ˆö¸Y–†%H†¾!4ý·Ý}èwª0eþRzÔ\IÛ^óÄ etªMÎ³2D"cìÇLUV3ƒ<ËÏñ4¬(¦Z™áÑ	Ó‰\Wí€Š›…`•‹6267ÝyØÑp«¦tCÚ«(¯sÜ*ÄÜçÇ§1öÛtã$TrüþTmr?à¯Nz	70”š‚Ú{ ÐžP^žŠÐíTlÓ%]ÈØ¤iÄÌðþVtkýh–TÛ8Ub«E
H&hÈ$øíN­6P'tpwÝ—²®bx>±E¼+¼Oõ¨uhÕ×iðŸ/Û›³[™ÿ›ùöYí-;Ub,%Õj…-xŒœ—Q*Œì`N«Ñ‘y˜™ˆ¥ì{*8Ñ4å¦À_†SÍÙŒà-4Qbñ–7­õ])+®,îfÞ›hâªš¦öç¶f`{3±çÒ'!j'Ø–G”è­Ý©ö¯Ž	´£>µ–0ÄLp…™NÎŽë9:ŒNEÑ!"RØk7i{•?uµ¨‚*<Y…ëòÏ\7®Õ˜§„‹Yw;œç 3Y-æ’¤tN	Ë­ŸMY¶Š;‡Ð1«­™;	J8.‰Œ®m1mÚT™e¬òÑeëÇÜ²ìY±Ðƒ·z†¦«ït°‹ÂvÆ×©h¹êhòok£àé­â¼!zavDzAB¥ú].Kº¼E…¶M_ÆŠÌB\órOš,KsMIïlK-áÄ’x«ÎÊÊúgcK-ÿ\9
ÙòÑÓ½Ÿ1TÓ:¡luà×>ƒwà¾ÜìÙÍZM¯ÄÇÈMn¦wŽê†a;×0	cwWŠ•@"Úáè5ëŒï©»8} {'st"´¨1-0žóýú®”ÕK,)š®)I®å“ØOø÷1’ßÎwoA\9¾²·ìX²·Ÿ6t`Üs†Æb§¹©\®7Ä„7Ýëò[8'FÔÄz'¬¤•V]
–YêÑÖÑ¯.pçjÛËÄæä†¯®µÆÔ–ï×þ+•Ã¤@-÷=åþJm5îÝ©ñs`p¶“iÅ©˜È’îe§,tKÖ¾éŸKÄ$WâùÜHªž²_ºt… ÊÅ!u°¿õÙB$iYfY˜–Ç`ý ÐšÔ­Ú6Ì×î%‡¤.¨¡Ñ6™|åšq Y[¦r3e­ÂÕYOô?!ŠÙ‚TÇrëú~$It„ìFoôùrÊÊ%µÛk‡~ª2|P Éh¥ ÅËÈ‹4?Bä6‘D4×,zûNñ±§ €ò¤üeéÏc¹ÙRö`»î¡q#KÆñ£ÛKE„¼õô,Hž¾M¼­zÁ¥qî56«&Ó^|6£CWÎ-‡úÛ©©Æ¯X Zôƒ0þR×šÁy…žÔÆ(îœØØqP-Æ¸œûîõæY#V×VÄ³&—Ü-0Ø*þUOA/Ÿôÿ•÷=	MWî©™™Fö9EÀR¡Öñ5}=ú løZÏ+)Ü°ÏCË%ÉÓKa1äˆR>'\ÁgÅK8ˆ÷'j¸lMüÛMõÝšùô•Wçªï¡S)mKÝØH-âr*RP—iÚ¯{uø:,Ÿ3ù›îRÖá˜ß:M|»Ò¥D#ªÿ9+Hc;š«`5ž ÏòU*ãµGÚËoÆ—8twx}ÊÆ›¼ë©ÛE|="Ñ€ÐŒìgofÑÂ:	ŠHÏËXPL8ëÃ[•š.­"±p9(1ŸtË¤ÓÝØ©I&J/«’TfÏ—Ý¸.o{ÂÅâDœäÐÀ¦˜».XN?v
Ôæ;Í­ƒ1#P!ƒ³³÷™Á¯ÆÆÕa~ ÆVû;ø']E€½MWG#Ù¿‚´öÂ‘€«ƒÐkLmý¢g3¼Î©…A:ðÉì…«OøMÔ!|ÿWÍo¦1óiæ=úòO“Ùüã5fK›iÒ5×ä+U™Z]þøQ	ù¸/¨j­“Ús³îËFP$’ËöÃÑÏ{'ttF¹É)”Jp`²i/ÛW4äÝÅŒ¶õ9 ã3`–Ý£Xu
PÚBnã€ÿZ|”‚âs+Éæ~óÚÂŽº
3~ŸÄåCN°c­ ZêôA‹º–8žî4*¶«îQ„–W‡ëX,°*lCö)—_qhxè;÷Mž–äFý ¥94Å3e‚Ö²XÿHï.mg
½ÇkâS0µÞÓÆ“‡ píE
…×8OÒ7@0#A£^ËeûL8žyjªÆ3‹ÙrHfâ
AsZ6Ÿõ]Q¡Œów÷^€	àÛSü®A 2Ñ/—”]z¹çÄ†Áz^Ž9 dc+—×˜&4	ª°×†Ë	 ¾ÉšŒl5-¬nÏ´8çW¿ACDÖÛWð‡‘õ
É|wz	Î¶rÏ!*Þc»ç‹Š×•»óãäùA%û ´¯ H†	&R9¹¶õûBËØ"ã;¯1?ÁqE8¥H…yjœÃGé¹#÷Œß‰ûÌ6ÛÐƒ UDÓYR€(ž•¥^Æé2·0GFÞ†ÌØ—±ßÈ)ëÇ³½SßEíçMfÊî[øAIy·¬Çð#3ì¯Ð3~‡÷[¯‚psFýY3 &`ÐäÚöIOñ¾ 7ï-ªgØ%ôÕKQ_	5Ò_šx3Ö5CF`,4n‡ãé‘Ð™Ç2 !V¢˜® ‡ÈåMqåô-²vƒOŽ†¤€Ôœ<67ÆÍåîeDú”% ù‰ØúµÆ¬1M*~Ý)a¿äubåM|õdƒL|ÛAè!–Âþ³Ó)À6úÈœ;^$KÂ”?V}P£ê4éêSýÛV„Ü tàrgRÜ&Üë»6@ÚØÖÝ™{wÉªlÒ+:òÙ‹Öl§q¿öµsWs/ëž5Æ‰‡Š¼ùª$ìwë=.V½Æ¤<8óüVÓ¬¢›0Ñ ñ^ÐÏÊì@CÄÄÊ7ÓAãqãÓYÒšÐL\2¨ßSí¹ø>t,âD?Êž6µŸâ_÷qÃ×­»ñ" hÛÅŒ”à¸.PULM;´þ©E¢ü­‘0o),+0m±¼S$÷$ýg”òØ®»ßîDð ‰Œ€H)„ØwòV˜Ø%P“É›§“Â³	™¦"nœnÊi µåoÅ<øIÅ¿oÊ‡Õ“Ú‡Ü¦“EŠ2Î'77½ñ@Ê"WÞóáZÍÚe>Üß³H5.\¶;s•FtæžÊD3&×âzL˜RÈµ–;3o[ü×Äì°<U.+I×‹iõ ?ŠEN”¿Æ˜L~{vµÀRÅÈ‹½y>¿¸'Ü¤s´Wý`°½÷þ•»¡Å]ÄÏâFe-¾¨¾wÏæ…wT‚‘ûè DÍy›f91F‡GqyH€½µ;¯Zš€ ·&uÊË—TŽÙ6óÃèÌÒ£À½y—vHoÆSøR3§Döî8ªóÐ70i¼‘I_»“M)j•\á‚Œv@„ã&ÌånÊ•?2+_fÁm wbÀüŒ½ª{T¿]¨«Þòw ‚ŽU´tÆ
‡€Û{Yq®˜Ï¥	z20ž–5ŸìužÉÒD/÷>Påƒ·ëÙ4÷†´0WoÓîøT%Ml±ê^tXÕ¨¹¥ˆú?¦—åüƒZ7MKxk`T-¤tI|GÖb†¥†èôþ…¥ÉS2);±_=ú® ä°t:¬_s)A£½PàC?âÞŠÒáßñ³¯¸3Tž,-í„ù2ªB*óÑvázª8ƒ@wÈ#@_avÏ©ÃŸ»êÎÝSËOvÛ³…U>ÀÍÉƒÝ}ºÁW f’JÒÞùLYj2Ò…èÖŒ@ÍòRùKôz’¶(bŠè½Œž©Øä¢Ð9+­FD—·±ÓT>¦á)fHŒÛˆ?l›ÆØð<`‚IHá‡0¥±Î³þâÀ4•EgL|jµê”˜Á€ì<Øóv
å3ó†a1swîžÊ¥Ë¹¥r‡Å8ÞeláxCº#pYã½ùjÍSñ~–Ž¨KóyGKš	.láÃèÄ)NhÖc^!‚~Z€%…ðª0u›õÞe’:ïú•ýþ.Ž¼Y`”ØZq+—âšöùÁìKˆjHq€Áá,ÍZù+¡Ia*š¸MÂ¥ J§û‡Ò»~.—iàùÜòÄriœGó[¸vU/˜¤öí<{x_¢v5¬pÙÁ©}×‡éšS³í…8ÚÙx‹sät¶NAé¬°ƒwv˜4ÞE[<g â&å³:Ã°8Ç$²§aà–­b…©ò(RéðˆMö”Ÿ¸æ½¶uÜ(EÊ ˜ïû’îU	‘Ïõ$üfŠ’íþ|Ìé,Ï[cÖ_;, N{ì¡Œ»Êp7-¼#Îëžá •–çùwË¨~‰Ú_ëö–£C½½Âô¥‡P•×$Liø.N´6‰§lµWŽ¢—RÚ  øK³óEåý¬âÏN^HØÁÏj/"<µ8”z<IÝîõãVÆ´*uZyÑšj/æÎAéõ–"_µòÅñØ¿ÆGóøË€ªcV0çûÐä¦°Ä¯1[“¯ÖûòpÀ_ç ÿký‡YéÍv“òØZ˜5U€2_èððyaÝDõ3¹#ËÔB29B#ï}
áº-À«©| ¾¸@0ìz6é,]é»Äv—¨^Ñ0}	™~‚®õù™+Ž8€{{¨mI˜ë©×­u€'µ­rÌÃé|³ØÈø”‘éBÃC†¸ýEÖ(šî‘ ¾•ÆhÖƒÊö*‰(÷–³×']Ë…"Z_Þ–ÜJÚ&G¦sósÆÊê9ÏÁ0 ï_#ÝòÛš HÔtðP¹¥¬ÓÿÂŽ‡û´å`,)BÑ\°új3}f5»²”|¬¦Û=Bý4Ö^TÜð¾¡·ÌãnŸP»Ãé¿,ma±?0aáQWò3éÁûñîÈô=«“Ghsªíä,ž‰ë11¡¡Rà`‡!‡¹c³™4@ömÌ«µ«ÔœK{‡=Z>²QÏ½i*Ä_®á7÷7‹b³E¤Ý÷å€?¦oñ áñÎ™…v¯
n¯îÃ}eƒŠ6[àœÔ j›»…qÈ ‚¡Ÿ%ì3S0 œ±È‹•7 ÃÝnpÃ‚ªÝ`•ÞŸžkäuxÄOÌº±ZXjÂ™ÿvQ´š6%ì­íþ¦ LÌût“O?—Àz,:%\Ú`x÷×«¬Œ†eßþ½0cxRúUVÂ)]¡Žýé,¦ã¾w	ò{«“À© 5õPßTSÛÇ“s¹Ÿá#("ÀPž£)ùÒr³iöÈû¦3€$!/X·œ©?š(î‡Ñjýî¨ÆPCW]³}@‹1£}ž²±=°ŠP]ƒ9ñ‰;öyïM6»ëÒÓrEÕ{Mì;n6YPÓÊÖÇË ¬`¨à›Èê¢lÓæiO[ÏR¼^Š(@L,‰üe™¯¬Á—tûjw&Ò-Â¤Q#Üaåxu”­}èÖà' œ¹SYuÍÕi(ðÔÏ‘vÐ_xè™Ìaá¬êb	´3T¥ìùèE3T„g~hÍÎz)ô—‘gÆPýDˆ¼ÓEs¨FAÞx>‘â@U¿mæ#t$_þÃ‰¸-–Q	-ë-ôÞž«¼Îþ-¨-×#Ô&V%2D?/±¥b·aø²]49¢ãÆ]³;WŽ%·ÄÃQ¤Êlõÿ¸0©ƒ…Ep¯J’†µ2Ìt³”ZÊP°"1‹Oó½
ÉûsW´ßIœ<Ê½nLþ¿Š¹ve0x´ŒÍµa9‡Ÿµ«ôæJîêÿ}(F£Wì—’A”›4ÞÁ·@†µýg€æ‹¬…—ƒÖ¹;0
Ä2>}^)ÀÍ÷½ž6U9©'®XÉ4Vv>ÃÍã?êÙ¹!çÃôCœÀfJR…,NÏ’CÅÿBgtÕ¤ò8z¾Õu
Îk(zíÕË¸PzÄÖSA
nMì åz}bšGE#k<M¨rŸöõ aÞÞõ’c}¶‚ñ;itï.ï0§°S0õŒA2›Q7jÞÃ•z×Æ„éÈÅ}¥ å‰Ð#³ïq±˜”õ/ù¡[ÂŒSLQÆ‚P‰q6 ¢±î÷xH^LxH·æHÊ¤Sb$b>¶,GüI~Ý¦áäB€DÛFÐB,[yÿãi“Ñë•&õáxÖ5WLî ¬ªˆ™Cèˆ½ßH¨T%7Ë’qtÙ•J!ßãÝ2ùÚ†]fk.$y©ÇÂúÕóÊÌ¾üG²ùìÂmK÷íèi º½orM1(é•BZv""ì^É¶ó~¬ýÁ	õžJr™Ç$iŠ%·D¯“'¿ÀÃJ?”a7/}kÆb×á*ÿû®_þý4}WË‰˜³CÂ]
<êP£ëÈ¬’#¢7o7´díƒÆíß=¢‘Þ lráxÎ8 8^þ<óÙ;r¶weÐeÅOqi×scÍÄGÒãˆ*Š‚×¾tƒîÕóïG´Òäd¹Ö¡Fmxjœ´‘”³Èáµ³Ú=“Á‚éIkçÛñðPÁVÜù·çÛÃHšý•>ÕU&†Ç­(Ôœ0!XcjöÙuÚ_¡/~…ú­Qî(¶V„›"ümM#€©R+vîÖ¥”ÝoŒ_¼v&Tq<_JtTæ`aÈáýÕ3Q¢ðQ²o+BBìVqaÔ°¿u-§&Î[}«ð6~zÙì‘­y«¨@×e³¾¼¦ä|Sy:'v6£¾fIÝÐè[væ»“Óåj€_aY$iLÈìyB~I31ÒZÉj+¡_ÛÓDDÙºí¸f§4¥¤­míÛém[ÿPÏg”p†:4~¿ñ,$ãµÍ+x®"‚AÁ¨Ùs/cGV0°ÂF¥=Í‘u]©ë–»ZÅ•ôfÎ;ÚÌ'í\ûÁ­«†Hâo†Éé
â7pÚƒq#îŽDˆÑbkÝ9ÎùÇ^ÌsÜ0ûà ò‘ÂÔ"›Åg¹n«¹Ð›þÂú_4ðn¶Ÿ¬	$qâ¨lý€š:‡c½×ÆñŸZ¬MŸôm3ç\PIIüœðJEŠSMwl‘æäºNúÝ†ê§€š.Iˆ5‹†‰ Õu“=—‰=Nç@Û| .àFÆ[ô¹kÏqå=s^¶:Y=UÐ«^õgPžq	Mçgpn’@6pqU±&Ã}rÝNHÞÉjè†Mùvœ,3“•R¹jeëµª¯kuå‰é†[“ì™H7eÍùB«Ä
·/ó <÷
Ã%	b^ŸUrõ?ï3éÛ}ÊGö çÔ€ï3$`æ*OK®2Ô;®ûÖL¨DˆÑE£Qâ(ñ¯€GM¬B n	È 5:€¶•€ìgD?©±Ã½3öœWœþB§Èñ[ÓMá§|¬öHX³DoÃD(cLnÂè¶+î4óÃ_  Ÿ&Qd­±r~Ÿã#Š'gcäNÑ9ŸKôAƒyÄÑ ìÎÊÈ§´N|jSe ‰TÑ©—&Ãü—êæ¨	yæý @¼Ð ò…Æï¦–ŸüµÕ_Kð·¹Òò ¶•CŠÛ}Éqó‡`6¢3InÖa÷Ðá¼ÏQôŸf?<9‘S·0€&-‚ük[ÓS~ð¼òWB˜·…ÎNMŸýG‡;wË~èèxð"Æ½1—+€žæ†r=­ª*
5y0'"‹qÍ1xÄ¼A|-ÅÕÚ98ci^÷½ ù”ºH¦rÐÍåI»ÿL@˜o+¤ƒ­‡”53SL‡Â•Ç¯hæHâ!¬iX;Þn)
'®îl\o¨öI«drHá§•¡?PN%Û$fXëtmâEpÂ'Í¶§_B"’³ëÜ?evÜóD£),2Xp!ô>3N€ÀÊ;ÑEïºy„>Vñ+'n<ƒ+íî^0­³»Á–{Qq³ÂïP/$ÏÏØ-e úŽÍ¡È¹þàW§{›6ýÐXZéžyâËGÊÎ¨ÓÃ¨¬ÌJ5pË8Âín»B¢ÝgbB¦U™4íDuŒ˜L9pž§#_ì(Ë…Ñ•˜Š~*‘ò'u÷À˜M˜ýØ¯ÕÄ%Søõ‘61¥°îoÁpMGÑ‘ª­`ºÎ±'\Y†é] †;	î9¿=%~ËÒ,ýf@²J²«‹Q“Ã«2^1óÅ¹Qj9…¡Ý^ÖIA6ÙØ“švç*ldJÑH…j vs`ÃÌCHè®¯Å›HXÁœv›U'kÔßPlçÙ4O³¸€,þ¾§f£Á‡#P	"Ø%Ýpq~B ó`7(¦~XÇŸ›IÚÝf|tòZ2j’¯©|°bËÝ¥òÅ#=š¸ÕÌ[vÀKl”¾õ%zKB«·É™^ºõ}ÙŠšÑ¥NRÕ7¯Bº05ôÞÞqWóØÀ¦¸l¥xí¡ÍG¾™ýd?øþd„#ÔKCñà¶ñC@§¾&k©=e›R¥ÝŒ»tÛýW«Â‡&§?ä;[¾MfpGúq(º<ªš©®ØÉ¾îöìCï¥Àº5ó®29poû;j”Ø‘Úi;Ž$.ñ‡àlõÙðM-”XÀúÝñaE}Â]ÛÅøMÚúOAXVµ~Ò¶Hxw­C•¼JŽTf;tYy¨HÍ¹ô1û‹Ý‚èÞ¶÷ºNëQ÷wä}.$ò–ùgµô7[Ñ<÷û[D`æ BPcÈtJæi`Ê¹ðºJ¾QãYäN"Ü¿bÅVºÕíœŒ•Â•žmá|?«ÛlW¦bx…ùîõo ®RÆsÁV#4:Ónæ¼/aÏÇÎú¾¥Ô4Ä:ø~è¾Cy„dˆTýú5‹{’¸VÌrÕ&55p® -ˆ— Jyb¥v"xylJ™?Z›[èš šopiwm6,5¸\ú/1(7ÿÉ¨4Ï" ùÖÒ9êoëÔ @Œ‰ÓÛ¢+ôøîŒ?†ý¼YÏst§²s}K ¼‹R‘%4² „XÎ  \ô¸Ìý	ðP(ô9<Pðœ¼Âñ¿·7(­gŸ¹^Û±ðºÝbÆÚ>·»ŠÕc,I·b|>Ö@&ÅÊÒ‰„«Çè:¾ÌÇ9Œyi
ºøþ‚U®84K÷0-½jÖþ™”àê#NZn  ÷cÕ›Šû8…kú‹,Ÿ•Uv`Ý´#ÄGš¨ÓUƒl¨ŸH4ñ5ÎÑýÏÆÈ^š}™\ ”†=ix	Ž;·¨S…t¿…£½³Ú3ã¸ŸjÛ_õÇkv¬—‡²B…vlÍ«.)×AS§a€&<WÅAzú`4Õó’>AMâìuÚÊ´Lè	Ö+šñÇÛ‰Óì^Y±Ã$ØœŒÉ;Ã¬ÝÊ¦ZUU1¼èÍ0D&HRvFJ;ûöFÍnó—Åã™þ”ŒFq¦ K'Þÿ±¢†&ü>Q™VöëâB#Oü AP«Óþå´¶–ˆ5½Ëî|b·>4;!ÍˆØTáö{rüÔ'¼„›Häf Kqw²¶ZÊxÓ;„v&ÿ«’Å="ö ÍŠ3î— 1»'Srzro=œñ ­'Ø?,d[ÿ*Èª‡i)˜pyG®ß‘ì—£I­m…­>_n›>Cmàÿ–ù¼O
¶«6êïì;WrYT¨ód—õR^:§°žùId‚FÈbÇJP$»‹©NiÙiæÉtsè°
âE’ãÖÖé´ÕÑŒyˆáNqL‡•ˆÇÃmfÜÒ¾3‘ûÄcFfæoÙö”õÕÄôøALz¨fKéPS”ó 6ºÛÕOèüƒÒÎ«»Åj@¶YÊw?Þ¹TŒ}Ý,9P«ö‚:q:Ô%Ýg»	‚òç‘oxp¡Yh“˜¬`ÚÇ@ˆÜ"°ºð|pƒSœ<«UCÀEìÓÝcƒaãe<p*þÍ¤âàjCò…þó÷c<£ù¼ûµ*„h’2¡Ö¿œ5i0SLØSc^¬Ôk¢@°æÇù¢+¾-åŸ¥–R.JiÁ¡’"ª†*'c·¼(Jhôûkž ò¨fä&€œI:0hÝ@<@9S#-Ÿ_ÉPwsèÃ°
yË«•¤WæQ–GÅb ÈŸ/0g-9 CÔr=„.‚»Òe 2ˆQ»Ñšò7VH¤(–5‘–;„èÕ]¦v0£¢ ]Pª`bŠÒÛBŒÓuïŸ:£ãº·ÐÈ²µ—õ¡ên,3ƒâ—½è~Å)Èˆ{*MA&Á|žÿº{	-Ti\Åf
þ¶&‰«€ñ‡MK–ç%ù@ËÓB¨­>|ê·Ï/LÄóD\¨J<ÅK›×Ÿ%4&SšöŸXsØ9Æ2ÛbòGÏI"í µùY±¯±ZMµl÷¨Ýá=òú;H«ûŽÙB¥ëP™ÀQGêÐ}«Ð?´Tø…®É«L°
7¨76Ð¸ŸÖ/Sçƒ<ýŠ Ø¾F·ñ3S«TÿRùŠ`ãh•PV.µjpFÈÍVÖ‹Ì]	ÇX†~¬ø˜’wàø5IUEWÐuºÀÏ%1—¬áóm% ÜK‚3¶ºã‹â1B2 ü™ª¯9ÛÂJR—A€¶Ø1ð–cèâ1íè·fÕhâ„½U*l8ÅJ$òÇJãMµuŒáœåñ}|÷‰Ý?hUÓnDúU(™1¯óšÂBÉ·(>%wc–,p*vHT‘t0V¾À[g¬–ú#¾Ã°©}íÙw’Œ¾6#ÝÙ˜ˆ–ý‰ä!e3êªÕK@È~[:™Sï¹Õ·„¦È]£,ãJ%Bµ§*áO´'€u‡¿¡æ(O^sVOÁ_=ÔÔ]ÒÙ:•¸ÀwyEt”•Äá0 ”‹%ý7&‚ÛDÊ7Ä‹•&"õ:À"ÐÉ‹°ûÚÿÛYÄ™~‡¬	t#‘ífb„TE;¸_®ÁG§¬x8‚g5ŠŠnm-û›xw™ÔõTŽÖ
T'¿n;cµ|5‚ÆT&Ì#]~bP¥ôùô.Ãe-	$p8ênØ6<‹AO<BêX`¢üvJSl/ù°l\_	Èšß5å®üóz„»Èû«isp'h§Ûœ¯H—w¼døì¢df}Á¡© 6+ð–÷±¥O¼vS²®ÝÔÑ†…m\$Çœwá:Å"–ÃÓŒP²‘·^×Õ•ÓTÅ{Y®+ñ?ì,iE–SKúö:N—9	¼¥n¬Kœ7Ao0‘!kzàZøøþq°µ³¶,±v 2†z–f‚éêÿÉÛy€´ƒsd:º‘Ûâêùeï
¯â}`ÝEÄ.?®£»Vñ~Ì_H€fâ$ÀUæÂ_ÔµZböMð/Õ{{«ŸpYaìø]|]†v­Œp4ÇxtÁ`F¾Ìß`¨q¯30ãŸXÎ—£(zœ™I£+D¼ö*ápS4·\0ÿ¶Pß›í÷œ5´ùú‘ ;-¬(Ñ>s:i>º‚Ç¬¢ÞrüÁÜ×£#5Sµ6ôòÀw„¤RÏ{e‚Ú6gÊøð„MÓ	8ÙN\.–ßhqBö!„ŒÕNÈ¹#½†NåÝyswÄn'õ”ª^YÖæ6 õ?æØÌ-–8®ëý4$–+¯R¸¹­@4K[0ª}y@¿™Hã–Ôç ®?7.EiŽŠBù@“æè’¶Þß7U½¨¯$kÉvÉ¿-Rœ±î–ˆ¿0[žE¿áŒƒQœÀ²äÞmlV~B]†Ÿ Ìæw5‰¨žâƒÂ†Ø\9i'™aºŸxX†¢Ï8¶®ÚOË€7Ö]'(W¯š¥VŒ±v_»-žž·Bð;ˆñ¹DU"Á|¿]3´Ñ×‘oáüÚ—ÖW«áÌu>¦ÝÉfWý¥r“gr¤v@ˆ*ÝUxáqçéZZI3þœ S¼Œ4[Œa‡jÔ+3†)ËMc
Ûèr•œz\V2“`v¯ÿZ»že+,Ãl½'æ&ì±%ã}É`¡šÆàÿÖZŒ¬‹
×û2a+CWkÆõ.PˆÈ£´CëpÐq'Úµ–×¤kWÕC%fôßKo(ôÈ#TŸ ‡_-ÍO*Úˆ3ø|ÛûZb›óéŸdæ¶a €Y©Ë±Ý²ŠfÂááFqLŸ§ždÏÕc™L`Ô‡TL:ç¾‘0‹u:`Ð0Œ Nä	¬"`mŽÓ)4|OÌXs˜ëÌQ§8ìÖu ]ŒAêI]CúÉÞ{¦q¥á„ÿõUæ|:&‘jô,YæÍ9ß
@j¼!ÔÃètvÃãoo®ÜõZ¡ä¤íÐ¥CÑ?î7\ùŸÎ=u›†2Ó$a±x³hkµfôzÞ+ ®¹E°û„¦Å-Ð˜ÍÜ —´ñ\±yƒ€QØkº$#›ÊÜ,™Õ 6ý—&ÈzlU‹¹Yÿþ¥3bü¿?™,þñ¡Ä<ä1Å«2mBËE]S®¤Œõ¦ûéiìHYDMid(óRµ!ÕFp% >ô-U@±3>2 ^Šþ($¬°@B¤^ëf#¨ú•Ö Ço‚ŒKW£6Ôö~5@r^Ú8,¯½¦6ŒŽñ6"1CPVáZw\*ØSÅ5AÞi–AÉüay^ºøI¯ÚôðYìCö¯Np|ºgp³’`ý~tM,h£ö³t6â^cû+Ó*7«î±Ñ5ö¦XÔ’ýÏ<vØç7·>æTw¦ÊÈ:Ž‡SeÐo„é¯kÝ®K°§:··ý#Ÿu2ôƒh‡ "¦Èãq,y_Ëm=£-RôüL0O»‘Û÷fYWêzé]&¸.V:]kPŠŽ}È9löÏçq}¾\º-þ…ò`&¦ìX¨WSÜ_4ˆ J•u®f@†pƒ O.E˜rQÒ}§Iãè!v¤è¬¥yá!Cy¤Ä ot‡ÓÛÄ»Nx¤[>2šŠ'¤ƒv½Ì¶û”^cÞèqwÑíÎòp¼³8l“;¥4E€TWHÆê—bƒs—à­<’Ÿ³øäÛÈBÛ:)Êeœ‘h §{•Õ1øbþMÕ-©)Õ¯eJß7'Ä—«lÖfƒhOÅDàb†G„Üéà8( Ðå¦Ñe wëÄ§Nkf½·†yvšÌ®Ó¬ŽàôVŠB:küaHžªÜO'YÈ_,\|•ÔØ„¤vGž¥°â!ÙB
ùR:wÁÏ&yZsp¸ìó®Šš˜äUImxáÑ.ºG™VÂe¦%K_\¹|úbÖ„‹y5„fc¤bî;¶÷žêøžÕþæ®‘¨º“žö-2d¢?Ošöêû¹ŠóbO·5¤êq¸,›¢iÈá`jÆ“i™®zâ·HÊ÷sDsÐëüÖ
°’Ó›*óKÃ¹Êm$)CØËšM»–
Ø5U'|p‰qWS·µ·¿×ðfjRßë¿é´§ ¾âÞ™ÖÐ,üZfÖHÁð§ë9rèô|A&™Wªnàý‡!Å>°¹èLƒî­·:Ø´úÒoây©IÓÁ"eÞMq	H˜GØÎ-yµ 	O^àúhÚ³^l±Šü\?Mû6-Ü½I¢+·wœpF ¹Fž*pÄ*4lNÆ‡é —ÐÜ™q‹òªóÆr›ÆÄ„cÃ­Û’óí°5TL±¦7üÇä
â]ÌÜ¤‰ÝGù0gZS+.¾/ªq³î{J9Ú‰¹e6s}.5/3ÀUîJB*Þ‡´•„d«Ç1Q«ÜÂ¬­ZB¥ðÕ®JCÄ¢`VJõêß^= ¨(¯•À	[}Ú$ŸàZ©ONx_©ü¹ÈÏÕ=è7È% Ð~­´d(†Þáƒ³”u-Xx–nR‡	UCŽk‹?=-:^Ù	WÌ:¸ÍÝ/ î_í³ ìÜG“BÊáü£¦ö‘ZäìV	,Åâö*BÊ¼0Rz”Œz*ÀšFmWæ¨'¨!'ºõ^ðzì,¶ÎSŠ›Jô7²†šÊQ¯®­·3Ï¬jÓ³^½åóÚ»œ•Â¦4	öÁ­ï!VœKãÀÑ‹*Ñ^ëÉ|ï-SÄ*¹	ó9®ÐQaeNF…cäîÊÊ?‡‘¸”ÔAÑ×¥T=àY5¡‚ÒREì¦$Í)èµä¥9ÉHº×2kV`‹Â^V¹Ý)0În¸£"í3K9Ö“^¤°Ãob‚ß/VÔ' …BV>Â4+§ZÌ¤>Þí÷Kµ†=gK¦3Îàªg­së¹WêÈóEÓ(¼ð%9zúX<'á‘¿wö!žzÌ@²¹ã Á#{c
†Ö¢à·æ©ê—®‡Žz ®ö6²Ï}äjûg[c€8›Á‹’žS¦-N¹X<ö&šþ¼š@ã¶ù“¢;r:`¤BÊÊóàRìL¢÷Êº²•ÒZ§ã›Õ­t“ Rsnk’¦8Irz½Ë,²¢'Y1–Ø¿þ¼]Dðž‰PÊÓŠÊ·Qµ§L8Æ£HªéÓ|ýmW!R ©7•Úì²ÅSÝ8:¸ûëå˜-ýš½– ¸x¡×8LE•	ùßÆ¡<¾¹¯@—g°Ðˆ«fC>{ñGsÃ:Z†¦ga·ÀžÄæ¡ØÖú f46§,Ú|÷Ï¬u)œ¡æ±gçD7ðh,€JIoii‡¡2÷ëÈu•IüÔûÂ°z ²ò¨P3Áüõ_¢2%K–¼ Œªüj'}›×‰^»gQmÒiE®b»JY,ºFDsòL¨¼ÛÏ¯0†‹‚ÿÝ	¥wŠµÎ ë(
s 	/ÞBUN%wµ A–t$§µVãÑG‹QÃJ…qÈÐP«l_·íQW«ÊÓÄÜ/äBòL›ÄE&€Ç(ø‰Ù'~ÈmL$´÷XµñºàêX
fË>^InÌH9ˆ¯‹ùœçgôCwv¾*”€2!˜ž»õ“jtj·ËFùƒÛ8L³*Ž1jìÑ(_àHi%sñ^½a9Š·
^}òvgaØÌSÇû&+NøhÊnŒØw‹…´$zœ|ÅHÖ$ÔœMÝrá.²GåjÍcDB2¥ñ:»Ïÿ“Ó~«]o&fÈns¼Š×î{c ,ï‹`!cÒJêqäÎ >úZƒ4ÿAÓ*vdŠ¬‡=¶2&Â1ò›ªñ'?]Cs=É ÅØ/¥O¾äìºÝ5Å5Ë@·êzX°<Ú:›{gš‘PH>˜¯¨ýH~|òtâ†a<q,Á–?Sù6 …ŒÒ£1:¡°á 09"oblØA8×Ú¨È|VþÏþ5•Œ“F=™Ó]¾+Eúþø˜@Í÷MÒŽ4¥ãÚ4Ø¢H™GªÊÍqˆ”0æ2(\d¯ôdÿ©9
»åk¹þ~
¡¢#!ÆXf©8ºJï*¬O0QLM^R Ÿæ'n?>T“Ï^™(I°þáb¯â÷ô]bqÚ+ZÍ
'Ç…—åÿ-9¥ºÈ0:Ì¦«Ò"[*^+I«…DÆd(ZUMãí¬.ä¯Ÿi°¯$„~@¹ˆ,¥­«Á±/ŒA·ÞÃ<BÇz¾N<Úh±3Å5×zâ[cî·,mw¡	Z½¨ªá¢·®/2Œpèú°ÝŒq$!á%ŒA¾
4¤qÏ}Ó3ûb	Ý‚Z2ta–4bâ1Èwó~Åy-±ò5>• £!µÎù*õb†OÃK¿ G…üc< ƒJjñÑÅÛ¯sEÙ¦,(h÷íû¡¹ý4Œ:lWiš„öêjþƒûI>ÉãÛØÓÏG{ÌÄœÓæUêGWbNf E†i³Á£šˆ>Š€÷ŠDÑÿ$ß|‹XžeøÓ«>y-<çnY¥²5®ÁàµømóèÐE8û?.YÁ±öy;·òƒGƒP.ây+PôuëZ|Ý¢\ZÚ‚Õ¿“	’g¬ÄQ‰qô›x¨œšZ	ÚÔMiÞMú§Å	lZÛMøë)%fŠ€¾¼I‚Šø»½Z_{¹lñ¯v`r³FDÑEQ†ØS÷&îôÍ.oQúî1xÎ2Oë¨f;eCÿO-Øã
Æª#ÕäÑ
ÿ[Ì»Úl{åS#¾õMcôP¹îdáåÈökªR^ëÖùÈíÛšbä ýo(Ã'”}ð©Ö“‰Œ‡€¯ø	ÃùŽÉç9måTM*ƒ¯à§z{Oq4	‘Wòé0ÛÖ¾Eq+	ìrêZ™a_‘=E^ü8Ì,¦Ôï%íê„Sµ„™"X|æUæžŠQèÅÒØÇ´¥LÆˆ+¾ò‚S'ÿl6£¾ƒÝ $Çn€¶;æ¬ÛNjä ê+ #hM%d	R·øfjNm'+˜¼‰…¬H§oY}Ú†¶P…vÝ”!éŸ³Í¥]	zÐØ A\ÄÅVÔ©Q£À›ë«ø„¹(©:#ûÂ2QÔö+¢¨¤â_¼ŽVNÿ&Àiuõ ¨ã¼ƒàGî…²œ¼#ˆdõxháôËp­Ç)$©ÿ‘ÜYAœ×ËùQrL­EzÊ4žÓLøs{M]wÈ¹òi[ \?hÞ†jM.-Ì‰44…ÄžÙîHDá®Xx6}LÙ6ûÓ;ÐÖ*‚ÑYnQ.HÕ³/‰+ð2ªÁ°9)?ðÕØÌ	)ò¤Ô9Zß^W§´ÔÅ×}r¹‚&·ÊCòa#	Ñ¾º®Èb1¬b¦NLó®Iƒî ýOUäåQ¼?“g/ïyÒ}}	#eO+ð¿Ž8Z,ó·/ÃiÛk1Ü€Î WN^xT²åø,’(“<ÌS¨ÌâÛ6Š-ÖƒŽgKF“vüî²˜Wï@Ãgu|÷&§WS¹SLî>Í’Åä–-¢0zÅïåòËê&«¡¦1ðûIlB–¬Æîˆ`–A{Ï@ÓñCˆæµO†5ù3 öøÜø<ãIn¼/ažÊm a.xž9fÇÆ¾Ü;òü(ä*U3OþV…ïøo M“ÇÃÃ ¬ØšŸÔçóú¤0äÂBÞÃèéU¨…ôVÀOƒûmK|¬½Z½v´{²c]ï,	H%Ô.ã@lëG›à§F‚^Ú& ûiîáUŸ†¿µ’Üçÿ›t#1¬„¦I“¸úö'wì-IÈDµ¾½®¹3 uÉcÊU3Õñù¹šƒmÕJz"‡ªPö€rÜCò°ôiQp¯„-ÇjÖ³`¬E<*‚{ÆqydCœˆqö¥FO’‘+%VMÇÐ	n,ü–âÉR+üéc{¥«"»Š}¾XÑÉ”ùÄÁNû	X³Àx£­Y	&…"Ý‚h'êµÕ¸üs¬³{ìP”Ò¸¢Zy8Üv,ÂÇ¡žòèÒÍU@o“»š(Îÿpþ¦;p3í&®±9d ÖJÂGIø¼äG| Ô^~Ö–„¯ªºû¤ã?‚!bI2nF2O•ÖF¬»ç¨Ñîä0P=ÖÈU‘îß©Ë3Œ&^ 2ÁI	GÛe3F)(+"¬ÿ×ž—Üƒ™Äm2ï(WHlù§å‘ÓäET,UP|¼©Z±;óµ‰®'RÝ·[àuœýPóßì^ð&¤CgWsˆ¿>ù9 R]êÈ>i?y¦;ZÂ!”[(>}ûòÒ!IBžüÜ¨·i¸%ï{÷·DÙßØ§˜KQœjÆ>²ÌRúÿjÛ+z
0½¦¡ÓTõè…@é8Þa°/_CGým‚âÆãyŸUš½`'ÃJŠ–&ò›Ÿm‚Ö`5ä)u$ {‹¤ŒÃyqNùæ'J¿úÿ†xœû™‘†®/qZIN&ºÁÉÔUœØì2ï/»¢4†„üpR¾°RgiXœQ‡/Ã£@ŒÄcv‘‘)àãWFjf0† Y}MÖØ³ ì!Ñ/Ü-µ§‰bÒÔDþžÈ–Fsõ°%¦ÒM®eT‹YJaÛÃý¬œü­µ«&>„²– Ž°Ú ŸzeÝ3»Eo ö’}ñ7!ƒ¹ÖFîƒ=¦"
mŽÍÀtm45ºˆïkÇÞ@Ðª®ƒ¢˜»$(Ä{RË¹ES¾ó…êd¦_<@„†}öò*ˆ®sÑ:%y}q
ô¦Êòô-Õ¹é³l&Ã‡§™h
ªç¡jòz&ÏXT†úlƒ,8é^|D¬ÌÅI9ýé:Š£Õ|C"š˜Pÿÿ8sŽÔ>¦$ž®º‹¯T5ÊNôñCˆ‹T©öÓ4Ø†ƒN¢F+öÉBæ¥ŸVHåÅk²rÁÙWFîÙ³ÐÏeñúp‰SšuA×Çh¥7/Ð[(âÍb®¶ëš—6%ÃiÏ:å…«U´©¿bC²‡¤šE€#ç>6èÅøvžÎÈBìªˆûèÝÉî7ø Ô¿H€Q”æwÐ[)wª*ÔY?l‡ë|©&ñB©ƒù§‡˜‰—âß÷rÿÒ§x‹7˜µÑÊvBíáàºøšNãTQx+•î5Û¨UY2¡ãÂfpÙÊ˜)„î\ÓBëah,û&¶P™5°L.°Ä zufó­ý‰<zÙäçO.¿Çû‚aNë\šIÈ óîˆ,A:~ffŸò£€°Ê ­˜Ã;‚‹&íÔ˜²{W}q*A^=¿¸ž£5ÕÇÆ=ýìY`„C@ ŠôæjUvà#e?IÏ÷W
Ì>	ª{Œ}(KÚ7¬pZuàº~½Ý“YžÉ›©:õ.j†¯£ÆÚùÝ-²|9¸Mí{®4Ìûœõ~ídO«¢IÛœ[²™ÉMU›tí¾ýÌþ¥Ì—U	È¶r£~hÞ&EFÏ	j%®»ti€ê>fzo‘¿¥Ì`…,¥Q^÷ÎÚŠúTEpeêÛ‹`Ñ/bvíÖyÃDþ;59[Å{ñÔ“½T2Átí‰\ýÎæZeÉˆ†o@¢|Û¶¿|ûalŸïÇ×Èeé“–GóÐí!$Ö¶6/¦(#.Zæ;)xx‚8¦~E‰ÂIïjÝ:Ï÷ÑÐæšöukê©;uz²N?0“¢•ULZ53!øJœÎŒÒÇ’%ÿraLÔÒÂ³ÞwnŒ;’$…}+ržtyh0}Ü)÷‘ÜŸœ_é™ƒŽãC0-W„ÓwûI+€r?v²y1Øž5’G«pÊ™ëòâ./I±
‚[iŸŒˆ‰éoÂdŠ±4µËó·_ÍÊÊ,Êt‡–ùBž…«Ó¹0Âª8_ú—aºú‘kÕWËdhÅ$¿lÈ4ìm¥U0õöò$<ò,k¾2Â—¯¯ÞýŸu
B¬ %¢ãxà7S]ÁdÛ‚½ò
$U÷W¹Ÿ„;V-CN¬!&3¡i6h&ªZj_î;`pdÆ
¨ýUm¸	ŠKð](¼þŒ†ææ¹¡Yõùš#²uC97(ÀùŸ}Ø¾/°V7W÷™>)&s˜ ‡·¡ìÞÛg4¦”·¶Æ©5}§mqA–UÀ}˜âH«Ä“Ò•Ä?»a¯Ö³O²eRŒ°Ù‚ú¨–ÌoÈcO§CD'j¬ªy‹–’ Eg©BáO¢ÓÆ-¹oX5«€mþž¨­š®;•º´µ¥Oç+–W©³,¯ñr9ç³9Õš¥'_{«öí£~67î‹•íŽ½„UÓKõ·Y&EfÏ®W»x "rÞb•*ï6y’™ÆÎ„%îÿÞ$¬[ QÍb·«“ŽåqF*]IU×›|œGïjº¯ªÒ(øÓ­ügàž‘GHÁ4LLQZlW
3HÆ¢çÆ™«³	’#’ÅÂ2ÈéŠ¥bwˆ–@J .iy›™±Tî—2Ÿ:mÔ×’¼ÎyæühMÙæ²‡Òþá‰çSIq¯¦EtÖqŸj•f0M¥Ô¶.žÉ$Æ·¡í°Ð¼ÍoÀt&œ|B½*8¿¡'‡éù¥çÙ7¾À†±vÜõ÷ð\®Âá¯4lm€¥³“-å™ÄBû…®(â$¼3Õ>rðØèÎÊ›¡ž‚­C°z)õ½A˜ÈÁ`|Ô}¼›Œ9¶¤‚¬B×ì÷]ªÅX/¥]kâ0j	¿hžÌ‘”ã	ÌÅø
o»toÈÑ‚ä¦‘fÇ-Ìõ§gµ¸K¯öc'#Ñvœ4—ÿ«HWä(úba»ê²¾Œ¸5•ê]léñÊ|qEÒþŽ·¥=º©äW@6q]mRBßñ‹ÉH‘”5ýsMà‹†‰¢*ÝËsÍ#$øüíï¥›‚TJAšmüŸ¸¥…PK-M›´x±àJWÔà¤â¨s½ˆ–1`Óâ÷&¾sÉžQ´ ]”3G‡OŠmÞ"³è3Hµ*°îï¥Ø¶¢ùSçÙÇbÍV[ý9ƒ\ÃD´Àš°¼ñ@ß~Í¿É>¶B¼ÃÔàøœ…É XˆIªVDº+ÿÌº¬ð!Žž|ó¦Â›ePfàÕí–øÀAµE›tÑêŠõýJ·—˜jÅÏ„ßSi®	ý¤›Æ+÷>®¿‡³büÚÅwZ¤”¬ùêÝ¹S<RëÜ‹ÃãOSBP¦Óët8™³Š"·víÕFgËŽ’©]„!ªBž%!0höóï'›× òDz;Ï¡hZ-P¡ø|RòÁÏ¼Þ!>Ñ;:‡u€IÄ;	óÜ46*°§‹—*Ð9[©1xâõ676IWGr¶LÄÍŒß:ê±¨ÿÓ´×ïÊ:JYÌ66Á%°1€!à›cô«D@¶`¢›õ¡”1ÜÊü§¼]M—?B€Ž-Ë´G },*Å_yHŒ"jüÖ»¾…[eþ›UJÂœ·5d®•uÈî”vú²kžSGuO—ØÒ^‡%0½E«“3roB}¶°»X‚×™öåOš¡OöÉ`]Lü:˜bMm™yÂ9±öýˆÏqpZ@Û=·í†¾^¾*åÔøh1[ñé6ô²©´@ÿFê#a¨:$
¦¯Î¯)Ð8öÌ€ÈÎp‹#3:]NOI“½ÔQKRÞ/+T7¹ˆ]ûh›5è~;Ú»îIsûq66+-èoXk©ö I„Í±2Ì1Ö ÿ<8­ÓZÏ„ fÜ†1Ò`MÜ2¢º:<eöXô-Á™!§‘;L Td ¿>_.‰SÇÄ‹ÛÓ8ûB©€/(ë\µd,&?;@]óýmaF~Xh%Ð*–< e`˜Ök×zh–ˆujù%Â{3ácÖ¼nýSÓ’/ó£
~*Móï'N3oûËpqÕ]oc…TQéYÊ¿\’^i?Ô7ùØy{ÇUÃ_¾ÓªÊì<Ëö‹Jc!»}ºäæ¼<U`t£3®zÁ{%e–»èã´^VAÀ’!—~™©‰5àùÌ ^íÙbAìq±f2R·aÁÇŒªO%VD¼/¦<Ð^4üÑ?49½ã,ùë£ è3r}èÎ£÷Æã52	ác÷ !˜ðÁë`sCbëã|š¬ÙáPüæÒåxsœ~üƒJýD/8Ö÷N'12¯ÐÒÀ{&gÙã˜þ™ÎäªºŒ´8/;…–¡…R"-dì?3ZµÄ‚t[X/qÓŸùpõr€Vžš_ÝpaÍï_4MJ5×jµÑÃ"ñ³¡nqX5‡õªq³ÓT-£!v©•§€rpRÈ54Iœ“i·}°ž¬
þÁæ~7rÇcÂï%Qçl »#ýçzlo*âŽPÁgªÇQóÔ>ÞÖ(x/’ð²ï1„ƒÚØQtóõsÝ—ŒKÐïçÊSÂÁúR^ ±ž6ç9¿‰ëÏÒûájëò-©Û};}h†…ue•ˆ²¥ßçŸ™ei- ñ…^u Ö¸8…“Í˜hf‘oªNjÀ›¾ã©uŒ!íV!ÓŠSùÄ…JIûväìWÀc;fÖi8JÐænYàn:»»…þ]¤oÐ…ãxˆãé
CÞºR=Å`ÛÀêƒ½Õ&þ%÷§šRnê@g¦‹3º×“ïôŠ,J	g?ƒ/ázns„À¯ü—˜ÙI=J«+•­Úæ+gL¦§ñjsîš–xßc4(ÖaÕ;„©‚Y:½§Tä¨äYè‹ÄÅj(;î
g†.jk˜ÆÈ”Uv Ø "¤Y‹¦¨–Ž¡éÝ
»ÄÛþ#¤@Q&FDÎ–›Ã¶ãù©éÛ¸Ì¼ÀÕ²P¯»C3M½}ÇB¨RUóÐAUëÂµ&&·–¢LEÊºÍŸJ2ªã!¯Óê‡ñ‘ÄàƒË¢{«–g ª©åè —7'*Ü$—•TW|îCÍ—*wÕ “¦F×#U°«ª úkäÖ†ÒÇ—)Éx”£œ©cÉŠÆ÷}zFÔ(¨„n§¸mE~‹ÝÛ«I
Sö¨Ã…Ã¥Ñ­¼Á‡6ÚëÎýŸO/a#&	\¯ÐaTh+AHŽpÅ§ÕÐqÎOÆÕÜ÷n”J3w=`*cõÃ£úŠ
‚g€:Ê­eýì[-¤cvIñB"º‘«Fk¡ik0Ôõã÷Š¯Uâ’dA0;G'xvŸˆæEœàš{‘xÇ=T¶|tv»½§bÍZ(òlmKÖRÂxé<ÖŽaœ”G`þ·ë÷²q‘M¤M†?‹%lAì‰"u£ÙµÌNÝšºK¼N\°¶CS~f°¡7ßi×3*ê]‘Â†ÒFö/ë]ê
fö\±‡-XÕ:Y†ï™Ãß¸b3N…>îà·ü`Í›íõ~e •«ã;~v;Žï%Ù¤šá´.AÐñÕOŽöqGB
”jŠx‰#Jcƒ°‘³ÕÊó%E…Ï·f@š¹cSÉßÃÖ åó°‚Ðé.e†gœÄÅ„n0)SáŠEÑg÷f@ Œêo"¨GÂã×T ‚Õß ë§Æ-h»dmö÷"â[ùhË«O2(÷Ö)4j^$^
ÁGe(~ËHøà™ÌÞh†<«+e°¿1bZ¿ª;ÌtÒÚ§¾Lm„ [.’oi¦L°C¤;ºajó¡ÅåÕ~_JÝB
4~Gìd}ªMS.Òdñ´oi®ðN£¶.•qA:ª>ü”áOL2kMÌÚ«RñÀ¸ûB—»Âú!ýöw© p°ÀÏåß:Ò}lÜ¦‘›úSè#Ûèß¼~%Ú™²Ýª8Ò.¸9)á5'Kq»Öý´ßHé¤±ÍWõSÊ:£A4J½|‚f¬îv¯§l(¡¾!à8YÃŠÖí Òª˜›•¥+sà18êœ…MºÔŒÀ;V:b€î÷UÈC9I—GuÝ>4xGrÚïª³fÖ‘foÁ‘ÍM¬1=GØº!NJA"¸nÈ×UÌ}oBÖ)@®î#ÂZ¯ °Î§;R)ºŽã¶HFÚ‡g£a¸ØÌBA¾–ÿój†iwñLð¤A«;¡~,0ÇœE£\#qÙIZ^*Q–©²èâXË®ÞÌàC‘q Œnþû|`Gy‰—Æ|™—â! V~­¾ä¬´ÞdŽÇbVVþ&ª–÷u¯¼ÓÃøm'¯û”Ÿôû®ØÂ¤à¾!ç[ti#€2·Õ©~ëšuˆ¨(tr‘CòdL:éù§	UI{’ë}o7Íç FdËDAý`ÆV‘ì%iƒ”î4Ô9'„¾E­ÞÑJ¶'l—¢Äó7æ\`=˜=Õ	ØÍÄ)ÿÃiž†Ítœ£Pî¿Gkkàç!Î‚
pòü¶ô)J/FrpèßÏÂ+Wd¼†¡¾kpVyçáù2l’çÊ-#À™¥¿ä~8¸™OÎ×ÒÞ(ÈT(’€=–a`zpäÞ‘Ò0‰WèÐ#§Ñ´"œbc¶\v4•’ÜÛ•1Éå¼|ë^6Ð¹%‹ÃW€¨“³
¡‚¶ã*“py²Ö——5ŸŽ®cÅ#Þ´Ò2jÇ"yíÉ?™®9Di÷ÌÞ&3_Õ-Ù«ñ(öµ§0ŠØ\ÇKêHÝt&k¤³­s6ãpñŸÑÁýºWù÷¥oÂ?}²õ	ôæ@QÙ»*4Àb·ø$:öÉŸj/^®!"Nôèè³ _Má5Ã@ÃÁóH-Oø^G ºvò®ù°£-ãër„~T¡UÚ|/*Æ§Ÿ$éVÞGíÿã€†p€…)Ú	YîÏ¢qp
ïŽ<8}¢ï$¬Å-~'ïÃ#8y^ô¨2
¾…ÄöÄœaÿœb ç²´Ä¨;ìý7™åöV\¨°Bd©«h’$ihævíåóÅˆaªôàµý¨LÖœ´‚1å|xåfî+ùÎ(rºU©Yß&j6tf"Ò£¯§
“Š!ÃØí…%õ1„þ‰Þ€î½A!Ì(Òº±öHÓÉ‡ì~‰ÒÏ•†ö'} -E¡vŽgýšižƒAµÂÉ-d/å9ê_ÇØe(0×ÎÃœy–UGônU^óGð?,Y® §LÇÝÄ‚síùQ±yâ5¿TTÛé—0	½DI.»©èr¸+ª"–?kà(Î"|w&äœþžQ›FRmŠ¬Ë8æ¾óâS]$6ái˜'¦C8<ài²QN»ZÊ’:>É£ ×À“ w·”¿p ­©}V®NuqK‡#Ü¶’d£y/õñß-~&°hwÝQPv	HêLazäà»›ò{P›„Ìa¡c …HítÇ‹û£D—Î,«)[ÀÚ}#°ÏÌ¡@ŸVØRV¤§ )61ò®öAYíÔ*cŒŠižá
$$Uæj ×aL<æúé›ÁFz¸Á±Å”0ï÷x?^±Üz¶ë0©qOîUí®ëâ^å§+Îý10«æ¥îógnIÍß(‰ÜöÂöH›Ý\ó´ö¿êûHº˜]áslè:1¨â7ûì†•ß03êÊÛàtwË$sÔ6ÆªŸ“r•)ƒøŠ•	
W$5)W¼@²"„$<ð@ƒf²ÃbMxN—íõÜ.-•¾`1ó“˜Ï`eFUAüÝpë¤¡ó°%»Tt´ˆÔyÆ—îYizfÜÎÏ›yÃ€^×!¼vfAùFr„7˜Wl²té'vyùê{óvølÓøÀ>ÒÑE:_pÎG	Év•Àmcá¨ðóÆ8ü?þâ×ßî"s–Ewð˜¬–¨ÛRdåQ94räŠBœÉtÁÔ£68 ûê÷âì´{ñy¼àRzÆ~¾R ñØÃ‹¶›09(Ú3Ùì#{^ =¡é¤Ìp€©—¯tö×{4„;ÅhwÎ8ÝßËHà`¨¾ÓKû=<qMAf¢û«(	åÕ§UNWœÀD&FT:Ñ€Ða¤€;L]W7£‰
c›|hïN5Ž³á€ É@¨XènIŠûÄïÃ-£‚‘›iä™A<‚ÛD“ÑjåJ¶°DÀVo˜Nl)ÉŸ'¨ÉrÓuWâ^r| ã7rM¸©á³á=ÉgFVV¿h³J‰1Ñ—…7>¬®-öÎoÄÑ€{õôëéá_a‚´D	Å*g¶àÚl#¢¼…nÖ0Âjq«Ãgw¢‰#‹î1ªS­<y=Œä‚ùCÏPìA É	»èb5=FMè2dü|õ©uoK^TR‚¢³$U²ŽÕÙ³NC²•±Îºv­ma\Ô]|Ø¤¶ 2 ås*ŽtÊk´HÜÂÏê£NÓ[wZÑü{RÔf°ÅÙ˜ß¤­\6~ÁÍ"Œ¦º±£‰Òo¡òäoU–´5+Å+Nq2o¨ÿ NÆ3©ûhàÝ­žfïFu*Ø‰£0ÝP39æÂ%A¤?–š%¯[ÉrªBGÂåFeRœ\zÿj‹F}Õì™Ïè–ŸBõfHÝ1]a˜;]#à“Üº:~¡(Oi¾ùY›T–ÈÈ‚cs{_òC•]ìœ¼·	¡.È±û‚CºúÃê=#Êÿ$b%ý”VW‡ÃU¥m÷DéðÁGŠ¯šÆý»‘#%„ís[º­ X›6cÌjìÜå2ú‹¼>`æW€ÏÝ¥Mš¯§ÁJaËÝ+v%ºÍGb]2Ál{*„¿á®²F jS@@,Ôc‡ÞZúLxÂi^­IVg8¬–pÈä-ÈÈ¡©ðƒã Nu¨ûù8kžìWÞøŒù3i}ƒªûEÌM¿ØÐ}&BÙç!©H÷Á<Bl!ÐO9Šç[ ìK©Êöa»jŠ=ƒ¢:(_CñôÉnÜ’‹hù™1˜öñ+¨³“¼.aªÁpP/1ôdñdÔé"S›vãN´Z³©(è=Us«jõQ’§È¤@í^’ ”†Ú/.Èà›WüïÔvˆ÷ç”­UÛ¬Ž!í”;ƒÅl¤üáŽý*h‚U²fÆ§=|¢`7§ëó_‘M[ÿ«ÿ~û{¬7­)6?cÈÌô>euMöÞùX® M¡ê+Oû+m²]i¶Bú8ë,Qr#Ô™)ØZv-ŒêföÅò³¾¾è„®”O®·Õs‚ÀgµSàš5æ;ÑëÅ×#ÊY0Ÿ>âÎÙM]wPZŸ¹%fþË LK_–jÒšà’Ì×ÿEP‡i04Þý».9#š—ªGŠÕné/¿ò$“:©N€ÚAÐ‘^°G8Ÿ€òÐ¦Óø—McÌ\&µp,Y"7)Wþš“ñ0Eé9N»èo‡AêêÐ5øpÊZÏ‰ãÇ¯ùŽ€Î$AŒkcI#<– ÐÔ—rÛßø)»{tçÄÝxz·µ;ÍìÑé¤é{]z&3	ä	zRÄvËNö®¾o¿ºlwÒ•Yÿ\.d}Üv4®ø[7x6Þ Ìõ ùã‚¦‰QàoÝ[hÝû¤˜ÚÈ²»
°ƒSg‡@ ß®‘u*Â]Óù]ª÷€ZÈÿñÃpè1f7l¿j*€Z¤ÚŽ(Ä=nÚíàtfk'«TÝaxLÁ—Qï„#¥,Á4 Ðæ—BÆ3$ô9?¨2ö];²#óÉ„ôšý¤>Œ¢Á§ubÑõ,ÔÐ·^ÀÞ;åš¿…P= Î°L»Z$ˆDê{d…ÙÒ­s‘zÆ2¶æ½ó "U¢U²I²y’l[÷ÑdÚÃÜæ6”*{P^oG2Uì)Th˜šƒœëw,ƒéÊæ)]c4dVY	ceÓWê,²îŒv‡Å÷Ý3~;f@S»Žðëc=÷O*&6)n‰2ì,µ)rNÖ8Pìÿ5ZB†ˆ$/ârÂÌè ¯LSËÇ~ôY~§Ö’<^ŸR‡`©É
^&|šnVR1éã<üÀùÑ’ýä¸Ç¾2cÅ÷Ä¸¨oqüŸÁ>T‹Í oXèÎïCFJZØ8¯¿‘‹^¸ú”·f|±]ýì±ù®(UÓÌ5"z©âJÜ`RZÈ—¥IÜM‡Ó£R\rs@ú±ˆÏzíÝý‹©Ï—#€7½sïîšþqŒ¥äƒàPŽOl$ª¯„FJ­v3 S6hz¯5*mï‚Â.Byè<iÂg.=ïYïûêyÆú)@›„ k— ÜG+q]ZeÆ8ïsoK`œÀÓuS@Ü(Wy,Z/¯~:QZ¥ÇñºMÚö.ó·82zà‹A‡J;ü	3Åj’a¤w1Œà>åÕœª’-f•«!éè×çG²¾¶É£…}ËzDQ1Ù+ì1˜’*´äd'-q*U@µºã:IJýDzÔ\Pœ•¤šèÜÍ07qžksËGý,^$5O^XÇå¼x3ûu1¿5ª‡à>ìpže‚Q…b2z§ýÙnyž.
˜ƒœŸ4ˆ-{Å7˜–³bu'"t»Í*[÷ÏíÞÛ“j&ÂüJÏ< ¦Ã¿¤8ÊÂ÷ÅŒÌÜç"—!Í¿Vaœ„`Ð£‘Zò"¦ªoàÈJf™…uäsŸ	QË4S>9HÔÞÐƒ¤¯g)L±i†;Áa]Òžq¯òÜã»“qfOÅéÞäéÖA]=ð«Ís$ÊMHèïçj=,Æ£¬¥C@K_žDõxÆâËÕ5ñfÒ;çï{Â¿^u¥!§P#€ð,…ÕHØÛ=š÷½<,¿g—ÖÙ+p{¬fH˜»ÈlË=Qöd­Ðü¥¦-ka–dàÙÛvçà‰¯+ÕÏü0sucÌÌ»Ò·k;¯VM¦QÄZÂö¹a3Ó¬¦&“}ÍuË3j4i‹¡Ù!, ØjEÞÇÎLø¨ßÈY™Ù°¡œ§d-¼Q^ðj¤2Ü°xì’NÊ“šèf«4Uÿ×éêÊ|ó”×ÁÁå®Ú(SîÅóµÜ$øÙnÌ%ÞÉc°6õÃ…D½M%×	6G±u}¥ë?â¥Ð.»‡VuÚÅão…{d³×°´ÞÞÜÕ,D*»C¢1uâ\Cô;äÞöo„èPp;.ÔÝ_ñaBë®ÃýKœ™Na#S²ˆ‡N¾ú¸/uªQ¸noˆÃ¨Z—ë€¬zžäìåÈûÐõAGQyäWÆg…¨š«ð½UšÓr­ý„£7	E;e› CM©ÓL¤u)ÀÛ:Ôíh¶æßöõ˜À^&¬4WæûEmÇ„e¿ôJõæŽ³nßp­…³ðŠi~eZ^m)§g¶»,-†=E=0Á÷=8¢ðj„Â¦ÜwËM·gÆ+…«@ükA½ÛÞ+$Œ\¥h˜–ÈƒO
²§g;1„1à1³]ÜÎÿ«ÂÁ¬}Õôb8šâ2‹]„‡„ì†ÚÃÐ„Ìœá–^ÉÌ³J
oT¶õ+€»”ÏZqçd¿í6kŒji®c.ÛZú¸àË±›þ­ô	ŸH8ê4&½P|^ÐAäØ«?¨¡8tFC€ÆèíÇt¢ÄjâM(ÇÚºÀþÞ¶»Mºó¯MšKþ¡ÓüdÆ š“"ªiRàuNA³oôj±"þÇóêQ–/ö¾¾Wa¥V˜^Åpob/…ÝÎ'GvLD(™5rsF!y¬_6ªçnl˜Ë®”~„ÌçÉJAEŸ ·u.[×°`®†üø·¼ §ºà`(× èhKau÷=ªIÉùt2€ÚÜ4÷½-9)²b¢V¼e„ºÝs™>~ì?Üqiì‰’ ÿ³C-Î=zz?]îe9ªa“xJ¬ÈîäîòèÖÊö$ºÆ6³Â$Ï±õÜúm¹æK¹ÎRr³Ò­_›¯Mýq—q»Ÿ4š›–ö‹d»¨ sd%kJ†DmWHc6íËYtw““•—CÍWïƒÛËôµR—¸,¨âïŽÛ$žärKÂ)ÀƒµÓìe<×$Î*²¥nÄ rFtÝŠ÷€¦ª(1š•ÿàI­ø§¿rÎ51EZ'¢gs€Žjâ|ñb?ú%Áî,±@îg`èÓ-ná’Æô	™<ß¯J>ÜN¸"£R†»À™¬ÈA11{Õîk^'¸­œ”Õ˜ ÊnÊq.õ_MõgÎ-&võI—©­¼JmNuï1.¬·	û[éÝo§4à+G‘gª-¹ì¯ç]ò0KÅÍŽg™[Y[À ENæ§Z˜ÞùãÚnWú=¶W#é8»{€§)2áü•U:AQ8¹Ü¶7]ÓáY‘î»Òk®5jEÄHXgÓ]›š´òÒjx¨znÚ¶7gÃ‘à²0®bÌŸ‹!‹µMžìGâN;Õ!‚g<Wi÷.ªÞß®Ö‡c×ë ÖöÞËîY†”ŽÕJÎuT/ìÀÂ»ÉÄýW^ÍUUlRKK%iÑ.
®K­µy™'Xs^A¯[‚c‰Zãû<1Ö§(®š½ÃÖº˜Xž¼^Ë°)Û`S*¢÷Ìy?*gæp¤Ú´£¥‚ÇIyS=xó/6íüè[šñ€{ÖŸ™C[”ëïç0À÷^~¥kÀq^õjnû®ef@Ý(üÙCèè¥jl#ôÊfÑU;"¯ëüwšh‘ÉGÑqq±ŸjõÙDøž	Œ¨ÏÜîGÝŸ§.¶mÊ‡äwê§.}ÌÈáI«3M“«Ã÷ û¯«1—É[ôQŸžï®+2Çröwm)˜0ÁàBÃ+ÙŒ»„ÆÁÔrV_ ò°”ÝœQ^–×C¯é;ÿÅŸŽ‹ˆ,&µ`ëkR‹+„Ž€äÂ_ƒ86ƒ×7=w7áµ¸•&Hê£i¼¿hhIƒ#Kq¿¶ü|»~Lr&@¢6O,Ä»jÁ5hš÷üY°Më¨ÒŒÎ7¨"áö›8‹ZH:IòˆH£ƒE•í6Åk´ŠGÌÊ5MLjÆ¯8>µÜ÷ÿªv¼·DcÍ·i‰xàá…ÐF¹&ö'yãêH»§*«ƒ²Y“×á]½2š3°£Âé;ÚÓ+îOµã=
U—cÂ>í 0Šwõ°#¥@¦©v­ÏeVå×EWk+k°àüµæã»÷‚’Nå6ZÎ™Ùç²”ÈÏàt;âáséÎ-Ù·ÉºªEùžC¤ðžá¿Ø ø/ÈqÚ.ºØ¢?yU)Êú‹³òþÄ¸D˜ ÏJÇÎ®• N¢ìä÷ä@Õ×:j2Î…Tð•žñÓ®wSrÀE»-ÙÌÿ™åš­|äÅÐ¼M¹ªì«¿`†d°ÿD[×3v|Š£äÞ ã©@ÌE7†ŒÚL€1r˜3=ê÷÷r—ôl£)CÍ»í—§Éåzöâ¬¼ý£ºlç·GÓwb ¯áˆFÉì.uP+tm5¸ÕõÜgZBðè’*àH¶Óº·–Á7&”E
)²dW·GN[hØ˜š·õìYÁ#J?þý·DaÐéÄÈïZTÈ0âYUq5©–Æ–i;6P9ÛB6ÑÕ‰ù¹u°}¡|ÔXO#¸Eê¨Ï\u¬+bÅi‡î§ŸnúÑÅoXâ›¾ÚN•´àËþÈ#ÓÕãQ=[¼¶èlÁwOîd¡9Gjå!€P:/ØßÜ§1ŒÚ/)’Ä™]ã§ž}ðm±Ö·RÈçw×œzƒ¡ó¶-O_~Rt17G'¬¡—=U~ì›ÙdYéD2½‡ý´Ï·Œ PCDn­Ð-»íI¢:ãLÐ
št).òƒñƒËz Q-°<>Ôªqè É7it‰íÄ\ñd œyv9¬;»Aòkú†^@‡á oÐ‰e·ëøGðÔu*\LÍ#p
¥rš0Qynhø|R_tY÷H½}“>ÚsC¾7†P£¸,ÖòáK"¢p¯[éyÊÍmuHyÀX›Hvv·³¼ƒPz‰âå•7öv•išÊèë1v a†Ç2¨ìùc×ÑòŒ+§K~/Ö’oµ®^ŒVÕèéx¶	ð Ç¤Å¡G{x²´­VtðdÑ)ñ³ˆBÇõ`Ó¿£fð9bDêÀ­E´†j½ñÏ u©¬1ØmH=O~ÎAßÅrÅå&¾=Î~ôõäñFYù0y}Öo^“ðÎ{ûjjJŒìV€²`÷51‚Ýâ«˜Ïš,«E‹‰I5»X.œ^òÖîþÝb˜¿\'x*yšÏÉÙ-_'VD¸xs¾J?zÀd³mŒÎs1‰Õ(¨¹wû…	ãÔ‹·ƒWcÊoòßŸ±¨þî…Ã{KBºçŠˆhÙÌºRå­„Žs·ŒO—À¡ÛU*góÓ˜¸´MñÌ¨’ç™;ö³ð–ûCÛžm	2¶„ïó(DMIù¶²g>·èv…j~nôª„Ué}gPî[¶>Úœ“Íè÷-À %AÀ6-<¿Û‹Ýc7ËÕ¦*t½\ åÆü ÔKÂP*¡ÿ·…AËGb†Ð&M÷Ë6—¿:/ 1p
­ 'zc‰¡¯ ³ar‹ÒryOÄ@ïÑ½$]?â¡ãEwn…å4Þ‘¨2ú}½Ø'ªmÖ¯CÓ‘G}·&ú&«Ü”é–ƒÕr6¢ìq‘à#Eà õÁvSù+ù… Š‘Ñ¬Â?SÌäæÅAÀ‚Î <o½÷¨˜˜ØÒT;mm™t¯ø¯7ÒeÄÎ…¬;Ëe+{!©-¦ï–=¾0}“È#83ÛapVHøusÊáeùDx¯C|¹¤åäÈî\Ý©Sc¾	¥ÕrzÈK¼]Œø!¶­v<iëj”ƒ´*ßûJJW¶«àÆ¾HKIiZ*õÍ4‰«qIÞ…Ü´zß	^¿c@ Ôï¢lÞØT·1¦âÕÖJù'¨™P6ÔmÌµæ>wëÐv T_‹˜ºá\´CÆâ™iÌÊŸeö0hh‹ùhiê€è/'0L{«2ÀÖèH‹„¾ NÄ}ë²J®3tØ°fH€|\ÁˆK€iÉüº‹M÷ž»OJp;VÛN+øû˜Óÿ=în¦gË™Ëv™"G)Z"Ä¹Ý÷ý~³xºÝD9¶™³æµåM™GÆûî«“M`ä?¾6ˆÄûÓ>8ï4$eÝ^µž«ÏæþP¦^ÕBl†¬ ÁìâˆÉ~•Sô7$¦rI)Ì¿ âø„°ÈJ.¤tÉí0ÒÇñVô+>1¾æ7CÛs¿`éz3æÚ‰fƒð¶ó;uÂüŽ†‹ï&ò3CŸ¬×þ ˆ¨½)UyÞ‘rK^«4´Ù¯÷‰>çQv„“a¯­çþ®7Ñ­ª|áùðçÛ¡q\uâhpDÇÈkÖ·ÂKYˆ@¯¾)­“ÈÕË-7mòlA¿Sàˆ§T”¨X9ö0¬¢ƒ¥KÛe‹-öûD×Ò%t¯Cñð¬¨JÝÏA~ãÜð Ô·@•mˆôk€Uú©Xæ'zœ‚ÂI£rE‹Ó§­w‚V÷»¢P?®Ýäòp š½téîùÒ¬&À¬d’Ý—!ïz öù9Ž ˆCÊBÈæoÎ·œñ#[Ú”<´ÈæÉ^åq,\¨¤^Ö]a{ïoi*„Zó»9ÂÇ—‡¬÷;­MkyÙ{œi»;kÅ2?‡Ó=ˆ•÷@<´=‘-gßöÍÈ­iy²S©^ˆÄPÂ+˜Ê$«S(ù·È³O1©ÂØBO$‰‹ ÊÀû7÷kwÓ:TÃ¸øß&M°x„œ Ý‘ÌI(ó–Æ¨B#,ÔÖ6ôŠ›æVŒr4)¹…i¯·ðÝÙDß5´Œ`À¦f+Š>ÂõÛOS¹|NÑ ²’íI÷óV´Áñ'mBµúU8?Ñ‚¯´·;Ñ¬Ö3‡†Ô¾c„®=¨&RY®@c¦¸§¢zŠùùÎ×nÑü›äìÛÄú÷W="_h¬AÛAð/BäÎ²kÒÚñàf´¢_&Ë8µ_Û÷–Œ½M8{°V~X†.“öDæ˜ÞÍí{QÈû†»“Ž#“…"—™ï­œ´ZÜEkrèX,µ˜Õ²ýyÏ4YûT±ž”ëX‰ ö!¡~¥mN7ò¿:FE#MLBÍ¡ŠŸ(q–‚'u–?kç]ÑÖw§².öýäf`"q‹I1ú“¹»ï>â0%¹æR`‡KZýI$”ä³:|dw•«½¡˜{² vøõí¿è54„~l˜™JÒÁ÷Ù¤GW3#˜LüXO¤ÿ,})Ê‡Ci \K´y€¸¬Kž@déÞ%ÕŒ–w©UÈñcdžŸx½«†nŸ•70ä¹›àBÏö|ž4’ò‚•c;µVH†PùýE¥8¸ÍÉ‡fN*<¢µƒ!ªñ°Ç:"¿ŠŠ{µ,QÓ	©Ü…ùÚ§T+“+¦ýú‹7ûž–„_O#w‘ÕPlþPQÄà¡[$['V-s/¹Z—Lþt<\€Dl«§íK*‰;"ñ³HÖw±t5ƒŽ<¥ç[¼ù 1»7‡G¥¿â"Šã›­J€kâc¬2mãÛÐÛçäÑ-^×·C7X‚hp‘©¯ôæ ‰Nú›·®€˜Ø –ÄPa÷ð‹YA½3Žµ½#ŠE²f Y)*¦¨è${{YTóµ¼ÁoÒvt´¸œæïèf“oŸ9q÷c¶áwov€üáÙ
½¿#m­Á¤Úë±¼n¬;ðë ¦?›J\‡qÐP@ Æz(áËS¿Œæ –p>'ÉöÆt˜!QÓ<ô\VŽÖ‹9\
ú[`oÚ¥iÐ	Ë&H£_ËqAðµ0ô–·Å/¡_m]Öý7Ï0a»¨¯.‰¥Ùƒˆ{Õycò§»	Ž;îm5ByªPRO;ô ¸Bû‚…~dÎîÐQpäÜÃ\±mªtP­ýXÓÈw EecÙèµ–íùÊBÎ>sÖ­aåÁ
MêËB$
×ùýRß¶—X4Øˆ‚7¼AËeóçr‡g¸Òãõ0õˆJÃ¡ydJ|Õ‚ÒéþF¤3,œw	È ´²,Fb7_{<2üLDGëU¯Y1Â°¿}/r%‚i	ˆÚøÏÅ@I€hßº0 YÙù¢Ò+x§åvæîÂ<Þ-
Æå#k&ƒ)Z›øÕë4…‚<Až}‘HW'ÚèØV»Ë
@4Ì+–òÍDèàm±ÐÙm•á|hÈR[¼>^N:IHöäXNOÍú¼:Ú­%/pâƒ6»îÅÃÆs„¦XpS¤Õ
o[‡üÝEÉ….‰/Òœw‹#t·e uàû©×Wªø¿Þ!pÈI6UBŸr­ÈÿÍ ‰¨íy­¬áUiÀ8{á…Ï‹øaLõÉëißgãy%% ´Ç/1Æ«DG§Ãz4è}Ñ÷@ÕKaïè[2¸7G{1õÅ¾ ÷f™ÉnÜÿÎ!¿qª˜cÅþ%¥*a¾¦±r£EÎÎÜ'{W•%‡þ*tÒ¡H~à\.Ui¥rÙÿ\c€‘xŸâ„±I•ðÙM¤òcÛg­ø†\KÙÝÿA­O¢àF…ÍEg rÑ·¶¼K“azMìªž©—?°§M\	+ÅU- 6%=ÒZâéù
v\.˜k´Ÿß ïOA}·ª² CZ´šÑnoó´n¼£@[73[oU4Ø¦`¸Ò‹•3%p¤›xYõ¨‡yv¡ƒ|#ån÷ý{ëHfÑ²¥³¼LúhuÈÔ­˜±…Ôò¾èp¡ÔÇ-©y¾;ß:¿–A8üÖ™â‰èVÞºûjl'ß{òq*Ãã=‚tŠ/µ‚èZ3“h“ecP%%Õ<w‹
H§òÞxàÿzm‹#º‘p;
.™¹øÚ±š’=ð’sê†¹² Z2·A’r1KÉèkïLè›³5Qb¶d àûYÚ«#<³9šˆ¡ùÙÕ—‰³áczNø´¦–ÅÙTSQâÊx8êÈ{´P÷ßòkã!ã[Pw#}ß*a¦Ël›‹Í8ý.TGÌèx»ŒlBè[á¤»/>(¿ZÐ1ôk¬µUÑ—cr\	½@|nô„ÕÖìz©BùRÜÎÒ\’ ûoï[_²"<’F[;ÌlÒ÷ÄŒ/®ç~„Ôá¹’’ºÕè‹g5sÜdÆv#ŸÅ"w®uK[—7Sä²ßRdü½ãÌï¬¶²®+U>Õ(Á‡xYxhó–.;Ã-ý*Ç/ÊQ}ûi¶æóïzULuâÔì°‹ªîÛ|·?9UÍŒxI„0]M6ßÑ©J§éµAy‘»F)¿w²6ÏãÆãx«€1B*ëÀjÐrHGã'?ó¢Ü]éµŠ·Ìžl±U[ä1°ù÷OàHt&l ¾5.ïJ|³n9Òt“šÖ·ÑèÀ~1ÿ€o"ˆ¡<£—–ô;²”%ÎÆXÈ’Ã­œ­.íZË{¢Š¸›?*‡ÓÌb”WåÄ›v¾Á¡p*éY†R­>AàZ5][O+âÉ”Ê ‚çW¦6Ü›ÝÊ:¢®¹¿VÛöaÌÇýKêúÔ¦,d¶leˆˆ»{–ì&üè%µ±Ôú÷˜YtR2­{ÂÂµi)¯$»sçæ„É)²#PÖÞhß4LÙçp+¿ý˜c±Y8ä€Æ²tp×-osŠCqP8åç«S¤Qt‚¿Æc¢‚»#…cæ²~ûÏKQý·†Z@GHgkÀaªåðaŸí‰°8´˜sw'³®]µEª¥$"š½ÆÛzå³1b¸‚±ÚbíÒ_\¼x‰ì|’:_f —+>¬âøUK¾`ËAú—éö–ËÈð¢ ´ÖyŠïõDèD„’70$çÒÇ™I:a<	¿ˆµÂÝ„öV,nVsý7U³Hµ™VŽø[›Ò¥£ŽèE[Pn˜Ëß"VyC‹µ£=!£Mìµçx|
-?{±$¾Ý¹wÑ}ñH4w±µ7ëî¼„¢¹°èÈÕDõt]9SPêpƒÎˆNb]ª³F)Ñ´2¦V,æ† ]xŒºiEÌsø²½q~KZ]äæ¬Ôß™¼0zÒÉO®‘³{¦¸mã›Ä¿9])­Uª¢Ë¬j²‹M5.‹È¸Û	1û!f–s†¥£ß_n§ú;+»%¶·ÀN®Â«$•`½ˆÀµØgP)[UWoô{j'Y#(»(€ÞO'ªxZµˆê‘ñCšåh
ÏBÕiêˆš¥’ÜgÑö8üùC0€òo Åƒ FÑ¹”'Çàág¸§B€}uçƒÛ>–@–Êk,ë‹Ê(L’ûý„?joÔaôcC=ø öã‘\öAÁRwk\v}lMØDŠ}Þ°3¤Ž§uUò/€n·_@½-áæÃóGzçJ-w&v„2Þ„¢Y‰¼©t„1¢S^»G†îqòäiís®«þs@n‡£>’¥_tE'?Er¯±^ò¸u«æ ¿¾£ùµ:bhkBwÇ˜ƒV©%y¦˜™W³qsÉJóÄ§oÔ	é§Æ©ñ'ŸC™mÃÉœðP{ØÛ`N›ôšÖcó}Áó‡r¹©–ªzûq n^Ä¥ü–RÆŽl Ç¤SMJ/ü„Á×È=žÇJÆGûÇ â_¾›Éù Ïi…%A¦‚à4¦Ð½¹µâSªqGµTòMpèäXRi¸’@ŒP'-Å>!qNådàÙ3õX¿;£UÒ_Ø¾=¼NÛäz´N¼Wr‘2ã4aºßéEP“É)Êf2wåCUat	¯ypÁ»–L¬ù3ƒÀggS*2fað5«ç´âÒ¹àÙ½£+è5ÅC²•˜\EŸ9€œÊZËŠä2XÒª7÷„I&6nø°êsÿ%žy•Z)LŽtã bNä?ÿßÉ­	‡âÒt€Œ¸Xòq7HöÄ5#øÛ§Ü¥¥lrk\7ühÕÀ®Í,r­W²´%müN6ò±C¸z­'çßÏÝMØ±_ô»ÀR¢ÊFÂÉNz]åEÇˆÆÇ'|Féæ]Â/ ~ÆvêÿØZ€y)¬»•é)ƒ¡W¬È¶Ì&^ý]nGè…Ä¬’{Þ5ŠÝÁÉ…éÎ°JZA”¾À‰„Þ¦sÖÎ ˜Vo¢Ï·L")ùMÃõaáü¸/qßFàNJ•À7”dáåû¬^Îž	Ã«zçqßé‹ü<pŠ—Ò4/ªÍ.$®³JµBûÅßü›û<Ï:æ¨±õO <YµÂ¨æÈêpÊ‡¼¯ …me#gFS¹Ë6õ¨å+©ÿŠñøÛ´ °ŠŽÌšd-Imž½¢š9@¼síDk…—ú7ÑÀ´AžvVËX3 ×]ï#k“cEY•x*ØÎåM©Pƒ.6Ò^Mq=pâæÞ{çAÇÉ FdS›oc3“Ó-EÖÏñÊý‹éN­ØàDãnñ¨%þû>‹ü Ô›lë5Õö(ä9~`ßàØ\~[î6•8pt©!ó»Ó:þ‚)bò¼òuãÁjR1Œ\Ag1Gapøf3œüZŠ‚å¶‡a<e!h9Whgáú…ès¤$—´µh2È·(BaÜFnN¨S´{¤%Å¨·¶škÎ”ÀîÄ‡Kò'W%¢ê¼2ÛvÞ^Öà`Ú©´Av×V˜÷/e»’&/HDÀoÕ’ž…‹êˆ/CÊ\¡N™ÁÀý@º¶çReÍ³`˜*PâŸ'ÐùÉ/Z"S‡Yóm½nÁõ!Óúe=Ø¶œ\ækr9jÉfŠîCž'õúÆFþ× é8¿Îéx…Ž‚ßjÂ¢½âaä™ý=2ùÉtÙ…ª·Ó£0Šäý{X¶ˆ5 úd[%SXØ¢V*	}XpµTZ†šýS°ÚChîVå¢Ê¢Ÿš¢¼²7I²ìj ù?•™öFY÷ï÷ù]Â3Ó©"™ÍÀ×-Û
Ä…k"
Açt…zt‚\Ô}tÍŽðÐ_§ÙˆžªÌ|On¤Íµ¯ÁüU;€fGö õ5½$6IãŽCÓ­ÃÔ.¡°ÖØ]-ÑÉ;T’-Ã–“±,&Z`jÍòqYº¸¬ÃTÕ1³ÖŒäçŠ5±#µdÞãž%YVÙ˜Ò(1hˆø–„.Êƒ</^Ú¹¦™/®a‘…Á¥zý€+3Æ'í<»û°_3l’¦òÆšT3ƒbŸÌ¼*,ë“i¸‡ö	÷± “FLLJXoÍ ™®1±£Ä´ñ¶Þe©Ï¯Eè…ÿÄ7¶ÚøÝÃRì}3’¢!ó¿m‹ãÝpø_ÓƒCàõàj‚ä¬ZnŽßdm7ÿ+úÓ —%©VD–Xp3†í9¿4p¡ëÆ¬*´L9JÈ@ë7xAs>ÕÃØÕA	©A-·çbæ÷î”·ä(i…ÔkÍv~9vÁê†¿³ÆV”ç{€BÙO±/só÷-eŒ³ýñZ¥Dßó¾2xàÓÄ±êþGãDè%åADoòº< Uùë[Vø¬„8—«i»}_Wå"ÖØ€ª T÷®›ôÃ=!‹	¢d!ÂÎÝ?N0hs~{È»=B;’MÌò²ÜD/‡mrP(q1Þ aõ
+ã¦{æà²´âWa×¨ÄÞ3 f‹Û¨~ d3õ|mñÜ–™ªf1mÙ›Syˆ b.(O8\h¹ùõ“´áÈ}†á¦¶+.ôl.=Ô¨êÂ—­Ÿ­Ý	6hÖ*]÷‚0,DB>a®¢5$âb²«C•‚<E¢a4©%Ý`Â±1yhí%õæ-žmRÞ™Ö1‡ó<50!ôïøP_¨´h`ØÂûË‡½wÕ?,‘W±8¢·àO
ZÖeØ¬;ZŽ«¼—Ì?•ðGÞž]2„B@­2p1É¤èÆ·íkk‘®i²r5Yf¯k~êØõhnT%Z©]Ã_¢% þSò1w—ÂñàSÞ¨Ñ3—æ‘Ï(­m†óëS¨\ú©©Cw³sPG½Q¼šôtqqd7h
ý¡‚£ZØTÅRŸ‹5ca½"¯j´VD3ŒÅvB²¡F/ølŸ. ö8v}Y£ùø*_Ý}ãmÑsµeÕKP™Ždo1$¿Õò7D½ÅÈùó†}nÝ +Ï^l¿Ñ3ÑèŒ*Dª>ÚøºŒOÚ¹¯#™Òâ0>4½ï%ÔƒUà°C½Wñ«ž	ï¡ÑHÜvR²Ó–-p–mÔ Y/›†3ß– 1Ç[Tì€l	¤IÚº·¹î6«dÜ®î²¼½B5§kw\C7 Þ«¬\Z×T\ßû¯rñ¯ÿs…"Ž1Œ'ÀƒÈº.E˜<%œ½¯}¶q §ÍÛñJ{H0W(g<ôÌ¨ºî·çÙ†˜&e Ñ	ÇÄÜQMw¶;£Í
qyê°Û\ÂÂQ+ox?/RéKëÃÑ‹¶péœõcbm	¹†$šoÒíÀ=¾]‚ª¯®ê®’[ênûôpÂö\& üøQì$…ëËùè{ÚÜÁëíŸéz˜ôœAôÔ"Šv;ð±G*,²³æN´Á]KÀK\6ññÞ &Ì|ÔËûe‘?[b&ˆ¬•zéu± ðôèFÐŒ!*‡kø!
‚ôegß=Jÿ¡Å»šWžÓÅyÂõuôÊÑKeÃ¸/B±l&~èý+fy¿”'ß^YdE,kÚg¨ýõa'¬¬³:Q-‹ª]jÌú©Z;x¹j·°í“1œ,›¶ýÁùÚÑ«8­â?ÔV1RûP:¥Ž¾uµ})‡g”ÄÑ’tú ¼0Vý)•™žïºÚ[â£·ŠmmÖV7®(í!r*2¦_0H+c7+’y©.Ò½Y ¥ìfŽ$?Å^]å:­¿&rò/
~•L¬ÓËŠù>v²=3c4uxñÂéâÜ	V‚[™åx“\XYõˆvp ×5M<-†"¤‰ÿZ} šËºþv£j"ÜÆÃ¾o~ƒ”þ¥_Õá87¾vúPÈÛ´”R¹æØÊÞ±Ñ›êQAW6dmkÖ0âì‡"Ðßii6ˆ¢
}›âK¬dÅ¡vBQ¸ýñ³ÄX<uól=ÉXq™uGP#»é®µI¹[Fo@+¦ë¶J†O±g¥ÑÁ@|_ß/ÐCêKr«unâ¥¬êx„ïÛ,þ	¢]ô¢§/M©€'_Ø,ÕKj˜™4Rú™Ú4­¿NläLçÀb;X>Ô’–‡LvÑî(öÚ˜ÅPš Sj±¶ÄC&Óf:† _äEº¬¸p~~‘QmdWR/>bŠuÉ­íBò{Rk©ðÇPä½§h®ç …#}­MêËÍ®¡òà«G°(˜X¨^†â¦íQ-€·‹sYM6’dDß·×¨a^JÞuìŸq”òíìÁÄø?øØôŠå!
ØIÍy#{æ5ïø:‡·‡ØÏ%æ’ß$ö;Ç­œôŽ:œü©Ã?l¤h8ŸrÀ1°~¿äçË¾¸z@ˆÃ%”“3‘‹H5è†¹…MJÏ’ƒbðÀúbZ*cŠÍqEtdí¯;ÈÎô|è	CÊ&y·Ò†~!NïjîÀãOù‡ßŸb;Bfj²+4;»;Â«i“••§ÑTbß/ñÛ7ñª2[Ñhð%—jh‰ªJ8ºëµ›:“u/~þ3åYâ3Ý/]¿gI™ZáØ•¿y îq Lí¬Þ;»Ÿ5]Û»8‹ŠZr„¦óo`ŽÀ\|šú‡$Ÿ4È–xK‹÷$J“`ÉÓZŸ¨³M[-Äb¹¡“—o•_;},U4r$¡M\5r±6û.;1ãïÌkŸ˜ì¬uÎ¡3ˆaüÚ‰û/hß*:éå‡ìN«Ñw ËïbŒB³+û ‰ï¾ìµy³Å;¤Û[Òcø\YZA³«s \ëHÙÁO±rgÃÎŸ^Þæú^x"tO&Ñ’'˜ióx…‚l‡ÂdÞÓ7|æíæïô eR„[ç®¼Sü(|>Ä'e6[¶·èëÅ›nà§C»ÉîA÷É€† 1›íUb´½*º{Ÿ¥®d$úŽ.4L‹¨ŠÿéÑ-3h	TÔ'²Cýã^YN@_jš=Aýý«Œ\:Or¶j¨»Ô&Ê")ë¥:™œ™¨L™µ*±¤M¨ˆääûI‚4…Tµm»mk:­´m}¼Sû—Í5-½cŠ³ÑEauÏ³—Áù4Ê@X))­¯3%{?ÜGûóùÊöw´&r¨ªQM-î¬vêH¿N÷‚4ßrÀ0ì÷=’^Þ·9òs­ö’¦ùu¯‘"ôÖµ®[Øï°±%Úrk^æ• Nòô}lYŠbÊ|Ê3šÃÏéÚ¶¦yÔ­hHà\aM~È ÿ:·¢5æøB¤ˆr5fˆÌ™’uŸ­Õq5#ÿ[]ç"¬hl„¾œw`+MµT	4ÖE¿+XÙ¤¥AØ@Ÿa28•_mYBUwz!±ÝûŽlÖ)ŠGÃ™õÿ]ÜH§D…6áêœåªÈ=àc†XÍ5Ryªš¸¿ã|ÈGMÊÕÆÖCãP¤"´a].Ã©ŒésÆÖ¤M•çêbKÊa7ìƒ•fØæLÄ|Õ¸‹µgÃa+¸OòŸUUx‰ã¢ A/ð8¢>cZ”ÌŽ^qðÑaB†¹N
Ò`{Æ¦ ¦±ÀH‹q'í’(¤uÊßÜMMý†¹À®˜3ª÷8-–4¿ðÕÈídÉ${.¾¬ð%ULXí”Q4 [ÈîYîAWt:Ü°;|c‚Ð1QÆƒWýjzàó¸zÉà¤š//Í›SÕü¹â…“Vö@—ˆÞYtÄDQTxçô³¤ü·ñæ ÃNr!RÛYîêYŽ`×ÿiï’h-5v¾Ç^µÈÊ‰ ¬s\¸í¿öŸÄïnoáŠ€Ð«ûsr€¢”E´x|¬Ó4¾ "€îüyé’ÉáX«1M•qÖQHØy@\Î™þåõí* PóÂS’åMöx¯ˆïüžõfþ•èMT®âÉ—Â}©ãK(¢‰‹ö}KïiÚÄ»¦JÒÞ‘e…H˜(Ì,
*TÙªuD8¥”ðÌãPn?²‡oîSè¹·rýË}ª o]ÈL^¶ÛÙUÒ‡GáVóòï{Uš0iJŒ³6=µf«~IþöíØH+öôÌ¦	IÓ£!’ç&–ÆèÛÁÍ±ˆtCfÄLøf¯ËùU¢b£¬#_ØáÞdÖ`Ä÷¨æx	ÐõÝò¦†ô(i3àO‡Ts<”w‚„)=H‹êþú«®²§³ ™-i)5¼ó@ƒ-q=VˆÕÇQy‘%¾r^êHÀ"ãiFë´ª…IÅðQ»qOU™{$yø:/×Æ’‹ÇvšÆÎÞ•%ˆKØÊ­Îh[#ÝB¬’Ü­JcÀ¬.ÒV³7T*C66v†xÏ^¶›_Ž´È´~EMŽ´›ÏÞ,ûçC§Øv0ÀËú‚Œë_Û‰`S-†Úñ	¦\Ú¤zý‹]‚ À$÷Wƒv˜È•c^hTb9¨…Ô
6ðº¬.ÿj×ZËòš”RšÚDïèªØùÉÄálßEâ?vò“õæFÞGÛ#.T8† 8ægK¯©éWÉÅ¹Ü§òè¬f‰òiAÇE|h´-3Çú…Àôç´ô¾Í‚ŽZÍAªUTX~ÂÆßlÂÇv>ÂÈê	"Œ#Â,ÍØ2MëzØK!…tÛáè.¶TŽ
£eö©D_‡¥•S!—'•‡Ï…ØðŒ«ª—@o‡#”³M+7/@5S/ñ‚ÆÊ×Ø%}ÅûdÕø¸&æ‹ùy÷˜ò‰FWMA´k3á ¯Ÿ>t]ÏykÝÊ£Z:™™ÆË_î éÝ;<#õeLæ?YÓOê²YowG<S¯â³ªK’i(Å6}^‰8·B(™=Gi´KÏÙ§Æ³hûúúŽIÈ´öûïX.æÆ»/‡qÚÉð"u®ø-øZ·›æÜ1•É#®˜¡ÞYÎß%oÈë”±,ü¿ËhpB~ÀÌdÆYÚJ@ãe›`f7„¯ÀòóE,ß$è[2€[Mæ&	ã~''¹˜›G>¶büP¢ã4ü”¬¾ü¸@?þF5ÂŠ…Då–ä>šÔ@ ­Û¿É/Ðüæ7H–SüMBž‚N««åË’ëŠ²èæ‡íÆ]ë$zyG×‹XÅì´CKñÒ¸¼ÿ7çUmiÀ-P„y˜iué@r#f|æTÜ’d=|ÕÙùÒ¨ÒÙ¥ 8]Fžy\Âé•,$ö<Ò‰&â£»UÄJàôæ½VãwîÙlÆÃÚí“^¼Ë+š9Í×6vÓÿ­—Ò©z;]B[n÷6×•sËNÇaÄ_7|É-*5·?DaÉ¹_Ð’Þ³Vž²ÚšËùÎj@ÏcÎ%?ZÅ4ñ½Ñ’ã¾èÔp:|ùµXˆŸUjç+*öhñDU`¼Ð»ÍŸï@_ëÍPÚâdÄ‡ã‡ðˆääh«®X|IçýdÉZËôßðß9æ¡	- ÝËÇ	Õprbñ‰ýÛcs€G9H¡,üAßÖ\¾ß¾²Ì&X¬¨IŸPn}É«©+.RÔ‰åp‹Š;™¸€v&¯!í»Öù¨“°ð»™d(µöœìJ‹'”ìjÜŽ!½ž¯4œ 6ÞNÿ†!;nêæ‡ËG‘&À0^Î}…÷í–+ ”â—<T?lø;Y´úUë´§¥›Ð‰–Urìt+˜¹ŽåŽµ>“ßì¨VC#eòVh3Zy·ÊÙ,Áô‘†Py86e‚+ÓCÚYïcšgï`e·ûù7—59"ÊsÆX·ZÓV¹ÃFyãCÚ…_:@‡ê0¡ƒ‘ãt™ZŒË&þ”é;.`ilÅ¨	˜EÁ²Ðš#¨µÄö/}ÀÖÙß^4ý}J†þHsº-E×`jg‹å/Žz@|rÉô™ïÜÆ¢Í8ªúŽb>pG$á!¢+Ê\pIc9‡TOD”Ÿ«ÕlÛ	D”9†Î4}qQ‚Ü7Ã@fl¬·#‘Îè¼ƒàž$êqÐ? /‰Å2aëÝr$.’[r6à(O7Þš !Xy-mGrí€J]œ«Hk»ü•ª–Ñ{;Õ1äƒ¿1TNš@’BðãÂ¼ùo,ºlñ‡®<]p2ß2%:HRÿ«ä&ý
~[ä2z=«¢yÏYµM­ŒvC––at5
ð®ô,â½pWÕž¨Ú¡õá#Ò>›×9¦A³¬ êQúJŸDåÕË&:«’-c‘aÂævD¢»æX>mqC7üp§¸‹Ðl~ À[Z\ó';´§ñÚSo*^÷ü”Â5x¨„.@I @Ù|·ò”u6˜@{ç(‚TÒœ’B4²ço¥H…l;¾Ùôª4êà±fë÷MÜµpT»UDËÓ` Î¦$½{JX;°ÇfC"¬”ûó3&ª¸–
®Kø‹¿ßÈ–åÅ\:nÀÓ;ÉMëtž¡K$ÜxM^k$"ßï­†VsËeæaLŸHs9Õº?BhïN¶äXlG!ãÅGxzÅ
<Én«ðmÕ¼fÃµ_1™òÔ1D´ÏxþØkYárnZ¿]zËIw+ÙaŒÎvZÒN4‘.á§`<¡S¯Y÷Ê‘/”ŒcöTµßT°Cº`²ˆ81D–êîŸ-eš÷Ã 1ï·ÕŠBR‘›ÛFjqzŽ$f91jl¦}±%«Ûx{
öØŒ7%‚¬¿ŽŸCN¬{“PŽ%¸œ?hkkñ·Põ–,[œÒlôœïÙQhBO¯ÚSÐ	^[},Ã+¬i‘j@h
Œò¤ÂN+@ŒÇ‘d¾“yÃÆrXhi$ Z54 ß÷ZMEK]l…¤âº¨ ><9¹Q¨ÌãÓþôªŠ®³TbiŸÀµ)7ÔÐÕÿ¨ÿ¼V/r@¸-E—æÔÂ…È:#@auV<†˜åÐk³þIEÝ8+L<Ê9ü¥VVUXP^®þŠ»}À?½¦Š÷A¬2-ÕuZÂYœÏP!À—””¬†¸·xæ:Ð”sy‰:ß’jþ]HYÉßPáAð6|åÙ,ñÐg 2‰òíomzs4Ð}ÑxÓ$1â—Î	å†
»ž)N2ÝœKW±ö²náŽ ›s@7JDP§¤Äì…Â2)!²@ú¥çª e¼_”á`ŠX¼Ù£.Áês[Ç±Âß±jÎZKas×Kpç!»éI†*ü“+†‚HÌS—xsý£04Ð*âboP IUA.øv”‚Íä†'Õ­Å Vvq 6ÌÃ%á‚½åw“¼ûèµsW	p“WãÖ`,&ÏŠ?ØFPÓ¤š›Û~=jNÌÝ)¶éì)ZLZX"½[ŸûÚ_Fo³É7Ã=¢âDËRâ@Iox™ÉHèûûh„¹ÿ“Ã•At¡¹‚òsªüÐ1Ç<|^ëöf‰J4&ôä1J¼Ø²çˆHaš‚’nzÅ€4ï­Ey³}ý;é”W|0%dÀ åÝt	-ãç‰ïXQ1¼å–2ÔÛcºáÝ„Ñ|¦_º'Aõ{¦*ÊÍ¯)Ñô˜âÔl}rý)*XµÿóÆ÷Aò!äÇÊkž#ªÇÊ.bžN1®u‚dÐÍ?C³Å)ÉòÒrÓº.íõ©“…—ú3Òœõüy*€2^;Ø[™ã£¸b´ðñÖ¯¿geÖbÛèÝÕ%³@“…&Ô¯¸Ž¶™¾k)¾yˆbþ™æD†{Sj”|zæÄQN´“M@Ë[±û?>Âæ†¨m¤ºN¦/@e÷‘ßbf³"éæ¡¤7s*Ãî‘î¾û ²Í“Ø¸MÛø3Ÿ”wõÊX¹¸|Hž#]´‡ ÕC+›4PþÑAm&4Yp›®x4Š s.“¹»
F§ÒþÅ#’æX˜$v$cM:ŠÈ+¯#½ BìéÊ6Uü|V1vŽ5­ê·Wa¦ËZþÔŒÅ¬¡ª$'õXmê„žÊ>ÔWY§ÜÀ£åÏ§8Ò)«ão Ž÷D˜¹Ù®¦½	%ª¯9…}ZAýƒØM+@ÍÔ¶òÀØˆ‹öw¯SdE­>Mé‹uL|`€ŽÏvÛ‚D-l¯\Ìöþ½³»ÂÈÆ%a+’ÞÆÌÊ¼‡¬ò†ÎHÍð½mîÒ&RÏdSÔN½D¤Ë¤´—7ì­'œd¹gTjé† å^ú(Å€ŸO—âªR-ÑÚ|}¼ÌaÀ{ägýº¦ü–2NÊI¢Æ¾õ\­¼4ló
ßðÑvèE»‘"b(Ý?`ÔDþ94sk†iÞÅ3°Èb<»}±ÅÖ•ä.þr6{D1¤éu„ï4.èç§ÂO}mØ˜NSn´Ë¥Æj„‡gIM·rÇw›0’Òrý&f±v„d(Í°‹›Å­8Rñ/¤ºØ&0½ w¯]ï!ELä©½à£ë,kf\Ru6#>MíÝŠ óf…¨u:²}µØ1!^Ý?æp2!Ð½Ø5ôWænà¹bùoB%Ëõ÷É4n#Ê’æ½X«eº;¦¸©nUäK°öÙv„#;²ùx.Ÿ^Ÿ/v»ƒÇI’Cµxµl³öt½âkYAöžQ•ïME$mÌ_Iép“aýk™jŒò#¾é"d,u3©/µúçŽKd>Ôv¯YfØ–°+*0âÂúéQÿja
Î G)GˆJµ÷ôš˜Xmâ€o™¼8úTž·Ö®ìÅ·–®ïo˜6sÎžÖ˜Îâs†²-^m¶–CI?m]íìµO¯‡<WRQöÑl	ö›#ì·Âº2•«\ö«ðÈ°ôð:ãbç_;
°»—|Y†ÑÛåŸ·<ãVœÁßªQSÙ‚ï­[q-oNÚ”ój66ö¿›h­ñCP«ÓmíG(ù:Ó¸º• Ê&»ë¹Ãº²p"š¡´µÝä…¼ç&1 ^¡<WkÝlO.³Ÿ\0åÁ&®pæº?zÛÄ˜R˜.W0u•9…0"28@Î&ñŽÿï\%Ebb¨Ð¤ZÎsC¿”¤â!Ž¿r->§ÄtzÔ~>Óƒ—,Ÿí»úã•Õc%ÇÑ¡`ÙB­Ð ÐªT±n‚¦ø}ñ{áÑol[e•	FCn©¬jˆî?=u¸-*%ÓØÌðŒ±íÙ**ºZ½ëJ	ÄÍŽé=”Ã&¾³KÇ¬"Z¸rùDÖ`HËvª‡¬kÎ:ßÖn0~ë˜?µeúJ–p'Àæ•HÑî§=¯F|èz‡'¿äÕÁÏéo¬9›5 ¦Èi‘5_;¿è-PwK&ÄÔfìý¬òwí6gJŸKDŽ<F+bÖ”íîÚ9º3ç’xŠ&ãxmcyzitnš1ýa`‰U‹ö8r<êÛb®ÜEþ6Iãß'9ämô¥B(Br©Áf¤µ*Oÿ…¢j’Ê_>ÖÿrŠÇ…üª‹«¸ÈiWç?Ðï†•Ëp –+î 8lÄðO¡/ìQ#ê>a)ŒCšÂ_ÁÖ\ÞöÖEß¢0[û"k¡"}6(PÀÖÇ¶“…6Î|§?ë9(W‰¼ª:õÕôÁ±Éˆ—òž=J$lø²Êž_¯>äuÚ£¤‚’ì¥ê	^Q´rëmÑ•jS<Lû	·ðùñÃSØd•wí­»'~$ÞO¹ýz ó´çv9íÅ\oñ(Øùùà²ËíIË”î}»©ßx¸üq˜^|RÒ†!Ëg‹Ë$Q}&ÝÛe:¨¨+ø=Cî4-D©¼Š“j µ	$óÙÏ´áqÁI³7×d„4Ó«€o¹·Hœu½Hîz£˜	_bkÉØÅ®Ì“ÈÄÎžÅÞ= °ÆîZçÅÊpã+h…ø8K‚ä«)d¬«Q"Áàp‹[ÓQºÜÀ3šW>íÀKM3Ÿ·Ôå˜¥ÊwodÊ/41,oµ Õd\«$Ÿ•zŽNJž«Ç×›Õ%¶Œ? ¢¸˜&Ãh´OÿÄøÉèÍXíµéîÄM
nf¨“gîJòXâ@˜ý^a¤¾	x	‚á+Ì¨[1‰Ú	ÝË“¨òáUÝEõ9öŽÖ*Y³°+bš¢¹ˆw&³<„WYHö^¹Â³
mL´<ŽO.~œíå•áÐ¤“©Õ¢–wåPkÂãF”«“ ¡„ì?Ì-¯‰ÛþYš©ƒ¶åžù=œþmbù'š[ÿÂú“liIšQ—%5QnL›íŒ?Ôà×+ÌpG
>€Ñ¾ƒ?Ò¸ 5u#ô=.†=FAƒÌV-]ˆ%ÂðæÑ£’•Òµœ›ýÊÒáP\å8œ	Àì4Ûy2^ù©OØåžûÔáPÕf†3È±0JÏÌœü£ë·˜­y±°´?„l1núÃhÁ5_;ªDu½½ãb.aŽŠgßC0s©Äb¥UCoà4 $X¦#xç…‡8ëb_›åùp×œô)”×_n?wå· ~ü}¯‡žP9§Ü³[ºídÝÃ¯RldšÔ²^õÉ/ºÜ‡C“¼XkFŠ^{3À©}åNÀä+Cžô,xÙMË¬À‹È+ŒX½ZÊþXÌ~²ŽÁÔWÏŸáüPTM6Ð…dsõÌ<GÉkíTšaÎìtìRQp« ÜHª¸®#’Dµ»ö—¼`VÄçÿ¹NoBo´AÑÊVi:ç¦ûK3Ã¯ümK4ÛÀú§	~€ð¿ÏÏIQšôÛæIžÄa-'ØÞ¬¶KE™×Þp¯Ç«F§pÏM* 8–©„Œ6ß•å\¹è”OÑŠ\“–²4gT=´B1˜úµ0;©Ž¦vmùŠ{XXgaú°ñà°Õþ½f¡Ä/ |ð½Èå¯{º&o"Ärîz¨‚œk˜ß|`Ù#ÌÛž‹QViqÔ¦ˆôz±ûc"ã5dlÁÍZ¡4ŠX†ƒ‡=u‰\É³¾öÃ	zFÙðKu[è$­ª6bçÀ¿'ƒ„Z(ßÔ1ãfäò¨¬A•ÖEö%^“ý´ù™{ƒ>‚EL£±ü§ A6·Ó¼9ÀÕ!öûe†BZ·tðXŸ*YëÈÛ:5¬p3§EË†ÖÄrTÜå…dnÅJ<B3ó­½ùâÚ×¹öåM°QàçÞ•¬š˜›z›àRe,Œ_õë”¨‚~CÕz`¬sGÃ6ÑÙ@¦\yôt.+_ÞÐÍ;¤ê5
"SÐSÞ§Â´ô@Òð L¥j)LÄ3Uy=p5éùn‰,ÒUèL¤[Té5úòÜÄóŸmè`ŸÞÂ
%¿è]ØëÔnˆ’xbæœç}"òG=kEåàä	5©4ê=²ÆT8m©¹ø‘S¿kòeÉxºì)!™ä¨õ]Ž•¹¡\nvõ°À@‹Õ\	ÿó…eÝÁ&ÂryÂ«xÍ^>*Ãé9 ƒM³2WUßJˆ’¡Êè˜0à-ŸTY-ÍaÂEBw“Œõ°Ð:|š±„†÷9´ôBfO g
PtNÂ&ÏØ²›mk8Ïóù*b§vK³BöÚ‹Žg6øòïg9@Nõ•ßU{1Ÿœ ã¥-U÷·¤é‡*u±õFdœõMÿÇÉã"ö«¸·´Ï,<|/K÷V¹"Ä—JI~Ä¼:e¾n{á(€šÂÞvÔÅ<d?'‰.]©ˆýj™(‰Ù}Vy	×½Æ¥Íƒ|ÖÇ„ª›¸þ©õºoUÈ#áA´ÒDR‡ï¶8v—öÂñ®ÿ.îS_‹r•ãYÈþâ6OQƒØóŒ¼ö2µ¨’”bkVÙw`°P—¢(éuzo}.!8]ÿGýYN[Ùî‰:àdŽØº…@
¶Æò¾”(ä}!By —ø”¸Ùµš#¼'ËAÃöd¯4¾#á«ü)83­Ø?­?¶›¶üú¬îå±†Ù£âxf¨¹SúG¤©Cqí§Tà(SãŸ¼å«HK´v²Ä˜&ž[ûüXÊˆ5¡mˆ ! ¨CìqoA‘CÈúVéîGíx*)´béB¼ÃoÙPŸåNCmDQë¤›.iŠ^ý^LÃaØ´“„YŸl9i¶Tkƒ>
ªÿ×À‹ßxiAëÄZ•å. KN×·ldÃ8Æz­Ô¼Ö?]Bˆ½²@ÒÜ„–·‘Á Wé§E ðE|þl¾ïá_äSgZeŠïú¨ê@ãŽe°³xÎš‹)k¾n¼ß“³A™ÂqømÜJXûÓìZ¢Û Z 2Õ/\˜ä/¶Æ™ÜÏ'Ì<6F¯]‰¾’.zÙJy×+eSŒVŽõ5Ú»Û•–×îhH£¥Ãûu6vé½6ýÖòžuIF™O•M±¨IQ ÷~md©—pÅºŸ3†–êÿËD„S7F•µ”XîáÏÜÔ*•	jÇÏÉDå¥':Pu¹Adv	¤1þ!ûcü±T$×Ç?ýavG	íêkþ°R´¥æÐ&Cz_2!§-[÷¥c—B†,{YOßs¹×Ué	BOqÕð%àšŠJ~H´Zz:CÈ¹€`y³Mè^èéHg¹$e‰;±»Sd»
xœÑô‚€â±Ã*kH‚Ø¹VP2Ã~-ñõFÔ¼”èà:Âç·ûV$×ãšÂ’é.c˜ZëÃ’È5qVàv.eKmð‘¸¡Ž \¹­><©äã4Àêý“ÓKt©Bÿ¹G´+Ü·Ÿéüz¸§Qªu? ªîáˆî¾ÐÄå/ÏÊu¥Ì‡¬ÔZa$“]Éabqüì.•×éåb·|2½¨šŠŒ+ŒuëÖ‚ÜZæ•<Ë@ÌúLê¦l²a£É¹N>{U7§š>Ž/”é5z3BÎÕ6£ñ­¸òÓü"—
AðwtÙ}¬b/C'Œü³“õm·4á,}	ØÂƒ!ûQìÜþ¼xñ$ÏÎ=2êMÐ ßP_ez°wY÷‰Ð3ºWy,žEÑäåQ#)ü8…¾jšÑT=ò3Žìú´äÂ»¨ã+þñ‹)ÔÆÛ wâàzîÚTžôIÖnä JØ_g:»å—›.â×ÊíOZµˆå1å=V•/2…+¬{ø¶±±Ý‚¢‡|1ÍXì²ß§oˆãÜT_Ðññ`
µ5zñ	•VpÊT~ád1æ¦µö1îùÒWûz¾Õ7óUW–de|v”wb+ìý|³âÆvœ(±|}šÆáSW(’‡ÕdÙŸGÜlºEšÇà»
n$è7ôdØ Ú%*A¢Gwt¥µ ØWÂB˜b~ùÖ
¨‰¡pDÀ¤µå²ï-¢
Ev‘.`§ùlªÔ™µÝ)‹©í¶×À…V¥ƒRˆ/Àè›¾’y‰¿u˜íÔt	Ù>þúvy:²1Ÿl%S>Î•u9ßaÊG—Å‹°ÎŠËÌÞbÂ0¤K2µ@®QSNúJT}µÐ§ÕxËîÁ³Lyw2^Ñç3%~´Ý€«È<¸ÔÌ”=$J‹Ðz=] ž×N.}W£ ÿö:ùšbƒmÚR‘ÞÐ]·JýžïL”9±—>²×í”_ÀèNç#.®y±qõhO³¯<óq¤ô¹…)€düC5PÎ	àK+ˆx<]¯î)<wmZ×feN[=ñÈöjØƒÐ¸ž(H‚¢ê²F9¥7ýì"i{; Tl³ô1Ýh‰Vìì	ØU4†op6Î¾¹&Ï¨uÓ¸$¸¿jUÚòÑ±•—v²rþC-è¥
¶'Ä KPz pB<1¯"ü‚èÌÑ„o0ëýç>‡J¹iÙ/þ#eƒÀ"£sé b‡ü$zg‡<Å,ÊÚu9qýº×"N£ƒ™Òú+¥kí>Ð~
)YcÉ$<}[ìsFyhþÌ1:Ù!^ðz6ÏG±û8rá:mNÊâT`Õ£Åwˆ}¼xÒ14HÂ²2¤œh~^øÝ’í_ªûæÏÕÖSŽ|Ê&îç:T±µIç²ˆ_ÿ˜¸Ï2|qµg®|Lj&§%~Kî—6WëPLóLÿ™Íx;–Èˆa1ï·i0ŒË¨Ú††€<¥à¥Ý£Û–Ó¢ûÁWàÈšÝ’·ZyIÉØiÛûVÂ®è½¦c¶ï“ºÆQA“#H¾›–7kf,‘Ì–T{Ñ˜Ž«§N˜^Ë6Â‹ºqdF\È\}Bq™½ÓÅžHçøÇP à}šäð§ñÞOldÐ>ÑÉ#XX¬¸‚‡AxöÒÁñ·jÒ×ºKävs„Æ¢ü€Š8LÖ ÛÉO.KÅ MRèvG$+C¿Æ·“¥·cK¹£¾Tú!vá>ùìA©‰“Yéc†¿‚TûIF^7Û|&ÍäÕºGÃº÷)ËÁÒ…Óµ7@ü¼Àn”§ŒµºcÑúæRÒÁÜ>%g½ˆ	C\ü£  m”8ÑÈñGQ¨0	{¦D"HÞåÔ‚xi‚pÝºŽY1†a&óÂc…>XáGKœŸðÚ=Yf<# z°-~á²â0
hã4 ‚¾ÀDz’úZ†¬Áƒ ÞêmüøÛÑdq¿É`è›ÙÄ‘ˆÿ2ÞÍÆÿ.rHDÜŒÁ¿KÀmð’€Íð¹üóÖÕœ<ÃÆ‹®ÖÓQ˜\[2ÆØ”ê^‘Ò©°sÒÀØKbåz;,ŸRG&Q§ÛV‹âö/³á,ûåEpZ:]›'+ðg4ŽC‰BT8È)ús£¨É§t|µs8„\™Ùóµn4£lÕÀ%”6&iRsKfþqüªßÁ1å¦ÐË¤ŒGu%ShÑ÷·»Ì|‹´‘y‘¤æÊè¦Xàvü¾)†”h@µú¼f—È¹É“^âÁXVp,ÏãÓñÀÄfÔYÜû‘Öc·ï¿n;v¾"G6É6âðÒs¿¾(¦Š	å¤1dk´ÖeîÂ3nï»–ÅH¨Ð6³¦m”÷/¢í˜ ¦ƒ*0yMjÔôÞäý0¾ÂÃ.¼ýxcHäÚv…V¼Q@±Ýí…‰˜¤ê^Ù2÷ªø::õ [µ’“»¼p"bÙíÄÍ§òºÌâ¶@ÄuX œ¤÷O´7ù”çU`mŒ
¦.ÿG.·„²E‡°`ð){6·A„T9[Ë)¦…9˜O&µèâ”KP©¤w¤ÃúdÜš¹xDPû?ØÁCŸÆÿ·Ã.ˆCë—Ç÷"BI%“õåý,‹'.1 ³|aGP ,åAy$ê<½7€˜CážfÖ?îæ³3a›±nœ’HSÂù¤€•?*bý-íÜc8›©²SµÖ:é²þ|kü¬Ï•
ë‘#®¿u=g:—5…›çh‰ýµ1éó¤¶Iõ°)%;£î&êÈ5ë5e	8Rë”Ï›ä`4N…*~Ó5¡Fÿ>?FCÖvâ—¶Nzôzs¥gÝê3Ø†¨ýêãÔçºú¬ž8@®¶¥€5>‹NÄ™Õ ¥’¿¨›óØŠÛ×Î'ÿ•c/‘[5[S.þOÈë¦£ìGs^~&h*J™Ö´.­•§Ø«l¼êœù«ÀàÚcÂ3<i“Èñ©†ôF@–!OÊ)W±·|oLp°ž}/\úc‘Éw±¤âfwpþó<XÏýähþ`DÏŒ/Ãì”a’ø*”_è:*·‹Øu«§à…1&À¬ìûôü~ŠÊÔõ¾¬½v#Ý;},$Ì8ç“3vø8ªç‡ÕÍ`I€E?¢Î÷ÚMõ¥¹Á¤•&Òä­vÑý]Ûé(˜7EmGê#3HÏMc O!ñ˜Z°Ã`7S×0TýDåYm Šâí¾9‚ào¬je¼¸¸«FüX«²tEˆ¶(J^’r!ØØ;h‹|ÜL@§ljÌpv5Œyäüv5–è
ýÒtp÷
Â^Ä¾‘ž	·j¹êÒf¨«Í–Ï+Ê¦·È&üË„÷ðã ,1¦«¶&%¥ŒÈ€UBAS¹ú‰©cmY73yEºÀ«ºëÑ%ÇÝ)X´’×s	ÚÁõi“?™*€ûÍúÓ Y¤¤ÙF1¡XîÇýóˆ2’¹5u¦äM íLÎGmÃœ<±Â«“º8Ìò`Ä
NÓ(ø–úVhï„üºâ´?z—Ü¿Ìs¢¡ðÅ>œÚE¿kXFòÛe6< [µÓ¬c…1º~i€ÕØi@ÔeŠugúÁ®j‘GQ ¹tùD°5 ¢lþ’ñê¦ü»©²¹L$©.¦Áç(i]„Xq¶äo2t 9ÍÖ˜*/#Üº7}Û>FEqy¢t4á@'aTKayÕKþ¹%ÓÄ~¬,sÌÃ»gÜJäŠw•´»#ö½ÀðÛ1Í.ræ àÎ<CaZ—¨#˜ñÉºÊÁ…Mÿ²yä…i"‡$ïUq*²¨×ÓŸ,[‘ökòRF˜ÎwÑz™£¼»ê”Õ›å·ô‡3V8¨šÚ¯Iü€.åß2p.qTÌNÆŠ·é$"Eßx´SÑÐOtyC ûÿ"ŒºWcïä'f›I/äˆXví‚]×#Y…íE'_ž§¥£šU¶dñ­ Wèõ´ëä°÷
 Miu‰”¯ŒåLhÂVJ»ºöÃg:œËÔLQnâÈ†é5ÅC—Œ ·Ã²øç;ë¹[½Úlø¬HRºLì%ì"X+^Û	Ì(i]¼1Ðf0Ò~ÙSpÊ+È§X.ýS9 È'¿Ù<L`W±µŽÛª„UÈ‘¤£ãç<¶ŸÞ¥BµAªÏ©AUžöà÷fwPÕ	—7!¹Yµ-ÂUë&­‡þE1àä)Éßx½Ü,4KâÔÚúät<F®½g¾TeæèÕŸiKÁÈ!†ïjC6¼Ktbèsƒ•"”Ù ÁÐçj60›gŠ£ž±Ý­¡—¾*qÄÍt›íÈ¶¡
Ýµ[gÚ;Ö£vÏ5[Ì¬€"Š<êÁK]’O5JÑj„‘’Âò “U4yu@¡ßì,4Ê5ÙÃøñ[,~ÏØieÖÅËŠR¥¤°w]1èÒ\Üôîœ¸7™1J¹_ñ´††F¡¯ Y"È*~„²@
2uªW ÆDÎŒ‡¾®œlÛ›²ê^iyêQnÓik#‰¸¦Bÿ-é‘ßÐˆØ¹µâýu0ãåÈC~*k/¢O5yÎ¸=Î:dÈeYA©%‚§®è€ùK˜{x°DÀ†ß¡531å¢i÷*eÌ]ä9€\ š»—¸‚ð¼ M;¿ð#¹Z45gñÈp¼Sˆ¡]È°ÂQýû}øÐ_k¦P­ÍÓ$÷Ú’§/·ü¸)YMÛUÛór½**i9X5oÀ I·C’N_S!˜Á»~`Û+Î)ÔÚU<ÉÒƒñŒtVÂbhìÝ‡îãôzì¿ÇæC’Ùˆ¹“F›/nÌšH„=[Aêd¿ÏðiÌ¾œŽ`ÆÌ>Å¡ƒøOçÄe?\uõ}G$Zå]!è©aJJT7Fî3‘v˜¶:ñ)JgÑ-‚~Šl%ò=˜>›©álh4õc\—;¼Ct¡^~2x€Ç7—n:ƒ•JÌ
.þ»û'ª!/“ Õþ¼˜ÃÂØpVSíRNëÄØ.˜’ˆ¦btRCè_fó/þðìÎÉr>9Ç¢–ËÇÀ¥áµs"o»àñÄ™ëY].Yv¨XÐD`ÈyÑ]o¦V…®ª©²…®f¤Ã¨…L§ÖâfFu³h”‰ØÄçØ‚?Øc;H]õ€Ä¢ÿ€½s¡îJÇ¤è¿³0¾dáÝo9ò™@ä””™À„™JÉ:»h»tŽ¦ž•å™+»¡~Œ‡´^†,œ	,»ðBaí<v9äÈD<$
kª¢Ç67ÖQé;J„ò€ßw$Ý{Ç—Iò«{q\p"'ÐÃ4ì¸tùÎÿ0eÍÕ-ÂçÕW•bÌ¸{LînæQ¯¡™™ÿb04/g‹ô‹o°#À÷ÅŒ#ˆ˜ë“DÈDLDlË¤µ¨àx¸ì[¯øÛ>÷ÂšÉÙAÚs8Ž˜ëëìsøýÙ‹°eˆ™°›ïµ\ úúc’óx™ ·ô7›·4V_FÉJãPF8J”çÑŠ¡B˜9þ¤³´Ø¸_OžâoëèOvž“Óïc(KFh2þ
€™J¿ô¥s¦»Ç‹&¼jº¤”IÝVO{Móà
P¾²h€ÿ’ÆÜm˜R’‹—ß
§o)‡n8‡6èQö±‰ÏzkŠA¸‹CBgê$KæÍd^~uÚð†¨l@8îgJS/¬¥èNz	lWÝ•]­±Ó rò›a¡æÉgRÚ˜m˜}BlwpÙ´‚¬Ö/zÚ@øŒ´Þ(±ÖýÂ}è7í÷ü£—þŸ«ç¯VØžÅÏ°€J¿ûØƒ7"X¼Y©uWwµŽ¦ðZ÷¹.U¡›¡§U‚Eò³t¿Ý`žã”_ÇGîSÙO)ˆ¯ŒÖ5ÞñßþB Âû-óE{]sÊe4õœ*I(î‘=RPì4ˆ^¤uÈÌ‚HÚf7vûŠLâ”±˜™*W	“Åv)ÚyÛÆ«ÊF©|
¹xPj¬õQ1è™Çã;º3Ù&ó:>ÅÀy†Ùäyfý2;
þ)M0—lÏüTá3Åíg†Ø:_~îl/ˆÖ.ÛEˆí™!Ä?îDl”¬©Ö0Å$)Y;"£¿µ2ZÙ¨Ÿ“„:AâÜq¦ÍÌ·jÂÎB‡âñuŽì¤‹–\14‚‹ôÚtçåæzØ
9‹Æ(+~—
WÜ:2®¼/G+Ú-¦„E€¥gœUPxßÁQ^·Áþ^O¶mih~w®ñ;ß‡4L0?ºÐ™Í_d9CHì\ŠéhA¡¥rÜ÷—{cÜd>ÂpÇ[W:;Õõ&èÆ`7]m<ãI)üF(Øúnï§tbûíœ	kºlÇÃÐh±g79oÁÃ´ùˆvu–m,‡b&'&ˆ[bnÀ†åQ—>®0úïüê+öV	‰ZY©àÈÚ›KÜ7ŠÀì|ÿ‡úõñÅ!ÍïÊ pÇI™eüN¸ÅÏ9¥äaÒVþ1„11‚ñ/Lûëÿ«¯<Á Ý?ÄïñÚjnÜä_O~ö];(S˜ç?ºÕÀø8Ð¯6·Ê–¨Jšès‘èßB©’´ÃX{"M›ýSà˜ow,ZÀwí˜Ò`Ð$¤MÝÀ¶i’A\®iMHkLQÉVÝ„®½/"ðÿ+­)Ÿ7½ôÔÝÃùˆ=œ¬×÷ñ*à|ÕWRÛwÞå¡<‰õÙmgžˆé<ÞÆ5ˆÂ?]"
G¾_›—‘lÌöØÕ|QhBžýL?x¡Ô·b€OCÔÓÂÀèù[ïÅEÕÄF­w2á§Êõ7 ©í76ý‘p×î<†2ÕL‹š¬£*Ž¯>ÜŒö vÏ6nF	Y<8Ú™Á³Wð”`cp<z÷ÁAþ84‡á›Æ}íêC˜¢©³YbÆÉDQÝ:EþÛt±)×ýð˜)moxC->•x9¦#üÛëF`:¢èFÿ>¾¼!6ñxKÙ»CPÎšž—¶x¡°mM¹`GÆ4öF©ïƒö	±Ëòä‡/Ðï±Z.lZ·Þë­¦
%ÂÇô:z`ÿÚß_Ýe˜ö‰¾&8¡Êç(?¤
þ3©çãêKÜÙ¨û<”M/Ò‚kRúÐkF5³¤7K#gän”Àh;œã–:o7C¢«›ÎŽdi"±¦Â/ÃÎm‹ƒ¬½M&&w-JÚ"²ÿ:Œ|pÃ]Éó¯˜åÞ„	—£i½Ò Á¿àÈÙ–©B…qQKáö+<u÷’dÓAl ýWâŠ˜Š%>“´[ÁÐ+;Æ"Î»vâE«à H™èÐ‹ýnØ·°Xtß(‰7Ssv¸‰T@‘Îð•ï|ÈF)tù]7Èý‡o¿Ü_ò÷®ªcÊÊãD¼ª|A9s#9«iÎqø¬¤Á ¤»ÒŽ„Û šÈà…> hFjãY'Îª³ØµñÕ-ÛûÂ2‰Ñÿá1;eÅ=óbØ¨9K<ÚŸY]ýü<AÇÔtvWÿÉÍ&cc*Þ	Š9U3ÿ®Dõ8"êÑZWáÉ©«ú9Ô!çàÖ­8dyÃˆpoc3!-Oç\=fS‰©4°(«/Wµ)ú6‰ô¢1Z„Œ^g¶p9Ä‰îÒ„ ³n¿ÐÃ½+ûŸ8Ä^oƒ°'2e¢*@_ µòëŠŸ*Òêºaò÷¸œÜ¾gÚÈKh!À½:¨­×þõÅÛOª]9³ÚÑù&*Pg ]AçùR3’˜×üJÂ%pùA¥ü–´µTÔ_Ù‰WÙUnz¨1?†xWî,l¤ž «¾#m	õÁdAguGs&¨÷HÉø™å¦UÞÅÜÏ0Ï;±âòH§P¹­;'ÎAÌ¯,/HcÚE
Æœ¶sx­‡†y·¾Vº Q[‚HÜªq­GgœsSùaûÃM‹BzaC6òÚß˜:ÀÑ½+â%ílÜá2O+2	GõµlÒV=ÑŽ*	;æK/¬ :K7'#VœÕ©¬6Ç§¶,§'¢BÓQP´}	Ê8î^ÝñÙöl—bYcØøâr¡%_ll¨ØE.a+¬kÉ
pŽfôüaa!#…gó»4±†$eoï\dûÀÐ\Ýñµ‘î„‹…DE¡÷a¨‰¤É9žQX!Ë‚+=yôNuôùÈ›tyoÉòµ—§˜½Sz¥‘ØøágG•{:†è´kxHÃâ1bé'ËŒñÇ«çï²;´+Mì'ÚV8À+&w6¯¨­:Iy ·Gl"¡Ô¢.^3Uº@¼›2w.)uÎ&'ÓºvÂÇÌÜêÛH¶\hoF½mfÂYOþº¼äNŸý½ü˜öìÿr°5Y…bö={Knu€Éù·*/±Ò
_w¶®¡Xœ§sƒ²õT$UýÂöIãûoÈx%‰¿vLáü­Juî'[Ø9`Š\·r‹ùúd,ÐÓ¬XûQˆ?ˆÕŸ¦„³º¡ºO?V1×ÙŸ5¶Nž„zéc­Û,›â;A‚NÙþ†ôËª)*¢9,¶7?Ä1L‹™ªH‰šâÄzO74ÒÙì|à¼Jù°‘ê8–£¡ãG»hšH‰ª-§uU'²¼üÉŸ’©µ '˜É]ú¼ö/dK$Æh.m´'Ó¹nY]%•ñ%<0œ÷lê­ªÛs1‘†ÏôAnzÌëö”Ì(œ[L‡-Óõ]ø7}"¢È™”j¡	mÒqë),}L&L ½&ÉÐ«¥Ð„i7!˜Íj
ìœsµW¤ï9÷Ä‘ÊÓÎqt¥´J°j_>îÌÄFÊ¼h ‰¡WÏy­"ûŒ]¶"ó]&Ö{ù‚YüSŸ\¿l`u§–r2QQ9ªfÂÌ\ãO¯>÷*Ÿ§Qý:
®çl­ìã5žÞŽ	PXd…[¹r7ÒBÆŒí-U¡‡˜€,äMIm&a7|•QÅŒrdÒ¤J˜å/	úH‰kèœC0ø˜Ò¨qoN|ËcÍ»o‚¦XÂ	5¦wC@¦ç»ßahòö.Y®™‰àÕƒt¹-f…Â^ì®€7å¢…hxŽ–+Ô´è|@¼°3ˆ;hm ™SLÿ½YKr¥nV¿ÍÀys0hr¤§HmÊÁPÚ0ãMXß¨Òç+µv–¢ºrø/%êNðiap¸€I•„ÿ\¦ã«ËÍVE›øÌ~r¯õ0›‚6¯éÃ	š“fÝ|U-[Ô2L7E>ŸÇÒ”zá$gÀ@«
¯ÖòÊMnGàÔY¶Ô¦8lïáÒü×E™=bU}ƒ6È£B`ZÞg‘¡}•^©zˆtIooøEÈ"»aA,Ë“¯Žø‡qÃÚôUõˆ>Z&ù7Ý9T¦ð{•
««ˆ1„FÛ>m…(¶iû U¢àÍˆ®NÔá¡‚A5¹ÑC¹l_ÞAŠ	þQè¾wæWö'ìLâÉ4/òSb8o^Î@¶ò«œÊ(çšmÉ*ŒCç‚ø.o~¹c¤Î¼¢„INµ×ŸÅÔŸË-«º5ÌUÝµÓP¨`cAAùÓ%ØæÀtã†2‡–ÚÔÉX óÞDß ¾•ÉòAÄäûK°×N…_'Xß¤:yó÷ê.`ø3ú³>D#Û»Î†ƒµ³M·X„¢Ücˆ¬M55éÃeb(q“<:œÏªäÛŸŠ%‘Ü'Kkb•&ìïçp ­Tô"úK”Üsž@ð¿¶:3#›ä¼ô„ÔÛs(=lÌå^aÕ†á ­cZß«¾}Êãf¥dœòí5ÊMÄ÷·Ÿ«Ô¬ül£¸ùÚŽí$ˆäLâa7’·Md‰‚	tHlA¼£«Á%Ü/±¶H€"9¦ýôì£pI¹zD'¯–^X‘ÿCòéÁ8ì£”¹8|¨%ÚÉ?j"·pY’“‘tFá~Ìè¶œnÓ´D_¥-F•m:J 
¶ïŽÈ´d¬«"Éß	r¾Ÿ,—÷éâ_Ó2Y?l7;}€+õÇî¨ö«•+’«âÀ8¢¹çîOA)¹!v’+<†p@Û‡‰Ü÷°¸»³ÛŒô’’ÌÁP:hâKÉ ”µv¡x¯$Ns’níG¸½T½œÜAm_¼!êz[S;üMÛöYtL5å}Ÿ‚¬e`èþ#‚ §ãC-º÷dK“×¯œÖXŒ:[g4'©Ü§½¯ös^yÈ«gõ!G²¼°ŠgŸ{4ôÿ×èQÈÃF"›x·ûÔˆß$@×¹áŸÙ²]_”ru¤1•ÍmÿÞë›‚XŒ}Ámv¸÷Â>Š\ãÈ¸…ãÅh13¿‡%PßÐÓ„“FŽûS	óö·µ³—Ý ¨…z˜ggý›  xßšÚ~plñêÓNÜƒð•ùÁU%ë¬‘†pæ—›«Š–ïnÈ&HÔ7Ìß5‡.Pëo&!¤§.#—R¢ì.EŸÜ
#™l(Zsåªp¤#\H{jÝcõ­YFFúÞ÷Îj”J2L34tŒS5Øe&-
ÊÇŽ²htph@†{r2ƒÇ¹U%¬$ÁåÝ³hÆ»áW`zÊxF¥ÃÚñ“ML‘×œ°vðl†;{r|s·è`ƒSŒÚR³×VŒ‘ûòŽYù\¡ñŽ<ÈÛ—¿“<JirS¢	g‹?&ˆaÒðãs
•á,Ñç°¯2V=
Zr pfÏVê=Ø-šE±©šÿ²,¦3Ñ(`Ÿ¸o­……­ˆÚÊ˜ÊLášVý–?”µkÎ¿#ø³N!(7Ùÿý¬@d—µ,ñŽíßÞÄ(CÊ/ðyAãhô¼]—®Ì.úŽën­ÓøK$t9’*U'=;:#ý[<­Å®hsÕœÆpÃ[‹[xŒgÜeÑÄÈ—îÙ»Ú¡sT¶þ@<ic‘0+è<˜…MÎáúˆ%-4/â¬J?v µÑJƒoCz}ts°óê©Z?öó¦\Åu ›Úƒ¾RB3¸Y¾ŸïýRbÌsQã¾ðyd@­2hé™tžÄp;VB´ÿíôÈ—ó÷O¹áN‰õàS0—Ó¾ÚôB~\•[AÈÊ§\pûdð1¢†Þ+.V-Š^6ôX¼«*VÔqQ%2æ[†ëòÊøV|Ñ*%×”BI¹¥@C/î	uù°7Áø;)áö³&%høàFùù2vÒÒãX6:Í“H µ—ÙªÉi²åÝ(z\Í²WkL½öBù^¯}<EÑ7e° B¹fŽadßÃÞ
¥\" S-h¥”õ¡a~-€p©¥õ[‹tãø^7ïdýƒ˜hi&3 Œˆû;jNŠÞMÓ¿E(oÿ×ÞÎ}GÏN)”pjq²«Šýn/]ŽÝ#ˆ]¶êØ$tÉHÅaáµ:bŸym–§øTõ$)Ö­còé¿ŸNQÞ2eÕƒ;ûlPòÛó(A€¢ên¨Þ‘b$àFÎ>Ú*ä-whDÝ¡oI<¶ÁPvÂâÉve¥j†ÆÕuooÝî¦Q{ùTo"¨©'_br©ê+úsÚÇÆªôÏ·Éma_z•z°gàåI¶SðN©<-ð›ú«C5¾ÔdMýÎw	7cŽy‹Ö¨6149>Ü»tÐ1Gõë«³¾IaŒMY•9H{Àˆ™)=È4Ü°J’¦3ÌvŽ©±`Ù
hõåsd­ôù@5…70ÅMì³àã>·l3õx¶èìHÄc&?xàäD‰z ÏÙÃq.—®0ëî]Òƒçƒ7%Ñ+©·a™RŸÃ¼?Ùã5ÿ(Š¦0ÅÛF{8ucŸ)×S‰ËÞõUýðîí&ºË=aÆœ³›FiYšÂ8 ^]"ï&všýñ„š¢úIY–àºÈ»t—P®%¿ý- Ô§AëÕ½Ë¦×†¾	µ›ÏH%U{Æ„îd®rÜTµz'ÅæÄuÜ+2Õ"è4+àÌ¡4î[¿’êm
±Ž]Õ{`Ñ—»
ëµl‡SžÇvP	ZŒ^ërTeÜ‰]œÕjé,f®íÉV6S  o_þ†€ vVkõ [Uzj«7rÅüàÿ$Çï(ÉìD½&ä\’9IôÅ5È¬šý/ÂÙxg‘ø2¨»«¨*\»¬‡ˆóF¶ÞŸðµ‰¬ç\÷äc UE¾Ôœ¤ûÛã‡);®á4’,ÏŠž5øÐxE/»ªÂ_í¸ÑÏ°ÈÃ²gã@„OØNœåk%ÛØJívÈ-M>Ê;ÕV>x¡¾Bï²õrP‚Ö]‡O*mœªœ±ª7žâm\ü6@ß½nq	Ñ-‹Ê‰QuO¾öÃÔÅ~à"
,?ÝËZ­Úca©ÜUÃßïK–ºãŽ·èÍwnâiÝmVðØÌMGÔçŸ7F&U»M:œõ<?Ûó®W	;P©zNµuý©ð2í]ü¯Í12„ÙfXÂGÿôZž:]tr]œEO[Èðõë÷žÊ)vøëéšÙ(Âªù®à†7õÒsg«ó˜‚'b]lC¶µS%ˆ$‘†šë¹Lv›„¿g–j5©Œ†fï¶
Â}À’úÕLCz’„ÈÔÍÇ©º`FÎò…†¿a¼ ÀKÚSéµ.¡LËôdi·)[o4bÅørT²•Ùi|íÌ]Y{(ûyÖ£}!˜r´ó¡tË1…¨µ`]äèp(á6×O<˜þÑËá±<¡[L%}78HåûÀæR«pøPaþþ"ÁéòË‚Ã—ì8Üi0Ö³ÕD‘m,•,Ý#kä/&¨údð]-<‡wâi#çû¦åÙeîžQON¬äWÐõ2{4mÒb¡yúö‡×^ª†ç‡LÁ/V¹ìÀØ'hƒf¦°²LÊ–Eg‚Ý6´¦Èk¨;±ÍðVë™Nà <›ä -íœY„Ÿ—FèÞ¨¡—lw*³Ðæ›uëŠœG>8wSzæËû\¦cŠrê|sŸ&‹ —ÞÝêÐÿí²¶½5ÅÀD›UáÊj§"îKÔ|cw)6±ò½\Ú}€Çº•”“[¢cäþ½&+}KËÜ³h!‡°MZ30u	ÝËÕ=ËÕæ …ƒä“"Hôñ@´ûìšñ­òïmå|'aï˜IØäy‹…;sâ°<Œ¤ºÍf3NGW,$ýy0‰6Ác)([J }å SêfÇ%ýqñù/5=Ãf:Üs(Â$s*Ÿ§[j¥ŽW‰¤‡%ü0D¦õbÃŸ—¨£‚Vç%Y
•9±ÿ‚…ÞŒSðŒþ“\šºCvçJ;ÇOã·ïCŸ„Þ)ËFb©JHìxl“àH8Š‘ÚÔ›o‹Äeuræ[µõUbß§9ª/{‡¢½wßæW9ðlõç2P?z¿ÞŸ2¢ž©Jš y–ŠÁNày,·ç^÷nÔ›µŒ¹7ŸŸþÊ·Š>‡ælºœê‰Ý.Æ²‘phi“œ.Ùãu,éF¦
ª­U›ÏlË~lÇ"ãVà¸1F#c=Ï,èíUûQ)­çàÌÌ˜ÕÑƒ#›Í¦<›gU$uln¥&Ìå^¢÷f{ŒQ‚sJu¢©<]ÁûM%ãýAD§CÛ=¤QPeÊGSOÏí@WŒò=D±€ŠoÂ!Â¼E2ˆ˜õd'®Ë°¤nsâg¬†ç®}U«(#¹+É>¬þëæ€¾l²wÍÃƒÓ.yVûƒ>Å-ß6êÑð>tÍ{TåDOB<×½q}†J_ÕZúØ¡‚7|„‹­XŠÂ½_sºñÝ3µy¹ž½-q35·I)D^vc;ymPßðzk@ø”“FDÄÏ[Ó´ŽÁ¥”GLß½¬¼úã€aÙXTÂ£KNHøQÅ¹X3Ž‰ð×bÞpî@8ò)ßEÝÅæ ;FODbÇn¢cNsÞ¶d€"]$ûæŽ7£ˆ~?_Ê6®^¿¨¾e,QeEÐK.¸&ÂIzì²ÊT‹ 7dÒ	GàÐ‰[TÅ	wD½qDöÛtRsàÌ·˜ŠjÉ»˜„XþÍ	’WÏ£Xo¿!ã^†gliM)CK«9Ám÷Å}g5#È±WtÙE¯ã‹ÃÙQYäù_±°lìââÁ@›ó¤(ósƒj…qÑ¨•Ð\‚V$Nü^ÚhÎC–/ÚV–¶†6åÓ‹,Í£¥¶ÉVb>=öÁV]Ôù~ž¯Ö­~àSªš<.±yŠ1ÓO_c¶FµÀ?˜gËß3 øì’Þfè‰ãì§oÓúý þˆÿràmˆoI‚“DF¿,è>+ª É{_Fð_œ.t …ž™¼Š¬kóIm>ÖÕ¸.~÷ÌCyïO	ƒFì¾;žv”Mè9“Ï#${Îwßü%_zR+ ±Ó8åË™€5Cd$8ËJÇÜ®œ·&\D s¿È£Ð®¡ÔðÖ!Þ=Å©Å
Äî2Í-Ó1b©îÑŽ*©åŠÛÜG²>©º²9¿“q
öÕèºêF/èÙ˜§ð><}u¸éIø;ÓÛŽ÷Fb	2¶Í¡{3M!’¹áýã™£ÇÒ|S¹)sð\ÛÂ[ÜpµY"PŠ&†qÝÎ]Õy[ô> 	/j¥û_õõ.†õ5mcÓ/UI4’LŒÐöbSüëž¥™bê7	Æ&"ýV=Ö“‚vü„Ù³..â ê9øÙb^ÔÛùÏì¥÷ª3]‰(i¡÷¿&WJíŸýéryæ'9<E¨xDªdþ£'¬mÎ¶•60ô¦·W.cvåJkª™Òi‰[ö‹'ŽRÂs
BkNÊ Â\[Qø$ü(T.dÚïQ•µû8æ¸K4®OÒÅÉ%Ä0ðT­’×·kT¡Gâd~bÊxÅœäï`zéf¾Í3€øBF`ù–»sÙ"yþÍÅÊ( ™‰	µ·á¿Ý§yª­ž­µ¬£k0Ö/üoUªÆ›ó<Í¶îl±.2Àêž9c,Zü>Ùåø#J&Êý@à¾izÓñ×žž~¹ 0a°Äò¬¶t–M—)Æ£;XÐg¿ÜC¹5[õ#Êi¦%›EyâÔÎè]ýxp³FDó*œ^­Nz¯]ÛZ¶3ââª<,¡ƒV¤äaŒ•‰FŽ½÷ƒ3Te]h˜Ë¿ëX/Â²b=¢é•ûY)*Ž[¦ºNÑí›¡åz  ä;Ö£Ü€TîÕ³€0÷=Jò6º¨RÏˆýŽqâê3Tý÷ÜÍöA;AÆÁ
ÙŽÒ·¦t…].7›Ok\6Gkl­ïí¼ÍX“Eºk†©Jj`‚ØøÆÆõš‚áY=œýx^•;ãð[i“MŽÛ9kEƒÝÆlúÓac±l¹7OšÙûÝ«l0	¼¿)ÑÉH¢A ¡µ÷9êqCSy1ð†Åã…Ùð >‘	ÿøŽã5ùhUÚmÆýã-Õ ç/ƒ÷4\~IízsßµCŒª'<¹^™}¡±dæ>šUÜ\¹å•:¼iþ¦kÉ`ùUËÍëv=Bê¨\7V™ª²Úzú¾nÿ…»äYÌÓ®ÌÆäsL?Æ°M—üíz´ÆkžEÆ¥Cö,ÀµFÈXG¨üjeãƒðâÂe¾´SžƒVPh\l,•z%shStdñˆ·OùM©qpºmXq`6¤#T¸ù—ûï‡²¦Qê-|ÅNÚ^æ>u1)þd]¤À>!qvÄ9îï÷ø' 4  ð9¶“C™úbö¡{'µÐf%›^ÙÔÆµ(VUsìLyTa=_î\¿í°³öh’x¸±Š¾^HwÄA3è¬¥ÐF„!q¦·ŒfžÄ9ÙƒEžµ€à{Ž¬c½Òà}nÏ‚)UÀ2ë0ˆ^÷¡Ø*¬ð›2›™†A-LQÀŽlõ<‘†¿Ip›º²D›¦¡4Ó·ù¢@1Æ÷ia·u×Þ{®d~Ï.QoË“(Á9GœºpÚ—!ŸžÅE"¬)e?]~½mÇ7,$t=ž5Âwùþ5»ãÏ¤ÅîSƒø`½æEÁký#~p+´çNÿSÍ³¿ól¤ ÜB´Sè¨þO{ÅaÝøišTv²p†9¨q•hAÃL’h’ÎÉºn»xd”9O¥tN'È¸ð8Èü–!eôß‹™ñªÔ!CÎ—« ¥Öê×Ø§•Úê¸\OÇO½½£qdÖn>(reíˆñfªë«ôÚ_°0ÏßŒÞ¢S±I–‘µÏKg%ò¥Œ†‚"Šâ#˜0ÑgÔç¶KpÊõ×A/ê‘ØÿÛ1iq,¥$NÓdÿ$þƒpÁ|Qƒ“ \ÔuÕ^±¬yp5ö¤|UÀ»pÓu§K›WaL´m|tà?³3ìbÊÆYìÇŽw¤§\âŒ…£.d2“ Q¬+Õ>Š3ÄöV—ü^8Èf‘Ç¯ªhÌgzèî²õ{X¤eá³ºˆPT‘ü÷økiN‹Ä‹d[á©’Dh]«SòÜÅ•ÖrNô]¿ C§±¬1Ù£¶M*ƒË¿žÝ«CDÊNÛÔ")JA4³ïwé*Ç´ê,ý ¯Ø—xÃ'x"ÄýFˆžÚ‘»(œ€Ó,b ”
`¡ï»Ëj‡D ÅËwIqÉŽ˜©Cn
óŸ^Å®»âVšQ
â®`ßð‘[2
`<Xgûµd`ÏƒlÄ“´ƒ”¦½z‘ t†ó:ƒÎ’ ÐbÙmÓ~ÊzYËD³És’oN¬m£šL¶1Zà6¥]<àIœîöéW;"jl<c]ãË¤nï-8tfõ¡òðC{4°3E2žiôäKµ²Îc™ÿ3V5ým[d¡2Ü*œtvºj?Uè.«ïž·¤q²ó8[gHÜì3Ããwîà¾®­½ù
v¾vGØIÁq	£ýÒèî8uM×â{O æ´½FÏ&|îCËó ¥Ò`/}<2›X€•Q-låQ"k®CO··Ô3¦»¯þŽ…aV·5î‰¬¾º¾=´†ê‹™™í!ïàþŠßZÐú¢À”k¯óÿBôÐ­ˆÕö†÷nöS†J¤lCc¾ãˆ’ºË>5¦*¢Uñá.Œàóù¹§¡ËESÄ„¶q µ$ŸÌç®ºüî÷Ô3ùšm =õÖ•ÏÕVŸ¾ç?>J(.§z°× ­ßUºÑ»ZÔòÎ!¾ÈÅA°B*¶3yˆÌC»j`¦ªÏùÈéxsÔŽú½Äþ­‰¡IËåÒu®«Ô«»èBG^k	Ò
ù|¡‹Ôn_ê¡=ëú˜çU§ƒF {ÓÁ=À0úÌŒ[¼ŒÛûâ§ð¬hÁ æO°¬Yaþ$Õ'?  ÇL­2AÄ‡jHS5‡tÀ Ú·Ž½³€«õÑ¼šCß×’o¨®ƒÏWIÿNÜHúìã§-¡È>ž%“–løï3ÑáÖ!Øn,š¸LLàÌC‘€12(Ò¿ƒÀ°ç#ñD°4•‚õ
ÐÊ×Ö|ÈMaí€
‹ÌÛáFq-ž¯O¸ã¯Ð†¯Ò6OkQ*˜Šy‹Õt;®JLrÙx2ŒE3zìÆKV2«”0ÕaaÖ•¶‘)GäÜä"ˆ¿}’Š¶ü3
ôÀ¸¸LoGDâÛxŒÄY`„ ö¼ø™Cz0zÂSñ‹ ¨nH-$Ô|ì‰™†KˆÙÿ"€€vÌ±\æÊˆz“¼µv2àeª4í.ž`“dESç	¶¼yª‹Ú«u2“Cã³
øßcéã£òó†ç¥âp
€Ý©®Ï÷ü÷rf`Í+±ÅÜL!ÉBvð¼ô.ÿñ"}9d’B·-ßÀâ}e4xÊÜƒÙFm»¾ô"êsõ(Ü…’^ ›p ’"`r1Ð?¦¡û!Œ£1Šïæ4÷7*Grü¥“o$1¿+X3÷:Ô
# ÉòÔ+)O;	–tVl·ê‚8ý3„+jÎÝ`4ÿ‚ä‰¹›'ÄõÎd×è	@Ê¦÷ü·–UCÆ†I¶ÊðCÂ3ûU®d†½yíÚAÁà­9âviCL‘PèO‘ûR‰ûOèÈy¶G Š¢¶Ü¼û$¿ÐYb~q¬‰íÉäöŠ`Œ½šGà¦k‡¬­ÍS$í®#øæ¡Ñ{A½›·&"f×ÚÚPŽÓ/B±,˜ÇCpYï*®°®†k­"ò£ÌµKSÕGÔEŽ‹Äz§÷èÍÄCâ«UlTSöëøÎ3»½6ÁÁ¶öÿØÈ¥nJíxëƒ¤Õ­¿Ì9BOßÌsp|Ü¢WÈLzB‰dÑYør«öC£ëÔJIŠ<«]ã€f3këa‡³47ÿVéaF‹¹ÞñÈ5\ðx°|=GM9Þ—þ$‹ö,4€Ý»§l¸ÍG$¿L½ùØoK˜”°Æ~×&‘ÚGK_.½ŸÀ÷ÜdØêµà?§c.U¿2©„–ÏPW¯;ææêÜ’õ¥¿ò# ÉadÔ¶„ÜVõ†×Þ†y¯vÁ$ÌÇV§:~ëx=JæGKËäÀ‡tl_v-QÓ±aN¾/7˜
5uï/æà_¶‚ßt3m²’¯brˆÌ~›¶&Û…œçX‘H‘¦6q”„ÂO²UÃkuÇ¡!›F(4~-’<¬ª=×/ï‘ƒ™s‘K[;u¯ó)ÊSó‹5)uT«æŸƒÞºl8Jõ-·Pl…<½:$¾Ç¨›r;>N•äùE}—KbZýèc!¹š-<†­'ƒj·/òsr+0†E*ìf)7ÁÓHïÂxNOF³(î1Xù‘xqOÆdÏÍÝX»Wð]øR$¾Gµ{~1‘ylÇv-úíÁdÈ4u¬ª„Cýí+4¿F7õC^|ZËT*óÜhKÊÜÆIó·,‡kï‹éðÈQ7^ôWcüÏÏ«R¼¤Zí;åÓƒ"e#ÒÒ­‚[ª@Ô:OÀ°3€‰0ør7õƒ'JažÑÆ8wÅmÒ7—±U£ÙÜ0ªü†ãu7ÊxÑò´
‰ê­©â8léÏÜZàNJ•tY]‰¶e&ã ÔUýýXµéEå~³Šá+/ã°mÁªSëÈjfËÅŸ¦¾B[¿¥4ŸÊÕBú­ìUŸzáé“*wo“Hâ"óšzF48t²´½¯ž@z~šgÇtiß{×tZàéÄDþãbÕõ*²‘–óç67JŒ@Ðe¡²H·ëB—¹@9TU°eˆ¡÷Êæ£þa°¹véUÄÙ«D—*'Õ!?è²6o¯º9ÓyyéÇ M^Pßþï{Y£–ˆ¬-}h-“Ð¨ý€µGó‹â°õkßl³Çðmše<AÑ{I2HßKÖ£ß®äÍ•SáN×l‹Ž{Þ“ÅµÀ:E"~ÝGÊr+]‡f~µ]§Êøí)×„CW€ž¸*ÝÓ€PÍU…ñ=*¶Ÿtlþ“iþƒDjûrõ £ÙGmÊ°È'pæ}) ¯LŽ‚x@´é’ºg´QM½¬b»Ûk`%bâÌ
)þñ+Íœé ^A6¾‚0»i }s­ ´yÏ˜¨œŠcÖ\wv{ÓËk¸˜‚ÔB
G-z“6¾Çý¤3r™PbôúH¬"k¹…tõ#g(O?M‰èf	ZQh2•ÄB2Àh'8)ïúë)Ðg³ÑÃþoÃç‰eÔQn ?(†h\¤Ha“o"=7¥aæ¬Xr¿ÕüxÙ3ùQ³
rjœÌ[¹Zk˜Ò«ƒkÊ°5ù&ÅœUÈ‹nÁ>¥Mœª^Ìm&Yej,/îfõøÐ6Z“ ü²`0	Z>µ’ƒ.Ï^õ†Fª)`èøØð%&>‘:ÏR?Å$ µÓy	¶*”ûmÎˆ7E4<t[Ÿƒ<{ i€à$ÌR0ž ä•ùÕêØž÷Ð¥ŽÆ%:ZÎ"úZ\uMO˜Lt¸ºEZZìOµ|V¹»þ—HÔT"‰­œF;G»À%ÉCµ Y§çâ1R*Gû£¦>™&esì/µÆs“˜ä7Ö-¦qp¸®†¥W›Äô÷7Ø¾ëL÷¦l< É5»1­jvô”âb‹e¦ôâ©äË6)õ†²¥H?² WV±¨rîe±™JŒzµì¤‹æ:>_ô‘m`˜¼!¯¥\F‹ÑÉI,ÛÿþŽéP–‘4û'
W&9JG(|dŸH#šoë9=ÄëòSðç‰0Õ
Ö«šPoÓ#Ð¶d81ñü¾±ÈùçÀJ©f»ñúÇ_¾,+,,Ç-ØÊúdöô–3ó:é¶œýq9«Ý	GbÂÝžD…‰t´ÉàßÔñ°âË±Øs÷1xIU>þdÈ€pIËçˆ`Q;
Äþ¿oÝð^mËP®çrCï1Ï‡7BCÆŽAŠñ:J|ÑßAáÈXh‡bâ%(yvRÓþ‚ c>bÅ)É*ˆŒFrï«vYEYŽüÂIÞEH~±S°CXÞxl-óL³¼°üafy$o¤jïÒ9~Wü¹ä=ä­Nž?<”ç=’Ëž½wÖHC‘±©˜:u§›.Á½Š.rHÂ?çMb¿ÎãHö'Ý÷é-9µôî™Œ›ç„v{0×ÇŒ‚S ŒSqÌê„ø‹ÛþC}5°:Í= ß÷¸rÛ”;ÜáU&`Ì ÄpŒ£>æ ƒù ×,=.,œpG[:¥ÓQÛ±ñ¡]k}:;1~@ñ+Š™x6ÌvÿÇ§Á>¹õ®×Æ¯§çdóMd¸ž¬7lOí¹yÅ_QaÍÏôD;;
Ç\žn](O*×dAv^Ðv»v»âFü¹ºÐai8—€+)¯Ú‹#!~Í•Ó¿x¢Æ
Þq˜;ÉkÚâ(Ç¶•Ÿ°7’-¢ˆû%EÉÖ¸N}#Y‡Zå]¿Xát!¢½£q`¥›ï0÷ØàìÍ;Nqø±¬pAÈôB!tÎ,&—jªWFu)Ñz@œ©6ËTÀ¢‡zqÍüõÓ'Bû$¼‰!N^¯’Mã´á[M?«x ¾õ¾; ³á ³fŸøoÑ·…!×:Ô0B0æ(lHd¤¬xl!I1¡tølÝ¤è\€Ex1t¾M]®&ÀÏo<_/'Vç#½óæ"–j¡À½\GS ·ÀÀª„rÕ.×p™iîIÿ1òúEË’5<äo¶FJû­K»QÁî:Ór´?–D6¶¾ CEð(|ˆ¥m£.aöëJÃèÎ²ÀbÑp¡X®ÞÓ×²×¬YéHËû[ˆ§ù>à^?Œ¿céPÝð’¸@“ò-Ür…¬ä]‡Ä¬¾HÃò–…~xM°§è ×Í;¨â_×õ'4âýd>¸±„E5ÓÊ*Wªû¯m#	ñC"h1Vòï)û{%,Måó4„XÑ¥GW²ÌkŠ¸)¥˜x¹ØƒÄpÏEó(®0FÍÀµ’½-i	ð´è³+u/óuÜSº†5Å¬€aÄOÍˆw.,R<`€¨Y¼Ä/¦bé<ã	ûåÑ\Ö7ÓyQÐèž_ý¸85D£-Œl¤ŒžáF‹Ëéæºv|ÜŽí¬þóëÌ,áÇ¸Í0ß·Ùój2³2O«&‘‰›j•ÌžbŽ‚OÄ›ÎÅ×Íã¸Û+)­ûÔÈ¸ÿåŒ-ÃjfqHwÙme÷lŽpœÕG	ûÄNTHBaô0åŸ<qkÚ9—n¼l²\qÚë–Ø"å~áñPö
KúçuÜú&U÷68õP-kÄšViñ–w5 ô5›:…¹†ì¬³‡±5\/½Å{fóûã$ÉJäK £USïezRºn8YÑ×.*5Õ?’²[N-MpË½ç¡å3r6^ã#ÖžÒ¸”´tîCŽCw¹„AÌzœyk–q·HÄ™IìS7œ³¥•®Z¦¸|”a£\ÕÚ“jÉ/¯Rüó€#fpKØ…6YIú²?š¥ŸwF§”Þƒ+Ñ¦M{LÍŒG)É—“YZYß;Ø¥•–.­ô7KNS†ÍgéùäK6¡Í41#÷JÁº\<C"fª°¬E«®bø÷ €¯p	ª½%LŠ”¶Ò,´vP¨£ü¨s³—þvJÜìfÝé.«×^Ó5œ¥±6Å™cÀ¯t²-—µ¥#Í5b
â]EŒÀVüþÛmhx{æ‚ï KþA.¶CIøÍðîæ}Ðb†UÅoKºá•æ¤<Kã~uì´ÊÙ¬åØÎ	x
ÖEý¢LÐ_°Jý|o—üeœ<RúÆšQâe„è×|ø¾p‡ƒ¼¢ör£41YšæåÉ‚:ÃaRqõe6Dƒ2ÜÄå¥ƒ#×Çü@ôGÈqo*ì ÑD8†[ÙI6ïPOq>–~%ÿ3~…»‰«… Z„mœkÍÛ@Õ7Ñz‘ #ZÖ_8µš&Reï$õÀc=>oÝ²ük·ŸU
µG'\:m'„ºž«ä}þão\.çŸKªPë	–¨êEE{³gÇývô`ðïZò×¤>eˆ‡WñÊ”Ï<ô›¶	•Î†Ð• cÿÃœ#Ÿ–Æ\Ä©s˜åÚÌ/ÒˆŒ?€æÍ¡yú	ìåH˜p"¾&ƒjˆ ¿½1ˆIO(›œ ÜùP+  ÐpÏ6'bÜWDËvn ¨ÅÇ¢	k¼×³õ8lèx­|¸O´ŒX„¯j-‘Öç š°(2¶æéhu|Eœ>MÄŽ-7|;7|ÌÉGIÚ•¿9Á_ÖáŽr&nQ²Ø|úÉ^¬ŒJ‚2º_ÖÿC"ŸÎ]±´Om“n4F4¤=™ƒŠ¥Ûæ$î‚KFâJ†»©«‹L	Ù2þžÆC_Sð°}Ÿ(öâ
kûÎcn]q:\`!ÃÃv'TTQ2Àþ1ÃÐûmðé‰ÇðóRA*LQòÊ{¯ÓáÝùK÷¢n`g|ÐÂïÝÎ›ÄŠÀÄ,§*QÜÒ?aP^KEPÍÔÃëÄ*eÙ5pÒæƒ2PÞˆÅ.<fDüO‹•à“¼\þWZÃ€úlK]Í†ä-sGVœ;üÏ[{®ŒRfÓ„m?~5•/¹¼5±R,tð	Ã×Qœv`<O@®‡O‹xÅÆb®xEÈ™y» –z4Üò<Šô\Vâq¸d‹>¸q@ û¾ýÜAµ£ŒŒ‘àQÍBSc ×Ë%çÂ>Ð!a}ºãn
ò³HÆýçFwçÃ†K!Ài,ÃõáNZQë"/»à"RªŠÜ[WMQ~âõÞKñô«`¯åi*K‘£‰in'æM ü¨!÷óLI¯Áð‰‚œN•(d¨y/:7¿§nÒJØ’þÁAOŸ‡¤¥Iá«C€ŽCÃzK;…P§ìñu§¨ÂÅß•L8¢~Aß}À_UOW;Tê» %	ñ†
ŒÕ	ÚfN#ú²ù
è+«PîwIÄÿRøMý:ëX‰Xq@as¾¦rœdA4éÉ]î‹´ž¤`$)²˜Jmåµ÷ÖhbíË\ÿ·ËŠøŠ‘!¹Û÷b8`!¹«Dp%Þ¼Hz»Ê(å}.aâªetú•M]+MÕ£>–(œrñªýy}N=nç‚©Rá†«ƒÈ^3ô”ÊˆF¬	«Dlgí-­‹ì8>AC³vøÐ Â´…R“Þ%"©“½b$§ÁõdÆ	ƒÅ¶ T¿‚=ÍæÚ—‹÷Îëyfv;c¶h=3,ŒÇa;~Ç5 |±ÿµÔõ™€{\°ã×±w%«XjìÎ>þ÷d?ì•i¯?‚Á’hEx’§’Wîï"·2‘ÆQ¡ÎÀ'üns7TämeúƒIÖù ´{q>h”Ë£ÝËÚrÁà$ñ¤ÐXÑ©Hÿ¬¢‘lÜ‡zÔ™1•±™*¯»Ô|•ìkÿ_ Ù)áØãâ{3f2QýQ„Ó^o6Ö±±1´ÖŽŠe­oÏØd¾¼k;ï÷“ÌÂè£TZÐ`q€¡XìÝf2ã6ŒV5CøóÿÈXJÑ¸Œ¤ì›{ŒôQ1þêL<ý­’0þEŽif‘’/V=è(C™Iþ®µÃ€³G÷ô0t¹ïx=]>3åè•v?1aæD‡–
ð°`Üìia”ðSé, —›>O¦'`ædÆÂVþâ+aé‹'>.J@mú;‡ØÎ~ ŒŸ‚ŠpÊ·ÅÈûjÙ¸m•Àg~Ö¼<’Kó„ñv•KˆM°\è½Òm×¦P›Òb†Ü_[có˜œÄph¤Ú/­@©»ví,·=xÔiÌŽ”êvpŠÁÚ¢xLO¨õ/8Ø.ëüÚŒti&Ö&F«µ!¢·xG›)²È»‚&1Á¬W›–ÅÓfcÞ³sÞˆ6âVº‰{ùTžmî¤É§ŸEá€wJh~aÀéÛ•­Ü÷Æ
]ŽrçUóSIÏŸ©ëGyq7‰ iŽ€ª;L˜òÅê,Gì:V7<«¾Û²PŽRvŠ&ØlÆö
—ÌÙÝNÙGVþªêÝ¸)\²«¨~ÈMn:	Ó¨‘!dRÚnÌ~bã¹¤ñÃ;š=‚¨käN&®¥XoÌÔ‚›%ŽŒèVdÈA{9<Û„Éò¨¤i¸¡‰LÕÀòx!VÑ3›uó4òe#Úõ–³©ýo)$WxµOøÁ #!õm3žRâ¸Q<wB$o»ö¢°‚¢ç4‘°&¥!¥U;‘¡?ñlÇw‚wæÛtfòÍö‘fÍP–š¾‰ßxwÝ*Ù.÷OùD=OZ$;îWÆ0vt^¥WØÚÛ=o­L'ŒO.õ¸;ô!àÈ¬ä-®ët£…ªTÓs©=H€ŠëÂ§¨l—#m_	K|ES…ëV8îc+Ô 1@¼¼E*±Ú˜Û¸ÙœcFnbyIm*`¥ÄzNoì¦>qñïøO:ñ›%r­®Nþâ= IÍC.¢±‰‘FÍÑY›ú›MJå=ë­'+@¾n\lé-A+]€ ™1Yhb#†às*òx~“|d„Vñ
»:ºÆ›:Â+h‘0ðÆavZ°&‰¹úºe»Ä‹â0·À¨L7²5Æa‹Ž‹gfíæ>ªˆá®‹’‚ý2U¸bÔj’jìdŽhH(5T!Â|.t*OåÕ	|ƒ»ÌÍ!GûPH‰¢‹£É'£•Ó™ý€þÚ÷|¯)pX<t>ÚNÀ<ÌR‡!-5˜Û:<¢©KÍÿäãî2ÐïSÑ\ƒ‘Éæs@ãÅ(2ŸÄ»N=i qÊ|´ÿfáç ±LqÉƒêëßX"!É“ÎÃAH=­ò~üÝŒ`6@!¹'ã½éñjÈqa4]H­Ö©¢ô(@à û3ìCÅ+»ÏðbEÇàÜEÈñžnFec‹æB”­“¤ÏÌ b93£|Ôyš€d”A£dtpöwµÆ]czeùºñŒd£`‡RÇ¥~?'5'úç±mi3’¡Y\ì2M%^Û8Ö 0„VúÀ ‹<ÍKØ˜‚å†yAú“Š«n+eCî}MÎ–Z¨¤‡=~Lb9ä .mSŸÆ™g“n?9ýà¦ž?x–”á¯í0úä#^)ßðÌE×âW›xÑWtŒÄÁâ¹·ì·eëS
¬ÁÔ=¯¢€0#zuÔU€‘sŠ‰¢‡éOåÌÕnÂÈí©bìY|2º#ˆ¤Øcî'â¼8\r>(@°Nó’™¨ lmFï”\8²_[Þ™´M¤…oÕÂ„=p©^CAmÐ$îyÞR¾ã_	MC„Ÿa»Û$²Oz’;…m¯Ê:ww>c½ËÿL§™Ä› ãÂ¦ë*aÃnÌÂñ"!ZïÃ“?[·Õ À†(/B×”ÌÉ¡[ÑeD‘´Mãµ¤-‡ªG6¶xOŒ#–*! LŽ¨ä›"õÐ_}qá}$Vq21¯§(Š_}å¢Wöâš /Duk¿&„}dÒy©jw­OÞ­˜ë<¥¯êâ Ìþ âwèú™"æ ˜¶="'²Cž‚”Š¶öÈ@Óž·¾jŽ€Áíž[S]Æ yz‘’9ød0Ð«ÌZÃã7ÆÝXÃ+Jù?Ä=@YÔ©–=àß	óO¸‡ BTcr:¨/1©ÉÔÎDIŒ!¶%V`ÇÕµúös“úñ'À†G‘Øû€–«–Þ´WÖqd†ßÙáê™±î¢ëð*‚LŽ§îˆÓSð…ÂnSs¢²:çž•ÕíÕàþÖàRO¡ÀœI¸{,¢'€Ð2E•„»Ï¹Ð]B\ì?1Õƒ‹¥©™AöÌÉÞ7iâ)ÈÛ|Q¹|H’ÜÜ©3èn,û*ñàDæ:öÛ‘Á¯õ6–EdÊ.…óª>Cƒe\HÕƒ{;Œ¼á…{>½Dz«ä8¡¶tÇÆØ©yû¤&8çi³[âŽØ1®–¬à~ ¯ GÁcûì+šnß–@­@r…e’ÕrY7¼’*ÒÁ€ÕÂëSå~t™Ìp"üb¿ àö¶`t	"ÒÉ@ÿíò8š¦÷º¾ã_ f—ˆß£ÝÌMÌ Á¬4øí–¡µšÞÊ4™Þ–f,† âŒP÷!l†Cº¨Ì¶O‚š‰±.›Àˆ\=½*Æª´ã­'+|Éý‘+ŸÙú¼àyNjÕ¿ÆoHR"à½»ƒZí\Ÿåéªd„ï'ÎCÓ+´GqvçeÅÞ.E¼@A\•âÒ»TÞ-˜ 4ãUz+ªÌCu"Mi7ý!PîÐˆ« /â`ÙÝÁõ<;B¢ç‰¸Iúñ÷U{hº¾?<bolùBÏFGºdŒ #öù…ÅŒ¬b_^Ek3£HÓÈÍ&;Æëgöö“¥}·½ÅBÔsÈ…×gB7Ý«k.ÿôî“WŒÔì%5î3*o:@Äiïóyk§´É³\ÍÎ79Ã’Ë—2K¿ý4ÌÕ@ÂKkVû ~g®qxÞêã½Û£ÓA«{­µ§i¼FÕóP0b_ñý×ÍQ5[âÒ}M0cèÏÒÏÕƒ…õñÅ¯.{yp®)Í8ˆ”øÁ°²²ÏYåtf­¿#.ó9HÛÞ¿o3cf0DÐ,ƒ‘ÈøØ‡îé@cáþô¹iŸÙbhÇc	a:zð	™#‹=~nhÒ¶E]ãnòôÆ0ü'±':»'Fj ñ¤–j£Õ’<iAã—Wwžf\¼~Äu~>ü'd‰MB¤ ‡öÉ[þduŸº±þ+«šN+‰gÊÿP [%,×NBÔÐt æ1®ÁÁÇ éH-oXþÆ‰»®ôèf"A‰Ø[˜2ymIý
^†
ôÆa°Éà5‘Ý/Žœä;šqˆûÆàüdÈ¿gù#[0Û›D<‰Ã'¸e°4:ÇÎúÛa_c*½*Éš¨š¼7PnÌ“ü¡)øŒ 9vTûê6×VkÉøÁyÁWà¤—©\ÿgÏ‰*©o?Lšdpf U 8åb«.$9Ie¤„5çoýžô.Ò;¹‚§Q Ú
©
þÀç9&ohF›¹X^µL[³r+ìˆ
”LtGœyG²eÏìðÏâÐÆ;]¾¶©tÎæÒ1Ús¤xÔ²®3­ßŽ¨k½9+lâ1}mz¯‚(ù…]X‰`š:ôìðÐ‚Û¬cÛÂW†´‚_ê\Ò
©öw\]Ÿ%1ò#&y—¾§ZÈ	¶ª¸ÖW²K6:Ýù(4îu1.Z4L2¤ª¶Z·|üƒÆÉ 5]>[>‘–i!g®ê?x69öNE»#Ú­7½O§šBWéßÚt.gë¤¼[²é±­ÔÚ[¯èFŸ€™÷á^ÊØ=þoö/„f òÊÃ	ä	|E‡nªq«‘ @ÎD•Õ¶Xããï›*0‘öPAJ½°1`Ì£a’Åm–ƒ@j¼j|7!-4),'&Æã§Pá¦êÃ³‰-DäCª'ÑwOˆ‘„—6†¢ó³>”|
W¹0Ë%r~{ä³¥ç“n:UkîyüB|¾xæÒþÆR›-ûm£Îk›·œºè[ÂbSl0rŽJà&Ž²hy´[Î<~ï‹»G™^äîgì<¦7±‰Ë¿‘`Œ0¾Xüç—“×ß}"µÄý»t aªÉ{U|»æ8¶Ñ¡®*]?wò$p³–2ÐU”4UÍûD»;Ó¿²[Ù‹>êVØ|Ö¡¦qüØFfjøèlíTž h>®ÌÎ†€R®°Pôcsµ-Á¥-Lõ?¬[è¤‹m˜áÏ]ipDŠ@D$ötàüîç,9ÛÛôêåz{joñ,µá^™5Ä·‡Œ½;óÒ&OûëW(Ó¦
´(—¹‘ÂÙ¿¹qd9ÉÕØ™ÀïùÍ¨0N‚_E>Íß,°½ÿ{òŒÌK„=v„÷€_S¦—1¼2!.rí—¯§þ`ÍµzdŸv7o¦¯yÆSÿOŒ$Þ®HnfÜén86Þ8¦¦¼ñKºíq¿“uyõõi×QVÇÁÒ m SEçN”i’ú‹¼mÑzDOD6ÈŽeéÚœ¬þP øe_‰ÎÜ	'Bõ‹ùçItTC{rl¯¼á\Ñ8åËœœ!($Ê‘ã¶Ño	œ´…Ÿ}â~m¡¹è mVR~À*‰Ù™54h«¶¼u!þ "fß )èf=µ‚¯åscèx™-Y¡SS³A”ÆAxŸbÆ:oOÁBëµ\“$\`úêI¹Êµ‚÷Z0#%î|4êŒ
	ú<–3Q)”^YÄš^uh¿Ó1§á¶qø76 Qe\(\Ôñ	0+b¯û™ˆÔºz0ê’Ò‘Þf(µ…ÒV÷]º÷ð*¸•ëÆæ]»qA>8‚bjP¯š›<§ÛÀîYæ)³J—:£™¿ô !*¢ÇÅ6Äj/õkLd¾™Œ1£MwGb¶íó€ZSŽ„n"`â›=Ïà:«Í¥UB›âŠâ<˜©ÆP÷8¢€h-(XÄûå˜^?Ê½–at‡&úT³`(NLcÃezÓÚ·crS2Œÿ‰/ë:ÙÔGþ!ªV‰iw@ïdŽƒ:+[ <Ô‘U ·q·åÅfaY?d=3àÆ:e^)¬«ÿu–Ä{ð}¦K9Äµ÷üµ­‰"mj‰rl˜-ÓÒ0{Ù­6Yø€ZtÏ•EëS`yÇ&CûômtÝ=Sú³ÄIÝ)¡ž”mK‘|Ao½ýæâ!Àµ$ç wÙ
/èâäØ‚—ðþ¨~“Ð5ƒû‡ƒ;uIq6ãÇS¼èÒíÄÌ2„UÌcPÏ¤˜s#!þ· W¾×ºòûÄï‚t€Q¬(»"âÉïa¨>á“²Óƒ€˜õ}SøÉ½jÿú0 µ)~µRÕË:#àxŠÜ~jàõú¿ÑÔ’NÒ¿‚	¯“SY¥'ðü‡W×œÑj}ä%$øáàV‚:l=šœ3“b×ÐAPn¡ãL<f9{@ fÕUP¬ÿú†>®üŽæíŽ¥XIÌó*£`‰fç}n‚ÙY?ÃŽ@¾NÔº¤	 ‘žœX@ëîcGTSÞ¼NÁ-·„Ñj;Û,8ø…ˆ¯qðùp$ÒÆ¸žS1ÎúŽë Ô2aÌ®Êþe°ê´âË2¨–žm‰IYäX,¡_¯ƒWãbGÿSÈŸiê ƒ8‹Ql¾;-n×÷ÖÎ‡#%­ñÞ¯jä].ÏLÁrøÎÈç
.îr ÷Š|Bu­rWî™öŠ@¹©èagŸU:ßûƒ[uZ¹ã×f| Ú¶ÏÞVŒè bt	uÈµsVv.±Àþõ±=o!«ˆ£Ñ¸Ñz—ùJ7	áÑ‘R•¯€2_çF›…TAð'¬ì.¨0A=Ò´qNœÜlÁi7s¿òLn»µÇZ¨¡«¨wùŽ©ˆ¨x¦¦BOÔCVŸÞäÏÂrTcr™Ü8`qÁs‰”a#ìÙžýŠnqo”«1,fÌìÿW$ø6e >Þ|XÐU¾}î™v
¿ÅL…æÝk¨;0•ûÔ`q³˜„­JC€ê–9EÀÅÔ!¼‡‡6¹ƒHfÙ©UÑÄ¡Œ~ï©o%¨gsO6b©k2 ærî WW¦óÔ·ë.^/V²å„oðò×A3»#”µ0×R’£ÆEOKË'Ë»VÙ{¼€_éÚðåT…ù¸QÃ…òA@)ƒóý1kûn.»bd›\¾Ï}mÒF­Ž§‰(kVÄø‡æŸuKÓH'ÞOø™ºgS°Z´cpTKC)L?ÄI~ñ°/oØ¥¸B‘h¹>cºMÈ2vÝ]Ì©…7»u_½×›ÖvÄo†[ýL‹»“è—©:‹¬5ŸÖ„½ÚÚ‹ÿÂÆÕbØ|„£Û³‘WìšÕ‚;‚.0+±[ãÈ2°ŠJP¸‚—öÑCŽrìf¥6ÛÀ»pŽ•/6Ÿ¨h;oT™	Q½0)·lÙé­ìt¾ªÅWfcíÔÛí	àÿ8CìXPJ%8#OôG‹Ê6ºÆt˜_rrý¶¦}‰ÐzÿÎ€ä%YÊ¹–¡gT‹^I]ÄFº1…v+šÏ¶A±ã¸G4>lÐÎƒªð¿Ò80tIwªQ[”¥Ö-Yˆ‡Ù¢ƒ>0×³Ä™xý®ù€Øìczs–N^€Ìa”€6ÆÎÞFþð¿á£Q+ï•Nlx%ƒè.Iÿ…ª7tÐ‡ú§e{¶ÝÓzZ¢ÙÑÄzOréÍ¬ì,Õúúdøo—Ö®0ƒé S#ôéwàŽ$¶Y˜b¾¢~¸Ã|QIF\¦´¼‰yâ€·ú³Â¡%«bæ"í¿J7"ãV”kËä	#D’‰e@V¯Š²E:ŠýqK]·½Æö„ ëÏu.¾¡'TLˆ<tŠ!{ÉH•I×¢0fì¡pþ Ë¯)¸¬t-a,Þ¬½JýÚeÒ5òA¸ÌD»ñ„ð¤£`]V7]ìoÜ=Àõ/é$ TxÐ^ìa?Y¸A&EfÀ`PçÕN,‹òìYƒŒÞí¸’mÛ³qñå˜¯¢!í‹ÖIü×Š…0C| ù2þHXÕ”ø¼¯”ß0ÁZÌ¿r¿ø8ÉŸùú,.uÐ"­»(£#>6£K2±Z··Ÿâö…Úe¼ýW’Ãí":Ì?ê¥ìˆaNùnÍPØh4È~u¼øp?.`AùÉ
ù·iýw¤aJmÀ£cÐa¯ôgNnÒâ®,WÔCn?zDŸÙ”?'ïõ’³\)c²?¶âáÐc™æÏHM»3Ÿ§ŠT>xÞˆð_ -N½ëÄ"ÿ•²°M»ÊŠ¬±œõÚ¶2jåº«>âÅlSð°b(#é`åÓé,$Ø’®íˆÌ¥ XûÞV?¬~’v­U;"Òä!Ý:ÛPp_d5°seW®ó"¥Hm±ÛJ0?k˜Ä\rÝ¿Yˆ1Å»Í†ð_.ÍTÏ@zêá&¼hž°ÓÅaœã{›‰Ð1çEKþ)³øAVÌïðjÅ}Zd®žxóÄÛÅG«üsëeÒ´õ”d5Lhz2WD;nlpÀÎÖ\bÔ6ðüD#ª–†Cð›–½{%²z)‘ß|œ…èPç±3ñ`"QCàÇùØ|Ch¤eÛm v8ªSêò†åÍÑˆ¡{òóVÖñ~LXy·D)˜ñ˜¢ú${Ôée+^-jé¼ F¡•w7À’?ÑLÙ9žý‚JF—úê³µ•‡Bë j®oÁhzhùŸ1¢ÂÚ¡àZ&c`Cû×qX	ì)Üã«Šd“gÀ%u¢l S!O,$mÑºY
¯EÈØ³jÆ‡.lˆ!2%±»©< Ë›+€üîUY·ñ>¬²Õ«o &ó4;½¼ë^SÏê¤	ˆ«Ð^÷–¶¹õ(Œ^õC(]ã}dûŽá'ëƒ)5¦ÔS¾£6Ž”`” ¿D, ¾Š”Ò)
Q#óÂdˆÍVu™8ÖO@¯éQÉ†µÚp•6ß—Ý=ø3ß\e‹¤*˜Ou1ÞÜq4ô8m[,–.|°‹!|­$÷`Ê¹£š,Ø‰åÚ(ˆÜ4º|7Ìï"ÄÐ`v®rZì˜Ðûëö5òò‡ ­êV7tfÀ˜8¶•«t ­À}˜E¡œºc¼í&SE`÷5/©m ÞƒHPGj¯Ëî§éðÆà?«JLsÐÐQu·þrZ×¤/ˆÅú‹îíË¶ÆH÷Öð8ãÊ™ð%ÿK#$­oœaBDá9´óW(€Ê~s{ü·¾Ð‡ ÷ ×Yp¸Ú;_å,š¸%³1è…›ô
Ã¶ytBQ È!Èrå²ÒIÔÈq54<lä=¸:l“þfßVq›mÛ9¼4þÒ§tÜ4l9á§}tåNò¯šánÁ®Š×SÖÒß«‡LÓ8¾
R»¿CI„Yoéæ¦þŸõ?*wÆÎ–zž£õð‹?¬‚SÝ÷N+»u°;<nÝ>Àêdšù7’~è¨ÀËÅÅ«°öíŽ=öË~Á˜9Ó T¯±ã›{mj<!K¥IL…“rì&8ÞuŸÒœ–ÍËž§ËJ[PðjT¿	·Vð„Óç¼"e‹‘]z5q“}|¨Œ„»?;lú>§lDSk1†B6gˆýo6F9¥ÂÄœÂ,Ñ!âiUÃ[‘Ž;½ÔÿjgÞ-ÉhÀoîô¯âÔ=Úì¢ªØRNe–ò×°òÄ>ª¥e†—âKvˆzÉÚiÉÅAivx…V­$ßRq¬É+Âkx2®Y›É
§w‘Ð¨Ü“'pS¢Ï(=ÝÃÞ{ÁŽé÷X”':'B'nÕ…•ÛfttWÀÆÑnV—¶÷U	9m…Ï™([c ±e™FIR¬w÷a•u‚ù·Þ’…×É©wsS¡×Ùf¼yQG‹ã¡ÿ&©‰jãÊña8%€ºWŸ‹É œËÐ€;Ãù õ0
€ëœÆý5~–É4/°%bñ%³=‘	”)º’ò¦½ƒ[P_¼èÞ`ÌÖÄŒ¶¼®Ðï™7meiPìøuùÝØþsœ´}ÎJÕTG0¸€;«_@øt,Ù×Ï¯M+²ÁmÎ?K‰·¡T"â¨QÖ' Ö˜³õÑÎúkž”\ÅÆª®±¡Šá² ¨öŸ¶?µ'¼ŠaG7¤O†ÜáM«ÓU 6’ˆlêód26VvS¢óŠ™/K{Œ{ªS¥/(Ï0B™¦bU—¢ºÁ%¯ˆ yÁŒ·y5KE{bØÑ]J-T<·êræ2Ä¼´ÿ¯Òü}Þ)[§c“Uµ#bë×–)·ù’”w¦ƒÒ-‡Z¢0öà­×
GÔrzx·}p~‡‡ý$ÂhŸë¼ ™K»X»wiŠøø¥Ò¯ë~ÚWJòžCÕZÅÆ'IQíúCä[Œ:`Çá¾UK¤ ë¶s4û•ò¿@ÏÞ$±°íØI7jÿ¸Þéñ%¯.«”Ï5	^ªõÿ·iN ) =¥îGvwVþ'ýûl´¢öÿL4„åÙð›ž„Œ>áNÖë4âwÄ2gŸ×],ðD×;8\¢‘nG$_bCð•¼÷PÈ$*i¾´
z*ÉÓ…±ÙeÙ~n„·ú3€Î5aÔDIJÇ	”{OlÜEòæ=-àŸ[¿ÒËœå2˜·l%À´ž:V®¡A©Ûï«­Îc20ŸQž`Q5ƒeH"š¨·ß#÷ï¥H˜\Nª­fOÓ$Fxøš¨¥+Ý“ôëÜ£fW‰æ$I™M<WzJsûžÒ‹¥À,Î1õE“åYîÿ£©˜³óƒÍ&ÿw2y.-ž’ËJ¤õß°=î—)†…ŽŠì~dxq$Ÿq²…Ó££1¼]VÎ÷1K'yµÿ´öEK‡ÄÒ¹•|pŽ5q@©Ÿ’µû]³[½«í“þ¨EíôÃ·¿*]fâP 1MiÃ7@õ¡Dÿý¯?&Ì·ÇJD­ÕŽ> JŠ.ž=ª•Ì;o$µêc×MÝf
)_jÄŸ™ØïPfúIi5=ñr_‘‘Ï1qŸ£î™a9›}
i[*ê¾WÌø¥'=i¦ïVßþÅžéÖ%âËgïŽÐYvóÁZ‘NqMù{S³–ë6»	ÊÑûoÃÖP>yiû»íi·´Ø+¿âð¼  ¯çÚkÂq¾]Qéƒ6!»Òù,á6#Óf€ò<jó¾~=Ê’Š@FÙMãÝEYÂYdUr8‰ÿ:`¦µÆ'™,9¢ò6–8Øº]_Rù÷ë8×CÞ„•„(ç3oà+öýÇ£j–XHêo<£Ï³I9¹ðÊ?ÙzzŒŒøPj~é5Éb6šµàl°Ouœ¯s;v:gPÑTÀúz º9_ª‘˜«ç€œZ)ALoK£´‡Ž;ôÜhFë…§	ç…1_áò—etù‡&jÍWú.>_›Ed7µŸC`}šó2´µÇsÑ3³u«nRVñ²ZÏÞÚbç´0 :G“(”„gE(0àÈEÿ9èþÙÎek‘¶±‘ÉÛçY9¶—Ô˜ðª+! ·ÒGznô{•·µ,Í¸š+{·)ð–8hü@ÜRQèT}ðõ&È6ýÎ—oQ‘–Ò0…¸TÁ…ìƒÆ;1Ð—z´öãÈª'ïµzÞ3dñ$jGS@cþÓŒ©—äÓ¨Á…¼å“Ž6ç>äÌ¦jÙn/zJ‘zÜzÒj:Ð²éðTœ¥·ž(Š¬áv;|Ì*“!Ð	|ç3äéª ¯[¶ã:tñ˜Gú³¾Û°?úü‡ite ûË·Ò5‘’É¾=ï.÷±ÄkÔJÞÛœèï“7M°‘üPp'Ó$CqKŒsìá0£†ÊG²"íscú+‡@ŸÂÓ´Ø›çÙÞÿˆ2"„ãM {t¸·ïPäÊ'ºOŠ-w'„q"¯¢ ·D«Œ¥ep©¡ÛÕ~É¥_Ç€oOFzòt8_úë‰èéJâ)ü’)¶dCÁ¨ÜpFÙm2ÐkßæDÎ%=ˆéwÕø…öÇsú˜‡ÙÛ¯ÈFDE{c#ð¹GfEhàÎŒÌÔ‰ä¢+MJ
ý¬Êap'nRÕœüÞ›¦k‚ne•WÀYö÷ÐúUÄ5L¿PNŒT(_^€; èhX\õ Ù[õ»gàKe)ú•ì€Y™‹ŠÓ •×†ÛÌSA%….Q=_)»ÔiêW‡ß­|å­2MÐx+iÏ"fŠë_’ø?ð:7tE€«¨ªo>1	ýÌ-hp|b– =©æ–H0]?9+(‘Ä±j7Ý¼…Sû8/¹‰ä½6ó¤a@E‚ñ@ªZb;ú&5ž#z¶æÔÑ™ÄÃ„žY·¼/eT¼Pâ9[Œ@Jä“BžmËÂåbWãfÒ¡Ã,ÓŠðlÅÞ‰[qæƒED»Ê {œµ…k]ì„€{Ö4†k­cŽ÷Ù¥oOD*ã$
ÃR¥œÎ';]ý¯$ˆó_ŒŠSÏ*HJÔ-YýÒ‚Ûæ÷g…E{ý¥Y‡PÎ†×j¢…\¡gA?=‰?Þ‘íuÆ( •±ÂG)Àø½1K«xo˜P‘Š¬†]Zó«Ã‘ 5Öäz‡‡»M ð)Vj^"Ñ>iÐŸ'Ë	èê[9c½$ÿnÇÓÆB™¨i$„àÕd³7±o„Âè‘®LÑ]¤+|OÑeþö—Ô¦êÄNÙ°+%püVŠháíXì<‰¯½-úÒóqu’UóØ4 !!uFFQ4êG1³4eçÈbôÜŽ±žÃ°JÎÝP«Ã³‹¨õ|Ö“Œ‘?«áÅ5œ36C‚ô2x'ªy_0:*²>ÖYÌ«ô·¦OêÜ¼ôÐ×g	^‚I—¶«"úGŒ˜``Ü,»[]3Eµ0 g¨–)Œþù¹M4f‡”Ä'zu3à¾«V²l}¤ë¢¿ÔûHZKt»ÜW¹62#+†­®ZèWÖ+aúù5?~1s4nÅ&ÈÏ¢VPíXÇjEÅ‡O\¼ûê#Ó˜rÍ²Ó$Ì2Œ±k¾…nimùS±°æ®Î·¹ŽÕãZÐ7Ÿô¨Ë¾?Ÿù÷“Æ#U$?êSâ6ì€sÅTïë4·œXîÇ}Ö	ÆÙ“ef˜&èaÍšÜ%ÊZç£˜Öìa¯­i?•ÎÆÎª±õÝÍ{î‰£"°zÞ-ªl´rLÞ¬Ñ#½mRÓç£ñe7õâû<#[ÓÎæ7í?m ÂKÎ¨ó¬¶]-¢’½À…ä‰Ý%—‘ŽÉvÍrsÝþþø©Žœ‡ÅZÿ®Ú	ˆ=öø«¾ÊMAR¸ƒÆ¤÷=	A®È{öæE¿Ÿ‹ÀiDP ?X‹¢€QŸ;Aqã¿èƒNÕ¬Ð\—Ã0u
Î…ù™:†Sx‘D’yœåŽNÄÿëýë&Ý´\Óbèò­?”¦ç•"A0ŠºðŠaiNŠ©E*‰þO­„)dÇX,p„þy×è­+’„$Ä&,$jOÝoŽsKÁÜã0ã˜O¡Ä™`|Vtæ?}²ì ŒÛ¥ïÏïO±Z/2¿¹ÅŒUÒpÞå¿>”–~×ëˆ·×qd¤X#èe‰º*´GZèˆSßlsð#ô$4ÑÇ_Ì× ¬2ÝBÔê~Š:P‹þc•)’UBŽE¬ítt²ŽÇ—(¦û,DA”÷‚I÷üì JmAþ—ÞhAº‰Ž˜¯x2â¿¿,ð);{ºÕ„åƒ~>!ü´qÙÞz]|½õ@Is$û€æ—R8€³:B’ŽèÄ¹;°Ñ8ýþG©cÕ:ÀÀ‰J¦USA|.GèÇ¼ë¤¬p×xtlnÛÞ/±Òë~V¼}–pdºNêó>cJZø 5[Ö_-láº¤	ïý¨bãµ›Ó´ä¡›ÆÅ©êlí»1­­t:•ÿeCÉgò:Ün;•êû=-“€¼Ys!Í	ÙAÕ$y!xï_Uô±WºBèmŠ”íDºø\‡“lýÀÎP¾‹sWbëÌš°¿øµÌº£‡†X¸~ò*ð‡sõaäÆËÕÖÐ	·Š›‰7n,`Kíôlw2áÔ¬{ŒXƒÖÇ(Á->³ƒbÂ®dv{óý3=£òÒ±6 ñLì¨cê[+€r†XIf+¬™{¨Ü¹æÓ¡kŸ¤úÔ,ºTKØÿÀ¥VŒþÃLÞØzp=Ÿ‰îŒJ‡§ö‰%üà¬3¼
KNÜw²5ÙŽ1¤–ú;yîsþ»¤V–^Ò¶›ýó\í=›7(Š¶e+ÛxX+æf¿húæbì¬*	È f€ó»ñï&ó=­{f¿,zÌé¹šjZävíð‹,½¾ç5x‰u/ñ2¿ˆƒŽÙî9UU§˜–Ñùº<•jÈ˜VôÖjŠ`K÷š<{ŽÈ%q¼nò÷ñçÛNEÃØÕÃ ¸ÐgPtAí<ëŒéëežb¥NýtE
¯HísÊ0t’pœ*+fÏmcÂ†
ªŽDõÐ:Q Jm63¥™âð$“h„1<•öÆZoÿ,Dß¾ŽiKIÖqŒøJý¥"­¦VeÚÌ6„%§èÅÜ¿šhPÿÂC§.˜fK@¹9’&io40þ¢÷£ÞZòS,-€‡««é\âkkæÔ¡¸$&áŽ©S˜ïó‡
ÂÂql¿}õi‚èj7øÏpÆ8ÂH¥-##s®=—öEÍEÝYç‡·sY/þ¿’IJÄ<Y«§ô’0žžàä9× ¬ÙùbhÜÛ_0	U)C?£°`^®”yu’
$¤U€%Ò¤&­Î·/ö:°¾é|OW`i?;Å„HßKÜ‰
éä‡(ÕóÁ'‡(Û`Ífß­ úÊ)þÕ§1TMÊàÒ”ýi_•mç«š/²ãìòÞ×ô®lÀÎ×6™.Î¢)~ †fÓçœ“vWt‚P«T¿×U|B›O–
z­¤šwÀ¡Þ]?__ÍxŸ2Æéª›Ó¸æIÁ#px{J¨U0ËR9-HÀH› ÕÈ¤Ý‡NL™ 4
¹x@åš®‰®Î;Z”`öjÜécšº#“¼r3¨¤qwM %'µÕ‹n¶X”ÙwHhº~tî¢H°pÇvé?û>!.N÷ Y	ö´²`~s`º¡¬\WNhØ™‘c#æ0`,m/ñFŠ+stÿ·öö­LðàOãk¬p²HX„ ÓI˜néö>p ·¸1«ù>soÅE0©¬Ö"w‹é`$R µfå¾‰O(:ÂÓs£é=ûš ÞKè.ÄÂõ°¥@´•«rú©g‘!|Ÿ§hiWÌPÞµþO¶ãIçÕ	¦Ußï·5¤T@Wª¬á‘ÄW›"**¹Œ°ój]û‚¹GIÙJTÂ¨•Ÿf•.I¯c¿Nå½tk¹þœE­Ú9d“ÉzTû…õç©#†³òðEãˆf`>=Þ‡Yª-Å !».”P¹UgÆÉH#6ç‚ñ×…¹"\^¹(ìý{HuÝƒã	èó#/µ]›'úµªŠt¶°ð°‡áeì©Îu9a‡eš”ã¥¼~þ•ý m¬¹äy˜œKàïï†r{ä5÷"JSYd*½A=±h~¢·ŒHïA·‰•3$²HVdùõ¥B–uCˆ—ÐA÷£©älK’s™¢Ÿðï°ãl‰ð>|£×ªÊ—áÌR³ÎÜ”È_KQÔ¡9ÁÞ4’i«`ó§¼,öV˜w é\} ¡_æÃ¾'<æ‡<Å§“³¯W<ÿÌ¢e#X”´ÅõVæþød9íþ)ÁôÀ<Œä¸3ÊSŒ²Cy­Ž1(nþíGL«óE>*œ¹%±5Ï`Ôïî.r¦í,ºý†ž0ÙxàŒQ•ƒv¥2-J3$³Î‚1/×‹Ñ(
¦~ƒš+Á‹?R¼ökl¥LÛ¹küaÝ¤ôéNË+_ôÍàZ‰•ºJz@óÐkt†W>Ã?1Ýh«áÌ­Å@Z¹¡Y£‡ð@ë:‡JaÄDAã{Ñ¹¢"k—kõµ)¶¦s—
³“$ûÓ&˜M¾Ã2ž¿õZ«™§Yþ²¸‚® ­¢£ZO€æªÃ½þÖîØ:¡ïFøåÓ~Ù¯AšVA	»Š%ZÅkoJ5ÿu°{CÀüˆFéÚ¤@ù¥m&‘)YHˆ4jëN_dÝ›	ŽA±LÎQî=å Ÿ\{,—Ž!–`@…¶$”-<jçæÂêS7({øx6Ôí8òwGÅâZf•š¡Òhi]¤÷‹¶½Y=Gá·g*nSGïmäø$d¾*ÙC0fè-›“·xH[?%"ý²Ö€ù8ž€D³z]và0ZÏ5„¾ºlßŽÒŽ¸µ	Çq›;C¡¢å¦¾Í˜6¶¥Ã
]”S@Qph,¥FI¸™–y9IÐ›à!	ðUTWL§‘Ã5äH S}‡®ÿ>]%.Ð"ÄG>W+ö¿þÂ
àH‘­n‰ã´TgÃ¯Ö¶î>@FUœkŸü´4dÀa+ÔYÄ×cÄ·`¶hX‹Ç»ã nß(0Ìb8Z(æY9³£SÂ)~ÝMÏëÓ7Eäíô¥Ÿãc“o`v¦E‹ínk4E»§§¸27ˆG•Lüä¤ñO§†Ë"f—†;¥	Ãˆ™š¾b
Á|6)´*ØìŸY,o“ruqìÓ±vÐÚ©ö“F—,«VBž–›u]Ê³›~ÐIäìë,Å…5úlQ¾¨ƒoâ›Ù"ÄçÚHe‹`ù<üy±émÔ™ösÁ
C	.ŠÑ…Œ··…u¿zÕ´;ˆôÚ‹@]±ð¦’xÜœ#‘©
(•vmžq+”,	ÁÏg0évÕýã†kvE¡O0!O 82{c
,o"Ý·iá õ…~2vš-»x%A´$ãiÇßx±Ï6 ¬Q®@Šêø•©i8éMÔªÆF¯íîz ³ö^îòÈô‹N
ýœ‰8KÊWÐT8ê”x€m=¢r¥_¾„|u*2Ñ4ËyX…$`ƒIñ#¬ËSNY	zÀöÚH»$^ ÁÒß_¿õXyDÑžòÌ8ë9¬úo3NòT¨ãßà}þêôO˜¥½
ÌÏ´_<…éQb¬®×˜p[º°¢/¯­I59¶S“œÄ*ÜÂ¿‡y\ÇäQµlf]·>äZýêS„\l)uz–FÃD¾Ù}l€ù{ò(pîÐ.üØ¥!šJ¦ÐèÇµko¸ÂZöÆ#HrSŠó?—„6d›·€(²%—þ\5¹be,ßôWþzXŽFVQÎ.Åcùw+³þMèå¨fÖj‚	ˆ,€ã³àš½“jü'›‡ÝÖ—Á ŠHMAÝO´Î Œ £/Éó«™Hl<ŽÁÑßÊ‚ç$Ý3kZÚ7¶¬Ûhh9{![£} ùNÍtßÔ?ƒ÷yÝkÿbªðx'z,ÆébÆ\Ï²j2Çã–ÿ°v&h©ðÔó¹º`k8‘ÀÈfÌD#˜N[´:ìòdÊÚXÞExï&$áÙÒËàÀÐ®¬<ÉQ$ô!Ž€rË¯áÉå¯Ýž;œÿˆÀÕM§´òy)¥V‹KKÆÈÅñ©läsv¾iÕw¾„YÖdô”ËûP×¨û»!Ö¸½šûµ£Ï&YÁjñ,`váˆ¡Y1†Àx¥C‚g‚Ä <ÚtÅ›xƒh\b–y>Úc+úrïhÀæ›îO.£ïVQz80Éey¥ÌÈqå˜‹5ØÑò78ùÜÙ¼)¹šhïv««‡ÆwõUdLï´ŠxÝ÷Ñ½µÚ‡‚LÊy‹>dÐä$è+æÈLR—A£ÈñY.¯Û­ËÝGrÁ>ÜurVÀñ:VåOc(>Ñù°÷'ˆk@–¿nqæŸ—jÆüÖð`ŸÝ³Ò$cÄÑW†–,[í‹•(bïü#Ï ¥†éD‡¶¿ßÌvž¬åH"fë‹å^qƒåg'sB¯NæØ:k¬¯ÑZ–NYé[¿ž¾Q5r»;‡÷é„• .”/)¯æïë¶Ö3Æ°U@FûÐ[?â8¿à…”ªÒßIÕ›Ô
µš)þK6†hÂÃ¬Uï' iBG®…)Àå"7bÉ]ˆò9ó£–iæ)½gj j‡õìoä¦vÒÄf¨âæéÑžf0x÷fÎNDAfi*c( ÊÔÀî`op¾n³­W6æ#ÃÝë<aI§RºoÄ5RÀ)™qWGáÇË±ÓŠòªêE‡FE­ÉRí{U7Fq ô’;–ˆfŒhçßº_ûcƒˆõ©zñžÃ*VLm3<³u€t¨þ±IUž98ðÖ­·Œxê3q{0œHA¸ù ½núZ¼ÇiV…Òæâoüy ©{+[©[»ÚÐùiSL­t€q­X66{+}“®ö€¥ðW+¨‹WFÔ=úŠš-òúr38Xæø_›gmýÕ¢;vC˜íðõ¥E|Ô¦B® [É_3#]•ÒB½—‚Tü]`Ò°F8§#maè¯=dåž%»ß0«Ö÷ÕwPì( ðäŽL[G¨×›ƒ ôCHÕ€4A\Ãó‹Å‡di¼mN€qö^‡m-*]:À”}^„HÑƒ”M¡«uµ`˜‘Š/·GêÌ;2Ø©¼§Ëòð O£a •¦j§@ufÎØN±´2V ÜyÏÆå‹¸ÝQØ(Ãe’€žùÇ.÷ËXâ4*ÄœÓ]JQ›ÉÃúÄ§¥ò¾ZÆóóF¿x­CI´
b²ìD4Yú‚¦šãÈ¦v™_­UÖ‰ü˜o‰ÔüA€Ì‚T˜ý½6T6nµ5ù´ÕÛò222óîò ïây·ÔÙÀRî°HÃ—Ç0LDHìz°}ûP ³qÀŽ‚-=EëÛiÓW/¢–<ñºJßsf ˆžIR‘ÞÛ§NüéP4fì$V
~ˆ’_	øHÖÚ
¥¨S•—jŠ‡Ë‡ vö	§”HHhøCÐSŒP´Z*ð0FÎpª9“f`8êo[aõû¤Ñze#8¾˜»'?íN[4Î˜\D„?eSÖ“ÚB–ª1"ÏàOXz£´ÊƒôF-äå9´¸9OïKó‰Fl2?öæ¾¡%®9Æ×j ¿€›¦ñönbõ	€ž%c’füá¨ÊÃ¨>îƒ+~ÑwšqÂúH›­§ë€
çWÄ¸Âô.“Ž¢úGP²˜ð¯ÃÈv—3ÇªT¦²µv7x?ˆ•]iì®j?Tºžœ»cu *H¡%
œw»LJÓp“$ñwtªÕ>6²¬ä(>FÐÜ±5ÖÑ{ª,ÿ‰¸)…ÿ'Hºdüæ^©RlÑ«ÄDðèŒY×W%Êk¾•n¥ƒ6!À@ú!ú¸$ &
Æ–Ú%`vGIP¾Q±«Óþ<PB'Ÿ»=’|,+ÒÐ˜w%¨**˜²o‚fž:ü…¹¯¼Ç—ƒ!®ð¥°·¦Ó’Œþq‡Ë?‘VŽ¶Qjˆ­Óa.6jˆG©ÝàCÓ£ÚÉ#YjCJeEMg¡N@\IÓHq¸2¹uw‘óð»ç”‡ƒÍ ‰1“ÒÐâäÍ»
½£sÚ—ÞG5C6¦ÂtxëKd±®”“¤®™³\/<¹†0üÃ0“	¨lïÑo0öËt`-V‰þôu_SÉ÷ƒÀr +„UTÝ² É‰ùMü´ÉôA5TßEà„U¿R‹5+žÈŸ†à¬èÓJe¢‹RÄ6­ÕvŒÍ='QåmAŠ’ê J§”³š¯×…KtèÑÉ¾Ì]qÖ	¸GÒeÏ‡µË§ÀYÝžöÙÖ­1Ê@!]vzçÀpîG”ùm«I_Nkr2"ì—Ë&>iû´Ö’T¾Â]Õ)ß¥Ô6..ç#ùð®n@Æ€Ã]šÊjÏ›R{ýY˜ÓèìÀb­cÏ_#<ì@JšçÕy|êÖ!KÖ•6Öú™UÅN'XÚÂï0XáÂ¬Ç jÀbíà³!2Ö« ½ø:—ÿ"!¾ˆ&å.‡gîr&4°!ÇüQ™ê¼¨$BWd õR1<S<¥	çðí/RŠú"m„J+âK²dî:¡’Æø£%hšÎskª³Ú-+Ž)v5¸7O5O~ÚÈC6@;Ìæ³ëñ´Ú¶¯íá ÈˆdL–_ÌJô¨ß²ì~¦©ºÂbÿ@¶¹|Çn÷Œ›‰„÷…<AµÑsÅ`Sƒ| ,Ü6 |š£XJ2ŽMgÝlp‡5ÝûŸè^Ñã¸Å«¼Ç­Í
Fn—‘Ø™·™9âôEœ‰ÐœA£µ\¾o½°ïkŸìöD0ûtË¬y¹ß¿ëG†¡b5Át’îÓ÷[òC6)Þ,ïxÕ=ÖûA=<ç¨K«öñÊÝ,š¿8-êè
{’ö Ô5bæji¹§ä$Skm±)XƒÍúTÏ#¾JÁk‘¶¾Ê	k£MKÿdÄËT"®æLÀ‚ôÇ`¿ûÐM<pðÙl[®)]×T5áÕÑÊ<?H_¸8ÊñÍ·Ä¡BÚ„Báû÷ÊdGfù9òÁ7:/¾>7{­I†ñIºîÅæÃàJR”$Ü¾6|ºÇý¢?àðñ	jÈ€®`ô_‹"s+~z+¡L•{B®¶•3\(89aáÃXØ¼ÿÎ/kõïÆÕ'SZ,kþß»2êIËqi[ñÓß„; ’iL6ày®Î“hi®©<z¢#50F`ÂÚlì=ùíª5F¬E¿‡NVù÷•aežì
×6t¡5w¾8Ð˜;r°˜?4(B‰L±±C!ëp’I$±Øv´=¿µy­YŠâZˆ8êØVC Š¡“Éh³îy „,<Õ’
÷ÊƒYÓ=Šq³|U¹Ùô$ŒL™-´pƒ5´p[ÔzhÛ±ÕïùÎBHé‹oYÿ±s^«v¢©ÃM³­îvË¿$G×Ò6hÛ™õ<m  –Ì„œ¼ðËõ_Œ)uq®þžæ¼¦Â{æßš[+´`ÐH=Ówï!Eu'ª¦§‚Åaw…–ÐÜ°i+Íå‹ç:qÉ‘Öù{VÑæŽå¸vÌŸrƒaábDbç½öJY^½Zê"a§UL/Ôòs#Q&‘K^Æ&Yð0¡ÂúHõ€BMÝÚ	ßådr!”Šçºü=<"÷ˆs»~êŽ_˜ÒŒÂ”!‘õ%ææx5¤ë0Iz.ˆšMâ¨KÄÒ¹)ðWò{Izà5ƒ›CSOz\Eö=è‹¦n€œXQwó^,HS£.äø)ÎÕüþgÝ¸JOÏ^;ƒ.dä!âÉà2neT+¹ëzDöà¿¾Ú“¥ì{…Ý%™¥d'ò— ‰Ì ‡qh÷R*¸k á]²¥æÈ«/g±†ª$ÉeMþv<}ÖqSU…(­Á
6D¢¶.ÔÖ›¤Ò½ÕPej†eP®Û€í{uÄ ”pç{+86ÇU´	–h xø,óòßÚÏ˜Y¦…7T}úJj¬×£m^ó’HûÔd25Ô8ëÞ3xíÎ.vZ¦×Òœ3úP±`…ÝQo¸]v§ˆPöÙÝªPALïujÕ—e7÷ì÷ZFNÎUÊÀ-z-ÔQàý2)®üó§XBfÐj¼%ô] 6Ér2/5F@¸[%îE&ÿY5	â—Y oK7‰c‚¶úW}f_ßAßk¡ò)Ÿ-’¶ÂP|âO¢|¦’c<ÓÔôÅ”vN¯¾ P.Ã\ä’Ýö%­@±B®ðÁ'ÕàßzQq€þ2@dµØÖÂC çµ&ÿª DéæÀØpŸûV9Jú$FË®‡Üg5bÕ³ÐW>Ç™P­†€ø
X-ECO®hÍ‡ÊëýWèuÕKë5šPÌ¢¯1z4~+œ^—ÉÞrJ”›ÃéâîÆëÜ })["RîéHnž3Žn€C¶°lÑÊ€h'$ÆÕ‡‰ íÜ~íÙÄKyôIêÂ[’ãÈYª?”–eäÖHßc˜µýßà…ÏC´Â4&'ÁÈ…é0›I¿rÝJe`4K8­a\œ –Ùj´ÍÁú9š|º#ž;(Pîd-ÈQk¥â.ü^M>š Ù®; „ÌPgÉºÇõ®U˜Ùq\‹ƒG&Ø¤ßÌ‰ÙÄn®¡Þsk¡…è“ìO
aÙØ›úÃGÀèµ¦N{pP/óƒ£êU§ú¿CÖ[›®‘JçzIÒAŒG(CO-’1¼ã2ÐKeÈþ©2á—ùéyjR¥¨ë¾>ÑÒ*6áÓ]á¿P¯|¯_pÈ«Ÿä9÷¥nµnT;È·°<X*}8h“Õ æ'åˆ?wÌ=;s,Í¾Ëø¥V Å
›†È×—"ÞÃ ¸ …Â=x"CO
y´ Ê1æPŒû-ÓQšµ”NVþ©~Ìš‰/Xˆ¤XëØgb-gF/P¢a£/k`÷wEà±ËíoS_f#yôq‰q[¯ø¬²ßrŒ+;°‰DÜaÈ÷žÝÒˆ‹¸u²8]µ{oLÛ­M*«ÑÅ<=èÐ>L‚q•/ÊlÊï‹Ã54·Cˆ`u‡&ŒIÕ3"jÔÌØ›¨Zõ´­Höja·†ÄÂ‘Xh—Ðc§0chŒy€‰:d,³Ð]‡˜èr(^PË‘à‰I¼QÑ¾_w%£ËÜ&åÞ	órÉñÔ”ð0~ž[)WQŸ¹"!èbèœöO‹ÅŸK¯eØ¯õô(·¼œåV“w3£¼HBSDÝC¢
æØ*wBnÒÏþ‡>uÁaaýzù2†LeŒyx|YÝûîºö0É	"ÿ·þL³ÙÚ‰.í±0:•I•·øv\·ép†³ôõoŽ€$V±A'Ã@?L~Œ&0M¨zøÈ¯!î!>-‰ôŒÛÊuw¼*ÂóSÜ=#‡oêÓO`íÎÅ@¯.tÕË]®D¼—•è7ÝU÷þ\‹…^¿ô,?Zì}`èop&bQIA‰ÞÃÄvˆÊ)­^2aqØÙo4þÏ?®;tÔäŒE~|Z=C¢å~	·m·?@úV}R"¹¬uÂùMLÅãÙéß¢˜™<2IOÞ§cÜŸ‹½ö£îSi†i9ÂávkÛ7‚lõ$âCSnûª¹À^n§$”jÄàÿbØ˜<Sõ«3IíüD’ì¥¢¨è½TC]¨¬ënxr‘fP;²?bÈa OŠ'É“”PÿŸx©E‘AÞ?±^cCâ*ÅN™·)h©‚=^¯G¬¸ \BÞ°~†ßã"ú¯dhæJæöÜy¬Â´7…Ã#C@¤Õ€S¸fæòšï]B«ÈJ7`œkËÊ¹ŒŽ,¨Oû­xŠH!ðd?ÉE×z®þJ
¿ÄfÓù	‰ßoFBD}¾Tˆb–‚â¿x‹Ÿ+ÂÈ2Žß™˜ŸÊWf}_”9@ž$QËˆCÍiæExˆ„¢¶ñ¢ÆŠŸèM¢Ü °\*®\(¶4¨Ö4'~Ú¥pUÿÚ(J¸ÇÌ¶½Kè‰®ö¦,Cø¾v„Ï¡òã‘Z„ªÔLÊu],
e¢÷ô_„&ƒTÜú0ŠÛ=­¿
’'>œcr]í?o Žx¬Ó	¬ªbôÊ¢zì<¿šY±õí#4dÜûXµ~lqw£¢+àP% æ®óÇmÔ•!Œçà*P¹ÓvÃ…´¿Á"Fû«ÿ4xßfõT’EâÚJq
óÊf×þSÑÄÃeÜå	 9W”P \[ÿýÓÎ DœÍr¯ú|ÏÜy×#Š7_"£ÖÊäX±?ÿl]²Qà]W‘líÍï€¢D·gDl&ŽHvÆ•D†4§è?â/m÷÷}Ý&šŠ‰b||â7ÿ	P¿#ºRE‡Æå´õv4ñ2s†øKò+Zµ<à§+ÇõOHµsŽøÕŽlƒ’êMšLÖ)åFÉ¢r”¸×)•„a‹9~ÑÏéÊŽ)»flÎû#~rxäùXÝk	M¯MTl­¹¯kõöÛÔì“ GAø3_/Æ1&Ó“~¾ Y´¢8ÊtcÅÙûÂ–Óz¤Ã~C£,}Ç¢"é‹ŸjÉNö!gÊCëÔ<‰"°HœOwQeŒÙ¢¥Zp„÷2Áç|œº52«Q¤¾²YOÑ%]-Ä&N¾–œqã‹'áþEÄTÄÍN’ïäg
ü"ïžü¥I¨ZUÈ ¶Ÿª2¶¦Â½Î)qÍ×O¤c±k¿Z¸®­fwt9ÕÉÝµ]P(ƒ^œož&rgòO%½˜2¯^Íj#Š%F5”òÓwm:b,"´ e+XbW¤39~õ5kN„‘Ê.­–óÌÑ|ÌÊÜ Öxõ•'óX:®'ò+à&kH)(1çŒEh(ñKm'ê¼x¯bŒì%FvÔ4m¦ ×)/WØGòqø8ÎµQ/W”.p"âÉqÙ”aPv"ëg…ÅÄ÷&…NàKëO%7‹¨Lr&u1(k!
yÄ0¡'ñ‚~¹ÑîºPÓÿ7b6Ó®< ‚äŠww_²Š[c¼Œã^é`wŠý˜{’%x¨$Q}d»à5>ui$Ç¾ÜC—Ô¶¬ªÕVCñ¬W|•·~Í¸¥f€Ir¾‚uÐÑ< `e›aâ 9 Ða7GÌúÛó_ûÅÌDØ`5P¦x‰z5-G©@­‰¾ØcúDRÏOì˜løØñWXo,ÏÝ²Ò‡ÙêÇVÛÆšdÈžq7OcÞ¡üO˜e5A}Ÿ!Ñ¶›-õka;B«…1³‹N	Dû‰”ê03€œ^Ò™Áhó¬sIxës"$áð˜µÌF£4ŠN$€7ei‹Žáy1Sœ9EWÅ¯æ ­Rv„kp¯•9¾Im_ôÞœ'áXžœ£„é|	œ`ê=òÊ@LHtñ©wàŽÏ¯ž¦ÇuÔ…ùv·g@‚¤ä~i„ØÆ'¢ ‰ÈÊß\VëÓ#1Ž¬±ø† u£øfŸÜÙ…v=±œN)".÷«[94 |Ú§~kQð¾õO¢n‡kIŠ¾]]Ómžý«Â¨…Þû¥¡lÐïÝÙ³éØP¤r¯ª_2=‹ö\\‹Òz–«ÁÝâ®ëFï_½uÔŸÍ«hí£ˆ÷^%„„·¾²‘mÃuaVþ£ó{ú?gÚO|UõM*†(d×kël‡õ›‡Voƒ‡Ô|ïiÈ¡Ù·l)pÿR!|34n|(©ÿ6CÿéŸq4t kaR]c\ÛîA5óÒa˜íÄµÎˆòI8ºÍ¸¥—i$Kr2s>"[ŒG%ìTiLka¨Î€ªŠ“·îÊ]Z—úúG!u]8>êÌfcJrðX¨~Q\…ºS„Y¬ÞYÅoŒÕgŽ)@"TÇÄUw¯F6›á:™jà¼¥@'˜s;9 ÂEb:·–4F¹t&%sA<lev½B6Ò6ê‹ë2³
'Ýýi}ÆØ0@õ)à·ˆš«Í¢›(áØE}´e%dù›œX*³Síãe*Û&ßx©yuøÂ*ó¶‹~«ßd½<N9uEÚŸÑ»,RSeŽ>	 B9‹œhSñÏþÔª:Ök¤Z/¿ÉÅŠïØ°»öíà"…¶:ž8ÅWVã ëÁ{©»t}ëip\¾'1q\¸e‡ò5J¶©ì8o´%Gq§3ºÖ‚ŠÏAîéÑMãb!ÞVÍ¯§n“OgÅñœy¡9Ð*#»,«ˆ„XŠ²ócØ±U%ÃnZß%\•m“w7c¶KEŽ§™ÁOMð¬ÎŽ7F>ÂA"ªV%Aì™ˆjbß “y©r¹•®ûxËíFÆÐÂ¥(Ï§A¿xö(|¬¥ÜÍ}±@ï=C;hžÌ€l|Zî*hÜ¶rÇÌ>ùÕ“mÎ7Ñ÷&vüÛÀøá8ædöóä ¼3…¡^ßc©—nVú/[Žgxè­ª¥˜óI9¢²¨çqø¥„lçÊUÁÄ:·Åª&‚V!4÷±RÅš
n÷UØt±=_O™£5æ¬×»ÅXÝº=E”ãÌè-˜º)"ÜN•í‘ÃdÍw®“î‚Òq\È%ÇzþLNŒ¡
zÄÐ)È6:§®õ3"<÷@ ô¤XM¼X‚˜lT&Ô…BÒ×<Žq².öT·á’çmöªÉÑ–¿¹xëú~éÝsIÄòMÔ§ç+âöq’Âúk`‚•©\•™«kÇÏ"n—’×–Ól«ÚÒ©÷môÁí˜0$!ßqÔ+Ç@·Ë+*VŠTãpn' ËoNovÃÏÜåÏ»®!;¸y[}Œz>6¬<õúîë‡)¿„–Ã¨˜xg‘{&ä¼²>Fl»<Õ—JÖÇ¤0¸Í'…CÝ²Ä$æd¬/rž3 @¡°Çeý«YÌ~?í[4ànrÅúõL‡Kƒ™Þ®XS°´ßG1|#»o•RƒóÐÈoûmŠÈôh›E@zÊ<A¨cð^§bÁ¸²}È€ÔÅüøH„dG„DØrdÚ†‰j5%LÿJâãøß¦,{<»°M¿>f„ ¢‹´ ì#NÐ8Þa±RUtÚe1(Ò||¿×²!gÕ×õéBòÓÃ~ë­rÒìÿyË 8¥Jö%ÄŽjÆ”îÇ¶ø„KQãÉC
~†ïõ€5'j”LZWï˜´qf‡ýˆ>‘-üç0Ôykî„=iÿy½C´Å7?%^w"PŒ¸a{lOD •më9Üœmq^×º‡¬UŸÞä«0µ'êý0¾‚¤µ¬/ƒD¶Þ‹”á-j°WÜ-ˆ/¡Õ´FmFu¹rœUÈïê]q!Ä}I¬Â=!"N¿È4vS£=Yèã %p—pmû© QAÿ¦ ÂÅ{Âßa{?'½êPÛIzbßxÄŠéKÏ`ÏÄy;ªð‚þïOÅtb¥öcÔ³Ëë)3aAW ŽÖºÔŠO:¼]Ôpk\	)N·ø„7jðòcJÃ$åQ¼Üî‹/‡UÙ¿«HR4‰ºLmÇÉc…e„€}®änýò\´‰s°½tvâGëfêùÙ0O™¶I™`žûGC÷¡)ÖMý”}ZžŸ¹hÞ¾Þ®ûì}ënåŽH/£$«6^ÁŒøÆmóœN¼f©”¼¾q(wS	äÆ­‚¦)chËåd^~àÌÑ1%ÝòÿAÃ¾äf» ¯þê[“”¨Þ7ŒÔ,¸;
+^e3ú@Ã5>#2û‰MƒÒá¦Y\¥M[¢ÆÉÆìÞìÖlOû£2ÕØžA½%÷':3‹àîG8-b”Ö1D¯µöa}m$r¼/„|­}GX6¹v Šk¶ßê&Ýòÿø»m›”Å(t…‘Š1qc€“ÁÈ1Ým®Së¬kô?1çÇ‘½œ.dÇÌîÃaÊ4êÔ‘p{EÂ#õ‘$òà'ø“—x;Ùèæ-B•à½bNàts4n;Z©}%Ë^¿´ó‡¹X3Ä7«üÁí,£B¨Œø?Ðé!#¶ÓÎ¨õÛbRs: ³:M´Qß|~„¼ú`ÊBÊL£~c‡‹å% bæ¿ò‚ä³_q“Òþ;õaõQßº?ü«Œo‘eÛP&Saªû—_0Äç³Ûëÿ4u¿{N.
ðÁ„}y—YÏ¹9:0ØéÖ)#[×ôX›)% æ¢¢«Á•XÃÂËiý¸œ¢½ßíídÔƒ_˜Þ„üu(þ¯Ú$µä]Xùa4ÂðÕ³æ—#[+nÞö›”ú7^ŽoêF¬ëžèèæßâ0ªï“hF%;úìã‹—Ù¯Õ
öUqãº¹ÙÂg¼&‘¡õ«`éhL³Ç³—M8uh)§õ4]oçx½}CØÇôê˜¥ñYàSª¡Ðˆ«&bÑtìúÑ—øîªJóÝ±Ï¥X™ç¤H0á'0ÕªSè )ªÆ/GyoTaFaU*Qï”Ûˆè9H0±OàÓH—ÍŠ-Œ+póÌV…>W×3]»òXHIú¶âãQ·a6q XþPçÍ°¥G=Ášiš%|BþÿEýl#Õ°b~4âwÒVðoÐ!Õ’¼ly55Í€GcRLkKÉ{Ð2†÷ñÙ
ð©Ö	ø%ÆNr]Y­Y·§ë» ™'ÙIÜÎ©Ú'™WéËNìË÷Ýœ×MtÕû<„ˆÏ©ëï
žµ—õnË˜Jˆ-±—WcFÙ#`Qe×3ÌkÂ–;«Ž]Bë>:Y‘"iÇ.f–b<ÁRJY:4!?Æ›øQ MÌ¨gít\œùöüÐ–Z›S³Æ:\|Õ¨Lˆï× ø7x(\£xQû<¸v0+
_†ËË*\×cPÑ3âÃ’ñˆì„„RêLçvç±y}Ä&H‘Ö±QÁÇÖê°>èƒªŒ"ŒÁÙR¡ƒ,~aåo´ˆyp½m õ“ãuég[ói-Ã}¦r+îØ°=E@$ml“¶ˆÄ8b8w'AŠN@M ¡F6v?F Q ™-y—HçÀÿIk”]onØ-á~è¹Ñd"ñ|ã£¦çÒ#Rpúöci“H¬ñäß&_¾c¢SRçóS;uïmzò‡‰ø¸»Â°ÖU'ï¶¦ÊQV©ºpÀ¼‰m²Ž¹Úà<J¢’Q!¤¼¶Ö(K©>b1¹|	»>æÝÉUÉöp÷}˜éIÇÆçÊ ¿†ˆ qÇ•„ü4§à×b õózõÔ
ws§­¿1áa†t-7)Þ¹¼üÅ¤wÍB[£ž‹%2ÐÈâHä'
ƒ§j"ì3t€‘Ti5œJí€ó’ä$9wAj¨r.qáèéß‘gaB–0/oÝXñ¿äd)È¿ª¸š@\Qn~î*˜]€ï(ZõãœÕ”ÉmxbëTùÝÓB›`ëÀ ŒþqÓæ‡ä½sjRïÉÁL¹òÌÙ*Sþ9ÐÎQ¯ÙÄJ°å$ÊÀ¹éak,ã[4b¨
m¯Óò*@²Ëó£–¶}ñwm¥áß8}¬µ!{?Çýf
!ÿõ’†`¡"TR;RL¾¨ÏçI°)÷qï{'ä\è½ŽÍå˜˜™S†r&THb…,9ÛyÍt’Ül&3OƒW4žßäŠ©GVIÆccÎ{õIú‰Ê½,¶*"rÆæ}_qz‰¿~cÂcn0RŠ“ø5º&èxÊþjô‡lõ/Õ‰%BÑË3ˆýÖµR `•,g‰^C…ý~k<zèùôZñŽ!»8]ƒµcK¸vbæÌzT…¡öýrM•íh$“ñ¤¢`qp(QåK9sKÝú\„¯±Eäp®Š€µ!ˆ-ë­ñv˜†iex©#ÙêÇa:<Ó,¶y$–d¯·ˆŠ	‚'*÷òÌ¿áYîÈå=ÀÉU!BÈO*ˆ‚Àöäí?Lù`˜Ù{î——"‘NàëxW–Ÿ{šo÷Î”IO»* >ruãYñý¿»þÇqà^Në…y>nÐÏÕì^ÁcZ™'[eµ¿No	‡6_…³Šjst´»ì:/L­‰Ý-ãv‡_@ªá+Óì+áê¼£Z™–f¬m2bÑ°¯"Mh³SšsÀ„3{žêdR©¨áNšÐ±š‘’Kï"ûDµ¿jrÚªâlmHýßu§¾yù4‹/%³)¤QÆ‘gŠRz¦F¤g;Äý½Êyæ¡ƒ5¸O9SÌ!¿¡P5Û7æ$a€jk¹ž|Ì¢!zGƒ/Ú NSÑïiu‡œ„àŒµŠèÈ¤†lY8Ê»aŸâc$ëÇškS>3<‚SûšxRÝíä5íÛò½­Êß³QM*€—,5(8ÄJA€™¸ÊÞÕ¹Ð®ç8ë-YÅÅUÿ¡4y¿k†—í1} ªÏt*q0Ð®Ãè(Z4„Î?×´S•§P¤äd0Ñm¯ÓgÞì%t!ìüâÒ’˜çUóuùŸb?‡Íá¦ýºûŸ8:Xýª+ât¸SÂ“„F hRc‹óòš&½2ÚÒ|·¡ÆfÛcmXòø$nèÕÛ•™XÛ¾,!‹-“:Þ}TªdóâãÉzD¹š$jœF^0g,XÈÙ±„[gq"¸Ï‚bñÎŽÜ¢àúPÆŽÔº š­¡Ëîº¦›ê’£›Zâm³aL²0=ó{"L4±¨a¼û–ÿQ§4Ï{ì/^ˆDvÌæ·OVp´ ¬ÙjŒ‘»aÉ¾@”‘‹fàfúHÃ³BL.+.‰eÈ–67ë³ÞŸh‡¦¶–.'`ú[WH`üG‚PºF
Ù?×F½›rÌì/¦ÀqP¼hºð˜:§@Šä!3¥
^émùÉJ¯?hç}àã þ†æVÅ¤®£!1	Ä-`sæñ®”x^?ÖRó½‘@Þt¾«ð²SnNŸS2m4®‰€þrý¡Žï²Òáý3ø9{×y? }*%aKœ\–1Ÿ!ùÝÉdHªÏõ´k¥|°	Ôèœ¯hñ¡Ž6ù&™8œù&Ä®Ÿ-RŸHöäBðâ!ØAvŽ€çîæ•
àø¥ÊG7ÄÍ'	Ã•ß­^×tr5Ó
½úü[Ýr¢´»‚PÏâš“¤ˆ Jþ6Oˆ›•î°æFÅ>îWaOh>7Ú1XtÔ…Wo/Î©¢pÄž
}¸åÐMÌ'Ø%y”p¸D2ÚÙ¦î¾f…‘O-O6¥:G˜š›ÓLK¢,½Q8ÎÔ!P•wûL£ñÔß1„Ú3)I;~ÙÊËißÌ®×_ò^‹j3%¨ëKH”²XM tœ§Sºù^[Æä 
³²º"ÊËYß_{î4ÂîÔåTÕV)Ôs1~kÛam›áÇÐþ9OŸÛm·Q*"\v=2’‘ÜÜîCÜ2ÓPvnljAƒ;¨~-þT®6ˆÜÕ¯N¢âãÉ‡Ìrëò†±7½Úq½÷KFA‡uF2XÂ­òc™ë.kº©æQ($Eï†„P™cqø68{un¬´B!²þ±”»"\À2sú‹øHXpmÕ=‘{ýU½µmÁcƒø
ÁóÏãiû˜A8çfÛ—ö”?lc}ÔÍ¯—Xææ¾!25ËrÝ:g÷JGQ0{CÉÛ¬Òz_í¾ 1Þ¨˜½Ã¥ÛYº+LNÄ"É—ç´iuWDL:Å$.óÄÞ¦ò47OT p"ý]£]|ÉöÅíV—äöYˆ–0WÃ?~u=Úb*+hW@`Øµˆ ÏŠ¶Nƒê‹Á’t°ùØøðñfŸ
€W97Àë1×ñ]£ü,øÜÁÎÚæ£•³?7Ù¡_žþå„§4-s™OŠï–jc+J§bó´,£Í–×ùaöþ3Œ¦1BÁ÷èêi¯åµnvÆ¯˜/*¸³†³ûŒ^›zÑ†uBžð´.:Ûž$ã>joÄXÂ$±ŸeûÊÐêùTf=YŽÌ@á“G¢.ç!ÅÛ’wð]ú±PiùÞÚ$èLUƒžµÚY—íO|§Ä":jÊêH pA<»·“¡Ë<W„Ô[l Šwäk)F¹ISâˆ˜,'V7OÉœR ìBÅÂƒÑ®ÖN±PQ›îßf‡lŸ7%¼KF¢ï–Kmð§÷ˆ´`aHù†{üKÆÃkw/»>-Ì•Ú^×mÉG%_Ñ,~;Æ^ÁÖ9&‡ù¢ô’|˜kÚµ¹œÿ³ÿ[³„Om0¦~Àû²/Mh$à·÷^ìgöSéIh0Hh÷öj3´²}kß‘x(­ƒYÏ@^#[h;˜*¨ØÉ»ëmÞ]¥dŽ¿Êg‚®–Ps! Ò+dN(÷PÔXÈ-†-ƒZ§æ¾8ƒ©*FÍ8éCäï‡¸™	&b´C¿õÉÅž½É{W©{F4êfÊFBHyPâÁÁº(´É¸À‡(–jB!Ûïü£¢+Kïl¼--5¾üæÁ\Ê®PÂSQÔ2³2… –AÕ°üŠ´£QD•eŸìêXÉ¾‰ãljDý”¿Ûr¼(>qö|Á‚Lê?wò(²†vä0GØ¼×qÜµ2>üœÅSTeIw	ú¥\îºe3m!WS7 n±²+BÁÂp¾Y²B–V…H+:ûZZ?—Æs£ÕxØ¿ÐÀÃÆ"W—ýe·»uÃö,eyÂslÛÍŒš×î›ÄJ?¶|“™|ê´bÈúþ
®«Á–{wÔø½â^{Ì?Òñ™Þþ¥£‡õTn@í*A÷®Wxõ÷ï4á£“ã†µ’€"¸Yƒ˜­­F¸Hf#Ü­cÄ€:æ0§JÏìþÂMtøîy<Õë$ N~
}6PòH“oeëúçøq>eKžmÏq¦¯¤êKE¹DR.Z£•–x¹np…ŠUiß‘He¥ß™2½†²®ùºŽuSg°Õ÷^`PÍÝÛ
òÐEŒùËniƒ¬ÐY˜ÑÕ{Ž¢‘Øo @v‹ö"»du)øÜPìãnðº¨Îèö³x$â±8|šÑÈ$ñj>¥ù‘Á’èŠ„Âð\Å¥n‹¯Ö2Žª\;—ë«Å¦OÇ¬Š™8?ÞlHPÜXcÇu*Áö•[@‰èÉl%ûO=´ó«ÁˆÕ{Å=Çõ¦/FuáÉO¤9EG!¡ ,¼„„>^®NªWGTH’a#RZm%lÀEð/«„jÎBÿ7½#ÍÍRNÕígSwp¬Â·ÊÉbÑ–Ð—®’O”¡Ÿu¯8½ÂüyÿÅÁþ;ÖòùY¡å°©1éì®y^…K+\TYœš~¿\ðMð;'TXZvú¿3lCXzb€¿	êÜ1Mÿu„«‡k°t3˜%åüÕµŒ°Áx}€ýù«„ê ›ª=uÓ‚#ÇOµxÝaFiñHïÎÂ%É#†f¶¬´n£>2wÑš®ï¼·ôÕ|é_Q”Ôõˆ«¯ò«ø4û(¿Ø£Â2^r»7xÝ$7"ôÇ te„Ú~¬ÉöÈ·IÕý÷ Çõ‰Wqv8—Œ§/ ËŸçœü÷Ög“LE/æ1è-c¯:Ó(mDë¿+Iµÿ6«²ëŸ¸ þÇNdê;ót	•­¡ !eö£•Û—rMLÞ²Câñ¶_ ÷=Þ,zäüµ,,Þ…·±LR`Ùß¶–6bÈ<­r wäšœ*•Eñ;Š¶n”[3/^øþüÞ½ùÊ]àh–et¬éÛŸ¸y£°—-øaÝYlrMÇS®rØ\Vý>ÇmrÜƒÀ×ó7«oç§Pm.¿éµº”†¨
Bff%*mõÛh–½ÛJçÒ”šŠ[ðá#žà¤[‹ð=âOà3â.zgTO#¬~ÛðK
ãOa2ñps‰¡ªœ`*	$7Ëù´$wˆ'Ü/b´>Åê!Ýý”¿ðŒðaïØC7]:—Ä `QL|ÏÆ‹W:íE‡Ù~+K|zÑ(pî>"Xèõþ9)Ýä°o½2ÙŒ­R0DcØAL¾1%œb¼è?U'Æ¤·Auý5ºÌW†<'w#(Bîí ïl+-~i˜~,m
žoB‡ãÚ”‘å˜<â-avg'ð2,Ñ÷Ì•Ox"©<ô…}‹ÚÉÕh­9YH	¶]Ðk2¯Ñ¡y¶üø*wî¸öZr
txî1H°Ì7j8s°ZÄ~%oòEÊOz2’ryi$ƒ½¸¢pè’m‚ßQ±3,s*õÔKó
‘à‘¦ A»¯„:vÎ¯Z„0¯Ìœ‘œOôò‹’1>&‰)a_ý’_—ÂÙí¦ñ|(‡Ù"Ò2Ô†rÿ8GKÒvpè4eÕ1íøüþò0ÄƒÇù°0(€»9²IP±š# oaÌdÍ“sö¬”« m`\½nöìØ´WæÎ¡Ií‡ÆôPF®~–—2€fu*õ$tc¡9U(gì@¯äleC"þ7RÏ¸ Øˆ5DRv4ÝEß@¤]J,{ÁÎ™wd[jø_Ú)¹pá7Ñ#ÃjÞ“‡Ù’~v4ÝfÏMæ0e§ŽÏo½Ô—©‰ºèÏfZ:_·)ÛüÍúi.
«1b.gH˜¤öcq‡Ø7:ßÅ¨ûàÛ 1zéäùÕ/ß½!ýˆqéS(J­ˆ¢àå#¤"p÷ºFŠñRÆæ–˜þÞÞOÙñÄKx1$´}ð.#â3T „Ê™oo;h L³)½×b³?°ß/kªœn{E‚õÈÔO6Y+	i4b"ØíFÏÀñ8Öd¡+²ïŒÈ|•‘%5Ûï%ZœkAD™¾O·Ë8
ùçÊídÁèT>5ÔB6S¥FmÅ·Ïsƒ½X–ŽsovÚÔÙz&ôÁÿ†˜ôÜÂ^aÅ,AÝÊ~É?T^Py.VBêÍˆVÎÂäè¹|Â*Ç%ÀÃÚž‘D±xê'÷ÑŒ^²d_ßý®Q¢÷ÜñtÒš‰oŽ¼“ÜÐ¬Bæ'
—ô>Ã“«½¡º:–’ZKaKXR7eR_màóu¹:Ü	¼C£*œªÁ¹E‚àa¼Néœÿüra3w°¦n•2H¢DXŽÄWš-¥B–óKÓp¤ï},ü˜(Žc»^‡ùl<ð¹âpÒ³´¹4Tm±Ô¼´"V7"øDu=V ¨WåÒ3ÅºÉå:¿ÃNMCÀ½gs ­‰m5›A@½­üQGe53zV¸ÁYÖ¯¡'!sJB#ø/
„… §&ŽÐ>É¬Ý!s+ÏÂt ´@úyË^`íÏ<‚¿¿=tÅõ%›2ÖÃ¾-Uï!‘2]Âo(æÂIÃaŠ±i46»®^’¼n]¨#~yR´@7†Â©ŸxGØ‚½t7- ƒ~>¤iÂùü³*„"1Ëée&qŸ^¥”äœ-¹7…tN\Ë#s±¬tm¢	95Ñe´É‚IÖñeë2Ò€ï˜ö¯±	_ÿ-f5^¦ÀpÁI€©BÆD<g´­
ÁÿŠ;gZä¦€/ü‰»ÃÓ$í´ÎD½3uë±x©1hi¡“ì‹ÑðÛ”¶Pðò‚“a$Ñ·Y4$4'Œ‡_¥æÉ.¥V}§@0¹³k£øJ£ã=ü©j(±pŽu¸§åø÷‰f(§ÈýZS»Ã-p†€ð™_^„ÄyHáÇÌt¶+:ûA‹ÚP¦xÕð.ã¥¹Øô¡ÿ!,Ôp»¼˜ˆ^ß“¬÷€I±£øR²3ô3ìj;³Ôõ5øH|ƒ†ñIÐ]…ÜÖÀb²¤vŸ÷<íò°;®ÚÈ³Ö"÷»J|hX'²ÅÀ­ì¥éOkñHI@(RA<2µ »¹ò‘ë3Î|ÓþDb-,¿JRÔN%	Ù¥µOF`‡}4È«#Ä¥:ƒý_ ÿ1wyåçþXñ7­” Ï˜âäD®üB6Ðà³(S^üÝ’$-F/_¡~×˜«(^+á7ÓÖ*4Ý›Ã_SøÿPý›úâTi3¶g¯ŠÇû×Ý—Ní‘#ï^cB¯ÑJê²:!œ=Ù‹U?CPHßC¤¼í:-^YëšÔ‡g‚œ|¨—2:ìZ¯Ttý[ßºn”ëW`ÚÅjÜðÒóJ˜[ÙO[œ^ÿå…Tóêp]ÆW*ß‹Uå
°9:‰(‰yiˆÀ®·5žøj†¼óùÑ´õŠ?ïÏ!°öù>KŽ½ÞÑ?gßØÈIw§Äc‹´MJpèè÷!4ï§ºä3_ÑOÆ‘sBð[å”Í¾ù—C-Å]Q»ŸaÌsá	«¶ïG¾hØ[W›Õ¬´Ìl@RËQ†™«@îèÂgú€)dÀœgÐKCt×2<R€¯•P}
Õ¬àfŸjÇFßtÑi*<¸†û]‚º¹¼ŠXI³gÊ¸9FÄq`4'´ºÉj“¸9s¥((¡Ñ;Š³]ïÈk7õ‹'ž¤À 0=l‰Çäq"³›ŽKq3f÷/<Ÿ„3šFµ—J+ïãâ$§C9*£=ÃS¦èáæu^L5¨ËJË;¹ðùŠy1µ9±žôd‰RgòÇ5 Ú.Ã$iÉ|•ãxcBõpÕtéo¤f`ò®õx“cY%üð{¿¤Ða7çÓ„\ü^_„B…ù‹Vß¡sˆ‘žÎ}¤ÎX`ôf9ülÞxjÿíŒÓ÷_,Ó/BÐ°bJ–FbÊMîãx*NS‹ëžózªÓ¹§´]äöÓ¹ewÇŸ2ÕÊ­k‚ü€ÿ½žHydÓDýh!ÄÎ $gJÇ‰ú®©„6Mø"H õŸFÕÞ9¬sãè›mµgºF80­ÆÃõåòì%´CJÄ®H¶`µ¤ÑœÂsoAMå‰Àë.ð‹»Ysî$HéÓ®Oç¥õ;ý†â^§ŠšÄÓN°ÁfyÅzãªÉp½pª…&FVÄÂýÑQTúÄê™•¶©ËÙØŽ&xé°²_>]§ßSïÞg?”t|8›Ìñ(Ð¤ë]µÊŽöhž‡ü›.”£fãvŠWà¶5Ë`ýùW~0Ý› ‰DL²,¦¬åŽ(à2 ¬‹LS"1¾GóÁ\ñ0Ä%Öù÷z¨ÑÞ®ÑdÞ õ÷^RèÞfÆQˆÃÆðè¡ú¬ª#ä`ÂJiUÙ+:é!që,5½ý–F ã—æáÃûa¡êˆ¢WK6íîád¸XOä±oŽ½gîž=4ÕÍrQœb`Ø©µk	‚ÿðœY/gÖÎ{¬6ºÞ‹Æ&f8š)›’6,‰ìÍí‰yÑÆD ­šÑ\;÷7‚þß´eë¥[2_ˆ†î²O¿wXû!SXèÏðËdÿn!a…­Ùãbÿp¦÷ÑçZÂ|² æÝ’ùŸ··-ð’ÿÌ¬Õ>–„J™3$\ZA<ç|»×¢÷þli4Ã(þV'v\óÛÞU—î¤¼(E®ÒÙú HÙ„–ÑUÍ€%Õ´SP•PÀm¿3wø£¥Æšù¡17uØV¢ŽWUêòOžl¼ù)i]Í¿~|n¤QAˆ®h¦t#A¥¹VñeÎ÷Å°I •†‚%û¦Öt}Æ‰f~ßSx+‡@v2 Ùè):Í#/9µî@¢2³…tŠM`[W+Óš éNjß”èšúq¶ª	sªõñ|Ven‹á \N&¨MÊ#6Æ•6‹¯·ùªïs=ÑIâ˜”U¯…™t£œ7ÛáþÌ=	¨¸.Fc–MÀ¾&Éû(E”à`êcg•Ô·bêŒ4pKî‰FI!˜?æóõ±gãb§æÍùLU©û²[G£«ô]ü•ˆÜ¯ÞÕíÀëÔ2¥Hub<e]Mˆy¥t¤·˜®ÀmÓÇ¼œ>¬ß–¥aÉÚ(3±§=ÞygÒ6èébö-@Æ‡‘9v_  `™eÌk¹À\9ƒÍª–7¥ââÍI¨QºÉ ¡| ­?í}oXå0C¥±Tzî?ÜÚd$y°¿Qs¸WÎ(ãÜBÌ‡uEp[g×tôËÂù´Æ°yšŽ÷¢øß–aåpKm²‰÷¶hB°d ±6èË2Ž3$¬3T‡æ/â1Šh?Úz¹<36
!àQí@häiÜÍV6IJ}ï	óÔL #+±ŽËý§©³;yÃw
Áƒ]öÒ
ý{KeKòóÁ¶z­ãL¨t|Z€Fž>ÒÀg…c”×Æüûê4—$-Ë,÷;–­RÕ¹\¶Ï–n^SYœÇC7¶°çc§7T¯55ˆ¡#É´0÷Y¿;!…óÕlþI"Ü_-vv%ÖX…lèÔ÷ï„ðtòÌCÅÀc 7ùÌ¦º7†Zç1¨Tìj=:^†Þ?XDù«M!úë«åSBÈ˜S°FaO]ð‚JD%‰V=#~Ê±±#Ç´P¬\m‰!Y¨à!Ñâ+S¯.ôhúášáŠ¿Fœp>l	 ¤h€ìOå­g•“¡;rëE:‡oJ^;Õö½i¾D÷9Rv;_µê»•5[í­I“þRâaÉÜ¨Rr‰Tÿxâß'ð¯¡ø{*]VÍË.¡en¡øˆ’=z†Â¦“ð¦ß(¨Â(ì‡]½]²¾Ã8­uÛ0º%	 v©;†Äi5C}[Š²_þXÇ†žG-3—eãTèãÁ&q=ò~áhcÆ	þ&B¸Ðâ©É<ùóÓSñ‡ž€ÈôvšñQè×%—z¶€QÀ±¸£ÁŽçf¢¡ =öoo´µ¯3¶MxÓ³q$œâè:(Õ¹cØ~Ä‚ý&Ÿ$&ã%[5>¬ªÚ¢åìDþ*UB÷wJ?žúç«—Ðøó;k‹ƒRç‚§Ÿ/”¾$&ÜÉÓ$fQå2S… àû¦©Ç­Ðc„©Š¸¶ß~þ[“$·¹ŽéÞÞ·Ó¶]G*Þ
Ê¾ø¦ëÔ.%ª­E¥Ë¬ªB‡[l;›',³“ÕKd,ÓÝAà³²ÏÆÁ­Ín¢¯$I†Í…z•µbTâÆ×…¾Ü¼MÖ’=FßÝ²½@.ðieîWlPRˆ™"³Ñ?ÊÃ1u0ÅVˆÅl ¹&X^À¢ÓLÙ’#+ €>:0\]¤¹'J¶˜ÀÃ|—6)`P	}I/fpd
£A›‡¡¿Â	Ë¹“ÿß¡Ë#©bK­Å%¯Ï’˜M’Ž¬Iö·.£€F”{,UPùKjŽjyäûdpÙ·áUÇ~I›ÍÿR˜b™PôteÑ^ZÝ›8¯rÕœ?òý(“Ñ(¨Qn=[üi†|[7sfÕžËr½½a9¬þÚO‰JÚïÒÚN©Q¢PLïD’=æÀàW9Æ_hîbõð‘_ÏfnÑéæ‡E'¿K{º*ÉË†	~Î{—­­ !)Yr’…`aÔ	Pª¿(ÐA~¶“ûÄžø–¥ÌWî˜¤E‡lb5Š6×º»Bƒ„Sì…][MÆ™¶ˆµ‘qVFEònÞ´Ì·ýrùŠv-ÙY#[AÃhÄTÓ¬CKúÔíŠ·R ’Ítro´ÉåÔœÒØ!©ü8ê#£µ—À%…rÃE-A{£ËQx£õ½Êunl_qUÆj2;/MíÿÕxX_ÀÂím·o¤ÂL•ô)Öö˜[Sk ‘×pâË+`žú§Â£)¼%þ²ï%!±%n~:êõÂ—†'Õryk‹`ÅOTbáªH¥S­{ àvxìëû$2o§¢&¹dšËOŸÉ{–I¬áo³K]`'Wîãü±ü—t„(YØ©#?õ]õÓ^º‡d<bm õó”ÉàMl[¾61×Õ HÂ>í0t\9‚3³ôsˆ1ÃS¦oÃ÷H}y§leMðIø6°IØjº<sk7k¦ðøN±qú‡Pßl&tàr²Ãú¦ˆ™Ÿyˆ_Óh@sñå/£Ebîdýï2¶ë[áEs-Ù©ïK©½ÎD=î‰9¤…EîmV[±'ÖHœ‚ñ’œ¶Ø‹' A—"¤ ¡_p¼€0`RN	yˆÞÔ*øá!—’"Á0J!YSÒ'Œœ
%Æ™éãlêå,ÑãÞ^±”W{|­Ò>ba8TÊõ=Ìc~ë“0E-ûnépKè/ùÌK®Ãñ±˜ÞA?Ý?‹ ë:nëO±Ã‚‹ddTmö5iÕpï&Ÿý þn.êÅ‘µaÿÔÓ‰¹çõ[GŒG|Å®´ŠHa–S$w«\}LÑ“ qÔ#N„’[Š÷ç°’1LÛ~t¢+øG¥Èÿ4 4}6«7¦xß¾Í„Ó
þ3^~×>Ú^]mŒÖàê§xg‹7¤Ä£ªrþ£ÁpÌsvjÏ‹E¥¼‰Pµ3 ße´^ÃÙMð¥ÿ§ñjUx/Š„ºìq¿-fî=œäLvílXc+±«9C“‘7H2-ç³ë³* P ¿zÎuŽU,	–LßˆÎG%!á—¿V&Ô,êPü–°`Ds•ã*èéIwQˆß1Qï>¹cNOÖàŽO$±Ñ‡c£.@ÇÝ:ñ5A(û¼MH“ÁÛÃKˆ#œßI¼ 1¨’;š:ªjkÞ æÀÕ×•ìu'[­Êt\RDìß‰Â%ö+œºª¸YV–vÍvü¬y4Ï1Xæ”¸ñ_ÑÌ]}4yëÐ }[D¹Ì[õK—e­Q~v¸C®Î2åM° ¹?PUÛ"«ÅfÉ¾¿ÖATG£@àQÆJéwôæ”ý)™RRQOá}§ÄM›íÂ²ÄÄÂHß+äp ½{éF‡q‡Ó^ÚsCï²>$÷VKMoá›×ƒŽy°&›9¹¬‰‡Fdå4TÀÐ04gN Æ#?¡©ùa½˜Dž{	^bÈòkëHÖðm?íÐŽÁÚF¶»ã­ñÕˆ‹3ŽÆ¨]9ì=Øt³¡¼ÿ%ƒ/jñ…Û5¹Õ]6”1•<½V6kk˜r6Ö­BÖßSÖß¸”P]¤{¡DÖbÿFiš»ß,~›º–øk§˜/ÎP˜ñþ®InË³HöŠM/èâ@ )fƒ*0îO,ÐN Õo	»™ò¼Æã,Ãc½Ùiæj@†ÆÔg¹ìšð]~´„ë§=¹Yôà¯¢„‰àÛY`5†¦„i›ž‰Í·³±àŸ”PeäÁ&œÕFûâLð©Çeý±¯C´XL?/ÙÊ?7dß±ÍSAý[-®¾šÉ@Yd‚òãB–ˆšëÆOTAºKX‡	Ð¥–fÄ¼íU»ÙœÇhsA_ýŸ€ÇâuH´#ê»S$—,;ºÔ¤Ûù–$ù;c“r~‡³Çøð,ír>ÂÞ”/Y;I<ÄqhœC7/ñ	˜ÄQø5‡~¡ã,„ ±A38œX8fZ;s]beënWóâ? ­â[ýÛHSÖÕžªƒ‘†,B¾Ô !<ü`h`ð?½b“±l°ÌÔ7CÄóÐ| ÐØ©:P½Ö¬!ÃŽÍK‚;_‹ C
Ã$e/2Æž€*Ôk
q Î„ý¨S‰Öãü/¼žŠÛ`"ÌZ¶ê‚‚\±œ%;’kºûòÏÒœÐc‘	A0¡ŠdˆxÔ}¼C’Ô½ŽÈŽöµc_Ùæ{ºt“‡ÈXŠÏDs›;áœIhÛàÛAß-Ýƒ±×)6†GìaV…*äëZ«½ ËÚ-®SÝjáwðè6fòí5[²I£½¢ðk0Ž¢ru“›ƒ¦ Ô4ï®äJtCŒÕÃ%H“íšîË©±LÑÑ”²3µ -Ìm/\‘'½Gµó©GÒÓ4;0wU.g3”ò|¢Ý@dñ&ÑxÔ#Ý)ŽƒâÉ‰e‡;ùÝx³z|
ÚnPüM¯øŸì[”ünl`¦ù c±½ÏÆ¿Óeé?’¯_g(ø(7ë‚•'ªõ~í²>×Õ
]ªé£Xã-0Þmå®^ÛØ3ALÌËãy¯¿cÇÆÆpP¢fÍˆqõÞyæl™œŸ%Q‹¾z„R¼»×˜ÈÙ8ÜYièTN†'»7,¾©þ‚ìTBª A‡7b²°ûB¼ÐÐÃñËÈÈtV³ØÆAG «8JKÓ¼EÔ?qØ'‰¸ÞŠlü-û©6õ£ÜOˆÓ•1ôj¾|.ÝÑk‚Šfæ•¼±Ìaób1ãÔV1âïC¤6ýÎ^@½”2k|«†‡î4ŸÒ™²³Ë-NÉjMo3Rd*PngØ¼àbÊñc£Uì,8#a
k2ŠŸ˜vrá’	À·‹sŸ«–ÑJUôow¶©Ê{]g‹‘i†{_ ƒ°o rò¸¯]—9¦Z` r‰£z¿rˆnÅ?
âz¢ù%õbFÁI"ÝÖ#<´WÃìw­Yá1¨Uõö,ßÆõ˜T<Bezä>ª$àåPf±ÁP¸S)y½Ùs#ðq3uD¢*®›¹Ð– °U&ïrme:¿;
ç-d¯ªè  8hCäF¹ÖÚžõ35è›ü½s„3ùus˜½WË©¸•?ç?ô¡[Ü€èue<‚'~–ž&p-âCª¯›lÚó”^î‹¿YSÒØp•¸—>ÙÔ‹3ùOé˜‹
ýŠ{Ö´V/dËÍ„JÂ]j£áäå½®} R«eC-Nâ¢7mðP—¶Ûâ–Óz¸±Ø1:ú/û¨xÉp‰º“éŸ…ÁæÇK’.yëÔ‹Ö¤w©ÀÇ'`HÛÞ¿d ùß&ZÞ6í$\âXÁ=uäoj¾€C-lcTá¬üD„T| œßË{‹;2„Ü]ÐÊýÅðâÃ ´J3½€p’Y`û=~Y;èMÄ};u+»¤ð¬¢ÏÒJk&?.™Íí@Qej{Ê~Ò¿ôžÿÑ·£CPˆà˜p¾0¤áTÛ™‹ŽÀ[RH!Ð7L%þ±÷â]–zõ²4¢ò
ÝlÈ×ª®Î›vÑzÏ]ò$§’hý%ì5ìï9±­XÔof×ÇÇ†›ºÁ¶”ø6ÆÏhYÒ“CjaaNp7×cïÎ¼ê	á‚Ì¿STô?ru6Û&£mI:lY¹~r™0js"ûRëQ0L.æ/$¤h¤ÉÔ¢Æ”x	vðä„3˜{>¨+¾‡fPœÇJó"Í=Iô••HnzllJ		»Mreä„E`‹jçIè,ðu•(—Qqö¶.—Aìß¢{%­àV,•6 æç¼?UòNlÞóÓ ¦1€nîîòÄ	häîæ'|É«H'?Î°¸cwyÈâƒãÕµw…óhm4«éø>RàY¯¶½3]ú­ÅPQ[9é¼¡'5oRè1YßåVÇq]ð­g*Q“föN„/X^•Ä #Õ,†:$S³‚ÅAŠúÝUâÐ5îß×^8‘¬~ôÁ›°Ê‡Zr¶<Žë)©eT–z­!.ÁaÌ>–?ó•+Û×W«†|½ÄŠÀkn„Z[“ä†Æo3Ö"=I+<?ÒF¾D"üoì#áPÝ² Fíî òûÀvBó¬­D&4Â#<+…Q5vâQÄŽÔošfšO(´ÜàÚ±MÁºš5+ÓÝ xêðdÃs²·KÀv®·„0-†)™ }äÛbžiÅý^„¢bŠÊk–úÄpÔÁßÞ9ÆK]$W7¤ÓB<Å»`á ²!î"=óL(úé·×ê­/>(þAõÔ±Ò~B'£ÎEhýsðÆæ¾ðÄ&ÅšùöÀŠRÇnW«k•%`oÖÞÙb¾!Œg·¾Ü¢ÁŠËúŠô7QSû+@>ÁC¼}YO‚ÇÈ–ÖåøhƒëKìf~ýíçÓâq!WÊÝâª…ÛßÊÏÎ~½Ù\‡Ò+ª BšÐøÛe“]¯¡â­"E-@(ÏsS=ŸïÍÒ!Y(S–js`âUöx€þÓýxÃÈ\x§¸Þ®æræì¼‹²ò å<«¼ hPø²aŽø©&UMfZb†5C²ÒP¹9Ãuån5¨Ú#£ñ6†Ód‘Dø
7ûÕtð
”Z8óÈÚ/a›Bš}ìe°87¹ˆû¡vû8½Çy–op@¦‰$o˜ªmâ{V«7UôÖs>œ’E÷–1q¥ùÎÙõÁjRžüEb×”a»*ÙE°RDË™ÇÖÊt±E†ÓwÔèÿÝY?ÆðÖ·Ké<°ô¹Òÿ¶1/à°¡^áüJ…#§ô¬Üa49WNŒßÛ¡»`lZ?/Û„†Ü­eOÉÀ¶=H©˜[„.(ï[¹…&@"áözIp7ò.\&/ÏZsŒ2Éß¶zóHDÛPt-$/’’’UmÏî±ím’Î)¿s¾ý_©OiÌÃ$wý=gLš)l™•šgDÆ+…[ýÁh,ño®L÷MÃ
äi¾?ÔAîVhr±š† ¸õÝæ.sÁN8ˆ<ÝàB…RÔ½öÁ"¦
ª±ˆ?wšj°(²Ø×YÓ­ë‡–´BGx[ìRqÊˆî¡¡îJ’v§æ„˜÷ø·ÍÈÒwGñóÔ’ªÙ¶ÐŠ6Ob6`Ü1Œ‰u]ðÅ™!<¬êõî­óuý9Ît³Æ¶vÕi0I£­ûB™ßx÷0+©;vS±ZT¾™CfpTþ‰3¨ß§•cÉ#«íøQ®èãVÿMÙÓpRwLiõ˜6¥ØÊå]q~¡ÏÛvƒða  éÂï³ƒ<2©Â‡õæpû¸ãá×~ïÉÚª(ó™Ÿ F¯×U2ØMüÍyAK¨Cèš8Ý!a5Š°0:c”Ø9˜)žƒÓyP4O
wÃðÒew$.[^½2ÄîªÜ…e.¤ë–xZ°*[êŸùnN¹/K6áìš#ˆJC_á¦“”ò­i€\Gïk¾"7Ï‰½a*óy¹¼}p_^ÞÞ»:tbwöJz¿ê™7/çÍ,ÛË²C¥W©6Ãx˜DE–ËºêX*…ñ4¥üxÁô¼I¸(J?ð0,Ááˆ»¹*-EoqÉNŒhð3PÎ{€ìwì‘\Õ»†q3ÇImÞš40|JKhuöÍ/÷.{ÛüÑï0ñ¬Vùí²/!:!Zî¸P»PßV"Ž{xì¶M>Ð$63ÆjÔŠHœ^"Å’Fº\ƒ *¥Y›†œï„V¿çËØðˆþ¼[ê‘6‹á’FGªáúoÍ«-ÊMfn¢4õâÞ;éË{]sšüÕ¥ÄC-.³¹níÅ dþBVž<—©È„Q,&­á¾>±ì²0-z†»ÉIØ9e4›o§œ¾Fr÷Ñì+	:©/•Ì÷‰¾@ö;SE‰¥Á åçe¾(v^ŽF­Ýà°	¤‹Ñ|!v-ë‹ÔU-dÿÎjË˜º¨Ö»S<8ŠRqN¬‰âÕlÜßûâÙ©4PE5ëƒFc9¡mÙ\ï&ÛîT<G¦½´|>†šèto°þKž	îÿ7Žõâó Œ»£!ÏÙ{ÿÈÓK©ÊfjõÇç"*4mž¼xêðR˜	¸ÞlHhæ¾­UX»>%ÁÔß'RiËïoó¦2‹l%h7Å§Ã8àMrÿdW&#Â!¬);Y"tK!.Ñi{t›²'mþo%Ú¶¦ûôJîÖºÏ„ Ç™D@Nv–cQ<mqØëkçÄñ£Nj0ü9+(Ç¥ÿùT–Å¨uQÁÜ„4LñExNJµÍ~uQç÷úhtÀ5¬ª@P&Ìäð½Z¹˜»KX"Uƒ*Ráò‹—ôÈƒsÖºñD R;E¬b˜ËÒ¦R:j½¨±\xüƒØæ}¹Ì
ŒhwÖ‡ôiWó2N«½H \çH¨±2í¯]ó{–¢˜1ÅŒZ£0¯lï‘ÉjÇ*kÏžÝcó­ÿO¦§}DÒ¢!Ao €y}šÈ±F`tñÒ+Õ†B‚$X)kB‚€¸Ä«OÞ¯R%OÊb#ØRÙP®»Ïßƒ¿@ÐÀA11!%-wZ{HAà‰ßàÎ|o+ˆIÝ]ýÌÕÉ*˜çÄÑXòl£´ª)GÇ…ÿÌ€Êk&”{ázò)¡Êˆˆ#%sib~—_™¹ƒòg<’ä£ú
g‘=§||{GÆN-—:]1ƒüÿÍ5|µsR¤çÄM4My’}Œ¯Ú¢U¤8Cî©½²ûû±˜IsÁÁ	wëO´~²}º3²ˆ&Öy$´:‹É#kÚJ~Íps¢ëA™`ãé|›Iú‹éx\ÂŒƒIçk`õ:<ÊA©Yšù²j¾¯ø`a{ž’¢u.„F=îÑHˆ.{8ÄÍ%Ú—Ú¶ùø;ojNYäÏ·ÌQÇ
¼ï†°À"87rfãc ÍÒx°×¼9¡T“S9´àÞÖãÚ¹ò”Êòc
Oˆª<]>‹®2¥åvE­ŒÆóØ¬ï”ŒëÂc)­O·€ú×È0Å‚ß*É5ç†A¬öú]•m#ŽNbPÚÝÜ“6”ô‹PÀ'R øw]LUåaHë¼QJ­5«­{/ðð(t¢…õ„%'mmx¦8
„ghîöÂh".1Þ`U¼ÊÒHR“´ÇÃy¹à²‰d<VïúŒ]¾öeõ²§Ž-†Ñ}Õ±€YŒœËýõñêSÃN¹NhJÔµ±­æÒ
V‹oo9F†¦ãà
—9mé2yaÖZŸ›g”Ì :"¸Ãšr)' ô=´Êý)áÁŒ¿tb1öžëæçˆ¬>ðq¤¶í¹lÇÖº}_‘{’À¬8@G¶ÅÝ7ðp: )2§›ÏuWç’¨uùþY1\¾Šýmf&b„9lmqx(ˆè.2rÊÌyF)á„¶¥óv²±è†D2,ö+ŒìjïYâ•ÅLKÔë~Š<ÒÄïá¹Íû-ˆÛÎ<göHÄw÷S³mªä›Œ“hŠu†ú3Á7ÊûžFáb{õ“f›Í°öAvs„åãüC<]_vÉ¥ìø¶!ž-ŽngðœA«ž8ï>Rjn c…xuoô{1± ÌÇaýŠ0ö¤ÎQ·„Ê-ªºž¾¾ÌæŠé@ï{ÆBw¢{£z²ˆ¤,Vô+®þ{• éŠ`'ßyC¦uBòtS'kJ	¹/ˆÇ_›aå4äF¿}Ú†þ_N2 oÏE¬”Œ'n9Ýwª%0by²YÝjé^ÿ}Ì3zÔò‘­%*‘}•Ã†ÐÖ·µDóÁ/à;/Z5)®çïŠœ£Øß'Èë’Ê‰ª ðL[ïNÈª:ŠøS&º7‹8>ÐÇ
Å ™ý«S.aš~U€ªZÊæÑ•…èzncéS#)¾ÞÇ42IÞøÝð~žÄ)á£RË”îE¤é4œ˜} ëñ,f‘Œy”ÇG±üaïzçQw×þ¼™ùN@ÄZÁ°‰d 8è¼K¥SèÜžJ¶¾ºú9v…`.•<	ÊI|/	M¤>V/âe†Œð‡Q8¾YÍ®\Vá!}}Æá„	÷;÷D2N‰™Û»$þÑà<ÄQ÷¾çI„xÁáÖoÀ¥¶=Ñå"î¨I|œÆu¡Ä l ÁrêŠ®—žö¸Áî¾Eð»ýöãôEvD•±š}fe4´£æŽÌ£ø_×@É£N“¯ž ˜öÑ˜ú7v6õudO
#;r¡È8÷ï œT9çfëhèTŸ}Ä6R|[w*¶ç!!“•J„¨¹øE`~	$ÃO”8âb%&ç‹ï…Åq‘\œ€œ8
¬ïøfZC¿(é´ëÍ/MS«ÔÜºk}ùL­S	dc,#q§¿aœ`ÿÍëCîvçk÷L2V
÷Ëœ‡Ž\–ƒ:ÉöØ¼Eá6ÊL^tU½oûŽiÕ1Õ“©K.uD.Í™cSR8ø¶(ß`ó±x Jdíf ,RYS4,›à‹)h#Fca”<O|±uÚ—OÕzb°ÓŸª‚j†yiÿ¡T1Z%n¹ÉÖ[	žnéeO¶]•Ó¿ÿé¶N^Ì…ò›J×{&½QvÕçemï¼¨F³ÛÜFñKREh·SƒL;åºêåíŒ:§XÊ>P&!#ÑÖ‚ÎÁuæ@]"Å{;­
Éú<*½×n)…RûƒÝšª}„-#¶V¶«kÕÚ	ð“”þÝë•uµ]:Wî~(‘–Ó{‰5½‡%vË—€c°ø¬S/¦ƒï2Äë(ÈŸ_Fjh3
ËmöP}5šµÆ—¹˜)ñeL%Ó¹]Óée¸X·`8´ËwÇË#0yHËQÒvíZª .r†IŠ`ÃÈvAÏ—wYµg­.÷.ˆ¶ÙD¹–÷yxÓ<«+½“cƒ+Ü“©`ÿÐJ'µŒ «yÜ]_ƒraWCÝ>Í©Ú0S	”<ø[~ø¨´Û„-YG!ŽÍ1¹þ
zExÍ‹M½D ¾µ±­Úê}fÚùÚqX‘´¼)’«ql=°¯øßŸ
m‡]á†ãTõ~ÐêCb8L@Kœ	Ï™Î5-)^çÖrÖyu¶?2ƒQ!µ#ð7ÇÈk»¥]º¤l‹~¯Î‡ÓsîÜd˜ZxàÂÔ‡®” 8^qÔºT°c¯1$©µþ8D\&Ð¾‡™êº+Á,Øœ¯ÍùéÛmû©³¦REþ}û‰’B‚Ý7D»Â~AÌˆ¹¯—lúj¨˜Bzdëf;³Þ»ýQ[<Åapùõ€ìÁî–HÃ:—\­oasb£Pz–g†‰¡ÀÞÈ¼L“_Q/×
97ö0F@¤Å?å¾ÿðØÀ^“Í´óÈîÓ/.16Cè÷®¨ŸÕ~–^ÿÓ`$»3©í¸á¦|Ö[Í5.-Ë4bì(ˆ‘‘÷ÇÂúcÜXG”f	c˜¼ì?©cºœGí™ÆÏÙ… 4èeKS|få´Š¯Q?Ø=3MGÖSÎåœósŠV¹îéZÉÊVÍ,P®Û4y¾à3dûc†“É]²YjÙ •ÔáGÛ½×~@ÄÚ÷=2²`ÕžØOÂT¤>4q·ÂŠHh£÷Sp%`O®~džT¥ŒDvª4…˜?+`#–\ƒÇþ¥¦ÍÍè\!”˜ClCO<°‡|ó‹€D !@Q‘ÿù(Új´*€Ï‹ó3*£tÑj1•,eI§ÓF¦^G î5¾ëÊ=½²Õ§-¥	QRx—@ÒímBöŠj¾n„Õƒ þÉDTXã­•µµÆ½kx?£ð¶!Ë›ÊJy@CÁ¢aª`î&äOäo7iZÅ´cœžáO1ÓM1˜øÃ‘¿Á-3ß¤	°4ŽÑ,ÍÔm×¥ E\‡T'å	˜&qt° LaÜ¼”ø²Üâ²da\3’$ýÖ¡eþÝdeý5ó­jÃ²¢qoX”>Ýê]éµ_DÇj¦úéöÞÆ—Üq<„]Ö^Ñ:£æµûº.£_’ŸjÈŸyU6|
ÞD‡|¯³ƒ˜ëÚàK8sï8ÓãajZêx,hË—íp<ób:¹XBsÕ×äú¨€nú~w´™Ýœ+‘)ÚH¨Û7,ÊÏ+8pj§‚l¥œ¥¾:0LÆyû!%¦ð›Ð¡ü‘¥à?P®æH®ì–Wt÷WPdá~Ý:ÒÛÒ<þ[hg¯«Ôÿ»ÏÜ˜e0™†ÿ'Âh;ÇözÀJ¬ì,ÊFy¶D _µ ÐŒOõ|óøwC»)®W<O¨Ñ•ƒ;½J¥?+ðja–¾äB0õãaØ”¸ð>ÙÅúÓ‘D·Õ?ÀÂkÓR¦2áîËÚ–’å3{=‡K¡qƒ‘\ü¨‡Šoíxò¨¹ƒcÃÑrª¨o6+(í±1€‹àoÿpÐJ(A—]
fS˜{àC…§W’²i¸³+µLñuqš–´`Ú©.gÞ gVŠ;ò6g×,Ä‹?'Éw~Dù¡ðó&",Îu8Àyô¨°÷•žFd„h»;`¯Ë\³».Ô`yòÞê[n¬ŠzÖ°®½èiV)Á ügbT÷]˜ØðBéXu€¹2¼Õ¶¾ážûÑ´×a·Ù˜Ä Ò8º½÷%Îw,•1®ªá*¡ªò`NLs@?ƒÇ6[åå&¤ÉØâ}ÝâC×í3I#åG€[L“ëPêýËŽÃ²„T*°QÄ¤í`“ÝFïÍ9B]€zîÔE^½‰õgöÀeÐÕDþbÙ²Î¶s×ª‚Rƒ‰¤ý˜°Ed1¯Ò»…˜r™šËÔI`È `‘sàwM9ÔÂf	<tmº˜Æv~Š~jÞˆ´žõ•Ým³/µ ¾„hu";dØ3.vÆšh”€4 U;z]C·|ß3F*¯	´@;ïX™ã‘qTT© ¦ZÑ÷$Û_Z¶ª³‘0€Šk2’°$ËaJZ®>ßDðsŸÐà[%n¯‚½Œf³C*ëÍ¤¿}®ŒÚ	ò “ÊHgï·R/ûÒhÍÑ­¨ÕÜOšÔfz"¼,’=Û‡£nÜ%‹U)©á»’Q©o	~”©o
&9ôxè#ìƒ¨¢›÷`ÉŒ+hw;¦ñÔÑGQ@ŸÙ¦,_éMŽ¤²°ù‘X™·ouÓD69iQÇ•¹5R¬Âñ¨¿³l „z«(/o>5“Æ_¡`öUØ	…)tHéùòiJì°NžPÆ¬¥)y”™Þ.cª[1_€ÝÀ]Ú:{ªI<‡
š…Èy	ªÚ“oe²P{ËÂà—€¸Ã±ôÁß© 6LE-ôÇ¢çç]".“ƒ€Ö‡ I*3’²jÖÂý–Nl´º÷¤ŒcÈòÎ—LüÄ³5&†|‚ÿ³Ñ…“}¡dï.ö3+¹±SQñ¯»­óöÌ>½Ñ'¥çø[a@ñÈ,‹%'øº&È[ì
n˜¸¬iÑIQÓíã*‰0v¬Â±îàAše[§©{(bB2äc`³]lXÔ/Úth´eˆØ*eÁIY]‚î8£»pâñŽê#C’;L'¢Êñú
‘C»E….äc¤€3!éŸ‚z½ª,)¢hgþ¹6{ôEáNúv‘2ÃpMž<5ºÝê>¶qòÂ	°’æá«á°F3;1`ì%S¼7s¾NH#¦#oüw}N?Í eh°K°{÷‡pñT£9„s5h.ª‚¦½ž[§Â÷O@M¤­çÞ‰‰äŒ¯ˆ¼é&mŸ7Õ_1´u©Y-dû@ÌIóŸ‹éµÅ¾,2hŽÐéø±ºØÏƒÀ ëB K“mÞ{L6ã[_Y'áäÝ²}¼‚#áæe@%àÜB2‚•1³ÿ…‡±À€ê c.èéçX·,”b«4e‰›4	ÝµÂõ¬­HÍ¯âx¿¤F®3Z!¨SQ¯f}‹g'1ú²·½]wƒú3µÐ×†	ô‹QˆI¸VÅ·€R‚l3*^ø¾DÏýj/7úK-®“ˆ^–<Z€º“ÐjŽL¡rÈrrZ4ÕíÎ½ßå–÷y‡¡9z‰/¿+^èÅÙ'ò\yæ#u2’>:!€%Xj~ýà)\óÌXÃ$0è“P>NtG—F‘J©él¶—è”»‡•uAP‘´CEƒ2tú·‡í‹7!:êÿu½ŠjðÁžË†˜àek/5Ý†sÿñÙìãaÎ–ª$N‹v0¢ ºµi¾Àô0 ¨# äD2È1¥E€á/~\˜h¤ò
ËWˆ´õØü^=v!áíJ Éå*²£€(…Kã8pä^:½Û¢ïQcÒ"|ŸveM$‹_ëÃ|Ð€ÚNsÙ}†ù[p²1¥f™ƒK€. zê©IëVZb¨¹96	#2[Kƒøó€*I²Ü©6g_p²“zÕH/¦l3:/þÇ¯!¾ì|Ã½§Ø·Ÿ½I81÷ÉÌ#×·‘ä—¦RÄþ±Ø;G»ÀÐa§·¸?øÏØZ÷^–uÆÿW¶bŠzæ}jÈ‹Ü¼v É{ðr´2õ0@ˆ³·‚íÜ¬klX¨6òÃhñJjè[2Œ²˜OœhÁqro¶í+ÃlZœJ9‰QÐ?¸—| æ‘©´ûú½
Êò“W'A˜ñ³k;l*³Ê¿Š³ö‘†®†pA{ñ—Àà ý¥w¢`d„pÌàC2æøÊKŒ“r…~ª-ODQÄm´w‡òúm´3ÜšnW|AÚ«RôŠoüœ‰NÃKcWÍÛ~áh¥}½ð­à\“›t"Ô£Õum^NEïŸÄˆ­G·(¨«F9›ksšÊru$Èø	îÉö`wÇ¿IžÁZå8<¾C‰ã¹3þð4^øÅ“ô4±¡‡¸?‡©èWd>‡‚)/<™ÏtçYØ£žÝ‹ð°™³½±¿Bc¨aE ñ®J¶òâAõßv‘Ž@¬Á,°¿Ûý–_dÀL.Æ*H4¬Ò4‰„>)RXƒ¬¡áXË\`÷NEFc°ÌP.,„ùÙuõ"©ðÃï£c÷mxiXµ|{JH}G"-#¾ð_vðÏ‚-ßÉÇÞEø*<„I §VF…òOòrÂ‰yP^FÍ! -0#8=);0cÄ&ì²ûºN¦é£ûÆ^‰²µ#©†=“¨Ã’;Ïè<•î]BoeÚ[€èâüM@»tb`8’¬¨ˆýàò#ñóSIÁRë/‹Uc T8ç&™ J<Ÿž—î˜ ÷Ó»œ	cGMí—k R¥Œöa¤3Ô°„É‰©ïBÄÛ¬†3Ã¯ÚéâË©t´ã<Ó8ÊB >H	%üÒEØß´¯àˆÿ„/«ÙŸ ÷?`úÝý-ÆdîM9ÎÆw
5mëëîYC‘¤õ÷·´½)b™1…CÍÔyÊÏÓ„°ŽÝî™‚—ha6€¥N¾¶“Wô‰{dÊùB®`›Û÷¼’õÇÂd1ï¸þt@;ŽØIÇ¡Âö­ó 9ã. ‹iX¼«ÇxéžJI§Ó:=ã¦t¸·Æo²¤U¡5)±!¬)7]m"|…—jFÉ¢×“jµv÷&0{ÿç× itlë«î‰ÓZù¢ªà›3>»Wî­:oìá¯v’òêD¹Ã›öVþ¡!ç^) 8\yðü­'ïÔ2}…ÑÂ‡×€ó^Îç%‡•„Æ^š[…‘ñXŒ 2„M=«j°ÇrÖåÆ‹"@—¼_æ½2š8-IÜ ‘vwÉ	ÖI¼	C©êŽéùòrY †U¿ÐÿYKXFHÄ·ŠÃJjCã/ÛHƒ!5_WâÜQ8QŸ”ë4²Ab ‹!šg}VÜ¨‡\.5H‰C}ŸnR4á”ÿÍiònn]c²Ý7&èæÃ¬ò³x-vÖ]šJà‡ö†Ò>[PÀHú%YRó+£ûš‚q·®¼ÌTÓÅ´m)™!hÉ»jØX {Ì2 ˆÈÍ¨BÊýìGÐ ÙK²Û|®ÄôéñºëÝ’.ù4ö§•åUÿ_3‘ÂûO"©{íŽR%ßˆÌe44»o‡à'U£lToîì Ð;œÖy¹.ä±YT‡ÊOéçIA¥ô]™óÔÍú²b8ÝšDÏ_ïÜV#þPu©µc¢ƒRzO–¯Éº$MÐòž3>¿CÑˆu³°’2ZúaüÑÂ×(>WF¾é<%®¸,ËÐÈŠò«…õ	“ê²—VŠ«(ÆÂ#k@Ÿ‘ŠÁþ.Bƒ¾ê8èTºÀ(ƒ’ºRòÒ®E"Qè[Ùé»Ûzæc¡¸)5ñ]¯„®œÙ¢Ä(xúÕš=¼c¸‚³~.g¡†ÔqµP•°Ý¸3>,ônüU„QŸ*3óŸW3ƒ	mÛWÄõÝ/Àce’<Äkó‚¤ù^%:C”-²á‹êÂŒŒ÷ÐÕm·‡æ–ŽLÁª0Ý÷òÅ^ ç£[§ÿKà›yê»´L•'‘ÆYùb0ˆ?ÕV¤u±•dßpÔ)2+Çt\Š–B`SáPŠ°„UŠš ãùÙ»
 üDH[Ç·àôDÖÐœ4¼œiøèAŽŸ¿´ÅÆ²æh9_Ðÿf¥-¹fù_üew*YzS™Ò³/ü(LÿÁèPBl›«æ¼V¯¢"•ù]ó8’3+˜=k‹ƒ#½¡˜,ÎHÈ–\ÛBok
·Ö¾˜s7¯Iä~nêqré‘ üšq¨àR»ÆuQú<ƒ¶2ðf¶‹TÅ#ý&ˆß½¦¹»‘¶ËæªÄÉT§eåášÕo)~@‹›õ‰|ÖüÂ¡àLóUE¿Ù:ì7— µ­f_³ÔSºLé¨CzaEœ09R.¬»¥®¬6	Aã‹Î¡EŠN6&Kÿ$Øà$o{ãµLó8®f˜®ýcYb¬‡ÒËc
Ñ§˜ÊóÍ½î#º·¢és :ˆ<5:‘5ÔÔcÌM«£€
Öñ-:öW¹ç5»fE¸—FHrÚª°–°+Ð);ÏÂÞ³÷?ª]F·+ŒyâtjgQú¯¾Y7QÏïã¼\y’t*1Ë‘+EòdøÇb’‰—Ò[N¥èè¿Ã†b>ä‚|º§¨íÜG_hX#ü5XØ&úÿA5ô8††Œk	ìU”ÆE‰¯"X4y»l‰»²¹.nýÝTœ%ªƒõz•¢–àEÉdm@_©‹
S„M§&ø0¼lÐR©ªd<˜~àF…ãÞd ŽÑ•·6'‚ ‹œsŒðØ!¤íL›|(Øê9`¯åEó ½÷³Yè`R	ßVþêû
™BåÒj’ý‰úÝY[Ï¹ÔcWµ§Þ}UŒà'MCNQ—ýAXjU„RŽ›#ûan,lÉØ#;þˆQ¥M*©J€"Í¿÷ëa%SÌ¨´k
Ž_”«‘­<ßt…Ð)Î_¿Qƒ"FÓCöøŽK´ƒ°&Š«)s¨^÷W—]T#Œ›#QŒž–bAèmð>–
™Zš¤€²Eýø¢aÊ·Úu4Ø6˜Î]›ð(±ê•µÕ0Ý§ §°ˆ|ávÖ~Äz[KbÊnM¿ÅF‡F_“U©‘+|ŠöW­rU….ŽÛ¼œ¾zªbœ½-ˆqPå|jHý¨¨Òá(Ì-;¬7ÄE£ãH#ÊÝ¨–†ÖƒéÔv‡û“ýªÒç·@ažUÃP¢ª±Ì“ÊýÞæc?Õ$±	„]÷ë¦ºæ-u˜A«üô%Û=E` äýg,_XôèÉÍ£[rVñ—Œ—þÙ ©~QÖç”5°5úÓÕ‚zmb+ÛTrè´áA¦†¬;Ë€ËžgÌ	hDÃ»ø–°^Å!«/’Š¬é,ÖôqÞ£Ë±‡9‰^bËc0éíðû¦E,º_Ò7wö´PŒ«Wø^ùËÁ{39¤H—
I´\}lN¾Ä%#¹Ç…é{’¨s-¤©ôc­ÒCƒ÷ê€f1}z¾C„Sn	ð,ƒ’Wo}Àˆ×å¦€ÎÌ´ï¡Yy_tÕexZ®HÏMf C‚ß¹\ñô·+cùRp>åp„l·!oîäÎôßÄ\×ÔÅJ.ÕcSíŽÎþ'ìw¥”u}x()i†G±¨›È”ØÞØeG-½ç/Ä#ÐL4l†N?õ ƒxƒ
'Lû¨›•5ÇXXŒÿà÷;ä£åï 28äV3¦Ð#•é'yí8aS^Ì¾)G'ªTcGbQ¹r‘<f*)áîÑn5lúåÝ·›%ðf	DÒÐMå|E„`9Þ_ÆJcñêšÀåÿ×òÆÒ¼i7ú ûoÙ\ð„æ€”öSPÆã…ßQjŽg¥Ê`<:ÊiùOžCè¿.Ê³iq qàÀU²€[CaŒ”2B¬ìý4€LqLÖ³êPGI—³yÉSÝCNÖ|¢Hf&T’`™`àÞ¢ý]JyqGÜËõ]U§ÉÏY>"úIÊL^(:	&ÿ§Hüˆ‡ì±˜f§Kv}u(­ƒŽš÷Žå¬²µ¨yéF†j	ýÒŠ•òŸM„î*/mËaH-£2Aì°a…‰ö›b]àðáîúõVlÊðú›k]œuÏ$Ó»Ÿd…¸rƒéÃÀrF„Ø'"ÖIô“ý´b¡$»QÌ–C#ÓÃu.|Þ¬Ÿî¿¬EQ©™ªyqË\üÛý~úÉIüÙsä'Ï:úÀ;NªN^E¹û:ÒàQÌ€»Þi·b[*‚mCÞó±ØîžŸK¤ûî^³‹ÀËáR7À¸¤P…[Tjné:
Æ”óQA{Fèš¬­ â»¾»ó‚:yhjµ˜¥ä†©­2ûv°Ÿ­À/£^K™ôP,Ghõøø·¤ÓÉî$5kk4]Ô ñ¢7_ìÚ«&É1„4 À~üŸœÜÌé£¿6vüìX²këÂf%Ñy¤Ù:…9ž\ðw0D.\ÆL2clõ‚¸”ƒÅ†A0Q1ÂæCHQ­£½:Ž‚d~ºp/ÚÙF=³Ÿ_ä;c……Ž-´+øT ûauÛ"Ú`èë<‰Ïø.jGõpMëC ó¼^èßJë[wíEþFtõ@òáä{%³n¯(X j4e²lçèšÝ•à­:*Ò5rÇÅš(—-êcáMgš_¦fZ¬”wZ9gÏÇT!gäZ·£šZYðt›''c‚&¹ÉV½ªÁn€	KéEÆéÌ-JÇ/Á“ˆŸÊ0 Ë1´ïç~¬‘$NJ)x`vèês2ßrƒ6F¤LËç‰°Å$Dß!Ùól Iòõ§î•Ìs·r™…;ç€CÀ'V’a†q[ö	¶MáVéãòœïüOä‚ˆB]N}+}ÜÝöné/ùúãÙo}¹”º‡´Í·’ÇP#HX”6ï,»>i:ÚÊuôü€VT„¦VçñÂâ5&C:‡øAzüªtŽó¦¥*“ð{Žc)¦k¦¸Sñ6Ûî5_Oå†íQ?œæ"Ó&-¬ù²IQ ¨ßäd[ÚLÚWD}ºXM;²ÿ—¯a­•xº…bFÞÜgˆåÖ‹ã‡?it…Í’ŠÚU‡Ï,Ð
ŠÛëÙ«[ [IÑòg[î'À´½ºTØ Ü‚¦´gšÕ9Êmìž—È¥†q:Î¾zí­cÞê*†V¿÷ŸVÿ0«¥5Y0Œ`/ýQÛˆæ²41µ—Ñ­¶8¾'¶Ò„ìb}È²pi´ÎCOáÕ,%CBÇ]¸î–#ì¨ÚöPÀgÚ&õð’ñá°] MÝÓtf½?ò˜Aqu$ýÔ÷÷ã¬™Î,„Ý«ûž†ÎÕØ¬IÇd1æ‰SjýËžaëÛW˜1_cRÁ®t]É»àêüR¿×¼x5˜›±^1—k½.³qcg÷Pôw1NŽmÝ5àøOj)ƒNÁkš™’ªˆÏ!Ÿü}‡W<œhƒö9b·H´]ºV^Ÿ/~Ù1é’³²
šòCJ´áÚ‰UÂ²§eï{ØœK‹š$6jðîÍ,¡Yç,Q5Y”òkûãctób‰à" 8\‹ÚÁp¾0b\ËFTŒìlzb›¦§K°0j&}„}Öƒ†Æìdç™³—ÛHm›^h§’¤IO„n-Kôy%êŸ…œ¤ÿÇNÔ ccÐ=ýlçbVñ3²’Ý7T¨ §!¤yëèŠ¥°O'Mv·¡÷òMó Ùùj›>D~+§<ônl‚…ý2Gq`€)ÎýLvÍrá!ãÔiçšÙèÿ²RVTFM=Ûr¡uªŸV”û?Ã·	Ð<´Ÿ×™Ü¹ì¦Ï	Ï!müè¯t½U$kE,é#²âÊlZßêƒ¦rM"ãGÕö³bÒ)wö[“ÒÕñ¼¿ü–¬0Mö–â-XÈ¼‘6Ü5Õ›O°\­ˆ1áo×nDÓ+?Ú· +>É¬U÷ù;bPv•b/ÍÐEÜì rîƒìwãýºê‡åë°ñ#‘LÄ÷³å£œø\#ÌîQ÷C=®HøsÝXQ)t«@qÞCD5Ð«ÿG7R3’Oê¶Ê .Ë[IÏûåwHDÆM‹±uõ—âÿêêh»ÞÒËSÇlG¬ÈI×EÀ:À::wžòÖ¶Ÿ0KRFAw˜ÏI7QÈÃs»Ñ69ê
À3	z#¶täò©d€¯r<‘ßè~ñ£ qÔß(ZTÙí‚ý1{ä%
á*™t…îØß{Ø"oÂ “ýøz!³gI<Î¥Æ›q4pp~m¯S•WÆ»’†vôÄ+ÁŒq=ÆåXÝzípe¡…ä·n•H%ñÜÞqçß8BœŽø˜à{èÐ:i,<ÊM5î¢w¯ïr§½81±Î½GÍ¤
ÀÂê“ƒF^j†Nü °qÏ­}ˆ@D¨¸Ñ‡gz§­-*K<’wNbÞdlÔÑLÉ\}¿ßê,‰À_Mà*7ÒÆ*þKOµ(œ rÓéÓ”tLJq—³¼úæí"MŒþá÷e„ßÆýH ÿ§°ã6¡âd¦íøòÅ€óÏ|¾Ü$Ó!5ó3Ò²
)ùÓé…îê¸C<6À­’ãÆ–X&<-]ò(Ð¬7äåøqCáÁ1K`3hb…~¾‹¶^hf°EeÜZ“…ÛRkP’t§>ôÒIËbE3:t‰êÎÜ¼¯¤´ßÌ "È÷#O35–Š7Ð ‡kÿàkuÑ€ŒîoV|¬PˆDP,oÔÃx Q\;VAœ0tà«Ã*¤QÃØ,jj§³iùpPY	µÆq§YÚ€ö(ÉÑ:a£[ÊGdýKXËN²19(Ü`·ä"ÒA~läE&)MÑøÀkÉ>DÒ¿\º²ê‰—‹÷Ð‹|V­&+>A ['[Ú>lë«°ÙYŸ¦PUt­„i$ô‹ey´vÚ²Äüê0¿›·]e¨’±Šýª}SõëqºxèÎŸ¹4ãNüÝLàå9ø-Æ,SŸØ%¯	¡µ ”lû¾P’ùÃûWnƒŠFÉU^Ä6‡›Kt´öÈxðV!4Œ3f×ç%ÁóVh‘'ƒÏ0¯Á;ðvZóÅäº«”ˆÎâ	ŸÇÍý=mÔPü‹>vÈIÉiƒ×_¬$úÏÅ²ÁÀÍWS,Êx¡óodØ½©ƒ}>³­¯ Í‘N*³ú’ëÔ³aÙO¦ÄvÖ¬Ij ûØ*uðÁ²¬5™1‰ŠDÌ{Ú:}èUtîGâ©§_u$F©S˜i5¸K´h}žÂLû†žn½q/êIŠÇÛüâ¥\	z4®ÿ3£]V˜Ê—¡7¤¿“2p#w“F.ÉJ‚·—n²ã¹«ÕÝ€ßÝ‹zÔãÌ‰_Qn'PrnW=Þ[‰ÐEà*¾1!ÇÌ'_¥›n@P¢Îìb¹kçköA;u\ Y{ƒ*^ûÞq¼ÊŽ8jÓ*ŸƒuNEiÙhœ
dE°æÃGóÊÕ¸±é¾÷'t¢„#ö[v5eœÒ,Á¥kÕ«k”À.ØÚ9s«ý²Ë\ÜèxfÆpf§Ø`c¼’ybÁ˜I-Ø.ÝØKIìhè?Há= ê U1¹‘†¶	.ËºêÊµÕ;ëï³B[z6XAúVÆ¯|à;è—34¬EsßÞçp|Fƒü?„»n0aß/'
Œ)æÇªg[s«©vé:‰Qç1:%_X:GãÄ¤Ã*ñ3¤€
j®=ÜÂ>ÅÍº vÍ¤#BemµrýH¥ ;¹q§ž ŽrðÇ½¯W@}ÚÓ?ëªi¹PxüG3É|þtœ%7}Xf¯êˆø¢Þáû7)Íi¹TÇk$¡º;ü“ô-_óOxqŠ–ÑÕ-‡Â|š‡mþ5‡¨Öúß‘,¥þ¯üÊ¬CJc­»Z¡w£ã54ÿîÍþLs#V‚+–âœy’ý®<ü… ô{êšÙÝÑ³‹ j˜î¥Ën"!M8¨FûÒåIl//))®êB¼·¦­Èi{@­Ó·|{…x‡À"%‡ûÁ”•>‡
5¼“7¾!ô?úœ,´"‰)Í^µ¦Úè³Ôœ8(¼ýnPâÚdôÙã²å»míGëÊñÙ¯Lýêg=®Í¼Èù‚Dg=é(ŠØÓÓÆ²%q¸:4]	|˜WH[Ö€Âø4/’eA¹Æ*¼ÙõŒÊ·Hœ£ÓÞqÃÌº4)q–GÉùŽ³\Î=.bÑþÏ÷6c'Oyws0LP	â‰a“­¿ï©¸`Ô©Ø‡BgÖt¤2Ö÷£†Œ1w§¬Y [ô0ªø©ñ)·ÐGz¤Äµø–Ç4¤ÁÏbˆ)¹8œZh8ÍQ¶C~ü„ø
åìM¤ŠI? ;÷Å}wœmð¤­¯š'„E½v­}8yÍwõ	%~œg•BP`áÖ>í3âd
½/øIôm¸½²·£lÒòÍ‹Ù“c,ÿb³"ÕîvÝÒíYÞ²Î¯”	²(µ?¶AndžŒ±ÈmÛZ"¼Óz6]VPøA§K®äŽ¹ÁÃÍðòþ°4'ê†¾íÝ[fA½ô;èu­6ØªK¡j…¾G/víƒÓ”qÚp;ÉPt¤pe|÷ö–àp·ïºZY´ÿjœÁû”ó§7ˆfóói=µÍ:ßÅƒ"ðœòNÐâ³¯àä´ž*bœ5þYÐœ›Ó`§>=çh^$²£’WjTFæSQŒL7¾xðÞ‰O$qÚ·Ý¶uu˜†^YÄðÁ'dì/[è`æT-Ú{ 'à—”Ì
A:¶¢ŽOSQ#U×5¶í#“½òºœ™òJûâ$µÌ9ZÍšLWh>Ö€º­Â±dugÅ{ñ¡)s†¸JE*ÞYlxÊð¿xÉLu/½Él×èˆ—YàSò(ç¦J¦_ƒÊ©È¤£¨Ë³UÍÅ7ø^U—04XWîÊi…nÕ•º•›S—X[ÀleÞ“HØ½B]›SÁ`É¢8ä÷ë3åléMÁ¦J5Ý˜Ôe6í¢gJ¬¡–®	Ð]–¡¬8ˆ‰ó"\üDC]ªæ”˜Cµ] éÍ1óaÓy!øÃ,hðK|Öõ­ñ>ô"u~$])¸d+&Cû¡^9¨´~º|CŒRE/)Hy¨-ËÏèF‚ª„%´G__ä^wkåc	U‡mÕ?»ÛþiaÇ6™*ªzáÍ®½'µ	‚Ö©Fl8dpÚ˜ÏÈRÊ#Do¡µ‰hl{	èS7ß&äíˆnMScï3[/øBG¬-ý€¼à†îóËÎEë¸2Š7]ª†á³&]ƒd'x¾j³fäéqNý5uð.ÜÎÑˆ!ä*Lÿõó ôÂ–ËÍÇšØ‘BZwPÐ}-OIÛðøÿQËv¼))9_fù„´ MÈì„	ÝöaÉˆ´1Ç¡zM6¸"ßŠMª¶–ú2|ÍA‡´r0µ‹ØK³í.	³D,ssí«·µÝvFBâ´@§2©_£¦âaæþ†Exy›‹ñ+?öhÁOCÝ´}áLQO¸(0b¸ÖÛGµ˜½Ý•Ž^äYÍ°[S¾¤C|DQ]I¾¯Ñ-¾ãÐÔmzû: ô’§EŒOÿ2z;tBr?ŒätfhÑU)\¸yJ1¨¿íÁ–ôÍn©ÖŸ”BCô<Œü@esJù¸Îrç…ÂÀù#döß5'‡Çg1( Sî£1ÍËXG¢®üCæìÂXGó¡×ÀöHR‹úKlóüõcå%ƒBiø_ÄˆÁR€g¼‚d+Ö„„É<ú®&Ö1¬É&§£uølì01P"Ø¶<°…Y¬`…pÇûF‡|â@€7…Ø· éç.GÃ¥Pûlîûvd,¢©8LõÐ2Ú¦8à}pkî~¡ÅÜ|iIã¤ª|:{i+¼3±&Õs‡Z1ETà|­wÜ€»œPïw?×Íx’¤9ð4FÇÈX^ÁAê£’2¥¥‹„ƒ€¨!Gû±Û…Ï«ÊÀð}2~º êÃÓu…­ê/>ò.Ù%ÏÐºt¾@Ù”óÅI€»Ò#îãÀ;Ü÷U1Õá—x‚S·Ã!/½éNëÌ*‰ÂoÐJIùÄ25Í2éáEN£qÐ¾;±^¤'çØ ç»¨Å‰8ØÏB÷Ëþ¥¥¹]`Yu>ûÏ­üÝ3ÖWáêoB;ûXM\ÓêVkñ°«ÿc'r¡èiøU,ö8-ÙècE‰_qµ²86NDfÑvJN1E¡›ÝttdÑ˜’©‡ö)qmy²ünShè½^O2"Ä€J[^4Öm¾°ìÁÂ¹¿F=l21À[‘o_—¨$]Ö€^r—ÄÈ%“ÿm ãýˆYOÄkÐCû¨’c(ï¾\$CBa¤
ñ¨o'¶ðÏõû+yº}(#Hþ7?mùZÏ¤R¥U¨5Ayá#ÚÆƒmyÎµ—­;*•m
&oC(ú\è	žóÒ 3*ÔøìšMÀßý9]ßÝ»ê]*ÿ‡*Äd',F$ó†YöeÚ{7YœØí»Z›lÙÄ8t+t‡r„¸üÁ*íýJeuÛ­–~¯]ŸW?÷?¾´05c‡ö_(C×sF ÷½20xp(”Zˆwl%²á¸ ßŠèB®¼~€D‡C€ø„ŠÄ…î’”<ÇÁAsƒ­¨5šcªÎû^Ö­m:š-khH	+4â5Ní]„ÑiÁG¯¥’å”·`îJ	ëöOü'Û9.åðëjYb&Z>7Ÿ%N/ÅTšHšü Ê®ïüÊ@¹ ú²½4¹¦ò¼íœÙ¨Ây5ÿ“IÇøÁ`¡Ø òþG  ÚÆ~>¬gù0É…Ý
þÔ”¾DÖ?nçÃ&ç°^it<*L fA¹?¤1eÁÚ8ÞäjûN?ai^À¢Éi†¸G\Ìq
ŒÈN†z!ŒÇ¢`‹”(þeÒ°³ág¾-y;óé~~
%·Ñ°%CCß`ëŸÑÏ›Æp-³¹‹¬ZÖÆQuïSœ2tû%›ªbÌÄÌ)êøä—>V–ÂdI“-ÍaÆn Ùb¹€/Ë0þ?KÔîÑäîìI­´Kt2toÛüGheKqYFŒ+ÐI:_õþ2¬6´ýñîIÝa.ŠzÍ×ˆ’=(&ø²}r]‘	©†6f¼†}i3_?>ÉþùáÏàIÅ§!«”ÂòqWýS}QëÉè´òMÿa×nÓ	ÇOD:ÿ4ëÍ¤dŸÉ`‚¨^«Î™<@x¼ˆ1^ ªÀ<[yÇA@p¶þ6ã¨‘'²¶ÝÍõÇæd‚08¢=š÷0èú	|žQþ³©nIÁÙÔ;Úømº³ÖmÃJÙ>ˆÜcrÊµånc‡WÄ¾ynGPl3çÝQÝ2©£O÷"L‚{¹ÀQ™Þ¶w‡Ã'\}¡i>ò€ÝøÆ!vGìK »Ë¶œZ¯é=‚¸÷Û-2í]CËã?G­Ìû¿Òdp-úL•<ÉÃ	•|Lâëh¥Û+îÆñö¬+é’îû¨˜±ÁÇqìëW
7ZïË(qJœjçÉÄÙ\:•šÈ¯×-9”¼k…^€*/ü;!“gOQfÓ
oã—«
•ÈéÖ³çµ!þœÀÖ¼ïµýÞu…‰yvuÛŒÈ›–ööl@Þ¿™l"ýÌ©€Î‘°©z_a¡{\ÍuîF‹W&2ßEx£J(àÓÎÜ/S:“©™†{°\“_2™ç…ÝÇû×Ò™×{ê‰)Ô×i(’FWi,ë·˜í5‰R»HÔßQjGŸG+íÕ‘äñ–{)4Öq7¯&27l‰árííË»½Â„òE
¤“¡2}=ÏD‘ÁÈ¹Ûª Ž"©Âl7ó¨[Þ=‚ aWŸhÞô–G@Z$Ñx&g9ûÖeTðvŽÂ8ÞVOå…<éÊÿÈ:'$1“}·Œ_®àPÐ¹S&c†—œ-Ê@¼Š*
¾ÚP‹OŸ^Ùgçt¹O“	m=Ji^¢Ì°Š›¢‚Þì ¡e<«‰‚4™¤õVßDF¥±:¼‹~½àÈV‡ÐüY…±JÐ4ygVh.):q¾½–©Åˆ™ =)ûÍº¶Ç.’wOêf‘(ßÙÎ¤³/ºÀh¾sƒ»·L™+ýk8ìà}•\Þ	eì!É¯hÙ¹ƒ#µ¤N—ËlÉÃ‹°ŒÄGç[Ê2ŽüÐq½ÅM[ÔÃ>a«âåŠÅ#C!*>Í…hEl(öWÇ
ä"ù3Õšq5ïè›ç%g½r³c„ëÉ?ÔËTDfb'¦¸fv5xÿÄ9Ðþ‡üJDfPÍ¢¾Ó6 Ìé£Ü¦+ÃáÜ`pÛ¹uTÝóEÃ”¹…a€¬œïR­þ¿­G^+¹ƒ¨«®ˆZÊ-ø¸u–>=ì·7kè“ˆ,}Ý¢/«4oü„ùÛ¦)­WbL-yk×jÅÂ¼^þs}ÌkìMÔ4&ËžÑ§v öü¼Ü-ÊõÄºíºT /9ìx=šà×i¯Ê/B©ÏãGZÞG;!ãY¬\öðÁ•¶ÕÖ¬.ò,Ø{„Ð‚R1ŸÜ„ÎTÓtþßdˆ2sÆ2e–Î%¹mw‰#!ï†àÑ×’ÏÝ¡eCòó:j¼ˆ‡þxXÚ•k‰‰=…aNE=»¦™>¹šà¾Š1ó—³ö´¦P›n’ÓÃºÈ%øz¤c”è‘3¢’$pVkšv£yaS1*<ä1º%›œ¨ôK´Û… Ø)¬•´ž8úñ»4¹s BøÙÌ%½d£¬+ÍÉÀÁùùï"90¯AKrfç¡ˆÏ;U~ª0ü8KNšl%“’ÆÑ‡^Ñ±J„q:?rÎG9ëmn¡h-ªØÏx´¬Œü%Ü^ÞfÔws×«äfižùI1Pµ˜ÆŒ4U5.œåÚ:ÔÆÛ*y±‡2—…Ö™¤×¥×#›ÿÍZÿRNçç_A„|z˜ÍmnaVuúQðÑ9’l-yZÞ`\É£#®‡p~ºôŠMÝû¦aÌ×¯5yÉ’r<É–ŠJ©È‡‚J0î,©AùÞV»’q©CÅí¤JÞ8³p(O–ëKø½½áµd¼tæ²)“pU‡/–:× …þYÎxái‰‡ú¥eº`²gëÛ<b	ÞôW9¢2˜º›„/ä]ù‘Ûx¡Uã2îCk½Gc°\*Ô{Ì"à’Rç,óÿÖg qÞL„úãJåÆPÈ4EzÔ…G¤,0ôyògð›xÍ Þ9¢øSsy?©Ü6F#”z!J,ŸsÍj.øa ¬‘ö±¾ ½JŒ™ðN<…ÞµÙiý…jÌ>…y6CóBy„Ì½¹,?ÒS¡Áš2Y‰€&’†Î«\Hšé¦`µn(Mý¡J§|þM³«¬½–s¾_Ã.Ië© ˆ¾À:gÂqûÚD=j U1==Ü_Ë×ÈîËü¾™h$ëžD ô¯Ï–ƒum›ÃèËz’œþ/tê½ªGëýÝ;êfkžAþcŒkUDÔî‘Ám[.\Yd °X©…ÁÁÝÀ´›X»‰F'ï…½˜b6T*!­­Ž²½Ï„ð±VwäïŽìd.ÍÝ0È„Nwk5 ¬è½	j
•	§Wo4ÍÃ¾9Û§T¾“`spT¬Ñõ'À¢ß«Ê¹Ï h•ë"ÈCà5ZÛÈ‘:5¹Õ¥Íˆø«KÏ®žú€ÒÜÑKÉ®–’ÞCÃOøÍtî{;OÕzÿ§Œ–<Y”6å@`—'Œ;çü=øq€wÝ¢4$•Nxoì°çãs•À5¾æwžÀì~nŒâ«ë¦Âè·Æ‰&‘Bâ‘P¾ …ïŒHÎK_ê¬Vº¾*c8bý}M,3ÌÀÞX<8NÍ,½*d•>Ýpã¥Ùœaåmœ”49JóÅšZèË¦l²º¡A"ßtŸ#Í¼rÒö-ùvãŸŽÃKU±Û˜ž)·ƒ<†ÀÆ8ˆZõô¹¼áØöb¿C„ZÛM®>®TèÀ$+D¥vnºÄ<© VE.ð?àt½­ó_Âá¬@”Q°5¸Ú4µT	Lêaß‹ÚéÚ6ŸÎfñ+!ê­X[†}ØÍÅ=<ïð[l%ÌwÅN•¯QqÅNÑ_·ñn‡|âøpx	´5Â¾Ë¢ƒm¸–»N¡Î{Q7&O#Ž²1:l³½PžÇ¶J‚!#0öwÛ„Bø•˜œ„AÛÝuÇV]ò=‹á¥Ÿds@7÷zNl(ÇŠß(»FK|&…#³Ç*Ù„˜§)‚DºqÌ*)…pŸ@³ŠØŸæJcd«ÉÈõ14[+3Ò ÒÌ
OòH­üf‹_#€X`¯$eÝÄL‰Oošþ §®vZ(ÑRsë’½ÂV.Ì®%vÑ^¦þ×x—ø—:8¡–{*|Á÷o" ˜äwÆ’_Ï¬Zï^­¿äd~áÁ™6ûu)‚ÅWX7qI>U½öôp$ÑñgKi÷ßyz>af¾²äwBúpR8¥ŒÁ^ù!kd¿ˆný1brHØJÕføûîÙ¾ÿŽ¨|D‰ð27ú¤tçè£ã0¬EÂL"5«HcQ–-(‡"w2ÒË)ÕÙV´$WÕ²íù9ÁV¤~ÝFè§ÿ|Á{½¯ JÁ¾Ãø×Óo°­->´rY0QÑ…†1>mÑ»ðTæˆ¹Y­Qda¿”&v’ê¬²“Ã€=ÇoÉ‹hˆÎÅ!8ºõ‰Þì¡mÚd›À¨5?QQò!YåYiwóB„Öhå3~}˜öFM{Àj(ÎD9ÒªAÈì,6šñ3mCLÔA?¥|1Œýí*µ˜2§ÌÈ¢yxjE³QÕ¯—S	üy‚ü¯½{>Ò&qOÿÉË¿’þóìþ)Ú»v­ÐÑQÑ‚ÊEÈ©ØÍI“Eîó1ñ$íÉRAKg(Ä	$Tn*Åè“Cm[yõuIr#X*ùNNÍ‹vâéj0†íÿZùUA®kˆÝ&ïíró‡ˆzÚE
K‹FmF'¨^Î_Ð‰²M]à~éõêGé/IöŽþi'ìÀÞ)¼LŸso8°èRFT›<!Ã	Ù^Ô=øãpÉ_’¦?Êe•vöwEÙOZÒ‡Ï!J	U÷£q¤ÒtTPªÞoƒ0Ö²§4S¯Œú}ÄÝÅâ‡µL|6+;šm,vÏä›5Û&ËW,ŽÄ¬GY:¨ïÚÀï|Ô·þÚä†àZjê|IöÂ¼=™YµêÂH\Œ¼p;A©:Rv¸ g³{bà/»$
·]Q”&:ÑŒ#†ˆÆŠÔQî¾éñë?”[dnnZ®ñâ/JÌ»rIàz¸Ñn;¢šèFpnú®¾_M‡’ï(Ÿ7ô´ª:Ü	MSÝö{øF}¡îüÌj••9<Æ!ä?ãÞ_À"úçôÊBÅÎ±£Ð“ÊÄxi‰Ó:ÁÝüô;d¤vâÑü¯ÈQqŸÂÐ¶ÿ¼¢‡háE-0¤5Ü_‚›ùmpœ=œ7›éÙ­Ë_Ù$XÑLŽj(ã7Â¡ì¬<N=üvl[ÁãÒ.Ç7ûX6‰Ý’ÞÖÃçCÒdát¬ýô˜š:´æIÖëIÂ¸°N«™À‹¾={plYbû²ë? bME³DBãm‰m†ê×'oPFÉðÁtžŽ•®ñ^„R»dÎÀÉ{ó:Ð”âu-;Xû[AªÏÐ`bY÷¼°fäš…@oS©§udÖá}(jdhØÎ}4vM À„üHñÓ7ZˆÝÊëƒA´	}W¿Nâù?^/
pdƒÌ
xÞSœâ^``t7‘‹sŠ¿yü™×VsîbI8¤Rµnû1%Ù§:o<ãû÷¾Ÿõº0²jä¡Eú/™Ëa„˜ \øw+‡À>É‡úÞMvú˜·¯õxbÙ	Ê b\#çClm$¶K–spæŠð®R¥ÆÊéþŸÈÑì„2_aN;CnŸ|¿œƒ»òœpPa[7;Qo¬WÏû{^LŠ¡È!9cPÄ™|!£¿â£û”'¥˜LÁH@jOwq÷`•Z±=—×[÷ñM¢›ÅŒà²z¢Ï<‹—Þ¾$™f8¸'k|XÛ©$ÇèÞëå§×Éº›äðŒ¬ëÞéÛ¶¶‹Të'œ.âXØÑþ’;Ï´$PTáûU8![4;`7&à`e%%á/ër•elFGe£$Byƒû(Áá7IâÖÚæ˜43ÁVÏò‡ä} šNR‡–#KK½\<U¾]L¸ûœW¶ŠÜêtô&ô²¸Z’þOŒ«‚E‰Äjç¶ÐŠÂý1#‹¹—C™•¸µ£-&ÌGH7g*d¤¥.JuROÛbÖþl½Ð0NifŒ*;Ý%t¢¸ÖWßcóoÞwìJñç‹ÔãŽf©LçÑ¹ÞÈTiÝ}Û¯òëqIg]n“ü¥8z’ºW+Íû8¾}ÄZ-ò.[l@q¦]õ.:`›ý}ÎšjäDZêœP+tÁ²ˆËmß†žÅš·®†ÅË:­•vTÃOX§“UÀÃ?
Â1 S;é‘§ì?Ií»(šŠ%ÕU$:yÈugcO1•€BE[
l©ìÁàL@)¼Ê§Ôùnåxp½"·uù“òfrdØÈ7Õa…—È±õl¬ÇH)F»8ç&(Ò>›öµ|Ï‘¶‡Tý£B:…´Ê½¼9“Þü.GÚ¹a¼	Müv®yð;[bqtXˆpóZîSÎ–¤”gäµßÀ¬¸}gÊ¡k­Þ|@YPˆ˜Ý2Ï@ßzƒ )ÊgØïL‚5q('äæç˜
öKz{Ô.4²‰½·™ë'ÞÖiZþLÒËÙL¿}Jðô|äX-s^[lÑWÅ}9zŒˆ†2@.o‘-;lÚßçó’LŽ“Šˆ-S>ÆÕãÌ6ÏÝsû¢æ[G&ÄBfüLÓö2á¾èWû¨<•Ci?÷Ô,Æ1µ#^¬{Cu“ÎÞš›÷ŽûY–6ÈŠ^žxŽ`ÙéÑ_¿°€Šug¶V‰¤n .3Fó…sò¿CE(þ»€p|¼Æº|æ.®ªøä€ës*À»]¬Àb»±'Ò±yQ3´¢øxŸŽI›H!g'jˆÃwSÜ`éÕÇõ‘X£YÌžhéL5F¦häÄŠÝÛ¸Gô.¨'O[UOS›C`¸O£³J&NoùÕ½;·e;-š²N+K°ÌÆzþ‹ß=•Œ‹ºêû‡ïÒ3*öðSSgÎ4>Æçn¾…©Ò¦4áŒç{àéÀÇ²§ÓÛ”¡†zÇ°B^šá×‚_ÈTùVäˆqÇ>Ž¤ÅµÃpîñ·)õ±™÷(ÉZÃ©#JyTÑ€þ9´|˜EÔ-è®®cšJ'ê˜`¦ÓÁÄ½3‘+fÊT&“:Æo±0@•gðw› <_°P“ÂÙ2j0NmÙT.Êôó´áæø…¬»zç<ÙæW‘ðõKÔ°Øà*®ñ„»Æ	½¢Ó4[4ˆíÃïõžš	xÕz+“46³VüŽjÂŸû-ŸfålØ–¹ E¾ÆA³µ^qLå(„­3Êm³U;÷åÕÆÊÄ°ªñ[q»á‹>iyìt}Ž3¡äÚsñD|ðò§é|Bèúg¾(PJ]¸wlfÈœg“)ÂÜöËjI<öë®£r¶Ä<8C}Ã6)çßøz)µÓáy
ïYý±ëì%À!aråK[r™Šëió5fä«E4«ÆÊÿ±j1n$€>KÚî=L_.æg°eOÜxØÿWm3Öh‚ôM˜Ì¬
¡W,L>²ïžÖ>æ6‚QªÌ+fÓoÖ:kÝm6šÔP*Ÿe÷ÌO½	y5§,	&B¼Õ…q†M”Î;Ýýüq‹P×a^I²ÇQÒó…9ç<ð%U´ƒFZõ\Ü/4^”å`Ä;ï/„ø˜¯I€MžPSÛý5ôžA?Þ¾M/=Xy“Tá[”»d6ÀjivÍ–ýàU‡·
¬ƒùØÇiÑÜÂ!»q‚j¼ŒN3Â‡ÅiÌÀ Ëi)ü:¯ó‡0KÌuõŒSaùž¯_6˜Wïø!ºÒçÇ—d"@Gú/H(EW¡YZGùÔ—„ØöÊ
úí;†âÔ!Ô3®gmÛ†,s•¨ß&&þíAâMÚÔâ²H¡\÷¿8ª‹™N¶`….ÅúþYp2°£/SCCtÍÆ Ý‘Ÿ/¹ìë%(T 7c)0ÁkÀt¬×3/#)°žƒ| £S¨KÛ„Œ~´üÍêÉ(ötˆ˜\MŒ§¾l¼ÖžÒÎ}×ŽôÎVoZÿj]Y®šª•¦9B5
†êaC‚‚µÌá\U¸‚V0…¬9{‡1‚KRL%rRo¶ŽÑÌ"Ö#¢1ÑldcÞÌÊ!öC·èÚ¾{Ñãrjêƒï]pRÓì½h¡žÿ{øB=Hýzúa—oa€ãZÍ¬úã`'Âk‚!ÎÕsDˆa€‘]QÔª¯Z¾—cÓ!„ÐŽwZ)›G„Ëý˜ÂJ1Ñ‡Kq!Ó–<mD®-Ö×C>¼Ù?wWh7¥Ù.×7³0`2zl5~ŸýâAÄö¨ñj¿¾ÁPÏ§ék$ý“[¢Ÿ¶£OûDÁßZö‘†%>nÜ‹MbÃ8Ö¤d*h@ŸNªÎ-!e§BÛºªƒÔ0#œC.ð-£$ýó@:jJ™Ûª™Î°0cŠTþ| œu	ð[ÿƒb‰¨›ÚGúf8qWÖ' v{zü °¯Ô¢€×êó N‚øµr¸z òé˜ñ…0žB@dc9Jíé^NñTä¤G¿Âkx‡˜*¼ßëÉå}ÿR˜aÖeSñ5úÃ$7AMº*	¹û‡ýþbð”ƒ­p|–.³Å²Ê”-ˆë{pŽÙíó„À¥5niêt9ÜÞÔàUÎi¬¡ó*•i[>ûæÈa	,qˆ!¢Þ)y€½)
}W¬p	[’ò6ƒ!x Ó&±Œ’ïìùæöúXF°.ŸÒBÕƒ³÷&8#S§ÉÄe)ÏIúá€äeÁÜ“^aPv—»ÃÏ–‰7q“`ÚmMy,m½-3+7xW$¼Íänê——iëËlì…NÆm\£O¸¿Ûô„?$°².€iR*„¼¶•ÚH„·ŠM²˜°ËÇãùø”ô«@d¿ã@q/¾àTºRŸ§£N%ôïl¤'t‰L¥§Ó‹ÇZ‘¦ûæÛ™½G]‘ä,T"@·»ZíC
†«á‘OÅGöî7‘q<‚À‹ü´ŒêCùéð7þYØÙhûmÿánz€S§\QL¢œ–&ëÂ9CEg²×~6NÐ©ÏæÂ^uœ„ov'6(>î¦0éVvµ.<¦ÚtQíKì1ÙÕžÎü^’¶Ö,íòe¿ßG°ë6·/Z*«©±‰œ'3ÒÔR¿SËxÎúÞ‹ö8éÑŸM"£ßx„í3ß8e&+0‡òó2#Aã~p/—$´æ
9ïŽŸëÃL\½§„vºo›A YncEÃ6µ˜	è!ž¥z¼þVVÍÁû{Y÷õÞ
u¢kó;±gà‹H ì+’i„eÊÅ~HæJ¬m—Í=ž&VçÒƒÀ‰9;T'„¥ŸÑYIy[EVD[ä›ñ9&Ÿ '|‹w‹Âc;ú|ê0e"§±Ï%ª•ZÌƒ±‘³4:1Z7éNù}¾hÑ 2¤^±Äí6`}Œ?soº}RàlÁö²'Hï	Å"J
šM%‡…Ãçx,žù,‚åK¯çöËçã1ç´¦»—òØNÃ_ŸÿLË ¶ÄÂÉ=B©üÃ¹h£cºÁ_ù gÖ	nµIËóŽL0a4>ï5|%F1Í_RUñTûµS”ô}Äº‚ÀÂ–4àž3T-zEDZ;¼Å3„4kBæßã©¬Ö]ŸG¶î¥&á®+5_	ºBåà4ÒÛ£¶Žæ•‹Ý³õ`Z	Æò«Qý€_ BO'ÛÀÓè(|á'›Ó°}ýÁòÀ°¾BÔý˜­»ˆ·GE îèA—Ñp¤4zK¡|A¬®)X*‚ãþ
Iºç®÷ü%ð™B€÷ö ,ó„€y·9žò$¿¹€Ä!Ñ“ëÛw/&Ûg¦Q?ÅˆP¹ÙQaÖ§éæ=&ÓÈ®*_{™³K\«ça™ÑÁM%<wü<pž^®:÷ý	dkkNNÛ‹WFµ—Yê.¡Óvý
™fž›_•—ªJ»”QŽÛUäI…t²vøŸöËÞéDkòPœbFƒ%œˆ˜pÓ;	—¶ˆr›®¬ñprw)_ˆøö!Žxëè˜d|ÛkÝ‰˜Lro…&´‹› öŒ†7T2ˆ\ÆäÒ®²³oæ†u9~º[°	~;:s¥oÏ‰­ÿ!RuÙ EK}ç¬DnÎO½¦£w©?ðE¹Ù„Ì ñÀ»«AÜ(±y¶¿¸½uâ2`³ä ø^	à´}ojPOÎLë•"´p\Ò0µ‚]â¬"¸äü»%æù6d+å
O‘RµqÉîÂ
t:N´Ãž~+`¯ç5U)pEíä	Ý¼ž±¦ËzžyOÚ€=û©ë}‰} ¡²É[ëŠˆœ¾®Ç~sœô'×‘üMïR…L(%°U»¿ä—éå,¹‹ì£“Å‡>X.ÓÆc†ÆFO)ÒQ‹ÆºQHîÛêä(Û@¨¬/Ä\Í1O¥D…j'6“Ýcî]ÒÚª‹b(x¯m):Ó½¿ém#œôGèA9ý4QÊÎV £Ë¹qMœÈfq0XÛYÓ‘™6?7½#-HSWÝsþ§rŸ‡Ö¿:‚‘5¤­§×åwHs¨dø‹ïYÍVœl8×–G>bŒ§á}…Ëxî=Ìxîz[ÕÆa
ÊðƒE0~OxÞós”™í½Yþ+LwÓ´~‡ØœâÚNÌ¬E×[^Z¾6¥XÑÉñBÖ‹¯­6 K„DþŠ±22(4K‚
Þ®©ôÃïD¨Š•zòÓ#¢d>fÍÂÐMûzÿXÚôÇ3sî<¸ý‚¦d¨ÂXóËé¡¹]x;®!…¿ŸLnÄfUVûÆFúßQí°%E÷|ž"V=–“7¾ï´q)|+´àýûØâÓ—pe5›eÊTÂ8.j|®úŠºÔÒáE™™¶Gã&`?$¤zÖtÄVñKÎÇYÂ)æ’%º¯´(“ûzO™Ï*8B¸x¾µTe«â·ð¿ŽâÊZ*iÌ:k^kî! Ù¬ª„žæ,`…Â¡QþËõ
Ó«\’Ñþð¶6¯E»E¦­“èx=6d¹Äâƒì·ðýï;ÈÂ¶èiDº}µqcA ÊÁî'µ];§âG-cGGŽ6ÝBˆ=X¥ÿ´µLÔ¸¹{€Loþþ=v(tŠôk*aû\‚›ú_Y¬ò…Ü[ÏÏ¨Õ&ºR¬É,„?Œ¼^¦UÊÐHÑèñ0ý†xóFô[U?µ™uîvéÈÙ#´RSâ”„Õ@šÄ"lüI'GÇ!T÷Ùhåíì$ lâÕ‹pç\Ô(óù·ûBƒ 'vî¾=MÎ9.›õ…ÏÖO.¸NénÀ”Gè6k ý9ùtìä1ZT AŸDEüõ–‹©–zDðÜùÓ›„wÕYM²•Ä‚ò¥PsYÑxM «[!ènò¶IÃŠÄwG±˜&eÆaŸ.8®6Üy"!hÖâ`ôWcK Qˆ<ZU)yšó'Ýg|™*ïµ0“ ŒXFÌDUŽ'a$‡F„R!ÜæPAfOR ªîà0ïï•úé­£Ÿ`®ž•³fS¿LeGPì›*F[ÉÇqpuÇqÃ«ÿ°µtM±[e8Ãgîã‹soÜ÷ß…zþGã8äÆÜ™$)0‘§nvaT$õÓTªçëª++7¿C%¬ V ßHv+$Àõ8þ¦ìÔ>P“$4O_‘Óy4Ÿ Ì2Ðš×JwL1ŒŽäterç"ÍFÎ}Gi;ÌRhÈÈÎfòC!Æ¬u,‚>ž9=ñ"ª’ÒÅfä>àEc_-qjùØ4rÆ¸Ð}’¿Bþ’¥œWJyá-açýQ÷yÉçèÇ_ùì¬zc´J¶þŠÊóÞí+ä¥¶ÄÍ'i-ü"ršß‘¦xŒ
F_±Ñ…á;ÀŽ=ºd-
la-®PÌ!?Ì½Å8/Vvbü„lÛêšÊóÑŠ°ŒÜHw­é5R%ù|#•[ GñÁ©$– q†:à„ê†õÏL¸áET½©æAÈ¹Ýê›1)BÁg1Iëù·E„êSòIäß_\û5ô}=àeÍvwÆ­ÙåWó$„Me¹dÛ&®G, VMåâýÉ-R÷Ì8É&¦ó­¯ýw¶Žàó»—MÌ¥ŠøšigÍ¶_DZy`$è2+à?z¯@IÑ/4ˆýzbJÜ>ûPàÃYAƒì=%X/¬#¹Í¹%ß/·tƒs îH3®6W š<³!§Lõb¾È¥-F†|‘I5Ñ¶c°D6êÊ%x Ü’‹³¤‹wP<}"=ea¾æŸ@ë˜8ÍŽÇü=òÊE@1¿ÕB?›ƒž&#®á²ÕãNs¤Tv2Ãê^òÔ¡¯~wM4Çš©š7ûZû¨åm”'2¸,ù<«\†€÷ÁWÉD`[Æ5jqLd-=a¡ÓËÔóÀ†Ñ‡ÒmDØE _âì›±W‘œ¼ð(X„iÉbö6:>kqÊ;:6î×$<‰-VbY8éH·«íÿ~¹³Ÿ?'öá¢q—m[¡á¢§A^{é’‡É
µ×¤Ì¼. ã° *`'Röï#çuð;*ã<|.€½÷Ðo|¤TÖ¿[O²vQâ]ÁLÍµ©G—6ŽáÑfñ›‡êg!‚¥¨¥¢§|•þLV¨Ì\•u†uÙs=±Lænzì¤©„3H6xàžÎàjðWæ©êßEK±î#×"ÕVñ½<ÐiØ…vÍ5i­YïÖ#Qµ“ÎOP¤ÕþŒC§½åæÍQÑ˜t±^[ÉÃ¶Ó§C”D+ÙÊ?ëS½ÆÎ[R×Y8+¼"òOþ±í¼TÃ‚	x2,nšÊcf~Sâ1izäu(ÔOk>1áŠÃƒ»æ–·ËlZKˆc„	¦\kÜà
ÙM¬€‡4'KŽ?âø6MËoÞ˜ÕM˜9¨›z!‰ñƒBÖèömEŒÍî4çAìLö«Tj(HÏàs£SEQÓï‡f3G8/@yxËgÛ€+'¥£ï Íy F/!L‡?:ƒ›á"Œ7³žÞ®¥8¿]& ’7acõm*UMŸ>É[Xý»Þ¦O-³Ûª‘0çwœÀÚÒË¡S–Sv{nnš5:‰½B\ÞÀfØß ö„šDh}íñ:¿ßW³F¥Þ•Wš<¼,Bä»ª#eRœí‘½…$!Ô"¥…Dµ*¢Xô¼È¡­#m]]$ÈâŠù´M´M@`à@ÏGý³¸p«ò¯ÿ¸9™¿áJLhDK®#·m¯·!Ö÷0ßk‡<*më×òåsœúºwjÝä³e(ˆ: BQã7þùîª¯<ÖÉ)¤Äº×U?ïmÿ*R)Ñ<¾ƒýœ’ºIœÙud°áÚÔ*ëè@íÐU;fï2­Ó(1;âÜ”ðþeòƒò¥>›5­pÿÓ™ö±SK¯gm¡r
Ì¢8Äå±ÜÜ¶ \ô±¯‰å@¾ãòW"Àkk÷±kÒîjÒÞƒ¦Bz–¦5”ÓŒØÝsk»Œ‚	þÄíHT‹Û{¹:xp—÷ŠÐˆºyG^ðq
ípØf_¨©JØnÿÞpl?Kß±ý:_ù†B™’Òø|wé®Åút=R3…]‰¹âÚÜ.ž<'SÚ™áë×˜[‡Ût+>•f|_Ùîùß×o\ÆŽ4˜ñnð?‘jšÕ»Zw$Œ¶‚á:åÒS©\0½ÆÅwIa|"êøŸÉwÖï®ü JîR~Ðo!‚Æ).f5°Ú¿,ÆÒlä‚XTB+ö£¨Ï0¶wÈ»|\Vüq
-&-Õk3Ã¥w<ØéÖMžËú™zív—ô¡»Ì[&¢"BÏÚI«VÑ$okß*ïSdêÒäÎŠÜÎsÜà]BŸñÑ[@`4£qô`KÉÿ%ÔZÖÐÒ»_ã4ÂcÞm¹&éÎ‡£’ž|*^tº»•¼U„‰ø,RNb£$<•:YX6œ‚¯wL†¡~v•É¨íšÉx÷FÆà-lÈ.Â<–­4Vhý”…îD#É¢Öy“°ƒ!ÕÄe 
vG:ÔnpZô”„†2b”«žî,ls®J³õ8„Ùì‰3•«õTqì.|™¡cZ‘â‚LŸÈ?¨˜%À×d}m*ñ7[°6ö¯Í`GÑä™à~ÈK¯hÊÉ(oUŸO
ÿU=KªÿYDùZ®Þ¥eÍÕˆéÖº¸ÙìIÓƒBóÓ&._„|Ö\ö… ­¨â“D~ŸŠrAÆ!šv<TOHŠ$¾XÇÄù	ÇžÉŒE’¥!©¯“Œ7s·9ù«Oà£`eµ‡Š}§qS,\;¹´©ed[Y÷5æjÚhÜÔµ+xl7ýª»ÛüµÙÖY(@Jq¹9'.Q+&>9Qñ@8’‡Žê,`Ì.Gô²„ÆiLŽßüX^Ÿ¿„UqäÌb£î¢Û=Xäð”Òâ&g¼ÂÙ9¡n7V°†Úarï :VÓ SKñ\
ä²Âž|Ë
C×7šÞí“ÈE <“½®Ï7q/‹†¶zÖ=%Á\nÀWaVK¢,™e¢‚j‡¶2µÚÑî	ºŒ6	cëov@êpî"˜8îY@ ål;Ó¼SMÀÄh'VŽùˆ%Uµ.~WÂ²é×T7¨#v<pÔnBr8IÐ‰Iò^ÿ¤pd›y3û)ÈîònvU:wÔ.~Þ]‰°0a	¬Úí>IëùþŽhûÕæl‚£1¨–ƒ²ä¨ª&üõ‚'^‚ò7ô[áí3÷í““Wz¶.€œB›¨m‘¥B5B“;pÛ}¿A Ýx¬öcRnÚéòq§Z=î«DƒƒAúŸ+©lîd|sÁ‡/ïƒŠ$›ÇM(¥®‚`òŸÐ#÷Q fÐ"Gú®êQ³S Ú3øå~‘7©ˆ¦²-úeÆ¿"H‹L!åa´X¤VM2UX®Ü÷“d×¤ü3ŒÔþ4~žiÝö5ž‹=6Èëe2_6Há9Î¤ù+²/ÙpY¨ÈIš™O|iQêjy„ ìŸªj×§$a9W…‡n[ƒ±/ç¢PŠÅÆ;•äÔÕÁ#Ú¾Á¢b|Ž×ÜR#ni—	¶‡éË•Á¹ v[Ú¬#Õœó9-„“9„Áš([›püQÎ¡$;=¹ëUÅy¤$û‰Q&ŠSÀl‡ÂŒn‹E G˜%õ0MJm2/N{"‚ûå[Æ^í…_bù¡wjÀK	¤>f]­ù2{_W|†mKùM·ÂˆVöª+eì¬µ`"uAfì2âMþÑŠ]>&)ÇikÍ6rA11…šN×J^T¹ý¿ÇPäy+@[kOkd»+åcUQÜúêsØgWÐ!Š^k/Ü£*
RÎ±uRî^Dµ·&sOm_o°â•Kæ?Ë–ÚîÊHyþ¹÷'ÿÀÓ>I1H«Í‹ðý¡¾~ËE¨íS¸¬	„7Ù¯«)øœß«±(m¿ÆoYŒœª3P½ŒOI:‹CƒizÂ1³ºñýí§Þ˜_‰gªÌÓ~| ù`–E´;÷*kŠý{ÖÔýðòEÌ[Ëóåå[RÇ¦œ7ÏPÑô¼Ö"Óªýtne½Úg–‰þ L*ÞÀÅƒ¥#dU”@‹“Ç‡ÿU‘ß_åÁº/{¿þÓ3+tÍÞ{™ˆÂ=œS%Óöžãb_Ÿ¤Þ5eàÞ—§{Ù(-«¶t8Å;°Õ“¡Ò1–çX¹(œønPÀÂì‰¾…»:"e‹& þŠý_$ß3z÷‘Nø!­ûéÎ¿ûJµAwkž˜ñyW\ãED{ð@–HŒµeÞ¦LœÅ^Wý•ˆÌU^¶Ãˆ(ƒ3n¡!Y”q¾ÉoZÛË@¹±5%uqã÷fýŽÑ.P·8Ñ—}ž|ÆÔêKË±_pû •#Z–éíÜ“âuR<0õ~j°šÛj¼ôƒ¦u‡)‚ëªB&‹”j‡uô·çõôÍÆè¼íÑÝs¥Û6„›	ƒÚM\?¶‹+Ùé»€ˆýQïY´pÄÚ±<5«è´ÑÄ"2y×wa>ÊalÜ”‚Ç1-·ÖÅ‘a=.¥QáË/Ð×Þâàcv¨/h ê!–37³vëÉCÆÆ™˜mf&dóàé„:ô…c]šfÞeÏqÌ=–Ó¶¯Z®ÌW˜·Â	¹	Âœ‰Â³‘¨ürŽv˜ÑûßL<Ý±Ö½yï_¾¢Ê³ãUX¨'÷ÂjÐê’4ví“ûbDàLˆ‡ÞåàpÁ†›C/&³õ]ÓmzÙÁÑ/"®·1&Â{¬‡ñ–õvæÖå¼1êµ;äË«ìË–)3Â·ó6<73…Ø?ëÏ#á«q'íM	µR‹ƒ*:EäÚnzð~»=ëhQB@[T…ŸëwH#––‚°¾¸ƒüž8Êb?PÖcw‰ƒú¶¦¦¡LµPÖ¯¤`9=T—¾îÓ/›±Up(è¢*ú:£™ÃÎBˆGˆó)¬¹ -[§¼r±ì"ÿÉCÊŠZóËr¥X"%_ïûâ0”«KÕÑé$&Ÿ½²þ“sÝ	2hæ{B›w±ž½/€)Žž«¥(€>WÜ‘ª‡`r,¦Ý`	ûTš©ÕÇÛs©$ô3«ÆÆeê(˜Ñaª¼ËpE!{¶í§M%7]‰*›Ú*j«–×Gæ¾¯[¥
‚º9ð±2ŸpõJ/†aZO“oø¸×œ³zÞ±“ýð u[ÛÔþÜMª?dÔqwâS{Ü€G4È%°Aƒù*{J¦JælbéÂ†V GØNœ¦Ý‘° :žU…[%¡ƒ|C<Îháä–^
œÙ_­b9×ýíYUÞýÐT.¯CûGt^¢‘–ºd.6µGÒ‰‹œM’u9,VµCtW»†AÙÒPZw]:ùþÔA'GÛù¡ÿŠ™›†kÚ%iÕí6Ôã;"S#z_¦”0è/«¿,øÔÔ'¯²GŸ­âž•t5›ºŸbë4%!B~]±ìÅ¹.ûáÛ ¶IK¶™}»{°Ìó‡é”*° õRá‹{Ííl¤ÓLE±‡##;êób™®W¹iÏZêÍŠƒuS>btÇiJ8'Ù7z˜‰q›PèPÁ´´ÈfÃ€Ç””=ã­cX~o÷•Þm1Ê:ƒÊ]4¯½ë²ky´dŸ'O;$ŸV#CùéÑˆÕX6M˜I–È_"Gâ}²Ê6O‰»€2>5C+§c^ÁˆE~×<bpyôsþ.¼âWyjoÇ€S~G¾Ò +Åœ7ŒûË÷Ù†6ÆÃ0ß,]C1l³>qµé/`ÕPÁ&³
DÎ^º_wÎ”Ê{%WgŸF™µž¤[‚¸gülö¥-´¢¨Qüåm×e››D€­¿E¼Zj@_z±oËœbrÜGÙóÌSeƒc³ó‚
Ó…¦ÃÂÎPZ“›ž{”MoÖ80åÃ"½Ìy¢Ý³·p£9c—ŠÃdsƒDP~·'“¸•|ævb!€Òyöb(I9u'2å¯¨Éú$º“õ÷ÈÀ†šõ³%TTUÙ¿äKï”%ÑB £—5X}¿Ét‹ÈwJíqbÀUµš+•\<”°	lŽPùË·Š±-xéB}Ó4ƒzp)å4.tkæñˆõþÌº›àN¤Þa3ðA½º1øºYš<[áèÛÎsóº€ïúMuŸá°Ò,öL`ßféIÍa÷ÇlÜ,ñä½ü…$7Pt¦Šº¡ažë;"u;Lûéòï½¿0œþî£&ŒÒa­8
ëš›ÇÏ"ó×Ô¼ÆF¿¸­ÅG9yáOó0·Á¾Ò5üÈ®¿¨ÈÓî\ob×±øúôÊ”Á‰†ÄºÆZÞ–!’iž½$ ‚ó^›îsuTnÅÈvð“i¡7Ú>RêÐ÷55(±ñúW%çèp“9Eý¦%F¸¢dSÔõ·<æ±³/Šö;óÔs3o.6ÁG"é¶ŒSk»ü%É«ýðÐ;2Wcv	‹š¯AÎðNèÝ$ª*Bg˜)ý§ÛwŸQÚaU ÞØWÎNîÑ'ýâ» %ÿäPç²ñs#½ˆÙ†À1eFí¾271Ô°:ªf&¸¬§6Ð.Û†wå¸ßZ2W#ÂßœìõB%Ä°{> d
hïŸ8õ&ÄÒš:"ÓH‘´ö‘8Kò@+¬‡–fìD•|¤Ù	Ž¹+¨2ÒÎ‡­xýGOµêéPàÀŽÂ`ß³iÚ˜ã¿Ê<›F»°> ßùË S!÷&¬%¬u}@¨Ô=3„q˜Ú Ú ~»Ì‹Ô6:ÞÊØ²nªB‹£5îMf[Sº:Á[Ê®Ÿ6_!p¦uë:Í3ö‰E O'e TÎÈ¿ï~·ULä£ýE‰ë–Ñ•m‹ðøìèÒ¹½LEÂw†¶Ìé}žïâ{;jCë#¥J~‚øXXˆµ°s›òÌ´¦øãŽ%ïžŠW²UìŠ‰mÒ½ôÕœjºuœA„÷2'*ž#j[òZ‘Xµ3’÷	”¬¸ëIØ+ð¾¾QP£íÙ`qà¡qQ6¸+kfXEf<‹w=#à‰è¸åÐX6äÂ•“§î,ßÇ}HËN÷c/Îç‚m¢ã:Z·ä6á²æM¸ü4(öä%?åT ÍgAxäsK	Gè«û#RY3Øá±œù¹Ø+…™€Ã¹Öukj^ Ðú˜M~’bµªæ…Ý+JÁ F¨@›¢^@¶¨ËaÆ_[ò³úf/1dÏÑ*o¨‚zÂr'€-¡cyZÈÛ-™î„«¼éÉÐ¾Çz+…ßÃ½Ü4ñ?]‹ÃÙi3Ñ>¢®†ôFæÎ“MÅ`@£rèô>7±Ã!víó/ìÿâˆË†á8\­G0hzÝš<66ÕnóëþHìŽÐRîO9b¯XInKm¦X#Ñ’€½f&ë·†Å«ñ6Óy“‹†t›4‡eg\kq¼+Ÿe#XØhgK†9?dŠÙm¬±Q”!ÁØÃëc»¥563@KžýA™À;¼ùD¿a9ílñui¥r^Ø9>£æD69Ç\&&žbøxCÞóShUB(¡ãÒ}÷¢‚hT¬‘U›Á‚QŠór‘Ÿ Í'¸×ã u,i?YŒçr>–çü¢Ãp> ­ò1v†Qý÷ÝCçêñ$ÉýõIëï­‹yÓhµ@Y uù,à=>‚»#ëEí"ó“ÀÎÐ·É¡P+Ñ	Óa)ø(Žœ¬ÑÊõž¬vŽ›ØLBÍ)?‹Š©Ç²ÙhDYºßâ®™&z$MÀ¦p9VŠ©OWï¥oTÏ¦”Û0}pOtëô¸ëˆÈ[r7ÿaþ"¯´ý·ZòbªÔéóNñâîmÜ³:v	ãÓÌ¾Ow€žõ+Ö£ƒ´M±øé8Ü°¶ƒÄ¢yDFƒÍ\OÄbMOß0ËàS.9~ž3½#ÓÃ·õôˆ¢íyŸ
Û–„¶_\Öì6Î 5ƒäÎïçZ‹IŒ±â¢ÌF0„=\ÈrºÒRÐ¾¤jäüCìcd›cèDfŸ/‘2Wå•OJ›ÜvàÃÒ†²—5Àø–ÑAµ­m8¦^°woÇIž-‰lÔ"?.€ÒÌê“0òŒnrà[èÁÔ˜©8ûÚAÊÒ@¡ÍlÑt»õ39Ù]UÄ+ôÂ¾ÓiÛîÆÓ)z6oWæô’¬r(Rj%®âó%{ðCz> 5œnýÙÍØ‹jŒùÔ#SÛ€«vså9
º‡ Ð/w’
ÛñõŒžnÍ_áŽD=öCÇŠF:q*¤Û*¸ñxK†G£Tv‘¦:k´¶nÛo³3·»Mh1o¤z,>bq¤üb¹[^—ÖðRñ†v…èså¡ÄA4UY“I¤ )
Nå/gò'U7„`¼âãmË^–kþ¨æÕk×­Ì–ÂÏo®†­ 1¤ÌÓôçrºä3W£@è°ÊÃ|Â<âð*ÖÆs*Ê=¦50ç±wÏÉ£¡Mç7Þ}>ÐŠììchÅˆAÏ¤,þ­°Þ&˜½ ¯	Ýï-4|àûYÓÒwåâW¨`Ó=˜ÿáH}náa»dÊòëE®àkè‚ƒ…	Ï€P7÷@ùÜÊŸœ›˜ê³Mšñ+ùw¥·g|D!–Ð„õÎëäícHþXý·Ø>•þgÌ–ð‰]¯üH|A©%ª
11ƒ‚n§Åžð|–?Î Û%&	Æ)ÛEžYûÕ>¯/3ÔCi>Õ©dQ6®‚õÖ_;å§iZr9anà|rTþÿýåì+JŸ‰Ëë†”`9Zx¯ß·´ÏoŠþÅ‰3ø<ÃRÉÅG‰wN¿BÖGD
É?›ì¦Äº¾ÂÁÎá7Õ×±pÆe1Ê.AË|5*±r¥€U'¨mS!-ÚÚ#¡å]×õm~‰ÿe#Mÿ^•F±nÃ‰TÎ`Ù&YB—Cý)¾ãÇd¼FÚ2Sh¸Üp”–4ú°[ü‹£´©%&R«{<U‹eîŠõg¹Ú’m’ƒköu5\àŽâXø,ÎbxÖ§š-÷G~ÛyÅÊ)p‡›Š2´¨5øM9wžö»ÚÈl{/š‹í”— E2n'Gnô¸» Œ¨£>ÿäð¥S<C&½¼M-–5MÁŒö¸Ó1ÂÄ½Â†”éÁì3)¼d²˜4”XÝdëz$aa«çç³‡>T 454©<Jˆ-î‰¼ï©€lèÝÕ2dg˜‹Á9%ÓHÒŠäÆ£}Q³ t‹H€0ºÈ¹±zé¯ˆ Ð	Ö£ T.Ž=j$í92ÒºîñÓ…ŠßÒ5b!´‚2NF_ Gé‰E;Öþ÷'aˆ“}ÔµÌ¹¾½±?*¯¢½°ÆïäŠŸ4ˆ@Eø8*ÁVÒï.ˆ{»Ùöš“C£”ì>‡ÄÖBÝfý\à¾c³CH}yËXA6‰WŒ¡ã_ÎÄ~óµ%½†¢ö€¬j,Úß2ŸxÌl%2Ö%ŸsñÕ¬ÜØ¶Àât´  oÑáµ[ˆ5ã©ªXY÷o!AJNrÌ„gãwÜ÷Í™ç«ŒìÏxv%)\YY1Ïÿ	)mÄIžniØéwÎh‘£Æ#Ý(©çýÍ÷¹Ãa´3zà ¸Nã`Hê¥Mm²>#A)7îNfWP7tëÖe‹1 ›×?“½ÜZsE{|òÝ?o&^9DØ4¶˜ùÚ6““ÌŠ¿:ã×m`6@_eÙ´¨Ã;5®ÚšÀw4ÚpnËá$µ¿Pf·|]í,ù ØE¬V”XüÖÝÑ'¡ëýfÔËz•þM¢ÅÌ]7¤šîMÒï‹ÊcÁ¬v¾$òþŠñÏyæ)D¢'<Ð5.xÅ²ö$n„?÷¼ìiÄá'¨"úå±Åt²“UÕéOö¿–A	€þ´Šk±¦]Ü³!i‡³ /¾N$©bü‡Ÿ¿D÷¡­ÃúÓ­E¥0Fé@í‡Aµ¡$&çïÒ]\Æàn¢ŸÊTø|Œv{Ô´u!‹¼øþF\q(oœ\4ÃÇž(./ˆ€xRÈ{?0Ô8é@ÍäkþàŸnÍë0xŽÏr”î6©ìÌœ'YGY¾rI”d* 01ÿ¨w©‡Ø®ÕýµÃ•5P<ÙùPc¤ÈÝ
i§ŽXˆåêk2BVÚïIèÙÚÑVô×ÁMöH¦í}€Ÿz¹Ðf:¶[£)UÆ6fÛ[ûê
¾3gå`°ðåÌ½îbßê³(ÚÖÛ”ø`\9/£ÖÛÂîÞ¼Þo/°r¢65ÑéL|Y×\8&©lúN*¬þ,¨/Š¸éc¯iæ$Q…+„›ÆmTÌëfjú5¬*86È˜]šÖÉ9¢/ÙC<wZ[(‹^‰,m=a…ø–Ÿt/ÕÚ#ÕPQgag´¯¿s }~èí¤4t¶¬0{ÅÜÊÝs—éIQÂe"`LºO¦Æ×Z¾¹{µsõ‹˜Bñ”ÇkU.+«¼”Ð°».L{Þ'¹×öoÊ|â`qL¶ò—Æ×D³.WnÂòh® ¹Ó%ˆšçÚ`Tê«ºØBµÅº…QcRo\9r»/µÞVƒÚ°î'çþa)Ê×¢%½ê©>ŠŸ™úßDÎ™’nN_ÕñÒëk2S³Rîä|¯—¢EúY.(ÀÇ<ßù&sè]_:Þ~|6Á¤iÈ-É|å%û12lÜ–þe–G;ô†˜)# »™¹@²‘'ÄlW¸†#Q}²»TCk¿¹ËUY²%Få—sAï€á“§tWŒ$Ò6”¨,d‚.Eèª<úR‘l67våÌ²A3'=i“1e)Ì¨9K¾å’‹ÂÜÛ$6Û®0òª_JÚ7Rºk)Æ®=Lø'†â"ÆÝ(}Hu§Nªëok[]ÿIG6¾,AôPäàv]Õ_	ÔbâˆÛŠèè–e,Œã†NÇ·Ö#O± b]/èè Ã=bÞ%»Ç‚¾¯¬Å†GÆ,SàõNÙJÖ?UŒGL‰ìú€Ç¡JGü¾¬€× IQvÞü™7´æ[þá\CIý¯,®n¤e0nr$t:&‰‰b™{Š¥ßÝMøHYhÕ‚Oa4Ï\Ä„Œ}­F7”ž9‰.pâû{CÝ%ò#«%^£}¯MÄô¼¿ÎZä<8,š6Ó`Þ=–q!­¦gúpò(ƒ{âU<,Ûf6Ð2|ó 	ñ¢¼`‹ü€¼.›éaË¬\¤ÏøÄ&]Œíuˆ»ê£ÑýÞøÐ¾Ùt‡)ánÂ<+ÀÆËu™üÃç4bXÇSÍÊðé}-‹²œà®ŽÚÿï¦ï)÷§ê[Ó¥1L6•s6¯££]qCMÅ*Ò0L/Éb±à™0Få<êÞÅ"R‡z—àÙ9ç¸Á	’VÚÎ³ÐW©ÛL`Nfª½E—­ËDÞÀB&)33\=’“¨wþd™‰Ã¾h§¡FT¼i_
U8X6,3‚Ég6Ç©%l#)G"*µšl‚¾Q·>ú…»Ã!ü4 ÙKxþã È6ÑÍˆY38øP1«±k 7'mƒ¯4àšGq³~i `•Žf²²áP©ðW6(LÀÛ¨Ã.îcfh·K•ájæê…;ÏŒ­7’qR»º ½ÅL¢lš­ŽŽþsû­‡}/6e#%º‡²Ó+[bJü¦3'ð©#OÕiŽ#Øü¾ß}¢/¸^Vd'!uÈßû:tÌºPP­ÿVþ_!0:t“‘±É*t?%SKêLô½yò5êyÌF C-ãs²¸š`f7ØïÌs³V³Ž¡qóU?¡š¯›—3€C y[xéÁÞ‚§¤¯‡-`ÛYU›Ae¬â‚¡7® Ï­¹,,Üï7­§¤Çø˜Å?ÜçôõÏ3¯cK5ìÄ\u&fÖ¡"¿Æe‚ûr®3v:ñTÌ*\oÛû:HÊáªçD–šÊ–×e„™)ØÌ"0ÈPD{ª¸6‘«U™|ýÄË½9¥¹Ù2“ÿZP¹dV“"ÝÍm]“mÆ€¡Þ¹‘ñæé(º ÚÃ*ÈÅõð`­Aº¼®›&’ ÆÜ}{Ëšy¿·-aÄs]›4®×$»\&C” ðU9MZ›ãÉ‘–Å³ÎU'Ä+
ˆ TƒíŸÜ·×ðÿÓhø®•}—Bà‘>ô¾÷.X>ÜrÂþòµF“GKíYà<oÀDøž1TÀö	˜xªM‚‰ð€Î¤• Š&MËíT½ÕgvÓ ª²vüÞ¯Ò@Š'àJ˜º0ÿÿA8ÆZ{‰&xÛ5sæZfº³Kh°¦˜Âf<Ÿ¿JÉ5©ùá¤ÆÊ;¸qXŸ¬×<ƒí•ÁÅÊWsùM÷Ä$9;}Þ¤«1s^¥¥î€» i-Bæ|[¦’Ð/WeÛÞíÏ–l)„±-0…Smñ¶`*ŽD#‹y†Çm|wP9Uˆ6£ÉœËD€)…EÔäáq÷ÌJøÀ.h8GFªÒëÊµýÒº‡ªv;NhÍV– ÓQlÈD§½—_úÞ±µ§Í¢.­|a\Õ`	¶ˆÎÂèYí©Þ¿\Ó\ô“Ÿ~ç(kA-°Ú%ž§.È-è\š9r3¡*Ë_÷ì<ž}9¢cñØÞOD¼ŽÉä{êSð/ã„1)®\Â#†aœ^îa?gN†Ð_aÏØž¹×G|YXƒ1kÐMÐ)C ÞpÒ‹D(3JsD-Š{ gy2rl-
­þYæj‹'U€C	Ç8TÃj¡ý@¼Ü‘®é•[‹/Ü«¢€kÆ}çñ._ˆpâÈra^"ö*õï/ÓÁS3|fN°øü~¡ÏOÍUŽBê’áNŸhœ“ ªN„¯ß%â)&?ÓQS¢žÎcú/õy¾Ò¹må)Db!MÆA
‡òFÅð¨$k;%·"bû]Lé?²nôõÓ*=!Éº|ú‰|áJ÷r˜f±–NEžAŠ2¨cŸý.ùè¼g"PoÄþ²LûñR’·M­äé¿:vˆ­/lØ`™EC¨2Bóö+´ÍçÜi`ÜhÉS³Ÿ­´%Üf¶¥t¢Â”Î°ç#Ý£ ±Q‚æ¦m×± ‚»´|’Z¶5c„kNäØ„LMq.ÿ†sbÂmºû‰íä!&.þ­v ÁÃ+’NÎ‘½lhbQC×rYq„?m‘v=,ï»Ù-U„Øz%Qp‹0|ŠâoyP;ú% aPŽ1ØÅæì™Vsæ9Óî”<,?6ð)µŠ‡†7÷•Þ½hgó›Þ÷¸Ù!³PØöðÏFÝå.U¯©ˆÿ(±ÆaA”Íbè4–œöÁS'¶n{g¿ô<ÍÉx/4$V„6´=»–¬ßì˜Ò‘¶êncÎ,É¼¡ÞÞâž:º×}Ä¿»²ájt£Â¤‡ÿ5‰ŠøãH3ÉÛ¾{ëòáˆËYŸ
œ-J,Ôíb·cÜˆ8I F@%¦33”KÂX<‹D|ÐŒE™Öí9{¨×3G(z	Õä^ŸZ€÷÷~;Ò²jÊðÕvƒVV/ƒ Aéo nèè9'Q0auð½C’HojñYO­´÷¼Ž]ôÆë;#ê¦Ì:Ûø,Ä³?¾Ô]©âbr`ÉÌÁ·´žÿ¹ÍÍÚ5z/g¦r
LSwß±²´ÉWh—Åˆ‚*$x‘Øá#ÀŒÚÑõÞ
'>“…X9ˆ 5E»µYûÒ:>káñ,Qf°ÜÑø›jY_ª	=pbG‚6Å·ùÞ5Š%j¢©²p¯ä›ÛFå’°ç'‚Q¥	õT•e>§uí|B¨™eÿü•½h×ßžõs÷‡½0Íó ¶e;Ô
Cg9´eç_žÍ¡–­&’WËêçÈ+3°yð‘#·ÃôWN§es)þ>ò¢-s­µççÀta•:ƒòë§õ#Äü]Ô+Þ-Òõ 6W«NS)9ïWtÓ{(lƒ¦‚…ä¹!Šíð.r´ÒHD]Ûh7¼7—-‚³ƒÇ95W÷ÿŒ æ,ê»ÀhUƒÇ`
ÇH·ØÑ5äÄ“ÈF(d½›”RþÕLn”a1‘®” Uƒ7Y˜ƒ[€ö1¥*B\kþÕšÎžn…æ{±ëÇ:RBÎíáÂY'¿ƒ÷¶ÉÕÎO”¢óÏ¾äMD~©4„³ïY49 šŠj½ŠŸ©S½§âÅb]™›ƒˆ
R@ñ§j;L*£7éHpÁ¢É· 4lM.jfGîocRpÓàôÐÓÙÛ0¬êy¨ $Z2a†.p¦°—@”Ãä~²ž©Ô­;Saý;&NÛÎbéÌaÌ›6!Íæ¡Ñgl¨åªƒp†ã…»×]ô†`´ib£òPaL9]MãI9<yá-’úNAÁÃð¾h†—Ýš°Oí³‰;˜ßKŒ9ýU÷7J¼è''ÿE¹780:‰¿;S¤”ÜèÛ!c­¬0ƒÔ@iŸŽÀÛ1*Ü>±÷9ƒ‰Ó_Â©þ1 áML‰ÈcÓ»¹ëÍ’5í ú1¿ƒgÌ=·å}Å¢’Qº§ûÑ6RdQÈû#ò{L4@jtB(ŒyÛè:âÒoéC¶4ß“A¦ßš_ú†V;¸Îû/??B§S”r7×žÜ-5¡6ç`”ñ.0ýÝÌ9„;Ë¡<½úŸ¯(Hj}ÿÅÈqi–É”š=QjîD#6²ðJzæÜ§©ÒœNt•õöúõíá	–Ñò
@è‡/9{ÕOé†RÞõ¢F±ýLPáèèuWÛ+‰²zE™ïC¸)æ}píDõ|—Q •¤¬ ÊîŠÃ­ÖÌÓXëWzŽj(§Õ þ(ï´;®æä•wwÏŒ¡ýÚ.KÝ¸»K†x¬otU5î‘H·9­Nf7Í›ÄˆžÁ¿®‰I‹ìžzÌ8ô™”EÌU ªÏßL ùKŽ=¤ÉüObt¤â­	wTª@„_Š•»ÒcT^5“éM«çeÖ¢ÃgÍ„ÍüÕ”S3¡%¶{gµè”˜8œ·ˆó•/º¶ú‘‹wSñû¿Ôj–é¾â.×Ô™µ90IO’žQñë ¡/^0‘4U{+ Jö ¾Àðy‘€¬Ýu iŒÕµ|Öëû›¾ÙHü)v™´fÈàqDý£wÅ”?"\Ü@Š¡ãAF¯YVt7”é=lhh¯@4ìq!2(9žE®RÊì×Kíi9¢Æ§c•­cäø……ç€)Õ’<^5(?èk".[v,€FÈ¬ÃO«´§ÿˆ…júdŽ›VÆ!]3,8ýýcH:–8.³§tIý? åp¹¶Æ0¸eÂVB“T•Æ\mï	ãú)%2|à$Yà"§@)Q»Îv|â=\ŒTg<Xw¹OXý–÷ÔfÆ‰BaàåVZ®jÉ²Œr]nÑÚ®µ±Ï£ Im?f‡[­ÝTòÎA†)ªé¿ƒºzB7Yl§×§Ó\2©×¢£GÕfßhà°–¬Ûwly
êBß)J´ l¥æ@pjí¦|¯ƒTVîSnÚe‘Y_	NÒ5E³Âl]²n}|}
å¤bL°eÆhFk»ä£ò7SH\jâ?ëiMÑõô¸Áð™<È°yü °îôÒp»ÊôGuÖ@ûÄêÎÎ…Kµ€ð.CÀ|Oƒ³í´Dvf!ðƒ-Ë_½\~èª‹˜ej
u(£]Eñöfó’Çp¡äü&CëßsÞv!N†tCÞ}é úèiÌê×–ŽØð#ØËØ0/k£ŒgYGË÷$r}¹^v³ÿa+-z!`Øq+<NDT½ð(zuÚ]tUªÖ0°ì"=Š§i8ã;Æ/‹¨••*@|˜6£{ i ép•$
 osN=5$`û;¯ž±/ŸØNÊ«`Ug|ÃÇízQ-Áš*ˆîúk²-)šžDœœô³dº• Ãm^Î=J¢b¡-•ŽÔgQUŽš°yŸ\Ðüí.`ATç²˜º‰‚òÁ³N2Ëh€ìÎúÀßdÑkbs-"¶aûœäfúPÈÃ7}?€n-­ÊcUMòäÍîºT×HôÁgˆmRDîÜŒtÝ@Jº'Ï âaÍŠº}XqÐ“'K1ßNàÔ™TØÍƒ—²qêX¨=Iz&ü§’6'§† ½g¨Ýú¤u×"{l
¹B¶¶¯Ø`×eÆa’0”ëh¡£ätPeð$ÏL©!#+¥v
ŠG¥Ê&}V£¾¯áþ¯²p#µÉl¶¡ò–÷{ÅŒØºQM¨ÃçÃÔ–Ð
×ë.ë|[{ñ¡Ø÷¯Ë3¢vD
mÌ{¬ô	Ãx«B°^1±‡¥Sóˆ/ˆø©ôkwmŸx!Ò‘Y9Q%­òñ_?`ÁÁ,ê\¤î&)5?
†QÃYØj‘1ê98Œ”S?ùºNçT­X©øBûfø^#d³A)«¸G²AqÇà[ìÅ/TáÉß#G.ŒOC–k»áåP_«mIIÑFƒq€˜:]G¾ÿŒâžjñ•R¼‚³4@³ä[Âÿ‰RµA“ŒDÏíMGÀ‘ÛKï¸&ž?_Íx`ˆž¹†M§"¼ƒŠ,²¦Q‰+Þ½&/‰´'~ÁjBØ£Ù•pÞîgƒ¿“…fj!s R¯0jÌ@›wÙm‡²köÕòÚè	­¡}¿ÓÅH#Š„®à‰)8Œ@FÌevÛ­ýäÊ¥‰:ÝÓ ¾˜ËoP '–ièýã³)5J’§Uˆ×0³,|F³]fÔ©åƒ ÕOâÊsJû«ß(™÷»Ã1™CÜw_§Ec‚¾_‚b¥JÂ>%ØëkYI+ÉÇÓb-8"#Þ›?A•bMM’ì«•æKS¶®×aHé	©#1xÎîP¼¡Ï"I\6ø{Ô•á~ñ_ð3æœóèvò"ñë3b,¬{È%J˜†Ý„Û¾®V.

ªáÛ—¨Û7BOnâ°1ü}V·uò€éd¥aÖ‡Êbõ¯	@v.ÅÓ³ü|_äù`ò5„‹­'„å4“«üÉÏŽmÈ®œ¤jîUÿ	Å0ÚJ«¢+ÝnÆý`y‘}Õ& í ð.±ÕGÕ¸OÙ¸’=p%:=šU2¡ÛÙ›ùL÷HûÆD°³û`Â§„öeÔ`†?w"s5ëu
ÚQ*Ä@4öN„_ÀÉ>vJý36n³µðíÙûdï^gæløHí;BÙîn1õÝÜïÀ ÔQ%ÏoPâ´o-½ÌQã‹ ÎRzwùMV/c’iË3±†¯žÍ¥ûç°FYQ#á[2ŸÉZÁû';ÒK½®„2¸d„ö®Eiü\k’±¨zÚ9Ÿ^ÖHªYji°†jŒ…Ý™†ö WY•uüW„ÈWM$âæ­³­ƒ©Tžõà‡_è>ÐvO,DDÄ yÒj[ƒ(}°;nÓ5‘–¨ÂF@7&ëÁhƒþøQ›‰=/®©×%æÙÃ]þðÅß\A®]Š+ŒWš÷¦1¶g\–‰¦Ñë $­·ÄDLÔ:’P©Îp6N@Æƒ  ö-Í\!!•ï‰œ#ÅF¦ŒÆÎ»•áÆÈÉ˜Ñð¨	2Ùï,îÛñßËõu'•ÉòèneÑ­TzèÂLÞ¿†z:Öä³#¿èP´Çl+:@`Â§cÐ§¼ØÓa]ðŸž¾BÕpg¨74©^µ8£Ò4wïzf2Â–÷„%¥ßž`ž–tD¬"×N6&"Ö™‘ îOÆ;¡×h4ËM^€ï«™ûxt+àè}o8JÝ´WÎ¬PgiÃ!PŸ“—N¯”ÙÖ)‘–¶UÔµ;<ãA»æz‹¿>¼².uŸû@Í"€Oá?c)±žy@ëà†ufjÜr•·<")‚WÎv¾ÛñjazÇò‘NÛfÖ­^‹ž­ËÀ“Ï¯+MšF¦N¥‚e! iå\ó"ûIË¤“·¹9„ÆÏÉ
¿{V1ÜnÐÍâ½ÈõªëHŽœ¿àë[É;ØVD Ÿ‚] y¦Ìâ-÷]uþ&/¶­;ð$NÔ:äý$]Kºñ@Ï •ð_³å¾ÛœUûý†
:ý¿¥DÃ½dwž!à±¯n½ÃUlµò„ƒ$ÏR=ô+´rtŽ9ŒckßöÅe£ŒÐÕUXðÝÜq	LbÒñ‘ê&––Àµg¨NPrÿµ‰ºîJ.¨•~!¡ùÿx=®fM{NŠðÌî®pjýÒÈª¹+\Âx½¢±Rõì+nj4slõñÃ‹…Õ.R“”#Û09w×‚Æ„º€[“øslÙÿš”Íç-´Þ‰!j¶ãtvé²×±6šgIß9ÇcS˜MŽR
¤·!9í ÜpÂ“ˆb1„j´|²~&Ø€^$À—ô$1´·´á§fÓœ—ÝP6&«WàUnI¤/ø¿x30zî4MA’œçm=b¨²i¥,Ãµ=¼½+!s«¬EÙ´€hKÁ8L™š®Šób…ck_Q¹óÕ¹"¾«‹Ûòi[ûY’ëÀ¸bÖî»Œ²"a‹ÛŸÒéj‰“VY­øBå<
Ï8t´–îWp½Î¥ÙWÕ@™IPW¶ßýÙIsÚòZ½lÙ¿ø,·³$ÍøM]…¬4d"ÐÉ¢ëâÚºÛNJ21jƒ~²°ŸFÛ.”AÎ\a ð`D“HÍƒUÎhT‡à×÷3Âƒéåäu™Ìâ±&øÃV4eêcFHfÔ÷ ûF,ÒÄcùáj¨?},|qÏ Còª6úò¡ô¥h¬Cd¸À_å®»Œ‹RQûŒ
ó$¸ˆ;opçk-Èw`xÐÃT,ž[u@%‘”2¾fpÊ·¶_xõÛeÚ…¹È7!á²Å|véˆú?frôv=ºÒ¢XélÚ»ž&Ð\5mÐ‘xö‡³Uiøù«më%ìÀ’mƒÞZáŽ]˜é(Öv¦Ýê¥7*„—p
 ¯¼Éâäp¿?JzMe‚,^›aÖ°‰“€ð€\½ê¡üQ”ÎK-î»]pÀh_iì]DK{Z…AVÚM!¶næ«µ:C7?×åT¹éóS7åîò5#eþç_MÅ¸ŠY‚FPp6®abóÍCÝ`õ Yrœ)Œ½Æ½Iè?úèù×M‹‚AZ† #¸£å`œÆ¡”Ë~¹ÍJG†Âç„
nmÆxaÒÇ‡Ò¬Í[Qq€Ò
ÿ={"¤KcS¬ãžÉõG8fR½šÀ:¯ÞDÓåS§w“{H—†f8‚ÖŽ|;ŠÚ¾èõæá¹Zý‡|è7Z–Â\×KÖDl)é¸õFH£}ø¡hÞƒ²ÛÊÃ”ö ?è	ÜBƒ]b–Ï¡èºUx/÷´)ókÄ¨WY‘ñH<²ÎOê+í¿8(¼®È{Íh>õëÈ"g0¹;¹@µs_jÎKoXµM‡å‚Ïx”Àe*]¨ Ô¢õbE÷°»P‘æq;(JŠŸa²“:ësIË€Äî—8“ó’ºHnðxüJA~òråµ,È~Lu(U€æ¦Öõž‚JdaV![dS—¢÷© ‚øÕêp¯’DêõDifR@0àWŽ•:§[”-h³u]fŽ,-Á€®ˆ”ÑAJ›àøS&öl2zþñ¡•aFWxôòÃ„“­á)È6‡‘¼G¾¢¾H¹>½Þ„Ò *[QB0×Aj~ç%§½é7TR¹‹ò>L’ú‡ˆe4c6Þ)U\$ô³?’è0¬Þ‰ÎbK<LCÙºÓÝò@®Ò¯1’Ä
äW}]_üÍŸó2P‘)aôÓ¶9a‰ª?—Þ˜3šyÂ;ƒZŽÝ½ñrœA÷ØÂuqÂZ~`kÍÖ6~Œè1órãÃf—lùïÍJCbiÖñþÃ1úðÄÏOeÒè&ä’µdïŸ¦Q‡šµ(êæÇ:Þüg.>6€iŒ
ï¾d0Gßo ¢FÚù&†¦	ˆquî‰ãûÎO¡º	,Êq_ü‡ð›ï39B²C8“‚½C„±¾…va>%ŽÌ†¢Ö¤~F$»/i’¾€×íN–Á~Q“…¤,éõ‰Õ±SÉþkpJk®ý8özñŠ L ·ÿ¼¿û9žwû3š²;[°§Y}½®H±Ú>‚'õËB’ãB©†ŸNn_L/–ôg@j23bS}¢¨¡n_á«‹)ÿFº€õoÄ™i:Ò[¾|#àÎFdxÓ±ªWeõùÇ»üpýªü<á6¬{½*¨§Â^_Þgéc–%ÑæÁˆÞ‘‹
ã^•¯JË‚ÈN’äøJò˜ÛÂR<®D“à`wò–p…LÝ[e‹ÈÅºŠf¥Ýôj¡ÔþPoWUßÃ|]ƒËô×©jWRcp<±û‡¿ÿ”:\ˆ $„dK LH·Û/v0/Î¯ô˜ˆÛÒ€{‘Û±yÎøKx’¶ÍO·wìöe÷Ä1´›âW@.Î§Å&[R§éÖVhzþH(áÊÙªÓj\Hn;­yõI2c'žÌ6)F?rùcûG­\(îŽÎÌ='´	¬þÉÐDEI'¦ôYHË2gq½[÷j_x<èðíq‚S‘±¾C’‰_eÒÑpf,¹6ªýÖå/‚Á÷í9	ÊVÜàÆÀlýtŸZØÝ…ÏàPá¼œWñ>¡"ià±~Œ6ùË/J¼f2Âë GMÌ}¯iyç±ÙçŠctùUk²ƒñE‚ªGŽÉ‚ž(ÇOSÉô¤P\y±ôrY}ä2´[tŠã˜o?ã0ÁÀµ™Êää6±-ÖÞL@Õ4þ:ƒ.oÏ¯q4OÐÔÇ¹¡Û)Ñf•Ø{Ê°²Õ«ô%.³ãÙ—Ú„%•Š„/[š¤àþô®Æ•ŸÉã¤k˜ŸšÖÅ"Ð]&”;)]õäø=õ<ñ¨ŠÇ®Ò$Ð­\¨P[ÁJž#¹ûPá-‚Â5utÁ\txWÿCfPùaäJ<²Ã´ÍöJC&7°MbþžåbÆâ[ÄšÏÐ°‹ZÙ5;ºyi`œú«vr:Ü:g<á`|–1BÆfÃzyýøæ{ Hpñ8cñ¨¤8Á,Öò*Òª3{LêŒœR${ïÚ0¤ÃìŠýÜ*ÆOãíOo¨ÖPêï±Ù‹Oþ…
@g»çm4ÐÚ¡¦KÞÉÇøB-?³ÆÈÜSm3™á±b«äirŸÛœTq­Î±ë·T%;9#¢¹ãžø@9üôËÈá
¹o‰6¹éò—5ˆÐx ­l	 ÁÃÒ×î€]q²ÉíÂ†ÃÂ©DA% 9ÍàÔ“^{Ë/]HhÕûHr ¨Ç­Ü¯/¤*È ü¸½ÐêÕXÐJ0Y…R¸Ø¬êÒr%º{
&é_òµ²³Hd‡ø”ŽüÄh^%=Ùe/•¶ƒÉ£×˜F¾ôY);	Q‹Î6mS»£K‹°p³1.OÐ+ñýò÷ôëIã^3žÕ)4Û­ß¥ïÛRæûj2 ¹3=éUŽ-› ­v?ˆ„&U»XHs¶š}°Š+ë3Û¡:g`ºó%ª½!ÎÒQÛByoTE–Ì´óYÛ¥,¬è\rY«?!ÈÚ`AJ@N8t)ÈÂ9Šò¸L<têc3Vc‰ÕÑˆ”kÏ×W4ž¸®©õmÅÜNçWå±ûˆÐt;dv­+eVãx©o|Ù´tuCè?ðYãÔNìrr¦œÈ«%Kš`Ýä°P°¯hIµ;&5DÌ‹ƒçþ¡*Ï¨,eoÀš`ŽjCÍ<>Žà\¶½T>¹ÈûåEXØ7&G:1ÄŒ#«w}çãZ~•êøo%l™”
$&Ð†Ü®v¸´RÀciÂëv…tKŠéD«.ó¼2"§/`i›=ÚXË~ó	dÙ·ƒux„óÖm’'7_ËQÈªøT'˜b}`6jHu‹æF„1±°Ç,ä­ãRLû3çü }=á¿¾³"ðû¿ îZ+› ˆŽÈÏßîóÿ*ÎJ'}¦,¾9^¦2yIrPK:åUá°µg<wM ûšŸ”ºS#š"äi__L]ÍTÖ_F9_{Ho-_¢Àö?i cI©²~.i!Îí
ë4›é7€XáUö"—{ðü»Ë:—x âQ<wÚD€2‰s’Ì÷ÃnåtÛ{Aû‘(Q&‡S¹MúÍÿàÏ$ Ó»UáwDmíÌ$ù$
K°ÔÞ3gxó)Õ™=gïõ…Â„“°žÜ÷­D^sñK¹æã‘Órzí|dÓè”¼³²¦|ìL«^›E–5ÙÊtÁ5e'ôÑÎpåŒd?²W§?0)Hã)4õ$¤è&Ò¶;‘UÞÛf¬±·ÉDä-ß¢€®ÃBMÓ\æÐØlÕuRÉÅzÛÇ¹qÎ`ï?­ð“uÄ£Eu AVî"Ÿ@w2€rù~—õ!í2š]#02|F<…l”OOhR‰ÁH?ª`#T Æ­%¿ž~iòÝì “…§š ‹F“‡FcZo¦å(8ö!ÈšØ8ÛÌŸm›Ë#§éË’1\8ÐkvÕËŒ¿ëõ‡êëã°j¿:pÖ¸9k6EN3À¦¾–a‹#­&ýuRW¬*BéSð0ãóåëŸAÖX¥›Rš’ûo³®ŽcÃ‹tËê!–¯ÓÂ¡ Í_øã¾V˜m¾È£ÚñZ uhÝ_Zb~8»:4¯‹y~wŒ‰=½ÇÐ›áÐâïÁã,iî¡£Àt¬ÕÏÃã™Níú	¼ ›ä°'H¦'Zí‘Í Ü¤(Àf£ «ÕË€°PB_zˆšdù·jÃÍ›$„Æè‹7Äè­W¸å7W×#‰f}…T¸kXUÜ6
…¶aRÎ½<ƒTb8ì±Ã&6ÔŽóK¡ü;Æ4žÇ54·«Á[HBn"üO3ÌµŸÄˆ0OÓ×K©¥ÏK)u¾½¯y^Dr+˜³YœQm-5í0ZY3I¸Œ#n<È
±9mþ¹Âí;ÆÒ©¥Õ}¶ø“–¦áð®íÉ±žæ-$Ì—tZ·¹v¶†5÷8 Æ[5.ÙZ'00ÅrnÈø¸õÇmŸ,ø4Ìw¸îoÓˆ 22m:óA¬!¦ù³>ºßXÈ8F¸¯%Œ›tAáë£–u^ Q0gÀ»õr,_ÿ+_-Nmán²Êe,ÃÎRk¹ ²:O;j7²høHç'eâ¾¹ðPÙfÔDXÓPÚk" HÊ>ÒiåÓÛöI“’ß’éýžNšÓ%HL2µ®‹Þ aSæ¿ bœúHbHM,í‹AÜ¸Ä¿qVïˆ¾$¸ž•R¹¹ƒß†û¥¹º!ÖæzÙ-R›ïâøvs°"…uõÜ…ùB|É™ßë]MÊ EâÐ\Â	<‚ ìWßî¦É`BuÚ‡©ùŽ>çÏ»3Z}žÌ”Ä“ Z	XýÇ¸iV¯üêÀc¾/Äbc¡€¥ï%ñ†x†ƒÔV¸_c9’—b_¤:Ìv¨‡v(êÕ®Þé"Òî²o¸`?ìdO_“lDñÕÚaš·Žî\¦*…¼qåS#®yùßñ¾ÂFG —Úþ¦jC.¿ñÝÊ¼ììêTý‰©·È–¨‡ê-ï¥fN\à=&iS=ˆô¾—.–Ò|)BàŸvhlÚÆ·5ñfß%3 cÝÜ\F÷,÷º»±|½×5”Rtýç§í q¥"f²èø_LZÊŸüù±óÖåÈ»ÅåèãZô¬h§<•IBþ€éUØ!A‡Û¡ï¬JÃ‹Oí|–šÞ¬I›ÌÿIàUñl{q&9}0ôf»\ö3i€‘˜¾yñÁyÏ°R&¦>µ3¾°¼þùŒÚÈÅÿ³€#§ô£i'^Þ‹lRâ_‚bêVí1© þèÂ#z•´‘OœÜi?dÛZ€9;ß¸“„·~\0
ºá˜ 8Ÿ
ZÛ}ÒÞÝîèiÙ`Àd¹¢{!öOýò;]¶# wþÔóãÎÕü’Ñ"-?@Ý'²Úˆä‘³ÍÄ|QN¤‘Ñz“(sHwhý¦š©ÍG‰ÛÔPMŽ×RÎŸy,%Nè2¨€1#)(äÒ?–}•¯®€æ²üè,"AÈ/ñSL¤äÊ«<Üdî “®„ÖñZ²Ç=â¨›ÚµÀ¯ªÿ)‚€Áò®Pï5P¢] ß‘épÉ»¦Ýí4‘ÍÔK‚M\¬Ö,>€Iõa¼ÙöøÑ] J·‰1V—Ä7â§Ž9åW
JöÐxk[UžïÞfUD/¢i'Ö‘~ÊL“œ”sOQdßV¬Ð˜AÈa-obõV­ãëO<<D°vsÄ”Ð­/Ëîv
}q}BÞ|¼ƒôkæ2€¤Ý‚r³šGÇíêÑ¹»0fOýe¡©–‰[È3KßÕ²D;.Ï^•.0klìÇÉ’ý	EzæI¶Â6þ'—W“·ÒðµAî#Ž¤Yl3›SqÐHÄ®m„ËyP–óî òk,Ü‘›s=ÿééóßWnüÅÈÐøUÓ¢>Xš™-Ä:M·ó]rN€«!}©käøÎãcß&K•Ù[ârÄÓ¡oy®%VªœºŸ<×+ê”Á®Þ_œüÓ«ÄÏ[kÐ—„Ób|X_þðI}ÛîÈñì'A6¦Â¡xŸ\…uü•]3¨›÷/ú(41Ž>—Üâƒ_@'}ÅmøèF‰Ø_ä.!‰Ã¯'©g~|Õs8äµè?9ðV;t{q-òâiH¼u™.L›¢ARW?Ü›íd+~Q5W¶Õ”5ÅÏa)}ð˜^cÞ~±!®«ÊŒÌ{ªÅIS,qQ¥ïIµVö'ŒÆ€­s‰3˜ÞÜr¯i_do‰º ¼å…ºa¥sl"¥Í=Ð3òØèfÚ\œÊ·Ìð@Y*•ÄéASz­©œ0&É>¯ßS¥³y[o£Ì;;ò¹×ðO‡.@¦v)ø%ç‘Ç½â)Št¬‚TÎ~ŸÌÍÔ+'­çjŸ±hbÀ±ÿ~bSSt^NaèV]ì|®AþR‚µ-í½sÙ½dÆ9ôõI÷~¹¸¦á‚	JÆéç;FšT‰Dµ3ì½R#!¡SWP*{dá}ö¼¨¥Ð­C¿‡1aÆ¢oð“U2.J ­z/½©¹ÑnbÍÃÕçþWÂÇi—Ö®ïiÃ@I7ù%Y
Òôš2ÄøqÇßŠñkhvÙ°µkéª!ÅæÛÈàÖÚqY£|óŒìüóËþÕ¼.?S¾òÛu'/ÍÐãx{ó
šj·”Rœ´hÒWO™Íò‡ÛkdWÇî÷@É¢üàvõ˜<ž­Œ•èXú´"†ÒOQS?cž{† $¤ÿA°ÏˆµÉGåX'!– ê5U™³%Žò,Ÿ…K¨1*=›yÌ‡8HEäÛ×Bõ†U±be”‰*lÑ¤çP´ ù’¦.<ŠW#+|þå^#é5ÝìÌªjÖ#¾Õtõ–îÿuZ€/#(oþ¼iÒuÖ;T<’  ,CÐ Ù—‰‚"ÄiC0_o£Ä~”ö¹øuãñºý´™Ì$>æjÑÓ«ˆ‘…­Fž^Š¿ÑÂ=S¹ó±*ŽD¼&±ø¯©»À9•raæ”É<C¯t{ø}_B”Î´©-ÚŽuIÿÉö-çš#ãŠ¤GJ‡r9`;Önzã§´_Ö¾
0pP¹í:Jî·úþÉ––w&Ýþ3é®614úäZ 88Í‹ß
©1%Xm·ÜãÑïmïVŽÏ‚ÿP
Cæ5³ù.èIÚùsf¢·çÙ:ÊulÆ±þžŠC-kQÜ3æ/),o5{üXsx<t
kA¦Z› URoÙnüAZæ&Ëd0±ŠP áqsè‘Nõ°ú“éÓ8ÄîúBÕã›{ÊDûÒØ5<ÅaÔ5Ÿò6+4l%]-Ú¥¾}ïÔf«þÎžB#bÿªµV^ÜÕ1Æä§]Y¬’ÎÖ¯®”*tN,6¼—›7÷p@3Ùì-i¡Ó³ñf0g±É·:g/•*jô>¨µÁâRæØòÔ\¨ãRO5iÛpûÐí¨¹ÁQÉKÕ›—`¡¡àèÖ¬$‰ù7L1ÕÒ›v»óøÍÛÅ0`· €—ØQ®ãß£±_²©À‹²Rl€¿ôî¤eüÉéòuP%$¯V¼r9Š²3Å€Çm/t¹É¯’.ý"'z@îi*Íßo6r;ú—óskzSiê×fB”ÿ UPs Ä:œ÷³2"àu~+Î¯à6,ND<‚K XÿÖ–+"$oƒ:$;ú~†9­Ü	ÕV¡¼™|=XnÊž&8óFæ6#Å§wÒjÇË©…	9Í6-½íà¶xi)Ò–½³¯EïÏ^FÐŠùl€¼7Ñ‹¨Œy–Ã­Ù¢6¢Ò{8zÞµÿÏ^‡ï'·QìÌTåª§HZ—£e¦*uÅ·"ü¹Aþl&²H%¦»8Ãm½±Ç] Êá„¨ïÏsì3H¼œ óªL|Sƒ…LXJJlüÁéÕëài0\~ÉÉOÜ“Ó¡µ“ ¤å–jT÷ka4dV7ÔÐœ!\éfaXúÙ†ZÙrðx…ê¹&Ì>œì”Ë½°ø%îW“lçÔ.BÀÓíÂ¦!¢“!³tšhVEônzú„8UîÁÏ\J†¡úþ-ÆÏÙ2J)CòM«€:­+äh÷#.u5œ6Ãáœ-Ð)Bªi /Å–Tf1Þ>3íÏ0
ˆH‘²õ k—°AdÊAq‡¡ý[ä¹íÁàßor)5€èÙž)jÅxA…ÍpE)_ßˆX—¤Ìè)0‚¨½¼‡¤ò¢+v{Ð1*]…hQÄêËÛËr¢ÖÇª	½)…À"µ8"‘‰!õ"Q4U¬Q;Zh—”íœfkÇ¸'0ÿ¿ªJ‰ÎÍÄü_]ÄzÙé‘¤°œŒ_JÒÑw‚D|óÛP"—	Wœš[¡¿6ÉžJÄ<Ë^/¶úm+©È×Ñnú»w¨§~èC™ê—ÃCÿÖx±á®;ëÒÑ*³Ùj¬PàJúÒîZ2â¶ŸíFkËëÎÁCŠ‡ÂØÉ;õ„‡ç)¹Xå™‡‘Ö‹”æ©ÜA—½i/
hûA’dá¥ø¶ø¨]û•unkã
¥úx–‹ã3½zöªÃÌÿÚÁ¶½|ÍƒŽ…ñœ¡Ù »>¹>ØÍXö™²–8Ú†sa*Åx»X`	‹ú¥¶Nªêä n/ÚdkÓ»È‚'µïrºt’š¾†ÇqÁ¡î&>1·ê5-9SªyÝX3`mFà@ud$`SvriàqFJÏq}+ƒÐ/àø@™†Õ‘à@öq@Y{|‹”JÙ4¨B|ÛoÏ	)¦ŸgNhªÜEs]ÙPT¡ãyæÛ¸iUù^n…€]mw*HGTía!˜´Š—ø:y¨â¸¿kÂ² ·N¦°¶&ÛuNƒÍ‘Ó¤°/«&ôšâvhŸÓ)Þï±ŒñVì•^\ˆØä$Mf7"*ÀK3+rþ!µyY,ÏõKŠKÕ3ùÂèGÎrñE{k7$J]V”áÞñ‰“ªT¼þ•ËB¬ bóòÅ
ÔÃ2.~\ÇásÆËÎ™CœÎ¥ñÓDùYv_ÔþrgIçÏe¿Õ¥%ùc{	x¼ßIG‘äâIÙ$)ã¬.Ú$¥»ö›¬¨L9­»„+btí¢& ÐLé~D]qña†=öÚÞ»‡¼ŠATþ³º&.k´›?Ì,˜KúHðƒLÌ‘â÷òÙá:ÁÍÏúQ7Êpâz½üù²âÕ{9Z‡p±÷ùa¿ØµS'´Ö¬2ÓÔŒ°Ÿ˜¸3å™[·mZýÝë¸t3€³02×ù­1wÌ,¶‚‡?®¬ZáA ¸DõŒõwI€úƒ+îþ#âøvÎ¤Ã“ŠVwÄÕäœÐÒ‡'¯‚é@ò—þÈü#zñÎ’a™u‡_šË‹ÙPœ*G—Ä`–90'›‹áÇè¤¾¹ýØÌ^òFÀ¹­q€›³–p…Èº”¨«¼À˜¦Zõ‡	bb"Ì~Ý›‰ÞÞZ3Pf€hß—™Y_†8w§›^s*ü©£ NTÁÂÿ”Ô»<‘uöiìxZÙ%Ï ôp’A›#:þiìzhwø±ÎÍ1aÀ¸.éìV×wØèÏ“~=œ£¡&ûÓ¿·Líœñ(•)’=é÷{1[Ê#yWýô‚„ççéˆŸ*Êý¿‘@x	ãÓ½ËÓì»©ø›Éq¼ßè!´ë¥T©B»˜7º^'tSË$Uf]´òÁùˆy#LÎ×‰´PÇÍÕ·â8‚G JÙØ‰_Ÿ,Ÿ™ÃZ).êÉý,ñ<¢sÎþ½cD€>.àÖ—Ê¿;¡Š=uâ<s²DçF6q½6•0ï}ž#lñënÊN¾¨€u#ðN}c
žº…ê’í‹*mFM½,Zš(änq\;{¡äf·XãnrZäÔ¶ö¤³eµ˜FÖ×c„U"®ÂŸ©žCÃ¦°rª…ƒˆò´ãRÙCV\šaÞÆ*€éI±•Öô@þ˜wÌÁK.7¯ùÅÖMíÍKÌªšø™ÍGŒ¸x üM¬¥
Ûª»#!¨±L+
ù”?eoŠ©{ð|—A‘¥ínäF/–½»Ûr3 çq-ñ m Ï¹	—­ªã¹ò,y°5"Ø&ÎŠŽÇÛýþhž”8ŠYS:Á¶(yôKOaÍ·-n6[Êe;>–óŒ™åÃ4TÇÐ*ÍDºZÀíøGI’h6o|Ò7s¬«2Ybzž’=o!@ÅÃ)(ex‘Fîï VùõoV2ÂªÚéndÙzŸÕ Hv§ÃÄÆi¶^Ï²›°MO)Àè7uôŒ¬õtFæ£iüœTú"#!Hâ³”çÅ»ßùVºŠð^.
	±¶B¯8$ÈÄtÂ /Ø×•¸L³ú™Ìbln²Õ±•Ž ‹^²”™ìŠøþ.›OíÓ€1s¢™AÏbÞ˜ÌÔÓÁjmÉæÚUWÔ‘?,J7<‰Q4°²Ô±.%é@ç•µÁUuE·…Ó0–ÆEøl{C2è{¹€s¾ädg+J¾ƒ›f€Šž\³¥`N“}!$˜ÎCû¤odÕdÚ_úH gÚº;žèQè.mä8è·‚41AÖêü”/`¢ª¸ûèŠ¨fþÁ”¦|·áWhÚÁIÎ/†I­'‡v5ª7-óiNëËhU®s¥¥éG&X8$c’
—ƒ »†¹nTÌK°´7„5Åsøåƒ ºßý„=vQþmµ[dËêM°ÍªlJ~5K$´0ÊE;QÅ~e¡Ïƒ¸T³ÇoBÜÞG®Øøëc{å/„ŽÐaùvXp{ý1DÛšS#8
 Qg
í¯qg| ~{87òn}‰Vò‰3rQ’›_wìÂõÞ1!ì62c‘Âò…š	pþòL®Úkõ:<~ “ýo†ŸD:sÄ4Ý:ù(Ü““µ‡N®^†æ^T65ÉÑ™hP<QÙS%ÖDHjI´é‡ÀÐNÒš;1°n†V„¸»#LÞB\“GÇ³9
:ÿÅHýüÅûùq®ÿþ²NÌŒäl8^æd[3= ŒW“gó˜&&D!Ûç—±nÊÍ‹¾ÿ©æb<X{UrÐçíò¬QŽp|+ª»ù¸®UÎ³W¬¶Õg(ò¤iP¾X#ÑˆÏ~Ì¸ÇÕ÷ÐPòd<ñ!ÍRßØìK ÕO¾Ë“8¸©ÜZ]5Ã;AìÑOº<Àœ÷¿ZœÖç¢­lkÒáâ×õ‡&t/2ÙZ8ÀqÛv‚‹DÐ²v6ýZþ*40sd±"‘EI¹‹F[ûó0i.ù;eW>óåÒO!­êK?óûƒ)3Æ<þ`×¡JáÄD¬h…tÊ`´ÄM,(!
!°¹õó%Z/š-¸ª~z#|²=e~6kcæ6EÀ3˜¶ÎŸh°Þî—C›ïç
ReW8cm‚Æ¿É?àH˜vØdM˜-<p6GÖiü£³mu?N[]R·´
QŠiGu²övçx¢Y1(OE"= ¾ÙÝª¶ýÝ°´Ë]6’ªÅ®GVLÊë7¢
‹]öã·9„hmØ&ø²×òïA{¤}FUár/MqD†3ÄÙ¸x³­Ï>tjú ;qIx2hT
Ã0|Û(ƒClŽs(:6Øü–¸¡tÃ!aNR»‰{E¼hínÎùÍ<NE¾uoÆ$u`–„RIìmK—ý–Í¸(q™hgîwbNŠ(EçŠ]bôu5¿¹?MOtšm2XØËM§R÷QYV*bçR¿ð—ÑóBrä[ÅÝ{Êñ3ÐoY<ÐÑz:†ú¼vŒvÏÞÊnkaMƒç+·Sio®?7ÇÚC
ý`©*ƒÔJ7ºýÕu§”ƒýŸ¹ÎÖLÇacY”]'S5bøQ‰y‰›$¡]ò]µeÂ¶AîpÕ—¡~€å ¾D½,'²µYT½ç3ïkcw¤î
ÏKÌ\øh‰QJ§1>O§~qóÕEjøŠ|gyÃp…ûÑv®–n£ _/íÊÓït!œ×/ ÔZçùOh—Õ˜™ÉJn¥j"ã~ƒÿªôàMñ”…WÐ7
‰ÜM_b¾Ü%¿uÕHÄDg¾L 2Yà1o¡5¤u+m6Ñ7¿+Á!•9scäÏ—kVËIã¡/àv 	Ì9ÀÕjá€:_-‚¿R¹2øÕ”ù¯¾¹¶Ë¹1Ã™š@¶XMKÓÐE®@¦Ûv	Z&0U{ÛcâF!/‚6Òªr¡LõW3éªðßÓý0ª$qÒù€K˜òˆæ{RN#’‘à?šuÕQýO¦>I&qªa2!³_uÞæÙq¯ ¯.˜ÁA‡¡ÐDŠÓíNKHJM¦˜ðç›Q„t˜é!Z@ðwH›H6˜Çào†7Ù"z îDX²Å¶ŒkŸzð´3Iš3äÝêF|ÔûëÌ¾?y!×XL er¹¶mùákàÊ}¿Br¶x3®ZiÆÕ0$g‘d	×¡IÒffFµ¨Ãß5ÍùÌWŸT qº /áÞÌen2]	Òì÷òrõ¤~íŽ"%ÝV4PŒJ5Ú½Ô8³ƒÁ/°œÀâ]ý‡zCD=‰Ù«L|J7@]poÉRñ·fX¦Äˆ?GÎðîKé¤5Î\`™H)Â·=ðû 
P»;è%ëÕrÃ7QhhªRÕ^ÇlDå=¾¦ƒÑ>gUö¬nóRœœX$¥þE@F‚ Ós˜µ;ÕÅŒ'E­—M£Ë™iOûƒÙé­T@™åMG§·Êò• w°¹0‹å]<?Ö˜×mc¹^~Ôç™šÂÚôü\Úhv¶””àF­±dÏÓ@›v°t±U§]ÄkÙáfð9®Q3™ÎLµ_Þpƒòsk«¿‹Ÿ|]Á6N§ð7]æC£áœYÇrÐ½há’f_[m)½kÌ„˜WÖlÆ{9xÊÈ°‚°×Ä+™3ÜèÞðhú\jÜ*–ÅoŸ÷÷{’¤¤æ1¿%¡Â¦Jå–1.<c¶÷šû7Mný×YXx‚NäÚ†íð˜ôè?)‹ Ä+j¬}rœ7ƒòÝtoïFN"±ž^’ñìf‹ŒŸ¿OûÝ™l™1vÓÄ½N"Õ"År?6¾[+ž…jùü“ øôƒß^a(d¡NÚ~òêÉßõJÛqw´3¸\ÝŸQ¢üÍc^À#„Û£ú“"WmÊØ$öÒØ®!É	x,_ÑØ|ƒþF³ ÓÿfÚk™ÐF&…ƒüâ:P…°Bà‡1ügN„C¨ÌB©Ú†Æ@‰YôzÛg{ô µN‡&§¬tšHø½…âñáK€íOGwëoé]ïhß/Á°*+aŒ»S­™åÉ¹}½B™‚Â×u*Ø twûÚkÎ‹«~–Á¸0P¯±´VN¯œéY0Ç0-‹_4™	ÒKÝV¨½a‡[ÈŠÐ°wÊ4L™¢Z9êdÖºý&ª<¿îç_y€`gÒë%RÁÍþ½Ò$’#\Õ6/uÝ»Ú+{7ý¬©´r{ÉÏ'|CËD4#‚eä6Ü®J^7ëÒçÏOÉ'tÃå8…É06_åÖu±ä|-Ž¼6ç ÙÜt¥¬T&ûÅveéR0€Ëû•w4É·²'òñqDÇ¼…ÓC×®–ÙëÑk×"7pGç\„&#öÙ÷ÙTžÍ¶‰
æb:R²~‡³7˜½Šë÷1¨Êƒ²É§´$g¤âëoä•ó
6[¬€Q9¿	‡™ÓTöLôÝWã…Xøïªw>¤_è@MÇõßkpÓên(–wæŸ±u`LGªz>ŠÚòdÕˆBx€Nq|œÄrÞœ$ß[ÒãöLgOèæ$Ï&>·0jÔ—2Ž-änR8ó‘(6îxG0–ÙÝ­ýÈ†‚*-m´Ô½Šú/ÊÌ›Õc=¬)²‹l¨ø‡p˜Æ]åCZ]0ÇeïÖ©k­s˜mø öªDBº, V§VÀô>ÚørÞµe£A‡
{Ý[Ðã0ßzònuÞe@õ²¢Ã1gÚ÷D
"×¥¥ó$É„”†Ïÿ—Ù½w8õÜ[áN­ãOW]©^øRiðþ	zÑd»*»äÌÐþ‹O3ð„"-’üø}rJlÐ¢9pE?Ó‡‡V>ëª5•Ç×?/ê.™}ßK21­NÖ#n„°ïDz–¼=øG×†s€˜õåÄ#‘}Ÿ5Óè•¿øE´óÜú€1©–J`ZŸãÕÓu(Uq²wù^ÃRþ:DÇÒÕéÑ¦"ÇXó¬"eîó´ÿgv9 Ú§Ä¹ÓÄ¶Ã‘)ŸíõÃ1ÚáU3g1T¯k¥nÒÜáŠûjC¨	¼ëõ‚}ü{7ë§5‘v7òõ8bÈi‹õL\a3fZmek	[uœ\*4?)X	<ïÎ¢µ!`N‘…ù	p0Æ'~~OàõG8…š£æ}5¹ZA˜&;ÕœJ­€õ—%–É¢}S«ú¡îÀ\•ß^T0È¬"‡={U¿Àu‘/†ÏóSäàÖd„ÒtœÊCÌ×Ôª+¹÷B~]l³ôÔñïÏ&gÏãâš’/ìÍ¥éŽn-”tP¶Ò¿Ÿrv‰7Ÿ¾k«‘ÆÓ`Zj5}€•;•eHRS±Ñüµ?fŽbV¡ÐÎw6dVª\tc¯Ù$Kî»¼X·Ð7?÷3>K³Îo¡æŸùGV÷~¼B%å‚˜ m=î4ÓiÌ6á0¨HYè+'¬eº´ '<õ»¨ÜõiyóyÕ£ÍÑx®Òlã
±Žâ@[AÍ•p-5í­ìã/¾Ç“xÄ<ãŠ¸.¸a¢l¶Ð[3êî[aJÂ|)ô¸A¬†ëbK(Ø¼s]r¡ñž£*LŒÐòÊ|©ž³£›”ÍÂ€€wFþÆ¸^T:DÏ•HL2}ÁÏ)ú!ZÃñyLeF© ñVþ®ÕAã—Ôþ†·,“ÿaô`§¡mÜggYv#¢:Ý‡#DÂŠ­hÂH	ËÌ:y:—|9žNwPa‚•©ÄrŽ("ôŸnH€×‹5T	éwSÎp3J§;Î‘šôÀ¢½×Óº¨%)ä7ãÃŠDPvVD¹QïÑeµlÍgy>÷J‡,•Ý™»¤_	gj¯î¸øKkâA.œƒf0H«y(ƒÿû ‹WØÓŸÃÁî’§¥aÜGï•mðÝg«Eãg±x±|IX fQ—uÝ{Î^6A0C%Ê»8¸XƒµzÝ ðz¶’ô…8Ù"£­*ß–{¯ëöÌ•rL`Ö_“JQ­›gDã„¡,¬Aƒ4;Œ›Ô÷ÃZ˜·Ë‹Ð‘·Žr;ˆ	Ö¿Qg$è³ÂÕËÈ ÿ1_\‘u[<«nNÞ5×qÌlñWªÒâËX²_w¨Êƒµ†Eé=‰xÛi¹Ãn€ÖÄhT6ÁfÔÚê-}hÀñ>à8ùô‚àoZûS”Éó‹‡°4H™à‰qcHÃ[E^É^§iá“Œ*KHOÕ•¡8„ªw¯òç0?%˜Z1éI…Ëãv`Sš îà ÄˆÉöJeû—õåzà —£•ø×òxºë€ ÑºÚ/>ŽOVµ®¹ºÒaê”~«ì£ôØmòi	À€<{¥-Øñ:¦Ž™T£FwÀKFá.!iLFz èïØB¶À™(6æÆè%U¶ƒëw•52iÝ—ŒüLAé¶›È´“ûµÐ«>%Mk4^yvZ¯÷Lí*6õÊ2Í)™“Žÿ'%î3œ"S“F]dz³ÍÄùx‰JõV™tå.÷¿À{_XSÌr(80Ì]nHäðQ3FNfÕlÇPPMb»õÒ?+Ïó„zú)`n·7h9zål–_ì$¢¡ÓÜ-ñåFBŸï~’cduÒP-Â»G{•î!2ŠákèqléA÷“þ‚Ä2*BY’S™ãÂ«Z†ªÆš½ÆlÉ(©e@¨*±dT|DlþoSê,ë„\Å÷‚;ýpp÷É	*
V}´OXéà	¼Ó,ÍW·ÆîôYO+¼f:ãó#ÒfrŒ­¼/}$]eˆ–ŽXhfœž$ú<ÄŽô$çþ9tÍæX$ÿ’ÞS?jX~‹0œÔòŠÌéRÀƒ(Ò?ƒj¶;®@8Ê8¹Øt6K44ÝI«Ã~Dcõ$DG2Ñ«u~ÊU¡<#fñé¡l© [¥Ë²R@Mð€„}©4jž>+õÁIŠ½jœpúc;HkÂÍFˆ¤tPòe9^ú '–h4!Êé‘+à_Œªzþ}_2ÝGVÒU3å‘‚'=éØ=«ª)¢˜ Ê˜džïÄ]{›Žµ-Æð°.;f×š…D=æüæˆâ(â•8úžAÑÑƒT<Ü5UßVqXê	0°êê{^·òd'`x´_:m[¢;;||#;GÕò¦q›…rË[UÆäë£±´3nzš~Viÿ™™£„îD()aúÐÍ™¡ù4‘•Js æñ)c}<ã¬Ä9M‚ðåº
¨
´T#™iê4Ž	$F*åy¦†ä£GolbAS~4bëÝ¹§(
8â½å§gFf½eÝe§:E’g_;Yê¦aAkP|5ò	´f‰!;…#zñz±Ìmx£’©Ž®„™(öŒ¡üÚ²ƒ
Væ÷ayÉÞH¥Ïè7Á©æÇ?ôÍìÛl	±Êœé´úÏ7q·hÃ¿É7Nèn¯á0NÂ'H»s1d+ú‹*ê†ê#(è,ÞeÒšfÑ"Ð7Cƒ}«%"ë-¢ÆîË*â+â“ßˆ:N¯‡XjÙiÿ«‘ØâŒähûê§E0ý¥4ÕáÈR5¯c˜€ÞÛnD‚iVòá_*\Lú~¼‡\+Bvfön5¿­/-:Œ3pª÷mÄE7TLQ?ñ—˜PiÖ€J¯wDé Ê#ˆÙ¶Y/-½¡²¡ïè˜IöP
8$Ê–ïÂÔÒÛP£° Ã™›¡³æå¡ÔŠ=ÄÝøe×ÐÞ9(¶)’öAV¤6š}PIðè›·]w:?Óøa®\·T&è®fªÖÔR2Æ·™œE¹|ÖÕ@ŽPìZ}Ì{­IH¿0uÝîaHe¦Æ,*˜?°/ð3†Þ+ ¯ögY×«¼WZ,Û5†Æ?¬Cúc
T Áñ¢-Ðä¬t‚k-¬Ný£(üé›Fîíôô¶»ùož¿Øúj#9ßnLhuÅÁ¦ø^ÖdÁ|1}€-†bŽÈÝ‹é}Jñ…BòJ°:õgzOMí‚L0¿bèÍàpbè,jz€|g\ÔqÏàÖ¹ÿz„ãVc».“u’«Å¨Žh€Lö€‡(Ý«`L£Ý£Ö¡<n@Ÿ—´¼ÑÉ÷Ñ|^;^²²Î:Ön£ÕMìR®–¯¸½æ§éY”L;$&Îü×@ÁÝÎ†€‰æ¥R1N5›ÀúÖ'öÃŠ”. å8&›o1)ñgSôÅU{(¸P+rk”â*’­)2ó`hO0RÀû#ÆÍ'öjX—œüEÿ5…®¿dIÑª¨AuQ,e¢º°²VíÚ=SuÒúá«¯?> ÏT}&­Òl¼ŸÞ™¶ahàØQfÞQd~˜ôÎÀøù…–LžÆ]‡ÁŒdíhO—\âÈÜ†˜"\)c
 €Ô\ˆÉÓò|GZÑ!¸s±ê`iº`ìãz}ÍJó…Ž("	:?ûïƒ'¥Û4 vþ¦’b[!Au„b*Òí€*QsþÙ$q§Ë…‡…$Ô®{Üé0iÑ›¹Å~ÿ£·{ÚßHeÑ2G¤È0º«!^e“þ\±iBñPÇ6‰¬}ÈIm@^" ‰Îí±õ*!¼xªU”‚õµ÷0ŽÀÒ¸yAfØá÷$íÉ”iDšÑqÉÆRƒv5gÖ„4ó	·RÛDì)·»#ÆHí#\‘‰&—Æ‹Å˜ú¾_ ž¦Úõdƒ?Ê!£°9D¸îKYƒ¯6Sã°&v×øêbÂHV¥ú|o¬’$XÀáÇ;TÃýôŽËLLiRš^F,Í\Ø‘‰éXk ¦qrühþù—E…ƒk2„jŸç–¼šžn§&Ô>±2HÐ¶úp~GTTµc/=âœž&GE¥YÀDS9ÀHâ,ÍÜ]åŸ}Ž¼.Êi²~¢¯‹z¾èàÕ6e-ÚÅBPQ(F‚Å¹ÔX*d[v¶ëQÐÛø»ÙnÈZØ³4ÏH®C0‡†qÌ¹ábÝ/+ñÑ•¡i²Õ¥=­’¸‡ùåIðÅKûÂO“ú$žæ·iŒÜs­vÿ—žþGºh—÷îSrŽ3ú®F';qR’­èŽ¬êþvÏgY…¿±ŽÝ°ÂN¥,H;}\Ò9Ï/a£ž¤sjäxÙ™ãöÃÛœFŽã"÷Ý/¾ÃEŠ~í«È¸tn#6ø>¶ÑÔpOôÿGU¾°%ÁYÞ¼î×¥<"-Ñ'¾âý ]ƒ|–ùûè«ZÏ¹Zt,¡XÄ­å»®ŠWûÃm™•„„X&C`•Jý¼lEÝ?DvÔ*¤TE²@40
ØSkŸ[‹œ^U<Tvã­ŽÅ¼8ô2t^ˆ›òŠ®…Ô k9£‘È fRÀùY¢
loœ€·¥e˜ôE t*íe†è!z{s¨U€œuNþX•-Yd9@yÃyü¢û¨‚çÌÚŒ%#Éø¾	ÞÊÏr^C‹)R0N§ó^%^Ì¦°‹ï»x¾Ù†wL'iRñt]·$"Ú,Mœ«@i‹³Vÿ‚Yí·þ§~Ø?Âø˜ÂÂîZ¶¤©ç\ 0Ï-k3ßZÊÄü+˜W7v|YÄ2ú: Äƒ/ÊÓûÿÅ+?ª2 5Í0ÔO5¶½ª`ÚA´^SÑ²çvo‰®£›Ä¥ãy\ÐçøëÑTñÿë®ã€£î!€ÒŒR´$™©Xï­-¿FÄâßîcº}¸<€Cp¿±F‰)ç¸1Tq±çÜWÚŽxˆÌ!ð¥ù"o <Ûæ1‡“øÇ.UÑÃ×èÊÎI©"¼Ž–ËÜ|4vž¨c¬ánfŠÇÝ}º•#*eI±pOJsYçrã1ê@Ös3£2“7AzÜ­f¦ßÎNy’ùÌlÚ ñ1<’AQûøœReýÅ^O	à¹òów’íGÈØ µÿ„
oškÊ*x«qaÄÞ`Òµ»qÅ«-dÃ`»Cpó6‚wTä¹eï;¿7x:(·¶ñ©JøÓ J¯OPkÉI¨c¿ÑCDK0ŸYÌœþc!MêzXžÐÊËž©›#¯µÁM²K‚{Õ$Ê¬#Õbì'_ªêr•´ËN9ç @oÉ#Ÿ·BÔvyV› gŒû;9Ûƒa+ÑcAo š6ÈÈfXùçYªa¾Š›õµyåð‚pÒ÷•©±éÂå/9äáÖ¹ •‡«ù­Üå©ÊŠ´²+@jX0Ù2›n®R¨ç3—ügÎ+ ;YC`Cˆ4L˜‘nË°ø˜#½Ë¨¨]å_œ‡r	¦UÎ+Å@fFÚÂ!	îûàÏög_øÉGêX©G%@óß£Î•ñ?ì‰ýqx3¤1Þ¬TÝî¶Ž€aéF‹PVÓûFˆ&°Ü¤´;L…®ÎU}âŸ‹àòy¶Úg
ýàÐ×ªùmð‡GGþGR ‡Œrƒ¿ƒR oÔ=3ÊõU±[×rÒâ²¡,µ®|"õ&±ºÈüõ"ä=û
lÁpù=ò@^h¸Cº˜—Åú«Ay«À¸Ñ?iMèuø]æøVðâÎ`j$ß]JPÿñTØ*UC¶Ñ² (N§M)®ýÐúšŠp˜ÀË.n4¥óœÖ$y_}ŽÌ‡b¤9õÁ:Sž*ìÓk¨y¨[CÊŠJc³]É<Ê×êÉTÓ˜.Ô™B‹ =‡ïß-+ajžiÃë…ë5 »Š0aÇ©™ì³k—ZhÂ£8=üD3=¿ÍÀÜ¿`¶"£ó=6ÁÝ•,¡î·¥>$#@AZBw\pž>GÚÌïÙè5—:‘GZÇÓžËŒ€m•,Ìt®£,P*Òâˆ6´SK™û
äõj&m.ïAè×‡ä3º¼àUŒÒ³Øb’­ÉÍÖ“FûÉË°±ÉI¬˜ÁÑLú0ÐúZ¼M´Ú_äXÊŒÂ¡^{ðu©×ÚïvKæ­Æ—øvâ\ÇÓU¾_“A±›Žwµe^Üñõw+’mð'fÌnfÄH'€›~¦fríš(å<0«è™W–<©U°eNýØ Ÿ¥Z·6åJ7êç»ß]ñihx¸‰%ÝrBuwà¸÷ó`Ã–ZÝMÑ†Ž ÿ½iyÌµƒ=µË!"’¥–ö·qÂIæŒ‡‹¤Àçê*µ-.Î›ž‚Pë
XÈéQLõUàõÐ:Ù²^÷,K1ÿ[nbÀóG2C"âå½HÉƒ~œJí,>ž6ùÛ±üñ‹‡|ÃIŠ3Öà€þÒ§ßAr2Ååj¾t2í4ºòJár]±©ÀìóÛ­cþ˜èÝ7ª²[…‘…3´%Ç¶'Áv=¿UsèªŒ‰…Bý%¾†í°x–ù;™¸é^·uÓz Róì7¼JZo¥ñGvýzÕà¬ïã{a~cµ¦3»1ÒÁ‰k'éÀìÞ	ÂÝŽ‡FAòÐ|é&sKJðÚ¤aª¸µ³»Ë{7«ÙËeÊ@Ä^Ò>rw%5¯C_¥H›'‰1*¼êW<Pö1œTHè›áôÛãÛ…*GÇßgtœ±W…¶3*tñ¦Œ‰E·ÖÿvVä³Q~-µîUj5ˆïšÃìÝ¡mB·ÒŽÕâ°îIH’~­
ðLP¹C|ˆYÞZS<P÷ÇÄ ¡huDB!>v]­Ux˜.3c?ß­×©ÃÂ@ßƒX_à|Â„?Ÿž@ÐðÙ4•›…§×­~IP¾PP«å»ó5òƒÃbë–ïwÈ¨Ä¬ñ~TÚòÖ3ª0oÜª›FÔG¼{Ô’œ£·‹Å¼“MýCöÌú´2 B	ÿ€’n3¸x•x‡u¬MnwX0ûºu§‚SÉeˆVå¢HÄNüB_¿ÊZsâ–È“žÛ©l3ÇvÐƒd2âªÂîò€¾>Å†ïI™¤Þä	>oî÷ŽaáYÎh¬¾Ö•y§…û;jÅ„s,ZÏ(±Ä| ÿwƒO9Òo£	
ˆ_¡ECAõÑ#ŽA#©yV'Y—@‡%R „5<žmS,MiÜj–ƒš2þ:-œH)žôÌ‚ê
÷¶©-9‡z/…º®(ªÝâ²_ ¾$mó:³¨µæ?è1<]´6mo€-•Ñ^*ˆÚà-;UHËæÑ%½FÜì ™›ÜƒW+í_é9›ŽDèbŒúË,|hK%ÓÚÊ›4 ®ÚÌ(Ä¼`”Ö_‡NÙ fÖ«ž‹êHâ]Zv6dÕqe¶L|9«&?ÕéòÁoÄ%O•Ñ
%°¡ë	\ð%Þk:èêShó‹ò¶Çfv¥"ª’å¡™B˜X†ÀÍ S	Äè˜,ù¹ì‘fÏ-K;4W¥“s“I
ÕÖã§)Xå²C »ªŠ‡˜gÌN÷š	‘'	Xo $:r°	úþÌF=1=}8l¹$ù7åÚ>É4Áã;+b»…§\ªªJ§÷21ð2ŒÇÙæ$õ¬âg47žæ¿š™ƒe¨ê¹‹(‡]ÐÅÂ·;.ˆŸM—ÿž(]»XJÏ×ˆœ|dˆŸGÍƒÓã$œU³ÚÔ|‘²P´Z³ãÞ)´•:íƒ±ö,ûÆD¡ÓÃv¢SYåY0›,¨P0’§6¤ñ¼¼.ÛøiËÆ´3UŸNR2§b˜°·S%[«Îòä™IÞ „"à¨õ¡µ¿dýOòÚÝ-‡*æ”9²Œµ°ŒôŠ¼HîY„~†öUÏ[Õuªaßüù˜`¹0ÇD|P×úòÆ#$¾©h3ú*ä|¥«™‰ÌAî©VªÈ¥Èo¾ôaÜ¢¯Uè]…³14·v{O_¢Ïž¹Ê@ÊI®Äâ5_rk9oµ»P.8?5¢.MyUXln rùNÑm†æ8*Òá(Ò(½åÐNt8ï˜½G¶4Åw&A™°¡·žÙ=ïÚ1ª[ž_ŸxØ‰°6x.~'%#0ãBÜP.÷TŽWôÕ#àR¥
Ï":Ú• l«*è‹iRß8ÛPÄT˜Ôc[Éã~ä3¶âZîÒlÙ+9	˜o`·„lÏ!éø“v·Ãˆ)(ÆF);P÷¬ÜPÒöîNl–ûÞ#kÚf¿çÑåLVýè@U)ÕüvÚØ«7HHóN·vYˆh£c{{ÇÇŽ]´Ñ`Ñpû{Û—õ¡#f€C2”WŽlTß·¯’Momè÷LÕèDOËÖÃÅ]Ð25ÞMŠ¸} œßc~ƒøßÍ-“¯OE~o(9ÝÓß*sc¶ñŽ<K…AÚÐ™Ö¾”o™€g®ÔÓ·šÓÆC¢«žoiw3\ûp9¶AßöHËç´öâŸ	Ã±ÚÐ•~’Â+^ÉÓöÁ&t0Ÿ¼Z~aØWœ0ÓïhÞV=bQkMÙCErmJ˜k-û6AŒ™	"Â˜v¥nÖ9¨H{µèþ9.«ò MPÔNˆp÷ÌÙóï„8“/óyÇjD>F;U-i;$”5Wp24zÔ*_žz‘×•k3™ÜS×@–‰Ú5A 	î&;G-OÇþÊò_‰_ßwÖúûõ(–äÀc pá*¤°…•ýX,÷Ñ±	h	Rò&'-›løI$wzäKJ†ïà¹};{ÇQJU¬äýÏtÍ<GEùò4µê4ª´ëº‚åß6ÕÄ’É:wRaº>ç‚´\`,€¡œYY­m¡j.žõi‡Cbãº]*¯T½·ûÄ4H÷/°nrÙ,lÆ98·ø«’ÄqBúâ]ç¸Ú¯Šyû­;âdîã:>CÐuûÚ/½{wÍÇÛÐ¦‚Õ˜+ÏGì¯§Î81™‰®<wÈ¸ìŒe^óµIÂ!5¦{'&+³É³
‰ÐZQbóèÎ±å`	0Ö…lÃÖW(miuâ¦GI·Je[1µ ²áÖy"ÁÝAä	Œ ÇŠrð@óÉ×ž9>~„ºàhfûÑøE0@äôÖÛßöØö¿1£nkªÒRîÏ‘ÙµEý¥ñ¾¥Õ^Ì2«6)ÛU¶š4®mYÛÇÁxbÐ7¿oÂAâvÜ¡ƒ^ö¦6ƒìÐ <K|²ëw[pa©Úâ00z$	^x8åí1p-âTŸ$Ïðµñ€“ZÖ*óÏ:r4.¦Ê•–8j_‰ÜE{ç-ë$UÏfÔ:µµTigímb|³:hmxAgc¹æÑé´}\’˜§gDÇ/‹i~.ÿ:ä	©•^(?Þ1x\KÎ±b®x3¶éµêø‡Í}ÁViˆ½Éô³Q´o‘=Gu”5yŒNpN Æ¾=·½ƒ5Ä¸Xq¹®Ùöƒ´ªüÝ“¾¶‡öÏlÊ£î¦Â“ÞÒò51Oíß[]¸â-Þ;¡·áŸ'¯¡žÇï)!Õ±Zµ|1{ybµFæòOÑmT ÃÆ‹ª×¹åÇä½èHC%v…Ãt·¡zx}ŸÿÁ†òSIì»6Ö?¸>Èõ²£+;FPÀsy@ÝF~Î°£•¿¸êVAsÉþc/˜Žò°UÛq‚ÔæÃJ–Q™:43•"3Q±÷ìñ¶!JÜËs"Ê€€­õxT¼Þ²éXä@g‹°àìì,Ú©SÑäLúù,èúz~,+VRVò³ZøQ6×šºYLQàÓ‡ÏÛ·ÚàgùCŠý^-5>²ÖÄQ<²wöñï2P¶ënUè—W´'ÉMÓ%g½¯¨hÈûbb'”]Í³¢XÜ!gÛ·™û»ÃE‚Ï,sôÉ*`ÏmQñò¤ÒS•ùÓºy—ÁÛOx?Ê²HŽ™ã®½ð‰;ŒE#ÞÈ÷ÝjÑŸÞà*lØ^»Û¥®ofhÙ•ï¹bG™“ ¤ÊŽêƒj|¾(²ñüSø®ßp‡ž-O]ª/lèÌÕÏfPÙþ4èü¿»µåW/ÅåŒG$&á‡5°÷8Qðl-ÇÙòÿ‰Fìoe`õÉ2Jó=Io/(6„zAu'ÝÍî‡„ð(Ãèl¬÷YûûÃkø'h_í’ÏÌGq™ïÊm€™´û æ5ýÈTbùÅ\æížÞ2@w`{Ÿic8%VõÍ” Ùú.ÏñÕ5Ž‘ìÆË”ˆnÑ¸C­fì‹ó3ÕêÏ§X‹…LcrèˆŽðÇ´ŠÔ†€L§æ¼Ò¬pˆÚ2å¬3$d-Ø7þåTÅÁùGµ60ñŠÃº>Uªc—¼Ü nô‰¤SlpXì«ÇWøø"rÇ–5nfU;EnK"Ì¸Ð
…—¯¬qy­¬4çñ›RØpVœímÉè-m¯yV„©šºûkÓ™_ŽÙÀStí/ÑUú¯kÁûwìít•"0d+ÞU„7h)/¸à•=`:ò­˜ï¨¦1ìLÑÊ#IïMxêôhÛþÀ)Ï,Ž˜^èª Œ”‚Ô_RÃ¥_Àý/¹—ÁùLñH(÷ÖûÆ;‘%«jOÅÆ¼w€_ØöD]ø7þï¬tJ‰hÅÅ'ðQð\;î&nébK$É)…¼ÀFF±w$`¯„#6nG-IºØõ/ŸçÂ"KXs8ù+CP…kkO˜±]·8¹ðÅKzEH ÆðAký„r½A®ž`"~Z?¡9¾®ÞM™ý‚•M“ßh¢ÏåSôèj+öøpòQV9¨äÆ%Ðj‰ÿÆë½ÞT¾LN3nÖØÁõÙÀ†±L·ï‚«  ¥ƒ³êHS¡Þºc¯Ò¾°XkñØ’”ï5p`?Àw2¨ÂN£«¹Þ'oiÞ3ÃIýº¶(t†žê¸˜Ãˆ!½=ïá—lÞ7'†LÔ.èÐõóÙxfØ‹™5aøë¹_-@21;ÿ*ÑÄåÿë"Õ3w:"yþ8%²áŠ9äj—µ1e¼¬ÿ4Íšµex<úf…þ;•ën‘£ÑíŠM1n>Õ°@žZKEö<LçÚ¤šË:°Š¸P§÷ÿwÄ¶™b+ ê¸¥éO!â~Á	>gŠhø±mS–<Ù<&0ßí¦ ÒN‰‚¥d>çÅ†Ã‚£‡ïðk³ûQKK?¹*à>ÅÆñ„ÙøE(Òù™qžÕ#ÕUì×ÐCZÏ°…4‰‘+I®Á#VŠr0î¾Ó\·aœóÚUÚÌ­£nÞö%>ußz—Úòµ	G]ªË‚Y„–¡´6x4|ó!ÀbET-å*×ZªI”Êù37DØžÙ%ÆÁžÏå"xü<§ÚR‡«ÈU¡h»ØæùJÐ[Í¥	&‘“¸sñ@A‚_ñÁ\à	Æ1E^§ '‡ÌYœPÖò‚³¶íLóOÃ‚ÿÊlùá!4k—ÇI, c zd…É³!l‰&1Ï6KêÛØ§OÐSžn½¼Á»x8£z+às_Ÿ]lãÀ‹£[©Oßâø«è/2K1çTÇáH˜t—‡Y¦-¤gÈÉ¥½}¿˜ÅDó>Ò¡ÈßuêÚ‚ê¯®ðÛ®Äv”d)½Ž_Ñ©P÷m-*	Æ¡¥FÇ£€ªLˆnèA•2l")À„ºï)ÉR9ú+Œ-XFo˜ˆûÆ6À[Ï]¡ ?ç’¹¢0K"ïÐœ!ÈF~"³zÐ.€ŠV½ôÀÃŽÅT»LÀÏQ€\rL-H)âäÅUŒ ü…A™øãÀ® £Œ.¡§â~õ…,ï1½„dîaÔÑPKë^GøZâB
:®lÙ[Ø´?m]åŽËþPæIöÅârõû	HcÚÿ¤Gg~ÀG‰^È\>9:dw¿Ÿ¼~Iµòzo¯½ó’=’$\÷?ý+ µ3¾´z*_lø/X,‰Vûk	)U‚%`0«®K¿fö•¹.—cvv¸ì<ä³î´µ¾%–~*"ØÀ!	ô¡39HÕnp<ï•Ü²‘xç¨°¦SûPxj0¿±èÔ¼ñ•ÿ¡°³âeReµÂ#K ìt–­7¤©.Á«ƒ€<âamÖŸxó¬ÒLÿØÉ…Å'"¿Å ð+8iË•ÇWãY&°»uO—Eç^#FF¡¾Jÿ§ø…¥NÌ/z·7@,;§„Vr?YVWò}f¼6~·©dh‡°Hóøža‡Ì¾€AÝß¯­HÉÎ³Œ@ ÊÅYÍPª‘ï>@@*Ç.èHÎRï¿ÿÒ/ //#»«ïð¨÷vùžI[¼–•¾uâ´þLˆ¼&1%bxûV.O ·6;9†>ª/o$›àF©—9–kV!Œö£l—‘Ë>êAØgž«²¾<\¸ES VÕ9¢šNToÑ”{±Á¶£{dá¢Ctˆ©Û˜äD qW«2Œ\"Ë.“æÔ8±Ìþ=*ç¢,þí§ø²[ŠEEï|4ï~”¡@Ð@ö`¥ìso{^h'ùù?ä…ö¬„'ú]'Ä¯…viBÉmŸØÞ*Ï8hÈØ½Ñ+r“¢“`¤Ù¢k–…`%p5(±P¹ ÀŒÍR°8¡ØV=)SeóN¹j~Ævÿ—ŒÇÞ×v/äÄ·UØ
"qWxÛ+ÔÁLmÈéyÀƒtƒ¢I{*Ñm¶g¾ÑØÆÏÇÔgÑoÀÙÅàœ´šZ$XÌ-p–lE'£‡anëòà~×@Ù¬ù¥ÑÅ¦»‚Ú­Ï_Ó¢‘°Õ“ùÅû°àôºCˆ¡‚Õ³Êqò™|™PF5¨l“g·‹ûÓÄ’qelMËg(ïuªm©¶•š˜´ÏÕ5No’Ñªzv¶¨Ea|™VéÊGÆ1-ÛØ<ðtÆmŠ2¤µ¶a8®á•&6hR¥³™ç74€T[l]gyž/Šgâ:Ü¿#A×1›>v?¨êYJy=W:x…¾Fz?O"¸¹êÊ 4{yœú¦ÈÍ·@$à	(Z'èŽ?û0­FŸ7NÞ£ñÚG"xÂ4ÿÿÛfàrKXÿãz<D“"¯qÒÊÛ¸‘³·Y>?xÍßé3h¢Ç.Q†ØFû©Vù“Cë²~Q½®+E¾@.özÖ*ddßà•©ðÕÄ…CQkþvpjPÎAçíðK$>Xö/)é ;’!Xš‰’8Nü«Bƒt“è.h£„sÃçÕ¦½/Á²Týî¢ï9T›³8LgÚ_ô¶aO z'¯Oû 7¥"[xåõÚ'G˜¯»>4¸¼×òã÷Z°pvž1µû Êð|1®,––‰í»kYË¢KêÐV¦òxÆ¹í¥Kø#&cOßz®ç%À›@ƒ“¯ìûë/.3”êªD×‹W…“lZüª`‚y;ºîC‚ø%M‘ëe¬ÝÏ¹4ÖPË'Q™&(j—ýi*«¹l¥–¨aœfÔÇ qv°Bî²C¬ŽjkÊÏ.™	U1’ø*geö¿—é­¹
í­ëÿù`)¦ÌH‡Í?cN™oˆp¸à>.F™ÞÐÎ¶‰eÏè— ùü.ô²®½®E´kGô‚#¶?R¶fxî„2Q1§¹ºÀilU¾/ÆþÜìPXÉßÀÖK«ºçÜÔÒÈúKö'õ6†šÑÅ,Úž2s¢ŸÍ²]ß/¿dCÇ=~-´ªß(ÿ­Ä¦œÏ+cÙ n¸YK
î‚”»Åëj&8é÷à‰£ÂÒÖ€5úHQr"/ûÇ®ò¾á)Bf‰\g½+ß-Ì×b{¯®V(÷]šÒ†=¹ñÜoÓô¥_žyÝJ¯á6Eó=ÖÞ™çmD–€ÃF9Á:4þVçE}ªÛ©“qaKòÎÙé„~¹Oa5$×€<¢1ÏýZ®icÊþÅaäì¢~aÿ„*O‡ÂØÓ}½vÑ ©Ê´ °ælƒ0duÛ­€Ìº¬–½nìÜ½Š¢m: åZ·ó÷üz“WÒÓæäÓíôúÅV%-GÿpÖ7!öƒhM+VÆIM(ƒù›fmNÎÀb¬ê¶8kŒ	M))ìü¢–áZ„£çäx=BÏ6ÊhƒÂ²6VkÎb`3÷¢má)Tl%fw$ZµÛÂi!f‹{‚0x¦g;‰ýíã‡
öÁøºyý‡êâuŸ³ã"ÒG]ª h¬Ä·ÔŸL>2ÍˆOÂ%.êŸÓí¸µ%‰oÄ~ü“ž]™¸vÍÏŽ6|
ŸåzO”OeÝÅ¼Lf÷—èÝ¢ê“YxÅ”˜~.n!@ÐðfÓ8¼‡±/WÒÐ$Yåéænr¹Ü¦f(Ó9Zß¶\T\NÉ ^Þ:Ûƒ6ùÙÛÔ¼€0ø(5’S<‡<¹)¢ Bîˆƒ/¬h—_Ïæn3$-<P5ß=Ìrð˜GE†4Ï;„SÂ	Šô*Ã•‡Ùõiì[:†ÖÌ7Aš8>Í-}ì)=†œÃÙÌ%–´ÞÎÌðÙúˆ€Ån°rbÌobåó´÷ÿ›d58À	·ÂtÓUv`:F=íQêZWÂGD9®ðó%i¸w(äàJ›Eú''É’ýîiÇÀn¼`€q?]ö+ôŽ*ÌÏ*kz+äv‚ãPU‘ýVïj ‡xR¥9_ §Õ‰Ó{LË“üÃy,¶²…JæFÈFIá‡„óR¹a™ïmµXÞæ[uŸÕâNX´_D»«Ñ¶¿-~š7‚×ãd¾T6jL¸„áe”ìiˆ€ÆÏ|­e^V1§l¦[(ÿhÒ­‚ƒ+•<7LEÆ¯®g(ö“Éå9¦Û`ÀèMJ…òìµK|—a}+û¸M™O¶Tz/((å3ôf„z™•‰8l¬ÍoÍû¤[‡'•&hÿ7–Ì
E|ï´®|·QXÆsoE›½bYOˆ Œ~a¬ Z{ÄÒ³³“ºÇ®ç§S[ZËŒ“êõ„X+9ÃJËÞ|8˜"':ÜÁ¯Îˆ¼f[[É~YgØž@¦›ßô(5nµ'•½Š
6‹KTÞ„nÃÌt¾M—% â§Á}ê€’UÖRž,ó±T†ˆý†ÐÆ¥È+ØUv¸eÈUcddªì­–[gU#•LÏäŠMXW±ør- HÛ¾ÕtDÓ…D$’+Y>v±8¬Û0}—Žx€Â-*Ç6¸8e†Éüï°òÇ×†-]<ÍMjÿáúËŽå)Ñóìø¢Iœ{,`Câï{ú{½A‚¦JF³óP_¡ô¹1œÐîý"ÔÏ¿Õ½†kÕË}WynšÈ%!UÝ¨Í ÚF¨é5¶ô¢ÉAü´ÉdÔëstQFÛ`Ú€š$?ZŸ·!óÑ¼üAœwÕÔ/ŸÛ¬0=0œÅv”pÊ•šÎ{ItŽ¹[9*px„‡yìªI˜©ÇWm`ä¡ÕŒâ@½g…Vµ§·^üˆ¾Ø'_\RíS^·ÓC¢}‘ñrr»	óÝúÝÕ+^Q÷L8Ö	A¸ÌÐ'ÔyÒx22´ô`+àêü}ó87œóù¦(-üuX/v'~¢)åXxy2¨ÔlóïwÍ€Õ ‡úÂå Þ•Ÿµ7éüMÓmô]{2Å “©ˆ¼‡1É>JER˜»ø°Úý]ú&*k6@ LýmÅÈnˆj‡c­Š]nû!£²õ)àÝˆ0Þ€Ð§|ÉÆYK[å¥]Ñ–Oè:ùŸ®B†^W]W’Qè.-“À~
|–Æêx2å±C_Å{È$»dÜSÔPû´œ_Å_0S9›FÛa!Œ ±üAOÂ^6¦ ÇýÚ°ŽN€áèUT(aêÊ30å>³r†Pcei‡­w»¿»‡†ÄøùµA
´±0u˜•·Ž¿Q:mÌ¼‰ŒatÈ¥d+·iÍœ$= Íå¢EV¸N:¨¥–×•áM^ñj¯ˆ^šZš"PÍ¶×†2dµ|s‚4a¢ï#¤Xê÷(5]{çHƒ3UQ	Ñ®™ôyøL\-t‘yXü.øpMaý{b†#”ÿžiS™­ÏfXï?<	Í¢ aÙ½pC&¨Ìo¶è„g_ ¶…÷(˜èñÑÉaâL1 © 2ðTz¦E’Êó\>êb¥öž’] 6E‘ÈéÚé£'¿1Ê±«‹­ÝÝµõ8âB©taGÐµ¡ÙA©°€ÖæýQ§*mEßðB;7°wù³†Xã%a[èðªèfõ©³Ô—KYËÀŽÚ¶+ZYÄsÅöÐÀ±“mÆÄáøíHÄñ¯½’¼LlíÝ§`6œDõå-q?~ÿ‚)*!ß$qÐdBƒf˜ùâþ`³«e¾ ›wÁzÜ.-TÊÆü9NIœ¨.¼äND4Þpˆ'Û@Ç3þ¯JQ‘ø¶©ôp2X\Ï¸7ùÓÞ®M;õq†_góD…ôTÇÃå·”ÛxË¹J•±BY²ë‚ÌÑln:êÑg‚M(åÆ`ú„F!‚aWaERG˜46ŒNîsÏÌ–›6^ñžÉ2L¬þ{K‘oÖŸHjŽupX~Ùåéº‡Ÿ£5I€ï |KÙø”^®½F.ÌÃ&¼ÎHñYZ‹äÈ¿Á,ÇQ´ðÈ$­ºdêxÇ|@òëÒÇß#i¬Š¹¡È½“ý6(ä“ŸÒÇ¦­pçë>%fïlª–<Sr±Wí|G	¥Y¸Ø‰Ví¼Å‘Âf÷<Èc¯G¬æ¹1ö=öÓÏ~w ñd(éâD°‡X‘Ñ€Éð§(uãT«•`×¹®üeB˜ûlE³F­ëTeê$AlØë_q¿!»Z5ù>^"ü˜Ow˜ð:ÞÏ-“íëoË³ÞH½Æî$`A™Š´ud~àÿ$? GŠÂ¶Qè“?_Õ+bÑbçTc5$„t¯£Ë8Ñ©>ëˆEâ¯t„9r­½¿í°5G\ñ/öb¡Ý%¡ç­…ë.Î:D¾(FÀìqZeƒü¿Œ]æ®mu˜[ŒhôQ!Œ_ÕI¯{¨w| è:Bib£¢ÂÚÃÏ~ROõyØIåßjMáõû/ôiEv·Â?Çþí¦°z«¯Ð,ð%~ýÒ
”ãŸÉÅ6öË˜þÝ|Ï(v2ÒEý\qÍ¿d7w_ìÀ½ÇÄ„°3¹þ8¾ËpëáÑ_{ÿ3Œr¢^ÒVeXÉbà¬®ëfÆ!!wõ"¨?w]ù_“‚ñ2‘Ÿ&=¼­‹&~’ç°Ãœ%¥)‡SÚ‹I)zê6‹}MÜ°Q«iÙíˆE]˜öÎ$åËg	ÐÏxÁ)@‚È? »Í®“¨]ú3Zp‹DF6Ïû/#´™ŠK,šËE½k”–VIP<ËP¿¸ Nw¶²ÆÊz¹ÎwãâJc×¿¦n/˜.¬*fe"w+#	ì-Ë2Æîp»nùØ6Úul÷/ÃuÝ?mØÓP¯„É±ø9ã	÷~ÃÓáºøÿŸ7c­òŠgTº¬ÁK7¥1=UÓÍÄ.¸üÕÝ %¸ KdkUÓ_¿ÔubË„a§•ôm7¤Åˆ¶¸ì€Ùf€:â|ÓƒÖœï\øÈ‚>À*õ6„Òø&¸.ü
§h$&ˆaÅG²ƒƒEL,I™CÙÃw´š¹¨£q‰÷‡Œ.Fè„Z“f:æâÀý['fdZ¨ê6üþC›!b<Ë†¤GéÇÏ©&$KvDwìhÍ·—ªIµúÙÌ¢<kŽ›LGŒ~ˆ/|Ï^@â*¸<=ãaêãùb‹|»Vü\ªÙkía0m<SmÊ×îëxâe˜âÎ\W©:R8ÛÔ½z÷nÌT/YÆ9˜
ÝÍØõìèŽµ¼‘ºº;„÷”Á”í†2 1¢a<Ø ê~Ó™ŒSÛ&çóKA ì1*(ˆÛFëÌ½Z­e=Ë(Ë ¯·°x¨Cñ ²û˜**°ÌÄœ‰1p÷8ªâ¾ÃHLþû”Te„XN«ËíWéÀ$“y9çhMž’F§ÀÑæQ;›+k»±œé×ã£`µ”ýDÙû}ëÃtõDä°óÈ²ø… ùÉm>×ã;§RÛpI¾¥1ë^ŽÓØD5äÜ­xçb§hÉÄ0Ç‚
Ÿ§2ÿ¯7ØS¨Ñ­Äáè‚*KÚ—›L€Ô½Ì\à9p ý*ÁJÔL‹4ƒ«Ó«ªöw•äp8	©+Ï9‚A,fÀy÷<VD-n?Ï.jïN¡ûeŒ-ÿ·^Ü×<q–§††¥@ÁZŸõ4Ê²¬Txñâp‰·vîü4%ù"l›*M[£„€¸/žÙÿ²@vÅRw¿=$ßñÈ‡Îj†F9W¨v'üÁ&©*Åpª€±i¾´{myæ¸B#÷O5u-ä‘mi[ÛÁLÅÈçñ
Z§íI[aqSîå>ó 1´>9éIç%I3¿Ï/é0xXx?L÷ãE¿µH®6‚†TÐ<àšýé3Œ‚|lº­Þ¤z¤$ß<ÊÒá›z‚â„Ide>ôÀ#¾~¨0ÐÊ»¥\°9Dhw9XM·™ÖnlSÇoYu¨é)[*¥ùÖååfïÄ?}‚ˆá¹Ün'Ln6}¥Tê:^¤ÈoPu½?W÷¹øbŽ a¹2¹"™áo4)Ç7úÊ pIöá÷>E¹Uc”_[hîŒ¿ÝúHH“µçŸ¨"œ“ç}U±ÂÅÂA¬> ,×1s½œ¸,˜Ïü‡ª2€¶IYdD`*:ééISÄ,›nÎ…_ü÷RÈú½‘÷¿ÕºŠÑö×¬ñ±ªÉ$ßFÙß67L#ã4XÕ½Vo^ä Ï!ürf(E²,ûp"ø×Aº§yÐùxðƒ/ˆóÊæY¸¼‘S1‡jÀp+¤ñ§„’@\?Pÿ’ÐµçóQ%ÆŸ½¾‚"	Û ŸVÂóß~òïºÒo¾¿i:òÞ¨ò¹½Ð—ù/üàu§..¶#ËŒõŒbôôP^P–|
$öHµ>¦Ûii7ñ±ï„KÒš#-¤odsÒ{´ä8¸ëoíO­ö(ê$¶ƒ&fr/"õP–:Èˆ½#ÂÂ~bDÑè­vé#Ôih×‡Ò4öuÅË0VÀ’ò“Žp!Jîg,.¸sï¦Q_Ûž8ZvãRPT÷,Ï{ÎÙ3gyÓX½A"‚£¨#-ÜZùÕÿ©¼¼"ô«(ªÈKJ¼í¦ÀÆ|*Ðæš«
Hˆ@;†ãßw|ùÜ¬Bºþïñª¿kõê
4+«eùØE—hzêŽ©£µ³š…FgßÜ jJ÷›§¢Ÿ~À­FQÙÉ‰”¯ïÐLAXcÈŽk¯¾ÍfZW;Ód+7ºC KÌß/V7šÀ}@$¬ç«)Òš¿pÏhÈÈi´¶lL`ÀªÌS„¿ÏH˜ÍÍ|Z6ê%áM	þ}Ÿ‘˜õÁXJÞ\OuG‡hºsðÃgDñ3¶?‹ñvâ$Ž©œ	1äð»,êÕ3=3Õ¸c¯92@}qÐ J¿çH¯®5RsÝî×“<’º«ÖñÃ‚f®ÏŠ,³°÷û—§¬"õ=2ÇL°ÁRðråNòõAÞ¾eõ<Y@OÁ…ziÞè=‰×ðOuÕùG­Œí“¥aŽZ‡¡\…Àªu2Ý]öYFTJ1©JF‰òñcrÙsÛdù’ÿ™GB^t]-S±íwk.µü¢½ýôØeVî0ª¤Tþy`è3>å£T<&ÜœûÒ&ìà¢¼¤á‘ÞLßEÛiáŽÈâþþHÀšüø³ü=1ÉngÎ~\1Ô¾ìˆP‰S0	dFìRòDýMb_.”š*gŸk\È5V¼AE¾z2È"{AU<ìþèŠk˜ë†<ÂÁáfÃñ3Î¦oÈÙÖ±¯?¢Ó%	+X Õ[gÁ$ˆÛ2Å§@?Ÿh Ãí0ða
;)ÝùÐ %MbFÜ?[tñL!OººmZÕãŸ;ô¾ƒþß„9ªb£HIñŸ‘.¾Û€;bÃ\.12å“·Gp)ŒŠ`)'¾•ÜWÌ¶|‹L7^çuÖåL9NÂ!7¤üvÆúáÈ	¾DL‘êü\± ¹ûce—4|]à–ë¢O£2øüJ(¥åô‡œÞHlr»ÀžÔÊ7ziR­Ñ&ÌlÃz£=§]c4‘K ¢)–nà¿¾™Å0BÊ 9‚¶íõŽá•Lûö|vÈþKx»®($„ègK#M]5­²!/<êW,)ÐL¦çú­)x¸íZ<ú”“Þæeù2õ
yOçê’‰“äHÚ·ØÒ—I°ìCòžlEèÝ…&ÿ“ŽÃH12©yt*@såIH†Ðê2÷èè“]è”š;~ªØŽŒö½>Î¬æ×ëu°ïúÜx<Ìª¿«B\`cÀ±“ëú‘—ÓŸ7£â¾˜G]Ý.UÝ“< v°WÖ[tËvªfÈLN*±ªŽ žÒ Òa1êRPhh`d×ÁeëZfum.‡Œj6ì¢ly’& ÐO„¥q0K¡ÿey´R'	%Ã§etÉðÆègÂÇúOø„W	…êè +Lh*.e0}¢>´¥ÇdÔBöb5Â @±>+$cfzZmcóÞr$¿DÐÌó;–x;fƒ1?¿f{wûšEjr<Ô¸»†½Kèœ€8ÒÖ?HQãPw=ªÁ9,T¨M-r²y6êð*ohl–ê|öBjp“ùé„O›Võ5$6Ib·”t^Ïrb÷Á¶Ú·óùsÎ–Ÿô)ÍÒ?2¢ed¥Ê¢ AÉ‹ÍÞ™Ìßè íá/zÒ„½øÞv£9†Ú_€"-{´¿«x=¹5…£Þ“<ÐOöïKD{D8©tŽàð«dàyrøïÞûÕû ]»6‹U“ZÚ÷ÍÍ›Åt•–æIW^Hûî¦…ŒÎÙn,¹•fŽytòP5—ÕFžvŸ¨%“éÓ× H 8[€u'ë0i Ft0¡¥øZ-k‹®ÿÓýÏ
Ïå:Lß×»ÝeÜ6(„Ïˆ$YÐO4ÕçÙ\Û„…Ô2¨n¶?Æžz™ÌæàCÀì¹+uÎ„°{lžNÜ‹)“ËeÃ¬Cýe!Â¿2uPlª<ë/Ì|¢wÚ2~Ëã(Cº±_¸ÙæG,D;2ðñûÊ²(\ÒN÷4´:7ÞÚW§íÒ
37WÍ$N=Ôaªó‚·a”Q§]85Éä^'­$|=GPjúÌlZY<÷‘¼/Bó#Xêóô|‘×Æ¢¯ŸT÷	×vgß,ŠDªÎÂ:½»a³l4»Eü-xL(s¶èž†º­ë7À«óÚß%¤s½ÑÔå6›â¡#²ÀØûg×Eùu%^·Ž±Ò±[ùiú¡\â`÷Õ``øÐuÃ’BPo+»XIæ·qAªyÞN\Ó¾„#Y8K;°eZJÕŸýí»È¼ÏÙ&°§P$1´½šÎ}€¹‡i”ÅK}“{•sèZõ¾çÓ>‡ºr¡ªì­éÌa_k¹ê®ç©0S¡€Ü•×7&»©®Pi-À6âÓàõ°Üÿ®Ì…k6ÐÕãð÷J¨Ðô	!DâÑaŠ—èïš™Ûéß1œz™Q
ß±ú¿.	ëõIKU3áG{;(íóâi¶2}/ºñ~tÚ—º¿X!æ>ý?N±)ƒC6bÎž
:[ôl0-”u«Y²³ ã½-’’h8kUÃ|øxØÐsÁèëÍ@¶Oe‘¡XËöIå“ImÏ¨‰®$Ê æ®¹rÄ©šL±l«Ýòá·TR´$³vOP(S°?}RØà¬ËÿÎ•Ô\\Ü+™A¶ÉÆÕsÏh‡*SÌÕ8DDZ<™®+š9ùõ•fÆ[1‚çôÍÚ†ìEî¼*ßü„óÿàl“¤ù™TûÅ•6±ZbzH5ïwÐÏýš?…o{0ÍÖN£—ä73}˜h[?A”Ç™Û¾Ö®ÝÐ:Ø˜øÑ‰84æäW¢šI¾¸­€êÔx®îõÂoC;µ¢rgb’¤ü(DÞa×ÌHdþ>éÉO¦ƒ¡ÅJôzaûÅnÞ(7žq°X7´ÎM‡ËUÔÌc‡ýéLz„Å×‰]Ta'¼_(u½o¬¶J¬¯µËã0½à|ù“çks¨ÒãÙ•“àÔ±£#¢é¬„.)«“:”óêî¯nMöõ>T„›ë*\›f‡ÓÆ"[8ÑY!ƒAREþ»Œ“P ·¼Z6o_Tó‹÷ªüÉ5ÄÒUèIŸúÙª±kØ‚å¯h5ºYö	Ç°^HÔ/s hÈj‹Äax‚ÿÃWf¸)–š›÷)›»K{Òò6p¹”ÇOt©Uó…œäÜ±mš­8Ì²óÝj“Ü²âKÎ)*%óçhj­*3±LØújEúÊ!1iÈ&írK€Å·öž«ÏóCvªQoAMaEhöoZ
úÐyáÓ_Kº¾vì'ãu¶)6$T«¬<‹{†Ëg;	¸äZš½² -AÄpöô'¤™¿4Žìº)º G±Uï·ŽuJöCGhò	Š©m^Iäé]ÿNÈ÷–÷3ôBG¦–€âB”¥Þ‰Îþe£VT¨vÅ£xFqTìnþÁT4‚B<ƒ{ßñ‡°ÖƒŸCâ­o„Iþ‡¬þÍñÃ,Ë^`Jœ~èŸîEÌ@1‹Ûczº»ÄØ×cÛ]&?9ÙBÿlô# Æ@n„¿´eñÒnÙ=H ¦fo8óŒÕ+|]«»ð*|&z¾žÙª¾ÕŽß\§®¨^ƒ/tr§M¾ƒ0^,åÒ¿ÍŠAéŸk¶Ž¦“Ÿ3ë,v=Öw{—íÈöôv‹sû}›ñ§kþ-íbq zï¯‹¿j/ÞhÃõ·<5tf;«JîéäH•To"/Æ¨ wˆ±žÐýE'à"FüÃõ<ò÷î<áÓA‚wƒE×åŽ\,²JffÆ(jquT>/çëLŒ>&¤üx]_²Ykõa§®9Í®’NìiÆÒÞ›ˆ„o‡£ Õ1ÜŸ_æ†í¥­~ú6¬úùUâì.ö ¡I»x-†àÊÍŽIÈü¥³LA~ä#ÊªãfÄ@&Ï2ÔNø¬ÖÐX-z®Ea¡“ô·
qnm¶ÙÆ¼G3‰ ‘ùIžåˆÙÇx>ÁV=´_Ö¦L¤°Y@È€ýþ¯JAé¨TuP™îš{\õTÏ	4ô¹ä*G€œYÉ™g™`¢+óÃ5:ð-Ûƒ|ÿÍàÇŒ*ïPÆ¼75–Â}-ÍmJ`ù†ÞZFÍ5ƒ6~/¾íhàIJ	J:<"\”}qdlPÒ‡Ê hJEiÒ¬D­ªÊœûç(i¶BÒK®»Î?8•L“GÂ´z×HìOŠ·¥2÷?™
:&’¯TÆ>uFI+ÝìO¸
ô¢Ä^È-êã‰¸.¹•ñDÃË—˜t€¦XÂÇ%|¿sj7Sïîù§”5ó¶-SëºÎàíuÔc‹Y!º¾Jö{ŠÒ'¼õ‹»–Ä$yä[ŠOˆxÅX!%ö4ïâJ|qF‘({‡õHÚ+ÉüzÜÚ¹:þþ|É5±L ôä<XÜHPõ¤ú¥/?ÒÞô-€:to4™Z‡nÃi4Òek=”›³Ø>J{Z¡„+Lè?>w”õ§š!Â^
]¿»)üºb°R½,÷žµÏÞŸ‡…¡ˆ&_‰Z«õjý™þgÿÐ¡PÉÊ%âžy#Ý·9ñ-·Ág&"‡cá!À??9–` tÜßZÏ
º»¼ë*¯ý3uÍ9¡{Yqw@t™Ä¹ö–¼Dõ 7 Ëù¥Ñ&Z@OŸ$~Ò:¹‘á=˜|cÓ@cc¤½¹Ü3›=±M$'kL–²`®ž÷ÆBêq¶mÖ`ùðÙÊÆ°ÛÚE/=kÙËàvŸdqáÐÚP/@dL%¾ÁpDÁùš˜ÎR’Î°|µV†+JŽ²ãf
¹±>Ž¤>ÔNsÝDöT1õI­_¹ 0ƒŽ^Ñ9W ØÀƒïº*œybœë…›h§>¨œã 1zSˆÁ”’KT¦É>‡qG“éKZÖAƒ¥8Ã!¢L•:ç¢'~)Á|b®Ê—ùm˜„Ê¦0¹s–¬âd¦j^ ¶tºf³aÚô¥ŽdÊPŸt$5Ú@ÅÍD!>#²Ræ³œ©Ìº[^ä‡‡œéHiï«ÞR’“åðÖ2ŽºÂçÅØóUÜîMÛªaÒ¤#„ºlð÷YÉ§]°ßYÚ\¾ßþÃRáéÔÒ;"}¼í2	ÖÚ>#‘G êí›Ž»¡Ëžo§ Çw˜ñj>4AÎè~DK(Bì7œWxÇÓ#y%¸õ_Üv*®È&YÅE.³BÕäõr9±§> uP-²e±|¿š!ÚƒÃÁMƒ»Xç¥ð$ì+r‘Ö££èá’Éük®|¡p–æ.8©u2ˆ–T„ˆD7Û¾—xýn©Rn½Nå¦•åÞoKÆÌ¥ 5¿Ž
¹{»J NbÕIÎ…¶ë+W‡ß1B}'g‡u:%K6Åí(5ŽíE`Æöë81«ùQ>úæZé_8A\nqè{åšâ~˜JÍÄs†®aÝPk°Ã’]
Åòù0MŸ_×–M~§zœ¿Þw7Sœî"^@˜\j»¤àŽƒ6¡[b'$û\%–_q8bWÃÃ2 Çƒñ–;”¾ñ]Ïx 7óô½„¼g{9aÏ¦T
õ¢|lZwLÛjÆ[ú`<¨ Ã§Î2ˆsËêâ•89‚$‹<1‘Û8Ãë7Åaøª­6ûì¾òµ2Q{‘¾ÂUê¬TóCŽ;t 'P„äýaAT;¨ÐöÃõè¤ 1ñ§¿ØQ±o?
‰¦Ugp¦äCÒÆq]âoOtMrŠ‡Ì'fÞmWnbe„¦Bâ²ŒÍu}Ç„ð¥«•¿÷i–-$O–écº¸i`¢½„ç›#	ê7w>(Í%5n»¹•|'À_®ZEXàòœùêûú‘”Ãî»K`˜Åi1ý©¬ÈGÉýèZµEvx‘j|øLÖJÉUüÝ6cIvfb™=‚e?¹k^ùz4À7™M,?åö)I€^-~Ù Ê6ì*_\ÒZ³h•r|ŸìÑ«ANKv.ˆ0{ºàüË·ðTìéãÖ/Þ¡J¦qŠêtœoæzÉ+ ¾APÅƒúj¨'¥DkNv”Öi%60ÀÆXYœ°w7MZ°®Ëú€çAÀ,*z¥å*Ú¥"Ëðæ•QèÀCíh>Ì®ü&uÕ}Ô¶·ŒTþy@IÉŒ¼úñqÁ†Â«ß;A‰à[æõìû½Anâªs÷ñ)cŽ<‡æ!ërÚS:D‘O¼+NE¬Ôw#_Ã­±ÜBF¯¶ÿ‰÷£XPI¥+=Û!ÛÐLV~a­5ê„I3»Ò~F„H­/’> Û¡³$.KX"´0LòIA×e¾
h½=¦†ãè5É^ØØ"pÉ‰•a÷—ýÇ‡É°@ÖTnžªË]oÁ2Éº™C_ôýè—»'A=Ø-bW}ÜYŒð‘‹yj7Â«wÍ…Äeo0%`ã‘Ñ-tç¥ß‰ø,dQ³OiÕd”l{'(âÝªe€?)Ä@ÇºÅº^» –cŒÏÍÏ!´²×Ñ¡¯‰zÒž&š±½w”A}Èï ºÊZ´v8q‡úeRº¥Gõ˜ÅÛŽ3ñ,p«–©i4 ‘C+ ã4¥„lNÕå ™t«­R=xB¶KTaðQMàK1G9÷JÁzÎÇ…Ô
§é(kèt‚£ÒmÂ¦è ü„*uLüˆþù·:4Ëv¼ Æ¯1ZŸÌâÈ7‰´Ø{±6%‘..*Üw¯I±
		Ó–ßÖþ'8ÂÙš68óQ‚?´@Ø,jØ|r„ÑK5uH£ÿÆvá¯k!JÞ¢ŠªyÃËgÔMOðD~A¡ï^Õ±~‚²îOÎ÷6Þ\”sDÍ3£þêeH*øY„òK¡ø‘8úï¸CÔ^êåp
Ç®‘Žªó¼ãq×-´ØÇ:zrd}MÝgžgÐòšÅ,Ãk?òí'|ö¾»“–¥{¼}±©ˆ² Õù»èÄÑ+hî^…¤Œ¿HÔZP¨kSä.J*‚)”*-«€ÄéEJ{‡!ð5ÉôÛ/Æ09X:´OÀm•ª<ñ„# ¹qL½¹¬"’µÙo£úQ#]°â(vÄ4T¼ëOAZ·$GéQâHäˆ&7xWˆÄëëG0àYõ¥çDõ¨
7nß´EbDÖE9ªñh˜lYä¥Fv¢*voóÂQ§2D×<Ø…Adµå¾’m®`DÃ»žùhO)J*LEfd¢+
Pfh‹½ÄïZáü0Ópú/€štI´tïù	ïjejãrŠ|7›RÉ³Të»L‰ð”¡mW{Ê¨N4F±3g0„Þ” ‹âç&I¢ò9zÃ#»íi•«ªÃA6‘Hð,Ùè•—¡„‚®Í˜]ÆJú´åEÏçÏý#f¢P°´9Ç†^“ÛKæ¬g»ý±Û¶Ãßßk6¿`{k]v.\Ýåˆ­û:m*[YŠ ˜Eý'vâ2Á;ƒ<=Cˆ™,'IšËcÒØ¹wàç	FÒÊ_A›Û—ìAën"~ÃmDý¿Š¾{³jÂq7KyÀ)]Š´ÿ¥þµÅœ-ðî,ñ‡IAãF¨*·ÜqÛ\É>EƒÝq\âé»9¼d¶8žÎž¢¹!—ÖØãéêÒ'-E¤0õí‚2 Æ©ö”¾«›NŽ}Ië<ÅNlãÐÜAlwç/h—ö‘êw¿Ïtd\Þ"C'™‹ºëEË	žët´öÚ!š¸iWDÒXÂY™õ‘ÔpÝÐ¨u{lx%eÀXÅ
sÙvGk~eÂ@Qñì[)7±Rpp#ëx9­Àü³Ü¾ƒäÜ1²-f›‰ãÏúUmêñšü¸­ºFÒÑìV(…9Í5¶b&€"VC–-J÷ ±*ýB® xõyrî¦–.“`o.ìÆ˜ÐE½U-mYC9ïˆÙÑÃVª,üù¼JÛ…~ÈåvpNmHrz'Ð÷Ð¬ø^À}Î+6L¢—YõÒ¬ÿ¤ÎŸ  ±LX„ª£”k=í³àœR¼Wjìêîìõü‹õ±½íØ\ñÐÀÃîÇ˜@zŒÇnÕeBãß^wå²€“9 Â:Pï¾F'®i&vW¶àÒk	¢øIŒ2õO¹tÐœšÜœ”Ç€¬kF
šð¬®K°—mIÝ¥y¿j»¬¥:«ç´×¹Ž×†7OùÝòæx,ÖÌ¥Šj{Ï^*ðU@¬?D]h®0ùwµ˜¢])SmÓj—¨ØšÖÍ^«ÙÄŽñCÚ{PÍ½fÀ
k¢ªuÖÌh;¹búÀb-¦ÝÓr0m|)r§ÆpŸð{:(Áí"çE™5«¤NfÆŸPb ïÛNªY©/ÏPµV®Ä;ñía£$PýHTäèÜÔÆu¯sÚÐô±BÊ¡’ªDR;&ÈvS^­L[Sä¹ &Ž˜žóŸ›2sUá91XlÚ@ZK1³‚x;¹&/ËoÅÉå“Úyë9ûÃ¤džªÏ[„‘Š3Œ _Ðvý#» =Ë72ÝyÓÊM§»c9­¬·?Ï#wN¨ëk-¾ò#óœ`“á(Éœ@T‚ˆÏìD¸ðJr’ª?@Ö!P\¿$}6«Okè ©Ätu–…ôQÎ}ž¦¸ &9à=Úá”°ŸC{^"«‚Š`‰à¢ÕÊ'À•úÉdÕ$)ÁH0ÏÓ8A€‹ÏqÄh”§;†”9ø^N¦BZ8ntúÀß`úÞi5ñë Q9“I¹ÙSÉVBû 5 ›×ÌégZrf@ÁKE|Š]5³ó1ý_·KG+¹¥¶C…Ô¹ˆß5ÌU¥bÐöŽ}Ä¾…±ïzë/n%|xHÍ89e[»«'Nå5¢hýeuªÄ+!ÜÍ'æŽÁ­huëap¥•–IŽŒŸdò8å«ÆaØè4]÷¡HhnhÓ+5wï×Õ%\s­Ã¼‚Å0¾hôÿˆÃql ¿^lvVdWñÐüGD†_rÂ¶¾¸	äíE0šÙš+òµ–˜ƒÑ‚ó¥sü„oSF¿¦ïJhùÎ+ÔQëÇ#".ÁÆãpžØ+ßxß¸û@ì±ìAA¾Ë¬ŸÚ§h€éÜZ2Œû»-/±XN¥ècÄÜÞÏáéöÙb&v€®à`šé¬ð£4áp½œ–˜óY+'š
­K©EÕ}Z·Ü¾Düó–¤ÃèãzÚ° ¢½Tojö2u’øšR¸é0¬%ß]PZ‚Çü ¿C½332›Ô"w¿CF	&hiÆÐ{Tû`H%ó¬’]—¾…r¥zmk:óÅ°„ÂE(’–Oí—ÛìëeçNf/ÕS­¬>V¹¯YM#Â'¯ÿD…õIFéPz@kTx”ß[Ð}yJ^\F›$IP°‚¡ëÖHŽ
øþ	E6-Yõ$ÆT«¥æ9&‰î¦úúÅý™Ûy:X$¹6tZËk„ÕAjgL‡Ÿƒ
€*  |Õ.Á¾Oøôä…OAŒ¥©ê°î-ûXa9¬ÎÆÀ¸&HøéKâ›ÑÛkN±ú¯¼¼…`IÁ_2¸¼ÉFŸQÄx-™Ó^XÐn9{º¹TŽõÐìBG…\X'LÕ(™˜`ß¶ý>†Q¢ÙÍ„ g8u½°PDQ ðÒÞû¤ß  [Å‡9¯÷Ø:ƒÃUe?ÎUJ\ ª°Ät£ø)O>EåÝà]]ºœiªz7‘[ØaeâfÁ=!z­++°Þséß7W´&Œ#üÂyšƒô5ã‡Æ"6ŸgóuÙ]”Œ¢bo3
[Õ¬ÔKäó­B±Û†øQ§¹XYÜa7‚À7rJ|HàÄ'°´¶íšòÊJg5Ázm[·’¸ÓMz{âˆ¢f\ý™j²ø…sHIhñï©ºðBQÂE€{­¨Aœ’ý
Qžñ:­É’O4ëæøŽ'ž¶ötx¨s÷êÉÊ/Y¶z÷~ék*dX^Ù†,L#ß&Wlâ0)d‘Yø7ÝNû3þpâ[~'ª ‘.Ñ¿ÝÔv	éjyŸ¯P£ûûÏÏc}#OZ…ÚtY¿—¥Ï)2õP‚Dâ“—´kî"VÈ3h-Oãñ"ð\E†z¼çBÄ&8;ù÷A?.:jR•Ã„ËüÞ¡*1–Ë„¦ÝÇ$»¦z€äš•ôQb~Ô|ø?T÷|Ó€F£½"‹%G&q6wÝÙ¹9šRuE’+Ã¾Nû6[Š*¯[ñ|TîõVûS91µÌ¢=/F'nívzÏoÖFÕ‰íîÿe²’ÉºÃO°”ª³Û¯g¿ÅêJè8¥Uu.Ï_@±‚Á«‘£p²jÈ¸š…Ï¶BÔÿÅÊ0Ÿèº¸ß°~!ôd`ßË/€åX¥q^ZX§±Ìò¡pLÎØhkQ¦I½U?Õìù‰Õê‹Si­$è­Oø¯;(Y’T2eê‚h(g «†0²yè–Te<5÷èNJTá%F¶–üË$æ½µ‚…tK’šÏp ›Ô$(²°.À1õCbB©ò.dFíìÕ}zçØ/àˆuí¼¥d³%BVô©YŒÓ& þŒtèªëÌ§l¿”Õ·%{£“>uþ™üŠr×£ÔC»~qŠÞ÷2Ô€o€ñÑvZ)…ñRu ªˆÌµ|	´4;²6-¨Ê”1ÞLË[>{ÛUEjËþÍñâÝÔöº)ýnchd,©<ùÃðá4~&¹`é<òñ#Æ}éhïÛwLT«†ðÙhº, â¤43w.âÌ*«Ë¿J.zŸ0Á¡¢<›`Ã<ÒÎi°O¦»Sâž©›MA£GBB0Þô•»Y·/œQiB¤Ò=ÙšZ:ˆÆâ¾ùgÆ^Yf2Z—Ñ‰vÜ”ÕÃ®[äCŸrš4ýµÈVcàÏ*ƒ‹µB„wMT—KÚ!xýÃe?* óÆ"_!ŒâsÏNÇÈºïhÂÂÃñõÐv7é»¨êæfÐ¡Tæd­ãJûr_#-Oò¼£ÂÍëJ$øFÎð2‘lÙÈeJ2z³îì.ÑqMk+$â/³c’@séW ãQŒ¢I¢&çº5Uá¥BùY‰žÔPBÆã&oærÊ–wkcuˆ®‡^œi¾¥Qcl©¢ÅTï‹°Ñ2Y¶ËYC÷T]¹sŒûLstEw4Ñœ	ù¦—õ=¿­¸zÈ¤˜ 9Õ`ä àžxÞr²‡çË~rsÌ	'Š¹èßa„ÿø”ÈÒJ5O“ÃÌÅçÕGà!Fvs+b.ÕŒ*c¢H®>¢ÐÃ¡òÙ`œÚTè”¾¦ï_RÙ2’©Qt‡»†I±]E"2±Ê[øÞUg¨‘ë{†¿O`øA5ƒ”a^;W1VÒ›QÈH€êmÊ5ËC¬ôÉÃNwSBæí›–gàÞÑ{#:=hbiüžâžYØñû›˜ži~J*i¦®ÐUÍ¶ßîòÍ‘ÚÁƒ¶qºý˜ÝÏ#`WJÃ“ƒcáÌË~¦M ˆ‰ÈJÌ”„2/uS‡´lúè‹ÞœDÜ>ŒYêÇ@‘÷›²Cžã5
 ÃÌ$Éñ9lî÷#fùYí"fÐ>ën‰þšÐÔ/ópÄ,Ð«%÷;±5§ý,µÁ<uö€Ö›uÙ:zŒÙ•1ß`Ï'Ú[÷#J;»ŒÑ/&!îV°Š’âGÀ^3* ÈƒóÔqïGVJ¬?¤¼m18ZÌŸ¯ÊÐI:aO:¢|ˆzM÷n÷—àýêâGý†äqZ¡’®Ó¬tªT¥TwsOÞò6øŒGB(’é%<=ä}µg¾¥›óÎ¿…DwGmœðc­Z¶r¿ëô¬îÝÂ+`A;š†¥¯ÓøC#&Ýã“:~
+vW0º"‡v*çu]ó¯@Únê …ôû’’÷kGiÂÐÕï@IoÑ@Iî‘-Žô8pºöÑQ¦^ÊáŸ´©ò‚g«iCHB òÄ+B2’”¢QÖµ"bÏ‚™§Â†ï	ý/©š=n.ÙÁ@/œ?ÍY}¤µºTßpå ÌÊcX4Ic_÷½Qº}=¥–Z‹ºV±ðí'“‹^±+ž¸M»Œî8‹3zÓ8:S™’ð¶¤Ù§¼aßÀøêÅ#ND‚;ëÍrëäÛ¦·jtQ•„Ó\ÜIä°•Æô1çC;qøáK“Ôâ4‰~œ˜ôwß»$r­Â8t¸¼u’F-cðüÍ¸/'8Òá>ÙíÒwå$gpÀ-.C½!;ÑœndTZÆr¼¶…øiÖ´Ê“×.K
)Ìô°ï­0G>þ;]{öÇÅûoNS•Ä2 LïÿÎó˜xè÷Ä¶ã–[J_(ž|> R}«Ò»å$oì”ã\’£"˜ë²j¡ú‰$<sX
Â–í#“ÝWŒÀ¯q'ÖºX“?¸ÏùmIY+øÂ©^ é=Ž	ï_.Rj\’0fƒƒùeÖé‰ùB?%YcvåT0ñKxÐ•`láeç|FÈ*žä^~%†;D$|m)üÄ+Sä­Ás$ìÙ/í
–Ú(ß€CŠ5W7ÈlÐ¼O†z_½”ôã[`=S³ŒÊCcË NÐÊƒÌ÷éÛ<¤€Bë7òæ€¶WZ½ÙMÚx¥x¿ü¼—³ºå²x
D	á¥ÉŸ9í?‚õ5° (,Bä“‚X¹Ü/‚Ÿk õxÞ^ùo³YqûZÅïlz\t×Š/YÐüôý¤òfò	âD	úE>¬ƒVÎKoh-¼¼ÿî·-9V'-$Š.i(¬×'ïÉœ—0+&f&ÿùÁJðì"‰Å‡‘£Ó5EòÿÆ—NL<A…[)æZ@ÒÅ¢çªÀ©‡á¢+>°K_m.u·(ƒ¿$'Q\‚²ôkÀÐÅåAE’Ë¼ßFIXàíV4Wþmßâ9oÂû:®™Â<£oZ©Ê=ÂŒÅypùÛ}(ÄhÞ¾_Àç’w267øºÔògˆ¿3êB%(ÖH9B¯3×>´³˜L2²Œòfä[Jáq"[Fµ„ÄŠK+ßÙ±!.Ÿ£.X$}ý/Ë ôËÉ‘ó;ÂÆ-!Ž@6Wpß“ªº"³sä”!™5îoÓâ7aÝœNŠ§mk:›sVÊÔ³§¦DnžäÇü!!‡Ô<ƒ) ôéÏ…Ã*dLÇIMN
@É»àÿ{XÇ?&V8Ÿåþ[¶£ài¢â0>§Š½^¬r¦Y¾‡JôÇý®¨HñX@¾ÈÔP'@GˆÔw}Ò8?&n§Ò*„ý;jÄI‚ÿÌÈ~úq¥¸I›”uãÖkè¤8È+ç1€ÈîÄ2û}O;r4B§Ò½–íšä[ËD£Þ¾>˜†ƒÿêCì˜s7rTb€a¶Ê»‹¸ðÃÀáˆ‘|G%´ÞÑÚK>ÔšëËTÝ~x»)óu¿n>{Ú‰ÕaeB«£¿ÜoéOº¨¸>˜£3y?K“¬¬&$ª9ãbf«Ã^$JQ%ŒßÞÕìÕÉ¾ö³À…ô—NŽ\±Ì]º#°¶a°vèÛÔÙU…ónJ„jîžÎ ëAà,yª‘ë05ó¾>|`‡da6pDz!Ð6¹Y¬¡.l¢
þôØ1þ[þ9 ‹EOû&þß§@Õ
N¤vÔÚE¢Àu)aýª“^¥tÏ1Vf€°8×åMraqXÙâq2Õ:µ&qåCG09‹“‚R. ñ¸ŽhÐÖq™®+yâOD&›§ôÝMj'>G.ó ¥g ý
)K!ôø"3çcçq“ÒÆ§V=‰\Ï¥ÀÃÿºBf‡?D|³öêíØ‚š¸OÝWÓÛ|›òdƒz7Ã“¶‘øäÙ   ú‘1Îuvn±ÄD‚î+ê@ìY´g@9eÝX)Þó»ï‰Q0’[jZ÷²ç)?¢?íæé®³·›ÙœÛôJ[ô-	Æug<~¦JDÙ9¶ZR(ê=¬Þ8YzÚ2ìë=ßbC«áì|Ñ†5Æ‚.2‰/E±`*€(£ÌC¨‘ÃÒä$%²ÁXµ®ºÕFî4ÓÖ4².üg	ìôhÂ­åÇÜÝ÷/¶¬ï3îèáž 
xûâØ#<ˆ÷«QÀŽÆÍÀ	ã‹{È³e¥|£ î(,ùÆBÕ¼‰foD"ŒD!?pDâ„U ìãÑ1h»Uˆ¿\ÒEø\¿¶€ÍDˆÅ%#§\q³ÓÙ,{eTE†ØálóœéMÊÄªË­â¿çÒÉ…M­G†58AÓ{ÝhM˜’ÒpÚ®8“õ:oÄ®VýÆ¦eÚd¾„¨•jâm"$?<tâÓ)­:±>Ð¦ #	íú¬Ûüÿq±W&M…ç-7YŠƒÞféÍ½µ{ü!P#À‚^í”ÚA‰Ãcž#Öÿ8?eâaè2–˜½V!Ë0Žy9í¤ZÀ¯µ;Ú¬‚J‰ŒÖ3ŸUC³Û}%ªÙåA±”û‹¸\ß9Ç±ßú$VsÔ£ì]Í?ÎŽÏEXÞkŒ½…2{_]aÛ­°ÔûdvšqFVs¯ù5òwV§Ô‚'òÏydQÌ"(µ~ÅHG!ÅRYÔg¤ROþ„'£Æ£ø»•Ýî€Æ?ø<Ý(¯	¾‚Ö}}ç¤¿e7D·ïä·Csˆ˜ä¶_Š¾7þ\+>@WJa/’s³QÈQªš×GÉ!vºEZSü\-ÜZìôpŽ¯1–a7åtµv¨¡uiäA0÷±B" Ø« `ž‰ye¾Ü÷zÌû¨N+“W½X*i¨ íÑñÍhÝI\Œ¨Aˆ2SsÉ€qžL"'Àâþ[Ì’°`—~ÿ¸â	IŠñÚƒDI_VÎ¢¶‰åÌgF“¹•Ç9Ý†•ÿœÈÿ~Fç<úVé¼ŽWK³/ÑÒ©oñþåOÐŽ»å›”íªFðI‚GTAKŒç¬¡	Ü R¦YF1Iïì÷ñP‰Ãþß¯°†äl|¿ÅTL\Ìá–12js?p±~+îMmšö˜¸]˜2( ‘ÈÎioàûW°Å8,Ï2ÑO.²®0ÐðªIi+êS!qZü|;(3
XWîOv-m‡©[ügf•Øšíz´ lºŠ †E\Jì<ï‰ÆëÍ;y©àÑ˜¨.s©Ü0M&,)kF¨Äà5Knóý–ÓSámçã”ç%ð] }l—•˜$yAn ?9´À˜Ê-Ã–BŽ¯‡ ‘ýó-‘/dæ¼ëÉÚÔÌr8$X0”G}H=ß+àR-æë—à&£ÑÅÇE²Ð>or¢sT~–›†¶ÀòŸb„pcTþIáî®œ`Oº,½ÅKlÄ7‹œÍˆ4è‚
ú”Šaw–iFf"ewæ¦!@³ÔWSã¨‰
/i:5 \"¦5”M´a†ûCI^î1”Â¡yÕ2ƒSCB¶›—„ÎÖÔ1ÅzÃÚ4ièq•ÎÓ@.Œ0Uè6ôt»k¡”²BêpåûUÆàiå(…ÆÆ}·”tSÊõŽv¡3ISH¤sŸôŽ®ÇoU„Ñì{)-?¹LU3å‚>«NðÁ
ÀsùâõÈü‰ªHb5á¶Å¤6H—òou9«£!,ÈÇ%Që…K_‡^zËT_ï*0k#‡8oº’ˆHÖ—# Y©`Ë¡
HsP,‚ùˆ`ÔdØ½0'õçÉmã¦dò!mæHaû‰œŠØ.Â‡³¿éAqLy8î?xÃé·'ÉN€jE–š—xÍk'$àÊ¬Ý´-³Ó’bø5C÷7ø’Û¡þÖoª‘â%w‡öÄmC‹O-?¢áGJ“íÅïQ%Rý^ÇD,0ýc¾˜¸í–å×¼šeo_ëÞp¶==PÈÄ`qZ[lE—ˆŸåM½Í+Æt,^Q¶Jý	«s£¥÷/ŒMWŸcÂ=&pÔíí‡áÑ®þ¥J‘í…b¥‚¡“áÓfEdªZ¸`rm~ÍW²yæfÍÞ%Ä²SU¢S¡·òà«ÃG¹7gõu8‡’gî\¡†6L°÷Î>×WAe‡½2Ÿf~ª¨¡dí˜+ mX´Ujx ·ª©÷H1›åpN‰®ù„¬’ÕŠž#e	8·2ˆE7ˆPîl
£Ig¾@#WüÕÏè¡Œë{ö_ÒïP¾éJ3ÊuGÙŠ­2I0Áv‚÷A¨SòÃÌá#íEv¿›ÍðÊª¡ìBø„²E¹³¡„ÕZ_S€v<yêŸùŽª651ˆ`íc™•ÉiAÕÏÄ ýDá}¹Îù{‘pœÈr*”Oî˜…ö<çë¶+¦äxfY@ØNRðèð£± ®¦Üy”ºÜ‚ &}J´âðÇ¶<ÒÔ;›çÎpÎ4kfZOuHa„Åg=švI‹(r“ÕÆgyh†œÉ6(,ÈKñ'oÕõG¿b’Ñàé£H#>£9ÓÑðùü&{¥µž«ëàPÒÚ~E‹i:•8T÷E×$½¢öh Ãö üb©ÌÊ<¯çKµX˜ëÊ]"w’Rv'oæDèü¢¦–àI`Gßâ­¼ÊL4ßkµò¥åXœ°ƒ"Iîæ´þß¤É™ÓLMûŸáSA|~aRUðÌžm£¼Ðê²6Ä{<œ%»ÙítWkž›BÖ‰6qûxHÁhjýÙ —É“äé³NO¥"u“CˆQ	bÂ<Ü$R@÷A3ßìFSšñ†Û‹ÛO
š|gs¬ófý0wùò€šâi÷’ÊyJŽÓÃ4êþÃ~n*ð_ðµtÁ¶Xj‰lrIˆW2'Ñ–Gìßccwm°$«–?EŠ‚œÌo{\ó1±áû[‹XmÚö…2n.âfÜ•ïã<tÓ»É7Í:?y3ì×Ä¹<³ýÿó?ƒœ`§ž¥9K<T—S>Š“3±ÞŽpJ³,%è¡í$õV„éó´¡ÙOÄ¹ä:MBktw®A6n›í‚®ÂXˆ@é6Mý­Ï¤?.LÝ,—wàüÅîª§äèï§ Ô>AR¹q$U¤3ýaÙ¯ÍæI§ÓmÜ• 7æ’g^šl¦cƒ²îdT3”Ð†Ÿx1|Ó‡ƒniö®!Œk™&ÞÆ/—ò|eô,ŽWòÇ©>×#éˆ\ 7.é]5?ÕB¥F¾#9až›‡¡b*<¿ÝÞ[C%pêz¹­øÉìFõnhóFUDÜ@H«ÕAèD¥î¥ù†­mH‡m*Ë3]Ç„ð§¡·Ã=qÒ³Š“<Âç)`Ü3Ì	Ø&øš!Î+åvëËæv"¤4{OfaM›G9^ÄÜ¯%ÐPþk'ê8¸:Ž2ªjò‚»NMc×Â.ðàW$‹DÐ?O÷Cî‰u‰{>'4¢KQ°øC_L®Æ5BÔY† Á“•ÿœC÷{£ŸíÆi¤"Ü˜rz†-71¡	ÿ€ŸçŸ	m?Ù{LËZfS³“s ¸jªñ‰À>Þ¹ÞÕZ‚m‡âù‹	ücf¨@ÊÚB)ðÙŽ8©‡e¼ïhÁÀNèÅæÁ¢˜*í{:h‰¢t@_aývý/•t§³TÏ«Ybº©" ÷ŒŸ²PÛÕ'ã{ðÝ=ÊûM$ÐþRMN1àWDêµŠy–ŽÛà­‚ÚÛJFâz]~,²6RU¨8¤f,àíÎ„Ql~1ê9Õ§«”…ÿGÐØ<u×ÿ)ƒ\ÎÐOäpôGY2u‹ˆ8ëÓ–gyo¼Öý(Zv¼¤g¾£{»A(6ad§°²è›…ë•&Å¯íQŸjû0¦«»æ¼ÅZ»6œo	 á@bØÆÙÊ.fµœÜGûÊ[ÛZ!`±JõÇC“L¸Ú5|3  y-¶+ÑwlÝ¹Ýš)…ÌÌñ!ÑäfÝxýB®ÅMëKTQPe‚Úä°sÓóäßð¾-wSÅÐðH-Ä:ÛKž³1%òj”Ã}‰çä8=lå—÷­s_f…·J:ŒáTÉBŒH—\7]âçØ¢ÂJ
6cS©Çì“À€_ó;Èß`Õ« „¿}w«0-Pcîj!ãÃˆ÷K0çK»Ç1æNî9«ÊÝ»ªæåÆ# y^ÅQ&õ
UKÜ .Oí*sçñ×uäLE»Þ¹J°ÿ — í¶ÓÓ¥UìqiÞ†DúÙZ•:ÍÔ>.ç{ÃóW .â›ÿãB¿ÊJóF³ç¢%éì`ÉïÄ`$lªÛ´ÓâÊñŸÏ4¦Âò@OjWŠHÄðY6¥ÍËX‘ÎØ¹`¢ÎÂháÐOéHýÛ'lI$‘•æŸø)D==6³uNa.ÎwçB
ô´ÛÇÎ¤
1˜+A[D;(Ù±„Å‘ÞAGg³QàW7Xí£yŠƒáå>˜FŸŸÜ«cØZn3ÖÉ}Œû•ªhx˜çt”Câ;!Å¿D‘í¡)víPò{¬ˆª'ãA>Ô^¢zO(ô8K+šÛœdÊa¡nhm&ËZøË¡5¦Bõ—(ÝG’g\Æsµ‚Ð§Èp	KŽ©ë*'›Fâ¿-³¸ÌoÝ_Ï°6É¼½äF¥8JŠ¹•!°§Íû|ìÇ±¦ýG“9©)ÄuÝP(ÿóAW£N=‘”ýý{óQråË5Ù?ŒAè#"[Üè±˜ è_uàênêuÃ®dëªÀãÞ0!«<æÎ“õì¼ÖŽ%Ï•Š®1eƒÔ¬.x›Ø­/â¹û@çëVy8¬(Ö¦©€ýÖ1æÕ_ðûU¯–zNe
_<zËÜÇ†Ò6RÓA“yÏ¦“Å (W›Û
ß{æc2
ÙÈUßÐ#a1þe’žÄ‡Ï´É\–/~øÅZâY]tn/Õ>±®f_xÛ?Éx[Œ8rv”!Å³1ŽLøŒÔü‹öX’sÍ²èè˜ya~Pü:ØáY™¬—ûëõ¾çæi»f8DgCJH ÕuJ•ÖÐ¤ìÆžÃ^//•ò6†pÈÚ ÂPÄr0žõ¤e"ñ-iÒhiSH_h:P¦m‡àíØ¶J£Õ}´ê#‚„fÔ&FžÝÕË"ª·ÓVÞìÕú¹š-‘öï®!ó¾¨¾záX¿ó:mJêÂÜxäÃ,[í¹Dý±$ÔPÇ"M-_6Šý«Ÿ…r».¬ø"Ûq2øþ&0üŒefÏ-·íPÚ¡¨#éÍ©4Ú¾Ê““õ¿”É½”êS¡°‡éC÷»(|šøËWlÇ_Ë_ágvñö•]Š+EWj°Kêå-‰§ÚGí	Þkº6mæ`4aA‘H»ŸüE„nB.îí›±6¾kkQ
êçyã?Y,ÛŸy~n«ºÚÔ¿Qð¢‘[ —²9;4KUÊš¢§¾ôtžÜ©Œ-?[½¼Û‘”&ô±eoò`Û_ÆûOó¨x–z_ôÐ»…ušþõÊÕ,ëëêÁ£½Þø*bŽ¸{`Ôµ¥g&„äOJKÆ³OJP@Æê½Æ
«R6;Ý}§þ¼ú‘îI2ªÇ(
þEÂÞ¾(B§i×¾NŽEð>Ô¶ûÞ°³½,üŽö¸ÍLùqé]7…¿c Êl«@“9ØR¯HÈ¼©C;	b^4Üe= ŸXßt’~]Sn˜ðË5u+G-ùÅ%[0g8DøVbO"Ò²Œ²uÓCÓ°}¥@n%mjsyfBÀ°>ÙÅ\Ïvd	eì¦NÌ2ý~¯¹¨¶"I†‹ÊòZ›¹ú„É,‚Ó*ûGz~
ŠkÝÙN\øÕÈ!ãÓ¥3AÏóLœ'¾ZG-–þì¬4ÔÛ"	´gŠÎBãª@ù1ÑÂÞŽŠß}ëÚ×uZ‡¨„Uf\Hõß1Öòlu@¢óW ùx¼à(€œß¸)>úÑú+"ƒ[·°|÷eÝî·ªò#•|ç™™ºa!«ôo"¾D€ä†ôû‰\¥6R|…\ ×!AdoaL’•&Ù‡ hÄmÏnqeF1KYýA|:?o+ªËØ£}&ä<Tk9¯úÆÅ7±,ÅÀ«Yb-Ö†‚5y¾(Oä…Ât·Ë²,lA#ÅnÒè‚e@Ô_·ÚúØßÊdL™ßÉ»q¤¤ÅQØæ2Su²éåò>wþ!ÓëX²íY¬œ‚CÁ•iØ%9%{}>àè‹ÈÚÛ0í€l‡”€¤˜P®¤!Ýqí9t*te‡a±'x‰×Qø¨¾koÛe@ŽP›æSL÷15ºI0åý€(âàÁ0Ãz+5'ëÅ}Ì(ZÍ%xþ…RàÇÂ´ÄéBwTu9b½²1›±PÌ:qo‰Í¢½ÔmmöR»ÃWwtXfEŠŸëj&¦(+9,¨§6ÂvôÙäAŠÁ(òª‡i:xÐ²ïàäÆ»ÔÀ
CÄ7ÌÔ)BÏe}WÑcèw°TB{Å°¬i	'X#‘ÒN9djwäúämîšiôh\zøøjÖãS7vÑ¿áxJw»ÿU6Hp–/#ãÙÊ]¾ß²ÜÎî€¿l‰rsƒä¡Ü¨‘šv,÷ç–‚Câ=c.çzjT”*&ûkneï¿cÝ»‹uïÍ>»­nL>¦i0yøÔ}¦Y¿7¤i5ÎãÕönÁöv/{zT¸ßöš«µêVÎ…˜^ì´òBìÛ·µ¼ëÑÜTHŸBy t©w%¸ÜÐñíG3Ó˜A|#ûá˜e:ñsýÔpCðÝ¯àÎÀK`%6€G”H£ôãÅ‹³/f2‚Ðˆ…%TÆZÝ(ž+ÃôÝUá¿›í­¤àüª7VÀ×Q[óÅ‚”&eQ1	jª7)ü,/¬y“ìR†é®ûsy9‹ìš4bÕ6W«y½wBÜH}üŠV5ÞÍ±c_ùXˆÂ£gmØô\Qk¾
 Hƒ5-ùî|ˆù‰}Œ‹Ð|•Ý~ö|å¹i((ÕB˜_k¹Dx5Ö³Þ¼'#ÎÈ¢—@§{üÇÅýl¹d\ÆœTö%Glóõô\R”XNÏö‹÷¢ƒÐ¿#Ã»¦’ù5ÈÄ}Y­TØ$
Ifý’ÃÊë­ÖAc¯%ÿoJùø|c]01s34Ü,zE¤íqMÝ9v^+Ñ0¶‡"—ðìoqìíofB…|÷rÏÁŽ¯AyÀyáuouÛoá¢6ß4ˆ®Ãú2j]§œ¦uL’Í¦¢é„kluNMt¤ÈŸk‚Ão<7j¸®B—¹QTåÒTÁù²ÜUæÒ{0¯õßÐ,GÅZ[«´î ‘–éíÃó¦IËYâcd~&*Ï^_v1úËŸçb—ø àrÆWÿ[@Ï‹¤ éõ´:¯B*<cŸ}Äù=vùÝ¦™B”†iwÍºœ•Âj†;¯ë@6ùº7¨o<¹T¥íD6ˆ%sê¼’ÿHäùïµ`£xâòTèºUè~ÇzªáÔ9Ûè6¬w§s.ozŸ@‚•OÐŒKˆõw6è¥§$™ÍµQÍýP´8ËtèKòžÝ’’<2 ¤Öº½,SP°­'ºÀ8F¡ÏkùÙuBÕz'¥_Qen|û]`4UWálÆ¬|ÕÁÕm£n&%(\M½Ù©)©”ÒþŠÛÁâu°‡ë\¿œ&+V¿è‡¼¡,W¡ÂÛœ“K(Í›Ê‰:S¬üëä4YñÆ§4YPìªÄÿúGIH˜.…½XgÅOZ¢(ïŸÔÏàæàt8îÖƒc}ø§H‚Š&‡Cø:y_ù¦K™XÛïõ|ßö]”ƒ<òˆ<m¬Ib-±ÿ‹.QŠ™a@®Ä+´ÄgD¥ÂV!áñàó<eÒôW¦\Û3\i(‰ˆâž[r­cé(…¿‚XjøðDîyº[õ‘aŠD|/¼AÅÅàú‘U©Â^É«Áyãt©÷*
-jj6ÂCæã’„w(Bˆã¬†#C²}A¯C¤mh·Ò£·†y¨iºŒü• œï^AÅÇêiævr¶oÏß™@,Ä±ÐÀåÓ5®+OX?pã½¶C¤,cþÃY9GgU…–<2I’ç¢T@\pi’pyþ“þ²;
)´jˆ6ê¹õ`p=·#7±¡%\ÒïÙ<O¿¨\9³DX@ògÇùêÐùž$…þ€„9…C¸M¥(špAaŠ»ËªPàpª-ï¢Ìx¦g¼•‰vR‡’G ²'O“¤âµÜ‚ðÕ.~ˆ8vhDXp\øÙHw²áïK¬]FÔx½­ì3Á`VÚ÷8Êßá½™£ ÜÊÕ–Õ.YLtF‘×B¹g³Š¾Š“ê´j&yËÎá ³-‡©*Ó'³pu*T½Ú·	çîKÖåý÷T^!‘€"„Ðÿ‰•4v’°Øýù_NŒ‹H‚K«À°A-m×ªÌ&Cj˜U«èé3o)h>È+£<·íFa%µ‡£¥år¸`ùJø­Ý}ŒL,2žÔ„âß!œµá¤,ŒÚiâ©lÞÂ¿&µ,wÖçÍåS¾+hôº‰ÿÏ%žžÄÕ	¸^d_§Ñ¡¬³be»Z½HðRüä¨;Œöðæ›¥R€€ÎtfÚeþÃÅÌïÞj(IÀ"ç¶ž(@à½?b=¤=ª¦#ÔŒSYžêGá¹SDÑH¶†Ÿ+!¾â£‰X¹+vYAm[mÍV´eõujÓÃ¾™ÈyA¯óCz^¨GPUÃ¤ÛŽ‹é”»ÊäúâêèµÃpÚU¬Áñ6¸/¦Ï&(›×JV9ÑSüÇSrI½òaï]3y˜O\ñnªŒÃ1ŸÂP?ÕªÇÉªšôÛ¦ú¸ˆl*ØæÏÍpG‹Ðµó5¶ã¤!ùb¨Ý
5OfŒ®×~£óQöÝ0ð#ÛW=!··°bIŽ^y?ÕÌräs gªù¬HÕÝH€èè]çåLÅdNøµ­X*,KÔ$AÆ]|1Ÿ,Fn\ª÷¤Xˆ{¸ðó2¹·+%¦:=è°‰ÞVGO´Ë×Õ$žâ*¾™`!|+2nb<ß«ëm¤oñHPJô-”ùó6ÐÏî6«C[g#\Ó¡M§w(³gÉÙxÎ´g¸d+`‚yÒYOƒ§¯˜V°‹{“Çøf÷Žª (x„mÁ9a¸Ð£pýgº“&z9P—r\e©Ï™×‘qà®­IwÀGª¶6µÄ¨,4X¥d©}½YtÈg`/5ãUÃ@ÛàÖM«c¬ž –ßÓ·“Ø,)‰8£Å¢65ü½*1T4;‚hÞNeaŒ]f¤vZ	‹%ì†N›£kió+}5µ»«lxÌ&)²Kn¤iPfïµ23AÇdïÛ’ÿìs"¨‚Üw†¢iqÉ/)´­/ \Àeu€å¸Ò}õ¶íL<„5HB‘²õ¬ŸhÜâØ²$Ž—wõ!IƒJ©»…lé‘V¬ƒƒ·Æ‚kÇG@­YtË´gÎ>ÞãUäª£9Z¶ÏrE‹˜nEµ	FóEˆþ¬×j¹‡í Ì&ù¤[±ÀŽfpP:ÛVi¥ÂíHž8q³¿6ÏjRŠ½EèêŒw§þ1?tÌ ¤^w ŸlÓL[Ìu|A}oÔu…É%v*dãž~_²(VW°y ‚•À€Ì÷³úÁðÐî&šðx:¤åëIû¢ö¢–Ž‡œ0Üë‰\Ï+ògÁ'¸K‹Üý­!—1Hâg„·z²O®O×rš`.Ý®þO²¯tÈMÜÜá—ä‘‹j]©Óv	{ÀÐ§ëHå\ìbn…/¶òé¯ßã¼ª¿rêÑü¹JŸCtêÁ­ryIú²äô‰ÌùÍjJÉ”ÞóSºÖ†80Bß£K| ÖÆ r²«Çqþ¬Êf÷zÝ6Æ&­kÀ 36ÞÛ¼ýÝ½*ð‹\t+”T<]8e—$º‡ëN*JözüíI…ð@Ñ,æå<Ù¼<ÕöžÎ¬Ž—@•øjþ~^«aV76òë2‰Gp[ÑHíD£§SƒõÊ…7ÿ$©ÿŸNi$‹Þ’‘üïcøÃ—Ü!ƒ0fá7½Šyât­hQ/~µÈ¸tLÕs<¾Úã{>	 àóž¢t=—ù´mMI¶\ý·€/
#=[Y£$[)òó‡þ‡>ÀWÔæ®—XçkeRžÃ¶a'h‘òµüj }ø#$ˆ.ÀnÀH—=(}¬®¶ÈµsÒ82®DöÈË/dñOÅ —‰©]Ú	9þ#Ã¬_J;¸­øüô5ÞÉ‘Oˆ§I¯Kü²ÕgqŠÛùÄÁœ8g¥{¹T§LˆGb¾·¼Û4hÓ«ÌµŸˆ¨É°„,µ^Ô’ÝÍŸîWqù0Ûû©è0çS	þ#Ï üCø=¨ïV,´ÎÃŠº£/rô+Ï´1Yh¤=Ö²Ù$Iq@‹Ôø~îh®e5¿CDDÕ­;—HÏéA)Œ»’Ì|ŸŸÇíL—²Ô²ìì¤»Aü"ät÷Y"ÔštÌßŒ‚œ˜pÝ§ñ„p¶±LqN¸i´·aBó“jÑm2{€Å˜7ðØ”ÑàK„ºéG~eGÐÎÑáRB›íáV [}±zí\•_~â"O9`,bëFæ :<È$ìü„œ[.¥‘n
ñ— >J·¹J7²©8vŒÃ„q²È7õ5jí¯ÞÕmeDs	ÐÙ"\$ªnÈSOVºhÑÍ!ß>*fQZ„d?Ó5Ù¨Æ·Â(¹BŒÀU}ÌFŽmèVÚŽjb–=Ä!9ï¶@C_WÀõªók¼î²*\:¾ˆ;z©-l©í¦‹0ýÇÏ`(^jX>IìWiK—
V°Á%óöüÍHßZå@£<3HÎ˜[½¤ÒÏÉ¼õðµÎÙ6DL¯`lK|<L—1Ý“?ô	žtzŸç4¼T@µÀ ±/<‡]ðò4 U‡{ŸPª[?â~[v'ŠèÈëu_3b¢4o-ú¡ög–8É4A‡.à^Æ&:xT§TO^ ›¹PÇ{ÓoåI•ë+¸ÊB½ì¢FÒ±îeI\pv%W>çÌc]óa›!9ØDÐ|Wmª€AHù
:Ž°rÖî!Ï÷›¦ÞAwÄC‡úŒì{yè¡¡HiA³Å—ý`€¢íûßüzKfÈ¿vÝ|ì}D˜(ì[0=×³+™/Ì&JÐÛŒ{9÷žÆ
ie¤°HóïgÆË*ÔAë—”ûJ„ª{ÎÖ_ößÔþ­ø{ØY™ð|šùŠWÚcez.PvûUc£ÁÕ¦â¦ƒÔžçT’Æ“ úæ¢ÙÕ¼ìh1ø=»µŠ,¥éaR5{gë\‡:…%ªúdÝ¯6ÔåE7A1ü&{•ø5¢°íü:ý±gýØ£î"»¯¢%¾k¦WŸ6õ'Ü.³|°øš$Ô"eÀ%‚R[oTP’ÅÚÙsš¬ôsj•¶žÕPL`ªÈÊq6îÜÓÓhÒ÷`ÇV‘¿2'aâÊµdç$“?‰ ¨"[‘Òçã×_¨c’TC—a
\p¥¼I¾›Õ–V­ArðïÒý^7œÌuçpóU›œ³`4+¸BªvÇðC<‚XõPîÆ±É¸Š6QéœBSoa A[Ït&ª‡²¯â\p_Tu’ÊRêißÊ­&)Äë§D¼‡xèáwÿf¸…<+Â¾S£¤A{¥Üú˜+Oå}Â'_‘e¬Ìà~mÃä„¼èÜ³¿©™u…›<%d\ncN:Í7=2Üˆ_@Ê•ùÃ$Ñy·þwÉì¿!ÅÇHî~R{}àæþé«Ð’DûŽêÁ8^qÀ4JÙ-ÑƒÈM\1ãæRYCï07t€üŠdÏÀ‡†ŠP>v˜>È{†þ‚¦ßõj¦åuÌlá;•`C§	—Ÿ F ¡~ÀÔ¥nÞ[)ˆrzúqOm­3Z …:3MŠ‡oU÷y¯‹|¶z”aÀëîtÏÈÄë¦Ak€†I>ãïeÏ}HØïÍƒG%+*’y¿ä45´+‚xcy
{(
±Ç†Öã§qmVÒ,ÆèŠ¨]ßQÑl
åÄJB,h¸%O¸*–>åÎç¬Žk³È³=âàûAÒØV7Pð¯ZÓÒXU#ý˜-¨f~^<„J¨ÚÌñÚ­Àù<j×¾yôy0ˆkT™“
µê´¨»¿/¯íÿV?šî%ˆIÌeIŠ±‡Š	­#%ÎÓ«Ï/fÊµé@XHª:µ]E¡@¦pù¸¥0à§ß[˜‚HËxSê?<wÚ®Hua·5M´Žªæ6ˆ¢S.Ê‡Žù¬½©Gyùº¥FOø&ÔáµQ0fŒ"RŠluð›‘µÿºŽ`…ê¹Ã=EÌØ¿0à€$¤D“©Ñ© ZTè
½¾¥Ü¦N¢e’oˆ*éÈ´:?ÕVˆ¹áèâx©[yr‰©ŽÝƒ|–ŽEK¥úÒ’‡¤ŽZÚùú‰ªP‰ÉL`g™©sy¥p¼fLõí7cv—X"è]}jGª¯‡Pç<v:ûž…Ò©?£‡`5Ë5
KŒ­ÔGCI|ŸŠ2¶ý'è¸2Ów¡Â£_ †Ø’t$$lz3ÂÎ·|ú±a™blfŽþp*©ÜÒÂ~ºS:¹ÄQ5*æ‚éGÀ>ýW\p»YÌõ´çÎàô4·Ž1íä:¥V¸ÿ¤„^.wä-8´Òý }Ûý7¯·î˜¬ç10	…ùÈVŠ-fè›ØM6)¶^o·ŠÄÓP	w ƒ´õs)Š6ûÚWºRBebk¨D‡Kc¶¯Fz^üaÈC­„Èkc‹ÄC-S”ëÑMà3BnêèëáŽ¢å»Y|ñó–ÚÖT–áè«úKµ.”	|D±LöO`tôOônÓ©ÉWšÎ@ín¶}­C˜•k:¡/r’éá,ŒwñNDYÎG&U7ƒ—G|\i„ûÝw¦`j-­V$˜ÑÅ0LZŸ„r}}¨Ù¤Þ +.¢Ä¶Ét§©@÷TKÆø²ê7&+g¿ZjNÐýþ)%"hiÒ		¢ZNqA™“ØŠá¤Á8ª5 qaÉ,áí<±,‹¥,ˆ5'M† 8û¬ÃÛâü”
W“]Ýö¹ª'¢¼–T„O	Ô)¾Z<¬¹¥ªì~§G'òuÄªx#ç{âLa;¬¼ÚMÖêu6änJd3…ì{Y$kw5<ù†¼¸¬¼àŽ¯æµÇc—*Úp, 0µ<í‘ãñ7¾qÆsüÒìô;}Y^ÍáÎš<žI‡°wpní
]]uúž/g¥`NšãG¢ÌÒ#×A†ásÂ¿‘F·Æì˜€è@›…'*_þ6”Ë5”s€©ýÍW-dY„h(`ýd›ªÂé<ï¥¾Íáõ«ùh§Ê×Áu™§b˜f$$ÄOÊ€z_ÖqµÉüªdè3ÖÐ¸àÔJIÓ‹»¦ïÅÃ™1Ìïø›º{Y}¸aˆ]¾c¾"»ŠV¥î°èšÁže-=²4^h¡•\ÍA€ÁþºÌ8!ÙP6¢RYþCi¬‰¿dP2§$“bã
G&Ó½µlir®s Ô@RÕ³§­€hFìçf_n‡=¿É vu¡™^¿S«ìâˆÆvýp*”ríºHþª—[ë ¤•Hœ%)yêrõ·-M²©GéÁC}¨5ÚðB“ 2cÒ†™;‚ø¢½¿Ö›œ/öÒéÐþåÍ@¯sgŒxî4i%Vºûïglå¤Ø3µ8u‘Ýýrè ¡¢´Rg6N®˜ueààäóÙÖíÍp00°6¶q‹ØIä´ógìoÃ˜#/fídP}%KìÉ«£âD`iP³P[ˆêÑÎyNj­²±ýxO9Œ_0ëà>"’{’ƒi½0‘p‚{¨ƒ”F>BðgÄ{ðAKñÓrŒö­Çs°³úV¤‰É$P™¦\ÀöRÖàÜ©Þn¥]”²/¼·P[ª[0{•ŒE#ç”;ÉŽÐ^.õLŠåÄ2$SÂJtòï§…ƒ@.£ðT2f¨èÅæ!¾ew8M—Ô¦ü¢Øä%vÀ³ÁmÝ`su>¤®÷€Õ´„ŸØI+;±ÈØ2oªqßMh~öžâØ@%Ìò½>Y?xxÈ[Žv-¦.çÌH}B÷îJîdBÙw’·GôU	RÒ‹¹uú<ˆa¿“?b`	«ü:ÐCÒ#x«$‚÷p­&€oˆ¯ÕA“ß"ý€®“>×²gO,ÆÆu÷3…†²5¨r/§ñ\x3©ŽžæêÉ¹„‡7º©8<uÎ¹§u#st)€V³Ñ›^ã˜Ö¯ÓnzpGÁC†$é_ì]<nY9µºpßÍô âp?ïx¹™EU”rÇŸÃÚ‡ Ùé”~mk÷mq-HËm{ZE€Ê`²ò=“ýjÇœ)ç‰Š‘©‘+VtÏ7zzôkñEuáÞªïRcÕ|ÄóZÚ¹Ÿ¦ƒ–)ºécëçåmöP¸˜@·¸Îj}È›Aªmœµy¿0™‡*(-¹VÑ(”…ý×`ú$ß0p”»?µ[bGRÛpbT¤á#¦5K~`¶¿è3ˆ4†F¨©v„»<H¾ß‚êŒ„}±>dåž?Të9á^ï>Ó(å‘_>ø#øì"B%PˆÕ^2Ñ>çÒ[¥ŸhbLP»0Vg^@Ž‰½ek	qÈäŽ$³8úløPü0cØÔ„Ã2Ž»š†Ù8+¦KÆ‘ÙÇÕÏÂÃcìî …1FçÅ#¤åd’þ²1¬xE½¼ ¡ã´¯SQ`›RC`—ó«ûóp¬R‘ €løõdGÌY]µR^´áâºÄé¿SÆ:m€ÑU‡q©þØÎ{D÷&j‹O×àát-&y?tnÔù,Uûº€ÆXîË?Çð‘Àÿ3.Å#.Á°ØT¾Yåú» "`”>òS»Ì.BˆÃNUƒî^á{œdy…¢_¬\J%àª"Näz,-û¤[¿ÃW÷SwÈª¨{Œ.bxCGVÛ‹þªOŸÚ;9ÌØDtž&<]˜U»>©V¼¼¾*ìÒ~Ö6_ñá'&BÂÌËêÙ
§ŒùÞ‹Õ¸2dQÓýq8¤æWt·Eèã’®*ãÏÓ9]Prý@ á¬ªå£F-Ù!<âKˆ1'Ë÷›NÍÍÛ´Ó mbFµ»öÇõv.ç28×nŒS'Â®gÀ(CÅ/n­¨–H{aú2	Gk¤‚j@µ@ŽR)!sh^Iÿ@øµäIœ.ïÈK¦©åm·íÍ;`ÈÂš`®Y
­Ü3-"ò¶F¬OsÂuÂÒé‹iš„]²¾‚ b‚aéÎ¬¶£4áHíšèÇ9£Ö)6zjKYôWùUNŠx›52k‚ÖkEDfM¹š›òp>–8‹SÆPÿåˆÞÿ¸gËˆ&B68-6… }ìŽ¼Ñ*IßGíƒB4Óg”¿Àó_ñÑ[Ü!VVîèÎ±3öyÿ*~?®q´‰™Ûlp¬W
Ö{@KÆ™vÿ›*4íº2ipòÄ'[å&fÆ"GÉ‘Û€|l®uY¹BÀx¬ágñ[FáÝÿø²—UÞx=çŸß¯ÓóÑJ+Yž¹k²×©ý-5Àð¹]#¢Žˆ‹0-^ÕŸË}+Æ
½ÝEMqÀ5³tÅ÷r@Pø+)‰áÒ6”q
ŠÂ±tÙÀP¹3yv',ã£Ö6tÊl-Ù¢½È¨Ýÿßº¨à¹9âÓ^atÂ„Œ¹Ô?ÎQA­S…Aö@ó±{‹æ¦‚qjÉXÌ8ÏÐÆ±ÆÔÂG&~™×óz»JdîšT—¥8ðƒIŽxT”¬ØéüaÖÑ2ŸTqz PìÇ—ãŒØÝh¿MGAþ>P Òôæ\7Â)^ØW±¸ÙAgðcØâü%°·v¦óÔ^°þì»¿‹û²;%²‡Ð}ÅA&L?JšŽà£j€¾½<¼ÕŸ‘SÐÑ@Úå›¢ë!w8@KØ$:;¦qùè¥Tí8PývÑ)(ÚèßAiZ_LOê,ÅÔ˜ˆI†.—rQÂtB‹Ý\RšÃZ·¢30·ƒ^#M~¸V’ª]÷š„é=3,ï†Ãú›ƒÄ‡S†z´X/H·ú‘­¬>—#ük|¤Ý*%ôKk4?aòˆj“Ö§]íîÞ'eeŠÛPß¿Ë²îh¤š¦ü’a7YD
Æd\ã•Uµ¤(YQÃ¢Ô4³Ì‹Û_’’né {GyKh—>Ýõ±¶Vë‰~oˆÂåp^ÄßfÖTùÃ%@°’Dç÷ò3ÉÍwßfÀEç<^/uŽK{þamþArDT¤,n_¬±a4[œtË÷ù«ÊG]]ÔÓš›Ô÷?à¸™^bÑ‡zœ; Ã‘U³HÒà\ª©[C¶,1nsŸƒ|9©&û‹²C*9ìM6¹6"§**Ö>›Zò3Ú¬é²ùâ\ÏÑ1fß”h`—*ôV!ßqš0HQÀ°ñÌ…žjlØ’²Î®ƒß¬Í&ŠÎ0Ê?¢É¬†=£ùà®Ÿ¤VmN³h*¥­‹Ulk`C"Š{¼è¢u"C‡c“¦1ªöiTåþoöa„ÑøÕ¶µ”ÁN¤^À¯@V
6j¹WW¦ÈÕÍiˆ¯2Y™‹M„<¤À‘–+©yÈ;rØ§SšèãH®®#µÒ}ËIÝû¶bó:ùuˆs¦ÜvjH:¡#4›”×8dš”v°½Õ>­;Œ?‘åÁ´¬m»ˆíÙ­v´V°§Ù°ù»Dµb@þ[©“¦‡NP=1:áÌÁÂàYM—ûvôÛøX{m^cÙ§ö&BaØ…Ì@ú¬2]ï£a‡é}ÅO¼±‰hûN·]ÑYfCnwIŒ!æddP]/ïOg7»›Í2uêù5ET˜p A]}w°Öx\W…gëËå	´{‹[t¨R_¤í–·9³´>!@GUiÔõ\þi¶š]ûÌþ'1Ðìb-@Fçvûƒí7fÃ_àƒ¥~Æ‰PÝÖãÅåûeóëÌ“¯»-9'dÑ,4™2Çøœ!mQÔ¶¹™9iYygÝ~õö8$lÚcj\õ'-áWdG´;<…6‡puPfUTæÛž.Z¼›f–*Ì˜2«w·ïãr¤æÿIÀgÙfh¸ù5w~
±áËUM4n)óÖloEm¶C[4'éFýë‰;r‹_ÿz’Õéó:d5³è Y+Ì
nÂÿMªÓ=IÈQ.Ðþàõn^8ñtÇ[èO¿ÅMO^Šþâ-]Å³+½ð^<­ßM³‹Çà”©ý@aî5”ŠÅ="¢³'±++äô°&³$PÄh;kî> H•%ÎZ&qáŽ*þÿ(øbèŠ~86ˆuä^S¿4Lº›Íèl
ññ	4-ÚRïáˆwübÃ<œ0Ö}8Í}z’ƒ Ó$Y£  p¯¸Iñe>Í›æ{FS¢s?š¹„œØvôþ¡¥l•CÎô2eÜ’Kõ-ùiþæïš>Ž!¡»„b„Ûú©ä°J"ýÒbÁÚI¶KÓ¾Q‚PÄæÎ§%jÔLzaâ$³/}~Ëê#™‹¹íÔíÅÃ‘~Z`“Í‰4¦ †g6Âoÿ«…›~ín¾òFaäåMµUK‘l Âhi¢Cj° :J±ÆþÇÅ°º&z÷ÕkZT1–rG€}dä™åÈgLC6ôìs,³¶‹€}Ø¶þoåW£½ñ1üàb‚§=fžTpRóòÂsÖqMaãWHAÅ†ÓãOö§‡¿~ñ3ã7éóNõ
 @ÅduÒ>¯d•Z€§Á™½®¹èT‰YiÖv¥•ˆK.à äcbM•Ž)E
–¦o†*óÿ^… —0Q:×‡ò×³´ ê˜]—3‡Ÿ2œRã;¸TVäZ†p ðÿn‰ˆô3òhÌplqÓ4é‹¼šXÍ<Ä”7¬œƒ{Ö’CU×ÅªHï"áÍŠÃ€Ï‹ä=^hŸäQ*ð ¶_Ogi$Gæ×ZØXfÉöáŒùò˜¤cèn‘¨uUˆ]®M‰ªb¨¡õ–^˜eì¬¿c¢S.bè®ñ `fH†"€ð¢p›9ÍU‰oÐÖ¼»o÷´—/Ófg†·fwRlìS‘Étj]À¼Þ?0P¨³Œ§ºÁóëÆDÖïÉÒÖè·†ÅHÇÍ=‚v‹2‹\ãÕJ¨NæƒÜŸ/ª–Úœ»kd1¶!Y”ÝÚ²
¡«‹œýš‡§³ä?ÊÿŽVAlwåðõ›qAÉp‚é±Ö1CÝ†Ð ÇÛ¦Úž98ì93B°•B‹Tw×;Ò£¶C³§~ùÃ­aÛŸ´ë£ßz8FN»j‰n+tm‡2WúÅ¢ØSÜ{L½âQƒ†•î”ü«gü–M.myùé,þÍ=ö³_E¬ê#¬t¸{åÓÑgÔ9€»¨S>#€rçº·­øçãçˆÂc“+?‹¤}­_jÿaé”nÁØØyù¿þ—hÏ¤…ªAh­Yõ¬v¥¹RŸ„“3+•ŸB¹~Õü$×@¢9WúàDý
Žû 24nµ©ã4LÚŒCÝ8MTr¼\¬ÃKénêæÉ™ˆèó¦3T·½=‚©#e_pj×÷¤…ô3%°ÆRîöTöEåªÖ¢q´A‰ù£%Š§ásìßmƒ)?P}¨“WÙõhÒŠ¼Éã¹/ª˜É¢Xh‰˜y~ÊuŠÃ—Ó„J½£:§äVŽ¬;1(•k¥oÉÂesêËô0Ö´eêÝŸí÷VöUü¬´0%Š¬Ô¥aÜî*·Å=ø&MÀm‘4vÕHxéMïH\åYPup9N^ê‡Ž_3E¹2<ÇœÝŒb›òšA"TáVUïEXhÄ_F·ø‰ìÏžQD~T‚(K!å.’x[ør«!ÓôqšÇQcéÔØÁ5‡õ(FfH§R9ÀK¿7ÓË§S'r¹m*ÛD6šÝ½'œ'bK2‘&kui9šÿÿ¸0Ø:ýÛNMÿ8áÇx 5,“³4Ó]ª	hš7²~úDÓå>,=½&xbzþdé>Ê+œ~A­03^%ó{öÚ—EQ;¸ŠâÃCÓ¦*ªØkªDáãËÛM'ò:_5\çHÓÙ0‚´ðNw,ùýþM—¯´4d¤ÏMU–2„Ý4pÆdF$£úÆV«?3û–ôÌ
%¢6a(Êæwš<É!´×ùoø†Of§S_¥n¾†ýñ°Y¸jÊ—sžH½‰c°Uj	¦PmŸ™ð"É*¦ã·¯7ßŽ~¡š>WGƒ*¨ë{YTƒp-ä›ÿ²ñ><ÌNpðF©sýbƒ‡¨>MÖÝtOMá½è3x £ï­£¸ŒØtüâ±p‰Öáxgýå£e@æk	¨DŸN‹UŸ¨6;d‡ÐOKÆNî¯üƒÂz*àÅÌ]ÌTÍg¡å:A0LírG{z±å’è| lÿMI£5s!™y½/ Š)Xn†±³(ãSfe]ªÏ©càq ÷"2E[ËÇÄYX™Ï¸[º	b<8˜I¶WÏâ,Î '³äé·h<‡.Gë¡1sY‡×ÁùÖó8T÷¹¡“Ó=ŒsñûøÃ[ÔíËýa×ß1Ur^~œŒˆK#H§!øñW››r½ø+åÉ8Û'C¼îŸÕãÅoð'
°ÀÙˆ ZÅ2.%k–rëqºY¸—½?N}64ý!ƒû>èAãB‚çã=±
ÀñÃw|Jré0€­v[Jxj/)åÆ¯Ñ °•n‘ ÷0™ŸƒSQ§õÌ¥QJÓX g¸¨öW*„‘?	©‚„Õ‡œ&![® Ô§-GæÅ¸NÛãó¨¢ÆHÁ¤.×ˆ^ `P£J²Œ†ýòî 8sc{k
Á«x\ Óä'ÃÔ;ž™b’e˜ŠF@óÕ)4°zäL¦t×…³‘ŸT7—çé3 ôNOüÜJqE|qÛW¦–6(B¬ñÀ¤d•™,úöû¦€•|ËL‘Œ'ÉØäy‡äàqºx{š`O,¹!{“¼yª‹ÕÄ »çWl‘ÕFL <µf‰Î"HâÚ»š©7Î€E( IUJˆ,ôGV´•eø?R€og„$êV:ýê cóÁÃl‘@PQ	¤°-4g¨çÅW[ŠÊeKqñ¿: ¶Vý­ $þ@qälî5VŸˆÅËª.€ÊfáÔ,é}“‘µyÁÓÓt­ù¿Go#Éê"ót•«ý8ºù
œŸ·F€j´#C6p˜ý:«Ñ@¿È£›¶4þàÆÙÐËÝf^]Êï?ûN™÷%ü1ùz„˜äÉzN€Eî‰C×Ááâ_‡Cšô†6«hÊäAlv:ŠåÒhG7¤Š¦oûO‚(«Œ!SOsE¹ŽÃÏ7µœjç\£ió#¤W€a¦Á;ºÉe\i*¸þ¬mHCn¼YšÕî]	éùùÕ0Äp¡–z…(#ˆ¶J¶ê¾}jÆÅ_Döëf¥r¦8B\åœ;_a²ÖÉiÚL*ƒT2hD,pV`Üá»wÌ -1FmÄ’Îç…‰ÿŒV?'ÃP2i¹¿÷híNGÞ#~ì|àïggih†ÕŠÂžøu¥ú}¥ÿé·Ãp$Ûœ
Y}ä2Ö;D[1…MB¥úè[Õ8ä0
M	††[Ö~!gÞ+•¥ž›ÿ‹ù	k9¸6aYõ…-Ò s²L^¨K‰ØybZó/“Ñû€É%÷\§×ca‰T:è¯tCAëäŽ.WèC_ç—æšö0ƒU<°ók·ÝwO4w·Mb§“ê¿ß¯b‹Ã‰¦ˆ–š>I¶êY˜i½g[Ü”ØPI¶
sð¸JlXHô9´,­òt»r4»hŸÌÅ}”÷Õï"—özh ·ikV€ü_¥²Ú´˜»«ý¢/«"m”7¶¿}2;e$È‹›B Ü+UåMÇ¹Æÿ)’DLÓ/çAõˆ^Ò˜\õ ý;uX%Äs@}f„,óÆ snN÷	y»í >j/L <QÑþG(‘±õð’UN„{hUî‡`GDˆ‚N9uõï?õë³Ô§ŽÁ†~~éãB€•ÐÔÐ=îŠß²Ú¶ ¹¹5¯*
^…iDž7IÚ°áî\çgËØÞ>Ö*)ñ“ªµ±™2Þáô…h$\¸°ÌZ,V/ûÈ8UÙJ"†7öß§pš¹*™œ`bá=S×1OvM[Òûé¦ !lŠÊ]Ä%h“‚Žp	fÅ•xžhï‡"î»öv]ï;[F–±~xÔ¡ŽòRgV#9ƒ3ÞñçîžÙ&±Ù›Pa'òÆšÐBJÿ8=Ï¢7Fnâ¸ ZJu’„/4²Jd¡+Ó™!ÍésrA'ÒÐ^Í…Œü–(z˜ïxyÆptÄI=2™ÃQ²·Tžm¥%#õÏoÔ‰±B¼èQZ[~KàZÉ6wúN<{áuFQ	‘ñ‘„«ŒÉå§dÉô]æè$º§¸j ©¾:~ y
ƒc:×COédJ~Ñ£uRïÜ´k^Ú]òî©@ÛÌý¾ÒJ½Èøë3\B
°º+}T½TêÎlzen ŠÝ™Ä{Ô6ÛWýíŸø)*bÔó4§ƒÙ'e¸øCäKÈ¤j‚2í~Ì"½2ñ¶ž˜¦JÇjô¿ Y¬¹/MÙSÅ=¨TMy¢¿šdþÙN“¥ª¼þ€Êpì&Nr'ˆ*d› “î?'cî?8õ3Â}ó6KÄ|“B:l¨—²*YA°±Ufl’t}é47ÛPè}2¨qõþ»Ý×Þñ
•À!Ô²Î;Ù|`–br ’Y÷‡w+†FdE7ÞX¶”¼Y}Æ»¸yeO³í9óßIâ
›æ+$>Må™¨¶~‘·5: èˆÌB‰+½$>ª±Ç¼L8¾£—èÂ
!]“ðä[ü„†þ]ªÊéË¬iô£˜"tkWÌ´ö^±÷„Ì¤Í­z8Ç0®CÚr‘Z+ËžyP¹.VÒmEDß7F÷’Ðmê³3
çr‹©÷[ |tãòÎ\[3D÷ÑóÚS¯Uaö
m
liHÉr6 ùs	‹€•¶í‰_;‡£?Íà1‡SahqÊ¿ÕIøŒŠè¸"÷‚ý.J¶¦WâCñ»öœ/žðI¥„) $g½	|\«Ö†¶{ 2.UûšŠpâ1ƒb‡oú¸Ôn›OøAPãtoË„ò•´k·½q³Hó’\ÉrQPÁÆÐ}í¦£së”}Û€YnsásXÍúîp&å„öS\Põ Á õ‰ºÆåDÖýˆ"¹|:$à
ŠVêLÓçþ°’¶m%ƒÄM¿š -YªÞCôrGŒ×5®yÑ–sq¡¢Å6¦¾jk¸ ©‰tŒQÿŸ&kNK’Ò"€X¨gŸH’.½.iDkARŒ
l$á­|ÕÀGòƒiG!:Œ Êtù„dÏ]ˆWt~Ë1})nC°­ºs—'u2…òt)#Ž¡)ãáÇ±â1%i$Mýàïß…³	ÓÊU¸t’x|*ÀR(ÿ¢È)îXr+Ð^ÄåÉ`XLâS %íÏ³ìSŸ2QÝV úd·!6á`xúêAnŽ2D_´”îmQX<J—¶[Ñgs¶ÒÁ«Û1 ~#´LDpS}<ôî”-‹Sëª6½ç]b'9Ä‚qCæÎ}‚½­Ï‹Úæ“	ÔeÎx}c¤ËÁü0XŸžsÉ9jöì…:]·¯7m93½È]
a\©ØzÇþ÷ˆz„ÉÑKÓrÏ\'[PðÄÖkâT%(­‹5½<²Ÿ/+ÆÙ‘®}uz
;ÆwTím[<¿–úÍŽž ñá¢®¥¢Z·ñ0ôµí,…jÏÚä<;‹Ï3ŽðÐ³z„ÅG3¦ãí2Ûõúá»e{:ëéÉÐßr	I0}êàÅŸ·¯‚Ñ1éâÕÚèèð~:hýÏEÝý,lºö—°Ñ>(‘ôÜn”å/¢ÇŠŸ¼TZ•FaTS"¼¢ë‰²ô…uS.hwäX_¹¨E\‚5&wuŠ«YÊ¨AIîêXê	‹‘wkþžv§—_sý5Å
Ži£Uòë:öxNÒeÁËŠq•¤À)»éNÕkÂ<tù¹Q—RÂëP½²Î‘Àö¨4Z8$º„d¼åž-"7ïÜ»}r¶?7°“˜T¥T—ÚÙÝó4ãîØc (rYíHÄ…ÈD±Ç*Iá~ã`zRJAJ®höÃB@Î÷<vƒŠxxE6ÓewÇ¹v+ ýceŒžZÜý©¸€ù¾8ýÇ”¶î¸PÃ¼âUiÍ±­±VKgZÿçC³f¾âkÏâˆùª
‘rG>þÌÁ]É6H	)IŽ5SND¬aëÏ×ÚtI°T¤eŒ®™•ÞŸŠ‰ÏÖ‘¼ÉKS¦S¶raÎÌZ`à5iõ1µ÷àŒ_ÂCR#pÝÌ†aœÒ/Ù‹$Dô¾ÔÒ06I¯üéøÿ¿¨z9„§UB:¿ïÑnh¿O¹ï¶]aø©D¶ûŠGù˜dÌ·¬’úÈ>àK,^l¤Ãt{©µÚJxe-ÄµŠ(ì¯Œ•ÂÖ%öß·:5þM&úZFôÞQ™ÜJRF7ËÇ77†@ƒÆi§–ÎÄu¤ä^ràx…¬©µm7«ÏìªÆµ7¦/ÀF‚˜ƒ~ø·€uu6À(ºx=vÎQ'.ªC6:¦™áéÿ4ÐJ¶ífÄ± 7X7¤` ©Í¯µW/u®°¢í¾ H{m‡ÏØ¼~Ò	©?Æ+1rú£üù2˜…Õgáá«·I˜]Úùêãxô–Ùi×¯0½à“:ÚŒÇ¹jÌ˜ùÌ†´ìÜUtó9ðŽÑ,BÒ*p`ÐÁ=€v&<EúF­8=RiiÉ¨Íà¤SQo$nm÷¶ƒsŸamó€ªl™î²’w]÷ÑÁ³Eô—ä)E<êÆ'=Ï¬úÖ~E&O¯cùx6”	·h+Ø¢cçÓŸ²²¨n÷‘"Þ©Ÿ«ö	€íãÉ;.rØÙGBææmÔÇLjì¿ì¤¹$ØÑÉ¶Åý	k¬Çç#úÂ<þJ±&ºZtky7SážÊÙŽ@”o‰ÿæ•§tì¾'O9¦$âbc‚–ÒFþÒc¨®ÍaP·]æÎµ…%§*ÍâxHR¯”]Å‹Bˆ'»,ì'ºø=K%Ýžd„Òà24öQ•æ”Ë=Œä¨S“ý+ç—Âì|y^ÂMÔhW. M9ú<ÿ$ Qì6Ú€ÅgÝê5«DþIcÁ	ÿëeÈÚîRëƒŸ óR•&Ù©Hæ1£²/ôº¿1æ4r‚ÛCh©?%«¬E€2C †¬óžü€Àé$¹¯*J
<åÉ¨[ßLuÄ¬É%Ýö¥z°ÏbUJäì,ãÎ”¨Í^uA6rXkn_cxãnÌëá ¡½!Î:¯TDøß*ÍÍ¦„TŠÈCjyÀ„=y’’Ž>übß	O0`81‰*
Øë€ú”p0\’ß?’‹ç‹åœèéiÔšù`1·
(Lä_ü!xÑ™wO'ÃfÊÜ—©+o¼ƒƒŽJôšéï}Êi¥Îõ<QòÀÙøÊTöÁÄ/ms\º—/JÉí¸%—LP!µÈxæJHÇ=þ¨P9W÷šöÙÜ®Ät3‰ÖºÞTÒéÃ÷ŒáŸ{¾e¸}6¸§>)Ù&0º;Ûª×›/bÈÃö´“~|WeW¥ýH™Bà–m•Åúƒú{.žZüw±™vNc[MôŸO	‰;oËN r­TŒMS<MŠ
ÀVË»# ïÀ9c˜Ài¶_“ƒ!Õx)EµË>Ed¡Æø½VGÒmœÈ¹5Âoî(¾HhBµH*9R&%\Rä,fáìžú˜¦ÏMVð¨|íø?iÔÔÄ¢Ø) Q›^[ÖˆöÇ½œ¤¯ (²¥µ±ˆ ^ëSÃ¨qjÃº¸ xðK	|$ º¬QX ûp\"nd|§·áD-FlÃëÎH”}øÒ:¯ç²<i.È®aånœm=xÝn5vfê;håe÷É0¬lMybu©”]•i(A`“è;LŽEÍv¶©(òË4ë„Ôg(VuÇ\±¯Å×+~<V‚io®D– WÃ€¿Yñb—ÿ2Ý€Z¥'–[ Mµéµ]À|GõÎå’	ö­¦#ûÛ!1Iâ7Ò õ¶ZÝÒ»()y)è7æü6¤DLs©„¤Õö´ûy&ŸUŽ;‚i.m2¿ÑGÎ•!R?ÑÄ¥Ž7IµÛ´ì¡­àd3äM=»ÆäùI=¿Ÿ ›°ÿŸÄÃ¯eªuÐœ¶9¦Ï”w²z&oædæ^#à ¤ÄúiFÕ’í±õXJ„ ÓrÍ¹†Âd1^lÅ¶¼¯ðùÚ2:ÖL)3äSa†cH`
lÃ˜˜Æ!MB©4:±åk{®ÐB)Þr{Á¸J.L‡!¬Ÿrºï‚ï"À´è—b°¨QÄöÐ"0Õ;]Ü™ŽÄM"cô7Þ4Lì|šÚ‰uu~¨Ÿšâ"ßy¡=Ÿ.áÕÉt >%–®¦–Ïf·!^ý¿0‘øH“(ž‘í$@<UÒrÙ€×8/*màNùQû!Jè¼¼à±µHË~S2ö"§mhë
ÿ—¾‹]Ö§o›»‹aÎ£³Œ2>*‡/ð•œ„'ÙÙ írÈ
éú„ƒáñkóé½Ó	N­ƒÌâ¥t«ø ¢L	S73” jëÖMf½}«"†9B„o»ØíÑO~ÉêH<¹yDÐF±÷d¾|CaÆ¯-õ7‰ˆÔJxÑ0ÿ qcrN—óf
:<ô9õ–“Q11³h·vA—à÷ÔÿŠC)É´n5Ù!{Ø'×þx0bð¯s4ØLqûÜè«¼‹gÅsÛ=zg9œ³ï3WÏÍöZ‘ñww{ s`öÓD‰–‘´#³Y_È1Sñ{)¯‰ª¦É–<ês72Î¤«Æ8 ìÝÂÊ{;SLyœôñ‘C–C<íz›Ýç¥›ÉÝ·°BôÛswÿ«Ê–¯Î1›þZ#cªÒ¼rÅ‘G‡þ¼],£Ÿ6ì×elM¥žç¯"&‘’×=„*÷Ï½ˆÚ^¾'ÛØ´¤ï ´iw‘þÚw,tn±~óBšèVV·¬eÇ&åüÊM½+œº*¬ò5¸¸?¡×—Ë]'ÈQg„!2¹Ü‘ìSËUgßZKGê@£KÿT¥{|ØMª·;ï$'eÒA ÈeKS×¸ðŠ$&HAµ­œ¹  ':SöÔ™¿ébÔT¯ÿ](‚|‡.UámÍ0iî¸&„&‹ÄÏùAz[ápÕÃd§7¶ºJ‡ŒîG~ñ¤ºê‹¹nt_]g‰?8ƒB¨-ßšÅžDwtùUÍ§~³ü*ÈüšÎ:"Ÿdxž{ô‚Ï3¯ý	pÙ«X;di;Eõ¿ßäó;fG"=Ò¨+4f^Ê[µ£úÇg” ts¤èfFáÛÔã|’¢¼3ÂËH±•ý}r›Þº³ø'›uºxú-½7,U²ÞlüÉ†w¹5«¦ã‡ 8DßI) o´œ’E3÷+¬~ãfžãK8?cPºŠnJÆ-v³ÚÓôÞ{šý£Î]Ðž‡"Ê*sn”ò9ÁŽTyŠ™®¾—	F63FtjâžCcÕŠ#z¼Äj±xêè(÷zD0#ó6ˆ«7fÏ´Úüb=­Nÿ‚…·ý¨vÇYC5Hd>%7çX…¢n{D²¢cT{ìRBAòÙÙðtD¢ æ†×Åq%Ù*ü—éÂ /¥ûÖÍä[[l Š-o\š¸Gù®U¼ëYWãî—¾ÏBPŽ²—‡]ÛíTÄl¾@fÇMì^ehÈZwÆÄ? 	çw
¨hmççµÝé;ç®î4VìõÚ¶œëÁÉ1Ÿ9…Õ\.8B/Ã6w­œ–ÿà°…´¦ö§î)¶XÊ#•È=)¹Ò$T•qá`ôec±‚»y.üaJ¶@ß^Jvé¡zàÆïcð)P`¾«Ôí€imƒÓ¬W™Åù…˜—®/Þ§¸˜!ÝªòKY’}NgänewSå¬«*à€}å/â¸¾7ØÔ Ô.CögrK'ìM3Àðé–K_¡?59È†¬ù
Z“ÄÎfÞ±m¦DNÂÔÅ&&»H|vzÞ“ª¼ ‰`ç+Ÿ	&ÂþèÔu²>Pƒž;0ÎËâ}pu	`5³Õk†B~2^uYÔObÙ“j2<f,×
«hpÎè$B.ÌðzÈ3vÂÉp>›øÌc¶Ô­ ÔÂõq[I'²
®FžWýÖ†"òÜmÀ–lpÎL>š+™v*Yƒ.˜jügÏÒØ˜iþXê(Dê¶¶8zRŽÁIÐë§vÅŽÂ·Hw^½§ýs¹l†kÜ|êÍÞéÑlÖì­6"ý
?2ægûcÅÉu#<CÄ°ï÷š>C¯
ûŠÁ³6ì%ç:ÏIJYç#íg1-tÇ†ä3šž1Eæ»`Š7›B–´ ß;£JÛÓ'öDÎ‚;~¬RUž%!ÜÅÑ8¶å:y¢Ç „£ÃµêXžN'EÚê9«C)’ºÐjªh_»Puµü§Ì¡ô1§vE`MBµÁÜP	o¤ƒ å|(-¿¿ ºD°jW&úþœ§ñøOP5#BZf¾Ó›w«¯cNãLt4çw=@£Ñrº£üo7Jøæ¯’®´Ÿ:}Ù©QF.öFdÔmuŽ’Ý#Xšî!æ·9Öðh ´•îâQ!ÕiñìÞ‹Õ!E07>„1OõõzoëlË}Ú2bf¬~€Qù°‚ü‹ÕÛd „R_é'Î‰ªÑgâžKô½e|‚-¸£ÙGõSŠq	X©B¯»'g—zè¡NN[/—bXåÖÉ)‚Íü^_*ù^UŸ0ê·QŸ£14c+÷³_…ÀÍ
˜iš-­•íÐ ®íÄ—È­ó_…/îxÕ¦®Ókßg'&v@D(Ø¿z(ÝMÍ‡á6øOó(±#Ž¼`œå¨ŒÈeÒ»èòÂ£A]ìõ§,TVÿrËæÂ$ÓžT€ÚKe§–äßE« çÉ€h€Ê-ôÝ«µvv)M(Â’ˆX<-çQÀÑTâ%F×”Õö²._×3˜tpißBÞÙ‹X¯Ê4¿e5¸<	XoÜ=_\_Î *Ñ&‹—ŽŒ‚E-Püu&›FÌçšêJäåWõt¹×D)Í«2ìýí ¡¸±5G-R·…°DUÒò,Óï‰©Ö²¾}÷&97Í¬@È¦¥«ÖÌþ‰H6÷gú¤’ãÁ¢#÷¾À‚Jy|FDãœ‚ï-5`–˜ˆÕÂC¸£-ù}þÞ4/_}FzágMfî™—1½gc»³]ÃH{¡wC—*ot ü“®Úû`ë=jV´‡‹û¤¸²Eˆì‚‚ÐBuÖ€crÞ)îîŸ‘GHz6KÚšÅ4810QŸ«;š)ãÚVCUÔó