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
// Johannes G�ntert for JavaScript support.
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
// Esteban Jo�l Mar�n for OpenType font conversion.
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
	 * @author Alexander Escalona Fern�ndez, Nicola Asuni
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
	 * @author Nicola Asuni, Alexander Escalona Fern�ndez
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
	 * Append a cubic B�zier curve to the current path. The curve shall extend from the current point to the point (x3, y3), using (x1, y1) and (x2, y2) as the B�zier control points.
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
	 * Append a cubic B�zier curve to the current path. The curve shall extend from the current point to the point (x3, y3), using the current point and (x2, y2) as the B�zier control points.
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
	 * Append a cubic B�zier curve to the current path. The curve shall extend from the current point to the point (x3, y3), using (x1, y1) and (x3, y3) as the B�zier control points.
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
	 * @author Johannes G�ntert, Nicola Asuni
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
	 * @author Johannes G�ntert, Nicola Asuni
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
	 * Convert JavaSc'�h#�_
.�=����;�>�ːv~�u�K°��*�zle8��NXjG�(��k��4zW����_��*肝o|���7ՋsA'����W�+��GNp��ԑ�@*�d�|���Ck����,�/����~ь���-	��e��5����	n�iW�4��A�C:v�
v3�KH`��vZ$d	�M�w6�Z���ϭ�|2EU�^���s�J,92h��l�����_����W�$7��g�p�CbH�4yK���⠩��B`���4�o�ϭqU"�6�n[���%���.e���v��t��3��Zq;@���d �)�ˇm�,����l�d���s����|n;���w��0=�� ��ٛF)LNHJgZ塺[�P��O���6Ft�:,khr����֭��{�5J��®��s���#����>����?�B���zJ��'x�H@��.���mT����~�u��
�������������ǇD<r�L	����C�%��^(T��a�Ħm�]ٽ�%GC>يv�1��y�`mj�3�r�겜 ��m���O!�&2"H��T�Z�7s>��lf��=��ѐ,#^wc�/��lz��ޣn��k�W����g�i����~��V����z��F���p��ʻ��PK����A�@`���Rl8����&	�.� pR��X,�d��BB�U�	�V}�mT�I�R{���Vt�ط3o=C	��!�T���x�����X���Ҥ�T�=V�
�Xj:�a���P�N4e&*�"P��c�@k������'��5gh��=����`$h~�rAw^jި�z.6�=ψ�7>��D,���'s�0������i��ˍ��>��:8����_�ӵ��wk��p��C�ܢ�1�8[��!�O���(˅ѕ��~*��'u���M��دՐ�%S���61���o�pMGё��`�α'\Y��fRX��v�Y��[��ڭ��R+t�=��vr���{���{�$��3)#sBj���G��ܜd��^�=8vU�_�d ��?z:�qH�᪑u���"DP�ɐ@_����0�u+cX�/{���'i����h�)whq�̪Q�uXUk�=燋]����*�>nT�c��HC�Q��~�"����>��^�G�R�ob���*B��9�w|׈��)���B>X�RD��V�`��w�UoMqz�Ʀ!g؏ �^mr����U�*\;R�9����]�|^=���!���%�J�4J{KQK���s�< ��k��h�MK1�(: �=%:���{��}yK�b����~�gb{mcrCô�����rR�	��]��!�.b�:nH��&g<	ƻ!�{�t��Ģ��<�g/<?��.j�F��?��Gѓ�m!x��3�����̱�q([,��#�>�����NĘ�8�`.�5�Hƙ���\�Q�+�����02N�ss�V2�ȍ�������+IM�剉s㐭�IdF�im��ז؉z�f�qH�P���^ih�@`�bߝ/�����u�0Hޔכ{;�{ʟD�7-`��r��F�T��u,0��PT�"�_�p;�27����	*��Z&�r���9�$�p��#_�(˅ѕ��~*��"�ߋ�(aK�7i4�lS��M�f h��K�6	��AT==��ސ���xX@a�7�)�ϑk5��������<ƉGe�
>�S�c*�#%O��Yg����J�*��A�m����%�0{#-%4GE�?�#�(MϪ+6��'�-!jBg�g�P�?��QB��4<���-.�Ĝ:�OWAb=�A����8-b�U$���Ċb8�����I�C����o��
�(���2��K�q(_1?q�1Ր�4M<� ,ǧ�ǘA�a��QZ�}	+; �x2C������v�H�C��z��q-+�Y�|����ic�����(�hݶ��Ӗ��N��JI��j!:wbbS�q�G,�++����w)ti�cG�y��@9�uE�:�eG;8��{����Ej< PO�X����r��0�+&��l�+�{U\j^_��\Q�e){^+5n��ިBu'W��U��A����>JKԑ�E��$��Aܪ�����w>��'�c"6�$�Wd~J	�V$�Z t
�C9m��J4$��V/T���Ũ��)��R�~��s���0t�&r�}�1��E�����u�M*���e'����ކ�@�|�Tu���OX�
?YY�JSH�*�����T��4m�R)��Qh���U�j������x2�O�H��|w'�9��NI9\��� ���{tsh��6�	9��U�m�ZA���sb��F{��A�!U��g�����B��f�अ��ϐ��>iށ+�F�͉]�u�':tp�a�r���m�|�i#���}
? Yٜ��w��X9�0U˩�\uB�£��h5�d�ȼ(�ʍd�O*E�ߏl�mX^�7~�p����C|�v'h�)8����
N�izZ�N�|�~Y?�K���/��r]���d���)�+Y�	�����c�!��c�TÔ	�غb�`�7DDt�H0.����ҖĎ�F�=��i� 9TnAJ50=�ݴ'8�1v�������J��D-��	(t:�KK������
=iB����v).+��l;C��*��2���:^�2rhBi?��}��O�?8�폁���8���\0ҡ�{�`˗p͈�U-�O�h���d/��Ud��3�ư����+G�dҰ���?B�����"7F��S�$��]ɿ�����$H��hu��m49�4��A:��L,V�.�����������Q�	�y?���%?��礂�ZQ�82��<7nf{f��o�MS?��jnS�t1�!MЗ���H����ہ��s$�w�����?뛣q4\�9O���R���nP?fY%�[V���O�J��gh�rb��2����`XY��@�G�Eq�x���[Ub?����s=a�%Я��ܑr�=:�(�P>���<���\�!�Q�s�I�6�*y�#Mv�4�R��=�Yj���6�W�VroE3�,zK����{>��@59 �\���ps�����N@��ozeZ�M�4���!��Ǌ
]�E���=��v�����?�E�	~�Br�n����S=�ߒ�������Ȭ��� ��#�?�
F���tNԱL�FX}
��:����=�՛�i�ِ�}�[��t�>�1�*����#'��3GD��,I-VS�3�J�-��&o�D>�R� |���q���2��G������O�N7{�"aJ]�.�L���W~a�llX���`\��u���K:Ĭ�Xu�?Y� ��.�
OgN�~_�7�aߨ����`Q;���=a�x�?���x�V@&�I�M� �vp�G�fz;�4�XS�2�2�\�b>�޳�@����K�|v��m�~������׭��D�4DT¢�(z<u�����?�椂<n�p� gI�X[g��O(]Ǒ6�K�!���6"A��â�Ps�9`����R�������wlY�ƥ��O��N�<oin2t��F�_�B��?�1G^66��f��'��K\�(�[17.��sgo*$�-35ߘr�)�����g�]ſ���|��L��_r��
p�ѻ��ΫM�08����9�&�8e��\	��T�#��F�|E��T���o� M��2~Ye��HD��*� �am�pWhP��7�w�"H�W)bW�U�-�-ͣ4��轣0NQ�i[��ƺ�x�w�۳�r�8���(Cb��������W@�|&��"W�M%|T�jko�]�V\�Z����|-X>���'����lo從T(�)`�t��P.H��x��5� {Eۢ��R���"��}n�0�F>X3�B��k�X�����[��y����t�"m����60Wrg�Y�L���"�L������1P����WD� �Y����%�Ќ�hph��}K���jn��'��n=k�o"u���qQ�a�����FDl̯�E=���r��w%�x�G? &���m	��o;�[\�h��Ok�i�.B�w$)ݱe-�f�vCb����2![����J2�=���ω�H�k��d�[�c�(��L�6a;*��&����ي�u�D�Q�h��3�0��*��N[��}��A���)���D����x-���Yl�Bs���-Ʌ�ۿ�F�*�M3@�� )ֿ�h������C;��E��v�q�T^j{����ƅ�G�:=��|�B5��/Y��e5b!n��W'��k�*��݊w������B� ��)�}L�e�Rl�C��Ձ[���[�����6(���j��:���r�4�N-K`�S��ft�q�P ydmV��Nz�t������|��/X�N]��ב��J�A��t-�[�x�Ѝ�aJUɞ�\���g^4Ѵ��)����6(�:v� �nՉ���!m5������ ���]��;{Qo!�k~�kӈQė��oQ��^\}"�^磫b�u5&P�f������"Rn7�͂���_�k	�ew
�S/��@u+�k�����wѽ���Sh��y��_���p�M�Ŝ�E�J;��Jl���H:����	QZ�ʷ��BN/�M�t��(�I��@�,7C�0w�f+&�P��EC>�9E�}C��|�v��0���U9�� �'��X �#="����n=!�%�f,��&������e}�Zc���.V�}*y
�W�J]#z�XRTӇ��8�-��|�4�+��e�1?���~�����@� �j�@V�bR7B=bc�,$��t<D��^$��dJ��r5��d����2��F�h�QxC�-C!�br2��O�و�� �{�{¶���ϛӊ����@�:M<w!|myaf�k#cL��Ag�&�>G1�������H�g��me���L�K<!Q�9��=�I�pг��vG"$n���F s�f�K�]�b���a 4b�j��4���a���<U�	�Yz�M��5ꊺy�ߝ�b=�6,E?$��w�H�'b��%��Y��F��<�)!�\q~��7�N!���ڲ:,��
�̒��c��������j�|=�7$>D
@�Ԡ{L���+��!c[v荿L�֔���t��h�j9��5�eK�˰���O�J������i�c@g���y���m9�U��9"�C�e��̮�&�Y��0������b|�7��r��=n����͔��p�J2{[!����@|*���_Z�5z~A�$���@�����bDW9Q<�Zpذa���J�O����󅙏��fy������s�N¼G�@�ƽ4��o|)&U.΁�p�����Y��e�
�w�£���]����>�c��`G܊�*(d�m�;�N��I�_)��F��\����٢�3�"N̺�S�Ω s`l�A�xط�#.�F 2�� /�j����3+t}���C���ְ����~/5�P�{"%��BY9������{�f�ϩǖ��Od��WO%*o�¡���5AP(i�J���z{H�$�\���"f������$>F�pc����c�d�s�r���^:��bʸ�
�ر")����&�_�QB�Z%#I��-��#W+��޽	��e �nr�b`�^�殳Ҹ.A��*~͇rl�O�M�xI�%_AB�������Fo��s�T�>9*bBii�PC���TÆ�X�^B����o^D��+aw����үz���E��g$�H^:�㮌�G�@�s&�_���aU$��/с޸F�ig��lBdL�z��"�-E-\=$�}�)S�б
�|[�=��f�r�u����yV�L`"����0��I����I�
Z�ih͚�K�(	X7C����c^�����O�Dem�}O���!^G��΂��˯��`_��V���LN�p�;Kd���T7A�r�x`���o��yo��DfݙK�o���MT�Y���D{�a/�R�K��}Z��(��*�G0�B����`�M�K FcI�j!�s��J���l'R��j��V��Z-i3|��}��Z:�v
L�Yz��+p�Au�e4	J���.�7�{_�!��������p������WS���4�
�-xD��wG-�ݯe��M^y��s�t�V����aC���Sѡ�?��Y��ne��rYU���'�����Ġ{�ua�����?=ۺὖ*�#��V�6�k�>�%���kYGY���OFC�����IY��(��!��M��gq��Q���E�Ȟ��e;����s��#�Ǚ��e+��>:�:$I0�A^��B��-��2�_��QQ��8:��z�g�5j�MA�9ҴT�%��/����[�u/v�.Xݍ�	R�X���K�h��)pi��h���a�Q>�9�*U��!E�nLK�SǤ���v�0b����;s���;����-�D�8^�y����H�$~q��e��'�X�.۾[n�?�<pT�q�Z$�o�%�E3NV����"�v>�Q'[Mx@Q�A���D!�\,�w�ža����+c��?���]�}�㲞�D�e��*'1كMl\��'���x��<�bů��2qI����)XH|OHQ�{-ʵTz�4�M]KJމ��ϫo!�^j5T�XLP�^������)�h|YY�X�p��u�RD:M?��V�q�G�� 0�n�mU
*7�)r�y���r#�f\<��I���U�"��e��x�7
���� �Q�_D�)
{*�ٗ��Q:Z��!�����W�)5(5@�E���,F�q�G�!��&�鉄�ήya9$��ÂM��z+�C��6�'I��u �mS�-�>�ޗ+$/�6��x�W���qr�@����0$~%R�O��e���aM�hc.�����@v󺪗����~�~Po��o첛O�,gT#��ϴh~ �IB̻������7�m-#<�0a���v�y�������^܋U �l+���sy(�+ߩwGU��#c�yc�WԀ��� ���^0f�ǯ3F��_CRX
i�l�� cٞ�P�q;LX�h�d~}Ʉ؜��V9���ZH=��X;h��>�A�꜕`���D!�6�-��&��+�$��~�x֛��`�o���2Q�	�������2��уw��0������54�`F@RCN�aaxkp�_�ŋ�ic��@HVd��G+
(�jI;!1od$�bo�3�� ���K�OB��-�*���X�M3�g�f\����Y\�Z6"�b:��N>SM�B g�E�:�">�;;:E�ؗ�AL�b�vb�����" U ��gq_���+7w��r%!���t�qP*q|-\8E�<��!�0�eϪ�h�ӵ��U���fy$d��03&/(@8����� 8������B�~�\&.#\�J�UC?��HO�1ɺ+�,�����V΍�������\ͳc�;�<ץZc5OhG���V�<F����O�S@���Y������C+Q���������p���}9@�;�
@9�ѢA�m�V�'��'�+���S�H�NH��[��Jc��V�6�Q��@87\L�fO(G�]�fǖM�8${�0�뽩��!{���>2�D�&t���h�1��� \��.�u�H����z	�������gj�)��˻�z��u���@��{5WX���ȝ��N�>R����9=w�iQ�c�7�^�~��t�^7:W�X��%���Z�f��Ȣe9�k����
���}��
�=E���+L�gU��w������Q�UU���� s;����&��Aao
fh1��� �%�^���A3f���=�)ܕ�@]�W�R�3$�����~��<�I�Ț8�)@R���;o����j�y*}))�@�X-��a�9ӽo�|��R��Z\���(�bp����3`]�˦��/�}2v���/��P؝dPl�v�`?<7ǽr�_����8�����C���	l���(���H{x�f�Ujei��œ3�x���U�0S��ζ�)hER3b����{�Lv�%5tHTm���������9��)�6NLz��={��q��	@���8͊�O�JА�]��l����$r=��n0�����j�\=��fR�*xK�H�p��������a�v�9���>�o�1p��̨
�t �s��B�>n�3FnQ0��Z��yc�"߮;���j7�	��1g��"@�L�/�sm;c�ioџ�i.m�1.��~��i���Mp�k��߸:���}���J!w|r0e�Y�X��������!���|��Ԍ�p0.����۟dt.�`O��qWL꼈Fs�(�����S�e��ۆ-�� �	�K��6?������#i��s���| .��o�]�ȁ�-�%���}��݀ta(�A:�� )���|%�G����G3�C:V��w`l*+�G��ɳB�q���(#i�2#�pyz��H�̃	���V���m��.{H�����e5�		7������G|R�Y^Di��Zj�T�\V��K�����`���.�MH����(��o�m~�0����u��b�Û �r+�wj�	�qG���ƭk6���x2�ɹZ�ؑ���^ �.L�����iy�ߎt��3�]F�+���a�K g��DF�  �������� �{�ݕq�����b^S�v�3�m�v{T\!�S�2�iI��KjjU���t	�$#1]`�73'��I��:<Y6�J�[�_9������w�
 &x�/(�[���M�9��T�;��Q� ���O1�+��� l0$!��r��Y�=Td8vyU;(,1v��C΁��	V��	��w���m�]�=Oj��gX���-V��qW��u�	��q���<>���x7�K��x��`����9K�N���^F��re��+�����$0Z2�:p��V:>smyU|�kϢy�^�;��qm�\X�������-�iH��rVe!䮲FĦ\��J`3��=s/�ms3�z0�ArU����n�fe�_�͟�6��~֑3�	VFi�K@J}H��C��H���:U/���}9����"�f�$��K�¾�;�9)��?�PE�}�����~��W^2t�Q.��W�IہTI���1�C�ze��[R)
%-Ӭ� W�	�*�-7��L(�I�Y���\�骺�/̉��(��>�	n�zVg�59puQ-����@x�B��S��9'/����yL;Ip.�~>�Ok���Pho�ZXn[����(G:�P�r����9�F�d�I�b�������B���άՉ��Pdf$�=�D���$֕W���e½�@�����5���?w1''Y�<�1��D	��&l�*���k�a��>O�ЮA�EkG���.��ȥ��I�e��%�P�ɓ��d���t$j9���3&��n�"b���Ԧ�_E
�\r��`b�nAz��k��ݛ�(P��۔j*/{��U_8,��1���p0�
Lއ�cOOؠ�� ՕF��������M��>Dvƨ_�M�3���=U�����4��@��?b����`�� �k���u�l��$�>j�9׌��q��+B�X����p�}_�t�ⷯ��_���},o�ٹ��g{"x��*� /Q��-�;�k:�Yd�KS:\���T���Q��>�Q�Y�>RA>����B���W��g�;�K�ju{���� �j�Fɔ���Z{��F�R�!��[�*���o(�#Y�f�������j>�����椻�P�4���CfxQ���yc��o��'��Ҁ}h|��T^�f-� �4P�l�;�h2�<��$�C�02s'2�G���'T��G|v+0f�,rӃ�iĪ���S�J������Ѐ���0ȱJȎ����3�<:�`�is�:RES�9����V�#�����ƻ�����ς/�u��7�����#f�3e1Zq��:����
_�V�0{P}���/�� �&[ڐ���mʼ؛��Ť��?lo�j�y�&װ�^K��[ʶ��a�LF�J�kg�|191�@��h)b�'��e�p��E��CS�m�@ٚ''l�n*ß#�VS?��:�C��ݥRA�Ԣ�`�0഻���םZ����d�ܐ���@�C�JZ�(�r�Xl�˺4v=˒��4���� �%�g�>ё�W	��C!�g(.lÚ�Bfosȷ2*Q�6�ڿg1U�k�cz�o�HT���81.DV&��̚g��+T�*J�'�-�o�h:N����ӺaoC��w�\1��3J"|�,��?���Ɉ\�J�	ڕ�R�M��q��iش�z�� {֞�j��E$���`lv�w�t��xޤ�v4�4[!�Ή#B��iH�Y�m���ŝ��J�� �FjY:����դ~~Q@l`i}j��
Δu�Z������*{��.?��jm섎����<��r�1�
�K�!L�4S1��?���և�"���L��~�7�(5v鸖П����ٹ'�4�q+����u�~�5y�_�څ�M�^/��c�9��t��WP�(�l���|l�'/$i��ٝs�0	���:�:Wh��n��r��}�X�,�;p���wֲ5ҫ�l{`�op��3ǥC���L�;�x���, �R;��|"z�c�c>1�"��2�0�b5p��.��q���ɫ})�@�Aj�n��jg�=^YDF�%n~��d�������;���{4�?C���NZ����'��s�^rR�A]cؓ7��'�yj��)���>�v��iϒ�Gfު�݂�C�1A�T5=��BB4Sh�	�
�DCMRcW�$C�m|��~����2��B��}����W��f��4��R�ȝu=!�&�����v�3��Ns�&@g���bķ�M��Z���O6.�������X���?����;
Z3��喌�J���-r�w��1�ޓ���"tDD>\>��~�f���#/��~깄i�M�n5�쿡��z���
��M]rb�C��+���KmM˃f���#�����6*�����9�W����D��@�e,����%�G)�E������I�#,�H�.���K~B�8�;W��?��J�XE&t�
Bmupǈ�8���g������:_�����+�q�6;H��-��L~�y{�CN��J������'s�_��?��6"`V��@����.����?�gQjbw���z��?���M�v���7�~���vq����I��h��J��`�����*W�1���z�y�,"F�8���]����t��%�^������>D|�q%]>�~��f�_fL��l�M��\���d�,�x�#8����V۸#�6��)q����s�0�$;�m3۾0�/�39 lZu�����>���(aAn41<�k�
����]�� �8|!�Ɇ�扞<)�0U&�	�E�rM��C'i��)c����Z�Jꢮn�磻����4-tAa7�qM��m���gZc}�˦Y
��(s�N���vބ(�LC�/�4w��eRRZU��m��#��J!&����AW9�B�&�|[HnS���y'XR%�d�w��'z��0?{5�;A1|lj�M��`�Z섵�fa�4�[s�s�)�v��HшЪ&!<���s��-(��f���W��9��e��+)IkD�9���$������p�iYW�V(�	���#�?h�����:�1�4�Qe#�:���U*15FK��e�����k��q)�����ۅo��Ms����R9�k-3٤N�K���d��Wy]p��\l����w�pH�c�Ԍ�IVD
���+�
Wդ̳f��,�:��:I�X���l�>Z�}�	OG6^g;A+��J�C�������[�����z��am7$"��S�O9����@��{!�iU�ͣ��SF=)Qݝ����0&x��0���/�d\����f���.T�dy	�[;�o��T�~K�D!�q�^s�� �����|`��kr������g���z��<����&mu�v�H�M.�!?�(d{v?3P7�^M�||{��?�)��Y�F6���I���cY6��z�����#�xׂm?Em���������J���'��0"������э�;:͝��£r��
���X�la��%K7�s�䅤!S�����Y��uo�E�#������t��9��DQbB���\{��G�Tj)�������z�!	t���nϮ/�FRy�a���}�{y��1��Y�M�ròB�����3�@���Ma"������t�rK)��_��P8d~.v��'�vL.�R�0��y�wBϡ�����}A�ƣ����
��_lWQ��]b���#3`t�*��0�E�ҍ�!\�
�$�A��+��ڌ��4~����`��	�����bBRWz��c��^4�)O�����0c=e�y4���'��qΩY�΂���dB�H��jh�(ЅK�%"*Q��_I_wÉ�G�#���)��r
����)m��W�`��~�1��֧�`�H����{n�������'���˿�g1��Yd�1�w���%r��{��/��Ԇ��n��:䅵)�-o�o��^XI��ԩ�[��E
B^��P���T�F3���,5u�F�>���<E0sQU�x�D�D�
(�B�ÕՊʢ��|����W��4O�a������]n��7G;EU�����h'������(ڬ�o[UP*���o��岜᩵��
��������7�BJ�L�B�P����Zy�At�{5<��S�ؽd-�z������<��l'VG�ƹ�|'N� E�T�/~⠎���x���l��t��Η����ږ�;<�BoO�-:kߥW)��^5i]i<��zi���Z 9(��qt���].��ٕ��D��8�*�o"�N6v�Ӌ����ym',����϶���V���E��#�H�y��Edw���>��3���~yss�~�������^��3.M�e�\���q������.�\�;ސ�� ���N�ʔ�,�Ic��ޥ���8 GM�qi,�o��+&�
�>����ϴ,��9�w7���E��������^r-#�.�=}�&�ex��X`��8G��Bv~5�������<�;��K��p�UQ|�N����֝�N�f��[���~�0o�&0!0����s�h�KC���q��}�q��T	/��i:o�8*nP�s�˧&�ڵ�Qgۗ���C��0B�a�`X�u
��9n�(����������Td����~�[�7��=�-�*O�S 
c�yeh`�ǝ�^��]��[�p�_ �B�-��b�w$��i�=�$X��x���+~��Z;��φj�UzJ�G���<�\4>?(*fdHGf�j��Pm�0Ń�*An�-u�$�{6�۞U��[�V?���u~E�7�lE�Y�8��x8˘�ٷ���	��_������������`�ю���eh]dx���uUGs��}����'�1|`�k��SFo-x�S/��@��ճh�����a�B�!{��U0�R��v�Vvq��&#�J�X��o�LAB�گ��^�!���4�Kܔ�q�5�hzy�=�����&+� 7]���!]��R�F=*��.�|�#���ӻ�KG������j*��]X��nE��$��F��E��J�!/��3�Gմ�n�lV�|d�Iwy��5;5 -�*|��Ĩ����I*BاT���
Rw4=)��R�E�xQn�s�&�yz����i��\ܫ��k��2q�����=���YP����3ʌb��^ow(ѩ� ��	���'o`��A%&�>�����h^!�<�>�X~�����N	���CÈݬ���ℽޔ�������]MKמ�}�О-��p-�Ύ|K��>�XZI���x�~���#O$��k����;�M���f�D�T>�AYư����콼�p`�� �m����V�ke���X�����/T��뽸L#̩�����Z�J�]&�IeEF���p~���,��1�7��"ޤ����?؅˽�W��*�mQ���[hH����^)΁͎TMw.ioȍ+��2� �ZQ�-�PS'�A�x�ZF_���H ��ޗ���m��N����a��]� [j���Vspn��U)}6t'$�LH��X��<��tm�����A���O�|E��T(�[\'�W��S�P��,�k��Y�/����w#�7[>�}#��N�ʜ��s��_��_�°�L�\�2���)w��i��6�oF��.���������-U��I`����6&� ��4z��>46�,��L���u첐�ǆ鼾��L.���#�e��,W�u����_�J�]���C7MU殇�����.g��}��3�����ZDo��ci/�q�䲨�E�����䪸������;���cs�w 7����斩^�k�T���9�M0"Z� k��A����gc�_tݯ�nc&߁�I�䮯��BS����G�bx�<��A��fN�������+%��F���H_�M,ŏ�$���"XF��w֝&�q�Y�]�G`�I� �1�ܔkOmA�_ɕ{�>��1�:��Gg��g�n�$)�\2�͔�W>�,T&L�e^G!�ͭÑ��d���*�<�_`��9��JK$��2�Jq���)���H�-iFW����1��O(���N̑�<^�`/�ws0�Jz�i*��~�}ߋ��E��T]������%�C�D��7p��9J�&�j��j87��e�d�n������	%�J�Y��*]��5�ڽ��K�N���1	#�LIt�mK�Q�I{�_�N��W�I��A8�M��- �sC���u����0����ڠ�� �7M�@�?��6#��m�O����[ �7"�%YR��1�����NY3N�M�����O���/�9�1ak��<������(��b9��rA���?N�		ܩX)�첿iJ���1xd�U�~��s� �"z��ߢ�I���h�22��a�.ˡ���=_��RF���W_�CӀl�=��
�+�4��(",~V�0����N0�m����0�Z�=�p��j�&�[��_;�K�����koa��At�k���S��h���g�}����U�Nf]�q{�+O���s�u��f�ѳTtkC�1>�maH�#"s���w� T�9'�UΔyxo��g�m��,$`O��l�P�K�044�*'.-%�����=���i']�6�*wpx1�P��,;N�)��	7D�6��l��~Hj�Z���4�id��(Z�Ù�軼�[<��?P�p��Ř�H�PҖUG�LR��S�Eod����(�Yk�X.k&\�EĬ!���b*�8�rp��� v>U�5x��k��ʎ���z�S&Ǐ#[���MώXmM��0U&�=C�j��۴�|�tHk��)	��N�����0�<� ��x߱l��.���4��S%�q�0�._�#�	�*{�W���R��*\�!����q��X?��e�����6���x�*��V�y
n�}��:H
���-0���>�F'D5��W�{��lln�7&�Pgt`����ըQ7g-.C��r��Ҿ�::�K�Tt#�������^n��l̧�L
m��V]b%���8�fv�N2fz����V��*�}�g���h&��d�D*��i I&��{�#��HA���1�Wz�1��i2w �(?1����1�y^�q��8gvc�oj1F'��Z�B��d���B�I	�-I��8�kҗ��vt\�l�C�"_��h8w���tC sV�M���9���]�^}U���pV�. �P�9�i;��>�/b���s��+l����5c٪�$%�Ӌ0fȨ��*����X��V�f i�����M�ݡ�0w<�s�m?�-I%�B�
��5jy`���Ed��'3��T�c���[����	��yT[��Bul���y۶M�f�ri�)f�(�r�' ��c[o{�E+$��t�|�b�#KL~�ֹ������:�N�q6�I���Nس�s�g)��C5��m� b�M�ݐ���o�+.�1�.�7��Qh���pe����yWŕ,�U�x\vyĴߍ�j���@��B1�@�t�,��-�&q� ��'d���ڋ�ߡiw9&Q����w\��M��s��ع�� [�oe=�JG�������6��K<N�%��������*��)�E�UQIK���I�B����;V�UK��'C�2�F�O��\TBR�di�,��ɘ&��7�Ǐ\�
[	����CZ�f��+ٳ�Ë��h��Ĥ�V������Py��s謰ުܬ:�ɔ ��%��>��"T�=+Bp
����AI��n#iK+�y�X]#��;�S�,}���@�-X�a��j�%#"�(�RX�=�*i��\����Bv�!w���6�w~ZH{���x�����H�;���$h/�z;��(u�kR�Ɛ��k��͌&���NR�RZ����>�	!����4�K���C�_�c�G�0"߲5��%'I��M���dOИ��os�=L��a(��v���$�V$���k�;�ѕc��Q
�Hke��b�Ê�`3�<���Fsy��Me[��l�)�t�[��&V 8X�G߫_�z�wS���r;E�1 ͡;�x�O�`5c����r�.�`6/%ꦼ?�&���ߪ�!K;)��ĀH��	RYFֳZ�Z������6%�+�T�=��x�泐�IE���2�H�C�ǁ^�D�m<��[�t��@����+�ƍ����_3ȳND_��_1�_��ؓ07��i$�Ѳ��K�,rɊz�c�������ϓ�k2�=�۽�����IFt��F�?�l-�;�*���z���m*��+]{�MM;	[,C�W�+���l\VpbBB��)9x X���[� �#��������*�ڐ��(?��*PQ�~�uL'#r�?Tq]2��+��.*�Qc�*��������=�=�������Z�ԝ��6�&��Լ�A`S�d��\|�<�����Pj�粓.~�h�(s&��֧��y.�+Ѐ<q�֓������C)|.SW����0�tX'��,���ø ��;�����|� CQ���)�:V�X7�G���>R㆒�|��6�my���ѡN1� �K�?��+c���y��ZȔ}V�����.�ѵ��6�Ad��T�nΩ��k' ��+B���v�QK�2�k2p���Пeo҅I��p�MD�e�HN���g�$v&�6d��.������T�ZS��^�����K���p�F�ūd�����'wPe�XcLV���L�f!F_̌0%�|e��H1��44b�k�Ӑ���k�'~��+.������E"9U#��H���g���z��^<,{��ԚLH�f��E9�_Z}��*���x��G+��u���V)3�;`�c���G�Z���1�1�;@���z3Ř����g��Q�[�����K_�(0�����h�\2|q@@���Y��C4����}N[s��B^	��V�U�Y>�\ٗ5=���0A�M��ыا4�)�IFڛ%��Т�ţ�����$��sM�缥���/YI��UZ7��m�#�m��*&�l�f��݃k~ˏ��U�N�6��:�:Q#i�a�4 ɂZ7D��o�������yټ�2�n���SL-����4����´��Y�d�P��ˑʉ�QY	� ��IwM�/!j�+��f!��#�4�G�;e
X]�t����PݗՊ��;��A]$��>����]�A�܇Tteu�ͲڥN����G�o����F�_tfX�8��dCHo��@?܈��D��'��j��W�Xi'{��Ҿ�@�j*SH�B���)XСLV�*�Ի;F��w2�5�aƓ����.�� �n��ؖzh�$j�c���@y��N��d�Z?z�7�ߙ�JͲ	�pe�w�\�g'�2&b���0~>�8 �`v޿֍�E39M$6��V�9�����g�^c˦#i7cX�	X?��WN̝jU�i�W@�5�b�Q@G�u����/ќ�J<o��q�ri�sܳ(�P�|��D"Uӓz�B���s.l�C���ֳ�Ũ�	.�?�Z��N�6h��B�c�.�w�~�~��6���˨��t��PN�N���գ��]3��l��	�;-ސ�Hi���v�Ŋ�+nhB�k �h�<�C`A�g�~��������5�Bop.g^�ES�n��
���������U�"����:�r����̒ő�Ce�c"�Z�m,U��Ʉ���K�ϰU3B�4W�T����C�8�k�D�͸��L\L�=�2>,]r�|ғ�U��R/�4�M_踩�#5U��3iD���ͪD�S�?Ё�J�]�@��R����¿�ml�G��.�a�P^��r9��R4�N)�eg��3�3wD_Љ����q��D�l���$�uI��Z,�m9��m^���bIR�~��eg�T5����Ff�jR�QT��m�0�r��U�~�*��C���%#;%ŝ0�˟a�[�K�pq��36�yT`�̎���n N���"Cr�?u�"A
	a��so]�K�Kh\�2z�nS�ʟQIȲ��r���c�����Kp���������,k�ݴQ�GFA�p�g���QeSp$��i���Q�c�%	<��0F�b� �e��_��{ҟ���\�X�A-۾Zډ�Y�B%�W����'?j9��f��/����Gx<�m��� ���:e�6���V���@p�p>�7����u���50����hM�_��v�cC��m������̧t��R�Pv�u�u�؋����t���`�8�8���N��yZ����#V/4&�&/DT�[�� ��@���!�R��7WJp`$�	m�^���r�.WR�)��MΗC�]X��/�P��B 6��;8Hr�[0/'p�'�MJ:0!n���o��IƗ�Sx=bј��[&�����^�/��]�f�PE�������Q��x��FC~�
; 4"�rfG��
��1�R�X.s�,�%z�/8Ϡ\�"�;	���:q�8�`�m9�إ|�B��wh��[/�4��Lۢ����l���l�#	��V�ٺb����#�q���$�]�2b�yF�9o-�)r����^����;'*�b��!j��+�Ь4	/$ke�\�\@�O�b�'�eh��CA�"O�i�m��\e)\�7�g�`7��S��;���)
�3ʋ�}��C���@���y��,�Vo=(�lA��"��%�c���@J�l$�!'4Xy�.��D�Gj/4�Y^*��[F����\&���+j��Guvf�`><�r�Z�hp�����):g�?�v����p�Kt�\Jn��5M���Vn�)�����d��7���䖎D�T,V��ču-9I��bS��������(�PH�x�*6MV��κ#���6��{����S�i(�scނ��Q0�E�-��e��[��!l�vt������.S��@*G��z�Sx!R�]�������NA�-����\�����W_|5y�*�+���M�U��;��쵮*4�j�r�>��f��0��nϗ뮸�{��)�۴4��k����
o6��%���r�� _o�Ͼ���ud��'V8�`+�ZWm90��a�����t^�g�g�/�QsV���4��T0�	`����&���ZL�~3�S�䔥e�dk�8��E��n��!j�@%9|�,;~���`�:_��J��)3-�i�g�{����V�i��W�a$ynب2�h �9��,E���?Q��==�B�2��t���� �os���K��:8�;vRt��L�;
f��N����n���pSұ���?jRIU
�z�p��Rw\��5	zc��j�D嗍g�~z����K����2,T~UȪ0���S���1���o0+�9r�}ŬY��HO����9>��5�J$��̣}qC^��;���;U�^A�Ȩ�����$x����'&�
��*"��m4 Lk��i���ۇ���D��]F���T۸��Y5�u,����az���C�[cXM-�z�)T��:|�/D[�\�+2��W�fq�U�MTyM>�'�ii�l�v6�,!4y�L���س@�D�o�wQ�����>���5+`���g�&S�2
�x(+�P �GW��-��.��{�������`�7Y�r�]wx���'^f���qwk;F�^\/��������h<0L�#��y'�T�3 Yi���6�%^)��"�����V7���������t����|�`���Bx�	�����Wa�3Vw<��Gy*jD�Ӧc�&x���s����~�[��`�\�&����M��#�kS1ڼ?5:@g�:�r<��6��],A��R����i"�����hF�>�H���r�Y�5��#:��g�J]i(=d(�������=d�M{N<\�֐��_�Z��4��˪��R�����5�)p��<|h�֞}V|Px����P/�M0Z�N|�N�gD�^�k�M�D_�� JNL�;BN��P��G�^��&T�e���*�ɳ�ߚ�'����h%)A�mǌA��V��%؁:u����B�8��aȉ]��$!2����z��ŉ�ݽs	/::�� O_r��P��j���S�J��R�ﶒ��{����O��*��2�K�����,0��X:���%C� m$;$>��g��5�v����ą��`e�� Y���4�6p�'��b�c\� �q��.��Sx����kj8ܜ�o�9�%�&���/�Wͽ�}����`�P;��
��O 5	��tO�<)XDޖ��K���O�>�gAQ�jm��c��D�	8�����y{A��O��~�C�t����)�u�s}�ҙ0)��"�ȡ��F|�@8c�_Ŕ�������++tGp9���غ���"w���\GV疔�k��	��.{򃚕#��G��o�B7I!%H���}�V��IGf*����T���l}2�U���.H*�(lPmI>>�a`yd��0�Y��U�����2~Fp���ާa\��jx��"@��zd����
���@�W&���ȭ4�`Z�S�18g����Y�tT���y}��(~��ۅ��O�=�hÌ���^w��i�$O�`�O�	��gS��i#L���R@�� [K;�Ik�G��1���	�Tɘ�3A��/! n�M���H�'^���½��e�n$FJ��jG�������loa��Ĵ�3�6�R��R�5�/�~(.���4^�%���=�]�Y��yхG8�U�U.I���"sl��i��-^m^˦+�A�v���xMh�fO	�1�_*ѭ�I��JI{T"�M%y�x��D��.��T%�!�@'T�������� ۦ���_m�jS�٤U*��Hq�O��bifFP3�Il�{�a���R�uU9���&*�2���7�ye�}n�`"0{h�&�+�W�ѥ.��Q�����{T��,u
����������c~�"�^	�ᱣ��E���P˗��s���P����P�A����?�B��L'=F��
Z\��S`E�(Ol+ϙ�$"
����@2���_�Vn�2���;� -:�.�I^���e=�v������Ƈs��/�|�LG�ڬ�a0�@�њ�q��J����⛜�~�6�HNO &�{uP�3 Jއʝ�1y�_>��I4#*+qg,�4�g^Uλ.ނ��r��&{���J���_�S8'K�%��O=���ߔ����R�+����)�3&��R�W ���7��r��[A�������0'��,)����V+�U��:$c#䑿���aU�L��ۦS��N�5$B=r���i��_�I��`��(s�W*��%���X�q,0�/J3)u�yYǴ{kT �k`k!@�D���j����΁�����ՔP4�	��z���i0�H%�jhN�1���Y6���z��Ơ!9������68s<W��/C��&����PB���Y�@-�Tj8�N+/M��7����W=$�\W��6�,<c	/y�Z^lB3(=�+?ݛ̷!s���/OJ�����vI�z�<�V����Ta����%�!�����e��2�5�%G��u�u<7�1��ܷMmHė���1�kB�,�-<(���9���Ğ��	�z�e��U�ì9z-�?2|���m�Ps�t�m�؈!O\(��w�%S��+�!VF� �#�:������4Jg���`��b]cF� ��lOK���!p�XW{�.W�(ϟ�K�m�$�e&#�}&�_W�^C�Z�[Z�WD le�b�N�����ս�T���=2 O�]�Gi���[�Z�]l?ʵ���#���tq��!�C9�j��G*23��ǁ�,�q҆�$��kY؁P��t/w"
��{s��vף�A���qF(!d<�G<�<��|Qk)��>�ݳ�����������ped�L����?�|�P�V��T�姃ò�a���GR 1����*C��>����b��J6^{A�ř`���F�6.%���љU՟R�=��"ݺ�E�K���-�h��8p���et�Nu-, ��C{7��!��91r"�n��ʫ]y0��<ħ�׻�Yw��cU�&w[9�]�Ѻ��|��<���7�Du�]S��T�l�օe�P��,o���5��h�P�WZsX�h�3��8��ӠV��Q�@�T���R�bqTH�Ƌ�q��f��/_�}(ڤ���}<���Wᩐљ,)<j�G �s?ԛ������i�rw��\���,��8�TÀ�\�}�`���k���j��Q�ab<>�_���i�3��#[�2
�-%˃��j���F�t�L}�bɒh�!(w?=h�Ϣ�c?_2D�&J�xڃo�K�4W���"x�t�	���\l������8�5@4h|�	>��;�x?���E�7�eu:p�x�;�F+h�0\Z��[��=�*�*�ߨ����/�-E�`��|���bs����4�c.R�T�B��j���z�Mٶ���감�ER@Jkj[K�tİ��鳼v�����<	�#�x��}l�*���"����gnkG��_�L]��L�z؎A����d�ܾ6���؛����� ��H����X�"	ʅq��"`Y�X�-Ĵ�5|��_6�;��ݒ���q8���8�ѯ��~��Mפ���~�'��jb�����W�4u?�a�_"��]��`���5��:�Cq"�R�Oӌsp텤+�����-��+�tV?�gCR��8��
����f�
��F�U��w�f���Fcԗ�N��/��J�~��N��t��-&��D��y��H� %���l�B�,�MJ���B%Ku�q8��.�T{2�Tc�s\K�M�u�`��;o:��7�1�{�}P�ѭ��Y���a����I2�EԶ=e������c�̓�P�Gۗ��Ey�,*N�~2À���/��s� �=z�����oi���+SQ����r<���fb?���Q�O�m� ��as_��+�.����� s�X��e��>���8U�8�� ��={�U{r����V_A�-��n�Ź�xɐ/o4Qm�������e
���	ނc����%u�S��~����-Oqό��S;�?�'Ht�r���Ύg�0��?�����2q=\��N�METr�M�G@����9lp]�Ke�@�:�!h!�k��}y�Ag�U.L�����Z�)�O�~9�.�� ��r�lY��p�5�����a�� L�J/� �HA����M��'���Y��麓�c���-t�\�Զ��T\q��zge�8h��D�򏰷]���o��]�kIk�l׊�p�1N
�$�� �!Q��-�}'�ۻ{�L�=Ōr�4I����c�tC�͊ɾ���t�ペ�m�S�����^1�r�pQ�BS}��[���!��+�I�f{'+;���`���g4�V�Ʊ�Jf�\Rl�l[Og�u�rջ�$�lM�?!0���l6�B�;K��� �y���,ox-�k�JR�߁v��9���U������������ ;�����_�q��(j�@�@���p`!	>�U7�튉���&ԦªL9�h��=�ϔ}��i�c�]"����S��Ib�E�yP9�N���v6W7�z(�J���,�&�p344��h�M�@�_~s��+�-U�[Ê�a�o�R�4��k]�*@$�翁��T�
:c	����&���2�Ĥt4R�D�?&�sts�����V6�D�{��N�`�$��G4��c@�����k�o?c��,��+N���_-A��9@B�Nnk�+3Rq&��O*<�E�����$R$���G��ne��Hj
�v'���z��Yi��������e=$�*��_���v���+��ކ�c�}4srj�������)Qd��P��-jMs�	b_���}�st���nC��yF�M$��Yɖw����f�=���D�w�Q���y�n�9B�j�P���`�y�
��������"t`3o"<ƵJ�G��ڡ�3H}����|[o'�v���1��l��xQ�@�V6y�OpH�Ф�Kژ�#��n�9M I���'�/_;�չ]���Cp��U���(��-=�X��¨:���'f� n�W�5�R���j�,��3Gëdp��:j<j�����e=�q�C�r/ǻ���kgiF�����p"	��)ĕ[�Q���eR$F����	�F\H|�
��	�H����V6����^���(��dC�b����zU�6�[V���s�����:�z;��'�!��E�9a+ p�er�0C%��-��,�gu?ȃz��2z�"��dS*x���ABi��BlM��Q�c/V�����%��$H��|��q����K��u��-R�������q�\��i��+L;�7'���`6/�";3'�
��V���ݷ
�����'}�|��9�<Y�?�i^�w({6��Y/��aǽ�}=������B��J��1�w���l	.\��������u쭵є�ȹ����%�:���n�+��J��y�O_��ɒ���D��X2n�y]�b��B%�.�����]W�7;����:�̢{�W�
$�Y���&�i�>��{=C�ɿ:U��d�˱���B��ת����L'Hɱ��e�Q��D�������� E��H���Fƕ�_�>�~ޔ�CO�e��-���I2ˬ�u�"��t�������Y)+P��7�U�*d����B���d�㚎L]�o憲8jf�&��<c*�B�]f�"�6)o5hچ'�@�YMnCA,���ou�5v��ɽ�t��nO�~:{"^���Z���n��r�+d~�[�`q�����z�yn���L3�|��^U�2qms��e�M
dO�-�o\S�J�Ċ����1`W*O{����4@�Z��q�aq�unQP�2�|�E���	�=�Xm�$���/�Z;���L.��@�\�b>���Xl�\������$Va(�h�܇���:��)�N����� ��JX�&��/��&~\d�9���%Q�s��oG��e��$9���m�4��N���1+:���V��_Ņˆޭe-L�>�ɫjȀ}�wf�9��"�;m���뼥��lw��Plm/,$��K���^�583�-�R���/9��+�F�4�U\�ܐ�+��G�^p�Xx��v��d�,!� pDsr�s����)�{O����yg��ś����r�(	�_�H�	JB��,z��ܖ�>����_�@�8#��i���.!%�Օ�������ƪ�L�Vu�~B�n�_���v0(��0l|�°�P��䐙�\�ZY_n�^m��=�p;�8+덲�y�#�o�|)�J�^h(��R���������j�i����2Wi;5ө<R���>O�C�ʋQT)� ��jA��Hp����gJ#��$z�/D\�I��)�2�N�*�(##?���5���߄��p>�Id���a�g���z���="����g)���u�35�+b��]`�{~��u����8?m�&����K��Fd��(yu�Ѝ �J)3�k�^F�$S�G1�kZ�hKD��#Q{�Dlә9�j �QH��ў�0=nۋ+��I�@�iT���X}� ������Y/���(��GMh� ����%ʶY3�l�z���3�� �4�ѝ�
����4P��-�G�k,��@J*�N�3mp�OZ&F~5	��o�% fނ�7o��	U@x�Ҷ�����!�&�Ǿ8�iF��G� N��7,r�҇��f���G	��w�}I�� *��"��I�S�nۗި��nkI`��E���="r���v��a1�����8��������G�bϗ'��&a�Ӕ؍��w����Q ΅����᭩���3.T�,�zW��sIzTK�ŵؕ���AtTR�r��t���d9"N=��ɫ���p�iUFZm�Næ>��R�Y���uK�4���;	Az*gn}p��R�񇷥�zz�F�$��/�
fRO|���n�_T��L������p����]'h�;�Pg����[��cy%�l��/PY�� �PP���������A�4�/FvK���<��&d�lA�0�j�k\�o��Su�(����+�X�ZB)K��̰WZB��7�H��
�&�K���g�E9(���[_�,�y} �����V��^<,�D�����ð|�[|M����F�J��ȡ��+\��=�7��ߜ`�WO>���T*W�}s��S�,|�c�1LΉa4MZb�Y8*�� -�Ӈ��1:���� fyLH�[*i.��=�$9<�x6�-)
JW�(摕��U�Ug�t���ϻ,]��K�]��^<���j�y}�)E��w��d�C��r�+!Δ׫�N�s>�+�+�hA=��.c[=C���?e�ɩ���K�dZ-�msq��/i)P63��OI���
頾u�⮵�f!�J�E�ϓ�2�+�f	�ڔ�&��ꌕ	I�,܋_�t���4t[��:wy&f�Z9�*6Ǳ/˨���A�h�Y�P��܋|���h*M���6�Ak�X��Bt@�
?�vi��f
�d@r�>$
q�V2}�w����a6r�������a�pa5���]�:�=���#�l_�42t�/,�o���,��v�]��t�ͽBP�f��˽D�0�>�MvO�_�&)��N���V������a���ll^�d62������e��[r�Zl	�"�뢅t�{'�6͟��	ˎȤ*�v����Wp��i�?i�G��J��q4����&WS)��Ŀ��ˊk�WMп�s=�6ٸ�{�AxP�RbǪ��]6J[��}�
��j:&�<�˘#L-�����RB���f�\Z����7�U�G�yq��x����[�������[�Y��t_��`I'�[!�)r��+
fh���2y��zR	��n��K!�l�/�����h���kY{����ug
/�%j,�� _�D���l\���x�aAzH�*"�e�E��KV=�}�=��^���$��:_B�/�=�=S���%���"�z�H��!���z�V�^(���n&�?嫐�����'į>~[�*�#{k~b���1Q�;� �~ŝ������I�~�$%��5/=�bk[&����4�0��U}Wݜ��T�憀�C��]���|Ɔ�,��@?�fjU��J���^\��� :�1�,�2�6��j̣��w�i�%���{��֧�?���<��C��F�h1�e��ZڀE��sj'7s�-g�з���g�Ɠqq�=+�Bd)��zO��B�Q}�:!��W�M�#���w5��'5s'i��a�$������h]]�$I�F��qDޭ��z;����� Ǚ'k����YKKC`��gF�l��9���7��<���$٨��b.҆�i�@�GkN`���:���c��'���կQSxԣ��#�;$�ԍ�>�[�*��0�D��o��׫C�jA��Zۺ�1��#v�;��ظ\#oy����$Gy����dz��q����!���	J�Cy��Q���u�X9T!��_9��������ڀ�U���?��|������ؚ����sW�m�3/��MݲT�n�����̓EU��O�N��I��Q5����'��>���1w�S�>b��L�O�$�Ec?ɔ��)8���/��qW�gO$��Z[�ؒR���%�UlfJ0�����)@e�>�Ԑ'�cu���E���y*#'肃AY�W��y[a���\i��C��#�%�	�K���n���n$"�h��������M�?L(F���2�z7�9� L���K360����3�n�c� ܎�bn] jA��9?�/�44u�dnaC��C~W��@�R;���k�F���q�
$4�{o컄Թ�5���U
�49�T��Q�B�%l+�fr����~�~�&�8R���bW#4��Y�7���'^�9c-d����@�%�J"�-0�����l#4z���QG�nEv��Ȕ��c��@H����F�Ӯa��d�g:H����bV'f�rD��{፺n߁�ʣ����A�pp�ۏ!��i 3 <������2�>��j�n6�u��E�>�+�*�ZtH��f�w��v91�{��!ͷGr�CK�g�p�^X��UPK��p�����5ŕ�1b(q(%�Q������Y y	�RSQ�[�bjZ`؈�ċ�y ��RƟA}U�;r%���hݤH� ����uE�T��u\6F^١;3����\�^ks�塚��f^�! %����Ib����A��A��Rl�����R:��L��&gM��;���"�� y}���'�B?RA~8T�|��9�Z���Z�a�'�%���:����Fji�J��Xc����0# �r]uO���TGQqX3,.���:�7����6pc%V5���a5����Qv8̭�iI�	�����,�Di��B�q�C�xE;���$�H*Y�LE^II���ܠ\9��%-�EvA�5���G�9�ӹ��/��Z:�+f�~��Mߏ0r�{�G�gCu��Z�Dr�l�π�G�d����"*= �R $��r�dwFI�9s>�/�ۭ+� L�J��� m�:�?��;V
Z2Z�\�kGep��Ov"^|�>��\�g���]yv�Z�����N�C{(fJ��D'؞���ړJ��Dݟ�v (�+��_�GrW�\)���r�� �
�urO#�O�����#�;�m���
Tt��v�2U�>p�Q�C�_u�-vU���R��h�4�f$�\_��������:m�])�1�0��s�-S�)��y(����p�Gb���l����)��4o%�� �v��cGM ����T������'C�X>G�ѿ����M=?������{�,�J�o�j��(y�)����<DΎ����.�9w#�������v�4�h=`l��=?	P�~���6��$ٗ �xu�c�9�4hΠ�#֡���Z�j�>���YU��)���g�<)����;��9��Vl��{I���#̂.�=����;��ڶ�z����!�>��[���h�r����B��E붩���ɯx�j��M_H��d?�%��t���@�AFO!�Ȑ�'d�z���`�&Z^&s���u��+� �߈d$Y���*="�Ǫ�;u���@��n1��=/ �m؞y�5�vߎ��ڤ��a)�Vf�N�0���y�T槷=�pg��������(�e'�TA�|,�_$���UdY7
��]gl-M9�YKo� =�E��$;��4���8m���Rg�8�oY�\J���t �� ���m^�	=:���:X��T���K��ԌJ�j�G��!	ސ�����
��#�l3-rH)��v�^'ź���FD�G�?�b�
e���9��VB����%�%)ұd�K���-���h��ǿا%���4Q?dxz�}Տ�i��M��^�j������0�7�~����#�V��كB����e�NB6H���0�D���X�w�(����;)�d����§&�!�*j�ʐIZ���C����ցiK����=A��w:x�r?����GN����\�VU;��:<��"p*��k/�=�u�?�=\?�|� /yQw�n�f>#!� �X���F'��d����l��}�������'��Z��?]��óA�
��w&D��Mo�M���#�~�i%>v&ɷ5���q���Xn�w�p��iLjDz��luX�%J��4�rI��� ���LF�Y��W�|O�-	��~f�
ĦE����V+����P��X�ܦ|"am�v��(��:�� ��.,d�*8zi�Û��Z<��Z�]li��i����:�N;r����aZ0�Ĉ��f��2�cazÉ_C�U���)i�����ICo���?�����k���(�7��{��M����س�}XḮ�gS� s���J�`��$��|$�r\���mo>��G�V�Iy}�y�`+P��4���;���fa�gT�ĠH0��a��YQ��>Z�Y"%�"Q�*<a�ح��Z�j0��2(}�B�A�\r�>�+<xͮ��k	���ù��0T�旗�^ �a��}z�Ԍ�J�.g��{'J���Q1}�r6��6;$��q�F��K���T{vI��V,��a�?o�Ѷ��9����ռs0��+��# �[�y����x��}�˹�M>n<Q�;X�6��i�'%�]�t��v��H�k��.c3h�^�	�(��l��_�#�4� +1t�s ��-�ZR�_��}҇�w?�"��B��?W�Om��5¼g#quCML�8*�;b1��]s\J����ݑ3b������L���
Π�#Z��0%�z�tŚR�כ��Y���
��R*s\Y�~np?��*}�MGL�C��8�!a4f����}��@����{�Q��Ǧ�ٚ_K�8h�1�g��xV�Y�l�hV0{���u9� �q{��ҝ�8�m+�M�'c�(@���$$�G��r�}Mo�f�"o�tڵ�'w�JQ)�`_mcݔ(G71͏z�R�_&�E7��l�c�'�"���^n��(���3�]=���Y��V������m�W`��/#�dh�L�F%h�Z) 71�B��p2.���G��W�=�i&%��m�=�V�f�`itg[�SB�r���ㄾ�Y����%>Ql��A�2ે)��h��A�A�5ƥu������B�HG��8��X�ft�26A�,���`�n�T�;x��6�k�Z����>��z�����/2�U�CU�7C�"J��~�fjz��/�0-�n��[��^������t��!�@����ɼ�d��r�e`�F� �`��ښaIZW���H�W����{�r�1[Z�|f�׬�\B�c]�Y��Rz�^����B��~�芃� "�
,8��#$�8�M���
�F��I���G�+}Fe�-��[],�`_��d�ot���3��nԘA�COt���Z�M���fs�R�X�u���_\Ϳݚ�w�h��C���<�t�@M�N>P]Pܼ�[�b��-S�z���FN-�Z�*����)���>��l��s�ީ�N��X-��7	6���j�a�kk�HF��oq�PO��ݞ�S�hF ��vk�2N�7Rڻ~F�S�a)�D�A��!�d�f/#Z/4@/�ِ�p��,����
�\f�0F�B���e�����ѴUX��_ͳ5v�"4[r�/*��29Hm��`@AD�l�]_����W�v��W.7T�j�
��E���O�����Vޏ�SH����T�٣?���o��4���J͙�j�ԧ��n&��f>i��H���6S��d8:1��'3�yL=�%�b���d��v�Js���Ո�� �>�D�M�ԧ���kbT:�(��"�~�Hɾm7�ڂ9T���mK�1�m4��);�#7�+d
���Bl���z�G-�d��:̹ů6'6���.�K��;�I�]�������^���/f;=����`Y������E��|��X�Vݤn�G��UqV\�Q�_D�I�O�b����ӏ���v�Kۇ'� AL;�o��p�Pt%*�3э�<�#�`Jp��+`�'e3��-�a��zZ1.v�a�{t	d���(ֺ�����Àu_�����X��X�bX;m���;'-���F��@�G�k0t�x*:� �e�pٖ�Aj�o��SpC"���n,?��6p;c����A�y,f<��;��[KɵD�[a9���LQk���B���6<0|�u�������?�L����b' !%�Q>��|��VǷ�r���3$��(eP%�@��� p�_��,K��M�|�l�V
�����a$A�ne�;�0�n����(�� -�7bd�]8��ɠ��N��E�㨃����kSy�{�ӾT��G(��*��}�C�����(ʏ˧�7�ST��	K���s��κ�+�!Q�[h�ƽ�M��-=�3䂿�-�����U"\)�Z{�YV�$�\�|�.I���N����Mˇ��T��؋��fc��������W\�˽"���?W�Q��G�r�#5�>�t�(�,dH@� �y�U��͟Q��gke_4�\��^;d�(��L�eqwbY�eu��&\,�'�:A�"À1=_:������[�**H�AO�<�A���q�Z0�J�?YC�4��S��rR@�S�������8��B� ��e��p2������
xl=7F�����%�õS���/�~	�I�p_��)��񿿚>��W���	B��qp��;�#��{b�����A�ջ���@�n^%pz	��ƈ��M�$�>��\qJ`T��oU����_�S~�_KV�P6$+_�>6�L}Ķ!_��^]<�0�5����l3�۷/b,�bO"�>��N��!�y�U�\,����Gdp3�?���N��ب�D��fӏg1C��F�08[H��yͩ��@e�P��^6j�9�Ȇ�E2x��9�LY��֨)��P�2��r�#��%}6�����y�8�:�P�h�Ff�=v�B��ym�ޝ1����(�Tm�0�ɪw���-s'�*I*\�;>^KU|Ȼ~O��
���������Z�΍9�����ϐҦ�ÿ� ,WkLF�t�ڷ�6�4Y񭢸�=,�T����
3��tM���p���^�)�nd����O�ë�\���j3Ar�L�>W)��Q,1x����`��ٌ��7f�%�6PiQ��>�]guîe��v�@w'���DY����,u{s"1Ma7S�Ȼ����=��)����+�}�*-|���a�B���i'����E�BsN�8����^r�JA��|a
� �;�ϰ���Wk�������pkҙY�}�R�����������Yg)}ss�?��W��}���=o` ��J�#"(..+ѦV*O@��Uj~�<�5*i��pw{P<;�o�1�<�YDvĝ �Vy�	��sKH�֮?;ș��D�/>Ge=u����I�V��߄�Q��aBy#������?}w��!n��z�>Sbv�Y��[��ڭ��R+t�[ B��S=�)d	;��*lߵ;�Ľ._�>KfB��
Q��ч�8L1�I6e����b���j�dw1]��rO�po5�ܶ}u-H���k΋{PܚI���9�v�;d-��&G��{�*��g���qA�1�亃��!��$;�N��1i�҈[5��˾}�S�˿��W��w?!G:U4g��g���iZ� �d��z�r)�ۂ!���o���S�bp^Q���l�׎�Q"K�&�{S��u������*�&�:	b�r3��	Y�	��7mdP+�}�⼱J����6돫cNV�C�Z��"O���G�Iy��뚨�s�h�U�d����i����C����8�/�0���D��-vp�xCn^�ZhXN��d[T�� ���I�kҐy���OtLJn�B����V�|zCu;���qGZ��A�%�����h(ɡ������^�{ί��q��{�u���F
5O 5�~Jex�d����:�	��ϊ����&/<�KX�����)�2��p!��?���OԲv�er�R����y!��3�b�}ZQb�tI\�m������ޥBˈ?\ ��N�&(�q=�$�p��#_�(˅ѕ��~*��'u���M�����#ka`}��č{�%i�)G����;�u��
,1���b�����d��UR��K5����5G�?}�����ٜ����x����VQ���[���!���t�m<Ԑ�Z�:5	):̻��٤r��,Rc�37���ݝ����<D'�8s���ѹ���液�v��2i�M���4�ʧ��X�X�!�ʵ����D��E�}~m[J��c[��jmyu�����@�y��<�3�!״
}����?d]m�n����֌^J���
s�/�u5��5�~%��>A�C����o>�F����g�-U�(�����i��F�|[�����%��\{?U�Y/z%��b�dr��@!��ָ @�O�[H�=�<5���;	��qe()� ��f��9�>��\o�_���O�1H�-[%�+�W���N����?����Z�����`-�v&%/�"� hA��KĮ�5^�7��H�9GD(\"�C���Y�/
ZC]�9t]GEG���A��xES	-�L R�A�`6�v_�(di�7R=�ɐ�*p���%�y��������=�2.�B	bt��ǒ�0�[GB���h������mfa��5���?�g4rcC��ð�Ҡ����oc��8�PGOe�F���/��?��G������o�L�2�� �D�	sm4c�NP�[p�&���P&=[�eA�R'���3��kp���'h����DT���
��4mh�˔}�S��Ս��+ow��ݾ�PB��E��z��85r��\,��-CL�M�{��U�xX��C��o���ș��2���<��ƃ���1.D�'`T*J�'���س{�#t�"/��܀=Å��`�ht'9:'��jdFb��/ 1���2=��8�ɇZ����#
`�^�pSh�9��H#x�(���b��4�*�O���/t;����
gCN�0�u`��35�����'7���d��f�[] ��({/P��Q�d�͚�r�%d�[�]G��� a������!��IJ?���Y�������%�q�����<I<��_�ʫ�Ҳ��h^8���<�Y��c\�Ϸ݈�06 �S�<��+�B	�P��JE] �|~������F�?�$/�-�6���?�����j������y�R���{�H��-�����������yRS����a�k�ƥ�[�QiP5������"@�A��j7�?7�bf����I�h��[ƾX��r���(���͗v��
�nj��e��rL/g�7�k.���Je���(����oܤR�������;fJ��/}I�JD��a�R���g���z�$�S�J�N`(�
�.���4��}��ƿw�lw)�_��Ο�Ν��co��(V���_'�aĹ^tB�7��n��@8Ŋ��"R^j�,�J�/���l�E��Y@������7���M��G8a�S�Ұi�1�DC��}=�/a�i�s����3P����m)�����9܂ ��W�'�B�7uT~��Z{������]V�F-9�X�Y��
����B�
��؆%�����M�wzwT�k��yӢ�c�$��T�g���gd�XUZ)�B���Y�Z�^8�e#��0�ݱ�uYt0n��Q��ʾ�y��.�7[~�F��%�>&�;Y5l�L �J�O���R�M�"��n�BTb�i��r�2���N�������(��4���KHY���cnk��%�#�/����m�����Uk��/������G)��=}4�n]�XxEKFEq��ݦ5	�N�r �Y������V���0S�����\-��e��Ė2�i�dᅞ߬ ��/r���ZH��� iݘ�(��3����Af���v_�3����l=�-�����`�>
�p�{����1^���&�S=�,����H :	m�C�3`����I|�ܿ2�@4H}��TpHݗ�q�9T��"8�9^�C|�s���$J����o�.=i7�L��6Ƶ�.��O%6tm��G�؇���h�Pq͖��4Ir3����t����(+:��	|�X�"��xL�qF9n~�D�c�2`J8OU$��) w����Ͷ�2b�C�/�ZR��Ȍ�I�ikx�M��1����Rh�=?７u�8��q�T]�c��<>����q��Pܸ�8a��lAlٸ��M������K�	yd��\���}�
O�#��Y�]x��[�+�Լq�A�I��aJ�Ω��B=����$(ݣ8-l:R�+7Ā|K�]:�w�ے����2���h<�����ƕjݶ,���!�����b��4�E��P�Z9�҃�v z�N�q��;�&Wn"�1DF���>���y��u�T�C��;��k�R���L3�v 3�[����pA��/w>H�lW��n\�&)]I�t��P����l�/�H>�CVL�	C��!l{Ϸѯ��U��އaⷍ��V,�Nq}�����3�o��Y���v���<���!��q_-�#%2[������39�bX��v��v�!?'�<����J�"MP�$���9�=��ðG���o���Wy�m�:~�Z�9J�|��у�" �'�(@��ƕ>K���6s�r�-���"�)M��9nv����%.�&���Ml���J-��
�@���k�Pڠ���d�|�$5Ҁ��2�ex��o���5�4)�_�w�7��r��.g��#',��n��)��dG>�-6�	�QK�&�)��އ�'�8��η.���hX�h醭'X��Д%R$]���]����I�5bĲ�9zM>���?��3�B��2}���f�[������-I��>C�����:O��C��^������\8�>;���F�����t*�&i�lS����Pj��v��b�H�[�¥ޏi�����qDDL���5��O���D"3U����.V�i���6�e~���G$�e��_��(�r��,��!B�0��l����LΧ9?�*�rBu�^��eSI/�w����e�W���V�T<�a!p�������R���cg�.�E7pU��T5���hޘË7߂K"�B]��[��Id0b��f�_:C33�m͕nމ,������@E��<���lo�!�7�E:����nUs-�$U�zX��zJ��F)mӖ�/("��;ט/�{�7�����sDO�1{�J
-iJ�g�~�,0���?7�$�AF��rX�DI��4��2!zk��K ��
���;�w�@D[���v�����x�K�kC���_�'<��� ���!0��(��Ӿ+�����<޻� � �$�{����!�*�O�[Wͱ�ؚ1�p��o�9ݐ��oPeJ�g*Oz|��0���9�c~�!�E!H�0����#���)��0��	���vd/�_��朽"�柝^�|�G7���w�|���F��66Pzj��eY<��.� ����4��*�;�1���L�l�%+��~w}�E~�����潂�Q,�;e���0�zX�hL����9�(#W��xe��J�w��%����%�ᰉ6�و��~�~HWp,�jߴ���%4��@���/�_Yq��C�pۚ�������a*R���:U��7~�R�u5��]��L��=-��<�x�ڜ}/^q �T���VC��\8�-D���|/��4��E��lǀ!��y2���Rw.*��$>G}�0W���,�$���*�� @ A��%D�鞙�d#���/A��Pg�ԭ����F�{��HH�w��2�Ep]�e��v��ѥ:�s�K|^���&�1C�y|4����Ȋߩ֓�DK���{�*#ȡR��L>���xrX�ucί�⻼3�2��OQ/v���@,���O��M@��H�����?���l@h�D�
��i�����ɚ��ms-Ei�zE�ɮͷ�ms�ϐcFڅ�;��z뱨�I~]�<)��؆�k���p!��@�K+-�� ۨf��W�ל�Ǒ�N��U��t+�5(�� ������]�ʭ�z���ò2uc��q�K�e�5����hz�9{E`�\��LH��w"�b�Cږ��.��2pY�xy��P�Å����@��1�+�9��Fsp�.�%Ͼ�5v�_�i�i���:�G_=$�DX�)�v�x�V�����5IN{R��@��5Z ]?�Y�$�e,z�@��w�9e��M��P�6����L�E�]>nȼ�voOT��`��;��{1L��5v.�9���bm����S]�zϢ~XL�L� �
"�a���3L9�h| ��
�KJ�|K�o��e�����G�S���������6�6zW��U�`:�D��ש�(߶���)��`���W�
@�W�|��vF[�'��.4�SX�P���e{����lr����Kebt(#',�Da��*$&
[��'��q�SH�*q���:�� mt4�
���U�� ��3��tΨ뼳^���7�ܢ��f��(V�
*��׮K�H�Og/T�7xx�޻'�٨�p�_�~�^�{]���U�O�=��j~�!�n�
����#m�n|"ݽ�$P�(#����c*+bN<��(��1ݦ�� ��y;1�Fo�z%
u�O���-�ڄ7��;5䎏��9%��#�/Y����y�0��u�uV���,?Lmh�Q���x*�����k��|R�.�l�s>�	?�Re����n]	�0���B�E�H�;�K�j���[M��aGx�H!J�o��|	��e	9�����@��t�HPX�`c�@�"�]���H�3���râ��؇��
�eB_�Y�����e���[�i�SȎ�h��kv�dq���^w�2DM^L��#��R��0v��	�X����v:�@�j����_L�Y�è��/����FE:.4ڌ9ܠ��"�H�)[<����8��"z$'P�`y
K�krc����v�%���F	P�A+�/n#"Y�]�C�):�sB~��F�狭�W�G���|D�8N8[�DȲ#���m���v����yW�#׉Dj%MC���I���ƛ�O<IG���X�j;�}�čM�M�!�=5����ƌj\X�T�:1��B\}8m޴�����/\��H�u�XZ[�+HҐ֡3���O^�2xU�r�@d'�[D�fK�DkP|�����6?jr���������j�\sFX�h
{%���f,�X&s8��vh�Nř��2w��!�Ȥ)��:��0�O�팴	`���qHͺG�Z>Wz�q����Y����<	鸯YO2}�b�2)ܬ���EG��8}&U{��ʶ��-�K�]��	�.��NƟhY�">.N��c�%T׉Rr�83�h�pp;ᒌ���[�(i2����F���&��I� �s���zٹM�<ʗ� �Ns�S<æ2�|���7䌥���"'�h*�(�Vz@/���}q�9���ht�$�Q���Cƌ�����.S>)�1#��̆�[:�����&J���1g=h�3�\��MD�F[[(6���.��Nf��}.ϵ��q+��tS����n$WdN�b��Ç���`z���m���з���8t�ql�H������Rޯ��4��Љ:�#N�]��́��P��	�N)�elW��I�Db������^8ymOOm��\U�̧�u,ҕ��{�;���`YRk9:G�c<�V�鋪ge ,�ј���g�� gE������ooZІ�=\DE��02s�8苄.�ڬ`�)U�(2 ���]Y 	쬞�v���{�¿���p��kx��ƀ'&k&45�->_Iǥ�s����ˤ-�H,��Nv/=뜝?P�M3�J��?�b^e@%�~=��+9����J$�O�� �@3ʺ8��g"�0����=�-E"����v�wt ��/�M��X`�$�g�)�u���tyk륻�8�8�ctfoˤ+�vtP�ѷ1\֫G�L�7�T�y��=M�2ذ�"�'�� �@k�Q���Д��:���TUڅE ��h�FrEc��T�0C��OG��4��r����b��Mƨd�[�]I�B�K(dZ�}��S(,��]����Y��~&2�����:WF�,~uV����.���Y���;܌T�z�o"��]�9�	���k���)�����1�e'�yB@R���v~�ONG6.�-`C� �DYU̯N��`I�P]A3�{��җҊ�<p�h:�<�|���	b�7;u�(�C�E����ﭥm@6��"���3�$�&cm�q�͗�2�����r!��36l����'�M��rDq�9����M@��pnW�l�B�]B�@﯂�d���P�9�_�Z'O�AD�᤽}����(�tJ���B57X��� �Q:�v<��;���K�=g�5V�&WB7�ox,,�"F�ʮ�*�P�|Ҏ!�ED�(�U7:GҸ2�LN����̾WO������L�2%åzn;3���*L��qs���$/�����ӂ��Y����ǩ�Lu�E��7��|�.*��Mד�|�X�G�_�[��s|G?9�T荏<����k��<g_"���R|���q�<EE��l�n�٘���*��o����An
��Ƀ%��L��9���X�TFg��>䫪�H1���7��z���	�OUT�Jh�;_��]���mP6}T���,#UH�V����ͧ�+<o��4�9k�-�ʳ4������+�g����s��#X�뻡XcQG��YK�̎����+�?ՃeW��G�:�-$�����8�#\�W�(����P~�Dk���R��챁C}u�>�9\�o#MDVFG��W��(Yj��#S\h��T��0L��0��I%(@,��+�^�Fz�#� ��mPe�jY]�� MGb���z׊ x�����f�ܔ�����<�;Hi��RWN�
�p2��}�	R>���t��;����A�D��N��g���(dy��Q�cc�#K�(F�%E�yXԙ���v�Ǩ~��ٙ#s���h��Y���FӰND�/N���0��vU�4:<����V�@���z�}@+%;�	��!��{��c+���}��hv���wpL�T?Xz��A��~B�H�q
�����@Bؙ����@B�%4i}l���\���@�؎T�%���
�{Z��^��A�?���J��ɟj+w�����#I&���dhس�o�^ׇF��	��=�Om�O|��iH�V�O�v�V�E�1�a�+�	�O#��ui��E�e�U
���3ٝ�~��Y��Y��7zSm�c'Ɋ�3��&P��
5��x++��Ub��T
�-Y��D=K�����H�[���� ��#}`�A쁱z��a�z_q#��u��!`L��4����Y8�U����C>�W����ς:"�Ac������}b�8��'v�
�͹�.qEG�Z��	��u	Z�4z $�J���`6{1�K�u�ґeJv��؎�Ә��OO`%�g�D�8�j����*����A�F�D^*��?���q�!�؉b8�l���ta����I��V�c�l]�]�gyi�٪b.�XZ�#��cf��3E��3����L��9� q����g�Tr?�����+
�p�Ĉ�md%�,z�Z�k�#z�8@6醙���NA]-k�iT��+�(f�(��G�Dشڞb9�x�����C�8m�x��Wɧ~���5��1x�4���aY5+��~i8�4��FW��i��P�� ��`�,��� ����ڽ��ϊpD�c3	K83heZE0?\�H������f�Ѓԣ�W̥�K��(��z��2S���H��v�O*_�l�B�V�>�t�c��y�J�E|Dr�2DWXG��S��4�A.��茷�����9]C�����Ԧ��Aa�����t���B	�d�q��Q/c?F��T��!�m�����Z	:{�Yƻ5jZ��yQ�Q�%)���9J(�q3��$�Yml�Vc
�V�շ�Z�ԸS�� �զy�஖X=Xy��c�W?[�\$=�/c��(^���!��܌L^�!��Y�pȹ��W� �v3�1H��+��H����S���_�3�.w[�!5��H�YJC� 7�!�ş��
ԧ{Բqr^���X��Y�8%�7�V��Y�@�{��.�c1NQ)ӑ��RV��1� Įz]�߲��%t�P�i�O��;��-�-꯳�|��}_�u�i�켅������0�U�|������;���EMd�F�
������|J=����,�4��V%��؃��W��#�*
/��k�6�K�\�L�ߕc� �%C�zؙÕ�Ά�IBe��-��uV<�b�]�y��uK�0K��{�KKu;�����"[#`ʃ?[�`t%��8~o��c�
����YS����x����dω3	�uf$��	��	��kNz�H�������^8����4:�U���Yd�]�K]4�6�>�j5Z��Q ���f
��)[�ђъ��E���+2�w$��0U�-���z���
|a��f,�
� �X���,�d��9����h�I���]�q�@E3ا�尦��*8�1���#l��l�v d8���Rt�e1�3n�v˜W��\H?�p���P�G�� ��2^+�K���	u ��X�T^����Qw���{�F�Ee~F(�?���[�];�����x]����Imc�M1e��# �2��(K�.��ߊ+E��5��S56���μ�c��	{�\T}��\�t���楸�i�mi4��[1/�9.N������~=g�VV�h�a�{ZV��j2�>�Kk��&4��1���fm'�챾ı�<��7\JA�k��������4rR�K��__���5��8zr�֣�r |_��Q�R[c� �
m���� Ί���K� :�a�e%��wD`\��W9����ۂ}�5gWT�+=�V�pWgѤҠ�,D!qv����xYw�D?�N��i;��tT�BP�e�Lt����[km�� �f��MJ�����VX�MzV�m��\�ll��0�6���2�ʿ��¼M�ڌ�_j�~u��)D��:�<պ��!f��94"�ԅ$����xƶ^��7�Q�ZH���AE"��*�\��i��8���b��u8���2"�U`���dd��ʠ$bc��'�E��f�h��jX�D*/�L�P�%�����$Q��9	�/yAi脳smK��p�t�Q�:�&zT��f��d�e���Ů�<�S6�����5��f�u-�d=���^�v���E?��2�wI�(n�csQ�#�;���Շp(L��h� �X�iM���%�ݾ�»#Ոg'�Po��&H,>��gI5�ҒW#��eX~���2�y~�O�u�����*�4¢����	�Ƀ��tL��g���[�Ng.M5�+\�/�Jۯ�M�ͻ	�7O"���E��k1������ށ�x�T�\���^ ��ߕް�T}�/��^�'��~~gZ`�x�~��Wω&a��~c�Eq��|*9��؟�`�gg���Y�(����>/̛����_����5�b��2˿�do���ZOTP�"�P��QbsF�"_r��k�C�;{Ƴ�g4��ӻ@�i�h8�.�n�
�5N�+6��3hj�+<�+���xh�Eľ�79��xڋm�I�2�fHT�"�y���+��[����]� ����B=u5y�=k���AS0��so�昇ҵUsA��
O�&��-%��KP�Ehҳ&%j�7h�#�<붴(R�o|+���Z�|�-����>��^��Bm��,�b�+-Ur��:.<Uf ύ���un|�=�����k��ɩ[,N]��R�	@�Q����K*�w5�F�ܓVS��.��5-����d���*��/��>�oUĲ�1�z���nTt�i?T7�:��q�
���?�.����$;�dry(������].}2���pv�n��_�Z�{���$��V�uV7��}D(�(k���m�8ò�|{�fk���׾���D�L
�D�Gy~��8�z��N��l|^ �>&vAi�M����`y��3���4��|��
�  ���|��c��I:\"�ۭ�j�nW�+]~��W:��_��pN��J��r�G�s�t��S�����&����c��5�hc��b���z`Y� �?��<��d����w{A\Q��J�94V&
�m��L���u�����n���}aO�I�� /����M����� �y�����͹�Q[է�|pn�_\$J�y2'2E���f����Ÿe�2��n��_�C���l/���>�g���#IY��!g��4x�~�6��b�Z3{��n�P�� ���HB�3��� G��t��2�^�c0dUL�N����I�����>nlD]�FD�����ϥ[�M���]h�9����2raΥR�}Tp2�Y���34a�L&�@\�T�d/�hru��ܧB朖�skmLIņ�����u ��~X��$�E'�a�o��B���l	�G� �a0�{MTP���2��/vБns
o���~���1��l�b�]�x�c���C?���]��iZ�T
,��Od���azZ5���"��c�g9��M�x7��[O.���vc����A\~�!~Z�"��Ռ���!�#�4!sPGέ(�\����H����P��a�`���AaT^�`Pc�G���{ �����[A i��u�1$5�x�1s0@̻��Y���0&�gDǠ�M�PT���!�K�X2�!��y�E�^)� |��-��w/�K	)%0���R�z>PoK�/�lQzÂ�
@P�#�j�ؗ��0��l��� �z�uΙD� V��xJH[?�Une8�ԯ)�������Ԇ"���qO '�TI���kaM;GU<�!�0��|k|��r�k˾t.�l�P�9޵����J���\�W�e����'L�^���G�����R��;B�<�4:s�����b��}y �����.ڨR�N$W+!s:�{=����&+DLn�m�#j�N�x�:�?�Y_O��']L%���%KB�Jz���7����DHa�/Vm*��ֺ>�޺��É��x��?�*.q?^��C7@p0���*�?�Z�,���a���\�Id۟�.��6�ņ۟iRI���{Z���9�3oYoa�^��i�
��7Y�j>�8o��~�}<!���\����P	�ZG���������%�h��� ����3��0A�:?F)��GF��EH�k{ٙ��сoС���� ���"&�d��lԂ�[P�N���Q;[�d��{�ئ�N�E�W�ϵ�(`�U���E�վ/����2ח��B������fI��ڴ��
�'[[B*����y���싸��$�Vh�K��G�����"�D���H�N郖^�k��_G
�f(�F9�Z��KA^��~Pc�L=�jo�_ѹIe��C��.�k�M�1� \U�kzW���a�b!h��l�B��������c:��c6�Qds�����S��k�xQ�pXy����!�� �
Г���t�|L#~\n�ٔ�y,֝m��+uܗ!�x2�<M롗�8�;->4���7"�*(+ʬ2���')��E��π�=g�m�WUi\�޷��"#������(t�~�'B���M�QR�'��$�W�y�M)m�x�߽Ii��� _�YQy^}{p?R"}x74R6ȳ)^M9���4�^�\"E4��[��6s`
BqeX���A���}-�jTC�X%Sۑm�=f1񿦸�Z�	%�tB���0/�nB�a,��n@���|��T�3����r�x�tR���TP���d��}�#�ݹ؝��9^
-Y��]B�o$=k��f�����OARm�� ��-簾�3Q~s���/����v��	38��ԹU����Ǉ}=�ّ����a�U���M��i*(�^�Ūm"����nd�O�Iՠ�yG1�6���dʩ����?ߩ��ɸ�_�	�I�T��<Y��+�����<�2K�,�)�,�
�֐V�֧Fʬ�����x����֡�2���Zp�r�;[p�nH�K0O0_!M��b<K�s)�b4gL�� �r�M!Tv|6>XҪ�o�!?Y��n;�����{_ˆ뽛\�.��I�-})��Η^�Z�_�"�|�ؔ�3��}�o\�����B����j#�r���A�^?�1O���U��*[v��J�89�BH$|Z���r B3�Q	nW��H�#;z���0[�ۇQhp���NV`Z�2ۙ��s(�����Z��-�¿��DȝvT��"��%�
k��~7V��E�=����ֽ,��j��p���?~����ٴA�wC�Y�$6�����M%��[�N�(�K���gCc��q<M��X���w��u�I���.+A���\�6�2�@zg	�gU5�yR쭠���f��X܉`h{VY�h�V�9��F+�z���~����֟�NÄh-�kF��W�{K����ʯ�'�3Ѩ�[NP: ����BU�����b�lԌ������τUz�p�:7Fw�%Ra(q��Z˧�E,B	�ПI�&�&�� �tU��.�q>�1wm�Z�e��kaW21%	zd�7E{!숤U���$B%s���@4X.�oV
�ڙ�#B~�"a�U$��U/��d��V�����؝�_yZg�mYs{�z"6&���/� ���91��)/؋9��O)lK^��m�����.P�ܺg��P�'ru*�J��ϓ�Mv �v�Vsz�'|�ɆM��&����|��@����lj�C�c*���MB�H�H��5�c�����H�r  G4_�$C�L��Si>����/���r�(�F�¦H�H�<��CU������^�Um����d�d_iz�9t�k��E2-S�+Ğ��CJ"���K2�b;��F�3[�+�j�Z�Q�6w�H�r T�����qKZ��E�qzD~J�,��+����5�q E���w�q �86нUP������N�XKz����)�mBf9Y��8�e8pe�t�b��o+e*�ó���|���f��fI�e����k ��\��о̫�L��W"-O2�	{��c�#�K�)V���/��aj�މ�O��!�M�:Ux;�]_�夢2��xVJć �
\��f��v�;��I�U*�C���(.ja3������:�_����%����[ߴ��8 5�zuI�r1}s[=ﶃ���ttQo[Aރ��#� �:�8�/�=^���5��n�н��:u���4?hs�L.bLY=Z6��ٹps&�I3O����Rr�\ ���	zߘg��O�1�+�� ����s�qUq��+���4�EY�)��	��(Iw��PO9F/�̯2K�Bl��C1��UZ�fhN2��u����EsX�vጛS5š>6`и��-px�>7��ѢH�6��h��%�v���67�Bc�ـ$X6ိ0���>JeB��n�!4Z�O>dM�8n�C���)<��#��Qb`@��9����|�q�/���e��R^!�V�WE@$4k	(�k{��f9���Q�J�(�#F_)F}�I#$UBl�!s��vv@W=bc��<���ws+�M��7��N�a_�C���L�0����с���Y�(E[�{�/�)���c��T���`"}Ե��G��$�i����t}�n5n%D�ڭ��T`c���q�ەN�B�<U�F�"zq��B��_V�i�<�{KA>;��}���O����ځ�s���X����+�׎"0��Y�d`M�N-����j�r�p�:�#��%q�x��]��@�i=�����XvX(�æ'f�ܴ�&���]�mhy�����#��~71F�������;��I*��4��K�b�6����$#H���`�aRI� ~�K�P��P*,3��D�˦O0��;>�����t�H�;!K�j{
�c\���X@�����s����(Y:D�_�
zϝi�c3/2�@H^8�O�w&g��r:w�V�yL>{B��7^_�x���15�`O�[�Y�̀�ɐ`P{m�7ç��"(f>'/���G*O��I��uD���@I4u���a����@X���d������ү�P�ꁌ�����]�B~�C�v��I��J�H*��㮈�U��Q9����S������:L�s˥�\��!��E�-L�8P~R��4�X
ZeL�jݺ�0�҉޲�*�,�=8)b��a>����(UJ�s�*�˹0_l�|�))�"����`�`�W؛̤d�q*�gy�C��½Y�2��GHq��3/����\f����D%�b�EGĦ	�����ȶzq�O�9��vȘV��>�T��U��������њ�Ի��%��ٹ���*J 0N4䤑Z���d?�-��P��q����P�܂�@�,�K�P�lYc:��0�oMR��]��(ы��P+bl�Q�r�@��ʾ�N=~Ό����8������xaBդK�Z+��Bn>i^"������(;�` ͞��ϗ�w6�mPbt�pF�/�6���qN���`���l�J~$L�����39Y�5��c%�i\ERƛ�L�R�A��5�����:�(���8�ͽIѰ�8��Q��|bk	�S�����Ļ <	�h�������<C���e@�����X��Kp�t)��xV�`f|[��/Y,�j�@?���u���"��F3س�gr�6vyR[��6x\NtKޟ�3�
����=���z$���5:�.!$+)~s�,�z�	ҷ*�^�M$��������>��r2m�* �<��`���9�����7��$�`��g��e�,�);�y8b�'v��tڐ:��M�Ք;�>������&�I��q���aN��Qe}��!��or'�'�7����Eє����ǩ����q�j�	\"Q���-��K6:�z�F�W�U�Q�'AQ&ia��w0'�{�.�w�C!�=O�%Ǜ����!�W|b��QMHȨ��Bzw�u0��!T�1��|�Jz����ޠG�{s=8)�Ggs':;@�y_ V�Ҏ�[���~�p��o�2A�E=��a��m���L3�u�1�+�u�ž!�AÀ;����s��Gj��	5�&&��|���*���v
��Cack,�H�kv��B�4,���`��֓�	�E���V9��{�����`�@�1�����O�B��q8�	� �k#��Xϱ��+v�̛��EА��ʄ�{��jGP�c�4QU��_V����?����v��%M�5���()��v7X��)��f�:�	�΢��(%£��=C��Mgc���X���at{�Ԋ����n���ŷ�K�>�9�$�`��m�ATKZ����U�J
T��m	bv�w�ѥs-B?9�*�����Y*E�,~P6%%w�f�w]Z����\�ʑM<�̎@��i�z�n@l�Z�껈!���^����`��� (*3P&� Q���;��H�W�G����ۢm 5u�ǋeΨ�1e!熴����M���P��?��~�clh+�jWJ�ͺ�M�:`8c�0�w�5����>�`�� H$�=S�㇬`���CN��d댱���Ȋ5�g��@�0u��j��Z�vAk�f��?p�+?�M����_5;̄=!�eޖ�m<Ω�:���A{�K�����C�%*��.F7�8-��`#�A�u�
ҸLK�X�"W?'�v}ԒA�TKH]��ej�ю��	�dJ���k�7��>����ݝ$h��i��d(Z<���@��-������C=&�.���6!���ZE��Z}���0PA��C$�MYj�s��E!���B�p�(VH�NnuA^	�(ݕ��u�ss��߽�S�����b���I;]ؾ���\c)8���Cvľ�J��{{]=���o���;��)��T�s�-p�������u4�Ҍ�W'�������J\�Z�MX2��G�9\����'!���Ծ�)�n�d� �l�pIr6�f����B��E�y��(J�(�Ks�q�"�k��Q��aEx;�7������l��0�N$��y�!���%�
��Z���g_?�?�)�jL6�W��U�[�g�zb���� �8fQ����ہG��e��c,
��e��x��L���\�8�'�vp#���o乧I�o��X���%�Vg,Gn6b�^-��"�>�����޻���YB�y���I����  @������O
����69ꄾꅢ����*;3WT�!-�5� D�M	�H2��x��W[��!���ݛN�Q�|4��~�<���|\�p�?ZN;F�՜ ��6��ׅT���: ���rP���f�6���#S.i�=M���x�ӣ�S# ����k��7p3gH��;ҿ(��Q�L�r��5��i\�eO��*z</����ZP���6���w�����^�=8^�a(�U<F��K��#���}�{Z��ľbD3��jPX�pme�F�e��A��9�D#Tb��˗1<�c�}<W��L�:�P�s0k�lɱ �,�&$�ᲇ�b�^yS�H.�F�^�.��Nف-z�x����*���ufa�oz�� �Cwl��A���p��J[9׼ �C�Bl�*}��F�0�ÝVC�����t�x�+�%cRR��W
�we�+F�-rE��KR٫��	��=�L��.�ï}���%U[剮�Ȉ+;�ӎN���/8z! �������C ��wa�\]iA���Z����r�Ќ�Sf�SM��Z��$o�@a�.���sxV���=`�mT=�����_�1�9S�FkI1�=���q"ȇ�~�w��윙����1�aQ�ϊqE���I�������U@	�ި��r�2�@�߱A�S���t�%֛9��=S94�8��Q7�_�ĊJ�ʱ��t��s��u����@@r�+aA87���nc�2���U�#����T��?ႜ$��kG[et2�&Qt�9�4/R�ȩ��犝̱߻e�A$:3�8�����rg�<q:�JS��ÝLwe����M���o���� a[G�H�	����3"��)d�A�.�e5�J��z��cN��}8�,@���m���^��A��H���ꘇ�cU[K�J{�yY=��bdx,`�9�����A�����\��B[���ı�Kl��',�
5:^@��j�/d:�& ~�)#t�� ��%@�1vI�[N��`5�����_�;��'��i�-a�o���`cc	�ad�-��٣ڞ��#�|���6�)�_��وf>�Ev-��l�'�*��
�i�ܑ4c���4�U%���� ���=��,Fgf%�QV3&A�n�fn��!���xN�7��g�|<���*@%X4�(�w��]z��7�}��<�<�[BCHk���M��u3��	m�̜=����5�V�"�D��c��0�ú�5�jWв,�\6�c	-���?'��Te'ɉ�yQ�W-՘����_%r7vet�LV�?�(�@	� c�ȫ	�r�m��i`h平�ܲy�R�Nr��sC��;a��\�іg��K���~6���`��ni�@�耷�B�M�^�V�Uth!�a�
rP��U,�Տs���w�����R3Z)m%r&2��M�p�O'�f�KԄ�2���!�2�bmsU����K�^T�f�׺V�g"�	r�T6l'?x��� �,��Ux�(�B�(�yQ~l�gi�dˏ��=	fK�XG�m*[i/��r �J���v縑�0�kO���� ��4:�`�cq�"�(*
Tr? ��ĚK�dv����V[Ё߰�VE�wC01�]xZ���N���������إP��lʊ� d�h�������ϸ�G�u#޾e.�,�9r�ؾ<����C+U
�>e5��{�k⇥(��F���j}�yϯ-J�xW��3�E�\%�+Hlɶz?�h���K ��Yz)^	|k�(��M�������z������M�]NtiҘ�z�3DA�D�-��ƛ��|Vj@��F�H�!�a����ӕ@���8z����3��N�0e�C$� ���*��4�A�Gc5Z���e�o�}���&��A;���E|��5ɠ�!S��`���+���.C�;��Y�$�)T��b��O4���*MΤ��7�C7`��G���q�	�NX�ƅ-?ͳ�A`��Xp~�K��@	�M����2���d��v�%��������[c���B,��������M*��;�9��_y�Qs�\�d0�i5�ޮ\e��Ed��gS`oi�8v{*��J�lZQR�f�;͖����bF����ia��́�Q �*On���i����g	y>����EE��hG ɡ���7��Vu=@�m�9@i�d��e�9\i��6Tj^ɜ %�e_���N՟yP>d%�\��x�8}����JKI�|�3�R����awf�����̕���y��d���(:�=��Ƶ�.,eȥC
��7u�=A)I��L���<{�O�@lFo�������uQ�]N���[� Q�4�q+;=`����K�3�9��Y(���$m�c��/ֳ�ƧqUA�.di�ÑH5�{*r�{;ga@�Ǚd�:�LS�[��\֥S��ϬNL�]�Zl~Dao�z!U���|�1� ����q5��x�fm��&��#�[WG�������3�ɍ�\:���0�l��{[�HXY�P�s4���3��6���jK�5��3̪A]JMg��C_ޘX���5�a�d�h=��D"�#~,}Hq���n��-C��<=\�pfTc��%G<H
����b\����ݍII�ɀ��[0��c=_�b��w��z߾)��U*mThjX��{��;������I�����9�7CK�%�3��W��V�����[j/ye椾�ǁ.����i^V�7�H�,��_�^bR���C����Fp�78�}xY��<W����:z�@a���� ���#�l%�s�����L��M�Y�\�C6�r(as��ف����\@q���}����~a�Q�Kv���溳s[iLE�ou�n�uX���YV�#��L�!�4��
��6�A�he�ذ�W ��Y��%Y���$��p~�ZR�7�/�XM������Z\�8F�5��D�m̮b�M:�u�6Ύ�|�
h���J!�� �B ���1^����6���A�/����b���M�m���lt��� :��2GC���^�Kfl�i� u��i�Ƅ?���o��rdm���{�p9��_3�?�1pGe-��6p����MF�$#�Uآ���|7��f���T���֠�9b:3W.j��U���%����q�{Z�iΟ��<�-z���������]��G�����gh�����6^Z�?H�B�ס׀J�| &HAt�-�A�`��z�~�>zOa?{���i�ٝ*O���fI�� \�,���A�?���D<�h^��Ih����ڶ	z����{~F:E)?�6��k��?�?�fs�P �7�����Z �~���4����2��
����n�m+���1/�����Q�Y~=�B���v?�`�>0�{�m,ρ�6�#����k���2��C���B�占(�u���&��_�,�8�a�|������q�����Ee\(�iN��rg	Y��2�Twd��������,�AS�2j��+e����D�b�w����%�GŲF������%rn8$v$Î�0䒠�uz��BUϿ�; �����o���A��z��;��%��0,���0h³n1�1%|���!o!�c�^Ρ���RH��ȡ�==��Q%�@F�2'^��%3v[�'�=�� ���h����LT����O��P�F�� �S���i�AB���&N��H���xBs�V>���d���^��Ioz��fQbA�� yM�~�W�Vp%��77�,x= ��G����8�e�j`�.A�Ζrh8�rDi�1��-A�X�P�\�avtw[��I�h��Æc԰!��![@d3�l4�ѫQE߷V��0�܌��9��:ك� ��v���k�%��1\&ζvm�&?3��x�+n;��R,�"��W�	?���37�װ4}��ǪKў�`]�f~�E��� ��� |���&܉V��
u�d��qr�>�4Ʊ����j��u
j���dצ�A�X�t+%o��j��a��myP�12��N�4���A ��ݑ�'�ّ�D�\͸�Π�ì�ּ:�9��8&Ҁ��6�׾�S��E\2a$@�e�A�ء���R�8�";��uNŎi��_�r��	 h�ۄ�,GS�Zu�,���/%H
���R!�)5+토L�ׅ������)�[�
w��"*�S�!�Yb���� �C @�*�<�j>���[)50KD/����7�hOꈀ����;�Wߪ���Eۖ��\�FV����C�m�o�:���&�n��������W���a޲�4�Q����hXK�4�o��8�]��K�j�k��Σ�]ȣm������A���� ƾ�&���?m;zDﯺ�pl���`����Η 9��b�A�2�)�$X�a�:6qt]*�iK��
��b������讳<�}eI�b�>�jd���4��"e4{�KP�j]f۠�Y5!���JKa���!�E�ܶ#�������}uڤӴ�Xw:��ū��8��}�>:9�������y�Q�����pI��	/���=��ϸ��h����|G��27�
A'��Y}z8��T�E0R���O�Ћ#r��Zu&������;R���|s���E�A}�ZۦyK{:��[��1�{1�TR<Z�>�k��X!���,�)�8�/��Z�?߅���U(�/��[7 �G�]T?�����EP�+o��s7<\�,;Jٌ�Ѽm�!���p�q*G.-����<��%�������D��ZaئF�f�w5x@�zk'|js��'-���{~�N�~)��W�[/;>8s��8�P�D�B��<kW}�dB��O�G����v��=}[�,Ә�8�߼h�)�����DY��ܶZLZW���	ie���8ъ��b:�"��`�RvC^H�& �����<�K�rEs+$�.���ɵ�י!��b�̪J���F��?�ޚ���Cҍ�4��ϗ�_���O��ݼ��#Ђ�>������/㔱$�D�菭��o%�[��yk���+���R�	#�&EN? �/����d${}��4��ĵ��oyq�iJ��>�@�s�УH �O"��A�fG�艖D�ԅ�#�	��m�������!&�Fr!y��j���g��Yg��88-_�&F����\�(8�
�����<V�� գ.�_�O�'��3�T�]I֐��>'K�Ht/a�^,)��ǋK���J�@s�
�5�"���A_��[���n�ЄÅC�w@|�(E���E3�9�fϒQ�h�R?hv@��� v�0�|z~�H�EP<�l9�-p��!��
����~g��ZF��qR�kjH��%���I�@Ib��.U�$�Ds,�E	�J�C�rq�I���pX_��H�.T���;�]���4P����m�m;��c�uH�0+��8�u����X�C������K���_nF��դJ$X*�2�_&+��ưw7`���X]6��`ݍ���� �;A���q3�16�醳H��aS�*W�6&�L������	�%:��lB���5��&d]�����C��%���-}��P��(��������m�ӹ���3;v���{F@��ȉ�A&8ց�<e7��B3�t�=��9��@�����T����>�hϻm�r��
�2��0Y���0y-u���M��jyL�x�wZ��E��[RR"o����ژ��Ӂ���=c��)�Β��J��P?<=���}�ݷ+Gb$ux�� �h!��m9D!8�gW�����������t�k#v�3�,�fN��}���pQ������3I=Y�(	=m<�ep�`,vئ�p�?������e��8Ȫ�M�A�1��iK�����9!�=�wa�H�t����涏e�C����q6^��\��G�����`�8�G+� ��(`�X5�}�E�~�59��<�6T"hm"�	���
4s(wc�X��v���)C�r<ڒ�Y��1ߊa �|��Z�ߠ��Lݰ�h��:=`��/���K�����|�֕�������g<bb��KS�"?�����Q7E9;��c�N�0��tw�#�<_�c�jK�zu��mk�1>��.L��y1�z��*n����b�T��b" �Z�ý���

�J�S�5���1�+LY30/����3/�d֭�?�'k����Ǘ��n��2`�Ozh�v�#	���O�z�l�D%m9.���38����G+0�ߟ�<���Y>�w.7�6�N�Xx��z 烽��(qB"�X�|�ߞb��R�����"�9�]|q�SRd��5F�F
D���4�:����v��E�i�G�`~`Tܹ�34a���_���!!�)�Yr�՞C��-R�>����#O�<�Z��5]��ͧ7Sv�ic��1�=�$���Ҟ�z�c�����es+�wd������n���M�f�n�� �F7=�b ���!��3���C�����#��>�z�P��I�R|�nD�~e<D��&e���Q�a�d����i	�F7����RХ�B�(�2d :����]�{�ss�Xp`����`�DB�-��k�}˄�{��y^@K��S��6�EX���o�҈���^+����ґV
�|�����8k�?w�Be1`#�ap�^�.���~qQ�K��[��	6E�����+����Hg��䉕"��]$I"��Yҳ�g���M���{�J��~��֯n��	���2DC�4?m�{���oY�J�Û'n��ò9��1�%��*��'tdh�>M�a8�)RsRf�9�n�=�V��{�F�zJՉ�dEq����%'7]�9C0n�Ub��j�	���{����6�E	-�R�s}֧!�\Y�Ə�w�v�3��~Q�Q���W(���zSP��DO��3�p�a9u$S2��@##�9d�]�$^�]��[!���D'au=ܕA�"�L(�+,1,|7�����=���;ϔ(K]&�aK�KcӃ�ϴ���F�ɒ.I�N�G�7fB4�F�P�ɢ�~�$�g�ͮ��I�ZJk)���S{{wZ����/O��s�6�� b]B���D����C"XW�ƞ�g�+��n���c����k=[�4��6!���ǭ�i�����eV
��C��[llQ������"�<��S@�Co��܁��}j,T�;[f�l}�J���]6��0{	cEe��̝=�b�_:E��"
`3���HXx^=�>���� 4 ���_K��hC#(2Ȉ�۷Ϸ$W�_g*��:}�ұd�x����E�j�*тJ��l� 9Em(̈��(�ۜB3"�9>�K�r9,Uv^+��*߲AQ�+�e\
%؄�u&�ʊL]��`�2\������A�mG��|X4�nT�(�VqGܪ� <�'��>�IM��:5Y���b�g>�̮���C�7��2�n�E���L��w}%<�7�Ĭە��/�6&�+��]�2NC�u<��n���<��]��� &u��<���M�~�sp24�842�=���t؜��nmK�n��/�/c����O�J	 ���}��]�P�T`�@����$�R%��Z��0v���R������G��mE8����p{o?y�6C���Hn{�3!.Q�oS��Yqe�:U]�#��D���R����CS�&�a��o�W*Ԣ���g4��n+{��d3�B=�< b���q���x݃W��oz٫��<z�� �_��7�W~A�s����|��9m����1�$s��T/h��� Ii
S���Sx��ӽQ�S�^I�\`$����1�O#}�����}�ƴ��W���[3�/�q�I���`]$����<�w�>�jm��d���Kx$�2�������k�)�m������^ﺱʼi+qw�M�& j�\�y���3���E�:Ƨwj#�1��:HjTu�pEȢ�)���g�V�#�0�>PT�p�I����mKͮ��TO����wRF�K�9���(=�q�Y����T�ǰ�Kj��(_���&d��ނ�F���!��?�DO8p�(MÛ���I�
���8�r �Ar���;᭱��� 4.F�M�H��!e���Jgt�U��O���ϬCL0��g8��S��V���B�=�]�X*�մCw�L�Y��l�l��m������
O�k}<蕌�Y�6�~�o[S1^�	�!��C�e/���b谹[���U�k��ĺT��	��"Ϛ3�m3�4�����$%�!��ٸȯ���X��?���/,�w��Ӝ�CY�g�kU-�B`�hZ�NtJ���<o<�^k֍�N�+m���Z��[z����6�vW�Bm���UP�����W�k��]S#l��|a��/�wD����/����*{Z\{
�¾��I2�	7�9�����>`򤸾*u�5����SCq2�����{�T����L�+$n��f�n|��Oj6����,c�\��:?��v��#M����b3��f��C�A���~%���ixk�nC;�dA�$<��.����~Zr�Rnp2h��S���f�\e�V5��"�H?��"�%qg�a K*	/S�JS������I&�wh	�~6�����=��4h��L.��|?8�,/�L�SL�7�o�s�!G6N�r�"�W2����L�-���ʉ�e������t��=��K|d$��,�~Z��~�*���mtV�C��83K2Tͤ�'�Gq��i�N6k�7����\Zt���y�')�c�}���φ���F���y�9��%�y���%���-pTKnK���v��zepd-�2_�5{�:n�I�JO��Զ�.�L5غ�#�ee��� �Bg��n�*ޘ�[@[Y��ϝ��h��D�B�?���xJ�^��^��i��}����Ys:�p��	�Ptb]���L�Ǜ�+Iq�c�f����%�ݥ�N�x���y_ ʔSj �y"�1�!�T�=��?�^��K�DEN��o?��s��TPU��bfXIy4�[8JXe8I9S(��=~~�B�t��74Q:R
��G�W.��m��XO�)O�훌�:��?�T�zQ���R�y��Ϫ���{3��z�����`O	� ~�X/mǏyP]}�)��B���q��r:�񂛩?@ǿ��~����*�W��ǭ���iaI�mHB[�U��+��c3?����i�$f���
�z���~N�$2���<�����r�q)���f�x_kC���4*Ճ�_��6'^(��Hu[�-聘Q�]��w��+5�������ҵ[v�fڵ�mx��I�0,�+X��5��������kם��7��qx���ԭ@�)����$[fFo6�{�<�'h��@�
�31B��1�~%����R~IҴ��O�����%/��残�\���P9����9��_v��Iq��\�?��'.�يH��G?�X=�|c�W�m#���@���9z����<�VW]�?:j1� R����<����Ó]��Yצ���֘�!n��]U7�3�0բ�2JKrg�`����H����{�P6v��] }�ߴ��#+�R�r��1�K����鷒$i}��3]@�첾���iF6G�Yg����pZ��?���ZF~�T�HVD_��-���5T|ȤS�F�%F����p>|`kNy ��@�e̬� ��f���SML��>�n0�V�̇����gM������� n�ĩr$X�O�����b'��ܼ��j�㹩͞��^�����x���^#��96�n��h�) #�e�?��~����}]ZO)�'�j{s��j'!�Ϊ��Cw�&A���mJ�h*8�b��9j���ǝ3֔Q����.w�\gʞ��8�i�fIEO8B{[g�:_�_)�[����M��l���L@����Ǆ.׺��<+=d��X'�&��&��4���:�2��P)�N��k�[���ł�^�盏����{�
�G1o	�r����ʈV�0��<�N�亪M!�v�eu
�ViEe��T7ʍ2
���bR�*e<Q���.��v��Asr��J	f5�m����S�imn걪"d� u��.�9J9�gŽ�ݩ-�P�:�4z�ix�>U+5��s
8��U����������a��8sύv�诎�b	��&5�_��	U�a[�N�u���������w����h߳U@Ͷ�<A:��X�U��Sx�^9�0�n�ݞ�����	����3�+i�yh4*��_�&Q�K6�V5�-7����z�#�9Ϣ�q��u^��1%.�Ҷ��kg% �۪�f9��U6*�+�X�Jۅ�\�*��S���1��LU]��8�r�: kH�j���'���o���w�u��Y�G2 >
�9�e\�Ӂ���Fܪ�L�*��&o�PA�I����<=E|���u���H�]������y�����o
p��gjU�&Ώ��2��[��*_w&�|c~�c_7'���Q�Y���Yj�(c������@iA��yp		'�2�k����"�w��(ʒ�U�{d�_c�ct�K���R	�.�u���>��ݫz>	_���^�E�՗-��4"n��U%��-��P]�������	c��6���{�]r�VЃB��]'�މ�����(O'-Њ���c��C�s���?�*%��eYj ��c^=W�[P���ϙ������Z����[+�D�uOvI�8�u�Kݠ�O/-t���~�W0]�]������{m�v�!�]r�?����z7�����!!�P�\�P[�cY U��pr���$�taP}Q=7��rK���P�`� �Ř3�s@a�%��t@�F#b���㘬�՟ES�aI�H������d��O5�@ut⼘����_����׳4�ؐ؊sp�fs}���Kr�.�'��=*��ؖ�"�K<C���{�T�ˣ��߮�vƑ~:���i*n���=��r��3m�q��e���	px�G@3��dq������CY �8�9"%կ��q���F�=;�_�p?��H;6M��5K�r������� �u(9Z���n8䇙6#������ɗ���Ƹ�O�ϱ&��-2�`�7��Ռ�'r���'f4�s�����b��2[�BL���5���!* �,=��L\ˣ��tm=�2T{�W<p(5�"��ho����~�vj[X�`��X���Ô��Wg����*�z��6�j���Es��,lṆ**U�o�(������J��o�?G2'S
��m*���-.��؉'��"	A��p\��v9�G�/�j���a9Pe��̫k0�Y�ǹ�JeH|���Mi&���-��4�c["�~�����ð%��R%���BV�*{�����{l�8;�j'�t��΢WG��y��$�E��Ӗ?�bK/�1c��TlX�.�$9��Eu�>�ɰٽd#���3��LMJ�9-{Y��ǖ���<�"t����Ι0"'`��
 �-�,44ϴa��n�F���gwCQQ���i딌'��(l�B!�����3�f�Wr��w�U���X�3��,ke���3@aԾ ��)���/���ΐ\�xm�C��~Ϩ�sO���yK#w8�h����SM�r���K-�gp�Wzo4À}���?ݨ�Tu �����&sFCk���ݘ@�5�o��\�({<���8��B��s��=��U�0�?$|��i����y�Y�I�?;��e@��J�2�]vDzs$v��ۊ�vn
S콮=�c����]e:Ϭ�:6%�QH�1��q��?.nSӧ��^bR> o�ki�YfTK�CPڳe�ܮ0�Vm�i-�X���J'q��XD�C��.��w����rYk3�ɟ��I�T��&h���G�Ƥ�/���<�s,o�I����q@c	6����IU�qX�n�nr���B(VF�E����`RH�L�s�8?)��e�'�َkrQ���1UT_���*yC�5�z���2�F޾r�z)$�1w&��
����\y5�kE���eѮ��J4���t�8N�{�%JF�ݞ��/�%NO�DF�1H?V����*B���1�!�h�c ��R�+|g�-q��wN��Z����+�������@��!�4�f�i����{���S�1�"{wj&z�JJ�y0�-�����`�<���^4������64��+IJ�&R��@�Cv���e�a3
s�`*!o9�8#��wv���o���������	!�ޚ�p�,}�U����e�34;G�`��,�k�oUʟoQ�g�1K77���� ��L�o)�ž	��� z�c8�yk��hk}��
�WBP	0��lJ��0 rHBY��f��!����L��Z��-�[l7�F'�R��ѻ�X��yM�DA�v������h����X��%T�6'i�5���[*��s���J@�ڭgˌ�l$IdvX��:.�?T	��@'2y�1��T����fIq�
��v}Az�wM�N�4��M�L��3Y�%�R�F��N��%P'ײ�g��H�!CD[��،^��p�����>q:i�/�`�a��^��C�30~�Ts��CY��a���*�"I�]�x��$&$�q�<�ǲq���ɏP5<�Nr5��Q�~KabR�y��Z�q�E��j�D�fb!OZ��Fң,��e��GS*O��lj[x�g/�6'�h/q��R���XP��{�P��H���8�.3�;3��Ix�=��KQHOL?m�:`Q�����0ῩZ�^���_�ʽ���w�z���k�gV!���n�XC<U��Ƨ!$�ٔ=�<�F9r=�ӻf4_�,��]�hG��*A�����Si,�.����	2���%<�½7������O�D�L|�(�j̱���r�����&C��x�]�XJ�;��m����)6��7�8�i�: b�$2x���r#�FM������B�����M|(���q$[f�!�҉�W�����Cme��
��ߞ/F4z	؞yT�u��GIz���7|m�c��9�T����3�nJ�'	ʃ�X���#l:��2Qt���mD�d�o������p� %d��]���B<�a�4�82}��I^튡�� L���.��^и�OF%[X���Ǹ�٩�:��5\on�6��g��ğ}�nQ�L�
M5f{��I�K�n��lޮ�%��<��j��ə�/�Oî�Z���>�:��/g�Ł��?�^����t}]%n1�����֣�%c���e@�ወ�a�{��UiY4�g��=������~�ė�}���Lސ��f*ϋ$��s�	{�x��^�-�$��H�@{�ڈ����/
��R���|�F~u��譖��)�K�N����ԏ�.ߑ#�^���U����?��k�l�y�TO��e�K�n�H���7!�T��̈�V�	�o)a�q�|�H?nNTCL8Q�c����B>O�;`������Q��erI\3�B��Ɩ{�q�u����T�6ը�$ʙG�U?����&�˚�&��	? l8�T
=}�L��AV=��I�4}c�L���M��w\��R��"��yYE�ڟ��c��LA�� �/�ZVtq�pˬ9郃���O�Snו<���i�2�ӷq$�b�s �O�Qnz���b LU-	�S�,4��E��
�j�η�>l�k*t@K��&�p��:'�_��`4#1U�c.��w��lr��Q���!���lp:� �nH��w�L0���΢#7�?��m��u�����q�ĳ�	(�f<����Z`|$#��xh*-h�~�����ĲjD�ٱ�a���F��k`lN�vr(��)�z¿����Z�i��b�gVdh��Nw�c�I�F9��Ҝ�ʳ=���ר�⸢�P��c
ƭ��.��C~�W/��fY�k�*�d~G�����%��L�v�22)7�Y���'��%}e�����c��}���e�v��G|`�8���R�c§�d�m�_Ƨk�"󂺷'�]E$d�⊁��"fP��a��k�z\�n��K�C�u�6��>�Gf�=�DG���H���xf�]�d�}��y�!��}���H��A�6*"�Pᤋ޺x�P���U�T ��N����0j�0���rp�v����^�y7\ᄗ7�f:�9�9|(���b#Z8:����U:]V�6H�)",���0=O~���f��� ؓ@��p~��\��x9���+�9�iS�G�i����'fl:�9
�6!���D=Z�ƥ��+���Q������b�{Z��!�q��:��eϧ��<�O�غ�qe�r`ҳ֬�
-�{�ؽ�Wf�H|�?s��K�;�â�C-	��gJ�C�O�o)lDɘ���8���xӜH���H=F
%��o�A�]�i�U�3��x�IRaxl���em�'��5��z��l���Ҵ�P+9љ[�zY^�������z?�m�gG�e][>t�E�"[}�L�h�4��X�RM�e�܍A��� �#�o�'X�k�W�=?l?������ٜPLsf*�k��=�>��g� ���HJ>)F������Z�K ��I�8'�{��9ļ/�����(�<���I����Bzz5{������+TR�a?���Bg�t�grR7����0XFP��e��E�P�%�֤*v���k,�/�ݍ)T��tA�x#C�z��5�*E(�8���]����rw�[?����Y��	���yI����|HKe���qzn��cI�`��1��Y��1K�O�1��!ȭc��pGT�+ڈR��|�ؓv��'��ǼT�PL�ih��������  t���gآ�E٠VS����`�v���`�Z �"�-Z�$0#-����U4����k��W�����Oo~w���4�:���
���Nt����-uq��
�;�CAf��ٻΈ��S��P�:s/�����5l��U&\/w�X��V^��QC��O��R��f~�,_�]=;��0��O>�4�ܷP�_�N<*Ri� �,?h�M��^�!E��ɚ���Ln��Rpӽ���r=!��M3��n��3���x>�����[YE����?"��D��F��`=�M(v��^� Ut�D����<E�>0P�2 6�������Ed�C���Ż|Iv��'[eML�U�����y�wT �sk0#S"��Phu�M-���.ۤ枙A�t���C�UtU��6`/�9��?�0I�͙U6�eɨ�C1q�eΖ����H���;S�/ ��Maa�y��Ι�%��� �8��+B�seZ%'�k$u-�b1�(�{�(1K��!6�{�<��
�$I j�wNw'�>�?�?4ߦ�[����Np����4X�*j����1r��ߎ���x<�X��~�Vz��r�x�j�r��6ƑD�K�g�bw������������FcK��x�m�4�����{�ᣈ܀V��QؾP}#x�������z;��^�w��i���ZZ���1�zș�T�M-3�.�j����X#X�rP���:�Tև��Imâ{�Np��5����ycT^�n�̇	�s�>��kbt<�%�0�s7��8�^��4O�f�OH��G�N f���<'�τ)�0�����4�y�cB��R3�6%����Rv�"����О�C14=ݴhW�KP?�ԣU��B����J�Bb���5��}��MbW�I����dw���|G���-'�5$a-��Aˌ�?cMnҭ��#�Y�ԏ�7��)�v"E�$-?v����g,��n/�aמ���|J�`m�v�����~)�,c�PI�;���&��?��-�����~��Y$v �0���u�}N�����`Ej;r�D��I�(>(�����;`���ʏ�O�R4�Ŏ��$/�������H��q��XfM�<<ޤꠡ�PX��G��˼eջA���@܌�>�;�9��0}����c�n�9�o���ӽ
��8X�ݨ\4^4��x�Hz�9[�T��nN�(F��ݕGڡ�����S����[��8� `�Q>%B�*b�9�F]ґ�,����Sp4K�!�]����#�(��R�$?�烒^\��xB�,���(���#9��i��Ei.��d|6�l5��ű����t/�
?��к��IhH�a�L������g����V�ܹ�tЛ�LJ#�|��g�>�٩���$p��W5�ZԾ[C��|*.���'aLd�۫dx5�).��"��i�!�א\���O��������%�:˖#�7������\�hu�މal��18#��!>�`@�+CT�0�ЊMe�L�~�K���m�,��k`�I��r`F,D�+�I�	�1>7ذ��=�����/<�9>��q6�z��f��L�[�Y+t'������Ɂ��V���r���������V=��ug~Q�1k�m�(�:w�h��D!�S��C���x�ۍ��r���k��7�υ��.���f&��A:ͷ�fF�vL�BWҪ;��8j΋�H
����߳}��C)8L"ݞ�NfwT���cw�`�y��G�Z����pK�[�%ٯ6��	Gn4Qx$��C�ui ��d��tXA�#щ��(
���)]S�)!���հfm�S����jVY��V����2~�Ҷ��;^���vFmf~w���G��{�Z�:m�j�EJ[kŧr���2	''C��	�Ҩ�4~!�9�_TsU1�O�Į
�nd[�:�3��r�'�Xv8eg�G�%7����$6�(*'���s�]���:��b`����a��8�A�J�,ku��tjii�u�;��q�R��Dsa�Z��m��
�����k(9Nbe(V��1���zfi��|X����:z������#vPВk-Z��q-��m�����ẳЍ/��o�d��v�g h�y����(S<�� �43������a��jC�L���^&Ýy���+}s�a�W�fўT�z�m�n�h� ��1�Ta���m@.)�(A��,��#w��Ժ��nH������KLl��q�fe@ަk-�4�!���H�	�jVg�Q��8h�C����`IS���,�2g���>]�NT�[ߒ
�mX#(���{8�:)�7jj�Q�.�+������������ޝC�#�J4m wK�t���M[Xt���l:A_r`�I2����){��W���m'͜��t{Xa�>�
z�f�R��lO�=�Z0�ٍ.�4��B3F�RL�~j߱��J�?����C2u��8_Iʼ��WFCC�#k�CK�BuzhhNə���킞F+	!���� xQ�/����a����o_�4��xa�C����q9k��<��Q�+��3r���m�rn.&��U�<vJS��Nʤ7$r�>0
������ /Y�|y��Mԡ�k�WD��a�F�z��b��7�um`���������J���."nSm;���Л��h�a�݂���6�������f�h��D,�pq.7��*t�0�~��:�������(}d��i��]��]9/X� W�dĂ��v�k>f�#����������2�ܒ�Ք�l�e����D��a���6*$�L�T<n�'[���1E�q���.�����F-�����o���������q�λe�h�eG���dr:�V��P�X�~W�uMS��b �4������sqB��(�����:�T߯��7���$n�v8��Ϗ���E(�n-lex�r9�3h��T)��YB�n�����1��D��oɲ���n͛7®�����=A#��Pө\�=�m�F��{��_�R�4k���E��g*\gzV<����QDJ��B� l;�d�o�$��Eo��*G����0�]�2-��_��$nH�ч �/̉�=�i�Z�d�؜X|�&��7ڎ��Nw�ܱ2�F�浞O���u���&�\Q?mMP{�\��Zs���q���ϊ�5�������	E�P��̋X`�pl��00�6F1b��f���wO��[��#�O�4$� D��Щr�����J��ߙ�字���\�d��:�nw�
]Ӷ�e��$��`� ��k&�| ������$�|�Ј
"*�i"�s�F}�*7��SQ�Iӆ��<�c>#Gg7p�`(u��#4ܴK���Hq�KHm�N�rjL4@�L�/�(�S_����PmI}1p�*�&��@i2�5����J��xU��"U0�#1
+d����R�
|a	�`t���N,QvhH���]���s�[k�����>�,�0�e"� �4�"F���$���ǆ�X�p���'�,x8,pu���ԝx��9���_)���2A	(�W��jL/���O���s��y.!��2RSPg��Z�,��"h���ʹC�K�A�~o�S�,7ۻj&GA_w��B~\p�'�z�����y2�v���0���2����]��6	|v�B�wP8���S!�V$�
u��t�R~�[���Z�<�D�s���^�1����m�����@�H�!���U]��/#�2a9 }�Ǩ<��"�����0C�?�$ђ�Oc�9M��8F�B����lj����ޏ/�R�u�;y�9z������c}`��g��7��S���7Bٖ7�nbC]1ֵ;�Go]�X�}���QL��G���εuA�����Ɉ��4m�� A��O�t��kn�@Fv�����f��>_S@�*��S�W	V�I��Ԥ�~��V�S����?^�Mg�~��ωl[,���r&Y�I�%�"_{1$RH5���ۣ6W.��W�:��n3+���M�!!��ī� 8�o&��,.���h̵���eD���*�����X�}ᯈ��^���㠞����5R�;���]E^D�Z�2�֛ΰ��3�A�<�x~_ʹ�:G�2+9�\g)݊f���<ڍy�m(/��^�-em�yj6�k��v��v�
�98�h�,'P1nxۨ�����^���t�q�^�!֔7a� lBtt)6���i{��"���7�ۄ���d�����pl��� )Sb䇝�2�ͬ�k�0ټ�4�:��5~9�|gB�R4�	z����u��u^?������ӊ�D ��S|?��v��Ư��^r�b��8�2HM���i��}E:�5)�!�j[G	�uþ%�)Nm��\��}��0��v!�T݃=#Mؚ�]&}�>�	�N��po�Qx�pN��fN�-�b��%r��uk����PCcb�Q��Q&ه�Q	�˵���4�Te�_�~؀����<�?�U��g'MR��;��Fp�XĶC��u:�����Z��8��m��(���Η)����q��:��%<��K��G�|-XC�b�b�l.y��E�Sv41�������g7Y�V�5�ʌ���s���}0R��}��R!U%�샟u�_.�/�F*حpO�!PX�9Kdz�;��'�%��r���K���y�B{�N�bz��.���}XPӘ�~��Q�����x��M)�^N�-aF����7�[����x���JcY�Le�(�֎��A^��G#��.5a0�@�g�I��F�>Δ�D�ֻL�d��*����.�{��2Y�Q�@t���°���|}��ȗ�<��y��eP^<�<?~���ǂ(���ï4�% O }+��������Δ��)��є,����
}oRt�EC���S����ɾe�2Ӿ���{��N-�0r�iWT@�������fR!�6x{�;t��^�AWZ�(��M[��ꈫ�N�����<�/�B5�7��vK��ahf�w��xOy]X�?�k���x����L,E ���qM��e�L0� �Bʽt����S#��Y��C;�p��Qi%ك������T�pM���}��j�P�tR6u��O�;V�a������d5��[Q`�U���(�x����%�V�q�e�NvF�+6Xl����V�'�"�8ǕDj�t%��ҬY���ך��"&;�xBr
�;����rdMZ�6��H������6� s���X�%���|�����l=��l��&�H���l+eE�!��p��|�4
Jz	���6<ߜ�(|���F���J��P��FH�ɮ�R������I�)���1�Fөc�L�φ�0�U�DYuy�rkP����K�����H�@�BM6h��ˏTǂ���$Ol�֐��(l'>	�UB;��+�=f�P�i,x¹�)�慠i��r�exW�zd<��+�7ۙ�v�m=���O�k��/;��|Wo��a��Lއ�o��pr隦8Kn�n�(�r�`�FBF��<�[�@���ֹ�+��m8R�׵�2�|�E|񬿚�b�Qo���p����'��3�5�Ck^�� 7o��+�E5��-w�K��Oq����\�%|�l����Bho4�@q����6Q��S�B�j��(�?�-~���_��c�('�-Y��� �Mb��ͩ�+��Et�������xAu���ϩ4!������[#�2F�Mf�KYc�������'�uK��'���q�S ���^�G�}0�򟺎k,Z׮�A�4c���K�8�Y�g�P�4oK�s��xOI'�Y��#��ny�&���iB{\��4�(;V�KYm+oe��G_LNZB������\���E�[�Z����On�a�X]��ΎH8w��I�Oi���=�C�-�M��D����7����e��3��N��e���;L"(��ۃ�������̤���	hL�(?�?:2�{��fa�*�WA���Y[��lļ����4�Z7@���)���L�$p(NN�f�s��[�b�sӗj|taz�$��ė�C���mNδc�ɵh�W�#D�1X��o�l�P�80�w��2o޸ƃ)mdl5���B�<3� udU�X�����z��C�""�k+d/�D	��P-p���+��W������� �d{�}�N�@j0`�r��MY���{xH@��Wj�j$M�O�y������W�w�I׸Iv�K�ǲŗ殑y�G���hy�D�c�r�X���y>�����k}i�QD($���K���_ �(x��w����A��H:���7B�:dQ_@�6��;<\�NenZ�n����O���*(�-l���F���3��>z1Y��yo�t�	k,#��1�M6$Y�z��i��7�|�RM��S#��(z>��&��X����K��&�g�M��G�Z��k�r	_���de�o�A>��I����dx�H��ɚ�f�1�I��1)���p<����0oRt/{�mG��4[�_ڜ��-���A/�$Ҧ�Ì�#f0���Z��}�/��Ɍ�B�����wAm2�:�E���+�+ �C1�k��C�g�]��[!����a�b�!�{���*�bs84Ȯ����Hh�u�#Gi��Գ�i����������ʕ��N��ң��:�9�}��z��,�:�3��6j#���	6�������O�
���lo����Rn�|9t�8WT3}�^�"���*��X#�f%��u��������*���F*�A)�5�s!C@�e���9�����qE�!��r]���]�l-�P���
셧�� []\�e`3o/cy�����k�o���2m1v2�yY�M]<@֌�u��}r��K�5�R=r&�+�������pO�����UbJݡ1_0��w�(&2�G��9]�U�c�=h�S_����4pm,��$��~�`~c9����S���R9�0� ��h������r����%�������4F�T��*:�6Гo�SR �|���1�<�3ٝ.���C���5�1��K5�`U��Y{���q.ܻ��c��@��r�e�_@o$R98����)�*[Ae�x8�veW��ȷ��j}gSF�"Msn���Z�'	Qպd���3c�+�مs��G�u�F!g>��:���:�9̻0�j.K䳔�j��61�v;�J�`(�,q���2��^��b۞�m�,�v��Q�������CP2	>+�?�l~�4q�V齙�=ӕr��C�����E�_��♸�j(�N\���^z���j����`fȴա��;>����n���)�����`��*Nn��ж�K�&��V$��Lz)���j(�����AT�|�x5-a�/"T�_5�����ihu�N�W+wdwf�m̒�/�Q3, �h�k���ԋ�9|ų�$�%:E�{׍W��|�>�2Za	e�:Т �l�Ǟ4)|
�4�� ��Ͽ!�@��<���?�����1��"���4��� ��,[�x�	�N��B*[�F>gu�=�RAb��r*V�J[�3�����	���o���� �O#Fp�][��S5���S�;%������݂|s�s�<q���F���E	6�+��&"���U�]�Li�_�lT��>|*����,_6F��m��\.%�)��j�*V&����GE֜�2� n���
��fQ��M�B����XP�_Ju��l�6��	?���"[�����+�t6��O���,6N��@:�r�Fq�[���_�����xb�
h�;���ʨ���h�>�<a&H܏�#;��;Qˁwl��?��;�� �RSPX�>�^dS0Iz"��@�V��~)�:�����ߐ�6��4��̮�@���ۛ|��4S�mm�� �E�<	��w2tzi��M���1��C�-�����J����|�$Q'� ��Y���xޕ�0W��������]�&B��s�1"���l���ݘ�GE��4rt��w�Awk6���+/l��s�|�K�_�,b��	c�71�~gHW�_�V���ExW���y�6O�rP�!�4���sW��L�&`��j��R�I���W>�q���&a���o�?ਅ�FX7�dgwf����g�ǂ"	!��Kxb��!ۧ$	�֑<���W	F�p_�i���!|E�\/^���0!��t�뒲sC�N�#��K��m��(K
��9�q��]	9���v�\�D�Y |�O�/z⢮�D�G��S��l]:�[DT܃�M��	LZb{2���<_|[���g}M#�g��%{�_�og�h�v��&����>����@�|b��]�����O����#�uC�x��˴���6	 �u嵀��=h����ͅ��6Y�
����v�=�<d6i��?&��b�N�c�lhf�'���ͮ�_j��H�s6�̛�	y�L&�E�p£�3lT������-�%z��R+-�@`�A��엫��ס
E���}�)H�t����7�U�j���e����3�N�ۧu8���Tk�(�%p����Q����w�d�{�Wr|�y�~1�*�)�^�Ծ:|yE �'�!�M��9�3Eyk�_ָ(�P$�91�����A��r
��)�*�ih/�E��)g؅r6��i�������$&�=��|)�-�V�K���\`�(��TE���uϫV�1`bd踶sl�H>����4Jh:������j!=�L]�8r&�׷����4 �sҤ�C�$�mo�&�/XU8��v�B��j{<y)p�i��l�r�q� 4߈.-�T�~ל����0)*����vM���r�������tס�3�u=�b���3-B(��}>�5��BJ�5�+HjA���7iٍ�Z,�����!����(�5.�绢c�Ul�����ᑈ�	M��9���z	�Q�p���?X�|�CK��*U��T�\�lc�'��W�M\Lb;��a(Y�$R�4;qU�-�?\5��+��|Y���Q�@]b���G�n��u��}Ps��6����̺�m��z�ڿj@�=#�Rߚ"�c2��h�>󗜥6|A��-��wY�#�wK2"�+�{-�H��8�b��c7�[}J�筭������<�\��އ�a�O�D<(��0��o�N�d!L�$�Lk�����^Za�Xl��o��	�`��g�]���	��r�e"w��m'���R���d���s�:��=�Sp���E�uo��Wk0�T��K��'������ckP�'##�jYM�T����9�fI�i���� +3�����	���%
k���4�v ���ui��8��UL�dlHL����ي�`�_<�y��Z:x�7,��$�$��Z޷i`��1��Ӽy��j�|"���⎲mw�,Lt!L�-�]��Њ�`��;T��|84_���|7��M�f
��L�#��`�Cok�s,�9�c �K����GM3P΢x��4t�<T|qyj��k�������i��O�n�e�* �;/�_���n\�2x�|��j��#9��w�[9Ix$��
�:pfj���q���+l8��Q��l;����&	glK�U3���g��L�pOR�}(7��Xߘ�(����1�k3xM������x��A_�F@c�y�;��8�삵[��u�+�]�u4a��?�o)�e �z�$��W-v.Pm<c���wұi�ҳ4�60����F!7|��t�ogh�e������ֆꐫl����rg %���H�E��?��y�i��[�c�1�d�E��E���9_X���K�r��VR$��1~��sG�X.:��b?��*���;���c�.҃�.�,>�W��'�Ltͼ�af���[��^8P�Ʒr^�9V��5B��i�M�/-�-8�m�á���Dp�it��_{�{����s���E3eˍ𴫙(�|����
΢�plB�1>��!�N�(�� ��^�5��S�t��U�,�Hrz�H:oS�Ⲅ��m�#��r�zNV>O)u�s�wZ2���b�
������^|8��CXޒ��x�'��RI�@��fJU;%����k\�����Ĺ�+�<B��~�!�:�H@u�Fuw%9�娼!w�(�
>�b}��'�����zr6C������3��	x��d��RZ��<+�M�u����1��Bo�
AL��_r�l�P���_i�఍�z!Kl5��Di��isL�)�.�����A���T�c��`�N |t�r�{D���*�򮘵/����u�VE�u�ᰅ��)���W�tk��������g�2a��c۴����r�=�$lI�����DX)bT�3���-��)�>!���tϩ�ĺ��p�N�HG$C�?e��^��'�b�z�<��1�}ؐi�ޝ�?�cDҰk�7�Du�2��
o8._��u�S\'�|&u�BQ���_
M8����Fjp��"�0�������]���n�jE��L��Qv�d�
h��n�ʓ���_��c��0�l�V̒]�O�г��v����r����p���"��E0�`+�&���m��#E
�0�"�����\���|C� P��霮�Zr��W|��R%*�����).f��1[⟦��?�L�]��픸��x�JJ:}T�����/� N��6��s�Ҩ�^4=ܮ��p�X~
D�0{��T��$P��gY�#��)C]���[�Q�"/�@b�C�SؼSuϹC?�������/���:��,���^ �r��X�o����e'g�:��Q��z��R���Pn�fʑ�@��}�<��dN~����="�����S����xw�1�������,��4V�����e����̯�{��-����t�/3I �M����y�M*�R2{�V�Al��*]��S
&]	��l�6i��d��{���̈U�A8aɼ/U_��%d��i5����2���#,b�I��,�r �LP#��� ��o+���T˼2rfdd���M{�l�X��+:¥��He��L}�yd�cՁ	��&��g�d��/q�b�P���=^�ݣ�u�$�E�Q�a��Îor����� �����ST��4�`;H�6����L���uڅZ��I�&��PL�k�0X��{����Y �ȟ�;�&v��5	����_�&�
�T�f%���;�N�r�G�m�^�g��k�N�zW���d�N4�) ]�@��KӬ����n='�}��ilƋZ���-?�;ͪ��m`��d-���*�\���O�ڵ$o�����B�4�J��l��o �jd�\&�!�����uR��
οN��_�wŊ{]���4lg�H�*��#?�, ���"�2�(K�_$Ӊ����f�����P5�AN�ܛz�4�6�<�%����+eR� <M��J�B#��\�#T�	S��vi,4��[j���`R}!3��Ȅ�f�}5y[R+5ew�X�;TU�¤�����5�Fvc$�:1b`�~n��%D�R�GId�x%�B���~��Kɶ��!����M�Ā�<kލ"�w���dCz���x�C� g����w^"��}c\S�q�9I)	�i?(��;n	���2���{
�A�Y��g盟���8��!�IÏ��y���AN��W�O���m���.�ġV&��KHk�����#g�C2*��pa1�DrZA-đ��{�k���"{��7�WW%r*��G�Cm}�	i'����0��M��6�?u_ܳ���_Ķ��c)�UŨ��dҏ�D�^(��pGl���"�4���#l��i��<c��T�Є*��}[�D@�8�������/��L;��н��j��ByQ����a�^���K�=���O4��v��M���`u`�Q�����u,��to����8FD�&e �D���_XB��E8���qaa�/
��]�c��DmW�3�:W����~��	�Gg���V@+#ʟ�g��"��o������Ǳ0L"�#�}��1�������=h�u7�fx'�Zt��<ow2j�M[G�D����	���w��n��jb�sN�)m�a���W�)�jQ^B��o�65�ْl�x������q�!����yh�|cكɋ��M���Ne�v�0x�ߕ��Ը >4i8p*=�P�,b��0z�O�o�������,;_\O�ب7�Fʉ�Pz�}ջ�i��np�C��Bw��ҽ����=��<��.�JT;2B��H�_�N�F�'���|�����8�`8���X��(}�w��,�zǛvy�!����G��4�ƞ�8k�Z�o.a�v�O�C����� ���3>����ͪ��}���Bm���|�����%R6��P�'^����v�9=��o��B�a�0W��$�,'��r���?�A�*�@S,��*�4��)��Jk���Z���8��z߀R�p��~]Gvw$%�r$��p�4t�x>�/V���Ѣ��H����E*T���=�Q���B"�̬�h���07Yv����g��>�)V�!�k�@<q��E���2*2���ŰTw�R�Fp;�3NTk��N�c:����a�d�>�:d�Y!=�%�׋�����̞\�,O ��z�ɮS_�����G@��(�_�~ډ*���Ȣ���7�u�/~5�u���fW����:SގY��geT_7-� ����s(�[r�>{�����Ձ}��"a�h�l8� �<��i�N�>�D�1�l-7� 7JE_�~�C��R'+57�`�J?�!��:���z�to����%�8F,���ZDRa�'ƫ��n�Fװ�J)�r�1�߼7?�Y���B�h��˙VO<;���~����]�dCc�ߘ���Qo�}�kT=|�z���x��ֱ�^%�B�g� &����W��T�R�;�TZb��1'6 ��e�W�W�.MA�PD\����̕W��Jb�aW#h�u���=���>� �5z�1AM'G�+�1�X�j��DDӗZ�
�/]LzV�/�+O#����6ăf�*�^I��7��g�)Il�/�7��N�+Y�)�E u��F^���&��=�1P�{q�ս�ƚ����Wm���\gׂ跖�_Ѕ�\��������k�r6JF��*\�r$�K��n�
���>_6���yHuÝ@�C��o��
�A�S���4��FS7j�y�:�{�V�S��{�l�s��ƣ�MM�L�2-����+���ʶ����]���Ի�<i^C�s�h�q�S6 `�<5��I�r'��_.����D6n�n����&����������}�)yZ-U_�rD^8\H�g���k�j���{o�D�w�[,��ˠM�$O�貴*o���o�&!�%!�_��+/oq��,'�΀�,V��^:SlJg�Pq.��V��~?!2��Q���@� ������a}p���6�4�(�a.�r��,����gvA��ZvN�
6c'5���j5��$@�}�Ez�ȥT�K	�t?D���e8�v��G���""Z*I=)�q�`Qu��>!��	�'HGS{�tt�����]���������.w�AE�sa��8h4'	&	crd���fh*���Gx]�y��vE|�MLt����#�y�?'R�j��ݍ��W�C@���bNS)��g�Nӻ��ί'��snP$�c<i���Zϡ����	�0l�RG+]F��<�Ip�6�%��A2��$�[�� ��M7�#���o <t��Ų��:fZ��o`�_3��6�N�խs�t�����6�Q���5��1��IDǌ[��V[�{R�Sx��V5�r��|�q4Ȑ�|5���K=m��zX��4�Gj`�Q�2��R��W?�� L#ݦbw��~� ڗt���0��~���g�9������zs.��لB�U+"H��OI��0���rG����t��W��ӆ�����QK2@��M5:�M�ɶ�+�#IG�����4G�./Y����56U���U�
^�o)4���@p�]��eƹ\�i�9���e\���4w��`ॊ��)��Ǆp[�F�SP�߫�+h�F�gT�9 ���C���!�CiDl�R�J�<��"��2_2�֎�	�I��w�΢��5�5��s��ڣ>�@��ӡ����� �F�
�q�HS��
.N�L��=R�qI����p�,ӽC9_����_��+�(�C[T�6؍c� �Rp.t���[S^Ğ�W�L�{�N���|xb�t�������f�сJ�f��4�/~x�1�.��9��Lكy�"����Ń0f����iP�cO�!c�Ż�>m�$�C.5���>(Vct�QĿ�&e���ޯ���mW�M^\����/�C�O *vF�u�!Ř0�Ur8��'-���>����Z���wQR�b�
=��R���,�	~�&��CUeZ[:�l�K��P�fK!����z�&Y�'���:��+���_|cG+��m��b}�0yV��ڃPڼ�us��<�lY���{�,Fϫ��J*1#��E�/:�2 �ߓj��ŭ'�-j�+1�}�!������
R+�q��Қ��ܮ���\V��+��H[Qw�����YI��P�p4^ P2(��tQ�\��,�z��-��v�����x}M//���!y41O����?cN5W1--�8[Я%$��͉���ͮ��!�ʔּ�)ek�qs@eB2a����j^�~S's��KR�o�߄���/n�ѝ�8{��?¦ݳ�7����[�v���\͛��w��5ү��?��y��t#Pm*K�~<L��%�E@� ���}�M�(�'��N���ɧ+e�vMa��E��ڤ�6��(�1���DJ{*^m`�ǖ`��1�H�����9!�I6	��6T��O��,Zz#�4��F&�z��na�"�ڱrfL3�$�X�o�y�'_*�u��������ruQ�yA>G2T��{�v��k�p���p+.z?���!\2�}a�;m�C%����i#0�n����:z���AC9tQ���CjS^��<'�R��^lL�rЅ�7E~U}o3�QoAZ�x�;�;	���ؽh�g�����|n�O�D9}���P�)��>�D�@8L��<��t6��	!��zGu^�]G�[���D};]�J� niqM�� ��LGw�}N�����e��ϲo�A���*eh�%Ju�5��je'�K��}�VT��oб-9��%^��p$͞ah.�&��+��?�(u�^�h��S�W]��PQl�&��L��ht�WM���LAVA\sBL�1�9]�.��n�q#�z�rR�L `���1�$'z%��#�b����������D!
�k�_�w��\�Y� 9<��nߖ��?L��up��q	���n�.��M���;�E��F2�T�y�wݶ�G���#�	��=1C�����})�d����<�S��&�(�:�R%�$P�/�c9ӯ�MP_���%��`Ĕ��W�0�b9���_�;��d=�����1s��1�ca����v�q���F�sT:��u�$��/y�<^�iʪ7l29=�*��o��κK+��5�ZN����})Td`m3$	x
�\����cM�<��s�"��b�n�q�tld��~�wNz@ه���.��q��V�O.ӝ�)ZġJ�8Ɉ'M)���7A�����҂&�p�dPAge=zأI������Τ���eKB�9��;����L���Ēm�x����46&rg�'QQ���LX�:47�y�a��!5��r�Gͫ�>�&��������u���q-e"�K/��З�g��.�p�T��/��O<����(���]��:�����.Y3���'TX�u��B\8�#[��)�q��-@Pn9i�?� �{�`]���W�?-~�<;Yn��e��#H_؝�K'
!�^�tu�\2�	�?����i�5����0l:�k-׺��`~�� ��N����I�)��;B'�Dt}�v{��ç,��{<���, ���i�r5��`�#G� 0��9�o��,쩊1������_!�W�qDj����I���T�n�wi�MX���!�(JQ*%�G
ޙ{ɪ�:q>[Cn�Yo�Z�Ie7��K�ఌ����{���<Ջ��D�?܈㩬�Ai��>@�	^�v4Pn�u��ЌUD;_�F~?EK����]s���2V,�WW�LL����?��?&���\�޴G�7Ow�Q�}J�q�1���I��ہ�Vz�Rv/&��+�6��*��%R�Nck��xB��#[m�]_�ј3C=P5Ȉ�[�{!l:�Yj#~]�\��iIg������q��Ķ)k�#S�,��H�d� 읽��V,�*�}LzA�;�'�����a�O�u���R%Ǧ�W�}����Q�-:��oc̨3�يҨ|	YEH��V6]*��HH��e����Nu��5SKj��)h��R�fмʕQ�&�`�ˢ�}*'{�b���T-� �[�(�Y��O��s����)6�̦�hƦXK#�k�P�sO1N�#|L�qgC�K�O `��2Y���:9���HY�e�+4�/��SogSUq���Q��-����Z��O�:������|N?Vw+���
�L2����+���*k�GB��1C���\���n��ނ\�M4��1��~���%�0�P���T�/��j�Jx�VN�qm]�E�U�3TE��T�(2�-y����E=����5p�麿<��tXPh}����Η�_���d��I�\��E��������,)K�� -��]^d�q��W0$�<MT��C��@/�
_ŷ�� g�)�&謖��<��M���L$Yp�Ve�0����`���h���Pm��_\�r.�"|���~a��N���9嚅���!M�%c=�	�������Nߔ��X��*ߪ�N�7���XLZI��4�X�mwy|(ϩ����.�V���eRhk\z eSؕmH��uR�����x�͖��db�Ha���Ut�^����gT�9�S(a*��8`��֚�_�H�L˵^��M��5����H	v<�	c���`�[��VW��`�CD�V�����a�5��s����ͤ��h
ha �a�?�W�b��6�0A�﵌��F*�2݂���YF?��3�{/z#�$���#��9�����W3(/�GDj��
��,Cjf�� ΌJ�ـ����Y)"
&��ՅY��Siv)a&�t��NS��t�8�gPŵd�UT�>�g+E`r�� (�_�w/���ސ��QFr����G+}3�,/�Mո�f7��d�Z�'��>øF�C�pWI�=\SǢ(���M_cࠛ��g�\Z�TOkv@����u��a�U�M~��S/ �UZ��^W�|��%���r�/yq��e���Q��)%OD&9�Ϋ.�N�t���_��7p�<i
e:^�r�k��[�TO���G[GU~,�2�C�)u�֩�LpY	_�Rn��&�Ώ�;��{qi���a_n�F�ݿ*=<#�'4���8��Ϙ�A�b]J�a�&Ŭ-�94�;0�����h������zz�X� D$c'��.�&�l��.�knj�AL��ך%��t{J�*��o]x��^rb��Lq����`�\T��Խ;y�"�&J������ȃ�V�"^��%�)�&u����mC�:�m����2ϣR�-�(M]����5��ੵ�΄{����3���
1P>�{L�(^|� �>��x�n�%��4� W�����[���-(�c�N4E��t��Ċ$�V$?�0'JO/H`Nl�C�6!f%Qk��^��N�����I����^F��|9�yGƣx_����$K��-v4S۴S��qR��Ӂ���J�)��	�K�C�\����5Iw�f�����L�a�﷬��H�kk����:v$}u:k�A�w�t�:9�y������KY��G\��_u7�@$T���O�"�G��S%L�mMA������`�'N).뭋�X����HwJ$�U͙��"B1���<E[x�}o�e�!8��ˁ�e�?����l��>���|�N�N��i9Z��ߧ&�6}�#0RDtk�'LZef��ե���}Ъ%�C�~�+)	* �9C�����BdG<�g?p*է\���M���u�*�o{������,�Kt?�}���M皈��T�0F�G�L�����Ab0	�\��f����]�$]�=z<z�P��cS�O`J�M	��.��C�}8��b��X8����Yē��1�r�L �9i�&Su�㞙OB2�J��b��y�6���e��@�+�NK�hP_���,-�Z~T� ;�'�!��诊'.-�7���陚ݐ���*n+��ȳ-�5��a�ض�������Hd�,rJ�5ٱ�T��9cR��sH �3�zM+��Q�J��pJt�.�"�[o�0����U5�Ł�	K���b���yV����X�5�."ZX�^8fZ��f{�ϔ�,����cό�9��迂�-�{\�T�rH�\�+剙�0��܌��m*�=|��]Qp�aPm�
� ��Ң�@w^����쮡���7��@P��ZI���(��x)��\;+�5+/2*���R9��t󽯖`����8O��9M���ж�魠5���y��SYgmm`�1~��N��~��۽��Ϧ�@pO�ߗE>Hױ6�=�Ǆw��y{���>���e���q�eA�r�h8T���Vu0	�B}ث��(��Y���e���;�*�E��(����,*厕��v;o����L�v�X���|��U쇧���I��:,�
P�4
��\^����Z�_[�f��J7�|��<��$���H��)�����IK+�kL���N[2�F��)[�a ��y"6.�o?1���|�xcg���"A'�DK|���"a	S�+Ð����a��=ԡv�����_˸�!j��n����'s�\$��r	��k��L�UUz�^&D����~�/}n E`EΔ��܍��29�TU�n y���DB{L��󓸓(�2��
��嬯T�ka�����[j@�Tk|���G��Z��$�j�| �U�1�VT���몄*��A`O��]�n_ i�&'��	�H�]㣋�F��63S#C�g ������VFS�;�i݀=y�M+��;a��h ���8���f  �����,��w�ڶD�&7�lQ�j��~0q ��G=*QÉ+b��)�W�'�ݴ9i�NC$U۹��_-�F�a���;0�.����SS�Gh>V)Y��|�=��"��D�d3�)6�褦H$�=���RmGs�0|#rQ�S����f>"�ch�A��Ld�+>,:u���?�q�J7/���{�R�B�S4Q��bm����R�N��	��8�t��_܃��{V�]o�=�hƈF�u��E���t>D��|oG���<��*��c�to�������cء!}�E�j�\�bo��`���B�RP��4�t�WǸ����o������`��@��˼l6?\�;����4�yj��p�_
��5BS���@���9�~���nţ���
��ߪk�N�Pۓ�T7#h�?��r�?�!�C�#�P�'F��� t��W�a��A_b�PP�ȥ��p�����L EJqU���8@j<y��ᷛH�U�;�Ǜ����0�}>z̔�+��������g2����9������ְ�y���Ov+BJƜ���Y��� ,ȣ�������� T&���Wǃ�_O�6�E�}5�R���3��Q���b�(P��df������Z�����9��U{�a�ώ�D>¹Z2�t\Α�M�%�����%~�I'��_ocO�E0��Lg�$3=�,��_�+BCk�����:�,j:� eh�H0s��q���|��1f"N�σs����O���A?���c��|�wH�3I`N\ѥ~�(�N�+�t<XLR�M�����I+��pJ�'3*l�8�k.��jґ ��)`&C���
�y��6Ȅ%�6�C-@��صc�k��@s�~��	'�RH$}���"�2 MH��ڜ�7�f��OG��;�ꦫ�0�}�-�M][�ЂZI[ވ�({{���zq�MW��^ �WC��h��&���'g>��\�T�Dvv��:��5YY��%�҂*�&���G=��h7����@8*c�ҹ���8�����IB-U����	�n$�^�h���s�Q�WKC�^W����'��ӑ#�C�k!�F�(A�H0��P���V|u�Q�������o(L3��z��c�s��G�
��Έ�����G�a�g,�oL��ـ��:S��Z��������/2���̝a�����n�e�K>I�ze�Z�n��8|��CȄ/�R�����!}�P8�r��Z�v?�=pS�b�T����2�O����ziQ�G��m�,��N�~��Q��;I;Rf������Is��<kH�[���K���L=~�T��f/�1�����ܣS�������7�/Jɟ~��>�l2e�ڳ�S|���K4^i��@��X������ B�sۣ�]v�O��B��u���d�dD*�!Q��I9�K$�y�@���1I�3;�����}��!hm�oQ� W:�P�XF���|���V��k��8���M�T͆�f
�/��(�i�P>�p�MEf�P�Ϲe@��q�B��ށ4�μ~'Q���ѱuݻ��&a���^�� ~[M'����v����AiDl!� �G%قC�^�_|�z3���(Y��#a��ެJZ_`ulc���̷�m�p@�^�W�<_b2L�>�P��@ �ù)�0���O� ����/\�7��?x l�/����M�u�͗)G�G@HH���v���i��_���k�	W�x
}xx�!d�oJ��C�ΎG�2��cu.pBus�M�o�V�Z�CwI��s �����&f�{$Yɳ.�M*]͊nn��@ïYe���W�<ZS��[<b����;��#؏�n�s�jFFx����Yj�,s~�����
g�3oj�0�A��hu�.�/.���Ǔ�14�&���+ރ�$X��Tp|2���#Jf�k����F7�#E��~�ܡ� FK7r;��{}��'��H�*��Wެ��a���hc�s�h]P��;���Yx��3�)X����o��C��w%�cͺB��gJd���/�Pj�U7�7�f�A��j��
C��Z���S�fc$P�D����99��fer�^��.��x������b�Ļ�O�s�5|"�@W���5����Ō��q�Z^��(���_%��@7dq���;ѩW�-G�}=��H4���B媗�7��W�9�[_��YC$ϥ���Ԓ��a'h�2�Rn1WaMʧy�U`zIt3����(����e�\T:w�(�����E�R�֣��Ǟ�,�o�D� [2�(��+�H�F���3\d9H���E�n4�G��א�\�\4&�l*�z�]�K�wc�9H�Ɵ>�I���1O#eI`{�,b����@�ҟ����=�XQ�5�E�ofB�ɉ%]\��V�!=�X��wP��OcM�쭽f�yERwt|cm���sw�Jc����W�:c�Vo��+��LB�
WS߶|�Q�E��;jhP�'�wV�X��4ج���gH7���:�c��-��-R��ý�7&��lĵ˪n��%��y�Y���|��`&t��%���z7�x�1W&J���z$.�.��z#pu����ڈM�	̛�[j�6.o(�C'~{��vN �y8�<�:�J��)h�zLϨV�4��9���s@��m���`^F�6�k.L���3NJ���(x&�����y�(2_Sk��gL���G2eQ�E��DR6g�\���e�v��"��)j�7!�T+����{V���P�5�\[z�E3I-*��0X�Ԉ`ō4��=[���ٴ�]�Ƌ5��V٠o�k�k��K�{������k�>���s���W�|��?��Pb��f��f߽PQ�!y�G������{��L�r(x�����'\XrReC�O�	^u���$WZw����7݇vM<L�r��y{O���D�ދ �Sqc?�s�wan�`�Y'ieڹ�qE]>�qe�\�幔�L�`�2�������eڵ���y��(ӽ�HS?�Y)#�x���՛�`O���ʍ�d]�|z�k!8�nl�&���39W�l7�VT�P&n5��	����l\/d��V��L ��s��?]q�C�Ⱦ��	�y�@%��8�� E�U}I��e�u�ά�U�;�a�
�F ������?ܰ�wPfϚH�Θg [
�A4���|F��7�!���f������A�'s*ϭD�b~��2%R'���*�s`�����*J1a���[������LI��O��v�6�aw�p(��@�_��+��F./=���Ȩ�i[���7�e�ɢ#%�gJD��	C��\�+�������8��O�"ۗ��(�A�{g����	b����<��Ț�=S�8n$����kl��:.\7;ec�[FS��{Pb5�"�9%���~�r���y�:.%� Jx���Kd��!\���Hߔ�)u��	����UF|~���}���n�W&�ziA�Qj'�4��x�U2�*��=R>��Ge�ͨ���O�$e�Z�y�F���Q4��
maE��ܧk�!��̛ni�MfK��pa�5T#�_��(H�B��^P?�R-�ԙ%1i����Ri�����*c%�D�j'�8Y���}��K�v �BO�w�AH�6A���i�Z��9�gπ{�ZꙆ�	8Xz N&x[��bkԶ��;�xrVq�-y9ښy�������p��\l:д��$g����2�s���+��R�����3�_�o��	KO44�^�7+L9yx�c �:��:�[�����!���q��3�$lM�F�^��CG�^�}�3��.k,�Ish�k�UcxN
B��C��n>-G*ˤ(w�+*y�F(/��+ (�8���k3��GW<����������L!��\5oL�N9���+d�oy�I��F��7���|,��Ӓ�r���j1b�U�=6e���ֆа�c��A���4�qOj��~q���&
�޴g�� @�G�E�B�����Tx#��z�
����4�ټP셕�W�=�˘����cb]A�X��	��x�w�&�(��ŭ����>*�^�bʀ�SO4��|��s��������H9*p�N�!~	�m(wV�^s  �;����h�ǭQ!�} ��g_/�DGs�o|L�k!��5�K�籃K�a��bW0����Ͳ�=2��(��h�8ӵEQ(�X��o6�T�Ɨ�e��p��w+&�g��Y���E����F�Z��t$��5ۓ�L���\}�1�x}L6�&C
��SN�9�C���:$�����/E��ضh�.^J'#��Յ�5�c���˳ ��{f#kE-TW\�q��!�E���+0lر,e�gt��&�0�ĸ�5.Z�)c�:�����f\Bson�J�U\� ��g�y��1�����%Z{h�Z�C�
!Ci�ОVO���_	�H ����\`��6V��pށ���|
u�Ds��<f�K�����I�g�8G'�Y�P��Et���B[����%8��o,1�zI။��~��^,_�,���0����3��!5x� �J��
�`h��	�{��;����e]G�K5�m5�)����2�������`w�M���M*����T��X�2]Z7����Y���hh������<�ǖ�=K\�kN�J�����O���`��7y��p�U<�6�E#gK�T��(�����	gu��3Uh��O΅Aq8�[ ��[;����i�iX�&}yR���$C��O�o�+ɂgx�?p����/�ReNw�|?}��w^��g��ݥű��P�+<�t���?�l��|��,'��9�.�n���I��r���Ł��_:B��E�m�������������.�6�"^���k8)b-bݴ�����g���� <T$ѡh�9 ��ǨTd��6"z��ygam�D���'Y߯��tiJ��-�ާ5���˶�CZ�ߏˁ�Ɖ=}�F���7�a[��fg�©h�cDx���M��)U"���@�j�����i�
v5�pNrK�Ԉ��;7Q���T˳oc�cV�2�^ŬT�&.�	Zv�ʼ���f^�1�Po=�٨��S�O��N&�qz�k�"���f,8������?�<����.�~J,��WC��n�����}����o�vb@���z��Z�	�X��D��[����5>���:�A�N�7�f�k�.4��m��_l��\~��w�|q��U������������M��3��6ha<�9ɆTa������k��4�ֵ�_|�8t�{92J|R��w���ȮU�Ҥ�]ss�cǦ�K�����������O��+����*ӏl,ԝ�(g�`X����������z��0����Kw�?Yq��2_G8>"ASHTk!������9�� ��=L`�bC���%@�o����	Q�c/���7H_�"�W�b^HT`�e�k���\^�v4
�y&Gȿ�l�+���0�IN�/OX/��՜4<��SZe��	��k;i�&D����鬊�\���w_�H���J4��_��E������15�S���	Z��0m��U:r���W���^�H�I)�����f��Y ���b>5@��~Y���7��M�#�&��ʩ���y�[d���n�g��A�������IJe��o�� E�u��5z�E5��	���M����U�ʿ�K�y��i����!T�q� =�@
¬�$%��<�9��Z�5_=�
?���*�q�m������po�+N��a$����Ǳ�a�{��9�$����!3�v.��܃� i��4���}r����Z�MъF��5�)�~�ހ�J߹}�+�u{�>]�0�|~_A�b���!J,u[l��௒����ͤL۽��C�L�Y�NZ��Ef2��^�	�� غR�q/Ȑao�������l�=�-���g�}H�.ɞ{)��bK��[!����S�M&Z@0�=vi�>d>)�l�W40� ��|��.��ٲ�Y��p�ݾkpT
7�jyf�.�������0�Q�I���~ΰ�+�3�_�eܛT��]���ќ�j�L��\7���9�2	��x� �y��l:h�	��:�lۙ.9U�̞�q�n�D��l�����b�����n.qv���Jpמ#�s�ӲN1|�A^l���<%�_���Rt�	�8�Ma�)�A��������)��C�_,���,N��bl_��Є�IɎ2�E�����ዢ��Cu����y �B����0�tg��A��<ǩ4���U���̞�d}�I��&n��?��ɠ�6�~~4F�E"Y�檍�uϾ堁���w���������q:'v8(��O�*"C����?���+�������Ķ�Xvz-�m� ��Ĉ��ӹ�O~YL�s�Á6�Ϭ�qR��C�]�j}�ihy0.����p^M�*�\q�#���n��P�@���� u	ԧM^41r�����X����j�)vs�)*l�H�Ђ��ˎ#��)���V�S0�c�3^����琒@�m�SW�c�;�s�=E�>;�����k3m��b���c4qn��"~�A��"�O�n���5���hgL���.W���X.��D/���z5ϝ���g�j��?|�퐊<���U�g�s�^u̓zէiZX�l�(=�sτ�q7�+�׳�^��ꅶ���H�4�婀1GP��ׅ C��8�7a,(|�Z�|��U�(|�����w�La���ȋ�Z`w[�:��d�Hz��.����9����SQM��Q�E̓FWt�x�\�㏢'!Il�w���[�O{���[Hk%R�cq����6���V��=��J^�y	��4Uy�{رn%+K׊	FR�U�ٜ����»��##�u&��Ю�is9�_Rm�{�20�U�T�g.p���p�#�����H�x9��Gi����!�8p�2������S�+�p�dD��L�Jϝo%n4����n+�<�Ӥ�(D{yop]g6ԗ�6[��b�]���n?WS}�wa�s؎7 �7�;-"D��.)p�/��h�2n�]�q4�,MO�+��%EZ����޳L'�W�*0�L���=��$�EZ�YZm��]��,MB���$Wеw���e�4 ����mm.~C�@��%��Ĳ��Q���{ �u��Q�G��F}���D ��bܑk����	�L����e���~�
��K����vX�ƚF0�ݧ� �����2�*�6��X'@xN�]�$[����N	V�mb��6���M��S�0q/�O�Pn��,<���XXH�zy�W���g+���?�J�PuK�'�r0�B�V����G�<ne�>��b��w���P�a�O����⹇Ԅhe�FV'*y�+dK���i�P�����|0՘�T��#��5��^�n�H��]}FR)��m���j�}�� �^��t�}�ʦ�Y�M�\�u�Zآ��I7f�]L��L����J���PL�7���	ý���o�Qk�6��j���};�W u��;�u0���Bs�~�J�iz�1V�&�V��L+��,~����|�1�Xi��i�@�\��5��ֲ���'!�em�}j�7��u:9�DU������&+�m"q�=8A_#���HY5Si&v���;�$x\�VJ��8��]�eQ�M���i��o>�1J1�À)&�k�e��)@�5u�z�4��*t���-���.W:����(����בL9�I�C	btV�x��Q�bj��Pr�\�9���W�:v���9�.ˎ�=�~#!��7%�\��=;'���ε�0�(���l������n+k0��S@J�η^΍���K��=�ϻ3�ɒ7�An��G
��?�1�6Ō�G� 7�A�ɇ��ܹ�����=	d��������[��gj�gj51(f������Duz�;����0D8��z�R�� �j���J�=�;����j��c����K�S�hW����s!Vj�EL��,̝�����dʖh��F�=�>�>BKh����Y�{�-�Q�����M$Le'��.O���������"k-����bO���2HM&h?B]Z��D�=,deVvP �o�2�ᣀ���� |xCtN�{ؘ O�Q
���`}6�vhDL�TK�M���G�����'M��^4lp�(%���hRA�RD�� OH�Χ�>G�2�h�ܦ�<Kx���C�i���:z�=�׷��� �	�V��*��Hӓ�D���K���8���72�h��l{�dV�~Tq���T�r-�Ɛ�8���C�̕bc�tIct�`��.s�~.G�D��~bC�����ꅠl�;2OV����86	�!Y�]q���l�;�8QA��6(��aw^6�h� ��М+S��-���0Q#k�B�x��zǈ��t�������?�Ѡ�x)hdj�v.'�O�6����V��؂��aWh��Y�ɣ��Q�o\�����;�`�@���A@7
��75��Z_���$����J���o����C1O�!�<��\�k���q=K�|����_}�]�Wx�c ��,C���
$J�D����)�և'�{mQ���av�(`C��$J�"�o �D��t��R�������.���&�����n����`�d�`ݢ�B�X��=.���W�V���W�M"�!��`#�#��DS�i�L�
\&c�&����R}��������ӫ���[������[��'�Uu��gfG&�pZ������,�tl�1w�b��{�Z{]M�L�̋���&�+�8�>�xS�FOV	K�����\_��>��,g�-ډ�D�;s9)�WJ8������zX����(x�Q�"#2BK��^B5�)=��h��3�^p�b3Q`��c��y,��Fݸ"��Klųrʢ���d��k�d ѿ֩aV���F�O*z���ԇ6�������x �������#�̯���G�֬/_��Y��-B�Yқ��4aG��x-	\<7�w�μD�v�-7�O������	�Z��_�?�{W���[hRK��'���Y�M �|��+�0�mx�'�'u`CԞ~�YxYzC�0��|F#�2=ns&��e	%��ĭ�Y�����bj�#�4��SJ�^��|%�[��9���3�0+����B�۸���4��K�x��)�<�.Q�~8˪�,��r�qU�A��i�#���U��1��V��f��1��|s-p���g�2�8�̚`5��R.�։��q������-�b�(au7�*��H����.ʺ�ڍF^/L	P�f�s���7�?�p:�b��0��<��`�=�c���h�;���i���*CW�u�i�}�K� <��&&p��e3!1Y�:lLwU�d�V\S�0���뉵���"w�`��Z�'c^�J��9��bѠ��I]C��w��9d�3P�÷��O��&��,�J_#�L 𛤪ږ�+��eQ��|������@ď�>A�ᚕ���gj���V��v��+��u�0���0?�
���������+�ҽfc�i���}���B�����NPSҏ�)K���J�G�)?�Ȍ3{�.$�R����D�G�#���Y�+9N���U`3��.���!�Y��2KWl
F��h%�Ʀjo�A3�~��(A����xڮ�F��m��Wp�V�'P�ԃXA�<\��F7a�D�Wψ�a�\��S!l|6 ����My��T�`�#aO��~��*6P��&p�Fʭrs�� �.m��!.6�3c�z礃����:��)JA�MΞ��H�ވ���8��f[��F��C�)���I\X�~�߷��xC��w�Q,�r&�19f�B���;�b�4w��!��Y2�|:���o������&J'"G�a���` �l�Wzy��o �ll9 �:��17;{:xJ��{Ӕ��C*���L�>�
Z6hѲmݚ�h�P�y��x����e�@r���޴P��ơ|7hee=m���41|�Vrz��1�G���/���)��u�\�I�z{э�H�����Z0�f"����a ���,pLa!��ލ6}��M��S��}��5I���-�pxX���}Zt"c��
�`&#�����tV 6rd.䩘�� /Ԧ�׭�3y'Jc��u����t0����#h��.	�$��wp���EY����4fZLv�'�)D�L�p�D��'���!���x�5�m�\)��ф����RQ�
�\Т��V-��������D�� �х�&�]�V�:�B� ��V�TXq�G�V��o"k�>��|.��<˳�^�?�T�������ýH���@��bRBt�Fy�����hb�k`B�CZFߘN)�5*�b�b4�����UxB[?��<H��>��L|�4�d&L��e�fS�0�y!&�}ĞMi��
����w�I�)u��)W������da��'g%~�Cu�l�=��U�´�;�G��R��d"(�6eU6��s!��s�4��1�@3E�l�`�?� ��쮪�g�
�*�.�IMJ�wY���v��#��D�r5~�<����W�N��V��tDQv%�0�1������+[����&��(ǵ�*L�A�8s$"�'���K�Z�@+yqzf����Y�+Z_����V���[�w|Y/��Sda�Ij"5�wk��/�A��9����g�����Vr��2%��/��'��@@d����(G��6��bRF���F~�0�1�,(W�n��f`_*����UmLWn++����Oğ[W�{C��n@:�q4^�jK�����؟kdɌK���V���[ϕ�-���I^��{?a{N�G�xɯc'n�5��W��Z�z
0v>�f�*�Y�v~.� x]�|j�+���������hJB�=,�#��%�;d7�M�kF��;,�e�n��� �E�i>�f�\���u�kOyx+w�3Ed�Xl��]k���\]�Og��g�Q�%�-l0;�y�9��]��l��1��')��`��/DH'4\~��0�]
@Pc��Ϫ����D8/Q���.�X��A�+�{H�\�j`�4W���l���n<����Ar�7�Y�����rR3�0�w�I��f����7��>_K�� ���E��rD������֓�Qa�w;��L-��K���u�LA�t�ʟB-?"��>��h������R��A�S��&U��%�I�,��T�m�웃����n���5���.v�w��_��Σ�����ȓ"�fY�&����6�e_|�F8��SB	.6����"ӯf���Zȅ3O��5̐�����j�_d*��d[��.�̟n�Ӑb����f<Qy�3�b�B�CC>���mU��C��	Z����:�A��"��]���t���]�Ga���
��q����`�W�����^r�oҵ�Zƀ�8�av>�jP+���~No",��	�ޝ�|ֈ[̊�1����s�)%`9/��ҏ>���a������@Q/�r�T��g�ș�j��[y��b�o�۫#	�g䉆�m\R�<�g}^My��C�������ߵ��0��7i%�j��8�ה'��n�-�J8�葐&�>��-���s���E�+�..q��"|T_�I�������G&H{F_8rۖ�gk��-]�Pd���R۹��p�tfj�Fs	�ڞs?��C�hZ�\G��;���n�K΢V�*����:�� 1G{,H��Y_:����g�wh�mCJ��s��<�1ޡ��97�§�Ⓔ@fh�����%ݧ�j��B����#�$�^`��ht҄�#�o5�ܜ����Wq�ּ��=�;��{3�'���e��E�(D�}��/��w5�V�L1���Cֲ��O&�D�æ2��c�y�� X��A���N���޸���5UtBƃ�,+J�\���r�d��Cl�,�s~�FL�	�3�W��b��.t�U����Q�s��Q�b�Ǐ�lFdج��D�T��O�?�%�/-��tz��H9����M~���e�~T�q�M�����M����:([͍?z�%�E�����!^dS.��Z_�4,S&(	W��V�1�q�wrg9��2��pB+��a�S���f������zH����]9��{���;Q�R�56V���9'�ޟ���ڃZp|EOW?�̩���l���.S��S_&�w��t���^��e�/v�̔�S'@h�q;p>ݵ��N�%����w�)6�La�#c��(^Q������G�}���y̷���9Jc�͗_Y��QT<~4����:r��#>[S�;L����jh�Q�󶅌���+� �d��;Z]c�!�[��Zь[6���p�ZF�3B�E&شW�Yj���[���-��%���Q���KÓ��U}������;�>����ZP�yA?�u���<B�j�aQKa��^����� ����6��"+����T�d���1����µ�����9v�aV�'N0�¶>����ì���|��A��f�k3�Jly�c�W�����@ȳY��8�l�6���'��H]9ot��5L�(�0Q��}�"A��+��U�����T�舐��AH�W��ث�A6�/��T0���]�o���ܒ$gd(⢆׉h���q�A��kV����zjv���W�NG�=ń��u<Qq`�`U]_��LJv!�����O�_嘆���b�s���I��A?��2����.@�ʮ����24@�^�+������(���:��^�����%w�oNl�GDo��EV/�(��!�L�\���*��	[�m��-��/Ѩ�MR�1Ȝz �MˆPS�m�^�F���N�	0�K�,9+ca(B�]�Q����U7����3���u'�E����$�<��$���F���/�������y����9�F�'�)��.��\�͛��v^�ܿ�.qBP6Ѱ~>Tړ*����ٓ���Mp&�|X���߶z�M���n@��l�xJ�KcI`g�A�n`q���.$��8)��'�"e��� g�|�X&?HL��W���g�$%l�Eh��l9����[ThV�Ʒ�^�'y�M��鮌����qg=�������D�������Y����-K1d��q�5|����>$3rd�C�v}�&8Q!�]VX[|��H�C��ͫ؀��^����)x�ͺBbG����^�瘂l��'>��Ŷ~���V,���W?J�r�ދXj^\��߀*���փ�<�W�1�Q�0N�#�ү#��c�=Le��d-���W�%m#:�X�"/x/0HMx��,�(bPb���x��gy;���,)�ZO�GRazD�``�c+G&Q��uN�����@��́����e�t6L_j�3����,_�r�m�M���Σ5:oHw0@̪Ώ�߶`�21�r��J����F�e"�x	<}��z�n��!M��{�Ω�9�%*#�SK�28�ίI4�����S�r��{�f��X�T�W��`���"�*� q�Zϫ�<%����/yp��� ��So^=����������&D_��B�[.fkR_,0�賰ڎ�H�#ڶ��{��Ô(���1q�(k��M��l�g�����_:��X��He)y`X�c5!�:�[��n4���f��ܖ��3'��:vG/"�k�r@|ce�h}��/�>m=�i��9��X�1���[k�;'�%�ճ{�?Yˀ�3�����*SD�^A�-0y�� ���ɮ��|<@g���+G�{j�foa�?���?Kϲ��{�<z /��p}�^�
��ꚿ�#�o�˿�;��A
V�O��+L{��dO3�H����GEh�r&;{H�h���?6��YĨ��i�mw�s��4�����ڏtbg����bq�H��S��	}��-{`D���!���ɸ�ڮ��t��X���[�O���ܤB���H� �w5P��z��ԃӂ�E}�B{���v��"5�=G�������E�Ŗ�s�C���dP/q��ձ߁�Gy*��]/xȶ� �n���Q�� ����_��|Tm�z��a�S�]��:�>���f�KqK�6�::!� ��B��)LqO=��ml�������_�j�d}����B};�R�>�Xt64#�pbc6�9�jnXr?�^�=��s��o7m����1����J?B.��}re�ٻ
���Khs�ӯ�m49��<"p���/(+��Y��by�5�`[q�����y����)n�K�55��!Q���7M�N[���u�'-��wT�[Ȇ�[P��vQ�˝�v`������7��=2 �j�/�����7��cb�Bj,y�� }��3�k��nl��ű]�T1��a`y�(�7k�����v��7��CĲ"=6�G�f�L���o���l��t-U^�i�[�~���x�>II1��y��1X
��ȥZ�ix�O��������'q���ў��dT-4"��f���
���i����� ��,��>�,�aF��MA*Ꮁe�q=_��Gv�3�E
��Q�����s�ָx�Z���jͮ;	��sȣ�M!(��K �J2�x�a�:ȇJ�,Xi�b�P�°^D�f�2�.�6�'�l�jl6P?�RA�z-������[�_�"��Ǔ�]�6뫣�91:��l��/oi�ԇ��j�� 68��t�L����海*�����ա_^��9��X�7�!���`�d'|.�,`���H|�/f<r4�nO`�l�U���r�ԋ�s���}؞��+?K��m���y��`ɽ�A¥���%2R]�I0�5��à}&.�7��3���GrS�U3H����+~������I�S�"(@:�K	�_#�E�fCr��9?鄋���[�ky�*=�9N�,�{$������"W7��#w�tس�$_:�Q1(��g�+�5\�D�1D<{�5x5Z(ݯ�f��B���ez~��j��\�H6w��p1�I�δ�/+'5ݍFCy�� י	2�y���P]�:��U9�_�N���������8-a��4�F\����>����46�	�a��rsHb�ײ�e8��k��͇������{A%ӝ�a:�����S!��� ��c�f �nC��T���z�0�I�M}��<�~�Fs���g�����%��0�Ň+@��zET&�5��\�����D�1���)����hI�6F�����͈����R,{4P��ƈ�|���ADfT_�
V���1ҿ����](z����mW7FBa�Q��Ώ�qGyv$��.�*�g,a�!�HT��*-���5*W*�.���H�����(�0�vѻ�Le�ٷ���1�Hۗ���p��xI�v%@��C3�ppy䛮��ė���v���t&�4ϰiw�#��y�z�o]�I�B�J�>�A+$�/;3��������l��g`�>�&��8�2����vx%_K��${<�b�@���R}&Z��p3t�ǽo��HI��}+h
T`����s;/#YD���l�ˆ�zZ���$��},��n�g�&�DʡM��G�}l���Bc���ֿsg�AV=���$�~�)�)t�'�.�?�^n!�e��h�#Xg�\��:�佱٦�'9���^�{���]����Ƨ��[��H���Y]��a�~[���^���- �����+;+��O��b�8sj�;�M��Ƨ�0�D9$�g���$��y9�����3W��Ez�5��?Ě�鍊���oL�K2l��U,�<(�J��;2҄��3	�Qxx���3�V�	햵Ͱ^�̡w\go��|`���(��9��_
.qOJ�=a]��7OS�b��红�/�:bg:�V�!�p�o��Pa/�_t>��C�sO�'�l?��&�@I��~kOT��
ɴ�U�������=��yɴt�T�Q���[�iMe���:�<81�9�0��`e	��b�2�m}�B_lGq�C;�1��@ �O�����3_N�/���3�Zu���=�������_סY4yzTf�\�eha��,�c���{9R���;�~�q���U�&˨3���&�_��t�U�S�S� ��ю��)�>]�������1�~)�HE@l8�����?S����P��1[�!����l����7s93^��v�E���������l��.4wh�].ufi��p�3R\�<� t�\�ٿ���1~�wC
:�xe?�a�t��N��Fˎ8��� ��Q�ƞjS�� �/)>�ȯ�0� y���V.�oF0C�P�Wc����9�Tp�JQ:I5
O4�ǒw���
 T���#��̼������=Y�z�}�T9[�k�=w�ȉ�?�C=m�G�F�д���V��(�B�J�t��)9$0�)!-g,��8�ý���C�ĸ�>M%��_ �Mty��q���]b�vߒ�d��V�ybU35���(%_DW 7�$h]E'k1�?�����ᙝ�˂A�����m���Y�eǒ��O�n�tl���&�y�Ȫk�T �����˟?�̏�;�,�Q�,���%1}����xW��b^���v!��� ��������;D*�`���ZC��f�8���q��_���/O���Y��{az#U����*����v��*� ��ǚ�{����AH�
cܠ�{N��fλ��A$�⿥�8��3����w���Ty�iQ03	X�9p�s�V��k���춙;�x`d��װG���v�n"�T{�M�"�1��g�}�Mzt����|�H_�^�h����ʍ�aCGI�Ä��Ǭ�Y�0�V�R�=����Q�:�$+�`5e���q�0[{i��/��~c��
Ҭd�X����+Y$�N�g�N�	'0����u�^��<q�眣(#���y=�<{��	�/�MH*,��Y�&7B�RA��:� /�G��w-�ڏ�a���~�oOm�H7+r7-c�����
��W�a��mq�Gý�9u�����|֚�j��^7�)��ڪ;-��_鱼[F��l`�9�
z����C��[�]�u�e2�U,�ұ<L؆�Ju�e86�荸�MdD%�P���,i����j���Πw#G1��-�F���_�[�wh��%�8��.�e�������*b��C���?�O���H�LTԴ}���=0�}�z��A�j�k�@��"){>$���$�Rsw~�i� F�0�*iCj��:W��{�V-��@�~ڍ9��W�ey�.�w��i�̳��mnY%�(DQF�f��u������ʇM���j𽮬n��l���������0��b�����u�2�$���R���~�Rߖ_蔖�}~u��g�"s��N�?,�J@�%d�VqM�CЉ��Wr��"�+�1I��Q�u
]����}����(�\x���Btc�?Gj"@`^��!�)���=z������9£��t�W�ƙ����ʤk"@ɠ�qr!*f���<��J7�Ҭ��\�k�^tX�F���o� -k���gݰ=�bk����_�+
|��$����D:���%;׾0| ��X�zyEi{Zb�0�5Ɲ�oJX%R��F+���Ɯֻ�g���oee�н�y��9o\�C��������(��:R�W©��ʐk�`�r�:1@��6BM&�n��FĻ�?r��; 9��Ao~Ө�� 
�����qN����x���臘1�-6i�M�c� ��:�����r~��7�^�� �C�U���6����"�Z�xַ;�HܕF�v+��ɒ��p�
�[m?c	 >E�2ua���|=k�z��.�í}�rZ���k=�����v�v�L�����y�n�,V"n��kj���Kv�����]{Z8X�����1*�Α��P6:�}Dvm����&��N�b,����tsq��*�):%��� �OT�K����#+Q�B��J�vOf,���r}/�u]ܲ$~6=����ßM>��2��p�g�fC	�i�cf�����VN2�G ��x*�q�O��= Ҁ]�y�	�x	�QvJy�~*
���!����P��I�s�/k����'��Z��֕Nٝ�6�晦ө����:0����=Z�,O���$�L}/.�j�G	&�� �2���w���4�M�n"�u0� Z�>�Ah�`U��e�5���zW�W(���g5�#��.�\�=�:����<���=³�°W	2�^s�^��mOzj�_#�����$�j�"�D�5H�����DO1�|�q���{*f�Q�@*6C���9�\��3�b˼������\�_�\��.���𦾆4�G�C��~����)	Q�t�3�~���Y�r�XRA�łpR�q�}i�%�/��WUj��m� PQ��V5�um���@tҟUi�0��	Eue���d��`.@y<:�����0�@'q�����>��]@�7��n��j��]�|<��ْ��#���CC��CDu�$L�*y9e���H����出O�)��*]�WI��k*�A�f�|%����M%�ٳ�K^�F��)�s�f�a]6�ϔR�@�y����l��e,�ՙ�)��P�L�o�$-}����U���!i��,m1K"�*]�	$�U�@�*m@f֦��Ծ�yĳˈ;���6���`�-�>�|Z��H�D�靃�[~���@:o��s0���;]Z�v9��e��uB�}�}�e�1�p���
�-R�Df5)�g��+P�"f��$W ����K�9u����h��#!�{1X�JL6gg��UtCy_N�����/V��*U"�����	����� ���!پ��bE�
$��[��U�as(�h�T����)��#�`�ː�R i��*�&�Ro���?|��1^�f��0�����epV1$��]�����1*����hUJ�+��h��z�F.�և�V�|m����l�%��h<�ka�H�~`3�������U�cLR�3�����u��إ��cW�P�oV�]Fq�-�*X�Bt����8�Cѻ{�`�	&]���{P�t�Sp�M��@ݤ3�-)c��t2O��o�ƳGQo�X��e���>�t��v0��Y�؉��:��Г/�5҆���&�/�NB�z%sNA�Mu�t@ ~J���+��S�l2����O�&=�\�dKh��4�=L�bI,�` �.*A���5DYy�Jh7�l�](�F�XVk)#���q��v%(��)+�6�g9�4s~���*�wQn�II�]�x<�,_{	��÷.q2�;08��'���h!*�"A�Bk��V��E�>$\Z/��Ǯ��O�@_N�`j���
�ǩ}����M�YI��s&�l���������|�W$	��+�R V-�1&*+0j"�,�uD�E��l�>MW��`��XG w���
����ݣ̅ �I�������	U}z2�`�qWCh�|�4��;q�'����u��#��z�~'KP��C���2��B�H#�k m�,b�cP����Bҧж������+���h��<͒��M�H������\Vhpw��\�x��x��J'#�3"j�%����Ճ�y�F�~{��/�H�cNۭ��h1��%��jji=_��[�<��r��fy��Z�� U�Ŀi%5'A�l���L=/ݐ���5�/�ki�Ƥ�W5Ȇ���6���Eiz"c���Z����蜥��Ȯ=��9�w{!p�3�Ԉ�a��AK�VS���m-Fz$_c� Z�a�+�`7��(Yzrxf'n�͂�a-����dV���l�H	ڕ�hrAW��W������9T��$:S�S��PT��qe�2X/�2�o�$~�QP�7CK��f=Wi��S�����+_y�e�f���8`�L>��f};	c]G�)��OC�X= v�gx1&<�����Zyv/�܁�~Wh@��e9��ɲ&��W:��ɦū�-^܀���Q ��qء����.n:���O)���:�o��lI+�x�Z/�m�Nmt�X%I2��^�`���jM-6�VG����5z���jvu��P8DW�Yǟ�� �ͼ���Q}�@��;��(�3}��Ї�2���I�|qt)�R�:�*+�;��o�dO���p淕�=��Ff��G�wC��)�
%k���g��h���٠���icE&���ɨl������`cE������=��'.�q�5�J�N�b�OJ,�0N!�l��R+�3�J�`�����Sȃ��ĸ�\�ҐCfxد�ϙg)9.��!o��B��<���Ql�5P�ށ4s�N�oh�9�>b��xv-���3�ĩͧ�^j�rz��h�!�5��!gi�>�v�Jx[�J�W��G��N�P'ը��^�w� ߩ�i�TlN�h��{iH5�2xɳ����$�}�am�6��۹���ϳҿ��B�2�OzET���������w0X�3�@��U�<.�޸!�GUG��xyi^���B�,ޏ��Br�9"J���0�Q�.K�w�d�]$�U׬ί/�5@�閿�o����T���4��aix1�YZ�w��O7����/��5ـD���I4��^D�"�P8b���`��2i���R�͒��Ԙ4G���ӯ$gwKi�aߑ��¾�H����e����n���H[H��g��T��=K��7\����p1K�oa>W���d�n)Hr�tqİ~+��]-��ah�'�n"��)I i.�R��_����K�ëI�<���7�`?I"TvCM�ڬ���8OA��A4,_U{�=4��s�=�A�W� NLa���ۛ���z�z���GV���� q�<��&�	�Z�5 �PX,cv,��J��W6iǚ
�6�Q���w��G�)��-� �Ú��A�k[���"����`?�"W��Z٘�H�j\��'�+�8�l0ٺ������T��4"�1�����o<x��w愊*�.��;f�S��z�Hi�H��Ш%�=0͂^"�xD�?�nG�bB�c��xk�FSǁ��3E@O��3H7zOy5j����T��w��W�yfg�^k�}�z|5�=Kϐ!�6�c���d=d=�H��O��=�����4/��fxcw��_��փ�3�r(��iRĽFl̜��z��@ {4GL#ѫQ������0� J^3p��t������c�~��U\{������f��^ɧC��]V��T���2V!P�)�kǲ����罝JU�*�(�	�j�=}��|��)����(y�ަ�u��i/�Æă�^p7��I���"�~Ӑt\|am���������(qP�39�[���}г��dd#&�b8�2Z��#_� �ŅZ����L��8�=�ɓЁ+w�1�1
��b�Y���`~�������bqƴ�Q��1�/�G�/���O�N�@f$~���a�Y�Z��A�?=�֝a��d��满��:�FǑ7yK��l�*�W#{(4��i;��>�3C{t����ܪ�d[���c+}���`�gغ��S0��s
2������0�?'��O�����Okp�L���N�9�e����/fQ
���|�����ۆ�[��	u��L��JЉ쾔�)�r�⽬�$R�7�2��٬�l_v�]:�z�1;�\��Qh�����8b�^��
P ��N���Ql�>iǨ��.7����v ��}`�� ��.�ɜՙ�hٔe>�Τ�$quy�����E�Jk O��6h�.og:���4������~sÚWgK����X�`������8HW�W�ԊY�	
o� � Ľ�W̄*|�*��`���
)L�Nx��Q�eY�S��Y��b��� /���<���7$�!D�ܩs�<�b�gm��3E�Ō���Dd��J&���ŧK��S�����Hi��⮾�pr�i��c߭�Q���-����#$�$��$���]O}�u�Y��Y
<E�y�CںB�R�">��䘻���i�A��)���u����^E��~�P9�~�6�+c!�Z/��iOH�k��h&�y$�$`Sq��,j��f��i�e�]�"?���.e�q!�����&�[�!��䖲�7�Q�+nɘ��R�	7ab'4��)���TUL��w]��G�U�$-�=��Iv����I��O�v:�������\̿|�zR���޸���&8��G�����@�5Z��az�s����Z������X���� qA�^Y�o�`�`Uk|�l��%˃��ֆ
�1H��s���"�X��ِ�����23Q��Ջ�0-����@7=V }|��c�1���w��/Y�6�u[Ӗ ��oe�iͫN�e/�[������U3&Ɓ���X]��������0L��G��	��Ъ��*3�ܳ/�[)}��zV��/��[p�2ۇV�t����|L5�+[����{���'e϶[�]��xP�:O�PMQ�R;��У��/B��֟�M����G �q���n��?��:��:�y~YOv�ax�|��zO�m1bZpW%C��Rz�n3ϣ	1��=�ees�3�:���E~ڣnm~KY�;��{�>��@�X�wL��`����E�(1o��V�'A��1�.���5��n��v�� ʗm�� �܍�Q��G㛃l�\QA��a�ť�tӜ���T��l�����%-�K/}��.$!��nĘ`��!jt�"�zl�(_������L�W�D�n�4`�
���D(�)�*��{�V_�F@�\�Rp��`�+G�q6��p�#�B7�q�tԷD��u�!�-n��\�	r6�N$���W��/"?�x�X-P�U~_����bIÌnn�Q��T�3kz�y6��za��v����&a5���5KX�|=�M���,e��Ɠpq~���'w���L5�a�d�l�T�F���D�}nf*����Y�E���f,���S0�W�����U�~;C�̧ +:�HÝ�S3N����b�A~s��j�����AmR�7���2L�`�U���������é	Z������|[�u�����#z@
�\T8��*�	C(�P���
�=V��$ض�Cx��Ɔ��R\��b����S�6Q=I�뇉۹q]I�m�\���PwR�EC8WM�=ʱ�m��e7�	6H�n��v��g����I�<�/�,+�����!{�;�!Md�!�e=R����(x���6:fm��(5�O�.�Oٸ�8u���o���4�R�.z;���+��PJX.�&����k I�R���_�U�l�&������W���f��ŜZR����ˇ2�b�5i�"@߲mP�l����B8���ǱԨ���6����S1]\��E��v�p�Gz9���N��{A���z���r�ph�N+~��Ȝ��$��<JNE� ^ْ?����T}�w�RW��ơ��u, ��/�u�����".�����hK1���z�tc��K���wX�b&�\?��!��tuZ�A>�ǗQ�6��fDh�Ӛ�e~�G�^���X��� �_q�hC��ꧮ	zj�}���Fl�=qy�$;���N,���c�����h��&; ��L�
�/M�A������ypո{�Mm�k�����|�H������U�.���~��H4�,ZY�o����Ȝ�󜋹jKuy�^�
�*�D!��/O�o������O���H��R[�����n~	O��8q�ch�.��3����Ү�G4���9��.�N"_EH%j)\g=��S]��,���t�O]�_Yv�:R��`�����y���5C3X�!\��x@9^�L"�N)Qp|ReXJ��e�A�v�}��=;e &�����Ұ�H���E��s��5�q=�}�w�ɝNǚǇ�x��E��j���?�*p���Ҥ������a� |�Q{Q��1\!ҿ�{y/@vO�#Lu�M��c�گ!�W�{js�+e�+�~�`Hw���煭�@��Ku��)B1 ����C�-ฉ��\�����!�rv���w�̝�n��d<��Gt,>MT�up#���C����ѬHqGў�@��|���g�R6w���	�-h�K.�P!�*��-7�Hr$2��q-�Ya���w|L.���1���Z��qGm3ZOiK�k�nt1@S�=��M���	��y�Wd�)	��L��ھ�=�@P��S7%���V�����=�p�Nr6/����M�!h�i3�jaM ������9�ӥyu���f��I��� �?G�>�G�	+���fY�gP���׶�BDŏ}�V���"�&-y���DLbk�Z�,tnF����3l�D�ub"IbZ��z`��҅��b)	|�<,%�oPG;_K-��wa�����x�C�~����)E�H��I�G�f�<�u�[��*Q/g'��ߏ�[��`�g{`���a���ҡs�SZ�j��ʅ���;��?@��(�9ӎ,��A�@PyJ�.��@Paok)$�����Cⲟ�0��_Y�U[��;��]\cש�.;Q:;]�%&>����`Qx;�
� g�xz���A���u]5\���n ˾԰�Y��}�m2�}����b_�y�0H$a'��!����{:���э�*VR| ��eYQ��0$��nf�X(+��Q���9�n���G��4In�'}�$����~��?(<�fӚ��]ڪ(��+�4G|e���^y�`K#+�/������e��|O��ހ1#](��R@PB�u6�9߀|�����ӣ�|;N���7f�/_���K�'�7��
�.`$L��ߢ��_�A�?Oda�p./M.X�亇4ȸ�k&�OXqK��/�D{�'��}z�0��!EOު�xL�ϯ�ؖ:x6G���S�S/Ƒbu(_,�mܭ�l������ȶ� �
�6��B9�=��&��vMP  T����W(����]z��5%�(�jP6M* 4*)<����S`���R�r�I�\#����	?�Zn�\�0#K&g��bWS0D0������x���MsN'��Ze8c.]Ҵi� �a�Q�x2������ �k��������/v��k_.zO(�+I�"�:d����-���Ii�a��H�F7ݬc�z�r�j9�e�?�!;�(o��>� �
�W��`^�a����n&J�?�7zxP	����^��9u�&�0mY-��OB�ş(���m�Y��L�NG�R�Fq���O��i:� ��5����������e�#<�'�����)Un�C���X=��1nV��y���~}tv��h�����3tΖKV�K�b��w��
3�3��t���;��K����7���"ɶ�����zt��KXF�*ޕ�n�/�f�[!�L��/����� _������[��-�tZ��1���/Uf!�s�����ڹ{9%���O9��deچ=�4h`Z��E]�.v�l[(�A3�v���m�{�ɸ�{�\�����H(s�(��Z�f �)��������-|���?<{f��F���3�s>��=�� �+n<��;�"NG��n'?�r�����oK�I�.P�6��
���+}�Vո��+�U:	p��Hu��vn�bU�������k���>j�0כ�j�D� ���K���+�j>�v#��̍���,���$��wm@�S�8#I{�f�X�	Uc����cL ��?;{��[�(������@���]Z�`u{�>�{R�G��ɱ�9���?k<yí�ϖ�0W.�R��/����{��: tl03�uyӷ��ṁ4������{(��Hqe�o�ЖW���_�׊���"g�V����:��T�x��s��A�R'�ŀ+�?�׬s�;Q�? �>� 0L#��LT\Cē"P�a��z5�WܐnB�7!�t쐊�3�Dlh&n��)tr��b�GU�2��v�
O�TȊ��|Yra�����'+^O���16�\�<�qo�V���kI�!���#�u�O;\���Of<B��/,�>�2n)��l��]C2�ht�����	�6�������@Tr���E�S�}�p�ɩ�m��ρ�D���e[2��K��%����b%&����Q+��U�'�K��.��i�%��x���-�Y����X$z��iMs
���Ocy)H�X���2���?��{K��knb�b��"���I�E�$�}��Ř`��&n��ΐ4H�b������n��4�	�sm���ɒɦ�>6���A�w�N�f�U��܏k�Ƃ[����xc��2<��9���A1�9��8���w�QI�{�V�_i��]�>�9��cZ���?N�`�@�9���r��k��?�(e�6[�0J0S=�O)���a������6�ޕ6�����(B�f��z��n�.��a�t�T�e�Ja���2�AW���0��ӟv�/b]�a�<�� ���i�%2��,��m����}��v�~�ڙU\:�&�3��K�y�N+� ��`uݜQCS��Gfગ�"@B&ڕ��)�T;szCZ�+��ݖ\����@Aȼ-n��C�6\���f�Z�|��B�B���{P�=4<�ӗ�\��8{O�P�}��<�n�<"~��v&�+P�e�I�c=7�e�,?��--��Da��t��A�K�_�O�ӑ��Z`#O��9�\f�t��]]o���&�T�,5^����܆$UL�=QKʎ�+ص�9��ME���u�Vҽ��&��|�O��/�L�l�VP��ܟifnl�W��,@�(Y��2dhf�=���p��+9�N�t���n�;	���GЮ�\L~Mݵ4o���L���,f:�cs�A�s���� <�d@x#7��)bӓ;�ߕb�?i��i��$Z�)!P�
E���*u ͒�����hzi����E���_�
-�������h��R�fo��-X���~��)�أ�N��=��ן�"w�hx5ۄ`�i�p�Vָ]na��M.s���y��پ������`𧠑�U�~A8@?}J�.bO��.�F�v�l7�$ �z�""<��!3�xD�^@���Uv=�����0�)�7JQ��<b��2�6[P�ϿK\��MX~���B4�WA�:ڙ���}Ο�cS��Ҝ����J�@%�o_c-�槥%�A9�!i:���u%���p�M�"��tR�k0��{�ZEG�Iԣ����!��Q�:�����&�t�W�0<mE~�sc�� OK�`�jV��"��gaiI�3d���0�� _�ްt='!�t�x��GriKme�,hm���8B���|�-]�uo������z�{�R-.ǝ�ZZig���lY)�E��[Z[V��yC6�6��µ�m�{'�B�A��~�O��a*kg�d���5�
%V�C����ƀ���a`�)�\��Q�i5�:z�V�⺕w3a~^��1H���5��[����͹N�={�~->e�hl	oAF�ʿל�T	�!�#h�Gb� |eaN���e�
Lס������]��!�Z��iLjn���3Z?I�v�̧��ٳ*×����ew}�"D������ϯsk.�6׮�Ioe����64*?@@M��^>/#�yV�]�n�Ʈ�I���"zp�Z�+F�����)�R��ʕn�ˠM~����3��w��ʭ5�ʴn�������F�����t�@ޏ��4Ul�x+~�=?���!�Ń&�J+c���20����	,z����3kԑnf�����_	�c�!gs�a�`��*��S�`�5�(ϸ�k��-���3�o9�qFe��,��c�"i��+��S���L�9����Gv1�����):^�I����C�E� '�d
(���^�U��{>����/iq�7|�i�Ȱ* pXL�y�_Ե���F�u��9ń�cͬ��g�1��l�C�Q�wV�.T�*9��t���������"�{?�#w�H@n���(�>I��8Y�m?����cJ�N�3S����?�>2A`{9�ίƏ�$ϨɁM)�?��n5� ������_�c�"�z	lnC;�8�~)�b�%M��k�R� ��v�[?�s��=
M��,u c+��L�&�-*3,��39�n@�w��ԂF�Z��>�)q��*�Wx�g��ʨO�n/PY%�8�!(�g�t�9��zPq��>� G���4�f�&8��5{������:0�Y�$�JcV֞�`�ξ��p�i��a�h�S�7�}$8��K�5���Ń� o�j6����ꇖV��M��4d�f�����/+�\�@1A�p�0Ȭ�z��8��
�2�;��>��|/'�-�ԩ�:�Ӓ��i0��,@�#R��K���O�H�fs��AB�2��-M��&�dz9ͨ��~��� 2�9���U��"?��~6��J+��(�zR�����CdF�lu159Iʈ���B?�s;PsF
���Y{�ro�5�ej1�|�s��op���G&���C�jG��D�ݔ�!,s�a8d-F4�m]
o�+����X�L. ��#�"��*�*'^%}�SR�Ng�j���Eh9�$�G11���A��WsDw�y�퓬_���(a�Whk���
����`K���i�B�AQ[~)�cv���5O: ��$l���� ����Ϋ"�������g鲦d�)���y3f$�!d���p����h��[�o״m�����h"�gԘ��1Z�%R4�[��ҔhCZd�CV�sâ�{�D�k���[pE@{=|[{��ԓ�>pM������t�"�G����4��,�7J���$W�k�[?)�� �|U�лR~�S?��d�:Z���5I����܄�rt7E��O�"7@� ��k*˷��.�*��D~5���)�U���5�>(�^ġ
��k��k�g5��{��+�i/�n�GhX�X�X�aܻ�s��.z 4�V2��qvh>$��=��<S���%q{�Yl�z	�z��z{��o��µ�� ��:���]��-��,�{�����Y�v�'�6��/�x}.��Nh����o���]u)X:n�{�;vХj*v!�C������x�J Qa�4ҫј�x�����H�l�\2v�A�ڻ[%ɏ��]~�������I��e<��h���,e���y1�o�a$Yq���LOa�Mr�hK�y	�?���N��p!�c�
��4����m����G�����'o9{�Id�Zv!�۶y$U����E�>VwO��E]H��iw����^�'�����o�j�}Em��~j\��� A�to������� �@�����~A��X�/��K[v����֡�Γgv����Sܰ���i>̧CP!�9˘��#S~����S#>o�(����b���R����1X�w�5o+P@;���*�;��cd%�����u}*����^��MXg;+0çj`2��^{'L���E��|�|�P����+���7�`�8ju���9vx������E �R�;�8m�>\��&�x��̅�r	�S8��;ysd��lY���/��ӣcX�bXV�#�#�J���I�O�%�\����R�~�Q�Ӂ��CT�F��2\�m�S9A�Ա�ܜ@ûD�@In��U��dk��g����J�'����?�M��e5�g�����X�фnv_y,��Vz�C�cyxñNuW��:(46X⤋�n�f���u�dy��͜5��b��
O��c����u�h�h딱·�|MʄV�I��V&���X��������m�E��e!��ݣ�oGհ=��Z;w5��� =�����w�EGY��n��CSM%v�s�t���]}�nڱ|m����KG'�n<8	��,�u�B�Hb��|�Yt���~W�~��~�3�f�V/�S�����c�P�<t*��G�5��ׯĘK�r6>���:7�_H���V{��K�e��M�?�������By9GV�ȸzc��D 
�=�P�s�ېGoZq��R��7{��4�8l����-/�=��sQPy|4/ɦc��/���&�5"�;�W�E��h���e�v�vk'�W�6�go���3<�m��H1k�XEVvIx��4_b �����n�\8�3"���J*�P���8�|���`R�G�)I�|�uHN�O^�Wc?�a�0:@�j����B����Y��U��/�Cp�K�FX�
�&���4��]���� \ҽ:
-{xc<P��!$�b�l�8�oɠc%6d�\�Q˵>��wÅ�ڽi�rp���md!���ί{�F�'��D��m�����e��u)�RRe�L7�ݣ�&��9�3��7��+��k�B���6z�+5~��^�bL��=�ݟ)3��K�y���e��ٳ���UD�4��jX�;��� 	p�d���WI�Y����
 I�p3��MA�uys��v�JY�
m �{�YJsi����X���*��_h���hs��B-�]0]$��\-����?�=�m�UÂ�;=쓡���������K
�
|ಙy�bw����u�ջ��63�h�~`B���+k�x�{E�V%���3pUqS����GA)4όQ(7�-]#��XزF��W:��
j�{z�o}���m���MlB��Ā�Hy���͡s��T�&㕖����@O� x^@���}�ƭ?Z�En��0�����t�v����P�ڀ��ԛ�(��F�^,�M2�٬?�.�{ʣ�= '�RS�>�[�q�'ڠ����|�<��V�˧s��G�R;�v/�"����.QPY�2�L�y�W!�r&�O�r��U$�qk�w���j���ɪ�@m�в���5/�k ~f�uh�"(���J߽�0^�r�oF�u\����m���-����K3g�,ش��6{U/{�#��� ���A5�T٘�B�o�A�5&��b��Zi8��H����]�K�(}	N�)�����;�6o�\g#�H��W��X�G�V�+2���k�pR���/�B��ƪ�7�J68����=\�&�!�>�1*�gAD�����L�&*�,Ԣb���(����	�5�a^@�_���wt�5���Y�C���N����I������k��Gγ���}�;��I"ͩn͗R��<�9�^�5�O��R�(�=`�5�#�#�Up��f���d��]��"�H��a.p^Z1&��%ii�����G:���k
8d��vc;�_�g+f�L�#7�����kШ��?/A�q߿�޳5lr�����]H����h;�[T��}?1�X�=xI��΢>bK�}:�ò=f1j�Bc�K��	i�����?�7*���K�d��~y+2��{�lb�%���!����zS\���"#vU?.��
���R�г�x(z�Q]0ľĖ��s�/�DY�3��2��4G��T�;I���/;9�A��_L0�!$��!-�-L��NO�d��Bw�ۨ��*\�cd
�ʖ7/�U��J�M�,�;�R&�*��Z� ������1�d^���0f�D�������{{S=�c�`���i���b�?�x�˞zD��(�F(�9��/��aN�����cs���u
�D�,����lf7sFA�ҳy�$��+6԰٦5����O�)$a(X�^c��g\0��;��9ޯPꓛ��E�J��mZ��ɚ��q[�9{��z��x�08�i�m�B�C���qz���H�؛�Ҧ��w�W�k�M/�X��Ot�ݚ�M0��E�*�3�F���t��A��_�m|�9Q�F�:c�����4og����µ�d�x�����9��΍Gf��!#�"!�
˯�~������r����w�	�,���8��_2�	�"���d�-�ȡP*�H�"q"U��f	שׂ���+_� �yAa�?�tҙ�ga��}&F3�׸���!){j��$�(	���"�ˌ� �ɝ��#Ʋ�U˚]�Yt~"�|]�ƞb$HL�*�Q��P�9�7%�;2]1��A��F`���u���n��6a8�/��Ij�K0hX=�î�ӹd�^�Qc�b��3Ғ�e�Щ�Zk��ʧ�W���_0~5*E�%*1t:�781Vz�0+��lK0���4��_�$���m t�f�&Pำ��� w���������)��TS�R+�Y!�,�S���,{����,75F���A��.�i��n5D�� ���|�z��]rae�=��^�f1~_WqaGE�l�,�3�8�WY����:>��Ш��Z�ܿ�\��a����`�,dؾB�V�Yב�	P�6����A�#KQ�S�8������5���������Wcg��C�j��O8^K���\
�"e'�������7OC,�@x�!\��K|�.R�:݄j��wlF��6���'i4/�*�´bAE�K���*J��{8�-����%���
�0� �\��b�v ��Q�|vŻk��J�U@��A0tJ�ʍq&v�!���tb��G��D����%��ĩ47�
����u.k/�Z\�:@�F��{�	��|rύ<ρC�U�/[
��B1~�w��\�A!�9��A�~�̓��b#^'cԴ3{8��Y�e�"�<{�J���F�˴�#����>4�k1��[cBfý���N�����i|`��O6խ6]�`�|؁�#.Z�>X�_v����������%	��OŋQ�������W�����+FC.�FO�諪-���/N�^E��ن]ӂ(�4¦8�y�U.k^�P1���)��h������s�� `�}�a �uN�l%�z?7&E�1� l���OQVΦ+%�n�s����'nBm�:��n���cv#~�$�1�t�1�e5��P���eON��T���ҿ��$>\h�й`ʟe�����ÿg%�qt��&���O��B3�P��K������j������ƇG0�<I6����D!�FvT'Rxʃ���$	Ah$��ެ�"�#�G5f�a+4,�"㡐z���7Qr��U'�P�h�eB<at:��=�����������dڎ�����T_@��z��B�s�+�0X��<�����"�g�J �PG��e�yּ6�������+�B���	d�W.aE�y��^��;���ʒ��^O�Y�WH��~~��ɦ�m�%���>��KI���Y��>����V������Q�V��,���q��!���r�������.���RQ��b9�����9/"�0X��V�DǺ��9Ro�˼���'���ϕ ���� �u�a7�Lھ��!<����k�ụ-�!<��MJ6�#ꩰ�O⟓��DR/g7:��-3���q��g{4D�o9�J�XkZ+]�r?%$�e=��'h�����M.�����#vj�O�w�M�� ��N��YiA0�#�fE9� 9e��-o6���TVs�X��bT�*��µ�W�.w���Q�3C��_�u�o������EL�a�s�)CeDﻋ����T��k��e>�TD�p�'�o�<lx�y�L������;m�ヿԪ����c�s��1J}�#�$�	�ޞ�g~�*�`�I^��|H��|��V4=�����ܹ����6Ds�Ҧ��u.2�U=@Lt^�=f����`K�4��1] T��]H�}%k/`�Y$Ɛ�����BU6$�x����r�B����Mq�f�Ŵ�� y����v����w�P��5���p���x������ac�-���W�Ra��d�Z?�d�|��,��KT�ޗp�7䊞���/������0,J���GrEd��C�ߩ�1�p�C�1ų����B|���`��1��JĲxA�\z�
�<���[��E�����FP�U��$�@����EK���˸�_hv�%S�d��i7ʝ��k�j�5�#��d�f*�I �t��HN�ke����n ��{7<���(Q�=�<��M�Β<vqb����`�v!� N�]A7jL�Н���.���ֳ`� /I��Js�}��(��-	5����e�-~�3�澡^��O8JH��-VuU;�q�Կu�F�y}�ek�HAC�=}�Ȱ~������b>���U�#��&��NI��T� �=�	�p�F�)=A{6zg4X�����X�^��cK%�;2�;r�Q|��d��'�v9��7g��T�?���3�R��_y��ǎ��l��W:[�����Ȩ�5�+7d�vk5Z��#���'��iM�ַͨ�Y��צm�[x��x
7<uA��R����ω%A��wi�zȻ7jRk�9~t�~�q�����j�0�����9�L�k-����$^4����*{��8	;2���ե+n����&!`���.Ne���@��T�w#]����f����IC2P�Z�� ���jzIݦ2+nڇI�U!�c'��S���+	�$9`F��3c�����q�Xɒz�KV���d��Y��v}?ĩԷ]��:%:3����U��PXV̛�NrK�T�T�$_�*�P�"����x�R��A0�斃�g6*�a�|������%@�ay��ᏽYp�쑲`w�^ܸc���re�-�U�(ܛ����n�������T������e����F����gS�9���r9l�c�GGI���(lk��ra�5q�GfZW5��*_���4�YY�u�Dz�� Ir�!��L(��v�l?T��\�G�R����ˊ1P� l��%ׯ2�'�@��D��<�K�h�#O�$�%l}<!�6�w��Fڈ���6��hn�+s��b��L�����v9��,i�M�U�Rs�{��]X��M��r�������IScp��u+V�ysuull�Yb�F�م�.$��$M��Et�f�� �����2�O�Fݎ�}<�!b�y�Rq���i���p�oD�C������c��� ��k�+�#3�0�1��ݞ�U:���b��u!f^�q�-�X��M�.N{֯4Y�v�� ~/w��;��=��kb��!b�K5���v�I�g=�)���"�T�b6 	���3iըi"�.��9�/��3�-�I�b���}:���2�!�@W�f5��1F���~��&y0[�F?*4�R��b���Q��nO���/���@�O�uAA��[qm�x����� ̃=_;j���`跏&�0��S�M�D�WY)��x Fa���T����E��k��6�v�`i���q�:A��,�rݛb�G� 2r���`��Tdc�� � [���S���0
^_��t%��V(����*��|U����?۸	��t
i1s�9���ز[@b-�ջ��.[�;�$�UGpGQOև{������:L~��֞h8�	l^GY��X��İ�G W�" z�}Zn�
�Dʜ|*c�&u�dT�;�ߡL�۲�\<O�9ͪ�E n�k�Y��bF�h9�����L�ǆ8�O�ˢ)5����gr5��f@C��e�{ �b�I�A�r��CU�������F~��B�
8 ��� E���B�ӢO`��rƵd%=I">�4'JQ3]�R�E�N����]{�KW�U�P#!�E�i�X+�z��F�u����&$�ň{�+9�E��Nʦ��(&�\CaE��{@ǎ��BR.�'}6d���=�@لp@�Ok��2����VL{�h�P-���������M��F>oAWr�8˥��On[�$ϯ��Qɯ2vls.N������^���]�u���P��� ��e��y���ׂAq�:����P��ë�����,�گ�̶��|�	d��H:T����O�0+�w:�nJ�P֚g~Cl7"��@�*/�,��h�����ۺ_<�X��\�՞�������f'��v$�Q�c�����+�g)��i��ʗ%�ofO��H�0�c�G �L��d�o�D1xU����tO�Y���2b^6�W"��כ�g��g\a��F���E#pK�)�`#d���~ړP���B���6*eir��6/c.��������Y�g~�VKs���V�s�@D|��ks�Ϟ���Ӂ8���=z����t	�����۹�Ww�\$�X��v�[rζ#��#�-�RѤҕ�2'�������M�w��i�;�9�uJJ��9G�����Ɍ�va��q�ބ��t���"%�O�ء2S4�3�+C!Cq;9�e��"���N����>�U���&Q�r�FhՃ�`�
p�HL�fFT��H����	�{hz¯v�¢�R��m-<��������xU|J�տ k�|��`�v$*8r�jg���ӏ��j���}����=��M��޻
�2Λ�n~��*�\h9R2������Kk��)~���l�� ̎�y�z۰ǟ L��4���DHH��h�f6S[Mt��q{�������Yf�����g#�Z�'����(s:��J���>�c������V��W�o�a�Y��+��LY}_ t�u�lD��b���t�QĹ������.�;�.����đ��җ�d�=��a�9��s��� ��͒����%7<z�+�qq��}9 P;W����`&wv+��B���ĞU鱕톬�l�k+�'#j��_�F>+9A�vL�~�?��J�~�3HʽE͕#r`��	�o�Wa���,&$�x��d'ݗ�'R��/��#wW����W���У�����d�5_�N�oT,�<�pq��I��%�p8nC�f��7L��4���}X�C�E�˄sU�cu�������Ѣ/Ü�H����x'�ћ!�4[g�Q�N����<B�Uuz�p��cm�3&���{*���thn�+�3a�1���h�~ w ��q� �V��:?��u��F�E�?*�G풇������h�^��>����_14�t��Ni]A}�h@�r,ޛ�c�%����<���;O@�j�6�B��pL�%������|>p�������~1��o�Q����z��[^2M�;� �G�*_���}�����ʺ�'����s6U\G���� ����&<��h2�<��~���y?F�sK�*�F�� �̑�5b~���������99�(V���E���鱎����/��ո2��d��j���%�(%�J(����s)Waf>�l���癒΁}X�j-|q�Q`r�~S(s�������s�K��d��b�fE��=�1AC�l{gq�Aqfs�ty�J�b���<p� �a(~���@7����i�	�$�ه��x�[�]��#;>�2j�������ի��
=��{.�mJ��)Wa���I�X�vǢ�,P�:���e3a�/�o.9깭&�.:z2"��i�Qg���ӳ-+|l��1T��h��}����=�����eؘ��)Wn�I�f�#���IY����v]#H�oX���Ēѫ�z_ ��kx�1��T4l�O!I���nA�[QyC�Չ=D���lG�=���-
gq9�XƙV�'����]����͡�N/�*��+�=���o��ppnpr_U�b����=x�*:�p?�΄bcz�%���1;\㹭W���,�B�4 [����^ʅ�\\�W �"�W��?)�.�R�yT�ڦ�m�Ky�WS��b��@�aTriR�'��F�hZD�G����e��^�ǟ������]���@G��6�����U9E̢I�B�WsOx���'ϼ;��RT�X�9��cT׽�!������Ǵ�b�m�><��{�<��U�׹���5,�H�C5%��&;(y�]���6�U͘�FVr3-E���ժE�����P�c�Ma;��� �����@�,W��T�މ��"�H��?+a�y�F)ݛdmO9E�1VjI��]�%F�mO���|H�lWԍ3^�$?	��7�F�"���S������\UY���bOO�5[g����.�&?����6��~��i�U�gj��߅�j?��.�Av���ZZ�SȊ׹(���qjW��Q��Z3��Q+  �v@�u���"Q�BX$?�ck�
kfr��`s�S���&`1�ޕ�*�ih��1���������>��V��
�O��S����C
��Ҋs' ˡ�;s�z|9g@ܦ�E���e�6iC;\{�����[�ߧSW�V3h{�hZ��=�f��fn6�jg���G�dHb@�*��	)��>��3U���S� a�u�����=�)m���j��Z����M���2F� `szF�ma���ۂ�uU8��n{��l��i)��p�Oq��6�mF�Bk�a��Mc��o�v3�K\M�f�[]݁�lܪ"���W|=���q�zFx���0�Q�m�J�p���Ś);@��O�u�l���p�w����\���19��	�\W1�k��luY�F�R2��ے�H+n�؀D��wí.��J'�U]-�,(�����0.�G����]�)z��;M(ǥ(�?u��4��"U2R�TSQ�f�rS��TT��ewP�!�-�BFL���M�+��N�D�l�n9)��2��HN,@c�g����nTo��Q� ��d�&� ����A��F\�M+�A�R��(ق��Lo��Jִ��8)*�1��U��`��]^��&��.���#�o��8��@��|+`��0
�&�r|Wyb�7�`I[%9���v�P�]�"&��H��:����s��p{�!`���[���<�[q vZ����ݛJ���V�Z��� ��/�J�[��ܽU� �@~~��v�f��(�����d}�Ѯ�t2�i�/����I�
�S=3���x��ց��,8?)+EM�+�:�B�/Χjrd�ȷ*�{�j���͟y�%�x���Xp��m��<J+;҄Fy>ڷ]�0o���4y��)]� �3	����"�\�`����%�f��٦��(#�\� ��Ya��[��+x쿭�!��f�Z�:5���咜dϴ���I��r���1���,#,n���)<���?"r3�4��HSp���6nT�ڀ�!p�}e��g?�=��N���ĕ��4i)��x�e�t�-�}�'���Z*[*Bo�`*v�sy����t�՘����­)��X+h4_4ʓz��mp?�h��G�+�`,F�0��#�ٳ��F�V<�X.�Cqwt��p�<��kE��է��ÙJi�2��¸酡78�MY���c)5a��L�Ά�����Uȼ�G Xc���r��µ�u)}�?��^*�O�BV�4M�:�2iC��Z�w��W������3�n�K��P}M� {>b8��zpO@�k�$��By��#��Y�?��ի��J�) ����������
ޱ�<)
B�I�c��tW]���T�k��R��=�����i��"��Z2p��3"]�����/Nd��z��;�Z�i�j��d4�g����<q���W�c�H���!��n���X�z�[y�wNҙ�`�\��#�]�nH@���{��������#޶�n�P��H���c��U�q:�qZ8�'?��8�)=�R��@1	����$o*��Ρ��b��@[t��\?�a]�O����y�{�Y�K�'�U!4��N��Y/�e���#�Y�^g������r���Q��oK��T ��L9�1>�B��i:��>��b� N��q�t=f�?.��_9$�/����!��_e3�H�V��ҿ�.�}��}���L�&	���
�0A>d�K�_<{Nm��L�ٺNg�����c����<NH}��H�k���@���`�����P����IT;��3�e����o�Q��!-�;�{/C�����˫�&>���=�_�Kf<�2�E�	�e�T�̪�Z��ڪ�Zy�]4���^3Q��_l���x�ss��C���=��1�C��#��s��(\�e�~���;�t�O���$�U�Ң�PR�Ѣe�DoƌzLqTxLO٨Q��I�Z�ȉ����\�J��w&���DI	sD���YLE�k؉���vYX'��h��@c��L��%[ѕ��b���Ώ5�
�I��{?�PV�"͑J�a��
�eNP�`B�����;�ʗ��κ�q\�4E5C��"���2S=�`�.��.=��W}3��������C�~S�<�xD��U��M-e��=�U���B��[�FS���<�#
%L��������L��
B�E��O�_����-�ԚF'c��|����v#���0��|y%��.JŷK�����T���Q7H����~"�.��tL��'̯*�.t�N���]*ۢ����CT��Lʓ�G7}�kV��Ubᕤ� Q'��D{��V~Ϲ=;vΌ=J7g�Y�K�h���]q���6H}���L�\y~g6�!�7]2�{���t��K`��3��9I-x��ih����'�qϫ�߬����
hZ�6N/��-��蹆�2�Pt��,U����8�4S��Ɵhc�W��F>���]V^�l�g�5ۊ��k��i�;-�R���8S��]Һ���*�/��|�����Iqd�e@B��<�8�Qљ*��I2��`b\��+��&�a�U6:�`�m��`ܬ�	BjɊ�]K8"�v���>��*w��:ӻurZ�W��g��V� �J��� ]|�WQ����B�7�iy�W���_�OW��LCT�_�Q7P��0����f��Z8xd�p�u�X���>7�*�m�7�BK+�If��ӻ�*F��w��#e>���~6Y2>as�ܨ�Q+6�k{(�>^|E����yRp�!6���� N�-�x���[;/w��[T�yz��#)�|YwW褛]w�¤�3�7B�;���c�R�8����e��]/Ã�J\�~W��j��6��m����Ģ������OW��h5�����`�l���zv ���#��Ws�Z /��b�����?0���7�d�S�1pЉ`t{�UhY�,�l�KC�_A(��+�8 5�
��l�A�m_b�`rМ�[w�d2�g��>9�X�����N�Υ(�`�9��N��{2���%����Օ@/4���Ϫ�۹4�n��\͟��Z+�]/U|�k9J�<�3V����r��t�pUtsR����X+�T�*wF��?�o\�f�;�{�H95;� Π��!���w*!Ɵ�`�9����4|��;R��9^6�xqխ@��~Ս֭ T�F�!�ؽ�O�h���_l��&7h�͇q�&(�L�u�oA����w���\�G�IE��HT_�>e�"ˎ���1�ӇD�E����Ė�x5o+��<��q�KDAD�S$5?fJȫҎ�l7���-7�	5d����ZFW
�Z�\�*�>��;����� _�֛����kQO��ht��&&�j0ac�~g�(w�eb{��e܇����P�����75�!��u�
�Su�y ���&k��:���QF�ph
JA���N.��~W|;C�Y�o�M���$��38G;z�L.��K(6�@%cB�=��\�6o�`��=�]�2�v�J���7��6&�;��?�����()����l�Ҡ�2�ֺd��>T�k���?i6fe)3�Z���l��)��S��_���áKZRs^�{X)���X>�Ics�ȳ"d���A��{X�ǋ1&~�cm��&Q>�J��^�'�Ǫ2Cop�ġ�QZ�/��"�[���IjC�3�$G]�Z�`�dĻ>)PVV�U��XO��N��D���f�pޅn H��Z�b\��F@����,�z��|��M90h*&���w��]�HN5��G��dͣ��[�~{6��%�V���% e��jÜ�A�E]0�ω��������R℉��VN_Ō������d���<��*�?�õ��s��_ѝ5�b�H*�TE^Jч��J��YL�d�.��u���xv��<
���F��
C��sÄ���Q�a����s�*�g�ł���i��\L9��P�4��z
̪�4gg��J	8�S�0�^� 7�:�A6�^�����W,/��b������^�Y1-4�g�	�7h�EN!�!9�`�k̫%+ekbu붋�̭)��j^Ŭ$�e8M����e��~�ȗ����'�.�S��	L�X	������Zj�
 ���,��ц�i`��*b7�2����Ă���Ji�ߎ���=�C��A��e��=x���W��v��E^w�	c�PÉٝ�q�|����|5|�k��2X���!�kz�����p?�aK�~L*|��(��\gn^�����û�����|��7��p5L��(� X	_��
��A�d�i��;�(�i���4�Ό�w;e*�O	��_9w!q��[����2-@Q�K�< ���*�����u�P�Y��I� %���m��D��&UgЄ�5y��/�j�A\�����͹%ܞ�^:u���"��qw�g`Uxq�4ibg�B1I�����:�w,���u��=qa�«>�ؿ�8"�w@���s_֍P��ڻ�r����J�1q���X_����|���'S��CN_O���?�UG#��ۧ�����X���Օ�Ӎ�_���B	�۠Bo�Ӕ�B�W������|��?���B�_/��,�OĪ��Ғ؟i3 0�r\`Q���
6,�y�<l�8ئRa��ei�4v�g\�][.<���{N~({���O��a����ru:cȠ�]&�Xh���k ���h繳�쌛i�P����R���K�`�D}���eSW�J�X5��u@T������)��/��ۘt�1vo�X�[�@���Ѭ��s.E�-���]p�T_����	k3���L�_���޶+$T���,nz�F!���*�1�%�0{Xj�����Y2
q��rT��]ugas���}���{��J@1�S�ނ1.ZT�|�Jᬷ�L��)	�1+w$q�:���|IN0�V�x���r[�T���`�@sX�hBO�_�U$�B���|O-��<//l���u~�C#����Cf�ؕ2�:y*�N�g7����dM��M_+�sz*fg����牚�L���-���o�aE�P����!֒��o����v�O#��8���4ċ.��i8R��/i뵗�Jd�@��)SV��Λ}N�i����ٛ�o��VtZ�
�!O"ҷ��e�ٴ�a����n�C��Ԭȟ��ϙP���e4��c��س�wff�E%JR�ߝHjk���7 �������e�v)�+7�1��kN4���������L���DZ �(
:<�����u_��E��~�����!J��7�G�_8��eus��U�,ڠ$�3�o��Ox���1�\{fˢ�pr��������v����u3ZLa05���f�J�\XG|23#O��#@J���$f �$���85"|������}KF�9en|�����Ź3KM�K��ȏ�6:Qx���$�c��M1n��� ��u
���
��+玚��I88�W�!
�c�BDp�߹�����pV��H�^`d��E6>�۪����v�_Z$�D^6)4�ʹ.Ur�붧�e o�c�@v�b��`���
F!�ҹ��zy�GrŊ~�]�`�xŦL���4S�hJ}B�'4�ٽ��C���q��N�6i����:���S$�/��U����Ώ
QR����(�k� ?�t�(9(Cj~�%����O��˭-ZZY�nä��M҉��*#���db�mNqn����녙.��\���j̔w��#�M����$27�ꫠ��h���*y�<��� ���$ނ���)�b����q&o����ч���ɪ��J_�jz�Z��T��j$ʦw1ՠ��_=�[%����@ٙ:����tv�\�M	^�˄�:V�d�!&�YC�[�\c�D��|�&:�籱�K=�gJ�폇���k	
���7�Y?������M!��|?�8'��6��E���J���i�����b��;��Y��Σ����('J�gt~`d[�CRke� Z�����xT����p�HQ���ߋ'�����ծ�C0�_���<�@�kj��d��R\�lh�s����ǻ�Tg@��Q5�P��1�G���\*�5�tģ��B:��s<|�9��W8Z5�|/'A%:�1�k�kj�x36>q=���h?ೠa�k�z3�R��H�E#D�N�D���$�Kl�H�Z1x|Duwtyg���5T�_�ŵ�Y���/F �����CW� �ۯ�&�"\F�s��
N q�3<E)�;���4���d�1��E��*ñ��^&8����o�?J��s"�tGLy��\��F�z*ق��*�y��3H�쿷��y��,^1��O%�y,�����Q�E��'�����xC=���`g�rr��ݱ�c ܧ�=�poVcȐyv@�H���mw6 t�;dZ��ܢ�1G�W�vX�"P��5{$?��TQM��k��n�%�o�2O���p���|ְ��[f�*?�]KU�������&��a�-׵�`�*�{�'J�&Vw1O���@b�kl�1�y�����lW�8���TP�3u�����*Vm�@_��.F���������*m�@�k82/7 �!Z�c�9�' �3���=��L��Y�$?B���T�,��?Aj����ت�,�b��D���Օ�p��O��5��b��-.pg_}���&z��/�P����&�_����C�*ۘ��A��63�_�zh4ͼׇ|��B��/#���gPf����str�GK ��Ps���	���9b�L�pH�5S�\�_v�ݘI�w@�$g�[S-�NM����?�{2�������cU������6畽��zR����(Ͻ`�!V ����FZ��=�#D_|ߛ���
-�p�يy�M��ʌ�1�K�v!�Z���L��]bW�����*a�Ѵڅ�2DA�ϲ��M��,訿�VL%gǵAr ��w�R���G������(�0 [2�7QSj�Γ��m��ַ��c���0��M�ކ#�d�rO�p�g�f�B�E�����a��O��z��S��9._�i��h�;�����-�$�{$OV2<�P*=���,�'H!��+�C��� (ɏ��A�
z1��!�Z6�
���'�/yP��/-��b6��%[C]��?ذ;ʓ�Ǟn�0`������t�%y�@��{��.�#��@���Ú�<\ּ\�%=ߤ��(���:X��)�7�_+P.UN(ՒǸЏR�´O�5�ɐ�_u�x,���`ٺW{��1�L��m��0�F��g�U�"�M(v�K�P�0֑V��^+��.-��{-����u��P�/k������K$��b�X9���ym���O��U_�.���~S�c?�����Si�UIb�evN���*LQ�S��nѥ
�^KP�`1��O�A��P�:weՓ�^���p�:[z�k/R�R��^~�\ؕ<D]�÷P��*�P��
݅(QPz;a�)�d�ݨ�� M7
P�S	�d%�A1Q�)��ѭv� |��"�q1�A��.B�N��h#��qN���~��{h��L%��2��K����9�E�Y���ms�����KDc?H�{*2��Y�u�0���땍���ǅ٨1c׎:�����p��J텩BX'<��،����c)��;l��E�@�$}CF��d#�?�Y���t�x����#���.�L~���f`�j�$]7+�/�k�wi�Ͳ�@P@cY�����^�ܶ���|�A�q��1����+[����&h��.�S���\���C��7>#���s�!����~�IG���Ş[�J_,�����	M�<��"	�I\%nu��J�ш1���jM�.���S�����o�#j�o�j�YY�D���Z�#�D�GP�~b��g'�&&�+�B�v���p�'�m��� ںK&�v�Xֆ�����U6�+)r���X�D#�+8O���Q�o�z��s�F#��rN�����q	���h%�,��
9�`��4Y��B�\�϶�.Z���1�\+Y���S��ؐ����_��^�$��^��a^�gM�1�3�^6���A�>�s���&<~�{�eL��ځ��2ݟ��c'g�p}_�~�b�^_�U{�U�)��92b� 9��%��X��t�A+| ̿��q�����
�b�N?���b��	����+k&m�j:R6��Ν>�eA=/ՠ ���z~��o�
PMD�'�N�>D"xbU���W�`&]��	�7Nk�[jX_;��|�K������Xx/d�q�E�$V���4��;��Ȳ�Y1�hdن�ޣ�Jtk�y�F$���נ�E���K����r8�	3����p����z���O�KgqP�o��~��9�L�A��K�<!����eM���a����KvC)X��XO�k���Ͱ���� k��vsD�����,m�E^����|!O$�_-zq?z5^-�T���p��)���S����<��+D��:��yX���Q�h��J:�]C�ql�t��JR��o�x�)�O����2��Q���|M����u;F�g�s�%1�^�1n�MҼ <0��.������Dw�Nq~��_���9XoGJ�#sj��pJ.`v%@���t``�ZH5(���\��吰X�C6���&�����u��k���b�<D�j��@#�ƀ�>�݈5fm���&�u�g���I�eH��H%T|\ȩ䋸[][�	�ԝ�P�ѝhG3�|/�v%*K~=aS�T
�2����ԎY(8M�Յ�#�3s}b�
�""�H�|<(�ay�[��2ó��R{�P�7�b	Q����Y�	8�]%e�����e����&8!z�ʾ!չ���T� �33���q؅�9���k`�#?qs�/� ���cTk�Ic�A�=e�~��r	�Σ��,��)T�[����0 ����F����ϗ�qΎ�gUj��jN��N�w)�!�gl��!R:��Ɉ��bF�#^��JD�3�b�(�F���ζ��~Љ!6�xKD�����b����5�L{�]\�غ�6�{o븒E�ٜ1���<A��%�l�E-��+Y��[����߃j��4s<O���t)"m%��`��AO�	��������ɮ��$���ñ"������I/'u��/S+�¡�/��<ţ��7� �X{g�͢�J����4%���1���#.FN��)���,��j;뭞���:�R9�M
6�Z=����	����Z�Ƃ�v�v�mY��r7s�ĀU9e$��K�Y�?Ș�"4�CR�F�������Aᔋ�XjBd�����̷�@�p)���ui�����qS@ �
{��	$6
�q���P�X�����s$o�9��^�!�w�#y4*������Ԛ8pQ��Ȁ^v�R�RԷR��ˮ��®�ٰ��'E�w��J��E��n��＾�g��S_J�؟M� OCN��|*s,#P|4}O�c�<�V���6I��v�?���{��MMm*%�30��V��#��X�X��b�<Nj��ݞ��@�ƀ��T�b�,]k�R�E�5���te�|_��<M�3{��[�ޘw�<?]� =�1v����b'Sx��.Z�hel���R`��>����c�53>��Ķ��W�\��f�H�EC�4���b�ľ=��\�Yo�g���AZ� ���腇5:�sbu����,���*��w�6
� `X��lF�T|0��/i����݃�g�a���^0q�3F�A�x}����)�-3��e$5Rw�>�<�PuM
ɬ�E�el;�ጄ�4�M�4����pLJ����La��p�S���u{�s*���"�>��n2=�vc���$d��3��X��G3Z!N�e��;�R�r�݃cezA>�W<ס�
�8(�c�~(��=�#���-�!���Wo�7��J1����P=(�zҧb3&	�A�������zvA��՚�F��y�<q����U�_$���?�І�3RR&��Ʃ�
-'.�)$�0�>D$�������"	�
���k�xm�4j��@W��ix�nGo�������ɑ�x�j,"���C��(��&'ЭR9<վ�ø�R2�/u��B�Փ�Z/Y�;��/l�0-6����Q�㲶_ =q��|�x�}S������|�C��O����Z˥�5�Ϣ���8��s/t�s6t-��ͪ�-��!��| �d���>�A���'�7�7�2��p�/��
�Ǝ�뽱Ɵ�R��n�9�G��5v>����`�	��)�d�s*R���vM1����+h��T,8[����߽:f�%d�"N&R�8=��O������0+gR��z��N]�!���x뽪��	`�w���΅�u�o�En�S��O=/�Y[��tdװ?�a
6�ȢT
j�ǋ�]E@$B���!ҿ�\�g��~�8�_��J�wO)t�LES�b��#��1���v�b²+ޯ�x�	��=Ae�J�V�'"�&���w���5Ր��ctyG��>���\�I��[`P�hZ%�G�+F�x�{�Qxo�#c�2v�߄�Q���JT�7�|�1�����5��Yk�7�Dx��'}z�D���s�M5�J^w��&���&�q�����q6Ro�W��t�j��A���-E�Rg��,+n��@S9 )��M<R�B�PT��kg(y�x{E�����a��{�G:}8�N�S�DS㰺~!��pQΊ���q\��~�J�ܴ
�R���5rɃ���|o�n]�����Np�<L�y�U��#���/�詁DF����C���-q�M��&�j�X��.��'1r��S�-��$}U'���;�,ȷvRگ1�ތ�
����[@��vңz���6�V�\�y��!����S�?���!$��-62�T�/k�>Ubd�y�<����R��a�&Mt��#e<b��s��&�i�s�.^?������O��/k��ϓ5����﬽�B���;����������1vG}�Bx?�`�<��g̛
�}��@��c%�x���W��K�ʜ����S�I��~�rvO�C��G:�;��qu����h-���偞lɱ��q����!/�&��m�J��ӂ	�ì+�s��DJ����������a�af}���[��Ȯ!��~�k�?|O��\�:�{|ƣ, ���i�eL�r^�gٱ�SO�ګ��}	;7\���h0���~+��rA���m�$��l���M%%O���U�n�Hc�~�Ȼ'�g�(}�E"qp̙0 4���@~>�\,6ݳ�1�lV�.��K�rΥࠤZ�E��DI�:n�ŉX��ĻY���>���#V;07q���i��	�/V�vf9��b�
l�Z6�nK�M�u�DX��@]�(.��C��wӰ�52��PP�����c�"���/�ֶ��DH�G�{�7�Kb� ���V���H�u���F����iv{�4R
TpW3�G��+�T��/�kBkdԻ3�v�!,Kk3�MS|�P��04eYp��`�H�7�����7٢l� sx�1
��Ǫ��ZQ��]@�B��
	���ϼ��ğ��Ɗ��,f~@Y����RRXgyA#T�M���#���X�I�mٲOi�9�$@��M�I�e�7��u$�ݪ! �o$�'���i��B��i�:�����ds�VM��fLu���%x���)䵀W^���.ぐ[XGd�BP�E��-3�_�g�X�H��lO�;\x��ѡ+��w4���"�2�����&ɹå6�H?2�%6�c80�.������C0��,X,졮%�R*A%佉rQ��2������?=?+aOl�e7���֘�f���,�����x��s(u�+z\|�Jd;���d۩�4��T� ��i&ca��Ci���!Ř��W(���AU`�2^"��T�/�i�'��}��a�4���������VT�(Ԩ`�.O��@Z�XDb׈c>�};0�s��Z��k�P�}�n���^d��iqDK��`ӊ� 3�=��� ^����M�T���ˀ�y���lW��sAL��ߗ}��?%�Ŭ�%	ʫJ^��B�~��.��M}�R-\���i�l0@75ؖ��B� ˕���^y:������q& *�m^�����O��So㋸���j�����;�Uo��j�B��q<f��2��mY��.U<Klr��շ�S�W�l����g��U���YT}[=ǀ���yÂ;�Ƣ�Cs�u��3����'e,"L�vF9:"�h���:&�Y.��FF����G��U:��O�41����� 1�˦�Fۇ�琉\����^��Nt��G������7g�)��r�or ���x a.��t^���g��qp#=0ZK]�4�SK�W�w��/S�&�r�"������Ƞ�q�D��= 1�����vr���qv|�5�L�Q�����~�����E��R�F��cR��\��B6`��U��}�?��qW��Ffg�����u��<�8pd�L�lfIH:67ȷ1~B(
MEr�������d��x.�	>��5�Q��(��%�ɹ�,"9B�vf�vi�k�2 �#����<z�q�cC�珦9����v�1�75�@�5��ʼ�?+˪%��/���������roc�;P�60�xj��kT|Ne
C�py9���L��G��U�ra'�h�����rw�nm��&s�#� [�g3L�1�0H�>\x�o�l2�Y!��Ǌ�?g�!B8+$��<��Q���1�wz�m�����)�M���濪�!�~�ǈDA_ߌWQZ!vh�7�0��"v�s��pW�i<ԋ9��1�^[l{%�jj�}T�����8����-��ڤ���)�U@��Sl�١�<�X�f��j��w�ߤ��VA�n�=q;�\��P^�Y"C�� �'�	J:���i�uPa�W@��%�e�nX�A6R�h��<v��y2ߎ��Gŏr�n��Q_Pl�,�k/%,��;K�L�\�%���<�t�n���,�k@��;�اPr�� >U��83�ج;X�d���F�EuG�J~�`6ƀƍ�)��������I�ét)u�\�����6�}�D�EtM����x��6���,4�����C�U'����	Vn}�$�X�v`C��u��{�DE(��N|��\��bq��j���i��� $�x��D_�K^��X*$�r��o>�I�f��V`e�+T2�p��t���@lZ�j�\D=��-���ʍy�%7����(aq�L�Jw�Ɋp�?W���*W��`�!�'�+������#���S�(9[(�S-J�ח�t��q��1U�5}lø|���n'�4TZ���u��T}1t�n@?F�;?����e�4��8 ��
*�w����x�?���o:m�������A��3����J�� �T���hT��L�)�<��,��O���#��\Ҁ@]5�c ��Z}h5s��#���$� �?�\��ʹ���j���lg&�K���n~���e@���1n�����<{���!R<�1
w�*m8�z�$�L���zR*�#fF��K�X�I��>�M���ސ�ףfx?��ށi��2�g��S���9MD��A�[}��:�,�M�Asos��zGH�1��e��%������nc��",��K�ý�������O���s`�I�M�!!J��a�������3�.Zc��=�-�Ao���^*@�U�S��Ëq��w|�� L} ���0(;�T�ڟ؛�
��t,��$�X�R��L/��@N�Լ�'>��"^�����r@#7Mi˽��������a_Zu@OG��3N�h��	���$����Z�tOg�� Ѹne�$Tf����}L'}�S~o�D���R��ƱC��i2y���Td��[����fCe0��U2aPZ�l>�V�\��,
^��<5Sw�Mm��5�(l�Pw1-tI��1�dl5���N#��_���\���د��3�GΠ(�>�	��<e
{vs��$����M�,H�v�A���jE���g+pw�I���6`��O˥����d�EpA�����B�yO��^kۀkj�i&��A��.�*���?�ӷ��F-|6�W�Vh{��n�^�l�_"�:3w�@�{�(q�+���/,��,:a�O\é��U�@5�]G³G&��D_�ک6[cf��|&�X��0�x�B� 
K�ntU���B�����������/�3-�9���U��V��H��ÜbC��W+�^�G'�q�%����{�[۬V���f��ChdQ�=a�.yN8@S�~��.SB6|�MaR�]�S�K�c�	{���y�+�����Q�\IDhhEQ�u�<��KW]j�!�_Ӈ
޼1��k|���ۂ;������z
�![@���c��M�Ii�QB`B���:^�6�/������r6v/��^X]�_�Z��_�́��?�'���qJeIҙ!��
>$8�l%�C�F�`��̚��"�Z���9��Y��C�G!��]^�/#���*;:�6�z����쪽P��ye�Q�u
>.�����-N��Cg�*���WuYn"ģr�����}�w��A���m�$P�_���[�{����ĭL���%�B��ЬX'�h�J�`],�Ջ;�6��d
�6K���Ȭ��ΐ�h�� ���X�A���E�.J�1+�%��
n��=�_�C�� �!۵6J����~uȐ�f�X�i�q[��+��=��]�K�qL�+:	Յ<������{��K�'��!#D���rb>)M�iڿ5�Yd��J�M��ܸHR�Qf�U��1��a�Sd ��'h�UΉ�f�Z��E��z���T����\j/d���/�>� o۰��2�}�$�]���(������"(��V�+'���uݏo�=��7&Ȇ�!�`���.��؞4l�r#Z乥��|CT	��zF�������j��O�>'mW.���*a�n���f�a^vb������Q,߻��w;���K&��@QPU=�o=���`�V�)l"��1r]؅������  �`hm��?�6ꋔg�0DF}"��e]i���:�������e���DU@�r|���O�3��!�F���@*���WO��Y��P}��i����B���C��.p��9�܄S��,�6s���B�zd���;?��-�L=��}��A�����l8g���Q���ݽ4�J�H~�4Y�ٹ�Gq�d�g��z��>}�@�9�a��Y3���1H�/Ԑ�Ǹ7�Jq���|�q������'�J��`K��A�ͦ����>BW'`���X������t�ՊyP��w��w=(������W��kF��X���:�3�*������xt$͟(	cǤl��D��X��:�� �>�u���)��EQ��|��D:42��.)NlLg׍�����C ����]��6�Sjꢥ ��Qաo�4�r+�xS�Ub�5�Mc� ���	�fM�o��}�l��+7�Z��1!\�b�t�f��)� ����>7O���-%�y�~Z'�����i�{�`�TD����{|�Y�Ykt5�0]c���t��-A��v�,�/��m��vZ!���.�����c�Ru��d��F�f�v�K�fg.q��	pwva-�_�����W�rf��^q��e���Yq�~�&ן�ٳی�m��Lf��NN��sgyk�;P��W����V	Ү��`������������y��P
\o����fN�~@��5Q�~�f�T.z[���l�U��;������˧F����N?��A��U���(]Je�*hC�|q���;C#��I%"u1��l �$�o�� �j1�}EOBM�Y�8縲��Sn�O��@����P��>�f��Xt�D,[>�T��X���FG[�%+PH�]��ſ�{O��w	�K�s���;�ѵ�P�Z�
����n]�}�p)~���K�g�B+&w��r�ث\��J�M�6��_̄���:��{�	�j�HIXQ�b� ��Ni6N�|r��;�W��������=cI ��8�|Sđ�g	�QLFDL7�+�M	��O������� �^��������|�'/'�!Kt`"�0������J|��\j��VA�k�禀,���]�`�f�:�`=)�pz���@fҭD���SY��@�`#wD��P:�֒ƭq���>̜{�g.&��ǋ�鬉)�j%}��,4	9)�_Y&��N�.Y[��n�����G�B���m�3����2 �}{� y�i5.�fgvնڒ˄*�(U᭧oq7o�  ��W��Й	K��Q��$���jdX/(�w��B��c�9>m����hP��F9�&��Y��ax`����j)]�wA�ͺk�=3��i���n��Z )9���[���ɯ��4�t��fj
�>��e�jf�y��R�E����%n�{�W13�a�ːF��g�c3H�w���O�d$��Ҥ����3iV��(�t@dpd��_�"(��,U�)PlO�v�[�q�]����~{֍ˑ~����^���=�ء�:y����S���n�u�7�n f�R�䴲	o@���/�i���RG#.�:�Ͽ�bpi�� �$������<�B��GN��� +��5+���� �tļ��A�+g(=딙�	��`���L�4l�T�~���s @[mE9y7�/\z��nS����'\� e�rˈ��p�k�S�nb���)�wv_�c�"����
P2��}r^�Y#h0�0D�VXj����
�JX����[׹	�������ZXH-CϿ���NA% b�K6_�@{ױ�ͩ��]�3V/qȧV��[)S2@8��G����|�aU�9(dŝq|0x�����|K��2^K��{R��>�JP���gR��qFJ�D�܃6u��i��W�"Fng�D��ՎI2��{c�^
����P�RP_�<�85#��[���W���6�
*�Tp�BP'wO	��D��:v=�_�[����/uug�G��h��W�Aq���G��>eh��s�s�F%L΂�C���C����bX2Sg���^Nļ��8p*��1��駙�O�ㄚ�c�3��F�	��7�-Q�ޓ�Y�|"���I�]!�\L�8�Z�����d�wA*3PHZ�E�kɞ�+�����k�h��H�T�C�m2�&;0$mϛ�	�� 1_��)�ɼ�v���*�$��%�wgZ�6�C��1�q#*��W���} �>:k��=�ä_�I��O���.z���G�"�d��,`�d��u
Mgno믆n�
s��p�!��G��l���o��H�������V��0a��,�(�' 燠{�~, j�0J!$�$�
��6Zwky�e eݒ 
��{�"꞉W�ڡ^���)�7r�<	1!�h1)N�yM�U�5���v~ч��	��?��4le,F����oV-���|���H5�+�2@$ɍ(R��@ȃ���y�I:?�E����5�N�fT�L)I�ҷ���_�`+���86��\f���O�%�6�h���l_�����{՜{U�D8-��9�N0�,�]�CJ�f��`-eSΘ�u���-BX0r��d�)�)ܴT4GnzjS �R�E܄��̌8�@������ht��EdNj�����/p������L��@����8�A�$�ef����OQ� ��6�?=�h�P�Ԇ�n<�6�aV��������ab��MX �T��H.m���,��ǯ� w����|�
�ЖB �Jɒn(G�E�(/%k�}��em��ß��^I	���\���`�d�N����,nze���ݧ.�E;:�_��&]�����u'a�Su���W��$j�a��f���{��#q!�zx0>�J�#bު-���ߕ�ޔ�ʸ+v�鉢���Tx����+`M��Iʺ��EOA �~�$^<��Ӈ�}���-�<��!Ho5��Ey�{��Ҫ|�.�}j���QH�PB`���E<\�G= ��[��*6xP&H|����Բ)�4U�*E�@x��#���%�+k=�b+cj���������{[�+���z���~ǿW��bī��%��;��� P����A�� �8%?F����Z���gX=^}l��N)�qgC��%����%)ӭ�M�H,��\a	��?���9v��z.dehj�2~se���|NQ�w��sH0� ��{�c�-�f����nJsz�Cs+������z�I)�>�����jck'�,�L�*��ңi�t�{� v��W�xZ%<l	�cf��wAR�z��3��/{4��8��ʪ?�D�P�	�)hh�8M��DZs����=sVS9m��xi)\�Fj%�H��6���W�v��m[���g&�C\*���W:X�ۭ�u@�
�N��CR�Aٝoڷ��Z��D�ѻsGO0rrJH��'R�t��"��8>�j���C�UM�v��Q�`�V�Ō�hF��a��F�&��K]��C��q8���Ʋ{��m��?9�ЇHh/��I*Z.�V`E���}ދ�,�|d#�ϤAW������5�[��꺏?lf��=>�@��vM7���UL����?�B).F9��p�L{"��3"��ԿF���A�`i*��U-"3&���&)7M��Z�/��s�V���}�x:�x��-g[� x����&��Z���lٔ6�h��s�}W�{���ـeCB���z���@��_IY�����KgG�ɝ��� ��e��$�+�QK����'�a�C&6A���<e�O���ry�|w��7�N�W���*3��<��l����NB����Nz(�L=����nɃG��
��!Ky7�W�O.�KPJ�h�K��dj�!qDk�Y�������zY��Goڛr�����Ɗ_�8*.�:���< B��/8��fR�#J�7��q-c��z+\�Xjd����)��:*���vH� "fb�����B~����4ؔ��F�7F�����]!�7����T5[]�ꎑT;�7��W��7?n,�C*]k�/�y�KD�[���e]s��J�mW�ؔH�]�4[��Y��Q�F����p���y�z������+��Fu��Sr��)�ȩ\�bx��-�@Z���x�l�f�`B\in�L}����[V����׉9���<�)�lIj|7�A9�\�"
���B�ַdI������J{���X\<'(�F"%�d��N>��N���o\9J�'����x��+����E�aUuZ�`K�	�$���H�u����p��VAk�������h��@@���w3�����W?�6�����c�RALr;,A�����v��I��G��V�2�MQc=Y����=��rHi帎�m��'sBκ�Y�+�U���7�Vݴsz�����J�����]~P��G�1ٖ��s���,k̹���_Ә<�"G���0�����bҌb0�/p�^I�� e��VȐY�e�X�x8m�e᪉n����˳K2an���^َ��=�BS?�	2��o��М�"6���a U5�|M���I�"�f�,�r�]���H�3�w�ڟ��
Kr��X,��c7%p��x���7"���;���6�MDr=��~@~?>��EN��
�J�a��Z38Vk�2���G�P��qR(�HCK�@̒(�|����Tv���0B�*��I�<��gJ�]���b���3w�p�TG�%YP�G�ȭ���b0�����l���������a��l/p�	��1�ߞu�F�>�v��w�9�4T�8��s�њ�v��9����b;5St\x�R���4]]���n��.��6�-,F��+(d�W@eR�H���j4�,�e,Qp����������p��C�R尼���v[���f��>=�h�J�c��kLQvl�R��|�v(�ʴe4���`~�ߥ�o�0du��c.�]�B	��*5ߦV�*�*��2	��]L�"B�ȟ]h�6���[��9?���9��H�u4��9׌$=�@�=��q84r�)7�_w.�lͯ+�����F��EZ� z��Է��ͭ
"���>ҟ���nt1�s��m,��c+}'�h�\?DC�,�f���'�¨B����} ��]?�}&EP&ؚ�t�E�4b�5 �u5��ۚ�y�y��?�k�nU�1_�&e��;��hA���������J�mb�]Ҧ�]���/����X�\.o�-ܞ�{e��oEpp�Qkb�e`�K���m�:sҵs<��/��3Lqr��l�pma#>hϼ�����w�h%��xY�]�ш{��wy���I�A?yj<&�ձk�$_��\O��a��1�o(�
0�(&y�i��â�D�2h�}�=��A֗�3m�K�K�5A���m��r�.B%��h��R��*�)�m��a��`Q �k�M�X*�}!�
�'��J".D�Y3wJϙ�����3\w�����겁T˵��!�i�"�
&�A0#F����vp�-K�i1ƘA���3�/�V�1���U����d��/Nm�����t+����Q/5j��:Y�㜞�=�#�G���*Γ>�pE�T�B��^�|m��^��C�� �\Z���A��id�o�:6�JG:�+�������5|j1�X�W�v{FJ��|�����ַ��à��j,��I�{ܥ���TN�2b���|�4W��A��ZQ���U���]
d�O�/LðP����nY_M�
��o�|k�t]}���-Tg_��:����7�e/Y*�X�xH6<u���=���F�aM�/'�V4V>wcXe
۹-L������U�3N�Q�;��o0��dO"?ͻH�Q�B�L�oW9 ����6�oK�npR�$�z6��f�B����Ԛ����=
D3%��5��p/C����Ҭ/���~x9����oI`����hj���*�j��CB^%�	��\�NA��;��L^�Ԁp�$�͆�H�h�҇�d ���� ܹQ8;�xm����R�"�'B��z��hFל�X� �/����������,�0;3zʋdƥu����
E�X��M�=C#&��s�J��/� �/����qܩW.Ե��<�\��O�"e��Fe�7�KS���P<ׅV��?���Q�����<�P������ �8
k�2�������l��&��0͏7�}v��O6⥐^�u�I��z��7�(�iL-�kW�I*i�*{�Q����x�� �]���Hj�D�br���`��,�+��M=��;!빱9T3��eP|�����C�&Okc�3F�V�}S����O�O{�ʟ������4�hF�Z�)�r��̟X�O���@Ơ��)��IQ���_T��KTr�����D+�k��?A�������|k��\�*51���i�LM������I��SL��NG8=O�>|N�`�]�w�kmV�R�	�<��a1�S��LD�T��L�E��s��]�a�^�H�'s��<��H"=u\��=��qs�fv����,��P@��1�1��m#�Y����y̓ݽv�є��4��n=����(nf�<�M��yNGX��!&��cF>yT�c�����/���4�E�6S٥Ӯ����T��Z*~��DQ�,yʯ�e*�]�0
����;ε��&�˴���6pZ��כ�Y���G���I��C�0�].�alq�P����s%�(Y��u���+I�Z��uA��aE�Q>��+�s��~M��O�lSOR=�k7���m���O�$�T��Z����(���",���{����R���j����׈hL��
�0���} Ś�W�8
rV�Pi�L��ˎX>� �w�5�Ѷ��膁)@7��K,¾��1L�[`0ٶj�@�$!i���|*w�*c ��8w����Bӳ:�~k��I�t{ ��F��i_���n�A�z�]�=�^sV��ž�()���d�\*!�<�*�т<�l���5T�d����L��_������6^����q/~�������6��G1�>3���|��*�X��і4��!�>����D�f���~�S|�<�pg���G��.Zu��!��Xt�¸E�vC�J�~��!_��v#���5�2 o��U?�'��2�,2�d�ߵ��uu�|������\Z�6��T�	=�9�e!�J}S����6�.8�϶64�Yl�_~*�R�7]����b����5��Ʀ�����7��5�[����mr�:���Zf��8�%���o��<�}�xtF�M�	m9�IA������rE��&�����<دC���5�.p��'�S?�='
A6f����ӕ�C���:P"��ܜd'��_�{<EGt������
'�"��u*+ãsB
/�|	8�k�)(v\`�#��r�����:��_�"�dh���y���z���|]����t�'hU���e���u�\DKw7ygO�	�e1� =�d��$X��5���Āe�(o�d)`P�B��y&��j��v�Wk��5g���ҟ�m�")�q�}�\ܾ\�H�2�W����2!��E����y��E�ӏ�mS8�J��nJr��S/�u%u�������� ��F��X߰v~���H���q"O}�HU7u�)��c1�x�Ao}ChNv.)R�/b���rK��:B^�R��Ļѳ���8�I~��fCԝ�Z�u5��d��	��ߖ\�l�0���
��w�ߌ�ّ��W���v@1p@"H��=�*
.���1�a�����4� ֵ(ˢ�s`���#��o�cR?����Ͷ����&5E�,y�/�,�fD�17�A/�S�!���ޤ�3�3c6f�Բ�.G-8��K���d�^A�ɪ/�I'�o��wi��w�`DAS�ՏY=z�����:���)�y�E�z�`��S�-5j�**5��qIx��A� k����"\��B��x�<͵��0v^ٸv�ǆ�0:.�Y�z�]��f����S��i{؋�V��i��
*��.TH�i�r?��<�zu��刻����3}�PhN�<I�Vٳ+D�-�T
�@'b�rL�i�������}-%9|�rJ��?x5x2�vc���5���8�@"��#������z�)'v )�qm{��ҙ����W�R_��&�SZ���J�>�{T)HEZ����ߏ~$R����r75�v�ѓ��������h��pP;�"�3QgvG�?�w�	�lȽ���2�)��7�@)��"��&>d�����M��/�υ0�Y�+���ծm���6n�u���#��ϱc'k+g����[s�~g�:�R_�=�l�e�w��ʓ�cG��29����I�*��,@�k�=�=.�B�h\�m�_yܛ�4����W�0�J-�h`��r��t�M%��q�r��N9�&�C��ʺK����� �)G~ϓ��!��C"�2ʝB��o����sB~��������T�d�T��-���%ƿ,�����0譒�ˮ_�[iBs}�����M��x�Z��k��_) ��8dmX	;�%�!^��-���Ez~� ����Q>v���<�Ǟ��s��|/چ]��(�*�$��1}-di��.j�:B��Ȃ~�p�PP���~�aQ�p��_�U��t����y9%n����Q�ë�=���$��E�����҆��+F��þ��|
틗I1�x�t&���-D<���V�R��Q�??��W���CS�q���h�I�ɗ0���*!X��^�8�H�BU47�$���9zs���� �$���b ��)S�`D�f�K���� M��a��(ֳ�ccq����`���ѓZ@e3Un��6A�|(��|mγ�}DdT�M۷(A�l�j4�[2�|C%$ j����P�ϡ����m
%]���1\GȎ��kaHC)���E�����LDo����	`Qt���ic�|ha�j������u53�m�E/n�O��w��Y�)�A �i�q2���%#/���k�"���C�I !��߻��t��;OrI���X�}�S��^�#��}EL�}4��+z�iP��
�_hN pG�O�������l�S���ͣ���ŏ�ծ�$uqd��[�̤������(��8[�~)@��O�a��W_e�����m="0��\�HE�d��3̐^��3�|%&`%���Q�C�&/u��O��:��&E�z_۟@�]�-�	@������>� tǿ�É�����Q����ץ�Z�֒�����ۼ�P+����2�����י�Qm���6v!e�=�y�݅���w�Pm9SHP!�B=�#�A�6��6�WϤr����w�OA�|l�X��(�dZ�r��[Y���$�3���'Y�Ù����2C�P��H�'-1v�H)?0.}L��Foyͣ�F�k��/�lR�Wx�{�Y����QY����aN��æ���?.����!��u���E�w|��g�OF���`?�;��+6�/�3;db�i���K[��:s4W��ۦjC �~0��&F9��[:���;ȯ�.D_�?f��ei|N���bY[���F�|��`v��$\r3��B��V	F�Ϗq̣8�@����Ƒ�����W��|�k�V8��s���5�ƪ	�瀏Z�p�$~ZdKϼQ������:����3@v ����j�N}�ȣ����͗-�>"�����;%#���� LJ���T������e���u�1��R�m��s��u���Wʟm��U�AU�Η��G{�Bo��ۡ�S%F�Q$���d<�R�R��)�]=�^�kkB��X�؁�����Voox���%_/�9�!���h3\]f0~���� �I6˙���Rm}�z<2_&`͜>� �X�=p�d����L1�f��p��w�$����`���cl{FSk��	픉܇5��:�m���6ieTP�� ~�a����	��"=-h�JY�TiuS�@�m<�4�;A��V�-(:&��+ݔ��&�v␄i	o:�P�׍�Qc��3ቔ�/q�9s���J8a4D �j_�Jru�K��7|��'
��m���Uqk��Aq��οM,("]�7�uȓ.*�R�궦�+�L�\.��z��m(`������vg�Oh@I���Q����=h��F�bdmYȡ�� Z�Q2�w vDh�)�e�q�#I�`^��#!�a;J�	s�qp �͞4Y+��+h����[2�����H�����MW�U�6_�`�D� Q	�=�~��3���0��>�$t�����j�C3�(�R1W �dV#���ò��4��0��^�6�8�I��9��^�ͯ���{ <����99<E��c�y��C��dy��xN!� ���}���}��a�=aIVQ��cb:�����2� ������a���Da�Dm��|ⷬ�7b�&�ʪCCq�]IY���i�t��.8��{���MNR�n �9���pG� ����<�bP鹿v�Y���-%���Ys�y���"dWҕc�MGsP��A]�F�&&�g��F:�'yDJ��h�]���e�rS���i�--!�?�

)�X�e-(���� q-�����e; ��1[kɑP��_[��w�I���@�)C=�	N-g���*�쐐A�9���`�b�$����臥���{�֩*�N�U�&g��=�PCD�*~OY�;���Q0w��B��,�ɽ7h>fV�	��s>��2  ��T���<�"%�4Z*0?�hH�ܳMժO�B�(��s%A���4U�焽=��\����/���irJ��̇�2/M��7�"M08b2��/H=��@�J���B��`4�h��<�e �'����o����6X�[�yp����C|�4��ܻ:��i *�Q�P��I�������pӭ���A�.�!o���zŬJ�P嫢-�1�A(K�Lpc�v�K�3+.����(pj��3E��q���d��S��]C�`����V��]7��Q5�U��@��P2���̱0U���?꽟�����p�Ǡ3���䩎�e7�ޔ��}��S�X����������ښ�uKG�V�|�J(�˳l��ή�Z��o�p����p�4�6x`��hA��2�Ed�F�6��<u褠/� ʝ;���_�7~-��G�e襅������(�R<#G�ON���
W��#xs��I]����{��w�;w���>8�V�hVO�L+��?n*�/�`��VP��n�9�I�����h׌3(��ȑ���w�UZ��ۇ��uvߚ�\J�B�flEV�����=���C0}�[$є���r�u��D���K	pE���ī�(\D��Rly)Nd�.f������~��;�Y+˲�2\Q� ���-N���,�u��|s�.�B+�Tt�<,��>e+���Lu�����q,��L欈�⹓�t�^��[����&4֗��y��F�*�}�ᱺ��O�/�Ѣ7�CW%����O��!���?=ނ+�Ml�Dχn$!M�Ux�t�����1&��z/H�������&�TH0��m��mP��g"/-����\O0���ӆ$)z�oRL�)��U�T��Q��))x�8>=a_�\����g1�*�Q;�S��_�/�U���0\<6/��G�E�^���^�#%���6�~У�2��R�b)%����/{c��`����\�*�c=��[�R�Q��'xd ��֢��������4�tu��p�f���n	L=�!Q���F����cS+���[{y�[��䘢�D-�S=eْ^�1�P&�^��2�c�\I~[��Mf�~(,l��>��.���Zu,�?kO��ʼ��Z	}xW�w�<@��LT̪}�L#��h�d�$��.���\��Y���f���M��;5,H�z��[9Z��{%.&�����к��!�Y>S�'����I: ��N��uK��A��|jＲpV���X�7~���@hݯtK>J0B�^�������z�w��gq�4\[	�L�nQ��z�������|\k�����3��vAy�&yQ���p8���@�H�4���y1��}��;M�xj$������&y�j����;���V;�>�`��-���Bko/��jt�M{ONF���w$�ۼ��·��r$'�.ڗx�Yg�nS�E�����"{��_�a��&p����!�%ْ����h�}�e�ƥ8ٵ�TŞ�5B��t���GhA�����Ow����X��:1�:�Y�&�L�*(�6.�y}���[�τX��U�nV�7O�X�J���=��w���T-C�w�i�x]���T��j�� ��fL�bƢ�h��e0T5���oV�5��m)B��]y��E���О��굈�$ц�J�l`�s:�{���A0�ՀbP'�,|�O���H���r,}!���[�\�!�펀D�ԋ�q�ۆ�_�p9�^��6�U9ހk�j�F����U�%	K\��:=4,]"����=�Ѯ��i�&)Y+��􈪧�*i)�u�	�B�:�;�՝#��]V���N�?�`�_�T;<-@��]�b��0����~��k�Ћ�����[0c�L#x;�T���o��3�}��uG�:��ς�^$Z|�qw��LrdP��ls�;e~lx��AZ]+=sJŭ|�c=:������w�v��x�BT^*�zw��;�"�,���n.5?41��l[~�݌��P0�lz��k'���{�1␔HX-����x[����,��_i�s*rJ���OnR�l^���u��Lj�_�.�	��⎒�R¿��Pӑ�H����u
Eρ�n�4;���=>kkt)�U�*ެ�佘B�EW���K+,v�<`������!E��&z�c�@@1��$����&�����O��wH�,���X��42OE�r�N�,��ѩ`��ʹ�Z�~w r`�/�a[ ��ƟY�����1(���^3_�R���kW��U�'6?�k��$��ܾ!I1�d��a5��ŚQO�иg�/�ٖ��LG���q�^a�?�����KEV�t��\6'm�o�f�`?9Z�����#������^m  ���Q�p���C��5 ��B���`;#zE���n�d��jS�l�9�yO)�[�9�S��D��N�&jpzas��A�dJ|��	�֤"�1�<
����ↁ�>	g����H �
!����ɼ�/~�^��)�7���HCQلt��|F/n��$��D�P�dL����"n��5���+����7��ȓ��@]�~���p��	�Z��$&!���>o�{��=������[��:������)�&V��O���Qm��c�|�R��a�����D�(%��nl>"S�w�%����3��=7L��*~���ߍ��d��y�ŞH��E�7*�.d�D�l^Pqp`#�o��]�]φ��Ǝ�;�[�׽����dϦ[t���P����55$�� 6
�?;��&/>�<k��LB�	Z�5_>j�W!��TXt6���:�}*���J��/8s��i⍔L�ZiI��o���ߓA���69���*�U���H*<��ICQ�\cR���*h8GF/���"l���c�d�n��+��l�Y�!쐐�H����z�&���3~;pN����ܧUK��/u.��]�y�8����4&�]��a70"���H�y�S������1��ݦ��!CS������J�>ۏ(�7�5�<������P�1B�O��&a�~e!GX�oAR+ϩ ���Dh�S�x��:T�9�&��԰10���T�ߋ�C�Oqw����(A���,���k񎑹G�7a�����|���k�f�������ܒ�bk�\��+��.8=�E|ˉ�(2���̰���=�5�1�I��%y�(ɀ���ć�]�\>xuQ�+���+-��h_�"���lc�M���XUC%��Ky��#�ZPr-�-�Z����% d�ߊ�`f�T���_�c*�_XZ=]�rz�Th���t���d���3.�2��l� _�(O��Z,�u�#�vTnA󴷀m|��7��-v��ge37/gk-?L
���Zr�Hku0�z;p��w�Ynx��H��H��mtP���Q�)lTS&��a�ӧl39�W��E�� �cY�@�ڂ���P���WV2e*����R�NJ;Z$��y��G	�5�irt�m�qT �!�� �k)�Ǵ���°�ȝ}�5C�=5aog�(/3��}{:�g��E� ����'{���eU!�a���~�9:��M�7)1�n�SGE�O�P��PQ�69��5dvl�B���&�Uh�To��2�h�r֐��?�H�m@|-�eӥ�:x趐�=ZD4���P6���F?��y��M
O�����6	�W�B�MEN����,�#X��p��Q�+u���b[fں�^������8-(�:�ms�'^_�*ܿ=k���d	�mSs� �jp"%��Y�b�0.�r��ϼ��J�]��N��f��e8�Ď��퍗�[F���ĉww�����[��q������&����@��	�Ǔ�c%�����ó� ��R�s��=��;~��gn�d�$K�9��?���RL-"�6PU���4�Nq:D�(���4�V����b5�v��c��J	!����s�U9Z�'�����m_)T�ި�*�[�=\����g�d�ٞ7L�RUT�����66 �R�.����S=�.D
�ǏR������j[�Dn�R����Uk�)e�>ay_+JK����u���K~��1� ��I�?���`�U���e���mp��ϣ^C�s4������b�\��<����%������k?Uɺ��5�Ȱ}��uS��\����]�OIz~�H��r<�ŭ�V�5�>�N�}"�E�ܐ��X�����^kՈNsn�`���F1�1�Xkϑ��-�hHB%���, ��yW ���q�|S���y�����\Ue�F5���q�jyv��9qG�*2��#ǰǭ�C��a*�PU��K�%��)O6�ՂIF%ϡ��WM!�+i-�}����䴅[��Ʒ�7��S����o��]�]q]�*����n	�
������'U�]ȬV��4È�^ު�M��>�|�N�`��ug�i��Vt9�;)yhg�)�+>�Fm_ Ma���)�̴j�뎻'��l��YKyD�)7�&��	w*ƶ���-R��NG+�R'aQ��&F����5ɐ�����İu�w�4�3�S�u����>))̯Ω�f5�l���Z͸х'�־���2.R��c�՚Mb�v��Ԑ����-�`��Ģ����v�Zg򜴐P���p���8�\&�%��-������X�j��H��@w<��H�
�śW,kd*6��A~�5!����8��rY@��E�s��7w��Q�������0�h����J�Y���A����n��Xk^>CQ	,�5;��d' ?�"�}0m�ܚ��K�e��U���T��1�;���*��j�r��lHe(��6V2�-�C�}�2���K��A��+A���Tp����)-K�6����<�mFP79�j��|-.�	��;�,R�ZPW��o�Ƒ2~Sr���W�x.� �p���>�#�pDxK=j'^ܥ������e2�|T���P ��)�ԌٷL�پ�F�J�$�Z��:�J���Q>U4G�R�H��V�#���g��h�T�|�U�v
�D�Ĵ�Rz�|I2u����ABR��A�(eIp�'��؅Y��i���`aH[�D��_~�ӭ����[�[Z�r�[�FF_eN2>'a��qH�>�����lL94�s�$#r�"���ΰQwǅ-~e����r�7���E��q"��ɡ	�׹$ADY6�������*�>V��7X�ϟ����HuB׸ܾśo���/�(2���&.���{�L[.�hc	y��n�vG���� �v����WA?�=�pM,@�����y��1�-y��4/f���;�k;����OQ��\ލ8�׿4ѱz/)�5�����@��LK�?.�(593n>�Q&��>ml�؇�d�����u�!m��;��.#�����R�b 3�m�gc���� Z;b���mZa�93FPq�u���:��[k�������4��6[yMS��O��U)E��p{:�!(h���^a��.��Z��L�YZ��9�L�����+H�V����O{^0�V����N��EB*R��zN4Ê�@�U����۸B��ڒ�o!
_�c-v-8��!����z+J,�A(�S	�âx[׎�# J6U}��MpH��#��qb�K�����YH�B���|�4���y8(@?����t�	�j�eD�X��'��e�8>��ݩE'�X�)��I�&��Wը���<_�n]d�!9-�+B���d�t>��Lh�d�΃c@���J~tG������׵߻L2%GP��J+���a�S_�c� ]pl��f���N1�`�j���UT^g��^��a4<H
� /���%0��M����ie��ȁ)o����6�':��{��Y;��L�Hfi�²b,�m��k���:�6q�n7�q�,����B���-�A�ƙ�c��!.{g�ճV��[Bk�����ɢ��1�� ��a�%�����'�@����/g�P ���P�W[�n`�p[�בG���i�.�A4�+��^�8<G�����:�����E{-tb�o��)�.ǀ�>��z��u�p�4BZ����M|f�^�5�1�d�u�߽y��1��V/UG����&=�n��3�����nb���g^�%K�G�k\��7�L1Vy�������=V�h�1<���5�7�-�osF��\[��ׁ�&e-F2Q�kT�4����6�a��Q��1��"}��O5eF�_&Kqҏ�rX41��P�^��a�����q�ؕ�x�>v�a��+?��0�N�(��� U���߽�ْ(rQ�T��Gx�qr?��9�Z���1�K&a�p�I��E@�bǯEJ@_��B/Ψ:Y�~�a�f*	�S��N_���B��M��wv��e����k�^%?E�E����7]z���N��]�Lo�|��º���A�P�BRSn�������׬EA�Sp��#�\�m�������uBk Y�����h9"Q�3�~ ���qx0�<���z+`�{�yl�K�#w�4|&(�E�dӧ�(QeJ�Y@#&�=
���p���K�=y��KT���_^l�Ǆ�����L�Թ�ť_Ն
G���ow�gC�x��}���T%�՞팋��i��T���X�կ8�z?�pwA��=����^\�����k��	$��g�٥H�'S�,_�^Xk֊[�r!H�m#2yj��K-^�Nd�@��M1�����?Y�O�f��Vp�׌����UW
������Z��̬M�_��Y��ԛ�B�~g���1�s��t�K8�Z�_���g�Zq�
b �����0x�����WT�V~�cY�X���ءK?��!4,�����Q$*l3϶2PY�w���1xM�ɰ�Y�����`�Tㆰ,���
��Ȇ���M��C�2��Y�h�qZ] ���8��	ңP�7�Nf�JdE��^(�a3ѷו]#w.�2URi|�3��+M������MaB���:ߊC�·��R�4�֯�h�d'�&��|Wз��o��W0�(��<�ǰs�4UͽP�:�=�^Y0a"�ߍ,�����}��$�T_-3�O4�k�@�~���B�46��.���{1?n��\���{��7�����p~��4�c����I�n� ��'��<��-9���l)s���;��S�Y^̏�|�
������ï��9Ļ �x`xe����H9�z�0�uX�מH��ϏLi,q�.U��7X,_���G�	:7��δ�@�S��x�Q�W��J؀�\G3H*�N[���j2��7x'�݂o�ѱ��f�T���~T`�b(�#���&�2����K	�����Z��J�f^�a0ľ^h�u���#���&���{H��(��Aۏr�i��5m����x�l?�ڕ���=�F�\�#�����8���0K3�6t�U(���I��C��y���LUnc�z{Mg�
ګ��
7�Mr�Vٹ[䧇�O�C�5<��w-�3Ӣ�����T��qx�~��-�	[��m��ݙ��_�*2��Y��&cW3�ۇ�SIj;����UC�
�Y·�H�Y��7.[�B�Q��L�B�� r���?�$]J�*}��
��/}谺��l�د��(ֻ�gy�i��R�Na�7H0 ����
#s���Tf�R#f!�̌DZ)s�9�+�f���$�.��1t�5���m�/=��r�-72�[�g�L]CX�s�Rf`87�8����*�]+m'�@N��M�i��k���F�YG����;������b�F?����؏��b�[
0�z��r�z�-P�������V�q*)B���X�ƦR�3y:jG:��F=�0�'�YHPR���\.�d����I�k�:���>�ۿ���}f��4��ޭ�A�b�*}�n!r���p�{�p��4�\p��lg�6�cm��5:�|L�Eo�t�-�җ�$L��x�0���7W>���e�s��ێ�X���K�R�u]��_I3pY�	+��䓏��+�G��~_��U!��>Ј	��e����U��+�� ��픖��ť� �Nw�g�\��H��3ebG=�R�a���At4����c��)p�G�  ��,�->_g������S�� 4�����z�`�S;8W���D/���:����h��+%Dq=��[�|<�Ybq)7>�,�Sݸy�Y偍b�D�N3g��t����)}c�o"���ք|ȼ�k�+3ֹ?���u�F
s�y�7bA��*�\�iK���4^�9��c�2 �Ȣ���I�<>{�$�A�������|���%0�Un�8n�9p��Gy���W<HE#b�T=�c�描] ���!6,�� 7^q�S�p�Z��X	�`��dH�q}�o,r����*h�R��V;*�ܰp6�F�$�n�Hz��qu���V�lk\jISX����p�▎�q�/m���{m4�j�{�Z Y�H�ތ�bh��|�>�^TV6~���e�~S�KL��-�`a�_�Cksk3T_ �ej�0��qp!=�$����6����lLi���yy�fp�*IҴ(�ײ=�,ܐL��`��l���"�Eӷ�D�F�\b7&1���7��V�Wp�Q�b5��1Ϧ1�HM��m�������$�E�z�t�7Ej��ᏬQJX��X$������1�4JQ	61AQfް�쭓��J_���,�k�Ύ����ꣲJ���uG�&��J�p�&Zz�7�b*�f.��5�^���jb싔��8��\\���|*|EZk�X�B����6$eYL�礵:����s"��2�|�W`����!n`xf2
�J������K�P{���y�ְ��l���x�i{�$��r"�Z%�r�uՠsU���9��M��#��=ܯ&�O�����*�>O�ﾬ�+pB�}��=����z���/Bs��Wl}*���_DO�
|�"�C�\����Qf�ΤA"��]g��l�4k7�l�*�Y9S�i��n0�t���d�B�n���F�H#����x����%C�|6O�8Yr�Ht|n�k�$
i�ckK�#,5��Ž�LsV��ٮ�9U:Y��R��d,�덛�.�s4��1��솇 Y�}�3�/8m�����5�J9¬�+�� ���F�;%V�*u��B�>��S�]3�h������,JS�	S����x S� h#�&kC��#䁌�ev�v��-���-'t�!���܀��$�MKK<w轘���,��P:�'�
��V$���:�VY`2�w-=l��u��ު��R�J�����$` ��8�/�����:Y�#���h���U��?�X�����b�]�>��/�/�Sn�(7����!"zPl�ci��1(?��3�* �BҒ�8Wg���!�њ���p�c�2:D�c��>t�|��CKck���m�qg�QEv`� (�n���e���2O�8���N÷��д�U&t7+�����I�������0g�'��$�+���83���A�J�}T����d�*��j��"��5�j� Ô.k�X�A�⽖��ܳStS?;��|[`.��~ڢ�ʎM[\u�o����|
�=dEh8�0S)%��^�8�0�g�0�q�����FK%Y��nߨ�A<�J�?��&���鴉�Ns��h�����X3���K>�Ӓ�;~"���^���$$o������J}�}#z52�5���t����b_���m�ZU���U��5��h�2ҡ��%�����S���35]��qG�r��(��3ŵr ,�;P�^bl��&�	�~n��{����e������X�O�X��V�{V�P���&?�N���D�"-ɔ/?|��w��c\@fI���x��=.!+�4�� :r4	�,�� {uV&�ތ�Glu�j������ܒ47���V�J��zZ���TJ�f"ɣ���0l�������pG���~�1�F��?D�b��w�%J�Q*%��Q/C߰��*^\eKZ����Br��8x��N��A��Ѽ�V�Nb�(�A�J�d�ai���(w���&�N��9}#P�^��@g�Z�ua`��W��'���
��{�G�.�ts^�;vb���0�D��2b�@be�0@#F���`�9�{=L�O������e|M�"e�S:W��=�k��'�_�p��f�E2��f�g��-�xqDl��b��*�� �]�+�W)�lI2�l(�;ƽd=9�;�چW#�C�t�q::�)¿�i��fXq^{s�f����%�'�S����]#/��)!�1EV"S�C�m�Ȭa'-3� ԯu	�ۛSv�4�rj�y� �`�]�:U�V%|�w��`ua�+r�
0�[���	���B |,��?!<S�7^�{]����E�si6r(E�h�����.U�
�����8�G[�wW��`g� �V��q�*����H��b:?��Ԯ�΄3��H�L�w�ɯmgY�(���/N�&���FOu���v"�3%�����\!�pv��Ľ�\�J�pHyS��=f����J���WWgx}F�ykx"�8�����3S�!t��>i��:�"�?k�ye�Aw��,�{�sd2��jo�����b�c�ڑ;p{���gK��i�i*]��s� ���?�3����B��C�S]Pr����P����1�m����X*�׫	#���ׇd�i�I�J�w�^0�Q<�M6��n7_���"R9��V�A�D�={�
��Q� �1�R�x�ɳ-t�g�v��:[I��ܖ�p,JS�Pu���>�
������F�y-�l2`��HC���0��?�&��B�*Q�Vϧ=v���NZ��j���5��.h�Wd�x���	q��Qb�4iU�ؗB��R�O���ra;��Ea����"zep̿Yus��>�)�$�g�HU	�6|#�8���H�` �@@� ��Z|����=�`�8DrW�U:��h�U�E̦�~�fЍ&��z6��k�yJ<��4�˾�h���$T����i�d�#3܅;��:f�L��gCxa���JR����λ]��!��r��y��#7N�������5 *���܎Ik���D����Л�<(6'�NB�[�n���H��*��/�تs� �q��K�����DK��H�HՊQ��1�>4ՋE�W���N��F�M�<H7{��5�գ�����<a����!C��i�#�mhf:�7�awI�k���:�b�Ci~6���	��&�:��'L���K�8��`}OK�5��'��L��j ;�]��$�wW(Vr�#�q��9���{�X���������H��$��*���m����,�o�A�?�[�	#�1�V�6=~��J���cf�Dk�fpH�*ð������w���G�cd�����w!Ӭ!� � o*piK'k�q�C.&X�B����_��+�Y��4��L�K	�	���	i�H%�\-<dWǍT�g��b!��A"V���{yį������B�-���G�0���]Pg>8�(��A��<�9�� �$d�4�R5��D8�:����~!��>k�X_�a�{n�����g�;1��Kk#��::�+���Z$w�Lǳr�Rl�ꍁ��q�[&7��C���b�~(� cf{au�_�L��k4E��K.^�� {Z}&��,�S�2�P�0&��k{��\��^Xu��ĄF�?��T*�gxf�� ����!��M�R�z�� gf�����ԟ��T��M�F�����,��N��d�pu74����L��@t�,�x��tf��7���/����X+��QoPF<����#��D&@�5��Y��g}�O���˪��ㆻ���˅���]z'���	���m)�Gn�*&��&��S��'1�%�0 �҇���.�g�iU�:��kA�C��t�n������j7�b<�/]��;����lm�N�+�pZY�?����O����?ٌ.�c���s[lr� ��4�2�S����P�O#Fs㿜�Z6���-�Z��EV�+��|꡵����>�I^��%irKD��o�l�z'���[���R�%�\󸬉�(��z-Z��v*�o��D� �Y���)'N(��)ox��Lvx�q��&i{K9���\�m?���+���E� ��#�7|�xh~N����B��^�
�#��aɿ��ΐ�]��9�������@��$Y�ԇ�w���;��z���];���é/���f8a�*c���������a��b���J�1���v�+��3�;���(DW�\B�7�����ŞV�&��	��j�@������{����(�� �˔��A/����Tc�G��4e΍�*���FԮ�g�*0ꅿ̌�u3�m�z�|y�ǯ�xd*��#ª�u�yM��*�E���E��G5z]��?�J��pf��J�P�Ê2���/�s���ɬ��U'"��f5��&��Z���)&��]��m�à���������p�6�Z �B�r��;����t������g`��V�×%?���$Sٟ!�'�"�L�OW�hGRyʱ�+�� ͩ�W8�{U��BgЎ$~����a����"!Z���yr��4U,t>Yp���Ed��Z�&;#��B���M�^-�/G�N&_c�9���I���2UH��YM7�(�v���Q��$< �����=I��~��$=C�g�ׇ������_Դȋ�V�1N�)���*����V֦�5s��?B��^e����P��iYtK��񷨪�1(I���^Tj��Jv���G�d��o�ݸ���H(Y"���r�tI��K����d��\/|������Z�"�@��H��h��:Ե��)[IP�Ұt|�%� �1k��dL'g:ȋ\���*Ϙ:B�T�IǍ�lF\;�GC�(?Lپe�:�U�*�&�Z~��a���)�K�����Q����=Q��k���v՚Cg�5>³c��E6�|��	[�������^�͝��������q�Ȑ��u�n�����"�C��--V��gH6>ĦޔT��p���E�k:%W�C׆��*�.��k=��Կd�F*���^?83�U�w4A߀�96"����w��h�Z�!oD�2�BkD=�:����h�<��h�h������%Cbk9m�+�A��Ո��*O#G-�ĳ���nf/�u��"G���#��la����Y�|,����S��_�K��!e7ҥy�`N�!Y�D)���"�s0�J5�>L�	��>hXг�3��1�< 4��H���P�)���f�����j������?e>B�D��D^mr��.;�ɧ�֫�?�Č�����n�N#���KZr�=�����C/�y��g���g���ث���dMV�eP|�_��"
@_I�wȉ�r3j��ն�5��ԖE��Y0����b��'��4�B F�@��7O��~��/x����A����B�(���IYᗣ��ߒ��3��cN�9`@��;���1�͢eF\�v�Xw�ɸ�	fC��	7gn�}���f��:GA��N}O���)�=����v��CG���jG��"���X�v�}&��a$����P��~O�K�XC�W�r�h��lWN7��a�	ѵ ���k��Ap^��&���M-��iId"=�6ۡ=��V��	=_UL�Dڠa{�V��ö`s�(��6�p�&»Ȏ�7J	Z�����_#a�H��N�F��F��H� �ɬB"���33G�$�~�����ѓ
Lbq��� ˜�@]�F��%λE����8��%Ĕr�/:O������w��R�ҍN	0(�",x�b&I�>x�#�Ϙ�r� ^�}^�ybD����� &���
����t�S�̚ރs�>�7ՔP%��Z��t1�2|�m*Fe�ƝR����� ��.e���]�����ޡ�[bާ`�G g�ey��w�8�tU��Mz��f����TG���G��=|�8Z�V��'i1by<�!�u5�vR��Gܧ/jv
]�߿� d��DYZ+������T�+���7���/7�M�n�B��.����\�HvYT((�|\�vO��ssLg�ߩ
�#��d�wɨ�A�3� Y?U72h�s�Q��#^�ĳ#���i7J�A��z��d	�	��PFZ�%�9<sd��^�u�O�j��`pK��3�����E�47�So�V��#�����ϟ�����`xr ���=�.F��D�Q�����`���<|]F��n�8c,�V4a�V;����br쎔��H��3���������0b��[�8���o�2����4�1����5��y3N��v
f$0��ȍ�8���<"r�&��$}�-m,�^t�z���������kl��e�v���}���e�g�=��@��4���:|q��s,�����(X��pD����dNiqEgK]��Gx�i�aV�:m���&ff�Oc(�FO	3z;pe�Ӣ�SE-jke4H
�����
K�����-�K9��c<�7���k@��-A/Ё0����q��5]>.�V��/\�ܗ]q߲�$!�Me��Pᄎ$"&5`�W�S=h_��տw�<������	J�Uُ�F�l�h<�}��!��7%E�	q���Lu�������5)�+��ƥ����-hut���`Z�������L��_����v�n�M��lL��9BZ��{�|E��a��J��+J��d�֣��m�p*�0l�D:�ll�PDɿ �N ����q���mh¹�hA"�{~B��L����B��F���Q�~����V�򠞀͂���o��?֔�dK��e�|�U۝�OTI)(�P �c᫑��.AJhz7$�%~]�G���"�E���6��WeCJ'�)�ֻF�³��6PrL
f[���x�Z�\�xl�g��~Or��j9I��h�°��S#��ȅ�y6ҭ�K��g�֔�V�쫛y�����*;��;�z|�e%�T�"q�*�[<H��>��?8������3�Y���R���ۿ�]v	��+�h�C��V~�Q-38D�l48���l�C���XtD:��W�����L}x�r$*�}��sD��\�FZ�{nΰ��ѭ~w�������ɇ��e�9�15-�TMւ-�!��KZ��s,B��G�95�q׋�^W�������.�z�>;C"���.LGSZ��G_4Axa�&t1�{"`9���@w3� F�P?�Tј�ޔ���jY�X
$6R?��[���U�@�S����&�p�|�sC����]0A���|�_����x9d�f�u���0���Ⱦ���B78��Y\�@uz�Vh3��D�¹Ž��jԮ��}�եp�@�F�V¯G�}�s)��q�+I�R����� ��J�K���~�x	�c��`Rk�<	墈5�cP�A�昢Ʒ�e��[\VeV��tȓ�a�oN?l<�4q���U�y&*߷��sB�G�?_*r�y��`�D#l2B���������@�7�V�}�	G�Y=�4�~��� ���cfB��ȥ2u���݈�Ѓ~	T�L67�~3Gd;�d_�V����p{|����<�g���ѐ�>��^�B�i�U�<6��O���g��pe�ݞ�/�����?�kY�13q��"<?�����Y7�Y�ى�ݜ��ΩH�����w����ɶ��@G��4�̘�HB^��yz�s�;ڏ�;�!�.�K��`p,�V7�������D�e��qt9��� 0��|�x���VoC��vf�sB�8.+%\����H��5�3��2b$6 6�Te@{\��V��Nt�f$�JK������.Q-CMٿõ�l��uv�9]��Xw�w��_�f���K��`"5�c:�@(�=jr4�$֑h�*N5aU�%;<�D��Jp��:J�U�[v��DM�Wf�A��%�\6&F�`��W����/�?��\�:�
[�^���ME���y�斦*lι�αQn��&ީ`l�5��(.k�Y4��,Y�
�3��AR��;�Λ@�^���G��k;]�Q{&�u�!�fכ}9�,��D+�+豎��o�P9���#���4��������֧����/;2'�2��g�������˧W8�T�b %��߄�c���k�"g>5���+��3%@�����]�01�_��b�#�m��nk˰���<�Kc�;�ܜ�qG���Λ ɾd�І��$�,���{��:sJ�fUw��qΐ�&�A\�i݊m�J�1�p*K92%~^P�*\_� !C�.z���ϟ�]q[�
���I���Ն(�I:��ݴQo��?�ˁ��aIT����-�v��� ���8_���է?j;M�LP������J���
�=�L�oH����gR�5PO6l!����hze��҂����[Az��.����sP]��╣��u�@��FŜlԇ~��_M�����i����nQ�A���1���[v#�O4k�P��E�"8iT��LѓIM#�����	#�r�-�g#Z�����p�t ��I>��
��a.��8�Yo�3|igkR��W>��S��Ah�+D z��l�F����0wy�[OV�9"	@G����<� 2 �4b�S_�:-z�9`�sw��r�D����F�?��xMMBtEf�"e���9����	�%X���h���Q.�leۂ}��0ֽ�}	6�n��*�ì�/G���/��ݨ�6�B����zu�+Y��h�GNI�^�5���aԖ�1`��8w^�g)�hS�2��X�<��_nN�;�ϡB��[��Z�5}��:YT
����	rkXi���D>Bd��_��P�%C�_��I|�'DC3܎o�����=;w0�6��Q�]c?����y8NL���=��6�:.ع�I�4 �� ��>&d��2�������?��S*�>��٩��n+]�`Io�0c��Z��~���]ʨl�iMt�NP���Oק)y�8�y�!L�p�%q~4�,VP��)08E�s��e_BԾ���u>C�Bb���T ���BȎ�Cqj����*��^�g,��a1��o�aP�'(3C%d�a>!�CD*V&X�:�rZ�$W_dq���'��!�p)���X��-M 1r��3��q�z4/<Q�Dp'�璪J.�����X\�I�%���DJ��_�+��%_W7;��VυRJ��
�G��N��3	Bm;�}@t�0szm�&����G:! �Ek�خx��d�K� &�h+���J,��=[j��c�V����?K��9^�"�� ��.=7>5�j�Qb���ɍ��Y����K~1k˸�}Z�[Px�Fy�
����7K�^�r_��M09����/�*�G��9&Q`E�k��|l�<W�`���̨Lc���
�mI�QQ��%6��tr�6#���	�4r��0���1��cc�*��ɡv'>�����Hv�?ŭ�|��rΠ�j4x&�W'���2Z8���;�����.������7�̋	i+}��Uy��|��Dw�g����	�0��7o��\�}_����o��k��kfL�j�f��M<|;p���կ!�>=<Q38�\/��ha!��愰E����8�3�0��F�)�q�w�x��{wr7�H2�D�j���sl�91P�����d.;ʖ�&���������Ye���"ey�'mceN��>wm�
��,�����@�*�n2�S�t#�c�E[x�4mO�����M��,|���p���ß�i��
`��GK�CRړ���gw:��^؈�a_��+�c�9�^X�T�t-�}��F:1����P�#|��!�v�7��e��0�w������Q��Ȓ��"�.𦻰2{���ɣ�Ĵ��ۥR���Y�I���q�5�����M�/��	z���:.@s~�=nNˡ���Q�X�p���7�Kҵ��|u�JkT����{1�b=�(V�s_Q��X� H���Z`���s�kY� bI��H)b�k��d�@t�0D?�HM��O��=j�Aˋn����@8{:��>�K�4��]	:�����׉X���G�?m(9�|�:�R��� :��eh�/n����"^�A���<<xBEL�}�-'/�q���H��5-Y!A)�HrVZ���1�.��(6r6�hE�{�"��J��j���a�,�J�M: ����h.��k"`4𕩤(������jU�'8a݈�*L�a-Fb?M�m��S�&=me2E��-���=�,���aM���}i��)��e�씚:3OUq���nW��V:~Ř�Vm��.�A<K��-�A<ұ����!�	��wo(�D=.G&�����_��֦)8W��zY�ӂ�BW�*7��_�As�9����x^�Q�;G9+gؘEωf�7�Su+�5��l��SZ��Gr
@��O� ��v�����Kbt��ݦ�xҟ�?=�!�gOwU�S�A����}�h[o�ey�$A���7Ӭ�_�,�fZ$<��j��ɤRK/4Ow��%Op��j'g�^|��#�Q
���x�ƛ��`i+��tR߽��s��٢��r�$�HT�6U��	?z�w`��8��{��#u�⍼l��cc�熭e��X�,�t�p�}�
7n�.-w�� ��In�Cΐ�����nR!��@���0�p.F��v2�]o��q:=H�����DfHK`�b�_���.�UR��}���#�@!�^�^���6�@�o~Z ;��e1�敧r�'2���& ]:�$S�63��$Sr����F�Y����9B
��8� ��N�O�ޠ�ڎo�l�F�y���$��;Y]|��#�3	J�TGs�����7�;��Vq^�n>�������H�����t�8��i)�*3}<iQ�g�7�xq�P`�>U|
��w�P9����Ɵ�U2��z\�q�Nfs�J�����穆���ߙx9,�?3�&�w���}��օ��yc~\���<N��Z����N�����L�j�s�(���r_P�y�zv�b��:���l+e����"h����A��2q�sˣ���Z@��UP��	�*z�ݮ��
@r�P,�E�Iy�y�kr�:/c�v���J|�Ȫ��D6� ��bSu��Yڵ+��tm�㖁��xzrs����Ȁ��F/<��ް�p/���)�,�,iO'kOqpȟ�v���h��.c��UG��*���5U��x�k���pD&Qה�ew�c@oL�<�3�����©(_�y�"�0��.]���E.C_���2el�Ez��[��2��zyH=k�Gu�D�k�ܕ���i^�|�GE@��R��n}�ಔ�Kp��F���+vƃ�cǤ��8a<޸��*�5�*�e36�\�k��*�#:U���<�Ѳ0�2�?�f�����܇͑>���cָ]ZicN��
&Hq�j� g1+�4'=y�y�:ZT/��ra����L�<�J�hKJe��y��udZ�����~��%H��c�XD���dt�����4�!��BW����&�×4Xp�CG����D��`�W�"p���4β���Z�<�"����֦玏��M5�'��'`@>w���H��N�+o}�O���~��X֑6\c2�3���"'h�3����p�:G1}S7�8�짦�w�n���
D��ޚd8l�9�����ڌ�U��.��il���oD��/F��x�"�j��wO࣊e;�}��w�	8,�QiT�IG${=g����8���!�'i7Z��-;�M�V1�IU�'�Q�L`�`8�?��#�7¹�؄���S�fG��q����������ś�]�U�.����O�Yh�V�n�*e�u�L���q����8�����$���D
O`�td8�H\n��{�O�H6��G�M��:?�\)����8�b�	=��/��g����3�XtX,�[��г��S@X4��Q����u�P����rw�rL/�%�t��}X�$M��	B��EL�����ױy�z����4��OQgJicw���̸[��S���]���)�: "��~+	��i��e�R�}�Tb�AYh|�o����"]�B_��H��;�u26�orXy��תO�������z�IFw�n�F�{�}���(��d��W7�����z����a ��X=T_ΑD��_�Z�����}"�M��q J����F�;�]���S
�@��D�_?<Ǘtֲvi!��r3@��O�4�=k���o����jI,4���/�Y��~v��q�+W�����X_�)�H����"�-�J��i��aACs�z�z��5 ���/"[��&��K���
��v�����q��$�&S�� ��f�~l����N�7]�L#5�%�E|G�i��**{�y������rN
n�b`��$ۧ}�?��sNI�1�X��T�����M\�MoU��,Do�Ua��m�vk��-J��"x���M	��XmJΨ�Ҷ����hE 1� ��P���BE���x!ث�T99�y�5�)|�K�@�M�}�O���eE����4����?���U\���.�.qS�XO��G���?s)����HRk�1Bv���l�j����ժ�S�3L�;�k3h���Io��V��1Sc��� ���~���$�K�ĩ��T�w0G�9B~"?�{��_�8���j&N,�ڟ���Fo�=�Ֆ���g��mIuf�#�/�� B��	�d���I�r�?��M����2� ]x����>T*d̙_b�������'/��Ecd����TGs>w� b��	������W��i���癡͔���+�{x&��1GW9m��e�1���B�{_���*%}w�����r<�("X�x��T���"����md�w��x�b㇁�n$Cf��5�w��̂����oq����N�<*���\K�P/�|���wf�hȊ�)�]��%�����yN�^;��������S!��uw��@^�A�8-�Oe-#�����XxjN��h��\�b�:����1$�$|KR��}�u6be�y�wy�r}Y�`��H�H����;�Al׿����ue1D�OנM��}zI1��7�[��v�¡��Q��5V��.,�E^w�U�[ϤfD�����Y���>�=:��?�/C�*�����D�/8D(�<��֟ҁ��9�`a�R�Pj�w�-�|P�~�]�v���cJ}y�z�P���`V�_K	���A�S���5��o����J�A&���']����nS�t��.�8�_��{��O���uX�J,*s���I@G������O���qV�y���$=�V�KK 7M���:�����â��]��S̒��-�'w�?��<0;	AFN�ߍ[s�\A�+�+o�#�k��;F��~E��:���r_H���Tɖn�1̪7�Z�x(5�A����D��vCE�2=�D_7����G���D"��C� �
�v<�2w6Q���Ŷ_'
BV1fW��O��h 6�A�B�����.˧�I]�^����1������q�Zw m�m	���M���&q>���%T�WehH������$b㲋+�&*=���&�gT�W�#j#������z���fܛ�>̱wM�K�z���]fZ�.��BgK�C�X��q3S���dW�Y0����^%��՛^����Ǵ4�A�������	F�}��)0�%6KT˞��>�a�Fj�N��� &�N�h�V�u������i�|��:�r�#�9����E��,�5l��0YS�����9Oh1��<�U(�u����y��3��{i�GM�s9��A�[��3ـ��0�}�
�T����0�$�ĵD�7X4�!�.zl�I��1���~۪"G\�k�pAuH9���nA �ӑZ�,\U@ f=@�G~po���$��Bv�)vM,���$����@�\:ȴ9����nW���A�<R�1WU+���ʹҕ��y��J�䶾/b�\������^��2�U�)�<�t�X�Er�t�ҏ����5�Ne!gj٩U�T9ڪ�!ʋ}��g&m�S<
}O�(r��2%e����J�S��d�͌:�ǐU��N#��s;�Fl��r@�3#����Ֆڥ�R,p��2��ɹt�P#� �<�R侗ur�T�?C���>���$f�g����������]��w�apY ���pK�l�K�%#�T��5˕���Yb<���\�����>(x���=�^�Y�6���w�)&Ƹ���[~Ż�p��P5�������㖾������r{�-YM�� &�67�����Ά�e�4�At =	�6�ܢ���v�*x�(L۱`� "��m?
7��,&��>�fMD�(�u�Qp�,�j���J����-�_��vq�|t#xU��fʫ�����:Bysn5��D���K�'u���c�������^��E�k?>��}�j ���H,�>f!��2�������[�yDU��C[�|�<�/%`=/���$tѓ�
�ʹH��n�}|�d+<Y)����.�����dI��6R�)�#�����ޘrʐ�՗S�֟ė\_��?��L}��㤆wۘ�+������?`nN�&�@����L��M���|�TU��iЫa9��r�OlT���^5��&y���n�|��f8H�[]�`݃&-��L���f���m;��,���"���ҳ㡐=qE�������ʈn�t��_��%��/� @oA�mQ�����u�	4t!IS֒@��).a�6��ە*�E�BY.(Q2�@	�fn��w���GӴ 0�Q���1�b9wy�e�C��f���$��ńELu)�H��ej=������+/>k�)y�p���a/�շ�Ҵμh�-�����̈l��Z�YZ��L�J˝0�q�� D�KW􉺻�����Rh4�����F.��c��z3zC��3վU�7����-���_��yY5D��d�]��}�Xj0��3ю��I&?�*m]�K��
׌"�6�
�1���p�mǾ8� �f'���/�� 6� Wgp���o���g�8Ć�
��"h���j��@[H������9'��lܗ��;� �q�(�A� �� �?y:�:;�>1t*h2�"�y�d��~��$:!��X�m/���N+�t�����0;8�:8Λ���Yp���x:z�ڞޒ�,f���T���<�<Q��q
���=��ryy*��`�
I���׎���=�]]z�I�"g�m|,�*ѺJ�d�v��� <�ܾ`M����z���QH#�5�m���r�"'r�U>,�#L���S:����#���:]��*܀"�H�v�,`Np:�t�yش~�Y�K�g}����5�2Wݏ��50ڂ�8��̜������cgv�x���q�cӝ�����/H&Y���!Wmz#�RH��6\��/�aحQ��Xz���LD��!�C*�#Q�e)Os�{_���DuIόfDϡ';<�����{�M��[������5M8��l�1��:M܄N�ٝ�tA�L�aF%�,~����H�qT�ҩ|f���s�{ɉQ&t�4�^����.^F2�����<t��Q@B6���t��v�%�Wh��վ�K�Q��a��.�^*��
�Dlg���� &*��(�3׸�jШ��c��O��,ޱؙW��4�i�-0�=Z�0���;�::T��7x-<Q+����A�{���N4ɓ�F�2)�?ͯJ�P���߱}	�?U
~DX�E�ɟb��a���O ��o��c̊iDF�Uj���w��Z�"Mh�_�v��j@����ø�g���r��u4���ύ��Р5�L��}��y��m�<�[�t����a�Sc$~�@�s�YgL��j�6{��*;������%O�ɒ��{���G'^���HNd"J�v��cJ��� ���Rլ�Iw�Q}2�)���l�d4�@0��M8�,�jI�KL�Y	x�q��� q��jvV6ۯ�I����(� ���m��B,�j��:ֻ���p�`"���LG���T����v��]��v���P!#��u#۠:����7�2V���շWI����Wuo�+��Β������(����ꇮ���
k�ш��;����Y�w���w+�^��K$��=��I�hʛ�?%��a��k������ YR��煿4��M��Ó}��O$1|ʎ�xt�[|�F�t(u�����\�?!��?�5LL�_�*�_Pl���F���e�Shؠ��p�/�\�r{��������_Wz���{�<��6բ��e�u���ު����ĳ�3����.إx
xZ�t����Xuo$�8�ƎV�3�ԂD��mHtϦ#���w=8Cw�lu�=ix���Ym��&/zh��QGn�l�C�oc�L3�=�?K(����CUM����٢�n��n<#5[�:�8�Ԣ�)�O��,��!�o�И�^m�|�u\Z٘�(!�^\���z��ҹJ�}��1�����2
0�	�Ϧ��M�Q��ў#v'�i������%-
,^I�x�M�CS��Ǧ������v�,��u�f�v��"�RO��(�u�a�>	QE:�Â��z��s{�K����&ʮ��n#kl�p�Ә�|bU�d��A_-W6�~��" J�k�2H�lW ��K��[�v��� u$P��C����B�V{��pY1�&!����C�Zy�-�qX�VsR���cqSC�9�(uX3<TP��. 9˔i��#���g�Ga22��bM]A�57�F5:d^��M��۰kD����q�/�B=����j�''e|,@������ݙB�h�I���t_���F6a³*B-�<S��GKs%-9Z,6� �Gz����ȵ���x70�g't��8a"�ܡ�Je��h�P��`OW*�5l�|���Ҙ��q(�;���!�-���:�׍��&��q.  �v�\�cE��b�jM�M��Մ�.ny�9]����&��e3��FA�b�u��\�I9_��\��ÿ���6X5���_����+��[�F��CN������((Ym�����ˡɆ����B����=Ȣ�vfH5����\L��4�tG�w�K��]Dw|d�K��.�"��r�%%o@����uk��Wsd��c�"m�O8j<M����0���~�J�1�%'u�T�}P���2W�Q�"%��m��o�N�!Y!0鐁�u�>��]17���e��s_���3�(z�%Z;�G�M����=��Q��[�lރl-.�uz��~ Y��	�k-+�f��^�e�F�"��ю>*� ��2���L�uuۆ&ꎬ���ޖ ��̼��1A�x��P��*Q�ɭ��&,�7��4M"��8[1�0T���$C~�n��|�=ƶ�)Y����<��ԑH�\+*skۻ����k}�5~�Qr��T¹��׿��1�ٟd�Q?�T:��ir�����M'a����F߄3��Z�5�pߌ�`�o����.�[u+M<��i([ߨ�I��-c������$�J�6y�v�u�9Y����v�)�t�L���;�s����q�{�n6E����:?��qшT@�O��Oz_�<���f�S����!�i�����d�X&}?ZU��Q�݊��Oks�*Y��� �ڷ����=�j(��B1H�������Ӈ��m�l}�/�e���HV�E�BV���G#����73�&\�q�o�M	70��&���K荳� ��a�����!��]{b�4��z�T�|& /2�5\k�W�n#��E�����]0��xlBܢ���uΘ�ؕ��m)��Hɪ��~�0�j=���Jau^`��Ru;�Zf�A��6�DH{ǒ ��oS^+�xC��6SbЏ�T�S�6���O"�@ �b��x`��KI��*s���TE���9�����)�i�ѰǥZ���G8�Ka/�9�ve_t�LA���jW���1Z�̒���� V��p�@'p�� vUo��9k�;"����a��A���}7��nQ!>X��sly�ǦQ�o�HǦ��˻�(�tt^'hC�?���Th��d�S�$0��0�1��@9�}���0�<Q0��dJ�OD��GV�� ���1#OE�Z����O����|D��-�)+��w�����+�i]������Qdsh%��}ȈV�g`18���.�5X���E���-�~��	�R3!ڒ����WxF�f�:�^��28u�eZ�ʪW�Ɲ~)�7��,���������u���� 2ۢ��*ԕ'�ʹ�2ے�Cׅ�d�^5��`S�q�>%v�T]CD�@4�d���!��Vlt����Z�TH񁜇����X�u���q��
h���e~��`��XAM�4&�>�Ϻ������(h�D�V
�R|{ÑM�-h�f�Kr%i��K�	��}�VUԘ^K,X0���b}3{0��S�^���y��e���IHTzc�|��4��s��o�w}k�dN_:�W*Oe�j�����cF�K�sK�&����$�r�,{�4�V���)�ޕMu/.nRcle|d���IzBa����_c���j�'%a��"}F���zOm�}Z'�@.?@c%ܩ��Hp�q������|wFE^S�$��Zw�c�_|��SE�T`�����ݛvِ�_�%ɚ�fЭ!�S/�48�[�����J���N�fϧ܍���U-?�e�����lł���@٘լ��G�c&r�cc�ݎ_1���%���djI.�M���N�$$&�S$�6��t�WO��\2������vK�`�a@�QhD4��Y�g�^��*R�ve�{i9d�>��+X��������z{�+Gi�l�V�]�#}
.�z���Hx��x�a�!�-��i�����b%J�	���V����¹U���^��ݪ���(�����n5�����ӟR:W��-�H����Gu���-�<��z��~J�7�˭]��t|�K_�q]�Y�iX���O�9�@?�t�5���0`��)���l�H��������
X�����Q�*3R�Ǟ����
�O����0����;^G��1l�Q����[�r�`��7d�*z�l� �I�!*�^��X�۬Q%z�R������/oU����<���>�ΐ����,����L����4q$�e�~9�
l��7m��(���1E�}���/*�Z{��]���w3ٜ$���"����Z�1E��o� G�Y �rd�:z �v
ǯ��ǭ�L��SĪ���9@�U[T�n�A��IYc��Y�N
�b�����Hj'1�p�p�[#����Gq*& ��Ϗ9�w��.X{���f�Y^�14<�7}�N.�g�� ��ۭ${J��Ҷ�'"��;�;0�_��-�9��\�~~���,r��M+���8�,�fd���V����	�M�;T����\KX��?��`����Uu�$q�N8�������*���&L�ז�����i�6Y��P�@W�}�+j���_1���/wa-��t�0�%�.JI5�p����mU*���/���B�{5|\�m���'!:�v�&���fg�mϵ����ّ�8�au g0���B��ZZ.qF(��X��~��>�}�f���e�Md�D`H��'���O��pCMkhO�c�����O=��:R���7f�����F���������b�Y�����J���v�i���j�m[N����z�-I0��0�:`�"^��L�w[޶{4�曙O�0��󺺇e�<{ i��m<&�`��ֈ�Ω>�c_�A��S�/ '�A�"�T}�=�[��e���Z���l��6��G����Һ+UV�������P�:E��V�f��X�"��q�?楬,sA��R�"EYW�b(�5u\8� ��ܥK|7~��G
��;��t�.%�������yK�4����QO�yi{�,<+@KQ����?�8}��sd'�zPM\!�����O��j��G#�RTђ�6�_=�F���.!r���a�I���2�W/��;5�;[�;y�-l߭�.�^v��n�RL'C�4�$ф����l�RVM[�p��_�+��wU�a� ��������uΕ>#��Ѧ��aF��'fEj�V��"ß*�:�˸Պ���a�K-�ר��� G�%}��k�sC(��c�۪��~9m�N��ue"��wY���?�?AN�P�W���X�������-�KH� ���]H��5C�Ūl�_����ks��d��Lk~�@�
p��aɚ�LMSD ��:뗝pN���htJV-���K�%���u����ϻ���*�����"�\�jO$�~�r� �qPS���}f��{�O�֠���W: ��H�Bkᕯt�t�e}gx;�>��/f���>]pR�R+�G�e׶��4�e<$1�=����e�����}�WXZ�b���X�(]iE�}H���Ϧ�����<c�VI�����K�[Ńݔet��p<�o�K���KMǞ����$P�J&~B��+�y{v��Ң��d������GS�F�4��?V[�>��I��	��`�7���[��'��w���<�B$
=ao:i@�4�й�m���ca����_:��'
c'�#����r�KJHs^�� ��/����՚�J<�Y1e]�v`13\�NR6��l���̳]?=/��M�Y8UF��1z��s:�8g'�'�s���'(�r�Y¥F 1TI�2>�y�uv�B0�>Wr*+���z1�ŊP/@{�S�Rc^�Lv��s*�Y�t��M0qr����fN8}Qn1�(��d�2��=|�OGxI#��*ƥn V�������x�J�8p�Z%e+p����Gcn#���������b�Pu*7�,^ ����%�EW�\o$���q�����B�Gg�l�4��<VmO����cV'���%.("E��u����ulمs��g&%y<�������;���0�[O���UMC��}�a�Se�e�J�_cр������9��IΆ�1�~8�u��	�DI+%N&B曨�� �O����y�n[��6�+=v���[���嗂M_�������@�ۥq!@���!]�xo�� ��+�LD�D�s�(�*��6/ET�]���c^.�1��>oZ�+���7�GM�P{D�r�hv�t��L���4��Z��h����m)�7+�o�XVLQM�p��u��F�_W�R�i50��`�U<M�������S\bnk�>��%k���<��?�C%SV{�����}ةS����.��Q�l��G�I�/�m��z仫����e=�B��}�߀�V�ِ:��eS��u<5�lο���H}$6a����w��)��7?�*u����<��4r]FZ��'G�<�r��p�ħWJ�����.�E�Z�?�\	��@� ���M(��H��r��ϒb��A�p�az�ִ��qL��Oj�(��v�وa�S�����د��"�g�~����f���?�*���г�%��2xJ�%�)ެtp+5/: ���q��anȀ�RQM�u �tOV�2F��� ����V:�pm�D}����F�-8 ���H��+�l�B���{�E8���e
)��<���4sU�l��G�}eB$��ѕ-k�q	����~	�5�|�ʥz*��F�4����<FȰ�<��G���>1☶w��Y�vp�n��T�=���R	+�=�J�(q�`���T�hȣ�#*�NΒp.��֒1����v�9S�c��_��#�o �1g�w6���'J_�MSʀ���7��C���&�$�j�9��
����1a�e��g|6���΢0y�wV^=&\㹚.�t��,� SN�6��7xo"w�+-(����*��w`�ا�������A�n���
:9���+eqꚕ_��%u���;�=�d�����23�h&|����7�pER��}@$ΰu�2[��z�^j���c�����m�t�n��C�i0�c?�RȤ�@��fw��'�kju�(C8V�$�ӟ|cޛ������1h�s��.�g\�~�4� ����;�������>�ڐ���7��-F��6�2/^i��5��s��|�M�{��os�����A���I��Φ�0u�� "�A���1W?]��rH��׺��d���l�X6�S��c9��"6��f�RC!l����Z�������|XYt����Ⴔ��Q�uwU"=Na��=3y>�j�
M�_o�z'�H��%yb3Zn�U���>	s��g�0��|����l����N��4�o��N���#M�b�B ���\�d�D|'*�fֆ��L�������
Jֵԃ����6��ScJ�=폁f�I7��+����1t�ꯟ2lx�z�[����.-�������G/��w�9�+���N<��Z����{j�Y�jne��JcI?�:�5ӗw�%�g!�N��c���x��3"Lf���n P�j��K��v���9[��(��d�,��5q��a�^�'��[��a�1'��{�X$rn�(���g�������K���%+�f#,Z����1s�O���B����N!�u�'p�nc�U\�Dݵ�܏�6_����
�L5��Oj7(��s�)(�g?�r��	���%��q�4lB�A��Ig����PĢM21̮�2<����|���w� $�L	���6G�L���_��$�I!A&�O\�a��T%N�7|s��R�Ѹ�(�՝�u^j_�N��}��[[s$)�`
5UAQ��J�5�"ŝh���\�E`��zC��GT]����]������bQ���}���p�O���%�%�kQ�@V�?��
LsfY�(�)!f�%Sz2���K�[[�K*Q��%�{c��s�����.�L��P��o��e�.��$� Ƿ�����s���L��~߲o��&�X�{�_H	ȫ����z'�-�Y�t��L�m`&'�R�	wj�^�#����݊�3�
}/���˟��' R ;�'��a$��n��K��h���sx���Vc��xG��������)xyZ��*��/���k���3���PU�0Z����A�̡�w������9�%���Bs�4���?C�/g��c,��`�H���e2�4;��G�B�e�3�i3���?�;��-cԖ�R����=���Z�LvF�B�=bhSW����8L)�y}�hER�5��W����� P������,����̓q���m�"���az/�G�Xo$M���s5���5$N94l9>6
j�<x����:�^�\�|�*Bc�ݸy�����a�O�0�Nׄ�����W�m�zg�	 G�x�&��T���5��o��P�j?wh����⅙P�f���L+�+N0!(>Sd�Ra��*{�c�t��L+������oJΡ/�,�tG�!P���j̬j��^� ��kdm7Qt��獋ˮ�"ٶ�@XﯱRf��Ⱥ�Kd�c��� j�hh�8�e.�Q|q�j���w�Uo�ľ#��Q�I�Jց�R`	�%��'L�|v~`���.!��Q6=	� ŗ��A	ñ�
�2��K�/M�/
au��7��;��m�օ�,�[_S�\mz����@�B�F����Kۄ� �����tT��	ߒ�g��I+�V���6�)9�`��п�C��X}|�q��N�ϔ���Q��%�[6�m;�o�����
�3x���V���?6G�39���ԩ����p�j����_'7r4ܧ�]����[��v�|YVT9��)( �$i��bZ� �4 yc!r�:a�^�`����Fݗ�2��}�Sޠԇ�q<��	������ƇU`]����AH7� Ŭ��ꠔ�d��^��f�љ,+ט�m�<�btk�_��5�?њh��k�)��)��Ƅ=�-/�ӥ�m�޲J)H��s�rm��B"��o��uϚ��?��E�M#jp��>ܬb�j���tl��`��.L��W�ٺ�T�&��/���t�5�@��1���_L�AV�Zj����+WF��5��dV�k@�d6���ft]-� y|���uУ���Kk��t�% 63�6�-#��9'tE��	��Ls��r&��sH2�{�@f=���aw7w���{07���<Tҹ'��~��:Vgd��.$?�#eL{�t���|9�?�������v�[������Y���J�UfK��[���PN�*�e��4{��f���=ط��T���^r5�4W�������ڽ�q+�s|�ߵɁ�a�鶦��&�%B �A�[��X:e��`hk�/���_��*υ'���X��+�{�Tރ��ů�oi��TF;��b��%��2/ב��^]�����`�9���;�є�?l��M�͛"��NC�A�_n_a��W7������~�Y���"
hXN��J�y�[��io�=�R�c�F�=L���i�9�����#ڴ�?�@LF���'���@�[<pE T::V)0�akD�4��;>
�Y3�L{C����թ�lp����x���p��墒��om>�
J������k*zu�;	=�������h����3����v���rJA<_���PY0�,J
h�����(	��{r�m���`Vl�;�T��
��\� 7�1���j%���of�n�����*�����O�D���Ԑ`�۠On_ R�g1Ƕ��~�v�A�t��U���(a>y���(�VC��x��تI|��`�蟪�'�?�������u��5b﴾�@932����r}�$�ia�̟O�sی��Nẙ�J˛�z9D9�F���;���p��A� �fT|6Ff*��;�ę;e��`��vJ�赧���c�|@��
s���5�9�,*i�~�|�0:�<Rp�T��=p ��U�>�8�M�%�g�v���P���o�M��9C>����]#Y4��:�0g��2?}�j�b:|�J��F`�Z����Q���b�
(~�i�=�Ŀ�����/��� �C��j
x�{,���Y���_D�V5��Ƅ `t(M�wFT޺<�z��I\W���=�O�g�]pÀ���z�V֖|{01/e�|�k/��::�=n����Si��H�wh��H�t�5�����D�z�H�+`g�ί����Y���e�;�:���[�@�qrlOD�������ya
[�4�wp����,�H0��#� �g#�h̟���6��j���v�?��`�Y�jbn�~���m��0U�p"p �1Vg���2��M��@�bݩ@HKz�fj�h��6w*_�'�g�ђ[��kf�,.��|�|ZL��Ts~�i gͶ,����:A�d=-�V�!dw[l!�?w߉<�o����4e>yF�U� `�5���/zq�S�D��w��Ki;d�TG�^�l���	�-�Qz�`�{أ��r�O�7��U�uG�ygY*�$���_*�݈�.S"�gO2ČɎ�݊�d�۔4j���
XC�߲&p��V�w^Y�	eu�gL	@�l���dnR�h�,a� �9g��A۴eڇ��[��е����Z"_�%$�h��\v��U�%C+U�<B�C�R�n�cTO@����%S�-��tѦ @4&�oI�"��N��mR���̨�6�O�yDA���v�ea�����H�d+����Cʮ$@��&���i˜��1�{ѽ�I���j�sW��LCyV9���8���֟){�!?L��n+������I��o�e�4��Sp/�=E��܂8�B���o�0NM��Y�]���m��C�=Y�ը����A�+������"9	��e�kCH30r�3x� ��r��>�iH<�cUC��t��aA,w���^駤VO����J�v�8v�~��چ�V��Ԝ��\6�q7��s��(���R��y�*z|���CR���BnČkG^��g�;\Ll��gN�j?g��#� ӁX���:VJ�5)�ˡ���ޟ�F����(bz�P���ݶ]���~�j���݁]�8%=΀��	G ���兺a�|=�������ɓ�|Q禗A�?����դ�hM�B!���p�ўD0�[��Q�biY8�QA�%�l���A�~'c�<��쭄32��)4�N�'m	aE��������G�.���/��/>#���ߗd.��w#0Ɨ�����N�s*R�T��H�w�:Q�TUցW�Cm���f����	7��j�PHV�ikH[GX��}�D5�s�$$���Y	�@��H{���S­J#��ok�0������޿�A&��1]p���9À�D��@�����$|JE�0�dkoϻ�����M�9��ܽcL���а����<�x����µ�_���hz<@j�������"�ټڼYLȾ�+�_�Le=^���[����	&a�M��.}���v2aYOz��鐕����VȊ;�د��`eK�:�e��%A� ���j^l������o~̿��ۥݱ4��	���#��- �Y̺�|��ۄ�Ѯkr�� �p��?D��tC5�J�X6�qۙ�5��`��5*&�������V�R�2��bFY�|=�j�e�۩��J�$���XoD�o���{mc���"��e�ip
�n��вqϓ �����Ҋ�+��ˤ�4^zO�/F�sua1#c��2l�u�����{"S����<}f�M�t��*��k����ɛ��i >��۲���I�rn*فu�6
�R�g���,:�2U��Ҍ�󵚎N��فj���uC��M#i�(���nU�_[exh�F�ZW���Ub��8����T����e�b6�j )m��MT��@Q^]�m>�^�.\F��"�]R���S*�@ه�e���d���I�d=���qI�*Nףo�V��nk8ǻ�����m���:��@�z��<�����������^I� �,�h���	��L�gkLң���,��kw�tB�돢�x��B4)ͯ��_��rF@T6�ɎI�xf�Wu�>Y�;{��td����2�#�SvYҝ��+4�sK��n�)G�ʩ^O�-�Wh�T�Y'}�_��nXe�b$mE���[�f���U��+`t����t�Ǩw�e�<�m6�fRs����2�5?x��ҡ�Q!*�����n��(���I�뼛4�SR|�>�-GY�+��SR+���f��i���_��Q%��ց;ҭ�U?$R��MV��_>�v@~~��I������!�f��),�`���;�rG��P�uթ���V���V����ՌD@6�D��@����s �|Q��n PL���1a}b��S��Ĝ�%�W%Z.�7:��D�M����PB���K�乾#��\�?��R�;��D�K�4o����KN�m�.�kA!�!w_ORx�Rǰ��C��Y��/ږ�D�mǝ� ̓r�b+�n�S\h��I*�ٞ�F�T#(h]"�v�Ũ�����i����7�����6�3�{NQa��B+ᶣ�A�{n��R���yo�jt8���)0��gi���м��q�K��G�Cr�xE�äO
����_E�L��S:sA&�c�f������O�~N6U*R�D⦕j�b8�2ge�G��O�# Y��a3�	�M6gL�DB�����ߖ�K��� ��x�K.d�Z����F�5狆3�mx���s�[�_P���ib�<^.��`)1?x�	I]3�@���jk��9���̶����De��ͦ�r�)��{�-'�]<�SGDhLb����A�D�hV���LP�[H*���w��t�1KZ �vg}�53P�uB�a�1���ܮ��`M)cAa0Gi�Z�A��a�i�U-؋cu^���R1sX.�F�@�W�g��]![���`[q�l>�6f�j�b�ţ;�F��G�y�G���,�Su)(��Ǜ�E���u����#�F�Yĳk@:�ZA $!�ZGd�JɎ��*;2�F/\�!���\5o~�B̪\�R�ze&�k��F�
�W$o7&}Ԓ�Y�0�k��dW�6T�Pٛ�F	����h��&?�}:��$��$ʾ���}�:*覷��� \,��GE��C��C�:]��?����������Χ�2{[q~��$�2�[ز�}�g*��w�%��Am ����\�Ɛmķ��;`�7��z���յɻ `�ӖXZ�e|9r<b:�F=����p��%)��p�����_�g��YnP�it�I�ͅ��ߛ��U�:��YӮb�8���:)�t���!�-D{4Y�
�g�7�0��CnQW�د��a6���u�HՈהʽt�!�w'<.Nv���,9E�L^��1[q??�p��b�c�l�O�Z[���-_/������z%������ƀQHv!����_3��)*z��u=�F��w_懬x� j�(�r3ܫT�/��m��9k'�%J���{b�'q�9��^���y�t�e�xY�7�!��4괥�%��]����HMK%6;�/Z�V��N�:kҵEi��4x�BK(�Pc��O$5~�O�m� �#G�5O]���1�^A�=)���!IT�7����g��s;1�vp`ӥ��a�A4�O�$�" '[g�Q!>�7� ᣚ��:�糧W�L1Vz<i:,Gv43L}j<��?���T��>��5V�i��31UI�1V�f*q�s{&1v4��p��{ 6 ���aE��$F|M(��s�^�UX��i���B{iH���TOk��J��F,a4˹�#<�v��PS�J3T.o��C,9���r�M:B@=�M��iu��?�ׇ4��9���5�I�u��V��=k�/�b�턃sj���C=�uw����a<��X�J���x+̿���v6/n�<�:�ʀ���N��c��LM�$�5��-:�>��h =}��YEP�>����u�HKA�H+>�.(z[Xe�I�^Mow(wm<��Rh���X������qD�\�.���s����y�%'�W�����Y��Ɵ����`&�:S�~^��B��{�ͦo&��3{��9��m��i�厇�0P2�g�*��u����/C:ax���xˋ`ek|���H�H&���s2�xf�MЍq�Q����,9Z��r�E<o����.�����*�P/CZ�kM��ю�0�*(T"U�ۺ�:���m%�#���$ �\��P.q*<"�
���w��>|�R��5m�OI~��۳�Y��y�|�N|<��O)N�V�4'�?��-`�Z��7���R�5f����3v���N卶cP����	�b5��p��1S��� �w���U��Ǟ�gzd����tmU�y�ê�������1��6l�ˣ��/Ge���a�l��!@\�<�"}������?�$���8��ߕox� x�.��;��ެ�0S!UKh�CԖNH����jr��/�����S�[M[Ι�I�	m�W�����u^;��	Yf�v�B�ԉ����@��\�覴��~EBI��E%�� ���4��[�XGY�ٴ�.BWvǵ|�C����<��6�E(���˫"c�L��F�����d�zE�ӛ >��{Cv�]�+-����)H��AR�`6�#�K��Y�Ł���d���Xa�qG��c
Q�ug�<�~��
�Or>u���V`�g��;d�D����~i?��{v�EA�µ���|���S����Cvǯ�*lf��F=H��������,^���4�U2[��˟}x%'Z��,�mz:����z�x� '1� �c�	f5�2/u��(�@�q�s�f�+�z���a4L\В��.8мc�c��#�1������̠I1���̫�u4nW��g�=�{є���@=b�!�\C���ב` ��~��p2�����U�L�X��a襠Vw��D�4r�>�����2�L��rT6�/��TPn�l���n�UҲ/d��T�5B꽃�Cԉ�_l^�P#f,���������A$r]=�8�+q∷:Kr.l��S�+I�d3:&�B3u��bѭ(��?R�InèW�e�o�u����e��z�UI�I�����*.����5iU3�Y�JM;[\��x���cQ�����?�ء��d���>����"<�ԆΆS}��5��G	��qܫ����%u�R^K��`�{E	���e�蠹��ߓ��3�2ixפ��+@Fo� 
a���{g51J��n��b\}}��O8R��{b��QCX]���ѻ�Zz��<���q�ܘ�+S�V��g�(�ɨ��k�o0���'H��Z�,�`�M;d�ŝv؉	Y,b/]w��fS�Mk�M7�������1@�A�<�Q��\f*2:s���H�@zx��I
�0P��N�Ϲ��/Ìa����{˞���l�'_6W�ƝΠ�ު7_���R�1UZ�y���ATk�>��A}��U:e5����o�47=Jڲ*3�3:.�c��s�o�:R�l��8��0�y�d,���R�I��2Z����n'_r6��������n�����Ia-������,�XUv��lb<vG���oI�R�5$�4��rr�Y$�$��Ky h���?��V�� �;T2!u\P8�''��a0 u&� o���ʛ����lw(VR���d:-N�L�����%&3s������c\� +�������B`�*febJ�R9-��4��Y_x�=vBcz�4ë5�A���@kQ��1'�錒��^�L��4:t� ��&���f�����iD�����)��m�Y���8�&��}*f�BR��e�����R*4V��X��F1��c8q���S������p�ykX�$s,Wc(���x��Ѣ�k�!*_9T�� !�Sg8���S�}�����˂7uw��v�Wtc)�~��G&�`f�a�l(^J�m �A1����&����b{��k���ɖ:
���h�>���+��"�̶���TJ��+���*�|،�HD&��b��	��&�V}�P���$lS</����[���$���!SK��/�$b���(��|;��3��l`I��U0'PZ_�2� �nRО>��@C�+�G8�W��@�j>���- ?K�Lm��H0�{���o��h8z�mKt�&{tS��6���d"���L��g����kX6.y����V֧�^ρ;�д���f��|��3l·�`��n蒱�co��~\�<���825�Udá� ��A<��xv"�� ����0{��W�&yG�	��Clb�Ά1g��q�x��d0>rl_��*&���XEH�<\�~PN�p����P�ZLM�W@��I*J_�Ð;s7�{��r�)a<�i�§b1'Hn~i�K}{X���0�5)u����{�r�@�@֬�u ���
)�x��-��v���0����q�Z,�c��|�&p7��T�A�j�-��I��$��e����-ǼvJ�9�o������c���6u�W���^��0����kK�^�z?	�E(b!�K��a�$RDI���l�J�'B�TlT͔K��u�:*q_v�3����r.P��!�r�\�TW�:�R�s�c��Y�/1�ل�j�xG&8��]^�i����x6�ʴ��I�V>C1��Zdz�e	lʿ�g�rŊ�7���Z�eG5C �I۲�Af�mKk�%�a�]�ߢ=�����nx�r��;_�&`V}6�:��TAL �:��B��0�4���i��8U��@T�"8�j4�Q���]'�ID����;?o���.�/���E��]Rf|<2����=�y����?�Z1fJ�7��o� ~,�[��A��������$,�"2�<iDc[-bg���{���F��)!ʑ��T��6�W�b�`~a�V�c[�?���
+E��nN�*��<�����;n�{{z�a�݆W�W^3����>�>��A��
����c�VAh)��N���Ǹ�mO�7ɹQ�ͅR��xgk`+���c8&p�h�>1��}I�N�bF��lpO+�A|���T6���[ڶ�@�FT©GB҆)�T��"��?,��j�#���=�UO�N�]=✠�ÑY�#=�% t\r6r�<�|��u�蟽����:���Lҭ������<�V �?denX�7*$;Zr*��3n3J�o��&)�j��Y�0(��O����׿y8J�65j��kw� �#���nw��*����'Q3���Ԑ�m`+l֬�_#���SK$#��{�����dL��Zr�'(��b-���v�#�F�MN �e�0���%�_��/�&Д� �����|�q�F|PK���PŬz�&
�j�`�t�O��*��`�ˤ)��YtQK\���F�0K���wV�ȵ1���$��.������������ޓt�q]��1�q'��!�t5�Or�����Ŧpxw$�H���F̶����O�PO��.Y߯|+r���Y23k1������ѱ��{��bGy���f���]2٠n;tH��U�9��R�R: l����%<�}�An�3nlbg<tG����3�s�h��{�̴�����H�E�C�C�P�>�"��4���3�$!���0��~Q}�ݮM�Ղ��j;עn��EE��F8��h��j�M3��e����X����k�EN2��t�0�e�\�q�DB���4�'��v��}���\:�Q�A85��V�x�-̚\��!?n �NE� ܈%�<��Lڅo��V�Hp�-���(�E
�_g��sCNAWP�,�r�1i*#t/K�P��"(�c77��a�uF	&��"$2�s蒿b��Z���&�;�� �'0m	��PE�Q}p���?*���~�K�-b�����I<R�1��vy�m��c�#�,����AŮjb9�Xe�d�̂K�P#Ɨ
Lm�3.wP�U�� ���=y��t	u�7	k����I��J���i&��U$��
�xD%5`��j�|�Ԓ����7����@|�7Ζ�ԡ�U3}�?Z��N�� ������$�Do�l�PP��|�*-�2K��i��F�SO�}@��*]q$���^�T�J1�
���<i�ip�v�/�RcՊ �t��T��J�J���Q�N������Ez��(�'UT)�A����L5�����ɸ:U	?��.��(���d���������%�s���}�R��Q_�064!lQ�R�'L��>�% qr��{�T����0CJ,_��8=ǽ{k7�c�(�_�@��lZ0q�hv�1y�����pL[Y�o��H�l�M?w
o9bo� �{��s�����Ī5k�A��5�[�v3���%GZU�6U-�7H����}Z����9�3�������:F��D�퓁j�vf�lt)@#�����/.qK��\9�`/�6�R��`�6���~(?��l,U[F9�
����pΐ�Q�/H[x�&�b&z�I��V`�`����N*i?>	�t�㿚ϱ<���W4č������ZRށ���B�O���;�P�z+��np�hi"�|��E�Ykb|G"}�#AF51\����#���fe|��e�뭓�o�:�".���|���׌��(Q������v�l)�.6ߘ�OH��z�#��B���N���9ۜ8ad�L��m��<	"_����ޢy#4��%�Qck�=����#����w%n�$�Q�0o�����;A����*g�.��˒&���B�8����4�й}7`���R��ɀ�I�rU��%��~d�pd�׿�%�r���\��*������՟=�V�e�`������4��q�W���?c<(A
��(��Z|�#�d��w��-ƚeY5�����&^�K�٪߈�
�x�;���O��_�'�{���w�4��d���4��f��X�q	6�n�ߛ�I5P<d�3)i9`opܙ(���%�`�Q��I�U��7&�)
��Y�����F �PYg�����q�\>����K�f{�d"���Xg�|
&�fwimH��t�Q��0]�*�a����~Pr�Ma�$��q���G�3�}'�^���OU�^z�f�����aR[�~�I��@�.K�9τ�Y6zj���_�Y�l��_C񧘉M�ץ�r-�#xvcD��kU��<M6�`�b��=_CSc��s̯/�8�UY���ȤX��8��b�
���~�jc��Iv Tu�\�+-�_Z����7#�H1-�֯�����^�߮��J�k�_A-yw;��59��&�Ol��Y7:��(j�!��zfCK��B�h&��e��뒺{�=u���>�t�������_&�Z�m'����FfS8��S���/D�?9�s�S���k}�>��x�н�Mמi=��t<����8�\���?�a�r4>���� !TY��IF8i��Ġ��H��)s�]����5����A�lqQ Y��/���J��%f�I,��LU��O�P���CdV~m�:MW�$ͫ�iO�4�b,u֯W�Y?(���9ϸi�e�ݴ	�b#N���C�����B�xDP%�Gt�m��u����H���D�n�_��^��h|��WeP��P�ۧL�}n��5������=�@�y37�ߩL��������m�9��'r�	�.L��_���u� ��ȟ#�E\�vYdި���j+�,���rE�;h���� Ұ (`�y�O��["����N��l5��c�	��զ����zO��w�E~I�<[(�cu/��֮�f�C�wuB\X�[�y�v!C��4�f�dͮJ���(�ʹ��I~�o�h������"Hwu����cHo��	�	{�E7@�F�<p.!�򝈈I8��E\�K]Ђ$ɏB�d�ӛ��>tM�]�f�������?
�,��J�cA�� l�8���\�_w�H��������n�87�?�y����Uhwg]v�}�5���u�1L(EQ�C���rAw��1i�jȷ0f;�O*��1����!�b\,>�D��C���)�i��}�cG\�M��ez�`�TP[������v��<�Q�)KF�;�<�>og��\7��7ϼ�$��Ϣ�9g���پ�:~����Xy�n
ɡf��f�Rl�`PdQ ��Y�S��ߣ-cR� o��}p��po�!�M8'���"9MKP!&r��/	*���Ksnm�(�u��E'4�Si�Ã���fZ���fnEn?'�Ł���Jkv=1;�r���bN�%3��f�M����VZ.#P���uS�����5�Y�4�K9o+�@?���U�y�gp��"�B�B7	�Jg�϶���ѰbS�﯏
�G�H)�����W��du��<^s<�]��J���Ľ��e��PkvE�,���k���W�K۔v��*8�n�So�T��������h�Tt_b$}�_ŵ�Gͮz��i���>N��WN��#���}�*�-J9�ٝܳ<��8����.T<,+t�[ B��S=�)d	;��*lߵ;�Ľ._�>KfB����qxY����(F��|���0.V�����e�%S���61���oM�D��,�3Q��y����qT�$�P��p��R���l�BF��g�9܌���H�#��o
JmP�`���ŗ��[�wi�J#�ٝ+SZ;�yXv�4c{k�^�3����y�����W�tF^s�Z����[��T��e��/Hs^i;*��0`�0�C�[�"{f&Ǩ:,�I�4T.w�nA�{_�8������z!B}PҠ�Gղ\C�TH�\tK������T�.�P���b���4x�Y����k�^3ghz/��Bq7�M��O-�!�m����'��i�j��T��O��3��/��_�E䟮�[-��M�[�[Ȗ����L�]��Y��p����ٔr���;nbH�j-���u6袪�����-׭e��p��/��n`j�tt�I/2kŦ��Y�M>c!Rԯ�6�OawD�|g�}z�*_�X��]Z�ߌ}�>��L����+f��Ƨ���6g����ڝ��})�{4�.��4�Q4���

f��s��-IRF���Hzid��+u1��R�i�FgJ6��]h���Ev�[�Y��� 0NMո�&�ޯ�G��O�$���)Ԃa������K�Po�y�'����/�d녽�d&rqX�<Tb�*H�^ ����H��@�pԐ�@A~l�d��[;&K��t�[�ޒig��þ<����3�@&+M��h��cj�k��@��}[{�7!��?�6POl��6��8��Mg3E>��C�-�5�lRr��91��.\���&8��z�8���j�#���L�V�h���"�&����	&]2���~Hi�'���/r�w��{b��_>+�s˾r� ������-$�'nV������]���c�C�'�҂�����ޘ��ְ�Z�(f��n��-k����U�AA�O��4Zo��ߢ���15��jd;�5�~`<�'�3�`�i!;!(���И��о���T�խFTd7�#�z��a�N�Lb���-�DET�>'�e:C�(s�^�b;��e��k6�1z~::K%����#&���ͽ;^*�EY�����th9=u~6�O*31�N��T��ܱ��-��[�����F8��%����%o�ď/�@%
l��~	&e����~�.���ԝe��G��<�3���v�ې#N��9e�A g~l1��׎��m�Uhf�s�;�+w�c��>�s,8̀�n<�R�T�C�����ā�| ,W2�Yl!�>��>}<��$ȍ|W��b.���)�tm#)�����k"����N?�g(��ʮ��^��%�es�R/@&z���wi�8�VzS�R^ئ��VZUIJ�蛀)ܾÂ�������K_�WH�Ik���g2�VF�:��V���ϕ(&?*�p8%��S���6�m? ���臷�U�u��_F�v���r�����~�-�/(�M�6E6W�IS*,.��in;J��}�7,��p����,'P�^� q��-f�Q0�o����� V���d��ϖ�ɼX*��61���A)»�
u������T.�i�y��t�C%n���\���⿩w�B.��jT(��֖(`�[��X���_�˹F�8E
�5m��1n]��d������N-~�{�</vl�JH��X���ٴ*_< Q�JYz�B@4]�v}b�y���ik�^��bo�{�@_e��*@�-��h'�ł�$����,(p'���S�1�r�E�t��R��"�U��t�٠��\?��'�b���)���@� ��r�;'I��:�)V21� o����<����Ȟқͤ����Wh�FF3S`́�l���#��m�>`��Ļ���\	�)�7�"}��yͭ�Ī����k5�=,�٤���R�`�� �X�Y��e�ȯ�:��BШBKn����aџ5j؝5ٓ��4��U5~g�jZ����4)�؏L�B>���`F���ݒ����{$)]�۷� :b�&K[7���v)=��_q��2o��tv��5�lC��� �K�%�X+�b�*������`#�������r^ś����,��g��N-��EKhM���߹��e����KMg������vt߀�Mz/,_=y|T���X�$v�-��WO�qX+D�>B�[�~��Zp�� �f�}u�сnPs���&i_X��t��L�TӼMs8Q�>߮���7S4��~7�,G�B)��+"�1� �V�ڷ-�B��mf. 7ժ�3�s}'��%�b��Ƥ|�M�V��O��#���d�4��t�Y���rݼIo{� ��獾|B5]�Z�]�GK���)�uM�M۵�����Z_������	?!�*�*8I�oՏ�4��\`�փJ�I�\1ؐp�������=2�d�tی��f
'�A���j0`n�����L���s濮�+M��p�>;|���lא��,�Jyu/��_$�n=4�|�]Ӱ6o]'ԭTF�j	�sZ�����E(H���R�R���7±�i����PO��n�^�쏰��jg}I���Rs���7жI^6��?�bq����������8�����砲��8��$�/�ߋ���5��HMy�u�_tV��[�L�E�N�-[������<����P>�v���m�G^��))���-�x	�z��� ,���c�����H�~�d��00\�WR%���;�U�:�<�Ne�k�c�80I��l���-�>���������w̄���f��2&��GO�#{G&"A�q �o9d���T"�^�t�p������9�j�@N�A��0��T���W&�����)Ƃ��젋G��.�:m��_��ѭ2�Q�첎���4�=���Z� A����q�-�NHh���t���y-;�받��R�%�]Dh����0�HF����mcl��$�J�CBզɛ ��D:Q@@����Ϝ^2	g�#����^CL���ےPÖ����M�g<vu���1�x��P)��zp�Fqθ\��PC���)�z�OιPl�q���Б���A��@�|����_��D8=�<�Wo��O���|��OH�*N�q^��^Z�<܌�*�.��E�${|\��jj��h46�F��;4r70?�����[�`�iiG�=F�����h({\��~���~E:�]A��3F(F�l�u�_S�s�M��3��8ac*��������N&�z!)���cB��Qn�n�a�q�r��<�����a��w���3��,�-b���j~)rvf!W�����#�=yOZa���h[1���H��cNF�o�^�Ε���k6���O�9�:Q)]����Q4�F�=W�i�N({�s�L��x�8= U��b��ޢh��Z]VS�>���q;�G	��Z�K�;E�%���J�y�ɂ'Q�O���~��j���t��M�X�B�� lw�|xҼkM�/�B�?B�.5�7��7R�V�G���4�@�9�*Г5�Q�m���|�p}�\\��`-��7���Gu?b ��|~SҬ�)�o�B���_�%�Tݫ�׵������Ψk@�%�P�ml +yM4�Q�$���7�D�]��3�8�}R�{�p���I�	�p�(��$��)ez[��ߠ��@�2:��7�^�Ue���&cv�!P`i��'�V+Lv��+c`b�^*�
����?��@�ď�G�d��S�¦#��;�k���ER:}r2Fba�t�`U�t�&�a[^��C�j�4��>I�ɛ{���?�1<�&9d^���3��@��E�V��Z}70u5�߈���1�Lj,��U�`�PM���2aU�q��42��F'!c¿�<~V�16K����6~�Q�J�ݎ�a���Itr,%Lٖy$]��INw�Z����P����\�Q=z�Hg��R�E?d�[�~ީ�_�{{�ys(�xb�]�Tb��F_Ui����'�������l�%#�@K��	�-Te"��H���>I�n�\ˎ;����g�`�M����/�eN���*��v��]�t�b\��O�V����c��J=���6=��#i��6�Xu���˷���!���DJ@�ة�s-���p�u�ah��"���Y���`�1�M�+��- ��#�Up����Ѓ�g�@��P�(˧Q�y!�-z��Vb�>���r1���:Gǧ�ŭ(����37��7bX,F�>>��>�2Ie%#?��&�E=3Pm)e�(Y����s>�vU�88R�)^<  -F������� ���TL!ƥ�x��(���v����|��[4؀k�Af]�ѻ�,��,t"�ٛ�bl}����c���_���Ml�� (��Y�a�����O2�<�&f�m��:���_�Ã�'��F��_��=V�JI~����l��8�s�^�2��^�x�u?O�֓��hC�+M��������ې�;�N%�a����;���Ϡ�?<:Y3��k_yլPAP���i3f�"6G����i) =�7�[y����'ӽ�q�'��_
CF�~`vQ-nVa���ӌ��Kꅽ�E˖0����>ލ�YT8�xE�[�;%!�5.�������)�5ड����X٢>���=�7�������ђ+�T`P�NC����<s૖�+�{�#��/Vc�5����C�R��B�T fE`���.���ts ��q.g#�J��~��K��#:��V�#Ƞ�������*��1nFA�"�K��l`	��"#�.@od8�C�	fBlA�8�I%5��)�wm���р���j?{�ti?<�
rck\����<���B	m�~�HW�J�E`�rlZ����fx�+܏�B�h�D_����Ǝ]� ���t�4��aG�D�� 0/|揩�����zn �`b�����y�g0���Տζ�UfbL��i��
J�צ���U��[�K�K&��E��~�%��W0t3GG�5[��|�w��	+C��DI�#D���,FR<Bv�R�g]�LeF�~R��庮u�Ճ J8�����SG���66(dpNd�:6G�8P��%O���vC֌U����vA/.9����=
Y���ܱ�&���S=�`�<��c�}��=��k���%Ø�5}rӏE� :�l�4W%$���9�ٶ�� �%R�=4�E-������BC0<$J�b��~s��N�s4E2��(5��^�\/OCB��i���t}jؿ�鯕O���LdS�~�7z�E6JЯP��i��r��Sc�!+�_G�	W������Շp���e�Ś,5�'A
W��C襄hu��Л�E�o�Λ��%	��ɗ�tհ�+
#�j�u���5{�>�2��_�%;�h\
�a��0[� W`Tw}l�a��Q/��\���wb����y�� �TW��֟/C��g���#P�Ē���f��fO�|l�|v���?ɨ�m؂V�����}�0U���j$�xdS����gӣ�X��3��ä��S�)Ķ"���ı���O�����eFYE�"����@��`5�HR���a�����XD_���nQxt?�}x�Z�ԧ�V�7��]�6a�2e��d�%*(��a[�1��k����i�SL���#(F0B�5#]C{q�^(�p(�Ew��E�y'�V�������s�#βd�\�|��y����y���ؖ��|Kj����_�]rwY5\X�n~ݷ�esS�qƜ��\�t�	뿑h���������F�\�݁�،�e�꧰�q��7���|8s�.'�OH!?F���R�4S!S5YkȦE��!_�4f;k�f3��",�t����,�z�{�i΀�
ɖr����nR0�]���8�
1�E0"SÝ�F��6��+�9`0��{���vP)�0-�p�w��^��7�J�e��w��b�a>`���n<��c��}���[�ah=�3��[�`+����Y�B��]�#t%?	�ӉJ���J�֓-��}U�8J*d�3-ߖn�MrgJAk |A� �o�D/��p�3*�>U�Zxs������BT'u@���>�h�LAT�=�HÁ����1P0YQ�dո���P���-�����J
߉�#+�g��S����:i��1v|� �C���KS�����B��3�V@/0��hÁg#���֜�dRGa�y&5L��Y�os/X� dD�$v�#����]���f�-}{�f;���#u�ј�:N�-�I�,P�����;*�,NV������Lᄶ�S���A�b�iN�u�(� #�2�%ݭlB}_d� Lc����1a�ik�Z�B��ҹ_����٫����w�).)��5�f��wʠ�r�ǣX��w�bW��/,4Y��,d��n�"s�������є��ܪ��o �WT�h��ZB(�\�y.&�R��J�.g�'��Y
�i���`O���Wk]eb�](�,�C�*_���m�*���R�Y(9��	�^�H��r��~�i��v� sJ�`w\e��}�d�/eo ~�����yW�oK9čЛ[�뚍�ό\���L�/B�FL^����r����l�A���_ߕ�-��AŽ���6���f�NO��1��3�����c@鼿z�Kk�6���-X$��R���O���B�$��Y��CѶV	H���tg`Ϣ��+:�Ɩ��6���;Yf��WS���+�vT�U��&����z��#1��h-�9"��7��A���&�Q�I%������A�X��票���@>���
ؼ�����T�#�a)$��<�	�Z��`2��I[7Zjޖ���5Ov�ƪE.N&� �F��2�d�ʖE�[�<�o�v���C��7Ko�;�@�3�a1b��&�@\�(�/��H�kkk&��z0�'�g+���(WQ2�df!�2ҷ�x��W+��~���0S�v^��YL�)�~ˬ����0,�W[���?�����`Â��g��T���2�(�#X�����wI�����	z@4���O�Q[m�k.z�_�=ϸW�vw&��6��ؐ:���S�#{�X-=(ɰ�r��;�����~1
P�)�JHg?������h�k��*㳺��u?��� g��L4\V�ʱ��^KU��?<lآW�>{p�	EUr!���e*>�mkc8(6������_�4�J��BѶ;�*�q ���5ƂSϷ!P��*Ē(pj>"�L2���mB�C�ahi�Ƴ���D���S����r[ucE%l��ކ�lO�u��uTт�B���A��JG��gb�p�^ C)8����K\װ���5���G�n��aͨF>��K ��Qf_����m +� ��Zm4H�[ԛ�r�EQ�}��x�LCr����Ǵ�#�}s9�8~�U���FF�_�Uq����M�H�����)��S2���>�^�h�6�<Y&�� 	͍��cl&�v?��^9��P��I�G+.J�F�֏��yL8M�^����+Y*�:N��{
��_�;�:�
�j�fc�,�:7b�¿i� 6�e�ud#�B�UzlDZ"l��k�W�c��,���oZ~�"dqz�s$�3���m�Knͩ�!��]��&[���^�i���J�����Ν�b��)g(���m��+�!($-*rB�~���-��688�.т��$�3��EjEo�C;eR���I���F���n�A��|��x���������k��leO'�z�o.�J����Dc8�VNڕ��G��D��|Z�͂��z+�c�}�{�Z4�r5PR��g�4��5�8?�G��ws�]i��\��g�7>l�O��:9{-T7cLU`���ʜ;�����kp��� �.�7_&41O�A*����&�T"�H����u��!�(����	�䭮�4׊�fӍb|��t���*R���?s::�l^ׅ�ZL�1ca��[��B4{��i/�-��H�[���΀d8����G��5��>X�B<�@��&�m~��	8v���̃|8�s�0^�\��Z�?|��o�e��Ý��ɀ�ŕ�{����7^:f���t�{�m�a8MZb����掘Ʒ��<�!燤<�w.�'>Lx��Q-吖��@��'�k���v�.>����5��~y6�>�e�d�F�~bldD�|��`K|�s�s�ZFt��߸�h{?O�K~I!�>y�N*e�4�^O|U�����e,c�j%��^L���A.�-��챎k�lV��" ɇ�Z�Z��t�uJ�0�(��+9Q6����޾�j;١g�3��!����f�� ��3�{�e5����|�FX
h��X)}�` /�:ͧĖ@,Y�,��S��h s5A�1�E�n�o	�"��n����4B����I��d��B��[�Q	�ٳ��"�P��\ZX<2r��q{�������&[�b����J����55�L�U�^�>՞�d�|�4<�Rf��m��K"�q��{=BA��JeYd�.��V.L�c����;}���3ҏ�"�\j�_l1���f��q�Y�J�N
C��g�ޣ��*m�M*"O��0�Ϡ�=�W-�o>�)W���O�NC@:ٛA�Y`� <s�^U�s�7�h������\�%�����牿o�f[����~ h�)�(�k�h	�U@c)���u�L�z��mڅ�<X�W!&Y�e:���l�i�l�6f��?���7 XX��u���*%�`�T��6+)Sӽ����8�*��$S�*���U�g57��˔J��v.��7��dኊr�{ƨ_kw��k#�eS�K��fуЅ�`�_��
Hnۧ��$�BB�:$��m������w���G��V���t��u�4�J���#9�G����:��JK���[�G��@hz+����r�1�6d������I#B�<e�zH���*��!e�i
K�1Jɵϙ4�Ksΐ��xq;Fo�}�\F��
{	�v,#���:T��S4���U�������u~E23�5�[@JU�c�eyX3{�d��7�F~�N��Q�^YK��-����X��������4�uM�a7/����U-��FXJ�}�6VeD����ķ���K�!���U�ރ'�#rl�q��i��`sӶX�(�j�������L�z����x�X�="�F)�Z\Z�R���ꭙ i:o<��}��U,W�:
��Fw+�$vk|����@����z۔���:��������/��І/^�Ee2��s%Ӄu;�t`�A��!�`e�����UO�Wol\:0��o
�خyʶq��D�����&o�/n��y��hbJv!9m�W�=�&�!=f/ug������@�9S�/a|&mj�*��dz�8���y�G�K�@
����Z��0TV3?�ES��T��✰��B�"�B&MK�ڛ�W��8u����E�_y��QK�/b�J��OD�?�"��;�
|��(<=�p�H��s��Q�k���9,bbh�0(<��;��ȅp\�9����ZC<�W䉶�Bf{{%�! ��� �-L�S�@�j���Є =�[&eY\M.V`>o��;�W���T�����q��9�u�C��\�[�R�2
�.�E3���! ��c\�v��t���O�Urn[l���.��c����I���P�K#�&f���n�Ao�5���p%�>�#�/��V�LY�	1h���E���*z	a� �֙4��k��->�On�������a��"�:D �����p����?����#��x���ȝ�ĕg�/�؛g�����]�9;�#�|g>�9�8ɂ�K��H�J_ "��Z�,���Oɜ�f�폻�
d�ّY�=�k��?��o<��;�@���:Q 	I��2G��ݬ|?���P]S�?��I�l� ���i6ޘ�]��;�2?�]�݆� %I�j�����L�5�9i�[�N�傊ԌB�kHS�z�.%�䚽���uIG>{�z����}!J�ҟ	�S07\�iB����U0pN�ZF��_��������G��.C۟�U�j����������1�4�꯹��\�����?磊x��p��D?��B�����
�A�Qu���'G`�4��=Ms"�7��E�S�VO&dږ�Y!���	�0H=z�&� }|k�Xi���q���4Rt��~�ݪ�&�i|�$LIؑ?� �VB
�#iE��R�<�w�X�^����S��;(l�C�A�5���㟷���ւ�MA���K������~-�mf�)��q�B��n�/d�j/#�:���#��;���>9���K8��x{�����y,5'��Թ]�v��£�<�����/y�Ο'J��0���h�ū7ݳ����~��~�虳r�0���9��v��y�6�1��SR�~_ k��-��z�?W�/"�қ{�bM*�
L[��y�-*maS�@%�Ln����Ŀ!W�)�]���i+ei,u�|�D�D}�«\V.(e��d�(h��;���C��3��S��/��s6q��W�G�~+�u �X#�c�2S����ˈh:}�f�r�*�Ǭ�!�6��8h�-�c֭�BG�����zx���	\����K*�(�8u_MɎ�	��*�S���ąaeG�A$��n��ζ��!�Rx:<I����Gz�@uԆ�1�tP֍�f���t�q#����k���{�3��j�l:���0]^�Ez~�"���s�;����Ɉ/a]�>�?�C~��2]�^w��A�O���|l��؋ �C��-�?��(P\yc�1I���0r,��0�O�t�c#~[N��'�WF!y����x7S���;S֊�"�L�_�u�!��멘����]dJ��Zj����ɫF�KH¬(c��n��R��)�{.�
�)��!6@DhS�~5�[RH�n�0W"�7��HZn��	���!�dK�ʕ�'�l��*��$:8Gt
c��tql�2}����?ݨSJ5=�c��(k}�����ȓM66�X4���e&�Nww�<YW=���R�(z�`ؤ+ʾ-��@�`�/U�E�H��W��u4�jb�s�QxL�mUQg����H]��S� �7L����H]�h�ӷd����?�dj̠��Ʉo�������m�4�y�(h�nj�Zhń�G�+���z�����"g���ϣc�/�S���!��%�N$�T��B�& 5��jLg�L��/XJ�
~<�<&I�����
T�~ ��qvAT�ذ����9�(�p�ޣ��w�}��MVe��gb��������������ᢍ����`o�����/R�*<�����#3�ma�h�(t	�C�tqH�n� �-������63[BEu2,/<��<�	ݛ�E�F��d�(6 8{�7�gm��ry�j�e����A�N?�=�oDu8\�s����P5�"2�M�������x<�%��9�1#�@��f�@�F�b�w��`��WB�г��Ox�.)����>�s�t�Mɍ�c�]X��=�4{�`�C��\����~47���Fy8�S��Z�2�x��K@�_�D���fEɏ�G����$��Nj*��Ot��F1�K6<l�C>.HK>�Ր
Ğ�V�S�;a�����a:<��扪j	�d�"2�(
Y��q�_�������j�E���j~�t���H�����G]Fv�������ލh=/<�-����\�39-ծ�I���mڈ��7��|���}jl1^��]�F��I�Tuv����m�4�r+]TH�N�I��Bt^�y�<IA��[m $WHp_5�:c�7�w#�u���7�t��&`�V�pN�}S�+�?_�;=1��c-�D(=N%��\��2h�>yi�J (�~����]=A���=mu�6�|��u��*`�晰�b,��]e�b�8���B�A�s�/�Xػ�"w>���u��3���o}l?�Ą��ט3���`�@Qa�"��7��>9���Q��v�bz�䯂Q�`����m딾8s��ۆrk��1�_9	�H����E�Ja^]kh����ώ.�;^�A6(�[� ���ܦ����:��O���VћwX�X�Bu,�MW:�L(@�}~	�=>m��:�+������Xco$�}#E�H����P�-f)B���0s�8��c�F'��ۭ�MYD~�}M �\E�D���]�F(����4Oe����+˶(���|x�����R�i������Y�$ȵ����3\)�y�C�4y|ωSȩ��I���s
i����3���_KDp=����q)7a�1�O�)nn���e��ʇ؍�?R�maY�:���? ��5�}s`�˾��ߵ�)>�Ɓ��j�4�7�a9I���n�'���h��N�Z��'��bB���\X��+��/�2:jB^삃9S�]��*�a�"pi0�נhƟ]"��r/�1�61�g��0��������9*T|N�6XO!z�&x��c:�oG����FN�`3������c�B�7?�W���E�p{9�m�`�1T(I��}�x�Ah~�>F�j&L�G��EN q�M�����6��<��4���7AY�]懩Z��E����R�U��P��.L9Zt��OP�3�ċ�i���l�� L��%�ԟ�$|c1ʱ��%HXu����%a��C��Xҝ�A���{S�?޹}k��p֛]k�˄���l�0-sY��1�/ c������7�ѧ�5�H7��6fW&c� R:�X��j&�<�Hc�k�=;�&ᢆ<��[)�,��&���\Pןʢb��ㅣ�qxIf{��bm"q�Kǀ�T�?�I�0m��jK\E�p}=�K�*N��n} �uZpj�.�v�Q�v�#��5�e2�/�<��?Y��5}D�e��|qB��F�6:R�@��\�5O�?���[X,�u�eī�Zv:��*�k˹�S4�	�dl�ዔn�|ɔ��/Z**6��$�	C�lt=���<dz��ɥ�Om��0��"�ld�\h�3_=OM��2��`�XS�Ku"�GЇ2}�MNvS����X��~C^�N90����+�T`�M؎����H@���YmLL�+.K4�.��;F'�̭��D���W�7wI��J��P!�G�m�!�5=VL��ZV�����S-���7���C0��_�[��� !5
)0u>&:JQ�X�˨�K�hDL�-�N;��R{�vҜ�$=��ƨ8+�.����o���|�(eF��QyO>��w�����~uF����ΦI.~����خI��V-�(F�B#�.g<>����Z�K�5������HƱ+������z���>\����D���7M��zQ�{��'A���T�/���d���$�)��(��S��z5���H�����0{z�:b��8c�R����0~���x9��{�t$�����kv\�����ݝ���e�T9�X*>�`x�dY�h��M��d9."��jq�~�Z�Ӓ�`�}+�H��h��V�(2Н&m�,���3V��f	u"�}fĐ;&��r0KO�)_���$��v�Z�$Pe�LuzEw�-�&�_ԝ�� �
v����r��s�?��+C.F��f}EN�8�㕏z;kj�\Z�h����m����>F-;M�!$[B�1��.��CC4fL����	�X���N��q�M�C���M�+�Z��*N	��s��WH�_�C����!v�Xg��T��%��&&68�6�(���x�� >�ߤ��QT�-��E�CE�ȩ�b1o��U(�b3��©ܮ'H� y#��T�vpN�B}1U�=��:/ԕ�B�9%'��}7� �=���/^��.�3s�` ��å���Z������0v,<���y���V׊kVL�>�`2�E�mn ��G�:V�U�.���f?����-L��S�k���7q.��J��U�h(XP��;�6Q�Ӹs�x�wyr^n|�2i
���D��F{�mc�Moa3M�b�]c����9���@ �D��>����ֱ~�2�d�{��VO�<�v�9�qC]#7c�9�/�@D]m����-p��ܝ�M�E5���}]#���k�^g��z�a�>GO9�[B��N+N}���}S�R3G$YZ��������Sگ2�U�0l�h@p���23�`䴪�k
������!����'Y�@цb���P��i�7��[�"(�%���;Ȉt��z��n�Q4'�%���H~<2�)��J#�5�ZJB�p=��c�J�-i��}�ܗ�MQm�є<��������^Y�B��L� ���t hjpub�05g���%|O
$$Q�g������.��Z���<W+�d;��.9�������z�Yƀ_,$\D�����'���XQ܇l�lkJ_�\SZ��G�$��j0�`��_��z��2��C�z�l�m��p��e����E���;�R�Fũ	0�0�p��[�q�ce�	�]f�TG ��.������/=SMA6��~<��ی6�_�O��E)�	t���㿯�%�/*�?n�9K��D���Hu:��&R"�滣�5���6�'5��&�'j��u��3��K�$�8 L���N��η���-�t[����S��i��t�WXQ�SZJ/GW���Uc�Lʏӝ\š�B��-�0/|�c��o_ށd��ϑ9W�J���YƵ�ӽ����{.Z�VM�C6��Wm,_����׊�:��i���IƝU���ރ+?a�8&�ޛvb*���`�M���sC8]�y� ]3�ɩl�7��b�!��-a���}�%�[�D�W��C:@b�,�򢸁�kdJԃ�]-ş�CH�b�/��d��Bt�.Y1����g2��V!BA�n��" ���s2n��FH�l�I���*��;���,�Yc�b�A��s�123\2��KbH nh&{M���2��eF��ܢ9Q�/܄�-t�Xq��B���.�x�ߠc&5�L����j@H+>�v�����U/L�Y�g��SUQ���k�{�Ǵ8�6�Vr��J��~�=1:��8fV��������+�-�ǒ�؈��9��SCU��uٔ�mR<ɲ��#Q@~)U�햼������3��C� L�䔰@�UB+���(��ޮiC���ڗ�bP+>���� ��n���X�7uUs!��D�| C@؈�y��ș�b��<���Onjǈ}V�P
����UrQD閗��آb�����'��î&`��qr����u��zWg��n��r��~�'mw�Y۲r9ͣ/9|�~G<Z�%Yω�`�1p��3mz:�f�s�**U�D֎H��M�0?�k����p�8@�L2���j$�7�nd���w!����ofqk��O�	����(�G�����D�s�ގ�1�gX_���(��rH�n��D7b@'��;��2�����o�%��h���&���U���<�dqJ�X�5� ������}�����1�x��Z��K��D2�S�,;W���������%�pi��I��6��F���`��&4�CP��`�}�o,�9��P�!�`({��PQ8�	�:n)Ͼm���X���NIɀ���ؿ:���NOCrR6��z�Y�3�D�)����e�y;�^V��?�s%(xj�{��Y�����i���#�g'"��
�V�]�i֪�%*��W�"�����9K���OK�)r�0�t������溃#+�'3�oLG �W��[�����e��0Q�:"�V���N�!$�E6�Px)�]��_��t��,�F���YQ;?��L���c+ޜ�3_����:�����.�8�nKy������v��AN6S]U�����|�
G{��� Y�ie;Y�z�8��#�j��֓�h��x�Z�㐘R������|^�m~7��5��W�.G��C%c�`���B�(�4�":��"K�z��&����nl&�eДsߠ6|��&�o��8#��"腃!�?%�q!ޔv6����g��Nt1j�)�Y���̇����X���\͜���; �w�ҟ�:Y�3}�A�CT��0i��w�����2�	l�X��ue��;���l��d��B�&bIv,�O�Ʈ�]��c�:I���Q�c-��%΃�?⟥�)EQ�j�1���Z�T*���?0\��5g��������(f��;B��3_/��t�!I4,��@���oi��V��}9&��t��1[4}������ԇd�8��Hc�D@�G!6L�tu�W8S!�F?^������&�]�ǗHj6���$/�X����ff1��S`�� | �,j�Uٱ���Q9%���M���,�@"S�Np�2I��~�-��c�7��A�F�y�`�3U{�g;�ge60���6\^�o��c�0�+��U�I�<��]w��	��2�W���<��9���~��&�۹X	_�~I��	j>(M�ꑌ�W�kM��V�W�?*ʞ\(؁Zu��䁋�����¯xpM�C��c�M����8g���P3���5�Y���Y�2�����[�fkB�����3��JPXb�I#D;���[*φQZ���KR�H����Cl� ���1e���'�ܩu�qxn��(�&��ϻD������d�]]�	N�-�w�7l�}�5K���s���(�_���=~zʁoii�!�L����ڝ����$�Qn@� �x��V���YKGcS�Ԯ�O~�I�O����͘���u� $ph�dً<n�Ej��W�hD�H�w�Mё�]�:��T�$lG{��EOh�@B/���Q�Sk�`:�&~��ؖ�BKp�pxBc��f��җIpX�]v�٫u�f�G#��I,&!M�婻J�4z7Iǎ��6��֎@�o:���!���*RK�v��I6m}���W4�sԭVKIB8���T�|k����XXxvrC�;�n[��#��{N
���}�G�h�3��MIDk.H���"��ED�LD�+�;��Xe(�C(��Y���wґ8� &`��"P0KX�+�*9����2y��
M���ɸ��r#��߹�Q@J$��d]���.������;�I�J������v?�;�	N���Ut��"��!>d���Դ(��@�Sy�?oK�:�֙ʐ�g�Y��Ʒ��{J��'tv:$#�5_W�B:���ϖ���%%Q�)!�l���	�>�����EK��C���e7���F���հz�j\�9Ҋ�~�Z-�3:i�e��$�c������3���j�����^�~�bp�R�y���2���2��뱭1usu&���k �!��*$N��K. ��,�Op!H5B��
���;�~��BA��5�~ȱW�G��5p1R�0���Չ�p�B�@���/qlR��UZ#���ݬ�i{�A�*r)2�QX2af�P^Na�9�ϒ��gս��~�%��u�������
�#ji�&�o��Z��bs�^-��]+(YZUOr��U�^u��h{)�����JД��:�"w.��
Ua�zD?�ҿ�/,Js�;p��zvۢ��?*�}�:���=�k���M��x�I�I>�!n@F��m�b�b����Be3W��({��A3B	?8��Tj����ڹg��x0a�-��t[�C�J��h�7gϹ�C��"d L�+M]�swI!GE�é�?8R�j����JqW_Um{���#�8�����9��l12G8]�$��,b~a� u�
�{��֦�Ȱ�Q�h~���4��L����7�g�?}��lg*�_Zu�1f�s�ߵ8�� ��e9���`c���*��K�4'+�����۠�4x��R�ŗ�,���UkV��!zL�L��}���=#�J�$�Z��sFq�j��b/�c�H/	%M5�j��-�PkA0���w"�7M��5����Zv�ύz���sy(z�o@��aA�ufD{F�����c5��`�[h�؟�������BW��!"~{���+�&�zj)�5u�w���cZ�.I��V��NZ�"��-��"t��h�[��A��Ȼ9��8��-.4����JL��Ɋ�'q�ޯX�J�o�����2%ɰ��m~�\L(�-f���~�RG�z`_�g������ �D6�Z���,���cC�� m���ry������w+۳�a�ں�>8O�5��to�w�N˙�L.$#��rيG���kg���>�L_�ÿ6A�j��S]B�<D,��,h��l�
�l�D����]-<���g���8�v�cѻ2�
��D���;��B�~Pl��H��=��D����.Dy�*0���rZKc�݂ʘ!�l|�;3��Z���s�g2^(ل�C���q�kƝ#�l�M3��j���k���$�7���������XTtx��4#�5	���C[%|��=J>n[�A��VƖz��&Z�_c��#��Ѹ�l՗SV�Y~�6��4�RAa�:JW��;�4�ԃö��!�� =7�#>)�ȁ�j_�`�h���bۂ�	�b-�bZw�?��&X���rmU�( ��V��ir�4{G@�����A��et�I�������x)�:/�rv��w�{I���Ҵ��~���{2�w�#��I�ߡ!���h3J�=��[�`[�`yE�Ǣ0=���I[M/(o.$F��=m��1s�g Epm鬌=���bI*+�,�2�7nc,���}�
������p@����C���Zg�{�
x��턉�7>��ݑ?2��.Xy���J-�p�����H�

z��TC���Zr�ѭ2~��^��G,2������Un������7����8l� ��Z6�OA��r���o�GMgWH���ד�B�����8/N����`!p9P�Cn��Ϙ���U�}ˆ-n@8r%!6��\c�ɿ({�	a;���ױ���V���d�Z|���_����9��������{�l2����+P'�)O	5т�L�q�[�T5vh���V����5�g/֣� �N�����1�A,�O>ӻ!xG0�Dl�A�My	:��w$aӜB�f���<fA�� Ti����~*�"�Ch�^yt���#����)_. ��x �r05����W��X�� ����X�����(v�k��?>�S���o�*M��	;z�R�����i�c),�e�X�v���	ӛ����i[����ʯB
+����"����V��ZQWJ\��W���7p���f�Dё&�>�xM�k���x
�9��3�P�o�5���1l�h<�0_���D�����D�CИ�$����\P��
@��1�N|���w���߰�MO�&��f@��_ri�1�/�FG_0;zA �<q�&�e��C��u1�(GaP6���hl�ʄ\���V�:J�]�䈫�{hE�g��fl�vP��F����)i
8��׵�~��yDE�NGW"vυ�Q������m�/�����bT��r�ߧ�;/eOGe�'��t�}u�Bޔ���A(�+�������<�!�)�:�OB�n7[Z�2T�����7 �S�9��YLUFS:e8�,)�T?�],�M��J2�M�q����3����j�݄�X����ĜS�Z(M�r��:S�a$y��^Jq5 ����_���2j�kᣖU��wVdwo)>g��-�U ��Xa��al���vd�֊R�h�!���&\}����Mb�+Ɉ��9�D�R�S�=�c<��]�v6�rt�x�g�I6�[�b���;īJϳ����9yݛx#��5��1�T��^��w�c��ܼ�ʺ������� VG��t�I��x�s���׬t�A�K�B��V\і�mu�<��#zTd�����.�����gV��49�Wb/�3�B��#u�:C�P�x���m�U H��l�\i�����j��d�v�7�Hv��\���U��� R�&l"�-�j��
O� 9P�
8I'�އ��F���8*��Y��h�$p&�>��3��s�c��b\�Z@l}�#t��?����8���ߦ��#v=+4�z&j�>� �1=�t&G6���B���^\�m�"�KNC.�#d���a�8r�p�'��#�|^���;7P��=h�}�C��o�UZZU�_��{zj�Xa2�r��8�%�'1'�^_h�Aߪb}M�J��9�y�BGĶV�_�f���e�Sf�/��1��Bk�����C	f�� �v��˻-���Ъk_��=IԆkHg�zi��E������������R=y�1�Y��C�p$`Ӽ��W�%�Y���R*��q]\5����"+�y�~���u���Q�x��5����_�Kv���g��V�V�X[EP�>3-ZBO�b����[�P4+�Ln�53�w�[���	!_�\n��3do$՚��}�z��G�WPre��}��Uc��V�~d	�	�J����)�W�P�<!�d1��3�T�u���5N׊�y��:�?��o�$��[,y����F���F,�D�@sԘ�[�CK�ڸ��-\O��W�����ijwl�Ƚ����(sƫ��5P��a\���i�t��4�r�_��>���sӃ�
���58C��)|�wU[�%�a'��^���-�))�>>|���ȇ���m'A.�0�oM�ࡡ���I�� ����!��j�i�X�G4I1���lq�Y�,�8\ ЩV��{�����y���<s"^.�F�V�.远eN4���#�Qx@��y=���tv�b��S�q��{��;D���aDﺤ�}v��]0���x����_
�0`$�Z��)/�|��l�[��ŻN�(@?9�&1�V-&$��t�Lg���B�C��lrg�Ji��W@z��3�P�����-E�ˬ�y��[%:��Ԛ�̂��O؂�n_J`�������=�Q���i򒸿��Fc~`<�����1�����\y�-�_i�C��4��@	���c�=�{�$��+js�Fo|�4�T���fz�U������ހ�H�!��],*/�b�%-�w�O�H�ޥ{��d��!x��:.��F�%u���F)��?�WOj.�Ԅ��ጫw$u3�m�w�'y��c�v9P[� �Q�I��H�;�<)pƵ���}�Pcg�V���i����&��/��-��_����?�e��H�� ��E)߁ŕaѯ=7�/�@���MA�Z�;aZ�e$��/UT77��9�Hy�W�o���y7f��� ������4�ie���@�!N�n���s�r���
R��{p�)(��(~������׈p%Ņ��	P���AY�Z�%����˞Q��b���9I�\�䕗��Ym$�K�*�����$��bH@E���|;kR���Xz@�<z7y.����j�U��ڳ�q'U��;'��:�د�Z9����yF����������:�"�2�'���C�\¾q�2�e�����Q�vo�i~�M�/�����E����S��Q4���S��ןW��9�x|]]�09_���y|�.�}�}[��������pe������X���,I1��6�����M�zi���%�|�j�?����D.O���Wdw�������!jֵGm|�B��pBG��3_��{>�� +Ε� N�D���r0"&��T&!\p��"LsGh	�>�U$�<!3@K���⢲˥��ڰ��N�w�U:Ŭ\��hg��g>�!�-m�udLfd"D���{p���n�Q��R��a�TW���T�7N���6��U�!�)��)�G���t��@9��Ս�v�^���a%ѓCb�"�W�_���X<�H�6T�C]'gn�OӚiH�I�WmY1"�����X2�G�.��8���W�}9������űA�A��U��TU�������z�8��������$�0vqe��2IA3���+Z�7X�t� �F�!���,���i���|Sz]k���E�WA_� 
��dI��D���,�Z$/n��h�����F	��%��[[?g�{��ȯBVr�cv�y�ܑ��b�8��X�#�����������
�83�]=C�o��˺s�����Ӱ�S!V��[Z�5����\</����\j�Fx��p�'�Lc��o��ɫ0���8o(�:Xi��؆�#���/�iγ�&�P~D!3��ę��$����i H�==*l��"�9S�H�t7,��\'���b^{eI{�����4:�IoQ��M��w.�)�t��b�ȍ�^?�X,��.�{�{�O"Cu�L�P�΀��������@�H�[uN�>��L�i���o����|;����Jn#�e�J=v�� �Dp�*Aa�VO>�}&s#�����T�Z�.i���>�YYe��� �u���H������<���.���\��+S�q��2|5��B�cS�:�P�\��3�A{X���OI�MO�G�Y���Ź�`;]�ȟ&�����`P���:�v�2����_��~ց��IN=핯��#�+/og����Õ��d��B�|�*�E�`c-�b�F��S����~���W?bac2<�RP��4�S���d`��ǡT򸪿i���R�[�D;>h �����w���6��W��ڎ17	�p�"o	<�ӧ�Oj�3GN��l���0�ƨ�yuh]��#6���%���H#�֪��Ѭ����};�?_"���Y�h�w���s/���n&D[�n�$715���Te�����6C��
y(лZ�|��G�fF&��^�lV�i�_�;����Q�m:Y�W�:����)��g�P��f���e�@0?G�����2����j�]�D�:6�����	<�\�و��V�(�c�X�����!��M�	� KH�uB�]qM�#4p�"��	�@H�蔓^A��X�����i��{���`2�0Q�E��TF�ἀe:�᥻��b��� L1�)Rr��	�ݻh�#�<��1{t�Zt�t�l�I��9^-v 3�����f�_���0cb�{\xGkb����!\&�z�o��T�FUu"�rJ��]�/c
���7�/̐�מ�Aѷ��i0�S�}s�P��T�p2�3�ήяGZ3�gxb�,r��e/E;M���&���xY���_��!�v��OwD!��t%�eqN�rc7���BFk(PP���7b�~p\%����֤L`����y�/B"�C�HRy�a��ԇ�2r�1�f��Irɷ6$��{t�$l���B�ŏ᛾�^�U$�Ñ����Nm��B���h��po�RKE܆k�5�OZN�����c��#�^��8�Ȇ7lQ.������1�@��3r� �X�"v�S-e3�ղ���б���S����~R8�h�O�X�W�w���;�j�-���nGʶ�7�,Bi�	K��j+�NT�4����ڳ~r�q���씬#'Y?�D)1�ZEf��9率z�Q�ґ�Ҡ�����������!>4��S~@���d����Я
����_H�*S�����,��N��q�MB2�Tݚ���B�Unᦆ�3m��!�`����Or\w�J��缡ne� ���ʡ5*[X ��<%�y|ߴ�`U�)����,����3�,9pY�6�.��0V�*���v�/��p/���*4�&������Q�t{R*y6ɑ��Z��鈃�z�\���ԭ}�/ic.���������L��KH�8�xoJc�}����Id�	�sP&���%��94�`P˷�b�ܶw-&���G~XI,�j��>6ͥ�8Sпom��8JЭn�BF��4��;`���V>���̔���!�m�4��?�[��J���~&s+tJ[���ƽ^ڸ4ua�c/�����&��w�?��`�"��|����mt
'2|�E�1�����۱���ň��NE4��
@AxKΣ`Qm�#��Wj]k����D��65�i��?t�9H/����v��U����R��+��άlB��O��A���L-ΠD,�x@��5ԃ�尙��&�aaz�&�f�~ͷB͆����qU���)zEʤ]^�腁����y�#?Ҍ\�}�c�b
�E��/�6�k$<�K�\�ձ� !�ҒQ�.�P��-�+K�?:R�ط��w,��i=_>Ɓ/ub��U��q8�TY�GB�t�sC{l����џ�+o�,^�!ԭ��Y�|�4��u�,�5����y�'+�mZY��|3���v�e뮶�.2=�-��J��e�;��l*5�ZG�Ȭ���Hb������}T�����ٌ,#�ag��F���w�g����K+���RL�1���31_����PC�����E2�[US�j��G����P��-�%���ܴ,'�)46��r�f_ �q�z�N� a�)��*T��iUZ�&�G|�K^�p}�WJ<��c��f&f��~F�Iv#��hl���]_���bu��&\��J.w�f2I��N�ı��#_.io;'��Y{�s�K�g<P#��Tbvx��
�s'�� C�љ>���׬c�����`R�<*�r��e��Ly#	*>�v3�O��'h�iĩL��
�&���;�Vv`����|1O~���x�x!C*4�X�t���J�����?��.&%g�ywS=p��Ӡ��mWF�+ &�	c�jhIM����0�38�?h`�:D��y��g����f�q���Y9㱑Z������X��7.Z��Z�d5q��k=��0t�9O~�E�.90��ڤ��L��ԭS��_����d
2���d�����*g��TF�0� 㠦�U�fk���7�>^�g�-<�q��.�;�L�FP~o�O�z�:��aZo* ~rgP�w�bއ�~}x���{G�{9�:_6)�z�3�v�lr;���1Ц!J?�P�,�ۀM��4^�_+ؘ'#����'�2S������:q����a#h��c�e�f��%���N��dn,����Kl��o���6�!lS[m(�d1��� F� Zt}��L6�n��^�D���,9OT�� �v��	 ���Ylr�d�b@��E�TG"�m����Q�ɳ��l��8V�6�l:;������W�6���\_�����7ˀu?��B櫣��=�nI�g2�zMC��*�����)!�-N�@&gVY��_Ԛ{H��Os�1�C�v���q�+����8:%�32{
�6���#<l��@y�������~���V"�Y��6����/,R��U�NUݞE��B�W���]j%%�V�k�j��FC)�ayRj���ä0��}S��4.E��X�aH�_�s�RNy�����V0PRX�3��s4���X�yA�Uw^�|�c�R�_����( �_����|	G 2h5�	{�#3!ADC�z7L��}k0�xx8�[ B�v;�A�O.��9���[g���'�����ó)�?꺟�D
�v�Gz�u�O�S3QV��6�����/�U��Y�!���_��U���q�=�y���7�C��Ć24t���rl&�X&=Q!Z��	��@Z7u=	Q~��랃���^iQX?pgF������TE%�n�����
8v�b����<�ŝ��d�M~�k`�c�^ m��s�.Mw�g;���-7q���h��	M?�?�T�^��d�>���%?JN4��[��u�v�L���{�0�٭IIb�Ķ��yrD0�7�g�P�	��Q��u��J�c9�4'`�ۨZ}��Ss��=����f��S�<�)c�?,Ȑ^{��2�'��G��?E	�?�q}�,5D������#C�����F@x9/@܌<%L.3�I���׻( �6������F)3~v9� ���k�!�qφY����(vT�u͖�Z8���R�<��xs�_��T�D����s�s� _�"��iy�X���VLBs������W��#���JiYm��Q�c�T%<�^p�B�w�I"�j�C6j��qupY�[.^��d+ �������qC�FÛ� D9��dG�����wu��5r�ݝY�A���<��h�9Ax�����P5ޝ,O)eц�|��t��ȝY��2{٫/w�a��f#�����	���.1�����<��؜��5���y�fd�m�[��vֆr���h�Y���4_�}��-G9:��F�.j��2��fοW�3��������q�mptMb�L[h{A�z������Bd=�H4��<ꉢm �G�â6,��n@�.{h����?�S)��v���� z&%2m��8��",��D���;�`��y9�*��[�_U�ɫP7ռ�v�>�fz��k���cR,}�ݑ�3��}ΧA�Z�I ��9��f�''*@�Y�ї��Yj�CK���	(� ъb�&��)a��Y����"ft�Wݱ*��Bo>�a�=<�GgP�܇~�=���Щ ��h�ȿ��1���'ym�I(���<4G�Av���[�&�jY�Qo�y� �AA��W؇�7|&@p��@~67���8k���؛���T�}�*��I~d]Ln���hfs &�{�\}�.�r�vR=dv��P�~4�́��Q�I��"~۸������7)Ԭ�B��ߺ�����t�4�刋+���NP�e[a�6�x�;�b��E�aV�g�_����T��е�C��. ׊���}���F"�f�iE�����]��7���O�������iD�������iN��؋��e1���m��C�"*U+.�Q��6���Q��Vp��E�pr���f��� �x;{�#]	Z���2�.�.��x ���u��V���3��$_�l��m�F��~��|�n
j>-E!$�A�ӻ�J}qu]A��5���u��a�Bn�ʉ���1{ˮ&D�A�����uó���9�S��U�`.������!�.ȿ��Q���'�M$�B0��/��V�7u^fT�Gp��򌵽�5un���V$*���<y��(Pc�xGF����5��	��ov��D���b'i�.��#� ��ػ�3�>�+Kh/$�NzvA��~�@��M^@��M���FP���a>Y岑�*�=���O-ȡ�n��ć�e1lЍ.x,�&����|��$pjiՐ[��!���%'+��OE�b�U-l�*'h�@_�n#Ayp
2�4;5W�}�x�=R����ya��4]�ʿ]O�9̅���w[� ��A���Q?Ys�����CN[5�87�A�mn<	�I�L(C��X'ƻmv�W�k4o����>od�_訖\C7�b�}F����^ ���b4��-���G���Z�3ј�k&�Uf��B�
�t{kD;.�3\#����ю�|oa"�F=CO�S�������M�~�ӂ�i�sXĞ��� ���$]KIP�z<�ʙ��E��F�!i�ZYU!�M���Uۿ�%^�i�����L	��D��"E��T��;PЍў�tm4���y,i[>���؛����@]F��`$���)&��*�@�UY��q��C�+Ax΀9;��M�z�$q�t�A(J��v/}V@N+�������_�N�-�ch�Z?�lt��%e���j�Wdڐen�>��2����oO�Z[B2]�:-i��4�)6៉Qg��J�x�<�V$�9�:xv�2�K�~��]��'U��Y��(��p�l��'e�م�i�%���O�-��8��TNZ;6�M��!��?΁�[X	�dGp��h o�JS|˹��S�J���=6KO��'��<� ��2�?���yG�5|���fX/:�.�س`%)�*�Aɻ��N���'��Y �oQr�� G���&*=K	���_�R=�����΋L��
�������y���l܈D&��>dF��r*3AA`*��J0�	�e���W�?_S�5�Α�DE��,�o�޸�-��A�2�ۮl�-J~eY��J���Ϳd؋�f,�W�kF�-gt{��Vp#ʳ��9��V���\*?�Y���(� �CD��P�C$P��O��̲'tP�N�P��t�#!T�{�ʉ�����'�0@���b+�@ �BW��w�o�rp�j���	�߾� ��3��כ��_���`�n�&IX�4`�����h���#�1+����
��G9LRL.QM���+VSH2bg�AU_@ v�W5JT�ꥮA
��)e`k����W�f$��*���a��鹱z�Vs�e���:����e��!hd ��بQ$m9����jM� S�$��\F���Lk!x�^w��E�eM��F1\r{������������Qy)�u�'#�I?(ۂ�����ٲ�]�t��;7�S�*H��肈��1a�IP��Q(&�.B�h Q�Δ1�-����d0,������	�7
4�
z��֦oz7�aA���R+ΐ��lx�[?���]ch��;�e�p�g�hĀf�;w�Ő.i>K���B�S~��V��hh`�4ιR��w�v.��Gt�x�w>��=C4`ҹ.�L)��믅i �uG�:H�*�i��|��WԷ@vt�G�7�sa�~ȗ��|�~I���#(�<3��t�m�^*(|��Ѷ�]h�{"l��Z���-���oQ�(�>��]))��|Nfę���=��_5HĻ1�X`�y8��G���:��*��h@��?(e��Û�d�AN�u��Wm��4X��(.\���*�ҍs������6|�����o%�腱���(�����&�((��݀-���M�+�آ&$5�����]j6D�N�F�z���&E+tl��x���y��M��CP�u�����Ò��Ow)~~�n�E����9��/����$g¤ɦH��=���^1��t#R��̂�^@SBdǘ3��$t��n���(�=[L�-<c��P>��[ws�@�A��n��
3	F5Q��k0i�/;#�9$��{V���?<�Wg9e^}�Z����L5�?`�\���O�]��zw���--M:Y�u�~3y|��ⲧ�]SC�(-�p�B!4^���^ {[:,����U- �>�B�G/�G��\m��ˇVpf�wǞ�M���cq;Jb�gl�z���� Tz���Č0�oYH��iy�����%jX�f�-�f�v!:bZ�J�.��?N'�����݄<֊���\�KZ'\;˔D-V!��| X�	�[��(��"��\��M2��>д���_LͺJ���0��2ٌ�dy�`65��ț��\�/��q���٫A�_@n�
"L�����fg)�-Z���9�.u��w��ϫ��U�K��!�p��@�VX8�1Q��wV~AǗے�93��P�z~�y��7R���-?�L��
d��@��[���΁>Pf�l��SÕRm���X�j��ѳ]>#s�;�PN������ա�����k5�.6c��
�7�ݪ��ubGH�k��:��S2.:�`ʈ[h�l����'z<�,�TUw!�a��s�QZ6*,�Zp[����c!�~����G*~x5�t���˫<�L3����m-)])�Ъ��~���6�Wl`A���e���{�s�"�|��-��[Y�����M�qS$kyv�`M�F�m`�ԅN����K[��%U��R�:�h���*6�,�+ƓjR=ٻG������k��BRIs�5�a�!�}��P�_X�?@5����\L���� ������xnS��:U\�ܡG#���YعW,x�k�ddM���x柎���E0p�w����i9CN:�gqQ��rh%}�;^��ϪC�R���/
_��C�����Q�t��M\�=�}�	ѻB2��8�mK-gܬ��9���r�jht�M:&>Nߩ}3i�J��Om�d�_8�c[�bO����z�q-�.璝�'�<qLg�����1��>,lS �p�X��~X!�y���gOs�/C��k��#D��G�����P]��jn�&�8K��tD�T�ڠ/TW�X��,-u��� p���h��fc�wq�����Y�|���'�C��:��t+z�(�Z]���zTF2�4�x�5�'�U$��R�����	�����R�D���i惖��Gjb��U��!V�������{tN������eo~L@�űGw��-�r/E�Ӌ~"i����5���D��2?�����=G�HЉ��?f�[i^�>�o݊��7O�8�����^��A��� �������G�熴Ҕ��u�۳5�.i_�u�|�m�N��A�С�.�7^��e���}�?6�������TC��l�Q�obǱDhC� /zHm���Z���ٝ�Uq��J�;nt��~�s��k��)-�X��~��}]��O`���+�$u�-�؀�&��
>��[0���Ib���#���u�����F��N�|ll�ׯ�D0�A�"�<I�Zm�1r��[����U�Nr�Ԫ$k��5&;w���.?y�4���PN��īz�;�E���"Ԋ"��`_��	覑%���m����?�M`�-�n"���Ͷ�'c����q�r��zcg���
8:���rM: �C)�F��f��UO�H+��	5SǢ�z���P7��_��\eD�I��`��ǏŤ��w��KByn2�%��p���u��4��T�i����O�O�퓫����I��Ror^��J�pq�"�/��kbq�YX�	�U-#ͷ�ֲ�`�I0oe2q�`�B�\�||2�DA�Ņ���L�,�#A�^���G	�^,Bj��$�*������Y�=�A���%T��4�кI����b�6Ⱥ�v`�4��ڈ�0����,��7�Z��i�����:q��A��g@V��kQ�H�z����<s/n�G6ʺ�M��!��
*J?���r9�3r�P��(;���["[�j��p�Z Ԋ,B2���(I���<����/���]�3�r8Z�@�G�2�k^�8�T�Xqa�8J�q���枍5R0#�5�G8�EY�q��X��\65��5D~;��V�� i� �-F=3�����b�]2#Τjh�DjR1kɸ���] r��}�8��r�{����ru
+��1+�\ϙ�k��GK�6B���iD!�#��\�8�������v��ƌ���~��T=S���*�+��	:H�1�.�7"�~�1��-��>,���@��0є��B��
E.l���t���hR~�J�(�a hls�ж�e��_f`c�PC3l�bjM�vH�*^���?<�TFem��+���H�C�5���i�?d�@�ؓ8���0��6tv��4�^����8y^�u�o=�GQr�x�@�!i#��������o�b˹ly�<f�L�a�Ӛϕ�E�pg��>L."�������U�q]�ܞc�9I�����I�����a췸�cܜ�nqF��Q��ި��,}���@�k��]R >�lr���Y��RD���\���u�PGT�_�v!9 �W^Iz9t+A�9	�4�����lڷuv)�Z�-�"���E܈~�aX�Tǒ�!�� ���Z��ߓwWg6�>vc%�^��}�D7�J�
��st���y/ty�秚�Y#k&�����xej-:fь��� ����y%���^��[�ay���7�0��x^P��,�)�pd?�~���ۆ3Hq+�Z�4��f����8��L0ڕ�#���a~Aڨ6�[O�Kr�.���D�y�[�#ώw����A�LYÏ�)��l
1\��bL���൱@o�H�0ŋ��o�
E&s��4B�����z�M>�2-C�� Sశ� ���^�>�,���?0�3���?���J�t�"y�]7����)�|u�GqC�q@�q��H���h�@���#��dQ�&U$�����k���Pz0�ӳu+��N�r[y�-v��/����EZlU�{�bdi��Fv���B�~kض4�i������/�Gj�|׭�0�D�D"�$]�����->���g&#ƚ3�:}�ݬG �GDh$�q�:#���T#�H� }5)�8���AP���X��g�x�P��"��b��o���6���˞z��²)�w^(f��_kd������^07��G�D�[G��uI[G�k&����f?��GJpѥ�^�Kh#h 1����8d�d�f��|�ls��h�2���E�����̄F�/��su������<�_�GI�$JңzA8)&q�c�~) �}36 K!�y���q�\�(��"<�P�� ������7��+'��o���RY�-Z٨Mb��t�,{�L'�Nx�J��öH���}*r4��4�Z���f��1�����&DX�1]��Bv���)�j	����?p̸���c�b8�܀D�;��?���Ox���a��*��s��h��g[j�ċ;��
���)�i�ՍE�����kS�I�<�|��yh|澹[��Y��on�N�>�C�R~�y���Jt��&RX����/3��W����gu�Z? ��p��|^H���e�2�*ь�m]�)�]%�=a�.���g��ee��m.z���Yg&2�Pj�R'��e�h���$i!$�� {�U3��e�F?�%���/�tJ���;/���t�@���UY��4hfmv���-)���� �b�:?�M	/ �1Wg��E�X�K�N���o���8�[��r��0<JW�� q���ό��+���r�_��˼wZI{V'���'?W����|Z�T~�P}��{O|��u*���y�1��3t�*^
QS������x}��g�S@�L-Lě`PK&!n#N���}���ξ!_�A<�
�|L�h��<ӣ?�k5l��>xY��uL�ϥ�����"8��E7<��h��y�;
�^�ʊ#���h��z�(��m�*Cr���C[Dqq�뛥{�5]kI�kT��1f��n��u7A_ҾJ7i�z?��1����fmg�E�c�����/"eG7��<�P�?BՍ�H��S�e��m�&�ބ�`��ҏK̫�����)�0�p0u�}�>��v/���:�-������%��s"������_x^ 9�������֎�:s[j���i4�iS2x��-eb4f�9Wc���N�Ug\%н#Y�q9{_\�Y#��)�[�r��;U��pU��P>�G��f��B�ϰ0��G���2w@E	�k�[<��OǬ;�b��xqO���P���Wl�Ӆu`��d=:ܧ���u�Z/=\�S��*�+^Vm��/[Œ�ٷC�A-]�B{��WC�9y�j�Êt�2��F��_��y-�O�&���1�p5!�V�|D�������A��O��.BVSy�x�x�IjGGk{����Q�w�W�zO^74|iȄl�8rYI�+
y�Y ��v���pB����w��t.B	\�Q,����h,�R�1��j0	U��|#η����9�p���&���r��r�F?��OA���gki.��Y��lOv&u���f[��O��	�L��,=e,(����)����.د/�T���t�1}��i���/�v�j�8~A	�dJ�;Mﷇ�b���k��0�4����|K�>%"��f� P4���7Ⱥ�����r��_�����jD@Ql�����\�!R` ;f�� e;!��`f�r��ꓩh4$t�<g�;E�%� %U�����!!�m���/j/�s7�3�d8:H �Y-�ɦ�*d}&�
tׁ�	���SI>�g��!��!�gf���N^PX�@�vQ�N����Q@@[p�����`.G�偾z�v�s�aZe������&!C-�"��oAߍ/Fw�e#֑���!ePQWF��˼�M֚,�[10�Y��ħ�xkz,���m�,M��+�?��}�ފ�B�r�������`cQ��Pv^ή�=۟<@�����L�
[�=M��9T�*zy��jPLN�,��ЃFc��b.�����`mr �6\����2������'��"75b���}�I��gH#Sf�I��T�DQp�x�������=����,n(�p��g�d9s� s���h����3�J^5M����V�2d�����D&�cc-ʕ��o	1V�u�}:�:`�=s����yP��d����1<P<l�� ��a&^L}�Q���g�h�EI�U�Bta�~��1"(�@(qP���� �<F��lT�iS�t�`��Öě� CsJ�!ӷ�(�Z��	Ҙ����H��&0DY}ݠ	��˓����>���QFAn�{h��o�5-
y���4�$E1U�Fۥ�y䰢<"���] I���e7��]ψP:*�	2:_P-M��<��t����
׳�� ����A���~�+��@zFl<Л|av��~�E�$ߛc�mG��(���2�5S�΢��$����ov+�J͕؈�\�x:���������e�:wf�.`è�Ҏ��x����rdN�8g� �NG53��׭XF>����o?{��jݲ�&2r�>���V�G6y�PwS2������Hs�N	���[t9����GriPf ��XY�0�|�ȘZ�)F<���lj�h� �����O�+���m#cN�`ۛ��>5n�HM�k|&��F��(��W!y��J8:����9�\�%L�?G�w���"y{k2�e�&�T�soc�Q�Z�ā$O{�?�GF�I��D�����,�Ji�@�M�F��I!y�=��v5��Ia47��O�RP�rZ�{ $�����:��#����������>bs�Ϯ<��!V/����B_z:��['/��|g%�&Iz���ّqغ2Hh�Z0�ʟ)k����d42���d�vY��zv�Z��7�쪀@��,"�^΅A�[�h���)u��>wǺ��!�MU�dm� �ꯀ���[�nlݱk�(@��FX���y���C�@rÍ˸��F���I�{B�=�Tb��2�V��q��˚��7d=�M���R�SS��[-�L��J�	N##P�*�ۡ��CL������G	I?�0/��"jw��#�<䋂�	\���Z��E���ͷ<�}��3���S9�^б�jvg�$�;#T��	>�eQL���G*��r�0�|蘕d1���g˻#ܿ����so�{�՝�@�ʈ��$���2r� Jt
b����D�\� ���yΉ�>/e?wgGb�˓	��[zN�)�M���9xH����ѐ�U�1_��ef3e;fB��d�4 �˃����I�P��e�;�L9���y��I?���)��š����;8?-�
�����εBi�	V���^.!/��Q���[�#�`�w���Aez��w������	����9S�,c����"��5��/�(I�E�lL�e��sC�j�KtGw0�q��a���K����V.�:Rl�dF�o�E=�&k)F9� �a��{�}�hg�����"��ݖ��.dmK��?Ws�򬅯m��Ym������K���P��k�ҩ�e�~�k���-�Eoa�}&�t<ޛ0��ON���V����D��#�o�C��i�������G��?�w�{�|Aė�7��Al���i�,$8�󰶬0>�k���pRC�w��*�~v����}����IW_���6�&�%��֫y��|� ķ!���A��ώ2.l��Jp5|T5��~��~k�����	q����z��c-266����slW}��$���̲����!+*�w�'v��8)�'sj��F!�$zj�yӳ}hdx���yZ �A	����j�St�H�I��Zi�6FD^�V���B6�}��N1o��RL������HHqjǞ���t<MƐ�c[� ������z��Q��Zh��hi�Ɣ���M	E�2�d<���Ϥ;׶:�]Eg�_�p(��#0Y)�z9 E,�6%�w+�!�ޕd/:��<�Ǜ��h_e��=/�G��]
b�L-��M�3d[CD1(��F�Ӌ�V��_l��q^H�C9],�6����*k(��#��k������b΃��3"��D0L��ޕH"V9���s�9��M����`��ԭ|��KW!�ut�;
��)�пR7�-K�����6��?�@ү#�wq͸�@ n�4�sڜU�]�
��_T	>�E&R$�Ut�|��5��qq�	��nS���������=vj��^�������O"��M��������X�<p㻖�	�Σ`e�,C��S�je�&�8_�'�<b�$n?=�w�5�"m�y�5iϦ4�HO�B��Of5�h����GYf-�*K�a���a��~�,���^T�Xx}��� 	K��H�}��*	��3�L�G��(��H�3�!:���EU���Yeva~�ᡔ&�AW������%"��^�V�~E1Q����.�!�UH�!$������t���|VH�S{���>�v�@��p���� =��������6/IjB���0�;>fM<j��9)���$ki���F��lKŜ�\5�k��Ŕ;�!����X�e�&�&P+�PG�A n��{��3t��K������#;���5����,�v.ݻɇ8l�`M�Aj��%�v��,0H�~p���(1�e���֓dP~�N5��
8&���3-��H;�]����7.8�@'�)��iZ����S%S���=Pm��:XS>LA���j]�����з����E����!+1s��_Ϯ�9�:���̋j��cஅ[��s�Ý`�ڝ-Z:�?� �yiV(����O/�ㆄD��A8ע*֒��M#ݑ���/-k|�����}���<<F
y��6-1c�5����i��@� �^��o(��s��K�Q�̧D:���-���y�8w!r۞e�q�K�K���L?����2)"+��I#���ɩ@!�=w��n���xI͆��if�"e��/����t���~͐�`nƀ�C���00�%]r����8�u��g؟���!R �c�sa�y7�z�h�t�su ob������[Ҙl�����B�A��R�B���W:e������R�*7̪�vW86B�|QZUV��R�F�S���S�־�
E�C+<Ce1���d �!���z�� ̜�J&��D/��q7C��t��{��ȒQ���SJq�%.���ȶ��aÆn�ե���%c���V���8q�`��g�X�����H*rA7�w ��hY��J˱��ʦ��� ���O�-�\d\� �Z���z��1Ju�u��'���9��?e�|T� �������B��{dW#�է�b��?�#�:�� �����R'AvԾ�J���?����61��Aۗ�$R l�|���A( �AN�
�O�F���m�+i��p��M�����ҋ�w[�����-v��k��C�����qa�Y�)u~�g��Šc[^�[a��JIK�=����b��Ic���!�U�賓�����3s�Ǖ�������.	�R�<�3�
v+8�0�a�|��2�pI7S����rh5�a)�{�qqTc[:�gc�EU�5c��'�i���X|��Z�ȅn��f�%M�O��t
�kt�K���^ng��Iv"�Jh������PZz��B��iR/sqU�+*����/pt�y������A��n\f���^׿��,{_����Y�@Bozl7�ѭ���w*��o�I�҂o�c����/�`p������N�\@i'���GC�\�-V����Փ��$�v'�3舚�k�=Q��|�=�p���Mʌ��>5���4��nv6�z��j���� ���x^�/�
��u�>'�Ձ|�2�m�Vn5��y��y.�s�E77Yֈ������(�M�;%���)�^d��.�\�nq,�l��C�zn�{Q\�hLO+�Ͱ�'D4�S�UȂ�����W�8��&G;����)L�:*O��<N���:i�V��r�X��J?k/�z�J'X���R>�ˮE�s��΃pZ.ʮPsauA���sq}��톎�5E�}}\4ªwY���~�T� QC
�ےj�rOo{��%�x� Q�*)��N���'�Rb>t�t��Nv�F�U�_8_���>���['��}��ȚRL]j�W�1�
�m߭	����J�{��҅1x}���b�Zαc=�6�u򩴂��#@@"�F5�����9jK�� ��x���J��b2�.U��l�s�< ��t�k^"+�ȹ\��W��q�7*�L�T�N��B�Q�Ჺƅ��'��h7�h����� v��h���/��k�����Av�؄	��o6�:�3Y��(mp��n��~�rJ���A����nSM�\k���-f��V���-f�f0O.�������İO�2Uw�v�hj��oq����=F;�b�:��pj�Z�=v�Ѩ0b����2.~��!��b�iE'$��r��	�h�E3m�h�-��~�0��6|߭7���G�_u���MToa/o�j�ٗ����J���g�h�� �)΄H����?�НYt���:�>ѼA'k�ג��:إ׌]��d%�'�J��^�u�sϤ����l�����&���Ő�
ZT
�g���}����fq��:� H�I��vƱrK��컴`����v��ǣg4=%Q3 ���E�X&0w����8���	�FL�`�H�~��(2�+S�[�UK�5�{AB�Gx�sQ��S�f��H��*���s��v�n�Z���t+�x�2��m=W@Țd�z�D&�Ps���M�;)�e�L�G	�FfL�Z7"U˓ñ>;RUk)�� ��|4g����M�ĳCC�%r��I�iJ�.4x�񎘗�9.�������sn|PFקP�4���*�^��ݛ��[?�M�i���k��p�oޥ��u��j%W�>.n�_Q�)	��)A���z��C'qq[QYܭ]ڂ@�2t%�]ͅ_!4<h�B#�"�ũ��X�b>��:ԙ�k/��{�)biRZ�Ԍ�b��v��eȹ�+�Q�1E�3���й~N~�c/[D�[w��;fJ=�2���"S�M�P}�����p�,�꭮�D��	~%E���i��R�ܵ��dQ�!��"W�\f*��	����EG�9}��l|B��2�S��4��~�{��l��u�H�cL5���W{���=,#e�N�z��?��`D�}7R�}�е��yk\N�<Q10�p&�$����>���a�̤6�k��|4��a�5����f5��l�7v��7xf&B���»����w�9�d�07� V���jz��]��(��WװR�51U(Pr2�z ���IC�ٸ�z.�V�'���m��7�|~�~>B������|��6%�=����
-ȡ^b@C��	`eh=�7-zˊߖ:��E2:_�T;��+��6[�#>󊾑 �hߵ��niy���s�1s�J�L��&2�� ��=y����	�H�z�Z�l����c�r;x��h�5��[�҉@�0C/�9��Z��Ʀ�4�i�
�5��� 2�xl�>�є��v�j�ni�����W��f+"H����G=������.�%xFS��Dd��&�i�kJN�/�SF���[����W�S�-�;�L�u��5�E�*=�0�ڴ��ǹ`��k�䈜�ȕ˩)�Oq�j.r�p�z�38?j
����"��	�de��e�����D�;����Y�o"@������߿���3o{�I</��?�W	2������2N)I��ѮQ�w �a?OE���_��WЂ�BU��iu2z^0�L3��|p��8S�CO4�ض�VZ��1��Tj��M����o�6*t�En��VB�Ɲ����~��g�𦕕:i��V�H�����um�zZM�,E��t�f)� �6��_%�pd0)�����s�T��8��?��3�U4c��B!���Sh��UUҨ9��I u�!��ȍ5}^`�O�^�5k@��v+��IK�����_�M�~��l<���ё�����CL!�WY���~��^�c��M�,@��+�=i
��o��Av����	����BOǞ�9!}(��vW���8p$煨��#l���x�C+���'^���&�dќ2��Ճu���\������؜�(ᓩ/��J�5��v��qn2qj{�B_lKO�L��BO�Z2�}�DN�L��p�?�g�T��X����J��_��Q�p���k���@y�[��M_ڲ���"X�ݧ
� �u{�	M@�lyf����.�,[�+M�[�{z�C~�xhк/.�Y�O(���
�9$� T��O�5K�(]6a�
�T���S,�魼����{Quy�u���:ۈ&��x�%�z���Jeh�����@#�S�ل{&�$���݋���=�����9F:��!J䦴s�[�t3�F��A0��>F�~�����l�S8TrͿ@�hH���Z��yo��(�{^�v��@��[�g派w���<8�qZ�X��l�p\}[�c�������z!]͋ ��5�N ���62�}��!�b��!�\�A	�i�%���c8�z�<����>�N�^j��3��@w��|l��Zpb�P���Z�P�_Z6 j��Mc�Yw�m�T͢v�+ْ���"j�&#�y���1���=4qt�A�*rp����ޚMЯ�8�5g�-�m�Y��;���Y%(̫������JœҫO����Ҵ�HCs3�'zC����e��.�S�L�9�R1G�4��NNaW���%��X%��rl�~C ��A�5��ee�i�!9߭�īv��u+�;��q4
-,Lg�Tm�l��M뫽���&�=������L|=�[~�������6��T~����x�,{i��*G�/7r�ޢU�щ=�m�l���S����LK�_�9��ǚ�L��T�4��k�����]��grb41�ٚ�P���5$���ע]d�RU���Q��Iѷ������#�C�$ļ�1V�� U'��3��O��	�>��Q���A�� ��E��
Θ�I<�}�9o%B�!Uۛ-����&Uq��L��$m��g�y����� 4���1~X��d�>��V��E�f�;d9jX"G��m>9�-�Ŀi��ZI����,,a�sdrg1P *S�s���C
]�b�)�e�x+�s�Rl0j�^u�&pV]��]_
�@@mj��{��BfI���'U?�4=|�1��~YхT�p�"��1
!Y���~��G�ο)�Vr�=�u%@6�#1�m����5����Y��%H��!4���}�w�0e�Rz�\I�^�� et�MΏ��2�D"c��LUV3�<���4�(�Z����	Ӊ\�W퀊��`��6267�y��p��tCګ(�s�*���ǧ1��t�$�Tr��Tmr?�Nz	70����{ ОP^����Tl�%]�ؤi����Vtk�h�T�8Ub�E
H�&h�$��N�6P'tpwݗ��bx>�E�+�O��uh��i�/ۛ�[�����Y�-;Ub,%�j�-x���Q*��`N�ёy�����{*8�4��_�S����-4Qb�7��])+�,�fޛh⪚���f`{3���'!j'ؖG��ݩ���	��>����0�Lp��NΎ�9:�N�E�!"R�k7i{�?u���*<Y����\7������Yw;�� 3Y-撤tN	˭�MY��;��1���;	J8.���m1m�T�e���e�����Y�Ѓ�z����t���v�שh���h�ok����!zavDzAB���].K��E���M_Ɗ��B\�rO�,KsMI�lK-�Ēx�����gcK-�\9
���ӽ�1T�:�lu��>�w������ZM����Mn�w��a;�0	cwW��@��"���5�嗢8} {'st"��1-0�������K,)��)I���O��1����woA\9����X���6t`�s��b���\�7Ą7���[8'F��z'���V]
�Y�����.p�j����䆯���Ԗ���+�ä@-�=��Jm5�ݩ�s`p��iũ�Ȓ�e�,tK־鍟K�$W���H���_�t����!u����B$iYfY����`��Кԭ�6���%��.���6�|�q�Y[�r3e���YO�?!�قT�r��~$It��Fo��r��%��k�~�2|P �h����ȋ4?B�6�D4�,z�N� ���e��c��R�`��q�#K����KE����,H��M��z��q�56�&�^|6�CW�-��۩�ƯX Z�0�Rך�y����(���qP-Ƹ�����Y#V�Vĳ&��-0�*�UOA/�����=	MW���F�9E�R���5}=� l�Z�+)ܰ�C�%��Ka1�R>'\�g�K8��'j�lM��M�ݚ���W��S)mK��H-�r*RP�i��{u�:,�3���R���:M|�ҥD#��9+Hc;��`5�����U*��G��oƐ�8twx}�ƛ���E|="рЌ�gof��:	�H��XPL8��[��.�"�p9(1�tˤ��ةI&J/��Tfϗݍ�.o{���D�������.XN?v
��;ͭ�1�#P!����������a~ �V�;�']E��MWG#ٿ�������kLm��g3���Ω�A:��셫O�M�!|�W�o�1�i�=��O����5fK�i�5��+U�Z]��Q	��/�j���s���FP$������{'ttF��)�Jp`�i/�W�4��Ō��9 �3`�ݣXu
P�Bn��Z|���s+��~���
3~���CN�c� Z��A���8��4*���Q��W��X�,��*lC�)�_qhx��;�M���F� �94�3e��ֲX�H�.mg
��k�S0���Ɠ��p�E
��8O�7@0#A�^�e�L8�yj��3���rHf�
AsZ6���]Q���w�^�	��S��A 2�/��]z��Ć�z^�9�dc+�ט&4	��׆�	��ɚ�l5-�nϴ8�W�ACD��W�����
�|wz	ζr�!*�c����ו�����A%� �� H�	&R9����B��"�;�1?�qE�8�H�yj��G�#��߉��6�Ѓ UD�YR�(���^��2�0GFކ�ؗ���)����S�E��Mf��[�AIy����#3��3~��[��psF�Y3�&`����IO�7�-�g�%��KQ_	5�_�x3��5CF`,4n���Й�2 !V��� ���Mq��-�v�O����Ԝ<67����eD��% �����Ƭ1M*~�)a��ub�M|�d�L|�A�!�����)�6�Ȝ;^�$K?V}P��4��S��V�� t�rgR�&��6@���ݙ{wɪl�+:����l�q����sWs/�5Ɖ�����$�w�=.V�Ƥ<8��VӬ��0� �^����@C���7�A�q��Y���L\2��S��>t�,�D?ʞ6���_�q�����" h��Ō��.PULM;���E����0o),+0�m��S$�$�g��خ���D� ���H)��w�V��%P�ɛ����	��"n�n�i ��o��<�Iſoʇ��ڇܦ�E�2�'77��@�"W���Z��e>�߳H5.\�;s�Ft��D3&��zL�Rȵ�;3o[����<U�.+I׋i� ?�EN��ƘL~{v��R�ȋ�y>��'ܤs�W�`��������]����Fe-���w���wT���� D͍y�f91F�GqyH���;�Z�� �&u�˗T��6����ң��y�vHo��S�R3�D��8���70i��I_��M�)j�\��v@��&��nʕ?2+_f�m wb�����{T�]����w ��U�t�
���{Yq��ϥ	z20��5��u���D/��>P僷��4���0Wo���T%Ml��^tXը����?�����Z7MKxk`T-�tI�|G�b���������S2)�;�_=�� �t:�_s)A��P�C?�ފ�������3T�,-��2�B*��v�z�8�@w�#@_avϩß����S�Ov����U>��Ƀ�}��W f�J���LYj2҅�֌�@��R�K�z��(b��������9+�FD����T>��)fH�ۈ?l����<`�IH�0��γ���4�EgL�|j�ꔘ���<��v
�3�a1sw�ʥ˹�r��8�el��xC�#�pY��j�S�~���K�yGK�	.l����)Nh�c^!�~Z�%��0u���e�:�����.���Y`��Zq+������K�jHq���,�Z�+�Ia*��M¥ J���һ~.�i�����ri�G�[�vU/����<{x_�v5��p���}ׇ�S���8��x�s�t�N�A����wv�4�E[<g��&�:ð8�$��a���b���(R���M����潶u�(Eʠ�����U	���$�f����|��,�[c�_;, N{졌��p7-�#���� ����w˨~��_����C�������P��$Li�.N�6��l�W���Rڠ �K��E�����N^H���j/"<�8�z�<I����Vƴ*uZyњj/��A���"_����ؿ�G��ˀ�cV0������į1[�����p�_� �k��Y��v���Z��5U�2_���ya�D��3�#��B29B#�}
�-���| ��@0�z6�,]��v��^�0}	�~�����+�8�{{�mI��׭u�'����r���|�������B�C���E�(����h����*�(����']˅"Z_ޖ�J�&G�s�s���9��0 �_#���� H�t�P���������`,)B�\��j3}f5���|���=B�4�^T�𾡷��n�P���,ma�?0a�QW�3�������=��Gh�s���,���11��R�`�!��c��4@�m̫��ԜK{�=Z>�QϽi*�_��7�7�b�E����?�o� ��Ι�v�
n���}e��6[��Ԡj���q� ���%�3S0 ��ȋ�7 ���npÂ��`�ޟ�k�ux�O̺�ZXj�vQ��6%���� �L��t�O?��z,:%\�`x�׫���e���0cxR�UV�)]����,��w	�{���� 5�P�TS�Ǔs���#("�P��)��r�i����3�$!/X���?�(���j��ƏPCW]�}@�1�}���=��P]�9��;�y�M6����rE�{�M�;n6YP�������`�����l��iO[�R�^�(@L,��e�����t�jw&�-¤Q#�a�xu��}���'� ��SYu��i(��ϑv��_x��a���b	�3T����E3T��g�~h��z)���g�P�D���Es�FA��x>��@U��m�#t$_�É�-�Q	-�-�������-�-�#�&V%2D?/��b�a��]49���]�;W�%���Q��l���0���Ep�J���2�t��Z�P�"1�O�
��sW��I�<ʽnL����ve0x���͵a9�������J���}(F�W엒A��4ޏ��@���g�������ց�;0
��2>}^)�����6U9�'�X�4Vv>���?�ٹ!���C���fJR�,NϒC��Bgtդ�8z��u
�k(z��˸Pz��SA
nM� �z}b�GE#k<M�r��� a����c}���;it�.�0��S0��A2�Q7j�Õz������}����#��q����/��[��SLQƂP�q6 �����xH^LxH��HʤSb$b>�,G�I~ݦ��B�D�F�B,[y��i��땐&��x�5WL���C����H�T%7˒q�tٕJ!���2�چ]fk.$y�������̾�G����mK���i���orM1(�BZv""�^ɶ�~����	��Jr��$i�%�D��'����J?�a7/}k�b��*���_��4}�Wˉ��C�]
<�P���Ȭ�#�7o7�d����=��� lr�x�8 8^�<��;r�we�e�Oqi�sc���G��*��׾t�����G���d�֡Fmxj������ᵳ�=����Ik����P�V�������H���>�U&�ǭ(Ԝ0!Xc�j��u�_�/~���Q�(�V��"�mM#��R+v�֐���o�_�v&Tq<_JtT�`a����3Q��Q�o+BB�Vqa԰�u-�&�[}��6~z���y��@�e�����|Sy:'v6��fI���[v滓��j���_aY$iL��yB~I31�Z�j+�_��DDٺ�f�4���m���m[��P�g�p�:4~��,$ふ�+x�"�A���s/cGV0��F�=͑u]�떝�Zŕ�f�;��'�\�����H�o���
��7pڃq#�D��bk�9���^�s�0�����"��g�n��Л���_4�n����	$q�l���:�c������Z�M��m3�\PII���JE�SMwl���N�꧀݆�.I�5�����u�=��=N��@�| .��F�[��k�q�=s^�:Y=UЫ^�gP�q	M�gpn�@6pqU�&�}r�NH��j�M�v�,3��R�je뵪�ku��[��H7e��B��
�/� <�
�%	b^�Ur�?�3��}�G����Ԁ�3$`�*OK�2�;���L�D��E�Q�(�GM�B n	Ƞ5:�����gD?��ý3��W��B���[�M�|��HX�Do�D(cLn��+�4��_  �&Qd��r~��#�'gc�N�9�K�A�y�� ���ȧ�N|jSe �Tѩ�&�����	y�� @�Р���������_K�Ґ� ��C��}�q�`6��3In�a����Q��f?<9�S�0�&-��k[�S~���W�B����NM��G�;w�~��x�"ƽ1�+����r=��*
5y0'"�q�1xļA|-���98ci^�� ���H�r���I��L@�o+�����53SL�ǯh�H�!�iX;�n)
'��l\o��I�dr�H᧕�?P�N%�$fX�tm�Ep�'Ͷ�_B"�����?ev��D��),2Xp!�>3N���;�E�y�>V�+'n<�+��^0�����{Qq���P/$���-e ��͡ȹ��W�{�6��XZ��y��G�Ψ�è��J5p�8��n�B��gbB�U�4�Du��L9p��#_�(˅ѕ��~*��'u���M��دՐ�%S���61���o�pMGё��`�α'\Y��] ��;	�9�=%~��,��f@�J����Q�ë2^1�ŹQj9���^�IA6�ؓ�v��*ldJ�H�j vs`��CH讯śHX��v�U'k�ߍPl��4O����,���f���#P	"�%�pq~B �`7(�~Xǟ�I���f|t�Z�2j���|��b�ݥ��#=����[v�Kl���%zKB�����^��}ي�ѥNR�7�B�05���qW�����l�x��G���d?��d�#�KC���C@��&k�=e�R�݌�t��W�&�?��;[�MfpG�q(�<�����ɾ���C���5�29po�;j��ؑ�i;�$.��l���M-�X����aE}�]���M��OAXV�~ҶHxw�C��J��Tf;tYy�H͹�1��݂�޶��N��Q��w�}.$��g��7[�<��[D`� BPc�tJ�i`ʹ�J�Q�Y�N"ܿb��V��휌��m�|?��lW�bx����o �R�s�V#4:�n�/a�������4�:�~�Cy�d�T��5�{��V�r��&55p��-�� Jyb�v"xylJ�?Z�[� �opiwm6,5�\�/1(7�ɨ4�"����9�o�Ԡ@���ۢ+���?���Y�st��s}K ���R�%4� �X� �\����	�P(�9<P����7(�g��^����b��>����c,I�b|>�@&��҉����:���9�yi
����U�84K�0-�j������#NZn� �c՛��8�k��,��Uv`ݝ�#�G���U�l��H4�5������^�}�\ ��=ix	�;��S�t������3㸟j�_��kv�����B�vl��.)�AS�a�&<W�Az��`4��>AM��u�ʴL�	�+����ۉ��^Y��$؜��;ì�ʦZUU1���0D&HRvFJ;��F�n�ŝ�����Fq� K'�����&�>Q�V���B#O� �AP��������5���|b�>4;!͈�T��{r��'���H�f Kqw��Z�x�;�v&����="� ͊3� 1�'Srzro=��'�?,d[�*Ȫ�i)�pyG�ߑ�엣I�m��>_n�>Cm������O
��6���;WrYT��d��R�^:����Id�F��b�JP$���Ni�i��ts�
�E�������ьy��NqL�����mf�Ҿ3���cFf�o��������ALz�fK�PS�� 6���O��������j@�Y�w?޹T�}�,9P���:q:�%�g�	���oxp�Yh���`��@��"���|p�S�<�UC�E����c�a�e<p*�ͤ��jC������c<�����*�h�2�ֿ�5i0SL�Sc^��k�@������+�-埥�R.Ji���"��*'c��(Jh��k� �f�&��I:0h�@<@�9S#-�_�Pws�ð
y˫��W�Q�G�b ȟ/0g-9 C�r=�.���e 2��Q�њ�7VH�(�5��;���]�v0�� ]P�`b���B��u�:�㺷�Ȳ�����n,3����~�)Ȉ{*MA&�|���{	-Ti\�f
��&�����MK��%�@��B��>|귍�/L��D\�J<�K���%4&S����Xs�9�2�b�G�I"� ��Y���ZM��l����=��;H����B��P��Q�G��}��?�T���ɫL�
7�76и��/S�<�� ؾF��3S�T�R��`�h�PV.�jpF��V֋�]	�X�~����w��5IUEW�u���%1����m�%��K�3����1B2 ����9��JR�A���1�c��1��f�hℽU*l8�J$��J�M�u����}|���?hU�nD�U(�1���B��(>%wc�,p*vHT�t0V��[g���#�ð�}퐝�w���6#�٘�����!e3��K@�~[:�S�շ���]�,�J%B��*�O��'�u����(O^sVO�_=��]��:���wyEt����0 ��%�7&��D�7ċ�&"�:�"Н�������Yę~��	t#��fb�TE;�_��G��x8�g5��nm-��xw���T��
T'�n;c�|5��T&�#]�~bP����.�e-	$p8�n�6<�AO<B�X`��vJSl/��l\_	Ț�5���z�����isp'h�ۜ�H�w�d��df}��� 6+�������O�vS����ц�m\$ǜw�:�"��ӌP���^�Օ�T�{Y�+�?�,iE�SK��:N�9	��n�K�7Ao0�!kz�Z���q����,�v 2�z�f������y���sd:������e�
��}`�E�.?���V�~�_H��f�$�U��_ԵZb�M��/�{{��pYa��]|]�v���p4�xt�`F���`�q�30�XΗ�(z��I�+D��*�pS4��\0��Pߛ���5���� ;-�(�>s:i>��Ǭ��r���ף#5S�6���w��R�{e��6gʝ���M�	8�N\.��hqB�!���Nȹ#��N��ysw�n'���^��Y��6 �?��́-�8���4$�+�R���@4K[0�}y@��H��� �?7.Ei��B�@��蒶��7U���$k�v��-R���0[�E����Q�����mlV~B]�����w5�����\9i'�a��xX���8���O��7�]'(W����V��v_�-���B�;��DU"�|�]3�сבo�����W���u>���fW��r�gr�v@�*�Ux�q��ZZI3�� S��4[�a�j�+3�)�Mc
��r��z\�V2�`v��Z��e+,�l�'�&�%�}��`������Z���
��2a+CWk��.P�ȣ�C�p�q'ڵ�פkW�C%f��Ko(��#T� �_-�O*ڈ3�|��Zb���d�a �Y�˱�ݲ�f���FqL���d��c�L`ԇTL:���0�u:`�0� N�	��"`m��)4|O�Xs���Q�8��u ]�A�I]C���{�q����U�|:&�j�,Y��9�
@j�!���tv��oo���Z���ХC�?�7\���=u��2�$a�x�hk�f�z�+ ��E�����-И�ܠ���\�y��Q�k�$#���,�� 6���&�zlU��Y���3b��?�,���<�1��2mB�E]S�������i�HYDMid(�R�!�Fp% >��-U@�3>2 ^��($���@B�^�f�#���� �o��KW�6��~5@r^�8,���6���6"1CPV�Zw\*�S�5A�i�A��ay^��I����Y�C��Np|�gp��`�~tM,h���t6�^c�+�*7���5���XԒ��<�v��7�>�Tw���:��Se�o��kݮK��:���#�u2�h� "���q,y_�m=�-R��L0O����fYW�z�]&�.V:]kP��}�9l���q}�\�-���`&��X�WS�_4���J�u�f@�p�� O.E�rQ�}�I��!v�謥y�!Cy�Ġot���ĻNx�[>2��'��v�����^c��qw����p��8l�;�4E�TWH��b�s��<�����ۏ�B�:)�e��h �{�Ր1�b�M�-�)կeJ�7'ė�l�f�hO�D�b�G����8(����e�w�ħNkf���yv�̮Ӭ���V�B:k��aH���O'Y�_,\|���؄�vG�����!�B
�R:w��&yZsp������UImx��.�G�V�e�%K_\�|�bք�y5�fc�b�;�����������������-2d�?O��������bO�5��q�,��i��`jƓi��z�H��sDs�����
��ӛ*��Kù�m$)C�˚M��
�5U'|p�qWS������fjR��鴧���ޙ��,�Zf�H���9r���|A&�W�n���!�>���L����:ش��o�y�I���"e�Mq	�H�G��-y� 	O^��hڳ^l���\?M�6-�ܽI�+�w�pF �F�*p�*4lNƇ� �Нܙq����r�����cíے��5TL��7���
�]�ܤ��G�0gZS+.�/�q��{J9ډ�e6s}.5/3�U�JB*އ���d��1Q��¬�ZB��ծJCĢ`VJ���^= �(���	[}�$��Z��ONx_������=�7�%��~��d(��ჳ�u-Xx�nR�	UC�k�?=-:^�	�W�:���/ �_���G�B�������Z��V	,���*Bʼ0Rz��z*��FmW�'�!'��^�z�,��S��J�7����Q����3Ϭjӳ^���ڻ����4	����!V�K��ы*�^��|�-S�*�	�9��QaeNF�c����?�����A���T=�Y5���RE�$�)蝵�9�H��2kV`��^V��)�0�n��"�3K9֓^����ob��/V�' �BV>�4+��Z̤>���K��=gK�3��g�s�W���E�(��%9z��X<'ᑿw�!�z�@���� �#{c
�֢��ꗮ��z ��6��}�j�g[c�8������S�-N�X<�&������@�����;r:`�B����R�L��ʺ���Z��խt� Rsnk���8I��rz��,��'Y1�ؿ��]D�P�ӊʷQ��L8ƣH���|�mW!R �7��첁�S�8:����-������x��8LE�	��ơ<���@�g����fC>{�Gs�:Z��ga���������f46�,�|�Ϭu)����g�D7�h,�JIoii��2���u�I����z���P3���_�2%K�������j'}�׉^�gQm�iE�b�JY,�FDs�L���ϯ0�����	�w��� �(
s 	/�BUN%w��A�t$��V��G�Q�J�q��P�l_��QW�����/�B�L��E&��(���'~�mL$��X������X
f�>^In�H9������g�Cwv�*��2!�����jtj��F���8L�*�1j��(_�Hi�%s�^�a9��
^}�vga��S��&+N�h�n��w���$z�|�H�$ԜM�r�.�G�j�cDB2���:������~�]o&f�ns����{c ,�`!c�J�q�� >��Z�4�A�*vd���=�2&�1��'?]Cs=� ��/�O����5�5�@��zX�<�:�{g��PH>����H~|�t��a<q,��?S�6 ����1:���09"obl�A8�ڨ�|V���5���F=��]�+E����@��MҎ4����4آH�G���q��0�2(\d��d��9
��k��~
��#!�Xf�8�J�*�O0QLM^R ��'n?>T��^�(I����b����]bq�+Z�
'ǅ���-9���0:̦��"[*^+I��D�d(ZUM��.��i��$�~@��,�����/�A���<B�z�N<�h�3�5�z�[c��,mw�	Z���ᢷ�/2�p���݌q$!�%�A�
4�q�}�3�b	݂Z2ta�4b�1�w�~�y-��5>� �!���*�b��O�K� G��c< �Jj���ۯsE٦,(h������4�:lWi�����j���I>������G{�Ĝ��U�GWbNf E��i�����>����D��$�|�X�e�ӫ>y-<�nY��5����m���E8�?.Y���y;��G�P.�y+P�u�Z|ݢ\Zڂտ�	�g��Q�q��x����Z	��Mi�M����	lZ�M��)%f����I�����Z_{�l�v`�r��FD��EQ��S�&���.oQ��1x�2O�f;eC�O-��
��#���
�[̝��l{�S#��Mc�P��d����k�R^�����ۚb��o�(��'�}��֓������	�����9m�TM*���z{Oq4	�W��0�־Eq+	�r�Z�a_�=E^�8�,���%��S���"X|�U���Q����Ǵ�L��+��S'�l6���� �$�n��;��Nj���+ #hM%d	R��fj�Nm'+�����H�oY}چ�P�vݔ!音ͥ]�	z�� A\��V��Q�������(�:#��2Q��+����_���VN�&�iu���ぼ��G��#�d�xh����p��)$����YA����QrL�Ez�4��L�s{M]wȹ�i[�\?hކjM.-̉44�����HD�Xx6}L�6��;��*��YnQ.Hճ/�+�2���9)?�����	)��9Z�^W�����}r��&��C�a#	�Ѿ���b1��b�NL�I�� �OU��Q�?�g/�y�}}	#eO+�8Z,�/�i�k1܀ΠWN^xT���,�(�<�S����6�-փ�gKF��v�W�@�gu|�&�WS�SL�>͒ŝ�-�0z������&���1��IlB����`�A{�@��C��O�5�3�����<�In�/a��m a.x�9f�ƾ�;��(�*U3O�V���o�M���� �ؚ������0��B����U���V�O��mK|��Z�v�{�c]�,	H%�.�@l�G��F�^�& �i��U�����ܝ���t#1���I����'w�-I�D�����3 u�c�U3������m�Jz"��P��r�C��iQp��-�jֳ`�E<*�{�qydC��q��FO��+%VM��	n,����R+��c{��"��}��X�ɔ���N�	X��x��Y	&�"��h'�ո�s��{�P�Ҹ�Zy8�v,ǡ�����U@o���(��p��;p3�&��9d �J�GI���G|��^~֖�������?�!bI2nF2O��F������0P=��U��ߩ�3�&^�2�I	G�e3F)(+"�����܃��m2�(WHl�����ET,UP|��Z�;󵉮'R��[�u��P����^�&�CgWs��>�9 R]��>i?y�;Z�!�[(>}���!IB��ܐ��i�%�{��D��ا�KQ�j�>��R��j�+z
0����T��@�8�a�/_CG�m����y�U��`'�J��&�m��`5�)u$�{����yqN��'J�����x������/qZIN&����U���2�/��4���pR��RgiX�Q�/Í�@��cv��)��WFjf0��Y}M�س��!�/��-���b��D��ȖFs��%��M�eT�YJa���������&>��� ��ڠ�zeݏ3�E�o ��}�7!���F�=�"
m�͐�tm45���k��@Ъ�����$(�{R˹ES���d�_<@��}��*��s�:%y}q
�����-չ�l&����h
��j�z&�XT��l�,8�^|D���I9��:���|C"��P��8s��>�$�����T5�N��C��T���4؆�N�F+��B楟VH��k�r��WF�ٳ��e��p�S�uA��h�7/��[(��b����6%�i�:八U���bC����E�#�>6���v�Ώ�B쪈�����7� ԿH�Q��w�[)w�*�Y?l��|�&�B������������r�ҧx�7����vB�����N�TQx+��5ۨUY2���fp�ʘ)���\�B�ah,�&�P�5�L.�� zuf���<z���O.�����aN�\�IȠ��,A:~ff�򣀰� ���;��&�Ԙ�{W}q*A�^=����5���=��Y`�C@����jUv�#e?I��W
�>	�{�}(K�7�pZu�~�ݓY�ɛ�:�.j�������-�|9�M�{�4����~�dO��Iۜ[���MU�t������̗U	��r�~hސ&EF�	j%��ti��>fzo����`�,�Q^��ڊ�TEpe�ۋ`�/bv��y�D�;59[�{�ԓ�T2�t�\���ZeɈ�o@�|۶�|�al�����e铖G���!$ֶ6/�(#.Z�;)xx�8�~E��I�j�:�������uk�;uz��N?0���ULZ53!�J�Ό�ǒ%�raL��³ސwn�;�$�}+r�tyh0}�)�����_陃��C0-W��w�I+�r?v�y1؞5�G�pʙ���./I�
�[i������o�d��4����_���,�t���B���ӹ0ª8_��a���k�W�dh�$�l�4�m�U0���$<�,k��2�������u
B� %��x�7S]�d�ۂ��
$U�W����;V��-CN�!&3�i6h&�Zj_�;`pd�
��Um�	�K�](�������Y���#�uC97�(���}ؾ/�V7W��>)&s� ������g4����Ʃ5}�mqA�U�}��H�ē���?�a�ֳO�eR��ق����o�cO�CD'j��y���� Eg��B�O���-�oX5��m������;�����O�+�W��,��r9�9՚�'_{����~67펽�U�K��Y&EfϮW�x "r�b�*�6y���΄%���$�[ Q�b�����qF*]IUכ|�G�j����(�ӭ�g���GH�4LLQZlW
3HƢ�ƙ���	�#���2�銥bw��@J .iy���T��2�:m�����y��h�M�沇����SIq��Et�q�j�f0M�Զ.��$Ʒ��м�o�t&�|B�*8��'������7����v����\���4lm����-吙�B���(�$�3�>r����ʛ����C�z)��A���`|�}���9�����B���]��X/�]k�0j�	�h�̑��	���
o�to�т䦑f�-���g��K��c'#�v�4���HW�(�ba�겾��5��]l���|qE�����=���W@6q]mRB���H��5�sM�����*��s�#$���拏�TJA�m�����PK-M��x��JW���s���1`���&�sɞQ� ]�3G�O�m�"��3H�*����ض��S���b�V[�9�\�D������@��~Ϳ�>�B��ԏ����� X�I�VD�+��̺���!��|�ePf�����A�E�t����J���j�τ�Si�	����+�>����b���wZ�����ݹS<R�܋��OSBP���t8���"�v��Fgˎ��]�!�B�%!0h���'��� �Dz;���hZ-P��|R��ϼ�!>�;:�u�I�;	��46*����*�9[�1x��676IWGr�L�͌�:걨�Ӵ���:JY�66�%�1�!��c��D@�`�����1�����]M�?B��-˴G },*�_yH�"j�ֻ��[e��UJ�5d��u��v��k�SGuO���^�%0�E��3roB}����X�י��O��O��`]L�:�bMm�y�9�����q�pZ@�=�톾^��*����h1[��6����@�F�#a�:$
�����)�8�̀��p�#3:]NOI���QKR�/�+T7��]�h��5�~;ڻ�Is�q66+-�oXk�� I���2�1� �<8��Zτ f܆1�`M�2��:<e�X�-��!��;L�Td �>_.�S�����8�B��/(�\�d,&?;@]��maF~Xh%�*�< e`��k�zh��uj��%�{3�cּn��SӒ/�
~*M��'N3o��pq�]oc�TQ�Yʿ\�^i?ԁ7��y{�U�_�Ӫ��<���Jc!�}����<U`t�3�z�{%e����^VA��!�~���5��̠^��bA��q�f2R�a�ǌ�O%VD�/�<�^4��?49��,�� �3r}������52	��c� !����`sCb��|����P����xs�~��J�D/8��N'12�����{&g�����䪺��8/;����R"-d�?3Z�Ăt[X/qӟ�p�r�V��_�pa��_4MJ5�j���"�nqX5���q��T-�!v����rpR�54I��i��}���
���~7r�c��%Q�l� �#��zlo*��P�g��Q��>��(x/���1����Qt��sݗ�K����S���R^ ��6�9�������j��-��};}h��ue�����矙ei-��^u ָ8��͘hf�o�Nj����u�!�V!ӊS�ąJI�v��W�c;f�i8J��nY�n:����]�oЅ�x���
C޺R=�`��ꃽ�&�%���Rn�@g��3�ד��,J	g?�/�zns�������I=J�+����+gL���jsx�c4(�a�;���Y:��T���Y���j(;�
g�.j�k��ȔUv � "�Y��������
����#�@Q&FDΖ�ö����۸̼�ղP��C3M�}�B�RU��AU�µ&&���LEʺ�͟J2��!�������ˢ{��g ���� �7'*�$��TW|�C͗*wՠ��F�#U��� �k�ֆ�Ǘ)ɏx����cɊ��}zF�(��n��mE~��۫I
S��Ååѭ���6ځ����O/a#&	\��aTh+AH��pŧ��q�Oƍ���n�J3w�=`*c�ã��
�g�:ʭe���[-�cvI�B"���Fk�ik0������U�dA0;G'xv���E���{�x��=T�|tv���b�Z(�lmK��R�x�<֎a��G`�����q�M�M�?�%lA�"u�ٵ�N���K�N\��CS~�f��7�i�3*�]��F�/��]�
f�\��-X�:Y���߸b3N�>����`͛��~e ���;~v;��%٤��.A���O��qGB
�j��x�#Jc�������%E�Ϸf@��cS���� ����.e�g��ńn0)S��E�g�f@���o"�G���T���ߠ��-h�dm��"�[�h��O2(��)4j^$^
�Ge(~�H�����h�<�+e���1bZ��;�t�ڧ�Lm� [.�oi�L�C�;�aj����~_JݏB
4~G�d}�MS.�d�oi��N��.�qA:�>���OL2kM�ڍ�R����B����!��w� p�����:�}lܦ���S�#��߼~%ڙ�ݪ8�.�9)�5'Kq�����H餱�W�S�:�A4J�|�f��v��l(��!�8YÊ�� ������+s�18꜅M�Ԍ�;V:b���U�C9I�Gu�>4xGr�荒f֑fo���M�1=G���!NJA"�n��U�}oB�)@��#�Z���Χ;R)���HFڇg�a����BA����j�iw�L�A�;�~,0ǜE�\#q�IZ^*Q�����Xˮ���C�q �n��|`Gy���|���!�V~��䬴�d��bVV�&���u�����m'���������¤�!�[ti#�2�թ~�u��(tr�C�dL:���	UI{��}o7��Fd�DA�`�V��%i���4�9'��E���J�'l����7�\`=�=�	���)��i���t��P�Gkk��!΂
p����)J/Frp����+Wd�����kpVy���2l���-#�����~8��O����(�T(��=�a`zp�ޑ�0�W��#���"�bc�\v4���ە1ɐ�|�^6й%��W����
����*��py����5���c�#޴�2j�"y��?��9Di���&3_�-٫�(���0��\ǁK�H��t&k���s6�p�����W���o�?}��	��@Qٻ*4�b��$:�ɟj/^�!"N��� _M�5�@���H-O�^G��v����-��r�~T�U�|/*ƍ��$�V�G�����p��)ځ	Y�Ϣqp
�<8}���$��-~'��#�8y^��2
����Ĝa��b��粴Ĩ;��7���V\��Bd��h�$ih�v���ňa������L֜��1�|x�f�+��(r�U�Y�&j6tf"ң��
��!���%�1���ހ�A!�(Һ��H�ɇ�~�ҏϕ��'} -E�v�g��i��A���-d/��9�_��e(0��Üy�UG�nU^�G�?,Y� �L��Ăs��Q�y�5�TT��0	�DI.���r�+�"�?k�(ΐ"|w&����Q�FRm���8���S]$6�i�'�C8<�i��QN�Zʒ:>ɣ ����w���p ��}V�NuqK�#ܶ�d�y/���-~&�hw�QPv	H�Laz�������{P���a�c��H�tǋ��D�΁,�)[��}#��̡@�V�R�V�� )61���AY��*c��i��
$$U�j �aL<����Fz���Ŕ0��x?^���z���0�qO�U���^�+��10�����gnI��(�܏���H��\�����H��]�sl�:1��7�솕�03����tw�$s�6ƪ��r�)����	
W$5)W�@�"�$<�@�f���bMxN����.-��`1��`eFU�A��p����%��Tt���yƗ�Yizf��ϛyÀ^�!�vfA�Fr�7�Wl�t�'�vy��{�v�l���>��E�:_p�G	�v��mc����8�?�����"s�Ew𘬖��Rd�Q94r�B��t�ԣ68 ������{�y��Rz�~�R���Ë��09(�3��#{^�=���p����t��{4�;�hw�8���H�`���K�=<qMAf���(	�էUNW��D&FT:р�a��;L]W7��
c�|h�N5��� �@�X�nI�����-����i�A<���D��j�J��D�Vo�Nl)ɟ'��r�uW�^r| �7rM����=�gFVV��h�J�1ї��7>��-��o�р{�����_a��D	�*g���l#���n�0�jq���gw��#��1�S�<y=���C�P�A �	���b5=FM�2d�|��uoK^TR���$U���ٳNC���κv�ma\�]|ؤ� 2 �s*�t�k��H����N�[wZ��{R�f��٘ߤ�\6~��"�������o���oU��5+�+Nq2o�� N�3��h�ݭ�f�Fu*؉�0�P39��%A�?��%�[�r�BG��FeR�\z�j�F}�������B�fH�1]�a�;]#��ܺ:~�(Oi��Y�T��Ȃcs{_�C�]으�	�.ȱ��C����=#��$b%��VW��U�m�D���G�������#%��s[�� X�6c�j���2���>`�W��ݥM����Ja��+v%��Gb]2�l{*����F jS@@,�c��Z�Lx�i^�IVg8��p��-�ȡ����Nu���8k��W����3i}���E�M���}&B��!�H��<Bl!�O9��[��K���a�j�=��:(_C���nܒ�h��1���+����.a��pP/1�d�d��"S�v�N�Z��(�=Us�j�Q����@�^�� ���/.���W���v��甭U۬�!�;��l����*h�U�fƧ=|�`7���_�M[���~�{��7�)6?c���>euM���X�� M��+O�+m�]i�B�8�,Qr#����)�Zv-��f��򳾾脮�O���s��g�S��5�;���׏#�Y0�>���M]wPZ��%f�� LK_�jҚ�����EP��i04���.9#���G��n�/��$�:�N��AБ^�G8���Ц���Mc�\&�p,Y"7)W����0E�9N���o�A���5�p�Z���ǯ�����$A�kcI#<���ԗr����)�{t���xz��;������{]z&3	�	zR�v�N���o��lwҕY�\.d}�v4���[7x6� �� �ウ�Q�o�[h�����Ȳ�
��Sg�@�߮�u*�]��]���Z����p�1f7l�j*�Z�ڎ(�=n���tfk'�T�axL��Q��#�,�4 ��B�3$�9?�2�];�#�Ʉ����>�����ub��,�з^��;嚿�P= ΰL�Z$�D�{d��ҭs��z�2���"U�U�I�y�l[��d����6�*{P^oG2�U�)Th�����w,����)]c4dVY	ce�W�,��v����3~;f@S����c=�O*&6)n�2�,�)rN�8P��5ZB��$/�r��� �LS��~�Y~�֒<^�R�`��
^&|�nVR1��<���ђ��Ǿ2c��ĸ�oq���>T�� oX���CFJZ�8����^����f|�]����(U��5"z��J�`RZȗ��I�M�ӣR\rs@����z�����ϗ#�7��s���q����P�Ol$���FJ�v3�S6hz�5*m��.By�<i�g.=�Y����y��)@���k���G+q]Ze�8�soK`���uS@�(Wy,Z/�~:QZ���M��.�82z��A�J;�	3�j�a�w1��>�՜��-f��!����G���ɣ�}�zDQ1�+�1��*��d'-q*U@���:IJ�D�z�\P�������07q�ks�G�,^$5O^X��x3�u1�5���>�p�e�Q�b2z���ny�.
����4�-{�7���bu'"t��*[����ۓj&��J�< ����8���Ō���"�!�ͿVa��`У�Z�"��o��Jf���u�s�	Q�4S>9H������g)L�i�;�a]Ҟq���㻓qfOŁ�����A]=����s$�MH���j=,ƣ��C@K_�D�x���Ր5�f�;��{¿^u��!�P#���,�ՐH��=���<,�g���+p{�fH���l��=Q�d�����-�ka�d���v����+���0s�uc�̻ҷk;�VM�Q�Z���a3Ӭ�&�}�u�3j4i���!, �jE���L����Y�ٰ���d-�Q^�j��2ܰx��Nʓ��f�4U�����|������(S����$��n�%��c�6�ÅD�M%�	6G�u}��?��.��Vu���o�{d�װ�����,D*�C�1u�\C��;����o��Pp;.Ԑ�_�aB���K��Na#S���N���/u�Q�no�èZ�뀬z��������AGQy�W�g�����U��r����7	E;e� CM��L�u)���:��h�������^&�4W��EmǄe��J�掳n��p�����i~eZ^m)�g��,-�=E=0��=8��j�¦�w�M�g�+��@�kA���+$�\�h��ȍ�O
��g;1�1�1�]�������}��b8��2�]������Є̜�^���J
oT��+����Zq�d��6�k�ji�c.�Z���˱�����	�H8�4&�P|^�A�ث?��8tFC�����t�ĝj�M(�ں��޶�M��M�K����d� ��"�iR�uNA�o�j�"����Q�/���Wa�V�^�pob/���'GvL�D(��5rsF!y�_6��nl�ˮ�~����JAE���u.[װ`����������`(� �hKau�=�I��t2���4��-�9)�b�V�e���s�>~�?�qi��� ��C-�=zz?]�e9�a�xJ�ȝ��������$��6���$�����m��K���Rr�ҭ_��M�q�q���4������d���sd%kJ�DmWHc6��Ytw����C�W�����R��,����$��rK�)�����e<�$�*��n� rFt݊����(1����I�����r�51EZ'�gs��j�|�b?�%��,�@�g`��-n���	�<߯J>�N�"�R������A11{��k^'����՘ �n�q.�_M�g�-&v�I����JmNu�1.��	�[��o�4�+G�g�-����]�0K�͍�g�[Y[� EN�Z�����nW�=�W#�8�{��)2����U:AQ8�ܶ7]��Y��ҝk�5jE�HXg�]�����jx�znڶ7gÑ�0�b̟�!��M��G��N;�!�g<Wi�.���߮ևc�������Y����J�uT/��»Ɂ��W^�UUlRKK%i�.
�K��y�'Xs^A��[�c�Z��<1֧(����ֺ�X��^˰)�`S*��̏y?*g�p�ڴ����IyS=x�/6���[��{֟�C[����0��^~�k�q^�jn��ef@�(��C��jl#��f�U;"���w�h��G�qq��j��D��	�����Gݟ�.�mʇ�w�.}���I�3M���� ���1��[�Q����+2�r�w�m)�0���B�+�������rV_ ���Q^��C��;�ş���,&�`�kR�+�����_�86��7=w7����&H�i��hhI�#Kq���|�~Lr&@�6O,��j�5h���Y�M�Ҍ�7�"����8�ZH:I�H���E��6�k��G�ʐ5MLjƯ8>������v��Dcͷi�x���F�&�'y��H��*���Y���]�2�3����;��+�O��=
U�c��>� 0�w���#�@��v��eV��EWk+k���������N�6ZΙ�粔���t;��s��-ٷ�ɺ�E��C���� �/�q�.�آ�?yU)�������ĸD� �J��ή� N�����@��:j2��T�����wSr�E�-�������|��мM��쫿`�d��D[��3v|���� ��@�E7���L�1r�3=���r��l�)Cͻ헧��z�������l��G�wb ���F��.uP+tm5����gZB��*�H�Ӻ���7&�E
)�dW�GN[hؘ����Y�#J?���Da�����ZT�0�YUq5����i;6P9�B6�����u�}�|�XO#�E�Ϗ\u�+b�i�n���oX⛾�N������#���Q=[����l�wO�d�9Gj�!�P:/��ܧ1��/)�ę]㧞}�m�ַRȁ�wלz���-O_~Rt17G'����=U~��dY�D2����Ϸ� PCDn��-��I�:�L�
�t).��ːz Q-�<>Ԫq� �7it���\�d �yv9�;�A�k��^@�� oЉe���G��u*\L�#p
�r�0Qynh�|R_tY��H�}�>�sC�7�P��,���K"��p��[�y��muHy�X�H�vv����Pz���7�v�i����1v a���2���c�э�+�K~/֒o��^�V���x�	� Ǥŝ�G{x���Vt�d�)�B��`ӿ�f�9bD���E��j��� u��1�mH=O~�Aߍ�r��&�=�~����FY�0y}�o^���{�jjJ��V��`�51��⫘Ϛ,�E��I5�X�.�^����݁b��\'x*y����-_'VD��xs�J?z�d�m��s1��(��w��	�ԝ���Wc�o�ߟ����{KB�犈h�̺R孄�s���O����U*g�Ә��M�̨��;�����C��m	2����(DM�I����g>��v�j~n���U�}gP�[�>ڜ����-� %A�6-<�ۋ�c7�զ*t�\ ��� �K�P*����A�Gb��&M��6��:/ 1p
� 'zc�����ar��ryO�@�ѽ$]?��Ewn��4ޑ��2�}��'�m֯CӑG}�&�&�ܔ閃��r6��q��#E� ��vS�+�� ��Ѭ�?S����A��� <o��������T;mm�t���7�e�΅�;�e+{!�-���=�0}��#83�apVH�us��e�Dx�C|������\ݩSc�	��rz�K�]��!��v<i�j���*ߏ�JJW���ƾHKIiZ*��4��qIޅܴz�	^�c@ ��l��T�1����J�'��P6�m̵�>w��v T_����\�C��i�ʟe�0hh��hi��/'0L{�2���H����N�}�J�3t�ذfH�|\��K�i������M����OJp;V�N+������=�n�g˙�v�"G�)Z"Ĺ���~�x��D9�����M�G��M`�?�6����>8�4$e�^������P�^�Bl�� ����~�S�7$�rI)̿�����ȁJ.�t��0���V�+>1��7C�s�`�z3�ڍ�f����;u������&�3C��������)UyޑrK^�4�ٯ��>�Qv��a�����7ѭ�|����ۡq\u��hpD��k�ַ�KY�@��)������-7m�lA�S���T��X9�0����K�e�-��D��%t�C��J��A~��� Է@�m��k�U��X�'z���I�rE�ӧ�w�V���P?����p ��t���Ҭ&��d�ݗ!�z ��9� �C�B��oη��#[ڏ�<����^�q,\��^�]a{�oi*�Z�9�Ǘ���;�Mky�{�i�;k�2?��=���@<�=�-g���ȭiy�S�^��P�+��ʍ$�S(��ȳO1���BO$�� ���7�kw�:Tø���&M�x�� ݑ�I(�ƨB#,��6��V�r4)��i�����D�5��`��f+�>���OS�|N� ���I��V���'mB��U8?т����;Ѭ�3��Ծc��=�&RY�@c����z�����n���������W="_h�A�A�/B�βk����f��_&�8�_�����M8{�V~X�.��D����{Q������#��"��ﭜ�Z�Ekr�X,��ղ�y�4Y�T����X� �!�~�mN7��:FE#MLB͡��(q���'u�?k�]��w��.���f`"q�I1�����>�0%��R`�KZ�I$��:|dw�����{��v����54�~�l��J���٤GW3#�L�XO��,})ʇCi \�K�y���K�@d��%՝��w�U��cd���x���n��70乛�B��|�4��c;�VH�P��E�8��ɇfN*<���!����:"���{�,Q��	�܅�ڧT+�+����7�����_O#w���Pl��PQ��[$['V-s/�Z�L�t<\�Dl���K*�;"�H�w��t5���<��[�� 1�7�G���"�㛭J�k�c�2m�������-^׷C7X�hp����� �N������� ��Pa���YA�3���#�E�f�Y)*���${�{YT��o�vt������f�o�9q�c��wov����
���#m�������n�;�� �?�J\�q�P@��z(��S��栖p>'���t�!Q�<�\V����9\
�[`oڥi�	�&H�_�qA�0����/�_m]��7�0a���.��ك��{�yc򧁻	�;�m5�By�PRO;� �B���~d���Qp���\�m�tP��X��w Eec�赖���B�>s֭a��
M��B$
����R�߶�X4����7�A�e��r��g����0��JáydJ|Ղ����F�3,�w	Ƞ��,Fb7_{<2��LDG��U�Y1°�}/r%�i	�����@I�h��0�Y����+x��v���<�-
��#k&�)Z����4��<A�}�HW'���V��
@4̐+���D��m���m��|h�R[�>^N:IH��XNO���:��%/p�6�����s��XpS��
o[���EɅ.�/Ҝw�#t�e u����W����!p�I6UB�r���� ���y���Ui�8{��ϋ��aL���i�g�y%�% ����/1ƫDG��z4�}��@�Ka��[�2�7G{1�ž��f��nܐ��!�q��c��%�*a���r�E���'{W�%��*t�ҡH~�\.Ui�r��\c��x�ℱI���M��c�g���\K���A�O��F��Eg�rѷ��K�azM쪞��?��M\	�+ŏU-�6%=�Z���
v\.�k��ߠ�OA}��� CZ���no�n��@[73[oU4��`�ҋ�3%p��xY���yv��|#�n��{�Hf������L�h�u�ԁ�������p����-��y�;�:��A8�֙��V޺�jl'�{�q*��=�t�/���Z3�h�ecP%%�<w�
�H����x��zm�#��p;
.���ڱ��=�s���� Z2�A�r1K��k�L���5Qb�d ��Yګ#<��9�����՗���czN������TSQ��x8��{�P���k�!�[Pw#}�*a��l���8�.TG��x��lB�[ᐤ�/>(�Z�1�k���Uїcr\	�@|n����z�B�R���\� �o�[_�"<�F[;�l��Č/��~��Ṓ����g5s�d�v#���"w�uK[�7S���Rd�����זּ��+U>��(��xYxh��.;�-�*�/�Q}�i����zULu��찋���|�?9U͌xI�0]M6�ѩJ��Ay���F)�w�6����x��1B*��j�rHG�'?��]���̞l�U[�1���O�Ht&l��5.�J|�n9�t��ַ���~1��o"��<�����;��%��XȒí��.�Z�{����?*���b�W�ěv���p*�Y�R�>A�Z5][O+�ɔʠ��W�6ܛ��:�����V��a���K��Ԧ,d�le���{��&��%�������YtR2�{�µi)�$�s���)�#P��h�4L��p+����c�Y8���tp�-os�CqP8��S�Qt���c����#�c�~��KQ����Z@GHgk�a���a�퉰8��sw'��]�E��$"����z���1b����b��_\�x��|�:_f �+>���UK�`�A�������𢠴�y���D�D��70$�ҐǙI:a<	����݄�V,nVs�7U�H��V��[�ҥ���E[Pn�˝�"VyC���=!�M��x|
-?{�$�ݹw�}�H4w��7�������D�t]9SP�p�ΈNb]��F)Ѵ2�V,� ]x��iE�s���q~KZ]���ߙ�0z��O���{��m�Ŀ9])�U��ˬj��M5.�ȸ�	1�!f�s����_n��;+�%���N�«$�`�����gP)[UWo�{j'Y#(�(��O'�xZ�����C��h
�B�iꈚ���g��8��C0��o��� Fѹ�'���g��B�}u��>�@��k,��(L����?jo�a��cC=� ��\�A�Rwk\v}lM�D�}ް3���uU�/�n�_@�-����Gz�J-w&v�2���Y���t�1�S^�G���q��i�s���s@n��>��_tE'?Er��^�u�栿����:bhkBwǘ�V�%y���W�qsɏJ�ħo�	遧Ʃ�'�C�m�ɜ�P{��`N����c�}���r����z�q n^ĥ��RƎl ��SMJ/�����=��J�G�Ǡ�_�������i�%A���4�н���S�qG�T�Mp��XRi��@�P'-�>!qN�d��3�X�;�U�_ؾ=�N��z�N�Wr�2�4a���EP�ɝ)�f2w�CUat	�yp���L��3��ggS*2fa�5���ҹ�ٽ�+�5�C���\E�9����Zˊ�2XҪ�7��I&6n���s�%�y�Z)L�t��bN�?���ɭ	���t���X�q7H��5#�ۧܥ�lrk\7�h����,r�W��%m�N6�C�z�'����Mر_���R��F��Nz]�Eǈ��'|F��]�/ ~�v���Z��y)����)��W����&^�]�n�G聅Ĭ�{�5���Ʌ�ΰJZA�������s�� �Vo�Ϸ�L")�M��a���/q�F��NJ��7�d����^Ξ	��z�q����<p���4/��.$��J�B������<�:���O <Y�¨���pʇ�� �me#gFS��6���+�����۴ ���̚d-Im����9@�s�Dk���7����A�vV�X3 �]�#k�cEY�x*���M�P�.6�^Mq=p���{�A�� FdS�oc3��-E�������N���D�n�%��>�� ԛl�5��(�9~`���\~[�6�8pt�!��:��)b��u��jR1�\Ag1Gap�f3��Z��嶇a<e!h9Whg����s�$���h2ȷ(Ba�FnN�S�{�%�����kΔ��ćK�'W%��2�v�^��`ک�AvםV���/e��&/HD�oՒ�����/C�\�N����@����Reͳ`�*P��'���/Z"S�Y�m�n��!��e=ض�\�kr9j�f��C�'����F�נ�8���x����j¢��a��=2��tم��ӣ0���{X��5 �d[%SXآV*	}Xp�TZ���S��Ch�V�ʢ�����7I��j��?����FY����]�3ө"����-�
ąk"
A�t�zt�\�}t����_�و���|On������U;��fG� �5�$6I�Cӭ��.����]-��;T�-Ö��,&Z`j��qY����T��1�֌���5�#�d��%�YV٘�(1h����.ʃ</^ڹ��/�a����z��+3�'�<���_3l���ƚT3�b�̼*,�i���	�� �FLLJXo� ��1������e����E����7�����R�}3��!�m���p�_ӃC���j��Zn��dm7�+�Ӡ�%�VD�Xp3��9�4p��Ƭ*�L9J�@�7xAs>����A	�A-��b���(i���k�v~9v�ꏆ���V��{�B�O�/s��-e����Z�D��2x��ı��G�D�%�ADo�< U��[V����8��i��}_W�"�؀��T�����=!�	�d!���?N0hs~{Ȼ=�B;�M���D/��mrP(q1� a�
+�{�಴�Waר��3 f�ۨ~ d3�|m�ܖ��f1mٛSy� b.(O8\h�������}�ᦶ+.�l.=Ԩ�����	6h�*]��0,DB>a��5$�b��C��<E�a4�%�`±1yh�%��-�mRޙ�1��<50!���P_��h`���ˇ�w��?,�W�8���O
Z��eج;Z�����?��Gޞ]2�B@�2p1ɤ����k�k��i�r5Yf�k~���hnT%Z�]�_�% ��S�1w����Sި�3���(�m���S�\���Cw��sPG�Q���tqqd7h
����Z�T�R��5ca�"�j�VD3��vB��F/�l�. �8v}Y���*_�}�m�s�e�KP��do1$���7D�����}n� +�^�l��3��*D�>����Oڍ��#���0>4��%ԃU�C�W�	��H�vR�Ӗ-p�mԠY/���3ߖ 1�[T�l	�Iں���6�d���B5�kw\C7�ޫ�\Z�T\���r��s�"�1�'��Ⱥ.E�<%���}�q�����J{H0W(g<��̨���ن�&e��	���Q�Mw�;��
qy��\��Q+ox?/R�K��ы�p��cbm	��$�o���=�]����ꮒ[�n��p��\& ��Q�$�����{������z���A��"�v;�G*,���N���]K�K\6��� &�|���e�?[b&���z�u� ���FЌ!*�k��!
��eg�=J��Ż�W��ŏy��u���Keø/B�l&~��+fy��'�^YdE,k�g���a'���:Q-��]j���Z;x�j���1�,������ѫ8��?�V1R�P:���u�})��g��ђt� �0V�)���ﺝ�[⣷�mm�V7�(�!r*2�_0H+c7+�y�.��Y ��f�$?�^]�:��&r�/
~�L�����>v�=3c4ux�����	V�[��x�\XY��vp��5M<-�"���Z} �˺�v�j"��þo~����_��87�v�P�۴�R�������ћ�QAW6dmkց0���"��ii6��
}��K�dšvBQ����X<u�l=�Xq�uGP#���I�[Fo@+����J�O�g���@|_�/�C�Kr�un⥬�x���,�	�]���/M��'_�,�Kj��4R��ڐ4���Nl�L��b;X>Ԓ��Lv��(����P� Sj���C&�f:��_�E���p~~�Qmd�WR/>b�uɭ�B�{Rk���P佧h��� �#}�M��ͮ���G�(�X�^���Q-���sYM6�dD��רa^J�u�q�������?����!
�I�y#{�5��:�����%���$�;ǭ���:���Ý?l�h8�r�1�~���˾�z@��%��3���H5膹�MJϒ�b���bZ*c��qEt�d�;���|�	C�&y��҆~!N�j���O��ߟb;Bfj�+4;�;���i�����Tb�/��7�2[�h�%��jh��J8���:�u/~�3�Y�3�/]�gI�Z�ؕ�y��q L���;��5]ۻ8��Zr���o`��\|���$�4ȖxK��$J�`��Z���M[-�b����o�_;},U4r$�M\5r�6�.;1���k���uΡ3�a�ډ�/h�*:���N��w ��b�B�+�����y��;��[�c�\YZA��s�\�Hٝ�O�rg�Ο^���^x"tO&ђ'�i�x��l��d��7|����� eR�[箼S�(|>�'e6[����śn��C���A�ɀ� 1��Ub��*�{����d$��.4L������-3h	T�'��C��^YN@_j�=A����\:Or�j���&�")�:����L��*��M������I�4�T�m�mk:��m}�S����5-�c���Eauϳ���4�@X))��3�%{?�G�����w�&r��QM-�v�H�N��4ߐr�0��=�^޷9�s�����u��"�ֵ�[���%�rk^� N��}lY�b�|�3����ڶ�yԭhH�\aM~Ƞ�:��5��B��r5f�̙�u���q5#�[]�"�hl���w`+M�T	4�E�+X٤�A�@�a28�_mYBU�wz!����l�)�GÙ��]�H�D�6����=�c�X�5Ry�����|�GM����C�P�"�a].é��s���M���bK�a7샕f��L�|ո��g�a+�O�UUx���A/�8�>cZ�̎^q��aB��N
�`{Ʀ ���H�q'�(�u���MM������3��8-�4������d�${.���%ULX�Q4�[��Y�AWt:ܰ;|c��1QƃW�jz��z�च//͛S���⅓V�@���Yt�DQTx�������� �Nr!R�Y��Y�`��i�h-5v��^��ʉ��s\�������noኀЫ�sr���E�x|�Ӑ4� "���y���X�1M�q�QH�y@\Ι����* P��S��M�x������f���MT��ɗ}��K(����}K�i�Ļ�J���e�H�(�,
*T٪uD8�����Pn?��o�S���r��}� o]�L^���U҇G�V���{U�0iJ��6=�f�~I����H+��̦	�Iӣ!��&�����ͱ�tCf�L�f���U�b��#_���d�`����x	�����(i3�O�Ts<�w��)=H��������� �-i)5��@�-q=V����Qy�%�r^�H�"�iF봍��I��Q�qOU�{$y�:/�ƒ���v���ޕ%�K�ʭ�h[#�B��ܭJ�c��.�V�7�T*C66v�x�^��_��ȴ~EM�����,��C��v0������_ۉ`S-���	�\ڤz��]���$�W�v�ȕc^hTb9���
6��.�j�Z��R���D�������l�E�?v����F�G�#.T8� 8�gK���W�Źܧ��f��iA�E|h�-3��������͂�Z�A�UTX~���l��v>���	"�#�,��2M�z�K!�t���.�T�
�e��D_���S!�'��υ�������@�o�#��M+7/@5S/�����%}��d���&��y���FWMA�k3� ��>t]�yk�ʣZ:����_� ��;<#�eL�?Y�O�YowG<S���K�i(�6}^�8�B�(�=Gi�K�٧Ƴh����Iȴ���X.�ƻ/�q���"u��-��Z����1��#����Y��%o�딱,���hpB~��d�Y�J@�e�`f7�����E,�$�[2�[M�&�	�~''���G>�b�P��4������@?�F5��D��>��@ �ۿ�/���7H��S�MB��N���˒늲����]�$zyG׋X��CK�Ҹ��7�Umi�-P�y�iu�@r#f|�Tܒd=|���Ҩ�٥ 8]F�y\��,$�<҉&���U�J���V�w��l����^��+�9��6v����ҩz;]B[n�6וs�N�a�_7|�-*5�?Daɹ_В޳V�������j@�cΝ%?Z�4�ђ���p:|���X���Uj�+*��h�DU`�л���@_��Pڝ�dć�����h��X|I��d�Z�����9�	- ���	�prb���cs�G9H�,�A��\�߾��&X��I�Pn}ɫ�+.Rԉ�p��;���v&�!��������d(����J�'��j܎!���4�� 6�N��!;n���G�&�0^�}����+���<T?l�;Y��U봧��Љ�Ur�t+���厵>���VC#e�Vh3Zy���,�����Py86e��+�C�Y�c�g�`e���7�59"�s�X�Z�V��Fy�C��_:@��0����t�Z��&����;.`ilŏ�	�E�����#����/}������^4�}J��Hs�-E�`jg��/�z@|rɁ����Ƣ�8���b>pG$�!�+ʏ\pIc9�TOD����l�	D�9��4}qQ��7�@fl��#��較��$�q�? /��2a��r$.�[r6��(O7�� !Xy-mGr�J]��Hk������{;�1䃿1TN�@�B��¼�o,�l�<]p2�2%�:HR���&�
~[�2z=��y�Y�M��vC��at5
��,�pW՞�ڡ��#�>��9�A����Q��J�D���&:��-�c�a��vD���X>mqC7�p����l~� �[Z\�';����So*^����5x��.@I @�|��u6�@{�(�TҜ�B4��o�H�l;����4��f��MܵpT�UD��` Φ$�{JX;��fC�"����3&����
�K����Ȗ��\:n��;�M�t��K$�xM^k$"�כֿ�Vs�e�aL�Hs9պ?Bh��N��XlG!��Gxz�
<�n��mռf��_1���1D��x��kY�rnZ�]z�Iw+�a��vZ�N4�.�`<�S�Y�ʑ/��c�T��T�C�`���81D����-e��� 1���BR���Fjqz�$f91jl�}��%��x{
���7%�����CN�{�P�%��?hkk��P��,[��l����QhBO��SЁ	^�[},�+�i�j@h
���N+@�Ǒd���y��rXhi$�Z54 ��ZMEK]l��⺨�><9�Q����������Tbi����)7�������V/r@�-E�����:#@auV<����k��IE�8+L<�9��VVUXP^����}�?����A�2-�uZ�Y��P!���������x�:Дsy��:ߒj�]HY��P�A�6|��,��g 2����omzs4�}�x�$1��	��
��)N2ݜKW���nᎠ�s@7JDP�����2)!�@��� e�_���`�X�٣.��s[Ǳ�߱j�ZKas�Kp�!��I�*��+��H�S�xs��04�*��boP IUA.�v����'խ� Vvq 6��%Ⴝ�w����sW	p�W��`,&ϊ?�FPӐ����~=jN��)���)ZLZX"�[���_Fo��7�=��D�R�@Iox��H���h����ÕAt����s���1�ǝ<|^��f�J4&��1J�ز�Ha���nzŀ4�Ey�}�;�W|0%d����t	�-���XQ1��2��c��݄�|�_��'A�{�*�ͯ)�����l}r�)*X�����A�!�ǐ�k�#���.b�N1�u�d��?C��)���rӺ.�������3Ҝ��y*�2^;�[�㣸b������ge�b����%�@��&ԯ������k)�y�b���D�{�Sj�|z��Q�N��M@�[��?>����m��N�/@e���bf�"�桤7s*���� �͓؁�M��3��w��X��|H�#]�� �C+�4P��Am&4Yp��x4� s.����
F����#��X�$v$cM:��+�#����B���6U�|V1v�5��Wa��Z�ԌŬ��$'�Xm���>�WY�����ϧ8��)��o ��D��ٮ��	%��9�}ZA���M+@�Զ��؈��w�SdE�>M�uL|`���vۂD-l�\���������%a+����������H��m�ҁ&R�dS�N�D�����7�'�d�gTj醠�^�(ŀ�O��R-��|}��a�{�g�����2N�I�ƾ�\��4l�
���v�E��"b(�?`�D�94s�k�i��3��b<�}�����.�r6{D1��u��4.����O}mؘNSn�˥�j��gIM�r�w�0��r�&f�v�d(Ͱ��ŭ8R�/���&0� w�]�!EL䩽��,kf\Ru6#>M��� �f��u:�}��1!^�?�p2!н�5�W�n�b�oB%����4n#ʒ�X�e�;���nU�K���v�#;���x.��^��/v���I�C�x�l��t��kY�A��Q��ME$m�_I�p�a�k�j��#��"d,u3�/���Kd>�v�Yfؖ�+*0����Q�ja
΁ G)G�J�����Xm�o��8�T��֮�ŷ���o�6sΞ֘��s��-^m��CI?m]�쵐O��<WRQ��l	��#�º2��\���Ȱ��:�b�_;
���|Y���執<�V���ߪQSق�[q-oNڔ�j66���h��CP��m�G(�:Ӹ�� �&��ú�p"�����䅼�&1 ^�<Wk�lO�.��\0��&�p�?z�ĘR�.W0u�9�0"28@�&���\%Ebb��ФZ��sC����!��r->��tz�~>�Ӄ�,�����c%�ѡ�`��B�� ��T�n���}�{��ol[e�	FCn���j���?=u�-*%��������**�Z��J	����=��&��KǬ"Z�r�D�`H�v���k�:��n0~�?�e�J�p'��H��=�F|�z�'������o�9�5���i�5_;��-PwK&��f����w�6gJ�KD�<F+b֔���9�3�x�&�xmcyzitn�1�a`�U��8r<��b��E�6I��'9�m���B(Br��f���*O���j��_>��r�ǅ������iW�?����p �+� 8l��O�/�Q#�>a)�C��_��\���Eߢ0[�"k�"}6(P��Ƕ��6�|�?�9(W���:�����Ɉ��=J$l��ʞ_�>�uڣ������	^Q�r�mѕjS<L�	�����S�d�w��'~�$�O��z ���v9��\�o�(������I˔�}���x��q�^|R��!�g��$Q}&��e:��+�=C�4-D����j �	$��ϴ�q�I�7�d�4ӫ�o��H�u�H�z��	_bk��Ů̓��Ξ��=����Z����p�+h��8K��)d��Q"��p�[�Q���3�W>��KM3�������wod�/41,o� �d\�$��z�NJ���כ�%��? ����&�h�O������X����M
nf��g�J�X�@��^a��	x	��+̨[1��	�˓���U�E�9���*Y��+b����w&�<�WYH�^���
mL�<�O.~����Ф��բ�w�Pk��F��� ���?�-����Y�������=��mb�'�[����liI�Q�%�5QnL��?���+�pG
>�Ѿ�?Ҹ 5u#�=.�=FA��V-]�%���ѣ��ҵ������P\�8�	��4�y2^��O�����P�f�3ȱ0J�̜�������y���?�l1n��h�5_;�Du���b.a��g�C0s��b�UCo�4�$X�#x煇8�b_���pל�)��_n?w� ~�}���P9�ܳ[��d�ïRld�Բ^��/�܇C��XkF��^{3��}�N��+C��,x�M�����+�X�Z��X�~����Wϟ��PTM6Ѕds��<G�k�T�a��t�RQp� �H����#�D������`V����NoBo�A��Vi:��K3ï�mK4����	~����IQ�����I��a-'�ެ�KE���p�ǫF�p�M* 8����6ߕ�\��Oъ\���4gT=�B1���0;����vm��{XX�ga���������f��/ |���{�&o"�r�z���k��|`�#�۞�Q�ViqԦ��z��c"�5dl��Z�4�X���=u�\ɳ���	zF��Ku[�$��6b���'��Z(��1�f��A��E�%^�����{�>�EL�����A6�Ӽ9��!��e�BZ�t�X�*Y���:5�p3�E����rT��dn�J<B3����׹���M�Q��ޕ����z��Re,�_�딨�~C��z`�sG�6��@�\y��t.+_���;��5
"S�Sާ´�@�� L�j)L�3Uy=p5��n�,�U�L�[T�5�����m�`���
%��]���n��xb��}"�G=kE���	5�4�=��T8m����S�k�e�x��)!����]����\nv���@��\	��e��&�ry«x͏^>*��9��M�2WU��J�������0�-�TY�-�a�EBw������:|�����9��BfO g
PtN�&�؝��mk8���*b�vK�B�ڋ�g6���g9@N���U{1�� �-U�����*u��Fd��M����"�������,<|/K�V�"ėJI~ļ:e�n{�(����v��<d?'�.]���j�(��}�Vy	׽ƥ̓|�Ǆ�������oU�#�A��DR��8v�����.�S_�r��Y���6OQ����2����bk�V�w`�P��(�uzo}.!8]�G�YN[��:�d�غ�@
���(�}!By ����ٵ�#�'�A��d�4�#ᐫ�)83��?�?����������٣�xf��S�G���Cq�T��(S㟼�HK�v�Ę&�[���Xʈ5�m� ! �C�qoA�C��V��G�x*)�b�B��o�P��NCmDQ뤛.i��^�^L�aش��Y�l9i�T�k�>
������xiA��Z��.�KN׷ld�8�z�Լ�?]B���@�܄���� W�E �E|�l����_�SgZe�����@�e��x�Κ�)k�n�ߓ�A��q��m�JX���Z�� Z 2�/\��/�ƙ��'�<6F�]���.z�Jy�+eS�V��5ڻ�����hH����u6�v�6���uIF�O�M��IQ �~md��pź�3������D�S7F���X�����*�	j���D�':Pu�Adv	�1�!�c��T$��?�avG	��k��R����&Cz_2!�-[��c�B�,{YO�s��U�	BOq��%����J~H�Zz:C���`y�M�^���Hg�$e�;��Sd�
x�����*kH�عVP2�~-��FԼ���:���V$����.c�Z�Ò�5qV�v.eKm𑸡��\��><���4�����Kt�B��G�+ܷ���z��Q��u? �������/��u�̇���Za$�]Ɂabq��.����b�|2�����+�u�ւ�Z�<�@��L�l�a�ɹN�>{U7���>�/��5z3B��6�����"�
A�wt�}�b/C'�����m�4�,}	�!�Q����x�$��=2�MР�P_ez�wY���3��Wy,�E���Q#)�8��j��T=�3�����»��+���)��� w��z��T��I�n� J�_g:�嗛.����OZ���1�=V�/2��+�{����݂��|1�X�ߧo���T_���`
�5z�	�Vp�T~�d1榵�1���W�z��7�UW�de|v�wb+��|���v�(�|}���SW(���dٝ�G�l�E���
n$�7�dؠ�%*A�Gwt�� ��W�B�b~��
���pD�����-�
Ev�.`��l�ԙ��)������V��R�/�����y��u���t	�>��vy�:�1�l%S>��u9�a�G�ŋ������b�0�K2�@�QSN�JT}�Ч�x����Lyw2^��3%~�݀��<��̔=$J��z=] ��N.}W����:��b�m�R���]�J���L�9��>����_��N�#.�y��q�hO��<�q����)�d�C5P�	�K+�x<]��)<wmZ�feN[=���j؃и�(H����F9�7��"i{; Tl��1�h�V��	�U4�op6ξ�&ϨuӸ$��jU��ѱ��v�r��C-��
�'� KP�z�pB<1�"����ф�o0���>�J�i�/�#e��"�s� b��$zg�<�,��u9q���"N�����+�k�>�~
)Ycɏ$<}[�sFyh��1:�!^�z6�G��8r�:mN��T`գ�w�}�x�14H²2��h~^�ݒ�_������S�|�&��:T��I粈_����2|q�g�|�Lj&�%~K�6W�PL�L���x;�Ȉa1��i0�˨چ��<��ݣۖӢ��W��Țݒ�ZyI��i��V®车c��QA�#H���7k�f,�̖T{ј���N�^�6�qdF\��\}Bq���ŞH���P��}�����Old�>��#XX����Ax����j�׺K�vs�Ƣ���8L� ��O�.K� MR�vG$+C�Ʒ���cK���T�!v�>��A���Y�c���T�IF^7�|&��պGú�)ː�҅ӝ�7@���n�����c���R����>%g��	C�\��  m�8���GQ�0	{�D"H��Ԃxi�pݺ�Y1�a&��c�>X�G�K����=Yf<#�z�-~��0
h�4����Dz��Z���� ��m����dq��`��đ��2����.rHD܌��K�m������՜<�Ƌ���Q�\[2�ؔ�^�ҩ�s����Kb�z;,��RG&Q��V���/��,��EpZ:]�'+�g4�C�BT8�)�s��ɧt|�s8�\���n�4�l��%��6&iRsKf�q����1��ˤ�Gu%Sh�����|���y�����X�v��)��h@���f�ȹɓ^��XVp,������f�Y����c��n;v�"G6��6���s��(��	�1dk��e��3nﻖ�H��6��m���/�� ��*0yMj�����0���.��xcH��v�V�Q@��텉���^�2���::��[�����p"b���ͧ���@�uX ���O�7���U`m�
�.�G.���E��`�){6�A�T9[�)��9�O&���KP��w���dܚ�xDP�?��C�����.�C�Ǎ�"BI%����,�'.1��|aGP ,�Ay$�<�7��C�f�?��3a��n��HS�����?*b��-��c8���S��:��|k��ϕ
��#��u=g:�5���h���1��I��)%�;��&��5�5e	8R��ϛ�`4N�*~�5�F�>?FC�v��Nz�zs�g��3؆���������8@�����5>�N��ՠ������؊���'��c/�[5[S.�O�릣�Gs^~&h*J�ִ.���ثl�������c�3<�i����F@�!O�)W��|oLp��}/\�c��w���fwp��<X���h�`Dό/��a��*�_�:*���u����1&�������~�������v#�;},$�8�3v�8����`I�E?����M������&��v��]��(��7EmG�#3H�Mc O!�Z��`7S�0T�D�Ym ���9��o�je����F�X��tE��(J^�r!��;h�|�L@�lj�pv5�y��v5��
��t�p�
�^ľ��	�j���f��͖�+ʦ��&�˄��� ,1���&%��ȀUBAS�����cmY73yE������%��)X���s	���i�?�*������Y���F1�X�ǐ��2��5u��M �L�Gm�Ü<�«��8��`�
N�(���Vh�����?z�ܿ�s����>��E�kXF�۝e6<�[�Ӭc�1�~i���i@ԝe�ug����j�GQ �t�D�5 �l����������L$�.���(i]�Xq��o2t 9�֘*/#ܺ7}�>FEqy�t4�@�'aTKay�K���%��~�,s�ûg�J�w���#�����1�.r� ��<CaZ��#��ɺ���M��y�i"�$�Uq*���ӟ,[��k�RF��w�z�����՛��3V8����I��.��2p.qT�NƊ��$"E�x�S��OtyC ��"��Wc��'f�I/�Xv�]�#Y��E'_�����U�d� W����䍰�
 Miu�����Lh�VJ����g:���LQn�Ȇ�5�C����ò��;�[�ڐl���HR�L�%�"X+^�	́(i]�1Џf0�~�Sp�+ȧX.�S9��'��<L`W���۪�Uȑ����<���ޥB�A�ϩAU����fwP�	�7!�Y�-�U�&���E1����)��x��,4K�����t<F��g�Te��՟iK��!��jC6�Ktb��s��"�� ���j6�0�g����ݭ���*q��t��ȶ�
ݵ[g�;֣v�5[̬�"�<��K]�O5J�j����� �U4yu@���,4�5����[,~��ie��ˊR���w]�1��\��7�1J�_񴆆F�� Y"�*~��@
2u�W �DΌ����l����^iy�Qn�ik#����B�-��Јع���u0����C~*k/�O5y�θ=�:d�e�YA�%�����K�{x�D��ߡ531�i�*e�]�9�\ ������ M;��#�Z45g��p�S��]Ȱ�Q���}���_k�P���$�ڒ��/���)YM�U��r�**i9X5o��I�C�N_S!���~`�+��)��U<�����tV�bh�݇���z���C�و���F�/n̚H�=[A�d���i̾��`��>š��O��e?\u�}G$Z�]!�aJJT7F�3�v��:�)Jg�-�~�l%�=�>���lh4�c\�;�Ct�^~�2x��7�n:��J�
.���'�!/������Í��pVS�RN���.����btRC�_f�/����ɏr>9���������s"o���ę�Y].Yv�X�D`�y�]o�V�������f�è�L���fFu�h�����؂?�c;H]��Ģ���s��JǤ���0�d��o9��@䔔����J��:�h�t�����+��~���^�,�	,��B��a�<v9��D<$
k���67�Q�;J���w$�{ǗI�{q\p�"'��4�t����0e��-���W�b̸{L�n�Q������b04/g��o�#��Ō#���D�DLDlˤ���x��[���>���Aڐs8�����s��ً�e�����\���c���x� ��7��4V_F�J�PF8J��ъ�B�9������_O��o��O�v����c(KFh�2�
��J���s��ǋ&�j���I�VO{M��
P����h�����m�R����
�o)�n8�6�Q�����zk�A��CBg�$K��d�^~u����l@8�gJS/����Nz	lW�ݕ]��� r��a���gRژm�}Blwpٴ���/z�@����(����}�7���������V؞�ϰ�J��؃7"X�Y�uWw����Z��.U����U�E�t��`���_�G�S�O)����5����B ��-�E{]s�e4���*I(�=RP�4�^�u�̂H�f7v��L⏔���*W	��v)�y�ƫ�F�|
�xPj��Q1���;�3�&�:>��y���yf��2;�
�)M0�l��T�3��g��:_~�l/��.�E���!�?�Dl����0�$)Y;"���2Z٨���:A��q��̷j��B���u�줋�\14����t���z�
9���(+~�
W�:2��/G+�-��E��g��UPx��Q^���^O�mi�h~w��;߇4L0?�Й�_d9CH�\���hA��r���{c�d>�p�[W:;��&��`7]m<�I)�F(��n�tb��	k�l���h�g7�9o�ô��vu�m,�b&'&�[bn���Q�>�0����+�V	�ZY���ڛK܍7���|������!��� p�I�e�N���9��a�V�1�11��/L�����<� �?����jn��_O~�];(S��?����8Я6�ʖ�J��s���B����X{"M��S��ow,Z�w��`�$�M���i�A\��iMHkL�Q�V݄��/"��+�)�7�������=�����*�|�WR�w��<���mg���<��5��?]"
G�_���l����|QhB��L?�x�Էb�OC������[��E��F�w2���7 ��76��p��<�2�L����*��>܌�� v�6nF	Y<8ڙ��W��`cp<z��A�84���}��C�����Yb��DQ݁:E��t�)���)moxC->�x9�#���F`:��F�>��!6�xKٻCP�����x���mM�`G�4�F���	����/��Z.lZ�ޏ뭦
%���:z`���_�e����&8���(?�
�3����K�٨�<�M/��kR��kF5��7K#g�n��h;��:o7C���Ύdi"���/��m����M&&w-J�"��:��|p�]�󐯘�ބ	��i�� ����ٖ�B�qQK��+<u��d�Al��W���%>��[��+;�"λv��E��H��Ћ�nط�Xt��(�7Ssv��T@����|�F)t�]7���o��_����c���D��|A9s#9�i�q���� ��Ҏ�۠�����> �h�Fj�Y'Ϊ�ص��-���2����1;e�=�bب9K<ڟY]��<A��tvW���&cc*�	�9U3��D�8"��ZW�ɩ��9�!��֭8dyÈpoc3!-O�\=fS��4�(�/W�)�6���1Z��^g�p9ĉ�҄ �n��ý�+��8�^o��'2e�*@�_�����*���a����ܾg��Kh!��:�������O�]9����&*Pg�]A��R3����J�%p�A�����T�_ىW�Unz�1?�xW�,l�� ��#m	��dAguGs&��H����U����0�;���H��P��;'�A̯,/Hc�E
���sx���y��V��Q[�Hܪq��Gg�sS�a��M�BzaC6��ߘ:�ѽ+�%�l��2O+2	G��l�V=ю*	;�K/� :K7'#V�թ��6ǧ�,�'�B�QP�}	�8�^����l�bYc���r�%_ll��E.a+�k�
p�f��aa!#�g�4��$eo�\d���\���DE��a����9�QX!˂+=y�Nu��țtyo�򵗧��Sz�����gG�{:��kxH��1b�'ˌ�ǫ��;�+M�'�V8�+&w6���:Iy��Gl"�Ԣ.^3U�@��2w.)u�&'Ӻv������H�\hoF�mf�YO����N��������r�5Y�b�={Knu����*/��
_w���X��s���T$U���I���o�x%��vL���Ju�'[�9`�\�r���d,�ӬX�Q�?�՟������O?V1�ٟ5�N��z�c��,��;A�N�����˪)*�9,�7?�1L���H����zO74���|�J����8����G�h�H��-�u�U'���ɟ��� '��]���/dK$�h.m�'ӹnY]%��%<0��l꭪�s1����Anz�����(�[L�-���]�7}"�ș�j�	m�q�),}L&L �&�Ы��Єi7!��j
�s�W��9�đ���qt��J�j_>���Fʼh ��W�y�"��]�"�]&�{��Y�S���\�l`u��r2QQ9�f��\�O�>�*��Q��:
��l���5�ގ	PXd�[�r7�Bƌ�-U�����,�MIm&a7|�QŌrd��J��/	�H�k�C0��Ҩ�qoN|�cͻo��X�	5�wC@���ah��.Y����Ճt�-f��^쮀7墅hx��+Դ�|@��3�;hm��SL��YKr�nV���ys0hr��Hm��P�0�MXߨ��+�v����r�/%�N�iap��I���\����VE���~r���0��6���	��f�|U-[�2L7E>���Ҕz�$g�@�
����MnG���Y�Ԧ8l�����E�=bU}�6ȣB`Z�g��}�^�z�tIoo�E�"�aA,ˏ�����q���U��>Z&�7�9T��{�
���1�F�>m�(�i��U���͈�N���A5��C�l_�A�	�Q�w�W�'�L��4/�Sb8o^�@���(�m�*�C��.o~�c�μ��IN�ן�ԟ�-��5��Uݵ�P�`cAA��%���t�2�����X���Dߠ����A���K��N�_'Xߤ:y���.`�3��>D#ۻΆ���M�X���c��M55��eb(q�<:�Ϫ�۟�%��'Kkb�&���p��T�"�K��s�@�:3#�����s(=l��^aՆ� �cZ߫�}��f�d���5�M�����Ԭ�l���ڎ�$��L�a7��Md��	tHlA����%�/��H�"9����pI�zD'��^X��C���8죔�8|�%��?j"�pY����tF�~�趜nӴD_�-F�m:J 
��ȴd��"��	r��,����_�2Y?l7;}�+������+����8����OA)�!v�+<�p@ۇ�������ی������P:h�K� ��v�x�$Ns�n�G��T���Am_�!�z[S;�M��YtL5�}���e`��#� ��C-��dK�ׯ��X�:[g4'�ܧ���s^yȫg�!G����g�{4����Q��F"�x��Ԉ�$@׹���]_�ru�1��m��뛂X�}�mv���>�\�ȸ���h13��%P��ӄ�F��S	������� ��z�gg��� x���~pl���N�����U%돬��p旛����n�&H�7��5�.P�o&!��.#�R��.�E��
#�l(Zs��p�#\H{j�c��YFF����j�J2L34t�S5�e&-
�ǎ�h�tph@�{r2�ǹU%�$��ݳhƻ�W`z�xF����ML�ל�v�l�;{r|s��`�S��R��V����Y�\��<�ۗ��<JirS�	g�?&�a���s
���,�簯2V=
Zr�pf�V�=�-�E�����,�3�(`��o��������ʘ��L�V��?��kο#��N!(7����@d��,���ޝ�(C�/�yA�h��]���.���n���K$t9�*U'=;:#�[<��Ůhs՜�p�[�[x�gܝe��ȗ���ڡsT��@<ic�0+�<��M����%-4/�J?v ��J�oCz}ts���Z?��\�u��ڃ�RB3��Y����Rb�sQ��yd@�2h�t��p;VB�����ȗ��O��N���S0�Ӿ��B~\�[A�ʧ\p�d�1���+.V-�^6�X��*V�qQ%2�[�����V|�*%הBI��@C/�	u��7��;)���&%h��F��2v���X6�:͓H ��٪�i����(z\��WkL���B�^�}<E�7e� B�f�ad���
�\"�S-h����a~-�p���[�t��^7�d���hi&3 ���;jN��MӿE(o����}G�N�)��pjq����n/]��#�]���$t�H�a�:b��ym���T�$)֭c�鿟NQޝ2e��;�lP���(A����n���b$�F�>�*�-whDݡoI<��Pv���ve�j��Սuoo��Q{��To"��'_br��+�s��ƪ�Ϸ�ma_z�z�g��I�S�N�<-���C5��dM��w	7c�y�֨6149>ܻt�1G�뫳�Ia�MY�9H{���)=�4ܰJ��3�v���`�
h��sd���@5�70�M����>�l3�x���H�c&?x��D�z ���q.��0��]҃���7%�+��a�R�ü?��5�(��0��F{8uc�)�S����U����&��=aƜ��FiY�8 ^]"�&v��񄚢�IY��Ȼt�P�%��- ԧA�ս˦׆�	���H%U�{Ƅ�d�r�T�z'���u�+2�"�4+�̡4�[���m
��]�{`ї�
�l�S��vP	Z�^�rTe܉]��j�,f����V6S��o_��� vVk��[Uzj�7r����$��(��D�&��\�9I��5Ȭ��/��xg��2����*\�����F�������\��c UE�Ԝ�����);��4�,ϊ�5��xE/���_��ϰ�òg�@�O�N��k%��J�v�-M>�;�V>x��B��rP��]�O*m�����7��m\�6@߽nq	�-�ʉQuO�����~�"
,?��Z��ca��U���K���㎷��wn�i�mV���MG��7F&U�M:��<?��W	;P�zN�u���2�]���12��fX�G��Z�:]tr]�EO[�������)v����(ª����7���sg���'b]lC��S%�$����Lv���g�j5���f��
�}����LCz��������`F�򅆿a� �K�S�.�L��di�)[o4b���rT���i|��]Y�{(�y֣}!�r���t�1���`]��p�(��6�O<�����<�[L%}78H����R�p�Pa��"���˂�×�8�i0ֳ�D�m,�,�#k�/&��d�]-<�w❏i#�����eQON��W��2{4m�b�y����^���L�/V����'h�f���LʖEg��6���k�;���V�N� <��-�Y���F�ި��lw*���u���G>8wSz���\�c�r�|s�&� ���������5��D�U��j�"�K�|cw)6���\�}�Ǻ���[�c���&+}K�ܳh!��MZ30u	���=��� ���"H��@������m�|'a�I��y��;s��<����f3NGW,$�y0�6�c)([J }� S�f�%�q��/5=�f:�s(�$s*��[j��W���%�0D��b������V�%Y
�9�����ތS����\��Cv�J;�O��C���)�Fb��JH�xl��H8���ԛo��eur�[��Ubߧ9�/{���w��W9�l��2P?z��ޟ2���J��y���N�y,��^�nԛ���7���ʷ�>��l����.�Ʋ�phi��.��u,�F�
��U��l�~l�"�V��1F#c=�,��U�Q)����̘�у#��ͦ<�gU$uln�&��^��f{�Q�sJu��<]��M%��AD�C�=�QPe�GSO��@W��=D���o�!¼E2���d'�˰�ns�g���}U�(#�+�>�����l�w�����.yV��>�-�6���>t�{T�DOB<׽q}�J_�Z�ء�7|���X�½_s���3�y���-q35�I)D^vc;ymP��zk@���FD��[Ӵ����GL߽����a�XT£KNH�QŹX3����b�p�@8�)�E���;FODb�n�cNs޶d�"]$��7��~?_�6�^����e,QeE�K.�&�Iz���T� 7d�	G�Љ[T�	wD�qD��tRs�̷��jɻ��X���	�WϣXo�!�^�gliM)CK�9�m��}g5#ȱWt�E����QY��_��l����@��(�s�j�qѨ��\��V$N�^�h�C�/�V���6���,ͣ���Vb>=��V]��~��֭~�S��<.�y�1�O_c�F��?�g��3 ���f����o��������r�m�oI��DF�,�>+� �{_F�_�.t ������k�Im>�ո.~���Cy�O	�F�;�v�M�9���#${�w��%_zR+ ��8�˙�5Cd$8�J�ܮ��&\D s�ȣЮ����!�=ũ�
��2�-�1b��ю*����G�>���9��q
����F/�٘��><}u��I�;�ێ�Fb	2�͡{3�M!����㙣��|S�)s�\��[�p�Y"P�&�q��]�y[�> 	/j��_��.��5mc�/UI4�L���bS�랥�b�7	�&"�V=֓�v��ٳ..� �9��b�^���ρ���3]�(i���&WJ���ry�'9<E�xD�d��'�mζ��60���W.cv�Jk���i�[���'�R�s
BkN� �\[Q�$��(T.d��Q���8��K4�O���%�0�T��׷kT�G�d~b�x����`z�f��3��BF`���s�"y����( ��	���ݧy��������k0�/�oU�ƛ�<���l�.2��9c,Z�>���#J&��@�iz��מ�~��0a����t�M�)ƣ���;X�g��C�5[�#�i�%�Ey����]�xp�FD�*�^�Nz�]�Z�3��<,��V��a���F����3Te]h�˿�X/²b=���Y)*�[��N�훡�z  ��;֣܀T�ճ�0�=J�6��Rψ��q��3T�����A;A��
َҷ�t�].7�Ok\6Gkl����X�E�k���Jj`���������Y=��x^�;��[i�M��9kE���l��ac��l�7O���ݫl0	��)��H�A����9�qCSy1������ >�	����5�hU�m���-�� �/���4\~I�zsߵC���'<�^�}��d�>�U�\��:�i��k�`�U���v=B�\7V����z��n����Y�Ӯ���sL?ưM���z��k�EƥC�,��F�XG��je����e��S��VPh\l,�z%shStd�O�M�qp�mXq`6�#T������Q�-|�N��^�>u1)�d]��>!qv�9����'�4  �9��C��b��{'����f%�^��Ƶ(VUs�LyTa=_�\���h�x����^Hw�A3謁��F��!q���f��9كE����{��c���}nς)U�2�0�^���*��2���A-LQ��l�<���Ip���D���4ӷ��@1��ia�u�ލ{�d~�.Qo˓(�9G��pڗ!���E"�)e?]~�m�7,$t=�5�w��5��Ϥ��S��`��E�k�#~p+��N�Sͳ��l� �B�S��O{�a��i�Tv�p�9�q�hA�L�h��ɺn�xd�9O��t�N'ȸ�8���!e�ߋ���!CΗ� ����ا���\O�O���qd�n>(�re��f�����_�0�ߌޢS�I����Kg%򥌆��"��#�0�g��Kp���A/����1iq,�$N�d�$��p�|Q�� \�u�^��yp5��|U���p�u�K�WaL�m|t�?�3�bʏ�Y�ǎw��\⌅�.d2��Q�+�>�3��V��^8�f�ǯ�h�gz���{X�e����PT����kiN�ċd[ᩍ�Dh]�S��ŕ�rN�]� C���1٣�M*�˿��ݫCD�N��")JA4��w�*Ǵ�,���ؗx�'x"���F��ڑ�(���,b �
`���j�D ��wIq�����Cn
�^Ů��V�Q
�`��[2�
`<Xg��d`σlē������z� t��:�Β �b�m�~�zY�D��s�oN�m��L�1Z�6�]<�I����W;"jl<�c]�ˤn�-8tf����C{4�3E2�i��K���c��3V5�m[d�2�*�tv�j?U�.��q��8[gH��3��w�ྮ���
v�vG�I�q	�����8uM��{O�洽F�&�|�C�� ��`/}<2�X��Q-l�Q"k�CO���3������aV�5���=��ꋙ��!�����Z�����k���B��������n�S�J�lCc�㈒��>5�*�U��.��������ESĄ�q���$��箺����3��m�=�֕��V���?>J(.�z��� ��U�ѻZԁ��!���A�B*�3y��C�j`������xsԎ�������I���u������BG^k	�
�|���n_ꝡ=����U��F�{��=�0�̌[������h���O��Ya�$�'? ��L�2AćjHS5�t��ڷ���������я��C�גo�����WI�N�H���-��>�%��l��3���!�n,��LL��C��12(ҿ����#�D�4���
����|��Ma�
����Fq-��O�㯁І��6OkQ*���y��t;�JLr�x2�E3z���KV2��0�aa֕��)G���"��}����3
����LoGD��x��Y`� ����Cz0z�S���nH-$�|����K���"��v̱\�ʈz���v�2�e�4�.�`�dES��	��y��ګu2�C��
��c�������p
�ݩ�����rf`�+����L!�Bv���.��"}9d�B�-���}e4x����Fm���"�s�(܅��^ �p��"`r1�?���!��1���4�7*Gr���o$1�+X3�:�
# ���+)O�;	�tVl��8�3�+j��`4������'���d��	@������UCƆI���C�3�U�d��y��A�୍9�viCL���P�O��R��O��y�G ���ܼ�$��Yb~q�������`����G�k����S$�#���{A���&"f���P��/B�,��CpY�*����k�"�̵KS�G�E���z�����C��UlTS����3��6������ȥnJ�x냤����9BO��sp|ܢW�LzB�d�Y�r��C��ԏJI�<�]�f3k�a��47�V�aF�����5\�x�|=GM9ޗ�$��,4�ݻ�l��G$�L���oK����~�&��GK_.�����d���?�c.U��2����PW�;���������# �adԶ��V���ސ�y�v�$��V��:~�x=J�GK����tl_v-QӍ�aN�/7�
5u�/��_��ߏt3m���br��~��&ۅ��X�H��6q����O�U�kuǁ��!�F(4~-�<��=�/���s�K[;u��)�S�5)uT���޺l8J�-�Pl�<�:$�Ǩ�r;>N���E}�KbZ��c!��-<��'�j�/�sr+0�E*�f)7��H��xNOF�(�1X��xqO�d���X�W�]�R$�G�{~1�yl�v-���dȝ�4u����C��+4�F7�C^|Z�T*��hK���I�,�k�����Q7^�Wc��ϫR��Z�;�Ӄ"e#��ҭ��[�@�:O��3��0�r7��'�Ja���8w�m�7��U���0����u7�x��
�ꭍ��8l���Z�NJ�tY]��e&���U��X��E�~����+/�m��S��jf�����B[���4���B���U�z��*wo�H�"�zF48t�����@z~�g�ti�{�tZ��āD��b��*�����67J�@Нe��H��B���@9TU�e������a��v�U�٫D�*'�!?�6o��9�yy�� M^P���{Y����-}h-�Ш����G���k�l���m�e<A�{I2H�K֍�߮�͕S�N�l��{ޓ���:E"~�Gʍr+]�f~�]����)��CW���*�ӀP�U��=*��t�l��i��Dj�r����Gmʰ�'p�})��L��x@�钺g�QM��b��k`%b��
)��+͜� ^A6��0�i }s� �yϘ���c�\wv{��k����B
G-z�6����3r�Pb��H�"k��t�#g(O?M��f	ZQh2��B2�h'8)���)�g����o��e�Qn ?(�h\�Ha�o"=7�a�Xr���x�3�Q�
rj��[�Zk�ҫ�kʰ5�&ŜUȋn�>�M��^�m&Yej,/�f���6Z����`0	Z>���.�^��F�)`����%&>�:�R?�$ ��y	�*��mΈ7E4<t[��<{ i��$�R�0�������؞�����%:Z�"�Z\uMO�Lt��EZZ�O�|V����H�T"���F;G���%�C� �Y���1R*�G�����>�&es�/��s���7�-�qp����W����7ؾ�L��l<��5�1�jv���b�e������6)����H?��WV��r�e��J�z�줋�:>_��m`��!��\F����I,�����P��4�'
W&9JG(|d�H#�o�9=���S��0�
֫�Po�#��d81��������J�f����_�,+,,�-���d���3�:鶜�q9��	Gb�ݞD��t��������˱�s�1xIU>�dȀpI��`Q;
���o��^m�P��rC�1χ7BCƎA��:J|��A�ȏXh�b�%(yvR����c>b�)�*��Fr�vYEY���I�EH�~�S�CX�xl-�L�����afy$o�j��9~W���=�N�?<��=�˞�w�HC����:u��.���.rH�?�Mb���H�'���-9��������v{0����S��Sq������C}5�:��= ���r۔;��U&`�� �p��>� �� �,=.,�pG[:��Q۱�]k}:;1~@�+��x6�v����>����Ư��d�Md���7lO�y�_Qa���D;;
�\�n](O*�dAv^�v�v��F�����ai8��+)�ڋ#!~͕ӿ�x��
�q�;�k��(Ƕ���7�-���%�E�ָN}#Y�Z�]�X�t!���q`����0�����;Nq���pA��B!t�,&�j�WFu)�z@��6�T����zq����'B��$��!N^��M��[M?�x ���; �� �f��oѷ�!�:�0B0�(lHd��xl!I1�t�lݤ�\�Ex1�t�M]�&��o<_/'V�#���"�j���\GS������r�.�p�i�I�1��E˒5<�o�FJ��K�Q��:�r�?�D6�� CE�(|��m�.a��J��β��b�p�X���ײ��Y�H��[���>�^?��c�P��@��-�r���]�Ĭ�H��~xM��� ��;��_��'4��d>���E5��*W����m#	�C"h1V��)�{%�,M��4�Xѥ�GW��k��)��x�؃�p�E�(�0F�����-i	��+u/�u�S��5���a�O͈w.,R<`��Y��/�b�<�	���\�7�yQ��_��85D�-�l����F���溁v|܎�����,�Ǹ�0߷��j2�2O�&���j���b���Oě������+)�������-�jfqHw�me�l�p��G	��NTHBa�0�<qk�9��n�l�\q���"�~��P�
K���u��&U�68�P-kĚVi�w5 �5�:���������5\/��{f���$�J�K �US�ezR�n8Y��.*5�?��[N-M�p˽��3r6^�#֏�Ҹ��t�C�Cw��A�z��yk�q�HęI�S7������Z��|�a�\�ړj�/�R��#fpK؅6�YI���?���wF��ރ+ѦM{L͌G)ɗ�YZY�;����.��7KNS��g���K6��41#�J��\<C"f���E��b�����p	��%L����,�vP����s���vJ��f��.��^�5���6řc��t�-���#�5b
�]E��V���mhx{�� K�A.�CI�����}�b�U�oK�����<K�~u��٬���	x
�E��L�_�J�|o��e�<R�ƚQ�e���|��p�����r�4��1Y�����:�aRq�e6D�2��奝�#���@�G�qo*� �D8�[�I6�POq>�~%�3~����� �Z�m�k��@�7�z� #Z�_8��&�Re�$��c=>o���k��U
�G'\:m'�����}��o\.�K�P�	���EE{�g���v�`��Z���>�e��W�ʔ�<���	�ΆЕ c�Ü#���\ĩs����/҈�?��͡y�	��H�p"�&�j� ��1�IO(�����P+  �p�6'b܏WD�vn ���Ǣ	k�׳�8l�x�|�O��X��j-��� ��(2���hu|E�>Mč�-7|;7|��GIڕ�9�_��r&�nQ��|��^��J�2�_��C"��]��Om�n4F4�=��������$�KF�J������L	�2���C_S�}�(��
k��cn]q:\`!��v'TTQ2��1���m�����RA*LQ��{�����K��n`g|����ΛĊ��,�*�Q��?a�P^KEP�����*e�5p��2Pވ�.<fD�O�����\�WZÀ�lK]͆�-sGV�;��[{��Rfӄm?�~5�/��5�R,t�	��Q�v`<O@��O�x��b�xEșy���z4��<��\V�q�d�>�q@�����A������Q�BSc ��%��>�!a}��n
�H���Fw���K!�i�,����NZQ�"/��"R���[WMQ~���K���`��i*K���in'�M ��!��LI������N�(d�y/:7��n�J����AO����I��C��C�zK;�P���u����ߕL8�~A��}�_UOW;�T껠%	�
��	�fN#����
�+�P�wI��R�M�:�X�Xq@as��r�dA4��]�����`$)��Jm���hb��\��ˊ���!���b8`!��Dp%޼Hz��(�}.a��et��M]+M��>�(�r���y}N=n炩Rᆫ��^3��ʈF�	�Dlg�-���8>AC�v�� ´�R��%"���b$���d�	�Ŷ�T��=��ڗ����yfv;c�h=3,��a;~�5�|��������{\��ױw%��Xj��>��d?�i�?���hE�x���W��"�2��Q���'�ns7T�me��I�� �{q>h�ˣ���r��$��XѩH����l܇z���1���*���|��k�_ �)����{3f2Q�Q��^o6ֱ�1�֎�e�o��d���k;������TZ�`q��X��f�2�6�V5C����XJѸ���{��Q1��L<���0�E�if���/V=�(C�I���À�G��0t��x=]>�3��v?1a�D��
�`��ia��S�,���>O�'`�d��V��+a�'>.�J@m�;���~�����pʷ����jٸm��g~ּ<�K��v�K�M�\��mצP��b��_[c��ph��/�@��v�,�=x�i����vp��ڢxLO��/8�.��ڌti&�&F��!��xG�)�Ȼ�&1��W����fc޳sވ6�V��{�T�m�ɧ�E�wJh~a��ە����
]�r�U�S�Iϟ��Gyq7� i���;L����,G�:V7<����P�Rv�&�l��
����N�GV���ݸ)\���~���Mn:	Ө�!dR�n�~b㹤��;�=��k�N&��Xo�Ԃ��%���Vd�A{9<������i���L���x!V�3�u�4�e#������o)$Wx�O�� #!�m3�R�Q<wB$o�������4��&�!�U;��?�l�w�w��tf����f�P�����xw�*�.�O��D=OZ$;�W�0vt^�W���=o�L'�O.��;�!�Ȭ�-��t���T�s�=H���§�l�#�m_	K|ES��V8�c+� 1@��E*�ژ��ٜ�cFnbyIm*`��zNo�>q���O:�%r��N��= I�C.����F��Y���MJ�=��'+@��n\l�-A+]� �1Yhb#��s*�x~�|d�V�
�:�ƛ:�+h�0��avZ�&����e�ċ�0���L7�5�a���gf��>��ᮋ���2U�b�j�j�d�hH(5T!�|.t*O��	|����!G�PH�����'��ә�����|�)pX<t>�N�<�R�!-5��:<��K�����2��S�\����s@��(2���N=i q�|��f�砱Lq�����X"!ɓ��AH=��~���`6@!�'���j�qa4]H��֩��(@� �3�C�+���bE���E��nFec��B������� b93�|�y��d�A�dtp�w��]cze���d�`�Rǥ~?'5�'��mi3��Y\�2M%^�8� 0�V����<�Kؘ���yA����n+eC�}MΖZ���=~Lb9� .mS���g�n?9�ঞ?x����0��#^)���E��W�x�Wt���⹷�e�S
���=���0#zu�U��s�����O���n���b�Y|2�#���c�'�8\r>(@�N󒙨�lmF�\8�_[ޙ��M��o�=p�^CAm�$�y�R��_	MC��a��$�Oz�;�m��:ww>�c���L��ě��¦�*a�n̏��"!Z�Ó?[�� ��(/Bה�ɝ�[�eD��M㵤�-��G6��xO�#�*!� L����"���_}q�}$Vq21��(�_}�W�� /Duk�&�}d�y�jw�Oޭ��<������ �w���"� ���="'�C������ȁ@Ӟ��j����[S]� yz���9�d0Ы�Z��7��X�+J�?�=@Yԩ�=��	�O���BTcr:�/1����DI��!��%V`�����s���'��G�������޴W�qd����꙱�����*�L�����S���n�Ss��:瞕�������RO���I�{,�'��2E���Ϲ�]B\�?1Ճ����A����7i�)��|Q�|H��ܩ3�n,��*��D�:�ۑ���6�Ed�.��>C�e\HՃ{;����{>�Dz��8��t��ةy��&8�i�[���1����~���G�c��+�nߖ@�@r�e��rY7��*������S�~t��p"�b�����`t	"�Ɂ@���8������_�f��ߣ��M� ���4�햡����4�ޖf,����P�!l�C��̶O�����.���\=�*ƪ�㭁'+|����+�������yNjտ�oHR"����Z�\���d���'�C�+�Gqv�e��.E�@A\��ҍ�T�-��4�Uz�+��Cu"Mi7�!P�Ј� /�`����<;B�牸I���U{h��?<bol�B�FG�d��#���Ō�b_^Ek3�H���&;��g����}���B�sȅ�gB7ݫk.���W���%5�3*o:@�i��yk����\��79Ò˗2K��4��@�KkV� ~g�qx���ۣ�A�{���i�F��P0b_����Q5[��}M0c����Ճ���ů.{yp�)�8��������Y�tf��#.�9H�޿�o�3cf0D�,����؇��@c����i��bh�c	a:z�	�#�=~nhҶE]�n���0��'�':�'Fj��j�Ւ<iA�Ww�f\�~�u~>�'d�MB�����[�du����+���N+�g��P�[%,�NB��t �1���� �H-oX�Ɖ����f"A��[�2ymI�
^�
��a���5��/���;�q�����dȿg��#[0ۛD<��'�e�4:����a_c*�*�����7Pn̓��)���9vT��6�Vk���y�Wग�\�gω*�o?L�dpf U 8�b�.$9Ie��5�o���.�;���Q��
�
���9&ohF��X^�L[�r+�
�LtG�yG�e�������;]���t���1�s�xԲ�3�ߎ�k�9+l�1}mz��(��]X�`�:�����۬c��W���_�\�
��w\]�%1�#&y����Z�	����W�K6:��(4�u1.Z4L2���Z�|���ɠ5]>[>��i!g��?x69�NE�#ڭ7�O��BW���t.g뤼[�����[��F������^��=�o�/��f����	�	|E�n�q�� @�D�նX���*0��PAJ��1`̣a��m��@j�j|7!-4),'&��P፦�ó�-D�C�'�wO����6���>�|
W�0�%r~{䳥�n:Uk�y�B|�x����R�-�m��k�����[�bSl0r�J�&��hy�[�<~G�^��g�<�7��˿�`�0�X��痓��}"����t a��{U|��8�ѡ�*]?w�$p��2�U�4U��D�;ӿ�[ً>�V�|֡��q��Ffj��l�T��h>���Ά��R���P�cs�-��-L�?�[褋m���]ipD�@D$�t����,9�����z{j�o�,��^�5ķ����;��&O��W(Ӧ
�(�����ٿ�qd9��ؙ�����0N�_E>��,���{���K�=v���_S��1�2!.r�����`͵zd�v7o��y�S�O�$ޮHnf��n86�8����K��q��uy��i�QV��Ҡm SE�N�i����m�zDOD6Ȏe�ڜ��P��e_���	'B����ItTC{rl���\�8�˜�!($ʑ��o	����}�~m��� mVR~��*�ٙ54h���u!� "f� )�f=����sc�x�-Y�SS�A��Ax�b�:oO�B�\�$\`��I�ʵ��Z0#%�|4�
	�<�3Q)�^YĚ^uh��1��q�76 Qe\(\��	0+b����Ժ�z0�ґ�f(���V�]���*�����]�qA>8�bjP���<����Y�)�J�:���� !*���6�j/�kLd����1�MwGb���ZS��n"`�=��:�ͥ�UB���<���P�8��h-(X���^?ʽ�at�&�T�`(NLc�ez�ڷcrS2���/�:��G�!�V�iw@�d��:+[�<ԑU �q���faY?d=3��:e^)���u��{�}�K9�������"mj�rl�-��0{٭6Y��ZtϕE�S`y�&C��mt�=S����I�)���mK�|Ao����!��$� w�
/���؂����~��5����;uIq6��S������2�U�cPϤ�s#!�� W�׺���t�Q�(�"���a�>ᓲӃ���}S���j���0 �)~�R��:#�x��~j�����ԒNҿ�	��SY�'���Wל�j}�%$����V�:l=��3�b��APn��L<f9{�@�f�UP����>����펥XI��*�`�f�}n��Y?Î@�NԺ�	����X@��cGTS޼N�-����j;�,8�����q��p$�Ƹ�S1���� �2a̮��e����2���m�IY�X,�_��W�bG�Sȟiꠃ8�Ql�;-n�����#%��ޯj�].�L�r����
.�r���|Bu��rW���@���ag�U:���[uZ��ׁf|�ڶ��V�� bt	uȵsVv.�����=o!���Ѹ�z��J7	�ёR���2_�F��TA�'��.�0A=ҴqN�܁l�i7s��Ln���Z����w�����x��BO�CV�����rTcr��8`q�s��a#�ٞ��n�qo��1,f���W$�6e >�|X�U�}�v
��L���k�;0���`q����JC��9E���!���6��Hf٩U�ġ�~�o%�gsO6b�k2 �r� WW�����.^/V��o���A3�#��0�R���EOK�'˻V�{��_����T���QÅ�A@)���1k�n.�bd�\��}m�F����(kV����uK�H'�O���gS�Z�cpTKC)L?�I~�/o���B�h�>c�M�2v�]̩��7�u_�כ�v�o�[�L���藩:��5�ք��������b�|��۳�W���;�.0+�[��2��J�P�����C�r�f�6���p��/6��h�;oT�	Q�0)�l����t���Wfc����	��8C�XPJ%8�#O�G��6��t�_rr���}��z�΀�%Yʹ��gT�^I]�F�1�v+��϶A��G4>l������80tIw�Q[���-Y��٢�>0׳ęx������czs�N^���a��6���F���Q+�Nlx�%��.I���7tЇ���e{���zZ����zOr����,���d�o�֮0�� S#��w��$�Y�b��~��|QIF\����y‷���¡%�b�"퐿J7"�V�k��	#D��e@V���E:��qK]����� ��u.��'TL�<t�!{�H�Iע0f�p��˯)��t-a,ެ�J��e�5�A��D���`]V7]�o�=��/�$ Tx�^�a?Y�A&Ef�`P��N,���Y����m���q����!��I�׊�0C|��2�HXՔ�����0�Z̿r��8ɟ��,.u�"��(�#>6�K2�Z��������e��W���":�?��aN�n�P�h4�~u���p?.��`A��
��i�w�aJm��c�a��gNn��,W�Cn?�zD�ٔ?'����\)c�?����c���HM�3���T>xވ�_�-N���"����M�ʊ����ڶ2j庫>��lS�b(#�`���,$؝���̥ X��V?�~�v�U;"��!�:�Pp_d5�seW��"�Hm��J0?k��\rݿY�1Ż͆�_.�T�@z��&�h����a��{���1�EK�)��A�V���j�}Zd��x����G��s�eҴ��d5L�hz2WD;nlp���\b�6��D#���C𛖽{%�z)��|����P�3�`"QC����|Ch�e�m v8�S�����ш�{��V��~LXy�D)���${��e+^-j�� F��w7��?�L�9���JF�������B��j�o�hzh��1��ڡ��Z&c`C���q�X	�)�㫊d�g�%u�l S!O,$mѺY
�E�سjƇ.l�!2%���< ˛+���UY��>��իo��&�4;���^S��	���^�����(�^�C(]�}d���'�)5��S��6��`���D,�����)
Q#��d��Vu�8��O@��QɆ��p�6ߗ�=�3�\e��*�Ou1��q4�8m[,�.|���!�|�$�`ʹ��,؉��(��4�|7��"��`v�rZ�����5�� ��V7tf��8���t� ��}�E���c��&SE`�5/�m�ރHPGj�������?�JLs��Qu��rZפ/��������˶�H���8�ʙ�%�K#$�o�aBD�9��W(��~s{����� ���Yp��;_�,��%�1����
öytBQ��!�r��I��q54<l�=�:l��f�Vq�m�9�4�ҧt�4l9ၧ}t�N���n����S��߫�L�8��
R��CI�Yo������?*w�Ζz�����?��S���N+��u�;<n�>��d��7�~����ū���=��~��9ӠT���{mj<!K�IL��r�&8�u�Ҝ��˞��J[P�jT�	�V����"e��]�z5q�}|����?;l�>�lDSk1�B6g��o6F9��Ĝ�,�!�iU�[��;���jg�-�h�o�����=�좪�RNe������>��e���Kv�z��i��Aivx��V�$�Rq��+�kx2�Y��
�w�Шܓ'pS��(=���{����X�':'B'nՅ��fttW���nV���U	9m�ϙ([c��e�FIR�w��a�u���ޒ��Ɂ�wsS�א�f�yQG���&��j���a8%���W��ɠ��Ѐ;��� �0
�����5~��4/�%b�%�=�	�)�����[P_���`��Č������7meiP��u�����s��}�J�TG0��;�_@�t,��ϯM+��m�?K���T"�Q�' ֘�����k���\�ƪ����� ����?�'��aG7�O���M��U 6��l��d26VvS���/K{��{�S��/(�0B��bU����%���y���y5KE{b��]J-�T<��r�2ļ�����}�)[�c�U�#b�ז)����w���-�Z�0���
G�rzx�}p~���$�h�� �K�X�wi����ү�~�WJ�C�Z��'IQ��C�[�:`��UK� �s4���@��$����I7j�����%�.���5	^�����iN��) =��GvwV�'��l����L4���𛞄�>�N��4�w�2g��],�D�;8\��nG$_bC����Pȏ$*i��
z*ɝӅ��e�~n���3��5a�DIJ�	�{Ol�E��=-��[��˜�2��l%���:V��A��﫭�c20��Q�`Q5�eH"����#��H��\N��fO�$Fx����+ݓ��ܣfW��$I�M<WzJs��ҋ��,�1�E��Y��������&�w2y.-���J��߰=��)�����~dxq$�q��ӣ�1�]V��1K'y����EK��ҹ�|p�5q�@�����]��[������E��÷�*]f�P 1Mi�7@��D���?&̷�JD�Վ> J�.�=���;o$��c�M�f
)_jğ���Pf�Ii5=�r_���1q���a9�}
i[*�W���'=i��V��Ş��%��g���Yv��Z�NqM���{S���6�	���o��P>yi���i���+���  ���k�q�]Q�6!����,�6#�f��<j�~=ʒ�@F�M��EY�YdUr8��:`��ƍ'�,9���6�8غ]_R���8��Cބ��(�3o�+��ǣj�XH�o<�ϳI9���?�zz���Pj~�5�b6���l�Ou��s;v:g�P�T��z �9_����瀜Z)ALoK����;��hF녧	�1_��et��&j�W�.>_�Ed7��C`}��2���s�3�u�nRV�Z���b�0��:G�(��gE(0��E�9����ek�������Y9��Ԙ�+! ��Gzn�{���,���+{�)�8h�@�RQ�T�}��&�6�ΗoQ���0��T����;1Зz���Ȫ'�z�3d�$jGS@c�ӌ���Ө�������6�>�̦j�n/zJ�z�z�j:����T����(���v;|�*�!�	|�3�� �[��:t�G���۰?���ite �˷�5��ɾ=�.���k�J�ۜ��7M���Pp'�$CqK�s��0���G�"�sc�+�@��Ӵ؛�����2"��M��{t����P��'�O�-w'�q"�� �D���ep�����~��_ǀoOFz�t8_�����J�)��)�dC���pF�m2�k��D�%=��w�����s����ۯ�FDE{c#�GfEh�Ό�ԉ�+MJ
���ap'nR���ޛ�k�ne�W�Y�����U�5L�PN�T(_^�;��hX\� �[��g�Ke)���Y������׆��SA%�.Q=_)��i�W�߭|�2M�x+i�"f��_��?�:7tE����o>1	�̍-hp|b� =��H0]?9+(�ıj7ݼ�S�8/���6�a@E��@�Zb;�&5�#z���љ�Ä�Y��/eT��P�9[�@J�B�m���bW�f���,ӊ�l���[q�ED�� {���k]섀{�4�k�c��٥oOD*�$
�R���';]���$��_��S�*HJ�-Y�҂���g�E{��Y�PΆ�j��\�gA?=�?ޑ�u�(����G)���1K�xo�P����]Z�Ñ 5��z���M��)Vj^"�>i��'�	��[9c�$�n���B��i$���d�7�o��葮L�]�+|O�e���Ԧ��Nٰ+%p�V�h��X�<���-���qu�U�؍4 !!uF�FQ4�G1�4e��b�������J��P�ó���|����?���5�36C��2x'�y_0:*�>�Y̫���O�ܼ���g	^�I���"�G��``�,�[]3E�0 g��)����M4f���'zu3ྫV�l}�뢿��HZKt��W�62#+���Z�W�+a��5?~1s4n��&�ϢV�P�X�jEŇO\���#ӘrͲ�$�2��k��nim�S���η�����Z�7���˾?�����#U$?�S�6�s�T��4��X��}�	�ٓef�&�a͚�%�Z磘��a��i?���Ϊ����{"�z�-�l�rLެ�#�mR���e7���<#[���7�?m �KΨ���]-�������%����v�rs���������Z���	��=�����MAR��Ƥ�=	A��{��E����iDP ?X���Q�;Aq���Nլ�\��0u
΅��:�Sx�D�y��N�����&ݴ\�b��?����"A0����aiN��E*��O��)d�X,p��y��+��$�&,$jO�o�sK���0�O�ę`|Vt�?}�젌�ۥ���O�Z/2����UҐp�忁>��~����qd�X#�e��*�GZ��S�ls�#�$4���_�� �2�B��~�:P��c�)�UB�E��tt��Ǘ(��,DA���I��� JmA���hA�����x2⿿,�);{�Մ�~>!���q��z]|��@Is$���R8��:B���Ĺ;��8��G�c�:���J�USA|.G�Ǽ돤�p�xtln��/���~V�}�pd�N��>cJZ��5[�_-lẤ	���b㵛Ӵ䡛�ũ�l�1��t:��eC�g�:�n;���=-���Ys!�	�A�$y!x�_U���W�B�m���D��\��l���P��sWb�̚����̺���X�~�*���s�a������	����7n,`K��lw2�Ԭ{�X���(�-�>��b®dv{��3=��ұ6��L�c�[+�r�XIf+��{�ܹ���k����,�TK����V���L��zp=���J����%��3�
KN�w�5َ1���;y�s���V�^Ҷ���\�=�7(��e+�xX+�f�h��b�*	� f����&�=�{f�,z��鹚jZ�v���,���5x�u/�2������9UU������<�jȘV��j�`K��<�{��%q�n�����NE���� ��gPtA�<���e�b�N�tE
�H�s�0t�p�*+f�mc
��D��:Q�Jm63����$�h�1<���Zo�,D߾�iKI�q��J���"��Ve��6�%���ܿ�hP��C�.�fK@�9�&io�40�����Z�S,-�����\�kk�ԡ�$&ᎩS���
��ql��}�i��j7��p�8�H�-##s�=��E�E�Y燷sY/���IJ��<Y����0����9� ���bh��_�0	U)C?��`^��yu�
$�U��%Ҥ&�΁�/�:���|OW`i?;ńH�K܉
��(���'�(�`�f߭ ��)�է1TM��Ҕ��i_�m��/���������l���6�.΢)~��f��眓vWt�P�T��U|B�O�
z���w���]?__͍x�2����Ӹ�I�#px{J�U0�R9-H��H����Ȥ݇NL� 4
�x@������;Z�`�j��c��#��r3��qwM %'�Ջn�X��wHh�~t�H�p�v�?�>!.N��Y	���`~s�`���\WNhؙ�c#�0`,m/�F�+st�����L��O�k�p�HX� �I�n��>p���1��>so�E0���"w��`$R �f徉O(:��s��=�� �K�.�����@���r��g�!|��hiW�P޵�O��I��	�U��5�T@W����W�"**����j]���GI�JT¨��f�.I�c�N��tk���E��9d��zT����#����E�f`>=އY�-� !�.�P�Ug��H#6��ׅ�"\^�(��{Hu݃�	��#/�]�'����t������e��u9a��e��㝥�~��� m���y���K���r{�5�"JSYd*�A=�h~���H�A���3$�HVd���B�uC���A�����lK�s������l��>|�תʗ��R��ܔ�_KQԡ9��4�i�`��,�V�w��\} �_�þ'<�<ŧ���W<�̢e#X����V���d9��)���<��3�S��Cy��1(n��GL��E>*��%�5�`���.r���,����0ٝx��Q��v�2-J3$�΂1/׋�(
�~��+��?R��kl�L۹k�aݤ��N�+_����Z���Jz@��kt�W>�?1�h��̭�@Z��Y���@�:�Ja�DA�{ѹ�"k�k��)��s�
��$��&�M��2���Z���Y����� ���ZO��ý����:��F���~��A�VA	��%Z�koJ5�u�{C���F�ڤ@��m&�)�YH�4j�N_d��	�A�L�Q�=堟\{,��!�`@��$�-<j����S7({�x6��8�wG��Zf����hi]������Y=G�g*nSG�m��$d�*�C0f�-���xH[?%"��ր�8���D�z]v�0Z�5���lߎҎ��	��q�;C��妾��6���
]�S@Qph,�FI���y9IЛ�!�	�UTWL���5�H S}���>]%.�"�G>W+����
�H��n���Tgïֶ�>@FU�k���4d�a+�Y��cķ`�hX�ǻ�n�(0�b8Z(�Y9��S�)~�M���7E������c��o`v�E��nk4E����27�G�L����O���"f���;�	È���b
�|6)�*��Y,o�ruq�ӱv�ک��F�,�VB���u]ʳ�~�I���,Ņ5�lQ����o��"���He�`�<�y��m���s�
C	.��х����u�z��;��ڋ@]��xܜ#��
(�vm�q+�,	��g0�v���kvE�O0!O 82{c
,o"��i� ��~2v�-�x%A�$�i��x��6 �Q�@�����i8�MԪ�F���z ��^����N
���8K�W�T8�x�m=�r�_��|u*2�4�yX�$`�I�#��SNY	z���H�$^ ���_��XyDў��8�9��o3N�T����}���O���
�ϴ_<��Qb��טp[���/��I59�S���*�¿�y\��Q�lf]�>�Z��S�\l)u�z�F�D��}l��{�(p��.�إ!�J���ǵko���Z��#HrS��?��6d����(�%��\5�be,��W�zX�FVQ�.�c�w+��M��f�j�	�,������j�'���֗� �HMA�O�Π���/��Hl<����ʂ�$�3kZ�7���hh9{![�}��N�t��?��y�k�b��x'z,��b�\ϲj2����v&h����`k8���f�D#�N[�:��d��X�Ex�&$������Ю�<�Q$�!��r˯���ݞ;������M���y)���V�KK�ȝ��l�sv�i�w��Y�d����Pר��!ָ������&Y��j�,`vሡY1��x�C�g�Ġ<�tśx�h\b�y>�c+�r�h���O.��VQz80�ey���q嘋5���78��ټ)���h�v����w�UdLﴊx��ѽ�ڇ�L�y��>d��$�+�ȁLR�A����Y.�ۭ���Gr�>�urV��:V�Oc(>�����'�k@��nq柗j����`�ݳ�$c��W��,[틕(b��#� ���D�����v���H�"f��^q��g'sB�N��:k����Z�NY�[���Q5r�;��鄕�.�/)�����3ưU@F���[?�8��������I՛�
��)�K6�h�ìU�' iBG���)��"7b�]��9�i�)�gj� j���o��v��f����ўf0�x��f�NDAfi*c(�����`op�n��W6�#���<aI�R�o�5R�)�qWG��˱ӏ����E�FE��R�{U7Fq���;��f�h�߁�_�c����z��*VLm3<�u�t���I�U�98�֭��x�3q{0�HA����n�Z��iV����o�y �{+[�[����iSL�t�q�X66{+}������W+��WF�=���-��r38X��_�gm�բ;vC�����E|�ԦB� [�_3#]��B���T�]`ҰF8�#ma诐=d�%��0����wP�(���L[G�כ� �CHՀ4A\��Ňdi�mN�q�^�m-*]:��}^�H���M��u�`���/�G��;2ة�����O�a ��j�@uf��N��2V �y��勸�Q�(�e�����.��X�4*Ĝ�]JQ�ɏ������Z����F�x�CI�
b��D4Y�����Ȧv�_�U։��o���A�̂T���6T6n�5�����222��� ��y����R�H×�0LDH�z�}�P �q���-=E��i�W/��<�J�sf ��IR���ۧN��P4f�$V
~��_	�H��
��S��j��ˇ v�	��HHh�C�S�P�Z*�0F�p�9�f`8�o[a����ze#8���'?�N[4Θ\D�?eS֓�B���1"��OXz��ʃ�F-��9��9O�K�Fl2?���%�9��j ������nb�	��%c�f���è>�+~�w�q��H����
�Wĸ��.����GP�����v�3ǪT���v7x?��]i�j?T����cu *H�%
�w�LJ�p�$�wt��>6���(>�F���5��{�,���)��'H�d��^�Rlѫ�D��Y�W%�k��n��6!�@�!���$ &
Ɩ�%`vGIP�Q����<PB'��=�|,+�Н��w%�**��o�f�:�����Ǘ�!�𥰷��Ӓ��q��?�V��Q�j���a.6�j�G���Cӣ��#YjCJeEMg�N@\I�Hq�2�uw���甇�� �1�����ͻ
��s�ڗ�G5C6��tx��Kd��������\/<���0��0�	�l��o0��t`-V���u_S����r�+�UTݲ ɉ�M����A5T�E��U�R�5+�ȟ����Je��R�6��v��='Q�mA��� J�����ׅKt�����]q�	�G�eχ�˧��Yݞ��֭�1�@!]vz��p�G��m�I_Nkr2"��&>i��֒T��]�)ߥ�6..�#��n@����]��jϛR{�Y�����b�c�_#<�@J���y|��!K֕6���U�N'X���0X�¬� j�b��!2֫���:��"!��&�.�g�r&4�!��Q�꼨$BWd �R1<S<�	���/�R��"m��J+�K�d�:�����%h��sk���-+�)�v5�7O5O~��C6@;����ڶ��� ȈdL��_�J��߲�~����b�@��|�n�������<A��s�`S�| ,�6�|��XJ2�Mg�lp�5����^��ū�ǭ�
Fn��؝���9��E��МA��\�o���k���D0�tˬy�߿�G��b5�t����[�C6)�,�x�=��A=<�K�����,��8-��
{�� ��5b�ji���$Skm�)X���T�#�J�k����	k�MK�d��T"��L����`���M<p��l[�)]�T5����<?H_�8ʏ�ͷġBڄB����dGf�9��7:/�>7{�I��I������JR�$ܾ6|����?���	jȀ�`�_�"s+~z�+�L�{B���3\(89a��X؝���/k����'SZ,k�߻2�I�qi[��߄; �iL6�y�Γhi��<z�#50F`��l�=��5F�E��NV���ae��
�6�t�5w�8И;r��?4(�B��L��C!�p��I$��v�=��y�Y��Z�8��VC �����h��y��,<Ւ
�ʃY�=�q�|U���$�L�-�p�5�p[�zh۱����BH�oY��s^�v���M���v��$G��6hۙ�<m���̄�����_�)uq�������{�ߚ[+�`�H=�w�!Eu'����ŏaw���ܰi+���:qɑ��{V���v̟r�a�bDb��JY^��Z�"a�UL/��s#Q&�K^�&Y�0���H��BM��	��dr!����=<"��s��~�_��Ҍ!��%��x5���0Iz.��M�K�ҹ)�W�{Iz�5��CSOz\E�=��n��XQw�^,HS�.��)����g��JO�^;�.d�!���2n�eT+��zD�࿾ړ��{��%��d'� �� �qh�R*�k �]���ȫ/g���$�eM�v<}�qSU�(��
6D��.�֛�ҽ�Pej�eP�ۀ�{u� �p�{+86�U�	�h x�,����ϘY��7T}�Jj�ףm^�H��d25�8��3x��.v�Z��Ҝ3�P�`��Qo�]v��P��ݪPAL�uj՗e7���ZFN�U��-�z-�Q��2)���XBf�j�%��]�6�r2/5F@��[%�E&�Y5	�Y oK7�c���W}�f_�A�k��)�-���P|�O�|��c<���ŔvN���P.�\����%�@�B���'����zQq��2@d�����C �&���D����p��V9J�$Fˮ��g5bճ�W>ǙP����
X-ECO�h�͇���W�u�K�5�P̢�1z4~+�^���rJ��������ܠ})["R��Hn�3�n�C��l�ʀ�h'$�Շ� ��~���Ky�I��[���Y�?��e��H�c��������C��4&'�ȅ�0�I�r�Je`4K8�a\� ��j����9�|�#�;(P�d-�Qk��.�^M>��ٮ;���Pgɺ���U��q\��G&ؤ�̉��n���sk����O
a�؛��G�萵�N{pP/��U���C�[���J�zI�A�G(CO-�1��2�Ke���2���yjR���>��*6��]�P�|�_p����9���n��nT;ȷ�<X*}8h�� �'刏?w�=;s,;���V �
���ח"�à� ��=x"CO
y���1�P��-�Q���NV��~�̚�/X��X��gb-gF/�P�a�/k`�wE���oS_f#y�q�q[�����r�+;��Dܝa����҈��u�8]�{oL��M*���<=��>L�q�/��l���54�C�`u�&�I�3"j��؛�Z���H�ja���Xh��c�0ch�y��:d,��]���r(^Pˑ��I�QѾ_w%���&��	�r��Ԕ�0~�[)WQ��"!�b��O��şK��eد��(����V�w3��HBSD�C�
��*wBn����>u�aa�z��2�Le�yx|Y����0�	"���L��ډ.�0:�I���v\��p����o��$V�A'�@?L~�&0M�z�ȯ!�!>-����uw�*��S�=#�o��O`���@�.t���]�D����7�U��\���^���,?Z�}`�op&bQIA�����v��)�^2aq�ُo4����?�;t��E~|Z=C��~	�m�?@�V}R"��u��ML����ߢ��<2IOާcܟ�����Si�i9��vk�7�l�$�CSn�����^n�$�j���bؘ<�S��3I��D�������TC]����nxr�fP;�?b�a�O�'ɝ��P��x�E�A�?�^cC�*�N��)h��=^�G���\Bް~���"��dh�J���y���7��#C@���S�f���]B��J7`�k�ʹ��,�O��x�H!�d?�E�z��J
��f��	��oFBD}�T�b����x��+��2�ߙ���Wf}_�9@�$QˈC�i�Ex������Ɗ��M�ܠ�\*�\(�4��4'~ڥpU��(J��̶�K�����,C���v��ϡ��Z���L�u],
�e���_�&�T��0��=��
�'>�cr]�?o �x��	��b�ʢz�<��Y���#�4d��X�~lqw���+�P% ���mԕ!���*P��vÅ���"�F���4x�f�T�E��Jq
��f��S���e��	�9W�P \[���� D��r��|�ܐy�#�7_"��ʁ�X�?�l]�Q�]W�l��D�gDl&�H�vƕD�4��?�/m��}�&���b||�7�	P�#�RE����v4�2s��K�+Z�<�+���OH�s��Վl���M�L�)�Fɢr���)��a�9~���ʎ)�fl��#~rx��X�k	M�MTl���k����쓠GA�3_/�1&Ӎ�~� Y���8�tc����z��~C�,}Ǣ"�鋟j�N�!g�C��<�"�H�OwQe��٢�Zp��2��|��52�Q���YO�%]-�&N���q�'��E�T��N���g
�"����I��ZU� ����2��½�)q��O�c�k�Z���fwt9��ݵ]P(�^�o�&rg�O%��2�^�j#�%F5���wm:b,"��e+XbW�39~�5kN���.�����|��ܠ��x��'�X:�'�+�&kH)(1猍Eh(�Km'��x�b��%Fv�4m� �)/W�G�q�8εQ/W�.p"��q��aPv"�g����&�N�K�O%7��Lr&u1(k!
y�0�'�~����P��7b6Ӯ< ��ww_��[c���^�`w���{�%x�$Q}d��5>ui$Ǿ�C�Զ���VC�W|��~͸��f�Ir��u��< `e�a�9��a7G����_���D�`5P�x�z5-G�@�����c�DRϏO�l���WXo,�ݲ҇���V�ƚdȞq7Ocޡ�O�e5A}�!Ѷ�-�ka;B��1��N	D����03��^ҙ�h�sIx�s"�$���F�4�N$�7ei���y1S�9EWů� �Rv�kp��9�Im_�ޜ'�X������|	�`�=��@LHt��w��ϯ���u���v�g@���~i���'������\V�ӝ#1����� u��f��مv=��N)".��[94�|ڧ~kQ��O�n�kI��]]�m����¨�����l�������P�r��_2=��\\��z������F�_�uԟͫh��^%������m�uaV���{�?g�O|U�M*�(d�k�l����Vo���|�iȡٷl)p�R!|34n|(��6C���q4t kaR]c\��A5��a�����Έ�I8�����i�$Kr2s>"[�G%�TiLka�΀������]Z���G!u]8>��fcJr�X�~Q\��S�Y��Y�o��g�)@"T��Uw�F6��:�j���@'��s;9��Eb:��4F�t&%sA<lev�B6�6��2�
'��i}��0@�)෈��͢�(��E}�e%d���X*�S��e*ۏ&�x�yu���*�~��d�<N9uE�ڟѻ,RSe�>	 B9��hS���Ԫ:�k�Z/��Ŋ�ذ����"��:�8ŏWV���{��t�}�ip\�'1q\�e��5J����8o�%Gq�3�ւ��A���M�b!�Vͯ�n�O�g��y�9�*#�,���X���cرU%�nZ�%\�m��w7c�KE�����OM��Ύ7F>�A"�V%A왈jb� ��y�r����x���F��¥(��A�x�(|����}�@�=C;h�̀l|Z�*hܶr��>�Փm�7��&v�����8�d��� �3��^�c��nV�/[�gx譪���I9����q���l��U��:�Ū&�V!4��RŚ
n�U�t�=_O��5����Xݺ=E����-��)"�N����d�w����q\�%�z�LN���
z��)�6:���3"<�@� ��XM�X��lT&ԅB��<�q�.�T���m���і��x��~��sI��Mԧ�+��q���k`���\���k��"n��ז�l��ҩ�m��혏0$!�q�+�@��+*V�T�pn'��oNov����ϻ�!;�y�[}�z>6�<����)���è�xg�{&伲>Fl�<՗J�Ǥ0��'�Cݲ�$�d�/r�3 @���e��Y�~?�[4�nr���L�K��ޮXS���G1|#�o�R�����o�m���h�E@z�<A�c�^�b���}Ȁ����H�dG�D�rdچ�j5%L��J���ߦ,{<��M�>f� ���� �#N�8�a�RUt�e1(�||�ײ!g����B���~�r���yˠ8�J�%ĎjƔ�Ƕ��KQ��C
~����5'j�LZWqf���>��-��0�yk��=i�y�C�ō7?%^w"P��a{lOD ��m�9ܜmq^����U���0�'��0�����/�D�ދ��-j�W�-�/�մFmFu�r�U���]q!�}I��=!"N���4vS�=Y�� %p�pm�� QA�����{��a{?'��P�Izb�xā��K�`��y;������O�t�b��cԳ��)3aAW �ֺԊO:�]�pk\	)N���7j��cJ�$�Q���/��U���HR4��Lm��c�e��}��n��\��s��t�v�G�f���0O��I�`��GC��)�M��}Z�����h޾ޮ��}�n��H/�$�6^����m�N�f����q(wS	�ƭ��)c�h��d^~���1%���Aþ�f������[����7��,�;
+^e3�@�5>#2��M���Y\�M[��������lO��2�؞A�%�':3���G8-b��1D���a}m$r�/�|�}GX6�v �k���&�����m���(t���1qc����1�m�S끬k�?1�Ǒ��.d����a�4�ԑp{E�#��$��'���x;���-B��bN�ts4n;Z�}%�^���X3�7����,�B���?��!#������bRs: �:M�Q�|~���`�B�L�~c���% b���_q���;�a�Qߺ?���o�e�P&Sa����_0�獳���4u�{N.
���}y�YϹ9:0���)#[��X�)%� 梐����X���i����������dԃ_�ބ�u(���$��]X�a4��ճ杗#[+n�����7^�o�F�������0��hF%�;�����ٯ�
�Uq㺹��g�&����`�hL����M8uh)��4]o�x�}C���꘥�Y�S��Ј�&b�t��ї��J�ݱϥX��H0�'0ժS�� )��/GyoTaFaU*Q�ۈ�9H0�O��H�͊-�+p��V�>W�3]��XHI�����Q�a6q X�P�Ͱ�G=��i�%|B��E�l#հb~�4�w�V�o�!���ly55̀GcRLkK�{�2����
���	�%�Nr]Y�Y��� �'�I����'�W��N������Mt��<���ϩ��
����n˘J�-��WcF�#`Qe�3�k;��]B�>:Y�"i�.f�b�<�RJY:4!?ƛ�Q M̨g�t\����ЖZ�S��:\|ըL��� �7x(\�xQ�<�v0+
_��ˏ*\�cP�3�Ò�섄R�L�v�y}�&H�ֱQ����>胪�"���R��,~a�o��yp�m ���u�g[�i-�}�r+�ذ=E@$ml����8b8w'A�N@M��F6v?F Q �-y�H���Ik�]o�n�-�~��d"�|㣦��#Rp��ci��H����&_�c�SR��S;u�mz���������U'ﶦ�QV��p���m������<J��Q!����(K��>b1�|	�>���U��p�}��I���ʠ����qǕ��4���b���z��
ws���1�a�t-7)޹��Ťw�B[���%2���H�'
��j"�3t��Ti5�J���$9wAj�r.q���ߑgaB�0/o�X��d)ȿ���@\Qn~�*�]��(Z��Ք�mxb�T���B�`�����q�����sjR���L����*S�9��Q���J��$����ak,�[4b�
m���*@��󣖶}�wm���8}��!{?��f
!����`�"TR;RL����I�)�q�{'�\轎�����S�r&THb�,9�y�t���l&3O�W4��䊩GVI�cc�{�I��ʽ,�*"r��}_qz��~c��cn0R���5�&�x��j�l�/Չ%Bѝ�3��ֵR�`�,g�^C���~k<z���Z�!�8]��cK�vb��zT������rM��h$��`qp(Q�K9s�K��\���E�p����!�-��v��iex�#���a:<�,�y$�d����	�'*��̿�Y���=��U!B�O*������?L�`��{"�N��xW��{�o�ΔIO�* >ru��Y������q�^N�y>n�����^�cZ�'[e��No	�6_���jst���:/L���-�v�_@��+��+�꼣Z��f�m2bѰ�"Mh�S�s��3{��dR���N�б���K�"�D��jrڪ�lmH��u��y�4�/%�)�QƑg�Rz�F�g;����y桃5�O9S�!��P5�7�$a�jk��|̢!zG�/� NS��iu��������Ȥ�lY8�ʻa��c$���kS>3<�S��xR���5�����߳QM*��,5(8�JA������չЮ�8�-Y��U��4y�k���1} ��t*q�0Ю��(Z4��?״S��P��d0�m��g��%t!�������U�u��b?�́�����8:X��+�t�S�F hRc����&�2��|���f�cmX��$n�����X۾,!�-�:�}T�d����zD��$j�F^0g,X����[gq"�ςb���ܢ��PƎԺ �������꒣�Z�m�aL�0=�{"L4��a����Q�4�{�/^�Dv��OVp� ��j���aɾ@���f�f�HóBL.+.�eȖ67�ޟh����.'`�[WH`�G�P�F
�?�F��r��/��qP�h��:�@��!3�
^�m��J�?h�}�����VŤ��!1	�-`s��x^?�R�@�t���SnN�S2m4����r�������3�9{ׁy? }*%aK�\�1�!���dH����k�|�	�蜯h�6�&�8��&Į�-R�H��B��!�Av�����
���ʏG7�́'	Õ��^�tr5�
���[�r����P�⚓�� J�6O�����F�>�WaOh>7�1XtԅWo/Ω�pĞ
}���M�'�%y�p�D2�٦�f���O-O6�:G�����L�K�,�Q8��!P�w�L����1��3)I;~���iߏ̮�_�^�j3%��KH��XM t��S��^[�� 
���"��Y�_{�4����T�V)�s1~k�am�����9O��m�Q*"\v=2�����C�2�PvnljA�;�~-�T�6����N���ɇ�r��7��q��KFA�uF2X­�c��.k���Q($EP�cq�68{un��B!�����"\�2s���HXpm�=�{�U��m�c��
����i��A8�fۗ��?lc}�ͯ�X��!25�r�:g�JGQ0{C�۬�z_� 1ި��å�Y�+LN�"���iuWDL:�$.�����47OT p"�]�]|����V���Y��0W�?~u=�b*+h�W@`ص� ϊ�N�����t������f�
��W97��1��]��,������揣���?7١_��儧4-s�O��jc+J�b�,�͖��a��3���1B����i���nvƯ�/*������^�z��uB��.:۞$�>jo�X�$��e�����Tf=Y��@�G�.�!�ےw�]��Pi���$�LU����Y��O|��":j��H�pA<�����<W��[l �w�k)F�IS���,'V7O��R �B�Ѯ�N�PQ���f�l�7%�KF���Km����`aH��{�K��kw/�>-̕�^�m�G%_�,~;�^��9&�����|�kڵ�����[��Om0�~���/Mh�$���^�g��S��Ih0Hh��j3��}kߑx(��Y�@^#[h;�*��ɻ�m�]�d���g���Ps! �+dN(�PԏX�-�-�Z�澝8��*F�8�C���	&b�C���Ş�ɝ{W�{F4�f�FBHyP����(�ɸ��(�jB!�����+K�l�--5�����\ʮPSQ�2�2� �Aհ����QD�e���Xɾ��ljD����r�(>q�|��L�?w�(��v�0Gؼ�qܵ2>���STeIw	��\�e3m!WS7 n��+B��p��Y�B�V�H+:�ZZ?��s��xؿ����"W���e��u��,ey�sl�͌����J?�|��|�b���
����{w����^{�?���������Tn@�*A��Wx���4ᣓㆵ��"�Y����F�Hf#ܭcĀ:�0�J�����Mt��y<��$ N~
}6P�H�oe����q�>eK�m�q����KE�DR.Z���x�np��Uiߑ�He�ߙ2�������uSg���^`P���
��E���ni���Y���{����o @v��"�d�u)��P��n�����x$�8|���$�j>�����芄��\ťn���2��\;��ŦOǬ��8?�lHP�Xc�u*���[@���l%�O=�����{�=���/Fu��O�9EG!��,���>^�N�WGTH�a#RZm%l�E�/��j�B�7�#��RN��gSwp�·��bі����O���u�8���y����;���Y�尩1��y^��K+\TY��~�\�M�;'TXZv��3lCXzb��	��1M�u���k�t3�%���յ���x}������ ��=uӂ#�O�x�aFi�H���%�#�f���n�>2wњ�����|�_Q��������4�(�؍��2^r�7x�$7"�� te��~���ȷI��� ����Wqv8���/ ˟����g�LE/�1�-c�:�(�mD�+I��6��럸���Nd�;�t	��� !e���ۗrML޲C��_ �=�,z���,,ޅ��LR`�߶�6b��<�r�w�䚜*�E��;��n�[3/^���޽��]�h��et��۟�y���-��a�YlrM��S�r�\V�>�mr܃���7�o�Pm.�鵺���
Bff%*m�ۍh���J�Ҕ���[��#���[��=�O�3�.zgTO#�~��K
�Oa2�ps�����`*	$�7���$w�'��/b�>��!�������a��C7]:�� `QL|�ƋW�:�E��~+K|z�(p�>"X����9)��o�2ٌ�R0Dc�AL�1%�b��?U'Ƥ�Au�5��W�<'�w#(B�� �l+-~i�~,m
�oB��ڔ��<�-avg'�2,��̕Ox"�<��}����h�9YH	�]�k2�я�y���*w��Zr
tx�1H��7j8s�Z�~%o�E�O�z2�ryi$����p�m��Q�3�,s*��K�
���� A���:vίZ�0�̜��O����1>&�)a_��_������|(��"�2Ԇ�r�8GK�vp�4e�1�����0�����0(��9�IP��# oa�d͓s���� m`\�n��شW�ΡI���PF�~��2�fu*�$tc�9U(�g�@��leC"�7Rϸ�؈5D�Rv4�E�@�]J,{�Ιwd[j�_�)�p�7�#�jޓ�ْ~v4�f�M�0e���o�ԗ�����fZ:_�)����i.
�1b.gH���cq��7:�Ũ��۠1z����/߽!���q�S(J�����#�"p��F��R�斘���O���Kx1$�}�.#�3T��ʙoo;h�L�)��b�?��/k��n�{E����O6Y+	i4b"��F���8�d�+����|��%5��%Z�kA�D��O��8
����d��T>5��B6S�Fmŷ�s���X��sov��فz&��������^a�,A��~�?T�^Py.VB�͈V����|�*�%���ڞ�D�x�'�с�^�d_���Q����tҚ�o����ЬB�'
��>Ó����:��ZKaKXR7eR_m��u�:�	�C��*����E��a�N���ra3w��n�2H�DX��W�-�B���K�p��},��(�c�^��l<��pҳ��4Tm����"V7"�Du=V �W��3ź��:��NMC��gs ��m5�A@���QGe53zV��Y֯�'!sJB#�/
�� �&��>ɬ�!s+��t��@�y�^`��<���=�t��%�2�þ-U�!�2]�o(��I�a��i46��^��n]�#~yR�@7����xG���t7- �~>�i����*�"1��e&q�^���-�7�tN\�#s��tm�	95�e�ɂI��e�2������	_�-f5^��p�I��B�D<g��
���;gZ䦀/������$��D�3u�x�1hi�����۔�P��a$ѷY4$4'��_���.�V}�@0��k��J��=��j(�p��u������f(���ZS��-p���_^��yH���t�+:�A��P�x��.㥹����!,�p����^ߓ���I���R�3�3�j;���5�H|���I�]����b��v��<��;��ȳ�"��J|hX'������O�k�HI@(RA<2� �����3�|��Db-,�JR�N%	٥�OF`�}4ȫ#ĥ:���_��1wy���X�7�� Ϙ��D��B6А�(S^�ݒ$-F/_�~ט�(^+�7���*4ݛ�_S��P�����Ti3�g�����ݗN��#�^cB��J�:!�=ًU?CPH�C���:-^Y�ԇg��|��2:�Z�Tt�[ߺn��W`��j����J�[�O[�^��T��p]�W*��U�
�9:�(�yi����5��j����Ѵ��?��!���>K����?g���Iw���c���MJp���!4狀�3_�O��sB�[�;���C-�]Q��a�s�	���G�h�[W�լ��l@R�Q���@���g���)d��g�KCt�2<R���P}
լ��f�j�F�t�i*<���]������XI�gʸ9F�q`4'���j��9s�((��;��]��k7��'��� 0=l����q�"���Kq3f�/<��3�F��J+���$�C9*�=�S����u^L5��J�;����y1�9���d�Rg��5 �.�$i�|��xcB�p�t�o��f`��x�cY%��{���a7�ӄ\�^_�B����Vߡs����}��X`�f9�l�xj����_�,�/BаbJ�Fb�M��x*NS���z�����]��ӹewǟ2�ʭk������Hyd�D�h!�� $gJǉ����6M�"H ��F��9�s���m�g�F80�������%�CJĮH�`��ќ�soAM���.���Ys�$H�ӮO��;���^������N��fy�z���p�p��&FV����QT���������؎&x鰲_>]��S��g?�t|8���(Ф�]����h����.��f�v�W�5�`���W~0ݛ �DL�,���(�2 ��LS"1�G��\�0��%���z��ޮ�d� ��^R��f�Q��������#�`�JiU�+:�!q�,5���F �����a�ꈢWK6���d�XO�o��g��=4��rQ�b`ة�k	���Y/g��{�6�ދ�&f8�)���6,����y��D ���\;�7��ߐ�e�[2_���O�wX�!SX����d�n!a����b�p����Z�|� ��ݒ�����-𒝁�̬�>��J�3$\ZA<�|�ע��li4�(�V'v\���U���(E���� Hل��U̀%Տ�SP�P�m�3w���ƚ��17u�V��WU��O�l��)i]Ϳ~|n�QA��h�t#A��V�e��ŰI ����%���t}Ɖf~�Sx+�@v2 ��):�#/9��@�2��t�M`[W+Ӂ� �Nj����q��	s���|Ven��\N&�M�#6ƕ6������s=�I☔U���t��7����=	��.Fc�M��&��(E���`�cg�Էb�4pK�FI!�?����g�b����LU���[G���]���ܯ������2�Hub<e]M�y�t�����m�Ǽ�>�ߖ�a��(3��=�yg�6��b�-@Ƈ�9v_ �`�e�k��\9����7����I�Q�� �|��?�}oX�0C��Tz�?��d$y���Qs��W�(��B��uEp[g�t�����ưy�����ߖa�pKm����hB�d �6��2�3$��3T��/�1�h?�z�<36
!�Q��@h�i��V6IJ}�	��L #+��������;y�w
��]���
��{KeK����z��L�t|Z�F��>��g�c������4�$-�,�;����R��\�ϖn^SY��C7���c�7T��55��#Ɂ�0�Y�;!���l�I"�_-vv�%�X�l�����t��C��c�7�̦�7�Z�1�T�j=:^��?XD��M!����SBȘS�FaO]��JD%�V=#~ʱ�#ǴP�\m�!Y��!��+S�.�h��኿F�p>l	 �h��O��g���;r�E:�oJ^;���i�D�9�Rv;_�껕5[�I��R�a�ܨRr�T�x��'��{*]V��.�en����=z�¦���(��(��]�]���8�u�0�%	 v�;��i5C}[��_�X���G-3�e�T���&q=�~�hc�	��&B����<���S񇞀��v��Q��%�z��Q�������f�� =�oo����3�Mxӳq$���:(չc�~Ă�&�$&�%[5>������D�*UB�wJ?��竗���;k��R炧�/��$&܁��$fQ�2S������ǭ�c�������~�[�$�������Ӷ]G*�
ʾ����.%��E����B�[l;�',���Kd,Ӂ�Aೲ�����n��$I�ͅz��bT��ׅ���M֒=F����@.�ie�WlPR��"��?��1u0�V��l �&X^���Lْ#+ �>:0\]��'J����|�6)`P	}I/fpd�
�A�����	˹���ߡ�#�bK���%�ϒ�M���I��.��F�{,UP�Kj��jy��dpٷ�U�~I���R�b��P�te�^Zݛ8�r՜?���(��(�Qn=[�i�|[7sf՞�r��a9���O�J����N�Q�PL�D�=���W9�_h�b���_�fn���E'�K{�*�ˆ	~�{��� !)Yr��`a�	P��(�A~���Ğ�����W�E�lb5�6׺�B��S�][Mƙ������qV�FE�n޴̷�r��v-�Y#[A�h�TӬ�CK����R ��tro�������!��8�#����%�r�E-A{��Qx����unl_qU�j2;/M���xX_���m�o��L��)���[Sk ��p��+`���£)�%���%!�%n~:���'�ryk�`�OTb�H�S�{ �vx���$2o��&�d��O��{�I��o��K]`'W������t�(Yة#?�]��^��d<b�m������Ml[�61�� H�>�0t\9�3��s�1�S�o��H}y�leM�I�6�I�j�<sk7k���N��q��P�l�&t�r�������y�_�h@s��/�Eb�d��2��[�E�s-٩�K���D=�9��E�mV[�'�H�����؋�' A�"���_p��0`RN	y���*��!��"�0J!YS�'��
%ƙ��l��,���^��W{|��>ba8T��=�c~�0E-�n�pK�/��K����A?�?���:n�O�Â�ddTm�5i�p�&����n.�ő�a��Ӊ���[G�G|�Ů��Ha�S$w�\}Lѓ q�#N��[��簒1L�~t�+�G���4� 4}6�7�x߾̈́�
�3^~�>�^]m����xg�7�ģ�r���p�svjϋE���P�3 �e�^��M����j�Ux/����q�-f��=��Lv�lXc+��9C��7H2-��* P �z�u�U,	�L߈�G%!ᗿ�V&�,�P���`Ds��*��IwQ��1Q�>�cNO���O$�чc�.@��:�5A(��MH����K��#��I� 1��;��:�jk� ���ו�u'[��t\RD�߉�%�+����YV�v�v��y4�1�X攸�_��]}4y�� }[D��[�K�e�Q~v�C��2�M� �?PU�"��fɾ���ATG�@�Q�J�w���)�RRQO�}��M��²���H�+�p��{�F�q��^�sC�>$�VKMo����y�&�9����Fd�4T��04gN �#?���a��D�{	^b��k�H��m?�Ў��F����Ո��3�ƨ]9�=�t����%�/j��5��]6�1�<�V6�kk�r6֭B��S�߸�P]��{�D�b�Fi���,~����k��/�P����In˳�H��M/��@�)f�*0�O,�N �o	�����,��c��i�j@���g����]~���=�Y��������Y`5���i�����������Pe���&�ՏF��L��e���C�XL?/��?7d߱�SA�[-����@Yd����B�����OTA�KX�	Х�fļ�U�ٜ�hsA_�����uH�#�S$�,;��Ԥ���$�;c�r~�����,�r>�ޔ/Y;I<�qh�C7/�	��Q�5�~��,���A38�X8fZ;s]be�n�W��?���[��HS�՞����,B�� !<�`h`��?�b���l���7C���|��ة:P�֬!Î�K�;_��C
�$e/2ƞ�*�k
q ΄��S����/����`"�Z����\��%;�k�������c�	A0��d�x�}�C�Խ�Ȏ��c_��{�t���X��Ds�;�Ih���A�-݃���)6�G�aV�*��Z�����-�S�j�w��6f��5[�I����k0��ru������� �4��JtC���%H���˩�L����3� -�m/\�'�G��G��4;0�wU.g3��|��@d�&�x�#݁)���ɉe�;��x�z|
�nP�M����[��nl`�� c���ƿ�e�?��_g(�(7낕'��~�>��
]��X�-0�m�^��3AL���y��c���pP�f͈q��y�l���%Q��z�R��ט��8�Yi�TN�'�7,�����TB� A�7b���B��������tV���AG �8JKӼE�?�q�'��ފl�-��6���O�ӕ1�j�|��.��k��f敼��a�b1��V1��C�6��^@��2k|����4�ҙ���-N�jMo3Rd*Png���b��c�U�,8#a
k2���vr��	���s����JU�ow���{]g��i�{_���o r�]�9�Z` r��z�r�n�?
�z��%�bF�I"��#<�W��w�Y�1�U��,����T<Bez�>�$��Pf��P�S)y��s#�q3uD�*���Ж� �U&�rme:�;
�-d���  8hC�F��ڞ�35����s�3��us��W˩��?�?��[܀�ue<�'~��&p-�C���l��^YS��p���>�ԋ3�O阋
��{��V/d�̈́J�]j���彮} R�eC-N�7m�P�����z���1:�/��x�p���韅���K�.y�ԋ֤w���'`H�޿d���&Z�6�$\�X�=u�oj���C-lcT���D�T| ���{�;2��]������� �J3��p�Y`�=~Y;�M�};u+�����Jk&?.����@Qej{�~ҿ���ѷ�CP���p�0��Tۙ���[RH!�7L%����]�z��4��
ݍl����Λv�zϐ]�$��h�%�5��9��X�of��ǆ������6Ɛ�hYғCjaaNp7�c�μ�	�̿ST�?ru6�&�mI:lY�~r�0j�s"�R�Q0L.�/$��h��ԢƔx	v��3�{>��+���fP��J�"�=I���HnzllJ		�Mre�E`�j�I�,�u�(�Qq��.�A�ߢ{%��V,�6 ��?U�Nl��Ӂ �1�n����	h���'|ɐ��H'?ΰ���cwy���յw��h�m4���>R�Y���3]���PQ[9鼡'5oR�1Y��V�q]�g*Q�f�N��/X^�� #�,�:$S���A���U��5���^8��~����ʇZr�<��)�eT�z�!.�a�>�?�+��W��|�Ċ�kn�Z[��ƍo3�"=I+<?�F�D"�o�#�Pݲ F�������vB�D&4�#<+�Q5v�QĎ�o�f��O(���ڱM���5+�ݠx��d�s��K�v���0-�)� }��b�i��^��b��k���p����9�K]$W7��B<Ż`� �!�"=�L(����/>(�A�Ա�~B'��Eh��s�Ɛ���&Ś�����R�nW�k��%`o���b�!�g��ܢ������7QS�+@>�C�}YO��Ȗ����h��K�f~�����q!W��⪅�����~��\��+��B����e�]���"E-@(�sS=����!Y(S�js`�U�x����x��\x��ޮ�r�켋�� �<�� hP��a���&UMfZb�5C��P�9�u�n5��#��6��d�D�
7��t�
�Z8���/a�B��}�e�87����v�8��y�op@��$o��m�{V�7U��s>��E��1q�������jR��Ebהa��*�E�RD˙���t�E��w����Y?����K�<������1/���^��J��#����a49WN�����`lZ?/ۄ�ܭeO����=H��[�.(�[��&@"��zIp7�.\&/�Zs�2�߶z�HD�Pt-$/���Um���m��)�s��_�Oi��$w�=gL�)l���gD�+�[��h,�o�L�M�
�i�?�A�Vhr��� ����.s�N8�<��B�R����"�
���?w�j�(���Yӭ����BGx[�Rqʈ�J�v�愘������wG��Ԓ�ٶЊ6Ob6`�1��u]�ř!<������u�9�t�ƶv�i0I���B��x�0+�;vS�ZT��CfpT��3�ߧ�c�#���Q���V�M��pRwLi��6����]q~���v��a����ﳃ<2���p�����~��ڪ(� F��U2�M��yAK�C�8�!a5��0:c��9�)���yP4O
w���ew$.[^�2��܅e.��xZ�*[��nN�/K6���#�JC_ᦓ��i�\G�k�"7�ω�a*�y��}p_^�޻:tbw�Jz��7/��,�˲C��W�6�x�DE�˺�X*��4���x���I�(J?�0,�ሻ�*-Eoq�N�h�3P�{��w�\ջ�q3�Imޚ40|JKhu��/�.{����0�V���/!:!Z�P�P�V"�{x��M>�$6�3�j�ԊH�^"ŒF�\��*��Y����V��������[�6���FG���oͫ-��Mfn�4���;��{]s��ե�C-.��n�� d�BV�<��ȄQ,&��>��0-z���I�9e4�o���Fr���+	:�/�����@�;SE��� ��e�(v^�F���	���|!v-��U-d��j˘��ֻS<8�RqN����l����٩4PE5냁Fc�9�m��\�&��T<G����|>���to��K�	��7����󠌻�!��{���K��fj���"*4�m��x��R�	���lHh��UX�>%���'Ri��o�2�l%h7ŧ�8�Mr�dW&#�!�);Y"tK!.�i{t��'m�o%ڶ���J�ֺτ �ǙD@Nv�cQ<mq��k���Nj0�9+(ǥ��T�ŨuQ��܄4L�ExNJ���~uQ���ht�5��@P&����Z���KX"U�*R���ȃsֺ�D R;E�b��ҦR:j���\x����}��
�hwև�iW��2N��H \�H��2�]�{����1ŌZ�0�l���j�*kϞ�c���O��}DҢ!Ao �y}�ȱF`t���+Ն�B�$X)kB���īOޯR%O�b#�R�P���߃�@��A11!%-wZ{HA�����|o+�I�]����*����X�l���)Gǅ�̀�k&�{�z�)�ʈ�#�%sib~�_����g<����
g�=�||{G�N-�:]1����5|�sR���M4My��}���ڢU�8C�����Is���	w�O�~�}�3��&�y$�:��#k�J~�ps��A�`��|�I���x\�I�k`�:<�A�Y���j���`a{����u.�F=��H�.{8��%ڏ�ڶ��;ojNY��Ϸ��Q�
��"87rf�c ��x�׼9�T�S9�����ڹ���c
O��<]>��2��vE�����ج��c)�O�����0ł�*�5�A���]�m#�NbP��ܓ6��P�'�R��w]LU�aH�QJ�5��{/��(t����%'mmx�8
�gh���h".1�`U���H�R���Ðy�಍�d<V���]��e����-��}ձ�Y�������S�N�NhJԵ����
V�oo9F����
�9m�2ya�Z��g�� :"���r)'��=���)����tb1������>�q����l�ֺ}_�{���8@G���7�p: )2���uW璨u��Y1\���mf&b�9lmqx(��.2r��yF)ᄶ��v���D2,�+��j�Y��LK��~��<����͐�-���<g�H�w�S�m�䛌��h��u��3�7���F���b{��f�Ͱ�Avs����C<]_vɥ���!�-�ng�A��8�>Rjn c�xuo�{1� ��a��0���Q���-��������@�{�Bw��{�z����,V�+��{� ��`'�yC�uB�tS'kJ	�/��_�a�4�F�}چ�_N2 o�E���'n9�w�%0by�Y�j�^�}�3z��%*�}�Æ�ַ�D��/�;/Z5)������'��ʉ���L[�NȪ:��S&�7��8>��
� ���S.a�~U��Z��ѕ��znc�S#)���42�I����~��)�R˔�E��4��}� ��,f��y��G���a�z�Qw�����N@�Z���d 8�K�S�ܞJ����9v�`.�<	�I|/	M�>V/�e����Q8�Yͮ\V�!}}��	�;�D2N��ۻ$���<�Q���I�x���o����=��"��I|��u�� l���rꊮ������E�����EvD���}fe4���̣�_�@ɣN��� ��ј�7v6�udO
#;r��8�T9�f�h�T�}�6R|[w*���!!��J����E�`~	$�O�8�b%&���q�\���8
���fZC�(���/MS��ܺk}�L�S	dc,#q��a�`���C�v�k�L2V
�����\��:��ؼE�6�L^tU�o��i�1Փ�K.uD.͙cSR8��(�`�x�Jd�f ,RYS4�,���)h#Fca�<O|�uڗO�z�b�ӟ��j�yi��T1Z%n���[�	�n�eO�]�ӿ��N^̅�J�{&�Qv��em���F���F�KRE�h�S�L;�����:�X�>P&!#�ւ��u�@]"�{;�
��<*��n)�R��ݚ�}�-#�V��k��	�������u�]:W�~(���{�5��%v˗�c���S/���2��(ȟ_Fjh3
�m�P}5��Ɨ��)�eL%ӹ]��e�X�`8��w��#0yH�Q�v�Z� .r�I�`��vAϗwY�g�.�.���D���yx�<�+��c�+ܓ�`��J'�� �y�]_�raWC�>ͩ�0S	�<�[~���ۄ-YG!��1��
zEx͋M�D ������}f���qX���)��ql=����ߟ
m�]��T�~��Cb8L@K�	ϙ�5-)^��r�yu�?2�Q!�#�7ǁ�k���]��l�~�·�s��d�Zx��ԇ�� 8^qԺT�c�1$���8D\&о���+�,�������m����RE�}���B��7D��~Ä���l�j��Bzd�f;�޻�Q[<�ap������H�:�\��oasb�Pz�g�����ȼL�_Q/�
97�0F@��?�����^�ʹ����/.16C������~�^���`$�3���|�[�5.-�4b�(�������c�XG�f	c���?�c��G��Ə�م 4�eKS|f���Q?�=3MG�S���s�V���Z��V�,P��4y��3d�c���]�Yj٠���G۽�~@���=2�`՞�O�T�>4q�Hh��Sp%`O�~d�T��Dv��4��?+`#�\���������\!��ClCO<��|�D�!@Q���(�j�*�����3*�t�j1�,eI��F�^G �5����=��է-�	QRx�@��mB��j�n�Ճ ��DTX㭕��ƽkx?��!˝��Jy@�C��a�`�&�O�o7iZŴc���O1�M1��Ñ��-3ߤ	�4��,��mץ E\�T'�	�&qt��Laܼ�����da�\3�$�֡e��de�5�jò�qoX�>��]�_D�j�����Ɨ�q<�]�^�:�����.�_��j��yU6|
�D�|�������K8s�8��ajZ�x,h˗�p<�b:�XBs������n�~w��ݜ+�)�H��7,��+8pj��l����:0L�y�!%��С����?P��H���Wt�WPd�~�:���<�[hg������ܘe0���'�h;��z�J��,�Fy��D _� ЌO�|��wC�)�W<O�ѕ�;�J�?+�ja���B0��aؔ���>���ӑD��?���k�R�2���ږ��3{=�K�q��\����o�x򨹃c��r���o6+(��1���o�p�J(A�]
fS�{�C��W��i��+�L�uq���`ک.gޠgV�;�6g�,ċ?'�w~D����&",�u8�y������Fd�h�;`��\��.�`y���[n��z������iV)���gbT�]���B�Xu��2�ն���Ѵ�a�٘� �8���%�w,�1���*���`NLs@?��6[��&����}��C��3I#�G�[L��P��ˎò�T*�QĤ�`��F��9B]�z��E^���g��e���D�b��ζsת�R������Ed1�һ��r����I`� `�s�wM9��f	<tm���v~�~jވ������m�/����hu";d�3.vƚh��4 U;z]C�|�3F*�	�@;�X��qTT�� �Z��$�_Z����0���k2��$�aJZ�>�D�s���[%n����f�C*�ͤ��}���	��Hg�R/��h�ѭ���O��fz"�,�=ۇ�n�%�U)�ỒQ�o	~��o
&9�x�#샨���`Ɍ+hw;���яGQ@�٦,_�M������X��ou�D69iQǕ�5R��񨿳l �z�(/o>5��_�`�U�	�)tH���iJ읰N�PƬ�)y���.c�[1_���]�:{�I<�
���y	�ړoe�P{������ñ��ߩ 6LE-��Ǣ��]".���և I*3��j�����Nl�����c��ΗL�ĳ5&�|�������}�d�.��3+��SQ񯻭�����>��'���[a@��,�%'��&�[�
n���i�IQ���*�0v�����A�e[��{(bB2�c`�]lX�/�th�e��*e�IY]��8��p����#C�;L'����
�C�E�.�c��3!��z��,)�hg��6{�E�N�v�2�pM�<5���>�q��	�����F3;1`�%S�7s�NH#�#o��w}N?͠eh�K�{��p�T�9�s5h.������[���O@M���މ�䌯���&m�7�_1�u�Y-d�@�I���ž,2h�������ρ�� �B K�m�{L6�[_Y'��ݲ}��#��e@%��B2��1�������� c�.���X�,�b�4e��4	������Hͯ�x��F�3Z!�SQ�f}�g'�1����]w��3��׆	��Q�I�Vŷ�R�l3*^��D��j/7�K-���^�<Z����j�L�r�rrZ4��ν���y��9z�/�+^���'�\y�#u2�>:!�%Xj~��)\��X�$0�P��>NtG�F�J��l��蔻��uAP��CE�2t����7!:��u��j���ˆ��ek/5݆s�����aΖ�$N�v0����i���0��#��D2�1�E��/~\�h��
�W�����^=v!��J���*����(�K�8p�^:����Qc�"|�veM$�_��|Ѐ�Ns�}��[p�1�f��K�. z�I�VZb��96	#2[K���*I�ܐ�6g_p��z�H/�l3:/���!���|Ð��ط��I81���#�����R����;G���a���?���Z�^�u��W�b��z�}jȋܼv �{�r�2�0@�����ܬklX�6��h�Jj�[2���O�h�qro��+�lZ�J9�Q�?��| 摩����
��W'A��k;l*�ʿ�������pA{��� ��w�`d�p��C2���K��r�~�-ODQ�m�w���m��3ܚnW|AګR�o���N�KcW���~�h�}���\��t"ԣ�um^NE�Ĉ�G�(��F9�ks��ru$��	���`wǿI��Z�8<�C��3��4^�œ�4����?���Wd>��)/<��t�Yأ�݋�����Bc�aE ��J���A��v��@��,������_d�L.�*H4��4��>)RX����X�\`�NEFc�̐P.,���u�"����c�mxiX�|{JH}G"-#��_v�ς-����E�*<�I��VF���O�ryP^�F�!�-0#8=�);0c�&���N����^���#��=��Ò;��<��]Boe�[����M@�tb`8�������#���SI�R�/�U�c T8�&� J<����ӻ�	cGM�k R���a�3԰�ɉ��B�۬�3ï���˩t��<�8�B�>H	%��E�ߴ�����/�ٟ �?`���-�d�M9��w
5m���YC�������)b�1�C��y��ӄ����ha6��N���W�{d��B�`��������d1��t@;��Iǡ�����9�.��iX���x�JI���:=�t���o��U��5)�!�)7]m"|��jFɢדj�v�&0{��� itl����Z�����3>�W�:o��v���D�Û�V���!�^) 8\y���'��2}��׀�^��%����^�[���X��2�M=�j��r��Ƌ"@��_�2�8-I� �vwɐ	�I�	C������rY �U���YKXFHķ��JjC�/�H�!5_W��Q8Q���4��Ab �!�g}Vܨ�\.5�H�C}�nR4����i�nn]c���7&��ì�x-v�]�J�����>[P�H�%YR�+����q����T�Ŵm)�!h��j�X {�2 ��ͨB���G� �K��|������ݒ.�4����U�_3���O"�{�R%߈�e44�o��'U�lTo���;��y�.䱁YT��O��IA��]������b8ݚD�_��V#�Pu��c��RzO��ɺ$M���3>�Cшu���2Z�a����(>WF��<%��,��Ȋ��	���V��(��#k@������.B���8�T��(���R�ҮE"Q�[���z�c��)5�]����٢�(x�՚=�c���~.g���q��P��ݸ3>,�n�U�Q��*3��W3�	m�W���/�ce�<��k��^%:C�-���������m�����L��0����^��[��K��y껴L�'��Y�b0�?�V�u��d�p�)2+�t\��B`S�P����U�� ��ٻ
 �DH[Ƿ��D�М4��i���A�����Ʋ�h9_��f�-�f�_�ew*YzS�ҳ/�(L���PBl���V��"��]�8�3+��=k��#���,�HȖ\�Bok
�־�s7�I�~n�qr� ��q���R��uQ�<��2�f��T�#�&�߽���������T�e���o)~@����|��¡�L�UE��:�7� ��f_��S�L�CzaE�09R.�����6	A�ΡE�N6&K�$��$o{�L�8�f����cYb����c
ѧ���ͽ��#����s�:�<5:�5��c�M���
��-:�W��5�fE��FHrڪ���+�);��޳�?�]F�+�y�tjgQ���Y7Q���\y�t*1ˑ+E�d��b�����[N���Æb>�|�����G_hX#�5X�&��A5�8���k	�U��E��"X4y�l����.n��T�%���z����E��dm@_��
S�M�&�0�l�R��d<�~�F���d��ѕ�6'� ��s���!��L��|(��9`��E� ���Y�`R�	�V���
��B��j�����Y[ϹԝcW���}U���'MCNQ��AXjU�R��#�an,l��#;��Q�M*��J�"Ϳ��a%S̨�k
�_����<�t��)�_�Q�"F�C���K���&��)s�^�W�]T#��#Q���bA�m�>�
�Z����E����aʷ�u4�6��]��(��ꕵ�0ݧ����|�v�~�z[Kb�nM��F�F_�U��+|��W�rU�.�ې���z�b��-�qP�|jH�����(�-;�7�E��H#�ݨ��փ��v�������@a�U�P���̓����c?�$�	�]�릺�-u�A���%�=E`���g,_X���ͣ[rV񗌗�٠�~Q��5�5��Ղzmb�+�Tr��A���;ˀ˞g�	hDû���^�!�/����,���qޣ˱�9�^b�c0�����E,�_�7w��P��W�^���{39�H�
I�\}lN��%#�ǅ�{��s-���c��C���f1}z�C�Sn	�,��Wo}���妀�̴��Yy_t�exZ�H�Mf C�߹\���+c�Rp>�p�l�!o������\���J.�cS���'�w��u}x()i�G���Ȕ���eG-��/�#�L4l�N?���x�
'L����5��XX����;���28�V3��#��'y�8aS^̾)G'�TcGbQ�r�<f*)���n5l��ݷ�%�f	D��M�|E�`9�_�Jc��������Ҽi7� �o�\��怔�SP���Qj�g��`<:�i��O�C�.ʳiq� q���U��[Ca��2B���4�LqLֳ�PGI��y�S�CN�|�Hf&T�`�`�ޢ�]JyqG���]U���Y>"�I�L^(:	&��H����챘f�Kv}u(�������嬲��y�F�j	�����M��*/m�aH-�2A�a����b]�������Vl����k]�u�$ӻ�d��r����rF��'"�I�����b�$�Q̖C#��u.|ެ�EQ���yq�\���~��I��s�'�:��;N�N^E��:���Q̀��i�b[*�mC���K���^�����R7���P�[Tjn�:
���QA{F蚬� ⻾��:yhj���䆩�2�v����/�^K��P,Gh��������$5kk4�]� �7_�ګ&�1�4��~��������6v��X�k��f�%�y��:�9�\�w0D.\�L2�cl�����ņA0Q1���CHQ���:��d~�p/��F=��_�;c���-�+�T �au�"�`��<���.jG��pM�C ��^��J�[w�E�Ft�@���{%�n�(X j4e�l��ݕ�:�*�5r�Ś(�-�c�Mg�_�fZ��wZ9g��T!g�Z���ZY�t�''c�&��V���n�	K�E���-J�/�����0 �1���~��$NJ)x`v��s2�r��6F�L�牰�$D�!��l�I�����s�r��;�C�'V�a�q[�	�M�V�����O䂈B]N}�+}���n�/�����o}�����ͷ��P#HX�6�,�>i:��u���VT��V����5&C:��A�z��t��*��{�c�)�k��S�6��5_O��Q?��"�&-���IQ����d[�L�WD}�XM;����a��x��bF��g��֋�?it�����U��,�
���٫[�[I��g[�'����T� ܝ���g��9�m잗ȥ�q:ξz��c��*�V���V�0��5�Y0�`/�Qۈ�41��ѭ�8�'�҄�b}Ȳpi��CO��,%CBǏ]��#���P�g�&����] M��tf�?�Aqu$����㬙�,�ݫ�����جI�d1�Sj�˞a��W�1_cR��t]Ɂ����R�׼x5���^1�k�.�qcg�P�w1N�m�5��Oj)�N�k������!��}�W<�h��9b��H�]�V^�/~�1钳�
��CJ��ډU²�e�{؜K��$6j���,�Y�,Q5Y��k��ct�b��"�8\����p�0b\�FT��lzb���K�0j&}�}փ���d����Hm�^h���IO�n-K�y%Ʂ����NԠ�cc�=�l�bV�3���7T� �!�y�芥�O'Mv����M� ���j�>D~+�<�n�l����2Gq`�)��Lv�r�!��i������RVTFM=�r�u��V��?÷	�<����ܹ��	�!m��t�U$kE,�#���lZ�ꃦrM"�G���b�)w��[�������0M���-Xȼ�6�5՛O�\��1�o�nD�+?�� +>��U��;bPv�b/��E��r��w�������#�L���壜��\�#��Q�C=�H�s�XQ)t�@q�CD5Ы�G7R3�O�� .�[I���wHD�M��u������h����S�lG��I�E�:�::w���ֶ�0KRFAw��I7Q��s���69�
�3	z#�t��d��r�<���~� q��(ZT�����1{�%
�*�t����{�"o� ���z!�gI<Υƛq4pp~m�S�Wƻ��v��+��q=��X�z�pe���n�H%���q��8B�����{��:i,<�M5��w��r���81�νG��
��꓃F^j�N����qϭ}�@D���чgz��-*K<�wNb�dl��L�\}���,��_M�*7��*�KO�(� r��ӔtLJq������"M����e����H ����6��d����ŀ��|��$�!5�3Ҳ
)�����C<6����ƖX&<-]�(Ь7���qC��1K`�3hb��~���^hf�Ee�Z���RkP�t�>��I�bE3:t���ܼ����� "��#O35��7� �k��ku����oV|�P�DP,o��x�Q\;VA�0t��*�Q��,jj��i�pPY	��q�Yڀ�(��:a�[�Gd�KX�N�19(�`��"�A~l�E&)M���k�>D��\��ꉗ��Ћ|V�&+>A�['[�>l뫰�Y��PUt��i$�ey�vڲ���0���]e������}S��q�x�Ο�4�N��L��9�-�,S��%�	����l��P����Wn��F�U^�6��Kt���x�V!4�3f��%��Vh�'��0��;�vZ��享����	����=m�P��>v�I�i��_�$��Ų���WS,�x��odؽ��}>����͑N*����ԁ�a�O��v֬Ij���*u����5�1��D�{�:}�Ut�G⩐�_�u$F�S�i5�K�h}��L���n�q/�I�����\	z4��3�]V�ʗ�7���2p#w�F.�J���n�㹫�݀�݋z��̉_�Qn'PrnW=�[��E�*�1!��'_��n@P���b�k�k�A;u\ Y{�*^��q�ʎ8j�*��uNEi�h�
dE���G��ո���'t���#�[v5e��,��kիk��.��9s����\��xf�pf��`c��yb��I-�.��KI�h�?H�=��U1����	.˺�ʵ�;��B[z��6XA�VƯ|�;�34�Es���p|F��?��n0a�/'
�)�Ǫg[s��v�:�Q�1:%_X:G�Ĥ�*�3��
j�=��>�ͺ vͤ#Bem�r�H��;�q����r�ǽ�W@}��?�i�Px�G3�|�t�%7}Xf�������7)�i�T�k$��;���-_�Oxq�����-��|��m�5����ߑ,����ʬCJc��Z�w��54����Ls#V�+��y���<����{����ѳ� j���n"!M8�F���Il//))��B�����i{@�ӷ|{�x���"%�����>�
5��7�!�?��,�"�)�^����Ԝ8(��nP��d����m�G���ٯL��g=�ͼ���Dg=�(�؏��Ʋ%q�:4]	|�WH[ր��4/�eA��*����ʷH����q���4)q�G����\�=.b����6c'Oyws0LP	�a���喝`ԩ؇Bg�t��2�����1w��Y [�0����)���Gz������4���b�)�8�Zh8͍Q�C~���
��M��I? ;��}w�m𤭯�'�E�v�}8y�w�	%~�g�BP`��>�3�d
�/�I�m�����l��͋ٓc,�b�"��v���Y޲ί�	�(�?�And����m�Z"��z6]VP�A�K�䎹�������4'ꆾ��[��fA��;�u�6تK�j��G/v�Ӕq�p;�Pt�pe|����p��ZY��j�����7�f��i=��:���"��N�⳯�䴞*b�5�YМ��`�>=�h^$���WjTF�SQ�L7�x�މO$qڷݶuu��^Y���'d�/[�`�T-�{ '����
A:���OSQ#U�5��#��򺜙�J��$��9Z͚LWh>ր��±dug�{�)s��JE*�Ylx��x�Lu/��l�舗Y�S�(�J�_�ʩȤ��˳U��7�^U�04XW�ʝi�nՕ���S��X[�leޓHؽB]�S�`ɢ8���3�l�M��J5ݘ�e6�gJ�����	�]���8���"\�DC]���C�] ��1�a�y!��,h�K|����>�"u~$])�d+&C��^9��~�|C�RE/)Hy�-���F���%�G__�^wk�c	U�m�?���ia�6�*�z�ͮ��'�	�֩Fl8dpژ��R�#Do���hl{	�S7�&��nMSc�3[/�BG�-���������E�2�7]���&]�d'x�j�f��qN�5u�.��ш!�*L��� ����͝ǚؑBZwP�}-OI����Q�v�))9�_f��� M��	��aɈ�1ǡzM6�"ߊM����2|�A��r0���K��.	�D�,ss���vFB�@�2�_���a���Exy���+?�h�OC��}�LQO�(0b���G���ݕ�^�YͰ[S��C�|DQ]I���-�����mz�: ����E�O�2z;tBr?��tfh�U)\�yJ1�������n�֍��BC�<��@es�J���r�����#d��5'��g1(�S��1��XG���C���XG����HR��Kl���c�%��Bi�_Ĉ�R�g��d+ք��<��&�1��&��u��l�01P"ض<��Y�`�p��F�|�@�7��� ��.GåP�l��vd,��8L��2ڦ8�}pk�~���|iI�㤪|�:{i+�3��&�s�Z1�ET�|�w܀���P�w?��x��9�4F��X^�A꣒2�������!G��ۅ�����}2�~� ���u���/>�.�%�кt�@ٔ��I���#���;��U1��x�S��!/��N��*��o�JI��25�2��EN�qо;�^�'�ؠ��ŉ8��B������]`Yu>�ϭ��3�W��oB;�XM\��Vk��c'r��i�U,�8-��cE�_q���86NDf�vJN1E���ttdј����)qmy��nSh�^O2"ĀJ[^4�m�������F=l21�[�o_��$]ր^r���%��m����YO�k�C���c(�\$CBa�
��o'�����+y��}(#H�7?m�ZϤR�U�5Ay�#�ƃmyε��;*�m
&oC(�\�	��� 3*���M���9�]�ݻ�]*��*ĝd',F$��Y�e�{7Y���Z�lِ�8t+t�r����*��Jeuۭ�~�]��W?�?��05c��_(C�sF ��20xp(�Z�wl%�� ߊ�B��~�D�C����ą<��As���5�c���^֭m:�-khH	+4�5N�]��i�G�����`�J	��O�'�9.���jYb&Z>7�%N/�T�H�� ʮ���@�����4�����٨�y5��I���`�� ��G� ��~>�g�0Ʌ�
�Ԕ�D��?n��&�^it<*L fA�?�1e��8��j�N?ai^���i��G\�q
��N�z!�Ǣ`��(�e����g�-y;��~~
%�Ѱ%CC�`�����p-����Z��Qu�S�2t�%��b���)��䗍>V��dI�-�a�n �b��/�0���?K������I��Kt2to���GheKqYF�+�I:_��2�6����I�a.�z�׈�=(&��}r]�	��6f��}i3_?>������Iŧ!����qW�S}Q����M�a�n�	�OD:��4�ͤd��`��^���<@x��1^ ��<[y�A@p��6���'�������d�08��=��0��	|�Q���nI���;��m����m�J�>��crʵ�nc�WľynGPl3��Q�2��O�"L�{��Q�޶w���'\}�i>�����!vG�K �˶�Z��=����-2�]C��?G������dp-�L�<���	�|L��h��+�����+鍒�������q��W
7Z��(qJ�j����\:��ȯ�-9��k�^�*/�;!�gOQf�
o㗫
���ֳ�!���ּ���u��yvuیț���l@޿�l"��������z_a�{\�u�F�W&2�Ex�J(����/S:����{�\�_2������ҙ�{�)��i(�FWi,뷘�5�R�H��QjG�G+�Ց��{)4��q7�&27l��r��˻��E
���2}=�D��ȹ۪ �"���l7�[�=� aW�h���G@Z$�x&g9��eT�v��8�VO�<����:'$1�}��_��PЏ�S&c���-�@��*
��P�O�^�g�t�O�	m=�Ji^�̰�����젡e<���4���V�DF��:��~���V���Y��J�4ygVh.):q����ň��=)�ͺ��.�wO�f�(��Τ�/��h�s���L�+�k8��}�\�	e�!ɯhٹ�#��N��l�Ë���G�[�2���q��M[���>a����#C!*>ͅhEl(�W�
�"�3՚q5���%g�r�c���?��TDfb'��fv5x��9����JDfP͢��6���ܦ+���`p۹uT��E����a�����R����G^+������Z�-��u�>=�7k蓈�,}ݢ/�4o���ۦ)�WbL-yk�j�¼^��s}�k�M�4&˞ѧv�����-��ĺ��T�/9�x=���i��/B���GZ�G;!�Y�\��������.�,�{����R1�܄�T�t��d�2s�2e��%�mw�#!���ג�ݡeC��:j����xXڕk��=�aNE=���>��ྊ1�����P�n��ú�%�z�c��葝3��$pVk�v�yaS1*<�1�%����K�ۅ��)����8��4�s B���%�d��+́������"90�AKrf����;U~��0�8KN�l%�����^э��J��q:?r�G�9�mn�h-���x����%�^�f�ws׫�fi��I1P��ƌ4U5.���:���*y��2��֙�ץ�#���Z�RN��_A�|z��mnaVu�Q��9�l-yZ�`\ɣ#��p~��M���a�ׯ5yɒr<ɖ�J�ȇ�J0�,�A��V��q�C��J�8�p(O��K����d�t�)�pU�/�:� ��Y�x�i����e�`�g��<b	���W�9�2����/�]���x�U�2�Ck�Gc�\*�{�"��R�,���g�q�L���J��P�4EzԅG�,0�y�g�x͠�9��Ssy?���6F#�z!J,�s�j.�a��������J���N<�޵�i��j�>�y6C�By�̍��,?�S���2Y��&��Ϋ\H��`�n(M��J�|��M�����s�_�.I멠���:g�q�ڐD=j�U1==�_��������h$�D ��ϖ�um����z���/t꽪G��ݍ;�fk�A�c�kUD�����m[.\Yd �X��������X��F'�b6T*!��������Vw�����d.��0��Nwk5���	j
�	�Wo4�þ9ۧT��`spT���'��߫ʹ� h��"�C�5Z�ȑ:5���͈��KϮ������Kɮ���C�O��t�{;O�z����<Y�6�@`�'�;��=�q�wݢ4$�Nxo���s��5��w���~n�����Ɖ&�B�P� ��H�K_�V��*c8b�}M,3���X<8N�,�*d�>�p�ٜa�m��49J�ŚZ�˦l���A"�t�#��r��-�v���KU�ۘ�)��<���8�Z�������b�C�Z�M�>�T���$+D�vn��<� V�E.�?�t���_���@�Q�5��4�T	L�aߋ���6��f�+!���X[�}���=<��[l%��w�N��Qq�N�_��n�|��px	�5¾ˢ�m���N��{Q7&O#��1:�l��P�ǶJ�!#0�wۄB�����A��u�V]�=�ᥟds@7�zNl(Ǌ�(�FK|&�#��*ل��)�D�q�*)�p�@��؟�Jcd����14[+3Ҡ��
O�H��f�_#�X`�$e��L�Oo�� ��vZ(�R�s뒽�V.̮%v�^���x���:8��{*|��o" ��wƒ_ϬZ�^���d~���6�u)��WX7q�I>U���p$��gKi��yz>af���wB�pR8���^�!kd��n�1brH�J�f���پ���|D��27��t���0�E�L"5�HcQ�-(�"w2��)��V�$Wղ��9�V�~�F��|�{���J�������o��->�rY�0Qх�1>mѻ�T��Y�Qda��&v�ꬲ�À=�oɋh���!8������m�d���5?QQ�!Y�Yiw�B��h�3~}���FM{�j(�D9ҪA��,6��3mCL�A?�|1���*��2��ȢyxjE�Qկ�S	�y����{>�&qO��˿�����)ڻv���Qт�Eȩ��I�E��1�$��RAKg(�	$Tn*��Cm[y�u�Ir#X*�NN͍�v��j0���Z�UA�k��&��r�z�E
K�FmF'�^�_Љ�M]�~���G�/I���i'���)�L�so8��RFT�<!�	�^�=��p�_��?�e�v�wE�OZ҇�!J	U��q��tTP��o�0ֲ�4S���}�����L|6+;�m,v��5�&�W,�ĬGY:�����|Է����Zj�|I�¼=�Y���H\��p;A�:R�v� g�{b�/�$
�]Q�&:ь#��Ɗ�Q����?�[dnnZ����/J̻rI�z��n;���Fpn���_M����(�7���:�	MS��{�F}����j��9<�!�?��_�"����B����Г��xi��:����;d�v�����Qq��ж�����h�E-0�5�_���mp�=�7��٭�_�$X�L��j(�7¡��<N=�vl[���.�7�X6�ݒ����C�d�t�����:��I��I����N�����={�plYb���? bME�DB�m�m��א'oPF���t�����^�R�d���{�:Д�u-;X�[A���`bY���f䚅@oS��ud��}(jdh��}4vM ���H��7Z����A�	�}W�N��?^/
pd��
x�S��^``t7��s��y���Vs�bI8�R�n�1%٧:o<��������0�j��E�/��a�� \�w+��>ɇ�ލMv�����xb�	� b\#�Clm$�K�sp��R�Ɛ�������2_aN�;Cn�|�����pPa[7;Qo�W��{^L���!9cPę|!�����'��L�H@jOwq�`�Z�=��[��M��Ō�z�ϝ�<��޾$�f8�'k|X۩$������ɺ��������۶��T�'�.�X����;ϴ$PT��U�8![4;`7&�`e%%�/�r�elFGe�$By��(��7I����43�V����}��NR��#KK�\<U��]L���W����t�&���Z��O���E��j�Њ��1#���C�����-&�GH7�g*d��.JuRO�b���l��0Nif�*;�%t���W�c�o�w�J�����f�L�ѹ��Ti�}ۯ��qIg]n���8z��W+��8�}�Z-�.[l@q�]�.:`��}΍�j�DZ�P+t����m߆�Ś�����:��vT�OX��U�Í?
��1 S;���?I�(��%�U$:y�ugcO1��BE[
l����L@)�ʧ��n�xp�"�u����frd��7�a��ȱ�l��H)F�8�&(�>����|ϑ��T��B:��ʽ�9���.Gڹa�	M�v�y�;[bqtX�p��Z�SΖ��g�����}gʡ�k��|@YP���2�@�z��)�g��L�5q('��瘁
�Kz{�.4�������'��iZ�L���L�}J��|�X-s^[l�W�}9z���2@.o�-;l�����L����-S>����6��s���[G&�Bf�L��2��W��<�Ci?��,�1�#^�{Cu��ޚ����Y�6Ȋ^�x�`���_����ug�V��n .3F�s�CE(���p|�ƺ|�.������s*��]��b��'ұy�Q3���x��I�H!g'j��wS�`�����X�Y̞h�L5F�h����۸G�.�'O[UOS�C`�O��J&No���;�e;-��N+K���z����=���������3*��SSg�4>��n�����4��{���ǲ��۔��zǰB^��ׂ_�T�V�q�>��ŵ�p��)����(ɏZé#JyTр�9�|�E�-��c�J'�`���Ľ3�+f�T&�:�o�0@�g�w� <_�P���2j0Nm�T.���������z�<��W���K԰��*���	���4[4�������	x�z+�46�V��j�-�f�l�����E��A��^qL�(��3�m�U;�����İ���[q��>iy�t}�3���s�D|���|B��g�(PJ]�wlfȜg�)����jI<����r��<8C}�6)���z)���y
�Y����%�!ar�K[r���i�5f�E4�����j1n$�>K��=L_.�g�eO�x؁�Wm3�h��M�̬
�W,L>���>�6�Q��+f�o�:k�m6��P*�e��O�	y5�,	&B�Յq�M��;���q�P��a^I��Q��9�<�%U��FZ�\�/4^��`�;�/����I�M�PS��5���A?޾M/=Xy�T�[��d6�jiv͖��U��
�����i���!�q�j���N3���i�� �i)�:��0K�u��Sa���_6�W��!���Ǘd"@G�/H(EW�YZG�ԗ����
���;���!�3�gmۆ,s���&&��A�M���H�\��8���N�`�.���Yp2��/SCCt�� ݑ�/���%(T�7c)0�k�t���3/#)���| �S�Kۄ�~�����(�t���\M���l��֞��}�׎���VoZ�j]Y�����9B5
��aC�����\U��V0��9{�1�KRL%rRo����"��#�1�ldc���!�C��ھ{��rj��]pR���h����{�B=H�z�a�oa��Zͬ��`'k�!���sD�a��]QԪ�Z���c�!�ЎwZ)�G�����J1ѐ�Kq!Ӗ<mD�-��C>��?�wWh7��.�7�0`2zl5~���A����j���Pϧ�k$��[����O�D��Z���%>n܋Mb�8֤d*h@�N��-!�e�Bۺ���0#�C.�-�$��@:jJ�۪���0c�T�| �u	�[��b����G�f8qW�'�v�{z� �����ׁ��N���r�z� ���0�B@dc9J��^N�T�G��kx��*�����}�R�a�eS�5��$7AM�*	������b𔃭p|�.�Ųʔ-���{p������5ni�t9�����U�i���*�i[>���a	,q�!��)y��)
}W�p	[��6�!x �&���������XF�.��BՃ��&8#S��ďe)�I���e�ܓ^aPv���ϖ�7q�`��m�My,m�-3+7xW$���nꗗi��l�N�m\�O����?�$��.�iR*�����H���M�������������@d��@q/��T�R���N%��l�'t�L��Ӌ�Z����ۙ�G]��,T"@��Z�C
���O�G��7�q<�������C���7�Y��h�m��nz�S�\QL���&��9CEg��~6N�Щ���^u��ov'6(>�0�Vv�.<��tQ�K�1�՞��^��֝,��e��G��6�/Z*������'3��R�S�x��ދ�8�џM"��x��3�8e&+0���2#A�~p/�$��
9��L\���v�o�A YncE�6���	�!��z��VV���{Y���
u�k�;�g��H �+�i�e��~H�J�m��=�&V�҃��9;T'����YIy[E�VD[��9&��'|�w��c;�|�0e"���%��Z̃���4:1Z7�N�}�h� 2�^���6`}�?so�}R��l���'H�	�"J
�M%����x,��,��K������1紦����N�_��L� ����=B��ùh�c��_��g�	n�Iː�L0a4>�5|%F1�_RU�T��S��}ĺ��4��3T-zEDZ;��3�4kB�����]�G��&�+5_	�B��4�ۣ��敋ݳ�`Z	���Q��_ BO'����(|�'�Ӱ}������B�������GE���A��p�4zK�|A��)X*���
I�����%�B��� ,�y�9��$����!ѓ��w/&�g�Q?ňP��Qa֧��=&�Ȯ*_{��K\��a���M%<w�<p�^�:��	dkkNNۋWF��Y�.��v�
�f��_���J��Q��U�I�t�v������Dk�P�bF�%���p�;	���r����prw)_����!�x��d|�k݉�Lro�&��� ���7T2�\��Ү��o���u9~�[�	~;:s�oω���!Ru٠EK}�Dn�O����w�?�E�ل� ����A�(�y����u�2`���^	�}ojPO�L�"�p\��0��]�"����%��6d+�
O�R�q���
t:�N�Þ~+`��5U)pE��	ݼ����z�yOڀ=���}�} ���[늈����~s��'ב�M�R�L(%�U�����,��죓Ň>X�.��c��FO)ҐQ����QH����(ۏ@���/�\�1O�D�j'6��c�]��ڪ�b(x�m):ӽ��m#��G�A�9�4Q��V �˹qM��fq0X�Y���6?7�#-HSW�s��r��ֿ�:��5������wHs�d���Y�V�l8זG>b���}��x�=�x�z[��a
���E0~Ox��s����Y�+LwӴ~�����N��E�[^Z�6�X���B֋��6 K�D���22(4K�
ޮ����D����z��#�d>f���M�z�X���3s�<����d��X��项]x;�!���Ln�fUV��F��Q�%E�|�"V=��7��q)|+������ӗpe5�e�T�8.j|�������E���G�&`?$�z�t�V�K��Y��)�%���(��zO��*8B�x��Te������Z*i�:k^k�!�٬����,`�¡Q���
ӫ\����6��E��E�����x=6d��������;�¶�iD�}�qcA ���'�];��G-cGG�6�B�=X����LԸ�{�Lo��=v(t��k*a�\���_Y���[�Ϩ��&�R��,�?��^�U��H���0��x�F�[U?��u��v���#��RS┄�@��"l�I'G�!T��h���$ l�Ջp�\�(�����B��'v�=M�9.�����O.�N�n����G�6k �9�t��1ZT A�DE������zD���ӛ�w�YM��Ă�PsY�xM �[!�n��IÊ�wG��&e�a�.8�6�y"!h��`�WcK Q�<ZU)y��'�g|�*�0� �XF�DU�'a$�F�R!��PAfOR����0���魣�`����fS�LeGP�*F[��qpu�që���tM�[e8�g��so��߅�z�G�8��܍�$)0��nvaT$��T���++7��C%� V �Hv+$���8����>P�$4O_��y4� �2К�JwL1���ter�"�F�}Gi;�Rh���f�C!Ƭu,�>�9=�"����f�>�Ec_-qj��4r���}��B����WJy�-a��Q�y����_��zc�J�������+䥶��'i-�"r����x�
F_�х�;��=�d�-
la-�P�!?̽�8/Vvb��l����ъ���Hw��5R%�|#�[�G���$� q�:�����L��ET���Aȹ��1)B�g1I���E��S�I��_\�5�}=�e�vw����W�$�Me�d�&�G,�VM����-R��8�&���w�����M̥���igͶ_DZy�`$�2+�?z�@I�/4��zbJ�>�P��YA��=%X/�#�͹%��/�t�s �H3�6W �<�!�L�b�ȥ-F�|��I5Ѷc�D6��%x ������wP<}"=ea��@��8͎��=��E@1��B?���&#����Ns�Tv2��^����~wM4ǚ��7�Z���m�'2�,�<�\�����W�D�`[��5jqLd-=a�������ч�mD�E _�웱W����(X�i�b�6:>kq�;:6��$<�-VbY8�H����~���?'��q�m[�ᢧA^{钇�
�פ̼. � *`'R��#�u�;*�<|.����o|�Tֿ[O�vQ�]�L͵�G�6���f����g!������|��LV��\�u�u�s=�L�nz����3H6x����j�W���EK��#�"�V�<�i؅v�5i�Y��#Q���OP����C�����Qјt�^[�öӧC�D�+��?�S���[R�Y�8+�"��O����TÂ	x2,n��cf~S�1iz�u(�Ok�>1��Ã�斷�lZK�c�	�\k��
�M���4'K�?��6M�o���M�9��z!��B���mE���4�A�L��Tj(H��s�SEQ��f3G8/@yx�gۀ+'��� �y�F/!L�?:���"�7��ޮ�8�]& �7ac�m*UM�>�[X��ަO-����0�w������S�Sv{nn�5�:��B\��f�� ����Dh}��:��W�F���W�<�,B仪#eR�푽�$�!�"��D�*�X��ȡ�#m]]$����M�M@`�@�G���p����9���JL�hDK�#�m��!��0�k�<*m����s���wj��e(�:��BQ�7�����<��)����U?�m�*R)�<�������I��ud����*��@��U;f�2��(1;�ܔ��e��>�5�p�ә���SK�gm�r
��8���ܶ \�����@���W"�kk���k��j����Bz��5�ӌ��sk���	���HT��{�:xp���Ј�yG^�q
�p�f_��J�n��pl?K߱�:_��B����|w鮍��t=R3�]�����.�<'Sڙ��ט[��t+>�f|_�����o\Ǝ4��n�?�j�ջZw$����:�ҝS�\0���wIa|"����w��� J�R~�o!��).f5�ڿ,��l�X�TB+�����0�wȻ|\V�q
-&-Ձk3åw<���M����z�v�����[&�"B��I�V�$ok�*�Sd���Ί��s��]B���[@`4�q�`K��%�Z��һ_�4�c�m�&�·���|*^t����U���,RNb�$<�:YX6����wL��~v�ɨ��x��F��-�l�.�<��4Vh����D#ɢ�y���!��e 
vG:�npZ����2b����,ls�J��8���3���Tq�.|���cZ��L��?��%��d}m*�7[�6���`G���~�K�h��(oU��O
�U=K��YD�Z�ޥe�Ո������IӃB��&._�|�\�������D~��rA�!�v<TOH�$�X���	ǞɌE���!�����7s�9��O�`e���}�qS,\;���ed[��Y�5�j�h�Ե+xl7��������Y(@Jq�9'.Q+&>9Q�@8����,`�.G����iL���X^���Uq��b���=X����&g���9�n7V���ar� :V� SK�\
�|ˍ
Cא7����E <����7q/���z�=%�\n�WaVK�,�e��j��2����	��6	c�ov@�p�"�8�Y@ �l;ӼSM��h'V���%U�.~W²��T7�#v<p�nBr8IЉI�^��pd�y3�)���nvU:w�.~�]���0a	�ځ�>I����h���l��1����䨪&���'^��7�[��3�퓓Wz��.��B��m��B5B�;p�}�A �x��cRn���q�Z=�D��A��+�l�d|s��/��$��M(���`��#�Q f�"G���Q�S �3��~�7����-�eƿ"H�L!�a�X�VM2UX����dפ�3���4~�i��5��=6��e2_6H�9Τ�+�/�p�Y��I��O|iQ�jy� ���j��$a9W��n[��/�P����;�����#ھ��b�|���R#ni�	���˕�� v[ڬ#���9-��9���([�p�QΡ$;=��U�y�$���Q&��S�l�n�E G�%�0MJm2/N{"���[�^�_b��wj�K	�>f]��2{_W|�mK�M�V��+e����`"uAf�2�M�ъ]>&)�ik�6rA11��N�J^T����P�y+@[kOkd�+�cUQ���s�gW�!�^k/ܣ*
RαuR�^D��&sOm_o��K�?˖���Hy���'���>I1H�͋����~�E��S��	�7ٯ�)��߫�(m��oY���3P��OI:�C�iz�1������ޘ_�g���~|��`�E�;�*k��{�����E�[����[RǦ�7�P����"Ӫ�tne��g��� L*��ŝ��#dU�@��Ǉ�U��_����/{���3+t��{���=�S%����b_���5e�ޗ�{�(-��t8�;�Փ��1��X�(��nP��쉾��:"e�& ���_$�3z��N�!���ο�J�Awk���yW\�ED{�@�H��e��L��^W������U^�È(�3n�!Y�q��oZ��@��5%uq��f��ѐ.P�8�ї}�|���K˱_p�� �#Z���ܓ�uR<0�~j���j����u�)��B&��j�u������������s��6��	��M\?��+�����Q�Y�p�ڱ<5����"2y�wa>�al����1-����a=.�Q��/������cv�/h ��!�37�v��C�ƙ�mf&d����:�c]�f�e�q�=�Ӷ�Z��W���	�	�³���r�v����L<ݱֽy�_��ʳ�UX�'��j��4v큓�bD��L�����p���C/&��]�mz���/�"��1&�{�����v����1�;�˫�˖)3·�6<73��?��#�q'�M	�R��*:E��nz�~�=�hQB@[T���wH#���������8�b?P�cw�������L�P֯���`9=T����/��Up(�*�:�����B�G��)�� -[��r��"��C��Z��r�X"�%_���0��K���$&�����s�	2h�{B�w���/�)����(�>Wܑ��`r,��`	�T�����s�$�3���e�(��a����pE!{��M%�7]�*��*j���G澯[�
��9�2�p�J/�aZO�o��ל�zޱ��� u[����M�?d�qw�S�{܀G4�%�A��*{J�J�l�b�V G�N��ݑ� :�U�[%��|C<�h��^
��_�b9���YU���T.�C�Gt^����d.�6�G҉��M�u9,V�CtW���A��PZw]:���A'G��������k�%i��6��;"S#z_��0�/��,���'��G��➕t5���b�4%!B~]��Ź.��� �IK��}��{���锐*� �R�{��l��LE��##;��b��W�i�Z�͊�uS>bt�iJ8'�7z��q�P�P����fÀǔ�=�cX~o���m1�:��]4���ky�d�'O;$�V#C��ш�X6M�I��_"G�}��6O���2>5C+�c^��E~�<bpy�s�.��WyjoǀS~G�� +��7����ن6��0�,]C1l�>q��/`�P�&�
D�^�_wΔ�{%Wg��F����[��g��l���-���Q��m�e��D���E�Zj@_��z��o˜br�G���Se�c��
Ӆ����PZ���{�Mo�80��"��y�ݳ�p�9c���ds�DP~�'���|�vb!��y�b(I9u'2����$����ȁ�����%TTUٿ�K�%�B ��5X}��t��wJ�qb�U��+��\<��	l�P�˷��-x�B}�4�zp)�4.tk���������N��a3�A��1��Y�<[����s���Mu���,�L`�f�I�a��l�,�����$7Pt����a��;"u;L�����0���&��a�8
뚛��"��Լ�F����G9y�O�0����5�Ȯ�����\obױ���ʔ���ĺ�Zޖ!�i��$ ��^��suTn��v�i�7�>R���55(���W%��p�9E��%F��dS���<���/���;��s3o.6�G"鶌Sk��%ɫ���;2Wcv	����A��N��$�*Bg�)����w�Q�aU���W�N��'�� %��P��s#������1eF�271԰:�f&���6�.��w��Z2W#�ߍ����B%İ{>�d
h�8�&�Қ:"�H����8K�@+�����f�D��|��	���+�2ҍ·�x�G�O���P����`߳iژ��<�F��> ��� S!�&�%�u}@��=3�q�� � ~�̋��6:��زn�B��5�Mf[S�:�[���6_!p�u�:�3��E�O'e T����~�UL��E�떁ѕm�����ҹ�LE�w����}����{�;jC�#�J~��XX���s��̴���%W�U슉mҽ�՜j�u�A��2'*�#�j[�Z�X�3��	����I�+�QP���`q�qQ6�+kfXEf<�w=#�����X6����,��}H�N�c/��m���:Z��6��M��4(��%?�T �gAx�sK	G��#RY3�ᱜ���+���ù�uk�j^ ����M~�b����+J� F�@��^@���a�_[��f/1d��*o��z�r'�-�cyZ��-�����о�z+��ý�4�?]���i3�>����F�ΓM�`@�r��>7��!v��/���ˆ�8\�G0�hz��<66�n���H��R�O9b�XInKm�X#ђ��f&����ū�6�y���t�4�eg\kq�+�e#X�hgK�9?d��m��Q�!����c��563@K��A��;��D�a9�l�ui�r^�9>��D69�\&&�b�x�C��ShUB(���}���hT��U���Q��r�� �'��� u,i?Y��r>�����p> ��1v�Q���C���$���I�וֹy�h�@Y�u�,�=>��#�E�"���зɡP+�	��a)�(��������v���LB�)?���ǲ�hDY��␮�&z$M��p9V��OW累o�TϦ��0}pOt�����[r7�a�"����Z�b����N���m��:v�	��̾Ow���+����M����8ܰ��ĢyDF��\��O�bMO�0��S.9~�3�#�÷���y��
ۖ��_\��6Π5�����Z�I����F0�=\�r��Rо��j��C�cd�c�Df�/�2W�O�J��v��҆��5����A��m8�^�wo�I�-�l�"?.����0��nr�[��Ԙ�8��A��@��l�t��39�]U�+�¾�i����)z6oW����r(Rj%���%{�Cz> 5�n���؋j���#Sۀ�vs�9
�� �/w�
�����n�_�D=��CǊF:q*��*��xK�G�Tv��:�k��n�o�3��Mh1o�z,>bq��b�[^���R��v��s��A4UY�I� )
N�/g�'U7�`���m�^�k����k׭����o����1�����r��3W��@���|�<��*��s*�=�50�w�ɣ�M�7�}>Ѝ���chňAϤ,����&�� �	݁�-4|��Y��w��W�`�=���H}n�a�d���E��k肃�	πP7�@���ʟ����M��+��w��g|D!�Є�����cH�X���>���g����]��H|A�%�
11��n�Ş�|�?� �%&	�)�E�Y��>�/3�Ci>��dQ6����_;��iZr9an�|rT�����+J���놔`9Zx�߷��o��ŉ3��<�R��G�wN�B�GD
�?��ĺ�����7�ױp�e1�.A�|5*�r��U�'�mS!-ڏ�#��]��m~��e#M�^�F�n��T�`�&YB�C�)���d�F�2Sh��p��4��[�����%&R�{<U�e��g�ڒm��k��u5\���X�,�bx֧�-�G~�y��)p���2��5�M9w�����l{/���� E2n'Gn�������>���S<C&��M-�5M�����1�������3)�d��4�X�d�z$aa�����>T�454�<J�-懲l���2dg���9%�H�����}Q� t�H�0�ȹ�z鯈 �	֣ T.�=j$�92Һ��Ӆ���5b!��2NF_�G�E;���'a��}Ե̹���?*������䊟4�@E�8*�V��.�{�����C���>���B�f�\�c�CH}y�XA6�W���_�č~�%�������j�,��2�x�l%2�%�s�լ�ض��t�  o��[�5���XY�o!AJNr��g�w����竌��xv%)\YY1��	)m�I�ni��w�h���#�(������Ða�3z� �N�`H�Mm�>#A)7�NfWP7t��e�1���?���ZsE�{|��?o&^9D�4����6���̊�:��m`6@_eٴ��;5�ښ�w4�pn��$��Pf�|]�,����E�V�X����'���f��z��M���]7���M���c��v�$�����y�)D�'<�5.xŲ�$n�?���i��'�"���t��U��O���A	�����k��]��!i�� /��N$�b����D�����ӭE�0F�@�A��$&���]\��n����T�|�v{��u!����F\q(o�\4���(./��xR�{?0Ԑ8�@��k���n��0x��r��6��̜'YGY�rI�d*�01��w��خՐ��Õ5P<��Pc���
i��X���k2BV��I����V���M�H��}��z���f:�[�)U�6f�[��
�3g�`����̽�b��(��۔�`\9/�����޼�o/�r�65��L|Y��\8&�l�N*��,��/���c�i�$Q�+���mT��fj�5�*86Ș]���9�/�C<wZ[(�^�,m=a����t/���#�PQgag���s }~��4t��0{����s��IQ�e"`L�O���Z��{�s���B��kU.+���а�.L{�'���o�|�`qL����D�.Wn��h� ��%����`T꫁��B����QcRo\9r�/��V�ڰ�'��a)�ע%��>������DΙ��nN_����k2S�R��|���E�Y.(��<��&s�]_:�~|6��i�-�|�%�12lܖ�e�G;�)# ���@��'�lW��#Q}��TCk���UY�%F�sA����tW�$�6���,d�.�E�<�R�l67v�̲�A3'=i�1e)̨9K�咋���$6ۮ0��_J�7R�k)Ʈ=L�'��"��(}Hu�N��ok[]�IG6��,A�P��v]�_	�b�ۊ��e,���NǷ�#O� b]/���=b�%������ņG�,S��N�J�?U�GL����ǡJG����נIQv���7��[��\CI��,�n�e0nr$t:&��b�{����M�HYhՂOa4�\Ą�}�F7��9�.p��{C�%�#�%^��}�M�����Z�<8,�6�`�=�q!��g�p�(�{�U<,�f6�2|� 	�`�����.��aˬ\����&]��u�������о�t��)�n�<+���u����4bX�S����}-���எ�����)���[ӥ1L6�s6���]qCM�*�0L/�b���0F�<���"R�z���9��	�V�γ�W��L`Nf��E���D��B&)33\=���w�d��þh��FT�i_
U8X6,3��g6��%l#)G"*��l��Q��>����!�4��Kx�� �6�͈Y38�P1��k�7'm��4��Gq�~i�`��f���P��W6(L�ۨ�.�cf�h�K��j��;ό�7�qR�� ��L�l�����s���}/6e#%����+[bJ��3'�#O�i�#����}�/��^Vd'!u���:t̺PP��V�_!0:t����*t?%SK�L��y�5�y��F C-�s���`f7���s�V���q�U?�����3�C y[x��ނ����-`�YU�Ae����7� ϭ�,,��7�������?�����3�cK5��\u&f֡"��e��r�3v:�T�*\o��:H���D���ʖ�e��)��"0�PD{��6��U�|���˽9���2��ZP�dV�"��m]�mƀ�޹����(� ��*����`�A����&����}{˚y��-a�s]�4��$�\&C���U9MZ��ɑ�ų�U'�+
� T���ܷ����h���}�B��>���.X>�r���F�GK�Y�<o�D��1T��	�x�M����Τ� �&M��T��gv� ��v�ޯ�@�'�J��0��A8�Z{�&x�5s�Zf��Kh����f<��J�5�����;�qX����<�����Ws�M��$9;}ޤ��1s^�� i-B�|[���/We�����l)��-0�Sm�`*�D#�y��m|wP9U�6�ɜ�D�)�E���q��J��.h8GF������Һ��v;Nh�V���Ql�D���_�ޱ��͢.�|a\Ր`	�����Y�޿\�\���~�(kA-��%��.�-�\�9r3�*�_��<�}9�c���OD����{�S�/�1)�\�#�a�^�a?gN��_a�؞��G|YX�1�k�M�)C �pҋD(3JsD-�{� gy2�rl-
��Y��j�'U�C	�8T�j��@�ܑ���[�/ܫ��k�}��._�p��ra^"�*��/��S3|fN����~��O�U�B��N�h�� �N���%�)&?�QS���c�/�y�ҹm�)Db!M�A
��F��$k;%�"b��]L�?�n���*=!ɺ|��|�J�r�f��NE�A�2�c��.��g"Po���L��R��M����:v��/l�`�EC�2B��+����i`�h�S����%�f��t�ΰ�#ݣ �Q��m������|�Z��5c�kN�؄LMq.��sb�m�����!&.��v ��+��NΑ�lhbQC�rYq�?m�v=,��-U��z%Qp�0|��oyP;�% aP�1����Vs�9��<�,?6�)�����7��ޝ�hg�����!�P����F���.U����(��aA��b�4����S'�n{g��<��x/4$V�6�=����썘ґ��nc�,ɼ����:��}Ŀ���jt�¤��5����H3�۾{��ሁ�Y�
�-J,��b�c܈8I F@%�3�3�K�X<�D�|ЌE���9{��3G(z	��^�Z���~;Ҳj���v�VV/� A�o n��9'Q0au�C�Hoj�YO�����]���;#��:��,ĳ?��]��br`�����������5z/g�r
LSw߱���Wh�ň�*$x���#������
'>��X9� 5E��Y��:>k��,Qf�����jY_�	=pbG�6ŷ��5�%j���p����F咰�'�Q�	�T�e>�u�|B��e����h�ߞ�s���0�� �e;�
Cg9�e�_�͡��&��W����+3�y�#���WN�es)�>�-s�����ta�:����#��]�+�-�� 6W�NS)9�Wt�{(l�����!���.r���HD]�h7�7�-����95W��� �,��hU��`
�H���5�ē�F(d�����R�՝Ln�a1����U�7Y��[��1�*B\k�՚Ξn��{���:RB����Y'�������O���Ͼ��MD~�4���Y49���j�����S�����b�]������
R@�j;L*�7�Hp���ɷ 4lM.jfG�ocRp�������0��y� $Z2a�.p���@���~���ԭ;Sa��;&N��b��a̛6!���g�l���p�����]�`�ib��PaL9]M�I9<y�-��NA����h��ݚ�O���;��K�9�U�7J��''�E�780:��;S�����!c��0��@i�����1*�>��9���_©�1 �ML��cӐ����͒5��1��g�=��}���Q����6Rd�Q��#�{L4@jtB(�y��:��o�C�4ߓA�ߚ_��V;�����/??B�S�r7מ�-5�6�`��.0���9�;ˡ<����(Hj}���qi�ɔ�=Qj�D#6��Jz�ܧ�ҜNt�������	���
@�/9{�O醏R���F��LP���uW�+��zE��C�)�}p�D�|�Q ��� ��í���X�Wz�j(�ՠ�(�;���wwό���.Kݸ�K�x�otU5��H�9�N�f7͛�������I���z�8���E�U ���L �K�=���Obt��	wT�@�_����cT^�5��M��e֢�g̈́��ՔS3�%�{g�蔘8�����/�����wS����j����.�ԙ�90IO��Q�렡/^0�4U{+�J�����y����u�i��յ|������H�)v��f���qD��w��?"\�@���AF�YVt7��=lhh�@4�q!2(9�E�R����K�i9�Ƨc��c�����)Ւ<^5(?�k".[v,�FȬ�O������j�d��V��!]3,8��cH:�8.��tI�?��p����0�e�VB��T��\m�	��)%2|�$Y�"��@)Q��v|�=\�Tg<Xw�OX����fƉBa��VZ�jɲ��r]n�ڮ��ϣ�Im?f��[��T��A�)�����zB7Yl��ק�\2�ע�G�fߍh����wly
�B�)J� l��@pj�|��TV�Sn�e�Y_	N�5E��l]�n}|}
�bL�e�hFk���7SH\j�?�iM�������<Ȱy� ����p���G�u�@����΅K���.C�|O���Dvf!��-�_�\~誋�ej
u(�]E���f��p���&C��sސv!N�tC�}���i��ז���#���0/k��gYG��$r}�^v��a+-z!`�q+<NDT��(zu�]tU��0��"=��i8�;�/����*@|�6�{ i �p�$
 osN=5$`�;���/��Nʫ`�Ug|���zQ-���*���k�-)��D����d����m^�=J�b�-���gQU���y�\���.`AT粘������N2�h������d�kbs-"�a����f�P��7}?�n-��cUM����T�H��g��mRD�܌t�@J��'� �a͊�}XqГ'K1�N�ԙT��̓��q�X�=Iz&���6'�� �g����u�"{l
�B����`�e�a�0��h���tPe�$�L�!#+�v�
�G��&}V�������p#��l�����{Ō��QM����Ԗ�
��.�|[{�����3�vD
m�{��	�x�B�^1���S�/����kwm�x!ґY9Q%���_?`��,��\��&)5?
�Q�Y�j�1�98��S?��N�T�X��B�f�^#d�A)��G�Aq��[��/T���#G.�OC�k���P_�mII�F�q��:�]G������j��R���4@��[���R��A��D��MG����K�&�?_�x`����M�"����,��Q�+޽&/��'~�jBإٔp���g����fj!s R�0j�@�w�m��k�����	��}���H#�����)8�@F�evۭ��ʥ�:�� ���oP '�i���)5J��U���0�,|F�]�f��� �O��sJ���(����1�C�w_�Ec��_�b�J�>%��kYI+���b-8"#ޛ�?A�bMM�쁫��KS���aH�	�#1x��P���"I\6�{ԕ�~�_�3���v�"��3b,�{�%J��݄۾�V.

��ۗ���7BOn�1�}V�u���d��aև�b��	@v.�ӳ�|�_��`�5���'���4����ώ�mȮ��j�U�	�0�J��+�n��`y�}�& � �.��GոOٸ�=�p%:=�U2��ٛ�L�H��D���`§��e�`�?w"s5�u
�Q*�@4�N�_��>vJ�3�6n������d�^g�l�H�;B��n1����� �Q%�oP�o-��Q� �Rzw�MV/c�i�3����ͥ��FYQ#�[2��Z��';�K����2��d���Ei�\k���z�9�^�H�Yji��j��ݙ�� WY�u�W��WM$�歳���T����_�>�vO,DD� y�j[�(�}�;n�5���F@7&��h����Q��=/����%���]����\A�]�+�W���1�g\����� $���DL�:�P��p6N�@ƃ� �-�\!��!�#�F���λ����ɘ��	2��,������u'����neѭTz��L޿�z:���#��P��l+:@`§cЧ���a]����B�pg�7�4�^�8��4w�zf2��%�ߞ`��tD�"�N6&"֙����O�;��h4�M^�龎�xt+��}o8JݴWάPgi�!P���N����)���U��;<�A��z��>��.u��@�"�O�?c)��y@���ufj�r��<"�)�W�v���jaz��N�f֭^������ϯ+M�F�N��e! i�\�"�Iˤ���9����
�{V1�n�������H�����[�;�VD���] y���-�]u�&/��;�$N�:��$]K��@Ϡ��_����ۜU���
:���DÍ�dw�!���n��Ul���$�R=�+�rt�9�ck���e����UX���q	Lb���&����g�NPr�����J.��~!���x=�fM{N�����pj��Ȫ�+\�x���R��+nj4sl������.R��#�09wׂƄ��[��sl������-�މ!j���tv�ױ6�gI�9�cS�M�R
��!9� �p�b1�j�|�~&؀^$���$1����fӜ��P6&�W�UnI�/��x30z�4MA���m=b��i�,õ=���+!s��Eٴ�hK�8L�����b�ck_Q��չ"�����i[�Y����b��"a�۟��j��VY��B�<
�8t���Wp��Υ�W�@�IPW����Is��Z�lٿ�,��$��M�]��4d"�ɢ��ں�NJ2�1j�~���F�.�A�\�a �`D�H̓U�hT����3�����u����&��V4e�cFHf�� �F�,��c��j�?},|q�� C�6����h�Cd���_宍���RQ��
�$���;op�k-�w`x��T,�[u@%��2�fpʷ�_x��eڅ��7�!���|v��?fr�v=�ҢX�lڻ�&�\5mБx���Ui���m�%���m��Z�]��(�v���7*��p
 �����p�?JzM�e�,^�aְ�����\���Q��K-�]p�h_i�]DK{Z�AV�M!�n櫵:C7?��T���S7���5#e��_MŸ��Y�FPp6�ab��C�`� Yr�)��ƽI�?����M��AZ� #���`�ơ��~��JG���
nm�xa�ǇҬ�[Qq���
�={"�KcS����G8fR����:��D���S�w�{H��f8���|;�ھ����Z��|�7Z��\�K�Dl)��FH�}���hރ���Ô� ?�	�B�]b�ϡ�Ux/��)�kĨWY��H<��O�+�8(���{�h>���"g0�;�@�s_j�KoX�M���x��e*]��Ԣ�bE���P��q;(J��a��:�sIˀ�8��Hn�x�JA~�r�,�~Lu(U������JdaV![dS�����������p��D��DifR@0�W��:�[��-h�u]f�,-������AJ���S&�l2z��aFWx��Ä���)�6���G����H�>�ޝ���*[QB0�Aj~�%���7TR���>L����e4c6�)U\$��?��0�މ�bK<�LCٺ���@�ү1��
�W}�]_�͟�2P�)a�Ӷ9a��?�ޘ3�y�;��Z�ݽ�r�A���uq�Z~`k��6~��1�r��f�l���JCbi����1����Oe��&䒵dQ���(���:��g.>6�i�
�d0G�o ��F��&��	�qu����O��	,�q_����39B��C8���C����va>%�̆�֤~F$��/i�����N��~Q���,����ձS��kpJk��8�z�L �����9�w��3��;[��Y}��H��>�'��B��B����N�n_L/��g@j23bS}���n_᫋)�F���oęi:�[�|#��Fdxӱ�We��ǻ�p���<�6�{�*����^_�g�c�%�������
�^��J˂�N���J���R<�D��`w��p�L�[e��ź�f���j���PoWU��|�]���שjWRcp<������:\� $�dK�LH��/v0/ί����Ҁ{�۱y��Kx���O�w��e��1���W@.Χ�&[R��ցVhz�H(��٪�j\Hn;�y�I2c'�̍6)F?r�c��G�\(���='�	����DEI'��YH�2gq�[�j_x<���q�S���C��_e��pf,�6����/����9	�V����l�t�Z�����PἜW�>�"i��~�6��/J�f2�� GM�}�iy�����ct�Uk���E��G�ɂ�(�OS���P\y��rY}�2�[t��o?�0�������6��-��L@�4�:�.oϯq4O��ǹ��)�f��{ʰ�ի�%�.��ٗڄ%���/[������ƕ���k�����"�]&�;)]���=�<�Ǯ�$Э\�P[�J�#��P�-��5ut�\txW�CfP��a�J<�Í����JC&7�Mb���b��[���а�Z�5;�yi`���vr:�:g<�`|�1B�f�zy���{�Hp�8c���8�,��*Ҫ3{LꌜR${��0�����*�O��Oo��P��ًO��
@g��m4�ڐ��K����B-?����Sm3��b��ir�ۜTq����T%;9#�����@9�����
�o�6���5��x �l	 �����]q����©DA% 9��ԓ^{�/]HhՏ�Hr ���ܯ/�*� ������XЁJ0Y�R�ج��r%�{
&�_򵲳Hd������h^%=�e/���ɣטF��Y);	Q��6mS��K��p�1.O�+������I�^3��)4ۭߥ��R��j2 �3=�U�-� �v?��&U�XHs��}��+�3�ۡ:g`��%��!��Q�ByoTE�̴�Yۥ,��\rY�?�!��`AJ@N8t)��9��L<t�c3Vc�����k��W4�����m���N�W���Нt;dv�+eV�x�o|ٴtuC�?�Y��N�rr��ȫ%K��`��P��hI�;&5D̋����*Ϩ,eo��`�jC�<>��\��T>����E�X�7&G:1��#�w}��Z~���o%l��
$&Іܮv��R�ci��v��tK��D�.�2"�/`i�=�X�~�	dٷ�ux���m�'7_�Q�Ȫ�T'�b}`6jHu��F�1���,���RL�3��� }=῾�"�����Z+� ��������*�J'}�,�9^�2yIrPK:�U��g<wM �����S#��"�i__L]�T�_F9_{Ho-_���?i cI��~.i!��
�4��7�X��U�"�{����:�x��Q<w�D�2�s����n��t�{A��(Q&�S�M�����$ ӻU�wDm��$�$
K���3gx�)ՙ=g���������D^s�K�����rz��|d�������|�L�^�E�5��t�5�e'���p�d?�W�?0)H�)4�$��&Ҷ;�U��f����D�-ߢ���BM�\���l�uR��z�ǹq�`�?��uģEu�AV�"�@w2�r�~��!�2�]#02|F<�l�OOhR��H?�`#T�ƭ%��~i��� ���� �F��FcZo��(8�!Ț�8�̟m��#��˒1\8�kv�ˌ��������j�:pָ9k6EN3�����a�#�&�uRW�*B�S�0����A�X��R���o���cËt��!���¡��_��V�m��ȣ��Z uh�_Zb~8�:4��y~w��=����������,i�t�����N��	����'H�'Z�͠ܤ(�f� ��ˀ�PB_z��d��j�͛$���7��W��7W�#�f}�T�kXU�6
��aRν<�Tb8��&6Ԏ�K��;�4��54���[HBn"�O3̵�Ĉ0O��K���K)u���y^Dr+��Y�Qm-�5�0ZY3�I��#n<�
�9m������;�ҩ��}��������ɱ��-$̗tZ��v��5�8��[5.�Z'00�rn�����m�,�4�w��oӈ 22m:�A�!���>��X�8F��%��t�A�룖u^ Q0g����r,_�+_-Nm�n��e,��Rk���:O;j7�h�H�'e⾹�P�f�DX�P�k"�H�>�i����I��ߒ���N��%HL2���� aS� b��HbHM,�AܸĿqV$���R���߆����!��z�-R����vs�"�u�܅�B|ə��]M� E��\�	<�� �W���`Buڇ���>�ϻ3Z}�̔ē Z	X���iV����c�/�b�c�����%�x���V�_c9��b_�:�v��v(�ծ��"��o�`?�dO_��lD���a�����\�*��q�S#�y����FG ����jC.���ʼ���T����Ȗ���-��fN\��=&iS=����.��|)B��vhl�Ʒ5�f�%3�c��\F�,����|��5�Rt��� q�"f���_LZ��������Ȼ����Z��h�<�IB���U�!A�ۡ�JËO�|��ެI���I�U�l{q&9}0�f�\��3i�����y��yϰR&���>�3�������������#���i'^ދlR�_�b�V�1� ��#z����O��i?d�Z�9;߸���~\0
��� 8�
Z�}�����i�`�d��{!�O��;]�#�w���������"-?@�'��ڈ䑳��|QN����z�(sHwh�����G���PM��RΟy,%N�2��1#)(��?�}��������,"A�/�SL��ʫ<�d����Z��=��ڵ����)����P�5P�]�ߑ�pɻ���4���K�M\��,>�I�a�����] J��1V��7⧎�9�W
J�Ѝxk[�U���fUD/�i'֑~�L���sOQd�V�ИA�a-ob�V���O<<D�vsĔ��/��v
}q}B�|����k�2��݂r��G����ѹ��0�fO�e�����[�3K���D;.�^�.0kl�����	Ez��I��6�'�W����A�#��Yl3�Sq�HĮm��yP��� �k,ܑ�s=�����Wn������UӢ>X��-�:M��]rN��!}�k����c�&K��[�r�ӡoy��%V����<�+����_��ӫ��[�kЗ��b|X_��I}�����'A6��x�\�u��]3���/�(41�>���_@'}�m��F��_�.!�ï'�g~|�s8䁵�?9��V;t{q-��iH�u�.L��ARW?�ܛ�d+~Q5W�Ք5��a)}�^c�~�!���ʌ�{��IS,q�Q��I�V�'�ƀ�s�3���r�i_do����兺a�sl"��=�3���f�\�����@Y*���ASz���0&�>��S��y[o��;;����O�.@�v)�%�����)�t��T�~����+'��j��hb���~bSSt^Na�V]�|�A�R��-�sٽd�9��I�~�����	J���;F�T�D�3�R#!�SWP�*{d�}����ЭC��1aƢo�U2.�J��z/����nb�����W��i�֮�i�@I7��%Y
ҁ���2��q�ߊ�khvٰ�k鐪!�������qY�|������ռ.?S���u'/���x{�
�j��R��h�WO����kdW���@ɢ��v��<�����X��"��OQS?c�{��$��A�ψ��G�X'!� �5U��%��,��K�1*=�y���8HE���B��U�be��*lѤ�P� ���.<�W#+|��^#�5��̪j��#��t����uZ�/#(o��i�u�;T<�  �,CРٗ��"�iC0_o��~����u������$>�j�ӫ����F�^����=S��*�D�&������9�ra��<C�t{�}_B�δ�-ڎuI���-�#��GJ�r9`�;�nz㧴_־
0pP��:J���ɖ�w&��3�614��Z 88͋�
�1%Xm�����m�V����P
C�5��.�I��sf����:�ulƱ���C-kQ�3�/),o5{�Xsx<t
kA�Z� URo�n�AZ�&�d0��P �qs�N������8���B��{��D���5<�a�5��6+4l%]-���}��f��ΞB#b���V^��1��]Y���֯��*tN,6���7�p@3��-i����f0g���:g/�*j�>����R����\��RO5i�p����Q�K՛�`����֬$��7L1�қv������0`� ���Q��ߣ�_�����Rl����e����uP%$�V�r9��3ŀ�m/t����.�"'z@�i*��o6r;���skzSi��fB���UPs �:���2"�u~+ί�6,ND<�K X�֖+"$o�:$;�~�9��	�V���|=Xnʞ&8�F�6#�ŧw�j�˩�	9�6-���xi)Җ���E��^FЊ�l��7с���y�í٢6��{8z޵��^��'�Q��T媧HZ��e�*uŷ"��A�l&�H%��8�m���]��ᄨ��s�3H�� �L|S��LXJJl������i0\~��Oܓ��������jT�ka4dV7�М!\�faX�نZ�r��x���&�>��˽���%�W��l��.B���¦!��!�t�hVE�nz��8U���\J����-���2J)C�M��:�+�h�#.u5�6��-�)B�i /ŖTf1�>3��0
�H��� k��Ad�Aq���[�����or)5��ٞ)j�xA��pE)_߈X����)0�������+v�{�1*]�hQ�����r��Ǫ	�)��"��8"��!�"Q4U�Q;Zh����fkǐ�'0���J���č�_]�z�鑤���_J��w��D|��P"�	W��[��6ɞJ�<�^/��m+����n��w��~�C���C���x��;���*��j�P�J���Z2⶟�Fk����C�����;����)�X噇�֋����A��i/
h�A�d�����]��unk�
��x���3�z���������|̓���٠�>�>��X����8چsa*�x�X`	����N��� n/�dkӻȂ'��r�t�����q���&>1��5-9S�y�X3`mF�@ud$`Svri�qFJ�q}+��/��@��Ց��@�q@Y{|��J�4�B|�o�	)��gNh��Es]�PT��y�۸iU�^n��]mw*HGT�a!�����:y�⸿k²��N����&۝uN�͑Ӥ�/�&���vh��)����V�^\���$Mf7"*�K3+r�!�yY,��K�K�3���G�r�E{�k7$J]V���񉓪T�����B� b���
��2.~\��s��ΙC�Υ��D�Yv_��rgI��e�ե%�c{	x��IG���I�$)�.�$������L9���+b�t�& �L�~D]q��a�=��޻���AT���&.k��?�,�K�H��L̑�����:����Q7�p�z������{9Z�p���a�صS'�֬2�Ԍ����3�[�mZ���t3��02���1w�,���?��Z�A �D���wI���+��#��vΤ���Vw������'���@����#z�Βa�u�_�ˋ�P��*G���`�90'����褾����^�F���q����p�Ⱥ�������Z��	bb"�~ݛ���Z3Pf�hߗ�Y_�8w��^s*��� NT����Ի<�u�i�xZ�%� �p�A�#:��i�zhw����1a��.��V�w����~=���&�ӿ�L��(�)�=��{1[ʁ#yW����鈟*����@x	�ӽ��컩���q�ߐ�!��T�B��7�^'tS�$Uf]�����y#L�׉�P��շ�8�G�J���_�,���Z).���,�<�s���cD�>�.�֗ʿ;��=u�<s�D�F6q�6�0�}�#l��n�N���u#�N}�c
�����*mFM�,Z�(�nq\;{��f�X�nrZ�Զ���e��F��c�U"���Cæ�r�������R�CV\�a��*��I����@��w��K.7����M��K̪����G��x �M��
۪�#!��L+
��?eo��{�|�A���n�F/���ۍr3 �q-�m Ϲ	���㹝�,y�5"�&�������h��8�YS:��(y�KOa��-n6[�e;>������4T��*͏D�Z���GI�h6o|�7s��2Ybz��=o!@��)(ex�F�� V��oV2ª��nd�z�ՠHv����i�^ϲ��MO)��7u��tF�i��T�"#!H����Ż��V���^.
	��B�8$��t� /����L����bln�ձ�� �^�������.��O�Ӏ1s��A��bޘ�ԍ��jm���UW��?,J7<�Q4��Ա.%�@畵�UuE���0��E�l{C2�{��s��dg+J���f���\��`N�}!$��C��od�d�_�H gں;��Q�.m�8跂41A����/`����芨f����|��Wh��I�/�I�'�v5�7-�iN��hU�s���G&X8$c�
������nT�K��7�5ŏ�s�������=vQ�m�[d��M�ͪlJ~5K$�0�E;Q�~e�σ�T��oB��G����c{�/���a�vXp{�1DۚS#8
 Qg
�qg|�~{87�n}�V�3rQ��_w����1!�62c���	p��L��k�:<~���o��D:s�4�:�(�ܓ���N�^��^T65�љhP<Q�S%�DHjI����NҚ;1�n�V���#L�B\�Gǳ9
:��H�����q����N̌�l8^�d[3= �W�g�&&D!�痱n�͋����b<X{Ur����Q�p|+�����UγW���g(��iP�X#ш�~������P�d<�!�R���K �O�˓8���Z]5��;A��O�<����Z���碭lk������&t/2�Z8�q�v��Dвv6�Z�*40sd�"�EI��F[��0�i.�;eW>���O!��K?���)3�<�`סJ��D�h�t�`��M,(!
!����%Z/�-��~z#|�=e~6kc�6��E�3����h���C���
R�eW8cm�Ɓ��?��H�v�dM��-<p6G�i���mu?N[]R��
Q�iGu��v�x�Y1(OE"= ��ݪ��ݰ��]6��ŮGVL��7�
��]�㏷9�hm�&�����A{�}FU�r/MqD�3�ٸx���>tj� ;qIx2hT
�0|�(�Cl�s(:6�����t�!aNR��{E�h�n���<NE�uo�$u`��RI�mK���͸(q�hg�wbN�(E�]b�u5��?MOt�m2X��M�R�QYV*b�R����Br�[��{��3�oY<��z:����v�v���n�k�aM��+�Sio�?7��C
�`�*��J7���u��������L�acY�]'S5b�Q�y��$�]�]�e¶A�p՗�~�� �D�,�'��YT��3�kcw��
�K�\�h�QJ�1>O�~q��Ej��|gy�p���v��n��_/����t!�ם�/ �Z��Oh�՘��Jn�j"�~�����M�W�7�
��M_b��%�u�H�Dg�L�2Y�1o�5�u+m6�7�+�!�9sc�ϗkV�I�/�v 	�9��j�:_-��R�2�Ք�����˹1Ù�@�XMK��E�@��v	Z&0U{�c�F!/�6Ҫr�L�W3�����0�$q���K���{RN#���?�u�Q�O�>I&q�a2!�_u���q� �.��A���D���NKHJM����Q�t��!Z@�w�H�H6���o�7�"z �DX�Ŷ�k�z�3I�3���F|���̾?y!�XL er��m���k��}�Br�x3�Zi��0$g�d	סI�ffF����5���W�T q� /���en2]	ҏ���r��~�"%�V4P�J5ڽ�8���/�����]��zCD=�٫L|J7@�]po�R�fX�Ĉ?G���K�5�\`��H)·=�� 
P�;�%��r�7Qhh�R�^�lD�=����>gU��n�R��X$��E@F� �s��;�ŝ��'E���M�˙iO�����T@��MG���� w��0��]<?֘�mc�^~�������\�hv����F��d��@�v�t�U�]�k��f�9�Q3��L�_�p��sk����|]�6N��7]�C��Y�rнh�f_[m)�k̄�W�l�{9x�Ȱ����+�3����h�\j�*��o���{����1�%���J�1.<c����7Mn��YXx�N�چ����?)���+j�}r�7���to�FN�"��^���f����O�ݙl�1v���N"�"�r?6�[+��j��������^a(d�N�~�����J�qw�3�\ݟQ����c^�#�۝���"Wm��$��خ!�	x,_��|��F� ��f�k��F&�����:P��B��1�gN�C�́B�چ��@�Y�z�g{� �N�&���t�H������K��OGw�o�]�h�/��*+a��S���ɏ�}��B�����u*� tw��k΋�~���0P���VN���Y0�0-�_4�	�K�V��a�[Ȋа�w�4L��Z9�dֺ�&�<���_y�`g���%R�����$�#\�6/u�ݻ�+{7����r{��'|C�D4#�e�6ܮJ^7����O�'t��8��06_��u��|-��6� ��t��T&��ve�R0����w4ɷ�'��qDǼ��C׮����k�"7pG��\�&#����T�Ͷ�
�b:R�~���7�����1�ʃ�ɧ�$g���o��
6[��Q9�	���T�L��W�X��w>�_�@M���kp��n(�w恟�u`LG��z>���dՈBx�Nq|��rޜ$�[���LgO��$�&>��0jԗ2�-�nR8�(6�xG0��ݭ�Ȇ�*-m�Խ��/�̛�c=�)��l���p��]�CZ]0�e�֩k�s�m� ��DB�, �V�V��>��r�޵e�A�
{�[��0�z�nu�e@����1g��D
"ץ��$Ʉ�����ٽw8��[�N��OW]�^�Ri��	z�d�*������O3��"-���}rJl��9pE?Ӈ�V>�5���?/�.�}�K21�N�#n���Dz��=�G׆s�����#�}�5�蕿�E�����1���J`Z����u(Uq�w�^�R�:D����Ѧ"�X�"e���gv9 ڧĹ�Ķ��)����1��U3g1T��k�n����jC�	����}�{7��5��v7��8b�i��L\a3fZmek	[u�\*4?)X	�<�΢�!`N���	p0�'~~O���G8����}5�ZA�&;՜J����%�ɢ}S�����\��^T0Ȭ"�={U��u�/���S���d��t��C��Ԫ+��B~]l������&g��⚒/�ͥ�n-�tP�ҿ�rv�7��k����`Zj5}��;�eHRS����?f���bV���w6dV�\tc��$KX��7?�3>K��o���GV�~�B%��� m=�4�i�6�0��HY�+'�e���'<������iy�yգ��x��l�
���@[A��p-5���/�Ǔx�<��.�a�l���[3��[aJ�|)��A���bK(ؼs]r������*L����|��������wF�Ƹ^T:��DϕHL2}��)�!Z��yLeF� �V���A�����,��a�`��m�ggYv#�:݇#D�h�H	��:y:�|9��NwPa����r�("��nH��׋5T	�wS�p3J�;Α������Ӻ�%)�7�ÊDPvVD�Q��e�l�gy>�J�,�ݙ��_	gj����Kk�A.��f0H�y(��� �W؁ӟ���a�G�m��g�E�g��x�|IX fQ�u�{�^6A0C%ʻ8�X��zݠ�z���8�"��*ߖ{���̕rL`�_�JQ��gD��,�A�4;�����Z��ˋБ��r;�	ֿQg$����Ƞ�1_\�u[<�nN�5�q̝l�W����X�_w��ʃ��E�=�x�i��n���hT6�f���-}h��>�8���oZ�S��󋇰4H���qcH�[E^�^�i���*�KHOՕ�8��w���0?%�Z1�I���v`S����Ĉ��Je����zࠗ�����x�� Ѻ�/>�OV�����a�~����m�i	��<{�-��:���T�Fw�KF�.!iLFz����B���(6���%U���w�52iݗ��LA鶛ȴ���Ы>%Mk4^yvZ��L�*6��2�)����'%�3�"S�F]dz����x�J�V�t�.���{_XS�r(80�]nH��Q3FNf�l�PPMb���?+��z�)`n�7h9z��l��_�$����-��FB��~�cdu�P-»G{���!2��k�ql�A�����2*BY�S��«Z��ƚ���l�(�e@�*�dT|Dl�oS��,�\���;�pp��	*
V}��OX��	��,�W����YO+�f:��#�fr���/}$]e���Xhf��$�<Ď�$��9t��X$���S?jX~�0�����R��(�?�j�;�@8�8��t6K44�I��~D�c�$DG2ѫu~�U�<#f��l��[�˲R@M���}�4j�>+��I��j�p�c;Hk��F��tP�e9�^�� '�h4!��+�_��z�}_2�GV�U3���'=��=��)���ʘd���]{���-��.;fך�D=�����(��8��A�уT<�5UߍVqX�	0���{^��d'`x�_:�m[�;;||#;G���q��r�[U��룱�3nz�~Vi������D()a��͝���4��Js ��)c}<���9M����
��
�T#�i�4�	$F*�y����GolbAS~4b�ݹ�(
8��gFf�e�e�:�E�g_;Y�aAk�P|5�	�f�!;�#z�z��mx�������(����ڲ�
V��ay���H���7����?����l	�ʜ���7q��hÿ�7N�n��0N�'H�s1d+��*��#(�,�eҚf�"�7C�}�%"�-����*�+�߈:N��Xj�i������h��E0��4���R5�c����nD�iV��_*\L�~��\+Bvf�n5��/-:�3p��m�E7TLQ?�Pi��J�wD� �#�ٶY/-������I�P
8$ʖ�����P�� Ù�����Ԋ=ĝ��e���9(�)��AV�6�}P�I�蛷]w:?��a�\�T&�f���R2Ʒ��E�|��@�P�Z}�{�IH�0u��aHe��,*�?�/�3�ޏ+ ��gY׫�WZ,�5��?�C�c
T���-��t�k-�N��(��F�������o����j#9�nLhu����^�d�|1}�-�b��݋�}J�B�J�:�gzOM�L0�b���pb�,jz�|g\�q��ֹ�z��Vc�.�u��Ũ�h�L���(ݫ`L�ݣ֡<n@��������|^;^����:�n��M��R�������Y�L;$&���@�������R1N5����'�Ê�. �8&�o1)�gS��U{(�P+rk��*��)2�`hO0R��#��'�jX���E�5���dI���AuQ,e����V��=Su��᫯?>��T}&��l��ޙ�ah��Qf�Qd�~��������L��]���d�hO�\�����"\)c
 ��\����|GZ�!�s��`i�`��z}�J�("	:?���'��4��v���b[!Au�b*��*Qs��$q�˅��$Ԯ{���0iћ��~���{��He�2G��0��!^e��\��iB�P�6��}�Im@^"�����*!�x�U�����0��ҸyAf���$�ɔiD��q��R�v5gք4�	�R�D�)��#�H�#\��&�Ƌ�����_ ����d�?�!��9D��KY��6S�&v׍��b�HV��|o��$X���;T����LLiR�^F,�\ؑ��Xk �qr�h���E��k2�j�疼��n�&�>�2H���p~GTT�c/=✞&GE�Y�DS9�H�,��]�}��.�i�~���z����6e-��BPQ(F�Ź�X*d[v��Q�����n�Zس4�H�C0��q���b�/+����i�ե=������I��K��O��$���i���s�v����G�h����Sr�3��F';qR��莬��v�gY����ݰ�N�,H;}\�9�/a���sj�xٙ���ۜF��"��/��E�~���tn#6�>���pO��GU���%�Y޼�ץ<"-�'��� ]�|����ZϹZt,�Xĭ廮�W��m����X&C`�J��lE�?Dv�*�TE�@40
�Sk�[��^U<Tv㭎ż8�2t^��򊮅� k9��� fR���Y�
lo����e��E t*�e��!z{s�U���uN�X�-Yd9@y�y��������ڌ%#���	���r^C�)R0N��^%^̦���x�نwL'iR�t]�$"�,M��@i��V��Y���~�?������Z����\ 0�-k3�Z���+�W7v|Y�2�: ă/�����+?�2�5�0�O5���`�A�^SѲ�vo����ĥ�y\�����T���〣�!�ҌR�$��X��-�F����c�}�<�Cp��F�)�1Tq���W��x��!��"o�<��1����.U������I�"�����|4v��c��nf���}��#*eI�pOJsY�r�1�@�s3�2��7Azܭf���Ny���l� �1<�AQ���Re��^O	����w��G�� ���
o�k�*x�qa��`ҵ�q��-d�`�Cp�6�wT�e�;��7x:(����J�� J�OPk�I�c��CDK0�Y̜�c!M�zX���˞��#���M�K�{�$ʬ#�b�'_��r���N9� @o�#��B�vyV� g��;9ۃa+�cAo �6��fX��Y�a�����y���p��������/�9���� �������ʊ��+@jX0�2�n�R���3��g�+ ;YC`C�4L��n����#�˨�]�_��r	�U�+�@fF�!	�����g_��G�X�G%@�ߣΕ�?���qx3�1ެT��a�F�PV��F�&�ܤ�;L���U}⟋��y��g
���ת�m��GG�GR ��r���R�o�=3��U�[�r�ⲡ,��|"�&�����"�=�
l�p�=�@^h�C������Ay����?iM�u�]��V���`j$�]JP��T�*UC�Ѳ (N�M)��Ё���p���.n4�����$y_}�̇b�9��:S�*��k�y�[CʊJc�]�<����TӘ.ԙB� =���-+aj�i����5���0aǩ�썳k�Zh£8=�D3=���ܿ`�"��=6�ݕ,�>$#@AZBw\p�>G�����5�:�GZ�Ӟ���m�,�t��,�P*���6�SK��
��j&m.�A�����3���U�ҳ�b������F��˰��I����L�0��Z�M���_�Xʌ��^{�u����vK�Ɨ�v�\��U�_�A���w�e^���w+�m�'�f�nf�H'��~��fr�(�<0��W�<�U�eN�� ��Z�6�J7���]�ihx��%�rBuw���`ÖZ�Mц� ��iy̵�=��!"�����q�I�������*�-.Λ��P�
X��QL�U���:��^�,K1�[nb��G2C"��HɃ~�J�,>�6�۱���|�I�3����ҧ�Ar2��j�t2�4��J�r]������ۭc����7��[���3�%Ƕ'�v=�Us誌��B�%����x��;���^�u�z R��7�JZo��Gv�z����{a~c��3�1���k'����	�ݎ�FA��|�&sKJ�ڤa������{7����e�@�^�>rw%5�C_�H�'�1*��W<P�1�TH�����ۅ*G��gt��W��3*t񦌉E���vV�Q~-��Uj5�����ݡmB�Ҏ����IH�~��
�LP�C|�Y�ZS<P��� �huDB!>v]�Ux�.3c?߭ש��@߃X_�|?��@���4����׭~IP�PP���5��b��wȨ�Ĭ�~T���3�0oܪ�F�G�{Ԓ����ż�M�C����2 �B	���n3�x�x�u�MnwX0��u���S�e�V�H�N�B_��Zs�ȓ�۝�l3�vЏ�d2����>ņ�I����	>o���a�Y�h��֕y����;j��s,Z�(��|��w�O9�o�	
�_�ECA��#�A#�yV'Y�@�%R �5<�mS,M�i�j���2�:-�H)��̂��
���-9�z/���(���_ �$m�:����?�1<]�6mo�-��^*���-;UH���%�F�� ��܃W+�_�9��D�b���,|hK%��ʛ4 ���(ļ`��_�N٠f֫���H�]Zv6d�qe�L|9�&?����o�%O��
%���	\�%�k:��Sh����fv�"��塙B�X��� S	���,���f�-K;4W��s�I
���)�X�C �����g�N��	�'	Xo�$:r��	���F=1=}8l�$�7��>�4��;+b���\��J��21�2����$���g47�濚��e�깋(�]��·;.��M���(]�XJ�׈�|d��G̓��$�U��ԝ|��P�Z���)��:탱�,��D����v�SY�Y0�,�P0��6��.��i�ƴ3U�NR2�b���S%[���䙍I� �"�����d�O���-�*搔9������H�Y�~��U�[��u�a����`�0�D|P����#$��h3�*�|�����A�V�ȥ�o��a���U�]��14�v{O_�Ϟ��@�I���5_rk9o��P.8?5�.MyUXln r�N�m��8*��(�(���Nt8G�4�w&A�������=��1�[�_�x؉�6x.~'%�#0�B�P.�T�W��#�R�
�":ڕ�l��*�iR�8�P�T��c[��~�3��Z��l�+9	�o`��l��!���v�È)(�F);P���P���Nl���#�k�f����LV��@U)��v�ث7HH�N�vY�h�c{{�ǎ]��`�p�{ۗ��#f�C2�W��lT߷��Mom��L��DO����]�25�M��} ��c~����-��OE~o(9���*sc��<�K�A�А�־�o��g��ӷ���C���oiw3\�p9�A��H����	ñ�Е~��+^����&t0��Z�~aؐW�0��h�V=bQkM�CErmJ�k-�6A��	"v�n�9�H{���9.�� MP�N�p�����8��/�y�jD>F;U-i;$�5Wp24z�*�_�z�וk3��S�@���5A��	�&;G-O����_�_�w����(���c p�*�����X,�ѱ	h	R�&'-�l�I$wz�KJ����};{�QJU����t�<GE��4��4��뺂��6����:wRa�>炴\`,���YY�m�j.��i��Cb�]*�T����4H�/�nr�,l�98������qB��]�گ�y��;�d��:>�C�u��/�{w���Ц�՘+�G쯧��81���<wȸ�e^�I�!5�{'&+�ɳ
��ZQb��α��`	0�օl���W(miu�GI�Je[1� ����y"��A�	��Ǌ�r�@��מ9>~���hf���E0@���������1�nk��R�ϑٵE����^�2�6)�U��4�mY���xb�7�o�A�vܡ�^��6��� <K|��w[pa���00z$	^x8��1p-�T�$���Z�*��:r4.����8j_��E{�-�$U�f�:��Tig�mb|�:hm�xAgc����}\���gD�/�i~�.�:�	��^(?�1x\Kαb�x�3�������}�Vi�����Q�o�=Gu�5y�NpN ƾ=���5ĸXq��������ݓ�����lʣ�����51O��[�]��-�;���'�����)!ձZ�|1{yb�F��O��mT �Ƌ�׹����HC%v��t��zx}�����SI�6�?�>����+;FP�sy@�F~ΰ�����VAs��c/���U�q����J�Q�:43�"3Q����!J��s"ʀ���xT�޲�X�@g�����,کS��L��,��z~,+VRV�Z�Q6�ך�YLQ�Ӈ�۷��g�C��^-5>����Q<�w���2P��nU�W�'�M�%g���h��bb'�]ͳ�X�!g۷����E��,s��*`�mQ���S��Ӻy���Ox?ʲ�H��㮽��;�E#����jџ���*l؏^�ۥ�ofhٕ�bG����ʎ�j|�(���S���p���-O]�/l����fP��4������W/��G$&�5��8Q�l-Ǎ����F�oe`��2J�=Io/(�6�zAu'���(��l��Y���k�'h_���Gq���m���� �5��Tb��\���2@w`{�ic8%V�͔ ��.���5����˔�n�ѸC�f��3����X��Lcr舎�Ǵ�Ԇ�L��Ҭp��2��3$d-�7��T���G�60�ú>U�c��� n�SlpX��W��"rǖ5nfU;EnK"̸�
����qy��4��R�pV���m��-m�yV�����kә_���St�/�U��k��w��t�"0d+�U�7h)/���=`:����1�L��#I�Mx��h���)�,��^� ����_Rå_��/����L�H(����;�%�jO�Ƽw�_��D]�7��tJ�h��'�Q�\;�&n�bK$�)���FF�w$`��#6nG-I���/���"KXs8�+CP�kkO��]�8���KzEH���Ak��r�A��`"~Z?�9�����M����M��h���S��j+��p�QV9���%�j�����T�LN3n֐�������L�������HS�޺c�Ҿ�Xk�����5p�`?�w2��N����'oi�3�I���(t���긘È!�=��l�7'�L�.�����xf���5a��_-@21;�*�����"�3w:"y�8%��9�j��1e���4͚�ex<�f��;��n����M1n>��@�ZKE�<L�ڤ��:���P���wĶ�b+ 긁��O!�~�	>g�h��mS�<�<&0���N���d>�ņÂ����k��QKK?�*�>�����E(���q��#�U���CZϰ�4��+I��#V�r0��\�a���U�̭�n��%>u�z���	G]����Y����6�x4|�!�bET-�*�Z�I���37D؞�%�����"x�<��R���U�h����J�[��	&���s�@A�_��\�	�1E^��'��Y��P�����L�OÂ��l��!4k��I, c zd���!l�&1�6K���اO�S�n����x8�z+�s_�]l����[�O�����/2K1�T��H�t��Y�-�g�ɍ��}���D�>����u�ڂ꯮�ۮ�v�d)��_ѩP�m-*	Ɲ���Fǣ��L�n�A�2l")����)�R9�+�-XFo����6�[�]� ?����0K"�М!�F~"�z�.��V���Î�T�L��Q�\rL-H)���U�� ��A����� ��.���~��,�1��d�a��PK�^G�Z�B
:�l�[ش?m]���P�I���r��	Hc���Gg~�G�^�\>9:dw���~I��zo���=�$\�?�+��3��z*_l�/X,�V�k	)U�%`0��K�f���.�cvv��<��%�~*"��!	��39H�np<�ܝ��x稰�S�Pxj0���Լ�������eRe��#K �t��7��.����<�am֟x��L��ɏ��'"�� �+8i˕�W�Y&��uO�E�^#FF��J�����N�/z�7@,;��Vr?YVW�}f�6~��dh��H���a�̾�A�߯�H�γ�@ ��Y�P���>�@@*�.�H�R���/�//#�����v��I[����u��L��&1%bx�V.O �6;9�>��/o$��F��9�kV!���l���>�A�g����<\�ES�V�9��NToє{����{d�Ct��ۘ�D�qW�2�\"�.���8���=*�,�����[��EE�|4�~��@�@�`��so{^h'���?����'�]'į�viB�m���*�8h��ؽ�+r����`�٢k��`%p5(�P�����R��8��V=)Se�N�j~�v������v/��ķU�
"qWx�+��Lm��y��t��I{*�m�g�������g�o�������Z$X�-p�lE'��an���~�@٬���Ŧ��ڭ�_Ӣ��Փ�������C���ճ��q�|�PF5�l�g����Ēqe�lM�g(�u��m���������5No�Ѫzv��Ea|�V��G�1-��<�t�m�2���a8��&6hR����74�T[�l]gy�/�g�:ܿ�#A�1�>�v?��YJy=W:x��Fz?O"���� 4{y������@$�	(Z'�?�0�F�7Nޣ��G"�x�4����f�rKX��z<D�"�q��۸���Y>?x���3h��.Q��F��V��C�~Q��+E�@.�z�*�dd������ąCQk�vpjP�A���K$>X�/)�;�!X���8N��B�t��.h��s��զ�/��T���9T��8Lg�_��aO�z'�O� 7�"[x���'G���>4������Z�pv�1�� ��|1�,����kYˢK��V��xƹ�K�#&cO�z��%��@������/.3��D׋W��lZ��`�y;��C��%M��e��Ϲ4�P�'Q�&(j��i*��l���a�f�� qv�B�C��jk��.�	U1��*ge���魹
����`)��H��?cN�o�p��>.F���ζ�e�� ���.�����E�kG�#�?R�fx�2Q1�����ilU�/����PX����K��������K��'�6����,ڞ2s��Ͳ]�/�dC�=~-���(��č���+c٠n�YK
���j&8�������ր5�HQr"/�Ǯ���)Bf�\g�+�-��b{��V(�]�҆=���o���_�y�J���6E�=�ށ��mD���F9�:4�V�E}�۩�qaK����~�Oa5$׀<�1��Z�ic���a��~a���*�O����}�v� �ʴ ��l�0duۭ�̺���n�ܽ��m:��Z����z�W���������V%-G�p�7�!���hM+V�IM(���fmN��b��8k�	M))�����Z����x=B�6�h�²6Vk�b`3��m�)Tl%fw$Z����i!f�{�0x�g;����
����y����u���"�G]��h�ķԟL>2��O�%.���%�o�~���]��v�ώ6|
��zO�Oe�żLf���ݢ�YxŔ�~.n!@��f�8���/W��$Y���nr�ܦf(�9Z߶\T\N� ^��:ۃ6���Լ�0�(5�S<�<�)� B/�h�_��n3$-<P5�=�r�GE�4Ϗ;�S�	��*�����i��[:���7A�8>�-}�)=�����%�����������n�rb�ob�����d58�	��t�Uv`:F=�Q��ZW�GD9���%i�w(��J�E�''ɒ��i��n�`�q?]�+�*��*kz+�v��PU��V�j��xR�9_ ����{L˓��y,���J�F�FIᇄ�R��a��m�X��[u���NX�_D��Ѷ�-~�7���d�T6jL���e��i����|�e^V1�l�[(�hҭ��+�<7LEƯ�g(����9��`��MJ���K|�a}+��M�O�Tz/((�3�f�z���8�l��o���[�'�&h�7���
E|ﴮ|�QX�soE��bYO� �~a� �Z{�ҳ���Ǯ�S[Z������X+9�J��|8�"'�:������f[[�~Yg؞@����(5n�'���
6�KTބn���t�M�% ��}ꀒU�R�,�T�����ƥ�+�Uv�e�Ucdd����[gU#�L��MXW��r- H۾�tDӅD$�+Y�>v�8��0}��x��-*�6�8e�������׆-]<�Mj���ˎ�)�����I�{,`C��{�{�A��JF��P_���1����"�Ͽս�k��}Wyn��%!Uݨ͠�F��5����A���d��stQF�`ڀ�$?Z��!�Ѽ�A��w��/�۬0=0��v�pʕ��{It��[9�*p�x��y��I���Wm`�����@�g�V���^����'_\R�S^��C�}��rr�	�����+�^Q�L8�	A���'�y�x22��`�+���}�87����(-�uX/v'~�)�Xxy2��l��ẁՠ����ޕ��7��M�m�]{2� �����1�>JER������]�&*k6@ L�m��n�j�c��]n�!���)�݈0ށ�Ч|��YK[�]іO�:���B�^�W]W�Q�.-��~�
|���x2�C_�{�$�d�S�P���_�_0S9�F�a!�����AO�^6����ڰ�N���UT(a��30�>�r�Pcei��w���������A
��0u������Q:m̼��atȥd+�i͜$�= ��EV�N:���ו�M^�j��^�Z�"PͶ׆2d�|s�4a��#�X��(5]{�H�3UQ	Ѯ��y�L\-t�yX�.�pMa�{b�#���iS���fX�?<	�� aٽpC&��o��g_ ����(�����a�L1 � �2�Tz�E���\>�b����]�6E������'�1ʱ����ݵ�8�B�taGе��A������Q�*mE��B;7�w���X�%a[���f�����KY���ڶ+ZY�s������m�����H�񯽒��Ll�ݧ`6�D��-q?~��)*!�$q�dB�f����`��e� �w�z�.�-T���9NI��.��ND4�p�'�@�3��JQ�����p2X\ϸ7��ޮM;�q�_g�D��T��巔�x˹J��BY����ln:��g�M(��`��F!�aWaERG�46�N�s�̖�6^�����2L��{K�o��Hj�upX~������5I�� |K���^��F.��&��H�YZ��ȿ�,�Q���$��d�x�|@�����#i����Ƚ��6(䓟�Ǧ�p��>%f�l��<Sr�W�|G	�Y�؉V�ő�f�<�c�G��1��=���~w��d(��D��X�р����(u�T��`׹��eB��lE�F���Te�$Al��_q�!�Z5�>^"��Ow��:��-���o˳�H���$`A���ud~��$? G�¶Q�?_�+b�b��Tc5$�t���8ѩ>�E�t�9r����5G\�/�b��%�筅�.�:D�(F��qZ�e�����]�mu�[�h�Q!�_�I�{�w| �:Bib������~RO�y�I��jM���/�iEv��?���z���,�%~��
����ŏ6�˘��|�(v2�E�\qͿd7w_����Ą�3��8��p���_{��3�r�^�VeX�bମ�f�!!w�"�?w]�_���2��&=���&~��Ü%�)�SڋI)z�6�}MܰQ�i��E]���$��g	��x�)�@��?��ͮ��]�3Zp�DF6��/#���K,��E�k��VIP<�P�� Nw����z��w��Jc׿�n/�.�*fe"w+#	�-�2��p�n��6�ul�/�u�?m��P��ɱ�9�	�~������7c��gT���K7�1=U���.���� %��KdkU�_��ub��a���m�7�ň����f�:�|Ӄ�֜�\�Ȃ>�*�6���&�.�
�h$&�a�G���EL,I�C��w�����q����.F�Z�f:����['fdZ��6��C�!b<ˆ�G��ϩ&$KvDw�hͷ��I���̢<k��LG�~�/|�^@�*�<=�a���b�|�V��\��k�a0m<Sm����x�e���\W�:R8���z�n�T/Y�9�
�����莵����;������2 1�a<� �~ә�S�&��KA �1*(���F�̽Z�e=�(ˠ���x�C�����**��Ĝ�1p�8����HL���Te�XN���W��$�y9�hM��F����Q;�+k������`���D��}��t�D���Ȳ�� ��m>��;�R�pI��1�^���D5�ܭx�b�h��0ǂ
��2��7�S�я����*Kڗ�L�Խ�\�9p �*�J�L�4������w��p8	��+�9�A,f�y�<VD-�n?ϐ.j�N��e�-��^��<q�����@�Z��4ʲ�Tx��p��v��4%�"l�*M[����/����@v�Rw�=$ߐ�ȇ�j�F9W�v'��&�*�p���i��{my�B#�O5u-�mi[��L����
Z��I[aqS��>�1�>9�I�%I3��/�0xXx?L��E��H�6��T�<�����3���|l����z�$�<���z��Ide>��#�~�0�ʐ��\�9Dhw9XM���nlS�oYu��)[*�����f��?}����n'Ln6}�T�:^��oPu�?W���b��a�2�"��o4)��7�ʠpI���>E�Uc�_[h��HH��矨"���}U�����A�> ,�1s���,�����2��IYdD`*:��IS�,�n΅_��R������պ���׬��$�F��67L#�4XսVo^�� �!�rf(E�,�p"��A��y��x��/����Y���S1�j�p+�񧄒@\?P������Q%�����"	�۠�V���~���o��i:�����З�/��u�..�#ˌ��b��P^P�|
$�H�>���ii7��KҚ#-�o�ds�{��8��o�O��(�$��&fr/"�P�:Ȉ�#��~bD���v�#�ihׇ�4�u��0V���p!J�g,.�s�Q_۞�8Zv�RPT�,�{��3gy�X�A"���#-�Z������"��(��KJ����|*�暫
H�@;���w|�ܬB����k��
4+�e��E�hzꎩ�����Fg�� jJ�����~��FQ�ɉ����LAXcȎk���fZW;�d+7�C K��/V7��}@$��)Қ�p�h��i��lL`���S���H���|Z6�%�M	�}�����XJ�\OuG�h�s��gD�3�?��v�$���	1��,��3=3ոc�92@}q� J��H��5Rs���ד<�����Âf�ϊ,�������"�=2�L��R�r�N��A޾e�<Y@O��zi��=���Ou��G�����a�Z��\���u2�]��YFTJ1�JF���cr�s�d����GB^t]-S��wk.�������eV�0��T�y`�3>�T<&ܜ��&������L�E�i�����H������=1�ngΏ~\1���P�S0	dF�R�D�M�b_.��*g�k\��5V�AE�z2��"{AU<���k��<���f��3Φo��ֱ�?���%	+X��[g��$��2ŧ@?�h ��0�a
;)��� %MbF�?[t�L!O��mZ�㟍;������9�b�HI��.�ۀ;b�\.12���Gp)��`)'���W̶|�L7^�u��L9N�!7��v�����	�DL���\�� ��ce�4|]���O��2��J(����Hlr�������7ziR��&�l�z��=�]c4�K �)�n������0B� 9�������L��|v��Kx��($��gK#M]5��!/<�W,)�L����)x��Z<�����e�2�
�yO������Hڷ�җ�I��C�lE�݅&����H12�yt*@s�IH���2���]蔚;~�؎���>ά����u����x<̪��B\`c�������ӟ7�⾘G]�.Uݓ< v�W�[t�v�f�LN*�����Ҡ�a1�RPhh`d��e�Zfum.��j6�ly�& �O��q0K��ey�R'	%çet����g���O��W	��� +Lh*.e0}�>���d�B�b5 @�>+$cfzZmc��r$�D���;�x;f�1?�f{w��Ejr<Ը���K���8��?HQ�Pw=��9,T�M-r�y6��*ohl��|��Bjp���O�V�5$6Ib��t^�rb���ڷ��s��Ζ��)��?2�ed�ʢ Aɋ�ޙ��� ��/z҄���v�9��_�"-{���x=�5���ޓ<�O��K�D{D8�t����d�yr������ ]�6�U�Z���͛�t���IW^H������n,��f�yt�P5��F�v��%���נH�8[�u'�0i Ft0���Z-k�������
��:L�׻�e�6(�ψ$Y�O4���\ۄ��2�n�?��z����C��+u���{l��N܋)��e��C�e!¿2uPl�<�/�|�w�2~��(C��_���G,D;2���ʲ(\�N�4�:7��W���
37W�$N=ԁa���a�Q�]85��^'�$|=GPj��lZY<���/B�#X���|��Ƣ��T�	�vg�,�D���:��a�l4�E�-xL(s�螆���7�����%�s����6�⡍#����g�E�u%^���ұ[�i��\�`��``���uÒBPo�+�XI淏�qA�y�N\Ӿ�#Y8K;�eZJ՟��ȼ��&��P$1������}���i��K}��{�s�Z����>��r�����a_k���0S��ܕ�7&���Pi-�6��������̅k6�����J���	!D��a������1�z�Q
߱���.	��IKU3�G{;(���i�2}/��~tڗ��X!�>�?N�)�C6bΞ�
:[�l0-�u�Y�� �-��h8kU�|�x؝�s����@�Oe��X��I�ImϨ��$ʠ殹rĩ�L�l����TR�$�vOP(S�?}R�����Ε�\\�+�A����s�h�*S��8DDZ<��+�9���f�[1��������E�*������l����T�ŕ6�ZbzH5�w����?�o�{0��N���73}�h[?A�Ǚ۾֮��:ؘ�щ84��W��I������x�����oC;��rgb���(D��a��Hd�>��O����J��za��n�(7�q�X7��M��U��c���Lz���׉]Ta'�_(u�o��J�����0��|���ks���ِ���Ա�#�鬄.)��:����nM��>T���*�\�f���"[8�Y!�ARE����P ��Z6o_T������5��U�I��٪�k؂�h5�Y��	ǰ^H�/s �hȍj��ax���Wf�)����)��K{��6p���Ot��U����m��8̲��j�ܲ�K�)*%��hj�*3�L��jE��!1i�&�rK�ŷ�����Cv�QoAMaEh�oZ
��y��_K��v�'�u�)6$T��<�{��g;	��Z��� -A�p��'���4�캍)� G�U﷎uJ�CGh�	��m^I��]�N����3�BG����B��މ��e�VT�vţxFqT�n��T4�B<�{��փ�C�o�I�������,�^`J�~��E�@1��cz�����c�]&?9�B�l�# �@n���e��n�=H �fo8��+|]���*|&z��٪�Վ�\���^�/tr�M��0^,�ҿ͊�A�k�����3�,v=�w{�����v�s�}���k�-�bq�z﯋�j/�h���<5�tf;�J���H�To"/ƨ w�����E'�"�F���<���<��A�w�E���\,�Jff�(jquT>/��L���>&��x]_�Yk�a��9ͮ�N�i�ҝ����o�� �1ܟ_����~�6���U��.� �I�x-�����I����LA~�#ʪ�fā@&�2�N������X-z�Ea����
qnm��ƼG�3� ��I���Ǎx>�V=�_֏�L���Y@Ȁ���JA��TuP��{\�T�	4���*G��Yəg�`�+��5:�-ۏ�|���ǌ*�PƼ75��}-�mJ`���ZF�5�6~/��h�IJ	J:<"\��}qdlP҇ʠhJEiҬD��ʜ��(i�B�K���?8�L��G´z�H�O����2�?�
:�&��T�>uFI+��O�
���^�-���.���D�˗�t��X��%�|�sj7S�����5�-S����u�c�Y!��J�{��'������$y�[�O�x�X!%�4��J|qF�({��Hڏ+��z��ڹ:��|�5�L���<X�HP����/?���-�:to4�Z�n�i4�ek��=����>J{Z��+L�?>w����!�^
]��)��b�R�,����ޟ����&_�Z��j���g�СP��%���y#ݷ9�-���g&"�c�!�??9�`�t��Z�
����*���3u�9�{Yqw@t�Ĺ���D��7 ����&Z@O�$~�:���=�|c�@cc����3�=�M$'kL��`����B�q�m�`����ư��E/=k���v�dq���P/@dL%��pD�����R�ΰ|�V�+J���f
��>��>�Ns�D�T1�I�_� 0��^�9W ����*�yb��녛h�>����1zS����KT��>�qG��KZ�A��8�!�L�:�'~)�|b�ʗ�m����0�s���d�j^ �t�f�a����d�P�t$5�@��D!>#�R泜�̺[^䇇��Hi��R�����2�������U��M۪aҤ#��l��Y�ɧ]��Y�\����R����;"}��2	��>#�G �훎��˞o� �w��j>4A��~DK(B�7�Wx��#y%��_�v*��&Y�E.�B���r9��> uP-�e�|��!ڃ��M��X��$�+r���������k�|�p��.8�u2��T��D7۾�x�n�Rn�N妕��oK�̥ 5��
�{�J Nb�I�΅���+W��1B}'g�u:%K6��(5��E`���81��Q>��Z�_8A\n�q�{���~�J��s��a�Pk��Ò]
���0M�_זM~�z���w7S��"^@���\j�����6�[b'$�\%�_q8bW��2 ǃ�;���]�x 7�����g{9aϦT
��|lZwL�j�[�`<� ç�2�s���89�$�<1��8��7�a���6����2Q{��U�T�C�;t�'P���aAT;������� 1��Q�o?
��Ugp��C��q]�oOtMr���'f�mWnbe��BⲌ�u}Ǆ�𥫕��i�-$O��c���i`����#	�7w>(��%5n���|'�_�Z�EX�����������K`���i1����G���Z�Evx�j�|�L�J�U��6cIvfb�=�e?�k^�z4�7�M,?��)I�^-~� �6�*_\�Z�h�r|��ѫANKv.�0{���˷�T����/ޡJ�q��t�o�zɍ+��APŃ�j�'�DkNv��i%60��X�Y��w7MZ�������A�,*z��*ڥ"���Q��C�h>̮�&u�}Զ��T�y@IɁ����q��«�;A��[�����An�s���)c�<��!�r�S:D�O�+NE��w#_í�ܝBF������XPI�+�=�!��LV~a�5�I3��~F�H�/�>�ۡ�$.KX"�0L�IA�e�
h�=����5�^��"pɉ�a���Ǉɰ@�Tn���]o�2���C_�����'A=�-bW}�Y��yj7«wͅ�e�o0%`��-t�߉�,dQ�O�i�d�l{'(�ݪe�?)�@Ǻź^� �c����!���ѡ��zҞ&����w�A}��Z�v8q��eR��G���ێ3�,p���i4 �C+ �4��lN�� �t��R=xB�KTa�QM�K1G9�J�z�ǅ�
��(k�t���m¦� ��*uL�����:4�v� Ư1Z����7���{�6%�..*�w�I�
		Ӗ���'8����68�Q�?�@�,j�|r��K5uH���v��k!Jޢ��y��g�MO�D~A��^ձ~���O��6�\�sD�3���eH*�Y��K���8��C�^��p
Ǯ������q�-���:zrd}M�g��g���,�k?��'|������{�}�����������+h�^����H�ZP�kS�.J*�)�*-����EJ{�!�5���/�09X:�O�m��<�# �qL���"����o��Q#]��(v�4T���OAZ�$G�Q�H�&7xW����G0�Y���D��
7nߴEbD�E9��h�lY�Fv�*vo��Q�2D�<؅Ad�徒m�`Dû��hO)J�*LEfd�+
Pfh����Z��0�p�/��tI�t��	�jej�r��|7�RɳT�L��mW{ʨN4F�3g0�ޔ ���&I��9z�#��i������A6�H�,�蕗����͘]�J���E����#f�P��9ǆ^���K�g���۶���k6�`{k]v.\�刭�:m*[Y�� �E�'v�2��;�<=C��,'I��c�عw��	F��_A�ۗ�A�n"~�mD����{�j�q7�Ky�)�]��������-��,�IA�F�*��q�\�>E��q\��9�d�8�Ξ��!�֍�����'-E�0��2 Ʃ�����N�}I�<�Nl���Alw�/h����w��td\�"C'����E�	��t���!��iWD�X�Y����p�Шu{lx%e�X�
s�vGk~e�@Q��[)7�Rpp#�x9����ܾ���1�-f������Um������F���V(�9�5�b&�"V�C�-J� �*�B� x�yr.��`o.�Ƙ�E�U-mYC9����V�,���Jۅ~��vpNmHrz'��Ь�^�}�+6L��Y�����Ο  �LX����k�=���R�Wj������������\�����ǘ@z��n�eB��^w�岀�9 �:P�F'�i&vW���k	��I�2�O�tМ�ܜ����kF
��K��mIݥy�j���:��׹�׆7O����x,�̥�j{�^*�U@�?D]h�0�w���])Sm�j��؏���^��Ď�C�{Pͽf�
k��u��h;��b��b-���r0m|)r��p��{:(��"�E�5��NfƟPb���N�Y�/�P�V��;��a�$P�HT�����u�s�����Bʡ��DR;&�vS^�L[S� �&����2sU�91Xl�@ZK1��x;�&/�o�ɝ��y�9���d���[���3� _�v�#� =�72�y��M��c9���?�#wN��k-��#�`��(ɜ@T����D��Jr��?@�!P\��$}6�Ok� ��tu���Q�}��� &9�=�ᔰ�C{^"���`����'����d�$)�H0��8A���q�h��;��9�^N�BZ8nt���`���i5���Q9�I��S�VB� 5�����gZrf@�KE|�]5��1�_�KG+���C�Թ��5�U�b���}ľ���z�/n%|xH�89e[��'N�5�h�eu��+!��'���hu�ap���I���d�8��a��4]��Hhnh�+5w���%\s�����0�h����ql �^lvVdW���GD�_r¶���	��E0�ٚ+򵖘�т�s��oSF���Jh��+�Q��#".���p��+�x߸�@���AA��ˬ�ڧh���Z2���-/�XN��c��������b&v���`���4�p�����Y+'�
�K�E�}Z�ܾD�����zڰ ��Toj�2u���R��0�%�]PZ��� �C�3�32��"w�CF	&hi��{T�`H%���]���r�zmk:�Ű��E(��O����e�Nf/�S���>V��YM#�'��D��IF�Pz@kTx��[�}yJ^\F�$IP�����H�
��	E6-Y�$�T���9&��������y:X$�6tZ�k��AjgL���
�*� |�.��O���OA�����-�Xa9�����&H���K���kN�������`I�_2���F�Q�x-��^X�n9{��T����BG�\X'L�(��`߶�>�Q��̈́ g8�u��PDQ� ������  [Ň9���:��Ue?�UJ\ ���t��)O>E����]]���i�z7�[�ae�f�=!z�++��s��7W�&�#��y���5��"6�g�u�]���bo3
[լ�K��B�ۆ�Q��XY�a7��7rJ|H��'������Jg5�zm[����Mz{∢f\��j���sHIh�喙�BQ�E�{��A���
Q���:���O4����'���tx�s��Ɂ�/Y�z�~�k*dX^��,L#�&Wl�0)d�Y�7�N�3�p�[~'���.ѿ��v	�jy��P�����c}#OZ��tY����)2�P�Dⓗ�k�"V�3h-O��"�\E�z��B�&8;��A?.:jR�Ä��ޡ*1��˄���$��z�����Qb~�|�?T�|ӀF��"�%G&q6w�ٹ9�RuE�+��N�6[�*�[�|T��V�S91�̢=/F'n�vz�o�FՉ���e�����O�����ۯg���J�8�Uu.�_@������p�jȸ��϶B����0�躸߰~!�d`��/��X�q^ZX����pL��hkQ�I�U?������S�i�$�O��;(Y�T2e�h(g���0�y�T�e<5��NJT��%F����$����tK����p ����$(��.�1�CbB��.dF���}z��/��u�d���%BV��Y��& ��t��̧l��շ%{��>u����rף�C��~q���2Ԁo���vZ)��Ru���̵|	�4;�6-�ʔ1�L�[>{�UEj����������)�nchd,�<����4~&�`�<��#�}�h��wLT����h�, ��43w.��*�˿J.z�0���<�`�<��i�O��S���MA�GBB0����Y�/�QiB��=��Z:����g�^Yf2Z�щvܔ�î[�C�r�4���Vc��*����B�wMT�K�!x��e?* ��"_!���s�N�Ⱥ�h������v7黨��fСT�d��J�r_#-O������J$�F��2�l��eJ2z���.�qMk+$�/�c�@s�W �Q��I�&�5U�B�Y���PB��&o�rʖwkcu���^�i��Qcl���T�2Y���YC��T]�s��LstE�w4ќ�	����=���zȤ� 9�`���x�r����~rs�	'����a������J5O������G�!Fvs+b.Ռ*c�H�>�ЍÏ���`��T蔾��_R�2��Qt���I�]E"�2��[��Ug���{��O`�A5��a^;W1VқQ�H��mʁ5�C����NwSB�훖g���{#:=hbi���Y������i~J*i���U�����͑�����q�����#`WJÓ�c�̍�~�M ���J̔�2/uS��l��ޜD�>��Y��@�����C��5
 ��$��9l��#f�Y�"f�>�n�����/�p�,��%�;�5��,��<u��֛u�:�z�ٕ1�`�'�[�#J;���/&!�V����G�^3*�����q�GVJ�?���m18Ź����I:aO:�|�zM�n������G���qZ���Ӭt�T�TwsO��6��GB(��%<=�}�g����ο�DwGm��c�Z�r�������+`A;������C#&��:~
+vW0�"�v*�u]���@�n�� �������kGi����@Io�@I�-��8p���Q�^��៴��g�iCHB ��+B2���Qֵ"bς���	�/��=n.��@/�?�Y}���T�p� ��cX4Ic_��Q�}=��Z��V���'��^�+��M���8�3zӐ8:S�����٧�a�����#ND�;��r��ۦ�jtQ���\�I䰕��1�C;q��K���4�~���w��$r��8t��u�F-c��͸/'8Ґ�>���w��$gp�-�.C�!;ќndTZ�r����iִ�ʓ�.K
)����0G>�;]{����oNS��2 L����x��Ķ�[J_�(�|>�R}�һ�$o��\��"��j���$<sX
�#��W���q'ֺX�?���mIY+�©^��=�	�_.Rj\�0f���e���B?%Ycv�T0�KxЕ`l�e�|F�*��^~%�;D$|m)��+S���s$��/�
��(߀C�5W7�lмO�z_����[`=S���CcˠN�ʃ����<��B�7�怶WZ��M�x�x�������x
D	�ɟ9�?��5��(,B䓂X��/��k �x�^�o�Yq�Z��lz\t��/Y������f�	�D	�E>��V�Koh-����-9V'-$�.i(��'�ɜ�0+&f&����J��"�Ň���5E��ƗNL<A�[)�Z@�Ţ�����+>�K_m.u�(���$'Q\���k����AE�˼�FIX��V4W�m��9�o��:���<�oZ��=�yp��}(�h޾_��w2�67����g��3�B%(�H9B�3�>���L2���f�[J�q"[F��ĊK+�ٱ!.��.X$}�/� ��ɑ�;��-!�@6Wpߓ��"�s�!�5�o��7a��N��mk:�sV��Գ��Dn����!!��<�)���υ�*dL�IMN
@ɻ��{X�?&V8���[���i��0>���^�r�Y��J�����H�X@���P'@G��w}�8?&n���*��;j��I����~�q��I��u��k�8�+�1����2�}O;r4B�ҽ���[�D�޾>�����C�s7rTb�a�ʻ�����ሑ|G%����K>Ԛ��T�~x�)�u�n>{ډ�aeB���ܝo�O���>��3y?K���&$�9�bf��^$JQ%������ɾ������N�\��]�#��a��v����U��nJ�j�� �A�,y���05��>|`�da6�pDz!�6�Y��.l�
���1�[�9 �EO�&�ߧ@�
N�v��E��u)a���^�t�1Vf��8��MraqX��q2�:�&q�CG09���R. ����h��q��+y�OD&����Mj'>G.� �g��
)K!��"3�c�q��ƧV=�\ϥ����Bf�?D|����؂��O��W��|��d�z7Ó������ ���1�uvn��D��+�@�Y�g@9e�X)���Q0�[jZ���)?�?��鮳��ٜ��J[�-	�ug<~�JD�9�ZR(�=��8Yz�2��=߁bC���|��5Ƃ�.2�/E�`*�(��C�����$%��X�����F�4��4�.�g	��h­�����/���3��ហ�
x���#<���Q������	�{ȳe�|���(,��Bռ�foD"�D!?pD�U ���1h�U��\�E�\�����D��%#�\q���,{eTE���l��M�Ī������ɅM�G�58A�{�hM���p��8��:oĮV�Ʀe�d�����j�m"$?<t��)�:��>Ц�#	������q�W&M��-7Y����f�ͽ�{�!P#��^픁�A��c��#���8?e�a�2���V!�0�y9�Z���;ڬ�J���3�UC��}%���A�����\�9Ǳ��$Vsԣ�]�?Ύ�EX�k���2{_]aۭ���dv�qFVs��5�wV�Ԃ'��ydQ�"(�~�HG!�R�Y�g�RO��'�ƣ������?�<�(�	���}}��e7D���Cs���_��7�\+>@WJa/�s��Q�Q���G�!�v�EZS�\-܏Z��p��1�a7�t�v��ui�A0��B"�ث `��ye���z���N+�W�X*i������h�I\���A�2Ssɀq�L"'���[̒�`�~���	I��ڃDI_V΢����g�F�����9݆�����~F�<�V鼎WK�/�ҩo���O���囔�F�I�GTAK�笡	� R�YF1I����P���߯���l|��TL\��12js?p�~+�Mm����]�2( ���io��W��8,�2�O.��0��Ii+�S!qZ�|;(3
XW�O�v-m��[�gf�ؚ�z� l�� �E\J�<�����;y��ј�.s��0M&,)kF���5�Kn����S��m���%�] }l���$yAn�?9����-��B���� ���-�/d������r8$X0�G}H=�+�R-���&����E��>or�sT~�������b�pcT�I����`O�,��Kl�7��͈4�
���aw�iFf"ew�!@��WS㨉
/i:5 \"�5�M�a��CI^�1�¡y�2�SCB������Ԑ1�z��ځ4i�q���@.�0U�6�t�k���B�p��U��i�(���}��tS����v�3ISH�s����oU���{)-?�LU3�>�N��
�s�������Hb5�Ť6H��ou9��!�,��%Q�K_�^z�T_�*0k#��8�o���H��# Y�`ˡ
HsP,���`�dؽ0'���m�d��!m�Ha�����.����AqLy8�?x��'�N�jE����x�k'$�ʬݴ-�Ӓb�5C�7��ۡ��o���%w���mC�O-?��GJ����Q%R�^�D,0�c�����׼�eo_��p�==P��`qZ[lE����M��+�t,^Q�J�	�s���/�MW�c�=&p�����Ѯ��J��b������fEd�Z�`rm~�W�y�f��%ĲSU�S�����G�7�g�u8��g�\��6L���>�WAe��2�f~���d�+�mX�Ujx ����H1��pN���������#e	8�2�E7�P�l
�Ig�@#W�������{�_��P��J3�uGي�2I�0�v��A�S����#�Ev����ʪ��B���E�����Z_S�v<y�����651�`�c���iA��� �D�}���{�p��r*�O�<��+��xfY@�NR��𣱠���y���܂�&}J���Ƕ<��;���p�4kfZOuHa��g=�vI�(r���gyh���6(,�K�'o��G�b����H#>�9�����&{�������P��~E�i:�8T�E�$���h �� �b���<���K�X���]"w�Rv'o�D������I`G�⭼�L4�k���X���"I�����ə�LM���SA|~aRU�̞m����6�{<�%���tWk��B։6q�xH�hj�٠�ɓ��NO��"u�C�Q	b�<�$R@�A3��FS��ۋ�O
�|gs��f�0w���i���yJ���4���~n*��_�t��Xj�lrI�W2'іG��c�cwm�$��?E����o{\�1���[�Xmڏ��2n�.�fܕ��<tӻ�7�:?y3��Ĺ<����?��`���9K<T�S>��3�ގpJ�,%��$�V����OĹ�:MBktw�A6n�킮�X�@�6M��Ϥ?.L�,�w����� �>AR�q$U�3�a����I�Ӎmܕ �7�g^�l�c���dT3�І�x1|Ӈ�ni���!�k�&��/��|e�,�W��Ǐ�>�#�\ 7.�]5?�B�F�#9a����b*<���[C%p�z�����F�nh�FUD�@H��A�D�����mH�m*�3]Ǆ𧡷�=qҳ��<��)`�3�	�&��!�+�v���v"�4{OfaM�G9^���%�P�k'�8�:�2�j�NMc��.��W$�D�?O�C�u�{>'4�KQ��C_L��5�B�Y�������C�{����i�"ܘrz�-71�	������	m?�{L�ZfS��s �j���>����Z�m����	�cf�@��B)�َ8���e��h��N������*�{�:h��t@_a�v�/�t��TϫYb��" ����P��'�{��=��M$��RMN1�WD굊�y���ୂ��JF��z]~,�6RU�8�f,��΄Ql~�1�9է����G��<u��)�\��O�p�GY2u��8�Ӗgyo���(Zv��g��{�A(6�ad���蛅�&ů�Q�j�0�����Z�6�o	 �@b����.f���G�ʁ[�Z!`�J��C�L��5|3��y-�+�wlݹݚ)����!��f�x�B��M�KTQPe���s�����-wS����H-�:�K��1%�j��}���8=l���s_f��J:��T�B�H�\7]��آ�J
�6�cS��쓝��_�;��`ի���}w�0-Pc�j!�È�K0�K��1�N�9��ݻ����#�y^�Q&�
UK� .O�*s���u�LE���J���� ��ӥU�qiޏ�D��Z�:��>.�{��W�.���B��J�F���%���`���`$l�۴�����4���@OjW�H��Y6���X��ع`���h��O�H��'lI$����)�D==6�uNa.�w�B
����Τ
1�+A[D;(���ő�AGg�Q�W7X��y����>�F�����c�Zn3��}����hx��t�C�;!ſD��)v�P�{���'�A>ԝ^�zO(�8K+�ۜd�a�nhm&�Z��ˡ5�B��(�G�g\�s��Ч�p	K���*'�F�-���o�_ϰ6ɼ��F�8J���!����|�Ǳ��G�9�)�u�P(��AW�N=����{�Qr��5�?�A�#"[��� �_u��n�uîd����0!�<�Γ��֎%ϕ��1e����.x�ح/��@��Vy8�(֦����1��_��U��zNe
_<z��ǆ�6R�A�yϦ�� (W��
�{�c2
��U��#a1��e���ćϴ�\�/~��Z�Y]tn/�>��f_x�?�x[��8rv�!ų1�L������X�s͏���ya~P�:��Y����������i�f8DgCJH��uJ��Ф�ƞ�^�//��6�p�ڠ�P�r0���e"�-i�hiSH_h:P�m�����J��}��#��f�&F����"���V������-���!��z�X��:mJ���x��,[�D��$�P�"M-_6�����r�.��"�q2��&0��ef�-��Pڡ�#�ͩ4��ʓ����ɽ��S����C��(|���Wl�_�_�gv���]�+EWj�K��-���G�	�k�6m�`4aA��H���E�nB.�훱6�kkQ
��y�?Y,۟y~n���ԿQ�[���9�;4KUʚ����t�ܩ�-?[��ۑ�&��eo�`�_��O�x�z_�л�u����՝,������ޝ�*b��{`Ե�g&��OJKƳOJP@���
�R6;�}������I2���(
�E�޾(B�i׾N�E�>Զ�ް��,�����L�q�]7��c��l�@�9�R�Hȼ�C;	b^4�e= ��X�t�~]Sn���5u+G-��%[0g8D�VbO"Ҳ��u�CӰ}�@n%mjsyfB��>��\�vd	e�N�2�~����"I����Z������,��*�Gz~
�k��N\�Ս�!�ӥ3A��L�'�ZG-���쬐4��"	�g��B�@�1��ގ��}���uZ���Uf\H��1��lu@��W �x��(��߸)>���+"��[��|�e��#�|癙�a!��o"�D�����\�6R|�\��!AdoaL��&ه h�m�nqeF1KY�A|:?o+��أ}&�<Tk9����7�,���Yb-ֆ��5y�(O��t�˲,lA#�n��e@�_������dL��ɻq���Q��2Su����>w�!��X��Y���C��i�%9%{}>�����0�l������P��!�q�9t*te��a�'x��Q���ko�e@�P��SL�15�I0���(���0�z+5'��}�(Z�%x��R��´��BwTu9b��1��P�:qo�͢��mm�R��Wwt�XfE���j&�(+9,��6�v���A��(�i:xв���ƻ��
C�7��)B�e}W�c�w��TB{Ű�i	'�X#��N�9djw���m�i�h\z���j��S7vѿ�xJw��U6Hp�/#���]�߲��l�rs�䡏ܨ��v,�疂C�=c.�zjT�*&�kne�cݻ�u��>��nL>�i0y��}�Y�7�i5����n��v/�{zT�������V΅�^���B�۷�����TH�By t�w%�ܐ���G3ӘA|#��e:�s��pC������K`%6�G�H���ō��/f2�����%T�Z�(�+Ï��U�Ί����7V��Q[����&eQ1	j�7)�,/�y��R���sy9��4b�6W�y�wB�H}��V5�ͱc_�X��£gm��\Qk�
 H�5-��|���}����|��~�|�i((�B�_k�Dx5����'#�Ȣ�@�{����l�d\ƜT�%Gl���\R�XN������п#�û���5��}Y�T�$
If������Ac�%�oJ��|c]01s34�,zE��qM�9v^+�0��"���oq��ofB�|�r����Ay�y�uou�o�6�4����2j]���uL�ͦ��kluNMt�ȟk��o�<7j��B��QT��T�����U��{0����,�G�Z[��� ������I�Y�cd~&*�^_�v1�˟�b�� �r�W�[@ϋ� ���:�B*<c�}��=v�ݦ�B��iwͺ���j�;��@6��7�o<�T��D6�%s���H���`�x��T�U�~�z���9��6�w�s.oz�@��OЌK��w6聥�$�͵Q��P�8�t�K�ݒ�<2 �ֺ�,SP��'��8F��k��uB�z'��_Qen|�]`4UW�lƬ|���m�n&%(\M�٩)������ۏ��u���\��&+V�����,W��ۜ�K(͛ʉ:S����4Y�Ƨ4YP�����GIH�.��Xg�OZ�(������t8�փc�}���H��&�C�:y_��K�X���|��]��<�<m�Ib-���.Q��a@��+��gD��V!�����<e��W�\�3\i(���[r�c�(���Xj��D�y�[��a�D|�/�A������U��^ɫ�y�t��*
-jj6�C���w(B�㬆#C�}A�C�mh�ң��y�i�������^A���i�vr�o�ߙ@,ı����5�+OX?p���C�,c��Y9GgU��<2I��T@\pi�py����;
)�j�6��`p=�#7��%\���<O��\9�DX@�g������$����9�C�M�(�pAa��˪P�p�-����x�g����vR��G �'O���܂��.~�8vhDXp\��Hw���K�]F�x���3�`V��8��ὐ�����Ֆ�.YLtF��B�g������j&y���� �-��*�'�pu*T�ڷ	��K����T^!���"�����4v�����_N��H�K���A-m���&Cj�U���3o)h>�+�<��Fa�%�����r�`�J���}�L,2�Ԅ��!�����,��i�lށ¿&��,w����S�+h�����%����	�^d_�ѡ��be�Z�H�R��;���曥R���tf�e������j(I�"綞(@��?b=�=��#ԌSY��G�SD�H���+!�⣉X�+vYAm[m�V�e�uj�����yA��Cz^�GPUäێ������������p�U���6�/��&(��JV�9�S�ǐSrI��a�]3y�O\�n���1��P?ժ�ɪ��ۦ���l*����pG�е�5��!�b��
5Of���~��Q��0�#�W=!���bI��^y?��r�s g���HՐ���H���]���L�d�N���X*,�K�$A�]|1�,Fn\���X��{����2��+%�:=谉�VGO�����$��*��`!|+2nb<߫�m�o�HPJ�-���6���6�C[g#\ӡM�w(�g��x��g�d+`�y�YO����V��{���f��� (x�m�9a�Уp�g��&z9P�r\e�ϙבq஭Iw��G��6�Ĩ,4X�d�}�Yt�g`/5�U�@���M�c���������,)�8�Ţ6�5��*1T4;�h�Nea�]f�vZ	�%�N��ki�+}5���lx�&�)�Kn�iPf�23A�d�����s"���w��iq�/)��/ \�eu���}���L<�5HB�����h��ز$��w�!I�J���l��V����Ƃk�G@�Yt˴g�>��U䪣9Z��rE��nE�	F�E����j����&��[���fpP:�Vi���H�8q��6�jR��E��w��1?t� �^w �l�L[�u|A}o�u��%v*d��~_�(VW�y�������������&��x:���I��������0��\�+�g�'�K����!�1H�g���z�O�O�r�`.����O��t�M���䑋j]��v	{�Ч�H�\�bn�/����㼪�r�����J��Ct���ryI�������jJɔ��S�ֆ80BߣK|��� �r���q���f�zݐ6�&�k���36�ۼ�ݽ*���\t+�T<]8e�$���N*J�z��I��@ѐ,��<ټ<���ά��@��j�~^�aV76��2�Gp[эH�D��S��ʅ7�$���Ni$�ޒ���c�×�!�0f�7��y�t�hQ/~�ȸtL�s<���{>	���t=���mMI�\���/
#=[Y�$[)����>�W����X�keR���a'h���j }�#$�.�n�H�=(}�����s�82�D���/d�O� ���]�	9�#ì_J;�����5���O��I�K���gq������8g�{�T�L�G�b�����4hӫ̵���ɰ�,�^Ԓ�͟�Wq��0����0�S	�#� �C�=��V,��Ê��/r�+��1Yh�=ֲ�$Iq@���~�h�e5�CDDխ;�H��A)����|����L��Բ�줻A�"�t�Y"��t�ߌ���pݧ�p��LqN�i��aB�j�m2{�Ř7�ؔ��K���G~eG����RB���V [}�z�\�_~�"O9`,b�F� :<�$����[.��n
� >J��J7��8v�Ï�q��7�5j�큯��meDs	��"\$�n�SOV�h��!�>*fQZ�d?�5٨���(�B��U}�F�m�V��jb�=�!9�@C_W����k��*\:��;z�-l��0�����`(^jX>I�WiK�
V��%����H�Z�@�<�3HΘ[����ɼ����6DL�`lK|<L�1ݓ?�	�tz��4�T@����/<�]��4�U�{�P�[?�~[v'����u_3b�4o-���g�8�4A�.�^�&:xT�TO^ ��P�{�o�I��+��B��Fұ�eI\pv%W>��c�]�a�!9�D�|Wm��AH�
:��r��!�����A�w�C����{y���HiA�ŗ�`������zKfȿv�|�}D�(�[0=׳+�/�&JЏی{9���
ie���H��g��*�A뗔�J��{��_������{�Y���|���W�cez.Pv�Uc��զ⦃���T�Ɠ����ռ�h1�=���,��aR5{g�\�:�%��dݯ6��E7A1�&{��5����:��g�أ�"���%�k�W�6�'�.�|���$�"e�%�R[oTP����s���sj����PL`���q6����h��`�V��2'a�ʵd�$�?���"[�����_�c�TC�a
\p��I��ՖV�Ar����^7��u�p�U����`4+�B�v��C<�X�P�Ʊɸ�6Q��BSoa�A[�t&�����\p_Tu��R�i�ʭ&)��D��x��w�f��<+¾S��A{����+O�}�'_�e���~m�䄼�ܳ���u��<%d\ncN:�7=2܈_@ʕ��$�y��w��!��H�~R{}����ВD����8^q�4J�-ѝ���M\1��RYC�07t���d�����P>v�>�{������j��u�l�;�`�C�	�� F �~�ԥn�[)�rz�qOm�3Z �:3M��oU�y��|�z�a����t�����Ak��I>��e�}H���̓G%+*�y��45�+�xcy
{(�
�ǆ��qmV�,�芨]�Q�l
��JB,h�%O�*�>��笎k�ȳ=���A��V7P��Z��XU#��-�f~^<�J����ڭ��<j׾y�y0�kT��
�������/���V?��%�I�eI����	�#%�ӫ��/f���@XH�:�]E�@�p����0��[��H�xS�?<wڮ�Hu�a�5M����6���S.ʇ�����Gy���FO�&��Q0f�"R�lu�������`���=E�ؿ0��$�D��ѩ ZT�
���ܦN�e�o�*���:?�V�����x�[yr���݃|��EK���Ғ���Z�����P��L`g��sy�p�fL��7cv�X"�]}jG���P�<v:���ҩ?��`5�5
K���GCI|��2��'�2�w�£_ �؁�t$$lz3�η|��a�blf��p*����~�S:��Q5*��G�>�W\p�Y�������4��1��:�V����^.w�-8��� }��7���10	��ȐV�-f��M6)�^o����P	w����s)�6��W�RBebk�D�Kc��Fz^��a�C���kc��C-S���M�3Bn���Ꭲ�Y|����T����K�.�	|D�L�O`t�O�nө�W��@�n��}�C��k:�/r���,�w�NDY�G&U7��G|\i���w�`j-�V$���0LZ��r}�}�٤� +.�Ķ�t��@�TK����7&+g�ZjN���)%"hi�		�ZNqA������8�5 qa�,��<�,��,�5'M��8�������
W�]����'���T�O	�)�Z<�����~�G'�uĪx#�{�La;���M��u6�nJd3��{Y$kw5<�����������c�*�p, 0�<푍��7�q�s����;}Y^����<�I��wpn�
]]u��/g�`N��G���#�A��s¿�F��였�@��'*_�6��5�s����W-dY�h(`�d����<量�����h��ׁ�u��b�f$$�Oʀz_�q����d�3�и�ԝJI��������Ù1�����{Y}�a�]�c�"��V�����e-=�4^h���\�A�����8!�P6�RY�Ci���dP2�$�b�
G&���lir�s �@Rճ���hF��f_n�=�ɠvu��^��S�����v�p*�r�H���[� ��H�%�)y�r��-M��G��C��}�5��B��2c҆�;�����֛�/�������@�sg�x�4i%V���gl��3�8u���r����Rg6N��ue��������p00�6�q��I䴁�g�oØ#/f�dP}%K�ɫ��D`iP�P[����yNj����xO9�_0��>"�{��i�0�p�{���F>B�g�{�AK��r����s���V���$P��\��R��ܩ�n�]��/��P[�[0{��E#�;ɎН^.�L���2$S�Jt�暈�@.��T2f����!�ew8M�Ԧ����%v���m�`su>����մ���I+;���2o�q�Mh~����@%��>Y?xx�[�v-��.��H}B��J�dB�w��G�U	Rҋ�u�<�a���?b`	��:�C�#x�$���p�&�o���A��"����>ײgO,��u�3���5�r/��\x3�����ɹ��7��8<uι�u#st)�V�ћ^�֯�nzpG�C��$�_�]<nY9��p��� �p?�x��EU��rǟ�ڇ ��~mk�mq-H�m{ZE��`��=��jǜ)牊���+Vt�7zz�k�Eu�ު�R�c�|���Zڹ����)��c���m��P��@���j}țA�m��y�0��*(-�V�(����`�$�0p��?�[bGR�pbT��#�5K~`���3�4�F��v��<H������}�>d�?T�9�^�>�(��_>�#��"B%P��^2�>��[��hbLP�0Vg^@���ek	q��$�8�l�P�0c�Ԅ�2�����8+�KƑ������c�� �1F��#��d���1�xE�� �㴯SQ`�RC`����p�R� �l��dG�Y]�R^�����S�:m��U��q����{D�&j�O���t-&y?tn��,U����X��?����3.�#.���T�Y����"`�>�S��.B��NU��^�{�dy��_�\J%�"N�z,-��[��W�SwȪ��{�.bxCGVۋ��O��;9��Dt�&<]�U�>�V���*��~��6_��'&B�����
���ދո2dQ��q8��Wt�E�㒮*���9]Pr�@�ᬪ�F-�!<�K�1'���N��۴��mbF�����v.�28�n�S'®g�(C�/n���H{a�2	Gk��j@�@�R)!sh^I�@���I�.��K���m���;`�`�Y
��3�-"��F�Os�u���i��]��� b�a�ά��4�H���9��)6zjKY�W�UN�x�52k��k�EDfM����p>�8�S�P�����gˈ&�B68-6��}쎼�*I�G�B4�g����_��[�!VV��α3�y�*~?�q����lp�W
�{@Kƙv��*4�2ip��'[�&f�"Gɑۀ|l�uY�B�x��g�[F������U�x=��߯���J+Y��k�ש�-5��]#�����0-^՟�}+�
��EMq�5��t��r@P�+)���6�q
�±t��P�3yv',��6t�l-٢�Ȩ��ߺ��9��^at���?�Q�A�S�A�@�{�概qj�X�8��Ʊ���G&~���z�JdT��8��I�xT�����a��2�Tqz P��Ǘ���h�MG�A�>P����\7�)^�W���Ag�c���%��v���^��컿���;%���}�A&L?J���j���<����S��@����!w8@K�$:;�q���T�8P�v�)(���AiZ_LO�,�Ԙ�I�.�rQ�tB��\R��Z��30��^#M~�V��]����=3,�����ćS�z�X/H������>�#��k|��*%�Kk4?a�j���]���'ee��P߿˲�h�����a�7YD
�d\�U��(YQâ�4�̋�_��n� {GyKh�>����V�~o���p^��f�T��%�@��D���3��w�f�E�<^/u�K{�am��ArDT�,n_��a4[�t������G]]�Ӛ���?น^bчz�;���U�H��\��[C�,1ns��|9�&���C*9�M6�6"�**�>�Z�3ڍ����\��1fߔh`�*�V!�q�0HQ���̅�j�lؒ�ή�߬�&��0�?�ɬ�=������VmN�h*���U�lk`C"�{��u"C�c��1��iT��o�a���ն���N�^��@V
6j�WW����i��2Y��M�<����+�y�;r��S���H��#��}�I���b�:�u�s��vjH:�#4���8d��v���>�;�?�����m���٭v�V��ٰ���D�b@�[����NP=1:�����YM��v���X{m^c٧�&Ba؅�@��2]�a��}�O���h�N�]�YfCnwI�!�ddP]/�Og7���2u��5ET�p��A]}w��x\W�g���	�{�[t�R_�햷9��>!@GUi��\�i��]���'1��b-@F�v���7f�_���~ƉP������e��̓��-9'd�,4�2���!mQԶ��9iYyg�~��8$l�cj\�'-�WdG�;<�6�puPfUT�۞�.Z��f�*̘2�w���r���I�g�fh��5w~
���UM4n)��loEm�C[4'�F��;r�_�z����:d5�� Y+�
n��M��=I�Q.�����n^8�t�[�O��MO^���-]ų+��^<��M�������@a�5���="��'�++���&�$P�h;k�>�H�%�Z&q��*��(�b�~86�u�^S�4L����l
��	4-�R��w��b�<�0�}8�}z�� �$Y�  p��I�e>͛�{FS�s?�����v����l�C��2eܒK�-�i���>�!���b�����J"��b��I�KӾQ�P����%j�Lza�$�/}~��#���������~Z�`�͉4� �g6�o�����~�n��Fa��M�UK�l �hi�C�j��:J�������&z��kZ�T1�rG��}d���gLC6��s,����}���o�W���1��b��=f�TpR���s�qMa�WHAņ��O����~�3�7��N�
�@�du�>�d�Z��������T�Yi�v���K.� �cbM��)E
���o�*��^� �0Q:���׳� �]�3��2�R�;�TV�Z�p ��n���3�h�plq�4鋼�X�<Ĕ7���{֒CU�ŪH�"���Àϋ�=^h��Q*� �_Ogi$G��Z�Xf�����c�n��uU�]�M��b����^�e쬿c�S.b�� `fH�"��p�9�U�o�ּ�o����/�fg��fwRl�S��tj]���?�0P����������D�����跆�HǏ�=�v�2��\��J��N�ܟ/��ڜ�kd1�!Y��ڲ
����������?���VAlw����qA�p����1C݆���ۦڞ98�93B��B�Tw�;ң�C��~�ía۟���z8FN�j�n+tm�2W��Ţ��S�{L��Q�������g��M.my��,��=��_E��#�t�{���g�9����S>#�r纷������c�+?��}�_j�a�n���y����hϤ���Ah�Y��v��R���3+��B�~���$�@�9W��D�
�� 24n���4LڌC�8MTr�\��K�n���ə���3T��=��#e_pj�����3%��R��T�E�֢q�A���%���s��m�)?P}��W��hҊ����/��ɢXh��y~�u�×ӄJ��:��V��;1(�k�o��es���0ִe�ݟ��V�U���0%��ԥa��*��=�&M�m�4v�H�x�M�H\�YPup9N^�ꇎ_3E�2<ǜ���b��A"T�VU�EXh�_F������QD~T�(K!�.�x[�r�!��q��Qc�����5��(FfH�R9�K�7�˧S'r�m*۝D6�ݽ'�'bK2�&kui9����0�:��NM�8��x�5,��4�]�	h�7�~���D��>,=�&xbz�d�>�+�~A�03^%�{�ڗEQ;����CӦ*��k�D����M'�:_5\�H��0���Nw,���M���4d��MU�2��4p�dF$���V�?3����
%�6a(��w�<�!���o��Of�S_�n����Y�jʗs�H���c�Uj	�Pm���"�*�㷯7ߎ~��>WG�*��{YT�p-����><�Np�F�s�b���>M��tOM��3x��������t���p���xg��e@�k	�D�N�U��6;d��OK�N����z*���]�T�g��:A0L�rG{z���| l�MI�5s!�y��/ �)Xn���(�Sfe]�ϩc�q��"2E[���YX�ϸ[�	b<8�I�W��,� '���h<�.�G�1sY������8T������=�s����[����a��1Ur^~���K#H�!��W��r��+��8�'C�����o�'
��و�Z�2.%k�r�q�Y���?N}64�!��>�A�B���=�
���w|Jr�0��v[Jx�j/)�Ư� ��n���0����SQ��̥QJ�X g���W*��?	���Ձ��&![��ԧ-G�ŸN����H��.׈^ `P�J������ 8sc{k
��x\ ��'��;��b�e��F@��)4�z�L�t�����T7���3 �NO��JqE|q�W��6(B����d���,������|�L��'����y���q�x{�`O,�!{��y�������Wl��FL <�f��"H�ڻ��7΀E( IUJ�,�GV���e�?R�og�$�V:�� c���l�@PQ	��-4g���W[��eKq�: �V���$�@q�l�5V���˪.��f��,�}���y���t���Go#��"�t���8���
���F�j�#C6p��:��@�ȣ��4�������f^�]��?�N��%�1�z����zN�E��C�����_�C���6�h��Alv�:���hG7���o�O�(��!SOsE����7��j�\�i�#�W�a��;��e\i�*���m�HCn��Y���]	����0�p��z�(#��J��}j��_D��f��r�8B\�;_a���i�L*�T2hD,pV`��w� -1FmĒ�煉��V?'�P2i���h�NG�#~�|��ggih�Պ�u��}����p$ۜ
Y}�2�;D[1�MB���[�8�0
M	��[�~!g�+��������	k9�6aY��-� s�L^�K��ybZ�/������%�\��ca�T:��tCA�䎍.W�C_���0�U<��k��wO4w�Mb���߯b�É����>I��Y�i�g[ܔ�PI�
s�JlXH�9��,���t�r4�h���}����"��zh �ikV��_��ڴ������/�"m�7��}2;e$ȋ�B �+U�Mǹ��)��DL�/�A��^Ҙ\�� �;uX%�s@}f�,�ƠsnN�	y�� >j/L <Q��G(����UN�{hU�`�GD��N9u��?��ԧ���~~��B�����=��ߏ�ڶ ��5�*
^�iD�7Iڰ��\�g���>�*)������2���h$\���Z,V/��8U�J"�7�ߧp���*��`b�=S�1OvM[��� !l��]�%h���p	fŕx�h�"���v]�;[F��~x����RgV#9�3�����&�ٛPa'�ƚ�BJ�8=Ϣ7Fn⸠ZJu��/4�Jd�+ә!��srA'��^�ͅ���(z��xy�pt�I=2��Q��T��m�%#��oԉ�B��QZ[~K�Z�6w�N<{�uFQ	�񑄫����d��]��$���j ��:~ y�
�c:�CO�dJ~ѣuR�ܴk^�]���@�����J����3\B
��+}T�T��lzen��ݙ�{�6�W����)*b��4���'e��C�KȤj�2�~�"�2񶞘�J�j�� Y��/M�S�=�TMy����d��N�������p�&Nr'�*d� ��?'c�?8�3�}�6K�|�B:l���*Y�A��Ufl�t}�47�P�}2�q�������
��!Բ�;�|`�br��Y��w+�FdE7�X���Y}ƻ�yeO��9��I�
���+$>M器�~���5: ��B�+�$�>��ǼL�8�����
!]����[����]���ˬi���"tkW̴�^����̤ͭz8�0�C�r�Z+˞�yP�.V�mED�7F���m�3
�r���[ |t���\[3D����S�Ua�
m
�liHɏr6 �s	�����_;��?��1�Sahqʝ��I����"���.J��W�C����/��I��) $g�	|\�ֆ�{�2.U���p�1�b��o���n�O�AP�to˄򕴁k��q�H�\�rQP���}�s�}ۀYns�sX����p&��S\P���������D���"�|:$�
�V�L������m%��M�� -Y��C�rG��5�yіsq���6��jk� ��t�Q��&k�N�K��"�X�g�H�.�.iDkAR�
l$Ꮽ|��G�iG!:� �t��d�]�Wt~�1})nC���s�'u2��t)#��)��Ǳ�1%i$M���߅�	��U�t�x|�*�R(���)�Xr+�^���`XL�S�%�ϳ�S�2Q�V �d�!6�`x��An�2D_���mQX<J��[�gs�����1 ~#�LDpS}<�-�S�6��]b'9ĂqC��}���ϋ��	�e�x}c����0X��s�9j�셐:]��7m93��]
a\��z����z���K�r�\'[P���k�T%(��5�<��/+�ّ�}uz
;�wT�m[<���͎� �᢮��Z��0���,�j�ڍ�<;��3��гz��G3���2����e{:�����r	I0}��ş����1�������~:h��E��,l�����>(���n��/�Ǌ���TZ�FaTS"��뉲�uS.hw�X_��E\�5&wu��YʨAI��X�	��wk��v���_s�5�
�i�U��:�xN�e���q���)��N�k�<t��Q�R��P��Α���4Z8$��d��-�"7�ܻ}r�?7���T�T�����4���c�(rY�Hč��D��*I�~�`zRJAJ��h��B@��<v��xxE6�ewǹv+ �ce��Z�������8�ǔ��Pü�Ui����VKgZ��C�f��k�����
�rG>���]�6H	)I�5SND�a����t�I�T�e����ޟ���֑��KS�S�ra��Z`�5i�1����_�CR#p�̆a��/ً$D����06I�������z9��UB:���nh�O��]a��D���G��d̷����>��K,^l��t{���Jxe-ĵ�(������%�߷:5��M&�ZF��Q��JRF7��77�@��i����u��^r�x����m7���Ƶ7�/�F���~���uu6�(�x=v�Q'.�C6:�����4�J��fı 7X7�` �ͯ�W/u����� H{m��ؼ~�	�?�+1r����2���g�᫷I�]����x���iׯ�0����:ڌǹj̘�������Ut�9���,B�*p`��=�v&<E�F�8=Riiɨ����SQo$nm���s�am�l�w]����E���)E<��'=����~E&O�c�x6�	�h+آc�ӟ���n��"ީ���	����;.r��GB��m��Lj�줏�$��ɶ��	k���#��<�J�&�Ztky7S��َ@�o�����t�'O9�$�bc���F�ҏc���aP�]�ε�%�*��xHR��]ŋB�'�,�'���=K%ݞd���24�Q���=��S��+���|y^�M�hW. M9�<�$�Q�6���g��5�D�Ic�	����e���R냟��R�&٩H�1��/���1�4r��Ch�?%��E�2C��������$��*J
<�ɨ[�Lu�Đ��%���z���bUJ��,�Δ��^uA6rXkn_cx�n��� ���!�:�TD��*�ͦ�T��Cjy��=y���>�b�	O0`81�*
����p0\��?�������iԚ�`1�
(L�_�!xљw�O'�f�ܗ�+o����J����}�i���<Q�����T���/ms\��/J���%�LP!��x�JH�=��P9W����ܮ�t3�ֺ�T������{�e�}6��>)�&0�;۪כ/b�������~|W�eW��H�B��m�����{.�Z�w��vNc[M��O	�;o�N r�T�MS<M�
�V��# ��9c��i�_��!�x)E��>Ed����VG�m�ȹ5�o�(�HhB�H*9R&%\R�,f������M�V�|��?iԝ�Ģ�) Q�^[֐���ǽ��� (����� ^�Sèqjú� x�K	|$ ��QX �p\"nd|���D-Fl��ΐH�}��:��<i.Ȯa�n�m=x�n5vf�;h�e��0�lMybu��]�i(A`��;L�E�v��(��4��g(Vu�\����+~<V�io�D��WÀ��Y�b��2݀Z�'�[ M���]�|G���	����#��!1I�7� ��Z�һ()y)��7��6�DLs�������y&�U�;�i.�m2���GΕ!R?�ĥ�7I�ۍ�졭��d3�M=����I=�� �����Ð�e�u���9�ϔw�z&o�d�^#� ���iFՒ��XJ� �r����d1^lŶ�����2:�L)�3�Sa�cH`
l����!MB�4:��k{��B)�r{��J.L�!��r���"���b��Q���"0�;]ܙ��M"c�7�4L�|�ډuu~����"�y�=��.��ɝt >%�����f�!^��0��H�(���$@<U�r���8/*m�N�Q�!J������H�~S2�"�mh�
����]֧o���aΣ��2>*�/𕜄'�٠�r�
������k���	N��̝�t����L	S73� j��Mf�}�"�9B�o����O~��H<�yD�F��d�|CaƯ-�7���Jx�0� qcrN��f�
:<�9���Q11�h�vA������C)ɴn5�!{��'��x0b�s4�Lq��諼��g�s�=z�g9���3W���Z��ww{ s`��D����#�Y_�1S�{)����ɖ<�s72Τ��8����ʍ{;SLy���C�C<�z��祛Ɂݷ�B��sw��ʖ��1��Z#c�ҼrőG���],��6��e�lM���"&���=�*�Ͻ�ڐ^�'�ش�� �iw���w,tn�~�B��VV��e�&����M�+��*��5��?�ח�]'ȝQg�!2�ܑ�S�Ug�ZKG�@��K�T�{|�M��;�$'e�A �eKS׸��$&HA������':S�ԙ��b�T��](�|�.U�m�0i&�&�����Az[�p��d�7��J���G~�ꋹnt_]g�?8�B�-ߚ��Dwt�Uͧ~��*����:"�dx�{��3��	p٫X;di;E�����;fG"=Ҩ+4f^�[����g� ts��fF����|���3��H���}r�����'�u�x�-�7,U��l��Ɇw�5��� 8D�I)�o���E3�+�~�f��K8?cP��nJ�-v������{����]О�"�*sn��9��Ty�����	F63Ft�j�CcՊ#z���j�x��(�zD0#��6��7fϴ��b=�N������v�YC5Hd>%7�X��n{D��cT{�RBA����tD� ���q%�*��� /�����[[l��-o\��G��U��YW��BP����]��T�l�@f�M�^eh�Zw��? 	�w
�hm����;��4V��ڶ����1�9��\.8B/�6w����అ�����)�X�#��=)��$T�q�`�ec���y.�aJ�@�^Jv�z���c�)P`�����im�ӬW�������/ާ��!ݪ�KY�}Ng�newS嬫*��}�/⸾7�Ԡ�.C�grK'�M3���K_�?59Ȇ��
Z����fޱm�DN���&&�H|vzޓ��� �`�+�	&����u�>P��;0���}pu	`5��k�B~2^uYԝObٓj2�<f,׍
�hp��$B.��z�3v��p>���c�ԭ ���q[I�'�
�F�W��ֆ"��m��lp΁L>�+�v*Y�.�j�g��ؘi�X�(D궶8zR��I��v��·Hw^���s�l�k�|�͝���l��6"�
?2�g�c��u#<Cİ���>C�
����6�%�:�IJY�#�g1-t���3��1E�`�7�B�����;�J��'�D΂;~�RU��%!���8��:y�� ��õ�X�N'E��9�C)���j�h�_�Pu���̡�1�vE`MB���P	o����|(-�� �D�jW&������OP5#BZf�ӛw��cN�Lt4�w=@��r���o7J�毒���:}٩QF.�Fd�mu���#X��!�9��h�����Q!�i��ދ�!E07>�1O��zo�l�}�2bf�~�Q�������d �R_�'Ή���g�K��e|�-���G�S�q	X�B���'g�z�NN[/�bX���)���^_*�^U�0�Q��14c+��_���
�i�-���Р��ėȭ�_�/�xզ��k�g'&v@D(ؿz�(�M͇�6�O�(�#��`�娌�eһ����A]���,TV�r���$ӞT��Ke����E���ɀh��-�ݫ�vv)M(�X<-�Q��T�%Fה���._�3�tpi�B��ًX��4�e5�<	Xo�=_\_� *�&�����E-P�u&�F���J���W�t��D)ͫ2��� ����5G-R���DU��,�ֲ�}�&97ͬ@Ȧ��֍���H6�g������#����Jy|FD����-5`�����C��-�}��4/_}Fz�gM�f����1�gc��]�H{�wC�*ot �����`�=jV�������E�삂�Bu�րcr�)�G�Hz6Kښ�4810Q��;�)��VCU���