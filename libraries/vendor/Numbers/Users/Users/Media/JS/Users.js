Numbers.NumbersUsersUsersFormUsers = Numbers.extend(Numbers.Form, {

	/**
	 * Selected shape
	 */
	selected_shape: null,

	/**
	 * Drawing manager
	 */
	drawing_manager: null,

	/**
	 * Map
	 */
	map: null,

	/**
	 * Nearest polygon field
	 */
	nearest_polygon_field: null,

	/**
	 * Initialize
	 *
	 * @param element element
	 */
	initialize: function(element) {
		var that = this;
		// find nearest fields
		this.nearest_polygon_field = $(element).closest('.container-fluid').find('.um_usrassgeoarea_polygon');
		var nearest_geometry_field = $(element).closest('.container-fluid').find('.um_usrassgeoarea_polygon__geometry');
		// parse geometry
		var geometry = $(nearest_geometry_field).val();
		if (!geometry) {
			geometry = null;
		} else {
			geometry = JSON.parse(html_decode(geometry));
		}
		// 1 second delay for modal to render
		setTimeout(function() {
			that.map = new google.maps.Map(document.getElementById('form_um_users_element_google_map_div'), {
				center: {lat: 43.747289, lng: -79.523849},
				zoom: 4
			});
			that.drawing_manager = new google.maps.drawing.DrawingManager({
				drawingMode: google.maps.drawing.OverlayType.MARKER,
				drawingControl: true,
				drawingControlOptions: {
					position: google.maps.ControlPosition.TOP_CENTER,
					drawingModes: ['polygon']
				},
				markerOptions: {
					draggable: true
				},
				circleOptions: {
					fillColor: '#ffff00',
					fillOpacity: 1,
					strokeWeight: 5,
					clickable: false,
					editable: true,
					zIndex: 1
				}
			});
			that.drawing_manager.setMap(that.map);
			// add an existing overlay
			if (geometry) {
				var coordinates = [];
				for (var i in geometry.coordinates) {
					for (var j in geometry.coordinates[i]) {
						coordinates.push(new google.maps.LatLng(geometry.coordinates[i][j][0], geometry.coordinates[i][j][1]));
					}
				}
				var temp_shape = new google.maps.Polygon({
					path: coordinates,
					strokeWeight: 2.5,
					clickable: false,
					editable: true,
					zIndex: 1
				});
				temp_shape.setMap(that.map);
				that.setSelection(temp_shape);
				that.drawing_manager.setOptions({
					drawingControl: false
				});
			}
			// complete overlay
			google.maps.event.addListener(that.drawing_manager, 'overlaycomplete', function(event) {
				var new_shape = event.overlay;
				new_shape.type = event.type;
				if (event.type != google.maps.drawing.OverlayType.MARKER) {
					that.drawing_manager.setDrawingMode(null);
					that.drawing_manager.setOptions({
						drawingControl: false
					});
					google.maps.event.addListener(new_shape, 'click', function() {
						that.setSelection(new_shape);
					});
					that.setSelection(new_shape);
				} else {
					new_shape.setMap(null);
				}
			});
		}, 1000);
	},

	/**
	 * Clear selection
	 */
	clearSelection: function clearSelection() {
		if (this.selected_shape) {
			this.selected_shape.setEditable(false);
			this.selected_shape = null;
		}
	},

	/**
	 * Delete selected shape
	 */
	deleteSelectedShape: function () {
		if (this.selected_shape) {
			this.selected_shape.setMap(null);
			// To show:
			this.drawing_manager.setOptions({
				drawingControl: true
			});
		}
	},

	/**
	 * Set selection
	 */
	setSelection: function (shape) {
		this.clearSelection();
		this.selected_shape = shape;
		shape.setEditable(true);
	},

	/**
	 * Set polygon
	 */
	setPolygon: function () {
		var vertices = this.selected_shape.getPath();
		var str = [], first = null;
        for (var i = 0; i < vertices.getLength(); i++) {
			str.push(vertices.getAt(i).lat().toString() + ' ' + vertices.getAt(i).lng().toString());
			if (!first) {
				first = vertices.getAt(i).lat().toString() + ' ' + vertices.getAt(i).lng().toString();
			}
        }
		str.push(first);
		$(this.nearest_polygon_field).val("ST_GeomFromText('POLYGON((" + str.join(',') + "))')");
	}
});