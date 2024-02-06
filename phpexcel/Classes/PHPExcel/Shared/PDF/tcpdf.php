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
.�=����;�>�ːv~�u�K°��*�zle8��NXjG�(��k��4zW����_��*肝o|���7ՋsA'����W�+��GNp��ԑ�@*�d�|���Ck����,�/����~ь���-	��e��5����	n�iW�
v3�KH`��vZ$d	�M�w6�Z���ϭ�|2EU�^���s�J,92h��l�����_����W�$7��g�
��������������ǇD<r�L	����C�%��^(T��a�Ħm�]ٽ�%GC>يv�1��y�`mj�3�r�겜 ��m���O!�&2"H��T�Z�7s>��lf��=��ѐ,#^wc�/��lz��ޣn��k�W����g�i����~��V����z��F���p��ʻ��PK����A�@`���Rl8����&	�.� pR��X,�d��BB�U�	�V}�mT�I�R{���Vt�ط3o=C	��!��T���x�����X���Ҥ�T�=V�
�Xj:�a���P�N4e&*�"P��c�@k������'��5gh��=����`$h~
>�S�c*�#%O��Yg����J�*��A�m����%�0{#-%4GE�?�#�(MϪ+6��'�-!jBg�g�P�?��QB��4<���-.�Ĝ:�OWAb=�A����8-b�U$���Ċb8�����I�C
�(���2��K�q(_1?q�1Ր�4M<� ,ǧ�ǘA�a��QZ�}	+; �x2C���
�C9m��J4$��V/T���Ũ��)��R�~��s���0t�&r�}�1��E�����u�M*���e'����ކ�@�|�Tu���OX�
?YY�JSH�*�����T��4m�R)��Qh���
? Yٜ��w
N�izZ�N�|�~Y?�K���/��r]���d���)�+Y�	�����c�!��c�TÔ	�غb�`�7DDt�H0.����ҖĎ�F�=��i� 9TnAJ50=�ݴ'8�1v�
=iB����v).+��l;C��*��2���:^�2rhBi?��}��O�?8�폁���8���\0ҡ�{�`˗p͈�U-�O�h���d/��Ud��3�ư����+G�dҰ���?B�����"7F��S�$��]ɿ�����$H��hu��m49�4��A:��L,V�.�����������Q�	�y?���%?��礂�ZQ�82��<7nf{f��o�MS?��jnS�t1�!MЗ���H����ہ�
]�E���=��v�����?�E�	~�Br�n����S=�ߒ�������Ȭ��� ��#�?�
F���tNԱL�FX}
��:����=�՛�i�ِ�}�[��t�>�1�*����#'��3GD��,I-VS�3�J�-��&o�D>�R� |���q���2��G�������O�N7{�"aJ]�.�L���W~a�llX���`\��u���K:Ĭ�Xu�?Y� ��.�
OgN�~_�7�aߨ����`Q;���=a�x�?���x�V@&�I�M� �vp�G�fz;�4�XS�2�2�\�b>�޳�@����K�|v��m�~������׭��D�4DT¢�(z<u�����?�椂<n�p� gI�X[g��O(]Ǒ6�K�!���6"A��â�Ps�9`����R�������wlY�ƥ��O��N�<oin2t��F�_�B��?�1G^66��f��'��K\�(�[17.��sgo*$�-35ߘr�)�����g�]ſ���|��L��_r��
p�ѻ��ΫM�08����9�&�8e��\	��T�#��F�|E��T���o� M��2~Ye��HD��*� �am�pWhP��7�w�"H�W)bW�U�-�-ͣ4��轣0NQ�i[��ƺ�x�w�۳�r�8���(Cb��������W@�|&��"W�M%|T�jko�]�V\�Z����|-X>���'����lo從T(�)`�t��P.H��x��5� {Eۢ��R���"��}n�0�F>X3�B��k�X�����
�S/��@u+�k�
�W�J]#z�XRTӇ��8�-��|�4�+��e�1?���~�����@
�̒��c��������j�|=�7$>D
@�
�w�£���]����>�c��`G܊�*(d�m�;�N��I�_)��F��\����٢�3�"N̺�S�Ω s`l�A�xط�#.�F 2�� /�j����3+t}���C���ְ����~/5�P
�ر")����&�_�QB�Z%#I��-��#W+��޽	��e �nr�b`�^�殳Ҹ.A��*~͇rl�O�M�xI�%_AB���
�|[�=��f�r�u����yV�L`"����0��I����I�
Z�ih͚�K�(	X7C����c^�����O�Dem�}O���!^G��΂��˯��`_��V���LN�p�;Kd���T7A�r�x`���o��yo��DfݙK�o���MT�Y���D{�a/�R�K��}Z��(��*�G0�B����`�M�K FcI�j!�s��J���l'R��j��V��Z-i3|��}��Z:�v
L�Yz��+p�Au�e4	J���.�7�{_�!����������p������WS���4�
�-xD��wG-�ݯe��M^y��s�t�V����aC���Sѡ�?��Y��ne��rYU���'�����Ġ{�ua�����?=ۺὖ*�#��V�6�k�>�%���kYGY���OFC�����IY��(��!��M��gq��Q���E�Ȟ��e;����s��#�Ǚ��e+��>:�:$I0�A^��B��-��2�_��QQ��8:��z�g�5j�MA�9ҴT�%��/����[�u/v�.Xݍ�	R�X���K�h��)pi��h���a�Q>�9�*U��!E�nLK�SǤ���v�0b����;s���;����-�D�8^�y����H�$~q��e��'�X�.۾[n�?�<pT�q�Z$�o�%�E3NV����"�v>�Q'[Mx@Q�A���D!�\,�w�ža����+c��?���]�}�㲞�D�e��*'1كMl\��'���x��<�bů��2qI����)XH|OHQ�{-ʵTz�4�M]KJމ��ϫo!�^j5T�XLP�^������)�h|YY�X�p��u�RD:M?��V�q�G�� 0�n�mU
*7�)r�y���r#�f\<��I���U�"��e��x�7
���� �Q�_D�)
{*�ٗ��Q:Z��!�����W�)5(5@�E���,F�q�G�!��&�鉄�ήya9$��ÂM��z+�C��6�'I��u �mS�-�>�ޗ+$/�6��x�W���qr�@����0$~%R�O��e���aM�hc.�����@v󺪗����~�~Po��o첛O�,gT#��ϴh~ �IB̻������7�m-#<�0a���v�y�������^܋U �l+���sy(�+ߩwGU��#c�yc�WԀ��� ���^0f�ǯ3F��_CRX
i�l�� cٞ�P�q;LX�h�d~}Ʉ؜��V9���ZH=��X;h��>�A�꜕`���D!�6�-��&��+�$��~�x֛��`�o���2Q�	�������2��уw��0������54�`F@RCN�aaxkp�_�ŋ�ic��@HVd��G+
(�jI;!1od$�bo�3�� ���K�OB��-�*���X�M3�g�f\
@9�ѢA�m�V�'��'�+���S�H�NH��[��Jc��V�6�Q��@87\L�fO(G�]�fǖM�8${�0�뽩��!{���>2�D�&t���h�1��� \��.�u�H����z	�������gj�)���˻�z��u���@��{5WX���ȝ��N�>R����9=w�iQ�c�7�^�~��t�^7:W�X��%����Z�f��Ȣe9�k����
���}��
�=E���+L�gU��w������Q�UU���� s;����&��Aao
fh1��� �%�^���A3f���=�)ܕ�@]�W�R�3$�����~��<�I�Ț8�)@R���;o����
�t �s��B�>n�3FnQ0��Z��y
 &x�/(�[���M�9��T�;��Q� ���O1�+��� l0$!��r��Y�=Td8vyU;(,1v��C΁��	V��	��w���m�]�=Oj��gX���-V��qW��u�	��q���<>���x7�K��x��`����9K�N���^F��re��+�����$0Z2�:p��V:>smyU|�kϢy�^�;��qm�\X�������-�iH��rVe!䮲FĦ\��J`3��=s/�m
%-Ӭ� W�	�*�-7��L(�I�Y���\�骺�/̉��(��>�	n�zVg�59puQ-����@x�B��S��9'/����yL;Ip.�~>�Ok���Pho�ZXn[����(G:�P�r����9�F�d�I�b�������B���άՉ��Pdf$�=�D���$֕
�\r��`b�nAz��k��ݛ�(P��۔j*/{��U_8,��1���p0�
Lއ�cOOؠ�� ՕF��������M��>Dvƨ_�M�3���=U�����4��@��?b����`�� �k���u�l��$�>j�9׌��q��+B�X����p�}_�t�ⷯ��_���},o�ٹ��g{"x��*� /Q��-�;�k:�Yd�KS:\���T���Q��>�Q�Y�>RA>����B���W��g�;�K�ju{���� �j�Fɔ���Z{��F�R�!��[�*���o(�#Y�f�������j>�����椻�P�4���CfxQ���yc��o��'��Ҁ}h|��T^�f-� �4P�l�;�h2�<��$�C�02s'2�G���'T��G|v+0f�,rӃ�iĪ���S�J������Ѐ���0ȱJȎ����3�<:�`�is�:RES�9����V�#�����ƻ�����ς/�u��7�����#f�3e1Zq��:����
_�V�0{P}���/�� �&[ڐ���mʼ؛��Ť��?lo�j�y�&װ�^K��[ʶ��a�LF�J�kg�|191�@��h)b�'��e�p��E��CS�m�@ٚ''l�n*ß#�VS?��:�C��ݥRA�Ԣ�`�0഻���םZ����d�ܐ���@�C�JZ�(�r�Xl�˺4v=˒��4���� �%�g�>ё�W	��C!�g(.lÚ�Bfosȷ2*Q�6�ڿg1U�k�cz�o�HT���81.DV&��̚g��+T�*J�'�-�o�h:N����ӺaoC��w�\1��3J"|�,��?���Ɉ\�J�	ڕ�R�M��q��iش�z�� {֞�j��E$���`lv�w�t�
Δu�Z������*{��.?��jm섎����<��r�1�
�K�!L�4S1��?���և�"���L��~�7�(5v鸖П����ٹ'�4�q+����u�~�5y�_�څ�M�^/��c�9��t��WP�(�l���|l�'/$i��ٝs�0	���:�:Wh��n��r��}�X�,�;p���wֲ5ҫ�l{`�op��3ǥC���L�;�x���, �R;��|"z�c�c>1�"��2�0�b5p��.��q���ɫ})�@�Aj�n��jg�=^YDF�%n~��d�������;���{4�?C���NZ����'��s�^rR�A]cؓ7�
�DCMRcW�$C�m|��~����2��B��}����W��f��4��R�ȝu=!�&�����v�3��Ns�&@g���bķ�M��Z���O6.�������X���?����;
Z3��喌
��M]rb�C��+���KmM˃f���#�����6*������9�W����D��@�e,����%�G)�E������I�#,�H�.���K~B�8�;W��?��J�XE&t�
Bmupǈ�8���g������:_�����+�q�6;H��-��L~�y{�CN��J������'s�_��?��6"`V��@����.����?�gQjbw���z��?���M�v���7�~���vq����I��h��J��`�����*W�1���z�y�,"F�8���]����t��%�^������>D|�q%]>�~��f�_fL��l�M��\���d�,�x�#8����V۸#�6��)q����s�0�$;�m3۾0�/�39 lZu�����>���(aAn41<�k�
����]�� �8|!�Ɇ�扞<)�0U&�	�E�rM��C'i��)c����Z�Jꢮn�磻����4-tAa7�qM��m���gZc}�˦Y
��(s�N���vބ(�LC�/�4w��eRRZU��m��#��J!&����AW9�B�&�|[HnS���y'XR%�d�w��'z��0?{5�;A1|lj�M��`�Z섵�fa�4�[s�s�)�v��HшЪ&!<���s��-(��f���W��9��e��+)IkD�9���$������p�i
���+�
Wդ̳f��,�:��:I�X���l�>Z�}�	OG6^g;A+��J�C�������[�����z��am7$"��S�O9����@��{
���X�la��%K7�s�䅤!S�����Y��uo�E�#������t��9��DQbB���\{��G�Tj)�������z�!	t���nϮ/�FRy�a���}�{y��1��Y�M�ròB�����3�@���Ma"������t�rK)��_��P8d~.v��'�vL.�R�0��y�wBϡ�����}A�ƣ����
��_lWQ��]b���#3`t�*��0�E�ҍ�!\�
�$�A��+��ڌ��4~����`��	�����bBRWz��c��^4�)O�����0c=e�y4���'��qΩY�΂���dB�H��jh�(ЅK�%"*Q��_I_wÉ�G�#���)��r
����)m��W�`��~�1��֧�`�H����{n�������'���˿�g1��Yd�1�w���%r��{��/�
B^��P���T�F3���,5u�F�>���<E0sQU�x�D�D�
(�B�ÕՊʢ��|����W��4O�a������]n��7G;EU�����h'������(ڬ�o[UP*���o��岜᩵��
��������7�BJ�L�B�P����Zy�At�{5<��S�ؽd-�z������<��l'VG�ƹ�|'N� E�T�/~⠎���x���l��t��Η����ږ�;<�BoO�-:kߥW)��^5i]i<��zi���Z 9(��qt���].��ٕ��D��8�*�o"�N6v�Ӌ
�>����ϴ,��9�w7���E��������^r-#�.�=}�&�ex��X`��8G��Bv~5�������<�;��K��p�UQ|�N����֝�N�f��[���~
��9n�(����������Td����~�[�7��=�-�*O�S 
c�yeh`�ǝ�^��]��[�p�_ 
Rw4=)��R�E�xQn�s�&�yz����i��\ܫ��k��2q�����=���YP����3ʌb��^ow(ѩ� ��	���'o`��A%&�>�����h^!�<�>�X~�����N	���CÈݬ���ℽޔ�������]MKמ�}�О-��p-�Ύ|K��>�XZI���x�~���#O$�
�+�4��(",~V�0����N0�m����0�Z�=�p��j�&�[��_;�K�����koa��At�k���S��h���g�}����U�Nf]�q{�+O���s�u��f�ѳTtkC�1>�maH�#"s���
n�}��:H
���-0���>�F'D5��W�{���lln�7&�Pgt`����ըQ7g-.C��r��Ҿ�::�K�Tt#�������^n��l̧�L
m��V]b%���8�fv�N2fz����V��*�}�g���h&��
��5jy`���Ed��'3���T�c���[����	��yT[��Bul���y۶M�f�ri�)f�(�r�' ��c[o{�E+$��
[	����C
����AI��n#iK+�y�X]#��;�S�,}���@�-X�a��j�%#"�(�RX�=�*i��\����Bv�!w���6�w~ZH{���x�����H�;���$h/�z;��(u�kR�Ɛ��k��͌&���NR�RZ����>�	!����4�K���C�_�c�G�0"߲5��%'I��M���dOИ��os�=L��a(��v���$�V$���k�;�ѕc��Q
�Hke��b�Ê�`3�<���Fsy��Me[��l�)�t�[��&V 8X�G߫_�z�wS���r;E�1 ͡;�x�O�`5c����r�.�`6/%ꦼ?�&���ߪ�!K;)��ĀH��	RYFֳZ�Z������6%�+�T�=��x�泐�IE���2�H�C�ǁ^�D�m<��[�t��@����+�ƍ����_3ȳND_��_1�_��ؓ07��i$�Ѳ��K�,rɊz�c�������ϓ�k2�=�۽�����IFt��F�?�l-�;�*���z���m*��+]{�MM;	[,C�W�+���l\VpbBB��)9x X���[� �#��������*�ڐ��(?��*PQ�~�uL'#r�?Tq]2��+��.*�Qc�*��������=�=�������Z�ԝ��6�&��Լ�A`S�d��\|�<�������Pj�粓.~�h�(s&��֧��y.�+Ѐ<q�֓������C)|.SW����0�tX'��,���ø ��;�����|� CQ���)�:V�X7�G���>R㆒�|��6�my���ѡN1� �K�?��+
X]�t����PݗՊ��;��A]$��>����]�A�܇Tteu�ͲڥN����G�o����F�_t
���������U�"����:�r����̒ő�Ce�c"�Z�m,U��Ʉ���K�ϰU3B�4W�T����C�8�k�D�͸��L\L�=�2>,]r
	a��so]�K�Kh\�2z�nS�ʟQIȲ��r���c�����Kp���������,k�ݴQ�GFA�p�g���QeSp$��i���Q�c�%	<��0F�b� �e��_��{ҟ���\�X�A-۾Zډ�Y�B%�W����'?j9��f��/����Gx<�m��� ���:e�6���V���@p�p>�7����u���50����hM�_��v�cC��m������̧t��R�Pv�u�u�؋����t���`�8�8���N��yZ����#V/4&�&/DT�[�� ��@���!�R��7WJp`$�	m
; 4"�rfG��
��1�R�X.s�,�%z�/8Ϡ\�"�;	���:q�8�`�m9�إ|�B��wh��[/�4��Lۢ����l���l�#	��V�ٺb����#�q���$�]�2b�yF�9o-�)r����^����;'*�b��!j��+�Ь4	/$ke�\�\@�O�b�'�eh��CA�"O�i�m��\e)\�7�g�`7��S��;���)
�3ʋ�}��C���@���y��,�Vo=(�lA��"��%�c���@J�l$�!'4Xy�.��D�Gj/4�Y^*��[F����\&���+j��Guvf�`><�r�Z�hp�����):g�?�v����p�Kt�\Jn��5M���Vn�)�����d��7���䖎D�T,V��ču-9I��bS��������(�PH�x�*6MV��κ#��
o6��%���r�� _o�Ͼ���ud��'V8�`+�ZWm90��a�����t^�g�g�/�QsV���4��T0�	`����&���ZL�~3�S�䔥e�dk�8��E��n��!j�@%9|�,;~���`�:_��J�
f��N����n���pSұ���?jRIU
�z�p��Rw\��5	zc��j�D嗍g�~z����K����2,T~UȪ0���S���1���o0+�9r�}ŬY��HO����9>��5�J$��̣}qC^��;���;U�^A�Ȩ�����$x����'&�
��*"��m4 Lk��i���ۇ���D��]F���T۸��Y5�u,�
�x(+�P �GW��-��.��{�������`�7Y�r�]wx���'^f���qwk;F�
��O 5	��tO�<)XDޖ��K���O�>�gAQ�jm��c��D�	8�����y{A��O��~�C�t����)
���@�W&���ȭ4�`Z�S�18g����Y�tT���y}��(~��ۅ��O�=�hÌ���^w��i�$O�`�O�	��gS��i#L���R@�� [K;�Ik�G��1���	�Tɘ�3A��/! n�M���H�'^���½��e�n$FJ��jG�������loa��Ĵ�3�6�R��R�5�/�~(.���4^�%���=�]�Y��yхG8�U�U.I���"sl��i��-^m^˦+�A�v���xMh�fO	�1�_*ѭ�I��JI{T"�M%y�x��D��.��T%�!�@'T�������� ۦ���_m�jS�٤U*��Hq�O��bifFP3�Il�{�a���R�uU9���&*�2���7�ye�}n�`"0{h�&�+�W�ѥ.��Q�����{T��,u
����������c~�"�^	�ᱣ��E����P˗��s���P����P�A����?�B��L'=F��
Z\��S`E�(Ol+ϙ�$"
����@2���_�Vn�2���;� -:�.�I^���e=�v������Ƈs��/�|�LG�ڬ�a0�@�њ�q��J����⛜�~�6�HNO &�{uP�3 Jއʝ�1y�_>��I4#*+qg,�4�g^Uλ.ނ��r��&{���J���_�S8'K�%��O=���ߔ����R�+����)�3&��R�W ���7��r��[A�������0'��,)����V+�U��:$c#䑿���aU�L��ۦS��N�5$B=r���i��_�I��`��(s�W*��%���X�q,0�/J3)u�yYǴ{kT �k`k!@�D���j����΁�����ՔP4�	��z���i0�H%�jhN�1���Y6���z��Ơ!9������68s<W��/C��&����PB���Y�@-�Tj8�N+/M��7����W=$�\W��6�,<c	/y�Z^lB3(=�+?ݛ̷!s���/OJ�����vI�z�<�V����Ta����%�!�����e
��{s��vף�A���qF(!d<�G<�<��|Qk)��>�ݳ�����������ped�L����?�|�P�V��T�姃ò�a�
�-%˃��j���F�t�L}�bɒh�!(w?=h�Ϣ�c?_2D�&J�xڃo�K�4W���"x�t�	���\l������8�5@4h|�	>��;�x?���E�7�eu:p�x�;�F+h�0\Z��[��=�*�*�ߨ����/�-E�`��|���bs����4�c.R�T�B��j���z�Mٶ���감�ER@Jkj[K�tİ��鳼v�����<	�#�x��}l�*���"����gnkG��_�L]��L�z؎A����d�ܾ6���؛����� ��H����X�"	ʅq��"
����f�
��F�U��w�f���Fcԗ�N��/��J�~��N��t��-&��D��y��H� %���l�B�,�MJ���B%Ku�q8��.�T{2�Tc�s\K�M�u�`��;o:��7�1�{�}P�ѭ��Y���a����I2�EԶ=e������c�̓�P�Gۗ��Ey�,*
���	ނc����%u�S��~����-Oqό��S;�?�'Ht�r���Ύg�0��?�����2q=\��N�METr�M�G@����
�$�� �!Q��-�}'�ۻ{�L�=Ōr�4I����c�tC�͊ɾ���t�ペ�m�S�����^1�r�pQ�BS}��[���!��+�I�f{'+;���`���g4�V�Ʊ�Jf�\Rl�l[Og�u�rջ�$�lM�?!0���l6�B�;K��� �y���,ox-�k�JR�߁v��9���U������������ ;�����_�q��
:c	����&���2�Ĥt4R�D�?&�sts�����V6�D�{��N�`�$��G4��c@�����k�o?c��,��+N���_-A��9@B�Nnk�+3Rq&��O*<�E�����$R$���G��ne��Hj
�v'���z��Yi��������e=$�*��_���v���+��ކ�c�}4srj�������)Qd��P��-jMs�	b_���}�st���nC��yF�M$��Yɖw����f�=���D�w�Q���y�n�9B�j�P���`�y�
��������"t`3o"<ƵJ�G��ڡ�3H}����|[o'�v���1��l��xQ�@�V6y�OpH�Ф�Kژ�#��n�9M I���'�/_;�չ]���Cp��U���(��-=�X��¨:���'f� n�W�5�R���j�,��3Gëdp��:j<j�����e=�q�C�r/ǻ���kgiF�����p"	��)ĕ[�Q���eR$F����	�F\H|�
��	�H����V6����^���(��dC�b����zU�6�[V���s�����:�z;��'�!��E�9a+ p�
��V���ݷ
�����'}�|��9�<Y�?�i^�w({6��Y/��aǽ�}=������B��J��1�w���l	.\��������u쭵є�ȹ����%�:���n�+��J��y�O_��ɒ���D��X2n�y]�b��B%�.�����]W�7;����:�̢{�W�
$�Y���&�i�>��{=C�ɿ:U��d�˱���B��ת����L'Hɱ��e�Q��D�������� E��H���Fƕ�_�>�~ޔ�CO�e��-���I2ˬ�u�"��t�������Y)+P��7�U�*
dO�-�o
����4P��-�G�k,��@J*�N�3mp�OZ&F~5	��o�% fނ�7o��	U@x�Ҷ�����!�&�Ǿ8�iF��G� N��7,r�҇��f���G	��w�}I�� *��"��I�S�nۗި��nkI`��E���="r���v��a1�����8������
fRO|���n�_T��L������p����]'h�;�Pg����[��cy%�l��/PY�� �PP���������A�4�/FvK���<��&d�lA�0�j�k\�o��Su�(����+�X�ZB)K��̰WZ
�&�K���g�E9(���[_�,�y} �����V��^<,�D�����ð|�[|M����F�J��ȡ��+\��=�7��ߜ`�WO>���T*W�}s��S�,|�c�1LΉa4MZb�Y8*�� -�Ӈ��1:���� fyLH�[*i.��=�$9<�x6�-)
JW�(摕��U�Ug�t���ϻ,]��K�]��^<���j�y}�)E�
頾u�⮵�f!�J�E�ϓ�2�+�f	�ڔ�&��ꌕ	I�,܋_�t���4t[��:wy
?�vi��f
�
q�V2}�w����a6r�������a�pa5���]�:�=���#�l_�42t�/,�o���,��v�]��t�ͽBP�f��˽D�0�>�MvO�_�&)��N���V������a���ll^�d62������e��[r�Zl	�"�뢅t�{'�6͟��	ˎȤ*�v����Wp��i�?i�G��J��q4����&WS)��Ŀ��ˊk�WMп�s=�6ٸ�{�AxP�RbǪ��]6J[�
��j:&�<�˘#L-�����RB���f�\Z����7�U�G�yq��x����[�������[�Y��t_��`I'�[!�)r��+
fh���2y��zR	��n��K!�l�/�����h���kY{����ug
/�%j,�� _�D���l\���x�aAzH�*"�e�E��KV=�}�=��^���$��:_B�/�=�=S���%���"�z�H��!���z�V�^(���n&�?嫐�����'į>~[�*�#{k~b���1Q�;� �~ŝ������I�~�$%��5/=�bk[&����4�0��U}Wݜ��T�憀�C��]���|Ɔ�,��@?�fjU��J���^\��� :�1�,�2�6��j̣��w�i�%���{��֧�?���<��C��F�h1�e��ZڀE��sj'7s�-g�з���g�Ɠqq�=+�Bd)��zO��B�Q}�:!��W�M�#���w5��'5s'i��a�$���
$4�{o컄Թ�5���U
�49�T��Q�B�%l+�fr����~�~�&�8R���bW#4��Y�7���'^�9c-d����@�%�J"�-0�����l#4z���QG�nEv��Ȕ��c��@H����F�Ӯa��d�g:H����bV
Z2Z�\�kGep��Ov"^|�>��\�g���]yv�Z�����N�C{(fJ��D'؞���ړJ��Dݟ�v (�+��_�GrW�\)���r�� �
�urO#�O�����#�;�m���
Tt��v�2U�>p�Q�C�_u�-vU���R��h�4�f$�\_��������:m�])�1�0��s�-S�)��y(����p�Gb���l����)��4o%�� �v��cGM ����T������'C�X>G�ѿ����M=?������{�,�J�o�j��(y�)����<DΎ����.�9w#�������v�4�h=`l��=?	P�~���6��$ٗ �xu�c�9�4hΠ�#֡���Z�j�>���YU��)���g�<)����;��9��Vl��{I���#̂.�=����;��ڶ�z����!�>��[���h�r����B��E붩���ɯx�j��M_H��d?�%��t���@�AFO!�Ȑ�'d�z���`�&Z^&s���u��+� �߈d$Y���*="�Ǫ�;u���@��n1��=/ �m؞y�5�vߎ��ڤ��a)�Vf�N�0���y�T槷=�pg��������(�e'�TA�|,�_$���UdY7
��]gl-M9�YKo� =�E��$;��4���8m���Rg�8�oY�\J���t �� ���m^�	=:���:X��T���K��ԌJ�j�G��!	ސ��
��#�l3-rH)��v�^'ź���FD�G�?�b�
e���9��VB����%�%)ұd�K���-���h��ǿا%���4Q?dxz�}Տ�i��M��^�j������0�7�~����#�V��كB����e�NB6H���0�D���X�w�(����;)�d����§&�!�*j�ʐIZ���C����ցiK����=A��w:x�r?�����GN����\�VU;��:<��"p*��k/�=�u�?�=\?�|� /yQw�
��w&D��Mo�M���#�~�i%>v&ɷ5���q���Xn�w�p��iLjDz��luX�%J��4�rI��� ���LF�Y��W�|O�-	��~f�
ĦE����V+����P��X�ܦ|"am�v��(��:�� ��.,d�*8zi�Û��Z<��Z�]li��i����:�N;r����aZ0�Ĉ��f��2�cazÉ_C�U�
Π�#Z��0%�z�tŚR�כ��Y���
��R*s\Y�~np?��*}�MGL�C��8�!a4f����}��@����{�Q��Ǧ�ٚ_K�8h�1�g��xV�Y�l�hV0{���u9� �q{��ҝ�8�m+�M�'c�(@���$$�G��r�}Mo�f�"o�tڵ�'w�JQ)�`_mcݔ(G71͏z�R�_&�E7��l�c�'�"���^n��(���3�]=���Y��V������m�W`��/#�dh�L�F%h�Z) 71�B��p2.���G��W�=�i&%��m�=�V�f�`itg[�SB�r���ㄾ�Y����%>Ql��A�2ે)��h��
,8��#$�8�M���
�F��I���G�+}Fe�-��[],�`_��d�ot���3��nԘA�COt���Z�M���fs�R�X�u���_\Ϳݚ�w�h��C���<�t�@M�N>P]Pܼ�[�b��-S�z���FN
�\f�0F�B���e�����ѴUX��_ͳ5v�"4[r�/*��29Hm��`@AD�l�]_����W�v��W.7T�j�
��E���O�����Vޏ�SH����T�٣?���o��4���J͙�j�ԧ��n&��f>i��H��
���Bl���z�G-�d��:̹ů6'6���.�K��;�I�]
�����a$A�ne�;�0�n����(�� -�7bd�]8��ɠ��N��E�㨃����kSy�{�ӾT��G(��*��}�C�����(ʏ˧�7�ST��	K���s��κ�+�!Q�[h�ƽ�M��-=�3䂿�-�����U"\)�Z{�YV�$�\�|�.I���N����Mˇ��T��؋��fc��������W\�˽"���?W�Q��G�r�#5�>�t�(�,dH@� �y�U��͟Q��gke_4�\��^;d�(��L�eqwbY�eu��&\,�'�:A�"À1=_:������[�**H�AO�<�A���q�Z0�J�?YC�4��S��rR@�S�������8��B� ��e��p2������
xl=7F�����
���������Z�΍9�����ϐҦ�ÿ� ,WkLF�t�ڷ�6�4Y񭢸�=,�T����
3��tM���p���^�)�nd����O�ë�\���j3Ar�L�>W)��Q,1x����`��ٌ��7f�%�6PiQ��
� �;�ϰ���Wk�������pkҙY�}�R�����������Yg)}ss�?��W��}���=o` ��J�#"(..+ѦV*O@��Uj~�<�5*i��pw{P<;�o�1�<�YDvĝ �Vy�	��sKH�֮?;ș��D�/>Ge=u����I�V��߄�Q��aBy#������
Q��ч�8L1�I6e����b���j�dw1]��rO�
5O 5�~Jex�d����:�	��ϊ����&/<�KX����
,1���b����
}����?d]m�n����֌^J���
s�/�u5��5�~%��>A�C�����o>�F����g�-U�(�����i��F�|[�����%��\{?U�Y/z%��b�dr��@!��ָ @�O�[H�=�<5���;	��qe()� ��f��9�>��\o�_���O�1H�-[%�+�W���N����?����Z�����`-�v&%/�"� hA��KĮ�5^�7��H�9GD(\"�C���Y�/
ZC]�
��4mh�˔}�S��Ս��+ow��ݾ�PB��E��z��85r��\,��-CL�M�{��U�xX��C��o���ș��2���<��ƃ���1.D�'`T*J�'���س{�#t�"/��܀=Å��`�ht'9:'��jdFb��/ 1���2=��8�ɇZ����#
`�^�pSh�9��H#x�(���b��4�*�O���/t;����
gCN�0�u`��35�����'7���d��f�[]
�nj��e��rL/g�7�k.���Je���(����oܤR�������;fJ��/}I�JD��
�.���4��}��ƿw�lw)�_��Ο�Ν��co��(V���_'�aĹ^tB�7��n��@8Ŋ��"R^j�,�J�/���l�E��Y@������7���M��G8a�S�Ұi�1�DC��}=�/a�i�s����3P����m)�����9܂ ��W�'�B�7uT~��Z{������]V�F-9�X�Y��
����B�
��؆%�����M�wzwT�k��yӢ�c�$��T�g���gd�XUZ)�B���Y�Z�^8�e#��0�ݱ�uYt0n��Q��ʾ
�p�{����1^���&�S=�,����H :	m�C�3`����I|�ܿ2�@4H}��
O�#��Y�]x��[�+�Լq�A�I��aJ�Ω
�@���k�Pڠ���d�|�$5Ҁ��2�ex��o���5�4)�_�w�7��r��.g��#',��n��)��dG>�-6�	�QK�&�)��އ�'�8��η.
-iJ�g�~�,0���?7�$�AF��rX�DI��4��2!zk��K ��
���;�w�@D[���v�����x�K�kC�
��i�����ɚ��ms-Ei�zE�ɮͷ�ms�ϐcFڅ�;��z뱨�I~]�<)��؆�k���p!��@�K+-�� ۨf��W�ל�Ǒ�N��U��t+�5(�� ������]�ʭ�z���ò2uc��q�K�e�5����hz�9{E`�\��LH��w"�b�Cږ��.��2pY�xy��P�Å����@��1�+�9��Fsp�.�%Ͼ�5v�_�i�i���:�G_=$�DX�)�v�x�V�����5IN{R��@��5Z ]?�Y�$�e,z�@��w�9e��M��P�6����L�E�]>nȼ�voOT��`��;��{1L��5v.�9���bm����S]�zϢ~XL�L� �
"�a���3L9�h| ��
�KJ�|K�o��e���
@�W�|��vF[�'��.4�SX�P���e{����lr����Kebt(#',�Da��*$&
[��'��q�SH�*q�
���U�� ��3��tΨ뼳^���7�ܢ��f��(V�
*��׮K�H�Og/T�7xx�޻'�٨�p�_�~�^�{]���U�O�=��j~�!�n�
����#m�n|"ݽ�$P�(#����c*+bN<��(��1ݦ�� ��y;1�Fo�z%
u�O���-�ڄ7��;5䎏��9%��#�/Y����y�0��u�uV���,?Lmh�Q���x*�����k��|R�.�l�s>�	?�Re����n]	�0���B�E�H�;�K�j���[M��aGx�H!J�o��|	��e	9�����@��t�HPX�`c�@�"�]���H�3���râ��؇��
�eB_�Y�����e���[�i�SȎ�h��kv�dq���^w�2DM^L��#��R��
K�krc����v�%���F	P�A+�/n#"Y�]�C�):�sB~��F�狭�W�G���|D�8N8[�DȲ#���m���v����yW
{%���f,�X&s8��
��Ƀ%��L��9���X�TFg��>䫪�H1���7��z���	�OUT�Jh�;_��]���mP6}T���,#UH�V����ͧ�+<o��4�9k�-�ʳ4������+�g����s��#X�뻡XcQG��YK�̎����+�?ՃeW��G�:�-$�����8�#\�W�(����P~�Dk���R��챁C}u�>�9\�o#MDVFG��W��(Yj��#S\h��T��0L��0��I%(@,��+�^�Fz�#� ��mPe�jY]�� MGb���z׊ x�����f�ܔ�����<�;Hi��RWN�
�p2��}�	R>���t��;����A�D��N��g���(dy��Q�cc�#K�(F�%E�yXԙ���v�Ǩ~��ٙ#s���h��Y���FӰND�/N���0��vU�4:<����V�@���z�}@+%;�	��!��{��c+���}��hv���wpL�T?Xz��A��~B�H�q
�����@Bؙ����@B�%4i}l���\���@�؎T�%���
�{Z��^��A�?���J��ɟj+w�����#I&���dhس�o�^ׇF��	��=�Om�O|��iH�V�O�v�V�E�1�a�+�	�O#��ui��E�e�U
���3ٝ�~��Y��Y��7zSm�c'Ɋ�3��&P��
5��x++��Ub��T
�-Y��D=K�����H�[���� ��#}`�A쁱z��a�z_q#��u��!`L��4����Y8�U����C>�W����ς:"�Ac������}b�8��'v�
�͹�.qEG�Z��	�
�p�Ĉ�md%�,z�Z�k
�V�շ�Z�ԸS�� �զy�஖X=Xy��c�W?[�\$=�/c��(^���!��܌L^�!��Y�pȹ��W� �v3�1H��+��H����S���_�3�.w[�!5��H�YJC� 7�!�ş��
ԧ{Բqr^���X��Y�8%�7�V��Y�@�{��.�c1NQ)ӑ��RV��1� Įz]�߲��%t�P�i�O��;��-�-꯳�|��}_�u�i�켅������0�U�|������;���EMd�F�
������|J=����,�4��V%��؃��W��#�*
/��k�6�K�\�L�ߕc� �%C�zؙÕ�Ά�IBe��-��uV<�b�]�
����YS����x����dω3	�uf$��	��	��kNz�H�������^8����4:�U���Yd�]�K]4�6�>�j5Z��Q ���f
��)[�ђъ��E���+2�w$��0U�-���z���
|a��f,�
� �X���,�d��9����h�I���]�q�@E3ا�尦��*8�1���#l��l�v d8���Rt�e1�3n�v˜W��\H?�p���P�G�� ��2^+�K���	u ��X�T^����Qw���{�F�Ee~F(�?���[�];�����x]����Imc�M1e��# �2��(K�.��ߊ+E��5��S56���μ�c��	{�\T}��\�t���楸�i�mi4��[1/�9.N������~=g�VV�h�a�{ZV��j2�>�Kk��&4��1���fm'�챾ı�<��7\JA�k��������4rR�K��__���5��8zr�֣�r |_��Q�R[c� �
m���� Ί���K� :�a�e%��wD`\��W9����ۂ}�5gWT�+=�V�pWgѤҠ�,D!qv����xYw�D?�N��i;��tT�BP�e�Lt����[km�� �f��MJ�����VX�MzV�m��\�ll��0�6���2�ʿ��¼M�ڌ�_j�~u��)D��:�<պ��!f��94"�ԅ$����xƶ^��7�Q�ZH���AE"��*�\��i��8���b��u8���2"�U`���dd��ʠ$bc��'�E��f�h��jX�D*/�L�P�%�����$Q��9	�/yAi脳smK��p�t�Q�:�&zT��f��d�e���Ů�<�S6�����5��f�u-�d=���^�v���E?��2�wI�(n�csQ�#�;���Շp(L��h� �X�iM���%�ݾ�»#Ոg'�Po��&H,>��gI5�ҒW#��eX~���2�y~�O�u�����*�4¢����	�Ƀ��tL��g���[�Ng.M5�+\�/�Jۯ�M�ͻ	�7O"���E��k1������ށ�x�T�\���^ ��
�5N�+6��3hj�+<�+���xh�Eľ�79��xڋm�I�2�fHT�"�y���+��[����]� ����B=u5y�=k���AS0��so�昇ҵUsA��
O�&��-%��KP�Ehҳ&%j�7h�#�<붴(R�o|+���Z�|�-����>��^��Bm��,�b�+-Ur��:.<Uf ύ���un|�=�����k��ɩ[,N]��R�	@�Q����K*�w5�F�ܓVS��.��5-����d���*��/��>�oUĲ�1�z���nTt�i?T7�:��q�
���?�.����$;�dry(������].}2���pv�n��_�Z�{���$��V�uV7��}D(�(k���m�8ò�|{�fk���׾���D�L
�D�Gy~��8�z��N��l|^ �>&vAi�M����`y��3���4��|��
�  ���|��c��I:\"�ۭ�j�nW�+]~��W:��_��pN��J��r�G�s�t��S�����&����c��5�hc��b���z`Y� �?��<��d����w{A\Q��J�94V&
�m��L���u�����n���}aO�I�� /����M����� �y�����͹�Q[
o���~���1��l�b�]�x�c���C?���]��iZ�T
,��Od���azZ5���"��c�g9��M�x7��[O.���vc����A\~�!~Z�"��Ռ���!�#�4!sPGέ(�\����H����P��a�`���AaT^�`Pc�G���{ �����[A i��u�1$5�x�1s0@̻��Y���0&�gDǠ�M�PT���!�K�X2�!��y�E�^)� |��-��w/�K	)%0���
@P�#�j�ؗ��0��l��� �z�uΙD� V��xJH[?�Une8�ԯ)�������Ԇ"���qO '�TI���kaM;GU<�!�0��|k|��r�k
��7Y�j>�8o��~�}<!���\����P	�ZG���������%�h��� ����3��0A�:?F)��GF��EH�k{ٙ��сoС���� ���"&�d��lԂ�[P�N���Q;[�d��{�ئ�N�E�W�ϵ�(`�U���E�վ/����2ח��B������fI��ڴ��
�'[[B*����y���싸��$�Vh�K��G�����"�D���H�N郖^�k��_G
�f(�F9�Z��KA^��~Pc�L=�jo�_ѹIe��C��.�k�M�1� \U�kzW���a�b!h��l�B��������c:��c6�Qds�����S��k�xQ�pXy����!�� �
Г���t�|L#~\n�ٔ�y,֝m��+uܗ!�x2�<M롗�8�;->4���7"�*(+ʬ2���')��E��π�=g�m�WUi\�޷��"#������(t�~�'B���M�QR�'��$�W�y�M)m�x�߽Ii��� _�YQy^}{p?R"}x74R6ȳ)^M9���4�^�\"E4��[��6s`
BqeX���A���}-�jTC�X%Sۑm�=f1񿦸�Z�	%�tB���0/�nB�a,��n@���|��T�
-Y��]B�o$=k��f�����OARm�� ��-簾�3Q~s���/����v��	38��ԹU����Ǉ}=�ّ����a�U���M��i*(�^�Ūm"����nd�O�Iՠ�yG1�6���dʩ����?ߩ��ɸ�_�	�I�T��<Y��+�����<�2K�,�)�,�
�֐V�֧Fʬ�����x����֡�2���Zp�
k��~7V��E�=����ֽ,��j��p���?~����ٴA�wC�Y�$6�����M%��[�N�(�K���gCc��q<M��X���w��u�I���.+A���\�6�2�@zg	�gU5�yR쭠���f��X܉`h{VY�h�V�9��F+�z���~����֟�NÄh-�kF��W�{K����ʯ�'�3Ѩ�[NP: ����BU�����b��lԌ������τUz�p�:7Fw�%Ra(q��Z˧�E,B	�ПI�&�&�� �tU��.�q>�1wm�Z�e��kaW21%	zd�7E{!숤U���$B%s���@4X.�oV
�ڙ�#B~�"a�U$��U/��d��V�����؝�_yZg�mYs{�z"6&���/� ���91��)/؋9��O)lK^��m�����.P�ܺg��P�'ru*�J��ϓ�Mv �v�Vsz�'|�ɆM��
\��f��v�;��I�U*�C���(.ja3������:�_����%����[ߴ��8 5�zuI�r1}s[=ﶃ���ttQo[Aރ��#� �:�8�/�=^���5��n�н��:u���4?hs�L.bLY=Z6��ٹps&�I3O����Rr�\ ���	zߘg��O�1�+�� ����s�qUq��+���4�EY�)��	��(Iw��PO9F/�̯2K�Bl��C1��UZ�fhN2��u����EsX�vጛS5š>6`и��-px�>7��ѢH�6��h��%�v���67�Bc�ـ$X6ိ0���>JeB��n�!4Z�O>dM�8n�C���)<��#��Qb`@��9����|�q�/���e��R^!�V�WE@$4k	(�k{��f9���Q�J�(�#F_)F}�I#$UBl�!s��vv@W=bc��<���ws+�M��7��N�a_�C���L�0����с���Y�(E
�c\���X@�����s����(Y:D�_�
zϝi�c3/2�@H^8�O��w&g��r:w�V�yL>{B��7^_�x���15�`O�[�Y�̀�ɐ`P{m�7
ZeL�jݺ�0�҉޲�*�,�=8)b��a>����(UJ�s�*�˹0_l�|�))�"����`�`�
����=���z$���5:�.!$+)~s�,�z�	ҷ*�^�M$��������>��r2m�* �<��`���9�����7��$�`
��Cack,�H�kv��B�4,���`��֓�	�E���V9��{�����`�@�1�����O�B��q8�	� �k#��Xϱ��+v�̛��EА��ʄ�{��jGP�c�4QU��_V����?����v��%M�5���()��v7X��)��f�:�	�΢��(%£��=C��Mgc���X���at{�Ԋ����n���ŷ�K�>�9�$�`��m�ATKZ�
T��m	bv�w�ѥs-B?9�*�����Y*E�,~P6%%w�f�w]Z����\
ҸLK�X�"W?'�v}ԒA�TKH]��ej�ю��	�dJ���k�7��>����ݝ$h��i��d(Z<���@��-������C=&�.���6!���ZE��Z}��
��Z���g_?�?�)�jL6�W��U�[�g�zb���� �8fQ����ہG��e��c,
��e��x��L���\�8�'�vp#���o乧I�o��X���%�Vg,Gn6b�^-��"�>�����޻���YB�y���I����  @������O
����69ꄾꅢ����*;3WT�!-�5� D�M	�H2��x��W[��!���ݛN�Q�|4��~�<���|\�p�?ZN;F�՜ ��6��ׅT���: ���rP���f�6���#S.i�=M���x�ӣ�S# ����k��7p3gH��;ҿ(��Q�L�r��5��i\�eO��*z</����ZP���6���w�����^�=8^�a(�U<F��K��#���}�{Z��ľbD3��jPX�pme�F�e��A��9�D#Tb��˗1<�c�}<W��L�:�P�s0k�lɱ �,�&$�ᲇ�b�^yS�H.�F�^�.��Nف-z�x����*���ufa�oz�� �Cwl��A���p��J[9׼ �C�Bl�*}��F�0�ÝVC�����t�x�+�%cRR��W
�we�+F�-rE��KR٫��	��=�L��.�ï}���%U[剮�Ȉ+;�ӎN���/8z! �������C ��wa�\]iA���Z����r�Ќ�Sf�SM��Z��$o�@a�.���sxV���=`�mT=�����_�1�9S�FkI1�=���q"ȇ�~�w��윙����1�aQ�ϊqE���
5:^@��j�/d:�& ~�)#t�� ��%@�1vI�[N��`5�����_�;��'��i�-a�o���`cc	�ad�-��٣ڞ��#�|���6�)�_��وf>�Ev-��l�'�
�i�ܑ4c���4�U%���� ���=��,Fgf%�QV3&A�n�fn��!���xN�7��g�|<���*@%X4�(�w��]z��7�}��<�<�[BCHk���M��u3��	m�̜=����5�V�"�D��c��0�ú�5�jWв,�\6�c	-���?'��Te'ɉ�yQ�W-՘����_%r7vet�LV�?�(�@	� c�ȫ	�r�m��i`h平�ܲy�R�Nr��sC��;a��\�іg��K���~6���`��ni�@�耷�B�M�^�V�Uth!�a�
rP��U,�Տs���w�����R3Z)m%r&2��M�p�O'�f�KԄ�2���!�2�bmsU����K�^T�f�׺V�g"�	r�T6l'?x��� �,��Ux�(�B�(�yQ~l�gi�dˏ��=	fK�XG�m*[i/��r �J���v縑�0�kO���� ��4:�`�cq�"�(
Tr? ��ĚK�dv����V[Ё߰�VE�wC01�]xZ���N���������إP��lʊ� d�h�������ϸ�G�u#޾e.�,�9r�ؾ<
�>e5��{�k⇥(��F���j}�yϯ-J�xW��3�E�\%�+Hlɶz?�h���K ��Yz)^	|k�(��M�������z������M�]NtiҘ�z�3DA�D�-��ƛ��|Vj@��F�H�!�a����ӕ@���8z����3��N�0e�C$� ���*��4�A�Gc5Z���e�o�}���&��A;���E|��5ɠ�!S��`���+���.C�;��Y�$�)T��b��O4���*MΤ��7�C7`��G���q�	�NX�ƅ-?ͳ�A`��Xp~�K��@	�M����2���d��v�%��������[c���B,��������M*��;�9��_y�Qs�\�d0�i5�ޮ\e��Ed��gS`oi�8v{*��J�lZQR�f�;͖����bF�����ia��́�Q �*On���i����g	y>����EE��hG ɡ���7��Vu=@�m�9@i�d��e�9\i��6Tj^ɜ %�e_���N՟yP>d%�\��x�8}����JKI�|�3�R����awf�����̕���y��d���(:�=��Ƶ�.,eȥC
��7u�=A)I��L���<{�O�@lFo�������uQ�]N���[� Q�4�q+;=`����K�3�9��Y(���$m�c��/ֳ�ƧqUA�.di�ÑH5�{*r�{;ga@�Ǚd�:�LS�[��\֥S�
����b\����ݍII�ɀ��[0��c=_�b��w��z߾)��U*mThjX��{��;������I�����9�7CK�%�3��W��V�����[j/ye椾�ǁ.����i^V�7�H�,��_�^bR���C����Fp�78�}xY��<W����:z�@a���� ���#�l%�s�����L��M�Y�\�C6�r(as��ف����\@q���}����~a�Q�Kv���溳s[iLE�ou�n�uX���YV�#��L�!�4��
��6�A�he�ذ�W ��Y��%Y���$��p~�ZR�7�/�XM������Z\�8F�5��D�m̮b�M:�u�6Ύ�|�
h���J!�� �B ���1^����6���A�/����b���M�m���lt��� :��2GC���^�Kfl�i� u��i�Ƅ?���o��rdm���{�p9��_3�?�1pGe-��6p����MF�$#�Uآ���|7��f���T���֠�9b:3W.j��U���%����q�{Z�iΟ�
����n�m+���1/�����Q�Y~=�B���v?�`�>0�{�m,ρ�6�#����k���2��C���B�占(�u���&��_�,�8�a�|������q�����Ee\(�iN��rg	Y��2�Twd
u�d��qr�>�4Ʊ����j��u
j���dצ�A�X�t+%o��j��a��myP�12��N�4���A ��ݑ�'�ّ�D�\͸�Π�ì�ּ:�9��8&Ҁ��6�׾�S��E\2a$@�e�A�ء���R�8�";��uNŎi��_�r��	 h�ۄ�,GS�Zu�,���/%H
���R!�)5+토L�ׅ������)�[�
w��"*�S�!�Yb���� �C @�*�<�j>���[)50KD/����7�hOꈀ����;�Wߪ���Eۖ��\�FV����C�m�o�:���&�n��������W���a޲�4�Q����hXK�4�o��8�]��K�j�k��Σ�]ȣm������A���� ƾ�&���?m;zDﯺ�pl���`����Η 9��b�A�2�)�$X�a�:6qt]*�iK
��b������讳<�}eI�b�>�jd���4��"e4{�KP�j]f۠�Y5!���JKa���!�E�ܶ#�������}uڤӴ�Xw:��ū��8��}�>:9�������y�Q�����pI��	/���=��ϸ��h����|G��27�
A'��Y}z8��T�E0R���O�Ћ#r��Zu&������;R���|s���E�A}�ZۦyK{:��[��1�{1�TR<Z�>�k��X!���,�)�8�/��Z�?߅���U(�/��[7 �G�]T?�����EP�+o��s7<\�,;Jٌ�Ѽm�!���p�q*G
�����<V�� գ.�_�O�'��3�T�]I֐��>'K�Ht/a�^,)��ǋK���J�@s�
�5�"���A_��[���n�ЄÅC�w@|�(E���E3�9�fϒQ�h�R?hv@��� v�0�|z~�H�EP<�l9�-p��!��
����~g��ZF��qR�kjH��%���I�@Ib��.U�$�Ds,�E	�J�C�rq�I���pX_��H�.T���;�]���4P����m�m;��c�uH�0+��8�u����X�C������K���_nF��դJ$X*�2�_&+��ưw7`���X]6��`ݍ���� �;A���q3�16�醳H��aS�*W�6&�L������	�%:��lB���5��&d]�����C��%���-
�2��0Y���0y-u���M��jyL�x�wZ��E��[RR"o����ژ��Ӂ���=c��)�Β��J��P?<=���}�ݷ+Gb$ux�� �h!��m9D!8�gW�����������t�k#v�3�,�fN��
4s(wc�X��v���)C

�J�S�5���1�+LY30/����3/�d֭�?�'k����Ǘ��n��2`�Ozh�v�#	���O�z�l�D%m9.���38����G+0�ߟ�<���Y>�w.7�6�N�Xx��z 烽��(qB"�X�|�ߞb��R�����"�9�]|q�SRd��5F�F
D���4�:����v��E�i�G�`~`Tܹ�34a���_���!!�)�Yr�՞C��-R�>����#O�<�Z��5]��ͧ7Sv�ic��1�=�$���Ҟ�z�c�����es+�wd������n���M�f�n�� �F7=�b ���!��3���C�����#��>�z�P��I�R|�nD�~e<D��&e���Q�a�d����i	�F7����RХ�B�(�2d :����]�{�ss�Xp`����`�DB�-��k�}˄�{��y^@K��S��6�EX���o�҈���^+����ґV
�|�����8k�?w�Be1`#�ap�^�.���~qQ�K��[��	6E�����+����Hg��䉕"��]$I"��Yҳ�g���M���{�J��~��֯n��	���2DC�4?m�{���oY�J�Û'n��ò9��1�%��*��'tdh�>M�a8�)RsRf�9�n�=�V��{�F�zJՉ�dEq����%'7]�9C0n�Ub��j�	���{����6�E	-�R�s}֧!�\Y�Ə�w�v�3��~Q�Q���W(���zSP��DO��3�p�a9u$S2��@##�9d�]�$^�]��[!���D'au=ܕA�"�L(�+,1,|7�����=���;ϔ(K]&�aK�KcӃ�ϴ���F�ɒ.I�N�G�7fB4�F�P�ɢ�~�$�g�ͮ��I�ZJk)���S{{wZ����/O��s�6�� b]B���D����C"XW�ƞ�g�+��n���c����k=[�4��6!���ǭ�i�����eV
��C��[llQ������"�<��S@�Co�
`3���HXx^=�>���� 4 ���_K��hC#(2Ȉ�۷Ϸ$W�_g*��:}�ұd�x����E�j�*тJ��l� 9Em(̈��(�ۜB3"�9>�K�r9,Uv^+��*߲AQ�+�e\
%؄�u&�ʊL]��`�2\������A�mG��|X4�nT�(�VqGܪ� <�'��>�IM��:5Y���b�g>�̮���C�7��2�n�E���L��w}%<�7�Ĭە��/�6&�+��]�
S���Sx��ӽQ�S�^I�\`$����1�O#}�����}�ƴ��W���[3�/�q�I���`]$����<�w�>�jm��d���Kx$�2�������k�)�m������^ﺱʼi+qw�M�& j�\�y���3���E�:Ƨwj#�1��:HjTu�pEȢ��)��
���8�r �Ar���;᭱��� 4.F�M�H��!e���Jgt�U��O���ϬCL0��g8��S��V���B�=�]�X*�մCw�L�Y��l�l��m������
O�k}<蕌�Y�6�~�o[S1^�	�!��C�e/���b谹[���U�k��ĺT��	��"Ϛ3�m3�4�����$%�!��ٸȯ���X��?���/,�w��Ӝ�CY�g�kU-�B`�hZ�NtJ���<o<�^k֍�N�+m���Z��[z����6�vW�Bm���UP�����W�k��]S#l��|a��/�wD����/����*{Z\{
�¾��I2�	7�9�����>`򤸾*u�5����SCq2�����{�T����L�+$n��f�n|��Oj6����,c�\��:?��v��#M����b3��f��C�A���~%���ixk�nC;�dA�$<��.����~Zr�Rnp2h��S���f�\e�V5��"�H?��"�%qg�a K*	/S�JS������I&�wh	�~6�����=��4h��L.��|?8�,/�L�SL�7�o�s�!G6N�r�"�W2����L�-���ʉ�e������t��=��K|d$��,�~Z��~�*���mtV�C��83K2Tͤ�'�Gq��i�N6k�7����\Zt���y�')�c�}�
��G�W.��m��XO�)O�훌�:��?�T�zQ���R�y��Ϫ���{3��z�����`O	� ~�X/mǏyP]}�)��B���q��r:�񂛩?@ǿ��~����*�W��ǭ���iaI�mHB[�U��+��c3?����i�$f���
�z���~N�$2���<�����r�q)���f�x_kC���4*Ճ�_��6'^(��Hu[�-聘Q�]��w��+5�������
�31B��1�~%����R~IҴ��O�����%/��残�\���P9����9��_v��Iq��\�?��'.�يH��G?�X=�|c�W�m#���@���9z����<�VW]�?:j1� R����<����Ó]��Yצ���֘�!n��
�G1o	�r����ʈV�0��<�N�亪M!�v�eu
�ViEe��T7ʍ2
���bR�*e<Q���.��v��Asr��J	f5�m����S�imn걪"d� u��.�9J9�gŽ�ݩ-�P�:�4z�ix�>U+5��s
8��U����������a��8sύv�
�
p��gjU�&Ώ��2��[��*_w&�|c~�c_7'���Q�Y���Yj�(c������@iA��yp		'�2�k����"�w��(ʒ�U�{d�_c�ct�K���R	�.�u���>��ݫz>	_���^�E�՗-��4"n��U%��-��P]�������	c��6���{�]r�VЃB��]'�މ�����(O'-Њ���c��C�s���?�*%��eYj ��c^=W�[P���ϙ������Z����[+�D�uOvI�8�u�Kݠ�O/-t���~�W0]�]������{m�v�!�]r�?����z7�����!!�P�\�P[�cY U��pr���$�taP}Q=7��rK���P�`� �Ř3�s@a�%��t@�F#b���㘬�՟ES�aI�H������d��O5�@ut⼘����_����׳4�ؐ؊sp�fs}���Kr�.�'��
��m*���-.��؉'��"	A��p\��v9�G�/�j���a9Pe��̫k0�Y�ǹ�JeH|���Mi&���-��4�c["�~�����ð%��R%���BV�*{�����{l�8;�j'�t��΢WG��y��$�E��Ӗ?�
 �-�,44ϴa��n�F���gwCQQ���i딌'��(l�B!�����3�f�Wr��w�U���X�3��,ke���3@aԾ ��)���/���ΐ\�xm�C��~Ϩ�sO���yK#w8�h����SM�r���K-�gp�Wzo4À}���?ݨ�Tu �����&sFCk���ݘ@�5�o��\�({<���8��B��s��=��U�0�?$|��i����y�Y�I�?;��e@��J�2�]vDzs$v��ۊ�vn
S콮=�c����]e:Ϭ�:6%�QH�1��q��?.nSӧ��^bR> o�ki�YfTK�CPڳe�ܮ0�Vm�i-�X���J'q��XD�C��.��w������rYk3�ɟ��I�T��&h���G�Ƥ�/���<�s,o�I����q@c	6����IU�qX�n�nr���B(VF�E����`RH�L�s�8?)��e�'�َkrQ���1UT_���*yC�5�z���2�F޾r�z)$�1w&��
����\y5�kE���eѮ��J4���t�8N�{�%JF�ݞ��/�%NO�DF�1H?V����*B���1�!�h�c ��R�+|g�-q��wN��Z����+�������@��!�4�f�i����{���S�1�"{wj&z�JJ�y0�-�����`�<���^4������64��+IJ�&R��@�Cv���e�a3
s�`*!o9�8#��wv���o���������	!�ޚ�p�,}�U����e�34;G�`��,�k�oUʟoQ�g�1K77���� ��
�WBP	0��lJ��0 rHBY��f��!����L��Z��-�[l7�F'�R��ѻ�X��yM�DA�v������h����X��%T�6'i�5���[*��s���J@�ڭgˌ�l$IdvX��:.�?T	��@'2y�1��T����fIq�
��v}Az�wM�N�4��M�L���3Y�%�R�F��N��%P'ײ�g��H�!CD[��،^��p�����>q:i�/�`�a��^��C�30~�Ts��CY��a���*�"I�]�x��$&$�q�<�ǲq���ɏP5<�Nr5��Q�~KabR�y��Z�q�E��j�D�fb!OZ��Fң,��e��GS*O��lj[x�g/�6'�h/q��R���XP��{�P��H���8�.3�;3��Ix�=��KQHOL?m�:`Q�����0ῩZ�^���_�ʽ���w�z���k�gV!���n�XC<U��Ƨ!$�ٔ=�<�F9r=�ӻf4_�,��]�hG��*A�����Si,�.����	2���%<�½7������O�D�L|�(�j̱���r�����&C��x�]�XJ�;��m����)6��7�8�i�: b�$2x���r#�FM������B�����M|(���q$
��ߞ/F4z	؞yT�u��GIz���7|m�c��9�T����3�nJ�'	ʃ�X���#l:��2Qt���mD�d�o������p� %d��]���B<�a�4�82}��I^튡�� L���.��^и�OF%[X���Ǹ�٩�:�
M5f{��I�K�n��lޮ�%��<��j��ə�/�Oî�Z���>�:��/g�Ł��?�^����t}]%n1�����֣�%c���e@�ወ�a�{��UiY4�g��=������~�ė�}���Lސ��f*ϋ$��s�	{�x��^�-�$��H�@{�ڈ����/
��R���|�F~u��譖��)�K�N����ԏ�.ߑ#�^���U����?��k�l�y�TO��e�K�n�H���7!�T��̈�V�	�o)a�q�|�H?nNTCL8Q�c����B>O�;`������Q��erI\3�B��Ɩ{�q�u����T�6ը�$ʙG�U?����&�˚�&��	? l8�T
=}�L��AV=��I�4}c�L���M��w\��R��"��yYE�ڟ��c��LA�� �/�ZVtq�pˬ9郃���O�Snו<���i�2�ӷq$�b�s �O�Qnz���b LU-	�S�,4��E��
�j�η�>l
ƭ��.��C~�W/��fY�k�*�d~G�����%��L�v�22)7�Y���'��%}e�����c��}���e�v��G|`�8���R�c§�d�m�_Ƨk�"󂺷'�]E$d�⊁��"fP��a��
�6!���D=Z�ƥ��+���Q������b�{Z��!�q��:��eϧ��<�O�غ�qe�r`ҳ֬�
-�{�ؽ�Wf�H|�?s��K�;�â�C-	��gJ�C�O�o)lDɘ���8���xӜH���H=F
%��o�A�]�i�U�3��x�IRaxl���em�'��5��z��l���Ҵ�P+9љ[�zY^�������z?�m�gG�e][>t�E�"[}�L�h�4��X�RM�e�܍A��� �#�o�'X�k�W�=?l?������ٜP
���Nt����-uq��
�;�CAf��ٻΈ��S��
�$I j�wNw'�>�?�?4ߦ�[����Np����4X�*j����1r�
��8X�ݨ\4^4��x�Hz�9[�T��nN�(F��ݕGڡ�����S����[��8� `�Q>%B�*b�9�F]ґ�,����Sp4K�!�]����#�(��R�$?�烒^\��xB�,���(���#9��i��Ei.��d|6�l5��ű����t/�
?��к��IhH�a�L������g����V�ܹ�tЛ�LJ#�|��g�>�٩���$p��W5�ZԾ[C��|*.���'aLd�۫dx5�).��"��i�!�א\���O���������%�:˖#�7������\�hu�މal��18#��!>�`@�+CT�0�ЊMe�L�~�K���
����߳}��C)8L"ݞ�NfwT���cw�`�y��G�Z����pK�[�%ٯ6��	Gn4Qx$��C�ui ��d��tXA�#щ
���)]S�)!���հfm�S����jVY��V����2~�Ҷ��;^���vFmf~w���G��{�Z�:m�j�EJ[kŧr���2	''C��	�Ҩ�4~!�9�_TsU1�O�Į
�nd[�:�3��r�'�Xv8eg�G�%7����$6�(*'���s�]���:��b`����a��8�A�J�,ku��tjii�u�;��q�R��Dsa�Z��m��
�����k(9Nbe(V��1���zfi��|X����:z������#vPВk-Z��q-��m�����ẳЍ/��o�d��v�g h�y����(S<�� �43������a��jC�L���^&Ýy���+}s�a�W�fўT�z�m�n�h� ��1�Ta���m@.)�(A��,��#w��Ժ��nH������KLl��q�fe@ަk-�4�!�����H�	�jVg�Q��8h�C����`IS���,�2g���>]�NT�[ߒ
�mX#(���{8�:)�7jj�Q�.�+������������ޝC�
z�f�R��lO�=�Z0�ٍ.�4��B3F�RL�~j߱��J�?����C2u��8_Iʼ��WFCC�#k�CK�BuzhhNə�
������ /Y�|y��Mԡ�k�WD��a�F�z��b��7�um`���������J���."nSm;���Л��h�a�݂���6�������f�h
]Ӷ�e��$��`� ��k&�| �
"*�i"�s�F
+d����R�
|a	�`t���N,QvhH���]���s�[k�����>�,�0�e"� �4�"F���$���ǆ�X�p���'�,x8,pu���ԝx��9���_)���2A	(�W��jL/���O���s��y.!��2RSPg��Z�,��"h���ʹC�K�A�~o�S�,7ۻj&GA_w��B~\p�'�z�����y2�v���0���2����]��6	|v�B�wP8���S!�V$�
u��t�R~�[���Z�<�D�s���^�1����m�����@�H�!���U]��/#�2a9 }�Ǩ<��"�����0C�?�$ђ�Oc�9M��8F�B����lj����ޏ/�R�u�;y�9z������c}`��g��7��S���7Bٖ7�nbC]1ֵ;�Go]�X�}���QL��G���εuA�����Ɉ��4m�� A��O�t��kn�@Fv�����f��>_S@�*��S�W	V�I��Ԥ�~��V�S����?^�Mg�~��ωl[,���r&Y�I�%�"_{1$RH5���ۣ6W.��W�:��n3+���M�!!��ī� 8�o&��,.�����h̵���eD���*�����X�}ᯈ��^���㠞����5R�;���]E^D�Z�2�֛ΰ��3�A�<�x~_ʹ�:G�2+9�\g)݊f���
�98�h�,'P1nxۨ�����^���t�q�^�!֔7a� lBtt)6���i{��"���7�ۄ���d�����pl��� )Sb䇝�2�ͬ�k�0ټ�4�:��5~9�|gB�R
}oRt�EC���S����ɾe�2Ӿ���{��N-�0r�iWT@�������fR!�6x{�;t��^�AWZ�(��M[��ꈫ�N�����<�/�B5�7��vK��ahf�w��xOy]X�?�k���x����L,E ���qM��e�L0� �Bʽt����S#��Y��C;�p��Q
�;����rdMZ�6��H������6� s���X�%���|�����l=��l��&�H���l+eE�!��p��|�4
Jz	���6<ߜ�(|���F���J��P��FH�ɮ�R������I�)���1�Fөc�L�φ�0�U�DYuy�rk
���lo����Rn�|9t�8WT3}�^�"���*��X#�f%��u��������*���F*�A)�5�s!C@�e���9�����qE�!��r]���]�l-�P���
셧�� []\�e`3o/cy�����k�o���2m1v2�yY�M]<@֌�u��}r��K�5�R=r&�+�������pO�����UbJݡ1_0��w�(&2�G��9]�U�c�=h�S_����4pm,
�4�� ��Ͽ!�@��<���?�����1��"���4��� ��,[�x�	�N��B*[�F>gu�=�RAb��r*V�J[�3�����	���o���� �O#Fp�][��S5���S�;%������݂|s�s�<q���F���E	6�+��&"���U�]�Li�_�lT��>|*����,_6F��m��\.%�)��j�*V&����GE֜�2� n���
��fQ��M�B����XP�_Ju��l�6��	?���"[�����+�t6��O���,6N��@:�r�Fq�[���_�����xb�
h�;���ʨ���h�>�<a&H܏�#;��;Qˁwl��?��;�� �RSPX�>�^dS0Iz"��@�V��~)�:�����ߐ�6��4��̮�@���ۛ|��4S�mm�� �E�<	��w2tzi��M
��9�q��]	9���v�\�D�Y |�O�/z⢮�D�G��S��l]:�[DT܃�M��	LZb{2���<_|[���g}M#�g��%{�_�og�h�v��&����>����@�|b��]�����O����#�uC�x��˴���6	 �u嵀��=h����ͅ��6Y�
����v�=�<d6i��?&��b�N�c�lhf�'���ͮ�_j��H�s6�̛�	y�L&�E�p£�3lT������-�%z��R+-�@`�A��엫��ס
E���}�)H�t����7�U�j�
��)�*�ih/�E��)g؅r6��i�������$&�=��|)�-�V�K���\`�(��TE���uϫV�1`bd踶sl�H>����4Jh:������j!=�L]�8r&�׷����4 �sҤ�C�$�mo�&�/XU8��v�B��j{<y)p�i��l�r�q� 4߈.-�T�~ל����0)*����vM���r�������tס�3�u=�b���3-B(��}>�5��BJ�5�+HjA���7iٍ�Z,�����!����(�5.�绢c�Ul�����ᑈ�	M��9���z	�Q�p���?X�|�CK��*U��T�\�lc�'��W�M\Lb;��a(Y�$R�4;qU�-�?\5��+��|Y���Q�@]b���G�n��u��}Ps��6����̺�m��z�ڿj@�=#�Rߚ"�c2��h�>󗜥6|A��-��wY�#�wK2"�+�{-�H��8�b��c7�[}J�筭������<�\��އ�a�O�D<(��0��o�N�d!L�$�Lk�����^Za�Xl
k���4�v ���ui��8��UL�dlHL���
��L�#��`�Cok�s,�9�c �K����GM3P΢x��4t�<T|qyj��k�������i��O�n�e�* �;/�_���n\�2x�|��j��#9��w�[9Ix$��
�:pfj���q���+l8��Q��l;����&	glK�U3���g��L�pOR�}(7��Xߘ�(����1�k3xM������x��A_�F@c�y�;��8�삵[��u�+�]�u4a��?�o)�e
΢�plB�1>��!�N�(�� ��^�5��S�t��U�,�Hrz�H:oS�Ⲅ��m�#��r�zNV>O)u�s�wZ2��
������^|8��CXޒ��x�'��RI�@��fJU;%����k\�����Ĺ�+�<B��~�!�:�H@u�Fuw%9�娼!w�(�
>�b}��'�����zr6C������3��	x��d�
AL��_r�l�P���_i�఍�z!Kl5��Di��isL�)�.�����A���T�c��`�N |t�r�{D���*�򮘵/����u�VE�u�ᰅ��)���W�tk��������g�2a��c۴����r�=�$lI��
o8._��u�S\'�|&u�BQ���_
M8����Fjp��"�0�������]���n�jE��L��Qv�d�
h��n�ʓ���_��c��0�l�V̒]�O�г��v����r����p���"���E0�`+�&���m��#E
�0�"�����\���|C� P��霮�Zr��W|��R%*�����).f��1[⟦��?�L�]��픸��x�JJ:}T�����/� N��6��s�Ҩ�^4=ܮ��p�X~
D�0{��T��$P��gY�#��)C]���[�Q�"/�@b�C�SؼSuϹC?�������/���:��,���^ �r��X�o����e'g�:��Q��z��R���Pn�fʑ�@��}�<��dN~����="�����S����xw�1�������,��4V�����e����̯�{��-����t�/3I �M����y�M*�R2{�V�Al��*]��S
&]	��l�6i��d��{���̈U�A8aɼ/U_��%d��i5����2���#,b�I��,�r �LP#��� ��o+���T˼2rfdd���M{�l�X��+:¥��He��L}�yd�cՁ	��&��g�d��/q�b�P���=^�ݣ�u�$�E�Q�a��Îor����� �����ST��4�`;H�6����L���uڅZ��I�&��PL�k�0X��{����Y �ȟ�;�&v��5	����_�&�
�T�f%���;�N�r�G�m�^�g��k�N�zW���d�N4�) ]�@��KӬ����n='�}��ilƋZ���-?�;ͪ��m`��d-���*�\���O�ڵ$o�����B�4�J��l��o �jd�\&�!�����uR��
οN��_�wŊ{]���4lg�H�*��#?�, ���"�2�(K�_$Ӊ����f�����P5�AN�ܛz�4�6�<�%����+eR� <M��J�B#��\�#T�	S��vi,4��[j���`R}!3��Ȅ�f�}5y[R+5ew�X�;TU�¤�����5�Fvc$�:1b`�~n��%D�R�GId�x%�B���~��Kɶ��!����M�Ā�<kލ"�w���dCz���x�C� g����w^"��}c\S�q�9I)	�i?(��;n	���2���{
�A�
��]�c��DmW�3�:W����~��	�Gg���V@+#ʟ�g��"��o������Ǳ0L"�#�}��1�������=h�u7�fx'�Zt��<ow2j�M[G�D����	���w��n��
�/]LzV�/�+O#����6ăf�*�^I��7��g�)Il�/�7��N�+Y�)�E u��F^���&��=�1P�{q�ս�ƚ����Wm���\gׂ跖�_Ѕ�\��������k�r6JF��*\�r$�K��n�
���>_6���yHuÝ@�C
�A�S���4��FS7j�y�:�{�V�S��{�l�s��ƣ�MM�L�2-
6c'5���j5��$@�}�Ez�ȥT�K	�t?D���e8�v��G���""Z*I=)�q�`Qu��>!��	�'HGS{�tt�����]���������.w�AE�sa��8h4'	&	crd���fh*���Gx]�y��vE|�MLt����#�y�?'R�j��ݍ��W�C@���bNS)��g�Nӻ��ί'��snP$�c<i���Zϡ����	�0l�RG+]F��<�Ip�6�%��A2��$�[�� ��M7�#���o <t��Ų��:fZ��o`�_3��6�N�խs�t�����6�Q���5��1��IDǌ[��V[�{R�Sx��V5�r��|�q4Ȑ�|5���K=m��zX��4�Gj`�Q�2��R��W?�� L#ݦbw��~� ڗt���0��~���g�9������zs.��لB�U+"H��OI��0���rG����t��W��ӆ�����QK2@��M5:�M�ɶ�+�#IG�����4G�./Y����56U���U�
^�o)4���@p�]��eƹ\�i�9���e\���4w��`ॊ��)��Ǆp[�F�SP�߫�+h�F�gT�9 ���C���!�CiDl�R�J�<��"��2_2�֎�	�I��w�΢��5�5��s��ڣ>�@��ӡ����� �F�
�q�HS��
.N�L��=R�qI����p�,ӽC9_����_��+�(�C[T�6؍c� �Rp.t���[S^Ğ�W�L�{�N���|xb�t�������f�сJ�f��4�/~x�1�.��9
=��R���,�	~�&��CUeZ[:�l�K��P�fK
R+�q��Қ��ܮ���\V��+��H[Qw�����YI��P�p4^ P2(��tQ�\��,�z��-��v�����x}M//���!y41O����?cN5W1--�8[Я%$��͉���ͮ��!�ʔּ�)ek�qs@eB2a����j^�~S's��KR�o�߄���/n�ѝ�8{��?¦ݳ�7����[�v���\͛��w��5ү��?��y��t#Pm*K�~<L��%�E@� ���}�M�(�'��N���ɧ+e�vMa��E��ڤ�6��(�1���DJ{*^m`�ǖ`��1�H�����9!�I6	��6T��O��,Zz#�4��F&�z��na�"�ڱrfL3�$�X�o�y�'_*�u�����
�k�_�w��\�Y� 9<��nߖ��?L��up����q	���n�.��M
�\����cM�<��s�"��b�n�q�tld��~�wNz@ه���.��q��V�O.ӝ�)ZġJ�8Ɉ'M)���7A�����҂&�p�dPAge=zأI������Τ���eKB�9��;����L���Ēm�x����46&rg
!�^�tu�\2�	�?����i�5����0l:�k-׺��`~�� ��N����I�)��;B'�Dt}�v{��ç,��{<���, ���i�r5��`�#G� 0��9�o��,쩊1������_!�W�qDj����I���T�n�wi�MX���!�(JQ*%�G
ޙ{ɪ�:q>[Cn�Yo�Z�Ie7��K�ఌ����{���<Ջ��D�?܈㩬�Ai��>@�	^�v4Pn�u��ЌUD;_�F~?EK����]s���2V,�WW�LL����?��?&���\�޴G�7Ow�Q�}J�q�1���I��ہ�Vz�Rv/&��+�6��*��%R�Nck��xB��#[m�]_�ј3C=P5Ȉ�[�{!l:�Yj#~]�\��i
�L2����+�
_ŷ�� g�)�&謖��<��M���L$Yp�Ve�0����`���h���Pm��_
ha �a�?�W�
��,Cjf�� ΌJ�ـ����Y)"
&��ՅY��Siv)a&�t��NS��t�8�gPŵd�UT�>�g+E`r�� (�_�w/���ސ��QFr����G+}3�,/�Mո�f7��d�Z�'��>øF�C�pWI�=\SǢ(���M_cࠛ��g�\Z�TOkv@����u��a
e:^�r�k��[�TO���G[GU~,�2�C�)u�֩�LpY	_�Rn��&�Ώ�;��{qi���a_n�F�ݿ*=<#�'4���8��Ϙ�A�b]J�a�&Ŭ-�94�;0�����h������zz�X� D$c'��.�&�l��.�knj�AL��ך%��t{J�*��o]x��^rb��Lq����`�
1P>�{L�(^|� �>��x�n�%��4� W�����[���-(�c�N4E��t��Ċ$�V$?�0'JO/H`Nl�C�6!f%Qk��^��N�����I����^F��|9�yGƣx_����$K��-v4S۴S��qR��Ӂ���J�)��	�K�C�\����5Iw�f�����L�a�﷬��H�kk����:v$}u:k�A�w�t�:9�y������KY��G\��_u7�@$T���O�"�G��S%L�mMA������`�'N).뭋�X����HwJ$�U͙��"B1���<E[x�}o�e�!8��ˁ�e�?����l��>���|�N�N��i9Z��ߧ&�6}�#0RDtk�'LZef��ե���}Ъ%�C�~�+)	* �9C�����BdG<�g?p*է\���M���u�*�o{������,�Kt?�}���M皈��T�0F�G�L�����Ab0	�\��f����]�$]�=z<z�P��cS�O`J�M	��.��C�}8�
� ��Ң�@w^����쮡���7��@P��ZI���(��x)��\;+�5+/2*���R9��t󽯖`����8O��9M���ж�魠5���y��SYgmm`�1~��N��~��۽��Ϧ�@pO�ߗE>Hױ6�=�Ǆw��y{���>���e���q�eA�r�h8T���Vu0	�B}ث��(��Y���e���;�*�E��(����,*厕��v;o����L�v�X���|��U쇧���I��:,�
P�4
��\^����Z�_[�f��J7�|��<��$���H��)�����IK+�kL���N[2�F��)[�a ��y"6.�o?1���|�xcg���"A'�DK|���"a	S�+Ð����a��=ԡv�����_˸�!j��n����'s�\$��r	��k��L�UUz�^&D����~�/}n E`EΔ��܍��29�TU�n y���DB{L��󓸓(�2��
��嬯T�ka�����[j@�Tk|���G��Z��$�j�| �U�1�VT���몄*��A`O��]�n_ i�&'��	�H�]㣋�F��63S#C�g ������VFS�;�i݀=y�M+��;a��h ���8���f  �����,��w�ڶD�&7�lQ�j��~0q ��G=*QÉ+b��)�W�'�ݴ9i�NC$U۹��_-�F�a���;0�.����SS�Gh>V)Y��|�=��"��D�d3�)6�褦H$�=���RmGs�0|#rQ�S����f>"�ch�A��Ld�+>,:u���?�q�J7/���{�R�B�S4Q��bm����R�N��	��8�t��_܃��{V�]o�=�hƈF�u��E���t>D��|oG���<��*��c�to�������cء!}�E�j�\�bo��`���B�RP��4�t�WǸ����o������`��@��˼l6?\�;����4�yj��p�_
��5BS���@���9�~���nţ���
��ߪk�N�Pۓ�
�y��6Ȅ%�6�C-@��صc�k��@s�~��	'�RH$}���"�2 M
��Έ�����G�a�g,�oL��ـ��:S��Z��������/2���̝a�����n�e�K>I�
�/��(�i�P>�p�MEf�P�Ϲe@��q�B��ށ4�μ~'Q���ѱuݻ��&a���^�� ~[M'����v����AiDl!� �G%قC�^�_|�z3���(Y��#a��ެJZ_`ulc���̷�m�p@�^�W�<_b2L�>�P��@ �ù)�0���O� ����/\�7��?x l�/����M�u�͗)G�G@HH���v���i��_���k�	W�x
}xx�!d�oJ��C�ΎG�2��cu.pBus�M�o�V�Z�CwI��s �����&f�{$Yɳ.�M*]͊nn�
g�3oj�0�A��hu�.�/.���Ǔ�14�&���+
C��Z���S�fc$P�D����99��fer�^��.��x������b�Ļ�O�s�5|"�@W���5����Ō��q�Z^��(���_%��@7dq���;ѩW�-G�}=��H4��
WS߶|�Q�E��;jhP�'�wV�X��4ج���gH7���:�c��-��-R��ý�7&��lĵ˪n��%��y�Y���|��`&t��%���z7�x�1W&J���z$.�.��z#pu�����ڈM�	̛�[j�6.o(�C'~{��vN �y8�<�:�J��)h�zLϨV�4��9���s@��m���`^F�6�k.L���3NJ���(x&�����y�(2_Sk��gL���G2eQ�E��DR6g�\���e�v��"��)j�7!�T+����{V���P�5�\[z�E3I-*��0X�Ԉ`ō4��=[���ٴ�]�Ƌ5��V٠o�k�k��K�{������k�>���s���W�|��?��Pb��f��f߽PQ�!y�G������{��L�r(x�����'\XrReC�O�	^u���$WZw����7݇vM<L�r��y{O���D�ދ �Sqc?�s�wan�`�Y'ieڹ�qE]>�qe�\�幔�L�`�2�������eڵ���y��(
�F ������?ܰ�wPfϚH�Θg [
�A4���|F��7�!���f������A�'s*ϭD�b~��2%R'���*�s`�����*J1a���[������LI��O��v�6�aw�p(��@�_��+��F./=���Ȩ�i[���7�e�ɢ#%�gJD��	C��\�+�������8��O�"ۗ��(�A�{g����	b����<��Ț�=S�8n$����kl��:.\7;ec�[FS��{Pb5�"�9%���~�r���y�:.%� Jx���Kd��!\���Hߔ�)u��	����UF|~���}���n�W&�ziA�Qj'�4��x�U2�*��=R>��Ge�ͨ���O�$e�Z�y�F���Q4��
maE��ܧk�!��̛ni�MfK��pa�5T#�_��(H�B��^P?�R-�ԙ%1i����
B��C��n>-G*ˤ(w�+*y�F(/��+ (�8���k3��GW<����������L!��\5oL�N9���+d�oy�I��F��7�
�޴g�� @�G�E�B�����Tx#��z�
����4�ټP셕�W�=�˘����cb]A�X��	��x�w�&�(��ŭ����>*�^��bʀ�SO4��|��s��������H9*p�N�!~	�m(wV�^s  �;����h�ǭQ!�} ��g_/�DGs�o|L�k!��5�K�籃K�a��bW0����Ͳ�=2��(��h�8ӵEQ(�X�
��SN�9�C���:$�����/E��ضh�.^J'#��Յ�5�c���˳ ��{f#kE-TW\�q��!�E���+0lر,e�gt��&�0�ĸ�5.Z�)c�:�����f\Bson�J�U\� ��g�y��1�����%Z{h�Z�C�
!Ci�ОVO���_	�H ����\`��6V��pށ���|
u�Ds��<f�K�����I�g�8G'�Y�P��Et���B[����%8��o,1�zI။��~��^,_�,���0����3��!5x� �J��
�`h��	�{��;����e]G�K5�m5�)����2�������`w�M���M*����T��X�2]Z7����Y���hh������<�ǖ�=K\�kN�J�����O���`��7y��p�U<�6�E#gK�T��(�����	gu��3Uh��O΅Aq8�[ ��[;����i�iX�&}yR���$C��O�o�+ɂgx�?p����/�ReNw�|?}��w^��g��ݥű��P�+<�t���?�l��|��,'��9�.�n���I��r���Ł��_:B��E�m�������������.�6�"^���k8)b-bݴ�����g���� <T$ѡh�9 ��ǨTd��6"z��ygam�D���'Y߯��tiJ��-�ާ5���˶�CZ�ߏˁ�Ɖ=}�F���7�a[��fg�©h�cDx���M��)U"���@�j�����i�
v5�pNrK�Ԉ��;7Q���T˳oc�cV
�y&Gȿ�l�+���0�IN�/OX/��՜4<��S
¬�$%��<�9��Z�5_=�
?���*�q�m������po�+N��a$����Ǳ�a�{��9�$����!3�v.��܃� i��4���}r����Z�MъF��5�)�~�ހ�J߹}�+�u{�>]�0�|~_A�b���!J,u[l��௒����ͤL۽��C�L�Y�NZ��Ef2��^�
7�jyf�.�������0�Q�I���~ΰ�+�3�_�eܛT��]���ќ�j�L��\7���9�2	��x� �y��l:h�	��:�lۙ.9U�̞�q�n�D��l�����b�����n.qv���Jpמ#�s�ӲN1|�A^l���<%�_���Rt�	�8�Ma�)�A��������)��C�_,���,N��bl_��Є�IɎ2�E�����ዢ��Cu����y �B����0�tg��A��<ǩ4���U���̞�d}�I��&n��?��ɠ�6�~~4F�E"Y�檍�uϾ堁���w���������q:'v8(��O�*"C����?���+�������Ķ�Xvz-�m� ��Ĉ��ӹ�O~YL�s�Á6�Ϭ�qR��C�]�j}�ihy0.����p^M�*�\q�#���n�
��K����vX�ƚF0�ݧ� �����2�*�6��X'@xN�]�$[����N	V�mb��6���M��S�0q/�O�Pn��,<���XXH�zy�W���g+���?�J�PuK�'�r0�B�V����G�<ne�>��b��w���P�a�
��,~����|�1�Xi��i�@�\��5��ֲ���'!�em�}j�7��u:9�DU������&+�m"q�=8A_#���HY5Si&v���;�$x\�VJ��8��]�eQ�M���i��o>�1J1�À)&�k�e��)@�5u�z�4��*t���-���.W:����(����בL9�I�C	btV�x��Q�bj��Pr�\�9���W�:v���9�.ˎ�=�~#!��7%�\��=;'���ε�0�(���l������n+k0��S@J�η^΍���K��=�ϻ3�ɒ7�An��G
��?�1�6Ō�G� 7�A�ɇ��ܹ�����=	d��������[��gj�gj51(f������Duz�;����0D8��z�R�� �j���J�=�;����j��c����K�S�hW����s!Vj�EL��,̝�����dʖh��F�=�>�>BKh����Y�{�-�Q�����M$Le'��.O�����
���`}6�vhDL�TK�M���G�����'M��^4lp�(%���hRA�RD�� OH�Χ�>G�2�h�ܦ�<Kx���C�i���:z�=�׷��� �	�V��*��Hӓ�D���K���8���72�h��l{�dV�~Tq���T�r-�Ɛ�8���C�̕bc�tIct�`��.s�~.G�D��~bC�����ꅠl�;2OV����86	�!Y�]q���l�;�8QA��6(��aw^6�h� ��М+S��-���0Q#k�B�x��zǈ��t��
��75��Z_���$����J���o����C1O�!�<��\�k���q=K�|����_}�]�Wx�c ��,C���
$J�D����)�և'�{mQ���av�(`C��$J�"�o �D��t��R�������.���&�����n����`�d�`ݢ�B�X��=.���W�V���W�M"�!��`#�#��DS�i�L�
\&c�&����R}���������ӫ���[������[��'�Uu��gfG&�pZ������,�tl�1w�b��{�Z{]M�L�̋���&�+�8�>�xS�FOV	K�����\_��>��,g�-ډ�D�;s9)�WJ8������zX����(x�Q�"#2BK��^B5�)=��h��3�^p�b3Q`��c��y,��Fݸ"��Klųrʢ���d��k�d ѿ֩aV���F�O*z���ԇ6�������x ���
���������+�ҽfc�i���}���B�����NPSҏ�)K���J�G�)?�Ȍ3{�.$�R����D�G�#���Y�+9N���U`3��.���!�Y��2KWl
F��h%�Ʀjo�A3�~��(A����xڮ�F��m��Wp�V�'P�ԃXA�<\��F7a�D�Wψ�a�\��S!l|6 ����My��T�`�#aO��~��*6P��&p�Fʭrs�� �.m��!.6�3c�z礃����:��)JA�MΞ��H�ވ���8��f[��F��C�)���I\X�~�߷��xC��w�Q,�r&�19f�B���;�b�4w��!��Y2�|:���o������&J'"G�a���` �l�Wzy��o �ll9 �:��17;{:xJ��{Ӕ��C*���L�>�
Z6hѲmݚ�h�P�y��x����e�@r���޴P��ơ|7hee=m���41|�Vrz��1�G���/���)��u�\�I�z{э�H�����Z0�f"����a ���,pLa!��ލ6}��M��S��}��5I���-�pxX���}Zt"c��
�`&#�����tV 6rd.䩘�� /Ԧ�׭�3y'Jc��u����t0����#h��.	�$��wp���EY����4fZLv�'�)D�L�p�D��'���!���x�5�m�\)��ф����RQ�
�\Т��V-��������D�� �х�&�]�V�:�B� ��V�TXq�G�V��o"k�>��|.��<˳�^�?�T�������ýH���@��bRBt�Fy�����hb�k`B�CZFߘN)�5*�b�b4�����UxB[?��<H��>��L|�4�d&L��e�fS�0�y!&�}ĞMi��
����w�I�)u��)W������da��'g%~�Cu�l�=��U�´�;��G��R��d"(�6eU6��s!��s�4��1�@3E�l�`�?� ��쮪�g�
�*�.�IMJ�wY���v��#��D�r5~�<����W�N��V��tDQv%�0�1������+[����&��(ǵ�*L�A�8s$"�'���K�Z�@+yqzf����Y�+Z_����V���[�w|Y/��Sda�Ij"5�wk��/�A��9����g�����Vr��2%��/��'��@@d����(G��6��bRF���F~�0�1�,(W�n��f`_*����UmLWn++����Oğ[W�{C��n@:�q4^�jK�����؟kdɌK���V���[ϕ�-���I^��{?a{N�G�xɯc'n�5��W��Z�z
0v>�f�*�Y�v~.� x]�|j�+���������hJB�=,�#��%�;d7�M�kF��;,�
@Pc��Ϫ����D8/Q���.�X��A�+�{H�\�j`�4W���l���n<����Ar�7�Y��
��q����`�W�����^r�oҵ�Zƀ�8�av>�jP+���~No",��	�ޝ�|ֈ[̊�1����s�)%`9/��ҏ>���a������@Q/�r�T��g�ș�j��[y��b�o�۫#	�g䉆�m\R�<�g}^My��C�������ߵ��0��7i%�j��8�ה'��n�-�J8�葐&�>��-���s���E�+�..q��"|T_�I�������G&H{F_8rۖ�gk��-]�Pd���R۹��p�tfj�Fs	�ڞs
��ꚿ�#�o�˿�;��A

���Khs�ӯ�m49��<"p���/(+��Y��by�5�`[q�����
��ȥZ�ix�O��������'q���ў��dT-4"��f���
���i����� ��,��>�,�aF��MA*Ꮁe�q=_��Gv�3�E
��Q�����s�ָx�Z���jͮ;
V���1ҿ����](z����mW7FBa�Q��Ώ�qGyv$��.�*�g,a�!�HT��*-���5*W*�.���H�����(�0�vѻ�Le�ٷ���1�Hۗ���p��xI�v%@��C3�ppy䛮��ė���v���t&�4ϰiw�#��y�z�o]�I�B�J�>�A+$�/;3��������l��g`�>�&��8�2����vx%_K��${<�b�@���R}&Z��p3t�ǽo��HI��}+h
T`����s;/#YD���l�ˆ�zZ���$��},��n�g�&�DʡM��G�}l���Bc�
.qOJ�=a]��7OS�b��红�/�:bg:�V�!�p�o��Pa/�_t>��C�sO�'�l?��&�@I��~kOT��
ɴ�U�������=��yɴt�T�Q���[�iMe���:�<81�9�0��`e	��b�2�m}�B_lGq�C;�1��@ �O�����3_N�/���3�Zu���=�������_סY4yzTf�\�eha��,�c���{9R���;�~�q���U�&˨3���&�_��t�U�S�S� ��ю��)�>]�������1�~)�HE@l8������?S����P��1[�!����l����7s93^��v
:�xe?
O4�ǒw���
 T���#��̼������=Y�z�}�T9[�k�=w�ȉ�?
cܠ
Ҭd�X����+Y$�N�g�N�	'0����u�^��<q�眣(#���y=�<{��	�/
��W�a��mq�Gý�9u�����|֚�j��^7�)��ڪ;-��_鱼[F��l`�9�
z����C��[�]�u�e2�U,�ұ<L؆�Ju�e86�荸�MdD%�P���,i����j���Πw#G1��-�F���_�[�wh��%�8��.�e�������*b��C���?�O���H�LTԴ}���
]����}����(�\
|��$���
�����qN����x���臘1�-6i�M�c� ��:�����r~��7�^�� �C�U���6����"�Z�xַ;�HܕF�v+��ɒ��p�
�[m?c	
���!����P��I�s�/k����'��Z��֕Nٝ�6�晦ө����:0����=Z�,O���$�L}/.�j�G	&�� �2���w���4�M�n"�u0� Z�>�Ah�`U��e�5���zW�W(���g5�#��.�\�=�:����<���=³�°W	2�^s�^��mOzj�_#�����$�j�"�D�5H�����DO1�|�q���{*f�Q�@*6C���9�\��3�b˼������\�_�\��.���𦾆4�G�C��~����)	Q�t�3�~���Y�r�XRA�łpR�q�}i�%�/��WUj��m� PQ��V5�u
�-R�Df5)�g��+P�"f��$W ����K�9u����h��#!�{1
$��[��U�as(�h�T����)��#�`�ː�R i��*�&�Ro���?|��1^�f��0�����epV1$��]�����1*����hUJ�+��h��z�F.�և�V�|m����l�%��h<�ka�H�~`3�������U�cLR�3�����u��إ��cW�P�oV�]Fq�-�*X�Bt����8�Cѻ{�`�	&]���{P�t�Sp�M��@ݤ3�-)c��t2O��o�ƳGQo�X��e���>�t��v0��Y�؉��:��Г/�5҆���&�/�NB�z%sNA�Mu�t@ ~J���+��S�l2����O�&=�\�dKh��4�=L�bI,�` �.*A���5DYy�Jh7�l�](�F�XVk)#���q��v%(��)+�6�g9�4s~���*�wQn�II�]�x<�,_{	��÷.q2�;08��'���h!*�"A�Bk��V��E�>$\Z/��Ǯ��O�@_N�`j���
�ǩ}����M�YI��s&�l���������|�W$	��+�R V-�1&*+0j"�,�uD�E��l�>MW��`��XG w���
����ݣ̅ �I�������	U}z2�`�qWCh�|�4��;q�'����u��#��z�~'KP��C���2��B�H#�k m�,b�cP����Bҧж������+���h��<͒��M�H������\Vhpw��\�x��x��J'#�3"j�%����Ճ�y�F�~{��/�H�cNۭ��h1��%��jji=_��[�<��r��fy��Z�� U�Ŀi%5'A�l���L=/ݐ���5�/�ki�Ƥ�W5Ȇ���6���Eiz"c���Z����蜥��Ȯ=��9�w{!p�3�Ԉ�a�
%k���g��h���٠���icE&���ɨl������`cE������=��'.�q�5�J�N�b�OJ,�
�6�Q�
��b�Y����`~�������bqƴ�Q��
2������0�?'��O�����Okp�L���N�9�e����/fQ
���|�����ۆ�[��	u�
P ��N���Ql�>iǨ��.7����v ��}
o� � Ľ�W̄*|�*��`���
)L�Nx��Q�eY�S��Y��b��� /���<���7$�!D�ܩs�<�b�gm��3E�Ō���Dd��J&���ŧK��S�����Hi��⮾�pr�i��c߭�Q���-����#$�$��$���]O}�u�Y��Y
<E�y�CںB�R�">��䘻���i�A��)���u����^E��~�P9�~�6�+c!�Z/��iOH�k��h&�y$�$`Sq��,j��f��i�e�]�"?���.e�q!�������&�[�!��䖲�7�Q�+nɘ��R�	7ab'4��)���TUL��w]��G�U�$-�=��Iv����I��O�v:�������\̿|�zR���޸���&8��G�����@�5Z��az�s����Z������X���� qA�^Y�o�`�`Uk|�l��%˃��ֆ
�1H��s���"�X��ِ�����23Q��Ջ�0-����@7=V }|��c�1���w��/Y�6�u[Ӗ �
���D(�)�*��{�V_�F@�\�Rp��`�+G�q6��p�#�B7�q�tԷD��u�!�-n��\�	r6�N$���W��/"?�x�X-P�U~_����bIÌnn�Q��T�3kz�y6��za��v����&a5���5KX�|=�M���,e��Ɠpq~���'w���L5�a�d�l�T�F���D�}nf*����Y�E���f,���S0�W�����U�~;C�̧ +:�HÝ�S3N����b�A~s��j�����AmR�7���2L�`�U���������é	Z������|[�u�����#z@
�\T8��*�	C(�P���
�=V��$ض�Cx��Ɔ��R\��b����S�6Q=I�뇉۹q]I�m�\���PwR�EC8WM�=ʱ�m��e7�	6H�n��v��g����I�<�/�,+�����!{�;�!Md�!�e=R����(x���6:fm��(5�O�.�Oٸ�8u���o���4�R�.z;���+��PJX.�&����k I�R���_�U�l�&������W���f��ŜZR����ˇ2�b�5i�"@߲mP�l����B8���ǱԨ���6����S1]\��E��v�p�Gz9���N��{A���z���r�ph�N+~��Ȝ��$��<JNE� ^ْ?����T}�w�RW��ơ��u, ��/�u�����".�����hK1���z�tc��K���wX�b&�\?��!��tuZ�A>�ǗQ�6��fDh�Ӛ�e~�G�^���X��� �_q�hC��ꧮ	zj�}���Fl�=qy�$;���N,���c�����h��&; ��L�
�/M�A������ypո{�Mm�k�����|�H��
�*�D!��/O
� g�xz���A���u]5\���n ˾԰�Y��}�m2�}�
�.`$L��ߢ����_�A�?Oda�p./M.X�亇4ȸ�k&�OXqK��/�D{�'��}z�0��!EOު�xL�ϯ�ؖ:x6G���S�S/Ƒbu(_,�mܭ�l������ȶ� �
�6��B9�=��&��vMP  T����W(����]z��5%�(�jP6M* 4*)<����S`���R�r�I�\#����	?�Zn�\�0#K&g��bWS0D0������x���MsN'��Ze8c.]Ҵi� �a�Q�x2������ �k��������/v��k_.zO(�+I�"�:d����-���Ii�a��H�F7ݬc�z�r�j9�e�?
�W��`^�a����n&J�?�7zxP	
3�3��t���;��K����7���"ɶ�����zt��KXF�*ޕ�n�/�f�[!�L��/����� _������[��-�tZ��1���/Uf!�s�����ڹ{9%���O9��deچ=�4h`Z��E]
���+}�Vո��+�U:	p��Hu��vn�bU�������k���>j�0כ�j�D� ���K���+�j>�v#��̍���,���$��wm@�S�8#I{�f�X�	Uc����cL ��?;{��[�(������@���]Z�`u{�>�{R�G��ɱ�9���?k<yí�ϖ�0W.�R��/����{��: tl03�uyӷ��ṁ4������{(��Hqe�o�ЖW���_�׊���"g�V����:��T�x��s��A�R'�ŀ+�?�׬s�;Q�? �>� 0L#��LT\Cē"P�a��z5�WܐnB�7!�t쐊�3�Dlh&n��)tr��b�GU��2��v�
O�TȊ��|Yra�����'+^O���16�\�<�qo�V���kI�!���#�u�O;\���Of<B��/,�>�2n)��l��]C2�ht�����	�6���
���Ocy)H�X���2���?��{K��knb�b��"���I�E�$�}��Ř`��&n��ΐ4H�b������n��4�	�sm���ɒɦ�>6���A�w�N�f�U��܏k�Ƃ[����xc��2<��9���A1�9��8���
E���*u ͒�����hzi����E���_�
-�������h��R�fo��-X���~��)�أ�N��=��ן�"w�hx5ۄ`�i�p�Vָ]
%V�C����ƀ���a`�)�\��Q�i5�:z�V�⺕w3a~^��1H���5��[����͹N�={�~->e�hl	oAF�ʿל�T	�!�#h�Gb� |eaN���e�
Lס������]��!�Z��iLjn���3Z?I�v�̧��ٳ*×����ew}�"D������ϯsk.�6׮�Ioe����64*?@@M��^>/#�yV�]�n�Ʈ�I���"zp�Z�+F�����)�R��ʕn�ˠM~����3��w��ʭ5�ʴn�������F�����t�@ޏ��4Ul�x+~�=?���!�Ń&�J+c���20����	,
(���^�U��{>����/iq�7|�i�Ȱ* pXL�y�_Ե���F�u��9ń�cͬ��g�1��l�C�Q�wV�.T�*9��t��������
M��,u c+��L�&�-*3,��39�n@�w��ԂF�Z��>�)q��*�Wx�g��ʨO�n/PY%�8�!(�g�t�9
�2�;��>��|/'�-�ԩ�:�Ӓ��i0��,@�#R��K���O�H�fs��AB�2��-M��&�dz9ͨ��~��� 2�9���U��"?��~6��J+��(�zR�����CdF�lu159Iʈ���B?�s;PsF
���Y{�ro�5�ej
o�+����X�L. 
����`K���i�B�AQ[~)�cv���5O: ��$l���� ����Ϋ"�������g鲦d�)���y3f$�!d���p����h��[�o״m�����h"�
��k��k�g5��{��+�i/�n�Gh
��4����m����G�����'o9{�Id�Zv!�۶y$U����E�>VwO��E]H��iw����^�'�����o�j�}Em��~j\��� A�to������� �@�����~A��X�/��K[v����֡�Γgv����Sܰ���i>̧CP!�9˘��#S~����S#>o
O��c����u�h�h딱·�|MʄV�I��
�=�P�s�ېGoZq��R��7{��4�8l����-/�=��sQPy|4/ɦc��/���&�5"�;�W�E��h����e�v�vk'�W�6�go���3<�m��H1k�XEVvIx��4_b �����n�\8�3"���J*�P���8�|���`R�G�)I�|�uHN�O^�Wc?�a�0:@�j����B����Y��U��/�Cp�K�FX�
�&���4��]���� \ҽ:
-{xc<P��!$�b�l�8�oɠc%6d�\�
 I�p3��MA�uys��v�JY�
m �{�YJsi����X���*��_h���hs��B-�]0]$��\-����?�=�m�UÂ�;=쓡���������K
�
|ಙy�bw����u�ջ��63�h�~`B���+k�x�{E�V%���3pUqS����GA)4όQ(7�-]#��XزF��W:��
j�{z�o}���m���MlB��Ā�Hy���͡s��T�&㕖����@O� x^@���}�ƭ?Z�En��0�����t�v����P�ڀ��ԛ�(��F�^,�M2�٬?�.�{ʣ�= '�RS�>�[�q�'ڠ����|�<��V�˧s��G�R;�v/�"����.QPY�2�L�y�W!�r&�O�r��U$�qk�w���j���ɪ�@m�в���5/�k ~f�uh�"(���J߽�0^�r�oF�u\����m���-����K3g�,ش��6{U/{�#��� ���A5�T٘�B�o�A�5&��b��Zi8��H����]�K�(}	N�)�����;�6o�\g#�H��W��X�G�V�+2���k�pR���/�B��ƪ�7�J68����=\�&�!�>�1*�
8d��vc;�_�g+f�L�#7�����kШ��?/A�q߿�޳5lr�����]H����h;�[T��}?1�X�=xI��΢>bK�}:�ò=f1j�Bc�K��	i�����?�7*���K�d��~y+2��{�lb�%���!����zS\���"#vU?.��
���R�г�x(z�Q]0ľĖ��s�/�DY�3��2��4G��T�;I���/;9�A��_L0�!$��!-�-L��NO�d��Bw�ۨ��*\�cd
�ʖ7/�U��J�M�,�;�R&�*��Z� ������1�d^���0f�D�������{{S=�c�`���i���b�?�x�˞zD��(�F(�9��/��aN�����cs���u
�D�,����lf7sFA�ҳy�$��+6԰٦5����O�)$a(X�^c��g\0��;��9ޯPꓛ��E�J��mZ��ɚ��q[�9{��z��x�08�i�m�B�C���qz���H�؛�Ҧ��w�W�k�M/�X��Ot�ݚ�M0��E�*�3�F���t��A��_�m|�9Q�F�:c�����4og����µ�d�x�����9��΍Gf��!#�
˯�~������r����w�	�,���8��_2�	�"���d�-�ȡP*�H�"q"U��f	שׂ���+_� �yAa�?�tҙ�ga��}&F3�׸���!){j��$�(	���"�ˌ� �ɝ��#Ʋ�U˚]�Yt~"�|]�ƞb$HL�*�Q��P�9�7%�;2]1��A��F`���u���n��6a8�/��Ij�K0hX=�î�ӹd�^�Qc�b��3Ғ�e�Щ�Zk��ʧ�W���_0~5*E�%*1t:�781Vz�0+��lK0���4��_�$���m t�f�&Pำ��� w���������)��TS�R+�Y!�,�S���,{����,75F���A��.�i��n5D�� ���|�z��]rae�=��^�f1~_WqaGE�l�,�3�8�WY����:>��Ш��Z�ܿ�\��a����`�,dؾB�V�Yב�	P�6����A�#KQ�S�8������5���������
�"e'����
�0� �\��b�v ��Q�|vŻk��J�U@��A0tJ�ʍq&v�!�
����u.k/�Z\�:@�F��{�	��|rύ<ρC�U�/[
��B1~�w
�<���[��E�����FP�U��$�@����EK���˸�_hv�%S�d��i7ʝ��k�j�5�#��d�f*�I �t��HN�ke����n ��{7<���(Q�=�<��M�Β<vqb����`�v!� N�]A7jL�Н���.���ֳ`� /I��Js�}��(��-	5����e�-~�3�澡^��O8JH��-VuU;�q�Կu�F�y}�ek�HAC�=}�Ȱ~������b>���U�#��&��NI��T� �=�	�p�F�)=A{6zg4X�����X�^��cK%�;2�;r�Q|��d��'�v9��7g��T�?���3�R��_y��ǎ��l��W:[�����Ȩ�5�+7d�vk5Z��#���'��iM�ַͨ�Y��צm�[x��x
7<uA��R����ω%A��wi�zȻ7jRk�9~t�~�q�����j�0�����9�L�k-�����$^4����*{��8	;2���ե+n����&!`���.Ne���@��T�w#]����f����IC2P�Z�� ���jzIݦ2+nڇI�U!�c'��S���+	�$9`F��3c�����q�Xɒz�KV���d��Y��v}?ĩԷ]��:%:3����U��PXV̛�NrK�T�T�$_�*�P�"����x�R��A0�斃�g6*�a�|�����
^_��t%��V(����*��|U����?۸	��t
i1s�9���ز[@b-�ջ��.[�;�$�UGpGQOև{������:L~��֞h8�	l^GY
�Dʜ|*c�&u�dT�;�ߡL�۲�\<O�9ͪ�E n�k�Y��bF�h9�����L�ǆ8�O�ˢ)5����gr5��f@C��e�{ �b�I�A�r��CU�������F~��B�
8 ��� E���B�ӢO`��rƵd%=I">�4'JQ3]�R�E�N����]{�KW�U�P#!�E�i�X+�z��F�u����&$�ň{�+9�E��Nʦ��(&�\CaE��{@ǎ��BR.�'}6d���=�@لp@�Ok��2����VL{�h�P-���������M��F>oAWr�8˥��On[�
p�HL�fFT��H����	�{hz¯v�¢�R��m-<��������xU|J�տ k�|��`�v$*8r�jg���ӏ��j���}����=��M��޻
�2Λ�n~��*�\h9R2������Kk��)~���l�� ̎�y�z۰
=��{.�mJ��)Wa���I�X�vǢ�,P�:���e3a�/�o.9깭&�.:z2"��i�Qg���ӳ-+|l��1T��h��}����=�����eؘ��)Wn�I�f�#
gq9�XƙV�'����]����͡�N/�*��+�=���o��ppnpr_U�b����=x�*:�p?�΄bc
kfr
�O��S����C
��Ҋs' ˡ�;s�z|9g@ܦ�E���e�6iC;\{�����[�ߧ
�&�r|Wyb�7�`I[%9���v�P�]�"&��H��:����s��p{�!`���[���<�[q vZ����ݛJ�
�S=3���x��ց��,8?)+EM�+�:�B�/Χjrd�ȷ*�{�j���͟y�%�x���Xp��m��<J+;҄Fy>ڷ]�0o���4y��)]� �3	����"�\�`����%�f��٦��(#�\� ��Ya��[��+x쿭�!��f�
ޱ��<)
B�I�c��tW]���T�k��R��=�����i��"��Z2p��3"]�����/Nd��z��;�Z�i�j��d4�g����<q���W�c�H���!��n
�0A>d�K�_<{Nm��L�ٺNg�����c����<NH}��H�k���@���`�����P����IT;��3�e����o�Q��!-�;�{/C�����˫�&>���=�_�Kf<�2�E�	�e�T�̪�Z��ڪ�Zy�]4��
�I��{?�PV�"͑J�a��
�eNP�`B�����;�ʗ��κ�q\�4E5C�
%L��������L��
B�E��O�_����-�ԚF'c��|����v#���0��|y%��.JŷK�����T���Q7H����~"�.�
hZ�6N/��-��蹆�2�Pt��,U����8�4S��Ɵhc�W��F>���]V^�l�g�5ۊ��k��i�;-�R���8S��]Һ���*�/��|�����Iqd�e@B��<�8�Qљ
��l�A
�Z�\�*�>��;����� _�֛����kQO��ht��&&�j0ac�~g�(w�eb{��e܇����P�����75�!��u�
�Su�y ���&k��:���QF�ph
JA���N.��~W|;C�Y�o�M���$��38G
���F��
C��sÄ���Q�a����s�*�g�ł���i��\L9��P�4��z
̪�4gg��J	8�S�0�^� 7�:�A6�^�����W,/��b����
 ���,��ц�i`��*b7�2����Ă���Ji�ߎ���=�C��A��e��=x���W��v��E^w�	c�PÉٝ�q�|����|5|�k��2X���!�kz�����p?�aK�~L*|��(��\gn^�����û�����|��7��p5L��(� X	_��
��A�d�i��;�(�i���4�Ό�w;e*�O	��_9w!q��[����2-@Q�K�< ���*�����u�P�Y��I� %���
6,�y�<l�8ئRa��ei�4v�g\�][.<���{N~({���O��a����ru:cȠ�]&�Xh���k ���h繳�쌛i�P����R���K�`�D}���eSW�J�X5��u@T������)��/��ۘt�1vo�X�[�@���Ѭ��s.E�-���]p�T_����	k3��
q��rT��]ugas���}���{��J@1�S�ނ1.ZT�|�Jᬷ�L��)	�1+w$q�:���|
�!O"ҷ��e�ٴ�a����n�C��Ԭȟ�
:<�����u_��E��~�����!J��7�G�_8��eus��U�,ڠ$�3�o��Ox���1�\{fˢ�pr��������v����u3ZLa05���f�J�\XG|23#O��#@J���$f �$���85"|������}KF�9en|�����Ź3KM�K��ȏ�6:Qx���$�c��M1n��� ��u
���
��+玚��I88�W�!
�c�BDp�߹�����pV��H�^`d��E6>�۪����v�
F!�ҹ��zy�GrŊ~�]�`�xŦL���4S�hJ}B�'4�ٽ��C���q��N�6i����:���S$�/
QR����(�k� ?�t�(9(Cj~�%����O��˭-ZZY�nä��M҉
���7�Y?������M!��|?�8'��6��E���J���i�����b��;�
N q�3<E)�;���4���d�1��E��*ñ��^&8����o�?J��s"�tGLy��\��F�z*ق��*�y��3H�쿷��y��,^1��O%�y,�����Q�E��'�����xC=���`g�rr��ݱ�c ܧ�=�poVcȐyv@�H���mw6 t�;dZ��ܢ�1G�W�vX�"P��5{$?��TQM��k��n�%�o�2O���p���|ְ��[f�*?�]KU�������&��a�-׵�`�*�{�'J�&Vw1O���@b�kl�1�y�����lW�8���TP�3u�����*Vm�@_��.F���������*m�@�k82/7 �!Z
-�p�يy�M��ʌ�1�K�v!�Z���L��]bW�����*a�Ѵڅ�2DA�ϲ��M��,訿�VL%gǵAr ��w�R���G������(�0 [2�7QSj�Γ��m��ַ��c���0��M�ކ#�d�rO�p�g�f�B�E�����a��O��z��S��9._�i��h�;�����-�$�{$OV2<�P*=���,�'H!��+�C��� (ɏ��A�
z1��!�Z6�
���'�/yP��/-��b6��%[C]��?ذ;ʓ�Ǟn�0`������t�%y�@��{��.�#��@���Ú�<\ּ\�%=ߤ��(���:X��)�7�_+P.UN(ՒǸЏR�´O�5�ɐ�_u�x,���`ٺW{��1�L��m��0�F��g�U�"�M(v�K�P�0֑V��^+��.-��{-����u��P�/k������K$��b�X9���ym���O��U_�.���~S�c?�����Si�UIb�evN���*LQ�S��nѥ
�^KP�`1��O�A��P�:weՓ�^���p�:[z�k/R�R��^~�\ؕ<D]�÷P��*�P��
݅(QPz;a�)�d�ݨ�� M7
P�S	�d%�A1Q�)��ѭv� |��
9�`��4Y��B�\�϶�.Z���1�\+Y���S��ؐ����_��^�$��^��a^�gM�1�3�^6���A�>�s���&<~�{�eL��ځ��2ݟ��c'g�p}_�~�b�^_�U{�U�)��92b� 9��%��X��t�A+| ̿��q�����
�b�N?���b��	����+k&m�j:R6��Ν>�eA=/ՠ ���z~��o�
PMD�'�N�>D"xbU���W�`&]��	�7Nk�[jX_;��|�K������Xx/d�q�E�$V���4��;��Ȳ�Y1�hdن�ޣ�Jtk�y�F$���נ�E���K����r8�	3����p����z���O�KgqP�o��~��9�L�A��K�<!����eM���a����KvC)X��XO�k���Ͱ���� k��vsD�����,m�E^����|!O$�_-zq?z5^-�T���p��)���S����<��+D��:��yX���Q�h��J:�]C�ql�t��JR��o�x�)�O����2��Q���|M����u;F�g�s�%1�^�1n�MҼ <0��.������Dw�Nq~��_���9XoGJ�#sj��pJ.`v%@���t``�ZH5(���\��吰X�C6���&�����u��k���b�<D�j��@#�ƀ�>�݈5fm���&�u�g���I�eH��H%T|\ȩ䋸[][�	�ԝ�P�ѝ
�2����ԎY(8M�Յ�#�3s}b�
�""�H�|<(�ay�[��2ó��R{�P�7�b	Q����Y�	8�]%e�����e����&8!z�ʾ!չ���T� �33���q؅�9���k`�#?qs�/� ���cTk�Ic�A�=e�~��r	�Σ��,��)T�[����0 ����F����ϗ�qΎ�gUj��jN��N�w)�!�gl��!R:��Ɉ��bF�#^��JD�3�b�(�F���ζ��~Љ!6�xKD�����b����5�L{�]\�غ�6�{o븒E�ٜ1���<A��%�l�E-��+Y��[����߃j��4s<O���t)"m%��`��AO�	��������ɮ��$���ñ"������I/'u��/S+�¡�/��<ţ��7� �X{g�͢�J����4%���1���#.FN��)���,��j;뭞���:�R9�M
6�Z=����	����Z�Ƃ�v�v�mY��r7s�ĀU9e$��K�Y�?Ș�"4�CR�F�������Aᔋ�XjBd�����̷�@�p)���ui�����qS@ �
{��	$6
�q���P�X�����s$o�9��^�!�w�#y4*������Ԛ8pQ��Ȁ^v�R�RԷR��ˮ��®�ٰ��'E�w��J��E��n��＾�g��S_J�؟M� OCN��|*s,#P|4}O�c�<�V���6I��v�?���{��MMm*%�30��V��#��X�X��b�<Nj��ݞ��@�ƀ��T�b�,]k�R�E
� `X��lF�T|0��/i����݃�g�a���^0q�3F�A�x}����)�-3��e$5Rw�>�<�PuM
ɬ�E�el;�ጄ�4�M�4����pLJ����La��p�S���u{�s*���"�>��n2=�vc���$d��3��X��G3Z!N�e��;�R�r�݃cezA>�W<ס�
�8(�c�~(��=�#���-�!���Wo�7��J1����P=(�zҧb3&
-'.�
���k�xm�4j��@W��ix�nGo�������ɑ�x�j,"���C��(��&'ЭR9<վ�ø�R2�/u��B�Փ�Z/Y�;��/l�0-6����Q�㲶_ =q��|�x�}S������|�C��O����Z˥�5�Ϣ���8��s/t�s6t-��ͪ�-��!��| �d���>�A���'�7�7�2��p�/��
�Ǝ�뽱Ɵ�R��n�9�G��5v>����`�	��)�d�s*R���vM1����+h��T,8[����߽:f�%d�"N&R�8=��O������0+gR��z��N]�!���x뽪��	`�w���΅�u�o�En�S��O=/�Y[��tdװ?�a
6�ȢT
j�ǋ�]E@$B���!ҿ�\�g��~�8�_��J�wO)t�LES�b��#��1���v�b²+ޯ�x�	�
�R���5rɃ���|o�n]�����Np�<L�y�U��#���/�
����[@��vңz���6�V�\�y��!����S�?���!$��-62�T�/k�>Ubd�y�<����R��a�&Mt��#e<b��s��&�i�s�.^?������O��/k��ϓ5����﬽�B���;����������1vG}�Bx?�`�<��g̛
�}��@��c%�x���W��K�ʜ����S�I��~�rvO�C��G:�;��qu����h-���偞lɱ��q����!/�&��m�J��ӂ	�ì+�s��DJ����������a�af}���[��Ȯ!��~�k�?|O��\�:�{|ƣ, ���i�eL�r^�gٱ�SO�ګ��}	;7\���h0���~+��rA���m�$��l���M%%O���U�n�Hc�~�Ȼ'�g�(}�E"qp̙0 4���@~>�\,6ݳ�1�lV�.��K�rΥࠤZ�
l�Z6�nK�M�
TpW3�G��+�T��/�kBkdԻ3�v�!,Kk3�MS|�P��04eYp��`�H�7�����7٢l� sx�1
��Ǫ��ZQ��]@�B��
	���ϼ��ğ��Ɗ��,f~@Y����RRXgyA#T�M���#���X�I�mٲO
MEr�������d��x.�	>��5�Q��(��%�ɹ�,"9B�vf�vi�k�2 �#����<z�q�cC�珦9����v�1�75�@�5��ʼ�?+˪%��/���������roc�;P�60�xj��kT|Ne
C�py9���L��G��U�ra'�h�����rw�nm���&s�#� [�g3L�1�0H�>\x�o�l2�Y!��Ǌ�?g�!B8+$��<��Q���1�wz�m�����)�M���濪�!�~�ǈDA_ߌWQZ!vh�7�0��"v�s��pW�i<ԋ9��1�^[l{%�jj�}T�����8����-��ڤ���)�U@��Sl�١�<�X�f
*�w����x�?���o:m�������A��3����J�� �T���hT��L�)�<��,��O���#��\Ҁ@]5�c ���Z}h5s��#���$� �?�\��ʹ���j���lg&�K���n~���e@���1n�����<{���!R<�1
w�*m8�
��t,��$�X�R��L/��@N�Լ�'>��"^�����r@#7Mi˽��������a_Zu@OG��3N�h��	���$����Z�tOg�� Ѹne�$Tf����}L'}�S~o�D���R��ƱC��i2y���Td��[����fCe0��U2aPZ�l>�V�\��,
^��<5Sw�Mm��5�(l�Pw1-tI��1�dl
{vs��$����M�,H�v�
K�ntU���B�����������/�3-�9���U��V��H��ÜbC��W+�^�G'�q�%����{�[۬V���f��ChdQ�=a�.yN8@S�~��.SB6|�MaR�]�S�K�c�	{���y�+�����Q�\IDhhEQ�u�<��K
޼1��k|���ۂ;������z
�![@���c��M�Ii�QB`B���:^�6�/������r6v/��^X]�_�Z��_�́��?�'���qJeIҙ!��
>$8�l%�C�F�`��̚��"�Z���9��Y��C�G!��]^�/#���*;:�6�z����쪽P��ye�Q�u
>.�����-N��Cg�*���WuYn"ģr�����}�w��A���m�$P�_���[�{����ĭL���%�B��ЬX'�h�J�`],�Ջ;�6��d
�6K���Ȭ��ΐ�h�� ���X�A���E�.J�1+�%��
n��=�_�C�� �!۵6J����~uȐ�f�X�i�q[��+��=��]�K�qL�+:	Յ<������{��K�'��!#D���rb>)M�iڿ5�Yd��J�M��ܸHR�Qf�U��1��a�Sd ��'h�UΉ�f�Z��E��z���T����\j/d���/�>� o۰��2�}�$�]���(������"(��V�+'���uݏo�=��7&Ȇ�!�`���.��؞4l�r#Z乥��|CT	��zF�������j��O�>'mW.���*a�n���f�a^vb������Q,߻��w;���K&��@QPU=�o=���`�V�)l"��1r]؅������  �`hm��?�6ꋔg�0DF}"��e]i���:�������e���DU@�r|�
\o���
����n]�}�p)~���K�g�B+&w��r�ث\��J�M�6��_̄���:��{�	�j�HIXQ�b� ��Ni6N�|r��;�W��������=cI ��8�|Sđ�g	�QLF
�>��e�jf�y��R�E����%n�{�W13�a�ːF��g�c3H�w���O�d$��Ҥ����3iV��(�t@dpd��_�"(��,U�)PlO�v�[�q�]����~{֍ˑ~����^���=
P2
�JX����[׹	�������ZXH-CϿ���NA% b�K6_�@{ױ�ͩ��]�3V/qȧV��[)S2@8��G����|�aU�9(dŝq|0x�����|K��2^K��{R��
����P�RP_�<�85#��[���W���6�
*�Tp�BP'wO	��D��:v=�_�[����/uug�G��h��W�Aq���G��>eh��s�s�F%L΂
Mgno믆
s��p�!��G��l���o��H�������V��0a��,�(�' 燠{�~, j�0J!$�$�
��6Zwky�e eݒ 
��{�"꞉W�ڡ^���)�7r�<	1!�h1)N�yM�U�5���v~ч��	��?��4le,
�ЖB �Jɒn(G�E�(/%k�}��em��ß��^I	���\���`�d�N����,nze���ݧ.�E;:�_��&]�����u'a�Su���W��$j�a��f���{��#q!�zx0>�
�N��CR�Aٝoڷ��Z��D�ѻsGO0rrJH��'R�t��"��8>�j���C�UM�v��Q�`�V�Ō�hF��a��F�&��K]��C��q8���Ʋ{��m��?9�ЇHh/��I*Z.�
��!Ky7�W
���B�ַdI������J{���X\
Kr��X,��c7%p��x���7"���;���6�MDr=��~@~?>��EN��
�J�a��Z38Vk�2���G�P��qR(�HCK�@̒(�|����Tv���0
"���>ҟ���nt1�s��m,�
0�
�'��J".D�Y3wJϙ�����3\w�����겁T˵��!�i�"�
&�A0#F����vp�-K�i1ƘA���3�/�V�1���U����d��/Nm�����t+����Q/5j��:Y�㜞�=�#�G���*Γ>�pE�T�B��^�|m��^��C�� �\Z���A��id�o�:6�JG:�+�������5|j1�X�W�v{FJ��|�����ַ��à��j,��I�{ܥ���TN�2b���|�4W��A��ZQ�
d�O�/LðP����nY_M�
��o�|k�t]}���-Tg_��:����7�e/Y*�X�xH6<u���=���F�aM�/'�V4V>wcXe
۹-L������U�3N�Q�;��o0��dO"?ͻH�Q�B�L�oW9 ����6�oK�npR�$�z6��f�B����Ԛ����=
D3%��5��p/C����Ҭ/���~x9����oI`����hj���*�j��CB^%�	��\�NA��;��L^�Ԁp�$�͆�H�h�҇�d ���� ܹQ8;�xm����R�"�'B��z���hFל�X� �/����������,�0;3zʋdƥu����
E�X��M�=C#&��s�J��/� �/����qܩW.Ե��<�\��O�"e��Fe�7�KS���P<ׅV��?���Q�����<�P������ �8
k�2�������l��&��0͏7�}v��O6⥐^�u�I��z��7�(�iL-�kW�I*i�*{�Q����x�� �]���Hj�D�br���`��,�+��M=��;!빱9T3��eP|�����C�&Okc�3F�V�}S����O�O{�ʟ������4�hF�Z�)�r��̟X�O���@Ơ��)��IQ���_T��KTr�������D+�k��?A�������|k��\�*51���i�LM������I��SL��NG8=O�>|N�`�]�w�kmV�R�	�<��a1�S��LD�T��L�E��s��]�a�^�H�'s��<��H"=u\��=��qs�fv����,��P@��1�1��m#�Y����y̓ݽv�є��4��n=����(n
����;ε��&�˴���6pZ��כ�Y���G���I��C�0�].�alq�P����s%�(Y��u���+I�Z��uA��aE�Q>��+�s��~M��O�lSOR=�k7���m���O�$�T��Z����(���",���{����R����j����׈hL��
�0���} Ś�W�8
rV�Pi�L��ˎX>� �w�5�Ѷ��膁)@7��K,¾��1L�[`0ٶj�@�$!i���|*w�*c ��8w����Bӳ:�~k��I�t{ ��F��i_���n�A�z�]�=�^sV��ž�()���d�\*!�<�*�т<�l���5T�d����L��_������6^����q/~�������6��G1�>3���|��*�X��і4��!�>����D�f���~�S|�<�pg���G��.Zu��!��Xt�¸E�vC�J�~��!_��v#���5�2 o��U?�'��2�,2�d�ߵ��uu�|������\Z�6��T�	=�9�e!�J}S����6�.8�϶64�Yl�_~*�R�7]����b����5��Ʀ�����7��5�[����mr�:���Zf��8�%���o��<�}�xtF�M�	m9�IA������rE��&�����<د
A6f����ӕ�C���:P"��ܜd'��_�{<EGt������
'�"��u*+ãsB
/�|	8�k�)(v\`�#��r�����:��_�"�dh���y���z���|]����t�'hU���e���u�\DKw7ygO�	�e1� =�d��$X��5���Āe�(o�d)`P�B��y&��j��v�Wk��5g���ҟ�m�")
��w�ߌ�ّ��W���v@1p@"H��=�*
.���1�a�����4� ֵ(ˢ�s`���#��o�cR?����Ͷ����&5E�,y�/�,�fD�17�A/�S�!���ޤ�3�3c6f�Բ�.G-8��K���d�^A�ɪ/�I'�o��wi��w�`DAS�ՏY=z�����:���)�y�E�z�`��S�-5j�**
*��.TH�i�r?��<�zu��刻����3}�PhN�<I�Vٳ+D�-�T
�@'b�rL�i�������}-%9|�rJ��?x5x2�vc���5���8�@"��#������z�)'v )�qm{��ҙ����W�R_��&�SZ���J�>�{T)HEZ����ߏ~$R����r75�v�ѓ��������h��pP;�"�3QgvG�?�w�	�lȽ���2�)��7�@)��"��&>d�����M��/�υ0�Y�+���ծm���6n�u���#��ϱc'k+g����[s�~g�:�R_�=�l�e�w��ʓ�cG��29����I�*��,@�k�=�=.�B�h\�m�_yܛ�4����W�0�J-�h`��r��t�M%��q�r��N9�&�C��ʺK����� �)G~ϓ��!��C"�2ʝB��o����sB~��������T�d�T��-���%ƿ,�����0譒�ˮ_�[iBs}�����M��x�Z��k��_) ��8dmX	;�%�!^��-���Ez~� ����Q>v���<�Ǟ��s��|/چ]��(�*�$��1}-di��.j�:B��Ȃ~�p�PP���~�aQ�p��_�U��t����y9%n����Q�ë�=���$��E�����҆��+F��þ��|
틗I1�x�t&���-D<���V�R��Q�??��W���CS�q���h�I�ɗ0���*!X��^�8�H�BU47�$���9zs���� �$���b ��)S�`D�f�K���� M��a��(ֳ�ccq����`���ѓZ@e3Un��6A�|(��|mγ�}DdT�M۷(A�l�j4�[2�|C%$ j����P�ϡ����m
%]���1\GȎ��kaHC)���E�����LDo����	`Qt���ic�|ha�j������u53�m�E/n�O��w��Y
�_hN pG�O�������l�S���ͣ���ŏ�ծ�$uqd��[�̤������(��8[�~)@��O�a��W_e�����m="0��\�HE�d��3̐^��3�|%&`%���Q�C�&/u��O��:��&E�z_۟@�]�-�	@������>� tǿ�É�����Q����ץ�Z�֒�����ۼ�P+����2�����י�Qm���6v!e�=�y�݅���w�Pm9SHP!�B=�#�A�6��6�WϤr����w�OA�|l�X��(�dZ�r��[Y���$�3���'Y�Ù����2C�P��H
��

)�X�e-(���� q-�����e; ��1[kɑP��_[��w�I���@�)C=�	
W��#xs��I]����
Eρ�n�4;���=>kkt)�U�*ެ�佘B�EW���K+,v�<`������!E��&z�c�@@1��$����&�����O��wH�,���X��42OE�r�N�,��ѩ`��ʹ�Z�~w r`�/�a[ ��ƟY�����1(���^3_�R���kW��U�'6?�k��$��ܾ!I1�d��a5��ŚQO�иg�/�ٖ��LG���q�^a�?�����KEV�t��\6'm�o�f�`?9Z�����#������^m  ���Q�p���C��5 ��B���`;#zE���n�d��jS�l�9�yO)�[�9�S��D��N�&jpzas��A�dJ|��	�֤"�1�<
����ↁ�>	g����H
!����ɼ�/~�^��)�7���HCQلt��|F/n��$��D�P�dL����"n��5���+����7��ȓ��@]�~���p��	�Z��$&!���>o�{��=������[��:������)�&V��O���Qm��c�|�R��a�����D�(%��nl>"S�w�%����3��=7L��*~���ߍ��d��y�ŞH��E�7*�.d�D�l^Pqp`#�o��]�]φ��Ǝ�;�[�׽����dϦ[t���P����55$�� 6
�?;��&/>�<k��LB�	Z�5_>j�W!��TXt6���:�}*���J���/8s��i⍔L�ZiI��o���ߓA���69���*�U���H*<��ICQ�\cR���*h8GF/���"l���c�d�n��+��l�Y�!쐐�H����z�&���3~;pN����ܧUK��/u.��]�y�8����4&�]��a70"���H�y�S������1��ݦ��!CS������J�>ۏ(�7�5�<������P�1B�O��&a�~e!GX�oAR+ϩ ���Dh�S�x��:T�9�&��԰10���T�ߋ�C�Oqw����(A���,���k񎑹G�7a�����|���k�f�������ܒ�bk�\��+��.8=�E|ˉ�(2���̰���=�5�1�I��%y�(ɀ���ć�]�\>xuQ�+���+-��h_�"���lc�M���XUC%��Ky��#�ZPr-�-�Z����% d�ߊ�`f�T���_�c*�_XZ=]�rz�Th�
���Zr�Hku0�z;p��w�Ynx��H��H��mtP���Q�)lTS&��a�ӧl39���W��E�� �cY�@�ڂ���P���WV2e*����R�NJ;Z$��y��G	�5�irt�m�qT �!�� 
O�����6	�W�B�MEN����,�#X��p��Q�+u���b[fں�^������8-(�:�ms�'^_�*ܿ=k���d	�mSs� �jp"%��Y�b�0.�r��ϼ��J�]��N��f��e8�Ď��퍗�[F���ĉww�����[��q������&����@��	�Ǔ�c%�����ó� ��R�s��=��;~��gn�d�$K�9��?���RL-"�6PU���4�Nq:D�(���4�V����b5�v��c��J	!����s�U9Z�'�����m_)T�ި�*�[�=\����g�d�ٞ7L�RUT�����66 �R�.����S=�.D
�ǏR������j[�Dn�R����Uk�)e�>ay_+JK����u���K~��1� ��I�?�
������'U�]ȬV��4È�^ު�M��>�|�N�`��ug�i��Vt9�;)yhg�)�+>�Fm_ Ma���)�̴j�뎻'��l��YKyD�)7�&��	w*ƶ���-R��NG+�R'aQ��&F����5ɐ�����İu�w�4�3�S�u����>))̯Ω�f5�l���Z͸х'�־���2.R��c�՚
�śW,kd*6��A~�5!����8��rY@��E�s��7w��Q�������0�h����
�D�Ĵ�Rz�|I2u����ABR��A�(eIp�'��؅Y��i���`aH[�D��_~�ӭ����[�[Z�r�[�FF_eN2>'a��qH�>�����lL94�s�$#r�"���ΰQwǅ-~e���
_�c-v-8��!����z+J,�A(�S	�âx[׎�# J6U}��MpH��#��qb�K�����YH�B���|�4���y8(@?����t�	�j�eD�X��'��e�8>��ݩE'�X�)��I�&��Wը���<_�n]d�!9-�+B���d�t>��Lh�d�΃c@���J~tG������׵߻L2%GP��J+���a�S_�c� ]pl��f���N1�`�j���UT^g��^��a4<H
� /���%0��M����ie��ȁ)o����6�':��{��Y;��L�Hfi�²b,�m��k���:�6q�n7�q�,����B���-�A�ƙ�c��!.{g�ճV��[Bk�����ɢ��1�� ��a�%�����'�@����/g�P ���P�W[�n`�p[�בG���i�.�A4�+��^�8<G�����:�����E{-tb�o��)�.ǀ�>��z��u�p�4BZ����M|f�^�5�1�d�u�߽y��1��V/UG����&=�n��3�����nb���g^�%K�G�k\��7�L1Vy��
���p���K�=y��KT���_^l�Ǆ�����L�Թ�ť_Ն
G���ow�gC�x��}���T%�
������Z��̬M�_��Y��ԛ�B�~g���
b �����0x�����WT�V~�cY�X���ءK?��!4,�����Q$*l3϶2PY�w���1xM�ɰ�Y�����`�Tㆰ,���
��Ȇ���M��C�2��Y�h�qZ] ���8��	ңP�7�Nf�JdE��^(�a3ѷו]#w.�2URi|�3��+M������MaB���:ߊC�·��R�4�֯�h�d'�&��|Wз��o��W0�(��<�ǰs�4UͽP�:�=�^Y0a"�ߍ,�����}��$�T_-3�O4�k�@�~���B�46��.���{1?n��\���{��7�����p~��4�c����I�n� ��'��<��-9���l)s���;��S�Y^̏�|�
������ï��9Ļ �x`xe����H9�z�0�uX�מH��ϏLi,q�.U��7X,_���G�	:7��δ�@�S��x�Q�W��J؀�\G3H*�N[���j2��7x'�݂o�ѱ��f�T���~T`�b(�#���&�2��
ګ��
7�Mr�Vٹ[䧇�O�C�5<��w-�3Ӣ�����T��qx�~��-�	[��m��ݙ��_�*2��Y��&cW3�ۇ�SIj;����UC�
�Y·�H�Y��7.[�B�Q��L�B�� r���?�$]J�*}��
��/}谺��l�د��(ֻ�gy�i��R�Na�7H0 ����
#s���Tf�R#f!�̌DZ)s�9�+�f���$�.��1t�5���m�/=��r�-72�[�g�L]CX�s�Rf`87�8����*�]+m'�@N��M�i��k���F�YG����;������b�F?����؏��b�[
0�z��r�z�-P�������V�q*)B���X�ƦR�3y:jG:��F=�0�'�YHPR���\.�d����I�k�:���>�ۿ���}f��4��ޭ�A�b�*}�n!r���p�{�p��4�\p��lg�6�cm��5:�|L�Eo�t�-�җ�$L��x�0���7W>���e�s��ێ�X���K�R�u]��_I3pY�	+��䓏��+�G��~_��U!��>Ј	��e����U��+�� ��픖��ť� �Nw�g�\��H��3ebG=�R�a���At4����c��)p�G�  ��,�->_g������S�� 4�����z�`�S;8W���D/���:����h��+%Dq=��[�|<�Ybq)7>�,�Sݸy�Y偍b�D
s�y�7bA��*�\�iK���4^�9��c�2 �Ȣ���I�<>{�$�A�������|���%0�Un�8n�9p��Gy���W<HE#b�T=�c�描] ���!6,�� 7^q�S�p�Z��X	�`��dH�q}�o,r����*h�R��V;*�ܰp6�F�$�n�Hz��qu���V�lk\jISX����p�▎�q�/m���{m4�j�{�Z Y�H�ތ�bh��|�>�^TV6~���e�~S�KL��-�`a�_�Cksk3T_ �ej�0��qp!=�$����6����lLi���yy�fp�*IҴ(�ײ=�,ܐL��`��l���"�Eӷ�D�F�\b7&1���7��V��Wp�Q�b5��1Ϧ1�HM��m�������$�E�z�t�7Ej��ᏬQJX��X$������1�4JQ	61AQfް�쭓��J_���,�k�
�J������K�P{���y�ְ��l���x�i{�$��r"�Z%�r�uՠsU���9��M��#��=ܯ&�O�����*�>O�ﾬ�+pB�}��=����z���/Bs��Wl}*���_DO�
|�"�C�\����Qf�ΤA"��]g��l�4k7�
i�ckK�#,5��Ž�LsV��ٮ�9U:Y��R��d,�덛�.�s4��1��솇 Y�}�3�/8m�����5�J9¬�+�� ���F�;%V�*u��B�>��S�]3�h������,JS�	S����x S� h#�&kC��#䁌�ev�v��-���-'t�!���܀�
��V$���:�VY`2�w-=l��u��ު��R�J�����$` ��8�/�����:Y�#���h���U��?�X�����b�]�>��/�/�Sn�(7����!"zPl�ci��1(?��3�* �BҒ�8Wg���!�њ���p�c�2:D�c��>t�|��CKck���m�qg�QEv`� (�n���e���2O�8���N÷��д�U&t7+�����I�������0g�'��$�+���83���A�J�}T����d�*��j��"��5�j� Ô.k�X�A�⽖��ܳStS?;��|[
�=dE
��{�G�.�ts^�;vb���0�D��2b�@be�0@#F���`�9�{=L�O������e|M�"e�S:W��=�k��'�_�p��f�E2��f�g��-�xqDl��b��*�� �]�+�W)�lI2�
0�[���	���B |,��?!<S�7^�{]����E�si6r(E�h�����.U�
�����8�G[�wW��`g� �V��q�*����H��b:?��Ԯ�΄3��H�L�w�ɯmgY�(���/N�&���FOu���v"�3%�����\!�pv��Ľ�\�J�pHyS��=f����J���W
��Q� �1�R�x�ɳ-t�g�v��:[I��ܖ�p,JS�Pu���>�
������F�y-�l2`��HC���0��?�&��B�*Q�Vϧ=v���NZ��j���5��.h�Wd�x���	q��Qb�4iU�ؗB��R�O���ra;��Ea����"zep̿Yus��>�)�$�g�HU	�6|#�8���H�` �@@� ��Z|����=�`�8DrW�U:�
�#��aɿ��ΐ�]��9�������@
@_I�wȉ�r3j��ն�5��ԖE��Y0����b��'��4�B F�@��7O��~��/x���
Lbq��� ˜�@]�F��%λE����8��%Ĕr�/:O������w��R�ҍN	0(�",x�b&I�>x�#�Ϙ�r� ^�}^�ybD����� &���
����t�S�̚ރs�>�7ՔP%��Z��t1�2|�m*Fe�ƝR����
]�߿� d��DYZ+������T�+���7���/7�M�n�B��.����\�HvYT((�|\�vO��ssLg�ߩ
�#��d�wɨ�A�3� Y?U72h�s�Q��#^�ĳ#�
f$0��ȍ�8���<"r�&��$}�-m,�^t�z���������kl��e�v���}���e�g�=��@��4���:|q��s,�����(X��pD����dNiqEgK]��Gx�i�aV�:m���&ff�Oc(�FO	
�����
K�����-�K9��c<�7���k@��-A/Ё0����q��5]>.�V��/\�ܗ]q߲�$!�Me��Pᄎ$"&5`�W�S=h_��տw�<������	J�Uُ�F�l�h<�}��!��7%E�	q���Lu�������5)�+��ƥ����-hut���`Z�������L��_����v�n�M��lL��9BZ��{�|E��a��J��+J��d�֣��m
f[���x�Z�\�xl�g��~Or��j9
$6R?��[���U�@�S����&�p�|�sC����]0A���|�_����x9d�f�u���0���Ⱦ���B78��Y\�@uz�Vh3��D�¹Ž��jԮ��}�եp�@�F�V¯G�}�s)��q�+I�R����� ��J�K���~�x	�c��`Rk�<	墈5�cP�A�昢Ʒ�e��[\VeV��tȓ�a�oN?l<�4q���U�y&*߷��sB�G�?_*r�y��`�D#l2B���������@�7�V�}�	G�Y=�4�~��� ���cfB��ȥ2u���݈�Ѓ~	T�L67�~3Gd;�d_�V����p{|����<�g���ѐ�>��^�B�i�U�<6��O���g��pe�ݞ�/�����?�kY�13q��"<?�����Y7�Y�ى�ݜ��ΩH�����w����ɶ
[�^���ME���y�斦*lι�αQn��&ީ`l�5��(.k�Y4��,Y�
�3��AR��;�Λ@�^���G��k;]�Q{&�
���I���Ն(�I:��ݴQo��?�ˁ��aIT����-�v��� ���8_���է?j;M�LP������J���
�=�L�oH����gR�5PO6l!����hze��҂����[Az��.����sP]��╣��u�@��FŜlԇ~��_M�����i����nQ�A���1���[v#�O4k�P��E�"8iT��LѓIM#�����	#�r�-�g#Z�����p�t ��I>��
��a.��8�Yo�3|igkR��W>��S��Ah�+D z��l�F����0wy�[OV�9"	@G����<� 2 �4b�S_�:-z�9`�sw��r�D����F�?��xMMBtEf�"e���9����	�%X���h���Q.�leۂ}��0ֽ�}	6�n��*�ì�/G���/��ݨ�6�B����zu�+Y��h�GNI�^�5���aԖ�1`��8w^�g)�hS�2��X�<��_nN�;�ϡB��[��Z�5}��:YT
����	rkXi���D>Bd��_��P�%C�_��I|�'DC3܎o�����=;w0�6��Q�]c?����y8NL���=��6�:.ع�I�4 �� ��>&d��2�������?��S*�>��٩��n+]�`Io
�G��N��3	Bm;�}@t�0szm�&����G:! �Ek�خx��d�K� &�h+���J,��=[j��c�V����?K��9^�"�� ��.=7>5�j�Qb���ɍ��Y����K~1k˸�}Z�[Px�Fy�
����7K�^�r_��M09����/�*�G��9&Q`E�k��|l�<W�`���̨Lc���
�mI�QQ��%6��tr�6#���	�4r��0���1��cc�*��ɡv'>�����Hv�?ŭ�|��rΠ�j4x&�W'���2Z8���;�����.������7�̋	i+}��Uy��|��Dw�g����	�0��7o��\�}_����o��k��kfL�j�f��M<|;p���կ!�>=<Q38�\/��ha!��愰E����8�3�0��F�)�q�w�x��{wr7
��,�����@�*�n2�S�t#�c�E[x�4mO�����M��,|���p���ß�i��
`��GK�CRړ���gw:��^؈�a_��+�c�9�^X�T�t-�}��F:1����P�#|��!�v�7��e��0�w������Q��Ȓ��"�.𦻰2{���ɣ�Ĵ��ۥR���Y�I���q�5�����M�/��	z���:.@s~�=nNˡ���Q�X�p���7�Kҵ��|u�JkT�
@��O� ��v�����Kbt��ݦ�xҟ�?=�!�gOwU�S�A����}�h[o�ey�$A���7Ӭ�_�,�fZ$<��j��ɤRK/4Ow��%Op��j'g�^|��#�Q
���x�ƛ��`i+��tR߽��s��٢��r�$�HT�6U��	?z�w`��8��{��#u�⍼l��cc�熭e��X�,�t�p�}�
7n�.-w�� ��In�Cΐ�����nR!��@���
��8� ��N�O�ޠ�ڎo�l�F�y���$��;Y]|��#�3	J�TGs�����7�;��Vq^�n>�������H�����t�8��i)�*3}<iQ�g
��w�P9����Ɵ�U2��z\�q�Nfs�J�����穆���ߙx9,�?3�&�w���}��օ��yc~\���<N��Z����N�����L�j�s�(���r_P�y�zv�b��:���l+e����"h����A��2q�sˣ���Z@��UP��	�*z�ݮ��
@r�P,�E�Iy�y�kr�:/c�v���J|�Ȫ��D6� ��bSu��Yڵ+�
&Hq�j� g1+�4'=y�y�:ZT/��ra����L�<�J�hKJe��y��udZ�����~��%H��c�XD���dt�����4�!��BW����&�×4Xp�CG����D��`�W�"p���4β���Z�<�"����֦玏��M5�'��'`@>w���H��N�+o}�O���~��X֑6\c2�3���"'h�3����p�:G1}S7�8�짦�w�n���
D��ޚd8l�9�����ڌ�U��.��il���oD��/F���x�"�j��wO࣊e;�}��w�	8,�QiT�IG${=g����8���!�'i7Z��-;�M�V1�IU�'�Q�L`�`8�?��#�7¹�؄���S�fG��q��
O`�td8�H\n��{�O�H6��G�M��:?�\)����8�b�	=��/��g����3�XtX,�[��г��S@X4��Q����u�P����rw�
�@��D�_?<Ǘtֲvi!��r3@��O�4�=k���o����jI,4
��v�����q��$�&S�� ��f�~l����N�7]�L#5�%�E|G�i��**{�y������rN
n�b`��$ۧ}�?��sNI�1�X��T�����M\�MoU��,Do�Ua��m�vk��-J��"x���M	��XmJΨ�Ҷ�
�v<�2w6Q���Ŷ_'
BV1fW��O��h 6�A�B�����.˧�I]�^����1������q�Zw m�m	���M���&q>���%T�WehH������$b㲋+�&*=���&�gT�W�#j#������z���fܛ�>̱wM�K�z���]fZ�.��BgK�C�X��q3S���dW�Y0����^%��՛^����Ǵ4�A�������	F�}��)0�%6KT˞��>�a�Fj�N��� &�N�h�V�u������i�|��:�r�#�9����E��,�5l��0YS�����9Oh1��<�U(�u����y��3��{i�GM�s9��A�[��3ـ��0�}�
�T����0�$�ĵD�7X4�!�.zl�I��1���~۪"G\�k�pAuH9���nA �ӑZ�,\U@ f=@�G~po���$��Bv�)vM,���$����@�\:ȴ9����nW���A�<R�1WU+���ʹҕ��y��J�䶾/b�\������^��2�U�)�<�t�X�Er�t�ҏ����5�Ne!gj٩U�T
}O�(r��2%e����J�S��d�͌:�ǐU��N#��s;�Fl�
7��,&��>�fMD�(�u�Qp�,�j���J����-�_��vq�|t#xU��fʫ�����:Bysn5��D���K�'u���c�������^��E�k?>��}�j ���H,�>f!��2�������[�yDU��C[�|�<�/%`=/���$tѓ�
�ʹH��
׌"�6�
�1���p�mǾ8� �f'���/�� 6� Wgp���o���g�8Ć�
��"h���j��@[H������9'��lܗ��;� �q�(�A� �� �?y:�:;�>1t*h2�"�y�d��~��$:!��X�m/���N+�t�����0;8�:8Λ���Yp���x:z�ڞޒ�,f���T���<�<Q��q
���=��ryy*��`�
I���׎���=�]]z�I�"g�m|,�*ѺJ�d�v��� <�ܾ`M����z���QH#�5�m���r�"'r�U>,�#L���S:����#���:]��*܀"�H�v�,`Np:�t�yش~�Y�K�g}����5�2Wݏ��50ڂ�8��̜������cgv�x���q�cӝ�����/H&Y���!Wmz#�RH��6\��/�aحQ��Xz���LD��!�C*�#Q�e)Os�{_���DuIόfDϡ';<�����{�M��[������5M8��l�1��:M܄N�ٝ�tA�L�aF%�,~����H�qT�ҩ|f���s�{ɉQ&t�4�^����.^F2�����<t��Q@B6���t��v�%�Wh��վ�K�Q��a��.�^*��
�Dlg���� 
~DX�E�ɟb��a���O ��o���c̊iDF�Uj���w��Z�"Mh�_�v��j@����ø�g���r��u4���ύ��Р5�L��}��y��m�<�[�t����a�Sc$~�@�s�YgL��j�6{��*;������%O�ɒ��{���G'^���HNd"J�v��cJ��� ���Rլ�Iw�Q}2�)���l�d4�@0��M8�,�jI�KL�Y	x�q��� q��jvV6ۯ�I����(� ���m��B,�j��:ֻ���p�`"���LG���T����v��]��v���P!#��u#۠:����7�2V���շWI����Wuo�+��Β������(����ꇮ���
k�ш��;����Y�w���w+�^��K$��=��I�hʛ�?%��a��k������ YR��煿4��M��Ó}��O$1|ʎ�xt�[|�F�t(u�����\�?!��?�5LL�_�*�_Pl���F���e�Shؠ��p�/�\�r{��������_Wz���{�<��6բ��
xZ�t����Xuo$�8�ƎV�3�ԂD��mHtϦ#���w=8Cw�lu�=ix���Ym��&/zh��QGn�l�C�oc�L3�=�?K(����CUM����٢�n��n<#5[�:�8�Ԣ�)�O��,��!�o�И�^m�|�u\Z٘�(!�^\���z��ҹJ�}��1�����2
0�	�Ϧ��M�Q��ў#v'�i������%-
,^I�x�M�CS��Ǧ������v�,��u�f�v��"�RO��(�u�a�>	QE:�Â��z��s{�K����&ʮ��n#kl�p�Ә�|bU�d��A_-W6�~��" J�k�2H�lW ��K��[�v��� u$P��C����B�V{��pY1�&!����C�Zy�-
h���e~��`��XAM�4
�R|{ÑM�-h�f�Kr%i��K�	��}�VUԘ^K,X0���b}3{0��S�^���y��e���IHTzc�|��4��s��o�w}k�dN_:�W*Oe�j�����cF�K�sK�&����$�r�,{�4�V���)�ޕMu/.nRcle|d���IzBa����_c���j�'%a��"}
.�z���Hx��x�a�!�-��i�����b%J�	���V����¹U���^��ݪ���(�����n5�����ӟR:W���-�H����Gu���-�<��z
X�����Q�*3R�Ǟ����
�O����0����;^G��1l�Q����[�r�`��7d�*z�l� �I�!*�^��X�۬Q%z�R������/oU����<���>�ΐ����,����L����4q$�e�~9�
l��7m��(���1E�}���/*�Z{��]���w3ٜ$���"�����Z�1E��o� G�Y �rd�:z �v
ǯ��ǭ�L��SĪ���9@�U[T�n�A��IYc��Y�N
�b�����Hj'1�p�p�[#����Gq*& ��Ϗ9�w��.X{���f�Y^�14<�7}�N.�g�� ��ۭ${J��Ҷ�'"��;�;0�_��-�9��\�~~���,r��M+���8�,�fd���V����	�M�;T����\KX��?��`����Uu�$q�N8�������*���&L�ז�����i�6Y��P�@W�}�+j���_1���/wa-��t�0�%�.JI5�p����mU*���/���B�{5|\�m���'!:�v�&���fg�mϵ����ّ�8�au g0���B��ZZ.qF(��X��~��>�}�f���e�Md�D`H��'���O��pCMkhO�c�����O=��:R���7f�����F���������b�Y�
��;��t�.%�������yK�4����QO�yi{�,<+@KQ�
p��aɚ�LMSD ��:뗝pN���htJV-���K�%���u����ϻ���*�����"�\�jO$�~�r� �qPS���}f��{�O�֠���W: ��H�Bkᕯt�t�e}gx;�>��/f���>]pR�R+�G�e׶��4�e<$1�=����e�����}�WX
=ao:i@�4�й�m���ca����_:��'
c'�#����r�KJHs^�� ��/�
)��<���4sU�l��G�}eB$��ѕ-k�q	����~	�5�|�ʥz*��F�4����<FȰ�<��G���>1☶w��Y�vp�n��T�=���R	+�=�J�(q�`���T�hȣ�#*�NΒp.��֒1����v�9S�c��_��#�o �1g�w6���'J_�MSʀ���7��C���&�$�j�9��
����1a�e��g|6���΢0y�wV^=&\㹚.�t��,� SN�6��7xo"w�+-(����*��w`�ا�������A�n���
:9���+eqꚕ_��%u���;�=�d�����23�h&|����7�pER��}@$ΰu�2[��z�^j���c�����m�t�n��C�i0�c?�RȤ�@��fw��'�kju�(C8V�$�ӟ|cޛ������1h�s��.�g\�~�4� ����;�������>�ڐ���7��-F��6�2/^i��5��s��|�M�{��os�����A���I��Φ�0u�� "�A���1W?]��rH��׺��d���l�X6�S��c9��"6��f�RC!l����Z�������|XYt����Ⴔ��Q�uwU"=Na��=3y>�j�
M�_o�z'�H��%yb3Zn�U���>	s��g�0��|����l����N��4�o��N���#M�b�B ���\�d�D|'*�fֆ��L�������
Jֵԃ����6��ScJ�=폁f�I7��+����1t�ꯟ2lx�z�[����.-�������G/��w�9�+���N<��Z���
�L5��Oj7(��s�)(�g?�r��	���%��q�4lB�A��Ig����PĢM21̮�2<����|���w� $�L	���6G�L
5UAQ��J�5�"ŝh���\�E`��zC��GT]����]������bQ���}���p�O���%�%�kQ�@V�?��
LsfY�(�)!f�%Sz2���K�[[�K*Q��%�{c��s�����.�L��P��o��e�.��$� Ƿ�����s���L��~߲o��&�X�{�_H	ȫ����z'�-�Y�t��L�m`&'�R�	wj�^�#����݊�3�
}/���˟��' R ;�'��a$��n��K��h���sx���Vc��xG��������)xyZ��*��/���k���3���PU�0Z����A�̡�w������9�%���Bs�4���?C�/g��c,��`�H���e2�4;��G�B�e�3�i3���?�;��-cԖ�R����=���Z�LvF�B�=bhSW����8L)�y}�hER�5��W����
j�<x����:�^�\�|�*Bc�ݸy�����a�O�0�Nׄ�����W�m�zg�	 G�x�&��T���5��o��P�j?wh����⅙P�f���L+�+N0!(>Sd�Ra��*{�c�t��L+������oJΡ/�,�tG�!P���j̬j��^� ��kdm7Qt��獋ˮ�"ٶ�@XﯱRf��Ⱥ�Kd�c��� j�hh�8�e.�Q|q�j���w�Uo�ľ#��Q�I�Jց�R`	�%��'L�|v~`���.!��Q6=	� ŗ��A	ñ�
�2��K�/M�/
au��7��;��m�օ�,�[_S�\mz����@�B�F����Kۄ� �����tT��	ߒ�g��I+�V���6�)9�`��п�C��X}|�q��N�ϔ���Q��%�[6�m;�o�����
�3x���V���?6G�39���ԩ����p�j����_'7r4ܧ�]����[��v�
hXN��J�y�[��io�=��R�c�F�=L����i�9�����#ڴ
�Y3�L{C����թ�lp����x���p��墒��om>�
J������k*zu�;	=�������h����3����v���rJA<_���PY0�,J
h�����(	��{r�m���`Vl�;�T��
��\� 7�1���j%���of�n�����*�����O�D���Ԑ`�۠On_ R�g1Ƕ��~�v�A�t��U���(a>y���(�VC��x��تI|��`�蟪�'�?�������u��5b﴾�@932����r}�$�ia�̟O�sی��Nẙ�J˛�z9D9�F���;���p��A� �fT|6Ff*��;�ę;e��`��vJ�赧����c�|@��
s���5�9�,*i�~�|�0:�<Rp�T��=p ��U�>�8�M�%�g�v���
(
x�{,���Y���_D�V5��Ƅ `t(M�wFT޺<�z��I\W���=�O�g�]pÀ���z�V֖|{01/e�|�k/��::�=n����Si��H�wh��H�t�5�����D�z�H�+`g�ί����Y���e�;�:���[�@�qrlOD�������ya
[�4�wp����,�H0��#� �g#�h̟���6��j���v�?��`�Y�jbn�~���m��0U�p"p �1Vg���2��M��@�bݩ@HKz�fj�h��6w*_�'�g�ђ[��kf�,.��|�|ZL��Ts~�i gͶ,����:A�d=-�V�!dw[l!�?w߉<�o����4e>yF�U� `�5���/zq�S�D��w��Ki;d�TG�^�l���	�-�Qz�`�{أ��r�O�7��U�uG�ygY*�$���_*�݈�.S"�gO2ČɎ�݊�d�۔4j���
XC�߲&p��V�w^Y�	eu
������I��o�e�4��Sp/�=E��܂8�B���o�0NM��Y�]���m��C�=Y�ը����A�+������"9	��e�kCH30r�3x� ��r��>�iH<�cUC��t��aA,w���^駤VO����J�v�8v�~��چ�V�
�n��вqϓ �����Ҋ�+��ˤ�4^zO�/F�sua1#c��2l�u�����{"S����<}f�M�t��*��k����ɛ��i >��۲���I�rn*فu�6
�R�g���,:�2U��Ҍ�󵚎N��فj���uC��M#i�(���nU�_[exh�F�ZW���Ub��8����T����e�b6�j )m��MT��@Q^]�m>�^�.\F��"�]R���S*�@ه�e���d���I�d=���qI�*Nףo�V��nk8ǻ�����m���:��@�z��<�����������^I� �,�h���	��L�gkLң���,��kw�tB�돢�x��B4)ͯ��_��rF@T6�
����_E�L��S:sA&�c�f������O�~N6U*R�D⦕j�b8�2ge�G��O�# Y��a3�	�M6gL�DB���
�W$o7&}Ԓ�Y�0�k��dW�6T�Pٛ�F	����h��&?�}:��$��$ʾ���}�:*覷��� \,��GE��C��C�:]
�g�7�0��CnQW�د��a6���u�HՈהʽt�!�w'<.Nv���,9E�L^��1[q??�p��b�c�l�O�Z[���-_/������z%������ƀQHv!����_3��)*z��u=�F��w_懬x� j�(�r3ܫT�/��m��9k'�%J���{b�'q�9��^���y�t�e�xY�7�!��4괥�%��]����HMK%6;�/Z�V�
���w��>|�R��5m�OI~��۳�Y��y�|�N|<��O)N�V�4'�?��-`�Z��7���R�5f����3v���N卶cP����	�b5��p��1S��� �w���U��Ǟ�gzd����tmU�y�ê�������1��6l�ˣ��/Ge���a�l��!@\�<�"}������?�$���8��ߕox� x�.��;��ެ�0S!UKh�CԖNH����jr��/�����S�[M[Ι�I�	m�W�����u^;��	Yf�v�B�ԉ����@��\�覴��~EBI��E%�� ���4��[�XGY�ٴ�.BWvǵ|�C����<��6�E(���˫"c�L��F
Q�ug�<�~��
�Or>u���V`�g��;d�D����~i?��{v�EA�µ���|���S����Cvǯ�*lf��F=H��������,^���4�U2[��˟}x%'Z��,�mz:����z�x� '1� �c�	f5�2/u��(�@�q�s�f�+�z���a4L\В��.8мc�c��#�1������̠I1���̫�u4nW��g�=�{є���@=b�!�\C���ב` ��~��p2�����U�L�X��a襠Vw��D�4r�>�����2�L��rT6�/��TPn�l���n�UҲ/d��T�5B꽃�Cԉ�_l^�P#f,���������A$r]=�8�+q∷:Kr.l��S�+I�d3:&�B3u��bѭ(��?R�InèW�e�o�u����e��z�UI�I�����*.����5iU3�Y�JM;[\��x���cQ�����?�ء��d���>����"<�ԆΆS}��5��G	��qܫ����%u�R^K��`�{E	���e�蠹��ߓ��3�2ixפ��+@Fo� 
a���{g51J��n��b\}}��O8R��{b��QCX]���ѻ�Zz��<���q�ܘ�+S�V��g�(�ɨ��k�o0���'H����Z�,�`�M;d�ŝv؉	Y,b/]w��fS�Mk�M7�������1@�A�<�Q��\f*2:s���H�@zx��I
�0P��N�Ϲ��/Ìa����{˞���l�'_6W�ƝΠ�ު7_���R�1UZ�y���ATk�>��A}��U:e5����o�47=Jڲ*3�3:.�c��s�o�:R�l��8��0�y�d,���R�I��2Z����n'_r6��������n�����Ia-������,�XUv
���h�>���+��"�̶���TJ��+���*�|،�HD&��b��	��&�V}�P���$lS</����[���$���!SK��/�$b���(��|;��3��l`I��U0'PZ_�2� �nRО>��@C�+�G8�W��@�j>���- ?K�Lm��H0�{���o��h8z�mKt�&{tS��6���d"���L��g����kX6.y����V֧�^ρ;�д���f��|��3l·�`��n蒱�c
)�x��-��v���0�
+E��nN�*��<�����;n�{{z�a�݆W�W^3����>�>��A��
����c�VAh)��N���Ǹ�mO�7ɹQ�ͅR��xgk`+���c8&p�h�>1��}I�N�bF��lpO+�A|���T6���[ڶ�@�FT©GB҆)�T��"��?,��j�#���=�UO�N�]=✠�ÑY�#=�% t\r6r�<�|��u�蟽��
�j�`�t�O��*��`�ˤ)��YtQK\���F�0K���wV�ȵ1���$��.������������ޓt�q]��1�q'��!�t5�Or�����Ŧpxw$�H���F̶����O�PO��.Y߯|+r���Y23k1�
�_g��sCNAWP�,�r�1i*#t/K�P��"(�c77��a�uF	&��"$2�s蒿b��Z���&�;�� 
Lm�3.wP�U�� ���=y��t	u�7	k�����I��J���i&��U$��
�xD%5`��j�|�Ԓ����7����@|�7Ζ�ԡ�U3}�?Z��N�� ������$�Do�l�PP��|�*-�
���<i�ip�v�/�RcՊ �t��T��J�J���Q�N������Ez��(�'UT)�A����L5�����ɸ:U	?��.��(���d���������%�s���}�R��Q_�064!lQ�R�'L��>�% qr��{�T����0CJ,_��8=ǽ{k7�c�(�_�@��lZ0q�hv�1y�����
o9bo� �{��s�����Ī5k�A��5�[�v3���%GZU�6U-�7H����}Z����9�3�������:F��D�퓁j�vf�lt)@#�����/.qK��\9�`/�6�R��`�6���~(?��l,U[F9�
����pΐ�Q�/H[x�&�b&z�I��V`�`����N*i?>	�t�㿚ϱ<���W4č������ZRށ���B�O���;�P�z+��np�hi"�|��E�Ykb|G"}�#AF51\����#���fe|��e�뭓�o�:�".���|���׌��(Q������v�l)�.6ߘ�OH��z�#��B���N���9ۜ8ad�L��m��<	"_����ޢy#4��%�Qck�=����#����w%n�$�Q�0o�����;A����*g�.��˒&���B�8����4�й}7`���R��ɀ�I�rU��%��~d�pd�׿�%�r���\��*������՟=�V�e�`������4��q�W���?c<(A
��(��Z|�#�d��w��-ƚeY5�����&^�K�٪߈�
�x�;���O��_�'�{���w�4��d���4��f��X�q	6�n�ߛ�I5P<d�3)i9`opܙ(���%�`�Q��I�U��7&�)
��Y�����F �PYg�����q�\>����K�f{�d"���Xg�|
&�fwimH��t�Q��0]�*�a����~Pr�Ma�$��q���G�3�}'�^���OU�^z�f�����aR[�~�I��@�.K�9τ�Y6zj���_�Y�l
���~�jc��Iv Tu�\�+-�_Z����7#�H1-�֯�����^�߮��J�k�_A-yw;��59��&�Ol��Y7:��(j�!��zfCK��B�h&��e��뒺{�=u���>�t�������_&�Z�m'���
�,��J�cA�� l�8���\�_w�H��������n�87�?�y����Uhwg]v�}�5���u�1L(EQ�C���rAw��1i�jȷ0f;�O*��1����!�b\,>�D��C���)�i��}�cG\�M��ez�`�TP[������v��<�Q�)KF�;�<�>og��\7��7ϼ�$��Ϣ�9g���پ�:~����Xy�n
ɡf��f�Rl�`PdQ ��Y�S��ߣ-cR� o��}p��po�!�M8'����"9MKP!&r��/	*���Ksnm�(�u��E'4�Si�Ã���fZ���fnEn?'�Ł���Jkv=1;�r���bN�%3��f�M����VZ.#P���uS�����5�Y�4�
�G�H)�����W��du��<^s<�]��J���Ľ��e��PkvE�,���k���W�K۔v��*8�n�So�T��������h�Tt_b$}�_ŵ�Gͮz��i���>N��WN��#���}�*�-J9�ٝܳ<��8����.T<,+t�[ B��S=�)d	;��*lߵ;�Ľ._�>KfB����qxY����(F��|���0.V�����e�%S���61���oM�D��,�3Q��y����qT�$�P��p��R���l�BF��g�9܌���H�#��o
JmP�`���ŗ��[�wi�J#�ٝ+SZ;�yXv�4c{k�^�3����y�����W�tF^s�Z����[��T��e��/Hs^i;*��0`�0�C�[�"{f&Ǩ:,�I�4T.w�nA�{_�8������z!B}PҠ

f��s��-IRF���Hzid��+u1��R�i�FgJ6��]h���Ev�[�Y��� 0NMո�&�ޯ�G��O�$���)Ԃa������K�Po�y�'����/�d녽�d&rqX�<Tb�*H�^ ����H��@�pԐ�@A~l�d��[;&K��
l��~	&e����~�.���ԝe��G��<�3���v�ې#N��9e�A g~l1��׎��m�Uhf�s�;�+w�c��>�s,8̀�n<�R�T�C�����ā�| ,W2�Yl!�>��>}<��$ȍ|W��b.���)�tm#)�����k"����N?�g(��ʮ��^��%�es�R/@&z���wi�8�VzS�R^ئ��VZUIJ�蛀)ܾÂ�������K_�WH�Ik���g2�VF�:��V���ϕ(&?*�p8%��S���6�m? ���臷�U�u��_F�v���r�����~�-�/(�M�6E6W�IS*,.��in;J��}�7,��p����,'P�^� q��-f�Q0�o����� V���d��ϖ�ɼX*��61���A)»�
u������T.�i�y��t�C%n���\���⿩w�B.��jT(��֖(`�[��X���_�˹F�8E
�5m��1n]��d������N-~�{�</vl�JH��X���ٴ*_< Q�JYz�B@4]�v}b�y���ik�^��bo�{�@_e��*@�-��h'�ł�$����,(p'���S�1�r�E�t��R��"�U��t�٠��\?��'�b���)���@� ��r�;'I��:�)V21� o����<����Ȟқͤ����Wh�FF3S`́�l���#��m�>`��Ļ���\	�)�7�"}��yͭ�Ī����k5�=,�٤���R�`�� �X�Y��e�ȯ�:��BШBKn����aџ5j؝5ٓ��4��U5~g�jZ����4)�؏L�B>���`F���ݒ����{$)]�۷� :b�&K[7���v)=��_q��2o��tv��5�lC��� �K�%�X+�b�*������
'�A���j0`n�����L���s濮�+M��p�>;|���lא��,�Jyu/��_$�n=4�|�]Ӱ6o]'ԭTF�j	�sZ�����E(H���R�R���7±�i����PO��n�^�쏰��jg}I���Rs���7жI^6��?�bq����������8�����砲
����?��@�ď�G�d��S�¦#��;�k���ER:}r2Fba�t�`U�t�&�a[^��C�j�4��>I�ɛ{���?�1<�&9d^���3��@��E�V��Z}70u5�߈���1�Lj,��U�`�PM���2aU�q��42��F'!c¿�<~V�16K����6~�Q�J�ݎ�a���Itr,%Lٖy$]��INw�Z����P����\�Q=z�Hg��R�E?d�[�~ީ�_�{{�ys(�xb�]�Tb��F_Ui����'�������l�%#
CF�~`vQ-nVa���ӌ��Kꅽ�E˖0����>ލ�YT8�xE�[�;%!�5.�������)�5ड����X٢>���=�7�������ђ+�T`P�NC����<
rck\����<���B	m�~�HW�J�E`�rlZ����fx�+܏�B�h�D_����Ǝ]� ���t�4��aG�D�� 0/|揩�����zn �`b�����y�g0���Տζ�UfbL��i��
J�צ���U��[�K�K&��E��~�%��W0t3GG�5[��|�w��	+C��DI�#D���,FR<Bv�R�g]�LeF�~R��庮u�Ճ J8�����SG���66(dpNd�:6G�8P��%O���
Y���ܱ�&���S=�`�<��c�}��=��k���%Ø�5}rӏE� :�l�4W%$���9�ٶ�� �%R�=4�E-������BC0<$J�b��~s��N�s4E2��(5
W��C襄hu��Л�E�o�Λ��%	��ɗ�tհ�+
#�j�u���5{�>�2��_�%;�h\
�a��0[� W`Tw}l�a��Q/��\���wb����y�� �TW��֟/C��g���#P
ɖr����nR0�]���8�
1�E0"SÝ�F��6��+�9`0��{���vP)�0-�p�w��^��7�J�e��w��b�a>`���n<��c��}���[�ah=�3��[�`+����Y�B��]�#t%?	�ӉJ���J�֓-��}U�8J*d�3-ߖn�MrgJAk |A� �o�D/��p�3*�>U�Zxs������BT'u@���>�h�LAT�=�HÁ����1P0YQ�dո���P���-�����J
߉�#+�g��S����:i��1v|� �C���KS��
�i���`O���Wk]eb�](�,�C�*_���m�*���R�Y(9��	�^�H��r��~�i��v� sJ�`w\e��}�d�/eo ~�����yW�oK9čЛ[�뚍�ό\���L�/B�FL^����r����l�A���_ߕ�-��AŽ���6���f�NO��1��3�����c@鼿z�Kk�6���-X$��R���O���B�$��Y��CѶV	H���tg`Ϣ��+:�Ɩ��6���;Yf��WS���+�vT�U��&����z��#1��h-�9"��7�
ؼ�����T�#�a)$��<�	�Z��`2��I[7Zjޖ���5Ov�ƪE.N&� �F��2�d�ʖE�[�<�o�v���C��7Ko�;�@�3�a1b��&�@\�(�/��H�kkk&��z0�'�g+���(WQ2�df!�2ҷ�x��W+��~���0S�v^��YL�)�~ˬ����0,�W[���?�����`Â��g��
P�)�JHg?������h�k��*㳺��u?��� g��L4\V�ʱ��^KU��?<lآW�>{p�	EUr!
��_�;�:�
�j�fc�,�:7b�¿i� 6�e�ud#�B�UzlDZ"l��k�W�c��,���oZ~�"dqz�s$�3���m�Knͩ�!��]��&[���^�i���J�����Ν�b��)g(���m��+�!($-*rB�~���-��688�.т��$�3��EjEo�C;eR���I���F���n�A��|��x���������k��leO'�z�o.�J����Dc8�VNڕ��G��D��|Z�͂��z+�c�}�{�Z4�r5PR��g�4��5�8?�G��ws�]i��\��g�7>l�O��:9{-T7cLU`���ʜ;�����kp��� �.�7_&41O�A*����&�T"�H����u��!�(����	�䭮�4׊�fӍb|��t���*R���?s::�l^ׅ�ZL�1ca��[��B4{��i/�-��H�[���΀d8����G��5��>X�B<�@��&�m~��	8v���̃|8�s�0^�
h��X)}�` /�:ͧĖ@,Y�,��S��h s5A�1�E�n�o	�"��n�����4B����I��d��B��[�Q	�ٳ��"�P��\ZX<2r��q{�������&[�b����J����55�L�U�^�>՞�d�|�4<�Rf��m��K"�q��{=BA��JeYd�.��V.L�c����;}���3ҏ�"�\j�_l1���f��q�Y�J�N
C��g�ޣ��*m�M*"O��0�Ϡ�=�W-�o>�)W���O�NC@:ٛA�Y`� <s�^U�s�7�h������\�%�����牿o�f[����~ h
Hnۧ��$�BB�:$��m������w���G��V���t��u�4�J���#9�G����:��JK���[�G��@hz+����r�1�6d������I#B�<e�zH���*��!e�i
K�1Jɵϙ4�Ksΐ��xq;Fo�}�\F��
{	�v,#���:T��S4���U�������u~E23�5�[@JU�c�eyX3{�d��7�F~�N��Q�^YK��-����X��������4�uM�a7/����U-��FXJ�}�6VeD����ķ���K�!���U�ރ'�#rl�q��i��`sӶX�(�j�������L�z����x�X�="�F)�Z\Z�R���ꭙ i:o<��}��U,W�:
��Fw+�$vk|����@����z۔���:
�خyʶq��D�����&o�/n��y��hbJv!9m
�����Z��0TV3?�ES��T��✰��B�"�B&MK�ڛ�W��8u����E�_y��QK�

�.�E3���! ��c\�v��t���O�Urn[l���.��c����I���P�K#�&f���n�Ao�5���p%�>�#�/��V�LY�	1h��
d�ّY�=�k��?��o<��;�@���:Q 	I��2G��ݬ|?���P]S�?��I�l� ���i6ޘ�]��;�2?�]�݆� %I�j�����L�5�9i�[�N�傊ԌB�kHS�z�.%�䚽���uIG>{�z����}!J�ҟ	�S07\�iB����U0pN�ZF��_��������G��.C۟
�A�Qu���'G`�4��=Ms"�7��E�S�VO&dږ�Y!���	�0H=z�&� }|k�Xi���q���4Rt��~�ݪ�&�i|�$LIؑ?� �VB
�#iE��R�<�w�X�^����S��;(l�C�A�5���㟷���ւ�MA���K������~-�mf�)��q�B��n�/d�j/#
L[��y�-*maS�@%�Ln����Ŀ!W�)�]���i+ei,u�|�D�D}�«\V.(e��d�(h��;���C��3��S��/��
�)��!6@DhS�~5�[RH�n�0W"�7��HZn��	���!�dK�ʕ�'�l��*��$:8Gt
c��tql�2}����?ݨSJ5=�c��(k}�����ȓM66�X4���e&�Nww�<YW=���R�(z�`ؤ+ʾ-��@�`�/U�E��H��W��u4�jb�s�QxL�mUQg����H]��S� �7L����H]�h�ӷd����?�dj̠��Ʉo�������m�4�y�(h�nj�Zhń�G�+���z�����"g���ϣc�/�S���!��%�N$�T��B�& 5��jLg�L��/XJ�
~<�<&I�����
T�~ ��qvAT�ذ����9�(�p�ޣ��w�}��MVe��gb��������������ᢍ����`o�����/R�*<�����#3�ma�h�(t	�C�tqH�n� �-������63[BEu2,/<��<�	ݛ�E�F��d�(6 8{�7�gm��ry�j�e����A�N?�=�oDu8\�s����P5�"2�M�������x<�%��9�1#�@��f�@�F�b�w��`��WB�г��Ox�.)����>�s�t�Mɍ�c�]X��=�4{�`�C��\����~47���Fy8�S��Z�2�x��K@�_�D���fEɏ�G����$��Nj*��Ot��F1�K6<l�C>.HK>�Ր
Ğ�V�S�;a�����a:<��扪j	�d�"2�(
Y��q�_�������j�E���j~�t���H�����G]Fv�������ލ
i����3���_KDp=����q)7a�1�O�)nn���e��ʇ؍�?R�maY�:���? ��5�}s`�˾��ߵ�)>�Ɓ��j�4�7�a9I���n�'���h��N�Z��'��bB�
)0u>&:JQ�X�˨�K�hDL�-�N;��R{�vҜ�$=��ƨ8+�.����o���|�(eF��QyO>��w�����~uF����ΦI.~����خI��V-�(F�B#�.g<>����Z�K�5������HƱ+������z���>\����D���7M��zQ�{��'A���T�
v����r��s�?��+C.F��f}EN�8�㕏z;kj�\Z�h����m����>F-;M�!$[B�1��.��CC4fL����	�X���N��q�M�C���M�+�Z��*N	��s��WH�_�C����!v�Xg��T��%��&&68�6�(���x�� >�ߤ��QT�-��E�CE�ȩ�b1o��U(�b3��©ܮ'H� y#��T�vpN�B}1U�=��:/ԕ�B�9%'��}7� �=���/^��.�3s�` ��å���Z������0v,<���y���V׊kVL�>�`2�E�mn ��G�:V�U�.�
���D��F{�mc�Moa3M�b�]c����9���@ �D��>����ֱ~�2�d�{��VO�<�v�9�qC]#7c�9�/�@D]m����-p��ܝ�M�E5���}]#���k�^g��z�a�>GO9�[B��N+N}���}S�R3G$YZ��������Sگ2�U�0l�h@p���23�`䴪�k
������!����'Y�@цb���P��i�7��[�"(�%���;Ȉt��z��n�Q4'�%���H~<2�)��J#�5�ZJB�p=��c�J�-i��}�ܗ�MQm�є<��������^Y�B��L� ���t hjpub�05g���%|O
$$Q�g������.��Z���<W+�d;��.9�������z�Yƀ_,$\D�����'���XQ܇l�lkJ_�\SZ��G�$��j0�`��_��z��2��C�z�l�m��p��e����E���;�R�Fũ	0�0�p��[�q�ce�	�]f�TG ��.������/=SMA6��~<��ی6�_�O��E)�	t���㿯�%�/*�?n�9K
����UrQD閗��آb�����'��î&`��qr����u��zWg��n��r��~�'mw�Y۲r9ͣ/9|�~G<Z�%Yω�`�1p��3mz:�f�s�**U�D֎H��M�0?�k����p�8@�L2���j$�7�nd���w!����ofqk��O�	����(�G�����D�s�ގ�1�gX_���(��rH�n��D7b@'��;��2�����o�%��h���&���U���<�dqJ�X�5� ������}�����1�x��Z��K��D2�S�,;W���������%�pi��I��6��F���`��&4�CP��`�}�o,�9��P�!�`({��PQ8�	�:n)Ͼm���X���NIɀ���ؿ:���NOCrR6��z�Y�3�D�)����e�y;�^V��?�s%(xj�{��Y�����i���#�g'"��
�V�]�i֪�%*��W�"���
G{��� Y�ie;Y�z�8��#
���}�G�h�3��MIDk.H���"��ED�LD�+�;��Xe(�C(��Y���wґ8� &`��"P0KX�+�*9����2y��
M���ɸ��r#��߹�Q@J$��d]���.������;�I�J������v?�;�	N���Ut��"��!>d���Դ(��
���;�~��BA��5�~ȱW�G��5p1R�0���Չ�p�B�@���/qlR��UZ#���ݬ�i{�A�*r)2�QX2af�P^Na�9�ϒ��gս��~�%��u�������
�#ji�&�o��Z��bs�^-��]+(YZUOr��U�^u��h{)�����JД��:�"w.��
Ua�zD?�ҿ�/,Js�;p��zvۢ��?*�}�:���=�k���M��x�I�I>�!n@F��m�b�b��
�{��֦�Ȱ�Q�h~���4��L����7�g�?}��lg*�_Zu�1f�s�ߵ8�� ��e9���`c���*��K�4'+�����۠�4x��R�ŗ�,���UkV��!zL�L��}���=#�J�$�Z��sFq�j��b/�c�H/	%M5�j��-�PkA0���w"�7M��5����Zv�ύz���sy(z
�l�D����]-<���g���8�v�cѻ2�
��D��
������p@����C���Zg�{�
x��턉�7>��ݑ?2��.Xy���J-�p�����H�

z��TC���Zr�ѭ2~��^��G,2������Un������7����8l� ��Z6�OA��r���o�GMgWH�
+����"����V��ZQWJ\��W���7p���f�Dё&�>�xM�k���x
�9��3�P�o�5���1l�h<�0_���D�����D�CИ�$����\P��
@��1�N|���w���߰�MO�&��f@��_ri�1�/�FG_0;zA �<q�&�e��C��u1�(GaP6���hl�ʄ\���V�:J�]�䈫�{hE�g��fl�vP��F����)i
8��׵�~��yDE�NGW"vυ�Q������m�/�����bT��r�ߧ�;/eOGe�'��t�}u�Bޔ���A(�+�������<�!�)�:�OB�n7[Z�2T�����7 �S�9��YLUFS:e8�,)�T?�],�M��J2�M�q����3����j�݄�X����ĜS�Z(M�r��:S�a$y��^Jq5 ����_���2j�kᣖU��wVdwo)>g��-�U ��Xa��al���vd�֊R�h�!���&\}����Mb�+Ɉ��9�
O� 9P�
8I'�އ��F���8*��Y��h�$p&�>��3��s�c��b\�Z@l}�#t��?����8���ߦ��#v=+4�z&j�>� �1=�t&G6���B���^\�m�"�KNC.�#d���a�8r�p�'��#�|^���;7P��=h�}�C��o�UZZU�_��{zj�Xa2�r��8�%�'1'�^_h�Aߪb}M�J��9�y�BGĶV�_�f���e�Sf�/��1��Bk�����C	f�� �v��˻-���Ъk_
���58C��)|�wU[�%�a'��^���-�))�>>|���ȇ���m'A.�0�oM�ࡡ���I�� ����!��j�i�X�G4I1���lq�Y�,�8\ ЩV��{�����y���<s"^.�F�V�.远eN4���#�Qx@��y=���tv�b��S�q��{��;D���aDﺤ�}v��]0���x����_
�0`$�Z��)/�|��l�[��ŻN�(@?9�&1�V-&$��t�Lg���B�C��lrg�Ji��W@z��3�P�����-E�ˬ�y��[%:��Ԛ�̂��O؂�n_J`�������=�Q���i򒸿��Fc~`<�����1�����\y�-�_i�C��4��@	�
R��{p�)(��(~������׈p%Ņ��	P���AY�Z�%����˞Q��b���9I�\�䕗��Ym$�K�*�����$��bH@E���|;kR���Xz@�<z7y.����j�U��ڳ�q'U��;'��:�د�Z9����yF����������:�"�2�'���C�\¾q�2�e�����Q�vo�i~�M�/�����E����S��Q4���S��ןW��9�x|]]�09_���y|�.�}�}[��������p
��dI��D���,�Z$/n��h�����F	��%��[[?g�{��ȯBVr�cv�y�ܑ��b�8��X�#�����������
�83�]=C�o��˺s�����Ӱ�S!V��[Z�5����\</����\j�Fx��p�'�Lc��o��ɫ0���8o(�:Xi��؆�#���/�iγ�&�P~D!3��ę��$����i H�==*l��
y(лZ�|��G�fF&��^�lV�i�_�;����Q�m:Y�W�:����)��g�P��f���
���7�/̐�מ�Aѷ��i0�S�}s�P��T�p2�3�ήяGZ3�gxb�,r��e/E
����_H�*S�����,��N��q�MB2�Tݚ���B�Unᦆ�3m��!�`����Or\w�J��缡ne� ���ʡ5*[X ��<%�y|ߴ�`U�)����,����3�,9pY�6�.��0V�*���v�/��p/���*4�&������Q�t{R*y6ɑ��Z��鈃�z�\���ԭ}�/ic.���������L��KH�8�xoJc�}����Id�	�sP&���%��94�`P˷�b�ܶw-&���G~XI,�j��>6ͥ�8Sпom
'2|�E�1�����۱���ň��NE4��
@AxKΣ`Qm�#��Wj]k����D��65�i��?t�9H/����v��U����R��+��ά
�E��/�6�k$<�K�\�ձ� !�ҒQ�.�P��-�+K�?:R�ط��w,��i=_>Ɓ/ub��U��q8�TY�GB�t�sC{l����џ�+o�,^�!ԭ��Y�|�4��u�,�5����y�'+�mZY��|3���v�e뮶�.2=�-��J��e�;��l*5�ZG�Ȭ���Hb������}T�����ٌ,#�ag��F���
�s'�� C�љ>���׬c�����`
�&���;�Vv`����|1O~���x�x!C*4�X�t���J�����?��.&%g�ywS=p��Ӡ��mWF�+ &�	c�jhIM����0�38�?h`�:D��y��g����f�q���Y9㱑Z������X��7.Z��Z�d5q��k=��0t�9O~�E�.90��ڤ��L��ԭS��_����d
2���d�����*g��TF�0� 㠦�U�fk���7�>^�g�-<�q��.�;�L�FP~o�O�z�:��aZo* ~rgP�w�bއ�~}x���{G�{9�:_6)�z�3�v�lr;���1Ц!J?�P�,�ۀM��4^�_+ؘ'#����'�2S������:q����a#h��c�e�f��%���N��dn,����Kl��o���6�!lS[m(�d1��� F� Zt}��L6�n��^�D���,9OT�� �v��	 ���Ylr�d�b@��E�TG"�m����Q�ɳ��l��8V�6�l:;������W�6���\_�����7ˀu?��B櫣��=�nI�g2�zMC��*����
�6���#<l�
�v�Gz�u�O�S3QV��6�����/�U��Y�!���_��U���q�=�y���7�C��Ć24t���rl&�X&=Q!Z��	��@Z7u=	Q~��랃���^iQX?pgF������TE%�n�����
8v�b����<�ŝ��d�M~�k`�c�^ m��s�.Mw�g;���-7q���h��	M?�?�T�^��d�>���%?JN4��[��u�v�L��
j>-E!$�A�ӻ�J}qu]A��5���u��a�Bn�ʉ���1{ˮ&D�A�����uó���9�S��U�`.������!�.ȿ��Q���'�M$�B0��/��V�7u^fT�Gp��򌵽�5un���V$*���<y��(Pc�xGF����5��	��ov��D���b'i�.��#� ��ػ�3�>�+Kh/$�NzvA
2�4;5W�}�x�=R����ya��4]�ʿ]O�9̅���w[� ��A���Q?Ys�����CN[5�87�A�mn<	�I�L(C��X'ƻmv�W�k4o����>od�_訖\C7�b�}F����^ ���b4��-���G���Z�3ј�k&�Uf��B�
�t{kD;.�3
�������y���l܈D&��>dF��r*3AA`*��J0�	
��G9LRL.QM���+V
��)e`k����W�f$��*���a��鹱z�Vs�e���:����e��!hd ��بQ$m9����j
4�
z��
3	F5Q��k0i�/;#�9$��{V���?<�Wg9e^}�Z����L5�?`�\���O�]��zw���--M:Y�u�~3y|��ⲧ�]SC�(-�p�B!4^���^ {[:,����U- �>�B�G/�G��\m��ˇVpf�wǞ�M���cq;Jb�gl�z���� Tz���Č0�oYH��iy�����%jX�f�-�f�v!:bZ�J�.��?N'�����݄<֊���\�KZ'\;˔D-V!��| X�	�[��(��"��\��M2��>д���_LͺJ���0��2ٌ�dy�`65��ț��\�/��q���٫A�_@n�
"L�����f
d��@��[���΁>Pf�l��SÕRm���X�j��ѳ]>#s�;�PN������ա�����k5�.6c��
�7�ݪ��ubGH�k��:��S2.:�`ʈ[h�l����'z<�,�TUw!�a��s�QZ6*,�Zp[����c!�~����G*~x5�t���˫<�L3����m-)])�Ъ��~���6�Wl`A���e���{�s�"�|��-��[Y��
_��C�����Q�t��M\�=�}�	ѻB2��8�mK-gܬ��9���r�jht�M:&>Nߩ}3i�J��Om�d�_8�c[�bO����z�q-�.璝�'�<qLg�����1��>,lS �p�X��~X!�y���gOs�/C��k��#D��G�����P]��jn�&�8K��tD
>��[0���Ib���#���u���
8:���rM: �C)�F��f��UO�H+��	5SǢ�z���P7��_��\eD�I
*J?���r9�3r�P��(;���["[�j��p�Z Ԋ,B2���(I���<����/���]�3�r8Z�@�G�2�k^�
+��1+�\ϙ�k��GK�6B���iD!�#��\�8�������v��ƌ���~��T=S���*�+��	:H�1�.�7"�~�1��-��>,���@��0є��B��
E.l���t���hR~�J�(�a hls�ж�e��_f`c�PC3l�bjM�vH�*^���?<�TFem��+���H�C�5���i�?d�@�ؓ8���0��6tv��4�^����8y^�u�o=�GQr�x�@�!i#��������o�b˹ly�<f�L�a�Ӛϕ�E�pg��>L."�������U�q]�ܞc�9I�����I�����a췸�cܜ�nqF��Q��ި��,}���@�k��]R >�lr���Y��RD���\���u�PGT�_�v!9 �W^Iz9t+A�9	�4�����lڷuv)�Z�-�"���E܈~�aX�Tǒ�!�� ���Z��ߓwWg6�>vc%�^��}�D7�J�
��st���y/ty�秚�Y#k&�����xej-:fь��� ����y%���^��[�ay���7�0��x^P��,�)�pd?�~��
1\��bL���൱@o�H�0ŋ��o�
E&s��4B�����z�M>�2-C�� Sశ� ���^�>�,���?0�3���?���J�t�"y�]7����)�|u�GqC�q@�q��H���h�@���#��dQ�&U$�����k���Pz0�ӳu+��N�r[y�-v��/����EZlU�{�bdi��Fv���B�~kض4�i������/�Gj�|׭�0�D�D"
'��o���RY�-Z٨Mb��t�,{�L'�Nx�J��öH���}*r4��4�Z���f��1�����&DX�1]��Bv���)�j	����?p̸���c�b8�܀D�;��?���Ox���a��*��s��h��g[j�ċ;��
���)�i�ՍE�����kS�I�<�|��yh|澹[��Y��on�N�>�C�R~�y���Jt��&RX����/3��W����gu�Z? ��p��|^H���e�2�*ь�m
QS������x}��g�S@�L-Lě`PK&!n#N���}���ξ!_�A<�
�|L�h��<ӣ?�k5l��>xY��uL�ϥ�����"8��E7<��h��y�;
�^
y�Y ��v���pB����w��t.B	\�Q,����h,�R�1��j0	U��|
tׁ�	���SI>�g��!��!�gf���N^PX�@�vQ�N����Q@@[p�����`.G�偾z�v�s�aZe������&!C-�"��oAߍ/Fw�e#֑���!ePQWF��˼�M֚,�[10�Y��ħ�xkz,���m�,M��+�?��}�ފ�B�r�������`cQ��Pv^ή�=۟<@�����L�
[�=M��9T�*zy��jPLN�,��ЃFc��b.�����`mr �6\����2������'��"75b���}�I��gH#Sf�I��T�DQp�x�������=����,n(�p��g�d9s� s���h����3�J^5M����V�2d�����D&�cc-ʕ��o	1V�u�}:�:`�=s����yP��d����1<P<l��� ��a&^L}�Q
y���4�$E1U�Fۥ�y䰢<"���] I���e7��]ψP:*�	2:_P-M��<��t����
׳�� ����A���~�+��@zFl<Л|av��~�E�$ߛc�mG��(���2�5S�΢��$����ov+�J͕؈�\�x:���������e�:wf�.`è�Ҏ��x����rdN�8g� �NG53�
b����D�\� ���yΉ�>/e?wgGb�˓	��[zN�)�M���9xH����ѐ�U�1_��ef3e;fB��d�4 �˃����I�P��e�;�L9���y��I?���)��š����;8?-�
�����εBi�	V���^.!/��Q���[�#�`�w���Aez��w������	����9S�,c����"��5��/�(I�E�lL�e��sC�j�KtGw0�q��a���K����V.�:Rl�dF�o�E=�&k)F9� �a��{�}�hg�����"��ݖ��.dmK��?Ws�
b�L-��M�3d[CD1(��F�Ӌ�V��_l��q^H�C9],�6����*k(��#��k�����
��)�пR7�-K�����6��?�@ү#�wq͸�@ n�4�sڜU�]�
��_T	>�E&R$�Ut�|��5��qq�	��nS���������=vj��^�������O"��M��������X�<p㻖�	�Σ`e�,C��S�je�&�8_�'�<b�$n?=�w�5�"m�y�5iϦ4�HO�B��Of5�h����GYf-�*K�a���a��~�,���^T�Xx}��� 	K��H�}��*	��3�L�G��(��H�3�!:���EU���Yeva~�ᡔ&�AW������%"��^�V�~E
8&���3-��H;�]����7.8�@'�)��iZ����S%S���=Pm��:XS>LA���j]�����з����E����!+1s��_Ϯ�9�:���̋j��cஅ[��s�Ý`�ڝ-Z:�?� �yiV(����O/�ㆄD��A8ע*֒��M#ݑ���/-k|�����}���<<F
y��6-1c�5����i��@� �^��o(��s��K�Q�̧D:���-���y�8w!r۞e�q�K�K���L?����2)"+��I#���ɩ@!�=w��n���xI͆��if�"e��/����t���~͐�`nƀ�C���00�%]r����8�u��g؟���!R �c�sa�y7�z�h�t�su ob������[Ҙl�����B�A��R�B���W:e������R�*7̪�vW86B�|QZUV��R�F�S���S�־�
E�C+<Ce1���d �!���z�� ̜�J&��D/��q7C��t��{��ȒQ���SJq�%.���ȶ��aÆn�ե���%c���V���8q�`��g�X�����H*rA7�w ��hY��J˱��ʦ��� ���O�-�\d\� �Z���z��
�O�F���m�+i��p��M�����ҋ�w[�����-v��k��C�
v+8�0�a�|��2�pI7S����rh5�a)�{�qqTc[:
�kt�K���^ng��Iv"�Jh������PZz��B��iR/sqU�+*����/pt�y������A��n\f���^׿��,{_����Y�@Bozl7�ѭ���w*��o�I�҂o�c����/�`p������N�\@i'���GC�\�-V����Փ��$�v'�3舚�k�=Q��|�=�p���Mʌ��>5����4��nv6�z��j���� ���x^�/�
��u�>'�Ձ|�2�m�Vn5��y��y.�s�E77Yֈ������(�
�ےj�rOo{��%�x� Q�*)��N���'�Rb>t�t��Nv�F�U�_8_���>���['��}��ȚRL]j�W�1�
�m߭	����J�{��҅1x}���b�Zαc=�6�u
ZT
�g���}����fq��:� H�I��vƱrK��컴`����v��ǣg4=%Q3 ���E�X&0w����8���	�FL�`�H�~��(2�+S�[�UK�5
-ȡ^b@C��	`eh=�7-zˊߖ:��E2:_�T;��+��6[�#>󊾑 �hߵ��niy���s�1s�J�L��&2�� ��=y����	�H�z�Z�l����c�r;x��h�5��[�҉@�0C/�9��Z��Ʀ�4�i�
�5��� 2�xl�>�є��v�j�ni�����W��f+"H����G=���
����"��	�de��e�����D�;����Y�o"@������߿���3o{�I</��?�W	2������2N)I��ѮQ�w �a?OE���_��WЂ�BU��iu2z^0�L3��|p��8S�CO4�ض�VZ��1��Tj��M����o�6*t�En��VB�Ɲ����~��g�𦕕:i��V�H�����um�zZM�,E��t�f)� �6��_%�pd0)�����s�T��8��?��3�U4c��B!���Sh��UUҨ9��I u�!��ȍ5}^`�O�^�5k@��v+��IK�����_�M�~��l<���ё�����CL!�WY���~��^�c��M�,@��+�=i
��o��Av����	����BOǞ�9!}(��vW���8p$煨��#l���x�C+���'^���&�dќ2��Ճu���\������؜�(ᓩ/��J�5��v��qn2qj{�B_lKO�L��BO�Z2�}�DN�L��p�?�g�T��X����J��_��Q�p���k���@y�[��M_ڲ���"X�ݧ
� �u{�	M@�lyf����.�,[�+M�[�{z�C~�xhк/.�Y�O(���
�9$� T��O�5K�(]6a�
�T���S,�魼����{Quy�u���:ۈ&��x�%�z���Jeh�����@#�S�ل{&�$���݋���=�����9F:��!J䦴s�[�t3�F��A0��>F�~�����l�S8TrͿ@�hH���Z��yo��(�{^�v��@��[�g派w���<8�qZ�X��l�p\}[�c�������z!]͋ ��5�N ���62�}��!�b��!�\�A	�i�%���c8�z�<����>�N�^j��3��@w��|l��Zpb
-,Lg�Tm�l��M뫽���&�=������L|=�[~�������6��T~����x�,{i��*G�/7r�ޢU�щ=�m�l���S����LK�_�9��ǚ�L��T�4��k�����
Θ�I<�}�9o%B�!Uۛ-����&Uq��L��$m��g�y����� 4���1~X��d�>��V��E�f�;d9jX"G��m>9�-�Ŀi��ZI����,,a�sdrg1P *S�s���C
]�b�)�e�x+�s�Rl0j�^u�&pV]��]_
�@@mj��{��BfI���'U?�4=|�1��~YхT�p�"��1
!Y���~��G�ο)�Vr�=�u%@6�#1�m����5����Y��%H��!4���}�w�0e�Rz�\I�^�� et�MΏ��2�D"c��LUV3�<���4�(�Z����	Ӊ\�W퀊��`��6267�y��p��tCګ(�s�*���ǧ1��t�$�Tr��
H�&h�$��N�6P'tpwݗ��bx>�E�+�O��uh�
���ӽ�1T�:�lu��>�w������ZM����Mn�w��a;�0	cwW��@��"���5�嗢8} {'st"��1-0�������K,)��)I���O��1����woA\9����X���6t`�s��b���\�7Ą7���[8'F��z'���V]
�Y�����.p�j����䆯���Ԗ���+�ä@-�=��Jm5�ݩ�s`p��iũ�Ȓ�e�,tK־鍟K�$W���H���_�t����!u����B$iYfY����`��Кԭ�6���%��.���6�|�q�Y[�r3e���YO�?!�قT�r��~$I
��;ͭ�1�#P!����������a~ �V�;�']E��MWG#
P�Bn��Z
3~���CN�c� Z��A���8��4*���Q��W��X�,��*lC�)�_qhx��;�M���F� �94�3e��ֲX�H�.mg
��k�S0���Ɠ��p�E
��8O�7@0#A�^�e�L8�yj��3���rHf�
AsZ6���]Q���w�^�	��S��A 2�/��]z��Ć�z^�9�dc+�ט&4	
�|wz	ζr�!*�c����ו
���{Yq��ϥ	z20��5��u���D/��>P僷��4���0Wo���T%Ml��^tXը����?�����Z7MKxk`T-�tI�|G�b���������S2)�;�_=�� �t:�_s)A��P�C?�ފ�������3T�,-��2�B*��v�z�
�3�a1sw�ʥ˹�r��8�el��xC�#�pY��j�S�~���K�y
�-���| ��@0�z6�,]��v��^�0}	�~�����+�8�{{�mI��׭u�'����r���|�������B�C���E�(����h����*�(����']˅"Z_ޖ�J�&G�s�s���9��0 �_#���� H�t�P���������`,)B�\��j3}f5���|���=B�4�^T�𾡷��n�P���,ma�?0a�QW�3�������=��Gh�s���,���11��R�`�!��c��4@�m̫��ԜK{�=Z>�QϽi*�_��7�7�b�E����?�o� ��Ι�v�
n���}e��6[��Ԡj���q� ���%�3S0 ��ȋ�7 ���npÂ��`�ޟ�k�ux�O̺�ZXj�vQ��6%���� �L��t�O?��z,:%\�`x�׫���e���0cxR�UV�)]����,��w	�{���� 5�P�TS�Ǔs���#("�P��)��r�i����3�$!/X���?�(���j��ƏPCW]�}@�1�}���=��P]�9��;�y�M6����rE�{�M�;n6YP�������`�����l��iO[�R�^�(@L,��e�����t�jw&�-¤Q#�a�xu��}���'� ��SYu��i(
��sW��I�<ʽnL����ve0x���͵a9�������J���}(F�W엒A��4ޏ��@���g�������ց�;0
��2>}^)�����6U9�'�X�4Vv>���?�ٹ!���C���fJR�,NϒC��Bgtդ�8z��u
�k(z��˸Pz��SA
nM� �z}b�GE#k<M�r��� a����c}���;it�.�0��S0��A2�Q7j�Õz������}����#��q����/��[��SLQƂP�q6 �����xH^LxH��HʤSb$b>�,G�I~ݦ��B�D�F�B,[y��i��땐&��x�5WL���C����H�T%7˒q�
<�P���Ȭ�#�7o7�d����=��� lr�x�8 8^�<��;r�we�e�
��7pڃq#�D��bk�9���^�s�0�����"��g�n��Л���_4�n����	$q�l���:�c������Z�M��m3�\PII���JE�SMwl���N�꧀݆�.I�5�����u�=��=N��@�| .��F�[��k�q�=s^�:Y=UЫ^�gP�q	M�gpn�@6pqU�&�}r�NH��j�M�v�,3��R�je뵪�ku��[��H7e��B��
�/� <�
�%	b^�Ur�?�3��}�G����Ԁ�3$`�*OK�2�;���L�D��E�Q�(�GM�B n	Ƞ5:�����gD?��ý3��W��B���[�M�|��HX�Do�D(cLn��+�4��_  �&Qd��r~��#�'gc�N�9�K�A�y�� ���ȧ�N|jSe �Tѩ�&�����	y�� @�Р���������_K�Ґ� ��C��}�q�`6��3In�a����Q��f?<9�S�0�&-��k[�S~���W�B����NM��G�;w�~��x�"ƽ1�+����r=��*
5y0'"�q�1xļA|-���98ci^�� ���H�r��
'��l\o��I�dr�H᧕�?P�N%�$fX�tm�Ep�'Ͷ�_B"�����?ev��D��),2Xp!�>3N���;�E�y�>V�+'n<�+��^0�����{Qq���P/$���-e ��͡ȹ��W�{�6��XZ��
����U�84K�0-�j������#NZn� �c՛��8�k��,��Uv`ݝ�#�G���U�l��H4�5������^�}�\ ��=ix	�;��S�t������3㸟j�_��kv�����B�vl��.)�AS�a�&<W�Az��`4��>AM��u�ʴL�	�+����ۉ��^Y��$؜��;ì�ʦZUU1���0D&HRvFJ;��F�n�ŝ�����Fq� K'�����&�>Q�V���B#O� �AP��������5���|b�>4;!͈�T��{r��'���H�f Kqw��Z�x�;�v&����="� ͊3� 1�'Srzro=��'�?,d[�*Ȫ�i)�pyG�ߑ�엣I�m��>_n�>Cm������O
��6���;WrYT��d�
�E�������ьy��NqL�����mf�Ҿ3���cFf�o��������ALz�fK�PS�� 6���O��������j@�Y�w?޹T�}�,9P���:q:�%�g�	���oxp�Yh���`��@��"���|p�S�<�UC�E����c�a�e<p
y˫��W�Q�G�b ȟ/0g-9 C�r=�.���e 2��Q�њ�7VH�(�5��;���]�v0�� ]P�`b���B��u�:�㺷�Ȳ�����n,3��
��&�����MK��%�@��B��>
7�76и��/S�<�� ؾF��3S�T�R��`�h�PV.�jpF��V֋�]	�X�~����w��5IUEW�u���%1����m�%��K�3����1B2 ����9��JR�A���1�c��1��f�hℽU*l8�J$��J�M�u����}|���?hU�nD�U(�1���B��(>%wc�,p*vHT�t0V��[g���#�ð�}퐝�w���6#�٘�����!e3��K@�~[:�S�շ���]�,�J%B��*�O��'�u����(O^sVO�_=��]��:���wyEt����0 ��%�7&��D�7ċ�&"�:�"Н�������Yę~��	t#��fb�TE;�_��G��x8�g5��nm-��xw���T��
T'�n;c�|5��T&�#]�~bP����.�e-	$p8�n�6<�AO<B�X`��vJSl/��l\_	Ț�5���z�����isp'
��}`�E�.?���V�~�_H��f�$�U��_ԵZb�M��/�{{��pYa��]|]�v���p4�xt�`F���`�q�30�XΗ�(z��I�+D��*�pS4��\0��Pߛ���5���� ;-�(�>s:i>��Ǭ��r���ף#5S�6���w��R�{e��6gʝ���M�	8�N\.��hqB�!���Nȹ#��N��ysw�n'���^��Y��6 �?��́-�8���4$�+�R���@4K[0�}y@��H��� �?7.Ei��B�@��蒶��7U���$k�v��-R���0[�E��
��r��z\�V2�`v��Z��e+,�l�'�&�%�}��`������Z���
��2a+CWk��.P�ȣ�C�p�q'ڵ�פkW�C%f��Ko(��#T� �_-�O*ڈ3�|��Zb���d�a �Y�˱�ݲ�f���FqL���d��c�L`ԇTL:���0�u:`�0� N�	��"`m��)4|O�Xs���Q�8��u ]�A�I]C���{�q����U�|:&�j�,Y��9�
@j�!���tv��oo���Z���ХC�?�7\���=u��2�$a�x�hk�f�z�+ ��E�����-И�ܠ���\�y��Q�k�$#���,�� 6���&�zlU��
�R:w��&yZsp������UImx��.�G�V�e�%K_\�|�bք�
��ӛ*��Kù�m$)C�˚M��
�5U'|p�qWS������fjR��鴧���ޙ��,�Zf�H���9r���|A&�W�n���!�>���L����:ش��o�y�I���"e�Mq	�H�G��-y� 	O^��hڳ^l���\?M�6-�ܽI�+�w�pF �F�*p�*4lNƇ� 
�]�ܤ��G�0gZS+.�/�q��{J9ډ�e6s}.5/3�U�JB*އ���d��1Q��¬�ZB��ծJCĢ`VJ���^= �(���	[}�$��Z��ONx_������=�7�%��~��d(��ჳ�u-Xx�nR�	UC�k�?=-:^�	�W�:���/ �_�����G�B�������Z��V	,���*Bʼ0Rz��z*��FmW�'�!'��^�z�,��S��J�7����Q����3Ϭjӳ^���ڻ����4	����!V�K��ы*�^��|�-S�*�	�9��QaeNF�c����?���
�֢��ꗮ��z ��6��}�j�g[c�8������S�-N�X<�&������@�����;r:`�B����R�L��ʺ���Z��խt� Rsnk���8I��rz��,��'Y1�ؿ��]D�P�ӊʷQ��L8ƣH���|�mW!R �7��첁�
s 	/�BUN%w��A�t$��V��G�Q�J�q��P�l_��QW�����/�B�L��E&��(���'~�mL$
f�>^In�H9������g�Cwv�*��2!�����jtj��F���8L�*�1j��(_�Hi�%s�^�a9��
^}�vga��S��&+N�h�n��w���$z�|�H�$ԜM�r�.�G�j�cDB2���:������~�]o&f�ns����{c ,�`
��k��~
��#!�Xf�8�J�*�O0QLM^R ��'n?>T��^�(I����b����]bq�+Z�
'ǅ���-9���0:̦��"[*^+I��D�d(ZUM���.��i��$�~@��,�����/�A���<B�z�N<�h�3�5�z�[c��,mw�	Z���ᢷ�/2�p���݌q$!�%�A�
4�q�}�3�b	݂Z2ta�4b�1�w�~�y-��5>
��#���
�[̝��l{�S#��Mc�P��d����k�R^�����ۚb��o�(��'�}��֓������	�����9m�TM*���z{Oq4	�W��0�־Eq+	�r�Z�a_�=E^�8�,���%��S���"X|�U���Q����Ǵ�L��+��S'�l6���� �$�n��;��Nj���+ #hM%d	R��fj�
0����T��@�8�a�/_CG�m����y�U��`'�J��&�m��`5�)u$�{����yqN��'J�����x����
m�͐�tm45���k��@Ъ�����$(�{R˹ES���d�_<@��}��*��s�:%y}q
�����-չ�l&����h
��j�z&�XT��l�,8�^|D���I9��:���|C"��P��8s��>�$�����T5�N��C��T���4؆�N�F+��B楟VH��k�r��WF�ٳ��e��p�S�uA��h�7/��[(��b����6%�i�:八U���bC����E�#�>6���v�Ώ�B쪈��
�>	�{�}(K�7�pZu�~�ݓY�ɛ�:�.j�������-�|9�M�{�4����~�dO��Iۜ[���MU�t������̗U	��r�~hސ&EF�	j%��ti��>fzo����`�,�Q^��ڊ�TEpe�ۋ`�/bv��y�D�;59[�{�ԓ�T2�t�\���ZeɈ�o@�|۶�|�al�����e铖G���!$ֶ6/�(#.Z�;)xx�8�~E��I�j�:�������uk�;uz��N?0���ULZ53!�J�Ό�ǒ%�raL��³ސwn�;�$�}+r�tyh0}�)�����_陃��C0-W��w�I+�r?v�y1؞5�G�pʙ���./I�
�[i������o�d��4����_���,�t���B���ӹ0ª8_��a���k�W�dh�$�l�4�m�U0���$<�,k��2�������u
B� %��x�7S]�d�ۂ��
$U�W����;V��-CN�!&3�i6h&�Zj_�;`pd�
��Um�	�K�](�������Y���#�uC97�(���}ؾ/�V7W��>)&s� ������g4����Ʃ5}�mqA�U�}��H�ē���?�a�ֳO�eR��ق����o�cO�CD'j��y���� Eg��B�O���-�oX5��m������;�����O�+�W��,��r9�9՚�'_{����~67펽�U�K��Y&EfϮW�x "r�b�*�6y���΄%���$�[ Q�b�����qF*]IUכ|�G�j����(�ӭ�g���GH�4LLQZlW
3HƢ�ƙ���	�#���2�銥bw��@J .iy���T��2�:m�����y��h�M�沇����SIq��Et�q�j�f0M�Զ.��$Ʒ���м�o�t&�|B�*8��'������7����v����\���4lm����-吙�B���(�$�3�>r����ʛ����C�z)��A���`|�}���9�����B���]��X/�]k�0j�	�h�̑��	���
o�to�т䦑f�-���g��K��c'#�v�4���HW�(�ba�겾��5��]l���|qE�����=���W@6q]mRB���H��5�sM�����*��s�#$���拏�TJA�m�����PK-M��x��JW���s���1`���&�sɞQ� ]�3G�O�m�"��3H�*����ض��S���b�V[�9�\�D������@��~Ϳ�>�B��ԏ����� X�I�VD�+��̺���!��|�ePf�����A�E�t����J���j�τ�Si�	����+�>����b���wZ�����ݹS<R�܋��OSBP���t8���"�v��Fgˎ��]�!�B�%!0h���'��� �Dz;���hZ-
�����)�
~*M��'N3o��pq�]oc�TQ�Yʿ\�^i?ԁ7��y{�U�_�Ӫ��<���Jc!�}����<U`t�3�z�{%e����^VA��!�~���5��̠^��bA��q�f2R�a�ǌ�O%VD�
���~7r�c��%Q�l� �#��zlo*��P�g��Q��>��(x/���1����Qt��sݗ�K����S���R^ ��6�9�������j��-��};}h
C޺R=�`��ꃽ�&�%���Rn�@g��3�ד��
g�.j�k��
����#�@Q&FDΖ�ö����۸̼�ղP��C3M�}�B�RU��AU�µ&&���LEʺ�͟J2��!�������ˢ{��g ���� �7'*�$��TW|�C͗*wՠ��F�#U��� �k�ֆ�Ǘ)ɏx����cɊ��}zF�(��n��mE~��۫I
S��Ååѭ���6ځ����O/a#&	\��aTh+AH��pŧ��q�Oƍ���n�J3w�=`*c�ã��
�g�:ʭe���[-�cvI�B"���Fk�ik0������U�dA0;G'xv���E���{�x��=T�|tv���b�Z(�lmK��R�x�<֎a��G`�����q�M�M�?�%lA�"u�ٵ�N���K�N\��CS~�f��7�i�3*�]��F�/��]�
f�\��-X�:Y���߸b3N�>����`͛��~e ���;~v;��%٤��.A���O��qGB
�j��x�#Jc�������%E�Ϸf@��cS���� ����.e�g��ńn0)S��E�g�f@���o"�G���T���ߠ��-h�dm��"�[�h��O2(��)4j^$^
�Ge(~�H�����h�<�+e���1bZ��;�t�ڧ�Lm� [.�oi�L�C�;�aj����~_JݏB
4~G�d}�MS.�d�oi��N��.�qA:�>���O
p����)J/Frp����+Wd�����kpVy���2
����*��py����5���c�#޴�2j�"y��?��9Di���&3_�-٫�(���0��\ǁK�H��t&k���s6�p�����W���o�?}��	��@Qٻ*4�b��$:�ɟj/^�!"N��� _M�5�@���H-O�^G��v����-��r�~T�U�|/*ƍ��$�V�G�����p��)ځ	Y�Ϣqp
�<8}���$��-~'��#�8y^��2
����Ĝa�
��!���%�1���ހ�A!�(Һ��H�ɇ�~�ҏϕ��'} -E�v�g��i��A���-d/��9�_��e(0��Üy�UG�nU^�G�?,Y� �L��Ăs��Q�y�5�TT��0	�DI.���r�+�"�?k�(ΐ"|w&����Q�FR
$$U�j �aL<����Fz���Ŕ0��x?^���z���0�qO�U����^�+��10�����gnI��(�܏���H��\�����H��]�sl�:1��7�솕�03����tw�$s�6ƪ��r�)����	
W$5)W�@�"�$<�@�f
c�|h�N5��� �@�X�nI�����-����i�A<���D��j�J��D�Vo�Nl)ɟ'��r�uW�^r| �7rM����=�gFVV��h�J�1ї��7>��-��o�р{�����_a��D	�*g���l#���n�0�jq���gw��#��1�S�<y=�
��Sg�@�߮�u*�]��]���Z����p�1f7l�j*�Z�ڎ(�=n���tfk'�T�axL��Q��#�,�4 ��B�3$�9?�2�];�#�Ʉ����>�����ub��,�з^��;嚿�P= ΰL�Z$�D�{d��ҭs��z�2���"U�U�I�y�l[��d����6�*{P^oG2�U�)Th�����w,����)]c4dVY	ce�W�,��v����3~;f@S����c=�O*&6)n�2�,�)rN�8P��5
^&|�nVR1��<���ђ��Ǿ2c��ĸ�oq���>T�� oX���CFJZ�8�
����4�-{�7���bu'"t��*[����ۓj&��J
��g;1�1�1�]�������}��b8��2�]������Є̜�^���J
oT��+����Zq�d��6�k�ji�c.�Z���˱�����	�H8�4&�P|^�A�ث?��8tFC�����t�ĝj�M(�ں��޶�M��M�K����d� ��"�iR�uNA�o�j�"����Q�/���Wa�V�^�pob/���'GvL�D(��5rsF!y�_6��nl�ˮ�~����JAE���u.[װ`����������`(� �hKau�=�I��t2���4��-�9)�b�V�e���s�>~�?�qi��� ��C-�=zz?]�e9�a�xJ�ȝ��������$��6
�K��y�'Xs^A��[�c�Z��<1֧(����ֺ�X��^˰)�`S*��̏y?*g�p�ڴ����I
U�c��>� 0�w���#�@��v��eV��EWk+k���������N�6ZΙ�粔���t;��s��-ٷ�ɺ�E��C���� �/�q�.�آ�?yU)�������ĸD� �J��ή� N�����@��:j2��T�����wSr�E�-�������|��мM��쫿`�d��D[��3v|���� ��@�E7���L�1r�3=���r��l�)Cͻ헧��z�������l��G�wb ���F��.u
)�dW�GN[hؘ����Y�#J?���Da�����ZT�0�YUq5����i;6P9�B6�����u�}�|�XO#�E�Ϗ\u�+b�i�n���oX⛾�N������#���Q=[����l�wO�d�9Gj�!�P:/��ܧ1
�t).��ː
�r�0Qynh�|R_tY��H�}�>�sC�7�P��,���K"��p��[�y��muHy�X�H�vv����Pz���7�v�i����1v a���2���c�э�+�K~/֒o��^�V���x�	� Ǥŝ�G{x���Vt�d�)�B��`ӿ�f�9bD���E��j��� u��1�mH=O~�Aߍ�r��&�=�~����FY�0y}�o^���{�jjJ��V��`�51��⫘Ϛ,�E��I5�X�.�^����݁b��\'x*y����-_'VD�
� 'zc�����ar��ryO�@�ѽ$]?��Ewn��4ޑ��2�}��'�m֯CӑG}�&�&�ܔ閃��r6��q��#E� ��vS�+�� ��Ѭ�?S����A��� <o��������T;mm�t
���#m�������n�;�� �?�J\�q�P@��z(��S��栖p>'���t�!Q�<�\V����9\
�[`oڥ
M��B$
����R�߶�X4����7�A�e��r��g����0��JáydJ|Ղ����F�3,�w	Ƞ��,Fb7_{<2��LDG
��#k&�)Z����4��<A�}�HW'���V��
@4̐+���D��m���m��|h�R[�>^N:IH��XNO���:��%/p�6�����s��XpS��
o[���EɅ.�/Ҝw�#t�e u����W����!p�I6UB�r���� ���y���Ui�8{��ϋ��aL���i�g�y%�% ����/1ƫDG��z4�}��@�Ka��[�2�7G{1�ž��f��nܐ��!�q��c��%�*a���r�E���'{W�%��
v\.�k��ߠ�OA}��� CZ���no�n��@[73[oU4��`�ҋ�3%p��xY���yv��|#�n��{�Hf������L�h�u�ԁ�������p����-��y�;�:��A8�֙��V޺�jl'�{�q*��=�t�/��
�H����x��zm�#��p;
.���ڱ��=�s���� Z2�A�r1K��k�L���5Qb
-?{�$�ݹw�}�H4w��7�������D�t]9SP�p�ΈNb]��F)Ѵ2�V,� ]x��iE�s���q~KZ]���ߙ�0z��O���{��m�Ŀ9])�U��ˬj��M5.�ȸ�	1�!f�s����_n��;+�%���N�«$�`�����gP)[UWo�{j'Y#(�(��O'�xZ�����C��h
�B�iꈚ���g��8��C0��o��� Fѹ�'���g��B�}u��>�@��k,��(L����?jo�a��cC=� ��\�A�Rwk\v}lM�D�}ް3���uU�/�n�_@�-����Gz�J-w&v�2���Y���t�1�S^�G���q��i�s���s@n��>��_tE'?Er��^�u�栿����:bhkBwǘ�V�%y���W�qsɏJ�ħo�	遧Ʃ�'�C�m�ɜ�P{��`N����c�}���r����z�q n^ĥ��RƎl ��SMJ/�����=��J�G�Ǡ�_�������i�%A���4�н���S�qG�T�Mp��XRi��@�P'-�>!qN�d��3�X�;�U�_ؾ=�N��z�N�Wr�2�4a�
ąk"
A�t�zt�\�}t����_�و���|On������U;��fG� �5�$6I�Cӭ��.����]-��;T�-Ö��,&Z`j��qY����T��1�֌���5�#�d��%�YV٘�(1h����.ʃ</^ڹ��/�a����z��+3�'�<
+�{�಴�Waר��3 f�ۨ~ d3�|m�ܖ��f1mٛSy� b.(O8\h�������}�ᦶ+.�l.=Ԩ�����	6h�*]��0,DB>a��5$�b��C��<E�a4�%�`±1yh�%��-�mRޙ�1��<50!���P_��h`���ˇ�w��?,�W�8���O
Z��eج;Z�����?��Gޞ]2�B@�2p1ɤ����k�k��i�r5Y
����Z�T�R��5ca�"�j�VD3��vB��F/�l�. �8v}Y���*_�}�m�s�e�KP��d
qy��\��Q+ox?/R�K��ы�p��cbm	��$�o���=�]����ꮒ[�n��p��\& ��Q�$�����{������z���A��"�v;�G*,���N���]K�K\6��� &�|���e�?[b&���z�u� ���FЌ!*�k��!
��eg�=J��Ż�W��ŏy��u���Keø/B�l&~��+fy��'�^YdE,k�g���a'���:Q-��]j���Z;x�j���1�,������ѫ8��?�V1R�P:���u�})��g��ђt� �0V�)���ﺝ�[⣷�mm�V7�(�!r*2�_0H+c7+�y�.��Y �
~�L�����>v�=3c4ux�����	V�[��x�\XY��vp��5M<-�"���Z} �˺�v�j"��þo~����_��87�v�P�۴�R�������ћ�
}��K�dšvBQ����X<u�l=�Xq�uGP#���I�[Fo@+����J�O�g���@|_�/�C�Kr�un⥬�x���,�	�]���/M��'_�,�Kj��4R��ڐ4���
�I�y#{�5��:�����%���$�;ǭ���:���Ý?l�h8�r�1�~���˾�z@��%��3���H5膹�MJϒ�b���bZ*c��qEt�d��;���|�	C�&y��҆~!N�j���O��ߟb;Bfj�+4;�;���i�����Tb�/��7�2[�h�%��jh��J8���:�u/~�3�Y�3�/]�gI�Z�ؕ�y��q L���;��5]ۻ8��Zr���o`��\|���$�4ȖxK��$J�`��Z���M[-�b����o�_;},U4r$�M\5r�6�.;1���k���uΡ3�a�ډ�/h�*:���N��w ��b�B�+�����y��;��[�c�\YZA��s�\�Hٝ�O�rg�Ο^���^x"tO&ђ'�i�x��l��d��7|����� eR�[箼S�(|>�'e6[����śn��C�
�`{Ʀ ���H�q'�(�u���MM������3��8-�4������d�${.���%ULX�Q4�[��Y�AWt:ܰ;|c��1QƃW�jz��z�च//͛S���⅓V�@���Yt�DQTx����
*T٪uD8�����Pn?�
6��.�j�Z��R���D�������l�E�?v����F�G�#.T8� 8�gK���W�Źܧ��f��iA�E|h�-3��������͂�Z�A�UTX~���l��v>���	"�#�,��2M�z�K!�t���.�T�
�e��D_���S!�'��υ����
~[�2z=��y�Y�M��vC��at5
��,�pW՞�ڡ��#�>�
�K����Ȗ��\:n��;�M�t��K$�xM^k$"�כֿ�Vs�e�aL�Hs9պ?Bh��N��XlG!��Gxz�
<�n��mռf��_1���1D��x��kY�rnZ�]z�Iw+�a��vZ�N4�.�`<�S�Y�ʑ/��c�T��T�C�`���81D����-e��� 1���BR���Fjqz�$f91jl�}��%��x{
���7%�����CN�{�P�%��?hkk��P��,[
���N+@�Ǒd���y��rXhi$�Z54 ��ZMEK]l��⺨�><9�Q����������Tbi����)7�������V/r@�-E�����:#@auV<����k��IE�8+L<�9��VVUXP^����}�?����A�2-�uZ�Y��P!���������x�:Дsy��:ߒj�]HY��P�A�6|��,��g 2����omzs4�}�x�$1��	��
��)N2ݜKW���nᎠ�s@7JDP�����2)!�@��� e�_���`�X�٣.��s[Ǳ�߱j�ZKas�Kp�!��I�*��+��H�S�xs��04�*��boP IUA.�v����'խ� Vvq 6��%Ⴝ�w����sW	p�
F����#��X�$v$cM:��+�#����B���6U�|V1v�5��Wa��Z�ԌŬ��$'�Xm���>�WY�����ϧ8��)��o ��D��ٮ��	%��9�}ZA���M+@�Զ��؈��w�SdE�>M�uL|`���vۂD-l�\���������%a+����������H��m�ҁ&R�dS�N�D�����7�'�d�gTj醠�^�(ŀ�O��R-��|}��a�{�g�����2N�I�ƾ�\��4l�
���v�E��"b(�?`�D�94s�k�i��3��b<�}�����.�r6{D1��u��4.����O}mؘNSn�˥�j��gIM�r�w�0��r�&f�v�d(Ͱ��ŭ8R�/���&0� w�]�!EL䩽��,kf\Ru6#>M��� �f��u:�}��1!^�?�p2!н�5�W�n�b�oB%����4n#ʒ�X�e�;���nU�K���v�#;���x.��^��/v���I�C�x�l��t��kY�A��Q��ME$m�_I�p�a�k�j��#��"d,u3�/���Kd>�v�Yfؖ�+*0����Q�ja
΁ G)G�J�����Xm�o��8�T��֮�ŷ���o�6sΞ֘��s��-^m��CI?m]�쵐O��<WRQ��l	��#�º2��\���Ȱ��:�b�_;
���|Y���執<�V���ߪQSق�[q-oNڔ�j66���h��CP��m�G(�:Ӹ�� �&��ú�p"�����䅼�&1 ^�<Wk�lO�.��\0��&�p�?z�ĘR�.W0u�9�0"28@�&���\%Ebb��ФZ��sC����!��r->��tz�~>�Ӄ�,������c%�ѡ�`��B�� ��T�n���}�{��ol[e�	FCn���j��
nf��g�J�X�@��^a��	x	��+̨[1��	�˓���U�E�9���*Y��+b����w&�<�WYH�^���
mL�<�O.~����Ф��բ�w�Pk��F��� ���?�-����Y�������=��mb�'�[����liI�Q�%�5QnL��?��
>�Ѿ�?Ҹ 5u#�=.�=FA��V-]�%���ѣ��ҵ������P\�8�	��4�y2^��O�����P�f�3ȱ0J�̜��
"S�Sާ´�@
%��]���n��xb��}"�G=kE���	5�4�=��T8m����S�k�e�x��)!����]����\nv���@��\	��e��&�ry«x͏^>*��9��M�2WU��J�������0�-�TY�-�a�EBw������:|�����9��BfO g
PtN�&�؝��mk8���*b�vK�B�ڋ�g6���g9@N���U{1�� �-U�����*u��Fd��M����"�������,<|/K�V�"ėJI~
���(�}!By ����ٵ�#�'�A��d�4�#ᐫ�)83��?�?����������٣�xf��S�G���Cq��T��(S㟼�HK�v�Ę&�[���Xʈ5�m� ! �C�qoA�C��V��G�x*)�b�B��o�P��NCmDQ뤛.i��^�^L�aش��Y�l9i�T�k�>
������xiA��Z��.�KN׷ld�8�z�Լ�?]B���@�܄���� W�E �E|�l����_�SgZe�����@�e��x�Κ�)k�n�ߓ�A��q��m�JX���Z�� Z 2�/\��/�ƙ��'�<6F�]���.z�Jy�+eS�V��5ڻ�����hH����u6�v�6���uIF�O�M��IQ �~md��pź�3������D�S7F���X�����*�	j���D�':Pu�
x�����*kH�عVP2�~-��FԼ���:���V$����.c�Z�Ò�5qV�v.eKm𑸡��\��><���4�����Kt�B��G�+ܷ���z��Q��u? �������/��u�̇���Za$�]Ɂabq��.
A�wt�}�b/C'�����m�4�,}	�!�Q����x�$��=2�MР�
�5z�	�Vp�T~�d1榵�1���W�z��7�UW�de|v�wb+��|���v�(�|}���SW(���dٝ�G�l�E���
n$�7�dؠ�%*A�Gwt�� ��W�B�b~��
���pD�����-�
Ev�.`��l�ԙ��)�������V��R�/�����y��u���t	�>��vy�:�
�'� KP�z�pB<1�"����ф�o0���>�J�i�/�#e��"�s� b��$zg�<�,��u9q���"N�����+�k�>�~
)Ycɏ$<}[�sFyh��1:�!^�z6�G��8r�:mN��T`գ�w�}�x�14H²2��h~^�ݒ�_������S�|�&��:T��I粈_����2|q�g�|�Lj&�%~K�6W�PL�L���x;�Ȉa1��i0�˨چ��<��ݣۖӢ��W��Țݒ�ZyI��i��V®车c��QA�#H���7k�f,�̖T{ј���N�^�6�qdF\��\}Bq���ŞH���P��}�����Old�>��#XX����Ax����j�׺K�vs�Ƣ���8L� ��O�.K� MR�vG$+C�Ʒ���cK���T�!v�>��A���Y�c���T�IF^7�|&��պGú�)ː�҅ӝ�7@���n�����c���R����>%g��	C�\��  m�8���GQ�0	{�D"H��Ԃxi�pݺ�Y1�a&��c�>X�G�K����=Yf<#�z�-~��0
h�4����Dz��Z���� ��m����dq��`��đ��2����.rHD܌��K�m������՜<�Ƌ���Q�\[2�ؔ�^�ҩ�s����Kb�z;,��RG&Q��V���/��,��EpZ:]�'
�g4�C�BT8�)�s��ɧt|�s8�\���n�4�l��%��6&iRsKf�q����1��ˤ�Gu%Sh�����|���y�����X�v��)��h@���f�ȹɓ^��XVp,������f�Y����c��n;v�"G6��6���s��(��	�1dk��e��3nﻖ�H��6��m���/�� ��*0yMj�����0���.��xcH��v�V�Q@��텉���^�2���::��[�����p"b���ͧ���@�uX ���O�7���U`m�
�.�G.���E��`�){6�A�T9[�)��9�O&���KP��w���dܚ�xDP�?��C�����.�C�Ǎ�"BI%����,�'.1��|aGP ,�Ay$�<�7��C�f�?��3a��n��HS�����?*b��-��c8���S��:��|k��ϕ
��#��u=g:�5���h���1��I��)%�;��&��5�5e	8R��ϛ�`4N�*~�5�F�>?FC�v��Nz�zs�g��3؆���������8@�����5>�N��ՠ������؊���'��c/�[5[S.�O�릣�Gs^~&h*J�ִ.���ثl�������c�3<�i����F@�!O�)W��|oLp��}/\�c��w���fwp��<X���h�`Dό/��a��*�_�:*���u����1&�������~�������v#�;},$�8�3v�8����`I�E?����M������&��v��]��(��7EmG�#3H�Mc O!�Z��`7S�0T�D�Ym ����9��o�je����F�X��tE��(J^�r!��;h�|�L@�lj�pv5�y��v5��
��t�p�
�^ľ��	�j���f��͖�+ʦ��&�˄��� ,1���&%��Ȁ
N�(���Vh�����?z�ܿ�s����>��E�kXF�۝e6<�[�Ӭc�1�~i���i@ԝe�ug����j�GQ �t�D�5 �l����������L$�.���(i]�Xq��o2t 9�֘*/#ܺ7}�>FEqy�t4�@�'aTKay�K���%��~�,s�ûg�J�w���#�����1�.r� ��<CaZ��#��ɺ���M��y�i"�$�Uq*���ӟ,[��k�RF��w�z�����՛��3V8����I��.��2p.qT�NƊ��$"E�x�S��OtyC ��"��Wc��'f�I/�Xv�]�#Y��E'_�����U�d� W����䍰�
 Miu�����Lh�VJ����g:���LQn�Ȇ�5�C����ò��;�[�ڐl���HR�L�%�"X+^�	́(i]�1Џf0�~�Sp�+ȧX.�S9��'��<L`W���۪�Uȑ����<���ޥB�A�ϩAU����fwP�	�7!�Y
ݵ[g�;֣v�5[̬�"�<��K]�O5J�j����� �U4yu@���,4�5����[,~��ie��ˊR���w]�1��\��7�1J�_񴆆F�� Y"�*~��@
2u�W �DΌ����l����^iy�Qn�ik#����B�-��Јع���u0����C~*k/�O5y�θ=�:d�e�YA�%�����K�{x�D��ߡ531�i�*e�]�9�\ ������ M;��#�Z45g��p�S��]Ȱ�Q���}���_k�P���$�ڒ��/���)YM�U��r�**i9X5o��I�C�N_S!���~`�+��)��U<�����tV�bh�݇���z���C�و���F�/n̚H�=[A�d���i̾��`��>š��O��e?\u�}G$Z�]!�aJJT7F�3�v��:�)Jg�-�~�l%�=�>���lh4�c\�;�Ct�^~�2x��7�n:��J�
.���'�!/������Í��pVS�RN���.����btRC�_f�/����ɏr>9���������s"o���ę�Y].Yv�X
k�
��J���s��ǋ&�j���I�VO{M��
P����h�����m�R����
�o)�n8�6�Q�����zk�A��CBg�$K��d�^~u����l@8�gJS/����Nz	lW�ݕ]��� r��a���gRژm�}Blwpٴ���/z�@����(����}�7���������V؞�ϰ�J��؃7"X�Y�uWw����Z��.U����U�E�t��`���_�G�S�O)����5����B ��-�E{]s�e4���*I(�=RP�4�^�u�̂H�f7v��L⏔���*W	��v)�y�ƫ�F�|
�xPj��Q1���;�3�&�:>��y���yf��2;�
�)M0�l��T
9���(+~�
W�:2��/G+�-��E��g��UPx��Q^���^O�mi�h~w��;߇4L0?�Й�_d9CH�\���hA��r���{c�d>�p�[W:;��&��`7]m<�I)�F(��n�tb��	k�l���h�g7�9o�ô��vu�m,�b&'&�[bn���Q�>�0����+�V	�ZY���ڛK܍7���|������!��� p�I�e�N���9��a�V�1�11��/L�����<� �?
G�_���l����|QhB��L?�x�Էb�OC������[��E��F�w2���7 ��76��p��<�2�L����*��>܌�� v�6nF	Y<8ڙ��W��`cp<z��A�84���}��C�����Yb��DQ݁:E��t�)���)moxC->�x9�#���
%���:z`���_�e����&8���(?�
�3����K�٨�<�M/��kR��kF5��7K#g�n��h;��:o7C���Ύdi"���/��m����M&&w
���sx���y��V��Q[�Hܪq��Gg�sS�a��M�BzaC6��ߘ:�ѽ+�%�l��2O+2
p�f��aa!#�g�4��$eo�\d���\���DE��a����9�QX!˂+=y�Nu��țtyo�򵗧��Sz�����gG�{:��kxH��1b�'ˌ�ǫ��;�+M�'�V8�+&w6���:Iy��Gl"�Ԣ.^3U�@��2w.)u�&'Ӻv
_w���X��s���T$U���I���o�x%��vL���Ju�'[�9`�\�r���d,�ӬX�Q�?�՟������O?V1�ٟ5�N��z�c��,��;A�N�����˪)*�9,�7?�1L���H����zO74���|�J����8����G�h�H��-�u�U'���ɟ��� '��]���/dK$�h.m�'ӹnY]%��%<0��l꭪�s1����Anz�����(�[L�-���]�7}"�ș�j�	m�q�),}L&L �&�Ы��Єi7!��j
�s�W��9�đ���qt��J�j_>���Fʼh ��W�y�"��]�"�]&�{��Y�S���\�l`u��r2QQ9�f��\�O�>�*��Q��:
��l���5�ގ	PXd�[�r7�Bƌ�-U�����,�MIm&a7|�QŌrd��J��/	�H�k�C0��Ҩ�qoN|�cͻo��X�	5�wC@���ah��.Y����Ճt�-f��^쮀7墅hx��+Դ�|@��3�;hm��SL��YKr�nV
����MnG���Y�Ԧ8l�����E�=bU}�6ȣB`Z�g��}�^�z�tIoo�E�"�aA,ˏ�����q���U��>Z&�7�9T��{�
���1�F�>m�(�i��U���͈�N���A5��C�l_�A�	�Q�w�W�'�L��4/�Sb8o^�@���(�m�*�C��.o~�c�μ��IN�ן�ԟ�-��5��Uݵ�P�`cAA��%���t�2�����X���Dߠ����A���K��N�_'Xߤ:y���.`�3��>D#ۻΆ���M�X���c��M55��eb(q�<:�Ϫ�۟�%��'Kkb�&���p��T�"�K��s�@�:3#�����s(=l��^aՆ� �cZ߫�}��f�d���5�M�����Ԭ�l���ڎ�$��L�a7��Md��	tHlA����%�/��H�"9����pI�zD'��^X��C���8죔�8|�%��?j"�pY����tF�~�趜nӴD_�-F�m:J 
��ȴd��"��	r��,����_�2Y?l7;}�+������+����8����OA)�!v�+<�p@ۇ�������ی������P:h�K� ��v�x�$Ns�n�G��T���Am_�!�z[S;�M��YtL5�}���e`��#� ��C-��dK�ׯ��X�:[g4'�ܧ���s^yȫg�!G����g�{4����Q��F"�x��Ԉ�$@׹���]_�ru�1��m��뛂X�}�mv���>�\�ȸ���h13��%P��ӄ�F��S	������� ��z�gg��� x���~pl���N�����U%돬��p旛����n�&H�7��5�.P�o&!��.#�R��.�E��
#�l(Zs�
�ǎ�h�tph@�{r2�ǹU%�$��ݳhƻ�W`z�xF����ML�ל�v�l�;{r|s��`�S��R��
���,�簯2V=
Zr�pf�V�=�-�E�����,�3�(
�\"�S-h����a~-�p���[�t��^7�d���hi&3 ���;jN��MӿE(o����}G�N�)��pjq����n/]��#�]���$t�H�a�:b��ym���T�$)֭c�鿟NQޝ2e��;�lP���(A����n���b$�F�>�*�-whDݡoI<��Pv���ve�j��Սuoo��Q{��To"��'_br��+�s��ƪ�Ϸ�ma
h��sd���@5�70�M����>�l3�x���H�c&?x��D�z ���q.��0��]҃�
��]�{`ї�
�l�S��vP	Z�^�rTe܉]��j�,f����V6S��o_��� vVk��[Uzj�7r����$��(��D�&��\�9I��5Ȭ��/��xg��2����*\�����F�������\��c UE�Ԝ�����);��4�,ϊ�5��xE/���_���ϰ�òg�@�O�N��k%��J�v�-M>�;�V>x��B��rP��]�O*m�����7��
,?��Z��ca��U���K���㎷��wn�i�mV���MG��7F&U�M:��<?��W	;P�zN�u���2�]���12��fX�G��Z�:]tr]�EO[�������)v����(ª����7���sg���'b]lC��S%�$����Lv���g�j5���f��
�}����LCz��������`F�򅆿a� �K�S�.�L��di�)[o4b���rT���i|��]Y�{(�y֣}!�r���t�1���`]��p�(��6�O<�����<�[L%}78H����R�p�Pa��"���˂�×�8�i0ֳ�D�m,
�9�����ތS����\��Cv�J;
��U��l�~l�"�V��1F#c=
��2�-�1b��ю*����
����F/�٘��><}u��I�;�ێ�Fb	2�͡{3�M!����㙣��|S�)s�\��[�p�Y"P�&�q��]�y[�> 	/j��_��.��5mc�/UI4�L���bS�랥�b�7	�&"�V=֓�v��ٳ..� �9��b�^���ρ���3]�(i���&WJ���ry�'9<E�xD�d��'�mζ��60���W.cv�Jk���i�[���'�R�s
BkN� �\[Q�$��(T.d��Q���8��K4�O���%�0�T��׷kT�G�d~b�x����`z�f��3��BF`���s�"y����( ��	���ݧy��������k0�/�oU�ƛ�<���l�.2��9c,Z�>���#J&��@�iz��מ�~��0a����t�M�)ƣ���;X�g��C�5[�#�i�%�Ey����]�xp�FD�*�^�Nz�]�Z�3��<,��V��a���F����3Te]h�˿�X/²b=���Y)*�[��N�훡�z  ��;֣܀T�ճ�0�=J�6��Rψ��q��3T�����A;A��
َҷ�t�].7�Ok\6Gkl�����X
`���j�D ��wIq�����C
�^Ů��V�Q
�`��[2�
`<Xg��d`σlē������z� t��:�Β �b�m�~�zY�D��s�oN�m��L�1Z�6�]<�I����W;"jl<�c]�ˤn�-8tf����C{4�3E2�i��K���c��3V5�m[d�2�*�tv�j?U�.��q��8[gH��3��w�ྮ���
v�vG�I�q	�����8uM��{O�洽F�&�|�C�� ��`/}<2�X��Q-l�Q"k
�|���n_ꝡ=����U��F�{��=�0�̌[������h���O��Ya�$�'? �
����|��Ma�
����Fq-��O�㯁І��6OkQ*���y��t;�JLr�x2�E3z���KV2��0�aa֕��)G���"��}����3
����LoGD��x��Y`� ����Cz0z�S���nH-$�|����K���"��v̱\�ʈz���v�2�e�4�.�`�dES��	��y��ګu2�C�
��c�������p
�ݩ�����rf`�+����L!�Bv���.��"}9d�B�-���}e4x����Fm���"�s�(܅��^ �p��"`r1�?���!��1���4�7*Gr���o$1�+X3�:�
# ���+)O�;	�tVl��8�3�+j��`4������'���d��	@������UCƆI���C�3�U�d��y��A�୍9�viCL���P�O��R��O��y�G ���ܼ�$��Yb~q�������`����G�k����S$��#���{A���&"f���P��/B�,��CpY�*����k�"�̵KS�G�E���z�����C��UlTS����3��6������ȥnJ�x냤����9BO��sp|ܢW�LzB�d�Y�r��C��ԏJI�<�]�f3k�a��47�V�aF�����5\�x�|=GM9
5u�/��_��ߏt3m���br��~��&ۅ��X�H�
�ꭍ��8l���Z�NJ�tY]��e&���U��X��E�~����+/�m��S��jf�����B[���4���B���U�z��*wo�H�"�zF48t�����@z~�g�ti�{�tZ��āD��b��*�����67J�@Нe��H��B���@9TU�e����
)��+͜� ^A6��0�i }s� �yϘ���c�\wv{��k����B
G-z�6����3r�Pb��H�"k��t�#g(O?M��f	ZQh2��B2�h'8)���)�g����o��e�Qn ?(�h\�Ha�o"=7�a�Xr���x�3�Q�
rj
W&9JG(|d�H#�o�9=���S��0�
֫�Po�#��d81��������J�f����_�,+,,�-���d���3�:鶜�q9��	Gb�ݞD��t��������˱�s�1xIU>�dȀpI��`Q;
���o��^m�P��r
�
�q�;�k��(Ƕ���7�-���%�E�ָN}#Y�Z�]�X�t!���q`����0�����;Nq���pA��B!t�,&�j�WF
K���u��&U�68�P-kĚVi�w5 �5�:���������5\/��{f���$�J�K �US�ezR�n8Y��.*5�?��[N-M�p˽��3r6^�#֏�Ҹ��t�C�Cw��A�z��yk�q�HęI�S7������Z��|�a�\�ړj�/�R��#fpK؅6�YI��
�]E��V���mhx{�� K�A.�CI�����}�b�U�oK�����<K�~u��٬���	x
�E��L�_�J�|o��e�<R�ƚQ�e���|��p�����r�4��1Y�����:�aRq�e6D�2��奝�#���@�G�qo*� �D8�[�I6�POq>�~%�3~����� �Z�m�k��@�7�z� #Z�_8��&�Re�$��c=>o���k��U
�G'\:m'�����}��o\.�K�P�	���EE{�g���v�`��Z���>�e��W�ʔ�<���	�ΆЕ c�Ü#���\ĩs����/҈�?��͡y�	��H�p"�&�j� ��1�IO(�����P+  �p�6'b܏WD�vn ���Ǣ	k�׳�8l�x�|�O��X��j-��� ��(2���hu|E�>Mč�-7|;7|��GIڕ�9�_��r&�nQ��|��^��J�2�_�
k��cn]q:\`!��v'TTQ2��1���m�����RA*LQ��{�����K��n`g|����ΛĊ��,�*�Q��?a�P^KEP�����*e�5p��2Pވ�.<fD�O�����\�WZÀ�lK]͆�-sGV�;��[{��Rfӄm?�~5�/��5�R,t�	��Q�v`<O@��O�x��b�xEșy���z4��<��\V�q�d�>�q@�����A������Q�BSc ��%��>�!a}��n
�H���Fw���K!�i�,����NZQ�"/��"R���[WMQ~���K���`��i*K���
��	�fN#����
�+�P�wI��R�M�:�X�Xq@as��r�dA4��]�����`$)��Jm���hb��\��ˊ���!��
�`��ia��S�,���>O�'`�d��V��+a�'>.�J@m�;��
]�r�U�S�Iϟ��Gyq7� i
����N�GV���ݸ)\���
�:�ƛ:�+h�0��avZ�&����e�ċ�0���L7�5�a���gf��>��ᮋ���2U�b�j�j�d
���=���0#zu�U��s�����O���n����b�Y|2�#���c�'�8\r>(@�N󒙨�lmF�\8�_[ޙ��M��o�=p�^CAm�$�y�R��_	MC��a��$�Oz�;�m��:ww>�c���L��ě��¦�*a�n̏��"!Z�Ó?[�� ��(/Bה�ɝ�[�eD��M㵤�-��G6��xO�#�*!� L����"���_}q�}$Vq21��(�_}�W�� /Duk�&�}d�y�jw�Oޭ��<������ �w���"� ���="'�C������ȁ@Ӟ��j����[S]� yz���9�d0Ы�Z��7��X�+J�?�=@Yԩ�=��	�O���BTcr:�/1����DI��!��%V`�����s���'��G�������޴W�qd����꙱�����*�L�����S���n�Ss��:瞕�������RO���I�{,�'��2E���Ϲ�]B\�?1Ճ����A����7i�)��|Q�|H��ܩ3�n,��*��D�:�ۑ���6�Ed�.��>C�e\HՃ{;����{>�Dz��8��t��ةy��&8�i�[���1����~���G�c��+�nߖ@�@r�e��rY7��*������S�~t��p"�b�����`t	"�Ɂ@���8������_�f��ߣ��M� ���4�햡����4�ޖf,����P�!l�C��̶O�����.���\=�*ƪ�㭁'+|����+�������yNjտ�oHR"����Z�\���d���'�C�+�Gqv�e��.E�@A\��ҍ�T�-��4�Uz�+��Cu"Mi7�!P�Ј� /�`����<;B�牸I���U{h��?<bol�B�FG�d��#���Ō�b_^Ek3�H���&;��g����}���B�sȅ�gB7ݫk.���W���%5�3*o:@�i��yk����\��79Ò˗2K��4��@�KkV� ~g�qx���ۣ�A�{���i�F��P0b_����Q5[��}M0c����Ճ���ů.{yp�)�8��������Y�tf��#.�9H�޿�o�3cf0D�,����؇��@c���
^�

�
���9&ohF��X^�L[�r+�
�LtG�yG�e�������;]���t���1�s�xԲ�3�ߎ�k�9+l�1}mz��(��]X�`�:�����۬c��W���_�\�
��w\]�%1�#&y����Z�	����W�K6:��(4�u1.Z4L2���Z�|���ɠ5]>[>��i!g��?x69�NE�#ڭ7�O��BW���t.g뤼[�����[��F������^��=�o�/��f����	�	|E�n�q�� @�D�նX���*0��PAJ��1`̣a��m��@j�j|7!-4),'&��P፦�ó�-D�C�'�wO����6���>�|
W�0�%r~{䳥�n:Uk�y�B|�x����R�-�m��k�����
�(�����ٿ�qd9��ؙ�����0N�_E>��,���{���K�=v���_S��1�2!.r�����`͵zd�v7o��y�S�O�$ޮHnf��n86�8����K��q��uy��i�QV��Ҡm SE�N�i����m�zDO
	�<�3Q)�^YĚ^uh��1��q�76 Qe\(\��	0+b����Ժ�z0�ґ�f(���V�]���*�����]�qA>8�bjP���<����Y�)�J�:���� !*���6�j/�kLd����1�MwGb���ZS��n"`�=��:�ͥ�UB���<���P�8��h-(X���^?ʽ�at�&�T�`(NLc�ez�ڷcrS2���/�:��G�!�
/���؂����~��5����;uIq6��S������2�U�cPϤ�s#!�� W�׺���t�Q�(�"���a�>ᓲӃ���}S���j���0
.�r���|Bu��rW���@���ag�U:���[uZ��ׁf|�ڶ��V�� bt	uȵsVv.�����=o!���Ѹ�z��J7	�ёR���2_�F��TA�'��.�0A=ҴqN�܁l�i7s��Ln���Z����w�����x��BO�CV�����rTcr��8`q�s��a#�ٞ��n�qo��1,f���W$�6e >�|X�U�}�v
��L���k�;0���`q����JC��9E���!���6��Hf٩U�ġ�~�o%�gsO6b�k2 �r� WW�����.^/V��o���A3�#
��i�w�aJm��c�a��gNn��,W�Cn?�zD�ٔ?'����\)c�?����c���HM�3���T>xވ�_�-N���"����M�ʊ����ڶ2j庫>��lS�b(#�`���,$؝���̥ X��V?�~�v�U;"��!�:�Pp_d5�seW��"�Hm��J0?k��\rݿY�1Ż͆�_.�T�@z��&�h����a��{���1�EK�)��A�V���j�}Zd��x����G��s�eҴ��d5L�hz2WD;nlp���\b�6��D#���C𛖽{%�z)��|����P�3�`"QC����|Ch�e�m v8�S�����ш�{��V��~LXy�D)���${��e+^-j�� F��w7��?�L�9���JF�������B��j�o�hzh��1��ڡ��Z&c`C���q�X	�)�㫊d�g�%u�l S!O,$mѺY
�E�سjƇ.l�!2%���< ˛+���UY��>��իo��&�4;���^S��	���^�����(
Q#��d��Vu�8��O@��QɆ��p�6ߗ�=�3�\e��*�Ou1��q4�8m[,�.|���!�|�$�`ʹ��,؉��(��4�|7��"��`v�rZ�����5�� ��V7tf��8���t� ��}�E���c��&SE`�5/�m�ރHPGj�������?�JLs�
öytBQ��!�r��I��q54<l�=�:l��f�Vq�m�9�4�ҧt�4l9ၧ}t�N���n����S��߫�L�8��
R��CI�Yo������?*w�Ζz�����?��S���N+��u�;<n�>��d��7�~����ū���=��~��9ӠT���{mj<!K�IL��r�&8�u�Ҝ��˞��J[P�jT�	�V����"e��]�z5q�}|����?;l�>�lDSk1�B6g��o6F9��Ĝ�,�!�iU�[��;���jg�-�h�o�����=�좪�RNe
�w�Шܓ'pS��(=���{����X�':'B'nՅ��fttW���nV���
��
G�rzx�}p~���$�h�� �K�X�wi����ү�~�WJ�C�Z��'IQ��C�[�:`��UK� �s4���@��$����I7j�����%�.���5	^�����iN��) =��GvwV�'��l����L4���𛞄�>�N��4�w�2g��],�D�;8\��nG$_bC����Pȏ$*i��
z*ɝӅ��e�~n���3��5a�DIJ�	�{Ol�E��=-��[��˜�2��l%���:V��A��﫭�c20��Q�`Q5�eH"����#��H��\N��fO�$Fx����+ݓ��ܣfW��$I�M<WzJs��ҋ��,�1�E��Y��������&�w2y.-���J��߰=��)�����~dxq$�q��ӣ
)_jğ���Pf�Ii5=�r_���1q���a9�}
i[*�W���'=i��V��Ş��%��g���Yv��Z�NqM���{S���6�	���o��P>yi���i���+���  ���k�q�]Q�6!����,�6#�f��<j�~=ʒ�@F�M��EY�YdUr8��:`��ƍ'�,9���6�8غ]_R���8��Cބ��(�3o�+��ǣj�XH�o<�ϳI9���?�zz���Pj~�5�b6���l�Ou��s;v:g�P�T��z �9_����瀜Z)ALoK����;��hF녧	�1_��et��&j�W�.>_�Ed7��C`}��2���s�3�u�nRV�Z���b�0��:G�(��gE(0��E�9����ek�������Y9��Ԙ�+! ��Gzn�{���,���+{�)�8h�@�RQ�T�}��&�6�ΗoQ���0��T����;1Зz���Ȫ'�z�3d�$jGS@c�ӌ���Ө�������6�>�̦j�n/zJ�z�z�j:����T����(���v;|�*�!�	|�3�� �[��:t�G���۰?���ite �˷�5��ɾ=�.���k�J�ۜ��7M���Pp'�$CqK�s��0���G�"�sc�+�@��Ӵ؛�����2"��M��{t����P��'�O�-w'�q"�� �D���ep�����~��_ǀoOFz�t8_�
���ap'nR���ޛ�k�ne�W�Y�����U�5L�PN�T(_^�;��hX\� �[��g�Ke)���Y������׆��SA%�.Q
�R���';]���$��_��S�*HJ�-Y�҂���g�E{��Y�PΆ�j��\�gA?=�?ޑ�u�(����G
΅��:�Sx�D�y��N�����&ݴ\�b��?����"A0����aiN��E*��O��)d�X,p��y��+��$�&,$jO�o�sK���0�O�ę`|Vt�?}�젌�ۥ���O�Z/2����UҐp�忁>��~����qd�X#�e��*�GZ��S�ls�#�$4���_�� �2�B��~�:P��c�)�UB�E��tt��Ǘ(��,DA���I��� JmA���hA�����x2⿿,�);{�Մ
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
�ϴ_<��Qb��טp[���/��I59�S���*�¿�y\��Q�lf]�>�Z��S�\l)u�z�F�D��}l
��)�K6�h�ìU�' iBG���)��"7b�]��9�i�)�gj� j���o��v��f����ўf0�x��f�NDAfi*c(�����`op�n��W6�#���<aI�R
b��D4Y�����Ȧv�_�U։��o���A�̂T���6T6n�5�����222��� ��y����R�H×�0LDH�z�}�P �q���-=E��i�W/��<�J�sf ��IR���ۧN��P4f�$V
~��_	�H��
��S��j��ˇ v�	��HHh�C�S�P�Z*�0F�p�9�f`8�o[a
�Wĸ��.����GP�����v�3ǪT���v7x?��]i�j?T����cu *H�%
�w�LJ�p�$�wt��>6���(>�F���5��{�,���)��'H�d��^�Rlѫ�D��
Ɩ�%`vGIP�Q����<PB'��=�|,+�Н��w%�**��o�f�:�����Ǘ�!�𥰷��Ӓ��q��?�V��Q�j���a.6�j�G���Cӣ��#YjCJeEMg�N@\I�Hq�2�uw���甇�� �1�����ͻ
��s�ڗ�G5C6��tx��Kd��������\/<���0��0�	�l��o0��t`-V���u_S����r�+�UTݲ ɉ�M����A5T�E��U�R�5+�ȟ����Je��R�6��v��='Q�mA��� J�����ׅKt�����]q�	�G�eχ�˧��Yݞ��֭�1�@!]vz��p�G��m�I_Nkr2"��&>i��֒T��]�)ߥ�6..�#��n@����]��jϛR{�Y�����b�c�_#<�@J���
Fn��؝���9��E��МA��\�o���k���D0�tˬy�߿�G��b5�t����[�C6)�,�x�=��A=<�K�����,��8-��
{�� ��5b�ji���$Skm�)X���T�#�J�k����	k�MK�d��T"��L����`���M<p��l[�)]�T5����<?H_�8ʏ�ͷġBڄB����dGf�9��7:/�>7{�I��I������JR�$ܾ6|����?���	jȀ�`�_�"s+~z�+�L�{B���3\(89a��X؝���/k����'SZ,k�߻2�I�qi[��߄; �iL6�y�Γhi��<z�#50F`��l�=���5F�E��NV���ae��
�6�t�5w�8И;r��?4(�B��L��C!�p��I$��v�=��y�Y��Z�8��VC �����h��y�
�ʃY�=�q�|U���$�L�-�p�5�p[�zh۱����BH�oY��s^�v���M���v��$G��6hۙ�<m���̄�����_�)uq�������{�ߚ[+�`�H=�w�!Eu'����ŏaw��
6D��.�֛�ҽ�Pej�eP�ۀ�{u� �p�{+86�U�	�h x�,����ϘY��7T}�Jj�ףm^�H��d25�8��3x��.v�Z��Ҝ3�P�`��Qo�]v��P��ݪPAL�uj՗e7���ZFN�U��-�z-�Q��2)���XBf�j�%��]�6�r2/5F@��[%�E&�Y5	�Y oK7�c���W}�f_�A�k��)�-���P|�O�|��c<���ŔvN���P.�\����%�@�B���'����zQq��2@d�����C �&���D����p��V9J�$Fˮ��g5bճ�W>ǙP����
X-ECO�h�͇���W�u�K�5�P̢�1z4~+�^���rJ��������ܠ})["R��Hn�3�n�C��l�ʀ�h'$�Շ� ��~���Ky�I��[���Y�?��e��H�c��������C��4&'�ȅ�0�I�r�Je`4K8�a\� ��j����9�|�#�;(P�d-�Qk��.�^M>��ٮ;���Pgɺ���U��q\��G&ؤ�̉��n���sk����O
a�؛��G�萵�N{pP/��U���C�[���J�zI�A�G(CO-�1��2�Ke���2���yjR���>��*6��]�P�|�_p����9���n��nT;ȷ�<X*}8h�� �'刏?w�=;s,;���V �
���ח"�à� ��=x"CO
y���1�P��-�Q���NV��~�̚�/X
��*wBn����>u�aa�z��2�Le�yx|Y����0�	"���L��ډ.��0:�I���v\��p����o��$V�A'�@?L~�&0M�z�ȯ!�!>-����uw�*��S�
��f��	��oFBD}�T�b����x��+��2�ߙ���Wf}_�9@�$QˈC�i�Ex������Ɗ��M�ܠ�\*�\(�4��4'~ڥpU��(J��̶�K�����,C���v��ϡ��Z���L�u],
�e���_�&�T��0��=��
�'>�cr]�?o �x��	��b�ʢz�<��Y���#�4d��X�~lqw���+�P% ���mԕ!���*P��vÅ���"�F���4x�f�T�E��Jq
��f��S���e��	�9W�P \[���� D��r��|�ܐy�#�7_"��ʁ�X�?�l]�Q�]W�l��D�gDl&�H�vƕD�4��?�/m��}�&���b||�7�	P�#�R
�"����I��ZU� ����2��½�)q��O�c�k�Z���fwt9��ݵ]P(�^�o�&rg�O%��2�^�j#�%F5���wm:b,"��e+XbW�39~�5kN���.�����|��ܠ��x��'�X:�'�+�&kH)(1猍Eh(�Km'��x�b��%Fv�4m� �)/W�G�q�8εQ/W�.p"��q�
y�0�'�~����P��7b6Ӯ< ��ww_��[c���^�`w���{�%x�$Q}d��5>ui$Ǿ�C�Զ���VC�W|��~͸��f�Ir��u��< `e�a�9��a7G����_���D�`5P�x�z5-G�@�����c�DRϏO�l���WXo,�ݲ҇���V�ƚdȞq7Ocޡ�O�e5A}�!Ѷ�-�ka;B��1��N	D����03��^ҙ�h�sIx�s"�$���F�4
'��i}��0@�)෈��͢�(��E}�e%d���X*�S��e*ۏ&�x�yu���*�~��d�<N9uE�ڟѻ,RSe�>	 B9��hS���Ԫ:�k�Z/��Ŋ�ذ����"��:�8ŏWV���{��t�}�ip\�'1q\�e��5J����8o�%Gq�3�ւ��A���M�b!�Vͯ�n�O�g��y�9�*#�,���X���cرU%�nZ�%\�m��w7c�KE�����OM��Ύ7F>�A"�V%A왈jb� ��y�r����x���F��¥(��A�x�(|����}�@�=C;h�̀l|Z�*hܶr��>�Փm�7��&v�����8�d��� �3��^�c��nV�/[�gx譪���I9����q���l��U��:�Ū&�V!4��RŚ
n�U�t�=_O��5����Xݺ=E����-��)"�N����d�w����q\�%�z�LN���
z��)�6:���3"<�@� ��XM�X��lT&ԅB��<�q�.�T���m���і��x��~��sI��Mԧ�+��q���k`���\���k��"n��ז�l��ҩ�m��혏0$!�q�+�@��+*V�T�pn'��oNov����ϻ�!;�y�[}�z>6�<����)���è�xg�{&伲>Fl�<՗J�Ǥ0��'�Cݲ�$�d�/r�3 @���e��Y�~?�[4�nr���L�K��ޮXS���G1|#�o�R�����o�m���h�E@z�<A�c�^�b���}Ȁ����H�dG�D�rdچ�j5%L��J���ߦ
~����5'j�LZWqf���>��-��0�yk��=i�y�C�ō7?%^w"P��a{lOD ��m�9ܜmq^����U���0�'��0�����/�D�ދ��-j�W�-�/�մFmFu�r�U���]q!�}I��=!"N���4vS�=Y�� %p�pm�� QA�����{��a{?'��P�Izb�xā��K�`��y;������O�t�b��cԳ��)3aAW �ֺԊO:�]�pk\	)N���7j��cJ�$�Q���/��U���HR4��Lm��c�e��}��n��\��s��t
+^e3�@�5>#2��M���Y\�M[�������
���}y�YϹ9:0���)#[��X�)%� 梐����X���i����������dԃ_�ބ�u(���$��]X�a4��ճ杗#[+n�����7^�o�F�������0��hF%�;�����ٯ�
�Uq㺹��g�&����`�hL����
���	�
����n˘J�-��WcF�#`Qe�3�k;��]B�>:Y�"i�.f�b�<�RJY:4!?ƛ�Q M̨g�t\����ЖZ�S��:\|ըL��� �7x(\�xQ�<�v0+
_��ˏ*\�cP�3�Ò�섄R�L�v�y}�&H�ֱQ����>胪�"���R��,~a�o��yp�m ���u�g[�i-�}�r+�ذ=E@$ml����8b8w'A�N@M��F6v?F Q �-y�H���I
ws���1�a�t-7)޹��Ťw�B[���%2���H�'
��j"�3t��Ti5�J���$9wAj�r.q���ߑgaB�0/o�X��d)ȿ���@\Qn~�*�]��(Z��Ք�mxb
m���*@��󣖶}�wm���8}��!{?��f
!����`�"TR;RL����I�)�q�{'�\轎�����S�r&THb�,9�y�t���l&3O�W4�
�?�F��r��/��qP�h��:�@��!3�
^�m��J�?h�}�����VŤ��!1	�-`s��x^?�R�@�t���SnN�S2m4����r�������3�9{ׁy? }*%aK�\�1�!���dH����k�|�	�蜯h�6�&�8��&Į�-R�H��B��!�Av�����
���ʏG7�́'	Õ��^�tr5�
���[�r����P�⚓
}���M�'�%y�p�D2�٦�f���O-O6�:G�����L�K�,�Q8��!P�w�L����1��3)I;~���iߏ̮�_�^�j3%��KH��XM t��S��^[�� 
���"��Y�_{�4����T�V)�s1~k�am�����9O��m�Q*"\v=2�����C�2�PvnljA�;�~-�T�6����N���ɇ�r��7��q��KFA�uF2X­�c��.k���Q($EP�cq�68{un��B!�����"\�2s���HXpm�=�{�U��m�c��
����i��A8�fۗ��?lc}�ͯ�X��!25�r�:g�JGQ0{C�۬�z_�� 1ި��å�Y�+LN�"���iuWDL:�$.�����47OT p"�]�]|����V���Y��0W�?~u=�b*+h�W@`ص� ϊ�N�����t������f�
��W97��1��]��,������揣���?7١_��儧4-s�O��jc+J�b�,�͖��a��3���1B����i���nvƯ�/*������^�z��uB��.:۞$�>jo�X�$��e�����Tf=Y��@�G�.�!�ےw�]��Pi���$�LU����Y��O|��":j��H�pA<�����<W��[l �w�k)F�IS���,'V7O��R �B�Ѯ�N�PQ���f�l�7%�KF���Km����`aH��{�K��kw/�>-̕�^�m�G%_�,~;�^��9&�����|�kڵ�����[��Om0�~���/Mh�$���^�g��S��Ih0Hh��j3��}kߑx(��Y�@^#[h;�*��ɻ�m�]�d���g���Ps! �+dN(�PԏX�-�-�Z�澝8��*F�8�C���	&b�C���Ş�ɝ{W�{F4�f�FBHyP����(�ɸ��(�jB!�����+K�l�--5�����\ʮPSQ�2�2� �Aհ����QD�e���Xɾ��ljD����r�(>q�|��L�?w�(��v�0Gؼ�qܵ2>���STeIw	��\�e3m!WS7 n��+B��p��Y�B�V�H+:�ZZ?��s��xؿ����"W���e��u��,ey�sl�͌����J?�|��|�b���
����{w����^{�?���������Tn@�*A��Wx���4ᣓㆵ��"�Y����F�Hf#
}6P�H�oe����q�>eK�m�q��
��E���ni���Y���{����o @v��"�d�u)��P��n�����x$�8|���$�j>��
Bff%*m�ۍh���J�Ҕ���
�Oa2�ps�����`*	$�7���$w�'��/b�>��!���
�oB��ڔ��<�-avg'�2,��̕Ox"�<�
tx�1H��7j8s�Z�~%o�E�O�z2�ryi$����p�m��Q�3�,s*��K�
���� A���:vίZ�0�̜��O����1>&�)a_��_������|(��"�2Ԇ�r�8GK�vp�4e�1�����0�����0(��9�IP��# oa�d͓s���� m`\�n��شW�ΡI���PF�~��2�fu*�$tc�9U(�g�@��leC"�7Rϸ�؈5D�Rv4�E�@�]J,{�Ιwd[j�_�)�p�7�#�jޓ�ْ~v4�f�M�0e���o�ԗ�����fZ:_�)����i.
�1b.gH���cq��7:�Ũ��۠1z����/߽!���q�
����d��T>5��B6S�Fmŷ�s���X��sov��فz&��������^a�,A��~�?T�^Py.VB�͈V����|�*�%���ڞ�D�x�'�с�^�d_���Q����tҚ�o����ЬB�'
��>Ó����:��ZKaKXR7eR_m��u�:�	�C��*����E��a�N���ra3w��n�2H�DX��W�-�B���K�p��},��(�c�^��l<��pҳ��4Tm����"V7"�Du=V �W��3ź��:��NMC��gs ��m5�A@���QGe53zV��Y֯�'!sJB#�/
�� �&��>ɬ�!s+��t��@�y�^`��<���=�t��%�2�þ-U�!�2]�o(��I�a��i46��^��n]�#~yR�@7����xG���t7- �~>�i����*�"1��e&q�^���-�7�tN\�#s��tm�	95�e�ɂI��e�2������	_�-f5^��p�I��B�D<g��
���;gZ䦀/������$���D�3u�x�1hi�����۔�P��a$ѷY4$4'��_���.�V}�@0��k��
�9:�(�yi����5��j����Ѵ��?��!���>K����?g���Iw���c���MJp���!4狀�3_�O��sB�[�;���C-�]Q��a�s�
լ��f�j�F�t�i*<���]������XI�gʸ9F�q`4'���j��9s�((��;��]��k7��'��� 0=l����q�"���Kq3f�/<��3�F��J+���$�C9*�=�S����u^L5��J�;����y1�9���d�Rg��5 �.�$i�|��xcB�p�t�o��f`��x�cY%��{���a7�ӄ\�^_�B����Vߡs����}��X`�f9�l�xj����_�,�/BаbJ�Fb�M��x*NS���z�����]��ӹewǟ2�ʭk������Hyd�D�h!�� $gJǉ����
!�Q��@h�i��V6IJ}�	��L #+��������;y�w
��]���
��{KeK����z��L�t|Z�F��>��g�c������4�$-�,�;����R��\�ϖn^SY��C7���c�7T��55��#Ɂ�0�Y�;!���l�I"�_-vv�%�X�l�����t��C��c�7�̦�7�Z�1�T�j=:^��?XD��M!����SBȘS�FaO]��JD%�V=#~ʱ�

�A�����	˹���ߡ�#�bK���%�ϒ�M���I��.��F�{,UP�Kj��jy��dpٷ�U�~I���R�b��P�te�^Zݛ8�r՜?���(��(�Qn=[�i�|[7sf՞�r��a9�
%ƙ��l��,���^��W{|��>ba8T��=�c~�0E-�n�pK�/��K�
�3^~�>�^]m����xg�7�ģ�r���p�svjϋE���P�3 �e�^��M����j�Ux/����q�-f��=��Lv�lXc+��9C��7H2-��* P �z�u�U,	�L߈�G%!ᗿ�V&�,�P���`Ds��*��IwQ��1Q�>�cNO���O$�чc�.@��:�5A(��MH����K��#��I� 1��;��:�jk� ���ו�u'[��t\RD�߉�%�+����YV�v�v��y4�1�X攸�_��]}4y�� }[D��[�K�e�Q~v�C��2�M� �?PU�"��fɾ���ATG�@�Q�J�w���)�RRQO�}��M��²���H�+�p��{�F�q��^�sC�>$�VKMo����y�&�9����Fd�4T��04gN �#?���a��D�{	^b��k�H��m?�Ў��F����Ո��3�ƨ]9�=�t����%�/j��5��]6�1�<�V6�kk�r6֭B��S�߸�P]��{�D�b�Fi���,~����k��/�P����In˳�H��M/��@�)f�*0�O,�N �
�$e/2ƞ�*�k
q ΄��S����/����`"�Z����\��%;�k�������c�	A0��d�x�}�C�Խ�Ȏ��c_��{�t���X��Ds�;
�nP�
]��X�-0�m�^��3AL���y��c��
k2���vr��	���s����JU�ow���{]g��i�{_���o r�]�9�Z` r��z�r�n�?
�z
�-d���  8hC�F��ڞ�35����s�3��us��W˩��?�?��[܀�ue<�'~��&p-�C���l��^YS��p���>�ԋ3�O阋
��{��V/d�̈́J�]j���彮} R�eC-N�7
ݍl����Λv�zϐ]�$��h�%�5��9��X�of��ǆ������6Ɛ�hYғCjaaNp7�c�μ�	�̿ST�?ru6�&�mI:lY�~r�0j�s"�R�Q0L.�/$��h��ԢƔx	v��3�{>��+���fP��J�"�=I���HnzllJ		�Mre�E`�j�I�,�u�(�Qq��.�A�ߢ{%��V,�6 ��?U�Nl��Ӂ �1�n����	h���'|ɐ��H'?ΰ���cwy���յw��h�m4���>R�Y���3]���PQ[9鼡'5oR�1Y��V�q]�g*Q�f�N��/X^�� #�,�:$S���A���U��5���^8��~����ʇ
7��t�
�Z8���/a�B��}�e�87����v�8��y�op@��$o��m�{V�7U��s>��E��1q�������jR��Ebהa��*�E�RD˙���t�E��w����Y?����K�<������1/���^��J��#����a49WN�����`l
�i�?�A�Vhr��� ����.s�N8�<
�
w���ew$.[^�2��܅e.��xZ�*[��nN�/K6���#�JC_ᦓ��i�\G�k�"7�ω�a*�y��}p_^
�hwև�iW��2N��H \�H��2��]�{����1ŌZ�0�l���j�*
g�=�||{G�N-�:]1����
��"87rf�c ��x�׼9�T�S9�����ڹ���c
O��<]>��2��vE�����ج��c)�O�����0ł�*�5�A���]�m#�NbP��ܓ6��P�'�R��w]LU�aH�QJ�5��{/��(t����%'mmx�8
�gh���h".1�`U���H�R���Ðy�಍�d<V���]��e����-��}ձ�Y�������S�N�NhJԵ����
V�oo9F����
�9m�2ya�Z��g�� :"���r)'��=���)����tb1������>�q����l�ֺ}_�{���8@G���7�p: )2���uW璨u��Y1\���mf&b�9lmqx(��.2r��yF)ᄶ��v���D2,�+��j�Y��LK��~��<����͐�-���<g�H�w�S�m�䛌��h��u��3�7���F���b{��f�Ͱ�Avs����C<]_vɥ���!�-�ng�A��8�>Rjn c�xuo�{1� ��a��0���Q���-��������@�{�Bw��{�z����,V�+��{� ��`'�yC�uB�tS'kJ	�/��_�a�4�F�}چ�_N2 o�E���'n9�w�%0by�Y�j�^�}�3z��%*�}�Æ�ַ�D��/�;/Z5)������'��ʉ���L[�NȪ:��S&�7��8>��
� ���S.a�~U��Z��ѕ��znc�S#)���42�I����~��)�R˔�E��4��}� ��,f��y��G���a�z�Qw�����N@�Z���d 8�K�S�ܞJ����9v�`.
#;r��8�T9�f�h�T�}�6R|[w*���!!��J���
���fZC�(���/MS��ܺk}�L�S	dc,#q��a�`���C�v�k�L2V
�����\��:��ؼE�6�L^tU�o��i�1Փ�K.uD.͙cSR8��(�`�x�Jd�f ,RYS4�,��
��<*��n)�R��ݚ�}�-#�V��k��	�������u�]:W�~(���{�5��%v˗�c���S/���2��(ȟ_Fjh3
�m�P}5��Ɨ��)�eL%ӹ]��e�X�`8��w��#0yH�Q�v�Z� .r�I�`��vAϗwY�g�.�.���D���yx�<�+��c�+ܓ�`��J'�� �y�]_�raWC�>ͩ�0S	�<�[~���ۄ-YG!��1��
zEx͋M�D ������}f���qX���)��ql=����ߟ
m�]��T�~��Cb8L@K�	ϙ�5-)^��r�yu�?2�Q!�#�7ǁ�k���]��l�~�·�s��d�Zx��ԇ�� 8^qԺT�c�1$���8D\&о���+�,�������m����RE�}���B��7D��~Ä���l�j��Bzd�f;�޻�Q[<�ap������H�:�\��oasb�Pz�g�����ȼL�_Q/�
97�0F@��?�����^�ʹ����/.16C������~�^���`$�3����|�[�5.-�4b�(�������c�XG�f	c���?�c��G��Ə�م 4�eKS|f���Q?�=3MG�S���s�V���Z��V�,P��4y��3d�c
�D�|�������K8s�8��ajZ�x,h˗�p<�b:�XBs������n�~w��ݜ+�)�H��7,��+8pj��l����:0L�y�!%��С����?P��H���Wt�WPd�~�:���<�[hg������ܘe0���'�h;��z�J��,�Fy��D _� ЌO�|��wC�)�W<O�ѕ�;�J�?+�ja���B0��aؔ���>���ӑD��?���k�R�2���ږ��3{=�K�q
fS�{�C��W��i��+�L�uq���`ک.gޠgV�;�6g�,ċ?'�w~D����&",�u8�y������Fd�h�;`��\��.�`y���[n��z������iV)���gbT�]���B�Xu��2�ն���Ѵ�a�٘� �8���%�w,�1���*���`NLs@?��6[��&����}��C��3I#�G�[L��P��ˎò�T*�QĤ�`��F��9B]�z��E^���g��e���D�
&9�x�#샨���`Ɍ+hw;���яGQ@�٦,_�M������X��ou�D69iQǕ�5R��񨿳l �z�(/o>5��_�`�U�	�)tH���iJ읰N�PƬ�)y���.c�[1_���]�:{�I<�
���y	�ړoe�P{������ñ��ߩ 6LE-��Ǣ��]".���և I*3��j�����Nl�����c��ΗL�ĳ5&�|�������}�d�.��3+��SQ񯻭�����>��'���[a@��,�%'��&�[
n���i�IQ���*�0v�����A�e[��{(bB2�c`�]lX�/�th�e��*e�IY]��8��p����#C�;L'����
�C�E�.�c��3!��z��,)�hg��6{�E�N�v�2�pM�<5���>�q��	�����F3;1`�%S�7s�NH#�#o��w}N?͠eh�K�{��p�T�9�s5h.������[���O@M���މ�䌯���&m�7�_1�u�Y-d�@�I���ž,2h�������ρ�� �B K�m�{L6�[_Y'��ݲ}��#��e@%��B2��1�������� c�.���X�,�b�4e��4	������Hͯ�x��F�3Z!�SQ�f}�g'�1����]w��3��׆	��Q�I�Vŷ�R�l3*^��D��j/7�K-���^�<Z����j�L�r�rrZ4
�W�����^=v!��J���*����(�K�8p�^:����Qc�"|�veM$�_��|Ѐ�Ns�}��[p�1�f��K�. z�I�VZb��96	#2[K���*I�ܐ�6g_p��z�H/�l3:/���!���|Ð��ط��I81���#�����R����;G���a���?���Z�^�u��W�b��z�}jȋܼv �{�r�2�0@�����ܬklX�6��h�Jj�[2���O�h�qro��+�lZ�J9�Q�?��| 摩����
��W'A��k;l*�ʿ�������pA{��� ��w�`d�p��C2���K��r�~�-ODQ�m�w���m��3ܚnW|AګR�o���N�KcW���~�h�}���\��t"ԣ�um^NE�Ĉ�G�(��F9�ks��ru$��	���`wǿI��Z�8<�C��3��4^�œ�4����?���W
5m���YC�������)b�1�C��y��ӄ
 �DH[Ƿ��D�М4��i���A�����Ʋ�h9_��f�-�f�_�ew*YzS�ҳ/�(L���PBl���V��"��]�8�3+��=k��#���,�HȖ\�Bok
�־�s7�I�~n�qr� ��q���R��uQ�<��2�f��T�#�&�߽���������T�e���o)~@����|��¡�L�UE��:�7� ��f_��S�L�CzaE�09R.�����6	A�ΡE�N6&K�$��$o{�L�8�f����cYb����c
ѧ���ͽ��#����s�:�<5:�5��c�M
��-:�W��5�fE��FHrڪ���+�);��޳�?�]F�+�y�tjgQ���Y7Q���\y�t*1ˑ+E�d��b�
S�M�&�0�l�R��d<�~�F���d��ѕ�6'� ��s���!��L��|(��9`��E� ���Y�`R�	�V���
��B��j�����Y[ϹԝcW���}U���'MCNQ��AXjU�R��#�an,l��#;��Q�M*��J�"Ϳ��a%S̨�k
�_����<�t��)�_�Q�"F�C���K���&��)s�^�W�]T#��#Q���bA�m�>�
�Z����E����aʷ�u4�6��]��(��ꕵ�0ݧ����|�v�~�z[Kb�nM��F�F_�U��+|��W�rU�.�ې���z�b��-�qP�|j
I�\}lN��%#�ǅ�{��s-���c��C���f1}z�C�Sn	�,��Wo}���妀�̴��Yy_t�exZ�H�Mf C�߹\���+c�Rp>�p�l�!o������\���J.�cS���'�w��u}x()i�G���Ȕ���eG-��/�#�L4l�N?���x�
'L����5��XX����;���28�V3��#��'y�8aS^̾)G'�TcGbQ�r�<f*)���n5l��ݷ�%�f	D��M�|E�`9�_�Jc��������Ҽi7� �o�\��怔�SP���Qj�g��`<:�i��O�C�.ʳiq� q���U��[Ca��2B���4�LqLֳ�PGI��y�S�CN�|�Hf&T�`�`�ޢ�]JyqG���]U���Y>"�I�L^(:	&��H����챘f�Kv}u(�������嬲��y�F�j	�����M��*/m�aH-�2A�a����b]�������Vl����k]�u�$ӻ�d��r����rF��'"�I�����b�$�Q̖C#��u.|ެ�EQ���yq�\���~��I��s�'�:��;N�N^E��:���Q̀��i�b[*�mC���K���^�����R7���P�[Tjn�:
���QA{
���٫[�[I��
��CJ��ډU²�e�{؜K��$6j���,�Y�,Q5Y��k��ct�b��"�8\����p�0b\�FT��lzb���K�0j&}�}փ���d����Hm�^h���IO�n-K�y%Ʂ����NԠ�cc�=�l�bV�3���7T� �!�y�芥�O'Mv����M� ���j�>D~+�<�n�l����2Gq`�)��Lv�r�!��i������RVTFM=�r�u��V��?÷	�<����ܹ��	�!m��t�U$kE,�#���lZ�ꃦrM"�G���b�)w��[�������0M���-Xȼ�6�5՛O�\��1�o�nD�+?�� +>��U��;bPv�b/��E��r��w�������#�L���壜��\�#��Q�C=�H�s�XQ)t�@q�CD5Ы�G7R3�O�� .�[I
�3	z#�t��d��r�<���~� q��(ZT�����1{�%
�*�t����{�"o� ���z!�gI<Υƛq4pp~m�S�Wƻ��v��+��q=��X�z�pe���n�H%���q��8B�����{��:i,<�M5��w��r���81�νG��
��꓃F^j�N����qϭ}�@D���чgz��-*K<�wNb�dl��L�\}���,��_M�*7��*�KO�(� r��ӔtLJq������"M����e����H ����6��d��
)�����C
dE���G��ո���'t���#�[v5e��,��kիk��.��9s����\��xf�pf��`c��yb��I-�.��KI�h�?H�=��U1����	.˺�ʵ�;��B[z��6XA�VƯ|�;�34�Es���p|F��?��n0a�/'
�)�Ǫg[s��v�:�Q�1:%_X:G�Ĥ�*�3��
j�=��>�ͺ vͤ#Bem�r�H��;�q����r�ǽ�W@}��?�i�Px�G3�|�t�%7}Xf�������7)�i�T�k$��;���-_�Oxq�����-��|��m�5����ߑ,����ʬCJc��Z�w��54����Ls#V�+��y���<����{����ѳ� j���n"!M8�F���Il//))��B�����i{@�ӷ|{�x���"%�����>�
5��7�!�?��,�"�)�^����Ԝ8(��nP��d����m�G���ٯL��g=�ͼ���Dg=�(�؏��Ʋ%q�:4]	|�WH[ր��4/�eA��*����ʷH����q���4)q�G����\�=.b����6c'Oyws0LP	�a���喝`ԩ؇Bg�t��2�����1w��Y [�0����)���Gz������4���b�)�8�Zh8͍Q�C~���
��M�
�/�I�m�����l��͋ٓc,�b�"��v���Y޲ί�	
A:���OSQ#U�5��#��򺜙�J��$��9Z͚LWh>ր��±dug�{�)s��JE*�Ylx��x�Lu/��l�舗Y
��o'�����+y��}(#H�7?m�ZϤR�U�5Ay�#�ƃmyε��;*�m
&oC(�\�	��� 3*���M���9�]�ݻ�]*��*ĝd',F$��Y�e�{7Y����Z�lِ�8t+t�r����*��Jeuۭ�~�]��W?�?��05c��_(C�sF ��20xp(�Z�wl%�� ߊ�B�
�Ԕ�D��?n��&�^it<*L fA�?�1e��8��j�N?ai^���i��G\�q
��N�z!�Ǣ`��(�e����g�-y;��~~
%�Ѱ%CC�`�����p-����Z��Qu�S�2t�%��b���)��䗍>V��dI�-�a�n �b��/�0���?K������I��Kt2to���GheKqYF�+�I:_��2�6����I�a.
7Z��(qJ�j����\:��ȯ�-9��k�^�*/�;!�gOQf�
o㗫
���ֳ�!���ּ���u��yvuیț���l@޿�l"��������z_a�{\�u�F�W&2�Ex�J(����/S:����{�\�_2������ҙ�{�)��i(�FWi,뷘�
���2}=�D��ȹ۪ �"���l7�[�=� aW�h���G@Z$�x&g9��eT�v��8�VO�<����:'$1�}��_��PЏ�S&c���-�@��*
��P�O�^�g�t�O�	m=�Ji^�̰�����젡e<���4���V�DF��:��~���V���Y��J�4ygVh.):q����ň��=)�ͺ��.�wO�f�(��Τ�/��h�s���L�+�k8��}�\�	e�!ɯhٹ�#��N��l�Ë���G�[�2���q��M[���>a����#C!*>ͅhEl(�W�
�"�3՚q5���%g�r�c���?��TDf
�	�Wo4�þ9ۧT��`spT���'��߫ʹ� h��"�C�5Z�ȑ:5���͈��KϮ������Kɮ���C�O��t�{;O�z����<Y�6�@`�'�;��=�q�wݢ4$�Nxo���s��5��w���~n�����Ɖ&�B�P� ��H�K_�V��*c8b�}M,3���X<8N�,�*d�>�p�ٜa�m��49J�ŚZ�˦l���A"�t�#��r��-�v���KU�ۘ�)��<���8�Z�������b�C�Z�M�>�T���$+D�vn��<� V�E.�?�t���_���@�Q�5��4�T	L�aߋ���6��f�+!���X[�}���=<��[l%��w�N��Qq�N�_��n�|��px	�5¾ˢ�m���N��{Q7&O#��1:�l��P�ǶJ�!#0�wۄB�����A��u�V]�=�ᥟds@7�zNl(Ǌ�(�FK|&�#��*ل��)�D�q�*)�p�@��؟�Jcd����14[+3Ҡ��
O�H��f�_#�X`�$e��L�Oo�� 
K�FmF'�^�_Љ�M]�~���G�/I���i'���)�L�so8��RFT�<!�	�^�=��p�_��?�e�v�wE�OZ҇�!J	U��q��tTP��o�0ֲ�4S���}�����L|6+;�m,v��5�&�W,�ĬGY:�����|Է����Zj�|I�¼=�Y���H\��p;A�:R�v� g�{b�/�$
�]Q�&:ь#�
pd��
x�S��^``t7��s��y���Vs�bI8�R�n�1%٧:o<��������0�j��E�/��a�� \�w+��>ɇ�ލMv�����xb�	� b\#�Clm$�K�sp��R�Ɛ�������2_aN�;Cn�|�����pPa[7;Qo�W��{^L���!9cPę|!�����'��L�H@jOwq�`�Z�=��[��M��Ō�z�ϝ�<��޾$�f8�'k|X۩$������ɺ��������۶��T�'�.�X����;ϴ$PT��U�8![4;`7&�`e%%�/�r�elFGe�$By��(��7I����43�V���
��1 S;���?I��(��%�U$:y�ugcO1��BE[
l����L@)�ʧ�
�Kz{�.4�������'��iZ�L���L�}J��|�X-s^[l�W�}9z���2@.o�-;l�����L����-S>����6��s���[G&�
�Y����%�!ar�K[r���i�5f�E4�����j1n
�W,L>���>�6�Q��+f�o�:k�m6��P*�e��O
�����i���!�q�j���N3���i�� �i)�:��0K�u��Sa���_6�W��!���Ǘd"@G�/H(EW�YZG�ԗ����
���;���!�3�gmۆ,s���&&��A�M���H�\��8���N�`�.���Yp2��/SCCt�� ݑ�/���%(T�7c)0�k�t���3/#)���| �S�Kۄ�~�����(�t���\M���l��֞��}�׎���VoZ�j]Y�����9B5
��aC�����\U��V0��9{�1�KRL%rRo����"��#�1�ldc���!�C��ھ{��rj��]pR���h����{�B=H�z�a�oa��Zͬ��`'k�!���sD�a��]QԪ�Z���c�!�ЎwZ)�G�����J1ѐ�Kq!Ӗ<mD�-��C>�
}W�p	[��6�!x �&���������XF�.��BՃ��&8#S��ďe)�I���e�ܓ^aPv�
���O�G��7�q<�������C���7�Y��h�m��nz�S�\QL���&��9CEg��~6N�Щ���^u��ov'6(>�0�Vv�.<��tQ�K�1�՞��^��֝,��e��G��6�/Z*������'3��R�S�x��ދ�8�џM"��x��3�8e&+0���2#A�~p/�$��
9��L\���v�o�A YncE�6���	�!��z��VV���{Y���
u�k�;�g��H �+�i�e��~H�J�m��=�&V�҃��9;T'����YIy[E�VD[��9&��'|�w��c;�|�0e"���%��
�M%����x,��,��K������1紦�
I�����%�B��� ,�y�9��$����!ѓ��w/&�g�Q?ňP��Qa֧��=&�Ȯ*_{��K\��a���M%<w�<p�^�:��	dkkNNۋWF��Y�.��v�
�f��_���J��Q��U�I�t�v������Dk�P�bF�%���p�;	���r����prw)_����!�x��d|�k݉�Lro�&��� ���7T2�\��Ү��o���u9~�[�	~;:s�oω���!Ru٠EK}�Dn�O����w�?�E�ل� ����A�(�y����u�2`���^	�}ojPO�L�"�p\��0��]�"����%��6d+�
O�R�q���
t:�N�Þ~+`��5U)pE��	ݼ����z�yOڀ=���}�} ���[늈����~s��'ב�M�R�L(%�U�����,��죓Ň>X�.��c��FO)ҐQ����QH����(ۏ@���/�\�1O�D�j'6��c�]��ڪ�b(x�m):ӽ��m#��G�A�9�4Q��V �˹qM��fq0X�Y���6?7�#-HSW�s��r��ֿ�:��5������wHs�d���Y�V�l8זG>b���}��x�=�x�z[��a
���E0~Ox��s�����Y�+LwӴ~�����N��E�[^Z�6�X���B֋��6 K�D���22(4K�
ޮ����D����z��#�d>f���M�z�X���3s�<����d��X��项]x;�!���Ln�fUV��F��Q��%E�|�"V=��7��q)|+������ӗpe5�e�T�8.j|�������E���G�&`?$�z�t�V�K��Y��)�%���(��zO��*8B�x��Te������Z*i�:k^k�!�٬����,`�¡Q���
ӫ\����6��E��E�����x=6d�����
F_�х�;��=�d�-
la-�P�!?̽�8/Vvb��l����ъ���Hw��5R%�|#�[�G���$� q�:�����L��ET���Aȹ��1)B�g1I���E��S�I��_\�5�}=�
�פ̼. � *`'R��#�u�;*�<|.����o|�Tֿ[O�vQ�]�L͵�G�6���f����g!������|��LV��\�u�u�s=�L�nz����3H6x����j�W���EK��#�"�V�<�i؅v�5i�Y��#Q���OP����C�����Qјt�^[�öӧC�D�+��?�S���[R�Y�8+�"��O����TÂ	x2,n��cf~S�1iz�u(�Ok�>1��Ã�斷�lZK�c�	�\k��
�M���4'K�?��6M�o���M�9��z!��B���mE���4�A�L��Tj(H��s�SEQ��f3G8/@yx�gۀ+'��� �y�F/!L�?:���"�7��ޮ�8�]& �7ac�m*UM�>�[X��ަO-����0�w������S�Sv{nn�5�:��B\��f�� ����Dh}��:��W�F���W�<�,B仪#eR�푽�$�!�"��D�*�X��ȡ�#m]]$����M�M@`�@�G���p����9���JL�hDK�#�m��!��0�k
��8���ܶ \�����@���W"�kk���k��j����Bz��5�ӌ��sk���	���HT��{�:xp���Ј�yG^�q
�p�f_��J�n��pl?K߱�:_
-&-Ձk3åw<���M����z�v�����[&�"B��I�V�$ok�*�Sd���Ί��s��]B���[@`4�q�`K��%�Z��һ_�4�c
vG:�npZ����2b����,ls�J��8���3���Tq�.|���cZ��L��?��%��d}m*
�U=K��YD�Z�ޥe�Ո������IӃB��&._�|�\�������D~��rA�!�v<TOH�$�X���	ǞɌE���!�����7s�9��O�`e���}�qS,\;���ed[��Y�5�j�h�Ե+xl7��������Y(@Jq�9'.Q+&>9Q�@8����,`�.G����iL���X^���Uq��b���=X����&g���9�n7V���ar� :V� SK�\
�|ˍ
Cא7����E <����7q/���z�=%�\n�WaVK�,�e��j��2����	��6	c�ov@�p�"�8�Y@ �l;ӼSM��h'V���%U�.~W²��T7�#v<p�nBr
RαuR�^D��&sOm_o��K�?˖���Hy���'���>I1H�͋���
�����Q�Y�p�ڱ<5����"2y�wa>�al����1-����a=.�Q��/������cv�/h ��!�37�v��C�ƙ�mf&d����:�c]�f�e�q�=�Ӷ�Z��W���	�	�³
��9�2�p�J/�aZO�o��ל�zޱ��� u[����M�?d�qw�S�{܀G4�%�A��*{J�J�l�b�V G�N��ݑ� :�U�[%��|C<�h��^
��_�b9���YU���T.�C�Gt^����d.�6�G҉��M�u9,V�CtW���A��PZw]:���A'G��������k�%i
D�^�_wΔ�{%Wg��F����[��g��l���-���Q��m�e��D���E�Zj@_��z��o˜br�G���Se�c��
Ӆ����PZ���{�Mo�80��"��y�ݳ�p�9c���ds�DP
뚛��"��Լ�F����G9y�O�0����5�Ȯ�����\obױ���ʔ���ĺ�Zޖ!�i��$ ��^��suTn��v�i�7�>R���55(���W%��p�9E��%F��dS���<���/���;��s3o.6�G"鶌Sk��%ɫ���;2Wcv	����A��N��$�*Bg�)����w�Q�aU���W�N��'�� %��P��s#������1eF��271԰:�f&���6�.��w��Z2W#�ߍ����B%İ{>�d
h�8�&�Қ:"�H����8K�@+�����f�D��|��	���+�2ҍ·�x�G�O���P����`߳iژ��<�F��> ��� S!�&
ۖ��_\��6Π5�����Z�I����F0�=
�� �/w�
�����n�_�D=��CǊF:q*��*��xK�G�Tv��:�k��n�o�3��Mh1o�z,>bq��b�[^���R��v��s��A4UY�I� )
N�/g�'U7�`���m�^�k����k׭����o����1�����r��3W��@���|�<��*��s*�=�50�w�ɣ�M�7�}>Ѝ���chňAϤ,����&�� �	݁�-4|��Y��w��W�`�=���H}n�a�d���E��k肃�	πP7�@���ʟ����M��+��w��g|D!�Є�����cH�X���>���g����]��H|A�%�
11��n�Ş�|�?� �%&	�)�E�Y��>�/3�Ci>��dQ6����_;��iZr9an�|rT�����+J���놔`9Zx�߷��o��ŉ3��<�R��G�wN�B�GD
�?��ĺ�����7�ױp�e1�.A�|5*�r��U�'�mS!-ڏ�#��]��m~��e#M�^�F�n��T�`�&YB�C�)���d�F�2Sh��p��4��[�����%&R�{<U�e��g�ڒm��k��u5\���X�,�bx֧�-�G~�y��)p���2��5�M9w�����l{/���� E2n'Gn�������>���S<C&��M-�5M�����1�������3)�d��4�X�d�z$aa�����>T�454�<J�-懲l���2dg���9%�H�����}Q� t�H�0�ȹ�z鯈 �	֣ T.�=j$�92Һ��Ӆ���5b!��2NF_�G�E;���'a��}Ե̹���?*������
i��X���k2BV��I����V���M�H��}��z���f:�[�)U�6f�[��
�3g�`����̽�b��(��۔�`\9/�����޼�o/�r�65��L|Y��\8&�l�N
U8X6,3��g6��%l#)G"*��l��Q��>����!�4��Kx�� �6�͈Y38�P1��k�7'm��4��Gq�~i�`��f���P��W6(L�ۨ�.�cf�h�K��j��;ό�7�qR�� ��L�l�����s���}/6e#%����+[bJ��3'�#O�i�#����}�/��^Vd'!u���:t̺PP��V�_!0:t����*t?%SK�L��y�5�y��F C-�s���`f7���s�V���q�U?�����3�C y[x��ނ����-`�YU�Ae����7� ϭ�,,��7�������?�����3�cK5��\u&f֡"��e��r�3v:�T�*\o��:H���D
� T���ܷ����h���}�B��>���.X>�r���F�GK�Y�<o�D��1T��	�x�M����Τ� �&M��T��gv� ��v�ޯ�@�'�J��0��A8�Z{�&x�5s�Zf��Kh����f<��J�5�����;�qX�
��Y��j�'U�C	�8T�j��@�ܑ���[�/ܫ��k�
��F��$k;%�"b��]L�?�n���*=!ɺ|��|�J�r�f��NE�A�2�c��.��g"Po���L��R��M����:v��/l�`�EC
�-J,��b�c܈8I F@%�3�3�K�X<�D�|ЌE���9{��3G(z	��^�Z���~;Ҳj���v�VV/� A�o n��9'Q0au�C�Hoj�YO�����]���;#��:��,ĳ?��]��br`�����������5z/g�r
LSw߱���Wh�ň�*$x���#������
'>��X9� 5E��Y��:>k��,Qf�����jY_�	=pbG�6ŷ��5�%j���p����F咰�'�Q�	�T�e>�u�|B��e����h�ߞ�s���0�� �e;�
Cg9�e�_�͡��&��W����+3�y�#���WN�es)�>�-s�����ta�:����#��]�+�-�� 6W�NS)9�Wt�{(l�����!���.r���HD]�h7�7�-����95W��� �,��hU��`
�H���5�ē�F(d�����R�՝Ln�a1����U�7Y��[��1�*B\k�՚Ξn��{���:RB����Y'�������O���Ͼ��MD~�4
R@�j;L*�7�Hp���ɷ 4lM.jfG�ocRp�������0��y� $Z2a�.p���@���~���ԭ;Sa��;&N��b��a̛6!���g�l���p�����]�`�ib��PaL9]M�I9<y�-��NA���
@�/9{�O醏R���F��LP���uW�+��zE��C�)�}p�D�|�Q ��� ��í���X�Wz�j(�ՠ�(�;���wwό���.Kݸ�K�x�otU5��H�9�N�f7͛�������I���z�8���E�U ���L �K�=���Obt��	wT�@�_����cT^�5��M��e֢�g̈́��ՔS3�%�{g�蔘8�����/�����wS����j����.�ԙ�90IO��Q�렡/^0�4U{+�J�����y����u�i��յ|������H�)v��f���qD��w��?"\�@���AF�YVt7��=lhh�@4�q!2(9�E�R����K�i9�Ƨc��c�����)Ւ<^5(?�k".[v,�FȬ�O������j�d��V��!]3,8��cH:�8.��tI�?��p����0�e�VB��T��\m�	��)%2|�$Y�"��@)Q��v|�=\�Tg<Xw�OX����fƉBa��VZ�jɲ��r]n�ڮ��ϣ�Im?f��[��T��A�)�����zB7Yl��ק�\2�ע�G�fߍh����wly
�B�)J� l��@pj��|��TV�Sn�e�Y_	N�5E��l]�n}|}
�bL�e�hFk���7SH\j�?�iM�������<Ȱy� ����p���G�u�@����΅K���.C�|O����Dvf!��-�_�\~誋�ej
u(�]E���f��p���&C��sސv!N�tC�}���i��ז���#���0/k��gYG��$r}�^v��a+-z!`�q+<NDT��(zu�]tU��0��"=��i8�;�/����*@|�6�{ i �p�$
 osN=5$`�;���/��Nʫ`�Ug|���zQ-���*���k�-)��D����d����m^�=J�b�-���gQU���y�\���.`AT粘������N2�h������d�kbs-"�a����f�P��7}?�n-��cUM����T�H��g��mRD�܌t�@J��'� �a͊�}XqГ'K1�N�ԙT��̓��q�X�=Iz&���6'�� �g����u�"{l
�B����`�e�a�0��h���tPe�$�L�!#+�v�
�G��&}V�������p#��l�����{Ō��QM����Ԗ�
��.�|[{�����3�vD
m�{��	�x�B�^1���S�/����kwm�x!ґY9Q%���_?`��,��\��&)5?
�Q�Y�j�1�98��S?��N�T�X��B�f�^#d�A)��G�Aq��[��/

��ۗ���7BOn�1�}V�u�
�Q*�@4�N�
�{V1�n�������H�����[�;�VD���] y���-�]u�&/��;�$N�:��$]K��@Ϡ��_����ۜU���
:���DÍ�dw�!���n��Ul���$�R=�+�rt�9�ck���e����UX���q	Lb���&����g�NPr�����J.��~!���x=�fM{N�����pj��Ȫ�+\�x���R��+nj4sl������.R��#�09wׂƄ��[��sl
��!9� �p�b1�j�|�~&؀^$���$1����fӜ��P6&�W�UnI�/��x30z�4MA���m=b��i�,õ=���+!s��Eٴ�hK�8L���
�8t���Wp��Υ�W�@�IPW����Is��Z�lٿ�
�$���;op�k-�w`x��T,�[u@%��2�fpʷ�_x��eڅ��7�!���|v��?fr�v=�ҢX�lڻ�&�\5mБx���Ui���m�%���m��Z�]��(�v���7*��p
 �����p�?JzM�e�,^�aְ�����\���Q��K-�]p�h_i�]DK{Z�AV�M!�n櫵:C7?��T���S7���5#e��_MŸ��Y�FPp6�ab��C�`� Yr�)��ƽI�?����M��AZ� #���`�ơ��~��JG���
nm�xa�ǇҬ�[Qq���
�={"�KcS����G8fR����:��D���S�w�{H��f8���|;�ھ����Z��|�7Z��\�K�Dl)��FH�}���hރ���Ô� ?�	�B�]b�ϡ�Ux/��)�kĨWY��H<��O�+��8(���{�h>���"g0�;�@�s_j�KoX�M���x��e*]��Ԣ�bE���P��q;(J��a��:�sIˀ�8��Hn�x�JA~�r�,�~Lu
�W}�]_�͟�2P�)a�Ӷ9a��?�ޘ3�y�;��Z�ݽ�r�A���uq�Z~`k��6~��1�r��f�l���JCbi����1����Oe��&䒵dQ���(���:��g.>6�i�
�d0G�o ��F��&��	�qu����O��	,�q_����39B��C8���C����va>%�̆�֤~F$��/i�����N��~Q���,����ձS��kpJk��8�z�L �����9�w��3��;[��Y}��H��>�'��B��B����N�n_L/��g@j23bS}���n_᫋)�F���oęi:�[�|#��Fdxӱ�We��ǻ�p���<�6�{�*����^_�g�c�%�������
�^��J˂�N���J���R<�D��`w��p�L�[e��ź�f���j���PoWU��|�]���שjWRcp<������:\� $�dK�LH��/v0/ί����Ҁ{�۱y��Kx���O�w��e��1���W@.Χ�&[R��ցVhz�H(��٪�j\Hn;�y�I2c'�̍6)F?r�c��G�\(���='�	����DEI'��YH�2gq�[�j_x<���q�S���C��_e��pf,�6����/����9	�V����l�t�Z
@g��m4�ڐ��K����B-?����Sm3��b��ir�ۜTq����T%;9#�����@9�����
�o�6���5��x �l	 �����]q����©DA% 9��ԓ^{�/]HhՏ�Hr ���ܯ/�*� ������XЁJ0Y�R�ج��r%�{
&�_򵲳Hd������h^%=�e/���ɣטF��Y);	Q��6mS��K��p�1.O�+������I�^3��)4ۭߥ��R��j2 �3=�U�-� �v?��&U�XHs��}��+�3�ۡ:g`��%��!��Q�ByoTE�̴�Yۥ,��\rY�?�!��`AJ@N8t)��9��L<t�c3Vc�����k��W4�����m���N�W���Нt;dv�+eV�x�o|ٴtuC�?�Y��N�rr��ȫ%K��`��P��hI�;&5D̋����*Ϩ,eo��`�jC�<>��\��T>����E�X�7&G:1��#�w}��Z~���o%l��
$&Іܮv��R�ci��v��tK��D�.�2"�/`i�=�X�~�	dٷ�ux���m�'7_�Q�Ȫ�T'�b}`6jHu��F�1���,���RL�3��� }=῾�"�����Z+� ��������*�J'}�,�9^�2yIrPK:�U��g<wM �����S#��"�i__L]�T�_F9_{Ho-_���?i cI��~.i!��
�4��7�X��U�"�{����:�x��Q<w�D�2�s����n��t�{A��(Q&�S�M�����$ ӻU�wDm��$�$
K���3gx�)ՙ=g���������D^s�K�����rz��|d�������|�L�^�E�5��t�5�e'���p�d?�W�
��aRν<�Tb8��&6Ԏ�K��;�4��54���[HBn"�O3̵�Ĉ0O��K���K)u���y^Dr+��
�9m������;�ҩ��}��������ɱ��-$̗tZ��v��5�8��[5.�Z'00�rn�����m�,�4�w��oӈ 22m:�A�!���>��X�8F��%��t�A�룖u^ Q0g����r,_�+_-Nm�n��e,��Rk���:O;j7�h�H�'e⾹�P�f�DX�P�k"�H�>�i����I��ߒ���N��%HL2���� aS� b��HbHM,�AܸĿqV$���R���߆����!��z�-R����vs�"�u�܅�B|ə��]M
��� 8�
Z�}�����i�`�d��{!�O��;]�#�w���������"-?@�'��ڈ䑳��|QN����z�(sHwh�����G���PM��RΟy,%N�2��1#)(��?�}��������,"A�/�SL��ʫ<�d����Z��=��ڵ����)����P�5P�]�ߑ�pɻ���4���K�M\��,>�I�a�����] J��1V��7⧎�9�W
J�Ѝxk[�U���fUD/�i'֑~�L���sOQd�V�ИA�a-ob�V���O<<D�vsĔ��/��v
}q}B�|����k�2��݂r��G����ѹ��0�fO�e�����[�3K���D;.�^�.0kl�����	Ez��I��6�'�W����A�#�
ҁ���2��q�ߊ�khvٰ�k鐪!
�j��R��h�WO����kdW���@ɢ��v��<�����X��"��OQS?c�{��$��A�ψ��G�X'!� �5U��%��,��K�1*=�y���8HE���B��U�be��*lѤ�P� ���.<�W#+|��^#�5��̪j��#��t����uZ�/#(o��i�u�;T<�  �,CРٗ��"�iC0_o��~����u������$>�j�ӫ����F�^����=S��*�D�&������9�ra��<C�t{�}_B�δ�-ڎuI���-�#��GJ�r9`�;�nz㧴_־
0pP��:J���ɖ�w&��3�614��Z 88͋�
�1%Xm�����m�V����P
C�5��.�I��sf����:�ulƱ���C-kQ�3�/),o5{�Xsx<t
kA�Z� URo�n�AZ�&�d0��P �qs�N��
�H��� k��Ad�Aq���[�����or)5��ٞ)j�xA��pE)_߈X����)0�������+v�{�1*]�hQ�����r��Ǫ	�)��"��8"��!�"Q4U�Q;Zh����fkǐ�'0���J���č�_]�z�鑤���_J��w��D|��P"�	W��[��6ɞJ�<�^/��m+����n��w��~�C���C���x��;���*��j�P�J���Z2⶟�Fk����C�����;����)�X噇�֋����A��i/
h�A�d�����]��unk�
��x���3�z���������|̓���٠�>�>��X����8چsa*�x�X`	����N��� n/�dkӻ
��2.~\��s��ΙC�Υ��D�Yv_��rgI��e�ե%�c{	x��IG���I�
�����*mFM�,Z�(�nq\;{��f�X�nrZ�Զ���e��F��c�U"���Cæ�r�������R�CV\�a��*��I����@��w��K.7����M��K̪����G��x �M��
۪�#!��L+
��?eo��{�|�A���n�F/���ۍr3 �q-�m Ϲ	���㹝�,y�5"�&�������h��8�YS:��(y�KOa��-n6[�e;>������4T��*͏D�Z���GI�h6o|�7s��2Ybz��=o!@��)(ex�F�� V��oV2ª��nd�z�ՠHv����i�^ϲ��MO
	��B�8$��t� /����L����bln�ձ�� �^�������.��O�Ӏ1s��A��bޘ�ԍ��jm���UW��?,J7<�Q4��Ա.%�@畵�UuE���0��E�l{C2�{��s��dg+J���f���\��`N�}!$��C��od�d�_�H gں;��Q�.m�8跂41A����/`����芨f����|��Wh��I�/�I�'�v5�7-�iN��hU�s���G&X8$c�
������nT�K��7�5ŏ�s�������=vQ�m�[d��M�ͪlJ~5K$�0�E;Q�~e�σ�T��oB��G����c{�/���a�vXp{�1DۚS#8
 Qg
��qg|�~{87�n}�V�3rQ��_w
:��H�����q����N̌�l8^�d[3= �W�g�&&D!�痱n�͋����b<X{Ur
!����%Z/�-��~z#|�=e~6kc�6��E�3����h���C���
R�eW8cm�Ɓ��?��H�v�dM
Q�iGu��v�x�Y1(OE"= ��ݪ��ݰ��]6��ŮGVL��7�
��]�㏷9�hm�&�����A{�}FU�r/MqD�3�ٸx���>tj� ;qIx2hT
�0|�(�Cl�s(:6�����t�!aNR��{E�h�n���<NE�uo�$u`��RI�mK���͸(q�hg�wbN�(E�]b�u5��?MOt�m2X��M�R�QYV*b�R����Br�[��{��3�oY<��z:����v�v���n�k�aM��+�Sio�?7��C
�`�*��J7���u��������L�a
�K�\�h�QJ�1>O�~q��Ej��|gy�p���v��n��_/����t!�ם�/ �Z��Oh�՘��Jn�j"�~�����M�W�7�
��M_b��%�u�H�Dg�L�2Y�1o�5�u+m6�7�+�!�9sc�ϗkV�I�/�v 	�9��j�:_-��R�2�Ք�����˹1Ù�@�XMK��E�@��v	Z&0U{�c�F!/�
P�;�%��r�7Qhh�R�^�lD�=����>gU��n�R��X$��E@F� �s��
�b:R�~���7�����1�ʃ�ɧ�$g���o��
6[��Q9�	���T�L��W�X��w>�_�@M���kp��n(�w恟�u`LG��z>���dՈBx�Nq|��rޜ$�[���LgO��$�&>��0jԗ2�-�nR8�(6�xG0��ݭ�Ȇ�*-m�Խ��/�̛�c=�)��l���p��]�CZ]0�e�֩k�s�m� ��DB�, �V�V
{�[��0�z�nu�e@����1g��D
"ץ��$Ʉ�����ٽw8��[�N��OW]�^�Ri��	z�d�*������O3��"-���}rJl��9pE?Ӈ�V>�5���?/�.�}�K21�N�#n���Dz��=�G׆s�����#�}�5�蕿�E�����1���J`Z����u(Uq�w�^�R�:D����Ѧ"�X�"e���gv9 ڧĹ�Ķ��)����1��U3g1T��k�n����jC�	����}�{7��5��v7��8b�i��L\a3fZmek	[u�\*4?)X	�<�΢�!`N���	p0�'~~O���G8����}5�ZA�&;՜J����%�ɢ}S�����\��^T0Ȭ"�={U��u�/���S���d��t��C��Ԫ+��B~]l������&g��⚒/�ͥ�n-�tP�ҿ�rv�7��k����`Zj5}��;�eH
���@[A��p-5����/�Ǔx�<��.�a�l���[3��[aJ�|)��A���bK(ؼs]r������*L����|��������wF�Ƹ^T:��DϕHL2}��)�!Z��yLeF� �V���A�����,��a�`��m
V}��OX��	��,�W����YO+�f:��#�fr���/}$]e���Xhf��$�<Ď�$��9t��X$���S?jX~�0�����R��(�?�j�;�@8�8��t6K44�I��~D�c�$DG2ѫu~�U�<#f��l��[�˲R@M���}�4j�>+��I��j�p�c;Hk��F��tP�e9�^�� '�h4!��+�_��z�}_2�GV�U3���'=��=��)���ʘd���]{���-��.;fך�D=�����(��8��A�уT<�5UߍVqX�	0���{^��d'`x�_:�m[�;;||#;G���q��r�[U��룱�3nz�~Vi������D()a��͝���4��Js ��)c}<���9M���
��
�T#�i�4�	$F*�y����GolbAS~4b�ݹ�(
8��gFf�e�e�:�E�g_;Y�aAk�P|5�	�f�!;�#z�z��mx�������(����ڲ�
V��ay���H���7����?����l	�ʜ���7q��hÿ�7N�n��0N�'H�s1d+��*��#(�,�eҚf�"�7C�}�%"�-����*�+�߈:N��Xj�i������h��E0��4���R5�c����nD�iV��_*\L�~��\+Bvf�n5��/-:�3p��m�E7TLQ?�Pi�
8$ʖ�����P�� Ù�����Ԋ=ĝ��e���9(�)��AV�6�}P�I�
T���-��t�k-�N��(��F�������o����j#9�nLhu����^�d�|1}�-�b��݋�}J�B�J�:�gzOM�L0�b���pb�,jz�|g\�q��ֹ�z��Vc�.�u��Ũ�h�L���(ݫ`L�ݣ֡<n@��������|^;^����:�n�
 ��\����|GZ�!�s��`i�`��z}�J�("	:?���'��4��v���b[!Au�b*��*Qs��$q�˅��$Ԯ{���0iћ��~���{��He�2G��0��!^e��\��iB�P�6��}�Im@^"������*!�x�U�����0��ҸyAf���$�ɔiD��q��R�v5gք4�	�R�D�)��#�H�#\��&�Ƌ�����_ ����d�?�!��9D��KY��6S�&v׍��b�HV��|o��$X���;T����LLiR�^F,�\ؑ��Xk �qr�h���E��k2�j�疼��n�&�>�2H���p~GTT�c/=✞
�Sk�[��^U<Tv㭎ż8�2t^��򊮅� k9��� fR���Y�
lo����e��E t*�e��!z{s�U���uN�X�-Yd9@y�y��������ڌ%#���	���r^C�)R0N��^%^̦���x�نwL'iR�t]�$"�,M��@i��V��Y�����~�?������Z����\ 0�-k3�Z���+�W7v|Y�2�: ă/�����+?�2�5�0�O5���`�A�^SѲ�vo����ĥ�y\�����T���〣�!�ҌR�$��X�
o�k�*x�qa��`ҵ�q��-d�`�Cp�6�wT�e�;��7x
���ת�m��GG�GR ��r���R�o�=3��U�[�r�ⲡ,��|"�&�����"�=�
l�p�=�@^h�C������Ay����?iM�u�]��V���`j$�]JP��T�*UC�Ѳ (N�M)��Ё���p���.n4�����$y_}�̇b�9��:S�*��k�y�[CʊJc�]�<����TӘ.ԙB� =���-+aj�i����5���0aǩ�썳k�Zh£8=�D3=���ܿ`�"��=6�ݕ,�>$#@AZBw\p�>G�����5�:�GZ�Ӟ���m�,�t��,�P*���6�SK��
��j&m.�A�����3���U�ҳ�b������F��˰��I����L�0��Z�M���_�Xʌ
X��QL�U���:��^�,K1�[nb��G2C"��HɃ~�J�,>�6�۱���|�I�3����ҧ�Ar2��j�t2�4��J�r]������ۭc����7��[���3�%Ƕ'�v=�Us誌��B�%
�LP�C|�Y�ZS<P��� �huDB!>v]�Ux�.3c?߭ש��@߃X_�|?��@���4����׭~IP�PP���5��b��wȨ�Ĭ�~T���3�0oܪ�F�G�{Ԓ����ż�M�C����2 �B	���n3�x�x�u�MnwX0��u���S�e�V�H�N�B_��Zs�ȓ�۝�l3�vЏ�d2����>ņ�I����	>o���a�Y�h��֕y����;j��s,Z�(��|��w�O9�o�	
�_�ECA��#�A#�yV'Y�@�%R �5<�mS,M�i�j���2�:-�H)��̂��
���-9�z/���(���_ �$m�:����?�1<]�6mo�-��^*���-;UH���%�F�� ��܃W+�_�9��D�b���,|hK%��ʛ4 ���(ļ`��_�N٠f֫���H�]Zv6d�qe�L|9�&?����o�%O��
%���	\�%�k:��Sh����fv�"��塙B�X��� S	���,���f�-K;4W��s�I
���)�X�C �����g�N��	�'	Xo�$:r��	���F=1=}8l�$�7��>�4��;+b���\��J��21�2����$���g47�濚��e�깋(�]��·;.��M���(]�XJ�׈�|d��G̓��$�U��ԝ|��P�
�":ڕ�l��*�iR�8�P�T��c[��~�3��Z��l�+9	�o`��l��!���v�È)(�F);P���P���Nl���#�k�f����LV��@U)��v�ث7HH�N�vY�h�c{{�ǎ]��`�p�{ۗ��#f�C2�W��lT߷��Mom��L��DO����]�25�M
��ZQb��α��`	0�օl���W(miu�GI�Je[1� ����y"��A�	��Ǌ�r�@��מ9>~���hf���E0@���������1�nk��R�ϑٵE����^�2�6)�U��4�mY���xb�7�o�A�vܡ�^��6��� <K|��w[pa���00z$	^x8��1p-�
����qy��4��R�pV���m��-m�yV�����kә_���St�/�U��k��w��t�"0d+�U�7h)/���=`:����1�L��#I�Mx��h���)�,��^� ����_Rå_��/����L�H(����;�%�jO�Ƽw�_��D]�7��tJ�h��'�Q�\;�&n�bK$�)���FF�w$`��#6nG-I���/���"KXs8�+CP�kkO��]�8���KzEH���Ak��r�A��`"~Z?�9�����M����M��h���S��j+��p�QV9���%�j�����T�LN3n֐�������L�������HS�޺c�Ҿ�Xk�����5p�`?�w2��N����'oi�3�I���(t���긘È!�=��l�7'�L�.�����xf���5a��_-@21;�*�����"�3w:"y�8%��9�j��1e���4͚�ex<�f��;��n����M1n>��@�ZKE�<L�ڤ��:���P���wĶ�b+ 긁��O!�~�	>g�h��mS�<�<&0�����N���d>�ņÂ����k��QKK?�*�>
:�l�[ش?m]���P�I���r��	Hc�
"qWx�+��Lm��y��t��I{*�m�g�������g�o�������Z$X�-p�lE'��an���~�@٬���Ŧ��ڭ�_Ӣ��Փ�������C���ճ��q�|�PF5�l�g����Ēqe�lM�g(�u��m���������5No�Ѫzv��Ea|�V��G�1-��<�t�m�2���a8
������`)��H��?cN�o�p�
���j&8�������ր5�HQr"/�Ǯ���)Bf�\g�+�-��b{��V(�]�҆=���o���_�y�J���6E�=�ށ��mD���F9�:4�V�E}�۩�qaK����~�Oa5$׀<�1��Z�ic���a��~a���*�O����}�v� �ʴ ��l�0duۭ�̺���n�ܽ��m:��Z����z�W���������V%-G�p�7�!���hM+V�IM(���fmN��b��8k�	M))�����Z����x=B�6�h�²6Vk�b`3��m�)Tl%fw$Z����i!f�{�0x�g;����
����y����u���"�G]��h�ķԟL>2��O�%.�����%�o�~���]��v�ώ6|
��zO�Oe�żLf���ݢ�YxŔ�~.n!@��f�8���/W��$Y���nr�ܦf(�9Z߶\T\N� ^��:ۃ6���Լ�0�(5�S<�<�)� B/�h�_��n3$-<P5�=�r�GE�4Ϗ;�S�	��*�����i��[:���7A�8>�-}�)=�����%�����������n�rb�ob�����d58�	��t�Uv`:F=�Q��ZW�GD9���%i�w(��J�E�''ɒ��i��n�`�q?]�+�*��*kz+�v��PU��V�j��xR�9_ ����{L˓��y,���J�F�FIᇄ�R��a��m�X��[u���NX�_D��Ѷ�-~�7���d�T6jL���e��i����|�e^V1
E|ﴮ|�QX�soE��bYO� �~a� �Z{�ҳ���Ǯ�S[Z������X+9�J��|8�"'�:������f[[�~Yg؞@����(5n�'���
6�KTބn���t�M�% ��}ꀒU�R�,�T�����ƥ�+�Uv�e�Ucd
|���x2�C_�{�$�d�S�P���_�_0S9�F�a!�����AO�^6����ڰ�N���UT(a��30�>�r�Pcei��w���������A
��0u������Q:m̼��atȥd+�
����ŏ6�˘��|�(v2�E�\qͿd7w_����Ą�3��8��p���_{��3�r�^�VeX�bମ�f�!!w�"�?w]�_���2��&=���&~��Ü%�)�SڋI)z�6�}MܰQ�i��E]���$��g	��x�)�@��?��ͮ��]�3Zp�DF6��/#���K,��E�k��VIP<�P�� Nw����z��w��Jc׿�n/�.�*fe"w+#	�-�2��p�n��6�ul�/�u�?m��P��ɱ�9�	�~������7c��gT���K7�1=U���.���� %��KdkU�_��ub��a���m�7�ň����f�:�|Ӄ�֜�\�Ȃ>�*�6���&�.�
�h$&�a�G���EL,I�C��w�����q����.F�Z�f:����['fdZ��6��C�!b<ˆ�G��ϩ&$KvDw�hͷ��I���̢<k��LG�~�/|�^@�*�<=�a���b�|�V��\��k�a0m<Sm����x�e���\W�:R8���z�n�T/Y�9�
�����莵����;������2 1�a<� �~ә�S�&��KA �1*(���F�̽Z�e=�(ˠ���x�C�����**��Ĝ�1p�8����HL���Te�XN���W��$�y9�hM��F����Q;�+k������`���D��}��t�D���Ȳ�� ��m>��;�R�pI��1�^���D5�ܭx�b�h��0ǂ
��2��7�S�я����*Kڗ�L�Խ�\�9p �*�J�L�4������w��p8	��+�9�A,f�y
Z��I[aqS��>�1�>9�I�%I3��/�0xXx?L��E��H�6��T�<�����3���|l����z�$�<���z��Ide>��#�~�0�ʐ��\�9Dhw9XM���nlS�oYu��)[*�����f��?}����n'Ln6}�T�:^��oPu�?W���b��a�2�"��o4)��7�ʠpI���>E�Uc�_[h��HH��矨"���}U�����A�> ,�1s���,�����2��IYdD`*:��IS�,�n΅_��R������պ���׬��$�F��67L#�4XսVo^�� �!�rf(E�,�p"��A��y��x��/����Y���S1�j�p+�񧄒@\?P������Q%�����"	�۠�V���~���o��i:�����З�/��u�..�#ˌ��b��P^P�|
$�H�
H�@;���w|�ܬB����k��
4+�e��E�hzꎩ�����Fg�� jJ�����~��FQ�ɉ����LAXcȎk���fZW;�d+7�C K��/V7��}@$��)Қ�p�h��i��lL`���S���H���|Z6�%�M	�}�����XJ�\OuG�h�s��gD�3�?��v�$���	1��,��3=3ոc�92@}q� J��H��5Rs���ד<�����Âf�ϊ,�������"�=2�L��R�r�N��A޾e�<Y@O��zi��=���Ou��G�����a�Z��\���u2�]��YFTJ1�JF���cr�s�d����GB^t]-S��wk.�������eV�0��T�y`�3>�T<&ܜ��&������L�E�i�����H������=1�ngΏ~\1���P�S0	dF�R�D�M�b_.��*g�k\��5V�AE�z2��"{AU<���k��<���f��3Φo�
;)��� %MbF�?[t�L!O��mZ�㟍;������9�b�HI��.�ۀ;b�\.12���Gp)��`)'���W̶|�L7^�u��L9N�!7��v�����	�DL���\�� ��ce�4|]���O��2��J(����Hlr�������7ziR��&�l�z��=�]c4�K �)�n�
�yO������Hڷ�җ�I��C�lE�݅&����H12�yt*@s�IH���2���]蔚;~�؎���>ά����u����x<̪��B\`c�������ӟ7�⾘G]�.Uݓ< v�W�[t�v�f�LN*�����Ҡ�a1�RPhh`d��e�Zfum.��j6�ly�& �O��q0K��ey�R'	%çet����g���O��W	��� +Lh*.e0}�>���d�B�b5 @�>+$cfzZmc��r$�D���;�x;f�1?�f{w��Ejr<Ը���K���8��?HQ�Pw=��9,T�M-r�y6��*ohl��|��Bjp���O�V�5$6Ib��t^�rb���ڷ��s��Ζ��)��?2�ed�ʢ Aɋ�ޙ��� ��/z҄���v�9��_�"-{���x=�5���ޓ<�O��K�D{D8�t����d�yr������ ]�6�U�Z���͛�t���IW^H������n,��f�yt�P5��F�v��%���נH�8[�u'�0i Ft0���Z-k�������
��:L�׻�e�6(�ψ$Y�O4���\ۄ��2�n�?��z����C��+u���{l��N܋)��e��C�e!¿2uPl�<�/�|�w�2~��(C��_���G,D;2���ʲ(\�N�4�:7��W���
37W�$N=ԁa���a�Q�]85��^'�$|=GPj��lZY<���/B�#X���|��Ƣ��T�	�vg�,�D���:��a�l4�E�-xL(s�螆���7�����%�s����6�⡍#����g�E�u%^���ұ[�i��\�`��``���uÒBPo�+�XI淏�qA�y�N\Ӿ�#Y8K;�eZJ՟���ȼ��&��P$1������}���i��K}��{�s�Z����>��r�����a_k���0S��ܕ�7&���Pi-�6��������̅k6�����J���	!D��a������1�z�Q
߱���.	��IKU3�G{;(���i�2}/��~tڗ��X!�>�?N�)�C6bΞ�
:[�l0-�u�Y�� �-��h8kU�|�x؝�s����@�Oe��X��I�ImϨ��$ʠ殹rĩ�L�l����TR�$�vOP(S�?}R�����Ε�\\�+�A����s�h�*S��8DDZ<��+�9���f�[1��������E�*������l����T�ŕ6�ZbzH5�w����?�o�{0��N���73}�h[?A�Ǚ۾֮��:ؘ�щ84��W��I������x�����oC;��rgb���(D��a��Hd�>��O����J��za��n�(7�q�X7��M��U��c���Lz���׉]Ta'�_(u�o��J�����0��|���ks���ِ���Ա�#�鬄.)��:���
��y��_K��v�'�u�)6$T��<�{��g;	��Z��� -A�p��'���4�캍)� G�U﷎uJ�CGh�	��m^I��]�N����3�BG����B��މ��e�VT�vţxFqT�n��T4�B<�{��փ�C�o�I�������,�^`J�~��E�@1��cz�����c�]&?9�B�l�# �@n���e��n�=H �fo8��+|]���*|&z��٪�Վ�\���^�/tr�M��0^,�ҿ͊�A�k
qnm��ƼG�3� ��I���Ǎx>�V=�_֏�L���Y@Ȁ���JA��TuP��{\�T�	4���*G��Yəg�`�+��5:�-ۏ�|
:�&��T�>uFI+��O�
���^�-���.���D�˗�t��X��%�|�sj7S�����5�-S����u�c�Y!��J�{��'������$y�[�O�x�X!%�4��J|qF�({��Hڏ+��z��ڹ:��|�5�L���<X�HP����/?���-�:to4�Z�n�i4�ek��=����>J{Z��+L�?>w
]��)��b�R�,����ޟ����&_�Z��j���g�СP��%���y#ݷ9�-���
����*���3u�9�{Yqw@t�Ĺ���D��7 ����&Z@O�$~�:���
��>��>�Ns�D�T1�I�_� 0��^�9W ����*�yb��녛h�>����1zS����KT��>�qG��KZ�A��8�!�L�:�'~)�|b�ʗ�m����0�s���d�j^ �t�f�a����d�P�t$5�@��D!>#�R泜�̺[^䇇��Hi��R�����2�������U��M۪aҤ#��l��Y�ɧ]��Y�\����R����;"}��2	��>#�G �훎��˞o� �w��j>4A��~DK(B�7�Wx��#y%��_�v*��&Y�E.�B���r9
�{�J Nb�I�΅���+W��1B}'g�u:%K6��(5��E`���81��Q>��Z�_8A\n�q�{���~�J��s��a�
���0M�_זM~�z���w7S��"^@���\j�����6�[b'$�\%�_q8bW��2 ǃ�;���]�x 7�����g{9aϦT
��|lZwL�j�[�`<� ç�2�s���89�$�<1��8��7�a���6����2Q{��U�T�C�;t�'P���aAT;������
��Ugp��C��q]�oOtMr���'f�mWnbe��BⲌ�u}Ǆ�𥫕��i�-$O��c���i`����#	�7w>(��%5n���|'�_�Z�EX�����������K`���i1����G���Z�Evx�j�|�L�J�U��6cIvfb�=�e?�k^�z4�7�M,?��)I�^-~� �6�*_\�Z�h�r|��ѫANKv.�0{���˷�T����/ޡJ�q��t�o�zɍ+��APŃ�j�'�DkNv��i%60��X�Y��w7MZ�������A�,*z��*ڥ"���Q��C�h>̮�&u�}Զ��T�y@IɁ����q��«�;A��[�����An�s���)c�<��!�r�S:D�O�+NE��w#_í�ܝBF������XPI�+�=�!��LV~a�5�I3��~F�H�/�>�ۡ�$.KX"�0L�IA�e�
h�=����5�^��"pɉ�a���Ǉɰ@�Tn���]o�2���C_�����'A=�-bW}�Y��yj7«wͅ�e�o0%`��-t�߉�,dQ�O�i�d�l{'(�ݪe�?)�@Ǻź^� �c����!���ѡ��zҞ&����w�A}��Z�v8q��eR��G���ێ3�,p���i4 �C+ �4��lN�� �t��R=xB�KTa�QM�K1G9
��(k�t���m¦� ��*uL�����:4�v� Ư1Z����7���{�6%�..*�w�I�
		Ӗ���'8����68�Q�?�@�,j�|r��K5uH���v��k!Jޢ��y��g�MO�D~A��^ձ~���O��6�\�sD�3���eH*�Y��K���8��C�^��p
Ǯ������q�-���:zrd}M�g��g���,�k?��'|������{�}�����������+h�^����H�ZP�kS�.J*�)�*-����EJ{�!�5���/�09X:�O�m��<�# �qL���"����o��Q#]��(v�4T���OAZ�$G�Q�H�&7xW����G0�Y���D��
7nߴEbD�E9��h�lY�Fv�*vo��Q�2D�<؅Ad�徒m�`Dû��hO)J�*LEfd�+
Pfh����Z��0�p�/��tI�t��	�jej�r��|7�RɳT�L��mW{ʨN4F�3g0�ޔ ���&I��9z�#��i
s�vGk~e�@Q��[)7�Rpp#�x9����ܾ��
��K��mIݥy�j���:��׹�׆7O����x,�̥�j{�^*�U@�?D]h�0�w���])Sm�j��؏���^��Ď�C�{Pͽf�
k��u��h;��b
�K�E�}Z�ܾD�����zڰ ��Toj�2u���R��0�%�]PZ��� �C�3�32��"w�CF	&hi��{T�`H%���]���r�z
��	E6-Y�$�T���9&������
�*� |�.��O���OA�����-�Xa9�����&H���K���kN�������`I�_2���F�Q�x-��^X�n9{��T����BG�\X'L�(��`߶�>�Q��̈́ g8�u��PDQ� ������  [Ň9���:��Ue?�UJ\ ���t��)O>E����]]���i�z7�[�ae�f�=!z�++��s��7W�&�#��y���5��"6�g�u�]���bo3
[լ�K��B�ۆ�Q��XY�a7��7rJ|H��'������Jg5�zm[����Mz{∢f\��j���sHIh�喙�BQ�E�{��A���
Q���:���O4����'���tx�s��Ɂ�/Y�z�~�k*dX^��,L#�&Wl�0)d�Y�7�N�3�p�[~'���.ѿ��v	�jy��P�����c}#OZ��tY����)2�P�Dⓗ�k�"V�3h-O��"�\E�z��B�&8;��A?.:jR�Ä��ޡ*1��˄���$��z�����Qb~�|�?T�|ӀF��"�%G&q6w�ٹ9�RuE�+��N�6[�*�[�|T��V�S91�̢=/F'n�vz�o�FՉ���e�����O�����ۯg���J�8�Uu.�_@������p�jȸ��϶B����0�躸߰~!�d`��/��X�q^ZX����pL��hkQ�I�U?������S�i�$�O��;(Y�T2e�h(g���0�y�T�e<5��NJT��%F�
 ��$��9l��#f�Y�"f�>�n�����/�p�,��%�;�5��,��<u��֛u�:�z�ٕ1�`�'�[�#J;���/&!�V����G�^3*�����q�GVJ�?���m18Ź����I:aO:�|�zM�n������G���qZ���Ӭt�T�TwsO��6��GB(��%<=�}�g����ο�DwGm��c�Z�r�������+`A;������C#&��:~
+vW0�"�v*�u]���@�n�� �������kGi����@Io�@I�-��8p���Q�^��៴��g�iCHB ��+B2���Qֵ"bς���	�/��=n.��@/�?�Y}���T�p� ��cX4Ic_��Q�}=��Z��V���'��^�+��M���8�3zӐ8:S�����٧�a�����#ND�;��r��ۦ�jtQ���\�I䰕��1�C;q��K���4�~���w��$r��8t��u�F-c��͸/'8Ґ�>���w��$gp�-�.C�!;ќndTZ�r����iִ�ʓ�.K
)����0G>�;]{����oNS��2 L����x��Ķ�[J_�(�|>�R}�һ�$o��\��"��j���$<sX
�#��W���q'ֺX�?���mIY+�©^��=�	�_.Rj\�0f���e���B?%Ycv�T0�KxЕ`l�e�|F�*��^~%�;D$|m)��+S���s$��/�
��(߀C�5W7�lмO�z_����[`=S���CcˠN�ʃ����<��B�
D	�ɟ9�?��5��(,B䓂X��/��k �x�^�o�Yq�Z��lz\t��/Y������f�	�D	�E>��V�Koh-����-9V'-$�.i(��'�ɜ�0+&f&����J��"�Ň���5E��ƗNL<A�[)�Z@�Ţ�����+>
@ɻ��{X�?&V8���[���i��0>���^�r�Y��J�����H�X@���P'@G��w}�8?&n���*��;j��I����~�q��I��u��k�8�+�1����2�}O;r4B�ҽ���[�D�޾>�����C�s7rTb�a�ʻ�����ሑ|G%����K>Ԛ��T�~x�)�u�n>{ډ�aeB���ܝo�O���>��3y?K���&$�9�bf��^$JQ%������ɾ������N�\��]�#��a��v����U��nJ�j�� �A�,y���05��>|`�da6�pDz!�6�Y��.l�
���1�[�9 �EO�&�ߧ@�
N�v��E��u)a���^�t�1Vf��8��MraqX��q2�:�&q�CG09���R. ����h��q��+y�OD&����Mj'>G.� �g��
)K!��"3�c�q��ƧV
x���#<���Q������	�{ȳe�|���(,��Bռ�foD"�D!?pD�U ���1h�U��\�E�\�����D��%#�\q���,{eTE���l��M�Ī������ɅM�G�58A�{�hM���p��8��:oĮV�Ʀe�d�����j�m"$?<t��)�:��>Ц�#	������q�W&M��-7Y����f�ͽ�{�!P#��^픁�A��c��#���8?e�a�2���V!�0�y9���Z���;ڬ�J���3�UC��}%���A�����\�9Ǳ��$Vsԣ�]�?Ύ�EX�k���2{_]aۭ���dv�qFVs��5�wV�Ԃ'��ydQ�"(�~�HG!�R�Y�g�RO��'�ƣ������?�<�(�	���}}��e7D���Cs���_��7�\+>@WJa/�s��Q�Q���G�!�v�EZS�\-܏Z��p��1�a7�t�v��ui�A0��B"�ث `��ye���z���N+�W�X*i������h�I\���A�2Ssɀq�L"'���[̒�`�~���	I��ڃDI_V΢����g�F�����9݆�����~F�<�V鼎WK�/�ҩo���O���囔��F�I�GTAK�笡	� R�YF1I����P���߯���l|��TL\��12js?p�~+�Mm����]�2( ���io��W��8,�2�O.��0��Ii+�S!qZ�|;(3
XW�O�v-m��[�gf�ؚ�z� l�� �E\J�<�����;y��ј�.s��0M&,)kF���5�Kn����S��m
�R-���&����E��>or�sT~�������b�pcT�I����`O�,��Kl�7��͈4�
���aw�iFf"ew�!@��WS㨉
/i:5 \"�5�M�a��CI^�1�¡y�2�SCB������Ԑ1�z��ځ4i�q���@.�0U�6�t�k���B�p��U��i�(���}��tS����v�3ISH�s����oU���{)-?�LU3�>�N��
�s�������Hb5�Ť6H��ou9��!�,��%Q�K_�^z�T_�*0k#��8�o���H��# Y�`ˡ
HsP,���`�dؽ0'���m�d��!m�Ha�����.����AqLy8�?x��'�N�jE����x�k'$�ʬݴ-�Ӓb�5C�7��ۡ��o���%w���mC�O-?��GJ����Q%R�^�D,0�c�����׼�eo_��p�==P��`qZ[lE����M��+�t,^Q�J�	�s���/�MW�c�=&p�����Ѯ��J��b������fEd�Z�`rm~�W�y�f��%ĲSU�S�����G�7�g�u8��g�\��6L���>�WAe��2�f~���d�+�mX�Ujx ����H1��pN���������#e	8�2�E7�P�l
�Ig�@#W�������{�_��P��J3�uGي�2I�0�v��A�S����#�Ev����ʪ��B���E�����Z_S�v<y�����651�`�c���iA��� �D�}���{�p��r*�O�<��+��xfY@�NR��𣱠���y���܂�&}J���Ƕ<��;���p�4kfZOuHa��g=�vI�(r���gyh���6(,�K�'o��G�b����H#>�9�����&{�������P��~E�i:�8T�E�$���h �� �b���<���K�X���]"w�Rv'o�D������I`G�⭼�L4�k���X���"I�
�|gs��f�0w���i���yJ���4���~n*��_�t��Xj�lrI�W2'іG��c�cwm�$��?E����o{\�1���[�Xmڏ��2n�.�fܕ��<tӻ�7�:?y3��Ĺ<����?��`���9K<T�S>��3�ގpJ�,%��$�V����OĹ�:MBktw�A6n�킮�X�@�6M��Ϥ?.L�,�w����� �>AR�q$U�3�a����I�Ӎmܕ �7�g^�l�c���dT3�І�x1|Ӈ�ni���!�k�&��/��|e�,�W��Ǐ�>�#�\ 7.�]5?�B�F�#9a����b*<���[C%p�z�����F�nh�FUD�@H��A�D�����mH�m*�3]Ǆ𧡷�=qҳ��<��)`�3�	�&��!�+�v���v"�4{OfaM�G9^���%�P�k'�8�:�2�j�NMc��.��W$�D�?O�C�u�{>'4�KQ��C_L��5�B�Y�������C�{����i�"ܘrz�-71�	������	m?�{L�ZfS��s �j���>����Z�m����	�cf�@��B)�َ8���e��h��N������*�{�:h��t@_a�v�/�t��TϫYb��" ����P��'�{��=��M$��RMN1�WD굊�y���ୂ��JF��z]~,�6RU�8�f,��΄Ql~�1�9է����G��<u��)�\��O�p�GY2u��8�Ӗgyo���(Zv��g��{�A(6�ad���蛅�&ů�Q�j�0�����Z�6�o	 �@b����.f���G�ʁ[�Z!`�J��C�L��5|3��y-�+�wlݹݚ)����!��f�x�B��M�KTQPe���s�����-wS����H-�:�K��1%�j��}���8=l���s_f��J:��T�B�H�\7]��آ�J
�6�cS��쓝��_�;��`ի���}w�0-Pc�j!�È�K0�K��1�N�9��ݻ����#�y^�Q&�
UK� .O�*s���u�LE���J���� ���ӥU�qiޏ�D��Z�:��>.�{��W�.���B��J�F���%���`���`$l�۴�����4���@OjW�H��Y6���X��ع`���h��O�H��'lI$����)�D==6�uNa.�w�B
����Τ
1�+A[D;(���ő�AGg�Q�W7X��y����>�F�����c�Zn3��}����hx��t�C�;!ſD���)v�P�{���'�A>ԝ^�zO(�8K+�ۜd�a�nhm&�Z��ˡ5�B��(�G�g\�s��Ч�p	K���*'�F�-���o�_ϰ6ɼ��F�8J���!����|�Ǳ��G�9�)�u�P(��AW�N=����{
_<z��ǆ�6R�A�yϦ�� (W��
�{�c2
��U��#a1��e���ćϴ�\�/~��Z�Y]tn/�>��f_x�?�x[��8rv�!ų1�L������X�s͏���ya~P�:��Y����������i�f8DgCJH��uJ��Ф�ƞ�^�//��6�p�ڠ�P�r0���e"�-i�hiSH_h:P�m�����J��}��#��f�&F����"���V������-���!��z�X��:mJ���x��,[��D��$�P�"M-_6�����r�.��"�q2��&0��ef�-��Pڡ�#�ͩ4��ʓ����ɽ��S����C��(|���Wl�_�_�gv���]�+EWj�K��-���G�	�k�6m�`4aA��H���E�nB.�훱6�kkQ
��y�?Y,۟y~n���ԿQ�[���9�;4
�R6;�}������I2���(
�E�޾(B�i׾N�E�>Զ�ް��,�����L�q�]7��c��l�@�9�R�Hȼ�C;	b^4�e= ��X�t�~]Sn���5u+G-��%[0g8D�VbO"Ҳ��u�CӰ}�@n%mjsyfB��>��\�vd	e�N�2�~����"I����Z������,��*�Gz~
�k��N\�Ս�!�ӥ3A��L�'�ZG-���쬐4��"	�g��B�@�1��ގ��}���uZ���Uf\H��1��lu@��W �x��(��߸)>���+"��[��|�e��#�|癙�a!��o"�D�����\�6R|�\��!AdoaL��&ه h�m�nqeF1KY�A|:?o+��أ}&�<Tk9����7�,���Yb-ֆ��5y�(O��t�˲,lA#�n��e@�_������dL��ɻq���Q��2Su����>w�!��X��Y���C��i�%9%{}>�����0�l������P��!�q�9t*te��a�'x��Q���ko�e@�P��SL�15�I0���(���0�z+5'��}�(Z�%x��R��´��BwTu9b��1��P�:qo�͢��mm�R��Wwt�XfE���j&�(+9,��6�v���A��(�i:xв���ƻ��
C�7��)B�e}W�c�w��TB{Ű�i	'�X#��N�9djw���m�i�h\z���j��S7vѿ�xJw��U6Hp�/#���]�߲��l�rs�䡏ܨ��v,�疂C�=c.�zjT�*&�kne�cݻ�u��>��nL>�i0y��}�Y�7�i5����n��v/�{zT�������V΅�^���B�۷�����TH�By t�w%�ܐ���G3ӘA|#��e:�
 H�5-��|���}����|��~�|�i((�B�_k�Dx5����'#�Ȣ�@�{����l�d\ƜT�%Gl���\R�XN������п#�û���5��}Y�T�$
If������Ac�%�oJ��|c]01s34�,zE��qM�9v^+�0��"���oq��ofB�|�r����Ay�y�uou�o�6�4����2j]���uL�ͦ��kluNMt�ȟk��o�<7j
-jj6�C���w(B�㬆#C�}A�C�mh�ң��y�i�������^A���i�vr�o�ߙ@,ı����5�+O
)�j�6��`p=�#7��%\���<O��\9�DX@�g������$����9�C�M�(�pAa��˪P�p�-����x�g����vR��G �'O���܂��.~�8vhDXp\��Hw���K�]F�x���3�`V��8��ὐ�����Ֆ�.YLtF��B�g������j&y���� �-��*�'�pu*T�ڷ	��K����T^!���"�����4v�����_N��H�K���A-m���&Cj�U���3o)h>�+�<��Fa�%�����r�`�J���}�L,2�Ԅ��!�����,��i�lށ¿&��,w����S�+h�����%����	�^d_�ѡ��be�Z�H�R��;���曥R���tf�e�
5Of���~��Q��0�#�
#=[Y�$[)����>�W����X�keR���a'h���j }�#$�.�n�H�=(}�����s�82�D���/d�O� ���]�	9�#ì_J;�����5���O��I�K���gq������8g�{�T�L�G�b�����4hӫ̵���ɰ�,�^Ԓ�͟�Wq��0����0�S	�#� �C�=��V,��Ê��/r�+��1Yh�=ֲ�$Iq@���~�h�e5�CDDխ;�H��A)����|����L�
� >J��J7��8v�Ï�q��7�5j�큯��meDs	��"\$�n�SOV�h��!�>*fQZ�d?�5٨���(�B��U}�F�m�V��jb�=�!9�@C_W����k��*\:��;z�-l����0�����`(^jX>I�WiK�
V��%����H�Z�@�<�3HΘ[����ɼ����6DL�`lK|<L�1ݓ?�	�tz��4�T@����/<�]��4�U�{�P�[?�~[v'����u_3b�4o-���g�8�4A�.�^�&:xT�TO^ ��P�{�o�I��+��B��Fұ�eI\pv%W>��c�]�a�!9�D�|Wm��AH�
:��r��!�����A�w�C����{y���HiA�ŗ�`������zKfȿv�|�}D�(�[0=׳+�/�&JЏی{9���
ie���H��g��*�A뗔�J��{��_������{�Y���|���W�cez.Pv�Uc��զ⦃���T�Ɠ����ռ�h1�=���,��aR5{g�\�:�%��dݯ6��E7A1�&{��5����:��g�أ�"���%�k�W�6�'�.�|���$�"e�%�R[oTP����s���sj����PL`���q6����h��`�V��2'a�ʵd�$�?���"[�����_�c�TC�a
\p��I��ՖV�Ar����^7��u�p�U����`4+�B�v��C<�X�P�Ʊɸ�6Q��BSoa�A[�t&�����\p_Tu��R�i�ʭ&)��D��x��w�f��<+¾S��A{����+O�}�'_�e���~m�䄼�ܳ���u��<%d\ncN:�7=2܈_@ʕ��$�y��w��!��H�~R{}����ВD����8^q�4J�-ѝ���M\1��RYC�07t���d�����P>v�>�{������j��u�l�;�`�C�	�� F �~�ԥn�[)�rz�qOm�3Z �:3M��oU�y��|�z�a����t�����Ak��I>��e�}H���̓G%+*�y��45�+�xcy
{(�
�ǆ��qmV�,�芨]�Q�l
�
�������/���V?��%�I�eI����	�#%�ӫ��/f���@XH�:�]E�@�p����0��[��H�xS�?<wڮ�Hu�a�5M����6���S.ʇ�����Gy���FO�&��Q0f�"R�lu�������`���=E�ؿ0��$�D��ѩ ZT�
���ܦN�e�o�*���:?�V�����x�[yr���݃|��EK���Ғ���Z�����P��L`g��sy�p�fL��7cv�X"�]}jG���P�<v:���ҩ?��`5�5
K���GCI|��2��'�2�w�£_ �؁�t$$lz3�η|��a�blf��p*����~�S:��Q5*��G�>�W\p�Y�������4��1��:�V����^.w�-8��� }��7���10	��ȐV�-f��M6)�^o����P	w����s)�6��W�RBebk�D�Kc��Fz^��a�C���kc��C-S���M�3Bn���Ꭲ�Y|����T����K�.�	|D�L�O`t�O�nө�W��@�n��}�C��k:�/r���,�w�NDY�G&U7��G|\i���w�`j-�V$���0LZ��r}�}�٤� +.�Ķ�t��@�TK����7&+g�ZjN���)%"hi�		�ZNqA������8�5 qa�,��<�,��,�5'M��8�������
W�]����'���T�O	�)�Z<�����~�G'�uĪx#�{�La;���M��u6�nJd3��{Y$kw5<�����������c�*�p, 0�<푍��7�q�s����;}Y^����<�I��wpn�
]]u��/g�`N��G���#�A��s¿�F��였�@��'*_�6��5�s����W-dY�h(`�d��
G&���lir�s �@Rճ���hF��f_n�=�ɠvu��^��S�����v�p*�r���H���[� ��H�%�)y�r��-M��G��C��}�5��B��2c҆�;�����֛�/�������@�sg�x�4i%V���gl��3�8u���r����Rg6N��ue��������p00�6�q��I䴁�g�oØ#/f�dP}%K�ɫ��D`iP�P[����yNj����xO9�_0��>"�{��
���ދո2dQ��q8��Wt�E�㒮*���9]Pr�@�ᬪ�F-�!<�K�1'���N��۴��mbF�����v.�28�n�S'®g�(C�/n���H{a�2	Gk��j@�@�R)!sh^I�@���I�.��K���m��
��3�-"��F�Os�u���i��]��� b�a�ά��4�H���9��)6zjKY�W�UN�x�52k��k�EDfM����p>�8�S�P�����gˈ&�B68-6��}쎼�*I�G�B4�g����_��[�!VV��α3�y�*~?�q����lp�W
�{@Kƙv��*4��2ip��'[�&f�"Gɑۀ|l�uY�B�x��g�[F������U�x=��߯���J+Y��k�ש�-5��]#�����0-^՟�}+�
��EMq�5��t��r@P�+)���6�q
�±t��P�3yv',��6t�l-٢�Ȩ��ߺ��9��^at���?�Q�A�S�A�@�{�概qj�X�8��Ʊ���G&~���z�JdT��8��I�xT�����
�d\�U��(YQâ�4�̋�_��n� {GyKh�>����V�~o���p^��f�T��%�@��D���3��w�f�E�<^/u�K{�am��ArDT�,n_��a4[�t������G]]�Ӛ���?น^bчz�;���U�H��\��[C�,1ns��
6j�WW����i��2Y��M�<����+�y�;r��
���UM4n)��loEm�C[4'�F��;r�_�z����:d5�� Y+�
n��M��=I�Q.�����n^8�t�[�O��MO^���-]ų+��^<��M�������@a�5���="��'�++���&�$P�h;k�>�H�%�Z&q��*��(�b�~86�u�^S�4L����l
��	4-�R��w��b�<�0�}8�}z�� �$Y�  p��I�e>͛�{FS�s?�����v����l�C��2eܒK�-�i���>�!���b�����J"��b��I�KӾQ�P����%j�Lza�$�/}~��#���������~Z�`�͉4� �g6�o�����~�n��Fa��M�UK�l �hi�C�j��:J�������&z��kZ�T1�
�@�du�>�d�Z��������T�Yi�v���K.� �cbM��)E
���o�*��^� �0Q:���׳� �]�3��2�R�;�TV�
����������?���VAlw����qA�p����1C݆���ۦڞ98�93B��B�Tw�;ң�C��~�ía۟���z8FN�j�n+tm�2W��Ţ��S�{L��Q�������g��M.my��,��=��_E��#�t�{���g�9����S>#�r纷������c�+?��}�_j�a�n���y����hϤ���Ah�Y��v��R���3+��B�~���$�@�9W��D�
�� 24n���4LڌC�8MTr�\��K�n���ə���3T��=��#e_pj�����3
%
��و�Z�2.%k�r�q�Y���?N}64�!��>�A�B���=�
�
��x\ ��'
���F�j�#C6p��:��@�ȣ��4�������f^�]��?�N��%�1�z����zN�E��C�����_�C���6�h��Alv�:���hG7���o�O�(��!SOsE����7��j�\�i�#�W�a��
Y}�2�;D[1�MB���[�8�0
M	��[�~!g�+��������	k9�6aY��-� s�L^�K��ybZ�/������%�\��ca�T:��tCA�䎍.W�C_���0�U<��k��wO4w�Mb���߯b�É����>I��Y�i�g[ܔ�PI�
s�JlXH�9��,���t�r4�
^�iD�7Iڰ��\�g���>�
�c:�CO�dJ~ѣuR�ܴk^�]���@�����J����3\B
��+}T�T��lzen��ݙ�{�6�W����)*b��4��
��!Բ�;�|`�br��Y��w+�FdE7�X���Y}ƻ�yeO��9��I�
���+$>M器�~���5: ��B�+�$�>��ǼL�8�����
!]����[����]���ˬi���"tkW̴�^����̤ͭz8�0�C�
�r���[ |t���\[3D����S�Ua�
m
�liHɏr6 �s	�����_;��?��1�Sahqʝ��I����"���.J��W�C����
�V�L������m%��M�� -Y��C�rG��5�yіsq���6��jk� ��t�Q��&k�N�K��"�X�g�H�.�.iDkAR�
l$Ꮽ|��G�iG!:� �t��d�]�Wt~�1})nC���s�'u2��t)#��)��Ǳ�1%i$M���߅�	��U�t�x|�*�R(���)�Xr+�^���`XL�S�%�ϳ�S�2Q�V �d�!6�`x��An�2D_���mQX<J��[�gs�����1 ~#�LDpS
a\��z����z���K�r�\'[P���k�T%(��5�<��/+�ّ�}uz
;�wT�m[<���͎� �᢮��Z��0���,�j�ڍ�<;��3��гz��G3���2����e{:�����r	I0}��ş����1�������~:h��E��,l�����>(���n��/�Ǌ���TZ�FaTS"��뉲�uS.hw�X_��E\�5&wu��YʨAI��X�	��wk��v���_s�5�
�i�U��:�xN�e���q���)��N�k�<t��Q�R��P��Α���4Z8$��d��-�"7�ܻ}r�?7���T�T�����4���c�(rY�Hč��D��*I�~�`
�rG>���]�6H	)I�5SND�a����t�I�T�e����ޟ���֑��KS�S�ra��Z`�5i�1����_�CR#p�̆a��/ً$D����06I�������z9��UB:���nh�O��]a��D���G��d̷����>��K,^l��t{���Jxe-ĵ�(������%�߷:5��M&�ZF��Q��JRF7��77�@��i����u��^r�x����m7���Ƶ7�/�F���~���uu6�(�x=v�Q'.�C6:�����4�J��fı 7X7�` �ͯ�W/u������ H{m��ؼ~�	�?�+1r����2���g�᫷I�]����x���iׯ�0����:ڌǹj̘�������Ut�9���,B�*p`��=�v&<E�F�8=Riiɨ����SQo$nm���s�am�l�w]����E���)E<��'=����~E&O�c�x6�	�h+آc�ӟ���n��"ީ���	����;.r��GB��m��Lj�줏�$��ɶ��	k���#��<�J�&�Ztky7S��َ@�o�����t�'O9�$�bc���F�ҏc���aP�]�ε�%�*��xHR��]ŋB�'�,�'���=K%ݞd���24�Q���=��S��+���|y^�M�hW. M9�<�$�Q�6���g��5�D�Ic�	����e���R냟��R�&٩H�1��/���1�4r��Ch�?%��E�2C��������$��*J
<�ɨ[�Lu�Đ��%���z
����p0\��?�������iԚ�`1�
(L�_�!xљw�O'�f�ܗ�+o����J����}�i���<Q�����T���/ms\��/J���%�LP!��x�JH�=��P9W����ܮ�t3�ֺ�T��
�V��# ��9c��i�_��!�x)E��>Ed����VG�m�ȹ5�o�(�HhB�H*9R&%\R�,f������M�V�|��?iԝ�Ģ�) Q�^[֐���ǽ��� (����� ^�Sèqjú� x�K	|$ ��QX �p\"nd|���D-Fl��ΐH�}��:��<i.Ȯa�n�m=x�n5vf�;h�e��0�lMybu��]�i(A`��;L�E�v��(��4��g(Vu�\����+~<V�io�D��WÀ��Y�b��2݀Z�'�[ M���]�|G���	����#��!1I�7� �
l
����]֧o���aΣ��2>*�/𕜄'�٠�r�
������k���	N��̝�t
:<�9���Q11�
�hm����;��
Z����fޱm�DN���&&�H|vzޓ��� �`�+�	&����u�>P��;0���}pu	`5��k�B~2^uYԝObٓj2�<f,׍
�hp��$B.��z�3v��p>���c
�F�W��ֆ"��m��lp΁L>�+�v*Y�.�j�g��ؘi�X�(D궶8zR��I��v��·Hw^��
?2�g�c��u#<Cİ���>C�
����6�%�:�IJY�#�g1-t���3��1E�`�7�B�����;�J��'�D΂;~�RU��%!���8��:y�� ��õ�X�N'E��9�C)���j�h�_�Pu���̡�1�vE`MB���P	o����|(-�� �D�jW&������OP5#BZf�ӛw��cN�Lt4�w=@��r���o7J�毒���:}٩QF.�Fd�mu���#X��!�9��h�����Q!�i��ދ�!E07>�1O��zo�l�}�2bf�~�Q�������d �R_�'Ή���g�K��e|�-���G�S�q	X�B���'g�z�NN[/�bX���)���^_*�^U�0�Q��14c+��_���
�i�