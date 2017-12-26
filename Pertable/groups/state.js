RegisterGroup("solids",
function(i) { return MeltingPoints[i] != null && MeltingPoints[i] > this.param.value; },
{ param: { name: "temperature", value: 293.15 } }
);

//================================================================================================================

RegisterGroup("liquids",
function(i) { return MeltingPoints[i] != null && BoilingPoints[i] != null && MeltingPoints[i] < this.param.value && BoilingPoints[i] > this.param.value; },
{ param: { name: "temperature", value: 293.15 } }
);

//===============================================================================================================

RegisterGroup("gases",
function(i) { return BoilingPoints[i] != null && BoilingPoints[i] < this.param.value; },
{ param: { name: "temperature", value: 293.15 } }
);
