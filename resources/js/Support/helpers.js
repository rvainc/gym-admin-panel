import moment from "moment/moment";

export const formatDate = (date) => moment(date).format('DD.MM.YYYY');
