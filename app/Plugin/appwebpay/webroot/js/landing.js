/* jshint bitwise:true, browser:true, eqeqeq:true, forin:true, globalstrict:true, indent:4, jquery:true,
   loopfunc:true, maxerr:3, noarg:true, node:true, noempty:true, onevar: true, quotmark:single,
   strict:true, undef:true, white:false */
/* global webroot, fullwebroot */

/*!
 * Llantas del Pacifico - Cyber Week
 */

//<![CDATA[
'use strict';

/**
 * Aplicacion
 */
jQuery.extend(
{
	/**
	 * Entrega la URL relativa/absoluta del sitio
	 *
	 * @param			string			ruta				Ruta de la aplicacion a devolver
	 * @param			bool			full				Devuelve la ruta completa de la app o la ruta relativa
	 * @return			string								URL de la aplicacion
	 */
	webroot					: function(ruta, full)
	{
		full	= (typeof(full) !== 'undefined' ? true : false);
		return (full ? fullwebroot : webroot) + ruta;
	},
	
	/**
	 * Mensajes de validacion
	 * Pinta los mensajes de validacion en el elemento seleccionado
	 *
	 * @param			Object			$container			Objeto jQuery con el objeto donde se debe escribir
	 * @param			Object			$item				Elemento del formulario con error
	 * @param			Object			mensaje				Mensaje de validación
	 * @return			void								Escribe en el HTML el mensaje
	 */
	errorValidacion			: function($container, $item, mensaje)
	{
		var $mensajes		= $('.validacion', $container);

		if ( $container.length )
		{
			if ( ! $mensajes.length )
			{
				$container.prepend($('<div />',
				{
					class		: 'validacion',
					text		: mensaje
				}));
			}
			else
			{
				$mensajes.text(mensaje);
			}
		}
		$item.focus();
		return false;
	},
	
	/**
	 * Determina el origen del visitante
	 * Reachlocal / Organico
	 *
	 * @return			string								Origen del visitante
	 */
	origenVisita				: function()
	{
		return (location.href.match(/rtrk\.cl/i) !== null ? 'ReachLocal' : 'Organico');
	}
});

/**
 * jQuery
 */
jQuery(document).ready(function($)
{
	/**
	 * Globales
	 */
	var $form_container		= $('#formulario'),
		$form				= $('form', $form_container),
		$input_origen		= $('[name$="[origen]"]', $form);

	/**
	 * Formulario
	 */
	if ( $form.length )
	{
		/**
		 * Origen del visitante
		 */
		if ( $input_origen.length )
		{
			$input_origen.val($.origenVisita());
		}
	
		/**
		 * Enmascaramiento y restriccion de inputs
		 */
		$('[name$="[nombre]"]', $form).alphanumeric({ allow: ' .\'"' });


		/**
		 * Reglas validacion
		 */
		$form.validate(
		{
			showErrors		: function() { return false; },
			invalidHandler	: function(evento, validador)
			{
				return $.errorValidacion($form_container, $(validador.errorList[0].element), validador.errorList[0].message);
			},
			submitHandler	: function(form) { if ( ! $(form).valid() ) { return false; } else { form.submit(); } },
			rules			: {
				'data[Lead][nombre]': {
					required		: true,
					maxlength		: 80
				},
				'data[Lead][email]': {
					required		: true,
					email			: true,
					maxlength		: 150
				}
			},
			messages		: {
				'data[Lead][nombre]': {
					required		: 'Debes ingresar tu nombre',
					maxlength		: $.validator.format('Tu nombre debe tener un máximo de {0} caracteres.')
				},
				'data[Lead][email]': {
					required		: 'Debes ingresar tu email',
					email			: 'Debes ingresar un email válido',
					maxlength		: $.validator.format('Tu email debe tener un máximo de {0} caracteres.')
				}
			}
		});
	}
});

//]]>
